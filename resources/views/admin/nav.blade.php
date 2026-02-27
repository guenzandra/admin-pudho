<!-- Main Layout Container -->
<div class="flex h-screen bg-gray-100">
  <!-- Sidebar Overlay (for mobile) -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden" onclick="toggleSidebar()"></div>

  <!-- Main Sidebar Container -->
  <div id="sidebar" class="h-screen bg-white shadow-lg fixed left-0 top-0 w-64 flex flex-col border-r border-gray-200 z-30 transition-all duration-300 -translate-x-full lg:translate-x-0 lg:sidebar-expanded">

    <!-- Logo Section with Red Accent - Clickable Image as Toggle -->
    <div class="p-4 border-b border-gray-200">
      <div class="flex items-center space-x-3">
        <!-- Make the image clickable as toggle for desktop -->
        <div onclick="toggleDesktopSidebar()" class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0 cursor-pointer group relative lg:block hidden" title="Click to toggle sidebar">
          <!-- Hover effect -->
          <div class="absolute inset-0 bg-red-100 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
          <img src="{{ asset('build/assets/images/logo-pudho.jpg') }}"
            alt="PUDHO Logo"
            class="w-12 h-12 rounded-md relative transform transition-transform group-hover:scale-105"
            onerror="this.onerror=null; this.src='https://via.placeholder.com/48x48?text=PUDHO';">
          <!-- Small indicator that it's clickable -->
          <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>

        <!-- Mobile logo (same as before but without toggle) -->
        <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0 lg:hidden">
          <img src="{{ asset('build/assets/images/logo-pudho.jpg') }}"
            alt="PUDHO Logo"
            class="w-12 h-12 rounded-md"
            onerror="this.onerror=null; this.src='https://via.placeholder.com/48x48?text=PUDHO';">
        </div>

        <div class="flex flex-col sidebar-text">
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
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          <span class="text-sm font-medium sidebar-text">Dashboard</span>
        </a>

        <!-- CMS Section -->
        <div>
          <div onclick="toggleDropdown('cmsDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
            <div class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
              </svg>
              <span class="text-sm font-medium sidebar-text">Posts</span>
            </div>
            <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow flex-shrink-0 sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
          <div id="cmsDropdown" class="hidden pl-11 space-y-1 mt-1">
            <a href="{{ route('allpost') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">All Post</a>
            <a href="{{ route('addpost') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Add Post</a>
            <a href="{{ route('categories') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Categories</a>
            <a href="{{ route('media') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Media Library</a>
          </div>
        </div>

        <!-- File Management -->
        <a href="{{ route('filemanagement') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
          </svg>
          <span class="text-sm font-medium sidebar-text">PUDHO File Management</span>
        </a>

        <!-- Residents -->
        <a href="{{ route('residents') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          <span class="text-sm font-medium sidebar-text">Residents</span>
        </a>

        <!-- Check Missing Files -->
        <a href="{{ route('cmissingfiles') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="text-sm font-medium sidebar-text">Check Missing Files</span>
        </a>

        <!-- Anti-Squatting -->
        <div>
          <div onclick="toggleDropdown('squattingDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
            <div class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
              <span class="text-sm font-medium sidebar-text">Anti-Squatting</span>
            </div>
            <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow flex-shrink-0 sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
          <div id="squattingDropdown" class="hidden pl-11 space-y-1 mt-1">
            <a href="{{ route('reports') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Reports</a>
            <a href="{{ route('investigation') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Investigation</a>
            <a href="{{ route('mapview') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Map View</a>
          </div>
        </div>

        <!-- Messages & FAQs Section -->
        <div class="pt-4 mt-2 border-t border-gray-100">
          <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 sidebar-text">Support</p>

          <!-- Messages -->
          <div>
            <div onclick="toggleDropdown('messagesDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <span class="text-sm font-medium sidebar-text">Messages</span>
              </div>
              <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow flex-shrink-0 sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
            <div id="messagesDropdown" class="hidden pl-11 space-y-1 mt-1">
              <a href="{{ route('inbox') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Inbox</a>
              <a href="{{ route('sent') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Sent</a>
              <a href="{{ route('archived') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Archived</a>
            </div>
          </div>

          <!-- FAQs -->
          <div>
            <div onclick="toggleDropdown('faqsDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium sidebar-text">FAQs</span>
              </div>
              <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow flex-shrink-0 sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
            <div id="faqsDropdown" class="hidden pl-11 space-y-1 mt-1">
              <a href="{{ route('pending') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Pending Questions</a>
              <a href="{{ route('answered') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Answered</a>
            </div>
          </div>
        </div>

        <!-- User Management -->
        <a href="{{ route('usermanagement') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <span class="text-sm font-medium sidebar-text">User Management</span>
        </a>

        <!-- Reports & Analytics -->
        <a href="{{ route('reportsAnalytics') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          <span class="text-sm font-medium sidebar-text">Reports & Analytics</span>
        </a>

        <!-- Settings -->
        <div>
          <div onclick="toggleDropdown('settingsDropdown', this)" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition duration-200 group cursor-pointer">
            <div class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span class="text-sm font-medium sidebar-text">Settings</span>
            </div>
            <svg class="w-4 h-4 transition-transform duration-200 dropdown-arrow flex-shrink-0 sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
          <div id="settingsDropdown" class="hidden pl-11 space-y-1 mt-1">
            <a href="{{ route('general') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">General</a>
            <a href="{{ route('help') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Security</a>
            <a href="{{ route('notifications') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Notifications</a>
            <a href="{{ route('logs') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Audit Logs</a>
            <a href="{{ route('security') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg sidebar-submenu">Help</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Top Navigation -->
  <div id="mainContent" class="flex-1 lg:ml-64 transition-all duration-300">

    <div class="pt-20 p-6">
      @yield('content')
    </div>

    <!-- Top Navigation Bar -->
    <div class="bg-white shadow-sm border-b border-gray-200 h-16 fixed top-0 right-0 left-0 lg:left-64 z-10 transition-all duration-300" id="topNav">
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
          <!---- Search Bar (optional) -->
          <div class="">
            <!-- You can add a search input here if needed for general search-->
          </div>
          <!-- Date and Time -->
          <div class="hidden md:block text-sm border-r border-gray-200 pr-6 relative">
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-0.5 h-8 bg-gradient-to-b from-transparent via-red-300 to-transparent"></div>
            <div class="font-medium text-gray-700 flex items-center">
              <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
              <span id="currentDate"></span>
            </div>
            <div class="text-xs text-gray-500 flex items-center justify-end" id="currentTime"></div>
          </div>

          <!-- Notification Bell with Dropdown -->
          <div class="relative" id="notificationContainer">
            <button onclick="toggleNotificationDropdown()" class="text-gray-500 hover:text-red-600 transition-colors relative group">
              <div class="absolute -inset-1 bg-red-100 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
              <svg class="w-5 h-5 lg:w-6 lg:h-6 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
              <!-- Notification Badge -->
              <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">3</span>
            </button>

            <!-- Notification Dropdown -->
            <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 border border-gray-200 z-50">
              <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-red-400 to-red-600 rounded-t-lg"></div>

              <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-700">Notifications</h3>
                <span class="text-xs text-red-600 hover:text-red-700 cursor-pointer">Mark all as read</span>
              </div>

              <div class="max-h-96 overflow-y-auto">
                <!-- Notification Item -->
                <a href="#" class="block px-4 py-3 hover:bg-red-50 border-b border-gray-50">
                  <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                      <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </div>
                    <div class="flex-1">
                      <p class="text-sm text-gray-800">New resident application</p>
                      <p class="text-xs text-gray-500 mt-1">5 minutes ago</p>
                    </div>
                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                  </div>
                </a>

                <!-- Notification Item -->
                <a href="#" class="block px-4 py-3 hover:bg-red-50 border-b border-gray-50">
                  <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                      <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                    </div>
                    <div class="flex-1">
                      <p class="text-sm text-gray-800">New message from John Doe</p>
                      <p class="text-xs text-gray-500 mt-1">15 minutes ago</p>
                    </div>
                  </div>
                </a>

                <!-- Notification Item -->
                <a href="#" class="block px-4 py-3 hover:bg-red-50 border-b border-gray-50">
                  <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                      <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </div>
                    <div class="flex-1">
                      <p class="text-sm text-gray-800">File verification complete</p>
                      <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                    </div>
                  </div>
                </a>
              </div>

              <div class="px-4 py-2 border-t border-gray-100">
                <a href="#" class="text-sm text-red-600 hover:text-red-700 block text-center">View all notifications</a>
              </div>
            </div>
          </div>

          <!-- Message Icon with Dropdown -->
          <div class="relative" id="messageContainer">
            <button onclick="toggleMessageDropdown()" class="text-gray-500 hover:text-red-600 transition-colors relative group">
              <div class="absolute -inset-1 bg-red-100 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
              <svg class="w-5 h-5 lg:w-6 lg:h-6 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
              <!-- Message Badge -->
              <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">5</span>
            </button>

            <!-- Message Dropdown -->
            <div id="messageDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 border border-gray-200 z-50">
              <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-red-400 to-red-600 rounded-t-lg"></div>

              <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-700">Messages</h3>
                <span class="text-xs text-red-600 hover:text-red-700 cursor-pointer">New message</span>
              </div>

              <div class="max-h-96 overflow-y-auto">
                <!-- Message Item -->
                <a href="#" class="block px-4 py-3 hover:bg-red-50 border-b border-gray-50">
                  <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                      JD
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-gray-800">John Doe</p>
                        <p class="text-xs text-gray-500">2 min ago</p>
                      </div>
                      <p class="text-xs text-gray-600 truncate">Regarding the file verification process...</p>
                    </div>
                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                  </div>
                </a>

                <!-- Message Item -->
                <a href="#" class="block px-4 py-3 hover:bg-red-50 border-b border-gray-50">
                  <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                      JS
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-gray-800">Jane Smith</p>
                        <p class="text-xs text-gray-500">1 hour ago</p>
                      </div>
                      <p class="text-xs text-gray-600 truncate">Updated the anti-squatting report...</p>
                    </div>
                  </div>
                </a>

                <!-- Message Item -->
                <a href="#" class="block px-4 py-3 hover:bg-red-50 border-b border-gray-50">
                  <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                      MR
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-gray-800">Mike Ross</p>
                        <p class="text-xs text-gray-500">3 hours ago</p>
                      </div>
                      <p class="text-xs text-gray-600 truncate">New resident application needs review...</p>
                    </div>
                  </div>
                </a>
              </div>

              <div class="px-4 py-2 border-t border-gray-100">
                <a href="#" class="text-sm text-red-600 hover:text-red-700 block text-center">View all messages</a>
              </div>
            </div>
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

              <a href="{{ route('profile') }}" class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 group">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profile</span>
              </a>
              <div class="border-t border-gray-100 my-1"></div>
              <a href="{{ route('welcome') }}" class="flex items-center space-x-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 group">
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
  // Sidebar state for desktop toggle
  let isSidebarCollapsed = false;

  function toggleDesktopSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const topNav = document.getElementById('topNav');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');
    const sidebarArrows = document.querySelectorAll('.sidebar-arrow');
    const sidebarSubmenus = document.querySelectorAll('.sidebar-submenu');
    const logoImage = document.querySelector('.lg\\:block img'); // Select the logo image

    isSidebarCollapsed = !isSidebarCollapsed;

    if (isSidebarCollapsed) {
      // Collapse sidebar
      sidebar.classList.add('lg:w-20');
      sidebar.classList.remove('lg:w-64');
      mainContent.classList.add('lg:ml-20');
      mainContent.classList.remove('lg:ml-64');
      topNav.classList.add('lg:left-20');
      topNav.classList.remove('lg:left-64');

      // Hide text elements
      sidebarTexts.forEach(el => el.classList.add('lg:hidden'));
      sidebarArrows.forEach(el => el.classList.add('lg:hidden'));
      sidebarSubmenus.forEach(el => el.classList.add('lg:hidden'));

      // Hide dropdowns when collapsed
      document.querySelectorAll('[id$="Dropdown"]').forEach(dropdown => {
        dropdown.classList.add('hidden');
      });

      // Optional: Add rotation effect to logo
      if (logoImage) {
        logoImage.style.transform = 'rotate(360deg)';
        setTimeout(() => {
          logoImage.style.transform = 'rotate(0deg)';
        }, 300);
      }
    } else {
      // Expand sidebar
      sidebar.classList.remove('lg:w-20');
      sidebar.classList.add('lg:w-64');
      mainContent.classList.remove('lg:ml-20');
      mainContent.classList.add('lg:ml-64');
      topNav.classList.remove('lg:left-20');
      topNav.classList.add('lg:left-64');

      // Show text elements
      sidebarTexts.forEach(el => el.classList.remove('lg:hidden'));
      sidebarArrows.forEach(el => el.classList.remove('lg:hidden'));
      sidebarSubmenus.forEach(el => el.classList.remove('lg:hidden'));

      // Optional: Add rotation effect to logo
      if (logoImage) {
        logoImage.style.transform = 'rotate(-360deg)';
        setTimeout(() => {
          logoImage.style.transform = 'rotate(0deg)';
        }, 300);
      }
    }
  }

  function toggleDropdown(dropdownId, element) {
    // Don't toggle if sidebar is collapsed in desktop mode
    if (window.innerWidth >= 1024 && isSidebarCollapsed) {
      return;
    }

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

  function toggleNotificationDropdown() {
    const dropdown = document.getElementById('notificationDropdown');
    dropdown.classList.toggle('hidden');

    // Close message dropdown if open
    const messageDropdown = document.getElementById('messageDropdown');
    if (!messageDropdown.classList.contains('hidden')) {
      messageDropdown.classList.add('hidden');
    }
  }

  function toggleMessageDropdown() {
    const dropdown = document.getElementById('messageDropdown');
    dropdown.classList.toggle('hidden');

    // Close notification dropdown if open
    const notificationDropdown = document.getElementById('notificationDropdown');
    if (!notificationDropdown.classList.contains('hidden')) {
      notificationDropdown.classList.add('hidden');
    }
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

  // Close dropdowns when clicking outside
  document.addEventListener('click', function(event) {
    // Profile dropdown
    const profileDropdown = document.getElementById('profileDropdown');
    const profileButton = document.querySelector('[onclick="toggleProfileDropdown()"]');

    if (profileButton && !profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
      profileDropdown.classList.add('hidden');
    }

    // Notification dropdown
    const notificationDropdown = document.getElementById('notificationDropdown');
    const notificationButton = document.querySelector('[onclick="toggleNotificationDropdown()"]');
    const notificationContainer = document.getElementById('notificationContainer');

    if (notificationContainer && !notificationContainer.contains(event.target)) {
      notificationDropdown.classList.add('hidden');
    }

    // Message dropdown
    const messageDropdown = document.getElementById('messageDropdown');
    const messageButton = document.querySelector('[onclick="toggleMessageDropdown()"]');
    const messageContainer = document.getElementById('messageContainer');

    if (messageContainer && !messageContainer.contains(event.target)) {
      messageDropdown.classList.add('hidden');
    }
  });

  // Close sidebar on window resize (if going to desktop)
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 1024) {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');
      sidebar.classList.remove('-translate-x-full');
      overlay.classList.add('hidden');

      // Reset sidebar collapse state on resize to large
      if (isSidebarCollapsed) {
        // Optionally keep collapsed state or reset
        // Uncomment the line below if you want to reset to expanded on resize
        // toggleDesktopSidebar(); 
      }
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

  /* Sidebar transitions */
  #sidebar {
    transition: width 0.3s ease-in-out;
  }

  #mainContent,
  #topNav {
    transition: margin-left 0.3s ease-in-out, left 0.3s ease-in-out;
  }

  /* Hide elements smoothly */
  .sidebar-text,
  .sidebar-arrow,
  .sidebar-submenu {
    transition: opacity 0.2s ease-in-out;
  }

  /* Dropdown animations */
  #notificationDropdown,
  #messageDropdown {
    animation: slideDown 0.2s ease-out;
  }

  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Logo image transition */
  .lg\\:block img {
    transition: transform 0.3s ease-in-out;
  }

  /* Cursor pointer for clickable logo */
  .lg\\:block {
    cursor: pointer;
  }
</style>