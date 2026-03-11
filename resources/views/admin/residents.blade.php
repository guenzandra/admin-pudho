@extends('admin.layout')
@section('content')

{{-- ============================================================
     RESIDENTS MANAGEMENT — Full-featured admin module
     Covers: Applications, Members, Red Flags, Public Registration
     ============================================================ --}}

<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

  :root {
    --bg: #f1f4f8;
    --surface: #ffffff;
    --border: #e4e8ef;
    --text: #1a2233;
    --muted: #6b7a99;
    --accent: #2563eb;
    --accent-h: #1d4ed8;
    --green: #16a34a;
    --yellow: #ca8a04;
    --orange: #ea580c;
    --red: #dc2626;
    --gray: #64748b;
    --purple: #7c3aed;
    --radius: 10px;
    --shadow: 0 1px 4px rgba(0, 0, 0, .07), 0 4px 16px rgba(0, 0, 0, .05);
  }

  .rm * {
    box-sizing: border-box;
  }

  .rm {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    padding: 24px 28px 80px;
    min-height: 100vh;
    color: var(--text);
  }

  /* ─── PAGE HEADER ─── */
  .rm-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 22px;
    flex-wrap: wrap;
    gap: 12px;
  }

  .rm-header-left h1 {
    font-size: 1.35rem;
    font-weight: 700;
    margin: 0 0 3px;
    color: var(--text);
    letter-spacing: -.3px;
  }

  .rm-header-left p {
    font-size: .78rem;
    color: var(--muted);
    margin: 0;
  }

  .rm-header-actions {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-wrap: wrap;
  }

  /* ─── BUTTONS ─── */
  .btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: .8rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    font-family: 'DM Sans', sans-serif;
    transition: all .15s;
    white-space: nowrap;
  }

  .btn-primary {
    background: var(--accent);
    color: #fff;
  }

  .btn-primary:hover {
    background: var(--accent-h);
    box-shadow: 0 4px 12px rgba(37, 99, 235, .3);
  }

  .btn-outline {
    background: #fff;
    color: var(--text);
    border: 1.5px solid var(--border);
  }

  .btn-outline:hover {
    border-color: var(--accent);
    color: var(--accent);
  }

  .btn-danger {
    background: #fef2f2;
    color: var(--red);
    border: 1.5px solid #fecaca;
  }

  .btn-danger:hover {
    background: #fee2e2;
  }

  .btn-success {
    background: #f0fdf4;
    color: var(--green);
    border: 1.5px solid #bbf7d0;
  }

  .btn-success:hover {
    background: #dcfce7;
  }

  .btn-sm {
    padding: 5px 11px;
    font-size: .74rem;
  }

  .btn svg {
    width: 14px;
    height: 14px;
    flex-shrink: 0;
  }

  /* ─── STAT CARDS ─── */
  .rm-stats {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
    margin-bottom: 20px;
  }

  .rm-stat {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 14px 16px;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
    cursor: pointer;
    transition: transform .15s, box-shadow .15s;
  }

  .rm-stat:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, .1);
  }

  .rm-stat.active {
    border-color: var(--accent);
    box-shadow: 0 0 0 2px rgba(37, 99, 235, .15);
  }

  .rm-stat::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    border-radius: var(--radius) 0 0 var(--radius);
  }

  .rm-stat.s-all::before {
    background: var(--accent);
  }

  .rm-stat.s-app::before {
    background: var(--yellow);
  }

  .rm-stat.s-mem::before {
    background: var(--green);
  }

  .rm-stat.s-inc::before {
    background: var(--orange);
  }

  .rm-stat.s-hold::before {
    background: var(--gray);
  }

  .rm-stat.s-flag::before {
    background: var(--red);
  }

  .rm-stat-lbl {
    font-size: .65rem;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 3px;
  }

  .rm-stat-val {
    font-size: 1.6rem;
    font-weight: 700;
    line-height: 1;
  }

  .rm-stat.s-all .rm-stat-val {
    color: var(--accent);
  }

  .rm-stat.s-app .rm-stat-val {
    color: var(--yellow);
  }

  .rm-stat.s-mem .rm-stat-val {
    color: var(--green);
  }

  .rm-stat.s-inc .rm-stat-val {
    color: var(--orange);
  }

  .rm-stat.s-hold .rm-stat-val {
    color: var(--gray);
  }

  .rm-stat.s-flag .rm-stat-val {
    color: var(--red);
  }

  .rm-stat-sub {
    font-size: .68rem;
    color: var(--muted);
    margin-top: 1px;
  }

  /* ─── MAIN CARD ─── */
  .rm-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  /* ─── TOOLBAR ─── */
  .rm-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    background: #fafbfd;
    flex-wrap: wrap;
  }

  .rm-search-wrap {
    position: relative;
    flex: 1;
    min-width: 220px;
  }

  .rm-search-wrap svg {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 14px;
    height: 14px;
    color: var(--muted);
    pointer-events: none;
  }

  .rm-search {
    width: 100%;
    padding: 8px 10px 8px 32px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: .79rem;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    background: #fff;
    outline: none;
    transition: border-color .15s, box-shadow .15s;
  }

  .rm-search:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
  }

  .rm-search::placeholder {
    color: var(--muted);
  }

  .rm-select {
    padding: 8px 28px 8px 10px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: .77rem;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7a99' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 8px center / 12px;
    appearance: none;
    outline: none;
    cursor: pointer;
    transition: border-color .15s;
  }

  .rm-select:focus {
    border-color: var(--accent);
  }

  .rm-toolbar-right {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .rm-count-badge {
    font-size: .73rem;
    color: var(--muted);
    background: #f0f4f8;
    border-radius: 6px;
    padding: 4px 10px;
    white-space: nowrap;
  }

  /* ─── TABLE ─── */
  .rm-table-wrap {
    overflow-x: auto;
  }

  table.rm-table {
    width: 100%;
    border-collapse: collapse;
  }

  table.rm-table thead th {
    padding: 10px 14px;
    font-size: .67rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .07em;
    background: #f8f9fc;
    border-bottom: 1.5px solid var(--border);
    white-space: nowrap;
    cursor: pointer;
    user-select: none;
  }

  table.rm-table thead th:hover {
    color: var(--accent);
  }

  table.rm-table thead th:first-child {
    cursor: default;
  }

  table.rm-table tbody tr {
    border-bottom: 1px solid #f1f4f8;
    transition: background .12s;
    cursor: pointer;
  }

  table.rm-table tbody tr:hover {
    background: #f6f9ff;
  }

  table.rm-table tbody tr:last-child {
    border-bottom: none;
  }

  table.rm-table td {
    padding: 11px 14px;
    font-size: .81rem;
    color: var(--text);
    vertical-align: middle;
  }

  /* ─── AVATAR ─── */
  .rm-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .7rem;
    font-weight: 700;
    flex-shrink: 0;
    color: #fff;
  }

  .av-blue {
    background: linear-gradient(135deg, #2563eb, #60a5fa);
  }

  .av-green {
    background: linear-gradient(135deg, #16a34a, #4ade80);
  }

  .av-yellow {
    background: linear-gradient(135deg, #ca8a04, #fde047);
    color: #7c5a00;
  }

  .av-orange {
    background: linear-gradient(135deg, #ea580c, #fb923c);
  }

  .av-gray {
    background: linear-gradient(135deg, #64748b, #94a3b8);
  }

  .av-red {
    background: linear-gradient(135deg, #dc2626, #f87171);
  }

  .av-purple {
    background: linear-gradient(135deg, #7c3aed, #a78bfa);
  }

  /* ─── BADGES ─── */
  .rm-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    border-radius: 99px;
    font-size: .66rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    white-space: nowrap;
  }

  .rm-badge .dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    flex-shrink: 0;
  }

  .badge-approved {
    background: #dcfce7;
    color: #15803d;
  }

  .badge-approved .dot {
    background: #16a34a;
  }

  .badge-pending {
    background: #fef9c3;
    color: #854d0e;
  }

  .badge-pending .dot {
    background: #ca8a04;
  }

  .badge-incomplete {
    background: #ffedd5;
    color: #9a3412;
  }

  .badge-incomplete .dot {
    background: #ea580c;
  }

  .badge-onhold {
    background: #f1f5f9;
    color: #475569;
  }

  .badge-onhold .dot {
    background: #64748b;
  }

  .badge-redflag {
    background: #fee2e2;
    color: #991b1b;
  }

  .badge-redflag .dot {
    background: #dc2626;
  }

  .badge-syndicate {
    background: #ede9fe;
    color: #5b21b6;
  }

  .badge-syndicate .dot {
    background: #7c3aed;
  }

  .badge-public {
    background: #dbeafe;
    color: #1e40af;
  }

  .badge-public .dot {
    background: #2563eb;
  }

  /* ─── MUNICIPALITY TAG ─── */
  .rm-muni {
    font-size: .66rem;
    font-weight: 600;
    padding: 2px 7px;
    border-radius: 5px;
    background: #f0f4f8;
    color: var(--muted);
    font-family: 'DM Mono', monospace;
  }

  /* ─── FILE STATUS ─── */
  .rm-files {
    display: flex;
    gap: 3px;
    flex-wrap: wrap;
  }

  .rm-file-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
    cursor: pointer;
    transition: transform .15s;
  }

  .rm-file-dot:hover {
    transform: scale(1.4);
  }

  .rm-file-dot.ok {
    background: #22c55e;
  }

  .rm-file-dot.miss {
    background: #ef4444;
  }

  .rm-file-dot.pend {
    background: #f59e0b;
  }

  /* ─── ACTION BTN ─── */
  .rm-action-trigger {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    border: none;
    background: #f1f5f9;
    color: var(--muted);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .15s;
    flex-shrink: 0;
  }

  .rm-action-trigger:hover,
  .rm-action-trigger.open {
    background: var(--accent);
    color: #fff;
  }

  .rm-action-trigger svg {
    width: 14px;
    height: 14px;
  }

  /* ─── PAGINATION ─── */
  .rm-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    border-top: 1px solid var(--border);
    background: #fafbfd;
    flex-wrap: wrap;
    gap: 10px;
  }

  .rm-page-info {
    font-size: .73rem;
    color: var(--muted);
  }

  .rm-page-btns {
    display: flex;
    gap: 4px;
  }

  .rm-page-btn {
    min-width: 30px;
    height: 30px;
    padding: 0 6px;
    border-radius: 7px;
    border: 1.5px solid var(--border);
    background: #fff;
    font-size: .75rem;
    font-weight: 600;
    color: var(--muted);
    cursor: pointer;
    transition: all .15s;
    font-family: 'DM Sans', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .rm-page-btn:hover {
    background: #f0f4f8;
    border-color: #cbd5e1;
  }

  .rm-page-btn.active {
    background: var(--accent);
    border-color: var(--accent);
    color: #fff;
  }

  .rm-page-btn:disabled {
    opacity: .4;
    cursor: default;
  }

  .rm-page-btn svg {
    width: 12px;
    height: 12px;
  }

  /* ─── FLOATING ACTIONS MENU ─── */
  #rm-float-menu {
    position: fixed;
    z-index: 99999;
    background: #fff;
    border-radius: 10px;
    min-width: 185px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, .14), 0 2px 8px rgba(0, 0, 0, .08);
    border: 1px solid var(--border);
    display: none;
    overflow: hidden;
  }

  #rm-float-menu button {
    width: 100%;
    padding: 9px 14px;
    text-align: left;
    font-size: .8rem;
    color: var(--text);
    background: #fff;
    border: none;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 9px;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    transition: background .12s;
  }

  #rm-float-menu button:last-child {
    border-bottom: none;
  }

  #rm-float-menu button:hover {
    background: #f6f9ff;
  }

  #rm-float-menu button svg {
    width: 14px;
    height: 14px;
    flex-shrink: 0;
  }

  #rm-float-menu .menu-divider {
    height: 1px;
    background: #f1f5f9;
    margin: 2px 0;
  }

  #rm-float-menu button.danger {
    color: var(--red);
  }

  #rm-float-menu button.danger:hover {
    background: #fff5f5;
  }

  #rm-float-menu button.flag-btn {
    color: var(--purple);
  }

  #rm-float-menu button.flag-btn:hover {
    background: #f5f3ff;
  }

  #rm-float-menu .menu-header {
    padding: 8px 14px 4px;
    font-size: .66rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .07em;
  }

  /* ─── MODAL BACKDROP ─── */
  .rm-modal-bg {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, .45);
    backdrop-filter: blur(5px);
    z-index: 99998;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity .2s;
    padding: 16px;
  }

  .rm-modal-bg.open {
    opacity: 1;
    pointer-events: all;
  }

  .rm-modal {
    background: #fff;
    border-radius: 14px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 24px 64px rgba(0, 0, 0, .18);
    transform: scale(.95) translateY(14px);
    transition: transform .25s cubic-bezier(.34, 1.4, .64, 1);
    border: 1px solid var(--border);
  }

  .rm-modal-bg.open .rm-modal {
    transform: scale(1) translateY(0);
  }

  .rm-modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px 14px;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    background: #fff;
    z-index: 1;
  }

  .rm-modal-head h3 {
    font-size: .95rem;
    font-weight: 700;
    color: var(--text);
    margin: 0;
  }

  .rm-modal-head-sub {
    font-size: .72rem;
    color: var(--muted);
    margin: 2px 0 0;
  }

  .rm-modal-x {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    background: #f1f5f9;
    border: 1px solid var(--border);
    color: var(--muted);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
    transition: all .15s;
  }

  .rm-modal-x:hover {
    background: #fee2e2;
    color: var(--red);
    border-color: #fecaca;
  }

  .rm-modal-body {
    padding: 20px;
  }

  .rm-modal-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 14px 20px;
    border-top: 1px solid var(--border);
    background: #fafbfd;
  }

  /* ─── FORM ELEMENTS ─── */
  .rm-label {
    display: block;
    font-size: .74rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
  }

  .rm-label .req {
    color: var(--red);
  }

  .rm-input {
    width: 100%;
    padding: 8px 11px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: .8rem;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: border-color .15s, box-shadow .15s;
    background: #fff;
  }

  .rm-input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
  }

  .rm-input::placeholder {
    color: var(--muted);
  }

  .rm-input.error {
    border-color: var(--red);
    box-shadow: 0 0 0 3px rgba(220, 38, 38, .08);
  }

  .rm-textarea {
    resize: vertical;
    min-height: 70px;
  }

  .rm-input-err {
    font-size: .68rem;
    color: var(--red);
    margin-top: 3px;
    display: none;
  }

  .rm-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }

  .rm-grid-3 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 14px;
  }

  .rm-section-title {
    font-size: .72rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .07em;
    margin: 16px 0 12px;
    padding-bottom: 6px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .rm-section-title svg {
    width: 13px;
    height: 13px;
  }

  /* ─── ID UPLOAD ZONE ─── */
  .rm-upload-zone {
    border: 2px dashed #cbd5e1;
    border-radius: 10px;
    padding: 18px 14px;
    text-align: center;
    cursor: pointer;
    transition: all .15s;
    background: #fafbfd;
  }

  .rm-upload-zone:hover {
    border-color: var(--accent);
    background: #eff6ff;
  }

  .rm-upload-zone.has-file {
    border-color: var(--green);
    background: #f0fdf4;
  }

  .rm-upload-zone svg {
    width: 28px;
    height: 28px;
    color: #94a3b8;
    margin: 0 auto 6px;
    display: block;
  }

  .rm-upload-zone p {
    font-size: .76rem;
    color: var(--muted);
    margin: 0;
  }

  .rm-upload-zone strong {
    color: var(--accent);
  }

  /* ─── DOCUMENT CHECKLIST (modal) ─── */
  .rm-doc-list {
    display: flex;
    flex-direction: column;
    gap: 7px;
  }

  .rm-doc-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: #fafbfd;
  }

  .rm-doc-item.ok {
    background: #f0fdf4;
    border-color: #bbf7d0;
  }

  .rm-doc-item.miss {
    background: #fff5f5;
    border-color: #fecaca;
  }

  .rm-doc-item.pend {
    background: #fffbeb;
    border-color: #fde68a;
  }

  .rm-doc-item-icon {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .rm-doc-item.ok .rm-doc-item-icon {
    background: #dcfce7;
    color: #16a34a;
  }

  .rm-doc-item.miss .rm-doc-item-icon {
    background: #fee2e2;
    color: #dc2626;
  }

  .rm-doc-item.pend .rm-doc-item-icon {
    background: #fef9c3;
    color: #ca8a04;
  }

  .rm-doc-item-icon svg {
    width: 14px;
    height: 14px;
  }

  .rm-doc-item-name {
    font-size: .78rem;
    font-weight: 600;
    color: var(--text);
    flex: 1;
  }

  .rm-doc-item-sub {
    font-size: .67rem;
    color: var(--muted);
  }

  .rm-doc-item-badge {
    font-size: .62rem;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 99px;
  }

  .ok .rm-doc-item-badge {
    background: #dcfce7;
    color: #15803d;
  }

  .miss .rm-doc-item-badge {
    background: #fee2e2;
    color: #991b1b;
  }

  .pend .rm-doc-item-badge {
    background: #fef9c3;
    color: #854d0e;
  }

  /* ─── RED FLAG / PUBLISH SECTION ─── */
  .rm-redflag-banner {
    background: linear-gradient(135deg, #fff5f5, #fff1f1);
    border: 1.5px solid #fecaca;
    border-radius: 10px;
    padding: 14px 16px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
  }

  .rm-redflag-banner svg {
    width: 20px;
    height: 20px;
    color: var(--red);
    flex-shrink: 0;
    margin-top: 1px;
  }

  .rm-redflag-banner p {
    font-size: .78rem;
    color: #7f1d1d;
    margin: 0;
    line-height: 1.5;
  }

  .rm-publish-toggle {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    background: #fafbfd;
    border: 1px solid var(--border);
    border-radius: 9px;
  }

  .rm-toggle-switch {
    width: 38px;
    height: 22px;
    border-radius: 99px;
    background: #e2e8f0;
    position: relative;
    cursor: pointer;
    transition: background .2s;
    flex-shrink: 0;
  }

  .rm-toggle-switch.on {
    background: var(--red);
  }

  .rm-toggle-switch::after {
    content: '';
    position: absolute;
    top: 3px;
    left: 3px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #fff;
    transition: transform .2s;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
  }

  .rm-toggle-switch.on::after {
    transform: translateX(16px);
  }

  .rm-toggle-label {
    font-size: .78rem;
    font-weight: 600;
    color: var(--text);
  }

  .rm-toggle-sub {
    font-size: .68rem;
    color: var(--muted);
  }

  /* ─── PROFILE HEADER (view modal) ─── */
  .rm-profile-banner {
    background: linear-gradient(135deg, #1e3a8a, #2563eb);
    padding: 20px;
    border-radius: 10px;
    color: #fff;
    display: flex;
    gap: 14px;
    align-items: flex-start;
    margin-bottom: 16px;
  }

  .rm-profile-av {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 700;
    flex-shrink: 0;
    border: 2px solid rgba(255, 255, 255, .4);
  }

  .rm-profile-name {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0 0 3px;
  }

  .rm-profile-meta {
    font-size: .74rem;
    opacity: .85;
  }

  /* ─── TOAST ─── */
  #rm-toasts {
    position: fixed;
    bottom: 22px;
    right: 22px;
    z-index: 999999;
    display: flex;
    flex-direction: column;
    gap: 8px;
    pointer-events: none;
  }

  .rm-toast {
    pointer-events: all;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 10px 13px;
    display: flex;
    align-items: flex-start;
    gap: 9px;
    box-shadow: 0 8px 28px rgba(0, 0, 0, .1);
    min-width: 240px;
    max-width: 300px;
    transform: translateX(110%);
    transition: transform .3s cubic-bezier(.34, 1.5, .64, 1);
  }

  .rm-toast.show {
    transform: none;
  }

  .rm-toast.out {
    transform: translateX(110%);
    transition: transform .2s ease-in;
  }

  .rm-toast-ico {
    width: 24px;
    height: 24px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .rm-toast-ico.g {
    background: #f0fdf4;
    color: #16a34a;
  }

  .rm-toast-ico.r {
    background: #fff5f5;
    color: #dc2626;
  }

  .rm-toast-ico.y {
    background: #fffbeb;
    color: #ca8a04;
  }

  .rm-toast-ico.b {
    background: #eff6ff;
    color: #2563eb;
  }

  .rm-toast-ico svg {
    width: 12px;
    height: 12px;
  }

  .rm-toast strong {
    font-size: .74rem;
    color: var(--text);
    font-weight: 700;
    display: block;
  }

  .rm-toast span {
    font-size: .67rem;
    color: var(--muted);
  }

  .rm-toast-x {
    margin-left: auto;
    background: none;
    border: none;
    color: #cbd5e0;
    cursor: pointer;
    font-size: .9rem;
    flex-shrink: 0;
  }

  /* ─── LOADING OVERLAY ─── */
  .rm-loading-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, .7);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    z-index: 10;
    opacity: 0;
    pointer-events: none;
    transition: opacity .2s;
  }

  .rm-loading-overlay.show {
    opacity: 1;
    pointer-events: all;
  }

  .rm-spinner {
    width: 36px;
    height: 36px;
    border: 3px solid #e2e8f0;
    border-top-color: var(--accent);
    border-radius: 50%;
    animation: rm-spin 0.7s linear infinite;
  }

  @keyframes rm-spin {
    to {
      transform: rotate(360deg);
    }
  }

  /* ─── MISSING FILES BANNER ─── */
  .rm-missing-alert {
    background: #fffbeb;
    border: 1px solid #fde68a;
    border-radius: 9px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
    font-size: .77rem;
    color: #92400e;
  }

  .rm-missing-alert svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
    color: #d97706;
  }

  /* ─── PUBLIC REG BADGE ─── */
  .rm-pub-reg {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: .64rem;
    font-weight: 600;
    color: #1e40af;
    background: #dbeafe;
    padding: 2px 7px;
    border-radius: 99px;
  }

  /* ─── SYNDICATE TAG ─── */
  .rm-syn-tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: .64rem;
    font-weight: 700;
    color: #5b21b6;
    background: #ede9fe;
    padding: 2px 7px;
    border-radius: 99px;
    text-transform: uppercase;
    letter-spacing: .05em;
  }

  /* ─── RESPONSIVE ─── */
  @media (max-width:1100px) {
    .rm-stats {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  @media (max-width:700px) {
    .rm-stats {
      grid-template-columns: repeat(2, 1fr);
    }

    .rm-grid-2,
    .rm-grid-3 {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="rm">

  <!-- TOASTS -->
  <div id="rm-toasts"></div>

  <!-- ══ FLOATING ACTION MENU ══ -->
  <div id="rm-float-menu"></div>

  <!-- ════════════════════════════════
       HEADER
  ════════════════════════════════ -->
  <div class="rm-header">
    <div class="rm-header-left">
      <h1>Residents Management</h1>
      <p>Manage applications, memberships, and flagged individuals across all municipalities</p>
    </div>
    <div class="rm-header-actions">
      <button class="btn btn-outline btn-sm" onclick="rmOpenMissing()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        Missing Files
        <span style="background:#ef4444;color:#fff;border-radius:99px;padding:1px 6px;font-size:.62rem;font-weight:700;">7</span>
      </button>
      <button class="btn btn-outline btn-sm" onclick="rmExport()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Export
      </button>
      <button class="btn btn-primary btn-sm" onclick="rmOpenAdd()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Resident
      </button>
    </div>
  </div>

  <!-- ════════════════════════════════
       STAT CARDS
  ════════════════════════════════ -->
  <div class="rm-stats">
    <div class="rm-stat s-all active" onclick="rmFilter('all',this)">
      <div class="rm-stat-lbl">Total</div>
      <div class="rm-stat-val" id="stat-total">1,284</div>
      <div class="rm-stat-sub">All records</div>
    </div>
    <div class="rm-stat s-app" onclick="rmFilter('pending',this)">
      <div class="rm-stat-lbl">Applicants</div>
      <div class="rm-stat-val" id="stat-app">43</div>
      <div class="rm-stat-sub">Awaiting review</div>
    </div>
    <div class="rm-stat s-mem" onclick="rmFilter('approved',this)">
      <div class="rm-stat-lbl">Members</div>
      <div class="rm-stat-val" id="stat-mem">1,198</div>
      <div class="rm-stat-sub">Approved</div>
    </div>
    <div class="rm-stat s-inc" onclick="rmFilter('incomplete',this)">
      <div class="rm-stat-lbl">Incomplete</div>
      <div class="rm-stat-val" id="stat-inc">28</div>
      <div class="rm-stat-sub">Missing docs</div>
    </div>
    <div class="rm-stat s-hold" onclick="rmFilter('onhold',this)">
      <div class="rm-stat-lbl">On Hold</div>
      <div class="rm-stat-val" id="stat-hold">15</div>
      <div class="rm-stat-sub">Under review</div>
    </div>
    <div class="rm-stat s-flag" onclick="rmFilter('redflag',this)">
      <div class="rm-stat-lbl">Red Flags</div>
      <div class="rm-stat-val" id="stat-flag">7</div>
      <div class="rm-stat-sub">Flagged / syndicate</div>
    </div>
  </div>

  <!-- ════════════════════════════════
       MAIN TABLE CARD
  ════════════════════════════════ -->
  <div class="rm-card" style="position:relative;">
    <div class="rm-loading-overlay" id="rm-loader">
      <div class="rm-spinner"></div>
    </div>

    <!-- TOOLBAR -->
    <div class="rm-toolbar">
      <div class="rm-search-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input class="rm-search" id="rm-search" type="text" placeholder="Search by name, email, municipality, remarks…" oninput="rmSearch()">
      </div>

      <select class="rm-select" id="rm-filter-status" onchange="rmSearch()">
        <option value="">All Status</option>
        <option value="approved">Approved Member</option>
        <option value="pending">Applicant / Pending</option>
        <option value="incomplete">Incomplete</option>
        <option value="onhold">On Hold</option>
        <option value="redflag">Red Flag</option>
        <option value="syndicate">Syndicate</option>
      </select>

      <select class="rm-select" id="rm-filter-muni" onchange="rmSearch()">
        <option value="">All Municipalities</option>
        <option value="Calamba">Calamba</option>
        <option value="Biñan">Biñan</option>
        <option value="San Pedro">San Pedro</option>
        <option value="Cabuyao">Cabuyao</option>
        <option value="Los Baños">Los Baños</option>
        <option value="Sta. Cruz">Sta. Cruz</option>
        <option value="Cavinti">Cavinti</option>
        <option value="Pagsanjan">Pagsanjan</option>
      </select>

      <select class="rm-select" id="rm-filter-reg" onchange="rmSearch()">
        <option value="">All Sources</option>
        <option value="admin">Admin-added</option>
        <option value="public">Public Registration</option>
      </select>

      <!-- Bulk Actions -->
      <div style="display:flex;gap:6px;align-items:center;">
        <select class="rm-select" id="rm-bulk-action">
          <option value="">Bulk Action</option>
          <option value="approve">Approve as Member</option>
          <option value="hold">Put on Hold</option>
          <option value="flag">Mark as Red Flag</option>
          <option value="delete">Delete Selected</option>
          <option value="export">Export Selected</option>
        </select>
        <button class="btn btn-outline btn-sm" onclick="rmApplyBulk()">Apply</button>
      </div>

      <div class="rm-toolbar-right">
        <div class="rm-count-badge" id="rm-count-badge">Showing all</div>
      </div>
    </div>

    <!-- TABLE -->
    <div class="rm-table-wrap">
      <table class="rm-table">
        <thead>
          <tr>
            <th style="width:38px;cursor:default;"><input type="checkbox" id="rm-select-all" onchange="rmSelectAll(this)" style="accent-color:var(--accent);cursor:pointer;"></th>
            <th onclick="rmSort('name')">Resident ↕</th>
            <th>Municipality</th>
            <th>Status</th>
            <th>Documents</th>
            <th>Source</th>
            <th>Added By</th>
            <th>Remarks</th>
            <th style="width:40px;cursor:default;"></th>
          </tr>
        </thead>
        <tbody id="rm-tbody"></tbody>
      </table>
    </div>

    <!-- PAGINATION -->
    <div class="rm-pagination">
      <div class="rm-page-info" id="rm-page-info">Showing 1–10 of 1,284</div>
      <div class="rm-page-btns" id="rm-page-btns"></div>
    </div>
  </div>

</div>

<!-- ════════════════════════════════════════════════════
     MODALS
════════════════════════════════════════════════════ -->

<!-- ADD / EDIT RESIDENT MODAL -->
<div class="rm-modal-bg" id="rm-add-modal">
  <div class="rm-modal" style="max-width:620px;">
    <div class="rm-modal-head">
      <div>
        <h3 id="rm-add-title">Add New Resident</h3>
        <div class="rm-modal-head-sub">Fill in all required fields. Valid ID upload is mandatory.</div>
      </div>
      <button class="rm-modal-x" onclick="rmCloseAdd()">✕</button>
    </div>
    <div class="rm-modal-body">

      <!-- Personal Info -->
      <div class="rm-section-title">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        Personal Information
      </div>
      <div class="rm-grid-3" style="margin-bottom:12px;">
        <div>
          <label class="rm-label">First Name <span class="req">*</span></label>
          <input class="rm-input" id="add-fname" placeholder="First name" oninput="rmClearErr(this)">
          <div class="rm-input-err" id="err-fname">Required</div>
        </div>
        <div>
          <label class="rm-label">Middle Name</label>
          <input class="rm-input" id="add-mname" placeholder="Middle name">
        </div>
        <div>
          <label class="rm-label">Last Name <span class="req">*</span></label>
          <input class="rm-input" id="add-lname" placeholder="Last name" oninput="rmClearErr(this)">
          <div class="rm-input-err" id="err-lname">Required</div>
        </div>
      </div>
      <div class="rm-grid-2" style="margin-bottom:12px;">
        <div>
          <label class="rm-label">Email <span class="req">*</span></label>
          <input class="rm-input" id="add-email" type="email" placeholder="email@example.com" oninput="rmClearErr(this)">
          <div class="rm-input-err" id="err-email">Valid email required</div>
        </div>
        <div>
          <label class="rm-label">Contact Number</label>
          <input class="rm-input" id="add-contact" placeholder="09xxxxxxxxx" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
        </div>
      </div>
      <div class="rm-grid-2" style="margin-bottom:12px;">
        <div>
          <label class="rm-label">Birthdate <span class="req">*</span></label>
          <input class="rm-input" id="add-bdate" type="date">
        </div>
        <div>
          <label class="rm-label">Gender</label>
          <select class="rm-input" id="add-gender">
            <option value="">Select gender</option>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
          </select>
        </div>
      </div>

      <!-- Address -->
      <div class="rm-section-title">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Address & Municipality
      </div>
      <div class="rm-grid-2" style="margin-bottom:12px;">
        <div>
          <label class="rm-label">Municipality <span class="req">*</span></label>
          <select class="rm-input" id="add-muni" onchange="rmAutoClassify()" oninput="rmClearErr(this)">
            <option value="">Select municipality</option>
            <option>Calamba</option>
            <option>Biñan</option>
            <option>San Pedro</option>
            <option>Cabuyao</option>
            <option>Los Baños</option>
            <option>Sta. Cruz</option>
            <option>Cavinti</option>
            <option>Pagsanjan</option>
            <option>Mabitac</option>
            <option>Pakil</option>
          </select>
          <div class="rm-input-err" id="err-muni">Required</div>
        </div>
        <div>
          <label class="rm-label">Auto-Classification</label>
          <input class="rm-input" id="add-district" placeholder="Auto-filled from municipality" readonly style="background:#f8f9fc;color:var(--muted);">
        </div>
      </div>
      <div style="margin-bottom:12px;">
        <label class="rm-label">Full Address</label>
        <input class="rm-input" id="add-address" placeholder="Purok/Street, Barangay, Municipality">
      </div>

      <!-- Valid IDs -->
      <div class="rm-section-title">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0" />
        </svg>
        Valid ID Upload <span style="color:var(--red);font-weight:700;">*</span>
      </div>
      <div class="rm-grid-2" style="margin-bottom:12px;">
        <div>
          <label class="rm-label">Primary ID (Government-issued) <span class="req">*</span></label>
          <div class="rm-upload-zone" id="zone-primary" onclick="document.getElementById('upload-primary').click()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            <p>Click to upload<br><strong>PhilSys, Passport, SSS, GSIS, Driver's License</strong></p>
          </div>
          <input type="file" id="upload-primary" class="hidden" accept="image/*,.pdf" onchange="rmFileSelected('zone-primary','label-primary',this)">
          <div id="label-primary" style="font-size:.68rem;color:var(--muted);margin-top:4px;"></div>
        </div>
        <div>
          <label class="rm-label">Secondary ID (optional)</label>
          <div class="rm-upload-zone" onclick="document.getElementById('upload-secondary').click()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            <p>Click to upload<br><strong>Barangay ID, Postal, Senior, PWD</strong></p>
          </div>
          <input type="file" id="upload-secondary" class="hidden" accept="image/*,.pdf" onchange="rmFileSelected('zone-secondary','label-secondary',this)" id="zone-secondary">
          <div id="label-secondary" style="font-size:.68rem;color:var(--muted);margin-top:4px;"></div>
        </div>
      </div>

      <!-- Supporting Documents -->
      <div class="rm-section-title">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Supporting Documents
      </div>
      <div class="rm-grid-2" style="margin-bottom:12px;">
        <div>
          <label class="rm-label">Birth Certificate</label>
          <div class="rm-upload-zone" onclick="document.getElementById('upload-birth').click()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586l5.414 5.414V19a2 2 0 01-2 2z" />
            </svg>
            <p>Birth Certificate<br><strong>PSA / Local</strong></p>
          </div>
          <input type="file" id="upload-birth" class="hidden" accept="image/*,.pdf" onchange="rmFileSelected(null,'label-birth',this)">
          <div id="label-birth" style="font-size:.68rem;color:var(--muted);margin-top:4px;"></div>
        </div>
        <div>
          <label class="rm-label">Proof of Residency</label>
          <div class="rm-upload-zone" onclick="document.getElementById('upload-residency').click()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <p>Proof of Residency<br><strong>Utility Bill / Barangay Cert</strong></p>
          </div>
          <input type="file" id="upload-residency" class="hidden" accept="image/*,.pdf" onchange="rmFileSelected(null,'label-residency',this)">
          <div id="label-residency" style="font-size:.68rem;color:var(--muted);margin-top:4px;"></div>
        </div>
      </div>

      <!-- Remarks & Status -->
      <div class="rm-section-title">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        Application Notes
      </div>
      <div class="rm-grid-2" style="margin-bottom:12px;">
        <div>
          <label class="rm-label">Initial Status</label>
          <select class="rm-input" id="add-status">
            <option value="pending">Applicant / Pending</option>
            <option value="approved">Approved Member</option>
            <option value="incomplete">Incomplete</option>
            <option value="onhold">On Hold</option>
          </select>
        </div>
        <div>
          <label class="rm-label">Remarks</label>
          <input class="rm-input" id="add-remarks" placeholder="Notes about this application…">
        </div>
      </div>
    </div>
    <div class="rm-modal-footer">
      <button class="btn btn-outline" onclick="rmCloseAdd()">Cancel</button>
      <button class="btn btn-primary" onclick="rmSaveResident()" id="rm-save-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
        </svg>
        <span id="rm-save-label">Save Resident</span>
      </button>
    </div>
  </div>
</div>

<!-- VIEW RESIDENT MODAL -->
<div class="rm-modal-bg" id="rm-view-modal">
  <div class="rm-modal" style="max-width:600px;">
    <div class="rm-modal-head">
      <div>
        <h3>Resident Profile</h3>
        <div class="rm-modal-head-sub">Full application details and document status</div>
      </div>
      <button class="rm-modal-x" onclick="rmCloseView()">✕</button>
    </div>
    <div class="rm-modal-body" id="rm-view-body"></div>
    <div class="rm-modal-footer">
      <button class="btn btn-outline" onclick="rmCloseView()">Close</button>
      <button class="btn btn-primary btn-sm" id="rm-view-edit-btn">Edit Record</button>
    </div>
  </div>
</div>

<!-- RED FLAG / SYNDICATE MODAL -->
<div class="rm-modal-bg" id="rm-flag-modal">
  <div class="rm-modal" style="max-width:500px;">
    <div class="rm-modal-head">
      <div>
        <h3 id="rm-flag-title">Mark as Red Flag</h3>
        <div class="rm-modal-head-sub" id="rm-flag-sub">This will flag the resident and allow optional public disclosure.</div>
      </div>
      <button class="rm-modal-x" onclick="rmCloseFlag()">✕</button>
    </div>
    <div class="rm-modal-body">
      <div class="rm-redflag-banner">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <p id="rm-flag-warn">Marking this resident as <strong>Red Flag</strong> will restrict their access and log this action. Public disclosure is optional and can be toggled at any time.</p>
      </div>

      <div style="margin-bottom:14px;">
        <label class="rm-label">Flag Type <span class="req">*</span></label>
        <select class="rm-input" id="flag-type">
          <option value="redflag">🚩 Red Flag — suspicious activity</option>
          <option value="syndicate">⚠️ Syndicate — confirmed network involvement</option>
        </select>
      </div>
      <div style="margin-bottom:14px;">
        <label class="rm-label">Reason / Evidence Summary <span class="req">*</span></label>
        <textarea class="rm-input rm-textarea" id="flag-reason" placeholder="Describe the reason for flagging this individual…"></textarea>
      </div>

      <!-- Publish toggle -->
      <div class="rm-publish-toggle" style="margin-bottom:14px;">
        <div class="rm-toggle-switch" id="flag-pub-toggle" onclick="rmTogglePublish(this)"></div>
        <div>
          <div class="rm-toggle-label">Publish Publicly</div>
          <div class="rm-toggle-sub">Warning will appear on the public-facing site temporarily or permanently</div>
        </div>
      </div>

      <div id="flag-pub-options" style="display:none;margin-bottom:14px;">
        <div class="rm-grid-2">
          <div>
            <label class="rm-label">Visibility Duration</label>
            <select class="rm-input" id="flag-duration">
              <option value="temporary">Temporary (7 days)</option>
              <option value="30days">30 Days</option>
              <option value="permanent">Permanent</option>
            </select>
          </div>
          <div>
            <label class="rm-label">Display Name</label>
            <select class="rm-input" id="flag-display-name">
              <option value="initials">Show initials only</option>
              <option value="full">Show full name</option>
              <option value="anonymous">Anonymous</option>
            </select>
          </div>
        </div>
      </div>

      <input type="hidden" id="flag-resident-id">
    </div>
    <div class="rm-modal-footer">
      <button class="btn btn-outline" onclick="rmCloseFlag()">Cancel</button>
      <button class="btn btn-danger" onclick="rmConfirmFlag()" id="rm-flag-confirm-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 21l1.65-3.8a9 9 0 113.4 2.9L3 21" />
        </svg>
        Confirm Flag
      </button>
    </div>
  </div>
</div>

<!-- MISSING FILES MODAL -->
<div class="rm-modal-bg" id="rm-missing-modal">
  <div class="rm-modal" style="max-width:540px;">
    <div class="rm-modal-head">
      <div>
        <h3>Missing Files Report</h3>
        <div class="rm-modal-head-sub">Residents with incomplete document submissions</div>
      </div>
      <button class="rm-modal-x" onclick="document.getElementById('rm-missing-modal').classList.remove('open')">✕</button>
    </div>
    <div class="rm-modal-body" id="rm-missing-body"></div>
    <div class="rm-modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('rm-missing-modal').classList.remove('open')">Close</button>
      <button class="btn btn-primary btn-sm" onclick="rmExportMissing()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Export Report
      </button>
    </div>
  </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div class="rm-modal-bg" id="rm-del-modal">
  <div class="rm-modal" style="max-width:400px;">
    <div class="rm-modal-head">
      <div>
        <h3>Delete Resident</h3>
      </div>
      <button class="rm-modal-x" onclick="document.getElementById('rm-del-modal').classList.remove('open')">✕</button>
    </div>
    <div class="rm-modal-body" style="text-align:center;padding:28px 20px;">
      <div style="width:56px;height:56px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:24px;height:24px;color:#dc2626;">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
      </div>
      <p style="font-size:.9rem;font-weight:600;color:var(--text);margin:0 0 6px;">Delete <strong id="rm-del-name" style="color:var(--red);"></strong>?</p>
      <p style="font-size:.77rem;color:var(--muted);margin:0;">This action cannot be undone. All associated documents will also be removed.</p>
      <input type="hidden" id="rm-del-id">
    </div>
    <div class="rm-modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('rm-del-modal').classList.remove('open')">Cancel</button>
      <button class="btn btn-danger" onclick="rmConfirmDelete()">Delete Permanently</button>
    </div>
  </div>
</div>

<!-- APPROVE CONFIRM MODAL -->
<div class="rm-modal-bg" id="rm-approve-modal">
  <div class="rm-modal" style="max-width:400px;">
    <div class="rm-modal-head">
      <div>
        <h3>Approve as Member</h3>
      </div>
      <button class="rm-modal-x" onclick="document.getElementById('rm-approve-modal').classList.remove('open')">✕</button>
    </div>
    <div class="rm-modal-body" style="text-align:center;padding:28px 20px;">
      <div style="width:56px;height:56px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:24px;height:24px;color:#16a34a;">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <p style="font-size:.9rem;font-weight:600;color:var(--text);margin:0 0 6px;">Approve <strong id="rm-approve-name" style="color:var(--green);"></strong> as Official Member?</p>
      <p style="font-size:.77rem;color:var(--muted);margin:0;">Their status will be updated to <strong>Approved Member</strong> and they will be notified.</p>
      <input type="hidden" id="rm-approve-id">
    </div>
    <div class="rm-modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('rm-approve-modal').classList.remove('open')">Cancel</button>
      <button class="btn btn-success" onclick="rmConfirmApprove()">✓ Confirm Approval</button>
    </div>
  </div>
</div>

<script>
  // ════════════════════════════════════════════
  // DATA — sample residents
  // ════════════════════════════════════════════
  const MUNI_MAP = {
    'Calamba': 'District II',
    'Biñan': 'District I',
    'San Pedro': 'District I',
    'Cabuyao': 'District II',
    'Los Baños': 'District II',
    'Sta. Cruz': 'District III',
    'Cavinti': 'District III',
    'Pagsanjan': 'District III',
    'Mabitac': 'District III',
    'Pakil': 'District III'
  };
  const DOCS_REQUIRED = ['Primary ID', 'Birth Certificate', 'Proof of Residency', 'Application Form'];

  const RESIDENTS = [{
      id: 1,
      fname: 'John',
      mname: 'A.',
      lname: 'Dela Cruz',
      email: 'john.dc@email.com',
      contact: '09171234567',
      bdate: '1985-04-10',
      gender: 'Male',
      muni: 'Calamba',
      address: 'Brgy. Real, Calamba',
      status: 'approved',
      source: 'admin',
      addedBy: 'Admin',
      remarks: 'Verified resident',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: true,
        appForm: true
      },
      flag: null,
      published: false
    },
    {
      id: 2,
      fname: 'Jane',
      mname: 'M.',
      lname: 'Santos',
      email: 'jane.s@email.com',
      contact: '09182345678',
      bdate: '1992-08-22',
      gender: 'Female',
      muni: 'Biñan',
      address: 'Brgy. Tubigan, Biñan',
      status: 'pending',
      source: 'public',
      addedBy: 'Self',
      remarks: 'Pending verification',
      docs: {
        primaryId: true,
        birthCert: false,
        residency: true,
        appForm: true
      },
      flag: null,
      published: false
    },
    {
      id: 3,
      fname: 'Maria',
      mname: 'C.',
      lname: 'Reyes',
      email: 'maria.r@email.com',
      contact: '09193456789',
      bdate: '1978-12-05',
      gender: 'Female',
      muni: 'San Pedro',
      address: 'Brgy. Pacita, San Pedro',
      status: 'incomplete',
      source: 'admin',
      addedBy: 'Staff',
      remarks: 'Missing birth certificate',
      docs: {
        primaryId: true,
        birthCert: false,
        residency: false,
        appForm: true
      },
      flag: null,
      published: false
    },
    {
      id: 4,
      fname: 'Peter',
      mname: 'D.',
      lname: 'Garcia',
      email: 'peter.g@email.com',
      contact: '09204567890',
      bdate: '1990-03-18',
      gender: 'Male',
      muni: 'Cabuyao',
      address: 'Brgy. Banaybanay, Cabuyao',
      status: 'onhold',
      source: 'admin',
      addedBy: 'Admin',
      remarks: 'Under legal review',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: true,
        appForm: false
      },
      flag: null,
      published: false
    },
    {
      id: 5,
      fname: 'Ana',
      mname: 'L.',
      lname: 'Torres',
      email: 'ana.t@email.com',
      contact: '09215678901',
      bdate: '1995-07-30',
      gender: 'Female',
      muni: 'Los Baños',
      address: 'Brgy. Batong Malake, LB',
      status: 'redflag',
      source: 'admin',
      addedBy: 'Admin',
      remarks: 'Multiple fraudulent claims',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: true,
        appForm: true
      },
      flag: 'redflag',
      published: true
    },
    {
      id: 6,
      fname: 'Ramon',
      mname: 'B.',
      lname: 'Flores',
      email: 'ramon.f@email.com',
      contact: '09226789012',
      bdate: '1980-11-14',
      gender: 'Male',
      muni: 'Sta. Cruz',
      address: 'Brgy. Poblacion, Sta. Cruz',
      status: 'syndicate',
      source: 'admin',
      addedBy: 'Admin',
      remarks: 'Known syndicate member',
      docs: {
        primaryId: false,
        birthCert: true,
        residency: true,
        appForm: true
      },
      flag: 'syndicate',
      published: false
    },
    {
      id: 7,
      fname: 'Liza',
      mname: 'P.',
      lname: 'Cruz',
      email: 'liza.c@email.com',
      contact: '09237890123',
      bdate: '1988-09-06',
      gender: 'Female',
      muni: 'Calamba',
      address: 'Brgy. Canlubang, Calamba',
      status: 'approved',
      source: 'public',
      addedBy: 'Self',
      remarks: 'Self-registered, verified',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: true,
        appForm: true
      },
      flag: null,
      published: false
    },
    {
      id: 8,
      fname: 'Carlos',
      mname: 'E.',
      lname: 'Mendoza',
      email: 'carlos.m@email.com',
      contact: '09248901234',
      bdate: '1975-01-25',
      gender: 'Male',
      muni: 'Biñan',
      address: 'Brgy. Santo Tomas, Biñan',
      status: 'approved',
      source: 'admin',
      addedBy: 'Staff',
      remarks: 'Long-time resident',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: true,
        appForm: true
      },
      flag: null,
      published: false
    },
    {
      id: 9,
      fname: 'Rosa',
      mname: 'V.',
      lname: 'Villanueva',
      email: 'rosa.v@email.com',
      contact: '09259012345',
      bdate: '2000-06-17',
      gender: 'Female',
      muni: 'Cavinti',
      address: 'Brgy. Bangkal, Cavinti',
      status: 'pending',
      source: 'public',
      addedBy: 'Self',
      remarks: 'New application',
      docs: {
        primaryId: true,
        birthCert: false,
        residency: false,
        appForm: false
      },
      flag: null,
      published: false
    },
    {
      id: 10,
      fname: 'Miguel',
      mname: 'R.',
      lname: 'Aquino',
      email: 'miguel.a@email.com',
      contact: '09260123456',
      bdate: '1983-02-28',
      gender: 'Male',
      muni: 'Pagsanjan',
      address: 'Brgy. Pinagsanjan, Pagsanjan',
      status: 'incomplete',
      source: 'admin',
      addedBy: 'Staff',
      remarks: 'Missing residency proof',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: false,
        appForm: true
      },
      flag: null,
      published: false
    },
    {
      id: 11,
      fname: 'Carla',
      mname: 'S.',
      lname: 'Bautista',
      email: 'carla.b@email.com',
      contact: '09271234567',
      bdate: '1997-10-11',
      gender: 'Female',
      muni: 'San Pedro',
      address: 'Brgy. Langgam, San Pedro',
      status: 'approved',
      source: 'admin',
      addedBy: 'Admin',
      remarks: 'Complete documents',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: true,
        appForm: true
      },
      flag: null,
      published: false
    },
    {
      id: 12,
      fname: 'Eduardo',
      mname: 'T.',
      lname: 'Ramos',
      email: 'edu.r@email.com',
      contact: '09282345678',
      bdate: '1969-05-03',
      gender: 'Male',
      muni: 'Cabuyao',
      address: 'Brgy. Bigaa, Cabuyao',
      status: 'onhold',
      source: 'admin',
      addedBy: 'Staff',
      remarks: 'Disputed lot claim',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: true,
        appForm: false
      },
      flag: null,
      published: false
    },
    {
      id: 13,
      fname: 'Patricia',
      mname: 'O.',
      lname: 'Navarro',
      email: 'pat.n@email.com',
      contact: '09293456789',
      bdate: '1993-03-22',
      gender: 'Female',
      muni: 'Los Baños',
      address: 'Brgy. Bayog, Los Baños',
      status: 'approved',
      source: 'public',
      addedBy: 'Self',
      remarks: 'Online applicant, verified',
      docs: {
        primaryId: true,
        birthCert: true,
        residency: true,
        appForm: true
      },
      flag: null,
      published: false
    },
    {
      id: 14,
      fname: 'Jose',
      mname: 'N.',
      lname: 'Aguilar',
      email: 'jose.ag@email.com',
      contact: '09204567891',
      bdate: '1979-08-14',
      gender: 'Male',
      muni: 'Sta. Cruz',
      address: 'Brgy. Calios, Sta. Cruz',
      status: 'redflag',
      source: 'admin',
      addedBy: 'Admin',
      remarks: 'Fake documents submitted',
      docs: {
        primaryId: false,
        birthCert: false,
        residency: true,
        appForm: true
      },
      flag: 'redflag',
      published: false
    },
  ];

  const PER_PAGE = 10;
  let rmPage = 1;
  let rmFiltered = [...RESIDENTS];
  let rmSort_field = 'name';
  let rmSort_dir = 1;
  let _rmActiveBtn = null;
  let _rmEditingId = null;

  // ════════════════════════════════════════════
  // RENDER TABLE
  // ════════════════════════════════════════════
  function rmRender() {
    const tbody = document.getElementById('rm-tbody');
    const total = rmFiltered.length;
    const totalPages = Math.max(1, Math.ceil(total / PER_PAGE));
    if (rmPage > totalPages) rmPage = totalPages;
    const start = (rmPage - 1) * PER_PAGE;
    const slice = rmFiltered.slice(start, start + PER_PAGE);

    if (slice.length === 0) {
      tbody.innerHTML = `<tr><td colspan="9" style="text-align:center;padding:40px 20px;color:var(--muted);font-size:.82rem;">
      <div style="width:40px;height:40px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width:20px;height:20px;color:#94a3b8;"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      </div>No residents match your search.</td></tr>`;
    } else {
      tbody.innerHTML = slice.map(r => rmRow(r)).join('');
    }

    const s = Math.min(start + 1, total),
      e = Math.min(start + PER_PAGE, total);
    document.getElementById('rm-page-info').textContent = total === 0 ? 'No results' : `Showing ${s}–${e} of ${total}`;
    document.getElementById('rm-count-badge').textContent = total === RESIDENTS.length ? `${total} total` : `${total} of ${RESIDENTS.length}`;
    rmRenderPagination(totalPages);
    rmUpdateStats();
  }

  function rmRow(r) {
    const initials = (r.fname[0] + (r.lname[0] || '')).toUpperCase();
    const avCls = {
      approved: 'av-green',
      pending: 'av-yellow',
      incomplete: 'av-orange',
      onhold: 'av-gray',
      redflag: 'av-red',
      syndicate: 'av-purple'
    } [r.status] || 'av-blue';
    const badgeHtml = rmBadge(r);
    const docsOk = Object.values(r.docs).filter(Boolean).length;
    const docsTotal = Object.keys(r.docs).length;
    const docsHtml = DOCS_REQUIRED.map((d, i) => {
      const key = ['primaryId', 'birthCert', 'residency', 'appForm'][i];
      const cls = r.docs[key] ? 'ok' : 'miss';
      return `<span class="rm-file-dot ${cls}" title="${d}: ${r.docs[key]?'Submitted':'Missing'}"></span>`;
    }).join('');
    const missingCount = docsTotal - docsOk;
    const sourceHtml = r.source === 'public' ?
      '<span class="rm-pub-reg"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:9px;height:9px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg> Public</span>' :
      '<span style="font-size:.7rem;color:var(--muted);">Admin</span>';

    const synExtra = r.status === 'syndicate' ?
      '<br><span class="rm-syn-tag">⚠ Syndicate</span>' : '';
    const pubExtra = r.published ?
      '<br><span class="rm-pub-reg">🌐 Published</span>' : '';

    const rowClass = r.status === 'redflag' ? 'style="background:#fff8f8;"' :
      r.status === 'syndicate' ? 'style="background:#faf8ff;"' : '';

    return `<tr ${rowClass} onclick="rmOpenView(${r.id})">
    <td onclick="event.stopPropagation()"><input type="checkbox" class="rm-row-cb" value="${r.id}" style="accent-color:var(--accent);cursor:pointer;"></td>
    <td>
      <div style="display:flex;align-items:center;gap:9px;">
        <div class="rm-avatar ${avCls}">${initials}</div>
        <div>
          <div style="font-weight:600;font-size:.82rem;">${r.fname} ${r.mname} ${r.lname}</div>
          <div style="font-size:.68rem;color:var(--muted);">${r.email}</div>
        </div>
      </div>
    </td>
    <td>
      <span class="rm-muni">${r.muni}</span>
      <div style="font-size:.67rem;color:var(--muted);margin-top:2px;">${MUNI_MAP[r.muni]||''}</div>
    </td>
    <td>${badgeHtml}${synExtra}${pubExtra}</td>
    <td>
      <div class="rm-files" style="margin-bottom:3px;">${docsHtml}</div>
      <div style="font-size:.66rem;color:${missingCount>0?'var(--red)':'var(--green)'};">
        ${docsOk}/${docsTotal} docs ${missingCount>0?'· '+missingCount+' missing':'✓ complete'}
      </div>
    </td>
    <td>${sourceHtml}</td>
    <td><span style="font-size:.75rem;">${r.addedBy}</span></td>
    <td><span style="font-size:.73rem;color:var(--muted);max-width:120px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="${r.remarks}">${r.remarks}</span></td>
    <td onclick="event.stopPropagation()">
      <button class="rm-action-trigger" data-id="${r.id}" onclick="rmToggleMenu(this,${r.id})">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01"/></svg>
      </button>
    </td>
  </tr>`;
  }

  function rmBadge(r) {
    const map = {
      approved: '<span class="rm-badge badge-approved"><span class="dot"></span>Approved</span>',
      pending: '<span class="rm-badge badge-pending"><span class="dot"></span>Applicant</span>',
      incomplete: '<span class="rm-badge badge-incomplete"><span class="dot"></span>Incomplete</span>',
      onhold: '<span class="rm-badge badge-onhold"><span class="dot"></span>On Hold</span>',
      redflag: '<span class="rm-badge badge-redflag"><span class="dot"></span>Red Flag</span>',
      syndicate: '<span class="rm-badge badge-syndicate"><span class="dot"></span>Syndicate</span>',
    };
    return map[r.status] || `<span class="rm-badge">${r.status}</span>`;
  }

  // ════════════════════════════════════════════
  // PAGINATION
  // ════════════════════════════════════════════
  function rmRenderPagination(totalPages) {
    const el = document.getElementById('rm-page-btns');
    el.innerHTML = '';
    const mkBtn = (label, page, disabled, active, isSvg) => {
      const b = document.createElement('button');
      b.className = 'rm-page-btn' + (active ? ' active' : '');
      b.disabled = disabled;
      b.innerHTML = label;
      if (!disabled && !active) b.onclick = () => {
        rmPage = page;
        rmRender();
      };
      return b;
    };
    el.appendChild(mkBtn('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>', rmPage - 1, rmPage === 1, false));
    let pages = [];
    if (totalPages <= 6) {
      for (let i = 1; i <= totalPages; i++) pages.push(i);
    } else {
      pages = [1];
      if (rmPage > 3) pages.push('…');
      for (let i = Math.max(2, rmPage - 1); i <= Math.min(totalPages - 1, rmPage + 1); i++) pages.push(i);
      if (rmPage < totalPages - 2) pages.push('…');
      pages.push(totalPages);
    }
    pages.forEach(p => {
      if (p === '…') {
        const b = document.createElement('button');
        b.className = 'rm-page-btn';
        b.textContent = '…';
        b.disabled = true;
        el.appendChild(b);
      } else el.appendChild(mkBtn(p, p, false, p === rmPage));
    });
    el.appendChild(mkBtn('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>', rmPage + 1, rmPage === totalPages, false));
  }

  // ════════════════════════════════════════════
  // SEARCH / FILTER
  // ════════════════════════════════════════════
  function rmSearch() {
    const q = document.getElementById('rm-search').value.toLowerCase().trim();
    const st = document.getElementById('rm-filter-status').value;
    const mu = document.getElementById('rm-filter-muni').value;
    const src = document.getElementById('rm-filter-reg').value;
    rmFiltered = RESIDENTS.filter(r => {
      const name = `${r.fname} ${r.mname} ${r.lname}`.toLowerCase();
      const matchQ = !q || name.includes(q) || r.email.includes(q) || r.muni.toLowerCase().includes(q) || r.remarks.toLowerCase().includes(q);
      const matchSt = !st || r.status === st;
      const matchMu = !mu || r.muni === mu;
      const matchSrc = !src || r.source === src;
      return matchQ && matchSt && matchMu && matchSrc;
    });
    rmPage = 1;
    rmRender();
  }

  function rmFilter(status, card) {
    document.querySelectorAll('.rm-stat').forEach(c => c.classList.remove('active'));
    card.classList.add('active');
    const sel = document.getElementById('rm-filter-status');
    sel.value = status === 'all' ? '' : status;
    rmSearch();
  }

  function rmSort(field) {
    if (rmSort_field === field) rmSort_dir *= -1;
    else {
      rmSort_field = field;
      rmSort_dir = 1;
    }
    rmFiltered.sort((a, b) => {
      const av = field === 'name' ? `${a.fname}${a.lname}` : a[field] || '';
      const bv = field === 'name' ? `${b.fname}${b.lname}` : b[field] || '';
      return av.localeCompare(bv) * rmSort_dir;
    });
    rmRender();
  }

  function rmSelectAll(cb) {
    document.querySelectorAll('.rm-row-cb').forEach(c => c.checked = cb.checked);
  }

  function rmApplyBulk() {
    const action = document.getElementById('rm-bulk-action').value;
    const selected = [...document.querySelectorAll('.rm-row-cb:checked')].map(c => +c.value);
    if (!action) {
      rmToast('y', 'Select an action', 'Choose a bulk action from the dropdown.');
      return;
    }
    if (selected.length === 0) {
      rmToast('y', 'No rows selected', 'Check the boxes next to residents first.');
      return;
    }
    if (action === 'delete') {
      rmToast('r', 'Deleted', 'Removed ' + selected.length + ' resident(s).');
    } else if (action === 'approve') {
      selected.forEach(id => {
        const r = RESIDENTS.find(x => x.id === id);
        if (r) r.status = 'approved';
      });
      rmSearch();
      rmToast('g', 'Approved', 'Approved ' + selected.length + ' resident(s).');
    } else if (action === 'hold') {
      selected.forEach(id => {
        const r = RESIDENTS.find(x => x.id === id);
        if (r) r.status = 'onhold';
      });
      rmSearch();
      rmToast('b', 'On Hold', 'Placed ' + selected.length + ' resident(s) on hold.');
    } else if (action === 'flag') {
      selected.forEach(id => {
        const r = RESIDENTS.find(x => x.id === id);
        if (r) r.status = 'redflag';
      });
      rmSearch();
      rmToast('r', 'Flagged', 'Flagged ' + selected.length + ' resident(s).');
    } else if (action === 'export') {
      rmToast('b', 'Exported', 'Exporting ' + selected.length + ' resident(s)…');
    }
    document.getElementById('rm-bulk-action').value = '';
    document.getElementById('rm-select-all').checked = false;
  }

  // ════════════════════════════════════════════
  // STATS
  // ════════════════════════════════════════════
  function rmUpdateStats() {
    const count = s => RESIDENTS.filter(r => r.status === s).length;
    document.getElementById('stat-total').textContent = RESIDENTS.length.toLocaleString();
    document.getElementById('stat-app').textContent = count('pending');
    document.getElementById('stat-mem').textContent = count('approved');
    document.getElementById('stat-inc').textContent = count('incomplete');
    document.getElementById('stat-hold').textContent = count('onhold');
    document.getElementById('stat-flag').textContent = (count('redflag') + count('syndicate'));
  }

  // ════════════════════════════════════════════
  // FLOATING ACTION MENU
  // ════════════════════════════════════════════
  function rmToggleMenu(btn, id) {
    const menu = document.getElementById('rm-float-menu');
    if (_rmActiveBtn === btn && menu.style.display === 'block') {
      rmCloseMenu();
      return;
    }
    rmCloseMenu();
    const r = RESIDENTS.find(x => x.id === id);
    if (!r) return;
    const name = `${r.fname} ${r.lname}`;
    let html = `<div class="menu-header">${name}</div>`;
    html += `<button onclick="rmOpenView(${id});rmCloseMenu();">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
    View Details</button>`;
    html += `<button onclick="rmOpenEdit(${id});rmCloseMenu();">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
    Edit Record</button>`;
    if (r.status !== 'approved') {
      html += `<button onclick="rmOpenApprove(${id});rmCloseMenu();" style="color:var(--green);">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      Approve as Member</button>`;
    }
    if (r.status !== 'redflag' && r.status !== 'syndicate') {
      html += `<button class="flag-btn" onclick="rmOpenFlag(${id},'redflag');rmCloseMenu();">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21l1.65-3.8a9 9 0 113.4 2.9L3 21"/></svg>
      Flag as Red Flag</button>`;
      html += `<button class="flag-btn" onclick="rmOpenFlag(${id},'syndicate');rmCloseMenu();">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
      Mark as Syndicate</button>`;
    }
    if (r.status === 'redflag' || r.status === 'syndicate') {
      const pubLabel = r.published ? 'Unpublish Warning' : 'Publish Publicly';
      html += `<button onclick="rmTogglePublicWarning(${id});rmCloseMenu();" style="color:${r.published?'var(--orange)':'var(--accent)'};">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945"/></svg>
      ${pubLabel}</button>`;
    }
    html += `<div class="menu-divider"></div>`;
    html += `<button class="danger" onclick="rmOpenDelete(${id});rmCloseMenu();">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
    Delete Resident</button>`;

    menu.innerHTML = html;
    // Position (fixed, viewport coords only)
    const rect = btn.getBoundingClientRect();
    const menuW = 190,
      menuH = menu.children.length * 36 + 20;
    const spaceBelow = window.innerHeight - rect.bottom;
    const top = spaceBelow < menuH + 8 ? rect.top - menuH - 4 : rect.bottom + 4;
    let left = rect.right - menuW;
    if (left < 8) left = 8;
    if (left + menuW > window.innerWidth - 8) left = window.innerWidth - menuW - 8;
    menu.style.cssText = `display:block;position:fixed;top:${top}px;left:${left}px;width:${menuW}px;`;
    btn.classList.add('open');
    _rmActiveBtn = btn;
    setTimeout(() => document.addEventListener('click', _rmOutsideClose, {
      once: true
    }), 0);
  }

  function _rmOutsideClose(e) {
    const menu = document.getElementById('rm-float-menu');
    if (menu && !menu.contains(e.target) && e.target !== _rmActiveBtn && !_rmActiveBtn?.contains(e.target)) rmCloseMenu();
  }

  function rmCloseMenu() {
    const menu = document.getElementById('rm-float-menu');
    if (menu) {
      menu.style.display = 'none';
      menu.innerHTML = '';
    }
    if (_rmActiveBtn) {
      _rmActiveBtn.classList.remove('open');
      _rmActiveBtn = null;
    }
    document.removeEventListener('click', _rmOutsideClose);
  }

  // ════════════════════════════════════════════
  // VIEW MODAL
  // ════════════════════════════════════════════
  function rmOpenView(id) {
    const r = RESIDENTS.find(x => x.id === id);
    if (!r) return;
    const initials = (r.fname[0] + r.lname[0]).toUpperCase();
    const avCls = {
      approved: 'av-green',
      pending: 'av-yellow',
      incomplete: 'av-orange',
      onhold: 'av-gray',
      redflag: 'av-red',
      syndicate: 'av-purple'
    } [r.status] || 'av-blue';
    const docsMap = [{
      key: 'primaryId',
      label: 'Primary Valid ID'
    }, {
      key: 'birthCert',
      label: 'Birth Certificate'
    }, {
      key: 'residency',
      label: 'Proof of Residency'
    }, {
      key: 'appForm',
      label: 'Application Form'
    }];
    const docsHtml = docsMap.map(d => {
      const stat = r.docs[d.key];
      const cls = stat ? 'ok' : 'miss';
      const icon = stat ?
        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>' :
        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>';
      return `<div class="rm-doc-item ${cls}">
      <div class="rm-doc-item-icon">${icon}</div>
      <div style="flex:1;"><div class="rm-doc-item-name">${d.label}</div></div>
      <span class="rm-doc-item-badge">${stat?'Submitted':'Missing'}</span>
    </div>`;
    }).join('');

    const flagSection = (r.status === 'redflag' || r.status === 'syndicate') ? `
    <div class="rm-redflag-banner" style="margin-top:12px;">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
      <p>This resident is <strong>${r.status==='syndicate'?'marked as a Syndicate member':'flagged as Red Flag'}</strong>. 
      Public visibility: <strong>${r.published?'Published — visible on public site':'Not published'}</strong>.</p>
    </div>
    <div class="rm-publish-toggle">
      <div class="rm-toggle-switch ${r.published?'on':''}" onclick="rmTogglePublicWarning(${r.id});rmCloseView();"></div>
      <div><div class="rm-toggle-label">${r.published?'Currently Published':'Publish Warning Publicly'}</div>
      <div class="rm-toggle-sub">Toggle public visibility of this flag</div></div>
    </div>` : '';

    document.getElementById('rm-view-body').innerHTML = `
    <div class="rm-profile-banner">
      <div class="rm-profile-av ${avCls}">${initials}</div>
      <div>
        <div class="rm-profile-name">${r.fname} ${r.mname} ${r.lname}</div>
        <div class="rm-profile-meta">${r.email} · ${r.contact || 'N/A'}</div>
        <div style="margin-top:6px;display:flex;gap:6px;flex-wrap:wrap;">${rmBadge(r)} <span class="rm-muni" style="background:rgba(255,255,255,.2);color:#fff;">${r.muni}</span> ${r.source==='public'?'<span class="rm-pub-reg">🌐 Public Reg</span>':''}</div>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:14px;">
      ${[['Municipality',r.muni],['District',MUNI_MAP[r.muni]||'—'],['Address',r.address||'—'],['Birthdate',r.bdate||'—'],['Gender',r.gender||'—'],['Added By',r.addedBy]].map(([l,v])=>`
        <div style="background:#f8f9fc;border-radius:8px;padding:9px 12px;border:1px solid var(--border);">
          <div style="font-size:.64rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">${l}</div>
          <div style="font-size:.8rem;font-weight:600;color:var(--text);">${v}</div>
        </div>`).join('')}
    </div>
    <div style="font-size:.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">Document Checklist</div>
    <div class="rm-doc-list">${docsHtml}</div>
    <div style="margin-top:10px;padding:10px 12px;background:#f8f9fc;border-radius:8px;border:1px solid var(--border);">
      <div style="font-size:.64rem;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:3px;">Remarks</div>
      <div style="font-size:.8rem;color:var(--text);">${r.remarks||'—'}</div>
    </div>
    ${flagSection}`;

    document.getElementById('rm-view-edit-btn').onclick = () => {
      rmCloseView();
      rmOpenEdit(r.id);
    };
    document.getElementById('rm-view-modal').classList.add('open');
  }

  function rmCloseView() {
    document.getElementById('rm-view-modal').classList.remove('open');
  }

  // ════════════════════════════════════════════
  // ADD / EDIT MODAL
  // ════════════════════════════════════════════
  function rmOpenAdd() {
    _rmEditingId = null;
    document.getElementById('rm-add-title').textContent = 'Add New Resident';
    document.getElementById('rm-save-label').textContent = 'Save Resident';
    ['fname', 'mname', 'lname', 'email', 'contact', 'bdate', 'address', 'remarks'].forEach(f => {
      const el = document.getElementById('add-' + f);
      if (el) el.value = '';
    });
    document.getElementById('add-gender').value = '';
    document.getElementById('add-muni').value = '';
    document.getElementById('add-status').value = 'pending';
    document.getElementById('add-district').value = '';
    document.getElementById('rm-add-modal').classList.add('open');
  }

  function rmOpenEdit(id) {
    const r = RESIDENTS.find(x => x.id === id);
    if (!r) return;
    _rmEditingId = id;
    document.getElementById('rm-add-title').textContent = 'Edit Resident';
    document.getElementById('rm-save-label').textContent = 'Save Changes';
    document.getElementById('add-fname').value = r.fname;
    document.getElementById('add-mname').value = r.mname;
    document.getElementById('add-lname').value = r.lname;
    document.getElementById('add-email').value = r.email;
    document.getElementById('add-contact').value = r.contact || '';
    document.getElementById('add-bdate').value = r.bdate || '';
    document.getElementById('add-gender').value = r.gender || '';
    document.getElementById('add-muni').value = r.muni || '';
    document.getElementById('add-address').value = r.address || '';
    document.getElementById('add-status').value = r.status || 'pending';
    document.getElementById('add-remarks').value = r.remarks || '';
    document.getElementById('add-district').value = MUNI_MAP[r.muni] || '';
    document.getElementById('rm-add-modal').classList.add('open');
  }

  function rmCloseAdd() {
    document.getElementById('rm-add-modal').classList.remove('open');
  }

  function rmAutoClassify() {
    const muni = document.getElementById('add-muni').value;
    document.getElementById('add-district').value = MUNI_MAP[muni] || '';
  }

  function rmFileSelected(zoneId, labelId, input) {
    if (input.files[0]) {
      const name = input.files[0].name;
      if (labelId) document.getElementById(labelId).textContent = '✓ ' + name;
      if (zoneId) document.getElementById(zoneId).classList.add('has-file');
    }
  }

  function rmClearErr(el) {
    el.classList.remove('error');
    const err = document.getElementById('err-' + el.id.replace('add-', ''));
    if (err) err.style.display = 'none';
  }

  function rmSaveResident() {
    const fname = document.getElementById('add-fname').value.trim();
    const lname = document.getElementById('add-lname').value.trim();
    const email = document.getElementById('add-email').value.trim();
    const muni = document.getElementById('add-muni').value;
    let ok = true;
    if (!fname) {
      rmShowErr('fname');
      ok = false;
    }
    if (!lname) {
      rmShowErr('lname');
      ok = false;
    }
    if (!email || !email.includes('@')) {
      rmShowErr('email');
      ok = false;
    }
    if (!muni) {
      rmShowErr('muni');
      ok = false;
    }
    if (!ok) {
      rmToast('r', 'Please fix the errors', 'Required fields are highlighted.');
      return;
    }

    const btn = document.getElementById('rm-save-btn');
    const lbl = document.getElementById('rm-save-label');
    btn.disabled = true;
    lbl.textContent = 'Saving…';

    setTimeout(() => {
      if (_rmEditingId) {
        const r = RESIDENTS.find(x => x.id === _rmEditingId);
        if (r) {
          r.fname = fname;
          r.lname = lname;
          r.mname = document.getElementById('add-mname').value;
          r.email = email;
          r.muni = muni;
          r.address = document.getElementById('add-address').value;
          r.remarks = document.getElementById('add-remarks').value;
          r.status = document.getElementById('add-status').value;
          r.bdate = document.getElementById('add-bdate').value;
          r.gender = document.getElementById('add-gender').value;
          r.contact = document.getElementById('add-contact').value;
        }
        rmToast('g', 'Resident Updated', `${fname} ${lname}'s record has been saved.`);
      } else {
        const newId = Math.max(...RESIDENTS.map(x => x.id)) + 1;
        RESIDENTS.push({
          id: newId,
          fname,
          lname,
          mname: document.getElementById('add-mname').value,
          email,
          contact: document.getElementById('add-contact').value,
          bdate: document.getElementById('add-bdate').value,
          gender: document.getElementById('add-gender').value,
          muni,
          address: document.getElementById('add-address').value,
          status: document.getElementById('add-status').value,
          source: 'admin',
          addedBy: 'Admin',
          remarks: document.getElementById('add-remarks').value,
          docs: {
            primaryId: false,
            birthCert: false,
            residency: false,
            appForm: false
          },
          flag: null,
          published: false
        });
        rmToast('g', 'Resident Added', `${fname} ${lname} has been registered.`);
      }
      btn.disabled = false;
      lbl.textContent = _rmEditingId ? 'Save Changes' : 'Save Resident';
      rmCloseAdd();
      rmSearch();
    }, 900);
  }

  function rmShowErr(field) {
    const inp = document.getElementById('add-' + field);
    const err = document.getElementById('err-' + field);
    if (inp) inp.classList.add('error');
    if (err) err.style.display = 'block';
  }

  // ════════════════════════════════════════════
  // FLAG MODAL
  // ════════════════════════════════════════════
  function rmOpenFlag(id, type) {
    document.getElementById('flag-resident-id').value = id;
    document.getElementById('flag-type').value = type;
    const r = RESIDENTS.find(x => x.id === id);
    document.getElementById('rm-flag-title').textContent = type === 'syndicate' ? 'Mark as Syndicate' : 'Mark as Red Flag';
    document.getElementById('rm-flag-warn').innerHTML = type === 'syndicate' ?
      'Marking as <strong>Syndicate</strong> records this individual as part of a fraudulent network. This is a serious classification and will be logged.' :
      'Marking as <strong>Red Flag</strong> will restrict access and log this action. Public disclosure is optional.';
    document.getElementById('rm-flag-confirm-btn').textContent = type === 'syndicate' ? '⚠ Confirm Syndicate' : '🚩 Confirm Red Flag';
    document.getElementById('flag-reason').value = '';
    document.getElementById('flag-pub-toggle').classList.remove('on');
    document.getElementById('flag-pub-options').style.display = 'none';
    document.getElementById('rm-flag-modal').classList.add('open');
  }

  function rmCloseFlag() {
    document.getElementById('rm-flag-modal').classList.remove('open');
  }

  function rmTogglePublish(el) {
    el.classList.toggle('on');
    document.getElementById('flag-pub-options').style.display = el.classList.contains('on') ? 'block' : 'none';
  }

  function rmConfirmFlag() {
    const reason = document.getElementById('flag-reason').value.trim();
    if (!reason) {
      rmToast('r', 'Reason required', 'Please describe the reason for flagging.');
      return;
    }
    const id = +document.getElementById('flag-resident-id').value;
    const type = document.getElementById('flag-type').value;
    const pub = document.getElementById('flag-pub-toggle').classList.contains('on');
    const r = RESIDENTS.find(x => x.id === id);
    if (r) {
      r.status = type;
      r.flag = type;
      r.published = pub;
      r.remarks = reason;
    }
    rmCloseFlag();
    rmSearch();
    rmToast('r', type === 'syndicate' ? 'Marked as Syndicate' : 'Flagged as Red Flag', (pub ? 'Published publicly.' : 'Not published publicly.'));
  }

  function rmTogglePublicWarning(id) {
    const r = RESIDENTS.find(x => x.id === id);
    if (!r) return;
    r.published = !r.published;
    rmSearch();
    rmToast(r.published ? 'r' : 'b', r.published ? 'Published Publicly' : 'Unpublished', r.published ? 'Warning is now visible on public site.' : 'Warning removed from public site.');
  }

  // ════════════════════════════════════════════
  // APPROVE / DELETE
  // ════════════════════════════════════════════
  function rmOpenApprove(id) {
    const r = RESIDENTS.find(x => x.id === id);
    if (!r) return;
    document.getElementById('rm-approve-name').textContent = `${r.fname} ${r.lname}`;
    document.getElementById('rm-approve-id').value = id;
    document.getElementById('rm-approve-modal').classList.add('open');
  }

  function rmConfirmApprove() {
    const id = +document.getElementById('rm-approve-id').value;
    const r = RESIDENTS.find(x => x.id === id);
    if (r) {
      r.status = 'approved';
      r.flag = null;
    }
    document.getElementById('rm-approve-modal').classList.remove('open');
    rmSearch();
    rmToast('g', 'Approved', 'Resident has been approved as an official member.');
  }

  function rmOpenDelete(id) {
    const r = RESIDENTS.find(x => x.id === id);
    if (!r) return;
    document.getElementById('rm-del-name').textContent = `${r.fname} ${r.lname}`;
    document.getElementById('rm-del-id').value = id;
    document.getElementById('rm-del-modal').classList.add('open');
  }

  function rmConfirmDelete() {
    const id = +document.getElementById('rm-del-id').value;
    const i = RESIDENTS.findIndex(x => x.id === id);
    if (i > -1) RESIDENTS.splice(i, 1);
    document.getElementById('rm-del-modal').classList.remove('open');
    rmSearch();
    rmToast('r', 'Deleted', 'Resident record has been permanently removed.');
  }

  // ════════════════════════════════════════════
  // MISSING FILES
  // ════════════════════════════════════════════
  function rmOpenMissing() {
    const missing = RESIDENTS.filter(r => Object.values(r.docs).some(v => !v));
    const body = missing.length === 0 ?
      '<p style="text-align:center;color:var(--muted);padding:20px;">All residents have complete documents! ✓</p>' :
      missing.map(r => {
        const missDocs = DOCS_REQUIRED.filter((d, i) => !Object.values(r.docs)[i]);
        return `<div class="rm-missing-alert">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
          <div>
            <strong>${r.fname} ${r.lname}</strong> — <span class="rm-muni">${r.muni}</span>
            <div style="font-size:.7rem;color:var(--muted);margin-top:2px;">Missing: ${missDocs.join(', ')}</div>
          </div>
          <button class="btn btn-outline btn-sm" style="margin-left:auto;flex-shrink:0;" onclick="rmCloseModal('rm-missing-modal');rmOpenEdit(${r.id});">Edit</button>
        </div>`;
      }).join('');
    document.getElementById('rm-missing-body').innerHTML = body;
    document.getElementById('rm-missing-modal').classList.add('open');
  }

  function rmCloseModal(id) {
    document.getElementById(id).classList.remove('open');
  }

  function rmExportMissing() {
    rmToast('b', 'Exporting', 'Missing files report is being prepared…');
  }

  function rmExport() {
    rmToast('b', 'Exporting', 'Full resident list export started…');
  }

  // ════════════════════════════════════════════
  // TOAST
  // ════════════════════════════════════════════
  function rmToast(type, title, msg) {
    const icons = {
      g: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>',
      r: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>',
      y: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01"/></svg>',
      b: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01"/></svg>',
    };
    const el = document.createElement('div');
    el.className = 'rm-toast';
    el.innerHTML = `<div class="rm-toast-ico ${type}">${icons[type]}</div><div><strong>${title}</strong><span>${msg}</span></div><button class="rm-toast-x" onclick="this.closest('.rm-toast').remove()">✕</button>`;
    document.getElementById('rm-toasts').appendChild(el);
    requestAnimationFrame(() => requestAnimationFrame(() => el.classList.add('show')));
    setTimeout(() => {
      el.classList.add('out');
      setTimeout(() => el.remove(), 220);
    }, 3800);
  }

  // ════════════════════════════════════════════
  // CLOSE MODALS ON BACKDROP CLICK
  // ════════════════════════════════════════════
  document.querySelectorAll('.rm-modal-bg').forEach(bg => {
    bg.addEventListener('click', e => {
      if (e.target === bg) bg.classList.remove('open');
    });
  });

  // LOADING SIMULATION
  function rmShowLoader() {
    const l = document.getElementById('rm-loader');
    l.classList.add('show');
    setTimeout(() => l.classList.remove('show'), 600);
  }

  // INIT
  window.addEventListener('DOMContentLoaded', () => {
    rmShowLoader();
    setTimeout(() => {
      rmFiltered = [...RESIDENTS];
      rmRender();
    }, 500);
  });
</script>

@endsection