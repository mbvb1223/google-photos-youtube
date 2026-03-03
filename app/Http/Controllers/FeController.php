<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class FeController extends Controller
{
    public function index(): View
    {
        return view('fe.index');
    }

    public function work(): View
    {
        return view('fe.work');
    }

    public function pricing(): View
    {
        return view('fe.pricing');
    }

    public function contact(): View
    {
        return view('fe.contact');
    }
}
