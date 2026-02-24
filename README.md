# Google Photos → YouTube Transfer Tool

A Laravel 12 web app that downloads videos from Google Photos and uploads them to YouTube.

## Requirements

- PHP 8.2+
- MySQL
- Node.js & npm
- Composer

## Setup

```bash
composer setup
```

## Google OAuth Credentials

You need a Google OAuth client to allow users to connect their Google Photos and YouTube accounts.

### 1. Create a Google Cloud project

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Click **Select a project** → **New Project**
3. Give it a name and click **Create**

### 2. Enable APIs

In your project, go to **APIs & Services → Library** and enable:

- **Photos Picker API**
- **YouTube Data API v3**

### 3. Configure OAuth consent screen

1. Go to **APIs & Services → OAuth consent screen**
2. Fill in the app name, user support email, and developer contact email
3. Click **Save and Continue** through each step
4. Under **Audience**, make sure the publishing status is set (it starts in "Testing" by default)
5. Add your Google account(s) as **test users** (required while in "Testing" status)

### 4. Create OAuth credentials

1. Go to **APIs & Services → Credentials**
2. Click **Create Credentials → OAuth client ID**
3. Application type: **Web application**
4. Add an **Authorized redirect URI**: `http://localhost:8000/auth/google/callback` (or your `APP_URL` + `/auth/google/callback`)
5. Click **Create**
6. Copy the **Client ID** and **Client Secret**

### 5. Update `.env`

```env
GOOGLE_CLIENT_ID=your-client-id-here
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback
```

## Development

```bash
# Run dev server (app + queue + logs + vite)
composer dev

# Run tests
composer test
```

## Commands

- `php artisan serve` — Start the web server
- `php artisan queue:listen` — Process queue jobs
- `php artisan migrate` — Run database migrations
- `php artisan test` — Run PestPHP tests
- `npm run dev` — Start Vite dev server
- `npm run build` — Build frontend assets