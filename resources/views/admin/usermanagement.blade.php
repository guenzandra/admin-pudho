<!---usermanagement for admin, staff--->
@extends('admin.layout')

@section('content')
<div class="min-h-screen p-6 md:p-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <!-- Top Bar with Search, Archive and Add Button -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <!-- Search Bar -->
            <div class="flex-1 max-w-md flex border border-gray-200 rounded-lg overflow-hidden focus-within:border-red-500 focus-within:ring-1 focus-within:ring-red-500 transition-all">
                <input type="text" class="flex-1 px-4 py-2.5 outline-none text-sm" id="searchInput" placeholder="Search by name, username, or email..." onkeyup="filterTable()">
                <button class="px-5 bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors flex items-center gap-2" onclick="filterTable()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search
                </button>
            </div>

            <!-- Archive and Add Buttons -->
            <div class="flex gap-3">
                <button type="button" class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:border-red-500 hover:text-red-600 transition-all" onclick="openArchiveModal()">
                    <i class="bi bi-archive me-2"></i> Archive (<span id="archivedCount">0</span>)
                </button>
                <button type="button" class="px-5 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium flex items-center gap-2 hover:bg-red-700 hover:shadow-md transition-all" id="openAddUserModal">
                    <i class="bi bi-person-plus"></i> Add User
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="flex flex-wrap items-center gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center gap-2">
                <i class="bi bi-funnel text-gray-400 text-xs"></i>
                <label class="text-gray-600 text-sm">Position:</label>
                <select id="positionFilter" class="px-3 py-1.5 border border-gray-200 rounded-md text-sm outline-none focus:border-red-500 bg-white" onchange="filterTable()">
                    <option value="all">All Positions</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Manager">Manager</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Staff">Staff</option>
                    <option value="Editor">Editor</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <i class="bi bi-circle text-gray-400 text-xs"></i>
                <label class="text-gray-600 text-sm">Status:</label>
                <select id="statusFilter" class="px-3 py-1.5 border border-gray-200 rounded-md text-sm outline-none focus:border-red-500 bg-white" onchange="filterTable()">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            <span class="ml-auto text-gray-500 text-xs bg-gray-200 px-3 py-1.5 rounded-full" id="resultCount">
                <i class="bi bi-people me-1"></i> Loading...
            </span>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto rounded-lg border border-gray-200" style="overflow: visible;">
            <table class="w-full border-collapse bg-white text-sm" id="userTable">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left px-4 py-3 text-gray-600 font-semibold text-xs uppercase tracking-wider border-b border-red-600">Name</th>
                        <th class="text-left px-4 py-3 text-gray-600 font-semibold text-xs uppercase tracking-wider border-b border-red-600">Position</th>
                        <th class="text-left px-4 py-3 text-gray-600 font-semibold text-xs uppercase tracking-wider border-b border-red-600">Username</th>
                        <th class="text-left px-4 py-3 text-gray-600 font-semibold text-xs uppercase tracking-wider border-b border-red-600">Email</th>
                        <th class="text-left px-4 py-3 text-gray-600 font-semibold text-xs uppercase tracking-wider border-b border-red-600">Status</th>
                        <th class="text-left px-4 py-3 text-gray-600 font-semibold text-xs uppercase tracking-wider border-b border-red-600">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Data will be populated by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-center gap-4 mt-6">
            <button class="px-4 py-2 border border-gray-200 bg-white rounded-lg text-sm text-gray-600 font-medium hover:border-red-500 hover:text-red-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed" onclick="changePage('prev')" id="prevPageBtn">
                <i class="bi bi-chevron-left me-2"></i>Previous
            </button>
            <span class="text-sm text-gray-600" id="pageInfo">
                <i class="bi bi-file-text me-1"></i> Page <span id="currentPage">1</span> of <span id="totalPages">1</span>
            </span>
            <button class="px-4 py-2 border border-gray-200 bg-white rounded-lg text-sm text-gray-600 font-medium hover:border-red-500 hover:text-red-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed" onclick="changePage('next')" id="nextPageBtn">
                Next<i class="bi bi-chevron-right ms-2"></i>
            </button>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden" id="addUserModal">
    <div class="bg-white rounded-xl w-11/12 max-w-2xl max-h-[90vh] overflow-y-auto shadow-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="bi bi-person-plus text-red-600 me-2"></i>Add New User
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeAddUserModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <form class="p-6" id="addUserForm" enctype="multipart/form-data">
            @csrf
            <!-- Profile Uploader -->
            <div class="mb-8">
                <div class="flex flex-col items-center mb-6">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-full bg-gray-100 border-2 border-gray-300 flex items-center justify-center text-gray-400 text-3xl mb-3" id="profilePreview">
                            <i class="bi bi-camera"></i>
                        </div>
                        <label for="profileImage" class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center cursor-pointer hover:bg-gray-50 transition-colors border border-gray-300">
                            <i class="bi bi-pencil text-gray-500 text-sm"></i>
                        </label>
                        <input type="file" name="profile_img" id="profileImage" class="hidden" accept="image/*" onchange="previewProfileImage(event)">
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="bi bi-info-circle me-1"></i>Upload profile picture (optional)
                    </p>
                </div>

                <h4 class="text-gray-700 font-semibold text-sm mb-4 pb-2 border-b border-gray-200">
                    <i class="bi bi-person me-2 text-gray-400"></i>Personal Information
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-600 text-xs font-medium mb-1.5">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="first_name" name="first_name" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="Enter first name" required>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-xs font-medium mb-1.5">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="Enter middle name">
                    </div>
                    <div>
                        <label class="block text-gray-600 text-xs font-medium mb-1.5">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="Enter last name" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 text-xs font-medium mb-1.5">Suffix</label>
                    <input type="text" id="suffix" name="suffix" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="Jr., Sr., III, etc.">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-600 text-xs font-medium mb-1.5">
                            Gender <span class="text-red-500">*</span>
                        </label>
                        <select id="gender" name="gender" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-white" required>
                            <option value="" disabled selected>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                            <option value="prefer_not_to_say">Prefer not to say</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-xs font-medium mb-1.5">
                            Birthdate <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="birthdate" name="birthdate" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 text-xs font-medium mb-1.5">
                        <i class="bi bi-telephone me-1 text-gray-400"></i>Contact Number <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="contact" name="contact_no" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" placeholder="Enter contact number" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 text-xs font-medium mb-1.5">
                        <i class="bi bi-envelope me-1 text-gray-400"></i>Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" placeholder="Enter email address" required>
                </div>
            </div>

            <div class="mb-8">
                <h4 class="text-gray-700 font-semibold text-sm mb-4 pb-2 border-b border-gray-200">
                    <i class="bi bi-lock me-2 text-gray-400"></i>Account Information
                </h4>

                <div class="mb-4">
                    <label class="block text-gray-600 text-xs font-medium mb-1.5">
                        <i class="bi bi-briefcase me-1 text-gray-400"></i>Position <span class="text-red-500">*</span>
                    </label>
                    <select id="position" name="position" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-white" required>
                        <option value="" disabled selected>Select position</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Manager">Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Staff">Staff</option>
                        <option value="Editor">Editor</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 text-xs font-medium mb-1.5">
                        <i class="bi bi-person-circle me-1 text-gray-400"></i>Username
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="username" name="username" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50 text-gray-600" placeholder="Click generate to create username" readonly>
                        <button type="button" class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all whitespace-nowrap" onclick="generateUsername()">
                            <i class="bi bi-arrow-repeat me-2"></i>Generate
                        </button>
                    </div>
                    <small class="block mt-1 text-gray-400 text-xs">
                        <i class="bi bi-info-circle me-1"></i>Based on first and last name (e.g., jdoe123)
                    </small>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 text-xs font-medium mb-1.5">
                        <i class="bi bi-key me-1 text-gray-400"></i>Password
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="password" name="password" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50 text-gray-600" placeholder="Click generate to create password" readonly>
                        <button type="button" class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all whitespace-nowrap" onclick="generatePassword()">
                            <i class="bi bi-arrow-repeat me-2"></i>Generate
                        </button>
                    </div>
                    <small class="block mt-1 text-gray-400 text-xs">
                        <i class="bi bi-info-circle me-1"></i>8-12 characters with letters and numbers
                    </small>
                </div>
            </div>
        </form>

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200">
            <button type="button" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeAddUserModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 hover:shadow-md transition-all" onclick="saveUser()">
                <i class="bi bi-save me-2"></i>Save User
            </button>
        </div>
    </div>
</div>

<!-- Archive/Recycle Bin Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden" id="archiveModal">
    <div class="bg-white rounded-xl w-11/12 max-w-4xl max-h-[90vh] overflow-y-auto shadow-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="bi bi-trash text-red-600 me-2"></i>Recycle Bin
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeArchiveModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-50 p-6 rounded-lg text-center">
                    <i class="bi bi-people text-red-600 text-2xl mb-2"></i>
                    <span class="block text-2xl font-bold text-red-600 mb-1" id="archivedTotal">0</span>
                    <span class="text-gray-500 text-xs">Archived Users</span>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg text-center">
                    <i class="bi bi-clock text-red-600 text-2xl mb-2"></i>
                    <span class="block text-2xl font-bold text-red-600 mb-1" id="pendingDeletion">0</span>
                    <span class="text-gray-500 text-xs">Pending Permanent Deletion</span>
                </div>
            </div>

            <div class="overflow-x-auto mb-4">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-left px-4 py-2.5 text-gray-600 font-semibold text-xs border-b border-gray-200">Name</th>
                            <th class="text-left px-4 py-2.5 text-gray-600 font-semibold text-xs border-b border-gray-200">Position</th>
                            <th class="text-left px-4 py-2.5 text-gray-600 font-semibold text-xs border-b border-gray-200">Archived Date</th>
                            <th class="text-left px-4 py-2.5 text-gray-600 font-semibold text-xs border-b border-gray-200">Expires In</th>
                            <th class="text-left px-4 py-2.5 text-gray-600 font-semibold text-xs border-b border-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="archiveBody">
                        <!-- Archive data will be populated -->
                    </tbody>
                </table>
            </div>

            <div class="bg-orange-50 p-3 rounded-lg text-orange-700 text-xs flex items-center gap-2">
                <i class="bi bi-info-circle"></i>
                <span>Items in recycle bin will be permanently deleted after 30 days</span>
            </div>
        </div>

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200">
            <button type="button" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeArchiveModal()">
                <i class="bi bi-x me-2"></i>Close
            </button>
            <button type="button" class="px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="emptyRecycleBin()">
                <i class="bi bi-trash me-2"></i>Empty Recycle Bin
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden" id="deleteModal">
    <div class="bg-white rounded-xl w-11/12 max-w-md shadow-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="bi bi-exclamation-triangle text-orange-500 me-2"></i>Move to Recycle Bin?
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeDeleteModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="p-8 text-center">
            <i class="bi bi-trash text-4xl text-orange-500 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Are you sure you want to move <strong id="deleteUserName" class="text-red-600"></strong> to recycle bin?</p>
            <p class="text-gray-400 text-xs">
                <i class="bi bi-info-circle me-1"></i>The user account will be archived and can be restored within 30 days.
            </p>
            <input type="hidden" id="deleteUserId">
        </div>

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200">
            <button type="button" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeDeleteModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="px-5 py-2 bg-orange-600 text-white rounded-lg text-sm font-medium hover:bg-orange-700 transition-all" onclick="moveToArchive()">
                <i class="bi bi-archive me-2"></i>Move to Recycle Bin
            </button>
        </div>
    </div>
</div>

<!-- Restore Confirmation Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden" id="restoreModal">
    <div class="bg-white rounded-xl w-11/12 max-w-md shadow-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="bi bi-arrow-return-left text-green-600 me-2"></i>Restore User
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeRestoreModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="p-8 text-center">
            <i class="bi bi-arrow-return-left text-4xl text-green-600 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Restore <strong id="restoreUserName" class="text-green-600"></strong> to active users?</p>
            <p class="text-gray-400 text-xs">
                <i class="bi bi-info-circle me-1"></i>The user account will be reactivated with all previous data.
            </p>
            <input type="hidden" id="restoreArchiveId">
        </div>

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200">
            <button type="button" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeRestoreModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="restoreUser()">
                <i class="bi bi-arrow-return-left me-2"></i>Restore User
            </button>
        </div>
    </div>
</div>

<!-- Permanent Delete Confirmation -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden" id="permanentDeleteModal">
    <div class="bg-white rounded-xl w-11/12 max-w-md shadow-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="bi bi-exclamation-circle text-red-600 me-2"></i>Permanently Delete?
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closePermanentDeleteModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="p-8 text-center">
            <i class="bi bi-exclamation-triangle text-4xl text-red-600 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Permanently delete <strong id="permanentDeleteUserName" class="text-red-600"></strong>?</p>
            <p class="text-gray-400 text-xs">
                <i class="bi bi-exclamation-circle me-1"></i>This action cannot be undone. All user data will be lost.
            </p>
            <input type="hidden" id="permanentDeleteArchiveId">
        </div>

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200">
            <button type="button" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closePermanentDeleteModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="permanentDelete()">
                <i class="bi bi-trash me-2"></i>Permanently Delete
            </button>
        </div>
    </div>
</div>

<!-- View User Details Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden" id="viewUserModal">
    <div class="bg-white rounded-xl w-11/12 max-w-2xl shadow-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="bi bi-person-circle text-red-600 me-2"></i>User Profile
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeViewModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="p-6 bg-gradient-to-r from-red-600 to-red-700 text-white flex items-center gap-4">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-2xl font-bold border-2 border-white" id="avatarInitials">
                JD
            </div>
            <div>
                <h2 class="text-xl font-bold" id="viewFullName">John A. Doe</h2>
                <span class="text-xs opacity-90 block mt-1" id="viewPosition">
                    <i class="bi bi-briefcase me-1"></i>Administrator
                </span>
            </div>
            <span class="ml-auto px-3 py-1 bg-white bg-opacity-20 rounded-full text-xs font-medium" id="viewStatusBadge">
                <i class="bi bi-circle-fill me-1 text-green-300"></i>Active
            </span>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-person me-1"></i>Username
                    </span>
                    <span class="text-gray-800 text-sm font-medium" id="viewUsername">johndoe_admin</span>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-envelope me-1"></i>Email
                    </span>
                    <span class="text-gray-800 text-sm font-medium" id="viewEmail">john.doe@example.com</span>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-telephone me-1"></i>Contact
                    </span>
                    <span class="text-gray-800 text-sm font-medium" id="viewContact">+63 912 345 6789</span>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-gender-ambiguous me-1"></i>Gender
                    </span>
                    <span class="text-gray-800 text-sm font-medium" id="viewGender">Male</span>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-calendar me-1"></i>Birthdate
                    </span>
                    <span class="text-gray-800 text-sm font-medium" id="viewBirthdate">January 15, 1990</span>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-cake me-1"></i>Age
                    </span>
                    <span class="text-gray-800 text-sm font-medium" id="viewAge">34</span>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-calendar-check me-1"></i>Date Joined
                    </span>
                    <span class="text-gray-800 text-sm font-medium" id="viewDateJoined">March 10, 2023</span>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-clock me-1"></i>Last Login
                    </span>
                    <span class="text-gray-800 text-sm font-medium" id="viewLastLogin">February 22, 2026</span>
                </div>
            </div>
        </div>

        <div class="flex justify-end px-6 py-4 border-t border-gray-200">
            <button type="button" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeViewModal()">
                <i class="bi bi-x me-2"></i>Close
            </button>
        </div>
    </div>
</div>

<!-- Edit Status Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden" id="editStatusModal">
    <div class="bg-white rounded-xl w-11/12 max-w-md shadow-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="bi bi-pencil-square text-red-600 me-2"></i>Update Account Status
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeEditStatusModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="p-6">
            <p class="text-gray-600 text-sm mb-4">
                <i class="bi bi-person me-1"></i>Update status for: <strong id="statusUserName" class="text-red-600"></strong>
            </p>
            <input type="hidden" id="statusUserId">

            <div class="flex flex-col gap-2">
                <label class="status-card cursor-pointer border border-gray-200 rounded-lg overflow-hidden hover:border-red-500 transition-all">
                    <input type="radio" name="userStatus" value="active" class="hidden">
                    <div class="status-card-content p-3 flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-green-500 shadow-sm"></span>
                        <span class="font-medium text-gray-700 text-sm w-16">
                            <i class="bi bi-check-circle-fill me-1 text-green-500"></i>Active
                        </span>
                        <span class="text-gray-400 text-xs">User can access the system</span>
                    </div>
                </label>

                <label class="status-card cursor-pointer border border-gray-200 rounded-lg overflow-hidden hover:border-red-500 transition-all">
                    <input type="radio" name="userStatus" value="inactive" class="hidden">
                    <div class="status-card-content p-3 flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-gray-400 shadow-sm"></span>
                        <span class="font-medium text-gray-700 text-sm w-16">
                            <i class="bi bi-pause-circle-fill me-1 text-gray-400"></i>Inactive
                        </span>
                        <span class="text-gray-400 text-xs">User cannot login</span>
                    </div>
                </label>

                <label class="status-card cursor-pointer border border-gray-200 rounded-lg overflow-hidden hover:border-red-500 transition-all">
                    <input type="radio" name="userStatus" value="suspended" class="hidden">
                    <div class="status-card-content p-3 flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-orange-500 shadow-sm"></span>
                        <span class="font-medium text-gray-700 text-sm w-16">
                            <i class="bi bi-exclamation-triangle-fill me-1 text-orange-500"></i>Suspended
                        </span>
                        <span class="text-gray-400 text-xs">Temporarily restricted</span>
                    </div>
                </label>
            </div>
        </div>

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200">
            <button type="button" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeEditStatusModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="updateStatus()">
                <i class="bi bi-save me-2"></i>Update Status
            </button>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div class="toast fixed bottom-8 right-8 bg-white rounded-lg shadow-lg px-5 py-3 transform translate-y-24 opacity-0 transition-all duration-300 z-[1001]" id="successToast">
    <div class="flex items-center gap-3">
        <div class="w-5 h-5 bg-green-500 text-white rounded-full flex items-center justify-center text-xs">
            <i class="bi bi-check"></i>
        </div>
        <span class="text-gray-700 text-sm font-medium" id="toastMessage">User added successfully</span>
    </div>
</div>

<style>
    /* Custom styles that work with Tailwind */
    .modal.show {
        display: flex;
    }

    .actions-menu.show {
        display: block;
    }

    .status-card input[type="radio"]:checked+div {
        @apply bg-blue-50 border-l-4 border-red-600;
    }

    .status-badge {
        @apply px-2 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1;
    }

    .status-active {
        @apply bg-green-100 text-green-700;
    }

    .status-inactive {
        @apply bg-red-100 text-red-700;
    }

    .status-suspended {
        @apply bg-orange-100 text-orange-700;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .actions-menu.show {
        animation: slideDown 0.2s ease;
    }

    .modal.show .modal-content {
        animation: slideUp 0.3s ease;
    }

    .overflow-visible {
        overflow: visible !important;
    }

    td.relative {
        position: relative;
        overflow: visible;
    }

    .actions-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 4px;
        z-index: 100;
        min-width: 180px;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    tr {
        overflow: visible;
    }

    .modal {
        z-index: 1000;
    }
</style>

<!-- Bootstrap Icons -->
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

<script>
    let currentPage = 1;
    let lastPage = 1;
    let totalUsers = 0;
    let filters = {
        search: '',
        position: 'all',
        status: 'all'
    };
    let currentUserId = null;
    let currentArchiveId = null;

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        loadUsers();
        loadArchiveStats();

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
            }
            if (!event.target.closest('.actions-btn') && !event.target.closest('.actions-menu')) {
                closeAllDropdowns();
            }
        };

        // Add event listeners for filters
        document.getElementById('searchInput').addEventListener('keyup', debounce(filterTable, 500));
        document.getElementById('positionFilter').addEventListener('change', filterTable);
        document.getElementById('statusFilter').addEventListener('change', filterTable);
    });

    // Debounce function to limit API calls
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Load users from API
    function loadUsers(page = 1) {
        const params = new URLSearchParams({
            page: page,
            search: filters.search,
            position: filters.position,
            status: filters.status,
            per_page: 10
        });

        fetch(`/admin/users?${params}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            renderTable(data.users.data);
            currentPage = data.users.current_page;
            lastPage = data.users.last_page;
            totalUsers = data.users.total;
            
            document.getElementById('archivedCount').textContent = data.archived_count || 0;
            
            updatePagination();
            document.getElementById('resultCount').innerHTML = 
                `<i class="bi bi-people me-1"></i> Showing ${data.users.data.length} of ${totalUsers} users`;
        })
        .catch(error => {
            console.error('Error loading users:', error);
            showToast('Error loading users', 'error');
        });
    }

    // Load archive stats
    function loadArchiveStats() {
        fetch('/admin/archived-users', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('archivedTotal').textContent = data.stats.total;
            document.getElementById('pendingDeletion').textContent = data.stats.expired;
        })
        .catch(error => console.error('Error loading archive stats:', error));
    }

    // Render table
    function renderTable(users) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        users.forEach(user => {
            const statusClass = user.is_active ? 'active' : 'inactive';
            const statusText = user.is_active ? 'Active' : 'Inactive';
            const statusColor = user.is_active ? 'green' : 'red';
            
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50 transition-colors';
            row.innerHTML = `
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-semibold text-xs">
                            ${user.initials || 'U'}
                        </div>
                        <span class="text-sm">${user.full_name || user.first_name + ' ' + user.last_name}</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="flex items-center gap-1">
                        <i class="bi bi-briefcase text-gray-400 text-xs"></i>
                        ${user.position || 'N/A'}
                    </span>
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="flex items-center gap-1">
                        <i class="bi bi-person-circle text-gray-400 text-xs"></i>
                        ${user.username || 'N/A'}
                    </span>
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="flex items-center gap-1">
                        <i class="bi bi-envelope text-gray-400 text-xs"></i>
                        ${user.email}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <span class="status-badge status-${statusClass}">
                        <i class="bi bi-circle-fill text-${statusColor}-400 text-xs me-1"></i>
                        ${statusText}
                    </span>
                </td>
                <td class="px-4 py-3 relative" style="overflow: visible;">
                    <button class="actions-btn w-8 h-8 bg-gray-100 rounded-lg text-gray-600 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center" onclick="toggleActionsMenu(this, ${user.user_id})">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <div class="actions-menu hidden absolute right-0 bg-white rounded-lg shadow-lg z-50 min-w-[180px] mt-1 border border-gray-200 overflow-hidden" id="menu-${user.user_id}" style="top: 100%; right: 0; margin-top: 4px;">
                        <button class="w-full text-left px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 flex items-center gap-2" onclick="viewUser(${user.user_id})">
                            <i class="bi bi-eye text-blue-500 w-4"></i> View Details
                        </button>
                        <button class="w-full text-left px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 flex items-center gap-2" onclick="editUserStatus('${user.full_name || user.first_name + ' ' + user.last_name}', ${user.user_id})">
                            <i class="bi bi-pencil-square text-green-500 w-4"></i> Edit Status
                        </button>
                        <button class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2 border-t border-gray-200" onclick="openDeleteModal('${user.full_name || user.first_name + ' ' + user.last_name}', ${user.user_id})">
                            <i class="bi bi-trash text-red-500 w-4"></i> Delete Account
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Filter table
    function filterTable() {
        filters.search = document.getElementById('searchInput').value;
        filters.position = document.getElementById('positionFilter').value;
        filters.status = document.getElementById('statusFilter').value;
        currentPage = 1;
        loadUsers(currentPage);
    }

    // Change page
    function changePage(direction) {
        if (direction === 'next' && currentPage < lastPage) {
            currentPage++;
            loadUsers(currentPage);
        } else if (direction === 'prev' && currentPage > 1) {
            currentPage--;
            loadUsers(currentPage);
        }
    }

    // Update pagination
    function updatePagination() {
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = lastPage;
        document.getElementById('prevPageBtn').disabled = currentPage === 1;
        document.getElementById('nextPageBtn').disabled = currentPage === lastPage;
    }

    // Toggle Actions Menu
    function toggleActionsMenu(btn, userId) {
        closeAllDropdowns();
        const menu = document.getElementById(`menu-${userId}`);
        if (menu) {
            menu.classList.toggle('show');
            
            if (menu.classList.contains('show')) {
                const closeMenu = (e) => {
                    if (!btn.contains(e.target) && !menu.contains(e.target)) {
                        menu.classList.remove('show');
                        document.removeEventListener('click', closeMenu);
                    }
                };
                setTimeout(() => document.addEventListener('click', closeMenu), 0);
            }
        }
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.actions-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    }

    // Add User Modal
    const addUserModal = document.getElementById('addUserModal');
    document.getElementById('openAddUserModal').onclick = function() {
        closeAllDropdowns();
        addUserModal.classList.add('show');
        document.getElementById('addUserForm').reset();
        document.getElementById('profilePreview').innerHTML = '<i class="bi bi-camera"></i>';
    };

    function closeAddUserModal() {
        addUserModal.classList.remove('show');
    }

    // Profile Image Preview
    function previewProfileImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profilePreview');
                preview.innerHTML = `<img src="${e.target.result}" class="w-24 h-24 rounded-full object-cover border-2 border-white shadow-md" alt="Profile">`;
            };
            reader.readAsDataURL(file);
        }
    }

    // Generate Username
function generateUsername() {
    const firstName = document.getElementById('first_name').value;
    const lastName = document.getElementById('last_name').value;

    if (firstName && lastName) {
        // Show loading state
        const generateBtn = event.target;
        const originalText = generateBtn.innerHTML;
        generateBtn.innerHTML = '<i class="bi bi-hourglass me-2"></i>Generating...';
        generateBtn.disabled = true;

        fetch('/admin/generate-username', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                first_name: firstName, 
                last_name: lastName 
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.getElementById('username').value = data.username;
                showToast('Username generated successfully');
            } else {
                alert(data.message || 'Error generating username');
            }
        })
        .catch(error => {
            console.error('Error generating username:', error);
            showToast('Error generating username', 'error');
        })
        .finally(() => {
            generateBtn.innerHTML = originalText;
            generateBtn.disabled = false;
        });
    } else {
        alert('Please enter first name and last name first');
    }
}

    // Generate Password
    function generatePassword() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let password = '';
        for (let i = 0; i < 10; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('password').value = password;
        showToast('Password generated successfully');
    }

    // Save User
    // Save User
function saveUser() {
    const form = document.getElementById('addUserForm');
    const formData = new FormData(form);

    // Check required fields
    const firstName = document.getElementById('first_name').value;
    const lastName = document.getElementById('last_name').value;
    const email = document.getElementById('email').value;
    const contact = document.getElementById('contact').value;
    const gender = document.getElementById('gender').value;
    const birthdate = document.getElementById('birthdate').value;
    const position = document.getElementById('position').value;
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (!firstName || !lastName || !email || !contact || !gender || !birthdate || !position || !username || !password) {
        alert('Please fill all required fields');
        return;
    }

    // Show loading state
    const saveBtn = event.target;
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="bi bi-hourglass me-2"></i>Saving...';
    saveBtn.disabled = true;

    fetch('/admin/users', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('User added successfully');
            closeAddUserModal();
            loadUsers(currentPage);
            loadArchiveStats();
            
            // Reset form
            document.getElementById('addUserForm').reset();
            document.getElementById('profilePreview').innerHTML = '<i class="bi bi-camera"></i>';
        } else {
            if (data.errors) {
                // Display validation errors
                const errorMessages = Object.values(data.errors).flat().join('\n');
                alert('Validation errors:\n' + errorMessages);
            } else {
                alert(data.message || 'Error creating user');
            }
        }
    })
    .catch(error => {
        console.error('Error saving user:', error);
        showToast('Error saving user', 'error');
    })
    .finally(() => {
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    });
}

    // Delete Modal
    const deleteModal = document.getElementById('deleteModal');

    function openDeleteModal(name, userId) {
        closeAllDropdowns();
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('deleteUserId').value = userId;
        deleteModal.classList.add('show');
    }

    function closeDeleteModal() {
        deleteModal.classList.remove('show');
    }

    function moveToArchive() {
        const userId = document.getElementById('deleteUserId').value;
        
        fetch(`/admin/users/${userId}/archive`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(`User moved to recycle bin`);
                closeDeleteModal();
                loadUsers(currentPage);
                loadArchiveStats();
            } else {
                alert(data.message || 'Error archiving user');
            }
        })
        .catch(error => {
            console.error('Error archiving user:', error);
            showToast('Error archiving user', 'error');
        });
    }

    // Archive Modal
    const archiveModal = document.getElementById('archiveModal');

    function openArchiveModal() {
        closeAllDropdowns();
        loadArchivedUsers();
        archiveModal.classList.add('show');
    }

    function closeArchiveModal() {
        archiveModal.classList.remove('show');
    }

    // Load archived users
    function loadArchivedUsers() {
        fetch('/admin/archived-users', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            renderArchiveTable(data.archived_users);
            document.getElementById('archivedTotal').textContent = data.stats.total;
            document.getElementById('pendingDeletion').textContent = data.stats.expired;
        })
        .catch(error => console.error('Error loading archived users:', error));
    }

    // Render archive table
    function renderArchiveTable(archivedUsers) {
        const archiveBody = document.getElementById('archiveBody');
        archiveBody.innerHTML = '';

        archivedUsers.forEach(user => {
            const archivedDate = new Date(user.archived_at).toLocaleDateString();
            const expiresAt = new Date(user.expires_at);
            const daysLeft = Math.ceil((expiresAt - new Date()) / (1000 * 60 * 60 * 24));
            const expiresText = daysLeft > 0 ? `${daysLeft} days left` : 'Expired';

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-2.5 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-person-slash text-gray-400"></i>
                        ${user.first_name} ${user.middle_name || ''} ${user.last_name} ${user.suffix || ''}
                    </div>
                </td>
                <td class="px-4 py-2.5 text-sm">${user.position || 'N/A'}</td>
                <td class="px-4 py-2.5 text-sm">${archivedDate}</td>
                <td class="px-4 py-2.5 text-sm">
                    <span class="${daysLeft <= 7 ? 'text-red-600' : 'text-gray-600'}">${expiresText}</span>
                </td>
                <td class="px-4 py-2.5">
                    <button class="text-blue-600 hover:text-blue-800 mr-3 transition-colors" onclick="restoreFromArchive(${user.archive_id}, '${user.first_name} ${user.last_name}')" title="Restore">
                        <i class="bi bi-arrow-return-left"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800 transition-colors" onclick="permanentDeletePrompt(${user.archive_id}, '${user.first_name} ${user.last_name}')" title="Delete Permanently">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            archiveBody.appendChild(row);
        });
    }

    // Restore Modal
    const restoreModal = document.getElementById('restoreModal');

    function restoreFromArchive(archiveId, name) {
        closeAllDropdowns();
        document.getElementById('restoreUserName').textContent = name;
        document.getElementById('restoreArchiveId').value = archiveId;
        restoreModal.classList.add('show');
    }

    function closeRestoreModal() {
        restoreModal.classList.remove('show');
    }

    function restoreUser() {
        const archiveId = document.getElementById('restoreArchiveId').value;
        
        fetch(`/admin/archived-users/${archiveId}/restore`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(`User restored successfully`);
                closeRestoreModal();
                loadArchivedUsers();
                loadUsers(currentPage);
                loadArchiveStats();
            } else {
                alert(data.message || 'Error restoring user');
            }
        })
        .catch(error => {
            console.error('Error restoring user:', error);
            showToast('Error restoring user', 'error');
        });
    }

    // Permanent Delete
    const permanentDeleteModal = document.getElementById('permanentDeleteModal');

    function permanentDeletePrompt(archiveId, name) {
        closeAllDropdowns();
        document.getElementById('permanentDeleteUserName').textContent = name;
        document.getElementById('permanentDeleteArchiveId').value = archiveId;
        permanentDeleteModal.classList.add('show');
    }

    function closePermanentDeleteModal() {
        permanentDeleteModal.classList.remove('show');
    }

    function permanentDelete() {
        const archiveId = document.getElementById('permanentDeleteArchiveId').value;
        
        fetch(`/admin/archived-users/${archiveId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(`User permanently deleted`);
                closePermanentDeleteModal();
                loadArchivedUsers();
                loadArchiveStats();
            } else {
                alert(data.message || 'Error deleting user');
            }
        })
        .catch(error => {
            console.error('Error deleting user:', error);
            showToast('Error deleting user', 'error');
        });
    }

    // Empty Recycle Bin
    function emptyRecycleBin() {
        if (confirm('Are you sure you want to permanently delete all expired items in recycle bin?')) {
            fetch('/admin/recycle-bin/empty', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Recycle bin emptied');
                    loadArchivedUsers();
                    loadArchiveStats();
                } else {
                    alert(data.message || 'Error emptying recycle bin');
                }
            })
            .catch(error => {
                console.error('Error emptying recycle bin:', error);
                showToast('Error emptying recycle bin', 'error');
            });
        }
    }

    // View User
    function viewUser(userId) {
        closeAllDropdowns();
        
        fetch(`/admin/users/${userId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const user = data.user;
            const stats = data.stats;
            
            document.getElementById('avatarInitials').textContent = user.initials || 'U';
            document.getElementById('viewFullName').textContent = user.full_name || `${user.first_name} ${user.middle_name || ''} ${user.last_name} ${user.suffix || ''}`;
            document.getElementById('viewPosition').innerHTML = `<i class="bi bi-briefcase me-1"></i>${user.position || 'N/A'}`;

            const statusClass = user.is_active ? 'green' : 'red';
            const statusText = user.is_active ? 'Active' : 'Inactive';
            document.getElementById('viewStatusBadge').innerHTML = `<i class="bi bi-circle-fill me-1 text-${statusClass}-300"></i>${statusText}`;

            document.getElementById('viewUsername').textContent = user.username || 'N/A';
            document.getElementById('viewEmail').textContent = user.email;
            document.getElementById('viewContact').textContent = user.contact_no || 'N/A';
            document.getElementById('viewGender').textContent = user.gender ? user.gender.charAt(0).toUpperCase() + user.gender.slice(1) : 'N/A';

            if (user.birthdate) {
                const birthDate = new Date(user.birthdate);
                document.getElementById('viewBirthdate').textContent = birthDate.toLocaleDateString('en-US', {
                    year: 'numeric', month: 'long', day: 'numeric'
                });
                document.getElementById('viewAge').textContent = user.age || 'N/A';
            } else {
                document.getElementById('viewBirthdate').textContent = 'N/A';
                document.getElementById('viewAge').textContent = 'N/A';
            }

            document.getElementById('viewDateJoined').textContent = stats.date_joined || 'N/A';
            document.getElementById('viewLastLogin').textContent = stats.last_login || 'N/A';

            document.getElementById('viewUserModal').classList.add('show');
        })
        .catch(error => {
            console.error('Error loading user details:', error);
            showToast('Error loading user details', 'error');
        });
    }

    function closeViewModal() {
        document.getElementById('viewUserModal').classList.remove('show');
    }

    // Edit Status
    const editStatusModal = document.getElementById('editStatusModal');

    function editUserStatus(userName, userId) {
        closeAllDropdowns();
        document.getElementById('statusUserName').textContent = userName;
        document.getElementById('statusUserId').value = userId;
        document.querySelectorAll('input[name="userStatus"]').forEach(radio => radio.checked = false);
        editStatusModal.classList.add('show');
    }

    function closeEditStatusModal() {
        editStatusModal.classList.remove('show');
    }

    function updateStatus() {
        const selectedStatus = document.querySelector('input[name="userStatus"]:checked');
        const userId = document.getElementById('statusUserId').value;
        
        if (selectedStatus) {
            fetch(`/admin/users/${userId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: selectedStatus.value })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(`Status updated to ${selectedStatus.value}`);
                    closeEditStatusModal();
                    loadUsers(currentPage);
                } else {
                    alert(data.message || 'Error updating status');
                }
            })
            .catch(error => {
                console.error('Error updating status:', error);
                showToast('Error updating status', 'error');
            });
        } else {
            alert('Please select a status');
        }
    }

    // Toast
    function showToast(message, type = 'success') {
        const toast = document.getElementById('successToast');
        const toastMessage = document.getElementById('toastMessage');
        
        toastMessage.textContent = message;
        
        if (type === 'error') {
            toast.querySelector('.bg-green-500').classList.remove('bg-green-500');
            toast.querySelector('.bg-green-500').classList.add('bg-red-500');
        } else {
            toast.querySelector('.bg-red-500')?.classList.remove('bg-red-500');
            toast.querySelector('.bg-red-500')?.classList.add('bg-green-500');
        }
        
        toast.classList.add('show', 'translate-y-0', 'opacity-100');
        toast.classList.remove('translate-y-24', 'opacity-0');

        setTimeout(() => {
            toast.classList.remove('show', 'translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-24', 'opacity-0');
        }, 3000);
    }
</script>

<!-- Add CSRF Token meta tag if not already present -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection