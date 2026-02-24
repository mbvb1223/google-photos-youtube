# Method: sessions.create

> Source: https://developers.google.com/photos/picker/reference/rest/v1/sessions/create

## Overview

Creates a session enabling users to select photos and videos for third-party application access. The method generates a picker interface where users can choose media from their Google Photos library.

## HTTP Request

```
POST https://photospicker.googleapis.com/v1/sessions
```

## Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `requestId` | string | No | A client-provided unique identifier for this request, used to enable the streamlined picking experience for OAuth 2.0 flow applications on limited-input devices. Must be a UUID v4 string (format: `xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx`, 32 hex characters). Cannot contain sensitive user information. |

## Request Body

The request body contains a [`PickingSession`](sessions.md#resource-pickingsession) object instance.

## Response Body

On success, returns a newly created [`PickingSession`](sessions.md#resource-pickingsession) object.

## Authorization

Required OAuth scope:

```
https://www.googleapis.com/auth/photospicker.mediaitems.readonly
```

## Error Handling

- **`FAILED_PRECONDITION`**: The user lacks an active Google Photos account.
- **`RESOURCE_EXHAUSTED`**: Excessive sessions have been created (unlikely under normal use).

## Notes

- Sessions become invalid after users complete the picking process.
- It is recommended to call `sessions.delete` after each session to maintain resource limits.
