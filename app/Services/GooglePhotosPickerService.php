<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ConnectedAccount;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GooglePhotosPickerService
{
    private const string BASE_URL = 'https://photospicker.googleapis.com/v1';

    public function __construct(
        private GoogleAuthService $authService,
    ) {}

    private function getToken(ConnectedAccount $account): string
    {
        return $this->authService->getAccessToken($account);
    }

    public function createSession(ConnectedAccount $account): array
    {
        $response = Http::withToken($this->getToken($account))
            ->withBody('')
            ->post(self::BASE_URL.'/sessions');

        $response->throw();

        return $response->json();
    }

    public function getSession(ConnectedAccount $account, string $sessionId): array
    {
        $response = Http::withToken($this->getToken($account))
            ->get(self::BASE_URL."/sessions/{$sessionId}");

        $response->throw();

        return $response->json();
    }

    public function deleteSession(ConnectedAccount $account, string $sessionId): void
    {
        Http::withToken($this->getToken($account))
            ->delete(self::BASE_URL."/sessions/{$sessionId}")
            ->throw();
    }

    public function listMediaItems(ConnectedAccount $account, string $sessionId, ?string $pageToken = null): array
    {
        $query = ['sessionId' => $sessionId];
        if ($pageToken) {
            $query['pageToken'] = $pageToken;
        }

        $response = Http::withToken($this->getToken($account))
            ->get(self::BASE_URL.'/mediaItems', $query);

        $response->throw();

        return $response->json();
    }

    public function downloadVideo(ConnectedAccount $account, string $baseUrl, string $filename): string
    {
        $downloadUrl = $baseUrl.'=dv';
        $path = 'transfers/'.$filename;

        $response = Http::withToken($this->getToken($account))
            ->withOptions(['stream' => true])
            ->get($downloadUrl);

        $response->throw();

        Storage::disk('local')->put($path, $response->getBody());

        return Storage::disk('local')->path($path);
    }
}
