<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ConnectedAccount;
use Google\Client as GoogleClient;

class GoogleAuthService
{
    public function getClient(ConnectedAccount $account): GoogleClient
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setAccessType('offline');

        $token = $account->token;

        $client->setAccessToken([
            'access_token' => $token['access_token'],
            'refresh_token' => $token['refresh_token'] ?? null,
            'expires_in' => ($token['expires_at'] ?? 0) - time(),
            'created' => time(),
        ]);

        if ($client->isAccessTokenExpired() && $token['refresh_token']) {
            $newToken = $client->fetchAccessTokenWithRefreshToken($token['refresh_token']);

            if (! isset($newToken['error'])) {
                $account->update([
                    'token' => [
                        'access_token' => $newToken['access_token'],
                        'refresh_token' => $newToken['refresh_token'] ?? $token['refresh_token'],
                        'expires_at' => time() + ($newToken['expires_in'] ?? 3600),
                    ],
                ]);
            }
        }

        return $client;
    }

    public function getAccessToken(ConnectedAccount $account): string
    {
        $client = $this->getClient($account);

        return $client->getAccessToken()['access_token'];
    }
}