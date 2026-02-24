# YouTube Playlists: update

Modifies a playlist. You can change its title, description, or privacy status.

## HTTP Request

```
PUT https://www.googleapis.com/youtube/v3/playlists
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

## Request Body

**Required:**
- `id` — Playlist ID
- `snippet.title` — Playlist title

**Modifiable:**
- `snippet.description`
- `snippet.defaultLanguage`
- `status.privacyStatus`
- `status.podcastStatus`
- `localizations.(key).title`
- `localizations.(key).description`

> Note: Properties not specified will be deleted if they already exist.

## Response

Returns the updated playlist resource.

## Quota Cost

**50 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `playlistTitleRequired` | Title is mandatory |
| 400 | `invalidPlaylistSnippet` | Invalid snippet data |
| 403 | `playlistForbidden` | Insufficient permissions |
| 404 | `playlistNotFound` | Playlist doesn't exist |
