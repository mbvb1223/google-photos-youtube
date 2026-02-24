# YouTube Playlists Resource

## Overview

A playlist resource represents a YouTube collection of videos that can be viewed sequentially and shared. Playlists are typically public by default but can be private or unlisted. YouTube also uses playlists to identify special collections like uploaded or liked videos.

## Methods

| Method | HTTP Request | Description | Quota Cost |
|--------|-------------|-------------|------------|
| **list** | `GET /youtube/v3/playlists` | Retrieves playlists matching request parameters | 1 unit |
| **insert** | `POST /youtube/v3/playlists` | Creates a new playlist | 50 units |
| **update** | `PUT /youtube/v3/playlists` | Modifies playlist properties | 50 units |
| **delete** | `DELETE /youtube/v3/playlists` | Removes a playlist | 50 units |

## Resource Properties

### Core

- **kind** (string): Always `youtube#playlist`
- **etag** (etag): Resource version identifier
- **id** (string): Unique YouTube playlist identifier

### snippet

- **publishedAt** (datetime): Creation date in ISO 8601 format
- **channelId** (string): Channel ID that published the playlist
- **title** (string): Playlist title
- **description** (string): Playlist description
- **channelTitle** (string): Title of the publishing channel
- **defaultLanguage** (string): Language of title and description
- **localized.title** (string): Localized playlist title
- **localized.description** (string): Localized playlist description
- **thumbnails** (object): Map of thumbnail images (default, medium, high, standard, maxres)

### status

- **privacyStatus** (string): `private`, `public`, or `unlisted`
- **podcastStatus** (string): `enabled`, `disabled`, or `unspecified`

### contentDetails

- **itemCount** (unsigned integer): Number of videos in the playlist

### player

- **embedHtml** (string): HTML iframe tag for embedded player

### localizations

- **localizations.(key).title** (string): Localized title by BCP-47 language code
- **localizations.(key).description** (string): Localized description by language code