<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ConnectedAccount;
use Google\Service\YouTube;
use Google\Service\YouTube\Video;
use Google\Service\YouTube\VideoSnippet;
use Google\Service\YouTube\VideoStatus;

class YouTubeUploadService
{
    private const CHUNK_SIZE = 2 * 1024 * 1024; // 2MB

    public function __construct(
        private GoogleAuthService $authService,
    ) {}

    public function upload(
        ConnectedAccount $account,
        string $filePath,
        string $title,
        ?string $description = null,
        string $privacyStatus = 'private',
    ): string {
        $client = $this->authService->getClient($account);
        $client->setDefer(true);

        $youtube = new YouTube($client);

        $snippet = new VideoSnippet();
        $snippet->setTitle($title);
        if ($description) {
            $snippet->setDescription($description);
        }

        $status = new VideoStatus();
        $status->setPrivacyStatus($privacyStatus);

        $video = new Video();
        $video->setSnippet($snippet);
        $video->setStatus($status);

        $request = $youtube->videos->insert('snippet,status', $video);

        $client->setDefer(false);

        $media = new \Google\Http\MediaFileUpload(
            $client,
            $request,
            mime_content_type($filePath) ?: 'video/*',
            null,
            true,
            self::CHUNK_SIZE,
        );

        $media->setFileSize(filesize($filePath));

        $handle = fopen($filePath, 'rb');
        $response = false;

        while (! $response && ! feof($handle)) {
            $chunk = fread($handle, self::CHUNK_SIZE);
            $response = $media->nextChunk($chunk);
        }

        fclose($handle);

        return $response->getId();
    }
}