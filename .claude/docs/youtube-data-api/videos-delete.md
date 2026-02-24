# YouTube Videos: delete

Deletes a YouTube video.

## HTTP Request

```
DELETE https://www.googleapis.com/youtube/v3/videos
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | The YouTube video ID to delete |

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
| 403 | `forbidden` | Video cannot be deleted; request may lack proper authorization |
| 404 | `videoNotFound` | Video specified in the `id` parameter cannot be located |