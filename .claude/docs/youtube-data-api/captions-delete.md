# YouTube Captions: delete

Deletes a specified caption track.

## HTTP Request

```
DELETE https://www.googleapis.com/youtube/v3/captions
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtube.force-ssl`
- `https://www.googleapis.com/auth/youtubepartner`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | Caption track ID to delete |

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
| 403 | `forbidden` | Insufficient permissions |
| 404 | `captionNotFound` | Caption track not found |
