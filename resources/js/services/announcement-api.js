// resources/js/services/announcement-api.js

class AnnouncementAPI {
    constructor() {
        this.baseUrl = '/editor/announcements';
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    async getData(filters = {}) {
        const params = new URLSearchParams(filters);
        const response = await fetch(`${this.baseUrl}/data?${params.toString()}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        if (!response.ok) throw new Error('Failed to fetch data');
        return await response.json();
    }

    async create(formData) {
        const response = await fetch(this.baseUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });
        
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to create announcement');
        }
        return await response.json();
    }

    async update(id, formData) {
        const response = await fetch(`${this.baseUrl}/${id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });
        
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to update announcement');
        }
        return await response.json();
    }

    async delete(id) {
        const response = await fetch(`${this.baseUrl}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        if (!response.ok) throw new Error('Failed to delete announcement');
        return await response.json();
    }

    async toggleStatus(id) {
        const response = await fetch(`${this.baseUrl}/${id}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        if (!response.ok) throw new Error('Failed to toggle status');
        return await response.json();
    }
}

const announcementAPI = new AnnouncementAPI();