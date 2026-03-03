<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class FeController extends Controller
{
    public function index(Request $request): View
    {
        return view('fe/index');
    }

    public function work(Request $request): View
    {
        return view('fe/work');
    }

    public function pricing(Request $request): View
    {
        return view('fe/pricing');
    }

    public function contact(Request $request): View
    {
        return view('fe/contact ');
    }
}
