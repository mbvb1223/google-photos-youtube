# YouTube Videos: list

Returns a list of videos that match the API request parameters.

## HTTP Request

```
GET https://www.googleapis.com/youtube/v3/videos
```

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Comma-separated list of resource properties: `contentDetails`, `id`, `snippet`, `statistics`, `status`, etc. |

### Filter (specify exactly one)

| Parameter | Type | Description |
|-----------|------|-------------|
| `chart` | string | `mostPopular` — returns most popular videos for region/category |
| `id` | string | Comma-separated YouTube video IDs |
| `myRating` | string | `like` or `dislike` — requires authorization |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `hl` | string | Language code for localized metadata |
| `maxHeight` | unsigned int | Embedded player height (72–8192 pixels) |
| `maxResults` | unsigned int | Items per page (1–50; default: 5) |
| `maxWidth` | unsigned int | Embedded player width (72–8192 pixels) |
| `pageToken` | string | Pagination token |
| `regionCode` | string | ISO 3166-1 alpha-2 country code |
| `videoCategoryId` | string | Video category filter (default: 0) |

## Response

```json
{
  "kind": "youtube#videoListResponse",
  "etag": "etag_value",
  "nextPageToken": "string",
  "prevPageToken": "string",
  "pageInfo": {
    "totalResults": "integer",
    "resultsPerPage": "integer"
  },
  "items": [video resources]
}
```

## Quota Cost

**1 unit** per API call.

## Common Errors

| Code | Error | Cause |
|------|-------|-------|
| 400 | `videoChartNotFound` | Requested chart unsupported or unavailable |
| 403 | `forbidden` | Insufficient authorization for file/processing details |
| 404 | `videoNotFound` | Video ID invalid or doesn't exist |