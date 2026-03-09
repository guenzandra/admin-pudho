@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Announcements</h1>
            <p class="text-gray-600 mt-2">Manage all announcements and their publication status</p>
        </div>
        <button onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Announcement
        </button>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <div class="relative">
                    <input type="text" placeholder="Search announcements..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="scheduled">Scheduled</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </div>

    <!-- Announcements Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Posted</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Sample Data - Replace with actual data from database -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-lg object-cover" src="https://via.placeholder.com/40x40?text=IMG" alt="Featured image">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Office Holiday Schedule Update</div>
                                    <div class="text-sm text-gray-500">Important announcement regarding office hours during holidays</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Mar 2, 2026</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Published</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">John Doe</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <button onclick="editAnnouncement(1)" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="deleteAnnouncement(1)" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="togglePublish(1)" class="text-orange-600 hover:text-orange-900 font-medium">Unpublish</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-lg object-cover" src="https://via.placeholder.com/40x40?text=IMG" alt="Featured image">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">New Housing Policy Implementation</div>
                                    <div class="text-sm text-gray-500">Updates to the housing application process</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Mar 1, 2026</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Draft</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Jane Smith</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <button onclick="editAnnouncement(2)" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="deleteAnnouncement(2)" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="togglePublish(2)" class="text-green-600 hover:text-green-900 font-medium">Publish</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-lg object-cover" src="https://via.placeholder.com/40x40?text=IMG" alt="Featured image">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">System Maintenance Notice</div>
                                    <div class="text-sm text-gray-500">Scheduled maintenance for online services</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Feb 28, 2026</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Scheduled</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Mike Johnson</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <button onclick="editAnnouncement(3)" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="deleteAnnouncement(3)" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="togglePublish(3)" class="text-green-600 hover:text-green-900 font-medium">Publish</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                    <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Previous</button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600">1</button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">...</button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">10</button>
                            <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="announcementModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Create Announcement</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="announcementForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" id="announcementTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter announcement title">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea id="announcementContent" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter announcement content"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img id="imagePreview" class="h-16 w-16 rounded-lg object-cover" src="https://via.placeholder.com/64x64?text=IMG" alt="Image preview">
                    </div>
                    <div>
                        <input type="file" id="featuredImage" accept="image/*" class="hidden" onchange="previewImage(event)">
                        <button type="button" onclick="document.getElementById('featuredImage').click()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            Upload Image
                        </button>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="announcementStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="scheduled">Scheduled</option>
                </select>
            </div>
            
            <div id="scheduleField" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Schedule Publish Date</label>
                <input type="datetime-local" id="scheduleDate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Save Announcement
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Create Announcement';
    document.getElementById('announcementForm').reset();
    document.getElementById('imagePreview').src = 'https://via.placeholder.com/64x64?text=IMG';
    document.getElementById('announcementModal').classList.remove('hidden');
}

function editAnnouncement(id) {
    document.getElementById('modalTitle').textContent = 'Edit Announcement';
    // Load announcement data into form
    document.getElementById('announcementModal').classList.remove('hidden');
}

function deleteAnnouncement(id) {
    if (confirm('Are you sure you want to delete this announcement?')) {
        // Delete logic here
        console.log('Deleting announcement:', id);
    }
}

function togglePublish(id) {
    // Toggle publish/unpublish logic here
    console.log('Toggling publish status for:', id);
}

function closeModal() {
    document.getElementById('announcementModal').classList.add('hidden');
}

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

// Show/hide schedule field based on status
document.getElementById('announcementStatus').addEventListener('change', function() {
    const scheduleField = document.getElementById('scheduleField');
    if (this.value === 'scheduled') {
        scheduleField.classList.remove('hidden');
    } else {
        scheduleField.classList.add('hidden');
    }
});

// Form submission
document.getElementById('announcementForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Save logic here
    console.log('Saving announcement...');
    closeModal();
});
</script>
@endsection
