@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Affiliated Offices</h1>
            <p class="text-gray-600 mt-2">Manage affiliated offices and their information</p>
        </div>
        <button onclick="openOfficeModal()" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Office
        </button>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-amber-500">
            <h2 class="text-xl font-semibold text-white">Office Directory</h2>
        </div>
        <div class="p-6">
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="officeSearch" placeholder="Search offices..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <select id="officeSort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="name">Sort by Name</option>
                    <option value="type">Sort by Type</option>
                    <option value="status">Sort by Status</option>
                </select>
            </div>

            <!-- Offices Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="officesGrid">
                <!-- Office Card 1 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/60x60?text=LOGO" alt="Office Logo" class="w-16 h-16 rounded-lg object-cover mr-3">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">Department of Education</h3>
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Active</span>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="truncate">123 Education Ave, Manila</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>(02) 123-4567</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="truncate">info@deped.gov.ph</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                            <div class="flex space-x-2">
                                <button onclick="editOffice(1)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Office">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteOffice(1)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Office">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <button onclick="uploadLogo(1)" class="px-3 py-1 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded text-sm transition-colors">
                                Upload Logo
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Office Card 2 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/60x60?text=LOGO" alt="Office Logo" class="w-16 h-16 rounded-lg object-cover mr-3">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">Department of Health</h3>
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Active</span>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="truncate">456 Health Blvd, Quezon City</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>(02) 987-6543</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="truncate">info@doh.gov.ph</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                            <div class="flex space-x-2">
                                <button onclick="editOffice(2)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Office">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteOffice(2)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Office">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <button onclick="uploadLogo(2)" class="px-3 py-1 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded text-sm transition-colors">
                                Upload Logo
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Office Card 3 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/60x60?text=LOGO" alt="Office Logo" class="w-16 h-16 rounded-lg object-cover mr-3">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">Department of Agriculture</h3>
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="truncate">789 Farm Road, Laguna</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>(049) 555-1234</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="truncate">info@da.gov.ph</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                            <div class="flex space-x-2">
                                <button onclick="editOffice(3)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Office">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteOffice(3)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Office">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <button onclick="uploadLogo(3)" class="px-3 py-1 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded text-sm transition-colors">
                                Upload Logo
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Office Card 4 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/60x60?text=LOGO" alt="Office Logo" class="w-16 h-16 rounded-lg object-cover mr-3">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">Department of Tourism</h3>
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Active</span>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="truncate">321 Tourism Ave, Pasay</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>(02) 777-8888</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="truncate">info@tourism.gov.ph</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                            <div class="flex space-x-2">
                                <button onclick="editOffice(4)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Office">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteOffice(4)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Office">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <button onclick="uploadLogo(4)" class="px-3 py-1 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded text-sm transition-colors">
                                Upload Logo
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6">
                <p class="text-sm text-gray-600">Showing <span class="font-medium">4</span> of <span class="font-medium">4</span> offices</p>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-500 cursor-not-allowed">Previous</button>
                    <button class="px-3 py-1 bg-amber-600 text-white rounded-lg text-sm">1</button>
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-500 cursor-not-allowed">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Office Modal -->
<div id="officeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="officeModalTitle">Add Office</h3>
            <button onclick="document.getElementById('officeModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="officeForm" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Office Name *</label>
                    <input type="text" id="officeName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter office name" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Office Type</label>
                    <select id="officeType" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="government">Government Agency</option>
                        <option value="ngo">NGO</option>
                        <option value="private">Private Sector</option>
                        <option value="international">International Organization</option>
                    </select>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address *</label>
                    <textarea id="officeAddress" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter complete address" required></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                    <input type="tel" id="officeContact" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="(02) 123-4567">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="officeEmail" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="info@office.gov.ph">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Website (Optional)</label>
                    <input type="url" id="officeWebsite" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="https://www.office.gov.ph">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="officeStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Office Logo (Optional)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="mt-1 text-sm text-gray-600">Click to upload logo</p>
                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                        <input type="file" id="officeLogo" accept="image/*" class="hidden" onchange="previewOfficeLogo(event)">
                        <button type="button" onclick="document.getElementById('officeLogo').click()" class="mt-2 px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded text-sm">
                            Choose File
                        </button>
                    </div>
                    <div id="officeLogoPreview" class="mt-2 hidden">
                        <img src="" alt="Logo Preview" class="w-16 h-16 rounded-lg object-cover">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('officeModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Save Office
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Logo Upload Modal -->
<div id="logoUploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Upload Office Logo</h3>
            <button onclick="document.getElementById('logoUploadModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="logoUploadForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Logo File</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    <input type="file" id="logoFile" accept="image/*" class="hidden" onchange="previewLogoFile(event)">
                    <button type="button" onclick="document.getElementById('logoFile').click()" class="mt-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                        Choose File
                    </button>
                </div>
            </div>
            
            <div id="logoFilePreview" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <img id="logoPreviewImage" src="" alt="Logo Preview" class="w-full h-auto max-h-48 object-contain">
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('logoUploadModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Upload Logo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let currentOfficeId = null;

// Office Functions
function openOfficeModal() {
    document.getElementById('officeModalTitle').textContent = 'Add Office';
    document.getElementById('officeForm').reset();
    document.getElementById('officeLogoPreview').classList.add('hidden');
    document.getElementById('officeModal').classList.remove('hidden');
}

function editOffice(id) {
    console.log('Editing office:', id);
    document.getElementById('officeModalTitle').textContent = 'Edit Office';
    
    // Load sample office data into form
    const officeData = {
        1: {
            name: 'Department of Education',
            type: 'government',
            address: '123 Education Ave, Manila',
            contact: '(02) 123-4567',
            email: 'info@deped.gov.ph',
            website: 'https://deped.gov.ph',
            status: 'active'
        },
        2: {
            name: 'Department of Health',
            type: 'government',
            address: '456 Health Blvd, Quezon City',
            contact: '(02) 987-6543',
            email: 'info@doh.gov.ph',
            website: 'https://doh.gov.ph',
            status: 'active'
        },
        3: {
            name: 'Department of Agriculture',
            type: 'government',
            address: '789 Farm Road, Laguna',
            contact: '(049) 555-1234',
            email: 'info@da.gov.ph',
            website: 'https://da.gov.ph',
            status: 'inactive'
        },
        4: {
            name: 'Department of Tourism',
            type: 'government',
            address: '321 Tourism Ave, Pasay',
            contact: '(02) 777-8888',
            email: 'info@tourism.gov.ph',
            website: 'https://tourism.gov.ph',
            status: 'active'
        }
    };
    
    const data = officeData[id];
    if (data) {
        document.getElementById('officeName').value = data.name;
        document.getElementById('officeType').value = data.type;
        document.getElementById('officeAddress').value = data.address;
        document.getElementById('officeContact').value = data.contact;
        document.getElementById('officeEmail').value = data.email;
        document.getElementById('officeWebsite').value = data.website;
        document.getElementById('officeStatus').value = data.status;
    }
    
    document.getElementById('officeModal').classList.remove('hidden');
}

function deleteOffice(id) {
    if (confirm('Are you sure you want to delete this office? This action cannot be undone.')) {
        console.log('Deleting office:', id);
        showNotification('Office deleted successfully!', 'success');
    }
}

function uploadLogo(id) {
    currentOfficeId = id;
    console.log('Uploading logo for office:', id);
    document.getElementById('logoUploadModal').classList.remove('hidden');
}

// Preview Functions
function previewOfficeLogo(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('officeLogoPreview').querySelector('img').src = e.target.result;
            document.getElementById('officeLogoPreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function previewLogoFile(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('logoPreviewImage').src = e.target.result;
            document.getElementById('logoFilePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

// Form Submissions
document.getElementById('officeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Saving office...');
    document.getElementById('officeModal').classList.add('hidden');
    showNotification('Office saved successfully!', 'success');
});

document.getElementById('logoUploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Uploading logo for office:', currentOfficeId);
    document.getElementById('logoUploadModal').classList.add('hidden');
    showNotification('Logo uploaded successfully!', 'success');
    currentOfficeId = null;
});

// Search and Filter Functions
document.getElementById('officeSearch').addEventListener('input', function(e) {
    console.log('Searching offices:', e.target.value);
    // Implement search functionality
});

document.getElementById('officeSort').addEventListener('change', function(e) {
    console.log('Sorting offices by:', e.target.value);
    // Implement sort functionality
});

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 
        type === 'error' ? 'bg-red-500 text-white' : 
        'bg-blue-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection
