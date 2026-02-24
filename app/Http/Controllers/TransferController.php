<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\ProcessTransferJob;
use App\Models\Transfer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $transfers = $request->user()->transfers()->latest()->get();

        return response()->json($transfers);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        if (! $user->photosAccount || ! $user->youtubeAccount) {
            return response()->json(['error' => 'Both Google Photos and YouTube accounts must be connected.'], 403);
        }

        $validated = $request->validate([
            'videos' => 'required|array|min:1',
            'videos.*.media_id' => 'required|string',
            'videos.*.base_url' => 'required|string',
            'videos.*.filename' => 'required|string',
            'videos.*.mime_type' => 'required|string',
            'videos.*.title' => 'required|string|max:100',
            'videos.*.description' => 'nullable|string|max:5000',
            'videos.*.privacy_status' => 'nullable|string|in:private,unlisted,public',
            'playlist_id' => 'nullable|string',
        ]);

        $transfers = [];

        foreach ($validated['videos'] as $video) {
            $transfer = $user->transfers()->create([
                'google_photos_media_id' => $video['media_id'],
                'google_photos_base_url' => $video['base_url'],
                'filename' => $video['filename'],
                'mime_type' => $video['mime_type'],
                'title' => $video['title'],
                'description' => $video['description'] ?? null,
                'privacy_status' => $video['privacy_status'] ?? 'private',
                'youtube_playlist_id' => $validated['playlist_id'] ?? null,
                'status' => 'pending',
            ]);

            ProcessTransferJob::dispatch($transfer);

            $transfers[] = $transfer;
        }

        return response()->json($transfers, 201);
    }

    public function show(Request $request, Transfer $transfer): JsonResponse
    {
        if ($transfer->user_id !== $request->user()->id) {
            abort(403);
        }

        return response()->json($transfer);
    }

    public function destroy(Request $request, Transfer $transfer): JsonResponse
    {
        if ($transfer->user_id !== $request->user()->id) {
            abort(403);
        }

        if (! $transfer->isPending()) {
            return response()->json(['error' => 'Only pending transfers can be cancelled.'], 422);
        }

        $transfer->update(['status' => 'cancelled']);

        return response()->json(['message' => 'Transfer cancelled.']);
    }
}
