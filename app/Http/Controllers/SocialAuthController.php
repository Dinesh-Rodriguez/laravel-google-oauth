<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Gmail;
use Google_Service_Tasks;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes([
                'openid', 'profile', 'email',
                'https://www.googleapis.com/auth/calendar.readonly',
                'https://www.googleapis.com/auth/tasks.readonly',
                'https://www.googleapis.com/auth/gmail.readonly'
            ])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        $gUser = Socialite::driver('google')->user();

        // Save tokens as a JSON structure
        $tokenJson = json_encode([
            'access_token' => $gUser->token,
            'refresh_token' => $gUser->refreshToken ?? null,
            'expires_in' => $gUser->expiresIn ?? null,
            'created' => time()
        ]);

        $user = User::updateOrCreate(
            ['email' => $gUser->getEmail()],
            [
                'name' => $gUser->getName(),
                'google_id' => $gUser->getId(),
                'avatar' => $gUser->getAvatar(),
                'google_token' => $tokenJson,
                'google_refresh_token' => $gUser->refreshToken ?? null,
                'google_token_expires_at' => now()->addSeconds($gUser->expiresIn ?? 3600),
                'password' => null, // Google OAuth users don't need passwords
            ]
        );

        Auth::login($user);
        return redirect('/dashboard');
    }

    protected function clientFromUser($user)
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->setAccessType('offline');

        // Decode stored token JSON
        $stored = null;
        if ($user->google_token) {
            $stored = json_decode($user->google_token, true);
        }

        if ($stored && isset($stored['access_token'])) {
            $client->setAccessToken($stored);
        } elseif ($user->google_token) {
            // fallback - if token is plain string
            $client->setAccessToken(['access_token' => $user->google_token, 'refresh_token' => $user->google_refresh_token]);
        }

        // Refresh when expired
        if ($client->isAccessTokenExpired()) {
            if ($user->google_refresh_token) {
                $client->fetchAccessTokenWithRefreshToken($user->google_refresh_token);
                $newToken = $client->getAccessToken();
                if ($newToken) {
                    $user->update([
                        'google_token' => json_encode($newToken),
                        'google_token_expires_at' => now()->addSeconds($newToken['expires_in'] ?? 3600),
                    ]);
                }
            } else {
                // user must re-consent
                return null;
            }
        }

        return $client;
    }

    public function calendar()
    {
        $user = auth()->user();
        $client = $this->clientFromUser($user);
        if (!$client) return redirect()->route('google.redirect');

        $service = new Google_Service_Calendar($client);
        $events = $service->events->listEvents('primary', [
            'maxResults' => 20,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        ]);

        return view('calendar', ['events' => $events->getItems()]);
    }

    public function todos()
    {
        $user = auth()->user();
        $client = $this->clientFromUser($user);
        if (!$client) return redirect()->route('google.redirect');

        $tasksService = new Google_Service_Tasks($client);
        
        try {
            // First get the task lists, then get tasks from the default list
            $taskLists = $tasksService->tasklists->listTasklists();
            $tasks = collect();
            
            if ($taskLists->getItems()) {
                // Get tasks from the first (default) task list
                $defaultTaskList = $taskLists->getItems()[0];
                $taskList = $tasksService->tasks->listTasks($defaultTaskList->getId(), [
                    'maxResults' => 50,
                    'showCompleted' => true,
                    'showDeleted' => false
                ]);
                $tasks = collect($taskList->getItems());
            }
            
            return view('todos', ['tasks' => $tasks->toArray()]);
            
        } catch (\Exception $e) {
            // If there's an error, return empty tasks array
            return view('todos', ['tasks' => []]);
        }
    }

    public function email()
    {
        $user = auth()->user();
        $client = $this->clientFromUser($user);
        if (!$client) return redirect()->route('google.redirect');

        $gmail = new Google_Service_Gmail($client);
        $list = $gmail->users_messages->listUsersMessages('me', ['maxResults'=>10]);

        $msgs = [];
        if ($list->getMessages()) {
            foreach ($list->getMessages() as $m) {
                $msg = $gmail->users_messages->get('me', $m->getId(), ['format'=>'metadata', 'metadataHeaders'=>['Subject','From','Date']]);
                $snippet = $msg->getSnippet();
                $headers = [];
                foreach ($msg->getPayload()->getHeaders() as $h) {
                    $headers[$h->getName()] = $h->getValue();
                }
                $msgs[] = [
                    'id' => $m->getId(),
                    'snippet' => $snippet,
                    'subject' => $headers['Subject'] ?? '',
                    'from' => $headers['From'] ?? '',
                    'date' => $headers['Date'] ?? '',
                ];
            }
        }

        return view('email', ['messages' => $msgs]);
    }
}
