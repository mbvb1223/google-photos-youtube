# YouTube PlaylistItems: insert

Adds a resource to a playlist.

## HTTP Request

```
POST https://www.googleapis.com/youtube/v3/playlistItems
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
- `snippet.playlistId` — Target playlist ID
- `snippet.resourceId` — Resource to add (includes `kind` and `videoId`)

**Optional:**
- `snippet.position` — Zero-based position in playlist
- `contentDetails.note` — User note (max 280 characters)
- `contentDetails.startAt` — *(Deprecated)*
- `contentDetails.endAt` — *(Deprecated)*

## Response

Returns a playlistItem resource on success.

## Quota Cost

**50 units** per API call.
