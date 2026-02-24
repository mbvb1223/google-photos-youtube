# Method: sessions.delete

> Source: https://developers.google.com/photos/picker/reference/rest/v1/sessions/delete

## Overview

Removes a photo picking session from the Google Photos system.

## HTTP Request

```
DELETE https://photospicker.googleapis.com/v1/sessions/{sessionId}
```

## Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `sessionId` | string | Yes | The Google-generated identifier for the session to delete. |

## Request Body

The request body must be empty.

## Response Body

On success, returns an empty JSON object `{}`.

## Authorization

Required OAuth scope:

```
https://www.googleapis.com/auth/photospicker.mediaitems.readonly
```

## Error Handling

- **`NOT_FOUND`**: The session does not exist or is not owned by the requesting user.

## Notes

- Only deletes sessions owned by the authenticated user.
