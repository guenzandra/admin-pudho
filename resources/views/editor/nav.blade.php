{{-- resources/views/layouts/nav.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PUDHO Editor — @yield('title', 'Dashboard')</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
      --red-deeper: #6B0A15;
      --sidebar-w: 268px;
      --topbar-h: 60px;
      --sb-bg: #B01D2A;
      --sb-text: rgba(255, 255, 255, 0.68);
      --sb-text-on: #ffffff;
      --sb-section: rgba(255, 255, 255, 0.35);
      --sb-div: rgba(255, 255, 255, 0.1);
      --sb-hover: rgba(255, 255, 255, 0.13);
      --sb-active: rgba(255, 255, 255, 0.16);
      --sb-user-bg: rgba(0, 0, 0, 0.15);
      --main-bg: #F6F1F2;
      --surface: #FFFFFF;
      --border: #EDE0E1;
      --text-primary: #1A0508;
      --text-secondary: #7A4A50;
      --text-muted: #B08888;
      --red-pale: rgba(255, 255, 255, 0.12);
      --red-pale2: rgba(255, 255, 255, 0.08);
      --red-border: rgba(255, 255, 255, 0.15);
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
      background: linear-gradient(180deg, #111827 0%, #0f172a 60%, #020617 100%);
      display: flex;
      flex-direction: column;
      z-index: 40;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
        width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;

      /* optional */
      border-right: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* subtle noise texture */
    #sidebar::after {
      content: '';
      position: absolute;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
    }

    #sidebar>* {
      position: relative;
      z-index: 1;
    }

    #sidebar.collapsed {
      width: 66px;
    }

    #sidebar.collapsed .nav-label,
    #sidebar.collapsed .nav-arrow,
    #sidebar.collapsed .section-label,
    #sidebar.collapsed .sub-menu,
    #sidebar.collapsed .user-info,
    #sidebar.collapsed .profile-dept {
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

    #sidebar.collapsed .sidebar-profile-area {
      justify-content: center;
      padding: 18px 0 16px;
    }

    @media (max-width:1023px) {
      #sidebar {
        transform: translateX(-100%);
        width: var(--sidebar-w) !important;
        box-shadow: 12px 0 40px rgba(0, 0, 0, 0.35);
      }

      #sidebar.mobile-open {
        transform: translateX(0);
      }

      #sidebar.collapsed .nav-label,
      #sidebar.collapsed .nav-arrow,
      #sidebar.collapsed .section-label,
      #sidebar.collapsed .sub-menu,
      #sidebar.collapsed .user-info,
      #sidebar.collapsed .profile-dept {
        opacity: 1;
        pointer-events: auto;
        width: auto;
        overflow: visible;
      }

      #sidebar.collapsed .nav-item {
        justify-content: flex-start;
        padding: 10px 14px;
      }

      #sidebar.collapsed .sidebar-profile-area {
        justify-content: flex-start;
        padding: 18px 18px 16px;
      }
    }

    /* ── Profile Area (top of sidebar) ── */
    .sidebar-profile-area {
      display: flex;
      align-items: center;
      gap: 13px;
      padding: 20px 18px 16px;
      transition: padding 0.3s, justify-content 0.3s;
      flex-shrink: 0;
    }

    .profile-avatar-sb {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.18);
      border: 2px solid rgba(255, 255, 255, 0.38);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-weight: 800;
      font-size: 16px;
      flex-shrink: 0;
      position: relative;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
    }

    .profile-avatar-sb .status-dot {
      position: absolute;
      bottom: 2px;
      right: 2px;
      width: 10px;
      height: 10px;
      background: #4ade80;
      border-radius: 50%;
      border: 2px solid rgba(255, 255, 255, 0.8);
    }

    .user-info {
      overflow: hidden;
      transition: opacity 0.25s, width 0.3s;
      min-width: 0;
    }

    .user-name-sb {
      font-size: 14px;
      font-weight: 800;
      color: #fff;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: 1.2;
    }

    .user-position {
      font-size: 11px;
      color: rgba(255, 255, 255, 0.91);
      white-space: nowrap;
      margin-top: 2px;
      font-weight: 500;
    }

    .profile-dept {
      margin-top: 5px;
      overflow: hidden;
      transition: opacity 0.25s;
    }

    .dept-badge {
      display: inline-flex;
      align-items: center;
      gap: -4px;
      padding: 0px 4px 1px 1px;
      font-size: 9.5px;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.85);
      letter-spacing: 0.02em;
      white-space: nowrap;
    }

    /* ── Divider ── */
    .sb-divider {
      height: 1px;
      background: rgba(255, 255, 255, 0.52);
      margin: 0 14px;
      flex-shrink: 0;
    }

    /* ── Nav scroll ── */
    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 8px 10px 10px;
      scrollbar-width: thin;
      scrollbar-color: rgba(199, 11, 11, 0.39) transparent;
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 3px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: rgba(199, 11, 11, 0.39) transparent;
      border-radius: 3px;
    }

    /* ── Section label ── */
    .section-label {
      font-size: 9px;
      font-weight: 800;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      color: rgba(199, 11, 11, 0.78);
      padding: 14px 10px 5px;
      white-space: nowrap;
      overflow: hidden;
      transition: opacity 0.25s;
    }

    /* ══ NAV ITEM — dome left, straight right ══ */
    .nav-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px 10px 14px;
      /* dome left = large left border-radius, straight right */
      border-radius: 50px 8px 8px 50px;
      cursor: pointer;
      text-decoration: none;
      color: rgb(255, 255, 255);
      font-size: 13px;
      font-weight: 500;
      white-space: nowrap;
      position: relative;
      overflow: hidden;
      border: none;
      background: none;
      font-family: 'Plus Jakarta Sans', sans-serif;
      width: 100%;
      text-align: left;
      transition: color 0.18s, background 0.22s;
      margin-bottom: 1px;
    }

    .nav-item:hover {
      background: rgba(199, 11, 11, 0.39);
      color: #fff;
    }

    .nav-item.active {
      background: rgba(199, 11, 11, 0.39);
      color: #fff;
      font-weight: 700;
    }

    /* right-edge active pill */
    .nav-item.active::after {
      content: '';
      position: absolute;
      right: 0;
      top: 18%;
      bottom: 18%;
      width: 3px;
      background: rgba(255, 255, 255, 0.85);
      border-radius: 3px 0 0 3px;
    }

    .nav-icon {
      width: 17px;
      height: 17px;
      flex-shrink: 0;
      opacity: 0.7;
      transition: opacity 0.18s;
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
      color: rgba(255, 255, 255, 0.45);
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
      padding: 8px 14px 8px 40px;
      border-radius: 50px 8px 8px 50px;
      font-size: 12.5px;
      color: rgba(255, 255, 255, 0.55);
      text-decoration: none;
      transition: color 0.15s, background 0.18s;
      white-space: nowrap;
      font-weight: 500;
      position: relative;
      margin-bottom: 1px;
    }

    .sub-item:hover {
      color: #fff;
      background: rgba(255, 255, 255, 0.12);
    }

    .sub-item.active {
      color: #fff;
      font-weight: 700;
      background: rgba(255, 255, 255, 0.14);
    }

    .sub-dot {
      position: absolute;
      left: 22px;
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      transition: background 0.15s;
    }

    .sub-item:hover .sub-dot,
    .sub-item.active .sub-dot {
      background: rgba(255, 255, 255, 0.85);
    }

    /* ── Sidebar bottom strip ── */
    .sidebar-bottom {
      flex-shrink: 0;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding: 12px 14px;
      display: flex;
      align-items: center;
      gap: 8px;
      background: rgba(0, 0, 0, 0.12);
    }

    .sb-bottom-icon {
      width: 28px;
      height: 28px;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.15);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.15s;
      color: rgba(255, 255, 255, 0.7);
      flex-shrink: 0;
    }

    .sb-bottom-icon:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
    }

    .sb-bottom-icon svg {
      width: 14px;
      height: 14px;
    }

    .sb-version {
      font-size: 10px;
      color: rgba(255, 255, 255, 0.28);
      font-weight: 600;
      margin-left: auto;
      white-space: nowrap;
      transition: opacity 0.25s;
    }

    #sidebar.collapsed .sb-version,
    #sidebar.collapsed .sidebar-bottom .sb-bottom-icon:not(:first-child) {
      display: none;
    }

    /* ════════════════════════════
       OVERLAY (mobile)
    ════════════════════════════ */
    #sidebarOverlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.55);
      z-index: 39;
      backdrop-filter: blur(4px);
    }

    #sidebarOverlay.show {
      display: block;
    }

    /* ════════════════════════════
       TOP NAV — RED
    ════════════════════════════ */
    #topNav {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: var(--topbar-h);
      background: linear-gradient(90deg, #571616, #7f1d1d);
      border-bottom: 1px solid rgba(0, 0, 0, 0.15);
      z-index: 30;
      display: flex;
      align-items: center;
      transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 2px 20px rgba(140, 17, 30, 0.4);
    }

    #topNav.sidebar-collapsed {
      left: 66px;
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
      padding: 0 20px;
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
      gap: 2px;
    }

    /* ── Arrow-style hamburger (arrow sticks on panel edge) ── */
    .hamburger-btn {
      display: none;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      cursor: pointer;
      color: #fff;
      padding: 0;
      width: 36px;
      height: 36px;
      border-radius: 9px;
      transition: background 0.15s;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .hamburger-btn:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    @media (max-width:1023px) {
      .hamburger-btn {
        display: flex;
      }
    }

    /* Desktop toggle: arrow that points left/right */
    .desktop-toggle-btn {
      display: flex;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      cursor: pointer;
      color: #fff;
      padding: 0;
      width: 36px;
      height: 36px;
      border-radius: 9px;
      align-items: center;
      justify-content: center;
      transition: background 0.18s;
      flex-shrink: 0;
    }

    .desktop-toggle-btn:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    @media (max-width:1023px) {
      .desktop-toggle-btn {
        display: none;
      }
    }

    /* Arrow icon SVGs inside toggle buttons */
    .toggle-arrow {
      width: 18px;
      height: 18px;
      transition: transform 0.3s;
    }

    /* When collapsed, flip arrow direction */
    .arrow-collapsed {
      transform: rotate(180deg);
    }

    /* breadcrumb */
    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      color: rgba(255, 255, 255, 0.65);
      font-weight: 500;
      margin-left: 2px;
    }

    .breadcrumb strong {
      color: #fff;
      font-weight: 700;
    }

    .breadcrumb .bc-sep {
      color: rgba(255, 255, 255, 0.35);
      font-size: 15px;
    }

    /* clock */
    .datetime-wrap {
      display: none;
      flex-direction: column;
      align-items: flex-end;
      padding-right: 16px;
      margin-right: 4px;
      border-right: 1.5px solid rgba(255, 255, 255, 0.2);
      gap: 1px;
    }

    @media (min-width:768px) {
      .datetime-wrap {
        display: flex;
      }
    }

    .dt-time {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #fff;
      line-height: 1;
      letter-spacing: -0.01em;
    }

    .dt-date {
      font-size: 10px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.6);
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }

    /* icon buttons — white style */
    .icon-btn {
      position: relative;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.15);
      cursor: pointer;
      color: rgba(255, 255, 255, 0.85);
      padding: 8px;
      border-radius: 9px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.15s, color 0.15s;
      margin: 0 2px;
    }

    .icon-btn:hover {
      background: rgba(255, 255, 255, 0.22);
      color: #fff;
    }

    .icon-btn svg {
      width: 19px;
      height: 19px;
    }

    .badge {
      position: absolute;
      top: 3px;
      right: 3px;
      min-width: 16px;
      height: 16px;
      background: #fff;
      border-radius: 8px;
      color: var(--red);
      font-size: 9px;
      font-weight: 800;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 3px;
      border: 2px solid rgba(192, 32, 47, 0.6);
    }

    /* profile btn */
    .profile-btn {
      display: flex;
      align-items: center;
      gap: 9px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      cursor: pointer;
      padding: 5px 12px 5px 5px;
      border-radius: 30px;
      transition: background 0.15s;
      margin-left: 6px;
    }

    .profile-btn:hover {
      background: rgba(255, 255, 255, 0.22);
    }

    .profile-av {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.22);
      border: 1.5px solid rgba(255, 255, 255, 0.4);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 12px;
      font-weight: 800;
      position: relative;
      flex-shrink: 0;
    }

    .profile-av .online {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 9px;
      height: 9px;
      background: #22c55e;
      border-radius: 50%;
      border: 2px solid #C0202F;
    }

    .profile-name {
      font-size: 13px;
      font-weight: 700;
      color: #fff;
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
      top: calc(100% + 10px);
      right: 0;
      width: 310px;
      background: #fff;
      border: 1px solid #F0D8DA;
      border-radius: 14px;
      box-shadow: 0 12px 48px rgba(140, 17, 30, 0.18), 0 2px 10px rgba(0, 0, 0, 0.06);
      z-index: 100;
      overflow: hidden;
      display: none;
      animation: dropIn 0.18s ease;
    }

    .dropdown-panel.show {
      display: block;
    }

    .dropdown-panel.narrow {
      width: 230px;
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
      border-bottom: 1px solid #F5E0E2;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #FEF0F1;
    }

    .dp-header h4 {
      font-size: 13px;
      font-weight: 700;
      color: #1A0508;
    }

    .dp-header a {
      font-size: 11.5px;
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
      border-bottom: 1px solid #FEF0F1;
      text-decoration: none;
      transition: background 0.12s;
    }

    .dp-item:hover {
      background: #FEF0F1;
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
      color: #1A0508;
      font-weight: 500;
      line-height: 1.35;
    }

    .dp-item-meta {
      font-size: 11px;
      color: #B08888;
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
      border-top: 1px solid #F5E0E2;
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
      color: #7A4A50;
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
      background: #FEF0F1;
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
      margin-left: 66px;
    }

    @media (max-width:1023px) {
      #mainContent {
        margin-left: 0 !important;
        padding: 18px;
      }
    }

    /* ── Manage Services badge ── */
    .nav-badge {
      margin-left: auto;
      background: rgba(255, 255, 255, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 20px;
      padding: 1px 7px;
      font-size: 10px;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.85);
      white-space: nowrap;
    }
  </style>
</head>

<body>

  <div id="sidebarOverlay" onclick="closeSidebar()"></div>

  <aside id="sidebar">

    <!-- Profile Area (replaces logo) -->
    <div class="sidebar-profile-area">
      <div class="profile-avatar-sb">
        E
        <span class="status-dot"></span>
      </div>
      <div class="user-info">
        <div class="user-name-sb">
          {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </div>
        <div class="user-position">
          {{ Auth::user()->position ?: 'Content Editor' }}
        </div>
        <div class="profile-dept">
          <span class="dept-badge">
            <span class="dept-badge-dot"></span>
            P.U.D.H.O - Laguna
          </span>
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

      <!-- <a href="{{ route('editor.images') }}"
        class="nav-item {{ request()->routeIs('editor.images') ? 'active' : '' }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="nav-label">Images</span>
      </a> -->

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
        <a href="{{ route('editor.settings.general-settings') }}" class="sub-item {{ request()->routeIs('editor.settings.general-settings') ? 'active' : '' }}"><span class="sub-dot"></span>General Settings</a>
        <a href="{{ route('editor.settings.notifications') }}" class="sub-item {{ request()->routeIs('editor.settings.notifications') ? 'active' : '' }}"><span class="sub-dot"></span>Notifications</a>
        <a href="{{ route('editor.settings.content-preferences') }}" class="sub-item {{ request()->routeIs('editor.settings.content-preferences') ? 'active' : '' }}"><span class="sub-dot"></span>Content Preferences</a>
        <a href="{{ route('editor.settings.help-guide') }}" class="sub-item {{ request()->routeIs('editor.settings.help-guide') ? 'active' : '' }}"><span class="sub-dot"></span>Help / User Guide</a>
      </div>

    </nav>

    <!-- Bottom strip -->
    <div class="sidebar-bottom">
      <div class="sb-bottom-icon" title="Dark mode" onclick="toggleDarkMode()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" id="dmIcon">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
      </div>
      <span class="sb-version">PUDHO v2.0</span>
    </div>

  </aside>

  <!-- ════ TOP NAV ════ -->
  <header id="topNav">
    <div class="topnav-inner">
      <div class="topnav-left">

        <!-- Mobile hamburger -->
        <button class="hamburger-btn" onclick="openSidebar()" aria-label="Open menu">
          <!-- arrow pointing right (into the panel) -->
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
          </svg>
        </button>

        <!-- Desktop collapse/expand toggle — arrow pointing left to collapse, right to expand -->
        <button class="desktop-toggle-btn" id="desktopToggleBtn" onclick="toggleDesktopSidebar()" aria-label="Toggle sidebar">
          <svg class="toggle-arrow" id="toggleArrowIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <div class="breadcrumb">
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
            <div style="padding:14px 16px 11px; border-bottom:1px solid #F5E0E2;">
              <div style="font-size:14px;font-weight:700;color:#1A0508">
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
              </div>
              <div style="font-size:11px;color:#B08888;margin-top:1px">
                @php
                $roles = [
                1 => 'Administrator',
                2 => 'Editor',
                3 => 'Staff',
                4 => 'App User'
                ];
                $position = Auth::user()->position ?? $roles[Auth::user()->role_no] ?? 'Content Editor';
                @endphp
                {{ $position }}
              </div>
              <div style="font-size:11px;color:#B08888;margin-top:1px">
                {{ Auth::user()->email }}
              </div>
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
            <div style="height:1px;background:#F5E0E2;margin:4px 0"></div>
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

      // Flip the arrow icon direction
      const arrowIcon = document.getElementById('toggleArrowIcon');
      if (sidebarCollapsed) {
        // Arrow pointing right = expand
        arrowIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>';
      } else {
        // Arrow pointing left = collapse
        arrowIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>';
      }
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
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
      } else {
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
      }
    }
  </script>

</body>

</html>