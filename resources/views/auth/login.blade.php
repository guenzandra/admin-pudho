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
        .red-accent { color: #B22234; }
        .red-accent-bg { background-color: #B22234; }
        .red-accent-border { border-color: #B22234; }
        .red-accent-light { background-color: rgba(178, 34, 52, 0.05); }
        .red-gradient { background: linear-gradient(135deg, #B22234 0%, #8B1A1A 100%); }
        .input-focus-effect:focus {
            border-color: #B22234;
            box-shadow: 0 0 0 3px rgba(178, 34, 52, 0.1);
            outline: none;
        }
        .hover-red:hover { color: #B22234; }
        .btn-red {
            background: linear-gradient(135deg, #B22234 0%, #8B1A1A 100%);
            transition: all 0.2s ease;
        }
        .btn-red:hover {
            background: linear-gradient(135deg, #8B1A1A 0%, #6B1010 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(178, 34, 52, 0.3);
        }
        .btn-red:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-1 red-gradient"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-50 rounded-full opacity-30"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-red-50 rounded-full opacity-30"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-red-50 rounded-full opacity-20 blur-3xl"></div>
    </div>

    <!-- Main Container -->
    <div class="relative w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Top Red Bar -->
            <div class="h-2 red-gradient"></div>

            <div class="px-8 py-8">
                <!-- Logo and Title Section -->
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-4">
                        <div class="p-2 rounded-2xl red-accent-light border border-red-200 inline-block">
                            <img src="{{ asset('images/logo-pudho.jpg') }}"
                                alt="PUDHO Logo"
                                class="w-24 h-24 rounded-xl border-2 border-white shadow-md object-cover"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/96x96?text=PUDHO';">
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-800">Provincial Urban Development</h1>
                    <h2 class="text-xl font-semibold red-accent">And Housing Office - Laguna</h2>

                    <!-- Badges -->
                    <div class="mt-4 space-y-2">
                        <p class="text-gray-500 text-sm flex items-center justify-center">
                            <span class="w-2 h-2 red-accent-bg rounded-full mr-2 animate-pulse"></span>
                            Secure Login Portal
                        </p>
                        <span class="inline-block px-4 py-1 red-accent-light text-red-700 rounded-full text-sm font-medium border border-red-200">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Administrator Access Only
                        </span>
                    </div>
                </div>

                <!-- Error Alert -->
                @if(session('error'))
                <div class="mb-4">
                    <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-red-700 text-sm">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
                @endif

                @if(session('message'))
                <div class="mb-4">
                    <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-green-700 text-sm">{{ session('message') }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                <div class="mb-4">
                    <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-red-700 text-sm">{{ $errors->first() }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
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
                               value="{{ old('username') }}"
                               class="input-focus-effect w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition duration-200 bg-white/50 @error('username') border-red-500 @enderror"
                               placeholder="Enter your username or email"
                               autocomplete="username"
                               required
                               autofocus>
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
                                   class="input-focus-effect w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition duration-200 bg-white/50 pr-12 @error('password') border-red-500 @enderror"
                                   placeholder="Enter your password"
                                   autocomplete="current-password"
                                   required>
                            <button type="button" 
                                    id="togglePassword" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-red-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                   class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>
                        <a href="#" 
                           onclick="alert('Please contact the system administrator for password reset.')"
                           class="text-sm text-gray-600 hover-red font-medium transition duration-200">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            id="loginButton"
                            class="btn-red w-full text-white font-semibold py-3 px-4 rounded-xl transform transition duration-200 shadow-lg">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Login to Dashboard
                        </span>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <p>&copy; {{ date('Y') }} PUDHO - Laguna</p>
                    <div class="flex space-x-3">
                        <a href="#" onclick="alert('Terms of service will be available soon.')" class="hover-red transition">Terms</a>
                        <a href="#" onclick="alert('Privacy policy will be available soon.')" class="hover-red transition">Privacy</a>
                        <a href="mailto:support@pudho-laguna.gov.ph" class="hover-red transition">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword')?.addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            const icon = this.querySelector('svg');
            if (type === 'text') {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        });
    </script>
</body>
</html>