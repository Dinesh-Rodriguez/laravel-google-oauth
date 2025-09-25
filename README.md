echo "# Laravel Google OAuth Integration

A professional Laravel application with Google OAuth authentication and integration with Google Calendar, Gmail, and Tasks APIs.

## Features

- **Google OAuth Authentication** - Secure login with Google accounts
- **Google Calendar Integration** - View and display calendar events
- **Gmail Integration** - Access and display email messages
- **Google Tasks Integration** - View and manage tasks
- **Modern UI/UX** - Enterprise-grade responsive design
- **Token Management** - Automatic token refresh handling

## Technologies Used

- Laravel 12.x
- Google OAuth 2.0
- Google APIs (Calendar, Gmail, Tasks)
- MySQL Database
- Modern CSS with animations
- Responsive design

## Installation

1. Clone the repository
\`\`\`bash
git clone https://github.com/YOUR_USERNAME/REPOSITORY_NAME.git
cd REPOSITORY_NAME
\`\`\`

2. Install dependencies
\`\`\`bash
composer install
\`\`\`

3. Set up environment
\`\`\`bash
cp .env.example .env
php artisan key:generate
\`\`\`

4. Configure database and Google OAuth credentials in .env

5. Run migrations
\`\`\`bash
php artisan migrate
\`\`\`

6. Start the server
\`\`\`bash
php artisan serve
\`\`\`

## Google OAuth Setup

1. Create a project in Google Cloud Console
2. Enable Calendar, Gmail, and Tasks APIs
3. Create OAuth 2.0 credentials
4. Add redirect URI: http://127.0.0.1:8000/auth/google/callback
5. Update .env with your credentials

## Screenshots

[Add screenshots of your application here]

## License

This project is open-sourced software licensed under the MIT license.
" > README.md