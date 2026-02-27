@extends('admin.layout')

@section('content')

<div class="space-y-6">
  <!-- Header -->
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-gray-800">Media Library</h1>
    <button onclick="uploadMedia()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all shadow-sm">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
      </svg>
      Upload Media
    </button>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Total Files</p>
          <p class="text-2xl font-bold text-gray-800">156</p>
        </div>
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
          </svg>
        </div>
      </div>
      <p class="text-xs text-gray-500 mt-2">2.4 GB used of 10 GB</p>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Images</p>
          <p class="text-2xl font-bold text-gray-800">98</p>
        </div>
        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Videos</p>
          <p class="text-2xl font-bold text-gray-800">23</p>
        </div>
        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Documents</p>
          <p class="text-2xl font-bold text-gray-800">35</p>
        </div>
        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Toolbar -->
  <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-4 border-b border-gray-200 bg-gray-50">
      <div class="flex flex-wrap items-center justify-between gap-4">
        <!-- Left side: Bulk Actions and Filter -->
        <div class="flex flex-wrap items-center gap-3">
          <!-- Bulk Actions Dropdown -->
          <div class="flex items-center gap-2" id="dropdown-bulk-actions">
            <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white min-w-[140px]">
              <option value="">Bulk Actions</option>
              <option value="delete">Delete Selected</option>
              <option value="download">Download Selected</option>
              <option value="move">Move to Folder</option>
            </select>
            <button class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition-all">
              Apply
            </button>
          </div>

          <!-- Filter Dropdown -->
          <div class="" id="dropdown-filter">
            <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white min-w-[140px]">
              <option value="">All Media</option>
              <option value="images">Images (98)</option>
              <option value="videos">Videos (23)</option>
              <option value="documents">Documents (35)</option>
            </select>
          </div>

          <!-- Search -->
          <div class="flex items-center">
            <input type="text" placeholder="Search media files..." class="w-64 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            <button class="px-3 py-2 bg-gray-600 text-white rounded-r-lg hover:bg-gray-700 transition-all">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Right side: View Toggle and Item Count -->
        <div class="flex items-center gap-3">
          <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
            <button class="p-2 bg-blue-600 text-white">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
              </svg>
            </button>
            <button class="p-2 bg-white hover:bg-gray-50">
              <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
              </svg>
            </button>
          </div>
          <span class="text-sm text-gray-600 bg-white px-3 py-1.5 rounded-lg border border-gray-200">
            <span class="font-medium">24</span> items
          </span>
        </div>
      </div>
    </div>

    <!-- Media Grid -->
    <div class="p-4" id="grid">
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <!-- Image Item 1 -->
        <div class="group relative bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-all cursor-pointer">
          <div class="absolute top-2 left-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
          </div>
          <div class="aspect-square bg-gray-100 relative">
            <img src="https://via.placeholder.com/150" alt="Media" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all"></div>
            
            <!-- Quick Actions on Hover -->
            <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
              <button onclick="previewMedia(1)" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-blue-600 hover:text-white transition-all" title="Preview">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </button>
              <button onclick="downloadMedia(1)" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-blue-600 hover:text-white transition-all" title="Download">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
              </button>
            </div>
          </div>
          <div class="p-2">
            <p class="text-xs font-medium text-gray-800 truncate">beach-sunset.jpg</p>
            <p class="text-xs text-gray-500">2.4 MB</p>
          </div>
        </div>

        <!-- Image Item 2 -->
        <div class="group relative bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-all cursor-pointer">
          <div class="absolute top-2 left-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
          </div>
          <div class="aspect-square bg-gray-100 relative">
            <img src="https://via.placeholder.com/150" alt="Media" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all"></div>
            <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
              <button onclick="previewMedia(2)" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-blue-600 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </button>
              <button onclick="downloadMedia(2)" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-blue-600 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
              </button>
            </div>
          </div>
          <div class="p-2">
            <p class="text-xs font-medium text-gray-800 truncate">mountain-landscape.jpg</p>
            <p class="text-xs text-gray-500">3.1 MB</p>
          </div>
        </div>

        <!-- Video Item -->
        <div class="group relative bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-all cursor-pointer">
          <div class="absolute top-2 left-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
          </div>
          <div class="aspect-square bg-gray-900 relative flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="absolute bottom-2 left-2 text-xs text-white bg-black bg-opacity-50 px-1.5 py-0.5 rounded">2:34</span>
            <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
              <button onclick="previewMedia(3)" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-blue-600 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </button>
            </div>
          </div>
          <div class="p-2">
            <p class="text-xs font-medium text-gray-800 truncate">barangay-meeting.mp4</p>
            <p class="text-xs text-gray-500">15.2 MB</p>
          </div>
        </div>

        <!-- Document Item -->
        <div class="group relative bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-all cursor-pointer">
          <div class="absolute top-2 left-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
          </div>
          <div class="aspect-square bg-yellow-50 relative flex items-center justify-center">
            <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
              <button onclick="previewMedia(4)" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-blue-600 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </button>
              <button onclick="downloadMedia(4)" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-blue-600 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
              </button>
            </div>
          </div>
          <div class="p-2">
            <p class="text-xs font-medium text-gray-800 truncate">annual-report-2025.pdf</p>
            <p class="text-xs text-gray-500">1.8 MB</p>
          </div>
        </div>

        <!-- Add more items as needed -->
        <!-- Repeat similar structure for more media items -->
      </div>
    </div>

    <!-- Pagination -->
    <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
      <span class="text-sm text-gray-600">Showing <span class="font-medium">1-8</span> of <span class="font-medium">24</span> items</span>
      <div class="flex gap-2">
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all" disabled>Previous</button>
        <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm">1</button>
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">2</button>
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">3</button>
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">Next</button>
      </div>
    </div>
  </div>

  <!-- Quick Tips -->
  <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
    <div class="flex items-start">
      <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div>
        <h3 class="text-sm font-medium text-blue-800">Media Library Tips:</h3>
        <ul class="text-sm text-blue-700 mt-1 list-disc list-inside">
          <li>Hover over any media item to see quick actions (Preview, Download)</li>
          <li>Check the box to select items for bulk operations</li>
          <li>Use filters to show only Images, Videos, or Documents</li>
          <li>Click on any media to view detailed information</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 hidden items-center justify-center">
  <div class="bg-white rounded-xl w-11/12 max-w-3xl max-h-[90vh] overflow-y-auto">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 sticky top-0 bg-white">
      <h3 class="text-lg font-semibold text-gray-800">Media Preview</h3>
      <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="p-6">
      <div class="aspect-video bg-gray-100 rounded-lg mb-4 flex items-center justify-center">
        <img src="https://via.placeholder.com/800x400" alt="Preview" class="max-w-full max-h-full object-contain">
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <p class="text-xs text-gray-500">Filename</p>
          <p class="text-sm font-medium">beach-sunset.jpg</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">File Size</p>
          <p class="text-sm font-medium">2.4 MB</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Dimensions</p>
          <p class="text-sm font-medium">1920 x 1080</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Uploaded On</p>
          <p class="text-sm font-medium">Feb 25, 2026</p>
        </div>
      </div>
    </div>
    <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200">
      <button onclick="downloadCurrentFile()" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Download
      </button>
      <button onclick="closePreviewModal()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
        Close
      </button>
    </div>
  </div>
</div>

<script>
  // Upload Media
  function uploadMedia() {
    // Create a hidden file input
    const input = document.createElement('input');
    input.type = 'file';
    input.multiple = true;
    input.accept = 'image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx';
    input.onchange = function(e) {
      const files = Array.from(e.target.files);
      alert(`Uploading ${files.length} file(s)...`);
      // Here you would normally upload to server
    };
    input.click();
  }

  // Preview Media
  function previewMedia(id) {
    document.getElementById('previewModal').classList.remove('hidden');
    document.getElementById('previewModal').classList.add('flex');
  }

  // Close Preview Modal
  function closePreviewModal() {
    document.getElementById('previewModal').classList.add('hidden');
    document.getElementById('previewModal').classList.remove('flex');
  }

  // Download Media
  function downloadMedia(id) {
    alert(`Downloading file ${id}...`);
  }

  // Download from preview
  function downloadCurrentFile() {
    alert('Downloading file...');
    closePreviewModal();
  }

  // Close modal when clicking outside
  window.onclick = function(event) {
    const modal = document.getElementById('previewModal');
    if (event.target === modal) {
      closePreviewModal();
    }
  }
</script>

@endsection