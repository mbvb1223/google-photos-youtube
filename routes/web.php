<?php

use App\Http\Controllers\Auth\GoogleConnectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PickerSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\YouTubeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\FeController::class, 'index']);
Route::get('/how-it-works', [\App\Http\Controllers\FeController::class, 'work']);
Route::get('/pricing', [\App\Http\Controllers\FeController::class, 'pricing']);
Route::get('/contact', [\App\Http\Controllers\FeController::class, 'contact']);

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Google OAuth
    Route::get('/auth/google/photos', [GoogleConnectController::class, 'connectPhotos'])->name('google.connect.photos');
    Route::get('/auth/google/youtube', [GoogleConnectController::class, 'connectYoutube'])->name('google.connect.youtube');
    Route::get('/auth/google/callback', [GoogleConnectController::class, 'callback'])->name('google.callback');
    Route::delete('/auth/google/{type}', [GoogleConnectController::class, 'disconnect'])->name('google.disconnect');

    // Picker sessions
    Route::post('/picker/sessions', [PickerSessionController::class, 'store'])->name('picker.sessions.store');
    Route::get('/picker/sessions/{sessionId}', [PickerSessionController::class, 'show'])->name('picker.sessions.show');
    Route::get('/picker/sessions/{sessionId}/media-items', [PickerSessionController::class, 'mediaItems'])->name('picker.sessions.media-items');
    Route::get('/picker/thumbnail', [PickerSessionController::class, 'thumbnail'])->name('picker.thumbnail');
    Route::delete('/picker/sessions/{sessionId}', [PickerSessionController::class, 'destroy'])->name('picker.sessions.destroy');

    // YouTube
    Route::get('/youtube/playlists', [YouTubeController::class, 'playlists'])->name('youtube.playlists');

    // Transfers
    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.index');
    Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');
    Route::get('/transfers/{transfer}', [TransferController::class, 'show'])->name('transfers.show');
    Route::delete('/transfers/{transfer}', [TransferController::class, 'destroy'])->name('transfers.destroy');
});

require __DIR__.'/auth.php';
