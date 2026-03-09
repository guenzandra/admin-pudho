@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Editor Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome to Editor Panel - Overview & Quick Access</p>
    </div>

    <!-- Success Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-2 right-2 text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <!-- Total Announcements -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between h-full">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 leading-tight">Total Announcements</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalAnnouncements ?? 0 }}</p>
                </div>
                <div class="bg-blue-100 rounded-lg p-3 flex-shrink-0 ml-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total News -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between h-full">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 leading-tight">Total News</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalNews ?? 0 }}</p>
                </div>
                <div class="bg-green-100 rounded-lg p-3 flex-shrink-0 ml-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Services -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between h-full">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 leading-tight">Total Services</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalServices ?? 0 }}</p>
                </div>
                <div class="bg-purple-100 rounded-lg p-3 flex-shrink-0 ml-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total FAQs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between h-full">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 leading-tight">Total FAQs</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalFAQs ?? 0 }}</p>
                </div>
                <div class="bg-orange-100 rounded-lg p-3 flex-shrink-0 ml-3">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Downloadable Forms -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between h-full">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 leading-tight">Downloadable Forms</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalForms ?? 0 }}</p>
                </div>
                <div class="bg-red-100 rounded-lg p-3 flex-shrink-0 ml-3">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <button onclick="window.location.href='#'" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add News
            </button>
            <button onclick="window.location.href='#'" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Service
            </button>
            <button onclick="window.location.href='#'" class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add FAQ
            </button>
            <button onclick="window.location.href='#'" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
                Add Announcement
            </button>
        </div>
    </div>

    <!-- Notifications (if implemented) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Recent Notifications</h2>
            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">3 New</span>
        </div>
        <div class="space-y-3">
            <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                <div class="bg-blue-100 rounded-full p-1">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-800">New announcement requires approval</p>
                    <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                <div class="bg-green-100 rounded-full p-1">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-800">News article published successfully</p>
                    <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-orange-50 rounded-lg">
                <div class="bg-orange-100 rounded-full p-1">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-800">Service update requires review</p>
                    <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Content Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recently Added Content -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Recently Added Content</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-2 font-medium text-gray-700">Title</th>
                            <th class="text-left py-3 px-2 font-medium text-gray-700">Type</th>
                            <th class="text-left py-3 px-2 font-medium text-gray-700">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-medium text-gray-900">PUDHO Monthly Report</div>
                            </td>
                            <td class="py-3 px-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">News</span>
                            </td>
                            <td class="py-3 px-2 text-gray-600">Mar 2, 2026</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-medium text-gray-900">Housing Application Process</div>
                            </td>
                            <td class="py-3 px-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Service</span>
                            </td>
                            <td class="py-3 px-2 text-gray-600">Mar 1, 2026</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-medium text-gray-900">Office Holiday Schedule</div>
                            </td>
                            <td class="py-3 px-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Announcement</span>
                            </td>
                            <td class="py-3 px-2 text-gray-600">Feb 28, 2026</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-medium text-gray-900">FAQ: Application Requirements</div>
                            </td>
                            <td class="py-3 px-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">FAQ</span>
                            </td>
                            <td class="py-3 px-2 text-gray-600">Feb 27, 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recently Edited Content -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Recently Edited Content</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-2 font-medium text-gray-700">Title</th>
                            <th class="text-left py-3 px-2 font-medium text-gray-700">Type</th>
                            <th class="text-left py-3 px-2 font-medium text-gray-700">Edited</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-medium text-gray-900">Vision & Mission Statement</div>
                            </td>
                            <td class="py-3 px-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Page</span>
                            </td>
                            <td class="py-3 px-2 text-gray-600">2 hours ago</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-medium text-gray-900">Contact Information Update</div>
                            </td>
                            <td class="py-3 px-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">News</span>
                            </td>
                            <td class="py-3 px-2 text-gray-600">5 hours ago</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-medium text-gray-900">Service Requirements</div>
                            </td>
                            <td class="py-3 px-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Service</span>
                            </td>
                            <td class="py-3 px-2 text-gray-600">1 day ago</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-medium text-gray-900">Organizational Chart</div>
                            </td>
                            <td class="py-3 px-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Page</span>
                            </td>
                            <td class="py-3 px-2 text-gray-600">2 days ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection