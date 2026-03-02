<!---addpost.blade.php--->
@extends('admin.layout')

@section('content')

<div class="max-w-4xl mx-auto py-6">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800">Create New Article</h1>
        <span class="text-sm text-gray-500 bg-blue-50 px-3 py-1 rounded-full flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="autosave-indicator">All changes saved</span>
        </span>
    </div>

    <!-- Main Form Container -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center gap-2 text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="font-medium">Write your article</span>
            </div>
        </div>

        <!-- Form Body -->
        <form id="postForm" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-6">
                <!-- Category Selection - Dynamic from Database -->
                <div class="categories-selection">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Choose where this article will appear
                    </p>
                </div>

                <!-- Post Title -->
                <div class="post-title">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" placeholder="e.g., Barangay Clearance Processing Update" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base" maxlength="255" required>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-xs text-gray-500 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Use a clear, descriptive title
                        </p>
                        <span class="text-xs text-gray-400 character-count">0/255</span>
                    </div>
                </div>

                <!-- Post Description/Excerpt -->
                <div class="post-description">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Short Description <span class="text-gray-400 text-xs">(optional)</span></label>
                    <textarea name="description" id="description" rows="3" placeholder="Brief summary of your article..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none" maxlength="500"></textarea>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-xs text-gray-500 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            This will appear in post previews and listings
                        </p>
                        <span class="text-xs text-gray-400 description-count">0/500</span>
                    </div>
                </div>

                <!-- Post Content with Rich Text Editor -->
                <div class="post-content">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Content <span class="text-red-500">*</span></label>
                    <!-- Hidden input for content -->
                    <input type="hidden" name="content" id="content-input">
                    
                    <!-- Rich Text Editor Toolbar -->
                    <div class="border border-gray-300 rounded-t-lg bg-gray-50 p-2 flex flex-wrap gap-1">
                        <button type="button" class="p-1.5 hover:bg-gray-200 rounded" title="Bold" onclick="formatText('bold')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z" />
                            </svg>
                        </button>
                        <button type="button" class="p-1.5 hover:bg-gray-200 rounded" title="Italic" onclick="formatText('italic')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h8 M6 20h8 M14 4L10 20" />
                            </svg>
                        </button>
                        <button type="button" class="p-1.5 hover:bg-gray-200 rounded" title="Underline" onclick="formatText('underline')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4v8a4 4 0 008 0V4 M4 20h16" />
                            </svg>
                        </button>
                        <span class="w-px h-6 bg-gray-300 mx-1"></span>
                        <button type="button" class="p-1.5 hover:bg-gray-200 rounded" title="Bullet List" onclick="formatText('insertUnorderedList')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <button type="button" class="p-1.5 hover:bg-gray-200 rounded" title="Numbered List" onclick="formatText('insertOrderedList')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    <!-- Rich Text Editor Area -->
                    <div id="richTextEditor" contenteditable="true" class="w-full px-4 py-3 border-x border-b border-gray-300 rounded-b-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm min-h-[200px] overflow-y-auto" placeholder="Write your article content here..."></div>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        You can use formatting tools to style your content
                    </p>
                </div>

                <!-- Multiple Photo Upload with Preview -->
                <div class="upload-photos">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Photos <span class="text-gray-400 text-xs">(optional, max 5 photos)</span></label>

                    <!-- Upload Area -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition-colors cursor-pointer" onclick="document.getElementById('photo-upload').click()">
                        <input type="file" id="photo-upload" name="photos[]" multiple accept="image/*" class="hidden" onchange="handlePhotoSelect(event)">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 5MB each</p>
                    </div>

                    <!-- Photo Preview Grid -->
                    <div id="photo-preview-grid" class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4"></div>
                </div>

                <!-- Multiple Video Upload with Preview -->
                <div class="upload-videos">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Videos <span class="text-gray-400 text-xs">(optional, max 3 videos)</span></label>

                    <!-- Upload Area -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition-colors cursor-pointer" onclick="document.getElementById('video-upload').click()">
                        <input type="file" id="video-upload" name="videos[]" multiple accept="video/*" class="hidden" onchange="handleVideoSelect(event)">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500 mt-1">MP4, MOV, AVI up to 50MB each</p>
                    </div>

                    <!-- Video Preview Grid -->
                    <div id="video-preview-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4"></div>
                </div>

                <!-- Status (Hidden - set by buttons) -->
                <input type="hidden" name="status" id="status" value="draft">

                <!-- Action Buttons -->
                <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="submitPost('publish')" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Preview & Publish
                    </button>

                    <button type="button" onclick="submitPost('draft')" class="px-6 py-2.5 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        Save as Draft
                    </button>

                    <button type="button" onclick="cancelPost()" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-all ml-auto">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 hidden items-center justify-center">
        <div class="bg-white rounded-xl w-11/12 max-w-3xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 sticky top-0 bg-white">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Preview Your Post
                </h3>
                <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body - Preview Content -->
            <div class="p-6">
                <!-- Author and Date Info -->
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 font-semibold">A</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800" id="previewAuthor">Admin</p>
                            <p class="text-xs text-gray-500">Author</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600" id="previewDate">{{ date('F j, Y') }}</p>
                        <p class="text-xs text-gray-500">Publication Date</p>
                    </div>
                </div>

                <!-- Preview Content -->
                <div class="space-y-4">
                    <!-- Category Badge -->
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium" id="previewCategory"></span>

                    <!-- Title -->
                    <h2 class="text-2xl font-bold text-gray-800" id="previewTitle"></h2>

                    <!-- Description -->
                    <p class="text-gray-600 bg-gray-50 p-3 rounded-lg italic" id="previewDescription"></p>

                    <!-- Main Content -->
                    <div class="prose max-w-none" id="previewContent"></div>

                    <!-- Photo Preview in Modal -->
                    <div class="mt-4" id="previewPhotos">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Attached Photos (<span id="photoCount">0</span>)</h4>
                        <div class="grid grid-cols-3 gap-2" id="photoPreviewGrid"></div>
                    </div>

                    <!-- Video Preview in Modal -->
                    <div class="mt-4" id="previewVideos">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Attached Videos (<span id="videoCount">0</span>)</h4>
                        <div class="grid grid-cols-2 gap-2" id="videoPreviewGrid"></div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
                <button onclick="closePreviewModal()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
                    Cancel
                </button>
                <button onclick="confirmPublish()" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Confirm & Publish
                </button>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div id="successToast" class="fixed bottom-8 right-8 bg-white rounded-lg shadow-lg px-5 py-3 transform translate-y-24 opacity-0 transition-all duration-300 z-50 border-l-4 border-green-500">
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <span class="text-gray-800 text-sm font-medium" id="toastMessage">Post published successfully!</span>
                <p class="text-xs text-gray-500 mt-0.5" id="toastSubMessage">Your article is now live</p>
            </div>
        </div>
    </div>

    <!-- Draft Toast -->
    <div id="draftToast" class="fixed bottom-8 right-8 bg-white rounded-lg shadow-lg px-5 py-3 transform translate-y-24 opacity-0 transition-all duration-300 z-50 border-l-4 border-yellow-500">
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
            </div>
            <div>
                <span class="text-gray-800 text-sm font-medium">Draft saved!</span>
                <p class="text-xs text-gray-500 mt-0.5">You can continue editing later</p>
            </div>
        </div>
    </div>

    <!-- Error Toast -->
    <div id="errorToast" class="fixed bottom-8 right-8 bg-white rounded-lg shadow-lg px-5 py-3 transform translate-y-24 opacity-0 transition-all duration-300 z-50 border-l-4 border-red-500">
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div>
                <span class="text-gray-800 text-sm font-medium" id="errorMessage">Error</span>
                <p class="text-xs text-gray-500 mt-0.5" id="errorSubMessage">Please try again</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Store uploaded files for preview
    let uploadedPhotos = [];
    let uploadedVideos = [];

    // Character counters
    document.getElementById('title').addEventListener('input', function() {
        document.querySelector('.character-count').textContent = this.value.length + '/255';
    });

    document.getElementById('description').addEventListener('input', function() {
        document.querySelector('.description-count').textContent = this.value.length + '/500';
    });

    // Rich Text Editor functions
    function formatText(command) {
        document.execCommand(command, false, null);
        document.getElementById('richTextEditor').focus();
        updateContentInput();
    }

    // Update hidden content input
    function updateContentInput() {
        document.getElementById('content-input').value = document.getElementById('richTextEditor').innerHTML;
    }

    // Handle photo selection
    function handlePhotoSelect(event) {
        const files = Array.from(event.target.files);

        // Limit to 5 files
        if (uploadedPhotos.length + files.length > 5) {
            showToast('errorToast', 'Too many photos', 'You can only upload up to 5 photos');
            return;
        }

        // Check file sizes
        for (let file of files) {
            if (file.size > 5 * 1024 * 1024) {
                showToast('errorToast', 'File too large', `${file.name} exceeds 5MB limit`);
                return;
            }
        }

        // Add new files
        uploadedPhotos = [...uploadedPhotos, ...files];
        updatePhotoPreview();
    }

    // Update photo preview grid
    function updatePhotoPreview() {
        const previewGrid = document.getElementById('photo-preview-grid');
        previewGrid.innerHTML = '';

        uploadedPhotos.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'relative group';
                previewItem.innerHTML = `
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                        <img src="${e.target.result}" class="w-full h-full object-cover" alt="Preview ${index + 1}">
                    </div>
                    <button type="button" onclick="removePhoto(${index})" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-md hover:bg-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                previewGrid.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });

        // Add placeholder for remaining slots
        const remainingSlots = 5 - uploadedPhotos.length;
        for (let i = 0; i < remainingSlots; i++) {
            const placeholder = document.createElement('div');
            placeholder.className = 'aspect-square bg-gray-50 rounded-lg border-2 border-dashed border-gray-200 flex items-center justify-center';
            placeholder.innerHTML = `
                <span class="text-xs text-gray-400">Empty slot</span>
            `;
            previewGrid.appendChild(placeholder);
        }
    }

    // Remove photo
    function removePhoto(index) {
        uploadedPhotos.splice(index, 1);
        updatePhotoPreview();
    }

    // Handle video selection
    function handleVideoSelect(event) {
        const files = Array.from(event.target.files);

        // Limit to 3 files
        if (uploadedVideos.length + files.length > 3) {
            showToast('errorToast', 'Too many videos', 'You can only upload up to 3 videos');
            return;
        }

        // Check file sizes
        for (let file of files) {
            if (file.size > 50 * 1024 * 1024) {
                showToast('errorToast', 'File too large', `${file.name} exceeds 50MB limit`);
                return;
            }
        }

        // Add new files
        uploadedVideos = [...uploadedVideos, ...files];
        updateVideoPreview();
    }

    // Update video preview grid
    function updateVideoPreview() {
        const previewGrid = document.getElementById('video-preview-grid');
        previewGrid.innerHTML = '';

        uploadedVideos.forEach((file, index) => {
            const videoItem = document.createElement('div');
            videoItem.className = 'relative group';
            videoItem.innerHTML = `
                <div class="aspect-video bg-gray-900 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="absolute bottom-1 left-1 right-1">
                    <p class="text-xs text-white bg-black bg-opacity-50 px-1 py-0.5 rounded truncate">${file.name}</p>
                </div>
                <button type="button" onclick="removeVideo(${index})" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-md hover:bg-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
            previewGrid.appendChild(videoItem);
        });

        // Add placeholder for remaining slots
        const remainingSlots = 3 - uploadedVideos.length;
        for (let i = 0; i < remainingSlots; i++) {
            const placeholder = document.createElement('div');
            placeholder.className = 'aspect-video bg-gray-50 rounded-lg border-2 border-dashed border-gray-200 flex items-center justify-center';
            placeholder.innerHTML = `
                <span class="text-xs text-gray-400">Empty slot</span>
            `;
            previewGrid.appendChild(placeholder);
        }
    }

    // Remove video
    function removeVideo(index) {
        uploadedVideos.splice(index, 1);
        updateVideoPreview();
    }

    // Submit post
    function submitPost(status) {
        document.getElementById('status').value = status;
        
        // Validate required fields
        const category = document.getElementById('category_id').value;
        const title = document.getElementById('title').value;
        const content = document.getElementById('richTextEditor').innerHTML;

        if (!category) {
            showToast('errorToast', 'Category required', 'Please select a category');
            return;
        }

        if (!title) {
            showToast('errorToast', 'Title required', 'Please enter a title');
            return;
        }

        if (!content || content.trim() === '') {
            showToast('errorToast', 'Content required', 'Please write some content');
            return;
        }

        if (status === 'publish') {
            showPreviewModal();
        } else {
            savePost('draft');
        }
    }

    // Save post via AJAX
    function savePost(status) {
        const formData = new FormData(document.getElementById('postForm'));
        
        // Add content
        formData.set('content', document.getElementById('richTextEditor').innerHTML);
        
        // Add files
        uploadedPhotos.forEach((file, index) => {
            formData.append(`photos[${index}]`, file);
        });
        
        uploadedVideos.forEach((file, index) => {
            formData.append(`videos[${index}]`, file);
        });

        // Show loading state
        const publishBtn = document.querySelector('button[onclick*="publish"]');
        const draftBtn = document.querySelector('button[onclick*="draft"]');
        
        if (status === 'publish') {
            publishBtn.disabled = true;
            publishBtn.innerHTML = '<span class="animate-spin">⌛</span> Publishing...';
        } else {
            draftBtn.disabled = true;
            draftBtn.innerHTML = '<span class="animate-spin">⌛</span> Saving...';
        }

        fetch('{{ route("posts.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (status === 'publish') {
                    showToast('successToast', data.message, data.submessage);
                    setTimeout(() => {
                        window.location.href = '{{ route("allpost") }}';
                    }, 2000);
                } else {
                    showToast('draftToast', data.message, data.submessage);
                    // Update autosave indicator
                    document.getElementById('autosave-indicator').textContent = 'Draft saved at ' + new Date().toLocaleTimeString();
                }
            } else {
                showToast('errorToast', 'Error', data.message);
            }
        })
        .catch(error => {
            showToast('errorToast', 'Error', 'Failed to save post');
            console.error('Error:', error);
        })
        .finally(() => {
            if (status === 'publish') {
                publishBtn.disabled = false;
                publishBtn.innerHTML = 'Preview & Publish';
            } else {
                draftBtn.disabled = false;
                draftBtn.innerHTML = 'Save as Draft';
            }
        });
    }

    // Preview Modal functions
    function showPreviewModal() {
        // Update preview with current form values
        const categorySelect = document.getElementById('category_id');
        const selectedCategory = categorySelect.options[categorySelect.selectedIndex]?.text || 'Uncategorized';
        
        document.getElementById('previewCategory').textContent = selectedCategory;
        document.getElementById('previewTitle').textContent = document.getElementById('title').value || 'Untitled Post';
        document.getElementById('previewDescription').textContent = document.getElementById('description').value || 'No description provided';
        document.getElementById('previewContent').innerHTML = document.getElementById('richTextEditor').innerHTML || '<p>No content provided</p>';
        
        // Update photo preview in modal
        const photoGrid = document.getElementById('photoPreviewGrid');
        photoGrid.innerHTML = '';
        if (uploadedPhotos.length > 0) {
            uploadedPhotos.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const photoDiv = document.createElement('div');
                    photoDiv.className = 'aspect-square bg-gray-100 rounded-lg overflow-hidden';
                    photoDiv.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover" alt="Photo ${index + 1}">`;
                    photoGrid.appendChild(photoDiv);
                };
                reader.readAsDataURL(file);
            });
        } else {
            photoGrid.innerHTML = '<div class="col-span-3 text-center py-4 text-gray-500 text-sm">No photos attached</div>';
        }
        document.getElementById('photoCount').textContent = uploadedPhotos.length;

        // Update video preview in modal
        const videoGrid = document.getElementById('videoPreviewGrid');
        videoGrid.innerHTML = '';
        if (uploadedVideos.length > 0) {
            uploadedVideos.forEach((file, index) => {
                const videoDiv = document.createElement('div');
                videoDiv.className = 'aspect-video bg-gray-900 rounded-lg flex items-center justify-center relative';
                videoDiv.innerHTML = `
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="absolute bottom-1 left-1 text-xs text-white bg-black bg-opacity-50 px-1 py-0.5 rounded">${file.name}</span>
                `;
                videoGrid.appendChild(videoDiv);
            });
        } else {
            videoGrid.innerHTML = '<div class="col-span-2 text-center py-4 text-gray-500 text-sm">No videos attached</div>';
        }
        document.getElementById('videoCount').textContent = uploadedVideos.length;

        document.getElementById('previewModal').classList.remove('hidden');
        document.getElementById('previewModal').classList.add('flex');
    }

    function closePreviewModal() {
        document.getElementById('previewModal').classList.add('hidden');
        document.getElementById('previewModal').classList.remove('flex');
    }

    function confirmPublish() {
        closePreviewModal();
        savePost('publish');
    }

    // Cancel post
    function cancelPost() {
        if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
            window.location.href = '{{ route("allpost") }}';
        }
    }

    // Show toast
    function showToast(toastId, message, subMessage) {
        const toast = document.getElementById(toastId);
        
        if (toastId === 'successToast') {
            document.getElementById('toastMessage').textContent = message;
            document.getElementById('toastSubMessage').textContent = subMessage;
        } else if (toastId === 'errorToast') {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorSubMessage').textContent = subMessage;
        }

        toast.classList.remove('translate-y-24', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');

        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-24', 'opacity-0');
        }, 3000);
    }

    // Reset form
    function resetForm() {
        document.getElementById('postForm').reset();
        document.getElementById('richTextEditor').innerHTML = '';
        uploadedPhotos = [];
        uploadedVideos = [];
        updatePhotoPreview();
        updateVideoPreview();
        document.querySelector('.character-count').textContent = '0/255';
        document.querySelector('.description-count').textContent = '0/500';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('previewModal');
        if (event.target === modal) {
            closePreviewModal();
        }
    }

    // Auto-save every 30 seconds
    setInterval(() => {
        const title = document.getElementById('title').value;
        if (title) {
            savePost('draft');
        }
    }, 30000);

    // Update content input when editor changes
    document.getElementById('richTextEditor').addEventListener('input', updateContentInput);
    document.getElementById('richTextEditor').addEventListener('blur', updateContentInput);
</script>

<style>
    /* Custom styles for the rich text area */
    .prose {
        max-width: 65ch;
        line-height: 1.6;
    }

    .prose p {
        margin-bottom: 1em;
    }

    /* Smooth transitions */
    .transition-all {
        transition: all 0.2s ease;
    }

    /* Toast animations */
    #successToast,
    #draftToast,
    #errorToast {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    /* Rich text editor placeholder */
    #richTextEditor:empty:before {
        content: attr(placeholder);
        color: #9ca3af;
    }

    #richTextEditor:focus:empty:before {
        content: '';
    }

    /* Ensure textareas don't resize */
    textarea {
        resize: none;
    }

    /* Loading spinner */
    .animate-spin {
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

@endsection