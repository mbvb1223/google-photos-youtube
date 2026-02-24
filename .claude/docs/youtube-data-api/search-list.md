# YouTube Search: list

Returns a collection of search results that match the query parameters.

## HTTP Request

```
GET https://www.googleapis.com/youtube/v3/search
```

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Must be set to `snippet` |

### Common Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `q` | string | Search query. Supports `-` (NOT) and `\|` (OR) operators |
| `maxResults` | unsigned int | Max items returned (0-50, default: 5) |
| `type` | string | Resource type: `video`, `channel`, `playlist` (default: all) |
| `order` | string | Sort by: `date`, `rating`, `relevance` (default), `title`, `videoCount`, `viewCount` |
| `pageToken` | string | Pagination token |
| `regionCode` | string | ISO 3166-1 alpha-2 country code |
| `relevanceLanguage` | string | ISO 639-1 language code for relevance ranking |
| `safeSearch` | string | Content filtering: `moderate` (default), `none`, `strict` |

### Video-Specific Filters (when `type=video`)

| Parameter | Type | Values |
|-----------|------|--------|
| `videoDuration` | string | `short`, `medium`, `long`, `any` |
| `videoDefinition` | string | `high`, `standard`, `any` |
| `videoCaption` | string | `closedCaption`, `none`, `any` |
| `eventType` | string | `live`, `upcoming`, `completed` |

## Response

```json
{
  "kind": "youtube#searchListResponse",
  "etag": "string",
  "nextPageToken": "string",
  "prevPageToken": "string",
  "regionCode": "string",
  "pageInfo": {
    "totalResults": "integer",
    "resultsPerPage": "integer"
  },
  "items": [
    {
      "id": { "kind": "string", "videoId": "string", "channelId": "string", "playlistId": "string" },
      "snippet": { ... }
    }
  ]
}
```

## Quota Cost

**100 units** per API call.
