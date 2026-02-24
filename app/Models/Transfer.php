<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTransfer
 */
class Transfer extends Model
{
    protected $fillable = [
        'user_id',
        'google_photos_media_id',
        'google_photos_base_url',
        'filename',
        'mime_type',
        'merge_sources',
        'title',
        'description',
        'privacy_status',
        'status',
        'youtube_video_id',
        'youtube_playlist_id',
        'error_message',
        'file_size',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'merge_sources' => 'array',
            'file_size' => 'integer',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }
}
