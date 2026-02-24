# YouTube Captions: list

Returns a list of caption tracks associated with a specified video.

## HTTP Request

```
GET https://www.googleapis.com/youtube/v3/captions
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtube.force-ssl`
- `https://www.googleapis.com/auth/youtubepartner`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Resource parts to include: `id`, `snippet` |
| `videoId` | string | YouTube video ID whose captions to retrieve |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | Comma-separated IDs of specific caption tracks |
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |

## Request Body

None required.

## Response

```json
{
  "kind": "youtube#captionListResponse",
  "etag": "etag_value",
  "items": [caption resources]
}
```

> Note: The response excludes actual caption text. Use `captions.download` for full content.

## Quota Cost

**50 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 403 | `forbidden` | Insufficient permissions |
| 404 | `notFound` | Caption track(s) or video not found |
