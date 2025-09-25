<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;

Route::get('/', function() { return view('login'); });

Route::get('/auth/google', [SocialAuthController::class,'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class,'handleGoogleCallback'])->name('google.callback');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function(){ return view('dashboard'); })->name('dashboard');
    Route::get('/calendar', [SocialAuthController::class,'calendar'])->name('calendar');
    Route::get('/email', [SocialAuthController::class,'email'])->name('email');
    Route::get('/todos', [SocialAuthController::class,'todos'])->name('todos');
    Route::post('/logout', function(){ auth()->logout(); return redirect('/'); })->name('logout');
});
