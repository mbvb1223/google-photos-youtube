<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
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

    public function submitContact(ContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()->back()->with('success', 'Thank you for your message! We\'ll get back to you soon.');
    }

    public function privacy(): View
    {
        return view('fe.privacy');
    }

    public function terms(): View
    {
        return view('fe.terms');
    }
}
