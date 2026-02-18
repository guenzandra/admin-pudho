<!-- Main Layout Container -->
<div class="flex h-screen bg-gray-100">
  <!-- Sidebar Overlay (for mobile) -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden" onclick="toggleSidebar()"></div>

  <!-- Main Sidebar Container -->
  <div id="sidebar" class="h-screen bg-white shadow-lg fixed left-0 top-0 w-64 flex flex-col border-r border-gray-200 z-30 transition-transform duration-300 -translate-x-full lg:translate-x-0">

    <!-- Logo Section with Red Accent - Redesigned -->
    <div class="p-4 border-b border-gray-200">
      <div class="flex items-center space-x-3">
        <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
          <img src="{{ asset('build/assets/images/logo-pudho.jpg') }}"
            alt="PUDHO Logo"
            class="w-12 h-12 rounded-md"
            onerror="this.onerror=null; this.src='https://via.placeholder.com/48x48?text=PUDHO';">
        </div>
        <div class="flex flex-col">
          <h1 class="font-bold text-gray-800 text-base"><span class="text-red-600">LAGUNA</span> PUDHO</h1>
          <p class="text-[10px] leading-tight text-gray-500">Provincial Urban Development</p>
          <p class="text-[10px] leading-tight text-gray-500 items-center text-center">Housing Office</p>
        </div>
      </div>
    </div>

    <!-- Main Navigation Sections -->
    <div class="flex-1 overflow-y-auto py-4 scrollbar-thin">
      <!-- Main Menu -->
      <div class="px-4 space-y-1">
        <!-- Dashboard -->
        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          <span class="text-sm font-medium">Dashboard</span>
        </a>

        <!-- CMS Section -->
        <div>
          <div onclick="toggleDropdown('cmsDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
            <div class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
              </svg>
              <span class="text-sm font-medium">CMS</span>
            </div>
            <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
          <div id="cmsDropdown" class="hidden pl-11 space-y-1 mt-1">
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Articles</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Announcements</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">News</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Media Library</a>
          </div>
        </div>

        <!-- File Management -->
        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
          </svg>
          <span class="text-sm font-medium">PUDHO File Management</span>
        </a>

        <!-- Residents -->
        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          <span class="text-sm font-medium">Residents</span>
        </a>

        <!-- Check Missing Files -->
        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="text-sm font-medium">Check Missing Files</span>
        </a>

        <!-- Anti-Squatting -->
        <div>
          <div onclick="toggleDropdown('squattingDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
            <div class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
              <span class="text-sm font-medium">Anti-Squatting</span>
            </div>
            <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
          <div id="squattingDropdown" class="hidden pl-11 space-y-1 mt-1">
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Reports</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Investigation</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Map View</a>
          </div>
        </div>

        <!-- Messages & FAQs Section -->
        <div class="pt-4 mt-2 border-t border-gray-100">
          <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Support</p>

          <!-- Messages -->
          <div>
            <div onclick="toggleDropdown('messagesDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <span class="text-sm font-medium">Messages</span>
              </div>
              <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
            <div id="messagesDropdown" class="hidden pl-11 space-y-1 mt-1">
              <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Inbox</a>
              <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Sent</a>
              <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Archived</a>
            </div>
          </div>

          <!-- FAQs -->
          <div>
            <div onclick="toggleDropdown('faqsDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">FAQs</span>
              </div>
              <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
            <div id="faqsDropdown" class="hidden pl-11 space-y-1 mt-1">
              <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Pending Questions</a>
              <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Answered</a>
              <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Categories</a>
            </div>
          </div>
        </div>

        <!-- User Management -->
        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <span class="text-sm font-medium">User Management</span>
        </a>

        <!-- Reports & Analytics -->
        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          <span class="text-sm font-medium">Reports & Analytics</span>
        </a>

        <!-- Settings -->
        <div>
          <div onclick="toggleDropdown('settingsDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
            <div class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span class="text-sm font-medium">Settings</span>
            </div>
            <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
          <div id="settingsDropdown" class="hidden pl-11 space-y-1 mt-1">
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">General</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Security</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Notifications</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Audit Logs</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg">Help</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Top Navigation -->
  <div class="flex-1 lg:ml-64">

    <div class="pt-20 p-6">
      @yield('content')
    </div>

    <!-- Top Navigation Bar -->
    <div class="bg-white shadow-sm border-b border-gray-200 h-16 fixed top-0 right-0 left-0 lg:left-64 z-10">
      <!-- Red top line -->
      <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-red-400 to-red-600"></div>

      <div class="flex items-center justify-between h-full px-4 lg:px-6 relative">
        <!-- Left side: Hamburger Menu + Logo (mobile) -->
        <div class="flex items-center space-x-3">
          <!-- Hamburger Menu Button with red hover effect -->
          <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-red-600 focus:outline-none group relative">
            <div class="absolute -inset-1 bg-red-100 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <svg class="w-6 h-6 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>

          <!-- Mobile Logo with red dot indicator -->
          <div class="flex items-center space-x-2 lg:hidden relative">
            <div class="absolute -left-1 -top-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-50">
              <img src="{{ asset('build/assets/images/logo-pudho.jpg') }}"
                alt="PUDHO Logo"
                class="w-7 h-7 rounded-md"
                onerror="this.onerror=null; this.src='https://via.placeholder.com/28x28?text=PUDHO';">
            </div>
            <span class="font-semibold text-gray-800">PUDHO</span>
          </div>
        </div>

        <!-- Right side: Time, Notifications, Profile -->
        <div class="flex items-center space-x-4 lg:space-x-6">
          <!-- Dateand Time -->
          <div class="hidden md:block text-sm border-r border-gray-200 pr-6 relative">
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-0.5 h-8 bg-gradient-to-b from-transparent via-red-300 to-transparent"></div>
            <div class="font-medium text-gray-700 flex items-center">
              <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
              <span id="currentDate"></span>
            </div>
            <div class="text-xs text-gray-500 flex items-center justify-end" id="currentTime"></div>
          </div>

          <!-- Notification Bell -->
          <div class="relative group">
            <button class="text-gray-500 hover:text-red-600 transition-colors relative">
              <div class="absolute -inset-1 bg-red-100 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
              <svg class="w-5 h-5 lg:w-6 lg:h-6 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
            </button>
          </div>

          <!-- Message Icon -->
          <div class="relative group">
            <button class="text-gray-500 hover:text-red-600 transition-colors relative">
              <div class="absolute -inset-1 bg-red-100 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
              <svg class="w-5 h-5 lg:w-6 lg:h-6 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
            </button>
          </div>

          <!-- Profile Dropdown with red accent -->
          <div class="relative">
            <button onclick="toggleProfileDropdown()" class="flex items-center space-x-2 focus:outline-none group">
              <div class="relative">
                <!-- Profile picture with red ring on hover -->
                <div class="absolute inset-0 bg-red-500 rounded-full opacity-0 group-hover:opacity-20 transition-opacity"></div>
                <div class="w-8 h-8 lg:w-9 lg:h-9 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-semibold text-sm lg:text-base shadow-md group-hover:shadow-lg transition-shadow">
                  A
                </div>
                <!-- Online status indicator -->
                <span class="absolute bottom-0 right-0 block w-2.5 h-2.5 bg-green-500 rounded-full ring-2 ring-white"></span>
              </div>
              <svg class="w-4 h-4 text-gray-400 hidden sm:block group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Dropdown Menu with red accent -->
            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 border border-gray-200">
              <!-- Red top accent for dropdown -->
              <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-red-400 to-red-600 rounded-t-lg"></div>

              <a href="#" class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 group">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profile</span>
              </a>
              <a href="#" class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 group">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Settings</span>
              </a>
              <div class="border-t border-gray-100 my-1"></div>
              <a href="#" class="flex items-center space-x-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 group">
                <svg class="w-4 h-4 text-red-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Dropdown Script -->
<script>
  function toggleDropdown(dropdownId, element) {
    const dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle('hidden');
    const arrow = element.querySelector('.dropdown-arrow');

    if (dropdown.classList.contains('hidden')) {
      arrow.style.transform = 'rotate(0deg)';
    } else {
      arrow.style.transform = 'rotate(180deg)';
    }
  }

  function toggleProfileDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('hidden');
  }

  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
  }

  // Close other dropdowns when opening a new one
  document.querySelectorAll('[onclick^="toggleDropdown"]').forEach(item => {
    item.addEventListener('click', function(event) {
      const currentDropdownId = this.getAttribute('onclick').match(/'([^']*)'/)[1];

      document.querySelectorAll('[id$="Dropdown"]').forEach(dropdown => {
        if (dropdown.id !== currentDropdownId && !dropdown.classList.contains('hidden')) {
          dropdown.classList.add('hidden');
          const otherElement = document.querySelector(`[onclick*="${dropdown.id}"]`);
          if (otherElement) {
            const otherArrow = otherElement.querySelector('.dropdown-arrow');
            if (otherArrow) {
              otherArrow.style.transform = 'rotate(0deg)';
            }
          }
        }
      });
    });
  });

  // Update time every second
  function updateDateTime() {
    const now = new Date();

    // Format date: Wednesday, February 18, 2026
    const options = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    };
    document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);

    // Format time: 2:03 P.M Philippines
    let hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const ampm = hours >= 12 ? 'P.M' : 'A.M';
    hours = hours % 12;
    hours = hours ? hours : 12;

    document.getElementById('currentTime').textContent = `${hours}:${minutes} ${ampm} Philippines`;
  }

  // Update immediately and then every second
  updateDateTime();
  setInterval(updateDateTime, 1000);

  // Close dropdown when clicking outside
  document.addEventListener('click', function(event) {
    const profileDropdown = document.getElementById('profileDropdown');
    const profileButton = document.querySelector('[onclick="toggleProfileDropdown()"]');

    if (profileButton && !profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
      profileDropdown.classList.add('hidden');
    }
  });

  // Close sidebar on window resize (if going to desktop)
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 1024) {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');
      sidebar.classList.remove('-translate-x-full');
      overlay.classList.add('hidden');
    }
  });
</script>

<!-- Optional: Add custom scrollbar styles -->
<style>
  /* For Chrome, Edge, and Safari */
  .scrollbar-thin::-webkit-scrollbar {
    width: 4px;
  }

  .scrollbar-thin::-webkit-scrollbar-track {
    background: transparent;
  }

  .scrollbar-thin::-webkit-scrollbar-thumb {
    background: #fecaca;
    border-radius: 20px;
  }

  .scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #fca5a5;
  }
</style>