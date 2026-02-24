# YouTube Videos Resource

## Overview

The video resource represents a YouTube video. Videos uploaded via the `videos.insert` endpoint from unverified API projects created after July 28, 2020 are restricted to private viewing until the project undergoes audit verification.

## Methods

| Method | HTTP Request | Description | Quota Cost |
|--------|-------------|-------------|------------|
| **list** | `GET /youtube/v3/videos` | Returns videos matching API request parameters | 1 unit |
| **insert** | `POST /upload/youtube/v3/videos` | Uploads a video and optionally sets metadata | 100 units |
| **update** | `PUT /youtube/v3/videos` | Updates a video's metadata | 50 units |
| **delete** | `DELETE /youtube/v3/videos` | Deletes a YouTube video | 50 units |
| **rate** | `POST /youtube/v3/videos/rate` | Adds or removes like/dislike ratings | 50 units |
| **getRating** | `GET /youtube/v3/videos/getRating` | Retrieves ratings the authorized user gave to videos | 1 unit |
| **reportAbuse** | `POST /youtube/v3/videos/reportAbuse` | Reports a video for abusive content | 50 units |

## Resource Properties

### Core Properties

- **kind** (string): Always `youtube#video`
- **etag** (etag): Resource entity tag
- **id** (string): Unique YouTube video identifier

### snippet

Contains basic video metadata:

- **publishedAt** (datetime): Publication date/time in ISO 8601 format
- **channelId** (string): Unique channel identifier
- **title** (string): Video title (max 100 characters)
- **description** (string): Video description (max 5000 bytes)
- **thumbnails** (object): Map of thumbnail images (default, medium, high, standard, maxres)
- **channelTitle** (string): Channel name
- **tags[]** (array): Keywords (max 500 characters total)
- **categoryId** (string): YouTube video category
- **liveBroadcastContent** (string): Values: `live`, `none`, `upcoming`
- **defaultLanguage** (string): Metadata language code
- **localized** (object): Localized title and description
- **defaultAudioLanguage** (string): Primary audio track language

### contentDetails

Video technical information:

- **duration** (string): Video length in ISO 8601 format (e.g., `PT15M33S`)
- **dimension** (string): `2d` or `3d`
- **definition** (string): `hd` or `sd`
- **caption** (string): Caption availability (`true`/`false`)
- **licensedContent** (boolean): Licensed content indicator
- **regionRestriction** (object): Country-level viewing restrictions
  - **allowed[]** (array): Viewable countries
  - **blocked[]** (array): Blocked countries
- **contentRating** (object): Ratings from various organizations
- **projection** (string): `360` or `rectangular`
- **hasCustomThumbnail** (boolean): Custom thumbnail indicator

### status

Upload and privacy information:

- **uploadStatus** (string): Values: `deleted`, `failed`, `processed`, `rejected`, `uploaded`
- **failureReason** (string): Upload failure explanation
- **rejectionReason** (string): Rejection explanation
- **privacyStatus** (string): `private`, `public`, `unlisted`
- **publishAt** (datetime): Scheduled publication time
- **license** (string): `creativeCommon` or `youtube`
- **embeddable** (boolean): Can be embedded elsewhere
- **publicStatsViewable** (boolean): Statistics visibility
- **madeForKids** (boolean): Child-directed designation
- **selfDeclaredMadeForKids** (boolean): Owner's kid-content declaration
- **containsSyntheticMedia** (boolean): Altered/synthetic content disclosure

### statistics

- **viewCount** (unsigned long): View count
- **likeCount** (unsigned long): Like count
- **dislikeCount** (unsigned long): Dislike count (private as of Dec 2021)
- **favoriteCount** (unsigned long): Deprecated (always 0)
- **commentCount** (unsigned long): Comment count

### Additional Objects

- **paidProductPlacementDetails**: Product placement disclosure
- **player**: Embed HTML and dimensions
- **topicDetails**: Associated topic IDs and categories
- **recordingDetails**: Recording date/location
- **fileDetails**: Uploaded file technical specs
- **processingDetails**: Video processing status
- **suggestions**: Quality and metadata improvement suggestions
- **liveStreamingDetails**: Live broadcast timing info
- **localizations**: Translated metadata by language