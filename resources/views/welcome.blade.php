<?php
// resources/views/admin/login.blade.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PUDHO - Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .red-accent {
            color: #B22234;
        }

        .red-accent-bg {
            background-color: #B22234;
        }

        .red-accent-border {
            border-color: #B22234;
        }

        .red-accent-light {
            background-color: rgba(178, 34, 52, 0.05);
        }

        .red-gradient {
            background: linear-gradient(135deg, #B22234 0%, #8B1A1A 100%);
        }

        .input-focus-effect:focus {
            border-color: #B22234;
            box-shadow: 0 0 0 3px rgba(178, 34, 52, 0.1);
        }

        .hover-red:hover {
            color: #B22234;
        }

        .btn-red {
            background: linear-gradient(135deg, #B22234 0%, #8B1A1A 100%);
        }

        .btn-red:hover {
            background: linear-gradient(135deg, #8B1A1A 0%, #6B1010 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(178, 34, 52, 0.3);
        }

        .btn-red:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .toast-item {
            animation: slideInRight 0.3s ease forwards;
        }

        .toast-item.hide {
            animation: slideOutRight 0.3s ease forwards;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <!-- Toast Container for Notifications -->
    <div class="fixed top-5 right-5 z-[1100] space-y-2" id="toastContainer"></div>

    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-1 red-gradient"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-50 rounded-full opacity-30"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-red-50 rounded-full opacity-30"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-red-50 rounded-full opacity-20 blur-3xl"></div>
    </div>

    <!-- Main Container -->
    <div class="relative w-full max-w-md">
        <!-- Session Status Messages -->
        @if(session('error'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Top Red Bar -->
            <div class="h-2 red-gradient"></div>

            <div class="px-8 py-8">
                <!-- Logo and Title Section -->
                <div class="text-center mb-8">
                    <!-- Logo -->
                    <div class="flex justify-center mb-4">
                        <div class="p-2 rounded-2xl red-accent-light border border-red-200 inline-block">
                            <img src="{{ asset('build/assets/images/logo-pudho.jpg') }}"
                                alt="PUDHO Logo"
                                class="w-24 h-24 rounded-xl border-2 border-white shadow-md"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/96x96?text=PUDHO';">
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-800">Provincial Urban Development</h1>
                    <h2 class="text-xl font-semibold red-accent">And Housing Office - Laguna</h2>

                    <!-- Dynamic Access Level Badge -->
                    <div class="mt-4 space-y-2">
                        <p class="text-gray-500 text-sm flex items-center justify-center">
                            <span class="w-2 h-2 red-accent-bg rounded-full mr-2 animate-pulse"></span>
                            Secure Admin Portal
                        </p>
                        <span class="inline-block px-4 py-1 red-accent-light text-red-700 rounded-full text-sm font-medium border border-red-200">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Role-Based Access Control
                        </span>
                    </div>
                </div>

                <!-- Error Alert (Hidden by Default) -->
                <div id="errorAlert" class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl hidden">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="errorMessage" class="text-sm"></span>
                    </div>
                </div>

                <!-- Login Form -->
                <form id="loginForm" onsubmit="return false;">
                    @csrf
                    <div class="space-y-6">
                        <!-- Username Field -->
                        <div class="space-y-2">
                            <label for="username" class="block text-sm font-semibold text-gray-700">
                                <svg class="w-4 h-4 inline mr-1 red-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Username or Email
                            </label>
                            <input type="text" 
                                   id="username" 
                                   name="username"
                                   class="input-focus-effect w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition duration-200 bg-white/50"
                                   placeholder="Enter your username or email"
                                   autocomplete="username"
                                   required>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">
                                <svg class="w-4 h-4 inline mr-1 red-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Password
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       id="password" 
                                       name="password"
                                       class="input-focus-effect w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition duration-200 bg-white/50 pr-12"
                                       placeholder="Enter your password"
                                       autocomplete="current-password"
                                       required>
                                <button type="button" 
                                        onclick="togglePassword()" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center focus:outline-none">
                                    <svg id="eyeIcon" class="w-5 h-5 text-gray-400 hover:text-red-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="remember" 
                                       name="remember"
                                       class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                            </div>
                            <button type="button" 
                                    onclick="showForgotPassword()"
                                    class="text-sm text-gray-600 hover-red font-medium transition duration-200">
                                Forgot Password?
                            </button>
                        </div>

                        <!-- Login Button -->
                        <button type="submit"
                                id="loginButton"
                                class="btn-red w-full text-white font-semibold py-3 px-4 rounded-xl transform transition duration-200 shadow-lg disabled:opacity-70 disabled:cursor-not-allowed">
                            <span class="flex items-center justify-center">
                                <span id="buttonText">Login to Dashboard</span>
                                <svg id="buttonSpinner" 
                                     class="hidden animate-spin ml-2 h-5 w-5 text-white" 
                                     xmlns="http://www.w3.org/2000/svg" 
                                     fill="none" 
                                     viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </button>

                        <!-- Role-Based Access Info -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Access Levels</h3>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div class="flex items-center gap-1 text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span>
                                    Administrator
                                </div>
                                <div class="flex items-center gap-1 text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                    Head Officer
                                </div>
                                <div class="flex items-center gap-1 text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-green-600 rounded-full"></span>
                                    Editor
                                </div>
                                <div class="flex items-center gap-1 text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-purple-600 rounded-full"></span>
                                    Housing Officer
                                </div>
                                <div class="flex items-center gap-1 text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-yellow-600 rounded-full"></span>
                                    Evaluator
                                </div>
                                <div class="flex items-center gap-1 text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-gray-600 rounded-full"></span>
                                    Staff
                                </div>
                                <div class="flex items-center gap-1 text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-indigo-600 rounded-full"></span>
                                    Inspector
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <p>&copy; {{ date('Y') }} PUDHO - Laguna</p>
                    <div class="flex space-x-3">
                        <button onclick="showTerms()" class="hover-red transition">Terms</button>
                        <button onclick="showPrivacy()" class="hover-red transition">Privacy</button>
                        <a href="mailto:support@pudho-laguna.gov.ph" class="hover-red transition">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // State management
        let isSubmitting = false;

        // Toast notification system
        function showToast(message, type = 'success', duration = 3000) {
            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast-' + Date.now();
            
            const bgColor = type === 'success' ? 'bg-green-500' : (type === 'error' ? 'bg-red-500' : 'bg-yellow-500');
            const icon = type === 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 
                        (type === 'error' ? 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' : 
                        'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z');
            
            const toastHTML = `
                <div id="${toastId}" class="toast-item flex items-center gap-3 ${bgColor} text-white px-4 py-3 rounded-lg shadow-lg mb-2 min-w-[300px]">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${icon}"></path>
                    </svg>
                    <span class="flex-1 text-sm">${message}</span>
                    <button onclick="closeToast('${toastId}')" class="text-white hover:text-gray-200 focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
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

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        // Show error message
        function showError(message) {
            const errorAlert = document.getElementById('errorAlert');
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = message;
            errorAlert.classList.remove('hidden');
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                errorAlert.classList.add('hidden');
            }, 5000);
        }

        // Handle login
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (isSubmitting) return;

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;

            // Validation
            if (!username || !password) {
                showError('Please enter both username and password');
                return;
            }

            // Show loading state
            isSubmitting = true;
            const loginButton = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');
            
            buttonText.textContent = 'Logging in...';
            buttonSpinner.classList.remove('hidden');
            loginButton.disabled = true;

            try {
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                // Make login request
                const response = await fetch('/admin/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        username: username,
                        password: password,
                        remember: remember
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Show success message
                    showToast('Login successful! Redirecting...', 'success');
                    
                    // Store user info in session storage for quick access
                    if (data.user) {
                        sessionStorage.setItem('user', JSON.stringify(data.user));
                    }
                    
                    // Redirect based on user role
                    setTimeout(() => {
                        window.location.href = data.redirect || '/admin/dashboard';
                    }, 1000);
                } else {
                    // Show error message
                    showError(data.message || 'Login failed');
                    showToast(data.message || 'Login failed', 'error');
                    
                    // Reset button
                    buttonText.textContent = 'Login to Dashboard';
                    buttonSpinner.classList.add('hidden');
                    loginButton.disabled = false;
                    isSubmitting = false;
                }
            } catch (error) {
                console.error('Login error:', error);
                
                let errorMessage = 'Connection error. Please try again.';
                
                if (!navigator.onLine) {
                    errorMessage = 'No internet connection. Please check your network.';
                }
                
                showError(errorMessage);
                showToast(errorMessage, 'error');
                
                // Reset button
                buttonText.textContent = 'Login to Dashboard';
                buttonSpinner.classList.add('hidden');
                loginButton.disabled = false;
                isSubmitting = false;
            }
        });

        // Forgot password handler
        function showForgotPassword() {
            showToast('Please contact your administrator for password reset', 'info');
            
            // You can also show a modal or redirect to password reset page
            // window.location.href = '/admin/forgot-password';
        }

        // Terms and privacy handlers
        function showTerms() {
            showToast('Terms of service will be available soon', 'info');
        }

        function showPrivacy() {
            showToast('Privacy policy will be available soon', 'info');
        }

        // Enter key support (already handled by form submit)
        
        // Check if user is already logged in
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Check session for existing login
            fetch('/admin/check-auth', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.authenticated) {
                    // User is already logged in, redirect to dashboard
                    window.location.href = data.redirect || '/admin/dashboard';
                }
            })
            .catch(() => {
                // Ignore errors, just don't redirect
            });
        });

        // Prevent back button after login
        window.history.pushState(null, null, window.location.href);
        window.addEventListener('popstate', function() {
            window.history.pushState(null, null, window.location.href);
        });
    </script>
</body>
</html>