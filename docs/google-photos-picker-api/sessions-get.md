# Method: sessions.get

> Source: https://developers.google.com/photos/picker/reference/rest/v1/sessions/get

## Overview

Retrieves information about a specified photo picking session using its unique identifier.

## HTTP Request

```
GET https://photospicker.googleapis.com/v1/sessions/{sessionId}
```

## Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `sessionId` | string | Yes | The Google-generated identifier for this session. |

## Request Body

The request body must be empty.

## Response Body

On success, returns a [`PickingSession`](sessions.md#resource-pickingsession) instance.

## Authorization

Required OAuth scope:

```
https://www.googleapis.com/auth/photospicker.mediaitems.readonly
```

## Error Handling

- **`NOT_FOUND`**: The specified session does not exist or is not owned by the user.
- **`PERMISSION_DENIED`**: The session exists but access has expired.
