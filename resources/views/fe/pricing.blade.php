@extends('fe.layouts.app')

@section('title', 'Pricing - SocialTools')

@section('content')
    <main class="flex-1 flex flex-col items-center py-16 px-6">
        <!-- Hero Header for Pricing -->
        <div class="text-center max-w-2xl mb-16">
            <span class="text-primary font-bold text-sm tracking-widest uppercase mb-3 block">Simple &amp; Transparent</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-slate-100 mb-6">Choose the right plan for your channel</h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg">Transfer your memories from Google Photos to YouTube effortlessly. No hidden fees, cancel anytime.</p>
        </div>
        <!-- Pricing Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-6xl">
            <!-- Free Plan -->
            <div class="flex flex-col gap-6 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex flex-col gap-2">
                    <h3 class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider">Free</h3>
                    <div class="flex items-baseline gap-1">
                        <span class="text-slate-900 dark:text-slate-100 text-5xl font-black tracking-tight">$0</span>
                        <span class="text-slate-500 text-base font-medium">/month</span>
                    </div>
                    <p class="text-slate-500 text-sm mt-2">Perfect for trying out the sync service.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full flex items-center justify-center rounded-lg h-12 px-4 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                    Get Started
                </a>
                <div class="flex flex-col gap-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">5 videos per month</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">Standard sync speed</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">720p Video Quality</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">Community support</span>
                    </div>
                </div>
            </div>
            <!-- Pro Plan -->
            <div class="relative flex flex-col gap-6 rounded-xl border-2 border-primary bg-white dark:bg-slate-900 p-8 shadow-2xl shadow-primary/10 transform md:-translate-y-4">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-primary text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                    Most Popular
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-primary text-sm font-bold uppercase tracking-wider">Pro</h3>
                    <div class="flex items-baseline gap-1">
                        <span class="text-slate-900 dark:text-slate-100 text-5xl font-black tracking-tight">$29</span>
                        <span class="text-slate-500 text-base font-medium">/month</span>
                    </div>
                    <p class="text-slate-500 text-sm mt-2">For content creators and power users.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full flex items-center justify-center rounded-lg h-12 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-all shadow-md shadow-primary/20">
                    Choose Pro Plan
                </a>
                <div class="flex flex-col gap-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <div class="text-sm flex gap-3 items-start font-medium text-slate-900 dark:text-slate-100">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span>Unlimited videos</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">High-speed storage sync</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">4K Ultra HD Uploads</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">Priority email support</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">Advanced channel analytics</span>
                    </div>
                </div>
            </div>
            <!-- Enterprise Plan -->
            <div class="flex flex-col gap-6 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex flex-col gap-2">
                    <h3 class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider">Enterprise</h3>
                    <div class="flex items-baseline gap-1">
                        <span class="text-slate-900 dark:text-slate-100 text-5xl font-black tracking-tight">$99</span>
                        <span class="text-slate-500 text-base font-medium">/month</span>
                    </div>
                    <p class="text-slate-500 text-sm mt-2">Custom solutions for large organizations.</p>
                </div>
                <a href="{{ route('contact') }}" class="w-full flex items-center justify-center rounded-lg h-12 px-4 bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 text-sm font-bold hover:opacity-90 transition-colors">
                    Contact Sales
                </a>
                <div class="flex flex-col gap-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">Custom video limits</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">Dedicated sync server</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">Multi-user management</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">24/7 Phone support</span>
                    </div>
                    <div class="text-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        <span class="text-slate-600 dark:text-slate-400">SSO &amp; Advanced Security</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Trust Badges -->
        <div class="mt-20 flex flex-col items-center gap-8">
            <p class="text-slate-400 text-sm font-semibold uppercase tracking-[0.2em]">Trusted by thousands of creators</p>
            <div class="flex flex-wrap justify-center gap-12 opacity-50 grayscale contrast-125">
                <div class="h-8 w-32 bg-slate-300 dark:bg-slate-700 rounded-full" data-alt="Placeholder for brand logo 1"></div>
                <div class="h-8 w-24 bg-slate-300 dark:bg-slate-700 rounded-full" data-alt="Placeholder for brand logo 2"></div>
                <div class="h-8 w-40 bg-slate-300 dark:bg-slate-700 rounded-full" data-alt="Placeholder for brand logo 3"></div>
                <div class="h-8 w-28 bg-slate-300 dark:bg-slate-700 rounded-full" data-alt="Placeholder for brand logo 4"></div>
            </div>
        </div>
    </main>
@endsection
