# YouTube Captions Resource

## Overview

A caption resource represents a YouTube caption track associated with exactly one video.

## Methods

| Method | HTTP Request | Description | Quota Cost |
|--------|-------------|-------------|------------|
| **list** | `GET /youtube/v3/captions` | Retrieve caption tracks for a video | 50 units |
| **insert** | `POST /upload/youtube/v3/captions` | Upload a new caption track | 400 units |
| **update** | `PUT /upload/youtube/v3/captions` | Modify draft status or upload replacement | 450 units |
| **download** | `GET /youtube/v3/captions/{id}` | Retrieve caption track content | 200 units |
| **delete** | `DELETE /youtube/v3/captions` | Remove a caption track | 50 units |

> Note: The `sync` parameter was deprecated on March 13, 2024. Auto-syncing remains available in YouTube Creator Studio.

## Resource Properties

### Core

- **kind** (string): Always `youtube#caption`
- **etag** (etag): Resource entity tag
- **id** (string): Unique caption track identifier

### snippet

- **videoId** (string): Associated video identifier
- **lastUpdated** (datetime): Last modification timestamp (ISO 8601)
- **trackKind** (string): Type: `ASR`, `forced`, or `standard`
- **language** (string): BCP-47 language tag
- **name** (string): Display name (max 150 characters)
- **audioTrackType** (string): Audio type: `primary`, `commentary`, `descriptive`, `unknown`
- **isCC** (boolean): Closed captioning for deaf/hard of hearing
- **isLarge** (boolean): Large text for vision-impaired users
- **isEasyReader** (boolean): Third-grade reading level formatting
- **isDraft** (boolean): Draft status (not publicly visible if true)
- **isAutoSynced** (boolean): YouTube audio synchronization applied
- **status** (string): Status: `serving`, `syncing`, or `failed`
- **failureReason** (string): Failure reason: `processingFailed`, `unknownFormat`, `unsupportedFormat`
