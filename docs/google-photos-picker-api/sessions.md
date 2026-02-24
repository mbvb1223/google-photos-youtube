# REST Resource: sessions

> Source: https://developers.google.com/photos/picker/reference/rest/v1/sessions

## Overview

The Sessions resource represents user sessions for selecting photos and videos through Google Photos Picker API. Applications manage session lifecycle and poll for user selections.

## Resource: PickingSession

Represents a user session enabling photo and video selection via Google Photos.

### JSON Representation

```json
{
  "id": string,
  "pickerUri": string,
  "pollingConfig": {
    object (PollingConfig)
  },
  "expireTime": string,
  "pickingConfig": {
    object (PickingConfig)
  },
  "mediaItemsSet": boolean
}
```

### Fields

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Output only. The Google-generated identifier for this session. |
| `pickerUri` | string | Output only. The URI used to redirect the user to Google Photos for selection. Cannot be opened in iframes for security. Supports `/autoclose` suffix for automatic window closure. |
| `pollingConfig` | object ([`PollingConfig`](#pollingconfig)) | Output only. The recommended configuration that applications should use while polling `sessions.get`. Present only when selections aren't finalized. |
| `expireTime` | string (Timestamp) | Output only. Time when access to this session (and its picked media items) will expire. Uses RFC 3339 format. |
| `pickingConfig` | object ([`PickingConfig`](#pickingconfig)) | Optional. Photo-picking configuration for the user's picking experience during this session. Set at creation; immutable thereafter. |
| `mediaItemsSet` | boolean | Output only. If set to `true`, media items have been picked for this session. |

## PollingConfig

Configuration guidance for API polling operations.

```json
{
  "pollInterval": string,
  "timeoutIn": string
}
```

| Field | Type | Description |
|-------|------|-------------|
| `pollInterval` | string (Duration) | Output only. Recommended time between poll requests. Format: seconds with up to 9 fractional digits (e.g., `"3.5s"`). |
| `timeoutIn` | string (Duration) | Output only. The length of time after which the client should stop polling. Zero indicates immediate cessation. |

## PickingConfig

Client-specified configuration for user selection experience.

```json
{
  "maxItemCount": string
}
```

| Field | Type | Description |
|-------|------|-------------|
| `maxItemCount` | string (int64) | Optional. The maximum number of items that the user can pick during this session. Defaults to 2000 if not specified. Values exceeding 2000 are coerced to 2000; negative values trigger `INVALID_ARGUMENT` error. |

## Methods

| Method | Description |
|--------|-------------|
| [`create`](sessions-create.md) | Generates a new session for photo/video selection. |
| [`delete`](sessions-delete.md) | Removes a specified session. |
| [`get`](sessions-get.md) | Retrieves session information. |
