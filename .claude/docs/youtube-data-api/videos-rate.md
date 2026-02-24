# YouTube Videos: rate

Adds a like or dislike rating to a video, or removes a rating.

## HTTP Request

```
POST https://www.googleapis.com/youtube/v3/videos/rate
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | YouTube video ID being rated |
| `rating` | string | Rating value: `like`, `dislike`, or `none` (removes rating) |

## Request Body

None required.

## Response

**Success:** HTTP `204 No Content`.

> Note: This does not affect the official like/dislike count of the video.

## Quota Cost

**50 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `emailNotVerified` | Email not verified |
| 400 | `invalidRating` | Invalid rating value |
| 403 | `forbidden` | Video cannot be rated or ratings disabled |
| 404 | `notFound` | Video not found |