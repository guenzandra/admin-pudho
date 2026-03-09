@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manage Services</h1>
            <p class="text-gray-600 mt-2">Manage and organize all available services</p>
        </div>
        <div class="flex space-x-3">
            <button onclick="toggleView()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span id="viewToggleText">Table View</span>
            </button>
            <button onclick="openServiceModal()" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Service
            </button>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-amber-500">
            <h2 class="text-xl font-semibold text-white">Service Directory</h2>
        </div>
        <div class="p-6">
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="serviceSearch" placeholder="Search services..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <select id="serviceFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="all">All Services</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
                <button onclick="saveServiceOrder()" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V2"></path>
                    </svg>
                    Save Order
                </button>
            </div>

            <!-- Card View (Default) -->
            <div id="cardView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Service Card 1 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow cursor-move" data-service-id="1" draggable="true">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Health+Service" alt="Service Image" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Published</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Health Services</h3>
                        <p class="text-sm text-gray-600 mb-4">Comprehensive healthcare programs including medical check-ups, vaccinations, and health education for the community.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editService(1)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Service">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="uploadServiceImage(1)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Upload Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                                <button onclick="togglePublish(1)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Unpublish">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="cursor-move">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow cursor-move" data-service-id="2" draggable="true">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Education+Service" alt="Service Image" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Published</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Education Programs</h3>
                        <p class="text-sm text-gray-600 mb-4">Educational assistance programs, scholarship opportunities, and skills development training for residents.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editService(2)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Service">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="uploadServiceImage(2)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Upload Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                                <button onclick="togglePublish(2)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Unpublish">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="cursor-move">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow cursor-move" data-service-id="3" draggable="true">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Housing+Service" alt="Service Image" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">Draft</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Housing Assistance</h3>
                        <p class="text-sm text-gray-600 mb-4">Affordable housing programs, home repair assistance, and shelter support for qualified residents.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editService(3)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Service">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="uploadServiceImage(3)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Upload Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                                <button onclick="togglePublish(3)" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-50 rounded-lg transition-colors" title="Publish">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="cursor-move">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Card 4 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow cursor-move" data-service-id="4" draggable="true">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Business+Service" alt="Service Image" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Published</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Business Support</h3>
                        <p class="text-sm text-gray-600 mb-4">Business registration assistance, entrepreneurship training, and microfinance support for local businesses.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editService(4)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Service">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="uploadServiceImage(4)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Upload Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                                <button onclick="togglePublish(4)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Unpublish">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="cursor-move">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table View (Hidden by default) -->
            <div id="tableView" class="hidden overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Service Name</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Short Description</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Image</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="serviceTableBody">
                        <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-move" data-service-id="1" draggable="true">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="cursor-move mr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Health Services</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">Comprehensive healthcare programs including medical check-ups, vaccinations, and health education.</td>
                            <td class="py-3 px-4">
                                <img src="https://via.placeholder.com/60x40?text=Health" alt="Service Image" class="w-16 h-12 rounded object-cover">
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Published</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editService(1)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Service">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="uploadServiceImage(1)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Upload Image">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="togglePublish(1)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Unpublish">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-move" data-service-id="2" draggable="true">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="cursor-move mr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Education Programs</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">Educational assistance programs, scholarship opportunities, and skills development training.</td>
                            <td class="py-3 px-4">
                                <img src="https://via.placeholder.com/60x40?text=Education" alt="Service Image" class="w-16 h-12 rounded object-cover">
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Published</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editService(2)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Service">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="uploadServiceImage(2)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Upload Image">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="togglePublish(2)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Unpublish">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-move" data-service-id="3" draggable="true">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="cursor-move mr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Housing Assistance</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">Affordable housing programs, home repair assistance, and shelter support for qualified residents.</td>
                            <td class="py-3 px-4">
                                <img src="https://via.placeholder.com/60x40?text=Housing" alt="Service Image" class="w-16 h-12 rounded object-cover">
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">Draft</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editService(3)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Service">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="uploadServiceImage(3)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Upload Image">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="togglePublish(3)" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-50 rounded-lg transition-colors" title="Publish">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-move" data-service-id="4" draggable="true">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="cursor-move mr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Business Support</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">Business registration assistance, entrepreneurship training, and microfinance support for local businesses.</td>
                            <td class="py-3 px-4">
                                <img src="https://via.placeholder.com/60x40?text=Business" alt="Service Image" class="w-16 h-12 rounded object-cover">
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Published</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editService(4)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Service">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="uploadServiceImage(4)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Upload Image">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="togglePublish(4)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Unpublish">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Service Modal -->
<div id="serviceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="serviceModalTitle">Add Service</h3>
            <button onclick="document.getElementById('serviceModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="serviceForm" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Service Name *</label>
                    <input type="text" id="serviceName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter service name" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="serviceStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Short Description *</label>
                    <textarea id="serviceDescription" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter short description" required></textarea>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Description</label>
                    <textarea id="serviceFullDescription" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter full description"></textarea>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Service Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="mt-1 text-sm text-gray-600">Click to upload service image</p>
                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                        <input type="file" id="serviceImage" accept="image/*" class="hidden" onchange="previewServiceImage(event)">
                        <button type="button" onclick="document.getElementById('serviceImage').click()" class="mt-2 px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded text-sm">
                            Choose File
                        </button>
                    </div>
                    <div id="serviceImagePreview" class="mt-2 hidden">
                        <img src="" alt="Service Image Preview" class="w-32 h-24 rounded-lg object-cover">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('serviceModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Save Service
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Image Upload Modal -->
<div id="imageUploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Upload Service Image</h3>
            <button onclick="document.getElementById('imageUploadModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="imageUploadForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Image File</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    <input type="file" id="imageFile" accept="image/*" class="hidden" onchange="previewImageFile(event)">
                    <button type="button" onclick="document.getElementById('imageFile').click()" class="mt-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                        Choose File
                    </button>
                </div>
            </div>
            
            <div id="imageFilePreview" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <img id="imagePreviewImage" src="" alt="Image Preview" class="w-full h-auto max-h-48 object-contain">
                </div>
                <div class="mt-2 text-sm text-gray-600">
                    <p id="imageFileName"></p>
                    <p id="imageFileSize"></p>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('imageUploadModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Upload Image
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let currentServiceId = null;
let currentView = 'card';
let draggedElement = null;

// View Toggle
function toggleView() {
    const cardView = document.getElementById('cardView');
    const tableView = document.getElementById('tableView');
    const viewToggleText = document.getElementById('viewToggleText');
    
    if (currentView === 'card') {
        cardView.classList.add('hidden');
        tableView.classList.remove('hidden');
        viewToggleText.textContent = 'Card View';
        currentView = 'table';
    } else {
        cardView.classList.remove('hidden');
        tableView.classList.add('hidden');
        viewToggleText.textContent = 'Table View';
        currentView = 'card';
    }
    
    // Reinitialize drag and drop for the new view
    initializeDragAndDrop();
}

// Drag and Drop functionality
function initializeDragAndDrop() {
    const services = document.querySelectorAll('[data-service-id]');
    
    services.forEach(service => {
        service.addEventListener('dragstart', handleDragStart);
        service.addEventListener('dragend', handleDragEnd);
        service.addEventListener('dragover', handleDragOver);
        service.addEventListener('drop', handleDrop);
    });
}

function handleDragStart(e) {
    draggedElement = this;
    this.style.opacity = '0.5';
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragEnd(e) {
    this.style.opacity = '1';
}

function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault();
    }
    
    e.dataTransfer.dropEffect = 'move';
    
    const container = currentView === 'card' ? document.getElementById('cardView') : document.getElementById('serviceTableBody');
    const afterElement = getDragAfterElement(container, e.clientY);
    
    if (afterElement == null) {
        container.appendChild(draggedElement);
    } else {
        container.insertBefore(draggedElement, afterElement);
    }
    
    return false;
}

function handleDrop(e) {
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    
    return false;
}

function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('[data-service-id]:not(.dragging)')];
    
    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

// Service Functions
function openServiceModal() {
    document.getElementById('serviceModalTitle').textContent = 'Add Service';
    document.getElementById('serviceForm').reset();
    document.getElementById('serviceImagePreview').classList.add('hidden');
    document.getElementById('serviceModal').classList.remove('hidden');
}

function editService(id) {
    console.log('Editing service:', id);
    document.getElementById('serviceModalTitle').textContent = 'Edit Service';
    
    // Load sample service data into form
    const serviceData = {
        1: {
            name: 'Health Services',
            description: 'Comprehensive healthcare programs including medical check-ups, vaccinations, and health education for the community.',
            fullDescription: 'Our health services provide comprehensive medical care including preventive health programs, medical consultations, vaccinations, health education, and community health initiatives.',
            status: 'published'
        },
        2: {
            name: 'Education Programs',
            description: 'Educational assistance programs, scholarship opportunities, and skills development training for residents.',
            fullDescription: 'We offer various educational support programs including scholarships, tutorial services, skills training, and educational assistance for qualified residents.',
            status: 'published'
        },
        3: {
            name: 'Housing Assistance',
            description: 'Affordable housing programs, home repair assistance, and shelter support for qualified residents.',
            fullDescription: 'Housing assistance programs include affordable housing options, home repair grants, rental assistance, and emergency shelter support for qualified residents.',
            status: 'draft'
        },
        4: {
            name: 'Business Support',
            description: 'Business registration assistance, entrepreneurship training, and microfinance support for local businesses.',
            fullDescription: 'Support for local businesses includes registration assistance, entrepreneurship training, microfinance programs, and business development services.',
            status: 'published'
        }
    };
    
    const data = serviceData[id];
    if (data) {
        document.getElementById('serviceName').value = data.name;
        document.getElementById('serviceDescription').value = data.description;
        document.getElementById('serviceFullDescription').value = data.fullDescription;
        document.getElementById('serviceStatus').value = data.status;
    }
    
    document.getElementById('serviceModal').classList.remove('hidden');
}

function uploadServiceImage(id) {
    currentServiceId = id;
    console.log('Uploading image for service:', id);
    document.getElementById('imageUploadForm').reset();
    document.getElementById('imageFilePreview').classList.add('hidden');
    document.getElementById('imageUploadModal').classList.remove('hidden');
}

function togglePublish(id) {
    console.log('Toggling publish status for service:', id);
    showNotification('Service status updated successfully!', 'success');
}

function saveServiceOrder() {
    const services = document.querySelectorAll('[data-service-id]');
    const order = Array.from(services).map(service => service.dataset.serviceId);
    console.log('Saving new service order:', order);
    showNotification('Service order saved successfully!', 'success');
}

// Preview Functions
function previewServiceImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('serviceImagePreview').querySelector('img').src = e.target.result;
            document.getElementById('serviceImagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function previewImageFile(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreviewImage').src = e.target.result;
            document.getElementById('imageFileName').textContent = `File: ${file.name}`;
            document.getElementById('imageFileSize').textContent = `Size: ${(file.size / 1024 / 1024).toFixed(2)} MB`;
            document.getElementById('imageFilePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

// Form Submissions
document.getElementById('serviceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Saving service...');
    document.getElementById('serviceModal').classList.add('hidden');
    showNotification('Service saved successfully!', 'success');
});

document.getElementById('imageUploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Uploading image for service:', currentServiceId);
    document.getElementById('imageUploadModal').classList.add('hidden');
    showNotification('Image uploaded successfully!', 'success');
    currentServiceId = null;
});

// Search and Filter Functions
document.getElementById('serviceSearch').addEventListener('input', function(e) {
    console.log('Searching services:', e.target.value);
    // Implement search functionality
});

document.getElementById('serviceFilter').addEventListener('change', function(e) {
    console.log('Filtering services:', e.target.value);
    // Implement filter functionality
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

// Initialize drag and drop on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeDragAndDrop();
});
</script>
@endsection
