import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('pickerFlow', () => ({
    loading: false,
    statusMessage: '',
    error: null,
    mediaItems: [],
    sessionId: null,
    pollTimer: null,
    popupWindow: null,

    // Transfer state
    transferring: false,
    transferError: null,
    transferSuccess: null,

    get selectedItems() {
        return this.mediaItems.filter(item => item._selected);
    },

    get selectedCount() {
        return this.selectedItems.length;
    },

    get allSelected() {
        return this.mediaItems.length > 0 && this.mediaItems.every(item => item._selected);
    },

    toggleAll() {
        const newState = !this.allSelected;
        this.mediaItems.forEach(item => item._selected = newState);
    },

    stripExtension(filename) {
        if (!filename) return 'Untitled';
        return filename.replace(/\.[^/.]+$/, '');
    },

    async openPicker() {
        this.error = null;
        this.transferError = null;
        this.transferSuccess = null;
        this.loading = true;
        this.statusMessage = 'Creating session...';

        try {
            const session = await this.createSession();
            this.sessionId = session.id;

            this.popupWindow = window.open(
                session.pickerUri,
                'googlePhotosPicker',
                'width=1024,height=700,left=100,top=100'
            );

            this.statusMessage = 'Waiting for selection...';
            this.pollSession();
        } catch (e) {
            this.error = e.message || 'Failed to start picker session.';
            this.loading = false;
        }
    },

    async createSession() {
        const response = await fetch('/picker/sessions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        });

        if (!response.ok) {
            const data = await response.json().catch(() => ({}));
            throw new Error(data.error || `Request failed (${response.status})`);
        }

        return response.json();
    },

    pollSession() {
        this.pollTimer = setInterval(async () => {
            try {
                const response = await fetch(`/picker/sessions/${this.sessionId}`, {
                    headers: { 'Accept': 'application/json' },
                });

                if (!response.ok) {
                    throw new Error('Failed to check session status.');
                }

                const session = await response.json();

                if (session.mediaItemsSet) {
                    this.stopPolling();
                    this.statusMessage = 'Loading videos...';
                    await this.fetchMediaItems();
                    await this.cleanupSession();
                    this.loading = false;
                }
            } catch (e) {
                this.stopPolling();
                this.error = e.message || 'Failed to poll session.';
                this.loading = false;
            }
        }, 2000);
    },

    stopPolling() {
        if (this.pollTimer) {
            clearInterval(this.pollTimer);
            this.pollTimer = null;
        }
    },

    async fetchMediaItems() {
        const items = [];
        let pageToken = null;

        do {
            const url = new URL(`/picker/sessions/${this.sessionId}/media-items`, window.location.origin);
            if (pageToken) {
                url.searchParams.set('pageToken', pageToken);
            }

            const response = await fetch(url, {
                headers: { 'Accept': 'application/json' },
            });

            if (!response.ok) {
                throw new Error('Failed to fetch media items.');
            }

            const data = await response.json();

            if (data.mediaItems) {
                items.push(...data.mediaItems);
            }

            pageToken = data.nextPageToken || null;
        } while (pageToken);

        this.mediaItems = items
            .filter(item => item.type === 'VIDEO')
            .map(item => ({
                ...item,
                _selected: true,
                _title: item.createTime ? item.createTime.substring(0, 10) : this.stripExtension(item.mediaFile?.filename),
                _description: '',
                _privacy: 'unlisted',
            }));
    },

    async submitTransfers() {
        this.transferError = null;
        this.transferSuccess = null;

        if (this.selectedCount === 0) {
            this.transferError = 'Please select at least one video to transfer.';
            return;
        }

        this.transferring = true;

        try {
            const videos = this.selectedItems.map(item => ({
                media_id: item.id,
                base_url: item.mediaFile?.baseUrl,
                filename: item.mediaFile?.filename || 'video',
                mime_type: item.mediaFile?.mimeType || 'video/mp4',
                title: item._title,
                description: item._description || null,
                privacy_status: item._privacy,
            }));

            const response = await fetch('/transfers', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ videos }),
            });

            if (!response.ok) {
                const data = await response.json().catch(() => ({}));
                throw new Error(data.error || data.message || `Transfer failed (${response.status})`);
            }

            const transfers = await response.json();
            this.transferSuccess = `${transfers.length} video(s) queued for transfer to YouTube.`;
            this.mediaItems = [];
            window.dispatchEvent(new CustomEvent('transfers-updated'));
        } catch (e) {
            this.transferError = e.message || 'Failed to start transfer.';
        } finally {
            this.transferring = false;
        }
    },

    async cleanupSession() {
        try {
            await fetch(`/picker/sessions/${this.sessionId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            });
        } catch {
            // Cleanup is best-effort
        }
        this.sessionId = null;
    },

    destroy() {
        this.stopPolling();
    },
}));

Alpine.data('transferHistory', () => ({
    transfers: [],
    pollTimer: null,

    init() {
        this.fetchTransfers();
        window.addEventListener('transfers-updated', () => this.fetchTransfers());
    },

    get hasActiveTransfers() {
        return this.transfers.some(t => t.status === 'pending' || t.status === 'processing');
    },

    async fetchTransfers() {
        try {
            const response = await fetch('/transfers', {
                headers: { 'Accept': 'application/json' },
            });

            if (response.ok) {
                this.transfers = await response.json();
            }
        } catch {
            // Silently fail on poll errors
        }

        this.managePoll();
    },

    managePoll() {
        if (this.hasActiveTransfers && !this.pollTimer) {
            this.pollTimer = setInterval(() => this.fetchTransfers(), 5000);
        } else if (!this.hasActiveTransfers && this.pollTimer) {
            clearInterval(this.pollTimer);
            this.pollTimer = null;
        }
    },

    async cancelTransfer(id) {
        try {
            const response = await fetch(`/transfers/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            });

            if (response.ok) {
                await this.fetchTransfers();
            }
        } catch {
            // Ignore
        }
    },

    statusLabel(status) {
        return { pending: 'Pending', processing: 'Processing', completed: 'Completed', failed: 'Failed', cancelled: 'Cancelled' }[status] || status;
    },

    statusClass(status) {
        return {
            pending: 'bg-yellow-100 text-yellow-800',
            processing: 'bg-blue-100 text-blue-800',
            completed: 'bg-green-100 text-green-800',
            failed: 'bg-red-100 text-red-800',
            cancelled: 'bg-gray-100 text-gray-600',
        }[status] || 'bg-gray-100 text-gray-600';
    },

    destroy() {
        if (this.pollTimer) {
            clearInterval(this.pollTimer);
            this.pollTimer = null;
        }
    },
}));

Alpine.start();
