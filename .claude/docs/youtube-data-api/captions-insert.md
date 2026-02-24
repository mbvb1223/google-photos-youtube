# YouTube Captions: insert

Uploads a caption track.

## HTTP Request

```
POST https://www.googleapis.com/upload/youtube/v3/captions
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtube.force-ssl`
- `https://www.googleapis.com/auth/youtubepartner`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Set to `snippet` |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |
| `sync` | boolean | *(Deprecated)* Auto-synchronize captions with audio |

## Request Body

**Required:**
- `snippet.videoId` — Target video ID
- `snippet.language` — BCP-47 language tag
- `snippet.name` — Display name (max 150 characters)

**Optional:**
- `snippet.isDraft` — Draft status

### File Upload

- **Maximum size:** 100 MB
- **Accepted MIME types:** `text/xml`, `application/octet-stream`, `*/*`

## Response

Returns a caption resource on success.

## Quota Cost

**400 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `contentRequired` | Missing caption track contents |
| 400 | `nameTooLong` | Caption name exceeds 150 characters |
| 403 | `forbidden` | Insufficient permissions |
| 404 | `videoNotFound` | Video not found |
| 409 | `captionExists` | Video already has caption with matching language and name |
