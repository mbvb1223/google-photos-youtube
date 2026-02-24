# REST Resource: mediaItems

> Source: https://developers.google.com/photos/picker/reference/rest/v1/mediaItems

## Overview

The mediaItems resource represents photos and videos selected by users through the Google Photos Picker API. It contains metadata about picked media including dimensions, camera information, and type-specific details.

## Resource: PickedMediaItem

Represents a photo or video selected by the user.

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Persistent identifier usable across sessions. |
| `createTime` | string (Timestamp) | Creation time in RFC 3339 format. |
| `type` | enum ([`Type`](#type-enum)) | Media type classification (`PHOTO` or `VIDEO`). |
| `mediaFile` | object ([`MediaFile`](#mediafile)) | Contains actual media file information. |

## MediaFile

Holds details about the actual media content.

| Field | Type | Description |
|-------|------|-------------|
| `baseUrl` | string | URL for fetching media bytes; requires additional parameters for dimensions. |
| `mimeType` | string | File format (e.g., `image/jpeg`). |
| `filename` | string | Original filename. |
| `mediaFileMetadata` | object ([`MediaFileMetadata`](#mediafilemetadata)) | Structural and camera metadata. |

## MediaFileMetadata

Technical information about the media file.

| Field | Type | Description |
|-------|------|-------------|
| `width` | integer | Original pixel width. |
| `height` | integer | Original pixel height. |
| `cameraMake` | string | Camera brand. |
| `cameraModel` | string | Camera model. |
| Union field `metadata` | | Either `photoMetadata` or `videoMetadata` (mutually exclusive). |

## PhotoMetadata

Photography-specific technical details (all fields optional).

| Field | Type | Description |
|-------|------|-------------|
| `focalLength` | number | Lens focal length. |
| `apertureFNumber` | number | F-stop value. |
| `isoEquivalent` | integer | ISO sensitivity. |
| `exposureTime` | string (Duration) | Shutter speed. |

## VideoMetadata

Video-specific information.

| Field | Type | Description |
|-------|------|-------------|
| `fps` | number | Frame rate. |
| `processingStatus` | enum ([`VideoProcessingStatus`](#videoprocessingstatus-enum)) | Current processing state. |

## Type Enum

| Value | Description |
|-------|-------------|
| `TYPE_UNSPECIFIED` | Unspecified type. |
| `PHOTO` | Photo media. |
| `VIDEO` | Video media. |

## VideoProcessingStatus Enum

| Value | Description |
|-------|-------------|
| `UNSPECIFIED` | Status unknown. |
| `PROCESSING` | Being processed; visible but not playable. |
| `READY` | Complete and playable. |
| `FAILED` | Processing failed. |

## Methods

| Method | Description |
|--------|-------------|
| [`list`](mediaItems-list.md) | Returns media items picked during a specified session. |
