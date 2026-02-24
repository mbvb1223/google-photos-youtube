<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Transfer;
use App\Services\GooglePhotosPickerService;
use App\Services\VideoMergeService;
use App\Services\YouTubePlaylistService;
use App\Services\YouTubeUploadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessMergeTransferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 7200;

    public int $tries = 2;

    public function __construct(
        public Transfer $transfer,
    ) {}

    public function handle(
        GooglePhotosPickerService $pickerService,
        VideoMergeService $mergeService,
        YouTubeUploadService $uploadService,
        YouTubePlaylistService $playlistService,
    ): void {
        if ($this->transfer->status === 'cancelled') {
            return;
        }

        $this->transfer->update([
            'status' => 'processing',
            'started_at' => now(),
        ]);

        $user = $this->transfer->user;
        $photosAccount = $user->photosAccount;
        $youtubeAccount = $user->youtubeAccount;
        $downloadedPaths = [];
        $mergedPath = null;

        try {
            $sources = $this->transfer->merge_sources;

            foreach ($sources as $source) {
                $path = $pickerService->downloadVideo(
                    $photosAccount,
                    $source['base_url'],
                    $source['filename'],
                );
                $downloadedPaths[] = $path;
            }

            $mergedPath = storage_path('app/private/transfers/merged_'.uniqid().'.mp4');
            $mergeService->merge($downloadedPaths, $mergedPath);

            $this->transfer->update([
                'file_size' => filesize($mergedPath),
            ]);

            $videoId = $uploadService->upload(
                $youtubeAccount,
                $mergedPath,
                $this->transfer->title,
                $this->transfer->description,
                $this->transfer->privacy_status,
            );

            if ($this->transfer->youtube_playlist_id) {
                $playlistService->addVideoToPlaylist(
                    $youtubeAccount,
                    $this->transfer->youtube_playlist_id,
                    $videoId,
                );
            }

            $this->transfer->update([
                'status' => 'completed',
                'youtube_video_id' => $videoId,
                'completed_at' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Merge transfer failed', [
                'transfer_id' => $this->transfer->id,
                'error' => $e->getMessage(),
            ]);

            $this->transfer->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'completed_at' => now(),
            ]);
        } finally {
            foreach ($downloadedPaths as $path) {
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            if ($mergedPath && file_exists($mergedPath)) {
                unlink($mergedPath);
            }
        }
    }
}
