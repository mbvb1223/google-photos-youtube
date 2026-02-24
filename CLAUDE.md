# Google Photos → YouTube Transfer Tool

A Laravel 12 web app that downloads videos from Google Photos and uploads them to YouTube.

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Database:** MySQL (`google_photos_youtube`)
- **Frontend:** Blade, Tailwind CSS v4, Vite
- **Queue:** Database driver
- **Testing:** PestPHP

## Development

```bash
# Setup
composer setup

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

## Code Style

- Follow PSR-12 coding standard
- Use Laravel Pint for formatting: `./vendor/bin/pint`
- Use strict types in PHP files
- Use constructor property promotion where appropriate
- Use Laravel's `encrypted:array` cast for sensitive data (tokens)

## Architecture

- **Controllers** — Thin controllers, delegate to services
- **Services** — Business logic in `app/Services/`
- **Jobs** — Long-running tasks (video download/upload) in `app/Jobs/`
- **Models** — Eloquent models in `app/Models/`

## APIs

- **Google Photos Picker API** — For selecting videos (Library API readonly scopes deprecated March 2025)
- **YouTube Data API v3** — For uploading videos
- **Google OAuth2** — Via Laravel Socialite

## Environment Variables

```
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback
```