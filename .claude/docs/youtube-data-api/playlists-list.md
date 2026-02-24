# YouTube Playlists: list

Returns a collection of playlists that match the API request parameters.

## HTTP Request

```
GET https://www.googleapis.com/youtube/v3/playlists
```

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Comma-separated list: `contentDetails`, `id`, `localizations`, `player`, `snippet`, `status` |

### Filter (specify exactly one)

| Parameter | Type | Description |
|-----------|------|-------------|
| `channelId` | string | Returns only the specified channel's playlists |
| `id` | string | Comma-separated YouTube playlist IDs |
| `mine` | boolean | Returns playlists owned by the authenticated user (requires auth) |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `hl` | string | Language code for localized metadata |
| `maxResults` | unsigned int | Max items returned (0-50, default: 5) |
| `pageToken` | string | Pagination token |
| `onBehalfOfContentOwner` | string | For YouTube content partners |
| `onBehalfOfContentOwnerChannel` | string | YouTube channel ID for partner operations |

## Response

```json
{
  "kind": "youtube#playlistListResponse",
  "etag": "etag",
  "nextPageToken": "string",
  "prevPageToken": "string",
  "pageInfo": {
    "totalResults": "integer",
    "resultsPerPage": "integer"
  },
  "items": [playlist resources]
}
```

## Quota Cost

**1 unit** per API call.