@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Images</h1>
            <p class="text-gray-600 mt-2">Manage and organize media images for various sections</p>
        </div>
        <button onclick="openUploadModal()" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
            </svg>
            Upload Image
        </button>
    </div>

    <!-- Filter by Usage -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-amber-500">
            <h2 class="text-xl font-semibold text-white">Media Gallery</h2>
        </div>
        <div class="p-6">
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="imageSearch" placeholder="Search images..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <select id="usageFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="all">All Images</option>
                    <option value="carousel">Carousel</option>
                    <option value="news">News</option>
                    <option value="services">Services</option>
                    <option value="orgchart">Org Chart</option>
                </select>
            </div>

            <!-- Image Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <!-- Image Card 1 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Carousel+Image+1" alt="Carousel Image 1" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">Carousel</span>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button onclick="previewImage(1)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="copyImageLink(1)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">carousel_hero_01.jpg</h3>
                        <p class="text-sm text-gray-600 mb-3">March 1, 2026</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editImageUsage(1)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Usage">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteImage(1)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 2 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=News+Image+1" alt="News Image 1" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">News</span>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button onclick="previewImage(2)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="copyImageLink(2)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">news_announcement_01.jpg</h3>
                        <p class="text-sm text-gray-600 mb-3">February 28, 2026</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editImageUsage(2)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Usage">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteImage(2)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 3 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Service+Image+1" alt="Service Image 1" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-purple-100 text-purple-800">Services</span>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button onclick="previewImage(3)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="copyImageLink(3)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">service_healthcare_01.jpg</h3>
                        <p class="text-sm text-gray-600 mb-3">February 25, 2026</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editImageUsage(3)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Usage">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteImage(3)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 4 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Org+Chart+Image+1" alt="Org Chart Image 1" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800">Org Chart</span>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button onclick="previewImage(4)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="copyImageLink(4)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">org_chart_director_01.jpg</h3>
                        <p class="text-sm text-gray-600 mb-3">February 20, 2026</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editImageUsage(4)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Usage">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteImage(4)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 5 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Carousel+Image+2" alt="Carousel Image 2" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">Carousel</span>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button onclick="previewImage(5)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="copyImageLink(5)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">carousel_hero_02.jpg</h3>
                        <p class="text-sm text-gray-600 mb-3">February 15, 2026</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editImageUsage(5)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Usage">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteImage(5)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 6 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=News+Image+2" alt="News Image 2" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">News</span>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button onclick="previewImage(6)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="copyImageLink(6)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">news_event_01.jpg</h3>
                        <p class="text-sm text-gray-600 mb-3">February 10, 2026</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editImageUsage(6)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Usage">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteImage(6)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 7 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Service+Image+2" alt="Service Image 2" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-purple-100 text-purple-800">Services</span>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button onclick="previewImage(7)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="copyImageLink(7)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">service_education_01.jpg</h3>
                        <p class="text-sm text-gray-600 mb-3">February 5, 2026</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editImageUsage(7)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Usage">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteImage(7)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card 8 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x200?text=Org+Chart+Image+2" alt="Org Chart Image 2" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800">Org Chart</span>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button onclick="previewImage(8)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="copyImageLink(8)" class="p-2 bg-white rounded-full text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1">org_chart_manager_01.jpg</h3>
                        <p class="text-sm text-gray-600 mb-3">February 1, 2026</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editImageUsage(8)" class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Usage">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteImage(8)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Image Modal -->
<div id="uploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Upload Image</h3>
            <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="uploadForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">File Name *</label>
                <input type="text" id="fileName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter file name" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Used For</label>
                <select id="imageUsage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="carousel">Carousel</option>
                    <option value="news">News</option>
                    <option value="services">Services</option>
                    <option value="orgchart">Org Chart</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image *</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                    <input type="file" id="imageInput" accept="image/*" class="hidden" onchange="previewUploadImage(event)">
                    <button type="button" onclick="document.getElementById('imageInput').click()" class="mt-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                        Choose Image
                    </button>
                </div>
                <div id="uploadImagePreview" class="mt-2 hidden">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <svg class="w-8 h-8 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900" id="uploadPreviewFileName"></p>
                            <p class="text-xs text-gray-500" id="uploadPreviewFileSize"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Upload Image
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Image Modal -->
<div id="previewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Image Preview</h3>
            <button onclick="document.getElementById('previewModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="text-center">
            <img id="previewImageSrc" src="" alt="Preview" class="max-w-full max-h-96 mx-auto rounded-lg">
            <div class="mt-4">
                <p class="text-sm text-gray-600" id="previewImageName"></p>
                <p class="text-xs text-gray-500" id="previewImageDate"></p>
            </div>
        </div>
    </div>
</div>

<!-- Edit Usage Modal -->
<div id="usageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Edit Image Usage</h3>
            <button onclick="document.getElementById('usageModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="usageForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Usage</label>
                <select id="editImageUsage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="carousel">Carousel</option>
                    <option value="news">News</option>
                    <option value="services">Services</option>
                    <option value="orgchart">Org Chart</option>
                </select>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('usageModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Update Usage
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let currentImageId = null;

// Modal Functions
function openUploadModal() {
    document.getElementById('uploadForm').reset();
    document.getElementById('uploadImagePreview').classList.add('hidden');
    document.getElementById('uploadModal').classList.remove('hidden');
}

function previewImage(id) {
    currentImageId = id;
    console.log('Previewing image:', id);
    
    const imageData = {
        1: { src: 'https://via.placeholder.com/800x600?text=Carousel+Image+1+Preview', name: 'carousel_hero_01.jpg', date: 'March 1, 2026' },
        2: { src: 'https://via.placeholder.com/800x600?text=News+Image+1+Preview', name: 'news_announcement_01.jpg', date: 'February 28, 2026' },
        3: { src: 'https://via.placeholder.com/800x600?text=Service+Image+1+Preview', name: 'service_healthcare_01.jpg', date: 'February 25, 2026' },
        4: { src: 'https://via.placeholder.com/800x600?text=Org+Chart+Image+1+Preview', name: 'org_chart_director_01.jpg', date: 'February 20, 2026' },
        5: { src: 'https://via.placeholder.com/800x600?text=Carousel+Image+2+Preview', name: 'carousel_hero_02.jpg', date: 'February 15, 2026' },
        6: { src: 'https://via.placeholder.com/800x600?text=News+Image+2+Preview', name: 'news_event_01.jpg', date: 'February 10, 2026' },
        7: { src: 'https://via.placeholder.com/800x600?text=Service+Image+2+Preview', name: 'service_education_01.jpg', date: 'February 5, 2026' },
        8: { src: 'https://via.placeholder.com/800x600?text=Org+Chart+Image+2+Preview', name: 'org_chart_manager_01.jpg', date: 'February 1, 2026' }
    };
    
    const data = imageData[id];
    if (data) {
        document.getElementById('previewImageSrc').src = data.src;
        document.getElementById('previewImageName').textContent = data.name;
        document.getElementById('previewImageDate').textContent = `Uploaded: ${data.date}`;
    }
    
    document.getElementById('previewModal').classList.remove('hidden');
}

function copyImageLink(id) {
    console.log('Copying image link for:', id);
    const imageUrl = `https://example.com/images/image_${id}.jpg`;
    navigator.clipboard.writeText(imageUrl).then(() => {
        showNotification('Image link copied to clipboard!', 'success');
    }).catch(() => {
        showNotification('Failed to copy image link', 'error');
    });
}

function editImageUsage(id) {
    currentImageId = id;
    console.log('Editing image usage for:', id);
    
    const imageUsageData = {
        1: 'carousel',
        2: 'news',
        3: 'services',
        4: 'orgchart',
        5: 'carousel',
        6: 'news',
        7: 'services',
        8: 'orgchart'
    };
    
    const usage = imageUsageData[id];
    if (usage) {
        document.getElementById('editImageUsage').value = usage;
    }
    
    document.getElementById('usageModal').classList.remove('hidden');
}

function deleteImage(id) {
    if (confirm('Are you sure you want to delete this image? This action cannot be undone.')) {
        console.log('Deleting image:', id);
        showNotification('Image deleted successfully!', 'success');
    }
}

// Preview Functions
function previewUploadImage(event) {
    const file = event.target.files[0];
    if (file) {
        document.getElementById('uploadPreviewFileName').textContent = file.name;
        document.getElementById('uploadPreviewFileSize').textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
        document.getElementById('uploadImagePreview').classList.remove('hidden');
    }
}

// Search and Filter Functions
document.getElementById('imageSearch').addEventListener('input', function(e) {
    console.log('Searching images:', e.target.value);
    // Implement search functionality
});

document.getElementById('usageFilter').addEventListener('change', function(e) {
    console.log('Filtering by usage:', e.target.value);
    // Implement usage filter functionality
});

// Form Submissions
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Uploading image...');
    document.getElementById('uploadModal').classList.add('hidden');
    showNotification('Image uploaded successfully!', 'success');
});

document.getElementById('usageForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Updating image usage...');
    document.getElementById('usageModal').classList.add('hidden');
    showNotification('Image usage updated successfully!', 'success');
    currentImageId = null;
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
