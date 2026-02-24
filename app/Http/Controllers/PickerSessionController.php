<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GooglePhotosPickerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
