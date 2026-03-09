@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Help & User Guide</h1>
                <p class="text-gray-600 mt-2">Learn how to use the editor panel and manage your content effectively</p>
            </div>
        </div>
    </div>

    <!-- Help Guide Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- How to Add News -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">How to Add News</h3>
                        <p class="text-sm text-blue-700">Create and publish news articles</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-blue-600">1</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Navigate to News Section</h4>
                            <p class="text-sm text-gray-600">Go to "Content Management" → "News & Accomplishments" in the sidebar</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-blue-600">2</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Click "Add New News"</h4>
                            <p class="text-sm text-gray-600">Use the blue button to create a new news article</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-blue-600">3</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Fill in Details</h4>
                            <p class="text-sm text-gray-600">Add title, content, featured image, and select category</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-blue-600">4</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Publish or Save Draft</h4>
                            <p class="text-sm text-gray-600">Choose to publish immediately or save as draft</p>
                        </div>
                    </div>
                </div>
                
                <button onclick="showDetailedGuide('news')" class="mt-4 w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    View Detailed Guide
                </button>
            </div>
        </div>

        <!-- How to Upload Forms -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-green-100">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">How to Upload Forms</h3>
                        <p class="text-sm text-green-700">Manage downloadable forms and documents</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-green-600">1</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Go to File Management</h4>
                            <p class="text-sm text-gray-600">Navigate to "File Management" → "Downloadable Forms"</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-green-600">2</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Upload Form File</h4>
                            <p class="text-sm text-gray-600">Click "Upload Form" and select PDF or document file</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-green-600">3</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Add Form Details</h4>
                            <p class="text-sm text-gray-600">Enter form name, description, and assign category</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-green-600">4</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Set Status</h4>
                            <p class="text-sm text-gray-600">Choose active/inactive status and save the form</p>
                        </div>
                    </div>
                </div>
                
                <button onclick="showDetailedGuide('forms')" class="mt-4 w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                    View Detailed Guide
                </button>
            </div>
        </div>

        <!-- How to Manage FAQs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-purple-100">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">How to Manage FAQs</h3>
                        <p class="text-sm text-purple-700">Organize frequently asked questions</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-purple-600">1</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Access FAQ Management</h4>
                            <p class="text-sm text-gray-600">Go to "FAQ Management" → "Manage FAQs"</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-purple-600">2</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Add New FAQ</h4>
                            <p class="text-sm text-gray-600">Click "Add FAQ" and enter question and answer</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-purple-600">3</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Assign Category</h4>
                            <p class="text-sm text-gray-600">Select appropriate category for organization</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-purple-600">4</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Set Priority</h4>
                            <p class="text-sm text-gray-600">Choose display order and save the FAQ</p>
                        </div>
                    </div>
                </div>
                
                <button onclick="showDetailedGuide('faqs')" class="mt-4 w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
                    View Detailed Guide
                </button>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-red-50 to-red-100">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Contact Support</h3>
                        <p class="text-sm text-red-700">Get help from our support team</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Email Support</h4>
                            <p class="text-sm text-gray-600">support@pudho.gov.ph</p>
                            <p class="text-xs text-gray-500">Response within 24 hours</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Phone Support</h4>
                            <p class="text-sm text-gray-600">(049) 511-2345</p>
                            <p class="text-xs text-gray-500">Mon-Fri, 8:00 AM - 5:00 PM</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Help Desk Portal</h4>
                            <p class="text-sm text-gray-600">help.pudho.gov.ph</p>
                            <p class="text-xs text-gray-500">Submit tickets and track progress</p>
                        </div>
                    </div>
                </div>
                
                <button onclick="contactSupport()" class="mt-4 w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    Contact Support Team
                </button>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <div class="text-sm text-gray-600">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Need more help? Access our complete documentation library</span>
                </div>
            </div>
            <div class="flex space-x-3">
                <button onclick="viewHelpDocumentation()" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                    View Help Documentation
                </button>
                <button onclick="downloadGuide()" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    Download Guide
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Links Section -->
    <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-4">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-medium text-amber-900">Quick Links</h4>
                <div class="mt-2 grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <a href="#" class="text-sm text-amber-800 hover:text-amber-900 underline">Video Tutorials</a>
                    <a href="#" class="text-sm text-amber-800 hover:text-amber-900 underline">Best Practices</a>
                    <a href="#" class="text-sm text-amber-800 hover:text-amber-900 underline">API Documentation</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div id="helpToast" class="fixed bottom-4 right-4 bg-white rounded-lg shadow-lg border border-gray-200 p-4 hidden transform transition-all duration-300 translate-y-full">
    <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h4 class="font-medium text-gray-800">Action Completed</h4>
            <p class="text-sm text-gray-600" id="toastMessage">Your request has been processed successfully.</p>
        </div>
    </div>
</div>

<script>
function showDetailedGuide(topic) {
    console.log('Opening detailed guide for:', topic);
    
    const guides = {
        news: 'Opening detailed news creation guide...',
        forms: 'Opening detailed forms upload guide...',
        faqs: 'Opening detailed FAQ management guide...'
    };
    
    showToast(guides[topic] || 'Opening guide...', 'info');
    
    // Simulate opening detailed guide
    setTimeout(() => {
        console.log(`Detailed ${topic} guide opened in new tab`);
    }, 1000);
}

function contactSupport() {
    console.log('Opening contact support form...');
    showToast('Opening support contact form...', 'info');
    
    // Simulate opening support form
    setTimeout(() => {
        console.log('Support contact form opened');
    }, 1000);
}

function viewHelpDocumentation() {
    console.log('Opening help documentation...');
    showToast('Opening complete help documentation...', 'info');
    
    // Simulate opening documentation
    setTimeout(() => {
        console.log('Help documentation opened in new tab');
    }, 1000);
}

function downloadGuide() {
    console.log('Downloading user guide...');
    showToast('Downloading user guide PDF...', 'success');
    
    // Simulate download
    setTimeout(() => {
        console.log('User guide PDF downloaded');
        showToast('User guide downloaded successfully!', 'success');
    }, 2000);
}

function showToast(message, type = 'success') {
    const toast = document.getElementById('helpToast');
    const messageElement = document.getElementById('toastMessage');
    const titleElement = toast.querySelector('h4');
    const iconElement = toast.querySelector('.w-10');
    
    // Update message
    messageElement.textContent = message;
    
    // Update icon and colors based on type
    if (type === 'success') {
        titleElement.textContent = 'Success';
        iconElement.className = 'w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center';
        iconElement.innerHTML = '<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
    } else if (type === 'info') {
        titleElement.textContent = 'Information';
        iconElement.className = 'w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center';
        iconElement.innerHTML = '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
    }
    
    // Show toast
    toast.classList.remove('hidden', 'translate-y-full');
    toast.classList.add('translate-y-0');
    
    // Hide after 3 seconds
    setTimeout(() => {
        toast.classList.add('translate-y-full');
        toast.classList.remove('translate-y-0');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 300);
    }, 3000);
}

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to guide cards
    document.querySelectorAll('.bg-white.rounded-xl').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('shadow-md', 'transform', 'scale-105');
            this.classList.remove('shadow-sm');
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('shadow-md', 'transform', 'scale-105');
            this.classList.add('shadow-sm');
        });
    });
    
    // Add click tracking to all buttons
    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            console.log('User clicked:', action);
        });
    });
});
</script>
@endsection
