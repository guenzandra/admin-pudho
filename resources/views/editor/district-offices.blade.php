@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">District Offices</h1>
            <p class="text-gray-600 mt-2">Manage districts and their municipalities</p>
        </div>
    </div>

    <!-- District List View -->
    <div id="districtListView" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-amber-500">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">District List</h2>
                <button onclick="openDistrictModal()" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add District
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Search and Filter -->
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="districtSearch" placeholder="Search districts..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <select id="districtSort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="name">Sort by Name</option>
                    <option value="municipalities">Sort by Municipalities</option>
                    <option value="updated">Sort by Last Updated</option>
                </select>
            </div>

            <!-- Districts Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">District Name</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">No. of Municipalities</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Last Updated</th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="districtTableBody">
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-amber-700 font-semibold text-sm">1</span>
                                    </div>
                                    <span class="font-medium text-gray-900">1st District</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    5 Municipalities
                                </span>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">March 1, 2026</td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="viewDistrict(1)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="View Municipalities">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="editDistrict(1)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Edit District">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteDistrict(1)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete District">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-amber-700 font-semibold text-sm">2</span>
                                    </div>
                                    <span class="font-medium text-gray-900">2nd District</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    4 Municipalities
                                </span>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">February 28, 2026</td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="viewDistrict(2)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="View Municipalities">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="editDistrict(2)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Edit District">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteDistrict(2)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete District">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-amber-700 font-semibold text-sm">3</span>
                                    </div>
                                    <span class="font-medium text-gray-900">3rd District</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    6 Municipalities
                                </span>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">February 25, 2026</td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="viewDistrict(3)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="View Municipalities">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="editDistrict(3)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Edit District">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteDistrict(3)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete District">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6">
                <p class="text-sm text-gray-600">Showing <span class="font-medium">3</span> of <span class="font-medium">3</span> districts</p>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-500 cursor-not-allowed">Previous</button>
                    <button class="px-3 py-1 bg-amber-600 text-white rounded-lg text-sm">1</button>
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-500 cursor-not-allowed">Next</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Municipality List View (Hidden by default) -->
    <div id="municipalityListView" class="hidden">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-cyan-500">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <button onclick="backToDistricts()" class="mr-4 p-2 text-white hover:bg-red-600 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <div>
                            <h2 class="text-xl font-semibold text-white" id="districtTitle">1st District - Municipalities</h2>
                            <p class="text-red-200 text-sm">Manage municipalities in this district</p>
                        </div>
                    </div>
                    <button onclick="openMunicipalityModal()" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Municipality
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <!-- Search and Sort -->
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" id="municipalitySearch" placeholder="Search municipalities..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <select id="municipalitySort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="name">Sort by Name</option>
                        <option value="status">Sort by Status</option>
                        <option value="updated">Sort by Last Updated</option>
                    </select>
                </div>

                <!-- Municipalities Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Municipality Name</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Address</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Contact</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Email</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Website</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Facebook</th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="municipalityTableBody">
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <img src="https://via.placeholder.com/40x40?text=LOGO" alt="Logo" class="w-10 h-10 rounded-lg mr-3">
                                        <div>
                                            <p class="font-medium text-gray-900">San Juan City</p>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Active</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">123 Main St, San Juan City</td>
                                <td class="py-3 px-4 text-sm text-gray-600">(02) 123-4567</td>
                                <td class="py-3 px-4 text-sm text-gray-600">info@sanjuan.gov.ph</td>
                                <td class="py-3 px-4">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">sanjuan.gov.ph</a>
                                </td>
                                <td class="py-3 px-4">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">fb.com/sanjuan</a>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="editMunicipality(1)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Edit Municipality">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button onclick="deleteMunicipality(1)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Municipality">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <img src="https://via.placeholder.com/40x40?text=LOGO" alt="Logo" class="w-10 h-10 rounded-lg mr-3">
                                        <div>
                                            <p class="font-medium text-gray-900">Quezon City</p>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Active</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">456 Gov Ave, Quezon City</td>
                                <td class="py-3 px-4 text-sm text-gray-600">(02) 987-6543</td>
                                <td class="py-3 px-4 text-sm text-gray-600">info@quezoncity.gov.ph</td>
                                <td class="py-3 px-4">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">quezoncity.gov.ph</a>
                                </td>
                                <td class="py-3 px-4">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">fb.com/quezoncity</a>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="editMunicipality(2)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Edit Municipality">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button onclick="deleteMunicipality(2)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Municipality">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <img src="https://via.placeholder.com/40x40?text=LOGO" alt="Logo" class="w-10 h-10 rounded-lg mr-3">
                                        <div>
                                            <p class="font-medium text-gray-900">Caloocan City</p>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">789 City Hall, Caloocan</td>
                                <td class="py-3 px-4 text-sm text-gray-600">(02) 555-1234</td>
                                <td class="py-3 px-4 text-sm text-gray-600">info@caloocan.gov.ph</td>
                                <td class="py-3 px-4">
                                    <span class="text-gray-400 text-sm">No website</span>
                                </td>
                                <td class="py-3 px-4">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">fb.com/caloocan</a>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="editMunicipality(3)" class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" title="Edit Municipality">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button onclick="deleteMunicipality(3)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Municipality">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6">
                    <p class="text-sm text-gray-600">Showing <span class="font-medium">3</span> of <span class="font-medium">3</span> municipalities</p>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-500 cursor-not-allowed">Previous</button>
                        <button class="px-3 py-1 bg-cyan-600 text-white rounded-lg text-sm">1</button>
                        <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-500 cursor-not-allowed">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- District Modal -->
<div id="districtModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="districtModalTitle">Add District</h3>
            <button onclick="document.getElementById('districtModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="districtForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">District Name</label>
                <input type="text" id="districtName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter district name" required>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('districtModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Save District
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Municipality Modal -->
<div id="municipalityModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="municipalityModalTitle">Add Municipality</h3>
            <button onclick="document.getElementById('municipalityModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="municipalityForm" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Municipality Name *</label>
                    <input type="text" id="municipalityName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Enter municipality name" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                    <input type="tel" id="municipalityContact" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="(02) 123-4567">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address *</label>
                    <textarea id="municipalityAddress" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Enter complete address" required></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="municipalityEmail" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="info@municipality.gov.ph">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Website Link (Optional)</label>
                    <input type="url" id="municipalityWebsite" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="https://www.municipality.gov.ph">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Facebook Page Link (Optional)</label>
                    <input type="url" id="municipalityFacebook" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="https://www.facebook.com/municipality">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Municipality Logo (Optional)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="mt-1 text-sm text-gray-600">Click to upload logo</p>
                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                        <input type="file" id="municipalityLogo" accept="image/*" class="hidden" onchange="previewLogo(event)">
                        <button type="button" onclick="document.getElementById('municipalityLogo').click()" class="mt-2 px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded text-sm">
                            Choose File
                        </button>
                    </div>
                    <div id="logoPreview" class="mt-2 hidden">
                        <img src="" alt="Logo Preview" class="w-16 h-16 rounded-lg object-cover">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="municipalityStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('municipalityModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg transition-colors">
                    Save Municipality
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let currentDistrictId = null;

// District Functions
function openDistrictModal() {
    document.getElementById('districtModalTitle').textContent = 'Add District';
    document.getElementById('districtForm').reset();
    document.getElementById('districtModal').classList.remove('hidden');
}

function editDistrict(id) {
    document.getElementById('districtModalTitle').textContent = 'Edit District';
    // Load district data into form
    document.getElementById('districtModal').classList.remove('hidden');
}

function deleteDistrict(id) {
    if (confirm('Are you sure you want to delete this district? This action cannot be undone.')) {
        console.log('Deleting district:', id);
        showNotification('District deleted successfully!', 'success');
    }
}

function viewDistrict(id) {
    currentDistrictId = id;
    console.log('Viewing district:', id);
    
    // Update district title
    const districtNames = {
        1: '1st District',
        2: '2nd District',
        3: '3rd District'
    };
    document.getElementById('districtTitle').textContent = districtNames[id] + ' - Municipalities';
    
    // Show municipality view, hide district view
    const districtView = document.getElementById('districtListView');
    const municipalityView = document.getElementById('municipalityListView');
    
    console.log('Before switch - District view visible:', !districtView.classList.contains('hidden'));
    console.log('Before switch - Municipality view visible:', !municipalityView.classList.contains('hidden'));
    
    districtView.classList.add('hidden');
    municipalityView.classList.remove('hidden');
    
    console.log('After switch - District view visible:', !districtView.classList.contains('hidden'));
    console.log('After switch - Municipality view visible:', !municipalityView.classList.contains('hidden'));
    
    // Scroll to top
    window.scrollTo(0, 0);
}

function backToDistricts() {
    console.log('Going back to districts list');
    
    const districtView = document.getElementById('districtListView');
    const municipalityView = document.getElementById('municipalityListView');
    
    console.log('Before back - District view visible:', !districtView.classList.contains('hidden'));
    console.log('Before back - Municipality view visible:', !municipalityView.classList.contains('hidden'));
    
    municipalityView.classList.add('hidden');
    districtView.classList.remove('hidden');
    
    console.log('After back - District view visible:', !districtView.classList.contains('hidden'));
    console.log('After back - Municipality view visible:', !municipalityView.classList.contains('hidden'));
    
    currentDistrictId = null;
    
    // Scroll to top
    window.scrollTo(0, 0);
}

// Municipality Functions
function openMunicipalityModal() {
    document.getElementById('municipalityModalTitle').textContent = 'Add Municipality';
    document.getElementById('municipalityForm').reset();
    document.getElementById('logoPreview').classList.add('hidden');
    document.getElementById('municipalityModal').classList.remove('hidden');
}

function editMunicipality(id) {
    console.log('Editing municipality:', id);
    document.getElementById('municipalityModalTitle').textContent = 'Edit Municipality';
    
    // Load sample municipality data into form
    const municipalityData = {
        1: {
            name: 'San Juan City',
            address: '123 Main St, San Juan City',
            contact: '(02) 123-4567',
            email: 'info@sanjuan.gov.ph',
            website: 'https://sanjuan.gov.ph',
            facebook: 'https://www.facebook.com/sanjuan',
            status: 'active'
        },
        2: {
            name: 'Quezon City',
            address: '456 Gov Ave, Quezon City',
            contact: '(02) 987-6543',
            email: 'info@quezoncity.gov.ph',
            website: 'https://quezoncity.gov.ph',
            facebook: 'https://www.facebook.com/quezoncity',
            status: 'active'
        },
        3: {
            name: 'Caloocan City',
            address: '789 City Hall, Caloocan',
            contact: '(02) 555-1234',
            email: 'info@caloocan.gov.ph',
            website: '',
            facebook: 'https://www.facebook.com/caloocan',
            status: 'inactive'
        }
    };
    
    const data = municipalityData[id];
    if (data) {
        document.getElementById('municipalityName').value = data.name;
        document.getElementById('municipalityAddress').value = data.address;
        document.getElementById('municipalityContact').value = data.contact;
        document.getElementById('municipalityEmail').value = data.email;
        document.getElementById('municipalityWebsite').value = data.website;
        document.getElementById('municipalityFacebook').value = data.facebook;
        document.getElementById('municipalityStatus').value = data.status;
    }
    
    document.getElementById('municipalityModal').classList.remove('hidden');
}

function deleteMunicipality(id) {
    if (confirm('Are you sure you want to delete this municipality?')) {
        console.log('Deleting municipality:', id);
        showNotification('Municipality deleted successfully!', 'success');
    }
}

function previewLogo(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('logoPreview').querySelector('img').src = e.target.result;
            document.getElementById('logoPreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

// Form Submissions
document.getElementById('districtForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Saving district...');
    document.getElementById('districtModal').classList.add('hidden');
    showNotification('District saved successfully!', 'success');
});

document.getElementById('municipalityForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Saving municipality...');
    document.getElementById('municipalityModal').classList.add('hidden');
    showNotification('Municipality saved successfully!', 'success');
});

// Search and Filter Functions
document.getElementById('districtSearch').addEventListener('input', function(e) {
    console.log('Searching districts:', e.target.value);
    // Implement search functionality
});

document.getElementById('districtSort').addEventListener('change', function(e) {
    console.log('Sorting districts by:', e.target.value);
    // Implement sort functionality
});

document.getElementById('municipalitySearch').addEventListener('input', function(e) {
    console.log('Searching municipalities:', e.target.value);
    // Implement search functionality
});

document.getElementById('municipalitySort').addEventListener('change', function(e) {
    console.log('Sorting municipalities by:', e.target.value);
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
