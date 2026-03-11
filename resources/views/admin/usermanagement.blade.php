<!---resources/views/admin/usermanagement.blade.php--->
@extends('admin.layout')

@section('content')
<div class="min-h-screen p-4 sm:p-6 md:p-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg p-4 sm:p-6">
        <!-- Top Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
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

        <!-- Filter Section -->
        <div class="flex flex-wrap items-center gap-3 mb-4 sm:mb-6 p-3 sm:p-4 bg-gray-50 rounded-lg">
            <div class="w-full sm:w-auto flex items-center gap-2">
                <i class="bi bi-funnel text-gray-400 text-xs"></i>
                <label class="text-gray-600 text-sm whitespace-nowrap">Position:</label>
                <select id="positionFilter" class="flex-1 sm:w-64 px-3 py-1.5 border border-gray-200 rounded-md text-sm outline-none focus:border-red-500 bg-white" onchange="filterTable()">
                    <option value="all">All Positions</option>
                    <optgroup label="LEADERSHIP & MANAGEMENT">
                        <option value="Administrator">Administrator</option>
                        <option value="Action Officer for Urban Development and Housing">Action Officer</option>
                        <option value="HeadOfficer">Head Officer</option>
                        <option value="Administrative Officer III">Administrative Officer III</option>
                    </optgroup>
                    <optgroup label="ADMINISTRATIVE & GENERAL SERVICES">
                        <option value="Housing and Homesite Regulation Officer I">Housing and Homesite Regulation Officer I</option>
                        <option value="Administrative Assistant II">Administrative Assistant II</option>
                        <option value="Administrative Aide VI">Administrative Aide VI (Clerk III)</option>
                        <option value="Administrative Aide IV">Administrative Aide IV (Bookbinder II)</option>
                        <option value="Administrative Aide III">Administrative Aide III</option>
                        <option value="Administrative Aide I">Administrative Aide I</option>
                        <option value="Job Order - Admin">Job Order</option>
                    </optgroup>
                    <optgroup label="GENERAL CLASSIFICATIONS">
                        <option value="Staff">General Staff</option>
                        <option value="Job Order">Job Order</option>
                        <option value="Contract of Service">Contract of Service</option>
                        <option value="ApplicationEvaluator">Application Evaluator</option>
                        <option value="SiteInspector">Site Inspector</option>
                    </optgroup>
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

        <!-- Table -->
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
                    <tbody id="tableBody" class="bg-white divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
            <div class="flex items-center justify-center sm:justify-start gap-2 w-full sm:w-auto">
                <button class="flex-1 sm:flex-none px-4 py-2 border border-gray-200 bg-white rounded-lg text-sm text-gray-600 font-medium hover:border-red-500 hover:text-red-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2" onclick="changePage('prev')" id="prevPageBtn">
                    <i class="bi bi-chevron-left"></i><span class="hidden sm:inline">Previous</span>
                </button>
                <span class="text-sm text-gray-600 px-2" id="pageInfo">
                    <span id="currentPage">1</span>/<span id="totalPages">1</span>
                </span>
                <button class="flex-1 sm:flex-none px-4 py-2 border border-gray-200 bg-white rounded-lg text-sm text-gray-600 font-medium hover:border-red-500 hover:text-red-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2" onclick="changePage('next')" id="nextPageBtn">
                    <span class="hidden sm:inline">Next</span><i class="bi bi-chevron-right"></i>
                </button>
            </div>
            <div class="text-xs text-gray-500 text-center sm:text-right w-full sm:w-auto">
                <i class="bi bi-info-circle"></i> Click <i class="bi bi-three-dots"></i> for more options
            </div>
        </div>
    </div>
</div>

<!-- Floating Actions Dropdown (body-level, never clipped by any container) -->
<div id="floating-actions-menu"></div>

<!-- Custom Toast Container -->
<div class="fixed top-2 right-2 left-2 sm:left-auto sm:right-5 sm:w-auto z-[1100] space-y-2" id="toastContainer"></div>

<!-- Add User Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="addUserModal">
    <div class="bg-white rounded-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-xl">
        <div class="sticky top-0 bg-white flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200 z-10">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-person-plus text-red-600 me-2"></i>Add New User</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeAddUserModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <form class="p-4 sm:p-6" id="addUserForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <div class="flex flex-col items-center mb-4">
                    <div class="relative">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gray-100 border-2 border-gray-300 flex items-center justify-center text-gray-400 text-2xl sm:text-3xl mb-2 overflow-hidden" id="profilePreview"><i class="bi bi-camera"></i></div>
                        <label for="profileImage" class="absolute bottom-0 right-0 w-7 h-7 sm:w-8 sm:h-8 bg-white rounded-full shadow-md flex items-center justify-center cursor-pointer hover:bg-gray-50 transition-colors border border-gray-300"><i class="bi bi-pencil text-gray-500 text-xs sm:text-sm"></i></label>
                        <input type="file" name="profile_img" id="profileImage" class="hidden" accept="image/*" onchange="previewProfileImage(event)">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 text-center"><i class="bi bi-info-circle me-1"></i>Upload profile picture (optional, max 2MB)</p>
                </div>
                <h4 class="text-gray-700 font-semibold text-sm mb-3 pb-2 border-b border-gray-200"><i class="bi bi-person me-2 text-gray-400"></i>Personal Information</h4>
                <div class="space-y-3 mb-3">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">First Name <span class="text-red-500">*</span></label>
                            <input type="text" id="first_name" name="first_name" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="First name" required>
                            <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-first_name"></div>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all" placeholder="Middle name">
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">Last Name <span class="text-red-500">*</span></label>
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
                            <label class="block text-gray-600 text-xs font-medium mb-1">Gender <span class="text-red-500">*</span></label>
                            <select id="gender" name="gender" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-white" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-gender"></div>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-600 text-xs font-medium mb-1">Birthdate <span class="text-red-500">*</span></label>
                            <input type="date" id="birthdate" name="birthdate" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" required max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>">
                            <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-birthdate"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1"><i class="bi bi-telephone me-1 text-gray-400"></i>Contact Number <span class="text-red-500">*</span></label>
                        <input type="tel" id="contact" name="contact_no" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" placeholder="09123456789" required maxlength="11" pattern="[0-9]{11}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-contact_no"></div>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1"><i class="bi bi-envelope me-1 text-gray-400"></i>Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" placeholder="email@example.com" required>
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-email"></div>
                    </div>
                </div>
                <h4 class="text-gray-700 font-semibold text-sm mb-3 pb-2 border-b border-gray-200"><i class="bi bi-lock me-2 text-gray-400"></i>Account Information</h4>
                <div class="space-y-3">
                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1"><i class="bi bi-briefcase me-1 text-gray-400"></i>Position <span class="text-red-500">*</span></label>
                        <select id="position" name="position" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-white" required>
                            <option value="" disabled selected>Select position</option>
                            <optgroup label="LEADERSHIP & MANAGEMENT">
                                <option value="Administrator">Administrator</option>
                                <option value="Action Officer for Urban Development and Housing">Action Officer (The Boss)</option>
                                <option value="HeadOfficer">Head Officer</option>
                                <option value="Administrative Officer III">Administrative Officer III (Detailed)</option>
                            </optgroup>
                            <optgroup label="GENERAL CLASSIFICATIONS">
                                <option value="Staff">General Staff</option>
                                <option value="Job Order">Job Order</option>
                                <option value="Contract of Service">Contract of Service</option>
                                <option value="ApplicationEvaluator">Application Evaluator</option>
                                <option value="SiteInspector">Site Inspector</option>
                            </optgroup>
                        </select>
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-position"></div>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1"><i class="bi bi-person-circle me-1 text-gray-400"></i>Username <span class="text-red-500">*</span></label>
                        <div class="flex gap-2">
                            <input type="text" id="username" name="username" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-gray-50" readonly required>
                            <button type="button" class="px-3 sm:px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all whitespace-nowrap" onclick="generateUsername()"><i class="bi bi-arrow-repeat"></i><span class="hidden sm:inline ms-2">Generate</span></button>
                        </div>
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-username"></div>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-600 text-xs font-medium mb-1"><i class="bi bi-key me-1 text-gray-400"></i>Password <span class="text-red-500">*</span></label>
                        <div class="flex gap-2">
                            <input type="text" id="password" name="password" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-gray-50" readonly required>
                            <button type="button" class="px-3 sm:px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all whitespace-nowrap" onclick="generatePassword()"><i class="bi bi-arrow-repeat"></i><span class="hidden sm:inline ms-2">Generate</span></button>
                        </div>
                        <div class="text-red-500 text-xs mt-1 hidden error-message" id="error-password"></div>
                    </div>
                </div>
            </div>
        </form>
        <div class="sticky bottom-0 bg-white flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeAddUserModal()"><i class="bi bi-x me-2"></i>Cancel</button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 hover:shadow-md transition-all relative" onclick="saveUser()" id="saveUserBtn">
                <span class="inline-flex items-center justify-center"><i class="bi bi-save me-2"></i><span class="btn-text">Save</span><span class="loading-spinner hidden ml-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg></span></span>
            </button>
        </div>
    </div>
</div>

<!-- Archive Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="archiveModal">
    <div class="bg-white rounded-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto shadow-xl">
        <div class="sticky top-0 bg-white flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-trash text-red-600 me-2"></i>Recycle Bin</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeArchiveModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <div class="p-4 sm:p-6">
            <div class="grid grid-cols-2 gap-3 sm:gap-4 mb-4 sm:mb-6">
                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg text-center"><i class="bi bi-people text-red-600 text-xl sm:text-2xl mb-2"></i><span class="block text-xl sm:text-2xl font-bold text-red-600 mb-1" id="archivedTotal">0</span><span class="text-gray-500 text-xs">Archived</span></div>
                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg text-center"><i class="bi bi-clock text-red-600 text-xl sm:text-2xl mb-2"></i><span class="block text-xl sm:text-2xl font-bold text-red-600 mb-1" id="pendingDeletion">0</span><span class="text-gray-500 text-xs">Expiring</span></div>
            </div>
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
                        <tbody id="archiveBody" class="bg-white divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>
            <div class="bg-orange-50 p-3 rounded-lg text-orange-700 text-xs flex items-start gap-2"><i class="bi bi-info-circle mt-0.5"></i><span>Items are permanently deleted after 30 days</span></div>
        </div>
        <div class="sticky bottom-0 bg-white flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeArchiveModal()"><i class="bi bi-x me-2"></i>Close</button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="emptyRecycleBin()"><i class="bi bi-trash me-2"></i>Empty</button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="deleteModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-exclamation-triangle text-orange-500 me-2"></i>Move to Recycle Bin?</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeDeleteModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <div class="p-6 sm:p-8 text-center">
            <i class="bi bi-trash text-4xl text-orange-500 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Move <strong id="deleteUserName" class="text-red-600"></strong> to recycle bin?</p>
            <p class="text-gray-400 text-xs"><i class="bi bi-info-circle me-1"></i>Account can be restored within 30 days</p>
            <input type="hidden" id="deleteUserId">
        </div>
        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeDeleteModal()"><i class="bi bi-x me-2"></i>Cancel</button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-orange-600 text-white rounded-lg text-sm font-medium hover:bg-orange-700 transition-all" onclick="moveToArchive()" id="moveToArchiveBtn">
                <span class="inline-flex items-center"><i class="bi bi-archive me-2"></i><span class="btn-text">Move</span><span class="loading-spinner hidden ml-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg></span></span>
            </button>
        </div>
    </div>
</div>

<!-- Restore Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="restoreModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-arrow-return-left text-green-600 me-2"></i>Restore User</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeRestoreModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <div class="p-6 sm:p-8 text-center">
            <i class="bi bi-arrow-return-left text-4xl text-green-600 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Restore <strong id="restoreUserName" class="text-green-600"></strong>?</p>
            <p class="text-gray-400 text-xs"><i class="bi bi-info-circle me-1"></i>Account will be reactivated</p>
            <input type="hidden" id="restoreArchiveId">
        </div>
        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeRestoreModal()"><i class="bi bi-x me-2"></i>Cancel</button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="restoreUser()" id="restoreUserBtn">
                <span class="inline-flex items-center"><i class="bi bi-arrow-return-left me-2"></i><span class="btn-text">Restore</span><span class="loading-spinner hidden ml-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg></span></span>
            </button>
        </div>
    </div>
</div>

<!-- Permanent Delete Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="permanentDeleteModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-exclamation-circle text-red-600 me-2"></i>Permanently Delete?</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closePermanentDeleteModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <div class="p-6 sm:p-8 text-center">
            <i class="bi bi-exclamation-triangle text-4xl text-red-600 mb-4"></i>
            <p class="text-gray-700 text-sm mb-2">Delete <strong id="permanentDeleteUserName" class="text-red-600"></strong> permanently?</p>
            <p class="text-gray-400 text-xs"><i class="bi bi-exclamation-circle me-1"></i>This action cannot be undone</p>
            <input type="hidden" id="permanentDeleteArchiveId">
        </div>
        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closePermanentDeleteModal()"><i class="bi bi-x me-2"></i>Cancel</button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="permanentDelete()" id="permanentDeleteBtn">
                <span class="inline-flex items-center"><i class="bi bi-trash me-2"></i><span class="btn-text">Delete</span><span class="loading-spinner hidden ml-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg></span></span>
            </button>
        </div>
    </div>
</div>

<!-- View User Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="viewUserModal">
    <div class="bg-white rounded-xl w-full max-w-2xl shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-person-circle text-red-600 me-2"></i>User Profile</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeViewModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <div class="p-4 sm:p-6 bg-gradient-to-r from-red-600 to-red-700 text-white">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-xl sm:text-2xl font-bold border-2 border-white overflow-hidden flex-shrink-0" id="viewProfileImage">
                    <img src="" alt="Profile" class="w-full h-full object-cover hidden" id="viewProfileImg">
                    <span class="initials" id="avatarInitials">JD</span>
                </div>
                <div class="text-center sm:text-left">
                    <h2 class="text-lg sm:text-xl font-bold" id="viewFullName">John A. Doe</h2>
                    <span class="text-xs opacity-90 block mt-1" id="viewPosition"><i class="bi bi-briefcase me-1"></i>Administrator</span>
                </div>
                <span class="sm:ml-auto px-3 py-1 bg-white bg-opacity-20 rounded-full text-xs font-medium flex items-center gap-1 whitespace-nowrap" id="viewStatusBadge"><i class="bi bi-circle-fill text-green-300"></i> Active</span>
            </div>
        </div>
        <div class="p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="bg-gray-50 p-3 rounded-lg"><span class="block text-gray-400 text-xs mb-1"><i class="bi bi-person me-1"></i>Username</span><span class="text-gray-800 text-sm font-medium break-all" id="viewUsername">johndoe_admin</span></div>
                <div class="bg-gray-50 p-3 rounded-lg"><span class="block text-gray-400 text-xs mb-1"><i class="bi bi-envelope me-1"></i>Email</span><span class="text-gray-800 text-sm font-medium break-all" id="viewEmail">john.doe@example.com</span></div>
                <div class="bg-gray-50 p-3 rounded-lg"><span class="block text-gray-400 text-xs mb-1"><i class="bi bi-telephone me-1"></i>Contact</span><span class="text-gray-800 text-sm font-medium" id="viewContact">+63 912 345 6789</span></div>
                <div class="bg-gray-50 p-3 rounded-lg"><span class="block text-gray-400 text-xs mb-1"><i class="bi bi-gender-ambiguous me-1"></i>Gender</span><span class="text-gray-800 text-sm font-medium" id="viewGender">Male</span></div>
                <div class="bg-gray-50 p-3 rounded-lg"><span class="block text-gray-400 text-xs mb-1"><i class="bi bi-calendar me-1"></i>Birthdate</span><span class="text-gray-800 text-sm font-medium" id="viewBirthdate">January 15, 1990</span></div>
                <div class="bg-gray-50 p-3 rounded-lg"><span class="block text-gray-400 text-xs mb-1"><i class="bi bi-cake me-1"></i>Age</span><span class="text-gray-800 text-sm font-medium" id="viewAge">34</span></div>
                <div class="bg-gray-50 p-3 rounded-lg"><span class="block text-gray-400 text-xs mb-1"><i class="bi bi-calendar-check me-1"></i>Date Joined</span><span class="text-gray-800 text-sm font-medium" id="viewDateJoined">March 10, 2023</span></div>
                <div class="bg-gray-50 p-3 rounded-lg"><span class="block text-gray-400 text-xs mb-1"><i class="bi bi-clock me-1"></i>Last Login</span><span class="text-gray-800 text-sm font-medium" id="viewLastLogin">February 22, 2026</span></div>
            </div>
        </div>
        <div class="flex justify-end px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeViewModal()"><i class="bi bi-x me-2"></i>Close</button>
        </div>
    </div>
</div>

<!-- Edit Status Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="editStatusModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-pencil-square text-red-600 me-2"></i>Update Status</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeEditStatusModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <div class="p-4 sm:p-6">
            <p class="text-gray-600 text-sm mb-4"><i class="bi bi-person me-1"></i>Update for: <strong id="statusUserName" class="text-red-600"></strong></p>
            <input type="hidden" id="statusUserId">
            <input type="hidden" id="currentStatus">
            <div class="flex flex-col gap-2">
                <label class="status-card cursor-pointer border rounded-lg overflow-hidden hover:border-red-500 transition-all p-3 flex items-center gap-3" data-status="active">
                    <input type="radio" name="userStatus" value="active" class="hidden">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <span class="font-medium text-gray-700 text-sm w-20">Active</span>
                    <span class="text-gray-400 text-xs flex-1 hidden sm:inline">User can access</span>
                    <span class="selected-indicator ml-auto text-red-600 hidden"><i class="bi bi-check-circle-fill"></i></span>
                </label>
                <label class="status-card cursor-pointer border rounded-lg overflow-hidden hover:border-red-500 transition-all p-3 flex items-center gap-3" data-status="inactive">
                    <input type="radio" name="userStatus" value="inactive" class="hidden">
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                    <span class="font-medium text-gray-700 text-sm w-20">Deactivated</span>
                    <span class="text-gray-400 text-xs flex-1 hidden sm:inline">Cannot login</span>
                    <span class="selected-indicator ml-auto text-red-600 hidden"><i class="bi bi-check-circle-fill"></i></span>
                </label>
            </div>
        </div>
        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeEditStatusModal()"><i class="bi bi-x me-2"></i>Cancel</button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="updateStatus()" id="updateStatusBtn">
                <span class="inline-flex items-center"><i class="bi bi-save me-2"></i><span class="btn-text">Update</span><span class="loading-spinner hidden ml-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg></span></span>
            </button>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="resetPasswordModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-key text-red-600 me-2"></i>Reset Password</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeResetPasswordModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <div class="p-4 sm:p-6">
            <p class="text-gray-600 text-sm mb-4"><i class="bi bi-person me-1"></i>Reset password for: <strong id="resetPasswordUserName" class="text-red-600"></strong></p>
            <input type="hidden" id="resetPasswordUserId">
            <div class="space-y-4">
                <div class="form-group">
                    <label class="block text-gray-600 text-xs font-medium mb-1"><i class="bi bi-shield-lock me-1"></i>New Password</label>
                    <div class="flex gap-2">
                        <input type="text" id="newPassword" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-gray-50" readonly>
                        <button type="button" class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all" onclick="generateNewPassword()"><i class="bi bi-arrow-repeat"></i><span class="hidden sm:inline ms-2">Generate</span></button>
                    </div>
                </div>
                <div class="bg-blue-50 p-3 rounded-lg text-blue-700 text-xs flex items-start gap-2"><i class="bi bi-info-circle mt-0.5"></i><span>Password must be at least 8 characters with letters and numbers</span></div>
            </div>
        </div>
        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeResetPasswordModal()"><i class="bi bi-x me-2"></i>Cancel</button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="resetPassword()" id="resetPasswordBtn">
                <span class="inline-flex items-center"><i class="bi bi-key me-2"></i><span class="btn-text">Reset Password</span><span class="loading-spinner hidden ml-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg></span></span>
            </button>
        </div>
    </div>
</div>

<!-- Reset Username Modal -->
<div class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[1000] items-center justify-center hidden p-4" id="resetUsernameModal">
    <div class="bg-white rounded-xl w-full max-w-md shadow-xl">
        <div class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800"><i class="bi bi-person-circle text-red-600 me-2"></i>Reset Username</h3>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" onclick="closeResetUsernameModal()"><i class="bi bi-x text-xl"></i></button>
        </div>
        <div class="p-4 sm:p-6">
            <p class="text-gray-600 text-sm mb-4"><i class="bi bi-person me-1"></i>Reset username for: <strong id="resetUsernameUserName" class="text-red-600"></strong></p>
            <input type="hidden" id="resetUsernameUserId">
            <div class="space-y-4">
                <div class="form-group">
                    <label class="block text-gray-600 text-xs font-medium mb-1"><i class="bi bi-person-badge me-1"></i>Current Username</label>
                    <input type="text" id="currentUsername" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50" readonly>
                </div>
                <div class="form-group">
                    <label class="block text-gray-600 text-xs font-medium mb-1"><i class="bi bi-person-plus me-1"></i>New Username</label>
                    <div class="flex gap-2">
                        <input type="text" id="newUsername" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none bg-gray-50" readonly>
                        <button type="button" class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all" onclick="generateNewUsername()"><i class="bi bi-arrow-repeat"></i><span class="hidden sm:inline ms-2">Generate</span></button>
                    </div>
                </div>
                <div class="bg-blue-50 p-3 rounded-lg text-blue-700 text-xs flex items-start gap-2"><i class="bi bi-info-circle mt-0.5"></i><span>Username is based on user's first and last name</span></div>
            </div>
        </div>
        <div class="flex justify-end gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all" onclick="closeResetUsernameModal()"><i class="bi bi-x me-2"></i>Cancel</button>
            <button type="button" class="flex-1 sm:flex-none px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all" onclick="resetUsername()" id="resetUsernameBtn">
                <span class="inline-flex items-center"><i class="bi bi-person-check me-2"></i><span class="btn-text">Reset Username</span><span class="loading-spinner hidden ml-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg></span></span>
            </button>
        </div>
    </div>
</div>

<style>
    .modal.show {
        display: flex;
    }

    .status-card.selected {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .status-card.selected .selected-indicator {
        display: block !important;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: .25rem;
        padding: .25rem .5rem;
        border-radius: 9999px;
        font-size: .75rem;
        font-weight: 500;
    }

    .status-active {
        background-color: #d1fae5;
        color: #047857;
    }

    .status-inactive {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    /* ── FLOATING DROPDOWN ── */
    #floating-actions-menu {
        position: fixed;
        z-index: 99999;
        min-width: 190px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .14), 0 2px 8px rgba(0, 0, 0, .08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        display: none;
        animation: dropIn .15s ease;
    }

    @keyframes dropIn {
        from {
            opacity: 0;
            transform: translateY(-6px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    #floating-actions-menu button {
        width: 100%;
        text-align: left;
        padding: 10px 16px;
        font-size: .875rem;
        color: #374151;
        background: white;
        border: none;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background .15s;
        cursor: pointer;
    }

    #floating-actions-menu button:last-child {
        border-bottom: none;
    }

    #floating-actions-menu button:hover {
        background-color: #f9fafb;
    }

    #floating-actions-menu button i {
        width: 16px;
        font-size: .875rem;
    }

    #floating-actions-menu button.del-btn:hover {
        background-color: #fef2f2;
    }

    /* Actions button */
    .actions-btn {
        width: 32px;
        height: 32px;
        background: #f3f4f6;
        border-radius: 8px;
        color: #6b7280;
        transition: all .2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
    }

    .actions-btn:hover,
    .actions-btn.active {
        background: #ef4444;
        color: white;
    }

    @media (max-width: 640px) {
        #floating-actions-menu {
            position: fixed !important;
            top: auto !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            min-width: unset;
            border-radius: 1rem 1rem 0 0;
            animation: slideUp .25s ease;
        }

        #floating-actions-menu button {
            padding: 14px 20px;
            font-size: 1rem;
        }

        .actions-btn {
            width: 36px;
            height: 36px;
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

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .modal.show {
        animation: fadeIn .2s ease;
    }

    .form-group.error input,
    .form-group.error select {
        border-color: #ef4444;
    }

    .error-message {
        color: #ef4444;
    }

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

    button:disabled {
        opacity: .7;
        cursor: not-allowed;
    }

    .toast-item {
        animation: slideInRight .3s ease forwards;
    }

    .toast-item.hide {
        animation: slideOutRight .3s ease forwards;
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

    @media (max-width:640px) {
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

    optgroup {
        font-weight: 600;
        color: #374151;
        background-color: #f9fafb;
    }

    optgroup option {
        font-weight: normal;
        color: #1f2937;
    }
</style>

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

    // ── FLOATING DROPDOWN ──
    let _activeBtn = null;

    function toggleActionsMenu(btn) {
        const menu = document.getElementById('floating-actions-menu');
        if (_activeBtn === btn && menu.style.display === 'block') {
            closeAllDropdowns();
            return;
        }
        closeAllDropdowns();

        const uid = btn.dataset.uid;
        const fullName = btn.dataset.name;
        const uname = btn.dataset.uname;
        const status = btn.dataset.status;

        menu.innerHTML = `
            <button onclick="viewUser(${uid}); closeAllDropdowns();">
                <i class="bi bi-eye" style="color:#3b82f6"></i> View Details
            </button>
            <button onclick="editUserStatus('${fullName}', ${uid}, '${status}'); closeAllDropdowns();">
                <i class="bi bi-pencil-square" style="color:#22c55e"></i> Edit Status
            </button>
            <button onclick="openResetPasswordModal('${fullName}', ${uid}); closeAllDropdowns();">
                <i class="bi bi-key" style="color:#eab308"></i> Reset Password
            </button>
            <button onclick="openResetUsernameModal('${fullName}', ${uid}, '${uname}'); closeAllDropdowns();">
                <i class="bi bi-person-circle" style="color:#a855f7"></i> Reset Username
            </button>
            <button class="del-btn" style="color:#dc2626" onclick="openDeleteModal('${fullName}', ${uid}); closeAllDropdowns();">
                <i class="bi bi-trash" style="color:#dc2626"></i> Delete Account
            </button>`;

        if (window.innerWidth <= 640) {
            menu.style.cssText = 'display:block;position:fixed;bottom:0;left:0;right:0;top:auto;width:100%;border-radius:1rem 1rem 0 0;';
        } else {
            const rect = btn.getBoundingClientRect();
            const menuW = 195;
            const menuH = 220;
            const spaceBelow = window.innerHeight - rect.bottom;
            // position:fixed uses viewport coords — no scrollY/scrollX needed
            const top = spaceBelow < menuH + 8 ? rect.top - menuH - 4 : rect.bottom + 4;
            let left = rect.right - menuW;
            if (left < 8) left = 8;
            if (left + menuW > window.innerWidth - 8) left = window.innerWidth - menuW - 8;
            menu.style.cssText = `display:block;position:fixed;top:${top}px;left:${left}px;bottom:auto;right:auto;width:${menuW}px;border-radius:10px;`;
        }

        btn.classList.add('active');
        _activeBtn = btn;

        setTimeout(() => {
            document.addEventListener('click', _outsideClose, {
                once: true
            });
        }, 0);
    }

    function _outsideClose(e) {
        const menu = document.getElementById('floating-actions-menu');
        if (menu && !menu.contains(e.target) && e.target !== _activeBtn && !_activeBtn?.contains(e.target)) {
            closeAllDropdowns();
        }
    }

    function closeAllDropdowns() {
        const menu = document.getElementById('floating-actions-menu');
        if (menu) {
            menu.style.display = 'none';
            menu.innerHTML = '';
        }
        if (_activeBtn) {
            _activeBtn.classList.remove('active');
            _activeBtn = null;
        }
        document.removeEventListener('click', _outsideClose);
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        loadUsers();
        loadArchiveStats();

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
            }
        };

        document.getElementById('searchInput').addEventListener('keyup', debounce(filterTable, 500));
        document.getElementById('positionFilter').addEventListener('change', filterTable);
        document.getElementById('statusFilter').addEventListener('change', filterTable);

        document.querySelectorAll('.status-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.status-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        const birthdateInput = document.getElementById('birthdate');
        if (birthdateInput) {
            const maxDate = new Date();
            maxDate.setFullYear(maxDate.getFullYear() - 18);
            birthdateInput.max = maxDate.toISOString().split('T')[0];
        }

        document.getElementById('email')?.addEventListener('input', validateEmailField);
        document.getElementById('contact')?.addEventListener('input', validatePhoneField);
        ['first_name', 'last_name'].forEach(f => document.getElementById(f)?.addEventListener('input', () => clearFieldError(f)));
        ['gender', 'birthdate', 'position'].forEach(f => document.getElementById(f)?.addEventListener('change', () => clearFieldError(f)));
    });

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func(...args), wait);
        };
    }

    function clearFieldError(field) {
        const err = document.getElementById(`error-${field}`);
        const inp = document.querySelector(`[name="${field}"]`);
        if (err) {
            err.classList.add('hidden');
            err.textContent = '';
        }
        if (inp) inp.closest('.form-group')?.classList.remove('error');
    }

    function validateEmailField() {
        const email = document.getElementById('email')?.value;
        const err = document.getElementById('error-email');
        const inp = document.getElementById('email');
        if (!inp) return true;
        if (!email) {
            err && (err.textContent = 'Email is required', err.classList.remove('hidden'));
            inp.closest('.form-group')?.classList.add('error');
            return false;
        }
        if (!email.includes('@') || !email.includes('.')) {
            err && (err.textContent = 'Please enter a valid email address', err.classList.remove('hidden'));
            inp.closest('.form-group')?.classList.add('error');
            return false;
        }
        err && (err.classList.add('hidden'));
        inp.closest('.form-group')?.classList.remove('error');
        return true;
    }

    function validatePhoneField() {
        const phone = document.getElementById('contact')?.value;
        const err = document.getElementById('error-contact_no');
        const inp = document.getElementById('contact');
        if (!inp) return true;
        const num = phone ? phone.replace(/[^0-9]/g, '') : '';
        if (!phone) {
            err && (err.textContent = 'Contact number is required', err.classList.remove('hidden'));
            inp.closest('.form-group')?.classList.add('error');
            return false;
        }
        if (num.length !== 11) {
            err && (err.textContent = 'Contact number must be exactly 11 digits', err.classList.remove('hidden'));
            inp.closest('.form-group')?.classList.add('error');
            return false;
        }
        err && (err.classList.add('hidden'));
        inp.closest('.form-group')?.classList.remove('error');
        return true;
    }

    function showToast(message, type = 'success', duration = 3000) {
        const toastContainer = document.getElementById('toastContainer');
        const toastId = 'toast-' + Date.now();
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle';
        toastContainer.insertAdjacentHTML('beforeend', `
            <div id="${toastId}" class="toast-item flex items-center gap-3 ${bgColor} text-white px-4 py-3 rounded-lg shadow-lg mb-2 w-full sm:min-w-[300px]">
                <i class="bi ${icon} text-lg flex-shrink-0"></i>
                <span class="flex-1 text-sm break-all">${message}</span>
                <button onclick="closeToast('${toastId}')" class="text-white hover:text-gray-200 flex-shrink-0"><i class="bi bi-x text-xl"></i></button>
            </div>`);
        setTimeout(() => closeToast(toastId), duration);
    }

    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 300);
        }
    }

    function showValidationErrors(errors) {
        document.querySelectorAll('.error-message').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        document.querySelectorAll('.form-group').forEach(el => el.classList.remove('error'));
        for (let field in errors) {
            const err = document.getElementById(`error-${field}`);
            const inp = document.querySelector(`[name="${field}"]`);
            if (err) {
                err.textContent = errors[field][0];
                err.classList.remove('hidden');
                inp?.closest('.form-group')?.classList.add('error');
            }
        }
    }

    function loadUsers(page = 1) {
        const params = new URLSearchParams({
            page,
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
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    renderTable(data.users.data);
                    currentPage = data.users.current_page;
                    lastPage = data.users.last_page;
                    totalUsers = data.users.total;
                    document.getElementById('archivedCount').textContent = data.archived_count || 0;
                    updatePagination();
                    document.getElementById('resultCount').innerHTML = `<i class="bi bi-people me-1"></i> ${data.users.data.length} of ${totalUsers}`;
                }
            })
            .catch(() => showToast('Error loading users', 'error'));
    }

    function loadArchiveStats() {
        fetch('/admin/archived-users', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('archivedTotal').textContent = data.stats.total;
                    document.getElementById('pendingDeletion').textContent = data.stats.expired;
                }
            }).catch(console.error);
    }

    function renderTable(users) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';
        users.forEach(user => {
            const statusClass = user.is_active ? 'active' : 'inactive';
            const statusText = user.is_active ? 'Active' : 'Deactivated';
            const statusColor = user.is_active ? 'green' : 'gray';
            const profileImage = user.profile_img ?
                `<img src="/storage/${user.profile_img}" class="w-7 h-7 rounded-full object-cover" alt="Profile">` :
                `<div class="w-7 h-7 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-semibold text-xs">${user.initials || 'U'}</div>`;
            const fullName = user.full_name || `${user.first_name} ${user.middle_name || ''} ${user.last_name} ${user.suffix || ''}`.trim();
            const safeName = fullName.replace(/'/g, "&#39;").replace(/"/g, "&quot;");
            const safeUname = (user.username || '').replace(/'/g, "&#39;");

            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50 transition-colors';
            row.innerHTML = `
                <td class="px-3 sm:px-4 py-3"><div class="flex items-center gap-2">${profileImage}</div></td>
                <td class="px-3 sm:px-4 py-3"><span class="text-xs sm:text-sm font-medium text-gray-900 truncate max-w-[80px] sm:max-w-none">${fullName}</span></td>
                <td class="px-3 sm:px-4 py-3 hidden md:table-cell"><span class="text-xs sm:text-sm">${user.position || 'N/A'}</span></td>
                <td class="px-3 sm:px-4 py-3 hidden lg:table-cell"><span class="text-xs sm:text-sm">${user.username || 'N/A'}</span></td>
                <td class="px-3 sm:px-4 py-3 hidden xl:table-cell"><span class="text-xs sm:text-sm truncate max-w-[150px]">${user.email}</span></td>
                <td class="px-3 sm:px-4 py-3">
                    <span class="status-badge status-${statusClass}">
                        <i class="bi bi-circle-fill text-${statusColor}-400 me-1"></i>${statusText}
                    </span>
                </td>
                <td class="px-3 sm:px-4 py-3">
                    <button class="actions-btn"
                        data-uid="${user.user_id}"
                        data-name="${safeName}"
                        data-uname="${safeUname}"
                        data-status="${statusClass}"
                        onclick="toggleActionsMenu(this)">
                        <i class="bi bi-three-dots text-sm sm:text-base"></i>
                    </button>
                </td>`;
            tbody.appendChild(row);
        });
    }

    function filterTable() {
        filters.search = document.getElementById('searchInput').value;
        filters.position = document.getElementById('positionFilter').value;
        filters.status = document.getElementById('statusFilter').value;
        currentPage = 1;
        loadUsers(currentPage);
    }

    function changePage(direction) {
        if (direction === 'next' && currentPage < lastPage) {
            currentPage++;
            loadUsers(currentPage);
        } else if (direction === 'prev' && currentPage > 1) {
            currentPage--;
            loadUsers(currentPage);
        }
    }

    function updatePagination() {
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = lastPage;
        document.getElementById('prevPageBtn').disabled = currentPage === 1;
        document.getElementById('nextPageBtn').disabled = currentPage === lastPage;
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
        document.querySelectorAll('.form-group').forEach(el => el.classList.remove('error'));
    };

    function closeAddUserModal() {
        addUserModal.classList.remove('show');
    }

    function previewProfileImage(event) {
        const file = event.target.files[0];
        if (!file) return;
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
        reader.onload = e => {
            document.getElementById('profilePreview').innerHTML = `<img src="${e.target.result}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover border-2 border-white shadow-md">`;
        };
        reader.readAsDataURL(file);
    }

    function generateUsername() {
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;
        if (!firstName || !lastName) {
            showToast('Please enter first and last name first', 'error');
            return;
        }
        const btn = event.target.closest('button');
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass"></i><span class="hidden sm:inline ms-2">Generating...</span>';
        btn.disabled = true;
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
            .then(r => r.json()).then(data => {
                if (data.success) {
                    document.getElementById('username').value = data.username;
                    clearFieldError('username');
                    showToast('Username generated');
                } else {
                    showToast(data.message || 'Error', 'error');
                }
            })
            .catch(() => showToast('Error generating username', 'error'))
            .finally(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
            });
    }

    function generatePassword() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
        let pw = '';
        for (let i = 0; i < 12; i++) pw += chars.charAt(Math.floor(Math.random() * chars.length));
        document.getElementById('password').value = pw;
        clearFieldError('password');
        showToast('Password generated');
    }

    function saveUser() {
        const form = document.getElementById('addUserForm');
        const formData = new FormData(form);
        let hasError = false;
        const required = [{
            id: 'first_name',
            msg: 'First name is required'
        }, {
            id: 'last_name',
            msg: 'Last name is required'
        }, {
            id: 'gender',
            msg: 'Gender is required'
        }, {
            id: 'birthdate',
            msg: 'Birthdate is required'
        }, {
            id: 'position',
            msg: 'Position is required'
        }, {
            id: 'username',
            msg: 'Username is required'
        }, {
            id: 'password',
            msg: 'Password is required'
        }];
        required.forEach(({
            id,
            msg
        }) => {
            const el = document.getElementById(id);
            if (!el?.value) {
                const err = document.getElementById(`error-${id}`);
                if (err) {
                    err.textContent = msg;
                    err.classList.remove('hidden');
                }
                el?.closest('.form-group')?.classList.add('error');
                hasError = true;
            }
        });
        if (!validateEmailField()) hasError = true;
        if (!validatePhoneField()) hasError = true;
        if (hasError) {
            showToast('Please fix the errors in the form', 'error');
            return;
        }

        const saveBtn = document.getElementById('saveUserBtn');
        const btnText = saveBtn.querySelector('.btn-text');
        const spinner = saveBtn.querySelector('.loading-spinner');
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
            .then(r => r.json()).then(data => {
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
                        showToast('Please check the form', 'error');
                    } else {
                        showToast(data.message || 'Error creating user', 'error');
                    }
                }
            }).catch(() => showToast('Error saving user', 'error'))
            .finally(() => {
                btnText.textContent = 'Save';
                spinner.classList.add('hidden');
                saveBtn.disabled = false;
            });
    }

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
        const btn = document.getElementById('moveToArchiveBtn');
        const t = btn.querySelector('.btn-text');
        const s = btn.querySelector('.loading-spinner');
        t.textContent = 'Moving...';
        s.classList.remove('hidden');
        btn.disabled = true;
        fetch(`/admin/users/${userId}/archive`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json()).then(data => {
                if (data.success) {
                    showToast('User moved to recycle bin');
                    closeDeleteModal();
                    loadUsers(currentPage);
                    loadArchiveStats();
                } else {
                    showToast(data.message || 'Error', 'error');
                }
            })
            .catch(() => showToast('Error archiving user', 'error')).finally(() => {
                t.textContent = 'Move';
                s.classList.add('hidden');
                btn.disabled = false;
            });
    }

    const archiveModal = document.getElementById('archiveModal');

    function openArchiveModal() {
        closeAllDropdowns();
        loadArchivedUsers();
        archiveModal.classList.add('show');
    }

    function closeArchiveModal() {
        archiveModal.classList.remove('show');
    }

    function loadArchivedUsers() {
        fetch('/admin/archived-users', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json()).then(data => {
                if (data.success) {
                    renderArchiveTable(data.archived_users);
                    document.getElementById('archivedTotal').textContent = data.stats.total;
                    document.getElementById('pendingDeletion').textContent = data.stats.expired;
                }
            })
            .catch(console.error);
    }

    function renderArchiveTable(archivedUsers) {
        const archiveBody = document.getElementById('archiveBody');
        archiveBody.innerHTML = '';
        archivedUsers.forEach(user => {
            const archivedDate = new Date(user.archived_at).toLocaleDateString();
            const expiresAt = new Date(user.expires_at);
            const daysLeft = Math.ceil((expiresAt - new Date()) / (1000 * 60 * 60 * 24));
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-3 sm:px-4 py-2.5 text-xs sm:text-sm"><div class="flex items-center gap-2"><i class="bi bi-person-slash text-gray-400"></i><span class="truncate max-w-[80px] sm:max-w-none">${user.first_name} ${user.last_name}</span></div></td>
                <td class="px-3 sm:px-4 py-2.5 text-xs sm:text-sm hidden sm:table-cell">${user.position||'N/A'}</td>
                <td class="px-3 sm:px-4 py-2.5 text-xs sm:text-sm hidden md:table-cell">${archivedDate}</td>
                <td class="px-3 sm:px-4 py-2.5 text-xs sm:text-sm"><span class="${daysLeft<=7?'text-red-600':'text-gray-600'}">${daysLeft>0?daysLeft+'d':'Expired'}</span></td>
                <td class="px-3 sm:px-4 py-2.5">
                    <button class="text-blue-600 hover:text-blue-800 mr-2 transition-colors" onclick="restoreFromArchive(${user.archive_id},'${user.first_name} ${user.last_name}')"><i class="bi bi-arrow-return-left"></i></button>
                    <button class="text-red-600 hover:text-red-800 transition-colors" onclick="permanentDeletePrompt(${user.archive_id},'${user.first_name} ${user.last_name}')"><i class="bi bi-trash"></i></button>
                </td>`;
            archiveBody.appendChild(row);
        });
    }

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
        const btn = document.getElementById('restoreUserBtn');
        const t = btn.querySelector('.btn-text');
        const s = btn.querySelector('.loading-spinner');
        t.textContent = 'Restoring...';
        s.classList.remove('hidden');
        btn.disabled = true;
        fetch(`/admin/archived-users/${archiveId}/restore`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json()).then(data => {
                if (data.success) {
                    showToast('User restored successfully');
                    closeRestoreModal();
                    loadArchivedUsers();
                    loadUsers(currentPage);
                    loadArchiveStats();
                } else {
                    showToast(data.message || 'Error', 'error');
                }
            })
            .catch(() => showToast('Error restoring user', 'error')).finally(() => {
                t.textContent = 'Restore';
                s.classList.add('hidden');
                btn.disabled = false;
            });
    }

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
        const btn = document.getElementById('permanentDeleteBtn');
        const t = btn.querySelector('.btn-text');
        const s = btn.querySelector('.loading-spinner');
        t.textContent = 'Deleting...';
        s.classList.remove('hidden');
        btn.disabled = true;
        fetch(`/admin/archived-users/${archiveId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json()).then(data => {
                if (data.success) {
                    showToast('User permanently deleted');
                    closePermanentDeleteModal();
                    loadArchivedUsers();
                    loadArchiveStats();
                } else {
                    showToast(data.message || 'Error', 'error');
                }
            })
            .catch(() => showToast('Error deleting user', 'error')).finally(() => {
                t.textContent = 'Delete';
                s.classList.add('hidden');
                btn.disabled = false;
            });
    }

    function emptyRecycleBin() {
        if (confirm('Permanently delete all expired items?')) {
            fetch('/admin/recycle-bin/empty', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json()).then(data => {
                    if (data.success) {
                        showToast('Recycle bin emptied');
                        loadArchivedUsers();
                        loadArchiveStats();
                    } else {
                        showToast(data.message || 'Error', 'error');
                    }
                })
                .catch(() => showToast('Error emptying recycle bin', 'error'));
        }
    }

    function viewUser(userId) {
        closeAllDropdowns();
        fetch(`/admin/users/${userId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json()).then(data => {
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
                    document.getElementById('viewFullName').textContent = user.full_name || `${user.first_name} ${user.middle_name||''} ${user.last_name} ${user.suffix||''}`;
                    document.getElementById('viewPosition').innerHTML = `<i class="bi bi-briefcase me-1"></i>${user.position||'N/A'}`;
                    const sc = user.is_active ? 'green' : 'gray';
                    const st = user.is_active ? 'Active' : 'Deactivated';
                    document.getElementById('viewStatusBadge').innerHTML = `<i class="bi bi-circle-fill text-${sc}-300"></i> ${st}`;
                    document.getElementById('viewUsername').textContent = user.username || 'N/A';
                    document.getElementById('viewEmail').textContent = user.email;
                    document.getElementById('viewContact').textContent = user.contact_no || 'N/A';
                    document.getElementById('viewGender').textContent = user.gender ? user.gender.charAt(0).toUpperCase() + user.gender.slice(1).replace('_', ' ') : 'N/A';
                    if (user.birthdate) {
                        const bd = new Date(user.birthdate);
                        document.getElementById('viewBirthdate').textContent = bd.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        const today = new Date();
                        let age = today.getFullYear() - bd.getFullYear();
                        if (today.getMonth() < bd.getMonth() || (today.getMonth() === bd.getMonth() && today.getDate() < bd.getDate())) age--;
                        document.getElementById('viewAge').textContent = age;
                    } else {
                        document.getElementById('viewBirthdate').textContent = 'N/A';
                        document.getElementById('viewAge').textContent = 'N/A';
                    }
                    document.getElementById('viewDateJoined').textContent = stats.date_joined || 'N/A';
                    document.getElementById('viewLastLogin').textContent = stats.last_login || 'N/A';
                    document.getElementById('viewUserModal').classList.add('show');
                }
            }).catch(() => showToast('Error loading user details', 'error'));
    }

    function closeViewModal() {
        document.getElementById('viewUserModal').classList.remove('show');
    }

    const editStatusModal = document.getElementById('editStatusModal');

    function editUserStatus(userName, userId, currentStatus) {
        closeAllDropdowns();
        document.getElementById('statusUserName').textContent = userName;
        document.getElementById('statusUserId').value = userId;
        document.getElementById('currentStatus').value = currentStatus;
        document.querySelectorAll('.status-card').forEach(c => {
            c.classList.remove('selected');
            c.querySelector('input[type="radio"]').checked = false;
        });
        const card = document.querySelector(`.status-card[data-status="${currentStatus}"]`);
        if (card) {
            card.classList.add('selected');
            card.querySelector('input[type="radio"]').checked = true;
        }
        editStatusModal.classList.add('show');
    }

    function closeEditStatusModal() {
        editStatusModal.classList.remove('show');
    }

    function updateStatus() {
        const sel = document.querySelector('input[name="userStatus"]:checked');
        const userId = document.getElementById('statusUserId').value;
        if (!sel) {
            showToast('Please select a status', 'error');
            return;
        }
        const btn = document.getElementById('updateStatusBtn');
        const t = btn.querySelector('.btn-text');
        const s = btn.querySelector('.loading-spinner');
        t.textContent = 'Updating...';
        s.classList.remove('hidden');
        btn.disabled = true;
        fetch(`/admin/users/${userId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: sel.value
                })
            })
            .then(r => r.json()).then(data => {
                if (data.success) {
                    showToast(`Status updated to ${sel.value}`);
                    closeEditStatusModal();
                    loadUsers(currentPage);
                } else {
                    showToast(data.message || 'Error', 'error');
                }
            })
            .catch(() => showToast('Error updating status', 'error')).finally(() => {
                t.textContent = 'Update';
                s.classList.add('hidden');
                btn.disabled = false;
            });
    }

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
        let pw = '';
        for (let i = 0; i < 12; i++) pw += chars.charAt(Math.floor(Math.random() * chars.length));
        document.getElementById('newPassword').value = pw;
    }

    function resetPassword() {
        const userId = document.getElementById('resetPasswordUserId').value;
        const newPw = document.getElementById('newPassword').value;
        if (!newPw) {
            showToast('Please generate a password', 'error');
            return;
        }
        const btn = document.getElementById('resetPasswordBtn');
        const t = btn.querySelector('.btn-text');
        const s = btn.querySelector('.loading-spinner');
        t.textContent = 'Resetting...';
        s.classList.remove('hidden');
        btn.disabled = true;
        fetch(`/admin/users/${userId}/reset-password`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    password: newPw
                })
            })
            .then(r => r.json()).then(data => {
                if (data.success) {
                    showToast('Password reset successfully');
                    closeResetPasswordModal();
                } else {
                    showToast(data.message || 'Error', 'error');
                }
            })
            .catch(() => showToast('Error resetting password', 'error')).finally(() => {
                t.textContent = 'Reset Password';
                s.classList.add('hidden');
                btn.disabled = false;
            });
    }

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
        const btn = event.target.closest('button');
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass"></i><span class="hidden sm:inline ms-2">Generating...</span>';
        btn.disabled = true;
        fetch(`/admin/users/${userId}/generate-username`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json()).then(data => {
                if (data.success) {
                    document.getElementById('newUsername').value = data.username;
                    showToast('Username generated');
                } else {
                    showToast(data.message || 'Error', 'error');
                }
            })
            .catch(() => showToast('Error generating username', 'error')).finally(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
            });
    }

    function resetUsername() {
        const userId = document.getElementById('resetUsernameUserId').value;
        const newUN = document.getElementById('newUsername').value;
        if (!newUN) {
            showToast('Please generate a username', 'error');
            return;
        }
        const btn = document.getElementById('resetUsernameBtn');
        const t = btn.querySelector('.btn-text');
        const s = btn.querySelector('.loading-spinner');
        t.textContent = 'Resetting...';
        s.classList.remove('hidden');
        btn.disabled = true;
        fetch(`/admin/users/${userId}/reset-username`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    username: newUN
                })
            })
            .then(r => r.json()).then(data => {
                if (data.success) {
                    showToast('Username reset successfully');
                    closeResetUsernameModal();
                    loadUsers(currentPage);
                } else {
                    showToast(data.message || 'Error', 'error');
                }
            })
            .catch(() => showToast('Error resetting username', 'error')).finally(() => {
                t.textContent = 'Reset Username';
                s.classList.add('hidden');
                btn.disabled = false;
            });
    }
</script>

@endsection