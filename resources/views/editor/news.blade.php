@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">News & Accomplishments</h1>
            <p class="text-gray-600 mt-2">Manage all news articles and accomplishment reports</p>
        </div>
        <button onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Article
        </button>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <div class="relative">
                    <input type="text" placeholder="Search articles..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Types</option>
                    <option value="news">News</option>
                    <option value="accomplishment">Accomplishment</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Sample Data - Replace with actual data from database -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex-shrink-0 h-16 w-24">
                                <img class="h-16 w-24 rounded-lg object-cover" src="https://via.placeholder.com/96x64?text=NEWS" alt="Article thumbnail">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">PUDHO Monthly Report</div>
                            <div class="text-sm text-gray-500">Comprehensive report on housing developments</div>
                            <div class="flex flex-wrap gap-1 mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">Housing</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Policy</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">Report</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">News</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Mar 2, 2026</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Published</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <button onclick="editArticle(1)" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="togglePublish(1)" class="text-orange-600 hover:text-orange-900 font-medium">Unpublish</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="archiveArticle(1)" class="text-gray-600 hover:text-gray-900 font-medium">Archive</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex-shrink-0 h-16 w-24">
                                <img class="h-16 w-24 rounded-lg object-cover" src="https://via.placeholder.com/96x64?text=ACCOMPLISHMENT" alt="Article thumbnail">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">Housing Project Completion</div>
                            <div class="text-sm text-gray-500">Successfully completed 50 housing units this quarter</div>
                            <div class="flex flex-wrap gap-1 mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">Accomplishment</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Housing</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">Project</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Accomplishment</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Mar 1, 2026</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Published</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <button onclick="editArticle(2)" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="togglePublish(2)" class="text-orange-600 hover:text-orange-900 font-medium">Unpublish</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="archiveArticle(2)" class="text-gray-600 hover:text-gray-900 font-medium">Archive</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex-shrink-0 h-16 w-24">
                                <img class="h-16 w-24 rounded-lg object-cover" src="https://via.placeholder.com/96x64?text=NEWS" alt="Article thumbnail">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">New Housing Policy Update</div>
                            <div class="text-sm text-gray-500">Changes to application requirements</div>
                            <div class="flex flex-wrap gap-1 mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800">Policy</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Update</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">News</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Feb 28, 2026</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Draft</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <button onclick="editArticle(3)" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="togglePublish(3)" class="text-green-600 hover:text-green-900 font-medium">Publish</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="archiveArticle(3)" class="text-gray-600 hover:text-gray-900 font-medium">Archive</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex-shrink-0 h-16 w-24">
                                <img class="h-16 w-24 rounded-lg object-cover" src="https://via.placeholder.com/96x64?text=ACCOMPLISHMENT" alt="Article thumbnail">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">Community Outreach Success</div>
                            <div class="text-sm text-gray-500">Successfully served 500 families this month</div>
                            <div class="flex flex-wrap gap-1 mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-pink-100 text-pink-800">Accomplishment</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">Community</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Success</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Accomplishment</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Feb 27, 2026</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Archived</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <button onclick="editArticle(4)" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="togglePublish(4)" class="text-green-600 hover:text-green-900 font-medium">Publish</button>
                                <span class="text-gray-300">|</span>
                                <button onclick="archiveArticle(4)" class="text-gray-600 hover:text-gray-900 font-medium">Unarchive</button>
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
<div id="newsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Add Article</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="newsForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" id="newsTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter article title">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select id="articleType" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="news">News</option>
                    <option value="accomplishment">Accomplishment</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea id="newsContent" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter article content"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                <div class="space-y-2">
                    <div class="flex flex-wrap gap-2" id="tagsContainer">
                        <!-- Tags will be added here dynamically -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Housing
                            <button type="button" onclick="removeTag(this)" class="ml-2 text-blue-600 hover:text-blue-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Policy
                            <button type="button" onclick="removeTag(this)" class="ml-2 text-green-600 hover:text-green-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" id="tagInput" placeholder="Add a tag..." class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onkeypress="handleTagInput(event)">
                        <button type="button" onclick="addTag()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            Add Tag
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="text-xs text-gray-500">Suggested tags:</span>
                        <button type="button" onclick="addSuggestedTag('Housing')" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded">Housing</button>
                        <button type="button" onclick="addSuggestedTag('Policy')" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded">Policy</button>
                        <button type="button" onclick="addSuggestedTag('Community')" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded">Community</button>
                        <button type="button" onclick="addSuggestedTag('Development')" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded">Development</button>
                        <button type="button" onclick="addSuggestedTag('Update')" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded">Update</button>
                        <button type="button" onclick="addSuggestedTag('Accomplishment')" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded">Accomplishment</button>
                        <button type="button" onclick="addSuggestedTag('Project')" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded">Project</button>
                        <button type="button" onclick="addSuggestedTag('Success')" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded">Success</button>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img id="mainImagePreview" class="h-16 w-24 rounded-lg object-cover" src="https://via.placeholder.com/96x64?text=MAIN" alt="Main image preview">
                    </div>
                    <div>
                        <input type="file" id="mainImage" accept="image/*" class="hidden" onchange="previewMainImage(event)">
                        <button type="button" onclick="document.getElementById('mainImage').click()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            Upload Main Image
                        </button>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Image Gallery (Optional)</label>
                <div class="space-y-3">
                    <div id="imageGallery" class="flex flex-wrap gap-3">
                        <!-- Gallery images will be added here dynamically -->
                        <div class="relative group">
                            <img class="h-16 w-24 rounded-lg object-cover" src="https://via.placeholder.com/96x64?text=GALLERY" alt="Gallery image">
                            <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <input type="file" id="galleryImages" accept="image/*" multiple class="hidden" onchange="addGalleryImages(event)">
                        <button type="button" onclick="document.getElementById('galleryImages').click()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Gallery Images
                        </button>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="newsStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
            
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Save Article
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Add Article';
    document.getElementById('newsForm').reset();
    document.getElementById('mainImagePreview').src = 'https://via.placeholder.com/96x64?text=MAIN';
    document.getElementById('newsModal').classList.remove('hidden');
    // Reset tags
    resetTags();
}

function editArticle(id) {
    document.getElementById('modalTitle').textContent = 'Edit Article';
    // Load article data into form
    document.getElementById('newsModal').classList.remove('hidden');
}

function togglePublish(id) {
    // Toggle publish/unpublish logic here
    console.log('Toggling publish status for article:', id);
}

function archiveArticle(id) {
    if (confirm('Are you sure you want to archive this article?')) {
        // Archive logic here
        console.log('Archiving article:', id);
    }
}

function closeModal() {
    document.getElementById('newsModal').classList.add('hidden');
}

function previewMainImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('mainImagePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

function addGalleryImages(event) {
    const files = event.target.files;
    const gallery = document.getElementById('imageGallery');
    
    for (let file of files) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <img class="h-16 w-24 rounded-lg object-cover" src="${e.target.result}" alt="Gallery image">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                gallery.appendChild(div);
            }
            reader.readAsDataURL(file);
        }
    }
}

// Tag management functions
function addTag() {
    const input = document.getElementById('tagInput');
    const tagText = input.value.trim();
    
    if (tagText && !tagExists(tagText)) {
        createTag(tagText);
        input.value = '';
    }
}

function addSuggestedTag(tagText) {
    if (!tagExists(tagText)) {
        createTag(tagText);
    }
}

function createTag(tagText) {
    const tagsContainer = document.getElementById('tagsContainer');
    const colors = ['blue', 'green', 'purple', 'orange', 'pink', 'indigo', 'red', 'yellow'];
    const color = colors[Math.floor(Math.random() * colors.length)];
    
    const tagElement = document.createElement('span');
    tagElement.className = `inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-${color}-100 text-${color}-800`;
    tagElement.innerHTML = `
        ${tagText}
        <button type="button" onclick="removeTag(this)" class="ml-2 text-${color}-600 hover:text-${color}-800">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    
    tagsContainer.appendChild(tagElement);
}

function removeTag(button) {
    button.parentElement.remove();
}

function tagExists(tagText) {
    const tags = document.querySelectorAll('#tagsContainer span');
    for (let tag of tags) {
        if (tag.textContent.trim().toLowerCase() === tagText.toLowerCase()) {
            return true;
        }
    }
    return false;
}

function handleTagInput(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        addTag();
    }
}

function resetTags() {
    const tagsContainer = document.getElementById('tagsContainer');
    tagsContainer.innerHTML = '';
}

function getTags() {
    const tags = [];
    const tagElements = document.querySelectorAll('#tagsContainer span');
    tagElements.forEach(tag => {
        tags.push(tag.textContent.trim());
    });
    return tags;
}

// Form submission
document.getElementById('newsForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get all tags
    const tags = getTags();
    console.log('Article tags:', tags);
    
    // Get article type
    const articleType = document.getElementById('articleType').value;
    console.log('Article type:', articleType);
    
    // Save logic here
    console.log('Saving article...');
    closeModal();
});
</script>
@endsection
