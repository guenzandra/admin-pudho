@extends('admin.layout')

@section('content')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0
  }

  .rpt-wrap {
    font-family: Arial, sans-serif;
    padding: 24px 20px;
    max-width: 1200px;
    margin: 0 auto
  }

  .rpt-wrap * {
    font-family: Arial, sans-serif
  }

  :root {
    --rpt-red: #C0392B;
    --rpt-red-hover: #a93226;
    --rpt-red-light: #FDECEA;
    --rpt-red-mid: #E74C3C;
    --rpt-white: #fff;
    --rpt-gray-50: #F9F9F9;
    --rpt-gray-100: #F1F1F1;
    --rpt-gray-200: #E0E0E0;
    --rpt-gray-400: #9E9E9E;
    --rpt-gray-600: #555;
    --rpt-gray-800: #222;
    --rpt-blue: #2980B9;
    --rpt-blue-light: #EAF4FB;
    --rpt-green: #27AE60;
    --rpt-green-light: #EAFAF1;
    --rpt-amber: #E67E22;
    --rpt-amber-light: #FEF9EC;
    --rpt-purple: #8E44AD;
    --rpt-purple-light: #F5EEF8;
    --rpt-radius: 8px;
    --rpt-radius-sm: 5px;
    --rpt-radius-lg: 12px;
  }

  /* ── Toolbar ────────────────────────────────── */
  .rpt-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px
  }

  .rpt-search-wrap {
    position: relative;
    flex: 1;
    min-width: 180px;
    max-width: 280px
  }

  .rpt-search-wrap svg {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--rpt-gray-400);
    width: 15px;
    height: 15px;
    pointer-events: none
  }

  .rpt-search-wrap input {
    width: 100%;
    padding: 8px 12px 8px 32px;
    border: 1.5px solid var(--rpt-gray-200);
    border-radius: var(--rpt-radius);
    font-family: Arial;
    font-size: 13px;
    outline: none;
    transition: border .2s;
    background: var(--rpt-white)
  }

  .rpt-search-wrap input:focus {
    border-color: var(--rpt-red)
  }

  /* ── Buttons ─────────────────────────────────── */
  .rpt-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 15px;
    border-radius: var(--rpt-radius);
    font-family: Arial;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    border: 1.5px solid transparent;
    transition: all .15s
  }

  .rpt-btn-outline {
    background: var(--rpt-white);
    border-color: var(--rpt-gray-200);
    color: var(--rpt-gray-600)
  }

  .rpt-btn-outline:hover {
    border-color: var(--rpt-red);
    color: var(--rpt-red)
  }

  .rpt-btn-red {
    background: var(--rpt-red);
    color: #fff;
    border-color: var(--rpt-red)
  }

  .rpt-btn-red:hover {
    background: var(--rpt-red-hover)
  }

  .rpt-btn-ghost {
    background: none;
    border: none;
    padding: 6px;
    cursor: pointer;
    color: var(--rpt-gray-400);
    border-radius: var(--rpt-radius-sm);
    display: flex;
    align-items: center
  }

  .rpt-btn-ghost:hover {
    color: var(--rpt-red);
    background: var(--rpt-red-light)
  }

  /* ── Tab nav ──────────────────────────────────── */
  .rpt-tabs {
    display: flex;
    gap: 4px;
    flex-wrap: wrap;
    margin-bottom: 24px;
    background: var(--rpt-gray-50);
    border: 1px solid var(--rpt-gray-200);
    border-radius: var(--rpt-radius);
    padding: 4px
  }

  .rpt-tab {
    padding: 7px 16px;
    border-radius: var(--rpt-radius-sm);
    font-family: Arial;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    background: transparent;
    color: var(--rpt-gray-600);
    transition: all .15s;
    display: flex;
    align-items: center;
    gap: 6px
  }

  .rpt-tab:hover:not(.active) {
    background: var(--rpt-white);
    color: var(--rpt-gray-800)
  }

  .rpt-tab.active {
    background: var(--rpt-red);
    color: #fff;
    box-shadow: 0 2px 6px rgba(192, 57, 43, .25)
  }

  /* ── Stat cards ───────────────────────────────── */
  .rpt-stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    gap: 14px;
    margin-bottom: 24px
  }

  .rpt-stat-card {
    background: var(--rpt-white);
    border: 1px solid var(--rpt-gray-200);
    border-radius: var(--rpt-radius-lg);
    padding: 16px 18px;
    position: relative;
    overflow: hidden
  }

  .rpt-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    border-radius: var(--rpt-radius-lg) var(--rpt-radius-lg) 0 0
  }

  .rpt-stat-card.red::before {
    background: var(--rpt-red)
  }

  .rpt-stat-card.blue::before {
    background: var(--rpt-blue)
  }

  .rpt-stat-card.green::before {
    background: var(--rpt-green)
  }

  .rpt-stat-card.amber::before {
    background: var(--rpt-amber)
  }

  .rpt-stat-card.purple::before {
    background: var(--rpt-purple)
  }

  .rpt-stat-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px
  }

  .rpt-stat-icon.red {
    background: var(--rpt-red-light)
  }

  .rpt-stat-icon.blue {
    background: var(--rpt-blue-light)
  }

  .rpt-stat-icon.green {
    background: var(--rpt-green-light)
  }

  .rpt-stat-icon.amber {
    background: var(--rpt-amber-light)
  }

  .rpt-stat-icon.purple {
    background: var(--rpt-purple-light)
  }

  .rpt-stat-label {
    font-size: 11px;
    font-weight: 700;
    color: var(--rpt-gray-400);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 4px
  }

  .rpt-stat-value {
    font-size: 26px;
    font-weight: 700;
    color: var(--rpt-gray-800);
    line-height: 1
  }

  .rpt-stat-sub {
    font-size: 11px;
    color: var(--rpt-gray-400);
    margin-top: 4px
  }

  .rpt-stat-trend {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 11px;
    font-weight: 700;
    margin-top: 6px;
    padding: 2px 7px;
    border-radius: 20px
  }

  .rpt-stat-trend.up {
    background: var(--rpt-green-light);
    color: var(--rpt-green)
  }

  .rpt-stat-trend.down {
    background: var(--rpt-red-light);
    color: var(--rpt-red)
  }

  /* ── Chart cards ──────────────────────────────── */
  .rpt-chart-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 16px;
    margin-bottom: 24px
  }

  .rpt-chart-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 24px
  }

  .rpt-card {
    background: var(--rpt-white);
    border: 1px solid var(--rpt-gray-200);
    border-radius: var(--rpt-radius-lg);
    padding: 20px
  }

  .rpt-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px
  }

  .rpt-card-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--rpt-gray-800)
  }

  .rpt-card-sub {
    font-size: 11px;
    color: var(--rpt-gray-400);
    margin-top: 2px
  }

  .rpt-chart-wrap {
    position: relative;
    width: 100%
  }

  /* ── Table ────────────────────────────────────── */
  .rpt-table-wrap {
    background: var(--rpt-white);
    border: 1px solid var(--rpt-gray-200);
    border-radius: var(--rpt-radius-lg);
    overflow: hidden;
    margin-bottom: 24px
  }

  .rpt-table-wrap table {
    width: 100%;
    border-collapse: collapse
  }

  .rpt-table-wrap thead tr {
    background: var(--rpt-gray-50);
    border-bottom: 1.5px solid var(--rpt-gray-200)
  }

  .rpt-table-wrap th {
    padding: 10px 14px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    color: var(--rpt-gray-600);
    letter-spacing: .05em;
    text-transform: uppercase
  }

  .rpt-table-wrap tbody tr {
    border-bottom: 1px solid var(--rpt-gray-100);
    transition: background .12s
  }

  .rpt-table-wrap tbody tr:hover {
    background: var(--rpt-red-light)
  }

  .rpt-table-wrap tbody tr:last-child {
    border-bottom: none
  }

  .rpt-table-wrap td {
    padding: 11px 14px;
    font-size: 13px;
    color: var(--rpt-gray-800);
    vertical-align: middle
  }

  .rpt-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700
  }

  .rpt-badge-active {
    background: var(--rpt-green-light);
    color: var(--rpt-green)
  }

  .rpt-badge-inactive {
    background: var(--rpt-gray-100);
    color: var(--rpt-gray-600)
  }

  .rpt-badge-pending {
    background: var(--rpt-amber-light);
    color: var(--rpt-amber)
  }

  .rpt-badge-red {
    background: var(--rpt-red-light);
    color: var(--rpt-red)
  }

  /* ── Progress bar ─────────────────────────────── */
  .rpt-progress-wrap {
    width: 100%;
    background: var(--rpt-gray-100);
    border-radius: 20px;
    height: 6px;
    overflow: hidden
  }

  .rpt-progress-fill {
    height: 100%;
    border-radius: 20px;
    transition: width .6s ease
  }

  .rpt-progress-fill.red {
    background: var(--rpt-red)
  }

  .rpt-progress-fill.blue {
    background: var(--rpt-blue)
  }

  .rpt-progress-fill.green {
    background: var(--rpt-green)
  }

  .rpt-progress-fill.amber {
    background: var(--rpt-amber)
  }

  .rpt-progress-fill.purple {
    background: var(--rpt-purple)
  }

  /* ── Section panels ───────────────────────────── */
  .rpt-panel {
    display: none
  }

  .rpt-panel.active {
    display: block
  }

  /* ── Overlay / Modal ──────────────────────────── */
  .rpt-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, .45);
    z-index: 9000;
    align-items: center;
    justify-content: center;
    padding: 16px
  }

  .rpt-overlay.open {
    display: flex
  }

  .rpt-modal {
    background: var(--rpt-white);
    border-radius: var(--rpt-radius-lg);
    width: 100%;
    max-width: 500px;
    max-height: 92vh;
    overflow-y: auto;
    box-shadow: 0 8px 40px rgba(0, 0, 0, .18)
  }

  .rpt-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 20px 14px;
    border-bottom: 1px solid var(--rpt-gray-200);
    position: sticky;
    top: 0;
    background: var(--rpt-white);
    z-index: 1
  }

  .rpt-modal-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--rpt-gray-800)
  }

  .rpt-modal-close {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--rpt-gray-400);
    padding: 4px;
    border-radius: var(--rpt-radius-sm);
    display: flex;
    align-items: center;
    transition: all .15s
  }

  .rpt-modal-close:hover {
    color: var(--rpt-red);
    background: var(--rpt-red-light)
  }

  .rpt-modal-body {
    padding: 22px
  }

  .rpt-modal-footer {
    padding: 14px 20px;
    border-top: 1px solid var(--rpt-gray-200);
    display: flex;
    justify-content: flex-end;
    gap: 8px
  }

  .rpt-field {
    margin-bottom: 18px
  }

  .rpt-field label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: var(--rpt-gray-600);
    margin-bottom: 6px
  }

  .rpt-field select,
  .rpt-field input {
    width: 100%;
    padding: 9px 12px;
    border: 1.5px solid var(--rpt-gray-200);
    border-radius: var(--rpt-radius);
    font-family: Arial;
    font-size: 13px;
    outline: none;
    transition: border .2s;
    background: var(--rpt-white);
    color: var(--rpt-gray-800)
  }

  .rpt-field select:focus,
  .rpt-field input:focus {
    border-color: var(--rpt-red)
  }

  .rpt-field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px
  }

  .rpt-toggle-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px
  }

  .rpt-toggle-row label {
    font-size: 13px;
    color: var(--rpt-gray-700)
  }

  .rpt-radio-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap
  }

  .rpt-radio-opt {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border: 1.5px solid var(--rpt-gray-200);
    border-radius: var(--rpt-radius);
    cursor: pointer;
    font-size: 13px;
    color: var(--rpt-gray-600);
    transition: all .15s
  }

  .rpt-radio-opt.selected {
    border-color: var(--rpt-red);
    background: var(--rpt-red-light);
    color: var(--rpt-red);
    font-weight: 700
  }

  .rpt-format-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px
  }

  .rpt-format-opt {
    border: 1.5px solid var(--rpt-gray-200);
    border-radius: var(--rpt-radius);
    padding: 12px;
    cursor: pointer;
    text-align: center;
    transition: all .15s
  }

  .rpt-format-opt:hover {
    border-color: var(--rpt-red);
    background: var(--rpt-red-light)
  }

  .rpt-format-opt.selected {
    border-color: var(--rpt-red);
    background: var(--rpt-red-light)
  }

  .rpt-format-opt svg {
    display: block;
    margin: 0 auto 6px
  }

  .rpt-format-opt span {
    font-size: 12px;
    font-weight: 700;
    color: var(--rpt-gray-700)
  }

  .rpt-format-opt.selected span {
    color: var(--rpt-red)
  }

  /* ── Legend dot ───────────────────────────────── */
  .rpt-legend {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-top: 10px
  }

  .rpt-legend-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: var(--rpt-gray-600)
  }

  .rpt-legend-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0
  }

  /* ── Divider ──────────────────────────────────── */
  .rpt-divider {
    border: none;
    border-top: 1px solid var(--rpt-gray-100);
    margin: 16px 0
  }

  /* ── No-data ──────────────────────────────────── */
  .rpt-nodata {
    text-align: center;
    padding: 32px;
    color: var(--rpt-gray-400);
    font-size: 13px;
    font-style: italic
  }

  /* ── Responsive ───────────────────────────────── */
  @media(max-width:900px) {
    .rpt-chart-grid {
      grid-template-columns: 1fr
    }

    .rpt-chart-grid-3 {
      grid-template-columns: 1fr 1fr
    }
  }

  @media(max-width:600px) {
    .rpt-wrap {
      padding: 14px 10px
    }

    .rpt-stat-grid {
      grid-template-columns: 1fr 1fr
    }

    .rpt-chart-grid-3 {
      grid-template-columns: 1fr
    }

    .rpt-tabs {
      gap: 2px
    }

    .rpt-tab {
      padding: 6px 10px;
      font-size: 12px
    }

    .rpt-field-row {
      grid-template-columns: 1fr
    }

    .rpt-format-grid {
      grid-template-columns: 1fr 1fr
    }

    .rpt-modal {
      max-width: 100%
    }

    .rpt-toolbar {
      gap: 8px
    }

    .rpt-search-wrap {
      max-width: 100%
    }
  }
</style>

<div class="rpt-wrap">

  {{-- ── Toolbar ──────────────────────────────────────── --}}
  <div class="rpt-toolbar">
    <div class="rpt-search-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8" />
        <path d="m21 21-4.35-4.35" />
      </svg>
      <input type="text" id="rptSearchInput" placeholder="Search reports..." oninput="rptSearch()">
    </div>
    <button class="rpt-btn rpt-btn-red" onclick="rptOpenModal()">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
        <polyline points="14 2 14 8 20 8" />
        <line x1="12" y1="18" x2="12" y2="12" />
        <line x1="9" y1="15" x2="15" y2="15" />
      </svg>
      Generate Report
    </button>
  </div>

  {{-- ── Tab Nav ───────────────────────────────────────── --}}
  <div class="rpt-tabs">
    <button class="rpt-tab active" data-tab="overall" onclick="rptSetTab('overall',this)">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7" />
        <rect x="14" y="3" width="7" height="7" />
        <rect x="14" y="14" width="7" height="7" />
        <rect x="3" y="14" width="7" height="7" />
      </svg>
      Overall
    </button>
    <button class="rpt-tab" data-tab="users" onclick="rptSetTab('users',this)">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
        <circle cx="9" cy="7" r="4" />
        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
      </svg>
      User Reports
    </button>
    <button class="rpt-tab" data-tab="posts" onclick="rptSetTab('posts',this)">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
        <polyline points="14 2 14 8 20 8" />
        <line x1="16" y1="13" x2="8" y2="13" />
        <line x1="16" y1="17" x2="8" y2="17" />
        <polyline points="10 9 9 9 8 9" />
      </svg>
      Post Reports
    </button>
    <button class="rpt-tab" data-tab="app" onclick="rptSetTab('app',this)">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
        <line x1="12" y1="18" x2="12.01" y2="18" />
      </svg>
      App Reports
    </button>
    <button class="rpt-tab" data-tab="faqs" onclick="rptSetTab('faqs',this)">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10" />
        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
        <line x1="12" y1="17" x2="12.01" y2="17" />
      </svg>
      FAQs Reports
    </button>
  </div>

  {{-- ═══════════════════════════════════════════════════════════ --}}
  {{-- TAB: OVERALL                                               --}}
  {{-- ═══════════════════════════════════════════════════════════ --}}
  <div class="rpt-panel active" id="rpt-panel-overall">

    <div class="rpt-stat-grid">
      <div class="rpt-stat-card red">
        <div class="rpt-stat-icon red">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-red)" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
        </div>
        <div class="rpt-stat-label">Total Users</div>
        <div class="rpt-stat-value">4,821</div>
        <span class="rpt-stat-trend up">&#9650; 12% this month</span>
      </div>
      <div class="rpt-stat-card blue">
        <div class="rpt-stat-icon blue">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-blue)" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
          </svg>
        </div>
        <div class="rpt-stat-label">Total Posts</div>
        <div class="rpt-stat-value">1,340</div>
        <span class="rpt-stat-trend up">&#9650; 8% this month</span>
      </div>
      <div class="rpt-stat-card green">
        <div class="rpt-stat-icon green">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-green)" stroke-width="2">
            <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
            <line x1="12" y1="18" x2="12.01" y2="18" />
          </svg>
        </div>
        <div class="rpt-stat-label">App Downloads</div>
        <div class="rpt-stat-value">9,204</div>
        <span class="rpt-stat-trend up">&#9650; 21% this month</span>
      </div>
      <div class="rpt-stat-card amber">
        <div class="rpt-stat-icon amber">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-amber)" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg>
        </div>
        <div class="rpt-stat-label">FAQs Answered</div>
        <div class="rpt-stat-value">286</div>
        <span class="rpt-stat-trend down">&#9660; 3% this month</span>
      </div>
      <div class="rpt-stat-card purple">
        <div class="rpt-stat-icon purple">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-purple)" stroke-width="2">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
          </svg>
        </div>
        <div class="rpt-stat-label">Active Sessions</div>
        <div class="rpt-stat-value">143</div>
        <span class="rpt-stat-trend up">&#9650; 5% today</span>
      </div>
    </div>

    <div class="rpt-chart-grid">
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">Platform Activity — 2025</div>
            <div class="rpt-card-sub">Users, Posts &amp; App Downloads per month</div>
          </div>
          <button class="rpt-btn-ghost" title="More options">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="5" r="1" />
              <circle cx="12" cy="12" r="1" />
              <circle cx="12" cy="19" r="1" />
            </svg>
          </button>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptOverallBarChart" height="200"></canvas></div>
        <div class="rpt-legend">
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-red)"></div>Users
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-blue)"></div>Posts
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-green)"></div>Downloads
          </div>
        </div>
      </div>
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">Content Breakdown</div>
            <div class="rpt-card-sub">Distribution by category</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptOverallPieChart" height="200"></canvas></div>
        <div class="rpt-legend" style="justify-content:center">
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-red)"></div>Users
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-blue)"></div>Posts
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-green)"></div>App
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-amber)"></div>FAQs
          </div>
        </div>
      </div>
    </div>

    <div class="rpt-card" style="margin-bottom:24px">
      <div class="rpt-card-header">
        <div>
          <div class="rpt-card-title">Monthly Trend — All Metrics</div>
          <div class="rpt-card-sub">12-month rolling performance</div>
        </div>
      </div>
      <div class="rpt-chart-wrap"><canvas id="rptOverallLineChart" height="130"></canvas></div>
    </div>

  </div>{{-- end overall --}}


  {{-- ═══════════════════════════════════════════════════════════ --}}
  {{-- TAB: USERS                                                 --}}
  {{-- ═══════════════════════════════════════════════════════════ --}}
  <div class="rpt-panel" id="rpt-panel-users">

    <div class="rpt-stat-grid">
      <div class="rpt-stat-card red">
        <div class="rpt-stat-icon red">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-red)" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
          </svg>
        </div>
        <div class="rpt-stat-label">Total Users</div>
        <div class="rpt-stat-value">4,821</div>
        <div class="rpt-stat-sub">Registered accounts</div>
      </div>
      <div class="rpt-stat-card green">
        <div class="rpt-stat-icon green">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-green)" stroke-width="2">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
          </svg>
        </div>
        <div class="rpt-stat-label">Active This Month</div>
        <div class="rpt-stat-value">2,104</div>
        <span class="rpt-stat-trend up">&#9650; 9.4%</span>
      </div>
      <div class="rpt-stat-card blue">
        <div class="rpt-stat-icon blue">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-blue)" stroke-width="2">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <line x1="19" y1="8" x2="19" y2="14" />
            <line x1="22" y1="11" x2="16" y2="11" />
          </svg>
        </div>
        <div class="rpt-stat-label">New This Month</div>
        <div class="rpt-stat-value">318</div>
        <span class="rpt-stat-trend up">&#9650; 12%</span>
      </div>
      <div class="rpt-stat-card amber">
        <div class="rpt-stat-icon amber">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-amber)" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <line x1="12" y1="8" x2="12" y2="12" />
            <line x1="12" y1="16" x2="12.01" y2="16" />
          </svg>
        </div>
        <div class="rpt-stat-label">Inactive / Flagged</div>
        <div class="rpt-stat-value">94</div>
        <span class="rpt-stat-trend down">&#9660; 2%</span>
      </div>
    </div>

    <div class="rpt-chart-grid">
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">User Registrations — 2025</div>
            <div class="rpt-card-sub">New users per month</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptUserBarChart" height="200"></canvas></div>
      </div>
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">User Status</div>
            <div class="rpt-card-sub">Active vs Inactive vs Flagged</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptUserDoughnut" height="200"></canvas></div>
        <div class="rpt-legend" style="justify-content:center;margin-top:8px">
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-green)"></div>Active
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-gray-400)"></div>Inactive
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-red)"></div>Flagged
          </div>
        </div>
      </div>
    </div>

    {{-- User Activity Table --}}
    <div class="rpt-card-header" style="margin-bottom:10px">
      <div>
        <div class="rpt-card-title">User Activity Log</div>
        <div class="rpt-card-sub" style="font-size:11px;color:var(--rpt-gray-400)">Recent account activity — Anti Squatting mobile application</div>
      </div>
    </div>
    <div class="rpt-table-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>User</th>
            <th>Role</th>
            <th>Last Active</th>
            <th>Posts</th>
            <th>Sessions</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="rptUserTableBody"></tbody>
      </table>
    </div>

    {{-- Top Active Users Bar --}}
    <div class="rpt-card">
      <div class="rpt-card-header">
        <div>
          <div class="rpt-card-title">Top 5 Most Active Users</div>
          <div class="rpt-card-sub">By number of sessions this month</div>
        </div>
      </div>
      <div id="rptTopUsers"></div>
    </div>

  </div>{{-- end users --}}


  {{-- ═══════════════════════════════════════════════════════════ --}}
  {{-- TAB: POSTS                                                 --}}
  {{-- ═══════════════════════════════════════════════════════════ --}}
  <div class="rpt-panel" id="rpt-panel-posts">

    <div class="rpt-stat-grid">
      <div class="rpt-stat-card blue">
        <div class="rpt-stat-icon blue">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-blue)" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
          </svg>
        </div>
        <div class="rpt-stat-label">Total Posts</div>
        <div class="rpt-stat-value">1,340</div>
        <span class="rpt-stat-trend up">&#9650; 8%</span>
      </div>
      <div class="rpt-stat-card green">
        <div class="rpt-stat-icon green">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-green)" stroke-width="2">
            <polyline points="20 6 9 17 4 12" />
          </svg>
        </div>
        <div class="rpt-stat-label">Approved</div>
        <div class="rpt-stat-value">1,102</div>
        <div class="rpt-stat-sub">82% of total</div>
      </div>
      <div class="rpt-stat-card amber">
        <div class="rpt-stat-icon amber">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-amber)" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <line x1="12" y1="8" x2="12" y2="12" />
            <line x1="12" y1="16" x2="12.01" y2="16" />
          </svg>
        </div>
        <div class="rpt-stat-label">Pending Review</div>
        <div class="rpt-stat-value">178</div>
        <div class="rpt-stat-sub">13% of total</div>
      </div>
      <div class="rpt-stat-card red">
        <div class="rpt-stat-icon red">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-red)" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <line x1="15" y1="9" x2="9" y2="15" />
            <line x1="9" y1="9" x2="15" y2="15" />
          </svg>
        </div>
        <div class="rpt-stat-label">Rejected / Flagged</div>
        <div class="rpt-stat-value">60</div>
        <div class="rpt-stat-sub">5% of total</div>
      </div>
    </div>

    <div class="rpt-chart-grid">
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">Post Submissions — 2025</div>
            <div class="rpt-card-sub">Monthly post volume</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptPostLineChart" height="200"></canvas></div>
      </div>
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">Post Status</div>
            <div class="rpt-card-sub">Approved vs Pending vs Rejected</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptPostPie" height="200"></canvas></div>
        <div class="rpt-legend" style="justify-content:center;margin-top:8px">
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-green)"></div>Approved
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-amber)"></div>Pending
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-red)"></div>Rejected
          </div>
        </div>
      </div>
    </div>

    <div class="rpt-card-header" style="margin-bottom:10px">
      <div>
        <div class="rpt-card-title">Recent Posts</div>
        <div class="rpt-card-sub" style="font-size:11px;color:var(--rpt-gray-400)">Latest submissions across all users</div>
      </div>
    </div>
    <div class="rpt-table-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="rptPostTableBody"></tbody>
      </table>
    </div>

  </div>{{-- end posts --}}


  {{-- ═══════════════════════════════════════════════════════════ --}}
  {{-- TAB: APP                                                   --}}
  {{-- ═══════════════════════════════════════════════════════════ --}}
  <div class="rpt-panel" id="rpt-panel-app">

    <div class="rpt-stat-grid">
      <div class="rpt-stat-card green">
        <div class="rpt-stat-icon green">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-green)" stroke-width="2">
            <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
            <line x1="12" y1="18" x2="12.01" y2="18" />
          </svg>
        </div>
        <div class="rpt-stat-label">Total Downloads</div>
        <div class="rpt-stat-value">9,204</div>
        <span class="rpt-stat-trend up">&#9650; 21%</span>
      </div>
      <div class="rpt-stat-card blue">
        <div class="rpt-stat-icon blue">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-blue)" stroke-width="2">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
          </svg>
        </div>
        <div class="rpt-stat-label">Daily Active</div>
        <div class="rpt-stat-value">1,847</div>
        <span class="rpt-stat-trend up">&#9650; 5%</span>
      </div>
      <div class="rpt-stat-card amber">
        <div class="rpt-stat-icon amber">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-amber)" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
          </svg>
        </div>
        <div class="rpt-stat-label">Avg. Session</div>
        <div class="rpt-stat-value">4m 32s</div>
        <div class="rpt-stat-sub">Per user per day</div>
      </div>
      <div class="rpt-stat-card red">
        <div class="rpt-stat-icon red">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-red)" stroke-width="2">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg>
        </div>
        <div class="rpt-stat-label">Crash Reports</div>
        <div class="rpt-stat-value">12</div>
        <span class="rpt-stat-trend down">&#9660; 40% fewer</span>
      </div>
    </div>

    <div class="rpt-chart-grid">
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">Downloads &amp; DAU — 2025</div>
            <div class="rpt-card-sub">Monthly download volume and daily active users</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptAppLineChart" height="200"></canvas></div>
        <div class="rpt-legend">
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-green)"></div>Downloads
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-blue)"></div>Daily Active Users
          </div>
        </div>
      </div>
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">Platform Split</div>
            <div class="rpt-card-sub">iOS vs Android</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptAppPlatformPie" height="200"></canvas></div>
        <div class="rpt-legend" style="justify-content:center;margin-top:8px">
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-blue)"></div>iOS
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-green)"></div>Android
          </div>
        </div>
      </div>
    </div>

    <div class="rpt-card-header" style="margin-bottom:10px">
      <div>
        <div class="rpt-card-title">Feature Usage</div>
        <div class="rpt-card-sub" style="font-size:11px;color:var(--rpt-gray-400)">How users interact with app features</div>
      </div>
    </div>
    <div class="rpt-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Feature</th>
            <th>Users</th>
            <th>Sessions</th>
            <th>Avg. Time</th>
            <th>Usage Rate</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="font-weight:600">Property Search</td>
            <td>3,210</td>
            <td>18,400</td>
            <td>3m 42s</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill blue" style="width:78%"></div>
                </div><span style="font-size:12px">78%</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-weight:600">Report Squatting</td>
            <td>2,104</td>
            <td>9,200</td>
            <td>5m 10s</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill red" style="width:64%"></div>
                </div><span style="font-size:12px">64%</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-weight:600">View Case Status</td>
            <td>1,840</td>
            <td>7,100</td>
            <td>2m 20s</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill green" style="width:55%"></div>
                </div><span style="font-size:12px">55%</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-weight:600">Community Posts</td>
            <td>1,340</td>
            <td>5,400</td>
            <td>4m 05s</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill amber" style="width:41%"></div>
                </div><span style="font-size:12px">41%</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-weight:600">FAQ &amp; Help</td>
            <td>820</td>
            <td>2,100</td>
            <td>1m 50s</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill purple" style="width:25%"></div>
                </div><span style="font-size:12px">25%</span>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>{{-- end app --}}


  {{-- ═══════════════════════════════════════════════════════════ --}}
  {{-- TAB: FAQs                                                  --}}
  {{-- ═══════════════════════════════════════════════════════════ --}}
  <div class="rpt-panel" id="rpt-panel-faqs">

    <div class="rpt-stat-grid">
      <div class="rpt-stat-card amber">
        <div class="rpt-stat-icon amber">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-amber)" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg>
        </div>
        <div class="rpt-stat-label">Total FAQs</div>
        <div class="rpt-stat-value">342</div>
        <div class="rpt-stat-sub">All time</div>
      </div>
      <div class="rpt-stat-card green">
        <div class="rpt-stat-icon green">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-green)" stroke-width="2">
            <polyline points="20 6 9 17 4 12" />
          </svg>
        </div>
        <div class="rpt-stat-label">Answered</div>
        <div class="rpt-stat-value">286</div>
        <div class="rpt-stat-sub">84% response rate</div>
      </div>
      <div class="rpt-stat-card red">
        <div class="rpt-stat-icon red">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-red)" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
          </svg>
        </div>
        <div class="rpt-stat-label">Pending</div>
        <div class="rpt-stat-value">56</div>
        <span class="rpt-stat-trend down">&#9660; 3 this week</span>
      </div>
      <div class="rpt-stat-card blue">
        <div class="rpt-stat-icon blue">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-blue)" stroke-width="2">
            <polyline points="21 8 21 21 3 21 3 8" />
            <rect x="1" y="3" width="22" height="5" />
            <line x1="10" y1="12" x2="14" y2="12" />
          </svg>
        </div>
        <div class="rpt-stat-label">Archived</div>
        <div class="rpt-stat-value">48</div>
        <div class="rpt-stat-sub">14% of total</div>
      </div>
    </div>

    <div class="rpt-chart-grid">
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">FAQ Submissions — 2025</div>
            <div class="rpt-card-sub">Questions submitted vs answered per month</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptFaqBarChart" height="200"></canvas></div>
        <div class="rpt-legend">
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-amber)"></div>Submitted
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-green)"></div>Answered
          </div>
        </div>
      </div>
      <div class="rpt-card">
        <div class="rpt-card-header">
          <div>
            <div class="rpt-card-title">Response Status</div>
            <div class="rpt-card-sub">Current FAQ status breakdown</div>
          </div>
        </div>
        <div class="rpt-chart-wrap"><canvas id="rptFaqDoughnut" height="200"></canvas></div>
        <div class="rpt-legend" style="justify-content:center;margin-top:8px">
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-green)"></div>Answered
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-red)"></div>Pending
          </div>
          <div class="rpt-legend-item">
            <div class="rpt-legend-dot" style="background:var(--rpt-gray-400)"></div>Archived
          </div>
        </div>
      </div>
    </div>

    <div class="rpt-card-header" style="margin-bottom:10px">
      <div>
        <div class="rpt-card-title">Top FAQ Categories</div>
        <div class="rpt-card-sub" style="font-size:11px;color:var(--rpt-gray-400)">By volume of questions received</div>
      </div>
    </div>
    <div class="rpt-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Category</th>
            <th>Questions</th>
            <th>Answered</th>
            <th>Pending</th>
            <th>Rate</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="font-weight:600">Account &amp; Login</td>
            <td>84</td>
            <td>76</td>
            <td>8</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill green" style="width:90%"></div>
                </div><span style="font-size:12px">90%</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-weight:600">Property Listings</td>
            <td>72</td>
            <td>60</td>
            <td>12</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill blue" style="width:83%"></div>
                </div><span style="font-size:12px">83%</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-weight:600">Reporting Issues</td>
            <td>65</td>
            <td>50</td>
            <td>15</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill amber" style="width:77%"></div>
                </div><span style="font-size:12px">77%</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-weight:600">Payments &amp; Billing</td>
            <td>58</td>
            <td>44</td>
            <td>14</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill red" style="width:76%"></div>
                </div><span style="font-size:12px">76%</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="font-weight:600">App Technical</td>
            <td>63</td>
            <td>56</td>
            <td>7</td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="rpt-progress-wrap" style="width:100px">
                  <div class="rpt-progress-fill purple" style="width:89%"></div>
                </div><span style="font-size:12px">89%</span>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>{{-- end faqs --}}

</div>{{-- end .rpt-wrap --}}


{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- GENERATE REPORT MODAL                                      --}}
{{-- ═══════════════════════════════════════════════════════════ --}}
<div class="rpt-overlay" id="rptGenerateModal">
  <div class="rpt-modal" role="dialog" aria-modal="true" aria-labelledby="rptModalTitle">
    <div class="rpt-modal-header">
      <span class="rpt-modal-title" id="rptModalTitle">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-red)" stroke-width="2"
          style="vertical-align:-2px;margin-right:5px">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
          <polyline points="14 2 14 8 20 8" />
          <line x1="12" y1="18" x2="12" y2="12" />
          <line x1="9" y1="15" x2="15" y2="15" />
        </svg>
        Generate Report
      </span>
      <button class="rpt-modal-close" onclick="rptCloseModal()" aria-label="Close">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>

    <div class="rpt-modal-body">

      {{-- Report Type --}}
      <div class="rpt-field">
        <label>Report Type</label>
        <select id="rptModalType">
          <option value="overall">Overall</option>
          <option value="users">User Reports</option>
          <option value="posts">Post Reports</option>
          <option value="app">App Reports</option>
          <option value="faqs">FAQs Reports</option>
        </select>
      </div>

      {{-- Date range mode --}}
      <div class="rpt-field">
        <label>Date Range</label>
        <div class="rpt-radio-group" id="rptDateModeGroup">
          <div class="rpt-radio-opt selected" data-mode="year" onclick="rptSelectDateMode('year',this)">By Year</div>
          <div class="rpt-radio-opt" data-mode="range" onclick="rptSelectDateMode('range',this)">Date Range</div>
        </div>
      </div>

      <div id="rptYearField" class="rpt-field">
        <label>Year</label>
        <select id="rptModalYear">
          <option>2025</option>
          <option>2024</option>
          <option>2023</option>
          <option>2022</option>
        </select>
      </div>

      <div id="rptRangeField" class="rpt-field" style="display:none">
        <label>From — To</label>
        <div class="rpt-field-row">
          <input type="date" id="rptDateFrom">
          <input type="date" id="rptDateTo">
        </div>
      </div>

      {{-- Format --}}
      <div class="rpt-field">
        <label>Export Format</label>
        <div class="rpt-format-grid">
          <div class="rpt-format-opt selected" data-fmt="pdf" onclick="rptSelectFmt('pdf',this)">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-red)" stroke-width="1.8">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
              <polyline points="14 2 14 8 20 8" />
              <line x1="9" y1="15" x2="15" y2="15" />
            </svg>
            <span>PDF</span>
          </div>
          <div class="rpt-format-opt" data-fmt="excel" onclick="rptSelectFmt('excel',this)">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-green)" stroke-width="1.8">
              <rect x="3" y="3" width="18" height="18" rx="2" />
              <line x1="3" y1="9" x2="21" y2="9" />
              <line x1="3" y1="15" x2="21" y2="15" />
              <line x1="9" y1="9" x2="9" y2="21" />
            </svg>
            <span>Excel</span>
          </div>
          <div class="rpt-format-opt" data-fmt="csv" onclick="rptSelectFmt('csv',this)">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--rpt-blue)" stroke-width="1.8">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
              <polyline points="14 2 14 8 20 8" />
              <line x1="8" y1="13" x2="16" y2="13" />
              <line x1="8" y1="17" x2="16" y2="17" />
            </svg>
            <span>CSV</span>
          </div>
        </div>
      </div>

    </div>

    <div class="rpt-modal-footer">
      <button class="rpt-btn rpt-btn-outline" onclick="rptCloseModal()">Cancel</button>
      <button class="rpt-btn rpt-btn-red" onclick="rptDoGenerate()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="8 17 12 21 16 17" />
          <line x1="12" y1="12" x2="12" y2="21" />
          <path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29" />
        </svg>
        Generate &amp; Download
      </button>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
  /* ── Helpers ─────────────────────────────────────────── */
  const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

  Chart.defaults.font.family = 'Arial';
  Chart.defaults.font.size = 12;
  Chart.defaults.color = '#555';

  const rptChartOpts = (extra = {}) => ({
    responsive: true,
    maintainAspectRatio: true,
    plugins: {
      legend: {
        display: false
      },
      tooltip: {
        bodyFont: {
          family: 'Arial'
        }
      }
    },
    ...extra
  });

  /* ── Tab switching ───────────────────────────────────── */
  function rptSetTab(tab, el) {
    document.querySelectorAll('.rpt-tab').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    document.querySelectorAll('.rpt-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('rpt-panel-' + tab).classList.add('active');
  }

  /* ── Search (highlights tabs that match) ────────────── */
  function rptSearch() {
    // Extend this to filter table rows as needed
  }

  /* ── Modal ───────────────────────────────────────────── */
  function rptOpenModal() {
    document.getElementById('rptGenerateModal').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function rptCloseModal() {
    document.getElementById('rptGenerateModal').classList.remove('open');
    document.body.style.overflow = '';
  }
  document.getElementById('rptGenerateModal').addEventListener('click', function(e) {
    if (e.target === this) rptCloseModal();
  });
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') rptCloseModal();
  });

  function rptSelectDateMode(mode, el) {
    document.querySelectorAll('#rptDateModeGroup .rpt-radio-opt').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('rptYearField').style.display = mode === 'year' ? '' : 'none';
    document.getElementById('rptRangeField').style.display = mode === 'range' ? '' : 'none';
  }

  function rptSelectFmt(fmt, el) {
    document.querySelectorAll('.rpt-format-opt').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
  }

  function rptDoGenerate() {
    /* Wire this to your Laravel backend route, e.g.:
       const type   = document.getElementById('rptModalType').value;
       const year   = document.getElementById('rptModalYear').value;
       const format = document.querySelector('.rpt-format-opt.selected').dataset.fmt;
       window.location.href = `/admin/reports/download?type=${type}&year=${year}&format=${format}`;
    */
    alert('Report generation triggered. Wire this to your backend route.');
    rptCloseModal();
  }

  /* ── User table data ─────────────────────────────────── */
  const rptUsers = [{
      name: 'Maria Santos',
      role: 'Admin',
      last: '2025-04-06',
      posts: 142,
      sessions: 98,
      status: 'active'
    },
    {
      name: 'Juan dela Cruz',
      role: 'User',
      last: '2025-04-05',
      posts: 34,
      sessions: 41,
      status: 'active'
    },
    {
      name: 'Ana Reyes',
      role: 'User',
      last: '2025-03-28',
      posts: 12,
      sessions: 9,
      status: 'inactive'
    },
    {
      name: 'Carlo Bautista',
      role: 'User',
      last: '2025-04-06',
      posts: 76,
      sessions: 61,
      status: 'active'
    },
    {
      name: 'Liza Soberano',
      role: 'Moderator',
      last: '2025-04-04',
      posts: 58,
      sessions: 44,
      status: 'active'
    },
    {
      name: 'Mark Garcia',
      role: 'User',
      last: '2025-04-03',
      posts: 20,
      sessions: 18,
      status: 'active'
    },
    {
      name: 'Rosa Mendoza',
      role: 'User',
      last: '2025-02-14',
      posts: 5,
      sessions: 3,
      status: 'inactive'
    },
    {
      name: 'Pedro Penduko',
      role: 'User',
      last: '2025-04-01',
      posts: 31,
      sessions: 27,
      status: 'active'
    },
    {
      name: 'Nina Cruz',
      role: 'Moderator',
      last: '2025-04-06',
      posts: 90,
      sessions: 72,
      status: 'active'
    },
    {
      name: 'Raffy Tulfo',
      role: 'User',
      last: '2025-04-05',
      posts: 14,
      sessions: 11,
      status: 'flagged'
    },
  ];

  function rptBuildUserTable() {
    const tbody = document.getElementById('rptUserTableBody');
    if (!tbody) return;
    tbody.innerHTML = rptUsers.map((u, i) => `
    <tr>
      <td style="color:var(--rpt-gray-400);font-size:12px">${i+1}</td>
      <td style="font-weight:600">${u.name}</td>
      <td><span class="rpt-badge ${u.role==='Admin'?'rpt-badge-red':u.role==='Moderator'?'rpt-badge-pending':'rpt-badge-inactive'}">${u.role}</span></td>
      <td style="color:var(--rpt-gray-600);font-size:12px">${u.last}</td>
      <td>${u.posts}</td>
      <td>${u.sessions}</td>
      <td><span class="rpt-badge ${u.status==='active'?'rpt-badge-active':u.status==='flagged'?'rpt-badge-red':'rpt-badge-inactive'}">${u.status==='active'?'&#10003; Active':u.status==='flagged'?'&#9675; Flagged':'&#9711; Inactive'}</span></td>
    </tr>`).join('');
  }

  function rptBuildTopUsers() {
    const c = document.getElementById('rptTopUsers');
    if (!c) return;
    const sorted = [...rptUsers].sort((a, b) => b.sessions - a.sessions).slice(0, 5);
    const max = sorted[0].sessions;
    const colors = ['var(--rpt-red)', 'var(--rpt-blue)', 'var(--rpt-green)', 'var(--rpt-amber)', 'var(--rpt-purple)'];
    c.innerHTML = sorted.map((u, i) => `
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
      <div style="width:130px;font-size:13px;font-weight:600;color:var(--rpt-gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${u.name}</div>
      <div style="flex:1">
        <div class="rpt-progress-wrap">
          <div class="rpt-progress-fill" style="width:${Math.round(u.sessions/max*100)}%;background:${colors[i]}"></div>
        </div>
      </div>
      <div style="width:40px;text-align:right;font-size:12px;color:var(--rpt-gray-600)">${u.sessions}</div>
    </div>`).join('');
  }

  /* ── Post table data ─────────────────────────────────── */
  const rptPosts = [{
      title: 'Squatting case in Tondo',
      author: 'Juan dela Cruz',
      cat: 'Report',
      date: '2025-04-06',
      status: 'approved'
    },
    {
      title: 'Illegal occupancy — Caloocan',
      author: 'Ana Reyes',
      cat: 'Report',
      date: '2025-04-05',
      status: 'pending'
    },
    {
      title: 'Community update — Pasig',
      author: 'Carlo Bautista',
      cat: 'Community',
      date: '2025-04-05',
      status: 'approved'
    },
    {
      title: 'Property dispute help',
      author: 'Mark Garcia',
      cat: 'Question',
      date: '2025-04-04',
      status: 'approved'
    },
    {
      title: 'Suspicious activity near lot 12',
      author: 'Nina Cruz',
      cat: 'Report',
      date: '2025-04-04',
      status: 'rejected'
    },
    {
      title: 'Request for legal advice',
      author: 'Rosa Mendoza',
      cat: 'Question',
      date: '2025-04-03',
      status: 'pending'
    },
    {
      title: 'Update: case #4421 resolved',
      author: 'Maria Santos',
      cat: 'Update',
      date: '2025-04-03',
      status: 'approved'
    },
  ];

  function rptBuildPostTable() {
    const tbody = document.getElementById('rptPostTableBody');
    if (!tbody) return;
    tbody.innerHTML = rptPosts.map((p, i) => `
    <tr>
      <td style="color:var(--rpt-gray-400);font-size:12px">${i+1}</td>
      <td style="font-weight:600;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${p.title}</td>
      <td style="color:var(--rpt-gray-600)">${p.author}</td>
      <td><span class="rpt-badge rpt-badge-inactive">${p.cat}</span></td>
      <td style="color:var(--rpt-gray-600);font-size:12px">${p.date}</td>
      <td><span class="rpt-badge ${p.status==='approved'?'rpt-badge-active':p.status==='pending'?'rpt-badge-pending':'rpt-badge-red'}">
        ${p.status==='approved'?'&#10003; Approved':p.status==='pending'?'&#9679; Pending':'&#10007; Rejected'}
      </span></td>
    </tr>`).join('');
  }

  /* ── Charts ──────────────────────────────────────────── */
  function rptMakeCharts() {
    // Overall Bar
    new Chart(document.getElementById('rptOverallBarChart'), {
      type: 'bar',
      data: {
        labels: MONTHS,
        datasets: [{
            label: 'Users',
            data: [280, 310, 295, 340, 380, 360, 420, 390, 410, 450, 480, 510],
            backgroundColor: 'rgba(192,57,43,.75)',
            borderRadius: 4
          },
          {
            label: 'Posts',
            data: [80, 95, 88, 110, 130, 125, 140, 120, 135, 155, 160, 175],
            backgroundColor: 'rgba(41,128,185,.65)',
            borderRadius: 4
          },
          {
            label: 'Downloads',
            data: [520, 610, 580, 700, 760, 730, 820, 790, 840, 900, 960, 1020],
            backgroundColor: 'rgba(39,174,96,.55)',
            borderRadius: 4
          },
        ]
      },
      options: rptChartOpts({
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              color: '#f0f0f0'
            },
            ticks: {
              font: {
                family: 'Arial'
              }
            }
          }
        }
      })
    });

    // Overall Pie
    new Chart(document.getElementById('rptOverallPieChart'), {
      type: 'pie',
      data: {
        labels: ['Users', 'Posts', 'App', 'FAQs'],
        datasets: [{
          data: [4821, 1340, 9204, 342],
          backgroundColor: ['#C0392B', '#2980B9', '#27AE60', '#E67E22'],
          hoverOffset: 6
        }]
      },
      options: rptChartOpts()
    });

    // Overall Line
    new Chart(document.getElementById('rptOverallLineChart'), {
      type: 'line',
      data: {
        labels: MONTHS,
        datasets: [{
            label: 'Users',
            data: [280, 310, 295, 340, 380, 360, 420, 390, 410, 450, 480, 510],
            borderColor: '#C0392B',
            backgroundColor: 'rgba(192,57,43,.08)',
            tension: .4,
            fill: true,
            pointRadius: 3
          },
          {
            label: 'Posts',
            data: [80, 95, 88, 110, 130, 125, 140, 120, 135, 155, 160, 175],
            borderColor: '#2980B9',
            backgroundColor: 'rgba(41,128,185,.06)',
            tension: .4,
            fill: true,
            pointRadius: 3
          },
          {
            label: 'App',
            data: [520, 610, 580, 700, 760, 730, 820, 790, 840, 900, 960, 1020],
            borderColor: '#27AE60',
            backgroundColor: 'rgba(39,174,96,.05)',
            tension: .4,
            fill: true,
            pointRadius: 3
          },
        ]
      },
      options: rptChartOpts({
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              color: '#f0f0f0'
            }
          }
        }
      })
    });

    // User Bar
    new Chart(document.getElementById('rptUserBarChart'), {
      type: 'bar',
      data: {
        labels: MONTHS,
        datasets: [{
          label: 'New Users',
          data: [42, 55, 48, 61, 78, 72, 85, 69, 74, 90, 95, 102],
          backgroundColor: 'rgba(192,57,43,.75)',
          borderRadius: 5
        }]
      },
      options: rptChartOpts({
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              color: '#f0f0f0'
            }
          }
        }
      })
    });

    // User Doughnut
    new Chart(document.getElementById('rptUserDoughnut'), {
      type: 'doughnut',
      data: {
        labels: ['Active', 'Inactive', 'Flagged'],
        datasets: [{
          data: [2104, 2623, 94],
          backgroundColor: ['#27AE60', '#9E9E9E', '#C0392B'],
          hoverOffset: 6
        }]
      },
      options: rptChartOpts({
        cutout: '65%'
      })
    });

    // Post Line
    new Chart(document.getElementById('rptPostLineChart'), {
      type: 'line',
      data: {
        labels: MONTHS,
        datasets: [{
          label: 'Posts',
          data: [88, 102, 94, 118, 135, 128, 145, 124, 138, 158, 165, 180],
          borderColor: '#2980B9',
          backgroundColor: 'rgba(41,128,185,.08)',
          tension: .4,
          fill: true,
          pointRadius: 3
        }]
      },
      options: rptChartOpts({
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              color: '#f0f0f0'
            }
          }
        }
      })
    });

    // Post Pie
    new Chart(document.getElementById('rptPostPie'), {
      type: 'pie',
      data: {
        labels: ['Approved', 'Pending', 'Rejected'],
        datasets: [{
          data: [1102, 178, 60],
          backgroundColor: ['#27AE60', '#E67E22', '#C0392B'],
          hoverOffset: 6
        }]
      },
      options: rptChartOpts()
    });

    // App Line
    new Chart(document.getElementById('rptAppLineChart'), {
      type: 'line',
      data: {
        labels: MONTHS,
        datasets: [{
            label: 'Downloads',
            data: [520, 610, 580, 700, 760, 730, 820, 790, 840, 900, 960, 1020],
            borderColor: '#27AE60',
            backgroundColor: 'rgba(39,174,96,.08)',
            tension: .4,
            fill: true,
            pointRadius: 3
          },
          {
            label: 'DAU',
            data: [840, 920, 900, 1050, 1100, 1080, 1200, 1150, 1180, 1250, 1300, 1400],
            borderColor: '#2980B9',
            backgroundColor: 'rgba(41,128,185,.06)',
            tension: .4,
            fill: true,
            pointRadius: 3
          },
        ]
      },
      options: rptChartOpts({
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              color: '#f0f0f0'
            }
          }
        }
      })
    });

    // App Platform Pie
    new Chart(document.getElementById('rptAppPlatformPie'), {
      type: 'pie',
      data: {
        labels: ['iOS', 'Android'],
        datasets: [{
          data: [3680, 5524],
          backgroundColor: ['#2980B9', '#27AE60'],
          hoverOffset: 6
        }]
      },
      options: rptChartOpts()
    });

    // FAQ Bar
    new Chart(document.getElementById('rptFaqBarChart'), {
      type: 'bar',
      data: {
        labels: MONTHS,
        datasets: [{
            label: 'Submitted',
            data: [22, 28, 25, 32, 38, 35, 42, 36, 40, 45, 48, 52],
            backgroundColor: 'rgba(230,126,34,.7)',
            borderRadius: 4
          },
          {
            label: 'Answered',
            data: [18, 24, 22, 28, 34, 30, 38, 30, 36, 40, 42, 48],
            backgroundColor: 'rgba(39,174,96,.7)',
            borderRadius: 4
          },
        ]
      },
      options: rptChartOpts({
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              color: '#f0f0f0'
            }
          }
        }
      })
    });

    // FAQ Doughnut
    new Chart(document.getElementById('rptFaqDoughnut'), {
      type: 'doughnut',
      data: {
        labels: ['Answered', 'Pending', 'Archived'],
        datasets: [{
          data: [286, 56, 48],
          backgroundColor: ['#27AE60', '#C0392B', '#9E9E9E'],
          hoverOffset: 6
        }]
      },
      options: rptChartOpts({
        cutout: '65%'
      })
    });
  }

  /* ── Init ──────────────────────────────────────────────── */
  rptBuildUserTable();
  rptBuildTopUsers();
  rptBuildPostTable();
  rptMakeCharts();
</script>

@endsection