<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return view('dashboard', [
            'photosAccount' => $user->photosAccount,
            'youtubeAccount' => $user->youtubeAccount,
            'transfers' => $user->transfers()->latest()->get(),
        ]);
    }
}
