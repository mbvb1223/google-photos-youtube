# Method: mediaItems.list

> Source: https://developers.google.com/photos/picker/reference/rest/v1/mediaItems/list

## Overview

Retrieves media items selected by a user during a Photos Picker session. Supports pagination for handling large result sets.

## HTTP Request

```
GET https://photospicker.googleapis.com/v1/mediaItems
```

## Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `sessionId` | string | Yes | The Google-generated identifier for this session. |
| `pageSize` | integer | No | Maximum media items to return (default: 50, max: 100). Negative values trigger an `INVALID_ARGUMENT` error. |
| `pageToken` | string | No | Token from previous call for pagination. |

## Request Body

The request body must be empty.

## Response Body

```json
{
  "mediaItems": [
    {
      object (PickedMediaItem)
    }
  ],
  "nextPageToken": string
}
```

| Field | Type | Description |
|-------|------|-------------|
| `mediaItems[]` | object ([`PickedMediaItem`](mediaItems.md#resource-pickedmediaitem)) | A page of picked media items. |
| `nextPageToken` | string | Token for retrieving subsequent pages; omitted if no additional pages exist. |

## Authorization

Required OAuth scope:

```
https://www.googleapis.com/auth/photospicker.mediaitems.readonly
```

## Error Handling

- **`FAILED_PRECONDITION`**: The user hasn't finished selecting items. Applications should poll `sessions.get` until `mediaItemsSet` is `true` before retrying.

## Notes

- The service may return fewer items than requested, including zero results with a valid `nextPageToken`.
