@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Content Preferences</h1>
                <p class="text-gray-600 mt-2">Configure your default content settings and workflow preferences</p>
            </div>
        </div>
    </div>

    <!-- Content Preferences Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Editor Workflow Settings</h2>
            <p class="text-sm text-gray-600">Customize how content is created and managed by default</p>
        </div>

        <div class="p-6 space-y-8">
            <!-- Default Post Status -->
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 mb-1">Default Post Status</h3>
                        <p class="text-sm text-gray-600 mb-4">Choose the default status when creating new content</p>
                        
                        <div class="space-y-3">
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="defaultPostStatus" value="draft" class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300" checked>
                                <div class="ml-3">
                                    <div class="font-medium text-gray-800">Draft</div>
                                    <div class="text-sm text-gray-600">Content starts as draft and needs review before publishing</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="defaultPostStatus" value="published" class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <div class="ml-3">
                                    <div class="font-medium text-gray-800">Published</div>
                                    <div class="text-sm text-gray-600">Content is published immediately upon creation</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Default Category -->
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 mb-1">Default Category for Content</h3>
                        <p class="text-sm text-gray-600 mb-4">Select the default category for new content items</p>
                        
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">No Default Category</option>
                            <option value="announcements">Announcements</option>
                            <option value="news">News & Accomplishments</option>
                            <option value="services">Services</option>
                            <option value="policies">Policies</option>
                            <option value="events">Events</option>
                            <option value="reports">Reports</option>
                        </select>
                        
                        <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start space-x-2">
                                <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="text-sm text-blue-800">
                                    <strong>Tip:</strong> Setting a default category helps organize content consistently and saves time during content creation.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Per Page -->
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 mb-1">Items Per Page in Tables</h3>
                        <p class="text-sm text-gray-600 mb-4">Control how many items appear in data tables by default</p>
                        
                        <div class="space-y-3">
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="itemsPerPage" value="10" class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300" checked>
                                <div class="ml-3">
                                    <div class="font-medium text-gray-800">10 items</div>
                                    <div class="text-sm text-gray-600">Best for slower connections and detailed review</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="itemsPerPage" value="20" class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <div class="ml-3">
                                    <div class="font-medium text-gray-800">20 items</div>
                                    <div class="text-sm text-gray-600">Balanced option for most users</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="itemsPerPage" value="50" class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <div class="ml-3">
                                    <div class="font-medium text-gray-800">50 items</div>
                                    <div class="text-sm text-gray-600">Maximum items for power users and bulk operations</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Preferences -->
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 mb-1">Additional Preferences</h3>
                        <p class="text-sm text-gray-600 mb-4">Other workflow and display settings</p>
                        
                        <div class="space-y-4">
                            <!-- Auto-save -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium text-gray-800">Auto-save Content</div>
                                    <div class="text-sm text-gray-600">Automatically save content while editing</div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                                </label>
                            </div>

                            <!-- Show Advanced Options -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium text-gray-800">Show Advanced Options</div>
                                    <div class="text-sm text-gray-600">Display advanced editing options by default</div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                                </label>
                            </div>

                            <!-- Compact View -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium text-gray-800">Compact Table View</div>
                                    <div class="text-sm text-gray-600">Use more compact table layout for better space utilization</div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Preferences are saved automatically and applied across all editor sessions</span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button onclick="resetToDefaults()" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                        Reset to Default
                    </button>
                    <button onclick="saveContentPreferences()" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        Save Preferences
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Workflow Benefits Section -->
    <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-4">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-medium text-green-900">Workflow Optimization</h4>
                <p class="text-sm text-green-800 mt-1">These preferences help streamline your content creation process, reduce repetitive tasks, and maintain consistency across your editorial work.</p>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div id="successToast" class="fixed bottom-4 right-4 bg-white rounded-lg shadow-lg border border-gray-200 p-4 hidden transform transition-all duration-300 translate-y-full">
    <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h4 class="font-medium text-gray-800">Preferences Saved</h4>
            <p class="text-sm text-gray-600">Your content preferences have been updated successfully.</p>
        </div>
    </div>
</div>

<script>
function saveContentPreferences() {
    const preferences = {
        defaultPostStatus: document.querySelector('input[name="defaultPostStatus"]:checked').value,
        defaultCategory: document.querySelector('select').value,
        itemsPerPage: document.querySelector('input[name="itemsPerPage"]:checked').value,
        autoSave: document.querySelectorAll('input[type="checkbox"]')[0].checked,
        showAdvanced: document.querySelectorAll('input[type="checkbox"]')[1].checked,
        compactView: document.querySelectorAll('input[type="checkbox"]')[2].checked
    };
    
    console.log('Saving content preferences:', preferences);
    
    // Show success notification
    showSuccessToast('Content preferences saved successfully!', 'success');
}

function resetToDefaults() {
    if (confirm('Are you sure you want to reset all content preferences to their default values?')) {
        // Reset radio buttons
        document.querySelector('input[name="defaultPostStatus"][value="draft"]').checked = true;
        document.querySelector('input[name="itemsPerPage"][value="10"]').checked = true;
        
        // Reset select
        document.querySelector('select').value = '';
        
        // Reset checkboxes
        document.querySelectorAll('input[type="checkbox"]')[0].checked = true;  // Auto-save
        document.querySelectorAll('input[type="checkbox"]')[1].checked = false; // Show Advanced
        document.querySelectorAll('input[type="checkbox"]')[2].checked = false; // Compact View
        
        console.log('Content preferences reset to defaults');
        showSuccessToast('Preferences reset to default values', 'info');
    }
}

function showSuccessToast(message, type = 'success') {
    const toast = document.getElementById('successToast');
    const messageElement = toast.querySelector('p');
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
    // Add change event listeners to all inputs
    document.querySelectorAll('input[type="radio"], input[type="checkbox"], select').forEach(input => {
        input.addEventListener('change', function() {
            console.log('Preference changed:', this.name || this.id, this.value || this.checked);
        });
    });
    
    // Add hover effects to radio button groups
    document.querySelectorAll('label').forEach(label => {
        label.addEventListener('mouseenter', function() {
            this.classList.add('bg-gray-100', 'rounded-lg', '-mx-2', 'px-2', 'py-1', 'transition-colors');
        });
        
        label.addEventListener('mouseleave', function() {
            this.classList.remove('bg-gray-100', 'rounded-lg', '-mx-2', 'px-2', 'py-1', 'transition-colors');
        });
    });
});
</script>
@endsection
