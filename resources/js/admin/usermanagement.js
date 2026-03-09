//resources/js/admin/usermanagement.js

// User Management Module
const UserManagement = (function() {
    let currentPage = 1;
    let lastPage = 1;
    let totalUsers = 0;
    let filters = {
        search: '',
        position: 'all',
        status: 'all'
    };

    // Initialize
    function init() {
        loadUsers();
        loadArchiveStats();
        attachEventListeners();
    }

    // Attach event listeners
    function attachEventListeners() {
        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
            }
            if (!event.target.closest('.actions-btn') && !event.target.closest('.actions-menu')) {
                closeAllDropdowns();
            }
        };

        // Add event listeners for filters
        document.getElementById('searchInput').addEventListener('keyup', debounce(filterTable, 500));
        document.getElementById('positionFilter').addEventListener('change', filterTable);
        document.getElementById('statusFilter').addEventListener('change', filterTable);

        // Add status card click handlers
        document.querySelectorAll('.status-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.status-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // Set max birthdate to 18 years ago
        const birthdateInput = document.getElementById('birthdate');
        if (birthdateInput) {
            const maxDate = new Date();
            maxDate.setFullYear(maxDate.getFullYear() - 18);
            birthdateInput.max = maxDate.toISOString().split('T')[0];
        }

        // Add real-time validation
        document.getElementById('email')?.addEventListener('input', validateEmailField);
        document.getElementById('contact')?.addEventListener('input', validatePhoneField);
        
        // Add real-time validation for other fields
        document.getElementById('first_name')?.addEventListener('input', function() {
            clearFieldError('first_name');
        });
        document.getElementById('last_name')?.addEventListener('input', function() {
            clearFieldError('last_name');
        });
        document.getElementById('gender')?.addEventListener('change', function() {
            clearFieldError('gender');
        });
        document.getElementById('birthdate')?.addEventListener('change', function() {
            clearFieldError('birthdate');
        });
        document.getElementById('position')?.addEventListener('change', function() {
            clearFieldError('position');
        });

        // Open add user modal
        document.getElementById('openAddUserModal')?.addEventListener('click', openAddUserModal);
    }

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Clear field error
    function clearFieldError(field) {
        const errorEl = document.getElementById(`error-${field}`);
        const inputEl = document.querySelector(`[name="${field}"]`);
        
        if (errorEl) {
            errorEl.classList.add('hidden');
            errorEl.textContent = '';
        }
        
        if (inputEl) {
            inputEl.closest('.form-group')?.classList.remove('error');
        }
    }

    // Validate email
    function validateEmailField() {
        const email = document.getElementById('email').value;
        const errorEl = document.getElementById('error-email');
        const inputEl = document.getElementById('email');
        const formGroup = inputEl.closest('.form-group');
        
        if (!email) {
            errorEl.textContent = 'Email is required';
            errorEl.classList.remove('hidden');
            formGroup.classList.add('error');
            return false;
        } else if (!email.includes('@') || !email.includes('.')) {
            errorEl.textContent = 'Please enter a valid email address';
            errorEl.classList.remove('hidden');
            formGroup.classList.add('error');
            return false;
        } else {
            errorEl.classList.add('hidden');
            formGroup.classList.remove('error');
            return true;
        }
    }

    // Validate phone
    function validatePhoneField() {
        const phone = document.getElementById('contact').value;
        const errorEl = document.getElementById('error-contact_no');
        const inputEl = document.getElementById('contact');
        const formGroup = inputEl.closest('.form-group');
        
        const numericPhone = phone.replace(/[^0-9]/g, '');
        
        if (!phone) {
            errorEl.textContent = 'Contact number is required';
            errorEl.classList.remove('hidden');
            formGroup.classList.add('error');
            return false;
        } else if (numericPhone.length !== 11) {
            errorEl.textContent = 'Contact number must be exactly 11 digits';
            errorEl.classList.remove('hidden');
            formGroup.classList.add('error');
            return false;
        } else {
            errorEl.classList.add('hidden');
            formGroup.classList.remove('error');
            return true;
        }
    }

    // Toast notification
    function showToast(message, type = 'success', duration = 3000) {
        const toastContainer = document.getElementById('toastContainer');
        const toastId = 'toast-' + Date.now();
        
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle';
        
        const toastHTML = `
            <div id="${toastId}" class="toast-item flex items-center gap-3 ${bgColor} text-white px-4 py-3 rounded-lg shadow-lg mb-2 min-w-[300px]">
                <i class="bi ${icon} text-lg"></i>
                <span class="flex-1 text-sm">${message}</span>
                <button onclick="UserManagement.closeToast('${toastId}')" class="text-white hover:text-gray-200">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `;
        
        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        
        setTimeout(() => {
            closeToast(toastId);
        }, duration);
    }

    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.add('hide');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }

    // Show validation errors
    function showValidationErrors(errors) {
        document.querySelectorAll('.error-message').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        document.querySelectorAll('.form-group').forEach(el => {
            el.classList.remove('error');
        });

        for (let field in errors) {
            const errorEl = document.getElementById(`error-${field}`);
            const inputEl = document.querySelector(`[name="${field}"]`);
            
            if (errorEl) {
                errorEl.textContent = errors[field][0];
                errorEl.classList.remove('hidden');
                
                if (inputEl) {
                    inputEl.closest('.form-group')?.classList.add('error');
                }
            }
        }
    }

    // Load users
    function loadUsers(page = 1) {
        const params = new URLSearchParams({
            page: page,
            search: filters.search,
            position: filters.position,
            status: filters.status,
            per_page: 10
        });

        fetch(`/admin/users?${params}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderTable(data.users.data);
                currentPage = data.users.current_page;
                lastPage = data.users.last_page;
                totalUsers = data.users.total;
                
                document.getElementById('archivedCount').textContent = data.archived_count || 0;
                
                updatePagination();
                document.getElementById('resultCount').innerHTML = 
                    `<i class="bi bi-people me-1"></i> Showing ${data.users.data.length} of ${totalUsers} users`;
            }
        })
        .catch(error => {
            console.error('Error loading users:', error);
            showToast('Error loading users', 'error');
        });
    }

    // Load archive stats
    function loadArchiveStats() {
        fetch('/admin/archived-users', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('archivedTotal').textContent = data.stats.total;
                document.getElementById('pendingDeletion').textContent = data.stats.expired;
            }
        })
        .catch(error => console.error('Error loading archive stats:', error));
    }

    // Render table
    function renderTable(users) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        users.forEach(user => {
            let statusClass = user.is_active ? 'active' : 'inactive';
            let statusText = user.is_active ? 'Active' : 'Deactivated';
            let statusColor = user.is_active ? 'green' : 'gray';
            
            const profileImage = user.profile_img ? 
                `<img src="/storage/${user.profile_img}" class="w-7 h-7 rounded-full object-cover" alt="Profile">` : 
                `<div class="w-7 h-7 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-semibold text-xs">${user.initials || 'U'}</div>`;
            
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50 transition-colors';
            row.innerHTML = `
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        ${profileImage}
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <span class="text-sm">${user.full_name || user.first_name + ' ' + user.last_name}</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="flex items-center gap-1">
                        <i class="bi bi-briefcase text-gray-400 text-xs"></i>
                        ${user.position || 'N/A'}
                    </span>
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="flex items-center gap-1">
                        <i class="bi bi-person-circle text-gray-400 text-xs"></i>
                        ${user.username || 'N/A'}
                    </span>
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="flex items-center gap-1">
                        <i class="bi bi-envelope text-gray-400 text-xs"></i>
                        ${user.email}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <span class="status-badge status-${statusClass}">
                        <i class="bi bi-circle-fill text-${statusColor}-400 text-xs me-1"></i>
                        ${statusText}
                    </span>
                </td>
                <td class="px-4 py-3 relative" style="overflow: visible;">
                    <button class="actions-btn w-8 h-8 bg-gray-100 rounded-lg text-gray-600 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center" onclick="UserManagement.toggleActionsMenu(this, ${user.user_id})">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <div class="actions-menu hidden absolute right-0 bg-white rounded-lg shadow-lg z-50 min-w-[180px] mt-1 border border-gray-200 overflow-hidden" id="menu-${user.user_id}">
                        <button class="w-full text-left px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 flex items-center gap-2" onclick="UserManagement.viewUser(${user.user_id})">
                            <i class="bi bi-eye text-blue-500 w-4"></i> View Details
                        </button>
                        <button class="w-full text-left px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 flex items-center gap-2" onclick="UserManagement.editUserStatus('${user.full_name || user.first_name + ' ' + user.last_name}', ${user.user_id}, '${user.is_active ? 'active' : 'inactive'}')">
                            <i class="bi bi-pencil-square text-green-500 w-4"></i> Edit Status
                        </button>
                        <button class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2 border-t border-gray-200" onclick="UserManagement.openDeleteModal('${user.full_name || user.first_name + ' ' + user.last_name}', ${user.user_id})">
                            <i class="bi bi-trash text-red-500 w-4"></i> Delete Account
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Filter table
    function filterTable() {
        filters.search = document.getElementById('searchInput').value;
        filters.position = document.getElementById('positionFilter').value;
        filters.status = document.getElementById('statusFilter').value;
        currentPage = 1;
        loadUsers(currentPage);
    }

    // Change page
    function changePage(direction) {
        if (direction === 'next' && currentPage < lastPage) {
            currentPage++;
            loadUsers(currentPage);
        } else if (direction === 'prev' && currentPage > 1) {
            currentPage--;
            loadUsers(currentPage);
        }
    }

    // Update pagination
    function updatePagination() {
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = lastPage;
        document.getElementById('prevPageBtn').disabled = currentPage === 1;
        document.getElementById('nextPageBtn').disabled = currentPage === lastPage;
    }

    // Toggle Actions Menu
    function toggleActionsMenu(btn, userId) {
        closeAllDropdowns();
        const menu = document.getElementById(`menu-${userId}`);
        if (menu) {
            menu.classList.toggle('show');
            
            if (menu.classList.contains('show')) {
                const closeMenu = (e) => {
                    if (!btn.contains(e.target) && !menu.contains(e.target)) {
                        menu.classList.remove('show');
                        document.removeEventListener('click', closeMenu);
                    }
                };
                setTimeout(() => document.addEventListener('click', closeMenu), 0);
            }
        }
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.actions-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    }

    // Add User Modal
    const addUserModal = document.getElementById('addUserModal');

    function openAddUserModal() {
        closeAllDropdowns();
        addUserModal.classList.add('show');
        document.getElementById('addUserForm').reset();
        document.getElementById('profilePreview').innerHTML = '<i class="bi bi-camera"></i>';
        
        document.querySelectorAll('.error-message').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        document.querySelectorAll('.form-group').forEach(el => {
            el.classList.remove('error');
        });
    }

    function closeAddUserModal() {
        addUserModal.classList.remove('show');
    }

    // Profile Image Preview
    function previewProfileImage(event) {
        const file = event.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                showToast('Image size should be less than 2MB', 'error');
                event.target.value = '';
                return;
            }
            
            if (!file.type.startsWith('image/')) {
                showToast('Please upload an image file', 'error');
                event.target.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profilePreview');
                preview.innerHTML = `<img src="${e.target.result}" class="w-24 h-24 rounded-full object-cover border-2 border-white shadow-md" alt="Profile">`;
            };
            reader.readAsDataURL(file);
        }
    }

    // Generate Username
    function generateUsername() {
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;

        if (!firstName || !lastName) {
            showToast('Please enter first name and last name first', 'error');
            return;
        }

        const generateBtn = event.target.closest('button');
        const originalText = generateBtn.innerHTML;
        generateBtn.innerHTML = '<i class="bi bi-hourglass me-2"></i>Generating...';
        generateBtn.disabled = true;

        fetch('/admin/generate-username', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                first_name: firstName, 
                last_name: lastName 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('username').value = data.username;
                clearFieldError('username');
                showToast('Username generated successfully');
            } else {
                showToast(data.message || 'Error generating username', 'error');
            }
        })
        .catch(error => {
            console.error('Error generating username:', error);
            showToast('Error generating username', 'error');
        })
        .finally(() => {
            generateBtn.innerHTML = originalText;
            generateBtn.disabled = false;
        });
    }

    // Generate Password
    function generatePassword() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
        let password = '';
        for (let i = 0; i < 12; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('password').value = password;
        clearFieldError('password');
        showToast('Password generated successfully');
    }

    // Save User
    function saveUser() {
        const form = document.getElementById('addUserForm');
        const formData = new FormData(form);
        
        let hasError = false;
        
        const firstName = document.getElementById('first_name').value;
        if (!firstName) {
            document.getElementById('error-first_name').textContent = 'First name is required';
            document.getElementById('error-first_name').classList.remove('hidden');
            document.getElementById('first_name').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const lastName = document.getElementById('last_name').value;
        if (!lastName) {
            document.getElementById('error-last_name').textContent = 'Last name is required';
            document.getElementById('error-last_name').classList.remove('hidden');
            document.getElementById('last_name').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const gender = document.getElementById('gender').value;
        if (!gender) {
            document.getElementById('error-gender').textContent = 'Gender is required';
            document.getElementById('error-gender').classList.remove('hidden');
            document.getElementById('gender').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const birthdate = document.getElementById('birthdate').value;
        if (!birthdate) {
            document.getElementById('error-birthdate').textContent = 'Birthdate is required';
            document.getElementById('error-birthdate').classList.remove('hidden');
            document.getElementById('birthdate').closest('.form-group').classList.add('error');
            hasError = true;
        } else {
            const birthDate = new Date(birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            if (age < 18) {
                document.getElementById('error-birthdate').textContent = 'User must be at least 18 years old';
                document.getElementById('error-birthdate').classList.remove('hidden');
                document.getElementById('birthdate').closest('.form-group').classList.add('error');
                hasError = true;
            }
        }
        
        const position = document.getElementById('position').value;
        if (!position) {
            document.getElementById('error-position').textContent = 'Position is required';
            document.getElementById('error-position').classList.remove('hidden');
            document.getElementById('position').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const username = document.getElementById('username').value;
        if (!username) {
            document.getElementById('error-username').textContent = 'Username is required';
            document.getElementById('error-username').classList.remove('hidden');
            document.getElementById('username').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const password = document.getElementById('password').value;
        if (!password) {
            document.getElementById('error-password').textContent = 'Password is required';
            document.getElementById('error-password').classList.remove('hidden');
            document.getElementById('password').closest('.form-group').classList.add('error');
            hasError = true;
        } else if (password.length < 8) {
            document.getElementById('error-password').textContent = 'Password must be at least 8 characters';
            document.getElementById('error-password').classList.remove('hidden');
            document.getElementById('password').closest('.form-group').classList.add('error');
            hasError = true;
        }
        
        const emailValid = validateEmailField();
        if (!emailValid) hasError = true;
        
        const phoneValid = validatePhoneField();
        if (!phoneValid) hasError = true;
        
        if (hasError) {
            showToast('Please fix the errors in the form', 'error');
            return;
        }

        const saveBtn = document.getElementById('saveUserBtn');
        const btnText = saveBtn.querySelector('.btn-text');
        const spinner = saveBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Saving...';
        spinner.classList.remove('hidden');
        saveBtn.disabled = true;

        fetch('/admin/users', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('User added successfully');
                closeAddUserModal();
                loadUsers(currentPage);
                loadArchiveStats();
                
                document.getElementById('addUserForm').reset();
                document.getElementById('profilePreview').innerHTML = '<i class="bi bi-camera"></i>';
            } else {
                if (data.errors) {
                    showValidationErrors(data.errors);
                    showToast('Please check the form for errors', 'error');
                } else {
                    showToast(data.message || 'Error creating user', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error saving user:', error);
            showToast('Error saving user', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            saveBtn.disabled = false;
        });
    }

    // Delete Modal
    const deleteModal = document.getElementById('deleteModal');

    function openDeleteModal(name, userId) {
        closeAllDropdowns();
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('deleteUserId').value = userId;
        deleteModal.classList.add('show');
    }

    function closeDeleteModal() {
        deleteModal.classList.remove('show');
    }

    function moveToArchive() {
        const userId = document.getElementById('deleteUserId').value;
        
        const moveBtn = document.getElementById('moveToArchiveBtn');
        const btnText = moveBtn.querySelector('.btn-text');
        const spinner = moveBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Moving...';
        spinner.classList.remove('hidden');
        moveBtn.disabled = true;
        
        fetch(`/admin/users/${userId}/archive`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('User moved to recycle bin');
                closeDeleteModal();
                loadUsers(currentPage);
                loadArchiveStats();
            } else {
                showToast(data.message || 'Error archiving user', 'error');
            }
        })
        .catch(error => {
            console.error('Error archiving user:', error);
            showToast('Error archiving user', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            moveBtn.disabled = false;
        });
    }

    // Archive Modal
    const archiveModal = document.getElementById('archiveModal');

    function openArchiveModal() {
        closeAllDropdowns();
        loadArchivedUsers();
        archiveModal.classList.add('show');
    }

    function closeArchiveModal() {
        archiveModal.classList.remove('show');
    }

    // Load archived users
    function loadArchivedUsers() {
        fetch('/admin/archived-users', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderArchiveTable(data.archived_users);
                document.getElementById('archivedTotal').textContent = data.stats.total;
                document.getElementById('pendingDeletion').textContent = data.stats.expired;
            }
        })
        .catch(error => console.error('Error loading archived users:', error));
    }

    // Render archive table
    function renderArchiveTable(archivedUsers) {
        const archiveBody = document.getElementById('archiveBody');
        archiveBody.innerHTML = '';

        archivedUsers.forEach(user => {
            const archivedDate = new Date(user.archived_at).toLocaleDateString();
            const expiresAt = new Date(user.expires_at);
            const daysLeft = Math.ceil((expiresAt - new Date()) / (1000 * 60 * 60 * 24));
            const expiresText = daysLeft > 0 ? `${daysLeft} days left` : 'Expired';

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-2.5 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-person-slash text-gray-400"></i>
                        ${user.first_name} ${user.middle_name || ''} ${user.last_name} ${user.suffix || ''}
                    </div>
                </td>
                <td class="px-4 py-2.5 text-sm">${user.position || 'N/A'}</td>
                <td class="px-4 py-2.5 text-sm">${archivedDate}</td>
                <td class="px-4 py-2.5 text-sm">
                    <span class="${daysLeft <= 7 ? 'text-red-600' : 'text-gray-600'}">${expiresText}</span>
                </td>
                <td class="px-4 py-2.5">
                    <button class="text-blue-600 hover:text-blue-800 mr-3 transition-colors" onclick="UserManagement.restoreFromArchive(${user.archive_id}, '${user.first_name} ${user.last_name}')" title="Restore">
                        <i class="bi bi-arrow-return-left"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800 transition-colors" onclick="UserManagement.permanentDeletePrompt(${user.archive_id}, '${user.first_name} ${user.last_name}')" title="Delete Permanently">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            archiveBody.appendChild(row);
        });
    }

    // Restore Modal
    const restoreModal = document.getElementById('restoreModal');

    function restoreFromArchive(archiveId, name) {
        closeAllDropdowns();
        document.getElementById('restoreUserName').textContent = name;
        document.getElementById('restoreArchiveId').value = archiveId;
        restoreModal.classList.add('show');
    }

    function closeRestoreModal() {
        restoreModal.classList.remove('show');
    }

    function restoreUser() {
        const archiveId = document.getElementById('restoreArchiveId').value;
        
        const restoreBtn = document.getElementById('restoreUserBtn');
        const btnText = restoreBtn.querySelector('.btn-text');
        const spinner = restoreBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Restoring...';
        spinner.classList.remove('hidden');
        restoreBtn.disabled = true;
        
        fetch(`/admin/archived-users/${archiveId}/restore`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('User restored successfully');
                closeRestoreModal();
                loadArchivedUsers();
                loadUsers(currentPage);
                loadArchiveStats();
            } else {
                showToast(data.message || 'Error restoring user', 'error');
            }
        })
        .catch(error => {
            console.error('Error restoring user:', error);
            showToast('Error restoring user', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            restoreBtn.disabled = false;
        });
    }

    // Permanent Delete
    const permanentDeleteModal = document.getElementById('permanentDeleteModal');

    function permanentDeletePrompt(archiveId, name) {
        closeAllDropdowns();
        document.getElementById('permanentDeleteUserName').textContent = name;
        document.getElementById('permanentDeleteArchiveId').value = archiveId;
        permanentDeleteModal.classList.add('show');
    }

    function closePermanentDeleteModal() {
        permanentDeleteModal.classList.remove('show');
    }

    function permanentDelete() {
        const archiveId = document.getElementById('permanentDeleteArchiveId').value;
        
        const deleteBtn = document.getElementById('permanentDeleteBtn');
        const btnText = deleteBtn.querySelector('.btn-text');
        const spinner = deleteBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Deleting...';
        spinner.classList.remove('hidden');
        deleteBtn.disabled = true;
        
        fetch(`/admin/archived-users/${archiveId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('User permanently deleted');
                closePermanentDeleteModal();
                loadArchivedUsers();
                loadArchiveStats();
            } else {
                showToast(data.message || 'Error deleting user', 'error');
            }
        })
        .catch(error => {
            console.error('Error deleting user:', error);
            showToast('Error deleting user', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            deleteBtn.disabled = false;
        });
    }

    // Empty Recycle Bin
    function emptyRecycleBin() {
        if (confirm('Are you sure you want to permanently delete all expired items in recycle bin?')) {
            fetch('/admin/recycle-bin/empty', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Recycle bin emptied');
                    loadArchivedUsers();
                    loadArchiveStats();
                } else {
                    showToast(data.message || 'Error emptying recycle bin', 'error');
                }
            })
            .catch(error => {
                console.error('Error emptying recycle bin:', error);
                showToast('Error emptying recycle bin', 'error');
            });
        }
    }

    // View User
    function viewUser(userId) {
        closeAllDropdowns();
        
        fetch(`/admin/users/${userId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const user = data.user;
                const stats = data.stats;
                
                const profileImg = document.getElementById('viewProfileImg');
                const initials = document.getElementById('avatarInitials');
                
                if (user.profile_img) {
                    profileImg.src = `/storage/${user.profile_img}`;
                    profileImg.classList.remove('hidden');
                    initials.classList.add('hidden');
                } else {
                    profileImg.classList.add('hidden');
                    initials.classList.remove('hidden');
                    initials.textContent = user.initials || 'U';
                }
                
                document.getElementById('viewFullName').textContent = user.full_name || `${user.first_name} ${user.middle_name || ''} ${user.last_name} ${user.suffix || ''}`;
                document.getElementById('viewPosition').innerHTML = `<i class="bi bi-briefcase me-1"></i>${user.position || 'N/A'}`;

                let statusColor = user.is_active ? 'green' : 'gray';
                let statusText = user.is_active ? 'Active' : 'Deactivated';
                
                document.getElementById('viewStatusBadge').innerHTML = `<i class="bi bi-circle-fill text-${statusColor}-300"></i> ${statusText}`;

                document.getElementById('viewUsername').textContent = user.username || 'N/A';
                document.getElementById('viewEmail').textContent = user.email;
                document.getElementById('viewContact').textContent = user.contact_no || 'N/A';
                document.getElementById('viewGender').textContent = user.gender ? user.gender.charAt(0).toUpperCase() + user.gender.slice(1).replace('_', ' ') : 'N/A';

                if (user.birthdate) {
                    const birthDate = new Date(user.birthdate);
                    document.getElementById('viewBirthdate').textContent = birthDate.toLocaleDateString('en-US', {
                        year: 'numeric', month: 'long', day: 'numeric'
                    });
                    
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    document.getElementById('viewAge').textContent = age;
                } else {
                    document.getElementById('viewBirthdate').textContent = 'N/A';
                    document.getElementById('viewAge').textContent = 'N/A';
                }

                document.getElementById('viewDateJoined').textContent = stats.date_joined || 'N/A';
                document.getElementById('viewLastLogin').textContent = stats.last_login || 'N/A';

                document.getElementById('viewUserModal').classList.add('show');
            }
        })
        .catch(error => {
            console.error('Error loading user details:', error);
            showToast('Error loading user details', 'error');
        });
    }

    function closeViewModal() {
        document.getElementById('viewUserModal').classList.remove('show');
    }

    // Edit Status
    const editStatusModal = document.getElementById('editStatusModal');

    function editUserStatus(userName, userId, currentStatus) {
        closeAllDropdowns();
        document.getElementById('statusUserName').textContent = userName;
        document.getElementById('statusUserId').value = userId;
        document.getElementById('currentStatus').value = currentStatus;
        
        document.querySelectorAll('.status-card').forEach(card => {
            card.classList.remove('selected');
            card.querySelector('input[type="radio"]').checked = false;
        });
        
        const currentCard = document.querySelector(`.status-card[data-status="${currentStatus}"]`);
        if (currentCard) {
            currentCard.classList.add('selected');
            currentCard.querySelector('input[type="radio"]').checked = true;
        }
        
        editStatusModal.classList.add('show');
    }

    function closeEditStatusModal() {
        editStatusModal.classList.remove('show');
    }

    function updateStatus() {
        const selectedRadio = document.querySelector('input[name="userStatus"]:checked');
        const userId = document.getElementById('statusUserId').value;
        
        if (!selectedRadio) {
            showToast('Please select a status', 'error');
            return;
        }
        
        const selectedStatus = selectedRadio.value;
        
        const updateBtn = document.getElementById('updateStatusBtn');
        const btnText = updateBtn.querySelector('.btn-text');
        const spinner = updateBtn.querySelector('.loading-spinner');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Updating...';
        spinner.classList.remove('hidden');
        updateBtn.disabled = true;
        
        fetch(`/admin/users/${userId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: selectedStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(`Status updated to ${selectedStatus}`);
                closeEditStatusModal();
                loadUsers(currentPage);
            } else {
                showToast(data.message || 'Error updating status', 'error');
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            showToast('Error updating status', 'error');
        })
        .finally(() => {
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            updateBtn.disabled = false;
        });
    }

    // Public API
    return {
        init,
        filterTable,
        changePage,
        toggleActionsMenu,
        openAddUserModal,
        closeAddUserModal,
        previewProfileImage,
        generateUsername,
        generatePassword,
        saveUser,
        openDeleteModal,
        closeDeleteModal,
        moveToArchive,
        openArchiveModal,
        closeArchiveModal,
        restoreFromArchive,
        closeRestoreModal,
        restoreUser,
        permanentDeletePrompt,
        closePermanentDeleteModal,
        permanentDelete,
        emptyRecycleBin,
        viewUser,
        closeViewModal,
        editUserStatus,
        closeEditStatusModal,
        updateStatus,
        closeToast
    };
})();

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    UserManagement.init();
});

// Make functions available globally for onclick handlers
window.UserManagement = UserManagement;