@extends('admin.layout')

@section('content')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0
  }

  .ntf-wrap {
    font-family: Arial, sans-serif;
    padding: 24px 20px;
    max-width: 1100px;
    margin: 0 auto
  }

  .ntf-wrap * {
    font-family: Arial, sans-serif
  }

  :root {
    --ntf-red: #C0392B;
    --ntf-red-h: #a93226;
    --ntf-red-light: #FDECEA;
    --ntf-white: #fff;
    --ntf-gray-50: #F9F9F9;
    --ntf-gray-100: #F1F1F1;
    --ntf-gray-200: #E0E0E0;
    --ntf-gray-400: #9E9E9E;
    --ntf-gray-600: #555;
    --ntf-gray-800: #222;
    --ntf-green: #27AE60;
    --ntf-green-light: #EAFAF1;
    --ntf-blue: #2980B9;
    --ntf-blue-light: #EAF4FB;
    --ntf-amber: #E67E22;
    --ntf-amber-light: #FEF9EC;
    --ntf-purple: #8E44AD;
    --ntf-purple-light: #F5EEF8;
    --ntf-radius: 8px;
    --ntf-radius-sm: 5px;
    --ntf-radius-lg: 12px;
  }

  /* ── Page header ──────────────────────────── */
  .ntf-page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 24px
  }

  .ntf-page-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--ntf-gray-800)
  }

  .ntf-page-sub {
    font-size: 13px;
    color: var(--ntf-gray-400);
    margin-top: 3px
  }

  /* ── Buttons ──────────────────────────────── */
  .ntf-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 15px;
    border-radius: var(--ntf-radius);
    font-family: Arial;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    border: 1.5px solid transparent;
    transition: all .15s
  }

  .ntf-btn-outline {
    background: var(--ntf-white);
    border-color: var(--ntf-gray-200);
    color: var(--ntf-gray-600)
  }

  .ntf-btn-outline:hover {
    border-color: var(--ntf-red);
    color: var(--ntf-red)
  }

  .ntf-btn-red {
    background: var(--ntf-red);
    color: #fff;
    border-color: var(--ntf-red)
  }

  .ntf-btn-red:hover {
    background: var(--ntf-red-h)
  }

  .ntf-btn-ghost {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px 7px;
    border-radius: var(--ntf-radius-sm);
    color: var(--ntf-gray-400);
    transition: all .15s;
    display: flex;
    align-items: center
  }

  .ntf-btn-ghost:hover {
    color: var(--ntf-red);
    background: var(--ntf-red-light)
  }

  .ntf-btn-sm {
    padding: 5px 10px;
    font-size: 12px
  }

  /* ── Card ─────────────────────────────────── */
  .ntf-card {
    background: var(--ntf-white);
    border: 1px solid var(--ntf-gray-200);
    border-radius: var(--ntf-radius-lg);
    padding: 20px;
    margin-bottom: 20px
  }

  .ntf-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
    flex-wrap: wrap;
    gap: 8px
  }

  .ntf-card-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--ntf-gray-800);
    display: flex;
    align-items: center;
    gap: 8px
  }

  .ntf-card-sub {
    font-size: 12px;
    color: var(--ntf-gray-400);
    margin-top: 2px
  }

  /* ── Settings grid ───────────────────────── */
  .ntf-settings-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px
  }

  .ntf-setting-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px;
    border: 1.5px solid var(--ntf-gray-200);
    border-radius: var(--ntf-radius);
    transition: border .15s
  }

  .ntf-setting-row:hover {
    border-color: var(--ntf-red)
  }

  .ntf-setting-info {
    display: flex;
    align-items: center;
    gap: 10px
  }

  .ntf-setting-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0
  }

  .ntf-setting-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--ntf-gray-800)
  }

  .ntf-setting-desc {
    font-size: 11px;
    color: var(--ntf-gray-400);
    margin-top: 2px
  }

  /* ── Toggle switch ───────────────────────── */
  .ntf-toggle {
    position: relative;
    width: 42px;
    height: 24px;
    flex-shrink: 0
  }

  .ntf-toggle input {
    opacity: 0;
    width: 0;
    height: 0;
    position: absolute
  }

  .ntf-toggle-slider {
    position: absolute;
    inset: 0;
    background: var(--ntf-gray-200);
    border-radius: 24px;
    cursor: pointer;
    transition: background .2s
  }

  .ntf-toggle-slider::before {
    content: '';
    position: absolute;
    width: 18px;
    height: 18px;
    background: #fff;
    border-radius: 50%;
    top: 3px;
    left: 3px;
    transition: transform .2s;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .2)
  }

  .ntf-toggle input:checked+.ntf-toggle-slider {
    background: var(--ntf-red)
  }

  .ntf-toggle input:checked+.ntf-toggle-slider::before {
    transform: translateX(18px)
  }

  /* ── Frequency select ────────────────────── */
  .ntf-select {
    padding: 6px 10px;
    border: 1.5px solid var(--ntf-gray-200);
    border-radius: var(--ntf-radius-sm);
    font-family: Arial;
    font-size: 12px;
    color: var(--ntf-gray-600);
    outline: none;
    background: var(--ntf-white);
    cursor: pointer;
    transition: border .15s
  }

  .ntf-select:focus {
    border-color: var(--ntf-red)
  }

  /* ── Toolbar ─────────────────────────────── */
  .ntf-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 16px
  }

  .ntf-search-wrap {
    position: relative;
    flex: 1;
    min-width: 180px
  }

  .ntf-search-wrap svg {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ntf-gray-400);
    width: 15px;
    height: 15px;
    pointer-events: none
  }

  .ntf-search-wrap input {
    width: 100%;
    padding: 8px 12px 8px 32px;
    border: 1.5px solid var(--ntf-gray-200);
    border-radius: var(--ntf-radius);
    font-family: Arial;
    font-size: 13px;
    outline: none;
    transition: border .2s;
    background: var(--ntf-white)
  }

  .ntf-search-wrap input:focus {
    border-color: var(--ntf-red)
  }

  /* ── Filter pills ────────────────────────── */
  .ntf-filters {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 14px
  }

  .ntf-filter {
    padding: 5px 14px;
    border-radius: 20px;
    font-family: Arial;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    border: 1.5px solid var(--ntf-gray-200);
    background: var(--ntf-white);
    color: var(--ntf-gray-600);
    transition: all .15s
  }

  .ntf-filter.active {
    background: var(--ntf-red);
    border-color: var(--ntf-red);
    color: #fff
  }

  .ntf-filter:hover:not(.active) {
    border-color: var(--ntf-red);
    color: var(--ntf-red)
  }

  /* ── Bulk actions bar ────────────────────── */
  .ntf-bulk-bar {
    display: none;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    background: var(--ntf-red-light);
    border: 1.5px solid var(--ntf-red);
    border-radius: var(--ntf-radius);
    margin-bottom: 12px;
    flex-wrap: wrap
  }

  .ntf-bulk-bar.show {
    display: flex
  }

  .ntf-bulk-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--ntf-red);
    flex: 1
  }

  /* ── Notification list ───────────────────── */
  .ntf-list {
    display: flex;
    flex-direction: column;
    gap: 0
  }

  .ntf-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    border-bottom: 1px solid var(--ntf-gray-100);
    cursor: pointer;
    transition: background .12s;
    position: relative
  }

  .ntf-item:last-child {
    border-bottom: none
  }

  .ntf-item:hover {
    background: var(--ntf-gray-50)
  }

  .ntf-item.unread {
    background: rgba(192, 57, 43, .03)
  }

  .ntf-item.unread .ntf-item-title {
    color: var(--ntf-gray-800);
    font-weight: 700
  }

  .ntf-item-checkbox {
    margin-top: 2px;
    accent-color: var(--ntf-red);
    width: 14px;
    height: 14px;
    cursor: pointer;
    flex-shrink: 0
  }

  .ntf-item-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0
  }

  .ntf-item-body {
    flex: 1;
    min-width: 0
  }

  .ntf-item-title {
    font-size: 13px;
    color: var(--ntf-gray-700);
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
  }

  .ntf-item-meta {
    font-size: 11px;
    color: var(--ntf-gray-400);
    margin-top: 3px;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap
  }

  .ntf-unread-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--ntf-red);
    flex-shrink: 0;
    margin-top: 5px
  }

  .ntf-item-actions {
    display: flex;
    gap: 2px;
    opacity: 0;
    transition: opacity .15s;
    flex-shrink: 0
  }

  .ntf-item:hover .ntf-item-actions {
    opacity: 1
  }

  .ntf-type-dot {
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    flex-shrink: 0
  }

  /* ── Badge ───────────────────────────────── */
  .ntf-badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap
  }

  .ntf-badge-count {
    background: var(--ntf-red);
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    border-radius: 20px;
    padding: 1px 6px;
    min-width: 18px;
    text-align: center
  }

  /* ── Empty state ─────────────────────────── */
  .ntf-empty {
    text-align: center;
    padding: 48px 20px;
    color: var(--ntf-gray-400)
  }

  .ntf-empty svg {
    margin: 0 auto 12px;
    display: block;
    opacity: .3
  }

  .ntf-empty p {
    font-size: 13px
  }

  /* ── Divider ─────────────────────────────── */
  .ntf-divider {
    border: none;
    border-top: 1px solid var(--ntf-gray-100);
    margin: 16px 0
  }

  /* ── Overlays & Modals ───────────────────── */
  .ntf-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, .45);
    z-index: 9000;
    align-items: center;
    justify-content: center;
    padding: 16px
  }

  .ntf-overlay.open {
    display: flex
  }

  .ntf-modal {
    background: var(--ntf-white);
    border-radius: var(--ntf-radius-lg);
    width: 100%;
    max-width: 520px;
    max-height: 92vh;
    overflow-y: auto;
    box-shadow: 0 8px 40px rgba(0, 0, 0, .18)
  }

  .ntf-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 20px 14px;
    border-bottom: 1px solid var(--ntf-gray-200);
    position: sticky;
    top: 0;
    background: var(--ntf-white);
    z-index: 1
  }

  .ntf-modal-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--ntf-gray-800)
  }

  .ntf-modal-close {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--ntf-gray-400);
    padding: 4px;
    border-radius: var(--ntf-radius-sm);
    display: flex;
    transition: all .15s
  }

  .ntf-modal-close:hover {
    color: var(--ntf-red);
    background: var(--ntf-red-light)
  }

  .ntf-modal-body {
    padding: 20px
  }

  .ntf-modal-footer {
    padding: 14px 20px;
    border-top: 1px solid var(--ntf-gray-200);
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    position: sticky;
    bottom: 0;
    background: var(--ntf-white)
  }

  /* Detail modal extras */
  .ntf-detail-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px
  }

  .ntf-detail-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--ntf-gray-800);
    text-align: center;
    margin-bottom: 6px
  }

  .ntf-detail-body {
    font-size: 13px;
    color: var(--ntf-gray-600);
    text-align: center;
    line-height: 1.6;
    margin-bottom: 16px
  }

  .ntf-detail-meta {
    background: var(--ntf-gray-50);
    border-radius: var(--ntf-radius);
    padding: 12px 14px
  }

  .ntf-detail-meta-row {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    padding: 4px 0;
    border-bottom: 1px solid var(--ntf-gray-100)
  }

  .ntf-detail-meta-row:last-child {
    border-bottom: none
  }

  .ntf-detail-meta-key {
    color: var(--ntf-gray-400);
    font-weight: 700
  }

  .ntf-detail-meta-val {
    color: var(--ntf-gray-700)
  }

  /* Delete confirm modal */
  .ntf-confirm-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--ntf-red-light);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px
  }

  /* ── Toast ───────────────────────────────── */
  .ntf-toast-wrap {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 10000;
    display: flex;
    flex-direction: column;
    gap: 8px;
    pointer-events: none
  }

  .ntf-toast {
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--ntf-gray-800);
    color: #fff;
    padding: 12px 16px;
    border-radius: var(--ntf-radius);
    font-family: Arial;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 4px 16px rgba(0, 0, 0, .2);
    opacity: 0;
    transform: translateY(10px);
    transition: all .25s;
    pointer-events: auto;
    min-width: 220px;
    max-width: 340px
  }

  .ntf-toast.show {
    opacity: 1;
    transform: translateY(0)
  }

  .ntf-toast.success {
    background: var(--ntf-green)
  }

  .ntf-toast.error {
    background: var(--ntf-red)
  }

  .ntf-toast.info {
    background: var(--ntf-blue)
  }

  .ntf-toast.warning {
    background: var(--ntf-amber)
  }

  .ntf-toast-msg {
    flex: 1
  }

  .ntf-toast-close {
    background: none;
    border: none;
    cursor: pointer;
    color: rgba(255, 255, 255, .7);
    padding: 2px;
    line-height: 1;
    font-size: 16px
  }

  .ntf-toast-close:hover {
    color: #fff
  }

  /* ── Pagination ──────────────────────────── */
  .ntf-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 14px;
    flex-wrap: wrap;
    gap: 8px
  }

  .ntf-page-info {
    font-size: 12px;
    color: var(--ntf-gray-400)
  }

  .ntf-page-btns {
    display: flex;
    gap: 4px
  }

  .ntf-page-btn {
    width: 30px;
    height: 30px;
    border: 1.5px solid var(--ntf-gray-200);
    background: var(--ntf-white);
    border-radius: var(--ntf-radius-sm);
    font-family: Arial;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    color: var(--ntf-gray-600);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .15s
  }

  .ntf-page-btn:hover:not(.active):not(:disabled) {
    border-color: var(--ntf-red);
    color: var(--ntf-red)
  }

  .ntf-page-btn.active {
    background: var(--ntf-red);
    border-color: var(--ntf-red);
    color: #fff
  }

  .ntf-page-btn:disabled {
    opacity: .3;
    cursor: not-allowed
  }

  /* ── Responsive ──────────────────────────── */
  @media(max-width:720px) {
    .ntf-settings-grid {
      grid-template-columns: 1fr
    }

    .ntf-page-header {
      flex-direction: column
    }

    .ntf-item-title {
      white-space: normal
    }
  }

  @media(max-width:480px) {
    .ntf-wrap {
      padding: 14px 10px
    }

    .ntf-modal {
      max-width: 100%
    }

    .ntf-item-actions {
      opacity: 1
    }
  }
</style>

<div class="ntf-wrap">

  {{-- ── Page Header ─────────────────────────── --}}
  <div class="ntf-page-header">
    <div>
      <div class="ntf-page-title">
        Notifications
        <span class="ntf-badge-count" id="ntfUnreadCount">0</span>
      </div>
      <div class="ntf-page-sub">Manage notification preferences and view your notification history</div>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
      <button class="ntf-btn ntf-btn-outline ntf-btn-sm" onclick="ntfMarkAllRead()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="20 6 9 17 4 12" />
        </svg>
        Mark All Read
      </button>
      <button class="ntf-btn ntf-btn-outline ntf-btn-sm" onclick="ntfOpenClearModal()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="3 6 5 6 21 6" />
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
        </svg>
        Clear All
      </button>
    </div>
  </div>

  {{-- ── Notification Settings ───────────────── --}}
  <div class="ntf-card">
    <div class="ntf-card-header">
      <div>
        <div class="ntf-card-title">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-red)" stroke-width="2">
            <circle cx="12" cy="12" r="3" />
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14" />
          </svg>
          Notification Preferences
        </div>
        <div class="ntf-card-sub">Control how and when you receive notifications</div>
      </div>
      <button class="ntf-btn ntf-btn-red ntf-btn-sm" id="ntfSaveBtn" onclick="ntfSaveSettings()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
          <polyline points="17 21 17 13 7 13 7 21" />
          <polyline points="7 3 7 8 15 8" />
        </svg>
        Save Changes
      </button>
    </div>

    <div class="ntf-settings-grid">

      <div class="ntf-setting-row">
        <div class="ntf-setting-info">
          <div class="ntf-setting-icon" style="background:var(--ntf-blue-light)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-blue)" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
          </div>
          <div>
            <div class="ntf-setting-label">Email Notifications</div>
            <div class="ntf-setting-desc">Receive alerts via email</div>
          </div>
        </div>
        <label class="ntf-toggle">
          <input type="checkbox" id="ntf-email" checked onchange="ntfMarkDirty()">
          <span class="ntf-toggle-slider"></span>
        </label>
      </div>

      <div class="ntf-setting-row">
        <div class="ntf-setting-info">
          <div class="ntf-setting-icon" style="background:var(--ntf-red-light)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-red)" stroke-width="2">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
              <path d="M13.73 21a2 2 0 0 1-3.46 0" />
            </svg>
          </div>
          <div>
            <div class="ntf-setting-label">Push Notifications</div>
            <div class="ntf-setting-desc">Browser push alerts</div>
          </div>
        </div>
        <label class="ntf-toggle">
          <input type="checkbox" id="ntf-push" onchange="ntfMarkDirty()">
          <span class="ntf-toggle-slider"></span>
        </label>
      </div>

      <div class="ntf-setting-row">
        <div class="ntf-setting-info">
          <div class="ntf-setting-icon" style="background:var(--ntf-green-light)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-green)" stroke-width="2">
              <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
              <line x1="12" y1="18" x2="12.01" y2="18" />
            </svg>
          </div>
          <div>
            <div class="ntf-setting-label">SMS Notifications</div>
            <div class="ntf-setting-desc">Text message alerts</div>
          </div>
        </div>
        <label class="ntf-toggle">
          <input type="checkbox" id="ntf-sms" onchange="ntfMarkDirty()">
          <span class="ntf-toggle-slider"></span>
        </label>
      </div>

      <div class="ntf-setting-row">
        <div class="ntf-setting-info">
          <div class="ntf-setting-icon" style="background:var(--ntf-amber-light)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-amber)" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
          </div>
          <div>
            <div class="ntf-setting-label">System Alerts</div>
            <div class="ntf-setting-desc">Critical system notifications</div>
          </div>
        </div>
        <label class="ntf-toggle">
          <input type="checkbox" id="ntf-system" checked onchange="ntfMarkDirty()">
          <span class="ntf-toggle-slider"></span>
        </label>
      </div>

      <div class="ntf-setting-row">
        <div class="ntf-setting-info">
          <div class="ntf-setting-icon" style="background:var(--ntf-purple-light)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-purple)" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
          <div>
            <div class="ntf-setting-label">New User Alerts</div>
            <div class="ntf-setting-desc">When new users register</div>
          </div>
        </div>
        <label class="ntf-toggle">
          <input type="checkbox" id="ntf-newuser" checked onchange="ntfMarkDirty()">
          <span class="ntf-toggle-slider"></span>
        </label>
      </div>

      <div class="ntf-setting-row">
        <div class="ntf-setting-info">
          <div class="ntf-setting-icon" style="background:var(--ntf-red-light)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-red)" stroke-width="2">
              <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
              <line x1="12" y1="9" x2="12" y2="13" />
              <line x1="12" y1="17" x2="12.01" y2="17" />
            </svg>
          </div>
          <div>
            <div class="ntf-setting-label">Report Alerts</div>
            <div class="ntf-setting-desc">New squatting reports</div>
          </div>
        </div>
        <label class="ntf-toggle">
          <input type="checkbox" id="ntf-reports" checked onchange="ntfMarkDirty()">
          <span class="ntf-toggle-slider"></span>
        </label>
      </div>

    </div>

    <hr class="ntf-divider">

    {{-- Digest frequency --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
      <div>
        <div style="font-size:13px;font-weight:700;color:var(--ntf-gray-800)">Email Digest Frequency</div>
        <div style="font-size:11px;color:var(--ntf-gray-400);margin-top:2px">How often to batch and send email summaries</div>
      </div>
      <select class="ntf-select" id="ntfDigest" onchange="ntfMarkDirty()">
        <option value="realtime">Real-time</option>
        <option value="hourly">Hourly</option>
        <option value="daily" selected>Daily Digest</option>
        <option value="weekly">Weekly Digest</option>
        <option value="never">Never</option>
      </select>
    </div>

    {{-- Quiet hours --}}
    <hr class="ntf-divider">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
      <div>
        <div style="font-size:13px;font-weight:700;color:var(--ntf-gray-800);display:flex;align-items:center;gap:6px">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
          </svg>
          Quiet Hours
        </div>
        <div style="font-size:11px;color:var(--ntf-gray-400);margin-top:2px">Suppress all notifications during this window</div>
      </div>
      <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
        <label class="ntf-toggle" style="margin-right:4px">
          <input type="checkbox" id="ntfQuietToggle" onchange="ntfToggleQuiet()">
          <span class="ntf-toggle-slider"></span>
        </label>
        <div id="ntfQuietRange" style="display:none;display:flex;gap:6px;align-items:center">
          <input type="time" class="ntf-select" id="ntfQuietFrom" value="22:00" onchange="ntfMarkDirty()">
          <span style="font-size:12px;color:var(--ntf-gray-400)">to</span>
          <input type="time" class="ntf-select" id="ntfQuietTo" value="07:00" onchange="ntfMarkDirty()">
        </div>
      </div>
    </div>

  </div>{{-- end settings card --}}


  {{-- ── Notification List ───────────────────── --}}
  <div class="ntf-card" style="padding:0;overflow:hidden">
    <div style="padding:16px 20px 0">
      <div class="ntf-card-header" style="margin-bottom:12px">
        <div>
          <div class="ntf-card-title">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-red)" stroke-width="2">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
              <path d="M13.73 21a2 2 0 0 1-3.46 0" />
            </svg>
            Notification Center
          </div>
          <div class="ntf-card-sub">Click any notification to view details</div>
        </div>
        <div style="display:flex;gap:6px;align-items:center">
          <span style="font-size:12px;color:var(--ntf-gray-400)" id="ntfListCount"></span>
        </div>
      </div>

      <div class="ntf-toolbar">
        <div class="ntf-search-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.35-4.35" />
          </svg>
          <input type="text" id="ntfSearch" placeholder="Search notifications..." oninput="ntfApplyFilter()">
        </div>
        <select class="ntf-select" id="ntfSortSelect" onchange="ntfApplyFilter()">
          <option value="newest">Newest First</option>
          <option value="oldest">Oldest First</option>
          <option value="unread">Unread First</option>
        </select>
      </div>

      <div class="ntf-filters">
        <button class="ntf-filter active" data-f="all" onclick="ntfSetFilter('all',this)">All</button>
        <button class="ntf-filter" data-f="unread" onclick="ntfSetFilter('unread',this)">Unread</button>
        <button class="ntf-filter" data-f="user" onclick="ntfSetFilter('user',this)">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-1px;margin-right:3px">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
          </svg>
          Users
        </button>
        <button class="ntf-filter" data-f="report" onclick="ntfSetFilter('report',this)">Reports</button>
        <button class="ntf-filter" data-f="system" onclick="ntfSetFilter('system',this)">System</button>
        <button class="ntf-filter" data-f="faq" onclick="ntfSetFilter('faq',this)">FAQs</button>
        <button class="ntf-filter" data-f="post" onclick="ntfSetFilter('post',this)">Posts</button>
      </div>

      {{-- Bulk bar --}}
      <div class="ntf-bulk-bar" id="ntfBulkBar">
        <span class="ntf-bulk-label" id="ntfBulkLabel">0 selected</span>
        <button class="ntf-btn ntf-btn-outline ntf-btn-sm" onclick="ntfBulkRead()">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12" />
          </svg>
          Mark Read
        </button>
        <button class="ntf-btn ntf-btn-outline ntf-btn-sm" onclick="ntfBulkUnread()">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <line x1="12" y1="8" x2="12" y2="12" />
            <line x1="12" y1="16" x2="12.01" y2="16" />
          </svg>
          Mark Unread
        </button>
        <button class="ntf-btn ntf-btn-sm" style="background:var(--ntf-red-light);color:var(--ntf-red);border:none" onclick="ntfBulkDelete()">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="3 6 5 6 21 6" />
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
          </svg>
          Delete
        </button>
        <button class="ntf-btn-ghost ntf-btn-sm" onclick="ntfClearBulk()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </button>
      </div>
    </div>

    <div id="ntfListWrap">
      <div class="ntf-list" id="ntfList"></div>
    </div>

    <div style="padding:12px 20px;border-top:1px solid var(--ntf-gray-100)" id="ntfPagWrap">
      <div class="ntf-pagination">
        <span class="ntf-page-info" id="ntfPageInfo"></span>
        <div class="ntf-page-btns" id="ntfPageBtns"></div>
      </div>
    </div>
  </div>

</div>{{-- end .ntf-wrap --}}


{{-- ══════════════════════════════ --}}
{{-- DETAIL MODAL                  --}}
{{-- ══════════════════════════════ --}}
<div class="ntf-overlay" id="ntfDetailOverlay">
  <div class="ntf-modal" role="dialog" aria-modal="true">
    <div class="ntf-modal-header">
      <span class="ntf-modal-title">Notification Detail</span>
      <button class="ntf-modal-close" onclick="ntfCloseModal('ntfDetailOverlay')">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="ntf-modal-body">
      <div class="ntf-detail-icon" id="ntfDetailIcon"></div>
      <div class="ntf-detail-title" id="ntfDetailTitle"></div>
      <div class="ntf-detail-body" id="ntfDetailBody"></div>
      <div class="ntf-detail-meta">
        <div class="ntf-detail-meta-row">
          <span class="ntf-detail-meta-key">Type</span>
          <span class="ntf-detail-meta-val" id="ntfDetailType"></span>
        </div>
        <div class="ntf-detail-meta-row">
          <span class="ntf-detail-meta-key">Received</span>
          <span class="ntf-detail-meta-val" id="ntfDetailTime"></span>
        </div>
        <div class="ntf-detail-meta-row">
          <span class="ntf-detail-meta-key">Status</span>
          <span class="ntf-detail-meta-val" id="ntfDetailStatus"></span>
        </div>
        <div class="ntf-detail-meta-row">
          <span class="ntf-detail-meta-key">Source</span>
          <span class="ntf-detail-meta-val" id="ntfDetailSource"></span>
        </div>
      </div>
    </div>
    <div class="ntf-modal-footer" id="ntfDetailFooter"></div>
  </div>
</div>


{{-- ══════════════════════════════ --}}
{{-- DELETE CONFIRM MODAL          --}}
{{-- ══════════════════════════════ --}}
<div class="ntf-overlay" id="ntfDeleteOverlay">
  <div class="ntf-modal" style="max-width:380px" role="dialog" aria-modal="true">
    <div class="ntf-modal-body" style="text-align:center;padding:28px 24px">
      <div class="ntf-confirm-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-red)" stroke-width="2">
          <polyline points="3 6 5 6 21 6" />
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
          <path d="M10 11v6M14 11v6" />
          <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
        </svg>
      </div>
      <div style="font-size:15px;font-weight:700;color:var(--ntf-gray-800);margin-bottom:8px" id="ntfDeleteTitle">Delete Notification?</div>
      <div style="font-size:13px;color:var(--ntf-gray-600);line-height:1.5" id="ntfDeleteMsg">This action cannot be undone.</div>
    </div>
    <div class="ntf-modal-footer" style="justify-content:center;gap:10px">
      <button class="ntf-btn ntf-btn-outline" onclick="ntfCloseModal('ntfDeleteOverlay')">Cancel</button>
      <button class="ntf-btn ntf-btn-red" id="ntfDeleteConfirmBtn">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="3 6 5 6 21 6" />
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
        </svg>
        Yes, Delete
      </button>
    </div>
  </div>
</div>


{{-- ══════════════════════════════ --}}
{{-- CLEAR ALL CONFIRM MODAL       --}}
{{-- ══════════════════════════════ --}}
<div class="ntf-overlay" id="ntfClearOverlay">
  <div class="ntf-modal" style="max-width:380px" role="dialog" aria-modal="true">
    <div class="ntf-modal-body" style="text-align:center;padding:28px 24px">
      <div class="ntf-confirm-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--ntf-red)" stroke-width="2">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
          <line x1="12" y1="9" x2="12" y2="13" />
          <line x1="12" y1="17" x2="12.01" y2="17" />
        </svg>
      </div>
      <div style="font-size:15px;font-weight:700;color:var(--ntf-gray-800);margin-bottom:8px">Clear All Notifications?</div>
      <div style="font-size:13px;color:var(--ntf-gray-600);line-height:1.5">All <strong id="ntfClearCount">0</strong> notifications will be permanently deleted. This cannot be undone.</div>
    </div>
    <div class="ntf-modal-footer" style="justify-content:center;gap:10px">
      <button class="ntf-btn ntf-btn-outline" onclick="ntfCloseModal('ntfClearOverlay')">Cancel</button>
      <button class="ntf-btn ntf-btn-red" onclick="ntfClearAll()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="3 6 5 6 21 6" />
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
        </svg>
        Clear All
      </button>
    </div>
  </div>
</div>


{{-- ══════════════════════════════ --}}
{{-- TOAST CONTAINER               --}}
{{-- ══════════════════════════════ --}}
<div class="ntf-toast-wrap" id="ntfToastWrap"></div>


<script>
  /* ═══════════════════════════════════════════════════════════
   DATA
   Replace with @/json($notifications) from your controller alisin mo nalang slash between @ and json.
   Each item: id, title, body, type, time, read, source
═══════════════════════════════════════════════════════════ */
  let ntfData = [{
      id: 1,
      title: 'New user registered',
      body: 'Maria Santos just created an account and is awaiting verification.',
      type: 'user',
      time: '2025-04-09 08:12',
      read: false,
      source: 'Anti Squatting App'
    },
    {
      id: 2,
      title: 'Squatting report submitted',
      body: 'A new squatting report has been filed in Tondo, Manila. Case #4421.',
      type: 'report',
      time: '2025-04-09 07:55',
      read: false,
      source: 'Mobile App'
    },
    {
      id: 3,
      title: 'System backup completed',
      body: 'Daily database backup completed successfully at 03:00 AM.',
      type: 'system',
      time: '2025-04-09 03:01',
      read: true,
      source: 'System'
    },
    {
      id: 4,
      title: 'FAQ answered by admin',
      body: 'Admin Jose Rizal answered the question "How do I cancel my subscription?"',
      type: 'faq',
      time: '2025-04-08 16:40',
      read: true,
      source: 'FAQ Module'
    },
    {
      id: 5,
      title: 'Post pending review',
      body: 'A new community post "Illegal occupancy — Caloocan" is waiting for moderation.',
      type: 'post',
      time: '2025-04-08 14:20',
      read: false,
      source: 'Community Module'
    },
    {
      id: 6,
      title: 'User account flagged',
      body: 'User Raffy Tulfo has been flagged for suspicious activity. Review required.',
      type: 'user',
      time: '2025-04-08 11:05',
      read: false,
      source: 'Security Module'
    },
    {
      id: 7,
      title: 'App crash reported',
      body: 'A crash was reported on Android v2.3.1. Error: NullPointerException in PropertyFragment.',
      type: 'system',
      time: '2025-04-08 09:30',
      read: true,
      source: 'Crash Reporter'
    },
    {
      id: 8,
      title: 'New FAQ submitted',
      body: 'User Ana Reyes submitted a new question: "What payment methods are accepted?"',
      type: 'faq',
      time: '2025-04-07 18:15',
      read: true,
      source: 'FAQ Module'
    },
    {
      id: 9,
      title: 'Squatting report resolved',
      body: 'Case #4418 has been marked as resolved by Admin Maria Santos.',
      type: 'report',
      time: '2025-04-07 15:00',
      read: true,
      source: 'Mobile App'
    },
    {
      id: 10,
      title: '10 new users this week',
      body: 'Registration milestone: 10 new users signed up this week, bringing the total to 4,821.',
      type: 'user',
      time: '2025-04-07 12:00',
      read: false,
      source: 'Analytics'
    },
    {
      id: 11,
      title: 'Post approved',
      body: 'Community post "Update: case #4421 resolved" has been approved and is now live.',
      type: 'post',
      time: '2025-04-06 17:30',
      read: true,
      source: 'Community Module'
    },
    {
      id: 12,
      title: 'System update available',
      body: 'A new system update (v3.1.2) is available. Please review the changelog before applying.',
      type: 'system',
      time: '2025-04-06 10:00',
      read: false,
      source: 'System'
    },
    {
      id: 13,
      title: 'Squatting report — high priority',
      body: 'High-priority squatting report filed in Quezon City. Requires immediate admin action.',
      type: 'report',
      time: '2025-04-05 09:45',
      read: false,
      source: 'Mobile App'
    },
    {
      id: 14,
      title: 'FAQ marked as archived',
      body: 'FAQ #12 "Is there a mobile app available?" has been archived by Admin.',
      type: 'faq',
      time: '2025-04-05 08:00',
      read: true,
      source: 'FAQ Module'
    },
    {
      id: 15,
      title: 'Scheduled maintenance notice',
      body: 'The system will undergo scheduled maintenance on April 12, 2025 from 12:00 AM to 2:00 AM.',
      type: 'system',
      time: '2025-04-04 14:00',
      read: true,
      source: 'System'
    },
  ];

  const NTF_PER_PAGE = 7;
  let ntfFilter = 'all';
  let ntfPage = 1;
  let ntfSearch = '';
  let ntfSort = 'newest';
  let ntfSelectedIds = new Set();
  let ntfDeleteTarget = null;
  let ntfSettingsDirty = false;

  /* ── Type config ─────────────────────────────── */
  const ntfTypeConfig = {
    user: {
      color: 'var(--ntf-purple)',
      bg: 'var(--ntf-purple-light)',
      label: 'User',
      icon: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>`
    },
    report: {
      color: 'var(--ntf-red)',
      bg: 'var(--ntf-red-light)',
      label: 'Report',
      icon: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>`
    },
    system: {
      color: 'var(--ntf-amber)',
      bg: 'var(--ntf-amber-light)',
      label: 'System',
      icon: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>`
    },
    faq: {
      color: 'var(--ntf-blue)',
      bg: 'var(--ntf-blue-light)',
      label: 'FAQ',
      icon: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>`
    },
    post: {
      color: 'var(--ntf-green)',
      bg: 'var(--ntf-green-light)',
      label: 'Post',
      icon: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>`
    },
  };

  /* ── Helpers ─────────────────────────────────── */
  function ntfEsc(s) {
    return (s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  function ntfTimeAgo(ts) {
    const diff = (Date.now() - new Date(ts).getTime()) / 1000;
    if (diff < 60) return 'Just now';
    if (diff < 3600) return Math.floor(diff / 60) + 'm ago';
    if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
    return Math.floor(diff / 86400) + 'd ago';
  }

  function ntfGetFiltered() {
    let d = [...ntfData];
    if (ntfFilter === 'unread') d = d.filter(n => !n.read);
    else if (ntfFilter !== 'all') d = d.filter(n => n.type === ntfFilter);
    if (ntfSearch) {
      const s = ntfSearch.toLowerCase();
      d = d.filter(n => n.title.toLowerCase().includes(s) || n.body.toLowerCase().includes(s));
    }
    if (ntfSort === 'oldest') d.sort((a, b) => new Date(a.time) - new Date(b.time));
    else if (ntfSort === 'unread') d.sort((a, b) => (a.read === b.read ? 0 : a.read ? 1 : -1));
    else d.sort((a, b) => new Date(b.time) - new Date(a.time));
    return d;
  }

  /* ── Render list ─────────────────────────────── */
  function ntfRender() {
    const all = ntfGetFiltered();
    const total = all.length;
    const pages = Math.max(1, Math.ceil(total / NTF_PER_PAGE));
    if (ntfPage > pages) ntfPage = 1;
    const start = (ntfPage - 1) * NTF_PER_PAGE;
    const slice = all.slice(start, start + NTF_PER_PAGE);
    const list = document.getElementById('ntfList');

    if (!slice.length) {
      list.innerHTML = `<div class="ntf-empty">
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
      </svg>
      <p>No notifications found</p>
    </div>`;
    } else {
      list.innerHTML = slice.map(n => {
        const cfg = ntfTypeConfig[n.type] || ntfTypeConfig.system;
        const sel = ntfSelectedIds.has(n.id);
        return `<div class="ntf-item ${n.read?'':'unread'}" id="ntf-row-${n.id}" onclick="ntfOpenDetail(${n.id})">
        <input type="checkbox" class="ntf-item-checkbox" ${sel?'checked':''} onclick="event.stopPropagation();ntfToggleSelect(${n.id},this)">
        <div class="ntf-item-icon" style="background:${cfg.bg};color:${cfg.color}">${cfg.icon}</div>
        <div class="ntf-item-body">
          <div class="ntf-item-title">${ntfEsc(n.title)}</div>
          <div class="ntf-item-meta">
            <span class="ntf-badge" style="background:${cfg.bg};color:${cfg.color}">${cfg.label}</span>
            <span>${ntfTimeAgo(n.time)}</span>
            <span>${n.source}</span>
          </div>
        </div>
        ${!n.read?'<div class="ntf-unread-dot"></div>':''}
        <div class="ntf-item-actions" onclick="event.stopPropagation()">
          <button class="ntf-btn-ghost" title="${n.read?'Mark unread':'Mark read'}" onclick="ntfToggleRead(${n.id})">
            ${n.read
              ? `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`
              : `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>`
            }
          </button>
          <button class="ntf-btn-ghost" title="Delete" onclick="ntfOpenDeleteModal(${n.id})">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="3 6 5 6 21 6"/>
              <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
            </svg>
          </button>
        </div>
      </div>`;
      }).join('');
    }

    // Counts
    const unread = ntfData.filter(n => !n.read).length;
    document.getElementById('ntfUnreadCount').textContent = unread;
    document.getElementById('ntfUnreadCount').style.display = unread ? '' : 'none';
    document.getElementById('ntfListCount').textContent = `${total} notification${total!==1?'s':''}`;

    // Pagination
    document.getElementById('ntfPageInfo').textContent =
      `Showing ${total===0?0:start+1}–${Math.min(start+NTF_PER_PAGE,total)} of ${total}`;
    ntfRenderPages(pages);
    ntfUpdateBulkBar();
  }

  function ntfRenderPages(pages) {
    const c = document.getElementById('ntfPageBtns');
    let h = '';
    h += `<button class="ntf-page-btn" onclick="ntfGoPage(${ntfPage-1})" ${ntfPage===1?'disabled':''}>
    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg></button>`;
    for (let p = 1; p <= pages; p++) {
      if (pages > 5 && p > 2 && p < pages - 1 && Math.abs(p - ntfPage) > 1) {
        if (p === 3 || p === pages - 2) h += `<button class="ntf-page-btn" disabled style="border:none">…</button>`;
        continue;
      }
      h += `<button class="ntf-page-btn ${p===ntfPage?'active':''}" onclick="ntfGoPage(${p})">${p}</button>`;
    }
    h += `<button class="ntf-page-btn" onclick="ntfGoPage(${ntfPage+1})" ${ntfPage===pages?'disabled':''}>
    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></button>`;
    c.innerHTML = h;
  }

  function ntfGoPage(p) {
    const pages = Math.ceil(ntfGetFiltered().length / NTF_PER_PAGE);
    if (p < 1 || p > pages) return;
    ntfPage = p;
    ntfRender();
  }

  /* ── Filters ─────────────────────────────────── */
  function ntfSetFilter(f, el) {
    ntfFilter = f;
    ntfPage = 1;
    document.querySelectorAll('.ntf-filter').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    ntfRender();
  }

  function ntfApplyFilter() {
    ntfSearch = document.getElementById('ntfSearch').value;
    ntfSort = document.getElementById('ntfSortSelect').value;
    ntfPage = 1;
    ntfRender();
  }

  /* ── Read / Unread ───────────────────────────── */
  function ntfToggleRead(id) {
    const n = ntfData.find(x => x.id === id);
    if (!n) return;
    n.read = !n.read;
    ntfRender();
    ntfToast(n.read ? 'Marked as read' : 'Marked as unread', 'info');
  }

  function ntfMarkAllRead() {
    ntfData.forEach(n => n.read = true);
    ntfRender();
    ntfToast('All notifications marked as read', 'success');
  }

  /* ── Selection & Bulk ────────────────────────── */
  function ntfToggleSelect(id, cb) {
    if (cb.checked) ntfSelectedIds.add(id);
    else ntfSelectedIds.delete(id);
    ntfUpdateBulkBar();
  }

  function ntfUpdateBulkBar() {
    const bar = document.getElementById('ntfBulkBar');
    const n = ntfSelectedIds.size;
    if (n > 0) {
      bar.classList.add('show');
      document.getElementById('ntfBulkLabel').textContent = `${n} selected`;
    } else {
      bar.classList.remove('show');
    }
  }

  function ntfClearBulk() {
    ntfSelectedIds.clear();
    ntfRender();
  }

  function ntfBulkRead() {
    ntfSelectedIds.forEach(id => {
      const n = ntfData.find(x => x.id === id);
      if (n) n.read = true;
    });
    ntfSelectedIds.clear();
    ntfRender();
    ntfToast('Marked as read', 'success');
  }

  function ntfBulkUnread() {
    ntfSelectedIds.forEach(id => {
      const n = ntfData.find(x => x.id === id);
      if (n) n.read = false;
    });
    ntfSelectedIds.clear();
    ntfRender();
    ntfToast('Marked as unread', 'info');
  }

  function ntfBulkDelete() {
    const count = ntfSelectedIds.size;
    ntfData = ntfData.filter(n => !ntfSelectedIds.has(n.id));
    ntfSelectedIds.clear();
    ntfRender();
    ntfToast(`${count} notification${count!==1?'s':''} deleted`, 'error');
  }

  /* ── Delete ──────────────────────────────────── */
  function ntfOpenDeleteModal(id) {
    ntfDeleteTarget = id;
    const n = ntfData.find(x => x.id === id);
    document.getElementById('ntfDeleteTitle').textContent = 'Delete Notification?';
    document.getElementById('ntfDeleteMsg').textContent = `"${n?n.title:'This notification'}" will be permanently removed.`;
    document.getElementById('ntfDeleteConfirmBtn').onclick = ntfConfirmDelete;
    ntfOpenModal('ntfDeleteOverlay');
  }

  function ntfConfirmDelete() {
    ntfData = ntfData.filter(n => n.id !== ntfDeleteTarget);
    ntfCloseModal('ntfDeleteOverlay');
    ntfRender();
    ntfToast('Notification deleted', 'error');
  }

  function ntfOpenClearModal() {
    document.getElementById('ntfClearCount').textContent = ntfData.length;
    ntfOpenModal('ntfClearOverlay');
  }

  function ntfClearAll() {
    ntfData = [];
    ntfSelectedIds.clear();
    ntfCloseModal('ntfClearOverlay');
    ntfRender();
    ntfToast('All notifications cleared', 'error');
  }

  /* ── Detail ──────────────────────────────────── */
  function ntfOpenDetail(id) {
    const n = ntfData.find(x => x.id === id);
    if (!n) return;
    if (!n.read) {
      n.read = true;
      ntfRender();
    }
    const cfg = ntfTypeConfig[n.type] || ntfTypeConfig.system;
    document.getElementById('ntfDetailIcon').innerHTML = `<div style="width:52px;height:52px;border-radius:50%;background:${cfg.bg};display:flex;align-items:center;justify-content:center;color:${cfg.color}">${cfg.icon.replace('width="16"','width="24"').replace('height="16"','height="24"')}</div>`;
    document.getElementById('ntfDetailTitle').textContent = n.title;
    document.getElementById('ntfDetailBody').textContent = n.body;
    document.getElementById('ntfDetailType').innerHTML = `<span class="ntf-badge" style="background:${cfg.bg};color:${cfg.color}">${cfg.label}</span>`;
    document.getElementById('ntfDetailTime').textContent = n.time + ' (' + ntfTimeAgo(n.time) + ')';
    document.getElementById('ntfDetailStatus').textContent = n.read ? 'Read' : 'Unread';
    document.getElementById('ntfDetailSource').textContent = n.source;
    document.getElementById('ntfDetailFooter').innerHTML = `
    <button class="ntf-btn ntf-btn-outline" onclick="ntfCloseModal('ntfDetailOverlay')">Close</button>
    <button class="ntf-btn ntf-btn-outline" onclick="ntfToggleRead(${n.id});ntfCloseModal('ntfDetailOverlay')">
      ${n.read?'Mark Unread':'Mark Read'}
    </button>
    <button class="ntf-btn" style="background:var(--ntf-red-light);color:var(--ntf-red);border:none"
      onclick="ntfCloseModal('ntfDetailOverlay');ntfOpenDeleteModal(${n.id})">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="3 6 5 6 21 6"/>
        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
      </svg>
      Delete
    </button>`;
    ntfOpenModal('ntfDetailOverlay');
  }

  /* ── Modal helpers ───────────────────────────── */
  function ntfOpenModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function ntfCloseModal(id) {
    document.getElementById(id).classList.remove('open');
    if (!document.querySelector('.ntf-overlay.open')) document.body.style.overflow = '';
  }
  document.querySelectorAll('.ntf-overlay').forEach(o => {
    o.addEventListener('click', function(e) {
      if (e.target === this) ntfCloseModal(this.id);
    });
  });
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
      const o = document.querySelector('.ntf-overlay.open');
      if (o) ntfCloseModal(o.id);
    }
  });

  /* ── Toast ───────────────────────────────────── */
  function ntfToast(msg, type = 'info') {
    const wrap = document.getElementById('ntfToastWrap');
    const t = document.createElement('div');
    t.className = `ntf-toast ${type}`;
    t.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0">${
    type==='success' ? '<polyline points="20 6 9 17 4 12"/>' :
    type==='error'   ? '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>' :
    type==='warning' ? '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>' :
    '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>'
  }</svg><span class="ntf-toast-msg">${msg}</span><button class="ntf-toast-close" onclick="this.parentElement.remove()">&#10005;</button>`;
    wrap.appendChild(t);
    requestAnimationFrame(() => {
      requestAnimationFrame(() => t.classList.add('show'));
    });
    setTimeout(() => {
      t.classList.remove('show');
      setTimeout(() => t.remove(), 300);
    }, 3500);
  }

  /* ── Settings ────────────────────────────────── */
  function ntfMarkDirty() {
    ntfSettingsDirty = true;
    document.getElementById('ntfSaveBtn').style.background = 'var(--ntf-red)';
  }

  function ntfSaveSettings() {
    /* Wire to your backend:
       const payload = {
         email:   document.getElementById('ntf-email').checked,
         push:    document.getElementById('ntf-push').checked,
         sms:     document.getElementById('ntf-sms').checked,
         system:  document.getElementById('ntf-system').checked,
         newuser: document.getElementById('ntf-newuser').checked,
         reports: document.getElementById('ntf-reports').checked,
         digest:  document.getElementById('ntfDigest').value,
         quiet:   document.getElementById('ntfQuietToggle').checked,
         quietFrom: document.getElementById('ntfQuietFrom').value,
         quietTo:   document.getElementById('ntfQuietTo').value,
       };
       fetch('/admin/notifications/settings', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'}, body: JSON.stringify(payload) })
         .then(r=>r.json()).then(()=>ntfToast('Settings saved','success'));
    */
    ntfSettingsDirty = false;
    ntfToast('Notification settings saved', 'success');
  }

  function ntfToggleQuiet() {
    const on = document.getElementById('ntfQuietToggle').checked;
    const el = document.getElementById('ntfQuietRange');
    el.style.display = on ? 'flex' : 'none';
    ntfMarkDirty();
  }

  /* Warn on unsaved changes */
  window.addEventListener('beforeunload', e => {
    if (ntfSettingsDirty) {
      e.preventDefault();
      e.returnValue = '';
    }
  });

  /* ── Init ────────────────────────────────────── */
  ntfRender();
</script>

@endsection