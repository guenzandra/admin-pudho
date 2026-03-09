@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Notification Settings</h1>
                <p class="text-gray-600 mt-2">Control editor alerts and notification preferences</p>
            </div>
        </div>
    </div>

    <!-- Notification Settings Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Editor Alert Preferences</h2>
            <p class="text-sm text-gray-600">Configure how you receive notifications for content changes and updates</p>
        </div>

        <div class="p-6 space-y-6">
            <!-- Email Notification Toggle -->
            <div class="flex items-center justify-between py-4 px-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Email Notifications</h3>
                        <p class="text-sm text-gray-600 mt-1">Receive notifications via email for important updates</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="emailNotificationToggle" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                </label>
            </div>

            <!-- Content Update Notification -->
            <div class="flex items-center justify-between py-4 px-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Content Update Notifications</h3>
                        <p class="text-sm text-gray-600 mt-1">Get notified when content is modified or updated</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="contentUpdateToggle" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                </label>
            </div>

            <!-- New Content Notification -->
            <div class="flex items-center justify-between py-4 px-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">New Content Notifications</h3>
                        <p class="text-sm text-gray-600 mt-1">Receive alerts when new content is added to the system</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="newContentToggle" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                </label>
            </div>

            <!-- Additional Notification Settings -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Additional Settings</h3>
                
                <div class="space-y-4">
                    <!-- Notification Frequency -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Notification Frequency</h4>
                            <p class="text-sm text-gray-600">How often you receive notification summaries</p>
                        </div>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option>Immediate</option>
                            <option>Hourly</option>
                            <option>Daily</option>
                            <option>Weekly</option>
                        </select>
                    </div>

                    <!-- Quiet Hours -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Quiet Hours</h4>
                            <p class="text-sm text-gray-600">Disable notifications during specific hours</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="time" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" value="22:00">
                            <span class="text-gray-500">to</span>
                            <input type="time" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" value="08:00">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
            <div class="flex justify-end space-x-3">
                <button onclick="resetToDefaults()" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    Reset to Defaults
                </button>
                <button onclick="saveNotificationPreferences()" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    Save Preferences
                </button>
            </div>
        </div>
    </div>

    <!-- Notification Preview Section -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-medium text-blue-900">Notification Preview</h4>
                <p class="text-sm text-blue-800 mt-1">Test your notification settings by sending a test notification to see how it will appear.</p>
                <button onclick="sendTestNotification()" class="mt-2 px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors">
                    Send Test Notification
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Notification Toast -->
<div id="notificationToast" class="fixed bottom-4 right-4 bg-white rounded-lg shadow-lg border border-gray-200 p-4 hidden transform transition-all duration-300 translate-y-full">
    <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h4 class="font-medium text-gray-800">Settings Saved</h4>
            <p class="text-sm text-gray-600">Your notification preferences have been updated successfully.</p>
        </div>
    </div>
</div>

<script>
function saveNotificationPreferences() {
    const preferences = {
        emailNotifications: document.getElementById('emailNotificationToggle').checked,
        contentUpdateNotifications: document.getElementById('contentUpdateToggle').checked,
        newContentNotifications: document.getElementById('newContentToggle').checked,
        frequency: document.querySelector('select').value,
        quietHoursStart: document.querySelectorAll('input[type="time"]')[0].value,
        quietHoursEnd: document.querySelectorAll('input[type="time"]')[1].value
    };
    
    console.log('Saving notification preferences:', preferences);
    
    // Show success notification
    showNotification('Notification preferences saved successfully!', 'success');
}

function resetToDefaults() {
    if (confirm('Are you sure you want to reset all notification settings to their default values?')) {
        document.getElementById('emailNotificationToggle').checked = true;
        document.getElementById('contentUpdateToggle').checked = true;
        document.getElementById('newContentToggle').checked = false;
        document.querySelector('select').value = 'Immediate';
        document.querySelectorAll('input[type="time"]')[0].value = '22:00';
        document.querySelectorAll('input[type="time"]')[1].value = '08:00';
        
        showNotification('Settings reset to defaults', 'info');
    }
}

function sendTestNotification() {
    // Simulate sending a test notification
    console.log('Sending test notification...');
    
    // Create a test notification
    const testNotification = {
        title: 'Test Notification',
        message: 'This is a test notification to verify your settings.',
        type: 'test',
        timestamp: new Date().toISOString()
    };
    
    console.log('Test notification sent:', testNotification);
    showNotification('Test notification sent successfully!', 'success');
}

function showNotification(message, type = 'success') {
    const toast = document.getElementById('notificationToast');
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

// Initialize tooltips and interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add change event listeners to toggles
    document.getElementById('emailNotificationToggle').addEventListener('change', function() {
        console.log('Email notifications:', this.checked ? 'enabled' : 'disabled');
    });
    
    document.getElementById('contentUpdateToggle').addEventListener('change', function() {
        console.log('Content update notifications:', this.checked ? 'enabled' : 'disabled');
    });
    
    document.getElementById('newContentToggle').addEventListener('change', function() {
        console.log('New content notifications:', this.checked ? 'enabled' : 'disabled');
    });
});
</script>
@endsection
