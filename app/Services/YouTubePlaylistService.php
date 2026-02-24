<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ConnectedAccount;
use Google\Service\YouTube;
use Google\Service\YouTube\PlaylistItem;
use Google\Service\YouTube\PlaylistItemSnippet;
use Google\Service\YouTube\ResourceId;

class YouTubePlaylistService
{
    public function __construct(
        private GoogleAuthService $authService,
    ) {}

    public function getPlaylists(ConnectedAccount $account): array
    {
        $client = $this->authService->getClient($account);
        $youtube = new YouTube($client);

        $response = $youtube->playlists->listPlaylists('snippet', [
            'mine' => true,
            'maxResults' => 50,
        ]);

        $playlists = [];

        foreach ($response->getItems() as $playlist) {
            $playlists[] = [
                'id' => $playlist->getId(),
                'title' => $playlist->getSnippet()->getTitle(),
            ];
        }

        return $playlists;
    }

    public function addVideoToPlaylist(ConnectedAccount $account, string $playlistId, string $videoId): void
    {
        $client = $this->authService->getClient($account);
        $youtube = new YouTube($client);

        $resourceId = new ResourceId;
        $resourceId->setKind('youtube#video');
        $resourceId->setVideoId($videoId);

        $snippet = new PlaylistItemSnippet;
        $snippet->setPlaylistId($playlistId);
        $snippet->setResourceId($resourceId);

        $playlistItem = new PlaylistItem;
        $playlistItem->setSnippet($snippet);

        $youtube->playlistItems->insert('snippet', $playlistItem);
    }
}
