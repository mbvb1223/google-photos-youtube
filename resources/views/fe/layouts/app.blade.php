<!DOCTYPE html>

<html class="light" lang="en"><head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Photo2Tube - From Photos to YouTube in One Click')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }
        .soft-gradient {
            background: radial-gradient(circle at 80% 20%, rgba(19, 127, 236, 0.05) 0%, transparent 40%),
            radial-gradient(circle at 10% 80%, rgba(19, 127, 236, 0.03) 0%, transparent 30%);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
<div class="relative min-h-screen flex flex-col soft-gradient">
    <header class="w-full max-w-7xl mx-auto px-6 lg:px-10 py-6 flex items-center justify-between">
        <div class="flex items-center gap-2 text-primary">
            <span class="material-symbols-outlined text-3xl font-bold">auto_videocam</span>
            <span class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100"><a href="/">Photos2Tube</a></span>
        </div>
        <nav class="hidden md:flex items-center gap-10">
            <a class="text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors" href="/how-it-works">How It Works</a>
            <a class="text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors" href="/pricing">Pricing</a>
            <a class="text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors" href="/contact">Contact</a>
        </nav>
        <div class="flex items-center gap-4">
            <button class="hidden sm:block px-5 py-2.5 text-sm font-bold text-slate-900 dark:text-slate-100 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
                Log In
            </button>
            <button class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 text-sm font-bold rounded-lg transition-all shadow-lg shadow-primary/20">
                Sign Up
            </button>
        </div>
    </header>

    @yield('content')

    <footer class="w-full bg-white dark:bg-background-dark border-t border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-6 py-12 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 md:gap-8">
                <!-- Branding Column -->
                <div class="col-span-1 md:col-span-1 flex flex-col gap-4">
                    <div class="flex items-center gap-2 group cursor-pointer">
                        <div class="bg-primary p-1.5 rounded-lg">
                            <span class="material-symbols-outlined text-white text-2xl">movie_filter</span>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">PhotoStream</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed max-w-xs">
                        Automatically transform your Google Photos memories into high-quality videos ready for YouTube.
                    </p>
                </div>
                <!-- Links Columns -->
                <div class="grid grid-cols-2 md:grid-cols-2 col-span-1 md:col-span-2 gap-8">
                    <div class="flex flex-col gap-4">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Legal</h3>
                        <nav class="flex flex-col gap-3">
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors text-sm" href="#">Privacy Policy</a>
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors text-sm" href="#">Terms of Service</a>
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors text-sm" href="#">Cookie Policy</a>
                        </nav>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Support</h3>
                        <nav class="flex flex-col gap-3">
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors text-sm" href="mailto:support@photostream.io">Contact Email</a>
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors text-sm" href="#">Help Center</a>
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors text-sm" href="#">API Docs</a>
                        </nav>
                    </div>
                </div>
                <!-- Social Column -->
                <div class="col-span-1 flex flex-col gap-4">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Connect</h3>
                    <div class="flex gap-4">
                        <a class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
                            <svg fill="currentColor" height="20" viewbox="0 0 256 256" width="20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z"></path>
                            </svg>
                        </a>
                        <a class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
                            <svg fill="currentColor" height="20" viewbox="0 0 256 256" width="20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M247.39,68.94A8,8,0,0,0,240,64H209.57A48.66,48.66,0,0,0,168.1,40a46.91,46.91,0,0,0-33.75,13.7A47.9,47.9,0,0,0,120,88v6.09C79.74,83.47,46.81,50.72,46.46,50.37a8,8,0,0,0-13.65,4.92c-4.31,47.79,9.57,79.77,22,98.18a110.93,110.93,0,0,0,21.88,24.2c-15.23,17.53-39.21,26.74-39.47,26.84a8,8,0,0,0-3.85,11.93c.75,1.12,3.75,5.05,11.08,8.72C53.51,229.7,65.48,232,80,232c70.67,0,129.72-54.42,135.75-124.44l29.91-29.9A8,8,0,0,0,247.39,68.94Zm-45,29.41a8,8,0,0,0-2.32,5.14C196,166.58,143.28,216,80,216c-10.56,0-18-1.4-23.22-3.08,11.51-6.25,27.56-17,37.88-32.48A8,8,0,0,0,92,169.08c-.47-.27-43.91-26.34-44-96,16,13,45.25,33.17,78.67,38.79A8,8,0,0,0,136,104V88a32,32,0,0,1,9.6-22.92A30.94,30.94,0,0,1,167.9,56c12.66.16,24.49,7.88,29.44,19.21A8,8,0,0,0,204.67,80h16Z"></path>
                            </svg>
                        </a>
                        <a class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
                            <svg fill="currentColor" height="20" viewbox="0 0 256 256" width="20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M164.44,121.34l-48-32A8,8,0,0,0,104,96v64a8,8,0,0,0,12.44,6.66l48-32a8,8,0,0,0,0-13.32ZM120,145.05V111l25.58,17ZM234.33,69.52a24,24,0,0,0-14.49-16.4C185.56,39.88,131,40,128,40s-57.56-.12-91.84,13.12a24,24,0,0,0-14.49,16.4C19.08,79.5,16,97.74,16,128s3.08,48.5,5.67,58.48a24,24,0,0,0,14.49,16.41C69,215.56,120.4,216,127.34,216h1.32c6.94,0,58.37-.44,91.18-13.11a24,24,0,0,0,14.49-16.41c2.59-10,5.67-28.22,5.67-58.48S236.92,79.5,234.33,69.52Zm-15.49,113a8,8,0,0,1-4.77,5.49c-31.65,12.22-85.48,12-86,12H128c-.54,0-54.33.2-86-12a8,8,0,0,1-4.77-5.49C34.8,173.39,32,156.57,32,128s2.8-45.39,5.16-54.47A8,8,0,0,1,41.93,68c30.52-11.79,81.66-12,85.85-12h.27c.54,0,54.38-.18,86,12a8,8,0,0,1,4.77,5.49C221.2,82.61,224,99.43,224,128S221.2,173.39,218.84,182.47Z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-slate-500 dark:text-slate-400 text-sm">
                    &copy; 2024 PhotoStream SaaS. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                     <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary border border-primary/20">
                     v2.1.0 Stable
                     </span>
                    <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-sm">
                        <span class="material-symbols-outlined text-sm">language</span>
                        <span>English (US)</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
@stack('scripts')
</body></html>
