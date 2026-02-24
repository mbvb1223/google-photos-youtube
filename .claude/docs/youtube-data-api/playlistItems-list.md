# YouTube PlaylistItems: list

Returns a collection of playlist items that match the API request parameters.

## HTTP Request

```
GET https://www.googleapis.com/youtube/v3/playlistItems
```

## Authorization

Requires OAuth 2.0 scope: `https://www.googleapis.com/auth/youtube.readonly`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Comma-separated list: `contentDetails`, `id`, `snippet`, `status` |

### Filter (specify exactly one)

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | Comma-separated playlist item IDs |
| `playlistId` | string | Unique ID of the playlist |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `maxResults` | unsigned int | Max items returned (0-50, default: 5) |
| `pageToken` | string | Pagination token |
| `videoId` | string | Filter by video ID |
| `onBehalfOfContentOwner` | string | For YouTube partners |

## Response

```json
{
  "kind": "youtube#playlistItemListResponse",
  "etag": "string",
  "nextPageToken": "string",
  "prevPageToken": "string",
  "pageInfo": {
    "totalResults": "integer",
    "resultsPerPage": "integer"
  },
  "items": [playlistItem resources]
}
```

## Quota Cost

**1 unit** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `playlistIdRequired` | Missing required parameter |
| 403 | `playlistItemsNotAccessible` | Insufficient authorization |
| 403 | `watchHistoryNotAccessible` | Watch history unavailable via API |
| 403 | `watchLaterNotAccessible` | Watch later items restricted |
| 404 | `playlistNotFound` | Playlist ID invalid |
