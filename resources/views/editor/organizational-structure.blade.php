@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Organizational Structure</h1>
            <p class="text-gray-600 mt-2">Manage organizational chart and position descriptions</p>
        </div>
    </div>

    <!-- Organizational Chart Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-indigo-500">
            <h2 class="text-xl font-semibold text-white">Organizational Chart</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Current Chart Display -->
                <div class="lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Current Organizational Chart</h3>
                        <div class="flex space-x-2">
                            <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Upload New Chart
                            </button>
                            <button onclick="document.getElementById('replaceModal').classList.remove('hidden')" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Replace Image
                            </button>
                        </div>
                    </div>
                    
                    <!-- Chart Image Display -->
                    <div class="border-2 border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                        <img id="orgChartImage" src="https://via.placeholder.com/800x600?text=Organizational+Chart" alt="Organizational Chart" class="w-full h-auto">
                    </div>
                    
                    <!-- Chart Information -->
                    <div class="mt-4 p-4 bg-indigo-50 rounded-lg border-l-4 border-indigo-500">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-indigo-800 font-medium">Current Version</p>
                                <p class="text-indigo-600">v2.1 - Updated March 1, 2026</p>
                            </div>
                            <div>
                                <p class="text-indigo-800 font-medium">File Size</p>
                                <p class="text-indigo-600">2.4 MB - PNG Format</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions & Info -->
                <div>
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <h4 class="font-medium text-gray-900 mb-3">Quick Actions</h4>
                        <div class="space-y-2">
                            <button onclick="downloadChart()" class="w-full px-3 py-2 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg text-left text-sm">
                                <svg class="w-4 h-4 mr-2 inline text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download Current Chart
                            </button>
                            <button onclick="viewVersions()" class="w-full px-3 py-2 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg text-left text-sm">
                                <svg class="w-4 h-4 mr-2 inline text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                View Version History
                            </button>
                            <button onclick="printChart()" class="w-full px-3 py-2 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg text-left text-sm">
                                <svg class="w-4 h-4 mr-2 inline text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                Print Chart
                            </button>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 mb-3">Chart Guidelines</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Recommended size: 1200x800px</li>
                            <li>• Supported formats: PNG, JPG, PDF</li>
                            <li>• Maximum file size: 5MB</li>
                            <li>• Ensure text is readable</li>
                            <li>• Use high-resolution images</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Position List Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-teal-500">
            <h2 class="text-xl font-semibold text-white">Position List & Descriptions</h2>
        </div>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Current Positions</h3>
                <button onclick="openPositionModal()" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Position
                </button>
            </div>
            
            <!-- Position Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Executive Level -->
                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="bg-gradient-to-r from-red-800 to-red-900 px-4 py-3">
                        <h4 class="font-semibold text-white">Executive Director</h4>
                        <p class="text-red-200 text-sm">Executive Level</p>
                    </div>
                    <div class="p-4">
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Responsibilities:</p>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>• Overall strategic leadership</li>
                                <li>• Policy development</li>
                                <li>• Stakeholder relations</li>
                                <li>• Organizational oversight</li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-1">Reports to:</p>
                            <p class="text-sm font-medium text-gray-800">Board of Directors</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">Updated: Feb 28, 2026</span>
                            <div class="flex space-x-1">
                                <button onclick="editPosition(1)" class="p-1 text-blue-600 hover:text-blue-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deletePosition(1)" class="p-1 text-red-600 hover:text-red-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Management Level -->
                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-4 py-3">
                        <h4 class="font-semibold text-white">Operations Manager</h4>
                        <p class="text-red-200 text-sm">Management Level</p>
                    </div>
                    <div class="p-4">
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Responsibilities:</p>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>• Daily operations</li>
                                <li>• Team coordination</li>
                                <li>• Process improvement</li>
                                <li>• Performance monitoring</li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-1">Reports to:</p>
                            <p class="text-sm font-medium text-gray-800">Executive Director</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">Updated: Mar 1, 2026</span>
                            <div class="flex space-x-1">
                                <button onclick="editPosition(2)" class="p-1 text-blue-600 hover:text-blue-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deletePosition(2)" class="p-1 text-red-600 hover:text-red-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staff Level -->
                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 px-4 py-3">
                        <h4 class="font-semibold text-white">Housing Officer</h4>
                        <p class="text-red-200 text-sm">Staff Level</p>
                    </div>
                    <div class="p-4">
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Responsibilities:</p>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>• Client assistance</li>
                                <li>• Application processing</li>
                                <li>• Document management</li>
                                <li>• Public service</li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-1">Reports to:</p>
                            <p class="text-sm font-medium text-gray-800">Operations Manager</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">Updated: Feb 25, 2026</span>
                            <div class="flex space-x-1">
                                <button onclick="editPosition(3)" class="p-1 text-blue-600 hover:text-blue-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deletePosition(3)" class="p-1 text-red-600 hover:text-red-800">
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

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Upload New Organizational Chart</h3>
            <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Image File</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500">PNG, JPG, PDF up to 5MB</p>
                    <input type="file" id="chartUpload" accept="image/*,.pdf" class="hidden" onchange="previewUpload(event)">
                    <button onclick="document.getElementById('chartUpload').click()" class="mt-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                        Choose File
                    </button>
                </div>
            </div>
            
            <div id="uploadPreview" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <img id="previewImage" src="" alt="Preview" class="w-full h-auto max-h-64 object-contain">
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button onclick="uploadChart()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                    Upload Chart
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Replace Modal -->
<div id="replaceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Replace Organizational Chart</h3>
            <button onclick="document.getElementById('replaceModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="space-y-4">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                <p class="text-sm text-yellow-800">
                    <strong>Warning:</strong> Replacing the current chart will overwrite the existing image. Consider creating a backup first.
                </p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select New Image File</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500">PNG, JPG, PDF up to 5MB</p>
                    <input type="file" id="chartReplace" accept="image/*,.pdf" class="hidden" onchange="previewReplace(event)">
                    <button onclick="document.getElementById('chartReplace').click()" class="mt-2 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition-colors">
                        Choose File
                    </button>
                </div>
            </div>
            
            <div id="replacePreview" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <img id="replacePreviewImage" src="" alt="Preview" class="w-full h-auto max-h-64 object-contain">
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="document.getElementById('replaceModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button onclick="replaceChart()" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition-colors">
                    Replace Chart
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Position Modal -->
<div id="positionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="positionModalTitle">Add Position</h3>
            <button onclick="document.getElementById('positionModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="positionForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Position Title</label>
                <input type="text" id="positionTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500" placeholder="Enter position title">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                <select id="positionLevel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
                    <option value="executive">Executive Level</option>
                    <option value="management">Management Level</option>
                    <option value="staff">Staff Level</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Responsibilities</label>
                <textarea id="positionResponsibilities" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500" placeholder="Enter responsibilities (one per line)"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Reports To</label>
                <input type="text" id="positionReportsTo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500" placeholder="Enter reporting position">
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('positionModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg transition-colors">
                    Save Position
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('uploadPreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function previewReplace(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('replacePreviewImage').src = e.target.result;
            document.getElementById('replacePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function uploadChart() {
    const fileInput = document.getElementById('chartUpload');
    if (fileInput.files.length > 0) {
        // Simulate upload
        console.log('Uploading new chart...');
        
        // Update the main image
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('orgChartImage').src = e.target.result;
            document.getElementById('uploadModal').classList.add('hidden');
            showNotification('Chart uploaded successfully!', 'success');
        }
        reader.readAsDataURL(fileInput.files[0]);
    }
}

function replaceChart() {
    const fileInput = document.getElementById('chartReplace');
    if (fileInput.files.length > 0) {
        // Simulate replacement
        console.log('Replacing chart...');
        
        // Update the main image
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('orgChartImage').src = e.target.result;
            document.getElementById('replaceModal').classList.add('hidden');
            showNotification('Chart replaced successfully!', 'success');
        }
        reader.readAsDataURL(fileInput.files[0]);
    }
}

function openPositionModal() {
    document.getElementById('positionModalTitle').textContent = 'Add Position';
    document.getElementById('positionForm').reset();
    document.getElementById('positionModal').classList.remove('hidden');
}

function editPosition(id) {
    document.getElementById('positionModalTitle').textContent = 'Edit Position';
    // Load position data into form
    document.getElementById('positionModal').classList.remove('hidden');
}

function deletePosition(id) {
    if (confirm('Are you sure you want to delete this position?')) {
        console.log('Deleting position:', id);
        showNotification('Position deleted successfully!', 'success');
    }
}

function downloadChart() {
    // Simulate download
    console.log('Downloading chart...');
    showNotification('Chart download started!', 'info');
}

function viewVersions() {
    console.log('Viewing version history...');
    showNotification('Version history feature coming soon!', 'info');
}

function printChart() {
    window.print();
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 
        type === 'error' ? 'bg-red-500 text-white' : 
        'bg-blue-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Position form submission
document.getElementById('positionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Saving position...');
    document.getElementById('positionModal').classList.add('hidden');
    showNotification('Position saved successfully!', 'success');
});
</script>
@endsection
