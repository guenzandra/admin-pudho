{{-- resources/views/layouts/nav.blade.php (refactored) --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PUDHO Editor — @yield('title', 'Dashboard')</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --red: #C0202F;
      --red-dark: #8C111E;
      --red-mid: #A8192A;
      --red-pale: #FEF0F1;
      --red-pale2: #FDE8EA;
      --red-border: #F3CACE;
      --sidebar-w: 268px;
      --topbar-h: 68px;
      --text-primary: #1A0508;
      --text-secondary: #7A4A50;
      --text-muted: #B08888;
      --surface: #FFFFFF;
      --bg: #F6F1F2;
      --border: #EDE0E1;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text-primary);
    }

    /* ═══════════ SIDEBAR ═══════════ */
    #sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--surface);
      border-right: 1px solid var(--red-border);
      display: flex;
      flex-direction: column;
      z-index: 40;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;
    }

    /* Collapsed state */
    #sidebar.collapsed {
      width: 70px;
    }

    #sidebar.collapsed .nav-label,
    #sidebar.collapsed .nav-arrow,
    #sidebar.collapsed .sidebar-brand-text,
    #sidebar.collapsed .section-label,
    #sidebar.collapsed .sub-menu,
    #sidebar.collapsed .user-info {
      opacity: 0;
      pointer-events: none;
      width: 0;
      overflow: hidden;
      white-space: nowrap;
    }

    #sidebar.collapsed .nav-item {
      justify-content: center;
      padding: 11px 0;
    }

    #sidebar.collapsed .nav-icon {
      margin: 0;
    }

    #sidebar.collapsed .logo-area {
      justify-content: center;
      padding: 18px 0;
    }

    #sidebar.collapsed .sidebar-user {
      justify-content: center;
      padding: 14px 0;
    }

    @media (max-width: 1023px) {
      #sidebar {
        transform: translateX(-100%);
        width: var(--sidebar-w) !important;
        box-shadow: 8px 0 32px rgba(192, 32, 47, 0.15);
      }

      #sidebar.mobile-open {
        transform: translateX(0);
      }

      #sidebar.collapsed .nav-label,
      #sidebar.collapsed .nav-arrow,
      #sidebar.collapsed .sidebar-brand-text,
      #sidebar.collapsed .section-label,
      #sidebar.collapsed .sub-menu,
      #sidebar.collapsed .user-info {
        opacity: 1;
        pointer-events: auto;
        width: auto;
        overflow: visible;
      }

      #sidebar.collapsed .nav-item {
        justify-content: flex-start;
        padding: 11px 14px;
      }

      #sidebar.collapsed .logo-area {
        justify-content: flex-start;
        padding: 16px 18px;
      }

      #sidebar.collapsed .sidebar-user {
        justify-content: flex-start;
        padding: 14px 16px;
      }
    }

    /* Brand area */
    .sidebar-brand {
      flex-shrink: 0;
      background: linear-gradient(145deg, var(--red-dark) 0%, var(--red) 60%, #D94050 100%);
      position: relative;
      overflow: hidden;
    }

    .sidebar-brand::before {
      content: '';
      position: absolute;
      top: -30px;
      right: -30px;
      width: 110px;
      height: 110px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.06);
      pointer-events: none;
    }

    .sidebar-brand::after {
      content: '';
      position: absolute;
      bottom: -20px;
      left: 20px;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.04);
      pointer-events: none;
    }

    .logo-area {
      display: flex;
      align-items: center;
      gap: 13px;
      padding: 16px 18px;
      cursor: pointer;
      position: relative;
      z-index: 1;
      transition: padding 0.3s;
    }

    .logo-img {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      border: 2px solid rgba(255, 255, 255, 0.35);
      object-fit: cover;
      flex-shrink: 0;
      transition: transform 0.3s;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
    }

    .logo-area:hover .logo-img {
      transform: scale(1.07);
    }

    .sidebar-brand-text {
      overflow: hidden;
      transition: opacity 0.25s, width 0.3s;
    }

    .brand-name {
      font-size: 14px;
      font-weight: 700;
      color: #fff;
      line-height: 1.2;
      white-space: nowrap;
      letter-spacing: 0.01em;
    }

    .brand-name span {
      color: rgba(255, 255, 255, 0.6);
      font-weight: 500;
    }

    .brand-tagline {
      font-size: 10.5px;
      color: rgba(255, 255, 255, 0.5);
      white-space: nowrap;
      margin-top: 3px;
      letter-spacing: 0.02em;
    }

    /* Nav area */
    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 14px 10px;
      scrollbar-width: thin;
      scrollbar-color: var(--red-border) transparent;
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 3px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: var(--red-border);
      border-radius: 3px;
    }

    .section-label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--text-muted);
      padding: 14px 10px 5px;
      white-space: nowrap;
      overflow: hidden;
      transition: opacity 0.25s;
    }

    /* Nav items */
    .nav-item {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 10px 12px;
      border-radius: 9px;
      cursor: pointer;
      text-decoration: none;
      color: var(--text-secondary);
      font-size: 14px;
      font-weight: 500;
      transition: background 0.15s, color 0.15s, padding 0.3s;
      white-space: nowrap;
      position: relative;
      width: 100%;
      border: none;
      background: none;
      font-family: 'DM Sans', sans-serif;
      text-align: left;
    }

    .nav-item:hover {
      background: var(--red-pale);
      color: var(--red);
    }

    .nav-item:hover .nav-icon {
      color: var(--red);
    }

    /* Active state — persistent highlight */
    .nav-item.active {
      background: var(--red-pale2);
      color: var(--red);
      font-weight: 600;
    }

    .nav-item.active .nav-icon {
      color: var(--red);
    }

    .nav-item.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 18%;
      bottom: 18%;
      width: 3.5px;
      background: var(--red);
      border-radius: 0 3px 3px 0;
    }

    .sub-item.active {
      background: var(--red-pale2);
      color: var(--red);
      font-weight: 600;
    }

    .sub-item.active::after {
      background: var(--red) !important;
    }

    .nav-icon {
      width: 18px;
      height: 18px;
      color: #C09090;
      flex-shrink: 0;
      transition: color 0.15s;
    }

    .nav-label {
      flex: 1;
      overflow: hidden;
      transition: opacity 0.25s;
    }

    .nav-arrow {
      width: 14px;
      height: 14px;
      color: var(--text-muted);
      flex-shrink: 0;
      transition: transform 0.2s, opacity 0.25s;
    }

    .nav-arrow.open {
      transform: rotate(180deg);
    }

    /* Sub-menu */
    .sub-menu {
      overflow: hidden;
      max-height: 0;
      transition: max-height 0.28s ease, opacity 0.25s;
      opacity: 0;
    }

    .sub-menu.open {
      max-height: 320px;
      opacity: 1;
    }

    .sub-item {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 8px 12px 8px 40px;
      border-radius: 8px;
      font-size: 13.5px;
      color: var(--text-secondary);
      text-decoration: none;
      transition: background 0.15s, color 0.15s;
      white-space: nowrap;
      font-weight: 500;
      position: relative;
    }

    .sub-item::after {
      content: '';
      position: absolute;
      left: 22px;
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: #D4AAAE;
      transition: background 0.15s;
    }

    .sub-item:hover {
      background: var(--red-pale);
      color: var(--red);
    }

    .sub-item:hover::after {
      background: var(--red);
    }

    /* Sidebar user strip */
    .sidebar-user {
      flex-shrink: 0;
      border-top: 1px solid var(--red-border);
      padding: 14px 14px;
      display: flex;
      align-items: center;
      gap: 11px;
      background: #FDF8F8;
      overflow: hidden;
      transition: padding 0.3s;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--red) 0%, var(--red-dark) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 14px;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(192, 32, 47, 0.3);
      position: relative;
    }

    .user-avatar .online-dot {
      position: absolute;
      bottom: 1px;
      right: 1px;
      width: 9px;
      height: 9px;
      background: #22c55e;
      border-radius: 50%;
      border: 2px solid white;
    }

    .user-info {
      flex: 1;
      overflow: hidden;
      transition: opacity 0.25s;
    }

    .user-name {
      font-size: 13px;
      font-weight: 700;
      color: var(--text-primary);
      white-space: nowrap;
    }

    .user-role {
      font-size: 11px;
      color: var(--text-muted);
      white-space: nowrap;
      margin-top: 1px;
    }

    /* ═══════════ OVERLAY ═══════════ */
    #sidebarOverlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(15, 0, 5, 0.5);
      z-index: 39;
      backdrop-filter: blur(3px);
    }

    #sidebarOverlay.show {
      display: block;
    }

    /* ═══════════ TOP NAV ═══════════ */
    #topNav {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: var(--topbar-h);
      background: white;
      border-bottom: 1px solid var(--red-border);
      z-index: 30;
      display: flex;
      align-items: center;
      transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 2px 16px rgba(192, 32, 47, 0.06);
    }

    #topNav::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--red-dark) 0%, var(--red) 50%, rgba(220, 100, 112, 0.4) 100%);
    }

    #topNav.sidebar-collapsed {
      left: 70px;
    }

    @media (max-width: 1023px) {
      #topNav {
        left: 0 !important;
      }
    }

    .topnav-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      padding: 0 24px;
      gap: 12px;
    }

    .topnav-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .hamburger-btn {
      display: none;
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-secondary);
      padding: 8px;
      border-radius: 9px;
      transition: background 0.15s, color 0.15s;
    }

    .hamburger-btn:hover {
      background: var(--red-pale);
      color: var(--red);
    }

    @media (max-width: 1023px) {
      .hamburger-btn {
        display: flex;
        align-items: center;
        justify-content: center;
      }
    }

    .desktop-toggle-btn {
      display: flex;
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-secondary);
      padding: 8px;
      border-radius: 9px;
      transition: background 0.15s, color 0.15s;
      align-items: center;
      justify-content: center;
    }

    .desktop-toggle-btn:hover {
      background: var(--red-pale);
      color: var(--red);
    }

    @media (max-width: 1023px) {
      .desktop-toggle-btn {
        display: none;
      }
    }

    /* Right side */
    .topnav-right {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .datetime-wrap {
      display: none;
      flex-direction: column;
      align-items: flex-end;
      padding-right: 18px;
      margin-right: 6px;
      border-right: 1.5px solid var(--red-border);
      gap: 1px;
    }

    @media (min-width: 768px) {
      .datetime-wrap {
        display: flex;
      }
    }

    .dt-time {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 18px;
      font-weight: 700;
      color: var(--red);
      line-height: 1;
      letter-spacing: -0.01em;
    }

    .dt-date {
      font-size: 11px;
      font-weight: 600;
      color: var(--text-muted);
      letter-spacing: 0.01em;
      text-transform: uppercase;
    }

    .icon-btn {
      position: relative;
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-secondary);
      padding: 9px;
      border-radius: 9px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.15s, color 0.15s;
    }

    .icon-btn:hover {
      background: var(--red-pale);
      color: var(--red);
    }

    .icon-btn svg {
      width: 20px;
      height: 20px;
    }

    .badge {
      position: absolute;
      top: 4px;
      right: 4px;
      min-width: 16px;
      height: 16px;
      background: var(--red);
      border-radius: 8px;
      color: white;
      font-size: 9px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 3px;
      border: 2px solid white;
    }

    .profile-btn {
      display: flex;
      align-items: center;
      gap: 9px;
      background: none;
      border: none;
      cursor: pointer;
      padding: 6px 10px 6px 6px;
      border-radius: 11px;
      transition: background 0.15s;
      margin-left: 4px;
    }

    .profile-btn:hover {
      background: var(--red-pale);
    }

    .profile-av {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--red), var(--red-dark));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 13px;
      font-weight: 700;
      position: relative;
    }

    .profile-av .online {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 10px;
      height: 10px;
      background: #22c55e;
      border-radius: 50%;
      border: 2px solid white;
    }

    .profile-name {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--text-primary);
      display: none;
    }

    @media (min-width: 640px) {
      .profile-name {
        display: block;
      }
    }

    /* Dropdowns */
    .dropdown-panel {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      width: 310px;
      background: white;
      border: 1px solid var(--red-border);
      border-radius: 14px;
      box-shadow: 0 10px 40px rgba(192, 32, 47, 0.14), 0 2px 10px rgba(0, 0, 0, 0.05);
      z-index: 100;
      overflow: hidden;
      display: none;
      animation: dropIn 0.18s ease;
    }

    .dropdown-panel.show {
      display: block;
    }

    .dropdown-panel.narrow {
      width: 220px;
    }

    @keyframes dropIn {
      from {
        opacity: 0;
        transform: translateY(-8px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .dp-header {
      padding: 12px 16px;
      border-bottom: 1px solid var(--red-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: linear-gradient(135deg, #FFF5F6, #fff);
    }

    .dp-header h4 {
      font-size: 13px;
      font-weight: 700;
      color: var(--text-primary);
    }

    .dp-header a {
      font-size: 12px;
      color: var(--red);
      text-decoration: none;
      font-weight: 600;
    }

    .dp-body {
      max-height: 300px;
      overflow-y: auto;
    }

    .dp-item {
      display: flex;
      align-items: flex-start;
      gap: 11px;
      padding: 12px 16px;
      border-bottom: 1px solid #FFF0F1;
      text-decoration: none;
      transition: background 0.12s;
    }

    .dp-item:hover {
      background: #FFF7F7;
    }

    .dp-item-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .dp-item-icon svg {
      width: 16px;
      height: 16px;
    }

    .dp-item-text {
      flex: 1;
    }

    .dp-item-title {
      font-size: 13px;
      color: var(--text-primary);
      font-weight: 500;
      line-height: 1.35;
    }

    .dp-item-meta {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    .dp-unread-dot {
      width: 7px;
      height: 7px;
      background: var(--red);
      border-radius: 50%;
      margin-top: 5px;
      flex-shrink: 0;
    }

    .dp-footer {
      padding: 11px 16px;
      border-top: 1px solid var(--red-border);
      text-align: center;
    }

    .dp-footer a {
      font-size: 12.5px;
      color: var(--red);
      text-decoration: none;
      font-weight: 600;
    }

    .profile-dp-item {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 11px 16px;
      font-size: 13.5px;
      color: var(--text-secondary);
      text-decoration: none;
      transition: background 0.12s, color 0.12s;
      cursor: pointer;
      border: none;
      background: none;
      width: 100%;
      font-family: 'DM Sans', sans-serif;
      text-align: left;
      font-weight: 500;
    }

    .profile-dp-item:hover {
      background: var(--red-pale);
      color: var(--red);
    }

    .profile-dp-item svg {
      width: 16px;
      height: 16px;
      color: #C09090;
      flex-shrink: 0;
    }

    .profile-dp-item:hover svg {
      color: var(--red);
    }

    .profile-dp-item.danger {
      color: var(--red);
    }

    .profile-dp-item.danger svg {
      color: var(--red);
    }

    .msg-av {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 12px;
      font-weight: 700;
      flex-shrink: 0;
    }

    /* Main content */
    #mainContent {
      margin-left: var(--sidebar-w);
      margin-top: var(--topbar-h);
      min-height: calc(100vh - var(--topbar-h));
      transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      padding: 28px;
    }

    #mainContent.sidebar-collapsed {
      margin-left: 70px;
    }

    @media (max-width: 1023px) {
      #mainContent {
        margin-left: 0 !important;
        padding: 18px;
      }
    }
  </style>
</head>

<body>

  <div id="sidebarOverlay" onclick="closeSidebar()"></div>

  <!-- SIDEBAR (Editor version) -->
  <aside id="sidebar">

    <!-- Brand (click logo toggles desktop sidebar) -->
    <div class="sidebar-brand">
      <div class="logo-area" onclick="toggleDesktopSidebar()" title="Toggle sidebar">
        <img src="{{ asset('build/assets/images/logo-pudho.jpg') }}"
          alt="PUDHO"
          class="logo-img"
          onerror="this.src='https://via.placeholder.com/42x42/ffffff/C0202F?text=P'">
        <div class="sidebar-brand-text">
          <div class="brand-name"><span>LAGUNA</span> PUDHO</div>
          <div class="brand-tagline">Urban Development & Housing</div>
        </div>
      </div>
    </div>

    <!-- Navigation (Editor routes) -->
    <nav class="sidebar-nav">

      <div class="section-label">Main</div>

      <!-- Dashboard -->
      <a href="{{ route('editor.editorDashboard') }}" class="nav-item {{ request()->routeIs('editor.editorDashboard') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="nav-label">Dashboard</span>
      </a>

      <!-- Content Management -->
      <button class="nav-item {{ request()->routeIs('editor.announcements','editor.news') ? 'active' : '' }}"
        onclick="toggleNav('contentMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
        </svg>
        <span class="nav-label">Content Management</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.announcements','editor.news') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.announcements','editor.news') ? 'open' : '' }}" id="contentMenu">
        <a href="{{ route('editor.announcements') }}" class="sub-item {{ request()->routeIs('editor.announcements') ? 'active' : '' }}">Announcements</a>
        <a href="{{ route('editor.news') }}" class="sub-item {{ request()->routeIs('editor.news') ? 'active' : '' }}">News & Accomplishments</a>
      </div>

      <!-- Page Management -->
      <button class="nav-item {{ request()->routeIs('editor.vision-mission-values','editor.organizational-structure','editor.district-offices','editor.affiliated-offices','editor.citizens-charter') ? 'active' : '' }}"
        onclick="toggleNav('pageMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <span class="nav-label">Page Management</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.vision-mission-values','editor.organizational-structure','editor.district-offices','editor.affiliated-offices','editor.citizens-charter') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.vision-mission-values','editor.organizational-structure','editor.district-offices','editor.affiliated-offices','editor.citizens-charter') ? 'open' : '' }}" id="pageMenu">
        <a href="{{ route('editor.vision-mission-values') }}" class="sub-item {{ request()->routeIs('editor.vision-mission-values') ? 'active' : '' }}">Vision, Mission & Values</a>
        <a href="{{ route('editor.organizational-structure') }}" class="sub-item {{ request()->routeIs('editor.organizational-structure') ? 'active' : '' }}">Organizational Structure</a>
        <a href="{{ route('editor.district-offices') }}" class="sub-item {{ request()->routeIs('editor.district-offices') ? 'active' : '' }}">District Offices</a>
        <a href="{{ route('editor.affiliated-offices') }}" class="sub-item {{ request()->routeIs('editor.affiliated-offices') ? 'active' : '' }}">Affiliated Offices</a>
        <a href="{{ route('editor.citizens-charter') }}" class="sub-item {{ request()->routeIs('editor.citizens-charter') ? 'active' : '' }}">Citizen's Charter Preview</a>
      </div>

      <!-- Service Management -->
      <button class="nav-item {{ request()->routeIs('editor.manage-services') ? 'active' : '' }}"
        onclick="toggleNav('serviceMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <span class="nav-label">Service Management</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.manage-services') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.manage-services') ? 'open' : '' }}" id="serviceMenu">
        <a href="{{ route('editor.manage-services') }}" class="sub-item {{ request()->routeIs('editor.manage-services') ? 'active' : '' }}">Manage Services</a>
      </div>

      <!-- FAQ Management -->
      <button class="nav-item {{ request()->routeIs('editor.manage-faqs','editor.faq-categories') ? 'active' : '' }}"
        onclick="toggleNav('faqMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="nav-label">FAQ Management</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.manage-faqs','editor.faq-categories') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.manage-faqs','editor.faq-categories') ? 'open' : '' }}" id="faqMenu">
        <a href="{{ route('editor.manage-faqs') }}" class="sub-item {{ request()->routeIs('editor.manage-faqs') ? 'active' : '' }}">Manage FAQs</a>
        <a href="{{ route('editor.faq-categories') }}" class="sub-item {{ request()->routeIs('editor.faq-categories') ? 'active' : '' }}">FAQ Categories</a>
      </div>

      <!-- File Management -->
      <button class="nav-item {{ request()->routeIs('editor.downloadable-forms','editor.form-categories') ? 'active' : '' }}"
        onclick="toggleNav('fileMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <span class="nav-label">File Management</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.downloadable-forms','editor.form-categories') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.downloadable-forms','editor.form-categories') ? 'open' : '' }}" id="fileMenu">
        <a href="{{ route('editor.downloadable-forms') }}" class="sub-item {{ request()->routeIs('editor.downloadable-forms') ? 'active' : '' }}">Downloadable Forms</a>
        <a href="{{ route('editor.form-categories') }}" class="sub-item {{ request()->routeIs('editor.form-categories') ? 'active' : '' }}">Form Categories</a>
      </div>

      <!-- Media Management -->
      <button class="nav-item {{ request()->routeIs('editor.images','editor.documents') ? 'active' : '' }}"
        onclick="toggleNav('mediaMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="nav-label">Media Management</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.images','editor.documents') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.images','editor.documents') ? 'open' : '' }}" id="mediaMenu">
        <a href="{{ route('editor.images') }}" class="sub-item {{ request()->routeIs('editor.images') ? 'active' : '' }}">Images</a>
        <a href="{{ route('editor.documents') }}" class="sub-item {{ request()->routeIs('editor.documents') ? 'active' : '' }}">Documents</a>
      </div>

      <div class="section-label">Configuration</div>

      <!-- Settings -->
      <button class="nav-item {{ request()->routeIs('editor.settings.notifications','editor.settings.content-preferences','editor.settings.help-guide') ? 'active' : '' }}"
        onclick="toggleNav('settingsMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="nav-label">Settings</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.settings.notifications','editor.settings.content-preferences','editor.settings.help-guide') ? 'open' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.settings.notifications','editor.settings.content-preferences','editor.settings.help-guide') ? 'open' : '' }}" id="settingsMenu">
        <a href="{{ route('editor.settings.notifications') }}" class="sub-item {{ request()->routeIs('editor.settings.notifications') ? 'active' : '' }}">Notifications</a>
        <a href="{{ route('editor.settings.content-preferences') }}" class="sub-item {{ request()->routeIs('editor.settings.content-preferences') ? 'active' : '' }}">Content Preferences</a>
        <a href="{{ route('editor.settings.help-guide') }}" class="sub-item {{ request()->routeIs('editor.settings.help-guide') ? 'active' : '' }}">Help / User Guide</a>
      </div>

    </nav>

    <!-- User strip (editor) -->
    <div class="sidebar-user">
      <div class="user-avatar">
        E
        <span class="online-dot"></span>
      </div>
      <div class="user-info">
        <div class="user-name">Editor</div>
        <div class="user-role">PUDHO — Content Manager</div>
      </div>
    </div>
  </aside>

  <!-- TOP NAV -->
  <header id="topNav">
    <div class="topnav-inner">
      <div class="topnav-left">
        <button class="hamburger-btn" onclick="openSidebar()" aria-label="Open menu">
          <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        <button class="desktop-toggle-btn" onclick="toggleDesktopSidebar()" aria-label="Toggle sidebar">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h10M4 18h16" />
          </svg>
        </button>
      </div>

      <div class="topnav-right">
        <!-- Date/time prominent -->
        <div class="datetime-wrap">
          <span class="dt-time" id="topTime"></span>
          <span class="dt-date" id="topDate"></span>
        </div>

        <!-- Notifications -->
        <div style="position:relative">
          <button class="icon-btn" onclick="toggleDropdown('notifPanel')" aria-label="Notifications">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="badge">3</span>
          </button>
          <div class="dropdown-panel" id="notifPanel">
            <div class="dp-header">
              <h4>Notifications</h4><a href="#">Mark all read</a>
            </div>
            <div class="dp-body">
              <a href="#" class="dp-item">
                <div class="dp-item-icon" style="background:#FFF0F1"><svg fill="none" stroke="#C0202F" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg></div>
                <div class="dp-item-text">
                  <div class="dp-item-title">New announcement ready</div>
                  <div class="dp-item-meta">5 min ago</div>
                </div>
                <div class="dp-unread-dot"></div>
              </a>
              <a href="#" class="dp-item">
                <div class="dp-item-icon" style="background:#EFF6FF"><svg fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg></div>
                <div class="dp-item-text">
                  <div class="dp-item-title">Message from admin</div>
                  <div class="dp-item-meta">15 min ago</div>
                </div>
                <div class="dp-unread-dot"></div>
              </a>
            </div>
            <div class="dp-footer"><a href="#">View all</a></div>
          </div>
        </div>

        <!-- Messages -->
        <div style="position:relative">
          <button class="icon-btn" onclick="toggleDropdown('msgPanel')" aria-label="Messages">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <span class="badge">5</span>
          </button>
          <div class="dropdown-panel" id="msgPanel">
            <div class="dp-header">
              <h4>Messages</h4><a href="#">New message</a>
            </div>
            <div class="dp-body">
              <a href="#" class="dp-item">
                <div class="msg-av" style="background:linear-gradient(135deg,#C0202F,#9A1520)">JD</div>
                <div class="dp-item-text">
                  <div style="display:flex;justify-content:space-between"><span class="dp-item-title">John Doe</span><span class="dp-item-meta">2 min</span></div>
                  <div class="dp-item-meta">Content update requested…</div>
                </div>
                <div class="dp-unread-dot"></div>
              </a>
              <a href="#" class="dp-item">
                <div class="msg-av" style="background:linear-gradient(135deg,#3B82F6,#1D4ED8)">JS</div>
                <div class="dp-item-text">
                  <div style="display:flex;justify-content:space-between"><span class="dp-item-title">Jane Smith</span><span class="dp-item-meta">1 hr</span></div>
                  <div class="dp-item-meta">FAQ category ready</div>
                </div>
              </a>
            </div>
            <div class="dp-footer"><a href="#">View all</a></div>
          </div>
        </div>

        <!-- Profile -->
        <div style="position:relative">
          <button class="profile-btn" onclick="toggleDropdown('profilePanel')">
            <div class="profile-av">E<span class="online"></span></div>
            <span class="profile-name">Editor</span>
          </button>
          <div class="dropdown-panel narrow" id="profilePanel">
            <div style="padding:14px 16px;border-bottom:1px solid var(--red-border);">
              <div style="font-weight:700">Editor</div>
              <div style="font-size:11px;color:var(--text-muted)">editor@pudho-laguna.gov.ph</div>
            </div>
            <a href="#" class="profile-dp-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg> Profile</a>
            <a href="#" class="profile-dp-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              </svg> Settings</a>
            <div style="height:1px;background:var(--red-border);margin:4px 0"></div>
            <a href="{{ route('welcome') }}" class="profile-dp-item danger"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg> Logout</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main id="mainContent">
    @yield('content')
  </main>

  <script>
    let sidebarCollapsed = false;

    function toggleDesktopSidebar() {
      if (window.innerWidth < 1024) return;
      sidebarCollapsed = !sidebarCollapsed;
      document.getElementById('sidebar').classList.toggle('collapsed', sidebarCollapsed);
      document.getElementById('topNav').classList.toggle('sidebar-collapsed', sidebarCollapsed);
      document.getElementById('mainContent').classList.toggle('sidebar-collapsed', sidebarCollapsed);
    }

    function openSidebar() {
      document.getElementById('sidebar').classList.add('mobile-open');
      document.getElementById('sidebarOverlay').classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
      document.getElementById('sidebar').classList.remove('mobile-open');
      document.getElementById('sidebarOverlay').classList.remove('show');
      document.body.style.overflow = '';
    }

    function toggleNav(menuId, btn) {
      if (window.innerWidth >= 1024 && sidebarCollapsed) return;
      const menu = document.getElementById(menuId);
      const arrow = btn.querySelector('.nav-arrow');
      const isOpen = menu.classList.contains('open');
      document.querySelectorAll('.sub-menu.open').forEach(m => m.classList.remove('open'));
      document.querySelectorAll('.nav-arrow.open').forEach(a => a.classList.remove('open'));
      if (!isOpen) {
        menu.classList.add('open');
        if (arrow) arrow.classList.add('open');
      }
    }

    function toggleDropdown(id) {
      const panel = document.getElementById(id);
      const isOpen = panel.classList.contains('show');
      document.querySelectorAll('.dropdown-panel.show').forEach(p => p.classList.remove('show'));
      if (!isOpen) panel.classList.add('show');
    }

    document.addEventListener('click', function(e) {
      if (!e.target.closest('[onclick^="toggleDropdown"]') && !e.target.closest('.dropdown-panel')) {
        document.querySelectorAll('.dropdown-panel.show').forEach(p => p.classList.remove('show'));
      }
    });

    window.addEventListener('resize', function() {
      if (window.innerWidth >= 1024) closeSidebar();
    });

    // Update time
    function updateTime() {
      const now = new Date();
      let h = now.getHours(),
        m = now.getMinutes().toString().padStart(2, '0'),
        s = now.getSeconds().toString().padStart(2, '0');
      const ampm = h >= 12 ? 'PM' : 'AM';
      h = h % 12 || 12;
      document.getElementById('topTime').textContent = `${h}:${m}:${s} ${ampm}`;
      const dateOpts = {
        weekday: 'short',
        month: 'short',
        day: 'numeric',
        year: 'numeric'
      };
      document.getElementById('topDate').textContent = now.toLocaleDateString('en-US', dateOpts).toUpperCase();
    }
    updateTime();
    setInterval(updateTime, 1000);
  </script>

</body>

</html>