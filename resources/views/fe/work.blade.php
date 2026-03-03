@extends('fe.layouts.app')

@section('title', 'Photo2Tube - From Photos to YouTube in One Click')

@section('content')
    <main class="mx-auto max-w-7xl px-6 py-20">
        <!-- Hero Title Section -->
        <div class="mb-20 text-center">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white md:text-5xl lg:text-6xl">
                Three simple steps to publish
            </h1>
            <p class="mx-auto max-w-2xl text-lg text-slate-600 dark:text-slate-400">
                Our automated workflow handles the technical details so you can focus on sharing your best moments with the world.
            </p>
        </div>
        <!-- How It Works Section -->
        <div class="relative">
            <!-- Connecting Line (Desktop Only) -->
            <div class="absolute top-24 left-0 hidden h-0.5 w-full bg-primary/10 lg:block"></div>
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
                <!-- Step 1 -->
                <div class="relative flex flex-col items-center text-center">
                    <div class="z-10 mb-8 flex h-20 w-20 items-center justify-center rounded-2xl bg-white shadow-xl shadow-primary/10 ring-4 ring-background-light dark:bg-slate-800 dark:ring-background-dark">
                        <span class="material-symbols-outlined text-4xl text-primary">login</span>
                    </div>
                    <div class="mb-4 inline-flex items-center justify-center rounded-full bg-primary/10 px-4 py-1">
                        <span class="text-xs font-black uppercase tracking-widest text-primary">Step 01</span>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-slate-900 dark:text-white leading-tight">Connect Google Account</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                        Securely link your Google Photos library with a single click. We use industry-standard OAuth 2.0 to keep your data private and safe.
                    </p>
                </div>
                <!-- Step 2 -->
                <div class="relative flex flex-col items-center text-center">
                    <div class="z-10 mb-8 flex h-20 w-20 items-center justify-center rounded-2xl bg-white shadow-xl shadow-primary/10 ring-4 ring-background-light dark:bg-slate-800 dark:ring-background-dark">
                        <span class="material-symbols-outlined text-4xl text-primary">photo_library</span>
                    </div>
                    <div class="mb-4 inline-flex items-center justify-center rounded-full bg-primary/10 px-4 py-1">
                        <span class="text-xs font-black uppercase tracking-widest text-primary">Step 02</span>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-slate-900 dark:text-white leading-tight">Select Videos from Photos</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                        Browse through your albums directly on our platform. Choose the high-quality clips you want to transfer—no downloading required.
                    </p>
                </div>
                <!-- Step 3 -->
                <div class="relative flex flex-col items-center text-center">
                    <div class="z-10 mb-8 flex h-20 w-20 items-center justify-center rounded-2xl bg-white shadow-xl shadow-primary/10 ring-4 ring-background-light dark:bg-slate-800 dark:ring-background-dark">
                        <span class="material-symbols-outlined text-4xl text-primary">smart_display</span>
                    </div>
                    <div class="mb-4 inline-flex items-center justify-center rounded-full bg-primary/10 px-4 py-1">
                        <span class="text-xs font-black uppercase tracking-widest text-primary">Step 03</span>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-slate-900 dark:text-white leading-tight">Publish to YouTube</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                        Customize your titles, descriptions, and privacy settings. One click and your content is live on your YouTube channel instantly.
                    </p>
                </div>
            </div>
        </div>
        <!-- Call to Action Section -->
        <div class="mt-32 rounded-3xl bg-primary px-8 py-16 text-center text-white md:px-16">
            <h2 class="mb-6 text-3xl font-extrabold md:text-4xl">Ready to sync your memories?</h2>
            <p class="mx-auto mb-10 max-w-xl text-lg text-white/80">
                Join over 50,000 creators who save hours every week by automating their video publishing workflow.
            </p>
            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                <button class="flex h-14 w-full items-center justify-center rounded-xl bg-white px-10 text-lg font-bold text-primary transition-all hover:bg-slate-50 hover:shadow-xl sm:w-auto">
                    Connect Now
                </button>
                <button class="flex h-14 w-full items-center justify-center rounded-xl border-2 border-white/30 px-10 text-lg font-bold text-white transition-all hover:bg-white/10 sm:w-auto">
                    View Demo
                </button>
            </div>
        </div>
    </main>
@endsection
