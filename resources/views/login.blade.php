<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Login - Socialite Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #f8fafc;
            --text-secondary: rgba(248, 250, 252, 0.8);
            --shadow-primary: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-glow: 0 0 50px rgba(99, 102, 241, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            opacity: 0.1;
            animation: gradientShift 8s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { transform: translateX(0%) translateY(0%); }
            25% { transform: translateX(-5%) translateY(-2%); }
            50% { transform: translateX(5%) translateY(2%); }
            75% { transform: translateX(-2%) translateY(5%); }
        }

        /* Floating particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.3);
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 70%;
            right: 10%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 10%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .login-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 64px 48px;
            box-shadow: var(--shadow-primary);
            text-align: center;
            max-width: 480px;
            width: 100%;
            position: relative;
            animation: slideUpFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUpFadeIn {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 1px;
            background: var(--primary-gradient);
            border-radius: 1px;
        }

        .logo {
            width: 96px;
            height: 96px;
            background: var(--primary-gradient);
            border-radius: 24px;
            margin: 0 auto 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            box-shadow: var(--shadow-glow);
            position: relative;
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .logo::after {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            background: var(--primary-gradient);
            border-radius: 28px;
            opacity: 0.3;
            z-index: -1;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.05); opacity: 0.1; }
        }

        .brand-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        h1 {
            color: var(--text-primary);
            margin-bottom: 16px;
            font-size: 40px;
            font-weight: 700;
            letter-spacing: -0.025em;
            line-height: 1.1;
        }

        .subtitle {
            color: var(--text-secondary);
            margin-bottom: 48px;
            font-size: 18px;
            line-height: 1.6;
            font-weight: 400;
        }

        .google-btn {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 20px 32px;
            text-decoration: none;
            color: #1e293b;
            font-size: 16px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 16px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            min-width: 320px;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .google-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .google-btn:hover::before {
            left: 100%;
        }

        .google-btn:hover {
            background: rgba(255, 255, 255, 1);
            border-color: rgba(66, 133, 244, 0.3);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -8px rgba(66, 133, 244, 0.4);
        }

        .google-btn:active {
            transform: translateY(-2px);
        }

        .google-icon {
            width: 24px;
            height: 24px;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIyLjU2IDEyLjI1QzIyLjU2IDExLjQ3IDIyLjQ5IDEwLjcyIDIyLjM2IDEwSDE2VjE0LjI2SDIwLjM5QzIwLjE5IDE1LjUyIDE5LjUyIDIwIDEwLjIzIDIwQzYuMjEgMjAgMi44IDE2Ljc5IDIuOCAxMi41UzYuMjEgNSAxMC4yMyA1QzEyLjE9IDUgMTMuNzEgNS42OSAxNC44NyA2Ljc4TDE3Ljk2IDMuNjhDMTYuMDcgMS45MiAxMy41IDEgMTAuMjMgMUM0LjU3IDEgMCA1LjU3IDAgMTIuNVMzLjU3IDI0IDEwLjIzIDI0QzE2LjM1IDI0IDIyLjU2IDE4LjQzIDIyLjU2IDEyLjI1WiIgZmlsbD0iIzQyODVGNCIvPgo8L3N2Zz4K') no-repeat center;
            flex-shrink: 0;
        }

        .features {
            margin-top: 56px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .feature {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 24px 16px;
            border-radius: 16px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            backdrop-filter: blur(10px);
        }

        .feature:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-4px);
        }

        .feature i {
            font-size: 32px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            display: block;
        }

        .feature h3 {
            font-size: 16px;
            color: var(--text-primary);
            margin-bottom: 4px;
            font-weight: 600;
        }

        .feature p {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 400;
        }

        .security-badge {
            margin-top: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .security-badge i {
            color: #10b981;
        }

        @media (max-width: 640px) {
            .login-container {
                padding: 48px 32px;
                margin: 20px;
            }
            
            .features {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .google-btn {
                min-width: auto;
                width: 100%;
            }

            h1 {
                font-size: 32px;
            }

            .subtitle {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 40px 24px;
            }
            
            .logo {
                width: 80px;
                height: 80px;
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="login-container">
        <div class="logo">
            <i class="fab fa-google"></i>
        </div>
        
        <div class="brand-text">Socialite Pro</div>
        <h1>Welcome Back</h1>
        <p class="subtitle">Enterprise-grade Google Workspace integration with advanced security and seamless user experience.</p>
        
        <a href="{{ route('google.redirect') }}" class="google-btn">
            <div class="google-icon"></div>
            Continue with Google Workspace
        </a>
        
        <div class="features">
            <div class="feature">
                <i class="fas fa-calendar-check"></i>
                <h3>Smart Calendar</h3>
                <p>AI-powered scheduling</p>
            </div>
            <div class="feature">
                <i class="fas fa-envelope-open-text"></i>
                <h3>Unified Inbox</h3>
                <p>Intelligent email management</p>
            </div>
            <div class="feature">
                <i class="fas fa-project-diagram"></i>
                <h3>Task Automation</h3>
                <p>Workflow optimization</p>
            </div>
            <div class="feature">
                <i class="fas fa-shield-check"></i>
                <h3>Enterprise Security</h3>
                <p>SOC2 Type II compliant</p>
            </div>
        </div>

        <div class="security-badge">
            <i class="fas fa-lock"></i>
            <span>Protected by 256-bit SSL encryption</span>
        </div>
    </div>
</body>
</html>