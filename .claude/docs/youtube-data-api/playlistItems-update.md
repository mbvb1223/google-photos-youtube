# YouTube PlaylistItems: update

Modifies a playlist item. For example, you can update the item's position in the playlist.

## HTTP Request

```
PUT https://www.googleapis.com/youtube/v3/playlistItems
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Resource properties to set and return: `contentDetails`, `id`, `snippet`, `status` |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |

## Request Body

**Required:**
- `id` — Playlist item ID
- `snippet.playlistId` — Playlist ID
- `snippet.resourceId` — Resource identifier

**Modifiable:**
- `snippet.position` — Zero-based position
- `contentDetails.note` — User note (max 280 characters)
- `contentDetails.startAt` — *(Deprecated)*
- `contentDetails.endAt` — *(Deprecated)*

## Response

Returns the updated playlistItem resource.

## Quota Cost

**50 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `invalidPlaylistItemPosition` | Position value unsupported |
| 400 | `playlistIdRequired` | Missing playlist identifier |
| 403 | `playlistItemsNotAccessible` | Insufficient authorization |
| 404 | `playlistItemNotFound` | Item doesn't exist |
