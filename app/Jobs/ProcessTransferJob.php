<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Transfer;
use App\Services\GooglePhotosPickerService;
use App\Services\YouTubeUploadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessTransferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 3600;

    public int $tries = 2;

    public function __construct(
        public Transfer $transfer,
    ) {}

    public function handle(
        GooglePhotosPickerService $pickerService,
        YouTubeUploadService $uploadService,
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
        $tempPath = null;

        try {
            $tempPath = $pickerService->downloadVideo(
                $photosAccount,
                $this->transfer->google_photos_base_url,
                $this->transfer->filename,
            );

            $this->transfer->update([
                'file_size' => filesize($tempPath),
            ]);

            $videoId = $uploadService->upload(
                $youtubeAccount,
                $tempPath,
                $this->transfer->title,
                $this->transfer->description,
                $this->transfer->privacy_status,
            );

            $this->transfer->update([
                'status' => 'completed',
                'youtube_video_id' => $videoId,
                'completed_at' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Transfer failed', [
                'transfer_id' => $this->transfer->id,
                'error' => $e->getMessage(),
            ]);

            $this->transfer->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'completed_at' => now(),
            ]);
        } finally {
            if ($tempPath && file_exists($tempPath)) {
                unlink($tempPath);
            }
        }
    }
}
