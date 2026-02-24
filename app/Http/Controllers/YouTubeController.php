<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\YouTubePlaylistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class YouTubeController extends Controller
{
    public function playlists(Request $request, YouTubePlaylistService $playlistService): JsonResponse
    {
        $youtubeAccount = $request->user()->youtubeAccount;

        if (! $youtubeAccount) {
            return response()->json(['error' => 'YouTube account not connected.'], 403);
        }

        $playlists = $playlistService->getPlaylists($youtubeAccount);

        return response()->json($playlists);
    }
}
