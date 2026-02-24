# YouTube Videos: insert

Uploads a video to YouTube and optionally sets the video's metadata.

## HTTP Request

```
POST https://www.googleapis.com/upload/youtube/v3/videos
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtube.upload`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Video resource properties to set and return. Values: `snippet`, `status`, `contentDetails`, `fileDetails`, `processingDetails`, `recordingDetails`, `localizations` |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `notifySubscribers` | boolean | Send notification to subscribers (default: `true`) |
| `onBehalfOfContentOwner` | string | YouTube CMS user authorization identifier |
| `onBehalfOfContentOwnerChannel` | string | Target channel ID for content partners |

## Request Body

Provide a video resource with configurable properties:

- `snippet.title` — Video title (max 100 characters)
- `snippet.description` — Video description (max 5000 bytes)
- `snippet.tags[]` — Keywords (max 500 characters total)
- `snippet.categoryId` — Video category ID
- `status.privacyStatus` — `private`, `public`, or `unlisted`
- `status.publishAt` — Scheduled publication time
- `status.embeddable` — Allow embedding
- `status.selfDeclaredMadeForKids` — Child-directed content
- `status.containsSyntheticMedia` — Synthetic media disclosure
- `recordingDetails.recordingDate` — Recording date
- `localizations.(key).title` — Localized title
- `localizations.(key).description` — Localized description

## Media Upload

- **Maximum file size:** 256 GB
- **Accepted MIME types:** `video/*`, `application/octet-stream`

## Response

Returns a complete video resource upon success.

## Quota Cost

**100 units** per API call.

## Important Notes

- Videos uploaded from unverified API projects created after July 28, 2020 are restricted to **private viewing** mode.
- Use resumable upload for large files. See [resumable-upload.md](resumable-upload.md).