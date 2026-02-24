# YouTube PlaylistItems Resource

## Overview

A playlistItem resource represents a video or other resource included in a playlist. Each item contains details about how that resource is used within the specific playlist context.

## Methods

| Method | HTTP Request | Description | Quota Cost |
|--------|-------------|-------------|------------|
| **list** | `GET /youtube/v3/playlistItems` | Returns playlist items matching request parameters | 1 unit |
| **insert** | `POST /youtube/v3/playlistItems` | Adds a resource to a playlist | 50 units |
| **update** | `PUT /youtube/v3/playlistItems` | Modifies a playlist item (e.g., position) | 50 units |
| **delete** | `DELETE /youtube/v3/playlistItems` | Deletes a playlist item | 50 units |

## Resource Properties

### Core

- **kind** (string): Always `youtube#playlistItem`
- **etag** (etag): Resource entity tag
- **id** (string): Unique playlist item identifier

### snippet

- **publishedAt** (datetime): Date/time item was added (ISO 8601)
- **channelId** (string): ID of user that added the item
- **title** (string): Item title
- **description** (string): Item description
- **thumbnails** (object): Map of thumbnail images (default, medium, high, standard, maxres)
- **channelTitle** (string): Channel title of the playlist's channel
- **videoOwnerChannelTitle** (string): Channel title that uploaded the video
- **videoOwnerChannelId** (string): Channel ID that uploaded the video
- **playlistId** (string): ID of the playlist containing this item
- **position** (unsigned integer): Zero-based index position in the playlist
- **resourceId** (object): Identifies the included resource
- **resourceId.kind** (string): Kind/type of the referred resource
- **resourceId.videoId** (string): YouTube video ID (if kind is `youtube#video`)

### contentDetails

- **videoId** (string): YouTube video ID
- **note** (string): User-generated note (max 280 characters)
- **videoPublishedAt** (datetime): Date/time video was published (ISO 8601)
- **startAt** (string): *(Deprecated)* Start time in seconds
- **endAt** (string): *(Deprecated)* End time in seconds

### status

- **privacyStatus** (string): Privacy status of the playlist item
