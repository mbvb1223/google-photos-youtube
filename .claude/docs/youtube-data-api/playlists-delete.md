# YouTube Playlists: delete

Deletes a playlist.

## HTTP Request

```
DELETE https://www.googleapis.com/youtube/v3/playlists
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | YouTube playlist ID to delete |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |

## Request Body

None required.

## Response

**Success:** HTTP `204 No Content`.

## Quota Cost

**50 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `playlistOperationUnsupported` | Cannot delete certain playlists (e.g., uploaded videos) |
| 403 | `playlistForbidden` | Insufficient authorization |
| 404 | `playlistNotFound` | Playlist not found |
