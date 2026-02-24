<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperConnectedAccount
 */
class ConnectedAccount extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'provider_type',
        'google_id',
        'email',
        'name',
        'token',
    ];

    protected function casts(): array
    {
        return [
            'token' => 'encrypted:array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAccessToken(): ?string
    {
        return $this->token['access_token'] ?? null;
    }

    public function getRefreshToken(): ?string
    {
        return $this->token['refresh_token'] ?? null;
    }

    public function isTokenExpired(): bool
    {
        $expiresAt = $this->token['expires_at'] ?? 0;

        return $expiresAt <= time();
    }
}