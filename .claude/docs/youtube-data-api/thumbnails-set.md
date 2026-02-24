# YouTube Thumbnails: set

Uploads a custom video thumbnail to YouTube and sets it for a video.

## HTTP Request

```
POST https://www.googleapis.com/upload/youtube/v3/thumbnails/set
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube.upload`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `videoId` | string | YouTube video ID for which to set the thumbnail |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |

## Request Body

Contains the thumbnail image (not a thumbnail resource object).

### File Constraints

- **Maximum size:** 2 MB
- **Accepted MIME types:** `image/jpeg`, `image/png`, `application/octet-stream`

## Response

```json
{
  "kind": "youtube#thumbnailSetResponse",
  "etag": "etag",
  "items": [thumbnail resources]
}
```

## Quota Cost

**~50 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `invalidImage` | Provided image content is invalid |
| 400 | `mediaBodyRequired` | Request missing image content |
| 403 | `forbidden` | Cannot set thumbnail or lacks permissions |
| 404 | `videoNotFound` | Video cannot be found |
| 429 | `uploadRateLimitExceeded` | Too many recent uploads |
