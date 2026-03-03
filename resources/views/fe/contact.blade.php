@extends('fe.layouts.app')

@section('title', 'Photo2Tube - From Photos to YouTube in One Click')

@section('content')
    <main class="px-6 md:px-20 lg:px-40 py-12 lg:py-24">
        <div class="max-w-6xl mx-auto">
            <!-- Hero Section -->
            <div class="mb-16">
                <h1 class="text-slate-900 dark:text-white text-4xl md:text-5xl font-black leading-tight tracking-tight mb-4">Get in touch</h1>
                <p class="text-slate-600 dark:text-slate-400 text-lg max-w-2xl">Have questions about syncing your Google Photos to YouTube? Our support team is ready to help you streamline your workflow.</p>
            </div>
            <!-- Contact Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                <!-- Left: Form -->
                <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <form action="#" class="space-y-6">
                        <div>
                            <label class="block text-slate-900 dark:text-slate-100 text-sm font-semibold mb-2" for="name">Name</label>
                            <input class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 text-base focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-400" id="name" placeholder="Enter your full name" type="text"/>
                        </div>
                        <div>
                            <label class="block text-slate-900 dark:text-slate-100 text-sm font-semibold mb-2" for="email">Email Address</label>
                            <input class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 text-base focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-400" id="email" placeholder="your@email.com" type="email"/>
                        </div>
                        <div>
                            <label class="block text-slate-900 dark:text-slate-100 text-sm font-semibold mb-2" for="message">Message</label>
                            <textarea class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 text-base focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-400 resize-none" id="message" placeholder="How can we help you?" rows="5"></textarea>
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
                                <a class="text-primary font-semibold hover:underline" href="mailto:support@photovideouploader.com">support@photovideouploader.com</a>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="flex-shrink-0 size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">location_on</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Our Office</h3>
                                <p class="text-slate-600 dark:text-slate-400">123 Creator Studio Way<br/>Mountain View, CA 94043</p>
                                <div class="mt-4 rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800 h-32 w-full max-w-sm bg-slate-100 relative">
                                    <div class="absolute inset-0 bg-cover bg-center opacity-70" data-alt="Abstract map showing office location in Mountain View" data-location="Mountain View, CA" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBmQIDt2KfHZLl4mJwqvX-AgYUgg06tALQ4lnL8L2mcv3_pXggRS2KBrXgBck2Z7yozQYs-3yhHFEhTI-BKs8sbJrCl4S_RUph3m4QQwQd3S68mcSGqyHoAAajMnAcj7o47wpURmvfHKGD8jP59eFBohBKsNwKiqDnSsIySizm7nu0msfv9e9kB5t3YM_yHcCb15R7BZIh7DsMIkotoiKp3Fw-Bz90aG07FotKrM6n6bH-yy62ULlGI2WZFEwh_QAWKAQE3CDVdAYc')"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-primary text-3xl">push_pin</span>
                                    </div>
                                </div>
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
                                <span class="material-symbols-outlined text-xl">camera</span>
                            </a>
                            <a class="size-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:border-primary hover:text-primary transition-all" href="#">
                                <span class="material-symbols-outlined text-xl">play_circle</span>
                            </a>
                        </div>
                    </div>
                    <!-- Help Center CTA -->
                    <div class="p-6 rounded-xl bg-slate-100 dark:bg-slate-800/50 border border-dashed border-slate-300 dark:border-slate-700">
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Looking for quick answers?</p>
                        <a class="text-sm font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all" href="#">
                            Visit Help Center <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
