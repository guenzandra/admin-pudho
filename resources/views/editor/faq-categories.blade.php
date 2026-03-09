@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">FAQ Categories</h1>
            <p class="text-gray-600 mt-2">Manage FAQ categories and their organization</p>
        </div>
        <button onclick="openCategoryModal()" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Category
        </button>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-amber-500">
            <h2 class="text-xl font-semibold text-white">Category List</h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Category Name</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Number of FAQs</th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-gray-100 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-900">General</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">5 FAQs</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editCategory(1)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Category">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteCategory(1)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Category">
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
                                    <div class="w-3 h-3 bg-green-100 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-900">Services</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">12 FAQs</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editCategory(2)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Category">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteCategory(2)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Category">
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
                                    <div class="w-3 h-3 bg-blue-100 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-900">Requirements</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">8 FAQs</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editCategory(3)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Category">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteCategory(3)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Category">
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
                                    <div class="w-3 h-3 bg-purple-100 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-900">Contact</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-purple-100 text-purple-800">6 FAQs</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editCategory(4)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Category">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteCategory(4)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Category">
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
                                    <div class="w-3 h-3 bg-amber-100 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-900">Technical</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800">3 FAQs</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="editCategory(5)" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Category">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteCategory(5)" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete Category">
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
        </div>
    </div>
</div>

<!-- Category Modal -->
<div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="categoryModalTitle">Add Category</h3>
            <button onclick="document.getElementById('categoryModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="categoryForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category Name *</label>
                <input type="text" id="categoryName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter category name" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                <div class="flex space-x-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="categoryColor" value="gray" class="sr-only" checked>
                        <div class="w-8 h-8 bg-gray-100 rounded-full border-2 border-gray-300 hover:border-gray-500 transition-colors"></div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="categoryColor" value="green" class="sr-only">
                        <div class="w-8 h-8 bg-green-100 rounded-full border-2 border-gray-300 hover:border-green-500 transition-colors"></div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="categoryColor" value="blue" class="sr-only">
                        <div class="w-8 h-8 bg-blue-100 rounded-full border-2 border-gray-300 hover:border-blue-500 transition-colors"></div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="categoryColor" value="purple" class="sr-only">
                        <div class="w-8 h-8 bg-purple-100 rounded-full border-2 border-gray-300 hover:border-purple-500 transition-colors"></div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="categoryColor" value="amber" class="sr-only">
                        <div class="w-8 h-8 bg-amber-100 rounded-full border-2 border-gray-300 hover:border-amber-500 transition-colors"></div>
                    </label>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('categoryModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    Save Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Category Functions
function openCategoryModal() {
    document.getElementById('categoryModalTitle').textContent = 'Add Category';
    document.getElementById('categoryForm').reset();
    document.getElementById('categoryModal').classList.remove('hidden');
}

function editCategory(id) {
    console.log('Editing category:', id);
    document.getElementById('categoryModalTitle').textContent = 'Edit Category';
    
    const categoryData = {
        1: { name: 'General', color: 'gray' },
        2: { name: 'Services', color: 'green' },
        3: { name: 'Requirements', color: 'blue' },
        4: { name: 'Contact', color: 'purple' },
        5: { name: 'Technical', color: 'amber' }
    };
    
    const data = categoryData[id];
    if (data) {
        document.getElementById('categoryName').value = data.name;
        document.querySelector(`input[name="categoryColor"][value="${data.color}"]`).checked = true;
    }
    
    document.getElementById('categoryModal').classList.remove('hidden');
}

function deleteCategory(id) {
    if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
        console.log('Deleting category:', id);
        showNotification('Category deleted successfully!', 'success');
    }
}

// Form Submission
document.getElementById('categoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Saving category...');
    document.getElementById('categoryModal').classList.add('hidden');
    showNotification('Category saved successfully!', 'success');
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
