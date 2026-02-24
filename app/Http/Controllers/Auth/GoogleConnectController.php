<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ConnectedAccount;
use Google\Client as GoogleClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GoogleConnectController extends Controller
{
    private function getClient(): GoogleClient
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return $client;
    }

    public function connectPhotos(Request $request): RedirectResponse
    {
        $client = $this->getClient();
        $client->addScope('openid');
        $client->addScope('email');
        $client->addScope('profile');
        $client->addScope('https://www.googleapis.com/auth/photospicker.mediaitems.readonly');

        $request->session()->put('google_auth_type', 'photos');

        return redirect()->away($client->createAuthUrl());
    }

    public function connectYoutube(Request $request): RedirectResponse
    {
        $client = $this->getClient();
        $client->addScope('openid');
        $client->addScope('email');
        $client->addScope('profile');
        $client->addScope('https://www.googleapis.com/auth/youtube.upload');

        $request->session()->put('google_auth_type', 'youtube');

        return redirect()->away($client->createAuthUrl());
    }

    public function callback(Request $request): RedirectResponse
    {
        $authType = $request->session()->pull('google_auth_type');

        if (! $authType || ! $request->has('code')) {
            return redirect()->route('dashboard')->with('error', 'Invalid OAuth callback.');
        }

        $client = $this->getClient();
        $tokenResponse = $client->fetchAccessTokenWithAuthCode($request->input('code'));

        if (isset($tokenResponse['error'])) {
            return redirect()->route('dashboard')->with('error', 'Failed to authenticate with Google.');
        }

        $client->setAccessToken($tokenResponse);

        $oauth2 = new \Google\Service\Oauth2($client);
        $userInfo = $oauth2->userinfo->get();

        ConnectedAccount::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'provider_type' => $authType,
            ],
            [
                'provider' => 'google',
                'google_id' => $userInfo->id,
                'email' => $userInfo->email,
                'name' => $userInfo->name,
                'token' => [
                    'access_token' => $tokenResponse['access_token'],
                    'refresh_token' => $tokenResponse['refresh_token'] ?? null,
                    'expires_at' => time() + ($tokenResponse['expires_in'] ?? 3600),
                ],
            ]
        );

        $label = $authType === 'photos' ? 'Google Photos' : 'YouTube';

        return redirect()->route('dashboard')->with('success', "$label account connected.");
    }

    public function disconnect(Request $request, string $type): RedirectResponse
    {
        $request->user()->connectedAccounts()->where('provider_type', $type)->delete();

        $label = $type === 'photos' ? 'Google Photos' : 'YouTube';

        return redirect()->route('dashboard')->with('success', "$label account disconnected.");
    }
}
