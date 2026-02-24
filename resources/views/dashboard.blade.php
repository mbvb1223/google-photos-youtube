<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Google Photos Connection --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Google Photos</h3>

                    @if ($photosAccount)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $photosAccount->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $photosAccount->email }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('google.disconnect', 'photos') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 underline">
                                    Disconnect
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mb-4">Connect your Google Photos account to select videos for upload.</p>
                        <a href="{{ route('google.connect.photos') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Connect Google Photos
                        </a>
                    @endif
                </div>
            </div>

            {{-- Video Selection --}}
            @if ($photosAccount)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="pickerFlow">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Selected Videos</h3>
                            <button @click="openPicker"
                                    :disabled="loading"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                                <template x-if="loading">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg>
                                </template>
                                <span x-text="loading ? statusMessage : 'Select Videos'"></span>
                            </button>
                        </div>

                        {{-- Error message --}}
                        <template x-if="error">
                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                                <span x-text="error"></span>
                            </div>
                        </template>

                        {{-- Empty state --}}
                        <template x-if="mediaItems.length === 0 && !loading">
                            <div class="text-center py-12 text-gray-400">
                                <svg class="mx-auto h-12 w-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm">No videos selected yet. Click "Select Videos" to open Google Photos.</p>
                            </div>
                        </template>

                        {{-- Video grid --}}
                        <template x-if="mediaItems.length > 0">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                <template x-for="item in mediaItems" :key="item.id">
                                    <div class="group relative bg-gray-50 rounded-lg overflow-hidden">
                                        <div class="aspect-video bg-black">
                                            <img :src="'/picker/thumbnail?url=' + encodeURIComponent(item.mediaFile?.baseUrl)"
                                                 :alt="item.mediaFile?.filename || 'Video'"
                                                 class="w-full h-full object-contain"
                                                 loading="lazy">
                                        </div>
                                        <div class="p-2">
                                            <p class="text-xs font-medium text-gray-700 truncate"
                                               x-text="item.mediaFile?.filename || 'Untitled'"
                                               :title="item.mediaFile?.filename"></p>
                                            <p class="text-xs text-gray-400" x-text="item.mediaFile?.mimeType || item.mimeType || ''"></p>
                                        </div>
                                        {{-- Video icon overlay --}}
                                        <div class="absolute top-2 right-2 bg-black/60 rounded-full p-1">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                                            </svg>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
