# YouTube Resumable Upload Protocol

Resumable uploads allow for uploads to be paused and resumed, improving reliability for large files or unstable connections.

## Step 1: Initiate a Resumable Session

```http
POST /upload/youtube/v3/videos?uploadType=resumable&part=snippet,status HTTP/1.1
Host: www.googleapis.com
Authorization: Bearer AUTH_TOKEN
Content-Length: [metadata_size]
Content-Type: application/json; charset=UTF-8
X-Upload-Content-Length: [file_size]
X-Upload-Content-Type: video/*
```

**Required Headers:**
- `Authorization` — OAuth token
- `X-Upload-Content-Length` — Total file size in bytes
- `X-Upload-Content-Type` — Video MIME type or `application/octet-stream`
- `Content-Type` — Must be `application/json; charset=UTF-8`

**Request Body:** Video resource JSON with metadata (title, description, tags, category, privacy).

## Step 2: Capture the Session URI

Response:
```http
HTTP/1.1 200 OK
Location: https://www.googleapis.com/upload/youtube/v3/videos?uploadType=resumable&upload_id=...
Content-Length: 0
```

Store the `Location` header URI for all subsequent requests.

## Step 3: Upload the Video File

```http
PUT UPLOAD_URL HTTP/1.1
Authorization: Bearer AUTH_TOKEN
Content-Length: [file_size]
Content-Type: video/*

[BINARY_FILE_DATA]
```

## Step 4: Handle Completion

### Success
`201 Created` response with the video resource in the body.

### Resumable Errors (retry with backoff)
- `500` Internal Server Error
- `502` Bad Gateway
- `503` Service Unavailable
- `504` Gateway Timeout

### Permanent Failure
`4xx` responses indicate permanent failure. Expired sessions return `404 Not Found`.

## Checking Upload Status

```http
PUT UPLOAD_URL HTTP/1.1
Authorization: Bearer AUTH_TOKEN
Content-Length: 0
Content-Range: bytes */[file_size]
```

Response if incomplete:
```http
HTTP/1.1 308 Resume Incomplete
Content-Length: 0
Range: bytes=0-999999
```

The `Range` header indicates bytes successfully uploaded (zero-indexed).

## Resuming an Interrupted Upload

```http
PUT UPLOAD_URL HTTP/1.1
Authorization: Bearer AUTH_TOKEN
Content-Length: [remaining_bytes]
Content-Range: bytes [FIRST_BYTE]-[LAST_BYTE]/[TOTAL_SIZE]

[PARTIAL_BINARY_FILE_DATA]
```

`FIRST_BYTE` must equal the previous `Range` header's last byte + 1.

## Chunked Uploads

For progress tracking on unstable networks, break files into segments:

**Chunk Requirements:**
- Must be a multiple of **256 KB** (except the final chunk)
- Consistent size across all chunks except the last

```http
PUT UPLOAD_URL HTTP/1.1
Authorization: Bearer AUTH_TOKEN
Content-Length: 524288
Content-Type: video/*
Content-Range: bytes 0-524287/2000000

[bytes 0-524287]
```

Non-final chunks receive `308 Resume Incomplete`. Final chunk returns `201 Created`.

## Best Practices

- Use **exponential backoff** when retrying after `5xx` errors
- Session URIs have finite lifespans — initiate uploads immediately
- Resume interruptions promptly to avoid session expiration
- Larger chunks are more efficient than small ones
- Validate continuous byte sequences to prevent upload failures
