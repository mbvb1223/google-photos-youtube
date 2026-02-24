# YouTube VideoCategories: list

Returns a list of categories that can be associated with YouTube videos.

## HTTP Request

```
GET https://www.googleapis.com/youtube/v3/videoCategories
```

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Must be set to `snippet` |

### Filter (specify exactly one)

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | Comma-separated list of video category IDs |
| `regionCode` | string | ISO 3166-1 alpha-2 country code for region-specific categories |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `hl` | string | Language for text values (default: `en_US`) |

## Response

```json
{
  "kind": "youtube#videoCategoryListResponse",
  "etag": "string",
  "items": [
    {
      "kind": "youtube#videoCategory",
      "etag": "string",
      "id": "string",
      "snippet": {
        "channelId": "string",
        "title": "string",
        "assignable": "boolean"
      }
    }
  ]
}
```

## Quota Cost

**1 unit** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 404 | `videoCategoryNotFound` | Specified category ID cannot be found |
