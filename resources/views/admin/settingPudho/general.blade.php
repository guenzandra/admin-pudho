@extends('admin.layout')

@section('content')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0
  }

  .gs-wrap {
    font-family: Arial, sans-serif;
    padding: 24px 20px;
    max-width: 960px;
    margin: 0 auto
  }

  .gs-wrap * {
    font-family: Arial, sans-serif
  }

  :root {
    --g-red: #C0392B;
    --g-red-h: #a93226;
    --g-red-light: #FDECEA;
    --g-white: #fff;
    --g-gray-50: #F9F9F9;
    --g-gray-100: #F1F1F1;
    --g-gray-200: #E0E0E0;
    --g-gray-400: #9E9E9E;
    --g-gray-600: #555;
    --g-gray-800: #222;
    --g-green: #27AE60;
    --g-green-light: #EAFAF1;
    --g-blue: #2980B9;
    --g-blue-light: #EAF4FB;
    --g-amber: #E67E22;
    --g-amber-light: #FEF9EC;
    --g-radius: 8px;
    --g-radius-sm: 5px;
    --g-radius-lg: 12px;
  }

  /* ── Page header ────────────────────────── */
  .gs-page-header {
    margin-bottom: 24px
  }

  .gs-page-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--g-gray-800);
    display: flex;
    align-items: center;
    gap: 10px
  }

  .gs-page-sub {
    font-size: 13px;
    color: var(--g-gray-400);
    margin-top: 4px
  }

  /* ── Card ───────────────────────────────── */
  .gs-card {
    background: var(--g-white);
    border: 1px solid var(--g-gray-200);
    border-radius: var(--g-radius-lg);
    margin-bottom: 18px;
    overflow: hidden;
    position: relative
  }

  .gs-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid var(--g-gray-100);
    flex-wrap: wrap;
    gap: 8px
  }

  .gs-card-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--g-gray-800);
    display: flex;
    align-items: center;
    gap: 8px
  }

  .gs-card-sub {
    font-size: 11px;
    color: var(--g-gray-400);
    margin-top: 2px
  }

  .gs-card-body {
    padding: 22px
  }

  /* ── Buttons ────────────────────────────── */
  .gs-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 16px;
    border-radius: var(--g-radius);
    font-family: Arial;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    border: 1.5px solid transparent;
    transition: all .15s
  }

  .gs-btn-red {
    background: var(--g-red);
    color: #fff;
    border-color: var(--g-red)
  }

  .gs-btn-red:hover {
    background: var(--g-red-h)
  }

  .gs-btn-outline {
    background: var(--g-white);
    border-color: var(--g-gray-200);
    color: var(--g-gray-600)
  }

  .gs-btn-outline:hover {
    border-color: var(--g-red);
    color: var(--g-red)
  }

  .gs-btn-ghost {
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px 8px;
    border-radius: var(--g-radius-sm);
    color: var(--g-gray-400);
    display: flex;
    align-items: center;
    transition: all .15s
  }

  .gs-btn-ghost:hover {
    color: var(--g-red);
    background: var(--g-red-light)
  }

  .gs-btn-sm {
    padding: 6px 12px;
    font-size: 12px
  }

  .gs-btn:disabled {
    opacity: .5;
    cursor: not-allowed
  }

  /* ── Field ──────────────────────────────── */
  .gs-field {
    margin-bottom: 18px
  }

  .gs-field:last-of-type {
    margin-bottom: 0
  }

  .gs-field label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 700;
    color: var(--g-gray-600);
    margin-bottom: 6px
  }

  .gs-field label svg {
    color: var(--g-red);
    flex-shrink: 0
  }

  .gs-input {
    width: 100%;
    padding: 10px 13px;
    border: 1.5px solid var(--g-gray-200);
    border-radius: var(--g-radius);
    font-family: Arial;
    font-size: 13px;
    color: var(--g-gray-800);
    outline: none;
    background: var(--g-white);
    transition: border .2s
  }

  .gs-input:focus {
    border-color: var(--g-red)
  }

  .gs-input.error {
    border-color: var(--g-red);
    background: var(--g-red-light)
  }

  textarea.gs-input {
    resize: vertical;
    min-height: 80px;
    line-height: 1.5
  }

  .gs-select {
    width: 100%;
    padding: 10px 13px;
    border: 1.5px solid var(--g-gray-200);
    border-radius: var(--g-radius);
    font-family: Arial;
    font-size: 13px;
    color: var(--g-gray-800);
    outline: none;
    background: var(--g-white);
    cursor: pointer;
    transition: border .2s
  }

  .gs-select:focus {
    border-color: var(--g-red)
  }

  .gs-field-hint {
    font-size: 11px;
    color: var(--g-gray-400);
    margin-top: 5px
  }

  .gs-field-err {
    font-size: 11px;
    color: var(--g-red);
    margin-top: 5px;
    display: none
  }

  .gs-field-err.show {
    display: block
  }

  .gs-char-count {
    font-size: 11px;
    color: var(--g-gray-400);
    text-align: right;
    margin-top: 4px
  }

  /* ── File upload ────────────────────────── */
  .gs-file-zone {
    border: 2px dashed var(--g-gray-200);
    border-radius: var(--g-radius);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all .15s;
    background: var(--g-gray-50)
  }

  .gs-file-zone:hover,
  .gs-file-zone.dragover {
    border-color: var(--g-red);
    background: var(--g-red-light)
  }

  .gs-file-zone input {
    display: none
  }

  .gs-file-zone-text {
    font-size: 13px;
    color: var(--g-gray-400);
    margin-top: 6px
  }

  .gs-file-zone-text strong {
    color: var(--g-red)
  }

  .gs-file-preview {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    background: var(--g-gray-50);
    border: 1px solid var(--g-gray-200);
    border-radius: var(--g-radius);
    margin-top: 10px
  }

  .gs-file-preview img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    border-radius: 4px;
    border: 1px solid var(--g-gray-200);
    background: #fff
  }

  .gs-file-preview-name {
    font-size: 12px;
    font-weight: 700;
    color: var(--g-gray-800);
    flex: 1;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap
  }

  .gs-file-preview-size {
    font-size: 11px;
    color: var(--g-gray-400)
  }

  /* ── Color picker row ───────────────────── */
  .gs-color-row {
    display: flex;
    align-items: center;
    gap: 10px
  }

  .gs-color-input {
    width: 44px;
    height: 38px;
    padding: 3px;
    border: 1.5px solid var(--g-gray-200);
    border-radius: var(--g-radius);
    cursor: pointer;
    background: var(--g-white)
  }

  .gs-color-input:focus {
    border-color: var(--g-red)
  }

  .gs-color-hex {
    flex: 1;
    max-width: 120px
  }

  .gs-color-swatch-row {
    display: flex;
    gap: 6px;
    margin-top: 8px;
    flex-wrap: wrap
  }

  .gs-swatch {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all .15s;
    flex-shrink: 0
  }

  .gs-swatch:hover,
  .gs-swatch.active {
    border-color: var(--g-gray-800);
    transform: scale(1.15)
  }

  /* ── Toggle ─────────────────────────────── */
  .gs-toggle-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid var(--g-gray-100)
  }

  .gs-toggle-row:last-child {
    border-bottom: none
  }

  .gs-toggle-info {
    display: flex;
    align-items: center;
    gap: 10px
  }

  .gs-toggle-icon {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0
  }

  .gs-toggle-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--g-gray-800)
  }

  .gs-toggle-desc {
    font-size: 11px;
    color: var(--g-gray-400);
    margin-top: 2px
  }

  .gs-toggle {
    position: relative;
    width: 44px;
    height: 24px;
    flex-shrink: 0
  }

  .gs-toggle input {
    opacity: 0;
    width: 0;
    height: 0;
    position: absolute
  }

  .gs-toggle-slider {
    position: absolute;
    inset: 0;
    background: var(--g-gray-200);
    border-radius: 24px;
    cursor: pointer;
    transition: background .2s
  }

  .gs-toggle-slider::before {
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

  .gs-toggle input:checked+.gs-toggle-slider {
    background: var(--g-red)
  }

  .gs-toggle input:checked+.gs-toggle-slider::before {
    transform: translateX(20px)
  }

  /* ── Font preview strip ─────────────────── */
  .gs-font-preview {
    padding: 12px 14px;
    background: var(--g-gray-50);
    border: 1px solid var(--g-gray-200);
    border-radius: var(--g-radius);
    margin-top: 8px;
    font-size: 14px;
    color: var(--g-gray-800);
    transition: font-family .2s
  }

  /* ── Theme preview bar ──────────────────── */
  .gs-theme-preview {
    border-radius: var(--g-radius);
    overflow: hidden;
    border: 1px solid var(--g-gray-200);
    margin-top: 12px
  }

  .gs-theme-preview-nav {
    height: 36px;
    display: flex;
    align-items: center;
    padding: 0 14px;
    gap: 8px
  }

  .gs-theme-preview-nav span {
    width: 10px;
    height: 10px;
    border-radius: 50%
  }

  .gs-theme-preview-body {
    padding: 12px 14px;
    background: var(--g-white);
    font-size: 12px;
    color: var(--g-gray-600)
  }

  .gs-theme-preview-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    color: #fff;
    margin-top: 6px
  }

  /* ── Dark mode preview ──────────────────── */
  .gs-dark-preview {
    border-radius: var(--g-radius);
    border: 1px solid var(--g-gray-200);
    overflow: hidden;
    transition: all .3s;
    margin-top: 12px
  }

  .gs-dark-preview-bar {
    height: 32px;
    background: #1e293b;
    display: flex;
    align-items: center;
    padding: 0 12px;
    gap: 6px
  }

  .gs-dark-preview-bar span {
    font-size: 11px;
    color: #94a3b8
  }

  .gs-dark-preview-body {
    padding: 12px 14px;
    background: #0f172a;
    color: #e2e8f0;
    font-size: 12px
  }

  .gs-dark-preview-body.light {
    background: var(--g-white);
    color: var(--g-gray-800)
  }

  /* ── Section footer ─────────────────────── */
  .gs-card-footer {
    padding: 14px 22px;
    border-top: 1px solid var(--g-gray-100);
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    background: var(--g-gray-50)
  }

  /* ── Loading overlay ────────────────────── */
  .gs-loading-overlay {
    display: none;
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, .82);
    z-index: 10;
    align-items: center;
    justify-content: center;
    border-radius: var(--g-radius-lg)
  }

  .gs-loading-overlay.show {
    display: flex
  }

  @keyframes gs-spin {
    to {
      transform: rotate(360deg)
    }
  }

  .gs-spinner {
    width: 26px;
    height: 26px;
    border: 2.5px solid var(--g-red-light);
    border-top-color: var(--g-red);
    border-radius: 50%;
    animation: gs-spin .7s linear infinite
  }

  /* ── Btn loading ────────────────────────── */
  .gs-btn-spinner {
    width: 14px;
    height: 14px;
    border: 2px solid rgba(255, 255, 255, .4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: gs-spin .7s linear infinite;
    flex-shrink: 0
  }

  /* ── Overlay / Modal ────────────────────── */
  .gs-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, .45);
    z-index: 9000;
    align-items: center;
    justify-content: center;
    padding: 16px
  }

  .gs-overlay.open {
    display: flex
  }

  .gs-modal {
    background: var(--g-white);
    border-radius: var(--g-radius-lg);
    width: 100%;
    max-width: 460px;
    max-height: 92vh;
    overflow-y: auto;
    box-shadow: 0 8px 40px rgba(0, 0, 0, .18)
  }

  .gs-modal-sm {
    max-width: 360px
  }

  .gs-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px 13px;
    border-bottom: 1px solid var(--g-gray-200);
    position: sticky;
    top: 0;
    background: var(--g-white);
    z-index: 1
  }

  .gs-modal-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--g-gray-800);
    display: flex;
    align-items: center;
    gap: 8px
  }

  .gs-modal-close {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--g-gray-400);
    padding: 4px;
    border-radius: var(--g-radius-sm);
    display: flex;
    transition: all .15s
  }

  .gs-modal-close:hover {
    color: var(--g-red);
    background: var(--g-red-light)
  }

  .gs-modal-body {
    padding: 20px
  }

  .gs-modal-footer {
    padding: 13px 20px;
    border-top: 1px solid var(--g-gray-200);
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    position: sticky;
    bottom: 0;
    background: var(--g-white)
  }

  /* ── Logo crop preview ──────────────────── */
  .gs-logo-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid var(--g-red);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--g-gray-50);
    flex-shrink: 0
  }

  .gs-logo-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover
  }

  /* ── Toast ──────────────────────────────── */
  .gs-toast-wrap {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 10000;
    display: flex;
    flex-direction: column;
    gap: 8px;
    pointer-events: none
  }

  .gs-toast {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    padding: 12px 16px;
    border-radius: var(--g-radius);
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

  .gs-toast.show {
    opacity: 1;
    transform: translateY(0)
  }

  .gs-toast.success {
    background: var(--g-green)
  }

  .gs-toast.error {
    background: var(--g-red)
  }

  .gs-toast.info {
    background: var(--g-blue)
  }

  .gs-toast.warning {
    background: var(--g-amber)
  }

  .gs-toast-msg {
    flex: 1
  }

  .gs-toast-x {
    background: none;
    border: none;
    cursor: pointer;
    color: rgba(255, 255, 255, .75);
    font-size: 15px
  }

  .gs-toast-x:hover {
    color: #fff
  }

  /* ── Unsaved badge ──────────────────────── */
  .gs-unsaved {
    display: none;
    font-size: 11px;
    font-weight: 700;
    color: var(--g-amber);
    background: var(--g-amber-light);
    padding: 2px 8px;
    border-radius: 20px;
    align-items: center;
    gap: 4px
  }

  .gs-unsaved.show {
    display: inline-flex
  }

  /* ── Divider ────────────────────────────── */
  .gs-divider {
    border: none;
    border-top: 1px solid var(--g-gray-100);
    margin: 16px 0
  }

  /* ── Responsive ─────────────────────────── */
  @media(max-width:640px) {
    .gs-wrap {
      padding: 14px 10px
    }

    .gs-modal {
      max-width: 100%
    }

    .gs-color-row {
      flex-wrap: wrap
    }

    .gs-card-footer {
      flex-direction: column
    }

    .gs-card-footer .gs-btn {
      justify-content: center
    }
  }
</style>

<div class="gs-wrap">

  {{-- ── Page Header ─────────────────────────── --}}
  <div class="gs-page-header">
    <div class="gs-page-title">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
        <circle cx="12" cy="12" r="3" />
        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14" />
        <path d="M12 2v2M12 20v2M2 12h2M20 12h2" />
      </svg>
      Website Settings
    </div>
    <div class="gs-page-sub">Manage your site identity, appearance, and behavior preferences</div>
  </div>


  {{-- ══════════════════════════════════════════ --}}
  {{-- GENERAL SETTINGS                          --}}
  {{-- ══════════════════════════════════════════ --}}
  <div class="gs-card">
    <div class="gs-loading-overlay" id="gsGenLoading">
      <div style="display:flex;flex-direction:column;align-items:center;gap:10px">
        <div class="gs-spinner" style="width:32px;height:32px;border-width:3px"></div>
        <span style="font-size:12px;color:var(--g-gray-600)">Saving…</span>
      </div>
    </div>
    <div class="gs-card-header">
      <div>
        <div class="gs-card-title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <line x1="2" y1="12" x2="22" y2="12" />
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
          </svg>
          General Settings
        </div>
        <div class="gs-card-sub">Site identity, logo, and description</div>
      </div>
      <span class="gs-unsaved" id="gsGenUnsaved">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <circle cx="12" cy="12" r="10" />
          <line x1="12" y1="8" x2="12" y2="12" />
          <line x1="12" y1="16" x2="12.01" y2="16" />
        </svg>
        Unsaved changes
      </span>
    </div>
    <div class="gs-card-body">

      {{-- Website Name --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
            <line x1="7" y1="7" x2="7.01" y2="7" />
          </svg>
          Website Name
        </label>
        <input type="text" class="gs-input" id="gsWebName" value="PUDHO Website" oninput="gsDirty('gsGenUnsaved')">
        <div class="gs-field-err" id="gsWebNameErr">Website name is required</div>
      </div>

      {{-- Tagline --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
          </svg>
          Tagline / Slogan
        </label>
        <input type="text" class="gs-input" id="gsTagline" placeholder="Short slogan shown under site name" oninput="gsDirty('gsGenUnsaved')">
      </div>

      {{-- Logo Upload --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <polyline points="21 15 16 10 5 21" />
          </svg>
          Website Logo
        </label>
        <div class="gs-file-zone" id="gsLogoZone" onclick="document.getElementById('gsLogoInput').click()" ondragover="event.preventDefault();this.classList.add('dragover')" ondragleave="this.classList.remove('dragover')" ondrop="gsHandleDrop(event,'gsLogoInput','gsLogoPreview','gsLogoZone')">
          <input type="file" id="gsLogoInput" accept="image/*" onchange="gsPreviewFile(this,'gsLogoPreview','gsLogoZone');gsDirty('gsGenUnsaved')">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--g-gray-400)" stroke-width="1.5" style="margin:0 auto 6px;display:block">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <polyline points="21 15 16 10 5 21" />
          </svg>
          <div class="gs-file-zone-text">Drag &amp; drop or <strong>click to browse</strong></div>
          <div style="font-size:11px;color:var(--g-gray-400);margin-top:3px">PNG, JPG, SVG — max 2 MB</div>
        </div>
        <div class="gs-file-preview" id="gsLogoPreview" style="display:none">
          <img id="gsLogoPreviewImg" src="" alt="Logo preview">
          <div>
            <div class="gs-file-preview-name" id="gsLogoPreviewName"></div>
            <div class="gs-file-preview-size" id="gsLogoPreviewSize"></div>
          </div>
          <button class="gs-btn-ghost" onclick="gsClearFile('gsLogoInput','gsLogoPreview','gsLogoZone')" title="Remove">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18" />
              <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
          </button>
        </div>
      </div>

      {{-- Favicon Upload --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polygon points="12 2 2 7 12 12 22 7 12 2" />
            <polyline points="2 17 12 22 22 17" />
            <polyline points="2 12 12 17 22 12" />
          </svg>
          Favicon
        </label>
        <div class="gs-file-zone" id="gsFavZone" onclick="document.getElementById('gsFavInput').click()" ondragover="event.preventDefault();this.classList.add('dragover')" ondragleave="this.classList.remove('dragover')" ondrop="gsHandleDrop(event,'gsFavInput','gsFavPreview','gsFavZone')">
          <input type="file" id="gsFavInput" accept="image/*,.ico" onchange="gsPreviewFile(this,'gsFavPreview','gsFavZone');gsDirty('gsGenUnsaved')">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--g-gray-400)" stroke-width="1.5" style="margin:0 auto 6px;display:block">
            <polygon points="12 2 2 7 12 12 22 7 12 2" />
            <polyline points="2 17 12 22 22 17" />
            <polyline points="2 12 12 17 22 12" />
          </svg>
          <div class="gs-file-zone-text">Drag &amp; drop or <strong>click to browse</strong></div>
          <div style="font-size:11px;color:var(--g-gray-400);margin-top:3px">ICO, PNG — 32×32 or 64×64 recommended</div>
        </div>
        <div class="gs-file-preview" id="gsFavPreview" style="display:none">
          <img id="gsFavPreviewImg" src="" alt="Favicon preview">
          <div>
            <div class="gs-file-preview-name" id="gsFavPreviewName"></div>
            <div class="gs-file-preview-size" id="gsFavPreviewSize"></div>
          </div>
          <button class="gs-btn-ghost" onclick="gsClearFile('gsFavInput','gsFavPreview','gsFavZone')" title="Remove">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18" />
              <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
          </button>
        </div>
      </div>

      {{-- Description --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="17" y1="10" x2="3" y2="10" />
            <line x1="21" y1="6" x2="3" y2="6" />
            <line x1="21" y1="14" x2="3" y2="14" />
            <line x1="17" y1="18" x2="3" y2="18" />
          </svg>
          Website Description
        </label>
        <textarea class="gs-input" id="gsDesc" rows="3" maxlength="300" oninput="gsCountChars(this,'gsDescCount');gsDirty('gsGenUnsaved')">This is the official website of the Provincial Urban Development &amp; Housing Office (PUDHO) of Laguna.</textarea>
        <div class="gs-char-count"><span id="gsDescCount">0</span> / 300</div>
      </div>

      {{-- Contact Email + Phone row --}}
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px" class="gs-field">
        <div>
          <label style="font-size:12px;font-weight:700;color:var(--g-gray-600);margin-bottom:6px;display:flex;align-items:center;gap:6px">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
            Contact Email
          </label>
          <input type="email" class="gs-input" id="gsEmail" placeholder="contact@pudho.gov.ph" oninput="gsDirty('gsGenUnsaved')">
        </div>
        <div>
          <label style="font-size:12px;font-weight:700;color:var(--g-gray-600);margin-bottom:6px;display:flex;align-items:center;gap:6px">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12" />
            </svg>
            Phone
          </label>
          <input type="tel" class="gs-input" id="gsPhone" placeholder="+63 49 xxx xxxx" oninput="gsDirty('gsGenUnsaved')">
        </div>
      </div>

      {{-- Copyright Text --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <path d="M14.83 14.83a4 4 0 1 1 0-5.66" />
          </svg>
          Copyright Text
        </label>
        <input type="text" class="gs-input" id="gsCopyright" value="© 2025 PUDHO. All rights reserved." oninput="gsDirty('gsGenUnsaved')">
      </div>

    </div>
    <div class="gs-card-footer">
      <button class="gs-btn gs-btn-outline gs-btn-sm" onclick="gsResetGeneral()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="1 4 1 10 7 10" />
          <path d="M3.51 15a9 9 0 1 0 .49-3.51" />
        </svg>
        Reset
      </button>
      <button class="gs-btn gs-btn-red gs-btn-sm" id="gsSaveGenBtn" onclick="gsSaveGeneral()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
          <polyline points="17 21 17 13 7 13 7 21" />
          <polyline points="7 3 7 8 15 8" />
        </svg>
        Save General Settings
      </button>
    </div>
  </div>


  {{-- ══════════════════════════════════════════ --}}
  {{-- THEME SETTINGS                            --}}
  {{-- ══════════════════════════════════════════ --}}
  <div class="gs-card">
    <div class="gs-loading-overlay" id="gsThemeLoading">
      <div style="display:flex;flex-direction:column;align-items:center;gap:10px">
        <div class="gs-spinner" style="width:32px;height:32px;border-width:3px"></div>
        <span style="font-size:12px;color:var(--g-gray-600)">Applying theme…</span>
      </div>
    </div>
    <div class="gs-card-header">
      <div>
        <div class="gs-card-title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
            <circle cx="13.5" cy="6.5" r="2.5" />
            <circle cx="17.5" cy="10.5" r="2.5" />
            <circle cx="8.5" cy="7.5" r="2.5" />
            <circle cx="6.5" cy="12.5" r="2.5" />
            <path d="M12 20c5 0 9-4 9-8s-4-7-9-7-9 3-9 7 4 8 9 8z" />
          </svg>
          Theme &amp; Appearance
        </div>
        <div class="gs-card-sub">Color palette, typography and preview</div>
      </div>
      <span class="gs-unsaved" id="gsThemeUnsaved">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <circle cx="12" cy="12" r="10" />
          <line x1="12" y1="8" x2="12" y2="12" />
          <line x1="12" y1="16" x2="12.01" y2="16" />
        </svg>
        Unsaved changes
      </span>
    </div>
    <div class="gs-card-body">

      {{-- Primary Color --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10a10 10 0 0 1 0-20z" />
          </svg>
          Primary / Accent Color
        </label>
        <div class="gs-color-row">
          <input type="color" class="gs-color-input" id="gsThemeColor" value="#C0392B" oninput="gsUpdateThemePreview();gsDirty('gsThemeUnsaved')">
          <input type="text" class="gs-input gs-color-hex" id="gsThemeHex" value="#C0392B" oninput="gsHexToColor('gsThemeColor','gsThemeHex');gsUpdateThemePreview();gsDirty('gsThemeUnsaved')" maxlength="7" placeholder="#C0392B">
        </div>
        <div class="gs-color-swatch-row">
          <div class="gs-swatch active" style="background:#C0392B" onclick="gsPickSwatch('#C0392B','gsThemeColor','gsThemeHex')"></div>
          <div class="gs-swatch" style="background:#2980B9" onclick="gsPickSwatch('#2980B9','gsThemeColor','gsThemeHex')"></div>
          <div class="gs-swatch" style="background:#27AE60" onclick="gsPickSwatch('#27AE60','gsThemeColor','gsThemeHex')"></div>
          <div class="gs-swatch" style="background:#8E44AD" onclick="gsPickSwatch('#8E44AD','gsThemeColor','gsThemeHex')"></div>
          <div class="gs-swatch" style="background:#E67E22" onclick="gsPickSwatch('#E67E22','gsThemeColor','gsThemeHex')"></div>
          <div class="gs-swatch" style="background:#1A252F" onclick="gsPickSwatch('#1A252F','gsThemeColor','gsThemeHex')"></div>
          <div class="gs-swatch" style="background:#16A085" onclick="gsPickSwatch('#16A085','gsThemeColor','gsThemeHex')"></div>
        </div>
      </div>

      {{-- Secondary Color --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
          </svg>
          Secondary Color
        </label>
        <div class="gs-color-row">
          <input type="color" class="gs-color-input" id="gsSecColor" value="#1A252F" oninput="gsDirty('gsThemeUnsaved')">
          <input type="text" class="gs-input gs-color-hex" id="gsSecHex" value="#1A252F" oninput="gsHexToColor('gsSecColor','gsSecHex');gsDirty('gsThemeUnsaved')" maxlength="7" placeholder="#1A252F">
        </div>
      </div>

      {{-- Font Style --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="4 7 4 4 20 4 20 7" />
            <line x1="9" y1="20" x2="15" y2="20" />
            <line x1="12" y1="4" x2="12" y2="20" />
          </svg>
          Font Family
        </label>
        <select class="gs-select" id="gsFontFamily" onchange="gsUpdateFontPreview();gsDirty('gsThemeUnsaved')">
          <option value="Arial,sans-serif" selected>Arial (Default)</option>
          <option value="'Times New Roman',serif">Times New Roman (Serif)</option>
          <option value="'Courier New',monospace">Courier New (Monospace)</option>
          <option value="Georgia,serif">Georgia</option>
          <option value="Verdana,sans-serif">Verdana</option>
          <option value="Tahoma,sans-serif">Tahoma</option>
        </select>
        <div class="gs-font-preview" id="gsFontPreview">The quick brown fox jumps over the lazy dog — 0123456789</div>
      </div>

      {{-- Font Size --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="4 7 4 4 20 4 20 7" />
            <line x1="9" y1="20" x2="15" y2="20" />
            <line x1="12" y1="4" x2="12" y2="20" />
          </svg>
          Base Font Size
        </label>
        <select class="gs-select" id="gsFontSize" onchange="gsDirty('gsThemeUnsaved')">
          <option value="13px">Small (13px)</option>
          <option value="14px" selected>Default (14px)</option>
          <option value="15px">Medium (15px)</option>
          <option value="16px">Large (16px)</option>
        </select>
      </div>

      {{-- Theme Preview --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" />
            <line x1="3" y1="9" x2="21" y2="9" />
          </svg>
          Live Preview
        </label>
        <div class="gs-theme-preview" id="gsThemePreviewBox">
          <div class="gs-theme-preview-nav" id="gsThemeNavBar" style="background:#C0392B">
            <span style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,.4)"></span>
            <span style="font-size:11px;color:#fff;font-weight:700;flex:1;margin-left:4px">PUDHO Website</span>
            <span style="font-size:10px;color:rgba(255,255,255,.7)">Admin Panel</span>
          </div>
          <div class="gs-theme-preview-body">
            <div style="font-size:12px;color:#555;margin-bottom:6px">Welcome back, Admin. Here's today's overview.</div>
            <div class="gs-theme-preview-btn" id="gsThemePreviewBtn" style="background:#C0392B">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12" />
              </svg>
              Primary Button
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="gs-card-footer">
      <button class="gs-btn gs-btn-outline gs-btn-sm" onclick="gsResetTheme()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="1 4 1 10 7 10" />
          <path d="M3.51 15a9 9 0 1 0 .49-3.51" />
        </svg>
        Reset
      </button>
      <button class="gs-btn gs-btn-red gs-btn-sm" id="gsSaveThemeBtn" onclick="gsSaveTheme()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
          <polyline points="17 21 17 13 7 13 7 21" />
        </svg>
        Save Theme
      </button>
    </div>
  </div>


  {{-- ══════════════════════════════════════════ --}}
  {{-- ACCOUNT PANEL THEME                       --}}
  {{-- ══════════════════════════════════════════ --}}
  <div class="gs-card">
    <div class="gs-loading-overlay" id="gsAccLoading">
      <div style="display:flex;flex-direction:column;align-items:center;gap:10px">
        <div class="gs-spinner" style="width:32px;height:32px;border-width:3px"></div>
        <span style="font-size:12px;color:var(--g-gray-600)">Saving…</span>
      </div>
    </div>
    <div class="gs-card-header">
      <div>
        <div class="gs-card-title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
          </svg>
          Account Panel Theme
        </div>
        <div class="gs-card-sub">Personalize your admin dashboard appearance</div>
      </div>
      <span class="gs-unsaved" id="gsAccUnsaved">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <circle cx="12" cy="12" r="10" />
          <line x1="12" y1="8" x2="12" y2="12" />
          <line x1="12" y1="16" x2="12.01" y2="16" />
        </svg>
        Unsaved changes
      </span>
    </div>
    <div class="gs-card-body">

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px" class="gs-field">
        <div>
          <label style="font-size:12px;font-weight:700;color:var(--g-gray-600);margin-bottom:6px;display:flex;align-items:center;gap:6px">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
              <rect x="3" y="3" width="18" height="18" rx="2" />
            </svg>
            Background Color
          </label>
          <div class="gs-color-row">
            <input type="color" class="gs-color-input" id="gsAccBg" value="#F8F9FA" oninput="gsUpdateAccPreview();gsDirty('gsAccUnsaved')">
            <input type="text" class="gs-input gs-color-hex" id="gsAccBgHex" value="#F8F9FA" oninput="gsHexToColor('gsAccBg','gsAccBgHex');gsUpdateAccPreview();gsDirty('gsAccUnsaved')" maxlength="7">
          </div>
        </div>
        <div>
          <label style="font-size:12px;font-weight:700;color:var(--g-gray-600);margin-bottom:6px;display:flex;align-items:center;gap:6px">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
              <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
            </svg>
            Text Color
          </label>
          <div class="gs-color-row">
            <input type="color" class="gs-color-input" id="gsAccFont" value="#212529" oninput="gsUpdateAccPreview();gsDirty('gsAccUnsaved')">
            <input type="text" class="gs-input gs-color-hex" id="gsAccFontHex" value="#212529" oninput="gsHexToColor('gsAccFont','gsAccFontHex');gsUpdateAccPreview();gsDirty('gsAccUnsaved')" maxlength="7">
          </div>
        </div>
      </div>

      {{-- Sidebar layout --}}
      <div class="gs-field">
        <label>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" />
            <line x1="9" y1="3" x2="9" y2="21" />
          </svg>
          Sidebar Style
        </label>
        <select class="gs-select" id="gsSidebarStyle" onchange="gsDirty('gsAccUnsaved')">
          <option value="light" selected>Light</option>
          <option value="dark">Dark</option>
          <option value="colored">Colored (uses primary color)</option>
        </select>
      </div>

      {{-- Toggles --}}
      <div style="border:1px solid var(--g-gray-200);border-radius:var(--g-radius);overflow:hidden">
        <div class="gs-toggle-row" style="padding:12px 14px">
          <div class="gs-toggle-info">
            <div class="gs-toggle-icon" style="background:var(--g-gray-100)">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--g-gray-600)" stroke-width="2">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
              </svg>
            </div>
            <div>
              <div class="gs-toggle-label">Dark Mode</div>
              <div class="gs-toggle-desc">Switches account panel to dark theme</div>
            </div>
          </div>
          <label class="gs-toggle">
            <input type="checkbox" id="gsDarkMode" onchange="gsToggleDarkPreview();gsDirty('gsAccUnsaved')">
            <span class="gs-toggle-slider"></span>
          </label>
        </div>
        <div class="gs-toggle-row" style="padding:12px 14px">
          <div class="gs-toggle-info">
            <div class="gs-toggle-icon" style="background:var(--g-blue-light)">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--g-blue)" stroke-width="2">
                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
              </svg>
            </div>
            <div>
              <div class="gs-toggle-label">Compact Mode</div>
              <div class="gs-toggle-desc">Reduce padding and spacing in panels</div>
            </div>
          </div>
          <label class="gs-toggle">
            <input type="checkbox" id="gsCompact" onchange="gsDirty('gsAccUnsaved')">
            <span class="gs-toggle-slider"></span>
          </label>
        </div>
        <div class="gs-toggle-row" style="padding:12px 14px">
          <div class="gs-toggle-info">
            <div class="gs-toggle-icon" style="background:var(--g-green-light)">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--g-green)" stroke-width="2">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
              </svg>
            </div>
            <div>
              <div class="gs-toggle-label">Animations</div>
              <div class="gs-toggle-desc">Enable UI transition animations</div>
            </div>
          </div>
          <label class="gs-toggle">
            <input type="checkbox" id="gsAnimations" checked onchange="gsDirty('gsAccUnsaved')">
            <span class="gs-toggle-slider"></span>
          </label>
        </div>
        <div class="gs-toggle-row" style="padding:12px 14px">
          <div class="gs-toggle-info">
            <div class="gs-toggle-icon" style="background:var(--g-amber-light)">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--g-amber)" stroke-width="2">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                <line x1="7" y1="7" x2="7.01" y2="7" />
              </svg>
            </div>
            <div>
              <div class="gs-toggle-label">Show Breadcrumbs</div>
              <div class="gs-toggle-desc">Display page path navigation</div>
            </div>
          </div>
          <label class="gs-toggle">
            <input type="checkbox" id="gsBreadcrumbs" checked onchange="gsDirty('gsAccUnsaved')">
            <span class="gs-toggle-slider"></span>
          </label>
        </div>
      </div>

      {{-- Account Preview --}}
      <div style="margin-top:14px">
        <div style="font-size:12px;font-weight:700;color:var(--g-gray-600);margin-bottom:8px;display:flex;align-items:center;gap:6px">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" />
            <line x1="3" y1="9" x2="21" y2="9" />
          </svg>
          Account Panel Preview
        </div>
        <div id="gsAccPreviewWrap" style="border:1px solid var(--g-gray-200);border-radius:var(--g-radius);overflow:hidden;transition:all .3s">
          <div id="gsAccPreviewBar" style="background:#C0392B;padding:10px 14px;display:flex;align-items:center;gap:10px">
            <div style="width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg>
            </div>
            <span style="color:#fff;font-size:12px;font-weight:700">Admin Panel</span>
          </div>
          <div id="gsAccPreviewBody" style="background:#F8F9FA;padding:14px;display:flex;gap:10px">
            <div style="width:80px;background:#fff;border-radius:6px;border:1px solid #e0e0e0;padding:8px;font-size:10px;color:#555">
              <div style="height:6px;background:#e0e0e0;border-radius:3px;margin-bottom:6px"></div>
              <div style="height:6px;background:#e0e0e0;border-radius:3px;margin-bottom:6px;width:70%"></div>
              <div style="height:6px;background:#C0392B;border-radius:3px;width:80%"></div>
            </div>
            <div style="flex:1">
              <div id="gsAccPreviewText" style="font-size:12px;color:#212529;font-weight:700;margin-bottom:6px">Dashboard Overview</div>
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px">
                <div style="background:#fff;border:1px solid #e0e0e0;border-radius:6px;padding:8px;font-size:10px;color:#555">4,821 Users</div>
                <div style="background:#fff;border:1px solid #e0e0e0;border-radius:6px;padding:8px;font-size:10px;color:#555">1,340 Posts</div>
              </div>
            </div>
          </div>
        </div>
        <div class="gs-dark-preview" id="gsDarkPreviewWrap" style="display:none">
          <div class="gs-dark-preview-bar">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
              <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
            </svg>
            <span>Dark mode preview</span>
          </div>
          <div class="gs-dark-preview-body">Sidebar and panels appear in dark background with light text for reduced eye strain.</div>
        </div>
      </div>

    </div>
    <div class="gs-card-footer">
      <button class="gs-btn gs-btn-outline gs-btn-sm" onclick="gsResetAccount()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="1 4 1 10 7 10" />
          <path d="M3.51 15a9 9 0 1 0 .49-3.51" />
        </svg>
        Reset
      </button>
      <button class="gs-btn gs-btn-red gs-btn-sm" id="gsSaveAccBtn" onclick="gsSaveAccount()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
          <polyline points="17 21 17 13 7 13 7 21" />
        </svg>
        Save Account Theme
      </button>
    </div>
  </div>


  {{-- ══════════════════════════════════════════ --}}
  {{-- MAINTENANCE & ADVANCED                    --}}
  {{-- ══════════════════════════════════════════ --}}
  <div class="gs-card">
    <div class="gs-card-header">
      <div>
        <div class="gs-card-title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
          </svg>
          Maintenance &amp; Advanced
        </div>
        <div class="gs-card-sub">Site availability, caching and developer options</div>
      </div>
    </div>
    <div class="gs-card-body">
      <div style="border:1px solid var(--g-gray-200);border-radius:var(--g-radius);overflow:hidden">
        <div class="gs-toggle-row" style="padding:12px 14px">
          <div class="gs-toggle-info">
            <div class="gs-toggle-icon" style="background:var(--g-red-light)">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>
            </div>
            <div>
              <div class="gs-toggle-label">Maintenance Mode</div>
              <div class="gs-toggle-desc">Show a maintenance page to all visitors</div>
            </div>
          </div>
          <label class="gs-toggle">
            <input type="checkbox" id="gsMaintenance" onchange="gsToggleMaintenance(this)">
            <span class="gs-toggle-slider"></span>
          </label>
        </div>
        <div class="gs-toggle-row" style="padding:12px 14px">
          <div class="gs-toggle-info">
            <div class="gs-toggle-icon" style="background:var(--g-blue-light)">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--g-blue)" stroke-width="2">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
              </svg>
            </div>
            <div>
              <div class="gs-toggle-label">Enable Cache</div>
              <div class="gs-toggle-desc">Cache pages for faster load times</div>
            </div>
          </div>
          <label class="gs-toggle">
            <input type="checkbox" id="gsCache" checked>
            <span class="gs-toggle-slider"></span>
          </label>
        </div>
        <div class="gs-toggle-row" style="padding:12px 14px">
          <div class="gs-toggle-info">
            <div class="gs-toggle-icon" style="background:var(--g-amber-light)">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--g-amber)" stroke-width="2">
                <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4" />
              </svg>
            </div>
            <div>
              <div class="gs-toggle-label">Debug Mode</div>
              <div class="gs-toggle-desc">Show detailed error messages (dev only)</div>
            </div>
          </div>
          <label class="gs-toggle">
            <input type="checkbox" id="gsDebug">
            <span class="gs-toggle-slider"></span>
          </label>
        </div>
        <div class="gs-toggle-row" style="padding:12px 14px">
          <div class="gs-toggle-info">
            <div class="gs-toggle-icon" style="background:var(--g-green-light)">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--g-green)" stroke-width="2">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
              </svg>
            </div>
            <div>
              <div class="gs-toggle-label">Search Engine Indexing</div>
              <div class="gs-toggle-desc">Allow search engines to crawl the site</div>
            </div>
          </div>
          <label class="gs-toggle">
            <input type="checkbox" id="gsSeo" checked>
            <span class="gs-toggle-slider"></span>
          </label>
        </div>
      </div>
      <div style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap;justify-content:flex-end">
        <button class="gs-btn gs-btn-outline gs-btn-sm" onclick="gsClearCache()">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="1 4 1 10 7 10" />
            <path d="M3.51 15a9 9 0 1 0 .49-3.51" />
          </svg>
          Clear Cache
        </button>
        <button class="gs-btn gs-btn-red gs-btn-sm" onclick="gsSaveAdvanced()">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
            <polyline points="17 21 17 13 7 13 7 21" />
          </svg>
          Save
        </button>
      </div>
    </div>
  </div>

</div>{{-- end gs-wrap --}}


{{-- ════════════════════════════════════ --}}
{{-- UNSAVED CHANGES CONFIRM MODAL       --}}
{{-- ════════════════════════════════════ --}}
<div class="gs-overlay" id="gsResetModal">
  <div class="gs-modal gs-modal-sm" role="dialog" aria-modal="true">
    <div class="gs-modal-body" style="text-align:center;padding:28px 24px">
      <div style="width:50px;height:50px;border-radius:50%;background:var(--g-red-light);display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--g-red)" stroke-width="2">
          <polyline points="1 4 1 10 7 10" />
          <path d="M3.51 15a9 9 0 1 0 .49-3.51" />
        </svg>
      </div>
      <div style="font-size:15px;font-weight:700;color:var(--g-gray-800);margin-bottom:8px">Reset to Defaults?</div>
      <div style="font-size:13px;color:var(--g-gray-600);line-height:1.5">All unsaved changes in this section will be discarded.</div>
    </div>
    <div class="gs-modal-footer" style="justify-content:center;gap:10px">
      <button class="gs-btn gs-btn-outline" onclick="gsCloseModal('gsResetModal')">Cancel</button>
      <button class="gs-btn gs-btn-red" id="gsResetConfirmBtn">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="1 4 1 10 7 10" />
          <path d="M3.51 15a9 9 0 1 0 .49-3.51" />
        </svg>
        Yes, Reset
      </button>
    </div>
  </div>
</div>


{{-- ════════════════════════════════════ --}}
{{-- MAINTENANCE WARNING MODAL           --}}
{{-- ════════════════════════════════════ --}}
<div class="gs-overlay" id="gsMaintenanceModal">
  <div class="gs-modal gs-modal-sm" role="dialog" aria-modal="true">
    <div class="gs-modal-body" style="text-align:center;padding:28px 24px">
      <div style="width:50px;height:50px;border-radius:50%;background:var(--g-amber-light);display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--g-amber)" stroke-width="2">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
          <line x1="12" y1="9" x2="12" y2="13" />
          <line x1="12" y1="17" x2="12.01" y2="17" />
        </svg>
      </div>
      <div style="font-size:15px;font-weight:700;color:var(--g-gray-800);margin-bottom:8px">Enable Maintenance Mode?</div>
      <div style="font-size:13px;color:var(--g-gray-600);line-height:1.5">All visitors will see a maintenance page until you disable this. Admins can still log in.</div>
    </div>
    <div class="gs-modal-footer" style="justify-content:center;gap:10px">
      <button class="gs-btn gs-btn-outline" onclick="gsCancelMaintenance()">Cancel</button>
      <button class="gs-btn gs-btn-red" onclick="gsConfirmMaintenance()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
          <line x1="12" y1="9" x2="12" y2="13" />
        </svg>
        Enable
      </button>
    </div>
  </div>
</div>


{{-- ════════════════════════════════════ --}}
{{-- TOAST                               --}}
{{-- ════════════════════════════════════ --}}
<div class="gs-toast-wrap" id="gsToastWrap"></div>


<script>
  /* ═══════════════════════════════════════
   MODAL HELPERS
═══════════════════════════════════════ */
  function gsOpenModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function gsCloseModal(id) {
    document.getElementById(id).classList.remove('open');
    if (!document.querySelector('.gs-overlay.open')) document.body.style.overflow = '';
  }
  document.querySelectorAll('.gs-overlay').forEach(o => {
    o.addEventListener('click', function(e) {
      if (e.target === this) gsCloseModal(this.id);
    });
  });
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
      const o = document.querySelector('.gs-overlay.open');
      if (o) gsCloseModal(o.id);
    }
  });

  /* ═══════════════════════════════════════
     TOAST
  ═══════════════════════════════════════ */
  function gsToast(msg, type = 'info') {
    const wrap = document.getElementById('gsToastWrap');
    const t = document.createElement('div');
    t.className = `gs-toast ${type}`;
    const icons = {
      success: '<polyline points="20 6 9 17 4 12"/>',
      error: '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
      warning: '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/>',
      info: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>'
    };
    t.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0">${icons[type]||icons.info}</svg><span class="gs-toast-msg">${msg}</span><button class="gs-toast-x" onclick="this.parentElement.remove()">&#10005;</button>`;
    wrap.appendChild(t);
    requestAnimationFrame(() => requestAnimationFrame(() => t.classList.add('show')));
    setTimeout(() => {
      t.classList.remove('show');
      setTimeout(() => t.remove(), 300);
    }, 3500);
  }

  /* ═══════════════════════════════════════
     LOADING & BTN STATE
  ═══════════════════════════════════════ */
  function gsShowLoading(id) {
    document.getElementById(id).classList.add('show');
  }

  function gsHideLoading(id) {
    document.getElementById(id).classList.remove('show');
  }

  function gsBtnLoad(btn, on) {
    if (on) {
      btn._o = btn.innerHTML;
      btn.disabled = true;
      btn.innerHTML = `<div class="gs-btn-spinner"></div> Saving…`;
    } else {
      btn.innerHTML = btn._o;
      btn.disabled = false;
    }
  }

  /* ═══════════════════════════════════════
     DIRTY / UNSAVED
  ═══════════════════════════════════════ */
  function gsDirty(id) {
    document.getElementById(id).classList.add('show');
  }

  function gsClean(id) {
    document.getElementById(id).classList.remove('show');
  }

  /* ═══════════════════════════════════════
     FILE UPLOAD
  ═══════════════════════════════════════ */
  function gsPreviewFile(input, previewId, zoneId) {
    const f = input.files[0];
    if (!f) return;
    if (f.size > 2 * 1024 * 1024) {
      gsToast('File exceeds 2 MB limit', 'error');
      input.value = '';
      return;
    }
    const reader = new FileReader();
    reader.onload = e => {
      const prev = document.getElementById(previewId);
      document.getElementById(previewId + 'Img').src = e.target.result;
      document.getElementById(previewId + 'Name').textContent = f.name;
      document.getElementById(previewId + 'Size').textContent = (f.size / 1024).toFixed(1) + ' KB';
      prev.style.display = 'flex';
      document.getElementById(zoneId).style.display = 'none';
    };
    reader.readAsDataURL(f);
  }

  function gsClearFile(inputId, previewId, zoneId) {
    document.getElementById(inputId).value = '';
    document.getElementById(previewId).style.display = 'none';
    document.getElementById(zoneId).style.display = 'block';
  }

  function gsHandleDrop(e, inputId, previewId, zoneId) {
    e.preventDefault();
    document.getElementById(zoneId).classList.remove('dragover');
    const f = e.dataTransfer.files[0];
    if (!f) return;
    const dt = new DataTransfer();
    dt.items.add(f);
    const inp = document.getElementById(inputId);
    inp.files = dt.files;
    gsPreviewFile(inp, previewId, zoneId);
    gsDirty('gsGenUnsaved');
  }

  /* ═══════════════════════════════════════
     CHAR COUNT
  ═══════════════════════════════════════ */
  function gsCountChars(el, countId) {
    document.getElementById(countId).textContent = el.value.length;
  }

  /* ═══════════════════════════════════════
     COLOR HELPERS
  ═══════════════════════════════════════ */
  function gsHexToColor(colorId, hexId) {
    const hex = document.getElementById(hexId).value;
    if (/^#[0-9A-Fa-f]{6}$/.test(hex)) document.getElementById(colorId).value = hex;
  }

  function gsPickSwatch(hex, colorId, hexId) {
    document.getElementById(colorId).value = hex;
    document.getElementById(hexId).value = hex;
    document.querySelectorAll('.gs-color-swatch-row .gs-swatch').forEach(s => {
      s.classList.toggle('active', s.style.background === hex || s.style.backgroundColor === hex);
    });
    gsUpdateThemePreview();
    gsDirty('gsThemeUnsaved');
  }

  /* ═══════════════════════════════════════
     FONT PREVIEW
  ═══════════════════════════════════════ */
  function gsUpdateFontPreview() {
    const ff = document.getElementById('gsFontFamily').value;
    document.getElementById('gsFontPreview').style.fontFamily = ff;
  }

  /* ═══════════════════════════════════════
     THEME PREVIEW
  ═══════════════════════════════════════ */
  function gsUpdateThemePreview() {
    const c = document.getElementById('gsThemeColor').value;
    document.getElementById('gsThemeHex').value = c;
    document.getElementById('gsThemeNavBar').style.background = c;
    document.getElementById('gsThemePreviewBtn').style.background = c;
    document.getElementById('gsAccPreviewBar').style.background = c;
    gsUpdateAccPreview();
  }

  /* ═══════════════════════════════════════
     ACCOUNT PREVIEW
  ═══════════════════════════════════════ */
  function gsUpdateAccPreview() {
    const bg = document.getElementById('gsAccBg').value;
    const fg = document.getElementById('gsAccFont').value;
    document.getElementById('gsAccBgHex').value = bg;
    document.getElementById('gsAccFontHex').value = fg;
    document.getElementById('gsAccPreviewBody').style.background = bg;
    document.getElementById('gsAccPreviewText').style.color = fg;
  }

  /* ═══════════════════════════════════════
     DARK MODE PREVIEW
  ═══════════════════════════════════════ */
  function gsToggleDarkPreview() {
    const on = document.getElementById('gsDarkMode').checked;
    document.getElementById('gsDarkPreviewWrap').style.display = on ? 'block' : 'none';
    document.getElementById('gsAccPreviewWrap').style.opacity = on ? .4 : 1;
  }

  /* ═══════════════════════════════════════
     SAVE GENERAL
  ═══════════════════════════════════════ */
  function gsSaveGeneral() {
    const name = document.getElementById('gsWebName').value.trim();
    if (!name) {
      document.getElementById('gsWebNameErr').classList.add('show');
      gsToast('Website name is required', 'error');
      return;
    }
    document.getElementById('gsWebNameErr').classList.remove('show');
    const btn = document.getElementById('gsSaveGenBtn');
    gsShowLoading('gsGenLoading');
    gsBtnLoad(btn, true);
    /* Wire to backend:
      const fd = new FormData();
      fd.append('name', name);
      fd.append('description', document.getElementById('gsDesc').value);
      fd.append('logo', document.getElementById('gsLogoInput').files[0]);
      fetch('/admin/settings/general', { method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body: fd })
        .then(r=>r.json()).then(()=>{ gsHideLoading('gsGenLoading'); gsBtnLoad(btn,false); gsClean('gsGenUnsaved'); gsToast('General settings saved','success'); });
    */
    setTimeout(() => {
      gsHideLoading('gsGenLoading');
      gsBtnLoad(btn, false);
      gsClean('gsGenUnsaved');
      gsToast('General settings saved successfully', 'success');
    }, 1200);
  }

  /* ═══════════════════════════════════════
     SAVE THEME
  ═══════════════════════════════════════ */
  function gsSaveTheme() {
    const btn = document.getElementById('gsSaveThemeBtn');
    gsShowLoading('gsThemeLoading');
    gsBtnLoad(btn, true);
    setTimeout(() => {
      gsHideLoading('gsThemeLoading');
      gsBtnLoad(btn, false);
      gsClean('gsThemeUnsaved');
      gsToast('Theme settings saved', 'success');
    }, 1100);
  }

  /* ═══════════════════════════════════════
     SAVE ACCOUNT
  ═══════════════════════════════════════ */
  function gsSaveAccount() {
    const btn = document.getElementById('gsSaveAccBtn');
    gsShowLoading('gsAccLoading');
    gsBtnLoad(btn, true);
    setTimeout(() => {
      gsHideLoading('gsAccLoading');
      gsBtnLoad(btn, false);
      gsClean('gsAccUnsaved');
      gsToast('Account theme saved', 'success');
    }, 1100);
  }

  /* ═══════════════════════════════════════
     SAVE ADVANCED
  ═══════════════════════════════════════ */
  function gsSaveAdvanced() {
    gsToast('Advanced settings saved', 'success');
  }

  /* ═══════════════════════════════════════
     RESET HANDLERS
  ═══════════════════════════════════════ */
  let gsResetTarget = null;

  function gsResetGeneral() {
    gsResetTarget = 'general';
    document.getElementById('gsResetConfirmBtn').onclick = gsDoReset;
    gsOpenModal('gsResetModal');
  }

  function gsResetTheme() {
    gsResetTarget = 'theme';
    document.getElementById('gsResetConfirmBtn').onclick = gsDoReset;
    gsOpenModal('gsResetModal');
  }

  function gsResetAccount() {
    gsResetTarget = 'account';
    document.getElementById('gsResetConfirmBtn').onclick = gsDoReset;
    gsOpenModal('gsResetModal');
  }

  function gsDoReset() {
    gsCloseModal('gsResetModal');
    if (gsResetTarget === 'general') {
      document.getElementById('gsWebName').value = 'PUDHO Website';
      document.getElementById('gsTagline').value = '';
      document.getElementById('gsDesc').value = 'This is the official website of the Provincial Urban Development & Housing Office (PUDHO) of Laguna.';
      document.getElementById('gsEmail').value = '';
      document.getElementById('gsPhone').value = '';
      document.getElementById('gsCopyright').value = '© 2025 PUDHO. All rights reserved.';
      gsClean('gsGenUnsaved');
    } else if (gsResetTarget === 'theme') {
      document.getElementById('gsThemeColor').value = '#C0392B';
      document.getElementById('gsThemeHex').value = '#C0392B';
      document.getElementById('gsSecColor').value = '#1A252F';
      document.getElementById('gsSecHex').value = '#1A252F';
      document.getElementById('gsFontFamily').value = 'Arial,sans-serif';
      gsUpdateFontPreview();
      gsUpdateThemePreview();
      gsClean('gsThemeUnsaved');
    } else if (gsResetTarget === 'account') {
      document.getElementById('gsAccBg').value = '#F8F9FA';
      document.getElementById('gsAccBgHex').value = '#F8F9FA';
      document.getElementById('gsAccFont').value = '#212529';
      document.getElementById('gsAccFontHex').value = '#212529';
      document.getElementById('gsDarkMode').checked = false;
      document.getElementById('gsCompact').checked = false;
      document.getElementById('gsAnimations').checked = true;
      document.getElementById('gsBreadcrumbs').checked = true;
      gsUpdateAccPreview();
      gsToggleDarkPreview();
      gsClean('gsAccUnsaved');
    }
    gsToast('Reset to defaults', 'info');
  }

  /* ═══════════════════════════════════════
     CLEAR CACHE
  ═══════════════════════════════════════ */
  function gsClearCache() {
    gsToast('Clearing cache…', 'info');
    setTimeout(() => gsToast('Cache cleared successfully', 'success'), 1200);
  }

  /* ═══════════════════════════════════════
     MAINTENANCE MODE
  ═══════════════════════════════════════ */
  function gsToggleMaintenance(cb) {
    if (cb.checked) {
      cb.checked = false;
      gsOpenModal('gsMaintenanceModal');
    } else {
      gsToast('Maintenance mode disabled', 'info');
    }
  }

  function gsCancelMaintenance() {
    gsCloseModal('gsMaintenanceModal');
  }

  function gsConfirmMaintenance() {
    document.getElementById('gsMaintenance').checked = true;
    gsCloseModal('gsMaintenanceModal');
    gsToast('Maintenance mode enabled — visitors see maintenance page', 'warning');
  }

  /* ═══════════════════════════════════════
     UNSAVED WARN
  ═══════════════════════════════════════ */
  window.addEventListener('beforeunload', e => {
    const dirty = ['gsGenUnsaved', 'gsThemeUnsaved', 'gsAccUnsaved'].some(id => document.getElementById(id).classList.contains('show'));
    if (dirty) {
      e.preventDefault();
      e.returnValue = '';
    }
  });

  /* ═══════════════════════════════════════
     INIT
  ═══════════════════════════════════════ */
  document.addEventListener('DOMContentLoaded', () => {
    gsCountChars(document.getElementById('gsDesc'), 'gsDescCount');
    gsUpdateFontPreview();
    gsUpdateThemePreview();
    gsUpdateAccPreview();
  });
</script>

@endsection