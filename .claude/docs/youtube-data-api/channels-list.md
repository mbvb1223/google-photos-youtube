# YouTube Channels: list

Returns a collection of zero or more channel resources matching the request criteria.

## HTTP Request

```
GET https://www.googleapis.com/youtube/v3/channels
```

## Authorization

Requests retrieving `auditDetails` require the scope:
`https://www.googleapis.com/auth/youtubepartner-channel-audit`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Comma-separated list: `auditDetails`, `brandingSettings`, `contentDetails`, `contentOwnerDetails`, `id`, `localizations`, `snippet`, `statistics`, `status`, `topicDetails` |

### Filter (specify exactly one)

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | YouTube channel ID(s) |
| `forHandle` | string | YouTube handle (with optional `@` prefix) |
| `forUsername` | string | YouTube username |
| `mine` | boolean | Return only authenticated user's channels |
| `managedByMe` | boolean | Return channels managed by content owner |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `maxResults` | unsigned int | Max items returned (0-50, default: 5) |
| `pageToken` | string | Pagination token |
| `hl` | string | Language code for localized metadata |
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |

## Response

```json
{
  "kind": "youtube#channelListResponse",
  "etag": "string",
  "nextPageToken": "string",
  "prevPageToken": "string",
  "pageInfo": {
    "totalResults": "integer",
    "resultsPerPage": "integer"
  },
  "items": [channel resources]
}
```

## Quota Cost

**1 unit** per API call.