<?php

use App\Http\Controllers\Auth\GoogleConnectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/auth/google/photos', [GoogleConnectController::class, 'connectPhotos'])->name('google.connect.photos');
    Route::get('/auth/google/youtube', [GoogleConnectController::class, 'connectYoutube'])->name('google.connect.youtube');
    Route::get('/auth/google/callback', [GoogleConnectController::class, 'callback'])->name('google.callback');
    Route::delete('/auth/google/{type}', [GoogleConnectController::class, 'disconnect'])->name('google.disconnect');
});

require __DIR__.'/auth.php';
