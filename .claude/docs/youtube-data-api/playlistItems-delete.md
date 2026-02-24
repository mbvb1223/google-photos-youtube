# YouTube PlaylistItems: delete

Deletes a playlist item.

## HTTP Request

```
DELETE https://www.googleapis.com/youtube/v3/playlistItems
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | string | YouTube playlist item ID to delete |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |

## Request Body

None required.

## Response

**Success:** HTTP `204 No Content`.

## Quota Cost

**50 units** per API call.

## Errors

| Code | Error | Description |
|------|-------|-------------|
| 400 | `playlistOperationUnsupported` | Cannot delete from this playlist type (e.g., uploads) |
| 403 | `playlistItemsNotAccessible` | Insufficient authorization |
| 404 | `playlistItemNotFound` | Item not found |
