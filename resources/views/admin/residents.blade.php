@extends('admin.layout')

@section('content')

<div class="space-y-6">
  <!-- Header -->
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-gray-800">Residents Management</h1>
    <div class="flex items-center gap-2 text-sm text-gray-500 bg-blue-50 px-3 py-1.5 rounded-full">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      Last updated: Today, 10:30 AM
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-5 gap-4" id="item-count">
    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Total Residents</p>
          <p class="text-2xl font-bold text-gray-800">1,284</p>
        </div>
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Applicants</p>
          <p class="text-2xl font-bold text-yellow-600">43</p>
        </div>
        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Residents</p>
          <p class="text-2xl font-bold text-green-600">1,198</p>
        </div>
        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Incomplete</p>
          <p class="text-2xl font-bold text-orange-600">28</p>
        </div>
        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wider">On Hold</p>
          <p class="text-2xl font-bold text-gray-600">15</p>
        </div>
        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Filters and Actions Bar -->
  <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-4 border-b border-gray-200 bg-gray-50">
      <div class="flex flex-wrap items-center justify-between gap-4" id="filters">
        <!-- Left side: Bulk Actions and Filters -->
        <div class="flex flex-wrap items-center gap-3">
          <!-- Bulk Actions Dropdown -->
          <div class="flex items-center gap-2" id="bulk-actions-dropdown">
            <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white min-w-[140px]">
              <option value="">Bulk Actions</option>
              <option value="delete">Delete Selected</option>
              <option value="hold">Put on Hold</option>
              <option value="approve">Approve as Resident</option>
              <option value="incomplete">Mark as Incomplete</option>
              <option value="export">Export Selected</option>
            </select>
            <button class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition-all">
              Apply
            </button>
          </div>

          <!-- Filter Dropdown -->
          <div class="" id="filter-dropdown">
            <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white min-w-[140px]">
              <option value="">All Residents</option>
              <option value="applicant">Applicants (43)</option>
              <option value="resident">Residents (1,198)</option>
              <option value="incomplete">Incomplete (28)</option>
              <option value="hold">On Hold (15)</option>
            </select>
          </div>

          <!-- Status Filter -->
          <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
            <option value="">All Status</option>
            <option value="active">Active</option>
            <option value="pending">Pending</option>
            <option value="inactive">Inactive</option>
          </select>

          <!-- Search Bar -->
          <div class="flex items-center" id="search-bar">
            <input type="text" placeholder="Search by name, email, or remarks..." class="w-64 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            <button class="px-3 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition-all">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Right side: Create Button and Item Count -->
        <div class="flex items-center gap-3">
          <!-- Create Resident Button -->
          <div class="" id="create-btn">
            <button onclick="openAddResidentModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all shadow-sm">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
              </svg>
              Add Resident
            </button>
          </div>

          <!-- Item Count -->
          <span class="text-sm text-gray-600 bg-white px-3 py-1.5 rounded-lg border border-gray-200">
            <span class="font-medium text-gray-800">1-10</span> of <span class="font-medium text-gray-800">1,284</span> residents
          </span>
        </div>
      </div>
    </div>

    <!-- Residents Table -->
    <div class="overflow-x-auto" id="table-residents">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-10">
              <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" id="selectAll" onchange="toggleAllCheckboxes(this)">
            </th>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:text-blue-600">
              <div class="flex items-center gap-1">
                First Name
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                </svg>
              </div>
            </th>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Middle Name</th>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Last Name</th>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Added By</th>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Remarks</th>
            <th class="py-3 px-4 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Row 1 - Resident -->
          <tr class="hover:bg-gray-50 transition-colors group">
            <td class="py-3 px-4 border-b border-gray-200">
              <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="1">
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-semibold text-sm">JD</div>
                <span class="text-sm font-medium text-gray-800">John</span>
              </div>
            </td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">A.</td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">Doe</td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">john.doe@email.com</td>
            <td class="py-3 px-4 border-b border-gray-200">
              <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1"></span>
                Resident
              </span>
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <div class="flex items-center gap-1">
                <div class="w-5 h-5 bg-gray-200 rounded-full flex items-center justify-center text-[10px] font-medium">AS</div>
                <span class="text-xs text-gray-600">Admin</span>
              </div>
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <span class="text-xs text-gray-600">Verified resident</span>
            </td>
            <td class="py-3 px-4 border-b border-gray-200 relative">
              <button onclick="toggleActionMenu(this)" class="p-1 hover:bg-gray-200 rounded-full transition-all">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                </svg>
              </button>
              <!-- Dropdown Menu -->
              <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10 action-menu">
                <div class="py-1">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2" onclick="viewResident(1)">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View Details
                  </a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2" onclick="editResident(1)">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                  </a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2" onclick="holdResident(1)">
                    <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Put on Hold
                  </a>
                  <div class="border-t border-gray-200 my-1"></div>
                  <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2" onclick="deleteResident(1)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                  </a>
                </div>
              </div>
            </td>
          </tr>

          <!-- Row 2 - Applicant -->
          <tr class="hover:bg-gray-50 transition-colors group">
            <td class="py-3 px-4 border-b border-gray-200">
              <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="2">
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 font-semibold text-sm">JS</div>
                <span class="text-sm font-medium text-gray-800">Jane</span>
              </div>
            </td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">M.</td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">Smith</td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">jane.smith@email.com</td>
            <td class="py-3 px-4 border-b border-gray-200">
              <span class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1"></span>
                Applicant
              </span>
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <div class="flex items-center gap-1">
                <div class="w-5 h-5 bg-gray-200 rounded-full flex items-center justify-center text-[10px] font-medium">JD</div>
                <span class="text-xs text-gray-600">John</span>
              </div>
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <span class="text-xs text-gray-600">Pending verification</span>
            </td>
            <td class="py-3 px-4 border-b border-gray-200 relative">
              <button onclick="toggleActionMenu(this)" class="p-1 hover:bg-gray-200 rounded-full transition-all">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                </svg>
              </button>
              <!-- Dropdown Menu -->
              <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10 action-menu">
                <div class="py-1">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2" onclick="viewResident(2)">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View Details
                  </a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2" onclick="approveResident(2)">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Approve as Resident
                  </a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2" onclick="editResident(2)">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                  </a>
                </div>
              </div>
            </td>
          </tr>

          <!-- Row 3 - Incomplete -->
          <tr class="hover:bg-gray-50 transition-colors group">
            <td class="py-3 px-4 border-b border-gray-200">
              <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="3">
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-semibold text-sm">MB</div>
                <span class="text-sm font-medium text-gray-800">Maria</span>
              </div>
            </td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">C.</td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">Brown</td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">maria.b@email.com</td>
            <td class="py-3 px-4 border-b border-gray-200">
              <span class="inline-flex items-center px-2 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">
                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-1"></span>
                Incomplete
              </span>
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <div class="flex items-center gap-1">
                <div class="w-5 h-5 bg-gray-200 rounded-full flex items-center justify-center text-[10px] font-medium">AS</div>
                <span class="text-xs text-gray-600">Admin</span>
              </div>
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <span class="text-xs text-gray-600">Missing requirements: Birth cert</span>
            </td>
            <td class="py-3 px-4 border-b border-gray-200 relative">
              <button onclick="toggleActionMenu(this)" class="p-1 hover:bg-gray-200 rounded-full transition-all">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                </svg>
              </button>
            </td>
          </tr>

          <!-- Row 4 - On Hold -->
          <tr class="hover:bg-gray-50 transition-colors group">
            <td class="py-3 px-4 border-b border-gray-200">
              <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="4">
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 font-semibold text-sm">PW</div>
                <span class="text-sm font-medium text-gray-800">Peter</span>
              </div>
            </td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">D.</td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">Wilson</td>
            <td class="py-3 px-4 border-b border-gray-200 text-sm">peter.w@email.com</td>
            <td class="py-3 px-4 border-b border-gray-200">
              <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1"></span>
                On Hold
              </span>
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <div class="flex items-center gap-1">
                <div class="w-5 h-5 bg-gray-200 rounded-full flex items-center justify-center text-[10px] font-medium">JS</div>
                <span class="text-xs text-gray-600">Jane</span>
              </div>
            </td>
            <td class="py-3 px-4 border-b border-gray-200">
              <span class="text-xs text-gray-600">Under review</span>
            </td>
            <td class="py-3 px-4 border-b border-gray-200 relative">
              <button onclick="toggleActionMenu(this)" class="p-1 hover:bg-gray-200 rounded-full transition-all">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                </svg>
              </button>
            </td>
          </tr>

          <!-- Add more rows as needed (up to 10) -->
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
      <span class="text-sm text-gray-600">Showing <span class="font-medium">1-10</span> of <span class="font-medium">1,284</span> residents</span>
      <div class="flex gap-2">
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all" disabled>Previous</button>
        <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm">1</button>
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">2</button>
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">3</button>
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">4</button>
        <span class="px-2 text-gray-500">...</span>
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">129</button>
        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-white transition-all">Next</button>
      </div>
    </div>
  </div>

  <!-- Quick Guide Card -->
  <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
    <div class="flex items-start">
      <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div>
        <h3 class="text-sm font-medium text-blue-800">Quick Guide:</h3>
        <ul class="text-sm text-blue-700 mt-1 grid grid-cols-1 md:grid-cols-3 gap-2">
          <li class="flex items-center gap-1">
            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
            Click "Add Resident" to register new resident
          </li>
          <li class="flex items-center gap-1">
            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
            Use bulk actions for multiple residents
          </li>
          <li class="flex items-center gap-1">
            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
            Click ⋮ icon for each resident's actions
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Add Resident Modal -->
<div id="addResidentModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 hidden items-center justify-center">
  <div class="bg-white rounded-xl w-11/12 max-w-2xl max-h-[90vh] overflow-y-auto">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 sticky top-0 bg-white">
      <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
        Add New Resident
      </h3>
      <button onclick="closeAddResidentModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <div class="p-6 space-y-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
          <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="First name">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
          <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Middle name">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
          <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Last name">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
          <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="email@example.com">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
          <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="+63 xxx xxx xxxx">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
        <textarea rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Additional notes..."></textarea>
      </div>
    </div>

    <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
      <button onclick="closeAddResidentModal()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
        Cancel
      </button>
      <button onclick="saveResident()" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
        </svg>
        Save Resident
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
      <span class="text-gray-800 text-sm font-medium" id="toastMessage">Resident added successfully!</span>
      <p class="text-xs text-gray-500 mt-0.5" id="toastSubMessage">New resident has been recorded</p>
    </div>
  </div>
</div>

<script>
  // Toggle action menu
  function toggleActionMenu(button) {
    const menu = button.nextElementSibling;
    menu.classList.toggle('hidden');
    
    // Close when clicking outside
    document.addEventListener('click', function closeMenu(e) {
      if (!button.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
        document.removeEventListener('click', closeMenu);
      }
    });
  }

  // Toggle all checkboxes
  function toggleAllCheckboxes(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(checkbox => {
      checkbox.checked = selectAllCheckbox.checked;
    });
  }

  // Modal functions
  function openAddResidentModal() {
    document.getElementById('addResidentModal').classList.remove('hidden');
    document.getElementById('addResidentModal').classList.add('flex');
  }

  function closeAddResidentModal() {
    document.getElementById('addResidentModal').classList.add('hidden');
    document.getElementById('addResidentModal').classList.remove('flex');
  }

  function saveResident() {
    closeAddResidentModal();
    showToast('successToast', 'Resident added successfully!', 'New resident has been recorded');
  }

  // Action functions
  function viewResident(id) {
    alert(`Viewing resident ${id}`);
  }

  function editResident(id) {
    alert(`Editing resident ${id}`);
  }

  function deleteResident(id) {
    if (confirm(`Are you sure you want to delete resident ${id}?`)) {
      alert(`Resident ${id} deleted`);
    }
  }

  function holdResident(id) {
    alert(`Resident ${id} put on hold`);
  }

  function approveResident(id) {
    alert(`Resident ${id} approved`);
  }

  // Toast function
  function showToast(toastId, message, subMessage) {
    const toast = document.getElementById(toastId);
    document.getElementById('toastMessage').textContent = message;
    document.getElementById('toastSubMessage').textContent = subMessage;

    toast.classList.remove('translate-y-24', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100');

    setTimeout(() => {
      toast.classList.remove('translate-y-0', 'opacity-100');
      toast.classList.add('translate-y-24', 'opacity-0');
    }, 3000);
  }

  // Close modal when clicking outside
  window.onclick = function(event) {
    const modal = document.getElementById('addResidentModal');
    if (event.target === modal) {
      closeAddResidentModal();
    }
  }
</script>

<style>
  /* Smooth transitions */
  .transition-all {
    transition: all 0.2s ease;
  }

  /* Toast animations */
  #successToast {
    transition: transform 0.3s ease, opacity 0.3s ease;
  }

  /* Action menu positioning */
  .action-menu {
    position: absolute;
    z-index: 50;
  }
</style>

@endsection