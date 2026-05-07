{{-- resources/views/layouts/nav.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PUDHO Editor — @yield('title', 'Dashboard')</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
      --sidebar-w: 260px;
      --topbar-h: 64px;
      --sb-bg: #C0202F;
      /* sidebar background (light) */
      --sb-text: rgba(255, 255, 255, 0.72);
      --sb-text-on: #ffffff;
      --sb-section: rgba(255, 255, 255, 0.38);
      --sb-div: rgba(255, 255, 255, 0.12);
      --sb-hover: rgba(255, 255, 255, 0.13);
      --sb-active: rgba(255, 255, 255, 0.18);
      --sb-user-bg: rgba(0, 0, 0, 0.12);
      --main-bg: #F6F1F2;
      --surface: #FFFFFF;
      --border: #EDE0E1;
      --text-primary: #1A0508;
      --text-secondary: #7A4A50;
      --text-muted: #B08888;
      --red-pale: #FEF0F1;
      --red-pale2: #FDE8EA;
      --red-border: #F3CACE;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--main-bg);
      color: var(--text-primary);
      transition: background 0.35s, color 0.3s;
    }

    /* ════════════════════════════
       SIDEBAR
    ════════════════════════════ */
    #sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--sb-bg);
      display: flex;
      flex-direction: column;
      z-index: 40;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
        width 0.3s cubic-bezier(0.4, 0, 0.2, 1),
        background 0.35s;
      overflow: hidden;
    }

    /* top-right decorative orb */
    #sidebar::before {
      content: '';
      position: absolute;
      top: -60px;
      right: -60px;
      width: 180px;
      height: 180px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.06);
      pointer-events: none;
    }

    #sidebar.collapsed {
      width: 70px;
    }

    #sidebar.collapsed .nav-label,
    #sidebar.collapsed .nav-arrow,
    #sidebar.collapsed .sidebar-brand-text,
    #sidebar.collapsed .section-label,
    #sidebar.collapsed .sub-menu {
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

    @media (max-width:1023px) {
      #sidebar {
        transform: translateX(-100%);
        width: var(--sidebar-w) !important;
        box-shadow: 8px 0 32px rgba(0, 0, 0, 0.25);
      }

      #sidebar.mobile-open {
        transform: translateX(0);
      }

      /* restore collapsed styles on mobile */
      #sidebar.collapsed .nav-label,
      #sidebar.collapsed .nav-arrow,
      #sidebar.collapsed .sidebar-brand-text,
      #sidebar.collapsed .section-label,
      #sidebar.collapsed .sub-menu {
        opacity: 1;
        pointer-events: auto;
        width: auto;
        overflow: visible;
      }

      #sidebar.collapsed .nav-item {
        justify-content: flex-start;
        padding: 10px 12px;
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

    /* ── Brand ── */
    .sidebar-brand {
      flex-shrink: 0;
    }

    .logo-area {
      display: flex;
      align-items: center;
      gap: 13px;
      padding: 18px 18px 14px;
      cursor: pointer;
      position: relative;
      z-index: 1;
      transition: padding 0.3s;
    }

    .logo-img {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      border: 1.5px solid rgba(255, 255, 255, 0.3);
      background: rgba(255, 255, 255, 0.12);
      object-fit: cover;
      flex-shrink: 0;
      transition: transform 0.3s;
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
    }

    .brand-name span {
      color: rgba(255, 255, 255, 0.6);
      font-weight: 500;
    }

    .brand-tagline {
      font-size: 10px;
      color: rgba(255, 255, 255, 0.45);
      white-space: nowrap;
      margin-top: 3px;
      letter-spacing: 0.02em;
    }

    /* ── Divider ── */
    .sb-divider {
      height: 1px;
      background: var(--sb-div);
      margin: 0 14px;
      flex-shrink: 0;
    }

    /* ── Nav scroll ── */
    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 10px 12px;
      scrollbar-width: thin;
      scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 3px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 3px;
    }

    /* ── Section label ── */
    .section-label {
      font-size: 9.5px;
      font-weight: 700;
      letter-spacing: 0.13em;
      text-transform: uppercase;
      color: var(--sb-section);
      padding: 14px 8px 5px;
      white-space: nowrap;
      overflow: hidden;
      transition: opacity 0.25s;
    }

    /* ══ NAV ITEM — ARC HOVER ══ */
    .nav-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      color: var(--sb-text);
      font-size: 13.5px;
      font-weight: 500;
      transition: color 0.18s;
      white-space: nowrap;
      position: relative;
      overflow: hidden;
      border: none;
      background: none;
      font-family: 'Plus Jakarta Sans', sans-serif;
      width: 100%;
      text-align: left;
    }

    /* The arc bubble */
    .nav-item::before {
      content: '';
      position: absolute;
      top: 50%;
      left: -100%;
      transform: translateY(-50%);
      width: 220%;
      height: 220%;
      border-radius: 50%;
      background: var(--sb-hover);
      transition: left 0.38s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s;
      opacity: 0;
      pointer-events: none;
    }

    .nav-item:hover::before {
      left: -55%;
      opacity: 1;
    }

    .nav-item.active::before {
      left: -55%;
      opacity: 1;
      background: var(--sb-active);
    }

    /* right-edge active pill */
    .nav-item.active::after {
      content: '';
      position: absolute;
      right: 0;
      top: 20%;
      bottom: 20%;
      width: 3.5px;
      background: rgba(255, 255, 255, 0.8);
      border-radius: 3px 0 0 3px;
    }

    .nav-item:hover {
      color: var(--sb-text-on);
    }

    .nav-item.active {
      color: var(--sb-text-on);
      font-weight: 600;
    }

    .nav-icon {
      width: 17px;
      height: 17px;
      flex-shrink: 0;
      opacity: 0.72;
      transition: opacity 0.18s, margin 0.3s;
    }

    .nav-item:hover .nav-icon,
    .nav-item.active .nav-icon {
      opacity: 1;
    }

    .nav-label {
      flex: 1;
      overflow: hidden;
      transition: opacity 0.25s;
    }

    .nav-arrow {
      width: 13px;
      height: 13px;
      flex-shrink: 0;
      color: rgba(255, 255, 255, 0.5);
      transition: transform 0.22s, opacity 0.25s;
    }

    .nav-item:hover .nav-arrow {
      opacity: 0.9;
    }

    .nav-arrow.open {
      transform: rotate(180deg);
    }

    /* ── Sub-menu ── */
    .sub-menu {
      overflow: hidden;
      max-height: 0;
      transition: max-height 0.3s ease, opacity 0.25s;
      opacity: 0;
    }

    .sub-menu.open {
      max-height: 320px;
      opacity: 1;
    }

    .sub-item {
      display: flex;
      align-items: center;
      padding: 8px 14px 8px 42px;
      border-radius: 8px;
      font-size: 13px;
      color: rgba(255, 255, 255, 0.58);
      text-decoration: none;
      transition: color 0.15s;
      white-space: nowrap;
      font-weight: 500;
      position: relative;
      overflow: hidden;
    }

    /* arc on sub-items too */
    .sub-item::before {
      content: '';
      position: absolute;
      top: 50%;
      left: -80%;
      transform: translateY(-50%);
      width: 180%;
      height: 200%;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.07);
      transition: left 0.32s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s;
      opacity: 0;
    }

    .sub-item:hover::before {
      left: -20%;
      opacity: 1;
    }

    .sub-item:hover {
      color: #fff;
    }

    .sub-item.active {
      color: #fff;
      font-weight: 600;
    }

    .sub-dot {
      position: absolute;
      left: 24px;
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.38);
      transition: background 0.15s;
    }

    .sub-item:hover .sub-dot,
    .sub-item.active .sub-dot {
      background: rgba(255, 255, 255, 0.9);
    }

    /* ── User strip ── */
    .sidebar-user {
      flex-shrink: 0;
      border-top: 1px solid var(--sb-div);
      padding: 14px 14px;
      display: flex;
      align-items: center;
      gap: 10px;
      background: var(--sb-user-bg);
      overflow: hidden;
      transition: padding 0.3s, background 0.35s;
    }

    .user-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.18);
      border: 1.5px solid rgba(255, 255, 255, 0.32);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-weight: 700;
      font-size: 13px;
      flex-shrink: 0;
      position: relative;
    }

    .online-dot {
      position: absolute;
      bottom: 1px;
      right: 1px;
      width: 9px;
      height: 9px;
      background: #4ade80;
      border-radius: 50%;
      border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .user-name {
      font-size: 13px;
      font-weight: 700;
      color: #fff;
      white-space: nowrap;
    }

    .user-role {
      font-size: 10.5px;
      color: rgba(255, 255, 255, 0.48);
      white-space: nowrap;
      margin-top: 1px;
    }

    /* Dark-mode toggle button inside sidebar */
    .dm-toggle-btn {
      margin-left: auto;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 30px;
      height: 30px;
      border-radius: 8px;
      border: none;
      background: rgba(255, 255, 255, 0.12);
      cursor: pointer;
      transition: background 0.18s;
      color: rgba(255, 255, 255, 0.8);
    }

    .dm-toggle-btn:hover {
      background: rgba(255, 255, 255, 0.22);
    }

    .dm-toggle-btn svg {
      width: 15px;
      height: 15px;
    }

    /* ════════════════════════════
       OVERLAY (mobile)
    ════════════════════════════ */
    #sidebarOverlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 39;
      backdrop-filter: blur(3px);
    }

    #sidebarOverlay.show {
      display: block;
    }

    /* ════════════════════════════
       TOP NAV
    ════════════════════════════ */
    #topNav {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: var(--topbar-h);
      background: var(--surface);
      border-bottom: 1px solid var(--red-border);
      z-index: 30;
      display: flex;
      align-items: center;
      transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1), background 0.35s, border-color 0.35s;
      box-shadow: 0 1px 16px rgba(192, 32, 47, 0.05);
    }

    /* slim red top line */
    #topNav::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--red-dark) 0%, var(--red) 60%, rgba(220, 100, 112, 0.4) 100%);
    }

    #topNav.sidebar-collapsed {
      left: 70px;
    }

    @media (max-width:1023px) {
      #topNav {
        left: 0 !important;
      }
    }

    .topnav-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      padding: 0 22px;
      gap: 12px;
    }

    .topnav-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .topnav-right {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    /* hamburger / desktop toggle */
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

    @media (max-width:1023px) {
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
      align-items: center;
      justify-content: center;
      transition: background 0.15s, color 0.15s;
    }

    .desktop-toggle-btn:hover {
      background: var(--red-pale);
      color: var(--red);
    }

    @media (max-width:1023px) {
      .desktop-toggle-btn {
        display: none;
      }
    }

    /* breadcrumb */
    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 12.5px;
      color: var(--text-muted);
      font-weight: 500;
      margin-left: 4px;
    }

    .breadcrumb strong {
      color: var(--text-primary);
      font-weight: 700;
    }

    .breadcrumb .bc-sep {
      color: var(--red-border);
    }

    /* clock */
    .datetime-wrap {
      display: none;
      flex-direction: column;
      align-items: flex-end;
      padding-right: 16px;
      margin-right: 4px;
      border-right: 1.5px solid var(--red-border);
      gap: 1px;
      transition: border-color 0.35s;
    }

    @media (min-width:768px) {
      .datetime-wrap {
        display: flex;
      }
    }

    .dt-time {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 17px;
      font-weight: 700;
      color: var(--red);
      line-height: 1;
      letter-spacing: -0.01em;
    }

    .dt-date {
      font-size: 10.5px;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
    }

    /* icon buttons */
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
      color: #fff;
      font-size: 9px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 3px;
      border: 2px solid var(--surface);
    }

    /* profile btn */
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
      color: #fff;
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
      border: 2px solid var(--surface);
    }

    .profile-name {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--text-primary);
      display: none;
    }

    @media (min-width:640px) {
      .profile-name {
        display: block;
      }
    }

    /* dropdowns */
    .dropdown-panel {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      width: 310px;
      background: var(--surface);
      border: 1px solid var(--red-border);
      border-radius: 14px;
      box-shadow: 0 10px 40px rgba(192, 32, 47, 0.12), 0 2px 10px rgba(0, 0, 0, 0.05);
      z-index: 100;
      overflow: hidden;
      display: none;
      animation: dropIn 0.18s ease;
      transition: background 0.35s, border-color 0.35s;
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
      background: var(--red-pale);
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

    .dp-header a:hover {
      text-decoration: underline;
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
      border-bottom: 1px solid var(--red-pale);
      text-decoration: none;
      transition: background 0.12s;
    }

    .dp-item:hover {
      background: var(--red-pale);
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

    .dp-footer a:hover {
      text-decoration: underline;
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
      font-family: 'Plus Jakarta Sans', sans-serif;
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
      color: #fff;
      font-size: 12px;
      font-weight: 700;
      flex-shrink: 0;
    }

    /* ════════════════════════════
       MAIN CONTENT
    ════════════════════════════ */
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

    @media (max-width:1023px) {
      #mainContent {
        margin-left: 0 !important;
        padding: 18px;
      }
    }
  </style>
</head>

<body>

  <div id="sidebarOverlay" onclick="closeSidebar()"></div>

  <aside id="sidebar">

    <!-- Brand -->
    <div class="sidebar-brand">
      <div class="logo-area" onclick="toggleDesktopSidebar()" title="Toggle sidebar">
        <img src="{{ asset('build/assets/images/logo-pudho.jpg') }}" alt="PUDHO" class="logo-img"
          onerror="this.src='https://via.placeholder.com/40x40/ffffff/C0202F?text=P'">
        <div class="sidebar-brand-text">
          <div class="brand-name"><span>LAGUNA</span> PUDHO</div>
          <div class="brand-tagline">Urban Development & Housing</div>
        </div>
      </div>
    </div>

    <div class="sb-divider"></div>

    <!-- Navigation -->
    <nav class="sidebar-nav">

      <div class="section-label">Main</div>

      <a href="{{ route('editor.editorDashboard') }}"
        class="nav-item {{ request()->routeIs('editor.editorDashboard') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="nav-label">Dashboard</span>
      </a>

      <div class="section-label">Content</div>

      <a href="{{ route('editor.announcements') }}"
        class="nav-item {{ request()->routeIs('editor.announcements') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
        </svg>
        <span class="nav-label">Announcements</span>
      </a>

      <a href="{{ route('editor.news') }}"
        class="nav-item {{ request()->routeIs('editor.news') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
        </svg>
        <span class="nav-label">News & Accomplishments</span>
      </a>

      <a href="{{ route('editor.images') }}"
        class="nav-item {{ request()->routeIs('editor.images') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="nav-label">Images</span>
      </a>

      <a href="{{ route('editor.documents') }}"
        class="nav-item {{ request()->routeIs('editor.documents') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
        </svg>
        <span class="nav-label">Documents</span>
      </a>

      <div class="section-label">Pages & Services</div>

      <button class="nav-item {{ request()->routeIs('editor.vision-mission-values','editor.organizational-structure','editor.district-offices','editor.affiliated-offices','editor.citizens-charter') ? 'active' : '' }}"
        onclick="toggleNav('pageMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <span class="nav-label">Page Management</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.vision-mission-values','editor.organizational-structure','editor.district-offices','editor.affiliated-offices','editor.citizens-charter') ? 'open' : '' }}"
          fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.vision-mission-values','editor.organizational-structure','editor.district-offices','editor.affiliated-offices','editor.citizens-charter') ? 'open' : '' }}" id="pageMenu">
        <a href="{{ route('editor.vision-mission-values') }}" class="sub-item {{ request()->routeIs('editor.vision-mission-values') ? 'active' : '' }}"><span class="sub-dot"></span>Vision, Mission & Values</a>
        <a href="{{ route('editor.organizational-structure') }}" class="sub-item {{ request()->routeIs('editor.organizational-structure') ? 'active' : '' }}"><span class="sub-dot"></span>Organizational Structure</a>
        <a href="{{ route('editor.district-offices') }}" class="sub-item {{ request()->routeIs('editor.district-offices') ? 'active' : '' }}"><span class="sub-dot"></span>District Offices</a>
        <a href="{{ route('editor.affiliated-offices') }}" class="sub-item {{ request()->routeIs('editor.affiliated-offices') ? 'active' : '' }}"><span class="sub-dot"></span>Affiliated Offices</a>
        <a href="{{ route('editor.citizens-charter') }}" class="sub-item {{ request()->routeIs('editor.citizens-charter') ? 'active' : '' }}"><span class="sub-dot"></span>Citizen's Charter</a>
      </div>

      <a href="{{ route('editor.manage-services') }}"
        class="nav-item {{ request()->routeIs('editor.manage-services') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <span class="nav-label">Manage Services</span>
      </a>

      <div class="section-label">Resources</div>

      <a href="{{ route('editor.manage-faqs') }}"
        class="nav-item {{ request()->routeIs('editor.manage-faqs') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="nav-label">Manage FAQs</span>
      </a>

      <a href="{{ route('editor.faq-categories') }}"
        class="nav-item {{ request()->routeIs('editor.faq-categories') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
        </svg>
        <span class="nav-label">FAQ Categories</span>
      </a>

      <a href="{{ route('editor.downloadable-forms') }}"
        class="nav-item {{ request()->routeIs('editor.downloadable-forms') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <span class="nav-label">Downloadable Forms</span>
      </a>

      <a href="{{ route('editor.form-categories') }}"
        class="nav-item {{ request()->routeIs('editor.form-categories') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
        </svg>
        <span class="nav-label">Form Categories</span>
      </a>

      <div class="section-label">Configuration</div>

      <button class="nav-item {{ request()->routeIs('editor.settings.notifications','editor.settings.content-preferences','editor.settings.help-guide') ? 'active' : '' }}"
        onclick="toggleNav('settingsMenu', this)">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="nav-label">Settings</span>
        <svg class="nav-arrow {{ request()->routeIs('editor.settings.notifications','editor.settings.content-preferences','editor.settings.help-guide') ? 'open' : '' }}"
          fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="sub-menu {{ request()->routeIs('editor.settings.notifications','editor.settings.content-preferences','editor.settings.help-guide') ? 'open' : '' }}" id="settingsMenu">
        <a href="{{ route('editor.settings.notifications') }}" class="sub-item {{ request()->routeIs('editor.settings.notifications') ? 'active' : '' }}"><span class="sub-dot"></span>Notifications</a>
        <a href="{{ route('editor.settings.content-preferences') }}" class="sub-item {{ request()->routeIs('editor.settings.content-preferences') ? 'active' : '' }}"><span class="sub-dot"></span>Content Preferences</a>
        <a href="{{ route('editor.settings.help-guide') }}" class="sub-item {{ request()->routeIs('editor.settings.help-guide') ? 'active' : '' }}"><span class="sub-dot"></span>Help / User Guide</a>
      </div>

    </nav>

  </aside>

  <!-- ════ TOP NAV ════ -->
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
        <div class="breadcrumb">
          <span>PUDHO</span>
          <span class="bc-sep">›</span>
          <strong>@yield('title', 'Dashboard')</strong>
        </div>
      </div>

      <div class="topnav-right">
        <div class="datetime-wrap">
          <span class="dt-time" id="topTime"></span>
          <span class="dt-date" id="topDate"></span>
        </div>

        <!-- Notifications -->
        <div style="position:relative">
          <button class="icon-btn" onclick="toggleDropdown('notifPanel')" aria-label="Notifications">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
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
                  <div class="dp-item-meta">5 minutes ago</div>
                </div>
                <div class="dp-unread-dot"></div>
              </a>
              <a href="#" class="dp-item">
                <div class="dp-item-icon" style="background:#EFF6FF"><svg fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg></div>
                <div class="dp-item-text">
                  <div class="dp-item-title">Message from admin</div>
                  <div class="dp-item-meta">15 minutes ago</div>
                </div>
                <div class="dp-unread-dot"></div>
              </a>
              <a href="#" class="dp-item">
                <div class="dp-item-icon" style="background:#F0FDF4"><svg fill="none" stroke="#22C55E" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg></div>
                <div class="dp-item-text">
                  <div class="dp-item-title">Content published successfully</div>
                  <div class="dp-item-meta">1 hour ago</div>
                </div>
              </a>
            </div>
            <div class="dp-footer"><a href="#">View all notifications</a></div>
          </div>
        </div>

        <!-- Messages -->
        <div style="position:relative">
          <button class="icon-btn" onclick="toggleDropdown('msgPanel')" aria-label="Messages">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
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
                  <div style="display:flex;justify-content:space-between;align-items:center">
                    <div class="dp-item-title" style="font-weight:600">John Doe</div>
                    <div class="dp-item-meta">2 min</div>
                  </div>
                  <div class="dp-item-meta" style="margin-top:2px">Content update requested…</div>
                </div>
                <div class="dp-unread-dot" style="margin-top:6px"></div>
              </a>
              <a href="#" class="dp-item">
                <div class="msg-av" style="background:linear-gradient(135deg,#3B82F6,#1D4ED8)">JS</div>
                <div class="dp-item-text">
                  <div style="display:flex;justify-content:space-between;align-items:center">
                    <div class="dp-item-title" style="font-weight:600">Jane Smith</div>
                    <div class="dp-item-meta">1 hr</div>
                  </div>
                  <div class="dp-item-meta" style="margin-top:2px">FAQ category ready</div>
                </div>
              </a>
            </div>
            <div class="dp-footer"><a href="#">View all messages</a></div>
          </div>
        </div>

        <!-- Profile -->
        <div style="position:relative">
          <button class="profile-btn" onclick="toggleDropdown('profilePanel')">
            <div class="profile-av">E<span class="online"></span></div>
            <span class="profile-name">Editor</span>
          </button>
          <div class="dropdown-panel narrow" id="profilePanel">
            <div style="padding:14px 16px 11px; border-bottom:1px solid var(--red-border);">
              <div style="font-size:14px;font-weight:700;color:var(--text-primary)">Editor</div>
              <div style="font-size:11.5px;color:var(--text-muted);margin-top:2px">editor@pudho-laguna.gov.ph</div>
            </div>
            <a href="#" class="profile-dp-item">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              My Profile
            </a>
            <a href="#" class="profile-dp-item">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              Settings
            </a>
            <div style="height:1px;background:var(--red-border);margin:4px 0"></div>
            <a href="{{ route('welcome') }}" class="profile-dp-item danger">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              Logout
            </a>
          </div>
        </div>

      </div>
    </div>
  </header>

  <main id="mainContent">
    @yield('content')
  </main>

  <script>
    /* ── sidebar collapse ── */
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
    window.addEventListener('resize', () => {
      if (window.innerWidth >= 1024) closeSidebar();
    });

    /* ── sub-menus ── */
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

    /* ── top-nav dropdowns ── */
    function toggleDropdown(id) {
      const panel = document.getElementById(id);
      const isOpen = panel.classList.contains('show');
      document.querySelectorAll('.dropdown-panel.show').forEach(p => p.classList.remove('show'));
      if (!isOpen) panel.classList.add('show');
    }
    document.addEventListener('click', e => {
      if (!e.target.closest('[onclick^="toggleDropdown"]') && !e.target.closest('.dropdown-panel'))
        document.querySelectorAll('.dropdown-panel.show').forEach(p => p.classList.remove('show'));
    });

    /* ── clock ── */
    function updateTime() {
      const now = new Date();
      let h = now.getHours(),
        m = now.getMinutes().toString().padStart(2, '0'),
        s = now.getSeconds().toString().padStart(2, '0');
      const ampm = h >= 12 ? 'PM' : 'AM';
      h = h % 12 || 12;
      document.getElementById('topTime').textContent = `${h}:${m}:${s} ${ampm}`;
      document.getElementById('topDate').textContent = now.toLocaleDateString('en-US', {
        weekday: 'short',
        month: 'short',
        day: 'numeric',
        year: 'numeric'
      }).toUpperCase();
    }
    updateTime();
    setInterval(updateTime, 1000);

    /* ── dark mode ── */
    const DARK_KEY = 'pudho_dark_mode';
    let darkMode = localStorage.getItem(DARK_KEY) === '1';
    applyDark(darkMode);

    function toggleDarkMode() {
      darkMode = !darkMode;
      localStorage.setItem(DARK_KEY, darkMode ? '1' : '0');
      applyDark(darkMode);
    }

    function applyDark(on) {
      document.body.classList.toggle('dark-mode', on);
      const icon = document.getElementById('dmIcon');
      if (on) {
        // sun icon
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
      } else {
        // moon icon
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
      }
    }
  </script>

</body>

</html>