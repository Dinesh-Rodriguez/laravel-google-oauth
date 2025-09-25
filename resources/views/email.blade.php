<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail - Socialite Google App</title>
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
            --primary: #ea4335;
            --primary-dark: #d33b2c;
            --secondary: #fbbc04;
            --accent: #34a853;
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
            background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(234, 67, 53, 0.15), transparent),
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
                radial-gradient(circle at 25% 25%, rgba(234, 67, 53, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(251, 188, 4, 0.08) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .floating-bubbles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(234, 67, 53, 0.1), rgba(251, 188, 4, 0.1));
            animation: floatEmail 10s ease-in-out infinite;
        }

        .bubble:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .bubble:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
            animation-delay: 4s;
        }

        .bubble:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 25%;
            left: 70%;
            animation-delay: 8s;
        }

        @keyframes floatEmail {
            0%, 100% {
                transform: translateY(0px) scale(1) rotate(0deg);
            }
            25% {
                transform: translateY(-20px) scale(1.1) rotate(2deg);
            }
            50% {
                transform: translateY(-10px) scale(0.9) rotate(-2deg);
            }
            75% {
                transform: translateY(-30px) scale(1.05) rotate(1deg);
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
            background: linear-gradient(90deg, transparent, rgba(234, 67, 53, 0.03), transparent);
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
            color: white;
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

        .inbox-container {
            background: var(--surface);
            backdrop-filter: blur(20px) saturate(180%);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border);
            animation: fadeInUp 0.8s ease-out;
            animation-delay: 0.2s;
            animation-fill-mode: both;
        }

        .inbox-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: var(--spacing-2xl);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .inbox-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .inbox-header h2 {
            font-size: 1.75rem;
            margin-bottom: var(--spacing-sm);
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .inbox-stats {
            display: flex;
            justify-content: center;
            gap: var(--spacing-2xl);
            margin-top: var(--spacing-lg);
            position: relative;
            z-index: 1;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            display: block;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-top: var(--spacing-xs);
        }

        .emails-list {
            max-height: 70vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
        }

        .emails-list::-webkit-scrollbar {
            width: 6px;
        }

        .emails-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .emails-list::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: var(--radius-sm);
        }

        .emails-list::-webkit-scrollbar-thumb:hover {
            background: var(--border-hover);
        }

        .email-item {
            padding: var(--spacing-xl) var(--spacing-2xl);
            border-bottom: 1px solid var(--border);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            animation: slideInRight 0.6s ease-out;
            animation-fill-mode: both;
        }

        .email-item:nth-child(1) { animation-delay: 0.1s; }
        .email-item:nth-child(2) { animation-delay: 0.2s; }
        .email-item:nth-child(3) { animation-delay: 0.3s; }
        .email-item:nth-child(4) { animation-delay: 0.4s; }
        .email-item:nth-child(5) { animation-delay: 0.5s; }

        .email-item:hover {
            background: var(--surface-hover);
            transform: translateX(4px);
            border-color: var(--border-hover);
        }

        .email-item:last-child {
            border-bottom: none;
        }

        .email-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: var(--spacing-md);
        }

        .email-from {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            flex: 1;
        }

        .sender-avatar {
            width: 3rem;
            height: 3rem;
            border-radius: var(--radius-lg);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .email-item:hover .sender-avatar {
            transform: scale(1.1);
            box-shadow: var(--shadow-md);
        }

        .sender-info h4 {
            color: var(--text-primary);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.125rem;
        }

        .sender-email {
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .email-date {
            color: var(--text-tertiary);
            font-size: 0.75rem;
            font-weight: 500;
            min-width: 80px;
            text-align: right;
        }

        .email-subject {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--spacing-sm);
            line-height: 1.4;
        }

        .email-snippet {
            color: var(--text-secondary);
            font-size: 0.875rem;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-weight: 500;
        }

        .email-unread {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }

        .no-emails {
            text-align: center;
            padding: var(--spacing-2xl);
            color: var(--text-secondary);
        }

        .no-emails i {
            font-size: 4rem;
            color: var(--text-tertiary);
            margin-bottom: var(--spacing-lg);
            opacity: 0.5;
        }

        .no-emails h3 {
            font-size: 1.5rem;
            margin-bottom: var(--spacing-sm);
            color: var(--text-primary);
            font-weight: 600;
        }

        .no-emails p {
            font-size: 1rem;
            line-height: 1.6;
            font-weight: 500;
        }

        .refresh-btn {
            position: fixed;
            bottom: var(--spacing-xl);
            right: var(--spacing-xl);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
        }

        .refresh-btn:hover {
            transform: translateY(-4px) rotate(180deg) scale(1.1);
            box-shadow: var(--shadow-xl);
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

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 1024px) {
            .inbox-container {
                margin: 0 var(--spacing-md);
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

            .inbox-stats {
                flex-direction: column;
                gap: var(--spacing-md);
            }

            .email-header {
                flex-direction: column;
                gap: var(--spacing-sm);
            }

            .email-date {
                text-align: left;
                min-width: auto;
            }

            .inbox-header {
                padding: var(--spacing-xl);
            }

            .email-item {
                padding: var(--spacing-lg);
            }

            .refresh-btn {
                bottom: var(--spacing-md);
                right: var(--spacing-md);
                width: 3.5rem;
                height: 3.5rem;
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                padding: 0 var(--spacing-sm);
            }
            
            .container {
                padding: var(--spacing-lg) var(--spacing-sm);
            }
            
            .inbox-header {
                padding: var(--spacing-lg);
            }
            
            .email-item {
                padding: var(--spacing-md);
            }
        }
    </style>
</head>
<body>
    <div class="floating-bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
            
            <div class="page-title">
                <i class="fas fa-envelope"></i>
                <h2>Gmail Inbox</h2>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1>📧 Your Gmail Inbox</h1>
            <p>Stay connected with your latest messages</p>
        </div>

        <div class="inbox-container">
            <div class="inbox-header">
                <h2>Recent Messages</h2>
                <div class="inbox-stats">
                    <div class="stat">
                        <div class="stat-number">{{ count($messages) }}</div>
                        <div class="stat-label">Messages</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">📱</div>
                        <div class="stat-label">Connected</div>
                    </div>
                </div>
            </div>

            @if(count($messages) > 0)
                <div class="emails-list">
                    @foreach($messages as $index => $message)
                        <div class="email-item">
                            @if($index < 3)
                                <div class="email-unread"></div>
                            @endif
                            
                            <div class="email-header">
                                <div class="email-from">
                                    <div class="sender-avatar">
                                        {{ strtoupper(substr(explode('<', str_replace('"', '', $message['from']))[0], 0, 1)) }}
                                    </div>
                                    <div class="sender-info">
                                        <h4>{{ explode('<', str_replace('"', '', $message['from']))[0] ?? 'Unknown Sender' }}</h4>
                                        <div class="sender-email">
                                            {{ preg_match('/<(.+)>/', $message['from'], $matches) ? $matches[1] : $message['from'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="email-date">
                                    {{ $message['date'] ? \Carbon\Carbon::parse($message['date'])->diffForHumans() : 'No date' }}
                                </div>
                            </div>
                            
                            <h3 class="email-subject">
                                {{ $message['subject'] ?? 'No Subject' }}
                            </h3>
                            
                            <p class="email-snippet">
                                {{ $message['snippet'] ?? 'No preview available' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-emails">
                    <i class="fas fa-inbox"></i>
                    <h3>Your inbox is empty</h3>
                    <p>No messages found. Check back later for new emails!</p>
                </div>
            @endif
        </div>
    </div>

    <button class="refresh-btn" onclick="window.location.reload()">
        <i class="fas fa-sync-alt"></i>
    </button>
</body>
</html>