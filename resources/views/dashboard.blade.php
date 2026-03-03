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

            {{-- YouTube Connection --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">YouTube</h3>

                    @if ($youtubeAccount)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $youtubeAccount->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $youtubeAccount->email }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('google.disconnect', 'youtube') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 underline">
                                    Disconnect
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mb-4">Connect your YouTube account to upload videos.</p>
                        <a href="{{ route('google.connect.youtube') }}"
                           class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                            Connect YouTube
                        </a>
                    @endif

                    {{-- YouTube upload notice (required by YouTube API ToS Section 9.1.1) --}}
                    <p class="mt-4 text-xs text-gray-400">By using Photos2Tube to upload content, you certify that it complies with the <a href="https://www.youtube.com/t/terms" class="text-indigo-600 hover:underline" target="_blank" rel="noopener noreferrer">YouTube Terms of Service</a> (including the <a href="https://www.youtube.com/howyoutubeworks/policies/community-guidelines/" class="text-indigo-600 hover:underline" target="_blank" rel="noopener noreferrer">Community Guidelines</a>). Please make sure that you do not violate others' copyright or privacy rights.</p>
                </div>
            </div>

            {{-- Video Selection & Transfer --}}
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

                        {{-- Transfer messages --}}
                        <template x-if="transferError">
                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                                <span x-text="transferError"></span>
                            </div>
                        </template>
                        <template x-if="transferSuccess">
                            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                                <span x-text="transferSuccess"></span>
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

                        {{-- Video grid with selection --}}
                        <template x-if="mediaItems.length > 0">
                            <div>
                                {{-- Select all toggle --}}
                                <div class="flex items-center gap-2 mb-3">
                                    <input type="checkbox" :checked="allSelected" @change="toggleAll()"
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm text-gray-600" x-text="selectedCount + ' of ' + mediaItems.length + ' selected'"></span>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                    <template x-for="(item, index) in mediaItems" :key="item.id">
                                        <div class="group relative bg-gray-50 rounded-lg overflow-hidden cursor-pointer"
                                             :class="{ 'ring-2 ring-blue-500': item._selected, 'opacity-50': !item._selected }"
                                             @click="item._selected = !item._selected">
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
                                            {{-- Selection checkbox overlay --}}
                                            <div class="absolute top-2 left-2">
                                                <input type="checkbox" :checked="item._selected" @click.stop="item._selected = !item._selected"
                                                       class="rounded border-white/80 text-blue-600 focus:ring-blue-500 shadow">
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
                            </div>
                        </template>
                    </div>

                    {{-- Transfer config form --}}
                    <template x-if="mediaItems.length > 0 && selectedCount > 0">
                        <div class="border-t border-gray-200 p-6">
                            <h4 class="text-md font-medium text-gray-900 mb-4">Transfer Settings</h4>

                            {{-- Shared playlist dropdown --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Add to YouTube Playlist</label>
                                <select x-model="selectedPlaylist"
                                        class="w-full sm:w-64 text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">No playlist</option>
                                    <template x-for="playlist in playlists" :key="playlist.id">
                                        <option :value="playlist.id" x-text="playlist.title"></option>
                                    </template>
                                </select>
                            </div>

                            <div class="space-y-4">
                                <template x-for="(item, index) in mediaItems" :key="'config-' + item.id">
                                    <div x-show="item._selected" class="flex gap-4 items-start p-4 bg-gray-50 rounded-lg">
                                        {{-- Thumbnail --}}
                                        <div class="w-24 flex-shrink-0">
                                            <div class="aspect-video bg-black rounded overflow-hidden">
                                                <img :src="'/picker/thumbnail?url=' + encodeURIComponent(item.mediaFile?.baseUrl)"
                                                     class="w-full h-full object-contain" loading="lazy">
                                            </div>
                                        </div>

                                        {{-- Config fields --}}
                                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                                                <input type="text" x-model="item._title" maxlength="100"
                                                       class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                       @click.stop>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                                <input type="text" x-model="item._description" maxlength="5000" placeholder="Optional"
                                                       class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                       @click.stop>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Privacy</label>
                                                <select x-model="item._privacy" @click.stop
                                                        class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                    <option value="private">Private</option>
                                                    <option value="unlisted">Unlisted</option>
                                                    <option value="public">Public</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Transfer button --}}
                            <div class="mt-6 flex items-center justify-end gap-3">
                                <span class="text-sm text-gray-500" x-text="selectedCount + ' video(s) will be transferred'"></span>
                                @if ($youtubeAccount)
                                    <button @click="submitTransfers()"
                                            :disabled="transferring || selectedCount === 0"
                                            class="inline-flex items-center px-5 py-2.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                                        <template x-if="transferring">
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                        </template>
                                        <span x-text="transferring ? 'Transferring...' : 'Transfer to YouTube'"></span>
                                    </button>
                                @else
                                    <a href="{{ route('google.connect.youtube') }}"
                                       class="inline-flex items-center px-5 py-2.5 bg-gray-400 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                                        Connect YouTube to Transfer
                                    </a>
                                @endif
                            </div>
                        </div>
                    </template>
                </div>
            @endif

            {{-- Transfer History --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="transferHistory">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Transfer History</h3>
                        <template x-if="hasActiveTransfers">
                            <span class="inline-flex items-center gap-1.5 text-xs text-blue-600">
                                <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Auto-refreshing
                            </span>
                        </template>
                    </div>

                    {{-- Empty state --}}
                    <template x-if="transfers.length === 0">
                        <div class="text-center py-8 text-gray-400">
                            <svg class="mx-auto h-10 w-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                            </svg>
                            <p class="text-sm">No transfers yet.</p>
                        </div>
                    </template>

                    {{-- Transfer table --}}
                    <template x-if="transfers.length > 0">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">YouTube</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                        <th class="px-4 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <template x-for="transfer in transfers" :key="transfer.id">
                                        <tr>
                                            {{-- Title --}}
                                            <td class="px-4 py-3">
                                                <p class="text-sm font-medium text-gray-900 truncate max-w-xs" x-text="transfer.title"></p>
                                                <p class="text-xs text-gray-400" x-text="transfer.filename"></p>
                                            </td>

                                            {{-- Status badge --}}
                                            <td class="px-4 py-3">
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium"
                                                      :class="statusClass(transfer.status)">
                                                    <template x-if="transfer.status === 'processing'">
                                                        <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                                        </svg>
                                                    </template>
                                                    <span x-text="statusLabel(transfer.status)"></span>
                                                </span>
                                                {{-- Error message --}}
                                                <template x-if="transfer.status === 'failed' && transfer.error_message">
                                                    <p class="text-xs text-red-500 mt-1 max-w-xs truncate" :title="transfer.error_message" x-text="transfer.error_message"></p>
                                                </template>
                                            </td>

                                            {{-- YouTube link --}}
                                            <td class="px-4 py-3">
                                                <template x-if="transfer.youtube_video_id">
                                                    <a :href="'https://www.youtube.com/watch?v=' + transfer.youtube_video_id"
                                                       target="_blank" rel="noopener"
                                                       class="inline-flex items-center gap-1 text-sm text-red-600 hover:text-red-800 underline">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"/>
                                                            <path fill="white" d="M9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                        </svg>
                                                        Watch
                                                    </a>
                                                </template>
                                                <template x-if="!transfer.youtube_video_id">
                                                    <span class="text-xs text-gray-400">&mdash;</span>
                                                </template>
                                            </td>

                                            {{-- Date --}}
                                            <td class="px-4 py-3 text-xs text-gray-500 whitespace-nowrap"
                                                x-text="transfer.completed_at ? new Date(transfer.completed_at).toLocaleString() : new Date(transfer.created_at).toLocaleString()">
                                            </td>

                                            {{-- Actions --}}
                                            <td class="px-4 py-3 text-right">
                                                <template x-if="transfer.status === 'pending'">
                                                    <button @click="cancelTransfer(transfer.id)"
                                                            class="text-xs text-red-600 hover:text-red-800 underline">
                                                        Cancel
                                                    </button>
                                                </template>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
