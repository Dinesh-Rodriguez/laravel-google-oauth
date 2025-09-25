<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar - Socialite Google App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #4285f4;
            --primary-dark: #1a73e8;
            --secondary: #34a853;
            --accent: #ea4335;
            --warning: #fbbc04;
            --surface: #ffffff;
            --surface-elevated: #f8fafc;
            --surface-hover: #f1f5f9;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-tertiary: #94a3b8;
            --border: #e2e8f0;
            --border-hover: #cbd5e1;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-2xl: 3rem;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(66, 133, 244, 0.15), transparent),
                        linear-gradient(135deg, var(--surface) 0%, var(--surface-elevated) 100%);
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(66, 133, 244, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(52, 168, 83, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(66, 133, 244, 0.1), rgba(52, 168, 83, 0.1));
            animation: floatCalendar 8s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 120px;
            height: 120px;
            top: 15%;
            left: 15%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 80px;
            height: 80px;
            top: 70%;
            right: 20%;
            animation-delay: 3s;
        }

        .particle:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 60%;
            animation-delay: 6s;
        }

        @keyframes floatCalendar {
            0%, 100% {
                transform: translateY(0px) rotate(0deg) scale(1);
            }
            33% {
                transform: translateY(-15px) rotate(5deg) scale(1.05);
            }
            66% {
                transform: translateY(-25px) rotate(-5deg) scale(0.95);
            }
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-lg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: var(--spacing-lg) 0;
        }

        .navbar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(66, 133, 244, 0.03), transparent);
            pointer-events: none;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 var(--spacing-xl);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            text-decoration: none;
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--radius-xl);
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .back-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .back-btn:hover::before {
            left: 100%;
        }

        .back-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: var(--shadow-xl);
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.25rem;
        }

        .page-title i {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .page-title:hover i {
            transform: rotate(10deg) scale(1.05);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: var(--spacing-2xl) var(--spacing-xl);
        }

        .header {
            text-align: center;
            margin-bottom: var(--spacing-2xl);
            animation: fadeInUp 0.8s ease-out;
        }

        .header h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            margin-bottom: var(--spacing-lg);
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }

        .header p {
            font-size: 1.25rem;
            color: var(--text-secondary);
            font-weight: 500;
            max-width: 600px;
            margin: 0 auto;
        }

        .events-container {
            background: var(--surface);
            backdrop-filter: blur(20px) saturate(180%);
            border-radius: var(--radius-xl);
            padding: var(--spacing-2xl);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border);
            animation: fadeInUp 0.8s ease-out;
            animation-delay: 0.2s;
            animation-fill-mode: both;
        }

        .events-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xl);
            padding-bottom: var(--spacing-lg);
            border-bottom: 1px solid var(--border);
        }

        .events-header h2 {
            color: var(--text-primary);
            font-size: 1.75rem;
            font-weight: 700;
        }

        .events-count {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--radius-xl);
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .events-count:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .events-grid {
            display: grid;
            gap: var(--spacing-lg);
        }

        .event-card {
            background: var(--surface-elevated);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xl);
            border-left: 4px solid;
            box-shadow: var(--shadow-md);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border);
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .event-card:nth-child(1) { animation-delay: 0.1s; }
        .event-card:nth-child(2) { animation-delay: 0.2s; }
        .event-card:nth-child(3) { animation-delay: 0.3s; }
        .event-card:nth-child(4) { animation-delay: 0.4s; }
        .event-card:nth-child(5) { animation-delay: 0.5s; }

        .event-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--border-hover);
        }

        .event-card:nth-child(odd) {
            border-left-color: var(--primary);
        }

        .event-card:nth-child(even) {
            border-left-color: var(--secondary);
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4rem;
            height: 4rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            opacity: 0.05;
            border-radius: 0 var(--radius-xl) 0 var(--radius-2xl);
            transition: all 0.3s ease;
        }

        .event-card:hover::before {
            opacity: 0.1;
            transform: scale(1.1);
        }

        .event-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--spacing-md);
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .event-time {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }

        .time-item {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
            padding: var(--spacing-md);
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .time-item:hover {
            border-color: var(--border-hover);
            box-shadow: var(--shadow-sm);
        }

        .time-item i {
            color: var(--primary);
            font-size: 1rem;
            align-self: flex-start;
        }

        .time-label {
            font-size: 0.75rem;
            color: var(--text-tertiary);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .time-value {
            font-size: 0.875rem;
            color: var(--text-primary);
            font-weight: 600;
        }

        .no-events {
            text-align: center;
            padding: var(--spacing-2xl);
            color: var(--text-secondary);
        }

        .no-events i {
            font-size: 4rem;
            color: var(--text-tertiary);
            margin-bottom: var(--spacing-lg);
            opacity: 0.5;
        }

        .no-events h3 {
            font-size: 1.5rem;
            margin-bottom: var(--spacing-sm);
            color: var(--text-primary);
            font-weight: 600;
        }

        .no-events p {
            font-size: 1rem;
            line-height: 1.6;
            font-weight: 500;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .events-container {
                padding: var(--spacing-xl);
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: var(--spacing-lg);
                padding: 0 var(--spacing-md);
            }

            .container {
                padding: var(--spacing-xl) var(--spacing-md);
            }

            .events-container {
                padding: var(--spacing-lg);
            }

            .events-header {
                flex-direction: column;
                gap: var(--spacing-md);
                text-align: center;
            }

            .event-time {
                grid-template-columns: 1fr;
            }

            .event-card {
                padding: var(--spacing-lg);
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                padding: 0 var(--spacing-sm);
            }
            
            .container {
                padding: var(--spacing-lg) var(--spacing-sm);
            }
            
            .events-container {
                padding: var(--spacing-md);
            }
        }
    </style>
</head>
<body>
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
            
            <div class="page-title">
                <i class="fas fa-calendar-alt"></i>
                <h2>Google Calendar</h2>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1>📅 Your Calendar Events</h1>
            <p>Stay organized with your upcoming events and meetings</p>
        </div>

        <div class="events-container">
            <div class="events-header">
                <h2>Upcoming Events</h2>
                <div class="events-count">{{ count($events) }} Events</div>
            </div>

            @if(count($events) > 0)
                <div class="events-grid">
                    @foreach($events as $event)
                        <div class="event-card">
                            <h3 class="event-title">
                                <i class="fas fa-calendar-check"></i>
                                {{ $event->getSummary() ?? 'No Title' }}
                            </h3>
                            
                            <div class="event-time">
                                <div class="time-item">
                                    <i class="fas fa-play"></i>
                                    <div>
                                        <div class="time-label">Start Time</div>
                                        <div class="time-value">
                                            {{ $event->start->dateTime ? 
                                                \Carbon\Carbon::parse($event->start->dateTime)->format('M j, Y g:i A') : 
                                                \Carbon\Carbon::parse($event->start->date)->format('M j, Y') }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="time-item">
                                    <i class="fas fa-stop"></i>
                                    <div>
                                        <div class="time-label">End Time</div>
                                        <div class="time-value">
                                            {{ $event->end->dateTime ? 
                                                \Carbon\Carbon::parse($event->end->dateTime)->format('M j, Y g:i A') : 
                                                \Carbon\Carbon::parse($event->end->date)->format('M j, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($event->getDescription())
                                <div class="event-description">
                                    <p>{{ Str::limit($event->getDescription(), 150) }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-events">
                    <i class="fas fa-calendar-times"></i>
                    <h3>No upcoming events</h3>
                    <p>Your calendar is clear! Time to plan something awesome.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>