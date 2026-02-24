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

    async openPicker() {
        this.error = null;
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

        this.mediaItems = items.filter(item => item.type === 'VIDEO');
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

Alpine.start();
