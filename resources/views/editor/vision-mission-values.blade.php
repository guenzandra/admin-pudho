@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Vision, Mission & Core Values</h1>
            <p class="text-gray-600 mt-2">Manage the organization's foundational statements and values</p>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="space-y-8">
        <!-- Vision Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 border-l-4 border-green-500">
                <h2 class="text-xl font-semibold text-white">Vision</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Editor -->
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Edit Vision Statement</h3>
                            <div class="flex space-x-2">
                                <button onclick="formatText('bold')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('italic')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4M14 4l-4 16m-4 0h4"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('underline')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Underline">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M5 8h14M5 16h14"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('insertUnorderedList')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Bullet List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('insertOrderedList')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Numbered List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="visionEditor" contenteditable="true" class="min-h-[200px] p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-slate-500 outline-none" oninput="updatePreview('vision')">
                            <p><strong>To be the leading provider</strong> of quality housing solutions and sustainable community development in the region, empowering families to achieve their dreams of homeownership and improved quality of life.</p>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <div class="text-sm text-gray-500">
                                <span id="visionWordCount">Word count: 23</span>
                            </div>
                            <button onclick="saveContent('vision')" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                                Save Vision
                            </button>
                        </div>
                    </div>
                    
                    <!-- Preview -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Preview</h3>
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div id="visionPreview" class="prose prose-sm max-w-none">
                                <p><strong>To be the leading provider</strong> of quality housing solutions and sustainable community development in the region, empowering families to achieve their dreams of homeownership and improved quality of life.</p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                            <p class="text-sm text-green-800">
                                <strong>Last updated:</strong> March 2, 2026 at 3:45 PM
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-green-500">
                <h2 class="text-xl font-semibold text-white">Mission</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Editor -->
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Edit Mission Statement</h3>
                            <div class="flex space-x-2">
                                <button onclick="formatText('bold')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('italic')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4M14 4l-4 16m-4 0h4"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('underline')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Underline">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M5 8h14M5 16h14"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('insertUnorderedList')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Bullet List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('insertOrderedList')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Numbered List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="missionEditor" contenteditable="true" class="min-h-[200px] p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500 outline-none" oninput="updatePreview('mission')">
                            <p><strong>We are committed</strong> to providing accessible, affordable, and sustainable housing solutions through:</p>
                            <ul>
                                <li>Professional service and community engagement</li>
                                <li>Innovative development programs</li>
                                <li>Partnerships with stakeholders</li>
                                <li>Environmental responsibility</li>
                            </ul>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <div class="text-sm text-gray-500">
                                <span id="missionWordCount">Word count: 18</span>
                            </div>
                            <button onclick="saveContent('mission')" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                                Save Mission
                            </button>
                        </div>
                    </div>
                    
                    <!-- Preview -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Preview</h3>
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div id="missionPreview" class="prose prose-sm max-w-none">
                                <p><strong>We are committed</strong> to providing accessible, affordable, and sustainable housing solutions through:</p>
                                <ul>
                                    <li>Professional service and community engagement</li>
                                    <li>Innovative development programs</li>
                                    <li>Partnerships with stakeholders</li>
                                    <li>Environmental responsibility</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                            <p class="text-sm text-green-800">
                                <strong>Last updated:</strong> March 1, 2026 at 2:30 PM
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Values Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-red-800 to-red-900 px-6 py-4 border-l-4 border-green-500">
                <h2 class="text-xl font-semibold text-white">Core Values</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Editor -->
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Edit Core Values</h3>
                            <div class="flex space-x-2">
                                <button onclick="formatText('bold')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('italic')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4M14 4l-4 16m-4 0h4"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('underline')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Underline">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M5 8h14M5 16h14"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('insertUnorderedList')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Bullet List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </button>
                                <button onclick="formatText('insertOrderedList')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded transition-colors" title="Numbered List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="valuesEditor" contenteditable="true" class="min-h-[200px] p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zinc-500 focus:border-zinc-500 outline-none" oninput="updatePreview('values')">
                            <p><strong>Our core values guide</strong> everything we do:</p>
                            <ul>
                                <li><strong>Integrity</strong> - We act with honesty and transparency</li>
                                <li><strong>Excellence</strong> - We strive for the highest standards</li>
                                <li><strong>Compassion</strong> - We care for our community</li>
                                <li><strong>Innovation</strong> - We embrace creative solutions</li>
                                <li><strong>Sustainability</strong> - We protect our environment</li>
                            </ul>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <div class="text-sm text-gray-500">
                                <span id="valuesWordCount">Word count: 22</span>
                            </div>
                            <button onclick="saveContent('values')" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                                Save Core Values
                            </button>
                        </div>
                    </div>
                    
                    <!-- Preview -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Preview</h3>
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div id="valuesPreview" class="prose prose-sm max-w-none">
                                <p><strong>Our core values guide</strong> everything we do:</p>
                                <ul>
                                    <li><strong>Integrity</strong> - We act with honesty and transparency</li>
                                    <li><strong>Excellence</strong> - We strive for the highest standards</li>
                                    <li><strong>Compassion</strong> - We care for our community</li>
                                    <li><strong>Innovation</strong> - We embrace creative solutions</li>
                                    <li><strong>Sustainability</strong> - We protect our environment</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                            <p class="text-sm text-green-800">
                                <strong>Last updated:</strong> February 28, 2026 at 4:15 PM
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Version History (Optional) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Version History</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <p class="text-sm font-medium text-gray-900">Vision Statement - Version 3</p>
                    <p class="text-xs text-gray-500">Updated by John Doe on March 2, 2026 at 3:45 PM</p>
                </div>
                <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">View</button>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <p class="text-sm font-medium text-gray-900">Mission Statement - Version 2</p>
                    <p class="text-xs text-gray-500">Updated by Jane Smith on March 1, 2026 at 2:30 PM</p>
                </div>
                <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">View</button>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <p class="text-sm font-medium text-gray-900">Core Values - Version 1</p>
                    <p class="text-xs text-gray-500">Updated by Mike Johnson on February 28, 2026 at 4:15 PM</p>
                </div>
                <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">View</button>
            </div>
        </div>
    </div>
</div>

<script>
// Rich text editor functions
function formatText(command) {
    document.execCommand(command, false, null);
    // Update preview for the active editor
    const activeElement = document.activeElement;
    if (activeElement && activeElement.contentEditable === 'true') {
        const section = activeElement.id.replace('Editor', '');
        updatePreview(section);
    }
}

function updatePreview(section) {
    const editor = document.getElementById(section + 'Editor');
    const preview = document.getElementById(section + 'Preview');
    const wordCount = document.getElementById(section + 'WordCount');
    
    // Update preview
    preview.innerHTML = editor.innerHTML;
    
    // Update word count
    const text = editor.innerText || editor.textContent;
    const words = text.trim().split(/\s+/).filter(word => word.length > 0);
    wordCount.textContent = `Word count: ${words.length}`;
}

function saveContent(section) {
    const editor = document.getElementById(section + 'Editor');
    const content = editor.innerHTML;
    
    // Simulate save operation
    console.log(`Saving ${section} content:`, content);
    
    // Show success message
    showSaveConfirmation(section);
    
    // Update last modified time
    updateLastModified(section);
}

function showSaveConfirmation(section) {
    const button = event.target;
    const originalText = button.textContent;
    const originalClass = button.className;
    
    button.textContent = 'Saved!';
    button.className = 'px-4 py-2 bg-green-600 text-white rounded-lg transition-colors';
    
    setTimeout(() => {
        button.textContent = originalText;
        button.className = originalClass;
    }, 2000);
}

function updateLastModified(section) {
    const now = new Date();
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric', 
        hour: 'numeric', 
        minute: 'numeric',
        hour12: true 
    };
    const formattedDate = now.toLocaleDateString('en-US', options);
    
    // Find and update the last modified element
    const sectionElement = document.getElementById(section + 'Editor').closest('.bg-white');
    const lastModifiedElement = sectionElement.querySelector('.bg-slate-50, .bg-gray-50, .bg-zinc-50');
    if (lastModifiedElement) {
        const colorClass = 'gray';
        lastModifiedElement.innerHTML = `
            <p class="text-sm text-${colorClass}-800">
                <strong>Last updated:</strong> ${formattedDate}
            </p>
        `;
    }
}

// Initialize word counts on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePreview('vision');
    updatePreview('mission');
    updatePreview('values');
});

// Handle keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey || e.metaKey) {
        switch(e.key) {
            case 'b':
                e.preventDefault();
                formatText('bold');
                break;
            case 'i':
                e.preventDefault();
                formatText('italic');
                break;
            case 'u':
                e.preventDefault();
                formatText('underline');
                break;
        }
    }
});
</script>
@endsection
