@extends('fe.layouts.app')

@section('title', 'Contact - Photos2Tube')

@section('content')
    <main class="px-6 md:px-20 lg:px-40 py-12 lg:py-24">
        <div class="max-w-6xl mx-auto">
            <!-- Hero Section -->
            <div class="mb-16">
                <h1 class="text-slate-900 dark:text-white text-4xl md:text-5xl font-black leading-tight tracking-tight mb-4">Get in touch</h1>
                <p class="text-slate-600 dark:text-slate-400 text-lg max-w-2xl">Have questions about transferring your Google Photos videos to YouTube? Our support team is ready to help.</p>
            </div>
            <!-- Contact Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                <!-- Left: Form -->
                <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-slate-900 dark:text-slate-100 text-sm font-semibold mb-2" for="name">Name</label>
                            <input class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 text-base focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-400 @error('name') border-red-500 dark:border-red-500 @enderror" id="name" name="name" placeholder="Enter your full name" type="text" value="{{ old('name') }}"/>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-slate-900 dark:text-slate-100 text-sm font-semibold mb-2" for="email">Email Address</label>
                            <input class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 text-base focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-400 @error('email') border-red-500 dark:border-red-500 @enderror" id="email" name="email" placeholder="your@email.com" type="email" value="{{ old('email') }}"/>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-slate-900 dark:text-slate-100 text-sm font-semibold mb-2" for="message">Message</label>
                            <textarea class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 text-base focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-400 resize-none @error('message') border-red-500 dark:border-red-500 @enderror" id="message" name="message" placeholder="How can we help you?" rows="5">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="w-full bg-primary text-white font-bold py-4 rounded-lg hover:bg-primary/90 transition-all flex items-center justify-center gap-2 group" type="submit">
                            Send Message
                            <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">send</span>
                        </button>
                    </form>
                </div>
                <!-- Right: Info -->
                <div class="space-y-12 py-4">
                    <!-- Contact Cards -->
                    <div class="space-y-8">
                        <div class="flex gap-5">
                            <div class="flex-shrink-0 size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">mail</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Email Support</h3>
                                <p class="text-slate-600 dark:text-slate-400 mb-2">Our average response time is under 2 hours.</p>
                                <a class="text-primary font-semibold hover:underline" href="mailto:phamkhien2309@gmail.com">phamkhien2309@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <!-- Social Links -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Follow our updates</h3>
                        <div class="flex gap-4">
                            <a class="size-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:border-primary hover:text-primary transition-all" href="#">
                                <span class="material-symbols-outlined text-xl">share</span>
                            </a>
                            <a class="size-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:border-primary hover:text-primary transition-all" href="#">
                                <span class="material-symbols-outlined text-xl">play_circle</span>
                            </a>
                        </div>
                    </div>
                    <!-- Help Center CTA -->
                    <div class="p-6 rounded-xl bg-slate-100 dark:bg-slate-800/50 border border-dashed border-slate-300 dark:border-slate-700">
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Looking for quick answers?</p>
                        <a class="text-sm font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all" href="{{ route('how-it-works') }}">
                            See How It Works <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
