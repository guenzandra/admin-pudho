<!---resources/views/admin/usermanagement.blade.php--->
@extends('admin.layout')

@section('content')
<div class="min-h-screen p-4 sm:p-6 md:p-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg p-4 sm:p-6">
        <!-- Top Bar with Search, Archive and Add Button -->
        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
            <!-- Search Bar - Full width on mobile -->
            <div class="w-full sm:flex-1 sm:max-w-md flex flex-col sm:flex-row gap-2">
                <div class="flex-1 flex border border-gray-200 rounded-lg overflow-hidden focus-within:border-red-500 focus-within:ring-1 focus-within:ring-red-500 transition-all">
                    <input type="text" class="flex-1 px-3 sm:px-4 py-2.5 outline-none text-sm" id="searchInput" placeholder="Search users..." onkeyup="filterTable()">
                    <button class="px-4 bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors flex items-center justify-center gap-2" onclick="filterTable()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="hidden sm:inline">Search</span>
                    </button>
                </div>
            </div>

            <!-- Archive and Add Buttons - Stack on mobile -->
            <div class="flex gap-2 w-full sm:w-auto">
                <button type="button" class="flex-1 sm:flex-none px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:border-red-500 hover:text-red-600 transition-all flex items-center justify-center gap-2" onclick="openArchiveModal()">
                    <i class="bi bi-archive"></i>
                    <span class="hidden xs:inline">Archive</span>
                    <span class="bg-gray-200 px-1.5 py-0.5 rounded-full text-xs" id="archivedCount">0</span>
                </button>
                <button type="button" class="flex-1 sm:flex-none px-4 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium flex items-center justify-center gap-2 hover:bg-red-700 hover:shadow-md transition-all" id="openAddUserModal">
                    <i class="bi bi-person-plus"></i>
                    <span class="hidden xs:inline">Add User</span>
                </button>
            </div>
        </div>

        <!-- Filter Section - Mobile optimized -->
        <div class="flex flex-wrap items-center gap-3 mb-4 sm:mb-6 p-3 sm:p-4 bg-gray-50 rounded-lg">
            <div class="w-full sm:w-auto flex items-center gap-2">
                <i class="bi bi-funnel text-gray-400 text-xs"></i>
                <label class="text-gray-600 text-sm whitespace-nowrap">Position:</label>
                <select id="positionFilter" class="flex-1 sm:w-auto px-3 py-1.5 border border-gray-200 rounded-md text-sm outline-none focus:border-red-500 bg-white" onchange="filterTable()">
                    <option value="all">All</option>
                    <option value="Administrator">Admin</option>
                    <option value="HeadOfficer">Head</option>
                    <option value="Editor">Editor</option>
                    <option value="HousingOfficer">Housing</option>
                    <option value="ApplicationEvaluator">Evaluator</option>
                    <option value="Staff">Staff</option>
                    <option value="SiteInspector">Inspector</option>
                </select>
            </div>

            <div class="w-full sm:w-auto flex items-center gap-2">
                <i class="bi bi-circle text-gray-400 text-xs"></i>
                <label class="text-gray-600 text-sm whitespace-nowrap">Status:</label>
                <select id="statusFilter" class="flex-1 sm:w-auto px-3 py-1.5 border border-gray-200 rounded-md text-sm outline-none focus:border-red-500 bg-white" onchange="filterTable()">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="inactive">Deactivated</option>
                </select>
            </div>

            <span class="w-full sm:w-auto sm:ml-auto text-gray-500 text-xs bg-gray-200 px-3 py-1.5 rounded-full flex items-center justify-center sm:justify-start gap-1" id="resultCount">
                <i class="bi bi-people"></i> Loading...
            </span>
        </div>

        <!-- Table Container - Horizontal scroll on mobile -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 -mx-4 sm:mx-0">
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200" id="userTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Position</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Username</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden xl:table-cell">Email</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                        <!-- Data will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination - Mobile optimized -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
            <div class="flex items-center justify-center sm:justify-start gap-2 w-full sm:w-auto">
                <button class="flex-1 sm:flex-none px-4 py-2 border border-gray-200 bg-white rounded-lg text-sm text-gray-600 font-medium hover:border-red-500 hover:text-red-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2" onclick="changePage('prev')" id="prevPageBtn">
                    <i class="bi bi-chevron-left"></i>
                    <span class="hidden sm:inline">Previous</span>
                </button>
                <span class="text-sm text-gray-600 px-2" id="pageInfo">
                    <span id="currentPage">1</span>/<span id="totalPages">1</span>
                </span>
                <button class="flex-1 sm:flex-none px-4 py-2 border border-gray-200 bg-white rounded-lg text-sm text-gray-600 font-medium hover:border-red-500 hover:text-red-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2" onclick="changePage('next')" id="nextPageBtn">
                    <span class="hidden sm:inline">Next</span>
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
            <div class="text-xs text-gray-500 text-center sm:text-right w-full sm:w-auto">
                <i class="bi bi-info-circle"></i> Click <i class="bi bi-three-dots"></i> for more options
            </div>
        </div>
    </div>
</div>

<!-- Custom Toast Container -->
<div class="fixed top-2 right-2 left-2 sm:left-auto sm:right-5 sm:w-auto z-[1100] space-y-2" id="toastContainer"></div>

<!-- Add User Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="addUserModal">
    <div class="bg-white rounded-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-xl">
        <div class="sticky top-0 bg-white flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200 z-10">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-person-plus text-red-600 me-2"></i>Add New User
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeAddUserModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <form class="p-4 sm:p-6" id="addUserForm" enctype="multipart/form-data">
            @csrf
            <!-- Profile Uploader -->
            <div class="mb-6">
                <div class="flex flex-col items-center mb-4">
                    <div class="relative">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gray-100 border-2 border-gray-300 flex items-center justify-center text-gray-400 text-2xl sm:text-3xl mb-2 overflow-hidden" id="profilePreview">
                            <i class="bi bi-camera"></i>
                        </div>
                        <label for="profileImage" class="absolute bottom-0 right-0 w-7 h-7 sm:w-8 sm:h-8 bg-white rounded-full shadow-md flex items-center justify-center cursor-pointer hover:bg-gray-50 transition-colors border border-gray-300">
                            <i class="bi bi-pencil text-gray-500 text-xs sm:text-sm"></i>
                        </label>
                        <input type="file" name="profile_img" id="profileImage" class="hidden" accept="image/*" onchange="previewProfileImage(event)">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 text-center">
                        <i class="bi bi-info-circle me-1"></i>Upload profile picture (optional, max 2MB)
                    </p>
                </div>

                <h4 class="text-gray-700 font-semibold text-sm mb-3 pb-2 border-b border-gray-200">
                    <i class="bi bi-person me-2 text-gray-400"></i>Personal Information
                </h4>

                <!-- Name fields - Stack on mobile -->
                <div class="space-y-3 mb-3">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="first_name" name="first_name" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="First name" required>
                            <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-first_name"></div>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="Middle name">
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="last_name" name="last_name" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="Last name" required>
                            <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-last_name"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1">Suffix</label>
                        <input type="text" id="suffix" name="suffix" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="Jr., Sr., III, etc.">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select id="gender" name="gender" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-white" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-gender"></div>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">
                                Birthdate <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="birthdate" name="birthdate" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" required max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>">
                            <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-birthdate"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1">
                            <i class="bi bi-telephone me-1 text-gray-400"></i>Contact Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="contact" name="contact_no" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" placeholder="09123456789" required maxlength="11" pattern="[0-9]{11}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-contact_no"></div>
                    </div>

                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1">
                            <i class="bi bi-envelope me-1 text-gray-400"></i>Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" placeholder="email@example.com" required>
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-email"></div>
                    </div>
                </div>

                <h4 class="text-gray-700 font-semibold text-sm mb-3 pb-2 border-b border-gray-200">
                    <i class="bi bi-lock me-2 text-gray-400"></i>Account Information
                </h4>

                <div class="space-y-3">
                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1">
                            <i class="bi bi-briefcase me-1 text-gray-400"></i>Position <span class="text-red-500">*</span>
                        </label>
                        <select id="position" name="position" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-white" required>
                            <option value="" disabled selected>Select position</option>
                            <option value="Administrator">Administrator</option>
                            <option value="HeadOfficer">Head Officer</option>
                            <option value="Editor">Editor</option>
                            <option value="HousingOfficer">Housing Officer</option>
                            <option value="ApplicationEvaluator">Application Evaluator</option>
                            <option value="Staff">Staff</option>
                            <option value="SiteInspector">Site Inspector</option>
                        </select>
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-position"></div>
                    </div>

                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1">
                            <i class="bi bi-person-circle me-1 text-gray-400"></i>Username <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2">
                            <input type="text" id="username" name="username" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-gray-50" readonly required>
                            <button type="button" class="px-3 sm:px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all whitespace-nowrap" onclick="generateUsername()">
                                <i class="bi bi-arrow-repeat"></i>
                                <span class="hidden sm:inline ms-2">Generate</span>
                            </button>
                        </div>
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-username"></div>
                    </div>

                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1">
                            <i class="bi bi-key me-1 text-gray-400"></i>Password <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2">
                            <input type="text" id="password" name="password" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-gray-50" readonly required>
                            <button type="button" class="px-3 sm:px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all whitespace-nowrap" onclick="generatePassword()">
                                <i class="bi bi-arrow-repeat"></i>
                                <span class="hidden sm:inline ms-2">Generate</span>
                            </button>
                        </div>
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-password"></div>
                    </div>
                </div>
            </div>
        </form>

        <div class="sticky bottom-0 bg-white flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeAddUserModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 hover:shadow-md transition-all relative" onclick="saveUser()" id="saveUserBtn">
                <span class="inline-flex items-center justify-center">
                    <i class="bi bi-save me-2"></i>
                    <span class="btn-text">Save</span>
                    <span class="loading-spinner hidden ml-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>

<!-- Archive/Recycle Bin Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="archiveModal">
    <div class="bg-white rounded-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto shadow-xl">
        <div class="sticky top-0 bg-white flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-trash text-red-600 me-2"></i>Recycle Bin
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeArchiveModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <div class="p-4 sm:p-6">
            <!-- Stats cards - Stack on mobile -->
            <div class="grid grid-cols-2 gap-3 sm:gap-4 mb-4 sm:mb-6">
                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg text-center">
                    <i class="bi bi-people text-red-600 text-xl sm:text-2xl mb-2"></i>
                    <span class="block text-xl sm:text-2xl font-bold text-red-600 mb-1" id="archivedTotal">0</span>
                    <span class="text-gray-500 text-xs">Archived</span>
                </div>
                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg text-center">
                    <i class="bi bi-clock text-red-600 text-xl sm:text-2xl mb-2"></i>
                    <span class="block text-xl sm:text-2xl font-bold text-red-600 mb-1" id="pendingDeletion">0</span>
                    <span class="text-gray-500 text-xs">Expiring</span>
                </div>
            </div>

            <!-- Archive table - Horizontal scroll on mobile -->
            <div class="overflow-x-auto mb-4 -mx-4 sm:mx-0">
                <div class="inline-block min-w-full align-middle px-4 sm:px-0">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 sm:px-4 py-2.5 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-3 sm:px-4 py-2.5 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Position</th>
                                <th class="px-3 sm:px-4 py-2.5 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Archived</th>
                                <th class="px-3 sm:px-4 py-2.5 text-left text-xs font-medium text-gray-500 uppercase">Expires</th>
                                <th class="px-3 sm:px-4 py-2.5 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="archiveBody" class="bg-white divide-y divide-gray-200">
                            <!-- Archive data will be populated -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-orange-50 p-3 rounded-lg text-orange-700 text-xs flex items-start gap-2">
                <i class="bi bi-info-circle mt-0.5"></i>
                <span>Items are permanently deleted after 30 days</span>
            </div>
        </div>

        <div class="sticky bottom-0 bg-white flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeArchiveModal()">
                <i class="bi bi-x me-2"></i>Close
            </button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="emptyRecycleBin()">
                <i class="bi bi-trash me-2"></i>Empty
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="deleteModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-exclamation-triangle text-orange-500 me-2"></i>Move to Recycle Bin?
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeDeleteModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <div class="p-6 sm:p-8 text-center">
            <i class="bi bi-trash text-4xl text-orange-500 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Move <strong id="deleteUserName" class="text-red-600"></strong> to recycle bin?</p>
            <p class="text-gray-400 text-xs">
                <i class="bi bi-info-circle me-1"></i>Account can be restored within 30 days
            </p>
            <input type="hidden" id="deleteUserId">
        </div>

        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeDeleteModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-orange-600 text-white rounded-lg text-sm font-medium hover:bg-orange-700 transition-all" onclick="moveToArchive()" id="moveToArchiveBtn">
                <span class="inline-flex items-center">
                    <i class="bi bi-archive me-2"></i>
                    <span class="btn-text">Move</span>
                    <span class="loading-spinner hidden ml-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>

<!-- Restore Confirmation Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="restoreModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-arrow-return-left text-green-600 me-2"></i>Restore User
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeRestoreModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <div class="p-6 sm:p-8 text-center">
            <i class="bi bi-arrow-return-left text-4xl text-green-600 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Restore <strong id="restoreUserName" class="text-green-600"></strong>?</p>
            <p class="text-gray-400 text-xs">
                <i class="bi bi-info-circle me-1"></i>Account will be reactivated
            </p>
            <input type="hidden" id="restoreArchiveId">
        </div>

        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeRestoreModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="restoreUser()" id="restoreUserBtn">
                <span class="inline-flex items-center">
                    <i class="bi bi-arrow-return-left me-2"></i>
                    <span class="btn-text">Restore</span>
                    <span class="loading-spinner hidden ml-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>

<!-- Permanent Delete Confirmation -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="permanentDeleteModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-exclamation-circle text-red-600 me-2"></i>Permanently Delete?
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closePermanentDeleteModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <div class="p-6 sm:p-8 text-center">
            <i class="bi bi-exclamation-triangle text-4xl text-red-600 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Delete <strong id="permanentDeleteUserName" class="text-red-600"></strong> permanently?</p>
            <p class="text-gray-400 text-xs">
                <i class="bi bi-exclamation-circle me-1"></i>This action cannot be undone
            </p>
            <input type="hidden" id="permanentDeleteArchiveId">
        </div>

        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closePermanentDeleteModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="permanentDelete()" id="permanentDeleteBtn">
                <span class="inline-flex items-center">
                    <i class="bi bi-trash me-2"></i>
                    <span class="btn-text">Delete</span>
                    <span class="loading-spinner hidden ml-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>

<!-- View User Details Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="viewUserModal">
    <div class="bg-white rounded-xl w-full max-w-2xl shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-person-circle text-red-600 me-2"></i>User Profile
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeViewModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <div class="p-4 sm:p-6 bg-gradient-to-r from-red-600 to-red-700 text-white">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-xl sm:text-2xl font-bold border-2 border-white overflow-hidden flex-shrink-0" id="viewProfileImage">
                    <img src="" alt="Profile" class="w-full h-full object-cover hidden" id="viewProfileImg">
                    <span class="initials" id="avatarInitials">JD</span>
                </div>
                <div class="text-center sm:text-left">
                    <h2 class="text-lg sm:text-xl font-bold" id="viewFullName">John A. Doe</h2>
                    <span class="text-xs opacity-90 block mt-1" id="viewPosition">
                        <i class="bi bi-briefcase me-1"></i>Administrator
                    </span>
                </div>
                <span class="sm:ml-auto px-3 py-1 bg-white bg-opacity-20 rounded-full text-xs font-medium flex items-center gap-1 whitespace-nowrap" id="viewStatusBadge">
                    <i class="bi bi-circle-fill text-green-300"></i> Active
                </span>
            </div>
        </div>

        <div class="p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-person me-1"></i>Username
                    </span>
                    <span class="text-gray-800 text-sm font-medium break-all" id="viewUsername">johndoe_admin</span>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span class="block text-gray-400 text-xs mb-1">
                        <i class="bi bi-envelope me-1"></i>Email
                    </span>
                    <span class="text-gray-800 text-sm font-medium break-all" id="viewEmail">john.doe@example.com</span>
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

        <div class="flex justify-end px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeViewModal()">
                <i class="bi bi-x me-2"></i>Close
            </button>
        </div>
    </div>
</div>

<!-- Edit Status Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="editStatusModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-pencil-square text-red-600 me-2"></i>Update Status
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeEditStatusModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <div class="p-4 sm:p-6">
            <p class="text-gray-600 text-sm mb-4">
                <i class="bi bi-person me-1"></i>Update for: <strong id="statusUserName" class="text-red-600"></strong>
            </p>
            <input type="hidden" id="statusUserId">
            <input type="hidden" id="currentStatus">

            <div class="flex flex-col gap-2">
                <label class="status-card cursor-pointer border rounded-lg overflow-hidden hover:border-red-500 transition-all p-3 flex items-center gap-3" data-status="active">
                    <input type="radio" name="userStatus" value="active" class="hidden">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <span class="font-medium text-gray-700 text-sm w-20">Active</span>
                    <span class="text-gray-400 text-xs flex-1 hidden sm:inline">User can access</span>
                    <span class="selected-indicator ml-auto text-red-600 hidden">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>
                </label>

                <label class="status-card cursor-pointer border rounded-lg overflow-hidden hover:border-red-500 transition-all p-3 flex items-center gap-3" data-status="inactive">
                    <input type="radio" name="userStatus" value="inactive" class="hidden">
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                    <span class="font-medium text-gray-700 text-sm w-20">Deactivated</span>
                    <span class="text-gray-400 text-xs flex-1 hidden sm:inline">Cannot login</span>
                    <span class="selected-indicator ml-auto text-red-600 hidden">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>
                </label>
            </div>
        </div>

        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeEditStatusModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="updateStatus()" id="updateStatusBtn">
                <span class="inline-flex items-center">
                    <i class="bi bi-save me-2"></i>
                    <span class="btn-text">Update</span>
                    <span class="loading-spinner hidden ml-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="resetPasswordModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-key text-red-600 me-2"></i>Reset Password
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeResetPasswordModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <div class="p-4 sm:p-6">
            <p class="text-gray-600 text-sm mb-4">
                <i class="bi bi-person me-1"></i>Reset password for: <strong id="resetPasswordUserName" class="text-red-600"></strong>
            </p>
            <input type="hidden" id="resetPasswordUserId">

            <div class="space-y-4">
                <div class="form-group">
                    <label class="block text-gray-600 text-xs font-medium mb-1">
                        <i class="bi bi-shield-lock me-1"></i>New Password
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="newPassword" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-gray-50" readonly>
                        <button type="button" class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all" onclick="generateNewPassword()">
                            <i class="bi bi-arrow-repeat"></i>
                            <span class="hidden sm:inline ms-2">Generate</span>
                        </button>
                    </div>
                </div>

                <div class="bg-blue-50 p-3 rounded-lg text-blue-700 text-xs flex items-start gap-2">
                    <i class="bi bi-info-circle mt-0.5"></i>
                    <span>Password must be at least 8 characters with letters and numbers</span>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeResetPasswordModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="resetPassword()" id="resetPasswordBtn">
                <span class="inline-flex items-center">
                    <i class="bi bi-key me-2"></i>
                    <span class="btn-text">Reset Password</span>
                    <span class="loading-spinner hidden ml-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>

<!-- Reset Username Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="resetUsernameModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                <i class="bi bi-person-circle text-red-600 me-2"></i>Reset Username
            </h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeResetUsernameModal()">
                <i class="bi bi-x text-xl"></i>
            </button>
        </div>

        <div class="p-4 sm:p-6">
            <p class="text-gray-600 text-sm mb-4">
                <i class="bi bi-person me-1"></i>Reset username for: <strong id="resetUsernameUserName" class="text-red-600"></strong>
            </p>
            <input type="hidden" id="resetUsernameUserId">

            <div class="space-y-4">
                <div class="form-group">
                    <label class="block text-gray-600 text-xs font-medium mb-1">
                        <i class="bi bi-person-badge me-1"></i>Current Username
                    </label>
                    <input type="text" id="currentUsername" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50" readonly>
                </div>

                <div class="form-group">
                    <label class="block text-gray-600 text-xs font-medium mb-1">
                        <i class="bi bi-person-plus me-1"></i>New Username
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="newUsername" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-gray-50" readonly>
                        <button type="button" class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all" onclick="generateNewUsername()">
                            <i class="bi bi-arrow-repeat"></i>
                            <span class="hidden sm:inline ms-2">Generate</span>
                        </button>
                    </div>
                </div>

                <div class="bg-blue-50 p-3 rounded-lg text-blue-700 text-xs flex items-start gap-2">
                    <i class="bi bi-info-circle mt-0.5"></i>
                    <span>Username is based on user's first and last name</span>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeResetUsernameModal()">
                <i class="bi bi-x me-2"></i>Cancel
            </button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="resetUsername()" id="resetUsernameBtn">
                <span class="inline-flex items-center">
                    <i class="bi bi-person-check me-2"></i>
                    <span class="btn-text">Reset Username</span>
                    <span class="loading-spinner hidden ml-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>

<style>
    /* Custom styles */
    .modal.show {
        display: flex;
    }

    .actions-menu.show {
        display: block;
    }

    .status-card.selected {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .status-card.selected .selected-indicator {
        display: block !important;
    }

    .status-badge {
        @apply px-2 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1;
    }

    .status-active {
        @apply bg-green-100 text-green-700;
    }

    .status-inactive {
        @apply bg-gray-100 text-gray-700;
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

    .actions-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 4px;
        z-index: 100;
        min-width: 180px;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    /* Mobile-friendly actions menu */
    @media (max-width: 640px) {
        .actions-menu {
            position: fixed;
            top: auto;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            margin: 0;
            border-radius: 1rem 1rem 0 0;
            animation: slideUp 0.3s ease;
        }
        
        .actions-menu button {
            padding: 12px 16px;
        }
    }

    /* Toast animations */
    .toast-item {
        animation: slideInRight 0.3s ease forwards;
    }

    .toast-item.hide {
        animation: slideOutRight 0.3s ease forwards;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    /* Mobile toast */
    @media (max-width: 640px) {
        @keyframes slideInRight {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-100%);
                opacity: 0;
            }
        }
    }

    /* Form validation styles */
    .form-group.error input,
    .form-group.error select {
        border-color: #ef4444;
    }

    .error-message {
        color: #ef4444;
    }

    /* Loading spinner animation */
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    /* Button loading state */
    button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Responsive utilities */
    @media (max-width: 480px) {
        .hidden-xs {
            display: none;
        }
    }
</style>

<!-- Bootstrap Icons -->
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
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

        // Add status card click handlers
        document.querySelectorAll('.status-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.status-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // Set max birthdate to 18 years ago
        const birthdateInput = document.getElementById('birthdate');
        if (birthdateInput) {
            const maxDate = new Date();
            maxDate.setFullYear(maxDate.getFullYear() - 18);
            birthdateInput.max = maxDate.toISOString().split('T')[0];
        }

        // Add real-time validation
        document.getElementById('email')?.addEventListener('input', validateEmailField);
        document.getElementById('contact')?.addEventListener('input', validatePhoneField);
        
        // Add real-time validation for other fields
        document.getElementById('first_name')?.addEventListener('input', function() {
            clearFieldError('first_name');
        });
        document.getElementById('last_name')?.addEventListener('input', function() {
            clearFieldError('last_name');
        });
        document.getElementById('gender')?.addEventListener('change', function() {
            clearFieldError('gender');
        });
        document.getElementById('birthdate')?.addEventListener('change', function() {
            clearFieldError('birthdate');
        });
        document.getElementById('position')?.addEventListener('change', function() {
            clearFieldError('position');
        });
    });

    // Debounce function
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

    // Clear field error
    function clearFieldError(field) {
        const errorEl = document.getElementById(`error-${field}`);
        const inputEl = document.querySelector(`[name="${field}"]`);
        
        if (errorEl) {
            errorEl.classList.add('hidden');
            errorEl.textContent = '';
        }
        
        if (inputEl) {
            inputEl.closest('.form-group')?.classList.remove('error');
        }
    }

    // Validate email
    function validateEmailField() {
        const email = document.getElementById('email')?.value;
        const errorEl = document.getElementById('error-email');
        const inputEl = document.getElementById('email');
        if (!inputEl) return true;
        
        const formGroup = inputEl.closest('.form-group');
        
        if (!email) {
            if (errorEl) {
                errorEl.textContent = 'Email is required';
                errorEl.classList.remove('hidden');
                formGroup?.classList.add('error');
            }
            return false;
        } else if (!email.includes('@') || !email.includes('.')) {
            if (errorEl) {
                errorEl.textContent = 'Please enter a valid email address';
                errorEl.classList.remove('hidden');
                formGroup?.classList.add('error');
            }
            return false;
        } else {
            if (errorEl) {
                errorEl.classList.add('hidden');
                formGroup?.classList.remove('error');
            }
            return true;
        }
    }

    // Validate phone
    function validatePhoneField() {
        const phone = document.getElementById('contact')?.value;
        const errorEl = document.getElementById('error-contact_no');
        const inputEl = document.getElementById('contact');
        if (!inputEl) return true;
        
        const formGroup = inputEl.closest('.form-group');
        
        const numericPhone = phone ? phone.replace(/[^0-9]/g, '') : '';
        
        if (!phone) {
            if (errorEl) {
                errorEl.textContent = 'Contact number is required';
                errorEl.classList.remove('hidden');
                formGroup?.classList.add('error');
            }
            return false;
        } else if (numericPhone.length !== 11) {
            if (errorEl) {
                errorEl.textContent = 'Contact number must be exactly 11 digits';
                errorEl.classList.remove('hidden');
                formGroup?.classList.add('error');
            }
            return false;
        } else {
            if (errorEl) {
                errorEl.classList.add('hidden');
                formGroup?.classList.remove('error');
            }
            return true;
        }
    }

    // Toast notification
    function showToast(message, type = 'success', duration = 3000) {
        const toastContainer = document.getElementById('toastContainer');
        const toastId = 'toast-' + Date.now();
        
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle';
        
        const toastHTML = `
            <div id="${toastId}" class="toast-item flex items-center gap-3 ${bgColor} text-white px-4 py-3 rounded-lg shadow-lg mb-2 w-full sm:min-w-[300px]">
                <i class="bi ${icon} text-lg flex-shrink-0"></i>
                <span class="flex-1 text-sm break-all">${message}</span>
                <button onclick="closeToast('${toastId}')" class="text-white hover:text-gray-200 flex-shrink-0">
                    <i class="bi bi-x text-xl"></i>
                </button>
            </div>
        `;
        
        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        
        setTimeout(() => {
            closeToast(toastId);
        }, duration);
    }

    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.add('hide');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }

    // Show validation errors
    function showValidationErrors(errors) {
        document.querySelectorAll('.error-message').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        document.querySelectorAll('.form-group').forEach(el => {
            el.classList.remove('error');
        });

        for (let field in errors) {
            const errorEl = document.getElementById(`error-${field}`);
            const inputEl = document.querySelector(`[name="${field}"]`);
            
            if (errorEl) {
                errorEl.textContent = errors[field][0];
                errorEl.classList.remove('hidden');
                
                if (inputEl) {
                    inputEl.closest('.form-group')?.classList.add('error');
                }
            }
        }
    }

    // Load users
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
            if (data.success) {
                renderTable(data.users.data);
                currentPage = data.users.current_page;
                lastPage = data.users.last_page;
                totalUsers = data.users.total;
                
                document.getElementById('archivedCount').textContent = data.archived_count || 0;
                
                updatePagination();
                document.getElementById('resultCount').innerHTML = 
                    `<i class="bi bi-people me-1"></i> ${data.users.data.length} of ${totalUsers}`;
            }
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
            if (data.success) {
                document.getElementById('archivedTotal').textContent = data.stats.total;
                document.getElementById('pendingDeletion').textContent = data.stats.expired;
            }
        })
        .catch(error => console.error('Error loading archive stats:', error));
    }

    // Render table
    function renderTable(users) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        users.forEach(user => {
            let statusClass = user.is_active ? 'active' : 'inactive';
            let statusText = user.is_active ? 'Active' : 'Deactivated';
            let statusColor = user.is_active ? 'green' : 'gray';
            
            const profileImage = user.profile_img ? 
                `<img src="/storage/${user.profile_img}" class="w-7 h-7 rounded-full object-cover" alt="Profile">` : 
                `<div class="w-7 h-7 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-semibold text-xs">${user.initials || 'U'}</div>`;
            
            const fullName = user.full_name || `${user.first_name} ${user.middle_name || ''} ${user.last_name} ${user.suffix || ''}`;
            
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50 transition-colors';
            row.innerHTML = `
                <td class="px-3 sm:px-4 py-3">
                    <div class="flex items-center gap-2">
                        ${profileImage}
                    </div>
                </td>
                <td class="px-3 sm:px-4 py-3">
                    <div class="flex items-center">
                        <span class="text-xs sm:text-sm font-medium text-gray-900 truncate max-w-[80px] sm:max-w-none">${fullName}</span>
                    </div>
                </td>
                <td class="px-3 sm:px-4 py-3 hidden md:table-cell">
                    <span class="text-xs sm:text-sm">${user.position || 'N/A'}</span>
                </td>
                <td class="px-3 sm:px-4 py-3 hidden lg:table-cell">
                    <span class="text-xs sm:text-sm">${user.username || 'N/A'}</span>
                </td>
                <td class="px-3 sm:px-4 py-3 hidden xl:table-cell">
                    <span class="text-xs sm:text-sm truncate max-w-[150px]">${user.email}</span>
                </td>
                <td class="px-3 sm:px-4 py-3">
                    <span class="status-badge status-${statusClass} text-xs">
                        <i class="bi bi-circle-fill text-${statusColor}-400 me-1"></i>
                        ${statusText}
                    </span>
                </td>
                <td class="px-3 sm:px-4 py-3 relative" style="overflow: visible;">
                    <button class="actions-btn w-7 h-7 sm:w-8 sm:h-8 bg-gray-100 rounded-lg text-gray-600 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center" onclick="toggleActionsMenu(this, ${user.user_id})">
                        <i class="bi bi-three-dots text-sm sm:text-base"></i>
                    </button>
                    <div class="actions-menu hidden fixed sm:absolute bottom-0 sm:top-full left-0 sm:left-auto right-0 sm:right-0 sm:bottom-auto bg-white rounded-t-xl sm:rounded-lg shadow-lg z-50 w-full sm:w-48 sm:min-w-[180px] mt-0 sm:mt-1 border border-gray-200 overflow-hidden" id="menu-${user.user_id}">
                        <button class="w-full text-left px-4 py-3 sm:py-2.5 text-sm text-gray-600 hover:bg-gray-50 flex items-center gap-2 border-b sm:border-b-0 border-gray-100" onclick="viewUser(${user.user_id})">
                            <i class="bi bi-eye text-blue-500 w-4"></i> View Details
                        </button>
                        <button class="w-full text-left px-4 py-3 sm:py-2.5 text-sm text-gray-600 hover:bg-gray-50 flex items-center gap-2 border-b sm:border-b-0 border-gray-100" onclick="editUserStatus('${fullName}', ${user.user_id}, '${user.is_active ? 'active' : 'inactive'}')">
                            <i class="bi bi-pencil-square text-green-500 w-4"></i> Edit Status
                        </button>
                        <button class="w-full text-left px-4 py-3 sm:py-2.5 text-sm text-gray-600 hover:bg-gray-50 flex items-center gap-2 border-b sm:border-b-0 border-gray-100" onclick="openResetPasswordModal('${fullName}', ${user.user_id})">
                            <i class="bi bi-key text-yellow-500 w-4"></i> Reset Password
                        </button>
                        <button class="w-full text-left px-4 py-3 sm:py-2.5 text-sm text-gray-600 hover:bg-gray-50 flex items-center gap-2 border-b sm:border-b-0 border-gray-100" onclick="openResetUsernameModal('${fullName}', ${user.user_id}, '${user.username || ''}')">
                            <i class="bi bi-person-circle text-purple-500 w-4"></i> Reset Username
                        </button>
                        <button class="w-full text-left px-4 py-3 sm:py-2.5 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2" onclick="openDeleteModal('${fullName}', ${user.user_id})">
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
        
        document.querySelectorAll('.error-message').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        document.querySelectorAll('.form-group').forEach(el => {
            el.classList.remove('error');
        });
    };

    function closeAddUserModal() {
        addUserModal.classList.remove('show');
    }

    // Profile Image Preview
    function previewProfileImage(event) {
        const file = event.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                showToast('Image size should be less than 2MB', 'error');
                event.target.value = '';
                return;
            }
            
            if (!file.type.startsWith('image/')) {
                showToast('Please upload an image file', 'error');
                event.target.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profilePreview');
                preview.innerHTML = `<img src="${e.target.result}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover border-2 border-white shadow-md" alt="Profile">`;
            };
            reader.readAsDataURL(file);
        }
    }

    // Generate Username
    function generateUsername() {
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;

        if (!firstName || !lastName) {
            showToast('Please enter first name and last name first', 'error');
            return;
        }

        const generateBtn = event.target.closest('button');
        const originalText = generateBtn.innerHTML;
        generateBtn.innerHTML = '<i class="bi bi-hourglass"></i><span class="hidden sm:inline ms-2">Generating...</span>';
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
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('username').value = data.username;
                clearFieldError('username');
                showToast('Username generated successfully');
            } else {
                showToast(data.message || 'Error generating username', 'error');
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
    }

    // Generate Password
    function generatePassword() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
        let password = '';
        for (let i = 0; i < 12; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('password').value = password;
        clearFieldError('password');
        showToast('Password generated successfully');
    }

    // Save User
    function saveUser() {
        const form = document.getElementById('addUserForm');
        const formData = new FormData(form);
        
        let hasError = false;
        
        const firstName = document.getElementById('first_name').value;
        if (!firstName) {
            document.getElementById('error-first_name').textContent = 'First name is required';
            document.getElementById('error-first_name').classList.remove('hidden');
            document.getElementById('first_name').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const lastName = document.getElementById('last_name').value;
        if (!lastName) {
            document.getElementById('error-last_name').textContent = 'Last name is required';
            document.getElementById('error-last_name').classList.remove('hidden');
            document.getElementById('last_name').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const gender = document.getElementById('gender').value;
        if (!gender) {
            document.getElementById('error-gender').textContent = 'Gender is required';
            document.getElementById('error-gender').classList.remove('hidden');
            document.getElementById('gender').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const birthdate = document.getElementById('birthdate').value;
        if (!birthdate) {
            document.getElementById('error-birthdate').textContent = 'Birthdate is required';
            document.getElementById('error-birthdate').classList.remove('hidden');
            document.getElementById('birthdate').closest('.form-group').classList.add('error');
            hasError = true;
        } else {
            const birthDate = new Date(birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            if (age < 18) {
                document.getElementById('error-birthdate').textContent = 'User must be at least 18 years old';
                document.getElementById('error-birthdate').classList.remove('hidden');
                document.getElementById('birthdate').closest('.form-group').classList.add('error');
                hasError = true;
            }
        }
        
        const position = document.getElementById('position').value;
        if (!position) {
            document.getElementById('error-position').textContent = 'Position is required';
            document.getElementById('error-position').classList.remove('hidden');
            document.getElementById('position').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const username = document.getElementById('username').value;
        if (!username) {
            document.getElementById('error-username').textContent = 'Username is required';
            document.getElementById('error-username').classList.remove('hidden');
            document.getElementById('username').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const password = document.getElementById('password').value;
        if (!password) {
            document.getElementById('error-password').textContent = 'Password is required';
            document.getElementById('error-password').classList.remove('hidden');
            document.getElementById('password').closest('.form-group').classList.add('error');
            hasError = true;
        } else if (password.length < 8) {
            document.getElementById('error-password').textContent = 'Password must be at least 8 characters';
            document.getElementById('error-password').classList.remove('hidden');
            document.getElementById('password').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const emailValid = validateEmailField();
        if (!emailValid) hasError = true;
        
        const phoneValid = validatePhoneField();
        if (!phoneValid) hasError = true;
        
        if (hasError) {
            showToast('Please fix the errors in the form', 'error');
            return;
        }

        const saveBtn = document.getElementById('saveUserBtn');
        const btnText = saveBtn.querySelector('.btn-text');
        const spinner = saveBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Saving...';
        spinner.classList.remove('hidden');
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
                
                document.getElementById('addUserForm').reset();
                document.getElementById('profilePreview').innerHTML = '<i class="bi bi-camera"></i>';
            } else {
                if (data.errors) {
                    showValidationErrors(data.errors);
                    showToast('Please check the form for errors', 'error');
                } else {
                    showToast(data.message || 'Error creating user', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error saving user:', error);
            showToast('Error saving user', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
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
        
        const moveBtn = document.getElementById('moveToArchiveBtn');
        const btnText = moveBtn.querySelector('.btn-text');
        const spinner = moveBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Moving...';
        spinner.classList.remove('hidden');
        moveBtn.disabled = true;
        
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
                showToast('User moved to recycle bin');
                closeDeleteModal();
                loadUsers(currentPage);
                loadArchiveStats();
            } else {
                showToast(data.message || 'Error archiving user', 'error');
            }
        })
        .catch(error => {
            console.error('Error archiving user:', error);
            showToast('Error archiving user', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            moveBtn.disabled = false;
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
            if (data.success) {
                renderArchiveTable(data.archived_users);
                document.getElementById('archivedTotal').textContent = data.stats.total;
                document.getElementById('pendingDeletion').textContent = data.stats.expired;
            }
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
            const expiresText = daysLeft > 0 ? `${daysLeft}d` : 'Expired';

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-3 sm:px-4 py-2.5 text-xs sm:text-sm">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-person-slash text-gray-400"></i>
                        <span class="truncate max-w-[80px] sm:max-w-none">${user.first_name} ${user.last_name}</span>
                    </div>
                </td>
                <td class="px-3 sm:px-4 py-2.5 text-xs sm:text-sm hidden sm:table-cell">${user.position || 'N/A'}</td>
                <td class="px-3 sm:px-4 py-2.5 text-xs sm:text-sm hidden md:table-cell">${archivedDate}</td>
                <td class="px-3 sm:px-4 py-2.5 text-xs sm:text-sm">
                    <span class="${daysLeft <= 7 ? 'text-red-600' : 'text-gray-600'}">${expiresText}</span>
                </td>
                <td class="px-3 sm:px-4 py-2.5">
                    <button class="text-blue-600 hover:text-blue-800 mr-2 transition-colors" onclick="restoreFromArchive(${user.archive_id}, '${user.first_name} ${user.last_name}')" title="Restore">
                        <i class="bi bi-arrow-return-left"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800 transition-colors" onclick="permanentDeletePrompt(${user.archive_id}, '${user.first_name} ${user.last_name}')" title="Delete">
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
        
        const restoreBtn = document.getElementById('restoreUserBtn');
        const btnText = restoreBtn.querySelector('.btn-text');
        const spinner = restoreBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Restoring...';
        spinner.classList.remove('hidden');
        restoreBtn.disabled = true;
        
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
                showToast('User restored successfully');
                closeRestoreModal();
                loadArchivedUsers();
                loadUsers(currentPage);
                loadArchiveStats();
            } else {
                showToast(data.message || 'Error restoring user', 'error');
            }
        })
        .catch(error => {
            console.error('Error restoring user:', error);
            showToast('Error restoring user', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            restoreBtn.disabled = false;
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
        
        const deleteBtn = document.getElementById('permanentDeleteBtn');
        const btnText = deleteBtn.querySelector('.btn-text');
        const spinner = deleteBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Deleting...';
        spinner.classList.remove('hidden');
        deleteBtn.disabled = true;
        
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
                showToast('User permanently deleted');
                closePermanentDeleteModal();
                loadArchivedUsers();
                loadArchiveStats();
            } else {
                showToast(data.message || 'Error deleting user', 'error');
            }
        })
        .catch(error => {
            console.error('Error deleting user:', error);
            showToast('Error deleting user', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            deleteBtn.disabled = false;
        });
    }

    // Empty Recycle Bin
    function emptyRecycleBin() {
        if (confirm('Permanently delete all expired items?')) {
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
                    showToast(data.message || 'Error emptying recycle bin', 'error');
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
            if (data.success) {
                const user = data.user;
                const stats = data.stats;
                
                const profileImg = document.getElementById('viewProfileImg');
                const initials = document.getElementById('avatarInitials');
                
                if (user.profile_img) {
                    profileImg.src = `/storage/${user.profile_img}`;
                    profileImg.classList.remove('hidden');
                    initials.classList.add('hidden');
                } else {
                    profileImg.classList.add('hidden');
                    initials.classList.remove('hidden');
                    initials.textContent = user.initials || 'U';
                }
                
                document.getElementById('viewFullName').textContent = user.full_name || `${user.first_name} ${user.middle_name || ''} ${user.last_name} ${user.suffix || ''}`;
                document.getElementById('viewPosition').innerHTML = `<i class="bi bi-briefcase me-1"></i>${user.position || 'N/A'}`;

                let statusColor = user.is_active ? 'green' : 'gray';
                let statusText = user.is_active ? 'Active' : 'Deactivated';
                
                document.getElementById('viewStatusBadge').innerHTML = `<i class="bi bi-circle-fill text-${statusColor}-300"></i> ${statusText}`;

                document.getElementById('viewUsername').textContent = user.username || 'N/A';
                document.getElementById('viewEmail').textContent = user.email;
                document.getElementById('viewContact').textContent = user.contact_no || 'N/A';
                document.getElementById('viewGender').textContent = user.gender ? user.gender.charAt(0).toUpperCase() + user.gender.slice(1).replace('_', ' ') : 'N/A';

                if (user.birthdate) {
                    const birthDate = new Date(user.birthdate);
                    document.getElementById('viewBirthdate').textContent = birthDate.toLocaleDateString('en-US', {
                        year: 'numeric', month: 'long', day: 'numeric'
                    });
                    
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    document.getElementById('viewAge').textContent = age;
                } else {
                    document.getElementById('viewBirthdate').textContent = 'N/A';
                    document.getElementById('viewAge').textContent = 'N/A';
                }

                document.getElementById('viewDateJoined').textContent = stats.date_joined || 'N/A';
                document.getElementById('viewLastLogin').textContent = stats.last_login || 'N/A';

                document.getElementById('viewUserModal').classList.add('show');
            }
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

    function editUserStatus(userName, userId, currentStatus) {
        closeAllDropdowns();
        document.getElementById('statusUserName').textContent = userName;
        document.getElementById('statusUserId').value = userId;
        document.getElementById('currentStatus').value = currentStatus;
        
        document.querySelectorAll('.status-card').forEach(card => {
            card.classList.remove('selected');
            card.querySelector('input[type="radio"]').checked = false;
        });
        
        const currentCard = document.querySelector(`.status-card[data-status="${currentStatus}"]`);
        if (currentCard) {
            currentCard.classList.add('selected');
            currentCard.querySelector('input[type="radio"]').checked = true;
        }
        
        editStatusModal.classList.add('show');
    }

    function closeEditStatusModal() {
        editStatusModal.classList.remove('show');
    }

    function updateStatus() {
        const selectedRadio = document.querySelector('input[name="userStatus"]:checked');
        const userId = document.getElementById('statusUserId').value;
        
        if (!selectedRadio) {
            showToast('Please select a status', 'error');
            return;
        }
        
        const selectedStatus = selectedRadio.value;
        
        const updateBtn = document.getElementById('updateStatusBtn');
        const btnText = updateBtn.querySelector('.btn-text');
        const spinner = updateBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Updating...';
        spinner.classList.remove('hidden');
        updateBtn.disabled = true;
        
        fetch(`/admin/users/${userId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: selectedStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(`Status updated to ${selectedStatus}`);
                closeEditStatusModal();
                loadUsers(currentPage);
            } else {
                showToast(data.message || 'Error updating status', 'error');
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            showToast('Error updating status', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            updateBtn.disabled = false;
        });
    }

    // Reset Password functionality
    const resetPasswordModal = document.getElementById('resetPasswordModal');

    function openResetPasswordModal(userName, userId) {
        closeAllDropdowns();
        document.getElementById('resetPasswordUserName').textContent = userName;
        document.getElementById('resetPasswordUserId').value = userId;
        document.getElementById('newPassword').value = '';
        generateNewPassword();
        resetPasswordModal.classList.add('show');
    }

    function closeResetPasswordModal() {
        resetPasswordModal.classList.remove('show');
    }

    function generateNewPassword() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
        let password = '';
        for (let i = 0; i < 12; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('newPassword').value = password;
    }

    function resetPassword() {
        const userId = document.getElementById('resetPasswordUserId').value;
        const newPassword = document.getElementById('newPassword').value;

        if (!newPassword) {
            showToast('Please generate a password', 'error');
            return;
        }

        const resetBtn = document.getElementById('resetPasswordBtn');
        const btnText = resetBtn.querySelector('.btn-text');
        const spinner = resetBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;

        btnText.textContent = 'Resetting...';
        spinner.classList.remove('hidden');
        resetBtn.disabled = true;

        fetch(`/admin/users/${userId}/reset-password`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ password: newPassword })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Password reset successfully');
                closeResetPasswordModal();
            } else {
                showToast(data.message || 'Error resetting password', 'error');
            }
        })
        .catch(error => {
            console.error('Error resetting password:', error);
            showToast('Error resetting password', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            resetBtn.disabled = false;
        });
    }

    // Reset Username functionality
    const resetUsernameModal = document.getElementById('resetUsernameModal');

    function openResetUsernameModal(userName, userId, currentUsername) {
        closeAllDropdowns();
        document.getElementById('resetUsernameUserName').textContent = userName;
        document.getElementById('resetUsernameUserId').value = userId;
        document.getElementById('currentUsername').value = currentUsername;
        document.getElementById('newUsername').value = '';
        resetUsernameModal.classList.add('show');
    }

    function closeResetUsernameModal() {
        resetUsernameModal.classList.remove('show');
    }

    function generateNewUsername() {
        const userId = document.getElementById('resetUsernameUserId').value;
        
        const generateBtn = event.target.closest('button');
        const originalText = generateBtn.innerHTML;
        generateBtn.innerHTML = '<i class="bi bi-hourglass"></i><span class="hidden sm:inline ms-2">Generating...</span>';
        generateBtn.disabled = true;

        fetch(`/admin/users/${userId}/generate-username`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('newUsername').value = data.username;
                showToast('Username generated successfully');
            } else {
                showToast(data.message || 'Error generating username', 'error');
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
    }

    function resetUsername() {
        const userId = document.getElementById('resetUsernameUserId').value;
        const newUsername = document.getElementById('newUsername').value;

        if (!newUsername) {
            showToast('Please generate a username', 'error');
            return;
        }

        const resetBtn = document.getElementById('resetUsernameBtn');
        const btnText = resetBtn.querySelector('.btn-text');
        const spinner = resetBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;

        btnText.textContent = 'Resetting...';
        spinner.classList.remove('hidden');
        resetBtn.disabled = true;

        fetch(`/admin/users/${userId}/reset-username`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ username: newUsername })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Username reset successfully');
                closeResetUsernameModal();
                loadUsers(currentPage);
            } else {
                showToast(data.message || 'Error resetting username', 'error');
            }
        })
        .catch(error => {
            console.error('Error resetting username:', error);
            showToast('Error resetting username', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            resetBtn.disabled = false;
        });
    }
</script>

@endsection