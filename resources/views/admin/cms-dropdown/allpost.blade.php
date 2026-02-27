@extends('admin.layout')

@section('content')

<div class="space-y-6">
  <!-- Header Section -->
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-gray-800">Posts</h1>
    <a href="{{ route('cms-dropdown.addpost') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all shadow-sm">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Post
    </a>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-4 gap-4" id="stat">
    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <span class="text-xs text-gray-500 uppercase tracking-wider">All Posts</span>
      <div class="text-2xl font-bold text-gray-800">12</div>
    </div>
    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <span class="text-xs text-gray-500 uppercase tracking-wider">Published</span>
      <div class="text-2xl font-bold text-green-600">8</div>
    </div>
    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <span class="text-xs text-gray-500 uppercase tracking-wider">Drafts</span>
      <div class="text-2xl font-bold text-yellow-600">3</div>
    </div>
    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <span class="text-xs text-gray-500 uppercase tracking-wider">Trash</span>
      <div class="text-2xl font-bold text-gray-500">1</div>
    </div>
  </div>

  <!-- Filters and Search Bar -->
  <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm space-y-4">
    <!-- Top row with bulk actions and filters -->
    <div class="flex flex-wrap items-center gap-4" id="filters-dropdown">
      <!-- Bulk Actions Dropdown -->
      <div class="flex items-center gap-2">
        <select id="bulk-actions-dropdown" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
          <option value="">Bulk Actions</option>
          <option value="edit">Edit</option>
          <option value="trash">Move to Trash</option>
          <option value="publish">Publish</option>
          <option value="draft">Move to Draft</option>
        </select>
        <button id="bulk-actions-btn" class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition-all">
          Apply
        </button>
      </div>

      <!-- Date Filter -->
      <select id="all-dates-dropdown-filter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
        <option value="">All Dates</option>
        <option value="feb2026">February 2026</option>
        <option value="jan2026">January 2026</option>
        <option value="dec2025">December 2025</option>
      </select>

      <!-- Categories Filter -->
      <select id="categories-dropdown-filter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
        <option value="">All Categories</option>
        <option value="news">News</option>
        <option value="announcements">Announcements</option>
        <option value="events">Events</option>
        <option value="guides">Guides</option>
      </select>

      <!-- Search Bar - moved to right using margin-left auto -->
      <div class="flex-1 flex justify-end">
        <div class="flex items-center max-w-md w-full">
          <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Search posts...">
          <button class="px-4 py-2 bg-blue-600 text-white rounded-r-lg text-sm font-medium hover:bg-blue-700 transition-all flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search
          </button>
        </div>
      </div>
    </div>

    <!-- Items count -->
    <div class="flex items-center justify-between border-t border-gray-100 pt-3" id="item-count">
      <span class="text-sm text-gray-500">Showing <span class="font-medium text-gray-700">1-3</span> of <span class="font-medium text-gray-700">12</span> posts</span>
      <span class="text-sm text-gray-500">Items per page: 10</span>
    </div>
  </div>

  <!-- Posts Table -->
  <div class="table-allposts overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
    <table class="min-w-full">
      <thead class="bg-gray-50">
        <tr>
          <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-10">
            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" onchange="toggleAllCheckboxes(this)">
          </th>
          <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
          <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Author</th>
          <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Categories</th>
          <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tags</th>
          <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date Published</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example row 1 -->
        <tr class="hover:bg-gray-50 transition-colors group relative">
          <td class="py-3 px-4 border-b border-gray-200">
            <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="1">
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div>
              <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Sample Post Title 1</a>
              <!-- Quick links appear on hover -->
              <div class="flex items-center gap-3 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-xs">
                <a href="#" class="text-blue-600 hover:text-blue-800 flex items-center gap-1" onclick="editPost(1)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                  Edit
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-green-600 hover:text-green-800 flex items-center gap-1" onclick="quickEdit(1)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
                  Quick Edit
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center gap-1" onclick="trashPost(1)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  Trash
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-purple-600 hover:text-purple-800 flex items-center gap-1" onclick="previewPost(1)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  Preview
                </a>
              </div>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex items-center gap-2">
              <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center text-xs font-medium text-gray-700">JD</div>
              <span class="text-sm text-gray-700">John Doe</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex flex-wrap gap-1">
              <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs">News</span>
              <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">Announcements</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex flex-wrap gap-1">
              <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full text-xs">important</span>
              <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full text-xs">update</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">Feb 20, 2026</td>
        </tr>

        <!-- Example row 2 -->
        <tr class="hover:bg-gray-50 transition-colors group relative">
          <td class="py-3 px-4 border-b border-gray-200">
            <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="2">
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div>
              <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">How to Apply for Barangay Clearance</a>
              <!-- Quick links appear on hover -->
              <div class="flex items-center gap-3 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-xs">
                <a href="#" class="text-blue-600 hover:text-blue-800 flex items-center gap-1" onclick="editPost(2)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                  Edit
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-green-600 hover:text-green-800 flex items-center gap-1" onclick="quickEdit(2)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
                  Quick Edit
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center gap-1" onclick="trashPost(2)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  Trash
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-purple-600 hover:text-purple-800 flex items-center gap-1" onclick="previewPost(2)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  Preview
                </a>
              </div>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex items-center gap-2">
              <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center text-xs font-medium text-gray-700">JS</div>
              <span class="text-sm text-gray-700">Jane Smith</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex flex-wrap gap-1">
              <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs">Guides</span>
              <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">Services</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex flex-wrap gap-1">
              <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full text-xs">tutorial</span>
              <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full text-xs">requirements</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">Feb 19, 2026</td>
        </tr>

        <!-- Example row 3 with Published status indicator -->
        <tr class="hover:bg-gray-50 transition-colors group relative">
          <td class="py-3 px-4 border-b border-gray-200">
            <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="3">
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div>
              <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Barangay Assembly 2026 Schedule</a>
              </div>
              <!-- Quick links appear on hover -->
              <div class="flex items-center gap-3 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-xs">
                <a href="#" class="text-blue-600 hover:text-blue-800 flex items-center gap-1" onclick="editPost(3)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                  Edit
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-green-600 hover:text-green-800 flex items-center gap-1" onclick="quickEdit(3)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
                  Quick Edit
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center gap-1" onclick="trashPost(3)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  Trash
                </a>
                <span class="text-gray-300">|</span>
                <a href="#" class="text-purple-600 hover:text-purple-800 flex items-center gap-1" onclick="previewPost(3)">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  Preview
                </a>
              </div>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex items-center gap-2">
              <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center text-xs font-medium text-gray-700">AS</div>
              <span class="text-sm text-gray-700">Admin Staff</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex flex-wrap gap-1">
              <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs">Events</span>
              <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">Announcements</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200">
            <div class="flex flex-wrap gap-1">
              <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full text-xs">assembly</span>
              <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full text-xs">schedule</span>
            </div>
          </td>
          <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">Feb 18, 2026</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Bulk Actions Bar -->
  <div class="mt-4 flex items-center gap-3 bg-white p-3 rounded-lg border border-gray-200 shadow-sm" id="bulkActionsBar" style="display: none;">
    <span class="text-sm text-gray-600">
      <span id="selectedCount">0</span> item(s) selected
    </span>
    <div class="flex gap-2">
      <button class="px-3 py-1.5 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition-all flex items-center gap-1" onclick="bulkDelete()">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        Delete Selected
      </button>
      <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all flex items-center gap-1" onclick="bulkArchive()">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
        </svg>
        Archive Selected
      </button>
    </div>
  </div>

  <!-- Pagination -->
  <div class="flex items-center justify-between">
    <span class="text-sm text-gray-600">Showing 1 to 3 of 12 posts</span>
    <div class="flex gap-2">
      <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-all" disabled>Previous</button>
      <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm">1</button>
      <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-all">2</button>
      <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-all">3</button>
      <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-all">Next</button>
    </div>
  </div>
</div>

<script>
  // Quick link functions
  function editPost(id) {
    console.log('Editing post:', id);
    alert(`Edit post ${id} - Redirect to edit page`);
    // window.location.href = `/admin/posts/${id}/edit`;
  }

  function quickEdit(id) {
    console.log('Quick editing post:', id);
    alert(`Quick edit post ${id} - Open modal for quick edits`);
    // Open modal for quick editing
  }

  function trashPost(id) {
    if (confirm(`Are you sure you want to move post ${id} to trash?`)) {
      console.log('Moving to trash:', id);
      alert(`Post ${id} moved to trash`);
    }
  }

  function previewPost(id) {
    console.log('Previewing post:', id);
    alert(`Preview post ${id} - Open in new tab`);
    // window.open(`/posts/${id}/preview`, '_blank');
  }

  // Toggle all checkboxes
  function toggleAllCheckboxes(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(checkbox => {
      checkbox.checked = selectAllCheckbox.checked;
    });
    updateBulkActionsBar();
  }

  // Update bulk actions bar visibility and count
  function updateBulkActionsBar() {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
    const bulkActionsBar = document.getElementById('bulkActionsBar');
    const selectedCountSpan = document.getElementById('selectedCount');

    if (checkedCount > 0) {
      bulkActionsBar.style.display = 'flex';
      selectedCountSpan.textContent = checkedCount;
    } else {
      bulkActionsBar.style.display = 'none';
    }

    // Update "Select All" checkbox state
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
      selectAllCheckbox.checked = checkedCount === checkboxes.length;
      selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
    }
  }

  // Add event listeners to all row checkboxes
  document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', updateBulkActionsBar);
    });
  });

  // Bulk delete function
  function bulkDelete() {
    const selectedIds = [];
    document.querySelectorAll('.row-checkbox:checked').forEach(checkbox => {
      selectedIds.push(checkbox.value);
    });

    if (selectedIds.length > 0) {
      if (confirm(`Are you sure you want to delete ${selectedIds.length} selected post(s)?`)) {
        console.log('Deleting posts:', selectedIds);
        alert(`Deleting ${selectedIds.length} post(s)`);
      }
    }
  }

  // Bulk archive function
  function bulkArchive() {
    const selectedIds = [];
    document.querySelectorAll('.row-checkbox:checked').forEach(checkbox => {
      selectedIds.push(checkbox.value);
    });

    if (selectedIds.length > 0) {
      if (confirm(`Are you sure you want to archive ${selectedIds.length} selected post(s)?`)) {
        console.log('Archiving posts:', selectedIds);
        alert(`Archiving ${selectedIds.length} post(s)`);
      }
    }
  }
</script>

@endsection