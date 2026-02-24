# YouTube Playlists: insert

Creates a new playlist.

## HTTP Request

```
POST https://www.googleapis.com/youtube/v3/playlists
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Resource properties to set and return: `contentDetails`, `id`, `localizations`, `player`, `snippet`, `status` |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |
| `onBehalfOfContentOwnerChannel` | string | YouTube channel ID for partner operations |

## Request Body

**Required:**
- `snippet.title` — Playlist name

**Optional:**
- `snippet.description`
- `snippet.defaultLanguage`
- `status.privacyStatus` — `private`, `public`, or `unlisted`
- `localizations.(key).title`
- `localizations.(key).description`

## Response

Returns a playlist resource on success.

## Quota Cost

**50 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `badRequest` | Invalid snippet or missing default language |
| 400 | `required` | Playlist title required |
| 400 | `maxPlaylistExceeded` | Channel has maximum playlists |
| 403 | `forbidden` | Operation forbidden or unauthorized |
