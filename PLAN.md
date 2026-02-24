# Google Photos → YouTube Transfer Tool

## Context

Build a Laravel 12 web app that lets users download videos from **one Google account's Photos** and upload them to **a different Google account's YouTube**. Two separate OAuth flows are needed — one for the Google Photos source and one for the YouTube destination.

**Critical API note:** Google Photos Library API deprecated `photoslibrary.readonly` on March 31, 2025. We must use the **Google Photos Picker API** instead — it provides a redirect-based UI where users select media, then our backend polls for results and downloads the selected videos.

## Packages to Install

```bash
composer require laravel/socialite google/apiclient
```

## Architecture: Dual-Account OAuth

The app login uses a simple Google sign-in (basic profile). Then the user connects two **separate** Google accounts from the dashboard:

1. **Connect Google Photos** — OAuth with scope `photospicker.mediaitems.readonly` (can be a different Google account)
2. **Connect YouTube** — OAuth with scope `youtube.upload` (can be a different Google account)

This is stored in a `connected_accounts` table:

| id | user_id | provider | provider_type | google_id | email | name | token (encrypted) | created_at | updated_at |
|----|---------|----------|---------------|-----------|-------|------|--------------------|------------|------------|

- `provider`: always `google` for now
- `provider_type`: `photos` or `youtube`
- `token`: encrypted JSON `{ access_token, refresh_token, expires_at }`
- Unique constraint on `(user_id, provider_type)`

## Implementation Steps

### Phase 1: Foundation

1. **Install packages** — `composer require laravel/socialite google/apiclient`
2. **Environment variables** — Add `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI` to `.env` and `.env.example`
3. **Config** — Add `google` key to `config/services.php`; increase `retry_after` to 3600 in `config/queue.php`
4. **Migration: users** — Add `google_id` (string, nullable, unique) column; make `password` nullable
5. **Migration: connected_accounts** — Create `connected_accounts` table: `id`, `user_id` (FK), `provider`, `provider_type`, `google_id`, `email`, `name`, `token` (text), unique on `(user_id, provider_type)`
6. **Migration: transfers** — Create `transfers` table: `user_id`, `google_photos_media_id`, `google_photos_base_url`, `filename`, `mime_type`, `title`, `description`, `privacy_status`, `status`, `youtube_video_id`, `error_message`, `file_size`, `started_at`, `completed_at`
7. **Update `app/Models/User.php`** — Add `google_id` to fillable, `connectedAccounts()` / `transfers()` relationships, helper methods `photosAccount()` and `youtubeAccount()`
8. **Create `app/Models/ConnectedAccount.php`** — Fillable fields, `encrypted:array` cast for `token`, `user()` relationship, token helper methods
9. **Create `app/Models/Transfer.php`** — Fillable fields, casts, `user()` relationship, status helper methods

### Phase 2: Authentication

10. **Create `app/Http/Controllers/Auth/GoogleController.php`** — Three OAuth flows:
    - **Login** (`/auth/google`) — Basic profile scope, creates/updates user, logs in
    - **Connect Photos** (`/auth/google/photos`) — Scope `photospicker.mediaitems.readonly`, offline access, forced consent. Callback stores token in `connected_accounts` with `provider_type=photos`
    - **Connect YouTube** (`/auth/google/youtube`) — Scope `youtube.upload`, offline access, forced consent. Callback stores token in `connected_accounts` with `provider_type=youtube`
    - Uses session state (`session()->put('google_auth_type', 'photos')`) to distinguish callbacks
11. **Routes** — Auth routes: `/auth/google`, `/auth/google/photos`, `/auth/google/youtube`, `/auth/google/callback`, `/auth/logout`

### Phase 3: Services

12. **Create `app/Services/GoogleAuthService.php`** — Configure `Google\Client` from a `ConnectedAccount`'s token, handle token refresh, persist refreshed tokens
13. **Create `app/Services/GooglePhotosPickerService.php`** — HTTP calls to `photospicker.googleapis.com/v1` using the user's **Photos** connected account token. Session CRUD, media item listing, video download (baseUrl + `=dv`, streamed to disk)
14. **Create `app/Services/YouTubeUploadService.php`** — Resumable chunked upload (2MB chunks) via `google/apiclient` using the user's **YouTube** connected account token. `videos.insert()` with snippet + status metadata

### Phase 4: Controllers & Job

15. **Create `app/Http/Controllers/PickerSessionController.php`** — Backend proxy for Picker API (create session, poll session, list media items). Requires Photos account connected.
16. **Create `app/Http/Controllers/TransferController.php`** — CRUD: list user transfers, create transfers from selected videos (dispatches job per transfer), cancel pending transfers. Requires both accounts connected.
17. **Create `app/Http/Controllers/DashboardController.php`** — Returns dashboard view with connected account status
18. **Create `app/Jobs/ProcessTransferJob.php`** — Downloads video using Photos account token → uploads to YouTube using YouTube account token → updates transfer status → cleans up temp file. 1hr timeout, 2 tries.
19. **Add all authenticated routes** — Picker proxy routes + transfer CRUD routes

### Phase 5: Frontend

20. **Create `resources/views/layouts/app.blade.php`** — Minimal layout with Vite assets, nav bar, CSRF meta tag
21. **Replace `resources/views/welcome.blade.php`** — Landing page with "Sign in with Google" button
22. **Create `resources/views/dashboard.blade.php`** — Main dashboard with:
    - **Account connections section** — "Connect Google Photos" and "Connect YouTube" buttons, showing connected account email when linked (with disconnect option)
    - **Video selection area** — "Select Videos" button (disabled until Photos account connected)
    - **Transfer config form** — Title, description, privacy per video (disabled until YouTube account connected)
    - **Transfer history table** — Status, progress, YouTube links
23. **Update `resources/js/app.js`** — Picker popup flow + transfer status polling

### Phase 6: Tests

24. **Feature tests** — Auth flows (login, connect photos, connect youtube), picker session endpoints, transfer CRUD + authorization
25. **Unit tests** — GoogleAuthService token refresh, services, ProcessTransferJob status transitions + cleanup

## File Summary

**Modified:**
- `.env` / `.env.example` — Google credentials
- `config/services.php` — Google config
- `config/queue.php` — Increase retry_after
- `app/Models/User.php` — Google fields + relationships
- `resources/views/welcome.blade.php` — Landing page
- `resources/js/app.js` — Picker flow
- `routes/web.php` — All routes

**New:**
- `database/migrations/*_add_google_id_to_users_table.php`
- `database/migrations/*_create_connected_accounts_table.php`
- `database/migrations/*_create_transfers_table.php`
- `app/Models/ConnectedAccount.php`
- `app/Models/Transfer.php`
- `app/Services/GoogleAuthService.php`
- `app/Services/GooglePhotosPickerService.php`
- `app/Services/YouTubeUploadService.php`
- `app/Http/Controllers/Auth/GoogleController.php`
- `app/Http/Controllers/DashboardController.php`
- `app/Http/Controllers/PickerSessionController.php`
- `app/Http/Controllers/TransferController.php`
- `app/Jobs/ProcessTransferJob.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/dashboard.blade.php`
- `tests/Feature/Auth/GoogleAuthTest.php`
- `tests/Feature/TransferTest.php`

## Key Design Decisions

- **Dual-account OAuth** — Separate connected accounts for Photos and YouTube, allowing different Google accounts for source and destination.
- **`connected_accounts` table** — Polymorphic-style table with `provider_type` to cleanly separate Photos vs YouTube tokens. Extensible for future providers.
- **Picker API over Library API** — Library API readonly scopes removed March 2025. Picker API uses a popup redirect.
- **Encrypted token storage** — `token` column uses Laravel's `encrypted:array` cast.
- **Streamed download + chunked upload** — No memory bloat for large videos.
- **Queue jobs** — Each transfer is a separate job with 1hr timeout and 2 retries.
- **Base URL expiration** — Picker API base URLs expire in 60 minutes; jobs should process promptly.

## Verification

1. `php artisan migrate` — Migrations run cleanly
2. `composer dev` — App starts (server + queue + vite)
3. Visit `/` → "Sign in with Google" → logs in with Google account A
4. Dashboard shows "Connect Google Photos" and "Connect YouTube" buttons
5. "Connect Google Photos" → OAuth with account B → shows connected email
6. "Connect YouTube" → OAuth with account C → shows connected email
7. "Select Videos" → popup → select videos → popup closes → videos listed
8. Configure title/privacy → submit → queue processes → video appears on YouTube account C
9. `php artisan test` — All tests pass