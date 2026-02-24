<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GooglePhotosPickerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class PickerSessionController extends Controller
{
    public function __construct(
        private GooglePhotosPickerService $pickerService,
    ) {}

    public function store(Request $request): JsonResponse
    {
        $account = $request->user()->photosAccount;

        if (! $account) {
            return response()->json(['error' => 'Google Photos account not connected.'], 403);
        }

        try {
            $session = $this->pickerService->createSession($account);
        } catch (RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return response()->json($session);
    }

    public function show(Request $request, string $sessionId): JsonResponse
    {
        $account = $request->user()->photosAccount;

        if (! $account) {
            return response()->json(['error' => 'Google Photos account not connected.'], 403);
        }

        $session = $this->pickerService->getSession($account, $sessionId);

        return response()->json($session);
    }

    public function mediaItems(Request $request, string $sessionId): JsonResponse
    {
        $account = $request->user()->photosAccount;

        if (! $account) {
            return response()->json(['error' => 'Google Photos account not connected.'], 403);
        }

        $items = $this->pickerService->listMediaItems(
            $account,
            $sessionId,
            $request->query('pageToken'),
        );

        return response()->json($items);
    }

    public function thumbnail(Request $request): Response
    {
        $account = $request->user()->photosAccount;

        if (! $account) {
            abort(403);
        }

        $baseUrl = $request->query('url');
        if (! $baseUrl || ! str_starts_with($baseUrl, 'https://lh3.googleusercontent.com/')) {
            abort(400);
        }

        $response = Http::withToken($this->pickerService->getAccessToken($account))
            ->get($baseUrl.'=w256-h256');

        $response->throw();

        return response($response->body(), 200)
            ->header('Content-Type', $response->header('Content-Type'))
            ->header('Cache-Control', 'private, max-age=3600');
    }

    public function destroy(Request $request, string $sessionId): JsonResponse
    {
        $account = $request->user()->photosAccount;

        if (! $account) {
            return response()->json(['error' => 'Google Photos account not connected.'], 403);
        }

        $this->pickerService->deleteSession($account, $sessionId);

        return response()->json(['message' => 'Session deleted.']);
    }
}
