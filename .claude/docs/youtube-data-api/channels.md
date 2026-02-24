# YouTube Channels Resource

## Overview

The Channels resource provides information about YouTube channels, including metadata, content details, statistics, and branding settings.

## Methods

| Method | HTTP Request | Description | Quota Cost |
|--------|-------------|-------------|------------|
| **list** | `GET /youtube/v3/channels` | Returns channels matching request criteria | 1 unit |
| **update** | `PUT /youtube/v3/channels` | Modifies channel metadata (brandingSettings, invideoPromotion) | 50 units |

## Resource Properties

### Core

- **kind** (string): Always `youtube#channel`
- **etag** (etag): Resource entity tag
- **id** (string): Unique channel identifier

### snippet

- **title** (string): Channel title
- **description** (string): Channel description (max 1000 characters)
- **customUrl** (string): Channel's custom URL
- **publishedAt** (datetime): Creation date in ISO 8601 format
- **defaultLanguage** (string): Language of title and description
- **country** (string): Associated country
- **thumbnails** (object): Thumbnail images (default 88x88, medium 240x240, high 800x800)
- **localized.title** (string): Localized channel title
- **localized.description** (string): Localized channel description

### contentDetails

- **relatedPlaylists.likes** (string): Playlist ID containing liked videos
- **relatedPlaylists.uploads** (string): Playlist ID containing uploaded videos
- **relatedPlaylists.favorites** (string): *(Deprecated)* Playlist ID for favorites

### statistics

- **viewCount** (unsigned long): Total views across all channel videos
- **subscriberCount** (unsigned long): Subscriber count (rounded to 3 significant figures)
- **hiddenSubscriberCount** (boolean): Whether subscriber count is hidden
- **videoCount** (unsigned long): Number of public videos uploaded

### status

- **privacyStatus** (string): `private`, `public`, or `unlisted`
- **isLinked** (boolean): Whether linked to YouTube username or Google+
- **longUploadsStatus** (string): Upload eligibility for videos >15 minutes
- **madeForKids** (boolean): Child-directed channel designation
- **selfDeclaredMadeForKids** (boolean): Owner's self-declared "made for kids" status

### brandingSettings.channel

- **title** (string): Channel title (max 30 characters)
- **description** (string): Channel description (max 1000 characters)
- **keywords** (string): Space-separated keywords (max 500 characters total)
- **trackingAnalyticsAccountId** (string): Google Analytics account ID
- **unsubscribedTrailer** (string): Video ID for unsubscribed viewers
- **defaultLanguage** (string): Metadata language
- **country** (string): Associated country

### topicDetails

- **topicCategories[]** (list): Wikipedia URLs describing channel content

### auditDetails

- **overallGoodStanding** (boolean): AND of community, copyright, and claims standing
- **communityGuidelinesGoodStanding** (boolean): Respects community guidelines
- **copyrightStrikesGoodStanding** (boolean): No copyright strikes
- **contentIdClaimsGoodStanding** (boolean): No unresolved claims

### contentOwnerDetails

- **contentOwner** (string): Linked content owner ID
- **timeLinked** (datetime): Linking date in ISO 8601 format