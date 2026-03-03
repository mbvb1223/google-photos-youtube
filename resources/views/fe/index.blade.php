@extends('fe.layouts.app')

@section('title', 'Photos2Tube - From Photos to YouTube in One Click')

@section('content')
    <main class="flex-1 flex flex-col items-center justify-center px-6 py-12 lg:py-24 max-w-7xl mx-auto w-full">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="flex flex-col gap-8 text-left max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary border border-primary/20 w-fit">
                    <span class="material-symbols-outlined text-sm">bolt</span>
                    <span class="text-xs font-bold uppercase tracking-wider">Fast &amp; Simple Transfers</span>
                </div>
                <div class="flex flex-col gap-4">
                    <h1 class="text-5xl lg:text-7xl font-extrabold leading-[1.1] tracking-tight text-slate-900 dark:text-slate-100">
                        From Photos to YouTube in <span class="text-primary">One Click</span>
                    </h1>
                    <p class="text-lg lg:text-xl text-slate-600 dark:text-slate-400 leading-relaxed">
                        Seamlessly transfer your Google Photos videos directly to YouTube. No downloads, no manual editing, just instant publishing.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="flex items-center justify-center gap-3 bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all shadow-xl shadow-primary/25 group">
                        Get Started Free
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="{{ route('how-it-works') }}" class="flex items-center justify-center gap-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-900 dark:text-slate-100 px-8 py-4 rounded-xl text-lg font-bold transition-all">
                        How It Works
                    </a>
                </div>
            </div>
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary/20 to-blue-400/20 rounded-2xl blur-2xl opacity-50"></div>
                <div class="relative bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-2xl overflow-hidden aspect-[4/3] flex items-center justify-center">
                    <div class="absolute top-0 left-0 w-full p-4 border-b border-slate-100 dark:border-slate-800 flex items-center gap-2 bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm z-10">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="ml-4 px-3 py-1 rounded bg-slate-100 dark:bg-slate-800 text-[10px] text-slate-400 font-mono flex-1">
                            photos2tube.com/dashboard
                        </div>
                    </div>
                    <div class="w-full h-full pt-14 p-6 flex flex-col gap-6 bg-slate-50 dark:bg-slate-950/50">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="aspect-square rounded-lg bg-slate-200 dark:bg-slate-800 animate-pulse"></div>
                            <div class="aspect-square rounded-lg bg-slate-200 dark:bg-slate-800 animate-pulse"></div>
                            <div class="aspect-square rounded-lg bg-slate-200 dark:bg-slate-800 animate-pulse"></div>
                        </div>
                        <div class="flex-1 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900">
                            <span class="material-symbols-outlined text-4xl text-primary/40 mb-2">upload_file</span>
                            <p class="text-sm text-slate-400 font-medium">Transferring video to YouTube...</p>
                            <div class="w-48 h-1.5 bg-slate-100 dark:bg-slate-800 rounded-full mt-4 overflow-hidden">
                                <div class="h-full bg-primary w-2/3 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <section class="w-full bg-slate-50 dark:bg-background-dark/50 border-t border-slate-100 dark:border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 flex flex-col md:flex-row items-center justify-between gap-8 opacity-60">
            <p class="text-sm font-bold uppercase tracking-widest text-slate-400">Seamless Integration With</p>
            <div class="flex flex-wrap justify-center items-center gap-12">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl">photo_library</span>
                    <span class="font-bold text-xl">Google Photos</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl text-red-600">smart_display</span>
                    <span class="font-bold text-xl text-slate-900 dark:text-slate-100">YouTube</span>
                </div>
            </div>
        </div>
    </section>
@endsection
