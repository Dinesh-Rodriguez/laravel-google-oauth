<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Socialite Google App</title>
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
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
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
            background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(120, 119, 198, 0.3), transparent),
                        linear-gradient(180deg, var(--surface) 0%, var(--surface-elevated) 100%);
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
                radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .floating-orbs {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            animation: float 6s ease-in-out infinite;
        }

        .orb:nth-child(1) {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .orb:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .orb:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 50%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) scale(1);
            }
            50% {
                transform: translateY(-20px) scale(1.05);
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
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.03), transparent);
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

        .logo {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: translateY(-1px);
        }

        .logo i {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .logo:hover i {
            transform: rotate(10deg) scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: var(--spacing-lg);
            background: var(--surface);
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .user-info:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--border-hover);
        }

        .user-avatar {
            width: 3rem;
            height: 3rem;
            border-radius: var(--radius-lg);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-md);
        }

        .user-details h3 {
            color: var(--text-primary);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.125rem;
        }

        .user-details p {
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .logout-btn {
            background: linear-gradient(135deg, var(--error), #dc2626);
            color: white;
            border: none;
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--radius-xl);
            font-size: 0.875rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            box-shadow: var(--shadow-sm);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .logout-btn:active {
            transform: translateY(0);
            box-shadow: var(--shadow-sm);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: var(--spacing-2xl) var(--spacing-xl);
        }

        .welcome-section {
            text-align: center;
            margin-bottom: var(--spacing-2xl);
            animation: fadeInUp 0.8s ease-out;
        }

        .welcome-section h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            color: var(--text-primary);
            margin-bottom: var(--spacing-lg);
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }

        .welcome-section p {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: var(--spacing-xl);
            font-weight: 500;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
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

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: var(--spacing-xl);
            margin-top: var(--spacing-2xl);
        }

        .service-card {
            background: var(--surface);
            backdrop-filter: blur(20px) saturate(180%);
            border-radius: var(--radius-xl);
            padding: var(--spacing-2xl);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border);
            animation: fadeInUp 0.8s ease-out;
            animation-fill-mode: both;
        }

        .service-card:nth-child(1) { animation-delay: 0.1s; }
        .service-card:nth-child(2) { animation-delay: 0.2s; }
        .service-card:nth-child(3) { animation-delay: 0.3s; }

        .service-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--border-hover);
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        }

        .service-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--gradient-light));
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            border-radius: var(--radius-xl);
        }

        .service-card:hover::after {
            opacity: 1;
        }

        .service-card.calendar {
            --gradient: linear-gradient(135deg, #4285f4, #34a853);
            --gradient-light: linear-gradient(135deg, rgba(66, 133, 244, 0.05), rgba(52, 168, 83, 0.05));
        }

        .service-card.email {
            --gradient: linear-gradient(135deg, #ea4335, #fbbc04);
            --gradient-light: linear-gradient(135deg, rgba(234, 67, 53, 0.05), rgba(251, 188, 4, 0.05));
        }

        .service-card.todos {
            --gradient: linear-gradient(135deg, #9c27b0, #673ab7);
            --gradient-light: linear-gradient(135deg, rgba(156, 39, 176, 0.05), rgba(103, 58, 183, 0.05));
        }

        .service-icon {
            width: 5rem;
            height: 5rem;
            border-radius: var(--radius-xl);
            margin: 0 auto var(--spacing-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 10;
        }

        .service-card:hover .service-icon {
            transform: translateY(-4px) scale(1.1);
            box-shadow: var(--shadow-xl);
        }

        .calendar .service-icon {
            background: linear-gradient(135deg, #4285f4, #34a853);
        }

        .email .service-icon {
            background: linear-gradient(135deg, #ea4335, #fbbc04);
        }

        .todos .service-icon {
            background: linear-gradient(135deg, #9c27b0, #673ab7);
        }

        .service-card h3 {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: var(--spacing-md);
            font-weight: 700;
            position: relative;
            z-index: 10;
        }

        .service-card p {
            color: var(--text-secondary);
            margin-bottom: var(--spacing-xl);
            line-height: 1.7;
            font-size: 1rem;
            font-weight: 500;
            position: relative;
            z-index: 10;
        }

        .service-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-decoration: none;
            padding: var(--spacing-md) var(--spacing-xl);
            border-radius: var(--radius-xl);
            font-weight: 600;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-sm);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
            position: relative;
            z-index: 10;
            overflow: hidden;
        }

        .service-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .service-btn:hover::before {
            left: 100%;
        }

        .service-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: var(--shadow-xl);
            color: white;
        }

        .service-btn:active {
            transform: translateY(-1px) scale(1.02);
        }

        .stats {
            background: var(--surface);
            backdrop-filter: blur(20px) saturate(180%);
            border-radius: var(--radius-xl);
            padding: var(--spacing-2xl);
            margin: var(--spacing-2xl) 0;
            text-align: center;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-lg);
            animation: fadeInUp 0.8s ease-out;
            animation-delay: 0.4s;
            animation-fill-mode: both;
        }

        .stats h2 {
            color: var(--text-primary);
            margin-bottom: var(--spacing-xl);
            font-size: 1.75rem;
            font-weight: 700;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-xl);
        }

        .stat-item {
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            background: var(--surface-elevated);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--border-hover);
        }

        .stat-number {
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: var(--spacing-xs);
            line-height: 1.2;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            .services-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: var(--spacing-lg);
                padding: 0 var(--spacing-md);
            }

            .user-info {
                order: -1;
                justify-content: center;
            }

            .container {
                padding: var(--spacing-xl) var(--spacing-md);
            }

            .services-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-lg);
            }

            .service-card {
                padding: var(--spacing-xl) var(--spacing-lg);
            }

            .stats {
                margin: var(--spacing-xl) 0;
                padding: var(--spacing-xl);
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-md);
            }
        }

        @media (max-width: 480px) {
            .welcome-section h1 {
                font-size: 2.5rem;
            }
            
            .nav-container {
                padding: 0 var(--spacing-sm);
            }
            
            .container {
                padding: var(--spacing-lg) var(--spacing-sm);
            }
        }
    </style>
</head>
<body>
    <div class="floating-orbs">
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
    </div>

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <i class="fab fa-google"></i>
                <span>Socialite App</span>
            </div>
            
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p>{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-section">
            <h1>Welcome Back, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h1>
            <p>Access your Google services from one beautiful dashboard</p>
        </div>

        <div class="stats">
            <h2>Connected Services</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Google Services</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">✓</div>
                    <div class="stat-label">OAuth Connected</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">∞</div>
                    <div class="stat-label">Possibilities</div>
                </div>
            </div>
        </div>

        <div class="services-grid">
            <div class="service-card calendar">
                <div class="service-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Google Calendar</h3>
                <p>View and manage your upcoming events, meetings, and appointments in a beautiful interface.</p>
                <a href="{{ route('calendar') }}" class="service-btn">
                    <i class="fas fa-calendar-check"></i>
                    Open Calendar
                </a>
            </div>

            <div class="service-card email">
                <div class="service-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>Gmail</h3>
                <p>Read your latest email messages and stay connected with your important communications.</p>
                <a href="{{ route('email') }}" class="service-btn">
                    <i class="fas fa-envelope-open"></i>
                    Read Emails
                </a>
            </div>

            <div class="service-card todos">
                <div class="service-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <h3>Google Tasks</h3>
                <p>Organize your tasks and to-dos efficiently with Google's powerful task management system.</p>
                <a href="{{ route('todos') }}" class="service-btn">
                    <i class="fas fa-check-circle"></i>
                    View Tasks
                </a>
            </div>
        </div>
    </div>
</body>
</html>