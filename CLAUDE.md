# Google Photos → YouTube Transfer Tool

A Laravel 12 web app that downloads videos from Google Photos and uploads them to YouTube.

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Database:** MySQL (`google_photos_youtube`)
- **Frontend:** Blade, Alpine.js, Tailwind CSS, Vite
- **Queue:** Database driver
- **Auth:** Laravel Breeze (email/password)
- **Google API Client:** `google/apiclient` (OAuth2, Photos Picker, YouTube Data API)
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

- **Controllers** — Thin controllers, delegate to services (`app/Http/Controllers/`)
- **Services** — Business logic (`app/Services/`)
- **Jobs** — Long-running tasks (video download/upload) (`app/Jobs/`)
- **Models** — Eloquent models (`app/Models/`)

### Key Files

- `app/Services/GoogleAuthService.php` — Token management & auto-refresh
- `app/Services/GooglePhotosPickerService.php` — Picker sessions, media items, video download
- `app/Services/YouTubeUploadService.php` — Resumable chunked video upload
- `app/Services/YouTubePlaylistService.php` — Playlist listing & video assignment
- `app/Jobs/ProcessTransferJob.php` — Download from Photos → upload to YouTube pipeline
- `app/Http/Controllers/Auth/GoogleConnectController.php` — OAuth connect/disconnect flows
- `app/Http/Controllers/PickerSessionController.php` — Picker API proxy endpoints
- `app/Http/Controllers/TransferController.php` — Transfer CRUD & job dispatch
- `app/Http/Controllers/YouTubeController.php` — YouTube playlist listing
- `app/Http/Controllers/DashboardController.php` — Main dashboard view
- `resources/js/app.js` — Alpine.js components (`pickerFlow`, `transferHistory`)
- `resources/views/dashboard.blade.php` — Main UI (connection cards, video grid, transfer history)

### Models

- **User** — Has many `ConnectedAccount` and `Transfer`. Has one `photosAccount` / `youtubeAccount`.
- **ConnectedAccount** — Stores OAuth tokens (`encrypted:array`). Unique on `(user_id, provider_type)`. Provider types: `photos`, `youtube`.
- **Transfer** — Tracks video transfer lifecycle. Statuses: `pending`, `processing`, `completed`, `failed`, `cancelled`.

### Transfer Flow

1. User selects videos via Google Photos Picker popup
2. Frontend polls picker session until complete, fetches media items
3. User configures title/description/privacy per video, optionally selects YouTube playlist
4. POST `/transfers` creates Transfer records and dispatches `ProcessTransferJob` per video
5. Job downloads video from Google Photos (streamed), uploads to YouTube (resumable 2MB chunks)
6. If playlist selected, adds video to playlist after upload
7. Transfer status updated throughout; frontend auto-polls for updates

## APIs

- **Google Photos Picker API** — For selecting videos (Library API readonly scopes deprecated March 2025)
- **YouTube Data API v3** — For uploading videos and managing playlists
- **Google OAuth2** — Via `google/apiclient` (separate scopes for Photos and YouTube)

## API Documentation

Reference docs in `.claude/docs/` before making any API-related changes or debugging API issues. These contain the authoritative endpoint URLs, parameters, and response formats.

- `.claude/docs/google-photos-picker-api/` — Google Photos Picker API (sessions, mediaItems)
- `.claude/docs/youtube-data-api/` — YouTube Data API v3 (videos, channels, playlists, playlistItems, search, captions, thumbnails, resumable uploads)

## Environment Variables

```
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback
```

## Project Plan

Always refer to `.claude/PLAN.md` for the implementation roadmap, current progress, and next steps. Check which phases/steps are completed (~~strikethrough~~) and which are pending before starting any work.
