# YouTube Videos: update

Updates a video's metadata.

## HTTP Request

```
PUT https://www.googleapis.com/youtube/v3/videos
```

## Authorization Scopes

- `https://www.googleapis.com/auth/youtubepartner`
- `https://www.googleapis.com/auth/youtube`
- `https://www.googleapis.com/auth/youtube.force-ssl`

## Parameters

### Required

| Parameter | Type | Description |
|-----------|------|-------------|
| `part` | string | Video resource properties to set and return. Values: `contentDetails`, `fileDetails`, `id`, `liveStreamingDetails`, `localizations`, `paidProductPlacementDetails`, `player`, `processingDetails`, `recordingDetails`, `snippet`, `statistics`, `status`, `suggestions`, `topicDetails` |

### Optional

| Parameter | Type | Description |
|-----------|------|-------------|
| `onBehalfOfContentOwner` | string | CMS user acting for content owner |

## Request Body

**Required fields:**
- `id` — Video ID
- `snippet.title` — Video title
- `snippet.categoryId` — Category ID

**Modifiable fields:**
- `snippet.description`
- `snippet.tags[]`
- `snippet.defaultLanguage`
- `status.embeddable`
- `status.license`
- `status.privacyStatus`
- `status.publicStatsViewable`
- `status.publishAt`
- `status.selfDeclaredMadeForKids`
- `status.containsSyntheticMedia`
- `recordingDetails.recordingDate`
- `localizations.(key).title`
- `localizations.(key).description`

## Response

Returns the updated video resource.

## Quota Cost

**50 units** per API call.