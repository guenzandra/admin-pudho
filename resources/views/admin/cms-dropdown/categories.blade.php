@extends('admin.layout')

@section('content')

<div class="space-y-6">
  <!-- Header -->
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-gray-800">Categories</h1>
    <p class="text-sm text-gray-500 bg-gray-50 px-3 py-1 rounded-full border border-gray-200">
      <span class="font-medium text-blue-500">{{ $totalCategories }}</span> total categories
    </p>
  </div>

  <!-- Toast Container -->
  <div id="toastContainer" class="fixed top-4 right-4 z-[100] space-y-2"></div>

  <!-- Success/Error Messages (Converted to toasts on page load) -->
  @if(session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        showToast('{{ session('success') }}', 'success');
      });
    </script>
  @endif

  @if(session('error'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        showToast('{{ session('error') }}', 'error');
      });
    </script>
  @endif

  <!-- Floating Help Panel -->
  <div id="helpPanel" class="fixed bottom-6 right-6 z-[60] w-80 bg-white rounded-xl shadow-2xl border border-gray-200 transform transition-all duration-300 translate-y-2 opacity-0 invisible">
    <!-- Panel Header -->
    <div class="flex items-center justify-between p-4 border-b border-gray-100">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center">
          <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <span class="font-medium text-gray-700">How to use Categories</span>
      </div>
      <button onclick="toggleHelpPanel()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Panel Content -->
    <div class="p-4 space-y-3 max-h-96 overflow-y-auto">
      <!-- Add Category -->
      <div class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
          <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-700">Add Category</h4>
          <p class="text-xs text-gray-500">Fill out the form on the left and click "Add Category"</p>
        </div>
      </div>

      <!-- Edit Category -->
      <div class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
          <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-700">Edit Category</h4>
          <p class="text-xs text-gray-500">Hover over a category and click "Quick Edit"</p>
        </div>
      </div>

      <!-- Delete Category -->
      <div class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
          <svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-700">Delete Category</h4>
          <p class="text-xs text-gray-500">Hover over a category and click "Delete"</p>
        </div>
      </div>

      <!-- Search -->
      <div class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
        <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
          <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-700">Search</h4>
          <p class="text-xs text-gray-500">Type in the search box to filter categories in real-time</p>
        </div>
      </div>

      <!-- Bulk Actions -->
      <div class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
        <div class="w-6 h-6 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
          <svg class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-700">Bulk Actions</h4>
          <p class="text-xs text-gray-500">Select multiple categories and choose an action</p>
        </div>
      </div>

      <!-- Pagination -->
      <div class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
        <div class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
          <svg class="w-3 h-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </div>
        <div>
          <h4 class="text-sm font-medium text-gray-700">Pagination</h4>
          <p class="text-xs text-gray-500">4 categories per page. Use the buttons below to navigate</p>
        </div>
      </div>
    </div>

    <!-- Panel Footer -->
    <div class="p-3 border-t border-gray-100 bg-gray-50 rounded-b-xl">
      <p class="text-xs text-gray-500 text-center">
        <span class="font-medium text-blue-500">{{ $totalCategories }}</span> categories total
      </p>
    </div>
  </div>

  <!-- Help Toggle Button -->
  <button id="helpToggle" onclick="toggleHelpPanel()" class="fixed bottom-6 right-6 z-[60] w-12 h-12 bg-white border border-gray-200 rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition-all hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-400">
    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  </button>

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

        <form action="{{ route('categories.store') }}" method="POST" class="p-4 space-y-4" id="addCategoryForm">
          @csrf
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category Name <span class="text-blue-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., News, Events, Announcements" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('name') border-red-500 @enderror">
            @error('name')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
              <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              This will appear in the categories list and post editor
            </p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-gray-400 text-xs">(optional)</span></label>
            <textarea name="description" placeholder="Brief description of this category..." 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-1">Help users understand what this category is for</p>
          </div>

          <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all flex items-center justify-center gap-2" id="submitCategoryBtn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Add Category</span>
            <div class="hidden" id="submitSpinner">
              <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </div>
          </button>

          <!-- Quick tip - minimalist -->
          <div class="bg-blue-50 p-3 rounded-lg mt-4 border border-blue-100">
            <p class="text-xs text-blue-700 flex items-start gap-2">
              <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
              <span><strong>Tip:</strong> Use clear, descriptive names</span>
            </p>
          </div>
        </form>
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
              <!-- Search with real-time trigger -->
              <div class="flex items-center">
                <input type="text" id="searchInput" placeholder="Search categories..." 
                       class="w-64 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                <button id="searchButton" class="px-3 py-2 bg-gray-600 text-white rounded-r-lg hover:bg-gray-700 transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </button>
              </div>

              <!-- Bulk Actions Dropdown -->
              <form id="bulkActionForm" action="{{ route('categories.bulk-delete') }}" method="POST" class="flex items-center gap-2">
                @csrf
                <input type="hidden" name="category_ids" id="selectedCategories">
                <select id="bulkAction" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                  <option value="">Bulk Actions</option>
                  <option value="delete">Delete Selected</option>
                </select>
                <button type="button" id="applyBulkAction" class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition-all">
                  Apply
                </button>
              </form>
            </div>

            <!-- Right side: Item Count -->
            <div class="text-sm text-gray-600 bg-white px-3 py-1.5 rounded-lg border border-gray-200">
              <span class="font-medium text-blue-500" id="visibleCount">{{ $categories->count() }}</span> / <span class="font-medium text-blue-500">{{ $totalCategories }}</span> items
            </div>
          </div>
        </div>

        <!-- Categories Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full" id="categoriesTable">
            <thead class="bg-gray-50">
              <tr>
                <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-10">
                  <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                </th>
                <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Posts</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              @forelse($categories as $category)
              <tr class="hover:bg-gray-50 transition-colors group relative category-row" data-category-id="{{ $category->id }}">
                <td class="py-3 px-4 border-b border-gray-200">
                  <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-500 focus:ring-blue-500" value="{{ $category->id }}">
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <div>
                    <span class="font-medium text-gray-800">{{ $category->name }}</span>
                    <!-- Quick links appear on hover -->
                    <div class="flex items-center gap-2 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                      <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')" class="text-gray-600 hover:text-blue-500 text-xs flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Quick Edit
                      </button>
                      <span class="text-gray-300">|</span>
                      <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-category-btn text-gray-600 hover:text-red-500 text-xs flex items-center gap-1">
                          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                          Delete
                        </button>
                      </form>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-600">
                  {{ $category->description ?? 'No description' }}
                </td>
                <td class="py-3 px-4 border-b border-gray-200">
                  <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-medium">
                    {{ $category->posts_count ?? 0 }} {{ Str::plural('post', $category->posts_count ?? 0) }}
                  </span>
                </td>
              </tr>
              @empty
              <tr id="emptyRow">
                <td colspan="4" class="py-8 text-center text-gray-500">
                  <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                  </svg>
                  <p class="text-lg font-medium">No categories yet</p>
                  <p class="text-sm">Create your first category using the form on the left.</p>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
        <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
          <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">
              Showing <span class="font-medium">{{ $categories->firstItem() }}</span> to <span class="font-medium">{{ $categories->lastItem() }}</span> of <span class="font-medium">{{ $totalCategories }}</span> categories
            </div>
            <div class="flex gap-2">
              @if($categories->onFirstPage())
                <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded-md text-sm cursor-not-allowed">Previous</span>
              @else
                <a href="{{ $categories->previousPageUrl() }}" class="px-3 py-1 bg-white border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50 transition-colors">Previous</a>
              @endif

              @foreach($categories->getUrlRange(max(1, $categories->currentPage() - 2), min($categories->lastPage(), $categories->currentPage() + 2)) as $page => $url)
                <a href="{{ $url }}" class="px-3 py-1 {{ $page == $categories->currentPage() ? 'bg-blue-500 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }} rounded-md text-sm transition-colors">{{ $page }}</a>
              @endforeach

              @if($categories->hasMorePages())
                <a href="{{ $categories->nextPageUrl() }}" class="px-3 py-1 bg-white border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50 transition-colors">Next</a>
              @else
                <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded-md text-sm cursor-not-allowed">Next</span>
              @endif
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Edit Category Modal -->
  <div id="editModal" class="fixed inset-0 w-full h-full overflow-y-auto z-[70]" style="display: none;">
    <!-- Modal Backdrop -->
    <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm"></div>
    
    <!-- Modal Container -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
      <div class="relative bg-white rounded-xl shadow-2xl max-w-md w-full mx-auto border border-gray-200 transform transition-all z-[71]">
        <!-- Loading Overlay -->
        <div id="modalLoading" class="hidden absolute inset-0 bg-white/90 rounded-xl flex items-center justify-center z-[72]">
          <div class="flex flex-col items-center">
            <svg class="animate-spin h-8 w-8 text-blue-500 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-sm text-gray-600">Updating category...</span>
          </div>
        </div>

        <!-- Modal Header -->
        <div class="flex items-center justify-between p-5 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Edit Category</h3>
          <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Modal Body -->
        <div class="p-5">
          <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
              <input type="text" id="edit_name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
              <textarea id="edit_description" name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div class="flex justify-end gap-2">
              <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">Cancel</button>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors" id="updateCategoryBtn">
                Update Category
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="fixed inset-0 w-full h-full overflow-y-auto z-[70]" style="display: none;">
    <!-- Modal Backdrop -->
    <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm"></div>
    
    <!-- Modal Container -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
      <div class="relative bg-white rounded-xl shadow-2xl max-w-md w-full mx-auto border border-gray-200 z-[71]">
        <div class="p-5 text-center">
          <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-50 mb-4">
            <svg class="h-8 w-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Confirm Delete</h3>
          <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this category? This action cannot be undone.</p>
          <div class="flex justify-center gap-3">
            <button onclick="closeDeleteModal()" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">Cancel</button>
            <button id="confirmDeleteBtn" class="px-6 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition-colors">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Real-time search trigger
  let searchTimeout;
  const searchInput = document.getElementById('searchInput');
  
  function performSearch() {
    const searchTerm = searchInput.value.toLowerCase();
    const rows = document.querySelectorAll('#categoriesTable tbody tr.category-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
      const categoryName = row.cells[1].textContent.toLowerCase();
      const description = row.cells[2].textContent.toLowerCase();
      
      if (categoryName.includes(searchTerm) || description.includes(searchTerm)) {
        row.style.display = '';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });
    
    // Update visible count
    document.getElementById('visibleCount').textContent = visibleCount;
    
    // Show empty state if no results
    const emptyRow = document.getElementById('emptyRow');
    if (emptyRow) {
      if (visibleCount === 0 && rows.length > 0) {
        if (!document.getElementById('noResultsRow')) {
          const tbody = document.getElementById('tableBody');
          const noResultsRow = document.createElement('tr');
          noResultsRow.id = 'noResultsRow';
          noResultsRow.innerHTML = `
            <td colspan="4" class="py-8 text-center text-gray-500">
              <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              <p class="text-lg font-medium">No categories found</p>
              <p class="text-sm">Try adjusting your search term</p>
            </td>
          `;
          tbody.appendChild(noResultsRow);
        }
      } else {
        const noResultsRow = document.getElementById('noResultsRow');
        if (noResultsRow) {
          noResultsRow.remove();
        }
      }
    }
  }

  // Trigger search on input with debounce
  searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(performSearch, 300);
  });

  // Search button click
  document.getElementById('searchButton').addEventListener('click', performSearch);

  // Enter key for search
  searchInput.addEventListener('keyup', function(e) {
    if (e.key === 'Enter') {
      clearTimeout(searchTimeout);
      performSearch();
    }
  });

  // Help Panel Toggle
  function toggleHelpPanel() {
    const panel = document.getElementById('helpPanel');
    const button = document.getElementById('helpToggle');
    
    if (panel.classList.contains('invisible')) {
      panel.classList.remove('invisible', 'opacity-0', 'translate-y-2');
      panel.classList.add('opacity-100', 'translate-y-0', 'visible');
      button.classList.add('rotate-90');
    } else {
      panel.classList.add('opacity-0', 'translate-y-2', 'invisible');
      panel.classList.remove('opacity-100', 'translate-y-0', 'visible');
      button.classList.remove('rotate-90');
    }
  }

  // Close panel when clicking outside
  document.addEventListener('click', function(event) {
    const panel = document.getElementById('helpPanel');
    const button = document.getElementById('helpToggle');
    
    if (!panel.contains(event.target) && !button.contains(event.target) && !panel.classList.contains('invisible')) {
      toggleHelpPanel();
    }
  });

  // Toast notification system
  function showToast(message, type = 'success') {
    const toastContainer = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    
    const bgColor = type === 'success' ? 'bg-green-50 border-green-400' : 'bg-red-50 border-red-400';
    const textColor = type === 'success' ? 'text-green-700' : 'text-red-700';
    const iconColor = type === 'success' ? 'text-green-500' : 'text-red-400';
    const icon = type === 'success' 
      ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'
      : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
    
    toast.className = `flex items-center ${bgColor} border-l-4 p-4 rounded-r-lg shadow-lg transform transition-all duration-500 translate-x-full`;
    toast.innerHTML = `
      <svg class="w-5 h-5 ${iconColor} mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        ${icon}
      </svg>
      <span class="${textColor} mr-3">${message}</span>
      <button onclick="this.parentElement.remove()" class="ml-auto text-gray-400 hover:text-gray-600">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    `;
    
    toastContainer.appendChild(toast);
    
    setTimeout(() => {
      toast.classList.remove('translate-x-full');
    }, 10);
    
    setTimeout(() => {
      if (toast.parentElement) {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
          if (toast.parentElement) {
            toast.remove();
          }
        }, 500);
      }
    }, 5000);
  }

  // Loading state for add category form
  document.getElementById('addCategoryForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitCategoryBtn');
    const btnText = submitBtn.querySelector('span');
    const spinner = document.getElementById('submitSpinner');
    
    submitBtn.disabled = true;
    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
    btnText.classList.add('hidden');
    spinner.classList.remove('hidden');
  });

  // Edit Category Function
  function editCategory(id, name, description) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_description').value = description;
    document.getElementById('editForm').action = `/categories/${id}`;
    document.getElementById('editModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  // Handle edit form submission
  document.getElementById('editForm').addEventListener('submit', function(e) {
    const modalLoading = document.getElementById('modalLoading');
    modalLoading.classList.remove('hidden');
  });

  function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
    document.body.style.overflow = '';
    document.getElementById('modalLoading').classList.add('hidden');
  }

  // Delete functionality
  let currentDeleteForm = null;

  document.querySelectorAll('.delete-category-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      currentDeleteForm = this.closest('.delete-form');
      document.getElementById('deleteModal').style.display = 'block';
      document.body.style.overflow = 'hidden';
    });
  });

  document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (currentDeleteForm) {
      const deleteBtn = this;
      deleteBtn.innerHTML = 'Deleting...';
      deleteBtn.disabled = true;
      currentDeleteForm.submit();
    }
  });

  function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    document.body.style.overflow = '';
    currentDeleteForm = null;
  }

  // Select All Checkboxes
  document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.getElementsByClassName('row-checkbox');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });

  // Bulk Action
  document.getElementById('applyBulkAction').addEventListener('click', function() {
    const action = document.getElementById('bulkAction').value;
    if (!action) {
      showToast('Please select an action', 'error');
      return;
    }

    const selected = [];
    const checkboxes = document.getElementsByClassName('row-checkbox');
    for (let checkbox of checkboxes) {
      if (checkbox.checked) {
        selected.push(checkbox.value);
      }
    }

    if (selected.length === 0) {
      showToast('Please select at least one category', 'error');
      return;
    }

    if (action === 'delete') {
      const deleteModal = document.getElementById('deleteModal');
      const modalTitle = deleteModal.querySelector('h3');
      const modalText = deleteModal.querySelector('p');
      
      modalTitle.textContent = 'Confirm Bulk Delete';
      modalText.textContent = `Are you sure you want to delete ${selected.length} selected categories? This action cannot be undone.`;
      
      document.getElementById('deleteModal').style.display = 'block';
      document.body.style.overflow = 'hidden';
      
      document.getElementById('confirmDeleteBtn').onclick = function() {
        document.getElementById('selectedCategories').value = JSON.stringify(selected);
        document.getElementById('bulkActionForm').submit();
      };
    }
  });

  // Close modal when clicking outside
  window.onclick = function(event) {
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    
    if (event.target == editModal) {
      closeEditModal();
    }
    if (event.target == deleteModal) {
      closeDeleteModal();
    }
  }
</script>

<style>
  /* Loading spinner animation */
  @keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
  
  .animate-spin {
    animation: spin 1s linear infinite;
  }

  /* Toast animation */
  .translate-x-full {
    transform: translateX(100%);
  }
  
  #toastContainer > div {
    transition: transform 0.3s ease-in-out;
  }

  /* Help panel animations */
  #helpPanel {
    transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s;
  }

  #helpToggle {
    transition: transform 0.3s ease;
  }

  #helpToggle.rotate-90 {
    transform: rotate(90deg);
  }

  /* Modal improvements */
  .backdrop-blur-sm {
    backdrop-filter: blur(4px);
  }

  /* Ensure modals cover everything */
  #editModal, #deleteModal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
  }
</style>

@endsection