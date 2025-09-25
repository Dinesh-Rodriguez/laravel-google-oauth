<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks - Socialite Google App</title>
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
            --primary: #9c27b0;
            --primary-dark: #7b1fa2;
            --secondary: #673ab7;
            --accent: #3f51b5;
            --success: #4caf50;
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
            background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(156, 39, 176, 0.15), transparent),
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
                radial-gradient(circle at 30% 30%, rgba(156, 39, 176, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(103, 58, 183, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            background: linear-gradient(135deg, rgba(156, 39, 176, 0.1), rgba(103, 58, 183, 0.1));
            animation: floatTasks 12s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            top: 70%;
            right: 25%;
            animation-delay: 4s;
        }

        .shape:nth-child(3) {
            width: 120px;
            height: 60px;
            border-radius: 50px;
            bottom: 20%;
            left: 60%;
            animation-delay: 8s;
        }

        @keyframes floatTasks {
            0%, 100% {
                transform: translateY(0px) rotate(0deg) scale(1);
            }
            25% {
                transform: translateY(-25px) rotate(5deg) scale(1.1);
            }
            50% {
                transform: translateY(-15px) rotate(-3deg) scale(0.9);
            }
            75% {
                transform: translateY(-35px) rotate(2deg) scale(1.05);
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
            background: linear-gradient(90deg, transparent, rgba(156, 39, 176, 0.03), transparent);
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
            max-width: 1200px;
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

        .tasks-container {
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

        .tasks-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: var(--spacing-2xl);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .tasks-header::before {
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

        .tasks-header h2 {
            font-size: 1.75rem;
            margin-bottom: var(--spacing-sm);
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .tasks-stats {
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

        .tasks-list {
            padding: 0;
        }

        .task-item {
            display: flex;
            align-items: center;
            padding: var(--spacing-xl) var(--spacing-2xl);
            border-bottom: 1px solid var(--border);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            animation: slideInLeft 0.6s ease-out;
            animation-fill-mode: both;
        }

        .task-item:nth-child(1) { animation-delay: 0.1s; }
        .task-item:nth-child(2) { animation-delay: 0.2s; }
        .task-item:nth-child(3) { animation-delay: 0.3s; }
        .task-item:nth-child(4) { animation-delay: 0.4s; }
        .task-item:nth-child(5) { animation-delay: 0.5s; }

        .task-item:hover {
            background: var(--surface-hover);
            transform: translateX(4px);
            border-color: var(--border-hover);
        }

        .task-item:last-child {
            border-bottom: none;
        }

        .task-checkbox {
            width: 1.5rem;
            height: 1.5rem;
            border: 2px solid var(--border-hover);
            border-radius: 50%;
            margin-right: var(--spacing-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            flex-shrink: 0;
            position: relative;
        }

        .task-checkbox::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--success), #45a049);
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        .task-checkbox i {
            position: relative;
            z-index: 1;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
            color: white;
            font-size: 0.75rem;
        }

        .task-item.completed .task-checkbox::before {
            opacity: 1;
            transform: scale(1);
        }

        .task-item.completed .task-checkbox i {
            opacity: 1;
            transform: scale(1);
        }

        .task-item.completed .task-checkbox {
            border-color: var(--success);
        }

        .task-item.completed .task-title {
            text-decoration: line-through;
            opacity: 0.6;
        }

        .task-content {
            flex: 1;
        }

        .task-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--spacing-xs);
            line-height: 1.4;
        }

        .task-meta {
            display: flex;
            gap: var(--spacing-lg);
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .task-status {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .status-badge {
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: var(--radius-xl);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-completed {
            background: rgba(76, 175, 80, 0.1);
            color: var(--success);
        }

        .status-pending {
            background: rgba(255, 152, 0, 0.1);
            color: #ff9800;
        }

        .task-priority {
            position: absolute;
            right: var(--spacing-lg);
            top: 50%;
            transform: translateY(-50%);
        }

        .priority-high {
            color: #f44336;
        }

        .priority-medium {
            color: #ff9800;
        }

        .priority-low {
            color: var(--success);
        }

        .no-tasks {
            text-align: center;
            padding: var(--spacing-2xl);
            color: var(--text-secondary);
        }

        .no-tasks i {
            font-size: 4rem;
            color: var(--text-tertiary);
            margin-bottom: var(--spacing-lg);
            opacity: 0.5;
        }

        .no-tasks h3 {
            font-size: 1.5rem;
            margin-bottom: var(--spacing-sm);
            color: var(--text-primary);
            font-weight: 600;
        }

        .no-tasks p {
            font-size: 1rem;
            line-height: 1.6;
            font-weight: 500;
        }

        .progress-bar {
            margin: var(--spacing-lg) var(--spacing-2xl);
            background: var(--surface-elevated);
            border-radius: var(--radius-lg);
            overflow: hidden;
            height: 6px;
            border: 1px solid var(--border);
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-lg);
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .floating-add {
            position: fixed;
            bottom: var(--spacing-xl);
            right: var(--spacing-xl);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
        }

        .floating-add:hover {
            transform: translateY(-4px) rotate(90deg) scale(1.1);
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

        @keyframes slideInLeft {
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
            .tasks-container {
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

            .tasks-stats {
                flex-direction: column;
                gap: var(--spacing-md);
            }

            .task-item {
                padding: var(--spacing-lg);
            }

            .task-meta {
                flex-direction: column;
                gap: var(--spacing-sm);
            }

            .tasks-header {
                padding: var(--spacing-xl);
            }

            .floating-add {
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
            
            .tasks-header {
                padding: var(--spacing-lg);
            }
            
            .task-item {
                padding: var(--spacing-md);
            }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
            
            <div class="page-title">
                <i class="fas fa-tasks"></i>
                <h2>Google Tasks</h2>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1>✅ Your Tasks & To-Dos</h1>
            <p>Stay productive with your Google Tasks integration</p>
        </div>

        <div class="tasks-container">
            <div class="tasks-header">
                <h2>Task Management</h2>
                <div class="tasks-stats">
                    <div class="stat">
                        <div class="stat-number">{{ count($tasks) }}</div>
                        <div class="stat-label">Total Tasks</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">
                            {{ collect($tasks)->where('status', 'completed')->count() }}
                        </div>
                        <div class="stat-label">Completed</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">
                            {{ collect($tasks)->where('status', 'needsAction')->count() }}
                        </div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
                
                @if(count($tasks) > 0)
                    @php
                        $completed = collect($tasks)->where('status', 'completed')->count();
                        $total = count($tasks);
                        $percentage = $total > 0 ? ($completed / $total) * 100 : 0;
                    @endphp
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                    </div>
                @endif
            </div>

            @if(count($tasks) > 0)
                <div class="tasks-list">
                    @foreach($tasks as $index => $task)
                        <div class="task-item {{ $task->getStatus() === 'completed' ? 'completed' : '' }}">
                            <div class="task-checkbox">
                                @if($task->getStatus() === 'completed')
                                    <i class="fas fa-check"></i>
                                @endif
                            </div>
                            
                            <div class="task-content">
                                <h3 class="task-title">
                                    {{ $task->getTitle() ?? 'Untitled Task' }}
                                </h3>
                                
                                <div class="task-meta">
                                    <div class="task-status">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="status-badge {{ $task->getStatus() === 'completed' ? 'status-completed' : 'status-pending' }}">
                                            {{ $task->getStatus() === 'completed' ? 'Completed' : 'Pending' }}
                                        </span>
                                    </div>
                                    
                                    @if($task->getDue())
                                        <div class="task-due">
                                            <i class="fas fa-calendar"></i>
                                            Due: {{ \Carbon\Carbon::parse($task->getDue())->format('M j, Y') }}
                                        </div>
                                    @endif
                                </div>

                                @if($task->getNotes())
                                    <div class="task-notes">
                                        <p>{{ Str::limit($task->getNotes(), 100) }}</p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="task-priority priority-{{ $index % 3 === 0 ? 'high' : ($index % 2 === 0 ? 'medium' : 'low') }}">
                                <i class="fas fa-{{ $index % 3 === 0 ? 'exclamation' : ($index % 2 === 0 ? 'minus' : 'arrow-down') }}"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-tasks">
                    <i class="fas fa-check-circle"></i>
                    <h3>No tasks found</h3>
                    <p>You're all caught up! Create new tasks in Google Tasks to see them here.</p>
                </div>
            @endif
        </div>
    </div>

    <button class="floating-add" onclick="alert('Create new tasks in Google Tasks app!')">
        <i class="fas fa-plus"></i>
    </button>
</body>
</html>