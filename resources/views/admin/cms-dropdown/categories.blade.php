@extends('admin.layout')

@section('content')

<div class="space-y-6">
  <!-- Header -->
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-gray-800">Categories</h1>
    <p class="text-sm text-gray-500 bg-blue-50 px-3 py-1 rounded-full">
      <span class="font-medium text-blue-600">12</span> total categories
    </p>
  </div>

  <!-- Instructions for non-tech users -->
  <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
    <div class="flex items-start">
      <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div>
        <h3 class="text-sm font-medium text-blue-800">How to use Categories:</h3>
        <ul class="text-sm text-blue-700 mt-1 list-disc list-inside">
          <li>Add a new category using the form on the left</li>
          <li>Hover over any category in the table to see Edit and Trash options</li>
          <li>Use the search box to find specific categories</li>
          <li>The "Count" column shows how many posts are in each category</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Main Content: 2-Column Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Add Category Form -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
          <h2 class="font-semibold text-gray-700 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Category
          </h2>
        </div>

        <div class="p-4 space-y-4">
          <div class="categories">
            <label class="block text-sm font-medium text-gray-700 mb-1">Category Name <span class="text-red-500">*</span></label>
            <input type="text" placeholder="e.g., News, Events, Announcements" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
              <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              This will appear in the categories list and post editor
            </p>
          </div>

          <div class="categories-description">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-gray-400 text-xs">(optional)</span></label>
            <textarea placeholder="Brief description of this category..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none">
            </textarea>
            <p class="text-xs text-gray-500 mt-1">Help users understand what this category is for</p>
          </div>

          <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Category
          </button>

          <!-- Quick tip -->
          <div class="bg-yellow-50 p-3 rounded-lg mt-4">
            <p class="text-xs text-yellow-700 flex items-start gap-2">
              <svg class="w-4 h-4 text-yellow-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
              <span><strong>Tip:</strong> Use clear, descriptive names that readers will understand easily.</span>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column: Categories Table -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <!-- Table Toolbar -->
        <div class="p-4 border-b border-gray-200 bg-gray-50">
          <div class="flex flex-wrap items-center justify-between gap-4">
            <!-- Left side: Search and Bulk Actions -->
            <div class="flex flex-wrap items-center gap-3">
              <!-- Search -->
              <div class="flex items-center">
                <input type="text" placeholder="Search categories..." class="w-64 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                <button class="px-3 py-2 bg-gray-600 text-white rounded-r-lg hover:bg-gray-700 transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </button>
              </div>

              <!-- Bulk Actions Dropdown -->
              <div class="flex items-center gap-2">
                <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                  <option value="">Bulk Actions</option>
                  <option value="delete">Delete Selected</option>
                  <option value="merge">Merge Categories</option>
                </select>
                <button class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition-all">
                  Apply
                </button>
              </div>
            </div>

            <!-- Right side: Item Count -->
            <div class="text-sm text-gray-600 bg-white px-3 py-1.5 rounded-lg border border-gray-200">
              <span class="font-medium text-gray-800">12</span> items
            </div>
          </div>
        </div>

        <!-- Categories Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-10">
                  <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </th>
                <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Count</th>
              </tr>
            </thead>
            <tbody>
              <!-- Category 1 -->
              <tr class="hover:bg-gray-50 transition-colors group relative">
                <td class="py-3 px-4 border-b border-gray-200">
                  <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <div>
                    <span class="font-medium text-gray-800">News</span>
                    <!-- Quick links appear on hover -->
                    <div class="flex items-center gap-2 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                      <a href="#" class="text-blue-600 hover:text-blue-800 text-xs flex items-center gap-1" onclick="editCategory(1)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Quick Edit
                      </a>
                      <span class="text-gray-300">|</span>
                      <a href="#" class="text-red-600 hover:text-red-800 text-xs flex items-center gap-1" onclick="trashCategory(1)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Trash
                      </a>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">
                  Latest updates and announcements from the barangay
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">8 posts</span>
                </td>
              </tr>

              <!-- Category 2 -->
              <tr class="hover:bg-gray-50 transition-colors group relative">
                <td class="py-3 px-4 border-b border-gray-200">
                  <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <div>
                    <span class="font-medium text-gray-800">Events</span>
                    <!-- Quick links appear on hover -->
                    <div class="flex items-center gap-2 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                      <a href="#" class="text-blue-600 hover:text-blue-800 text-xs flex items-center gap-1" onclick="editCategory(2)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Quick Edit
                      </a>
                      <span class="text-gray-300">|</span>
                      <a href="#" class="text-red-600 hover:text-red-800 text-xs flex items-center gap-1" onclick="trashCategory(2)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Trash
                      </a>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">
                  Upcoming barangay events and community activities
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">5 posts</span>
                </td>
              </tr>

              <!-- Category 3 -->
              <tr class="hover:bg-gray-50 transition-colors group relative">
                <td class="py-3 px-4 border-b border-gray-200">
                  <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <div>
                    <span class="font-medium text-gray-800">Announcements</span>
                    <!-- Quick links appear on hover -->
                    <div class="flex items-center gap-2 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                      <a href="#" class="text-blue-600 hover:text-blue-800 text-xs flex items-center gap-1" onclick="editCategory(3)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Quick Edit
                      </a>
                      <span class="text-gray-300">|</span>
                      <a href="#" class="text-red-600 hover:text-red-800 text-xs flex items-center gap-1" onclick="trashCategory(3)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Trash
                      </a>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">
                  Important announcements and reminders for residents
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">3 posts</span>
                </td>
              </tr>

              <!-- Category 4 -->
              <tr class="hover:bg-gray-50 transition-colors group relative">
                <td class="py-3 px-4 border-b border-gray-200">
                  <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <div>
                    <span class="font-medium text-gray-800">Services</span>
                    <!-- Quick links appear on hover -->
                    <div class="flex items-center gap-2 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                      <a href="#" class="text-blue-600 hover:text-blue-800 text-xs flex items-center gap-1" onclick="editCategory(4)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Quick Edit
                      </a>
                      <span class="text-gray-300">|</span>
                      <a href="#" class="text-red-600 hover:text-red-800 text-xs flex items-center gap-1" onclick="trashCategory(4)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Trash
                      </a>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">
                  Information about barangay services and requirements
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">2 posts</span>
                </td>
              </tr>

              <!-- Category 5 -->
              <tr class="hover:bg-gray-50 transition-colors group relative">
                <td class="py-3 px-4 border-b border-gray-200">
                  <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <div>
                    <span class="font-medium text-gray-800">Projects</span>
                    <!-- Quick links appear on hover -->
                    <div class="flex items-center gap-2 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                      <a href="#" class="text-blue-600 hover:text-blue-800 text-xs flex items-center gap-1" onclick="editCategory(5)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Quick Edit
                      </a>
                      <span class="text-gray-300">|</span>
                      <a href="#" class="text-red-600 hover:text-red-800 text-xs flex items-center gap-1" onclick="trashCategory(5)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Trash
                      </a>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">
                  Updates on ongoing and completed barangay projects
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">1 post</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
          <span class="text-sm text-gray-600">Showing <span class="font-medium">1-5</span> of <span class="font-medium">12</span> categories</span>
          <div class="flex gap-2">
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all" disabled>Previous</button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm">1</button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">2</button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">3</button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">Next</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Additional User-Friendly Notes -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
          <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-800">Adding Categories</h4>
          <p class="text-xs text-gray-500">Fill in the name and description, then click "Add Category"</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
          <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-800">Editing Categories</h4>
          <p class="text-xs text-gray-500">Hover over a category and click "Quick Edit" to make changes</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
          <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-800">Deleting Categories</h4>
          <p class="text-xs text-gray-500">Hover and click "Trash" to remove. Posts won't be deleted, just uncategorized</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Quick link functions
  function editCategory(id) {
    alert(`Edit category ${id} - You can rename or change the description`);
  }

  function trashCategory(id) {
    if (confirm(`Are you sure you want to move this category to trash?`)) {
      alert(`Category ${id} moved to trash`);
    }
  }
</script>

@endsection