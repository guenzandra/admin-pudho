@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Citizen's Charter</h1>
            <p class="text-gray-600 mt-2">Manage Citizen's Charter content and document</p>
        </div>
    </div>

    <!-- Section 1: Intro Content -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-amber-500">
            <h2 class="text-xl font-semibold text-white">📝 Section 1: Intro Content</h2>
        </div>
        <div class="p-6">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Introduction Text</label>
                <div class="border border-gray-300 rounded-lg overflow-hidden">
                    <!-- Rich Text Editor Toolbar -->
                    <div class="bg-gray-50 border-b border-gray-300 px-4 py-2 flex items-center space-x-2">
                        <button onclick="formatText('bold')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                            </svg>
                        </button>
                        <button onclick="formatText('italic')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Italic">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4M14 4l-4 16M10 20h4"></path>
                            </svg>
                        </button>
                        <button onclick="formatText('underline')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Underline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v6a4 4 0 008 0V4m-8 12h8"></path>
                            </svg>
                        </button>
                        <div class="w-px h-6 bg-gray-300"></div>
                        <button onclick="formatText('insertUnorderedList')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Bullet List">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <button onclick="formatText('insertOrderedList')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Numbered List">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Rich Text Editor -->
                    <div id="introEditor" contenteditable="true" class="min-h-[200px] p-4 focus:outline-none" style="min-height: 200px;">
                        <p>Welcome to the Provincial Disaster Risk Reduction and Management Office (PDRRMO) Citizen's Charter. This document serves as your guide to understanding our services, procedures, and commitments to the public. We are dedicated to providing efficient, transparent, and responsive disaster risk reduction and management services to all citizens of our province.</p>
                        <p>Our charter outlines the following key areas:</p>
                        <ul>
                            <li>Emergency response procedures</li>
                            <li>Disaster preparedness programs</li>
                            <li>Risk assessment and mitigation</li>
                            <li>Public information and education</li>
                            <li>Coordination with partner agencies</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Current Content Preview -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Content Preview</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <div id="contentPreview" class="prose prose-sm max-w-none">
                        <!-- Preview will be updated here -->
                    </div>
                </div>
            </div>
            
            <!-- Save Button -->
            <div class="flex justify-end">
                <button onclick="saveIntroContent()" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Section 2: Citizen's Charter Document -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-amber-500">
            <h2 class="text-xl font-semibold text-white">📄 Section 2: Citizen's Charter Document</h2>
        </div>
        <div class="p-6">
            <!-- Current Document Info -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Current File</label>
                        <p class="font-medium text-gray-900">Citizen_Charter_2026.pdf</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Upload Date</label>
                        <p class="text-gray-900">March 1, 2026</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">File Size</label>
                        <p class="text-gray-900">2.4 MB</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                        <span id="documentStatus" class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 mt-6">
                    <button onclick="openUploadModal()" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        Upload PDF
                    </button>
                    <button onclick="viewDocument()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View PDF
                    </button>
                    <button onclick="openReplaceModal()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Replace PDF
                    </button>
                    <button onclick="deleteDocument()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete PDF
                    </button>
                    <button onclick="toggleStatus()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Toggle Status
                    </button>
                </div>
            </div>
            
            <!-- Note -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-blue-400 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-blue-800">
                            <strong>Note:</strong> Only one active Citizen's Charter document can be displayed at a time. When uploading a new document, it will automatically become the active document.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload PDF Modal -->
<div id="uploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Upload Citizen's Charter PDF</h3>
            <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="uploadForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload PDF Document *</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500">PDF files only, up to 10MB</p>
                    <input type="file" id="pdfInput" accept=".pdf" class="hidden" onchange="previewPDF(event)">
                    <button type="button" onclick="document.getElementById('pdfInput').click()" class="mt-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                        Choose PDF
                    </button>
                </div>
                <div id="pdfPreview" class="mt-2 hidden">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <svg class="w-8 h-8 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900" id="previewPDFName"></p>
                            <p class="text-xs text-gray-500" id="previewPDFSize"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                <p class="text-sm text-yellow-800">
                    <strong>Important:</strong> This new PDF will automatically become the active Citizen's Charter document and replace any existing active document.
                </p>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Upload PDF
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Replace PDF Modal -->
<div id="replaceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Replace Citizen's Charter PDF</h3>
            <button onclick="document.getElementById('replaceModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
            <p class="text-sm text-yellow-800">
                <strong>Warning:</strong> Replacing this document will overwrite the existing Citizen's Charter PDF. This action cannot be undone.
            </p>
        </div>
        
        <form id="replaceForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Document</label>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="font-medium text-gray-900">Citizen_Charter_2026.pdf</p>
                    <p class="text-sm text-gray-500">2.4 MB • Uploaded: March 1, 2026</p>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">New PDF Document *</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500">PDF files only, up to 10MB</p>
                    <input type="file" id="replacePdfInput" accept=".pdf" class="hidden" onchange="previewReplacePDF(event)">
                    <button type="button" onclick="document.getElementById('replacePdfInput').click()" class="mt-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                        Choose New PDF
                    </button>
                </div>
                <div id="replacePdfPreview" class="mt-2 hidden">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <svg class="w-8 h-8 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900" id="replacePreviewPDFName"></p>
                            <p class="text-xs text-gray-500" id="replacePreviewPDFSize"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('replaceModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Replace PDF
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let isActive = true;

// Rich Text Editor Functions
function formatText(command) {
    document.execCommand(command, false, null);
    document.getElementById('introEditor').focus();
    updatePreview();
}

function updatePreview() {
    const editorContent = document.getElementById('introEditor').innerHTML;
    document.getElementById('contentPreview').innerHTML = editorContent;
}

// Modal Functions
function openUploadModal() {
    document.getElementById('uploadForm').reset();
    document.getElementById('pdfPreview').classList.add('hidden');
    document.getElementById('uploadModal').classList.remove('hidden');
}

function openReplaceModal() {
    document.getElementById('replaceForm').reset();
    document.getElementById('replacePdfPreview').classList.add('hidden');
    document.getElementById('replaceModal').classList.remove('hidden');
}

// Document Management Functions
function saveIntroContent() {
    const content = document.getElementById('introEditor').innerHTML;
    console.log('Saving intro content:', content);
    showNotification('Introduction content saved successfully!', 'success');
}

function viewDocument() {
    // Check if document exists
    const fileName = document.querySelector('.font-medium.text-gray-900').textContent;
    if (fileName === 'No document uploaded') {
        showNotification('No document uploaded to view', 'warning');
        return;
    }
    
    // Open PDF in new tab (simulated)
    console.log('Viewing document:', fileName);
    window.open('/documents/citizen_charter_2026.pdf', '_blank');
    showNotification('Opening document in new tab...', 'success');
}

function deleteDocument() {
    if (confirm('Are you sure you want to delete the Citizen\'s Charter PDF? This action cannot be undone.')) {
        console.log('Deleting document...');
        showNotification('Document deleted successfully!', 'success');
        // Reset document info
        document.querySelector('.font-medium.text-gray-900').textContent = 'No document uploaded';
        document.getElementById('documentStatus').className = 'inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800';
        document.getElementById('documentStatus').textContent = 'Inactive';
    }
}

function toggleStatus() {
    const statusElement = document.getElementById('documentStatus');
    isActive = !isActive;
    
    if (isActive) {
        statusElement.className = 'inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800';
        statusElement.textContent = 'Active';
        showNotification('Document status changed to Active', 'success');
    } else {
        statusElement.className = 'inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800';
        statusElement.textContent = 'Inactive';
        showNotification('Document status changed to Inactive', 'warning');
    }
}

// Preview Functions
function previewPDF(event) {
    const file = event.target.files[0];
    if (file) {
        document.getElementById('previewPDFName').textContent = file.name;
        document.getElementById('previewPDFSize').textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
        document.getElementById('pdfPreview').classList.remove('hidden');
    }
}

function previewReplacePDF(event) {
    const file = event.target.files[0];
    if (file) {
        document.getElementById('replacePreviewPDFName').textContent = file.name;
        document.getElementById('replacePreviewPDFSize').textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
        document.getElementById('replacePdfPreview').classList.remove('hidden');
    }
}

// Form Submissions
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Uploading PDF...');
    document.getElementById('uploadModal').classList.add('hidden');
    showNotification('PDF uploaded successfully! This document is now active.', 'success');
    // Update document info
    document.querySelector('.font-medium.text-gray-900').textContent = document.getElementById('previewPDFName').textContent || 'New_Document.pdf';
    document.getElementById('documentStatus').className = 'inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800';
    document.getElementById('documentStatus').textContent = 'Active';
    isActive = true;
});

document.getElementById('replaceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Replacing PDF...');
    document.getElementById('replaceModal').classList.add('hidden');
    showNotification('PDF replaced successfully!', 'success');
    // Update document info
    document.querySelector('.font-medium.text-gray-900').textContent = document.getElementById('replacePreviewPDFName').textContent || 'Replaced_Document.pdf';
});

// Initialize preview on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePreview();
    
    // Update preview when editor content changes
    document.getElementById('introEditor').addEventListener('input', updatePreview);
});

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 
        type === 'error' ? 'bg-red-500 text-white' : 
        type === 'warning' ? 'bg-yellow-500 text-white' :
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
