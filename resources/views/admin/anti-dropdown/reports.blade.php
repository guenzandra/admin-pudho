@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  :root {
    --border:      #e2e5ea;
    --surface2:    #f4f5f7;
    --accent:      #e8472a;
    --accent2:     #f5a623;
    --text:        #1a1d23;
    --text-muted:  #7a8094;
    --text-sub:    #4a5068;
    --green:       #16a34a;
    --red:         #dc2626;
    --blue:        #2563eb;
    --purple:      #7c3aed;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  .rp-wrap {
    font-family: Arial, Helvetica, sans-serif;
    background: transparent;
    color: var(--text);
    min-height: 100vh;
    position: relative;
  }

  /* ── Loading Overlay ── */
  .rp-loader {
    position: absolute; inset: 0;
    background: rgba(255,255,255,0.88);
    z-index: 1035;
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 12px;
    transition: opacity 0.3s;
    min-height: 200px;
  }
  .rp-loader.hidden { opacity: 0; pointer-events: none; }
  .rp-spinner {
    width: 40px; height: 40px;
    border: 3px solid var(--border);
    border-top-color: var(--accent);
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
  }
  .rp-loader p { font-size: 13px; color: var(--text-muted); }
  @keyframes spin { to { transform: rotate(360deg); } }

  /* ── Header ── */
  .rp-header {
    background: #fff;
    border-bottom: 1px solid var(--border);
    padding: 14px 24px;
    display: flex; align-items: center; justify-content: space-between;
    
    gap: 12px; flex-wrap: wrap;
  }
  .rp-header-left { display: flex; align-items: center; gap: 12px; }
  .rp-logo {
    width: 36px; height: 36px; background: var(--accent); border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 14px; color: #fff; flex-shrink: 0;
  }
  .rp-title-block h1 { font-size: 15px; font-weight: 700; color: var(--text); line-height: 1.2; }
  .rp-title-block span { font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; }
  .rp-header-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

  /* ── Buttons ── */
  .btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 14px; border-radius: 7px; border: none;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px; font-weight: 700; cursor: pointer;
    transition: all 0.15s; white-space: nowrap; line-height: 1;
  }
  .btn i { font-size: 12px; }
  .btn-ghost { background: transparent; color: var(--text-sub); border: 1px solid var(--border); }
  .btn-ghost:hover { background: var(--surface2); color: var(--text); }
  .btn-accent { background: var(--accent); color: #fff; }
  .btn-accent:hover { background: #d63d22; }
  .btn-success { background: rgba(22,163,74,0.1); color: var(--green); border: 1px solid rgba(22,163,74,0.25); }
  .btn-success:hover { background: rgba(22,163,74,0.2); }
  .btn-danger { background: rgba(220,38,38,0.1); color: var(--red); border: 1px solid rgba(220,38,38,0.25); }
  .btn-danger:hover { background: rgba(220,38,38,0.2); }
  .btn-sm { padding: 5px 10px; font-size: 12px; }
  .btn-sm i { font-size: 11px; }
  .btn:disabled { opacity: 0.55; cursor: not-allowed; }
  .btn .btn-spinner {
    width: 13px; height: 13px;
    border: 2px solid rgba(255,255,255,0.35);
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
    display: none; flex-shrink: 0;
  }
  .btn.loading .btn-spinner { display: inline-block; }
  .btn.loading .btn-label  { display: none; }

  /* ── Stats ── */
  .rp-stats {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 1px; background: var(--border);
    border-bottom: 1px solid var(--border);
  }
  .stat-cell {
    background: #fff; padding: 15px 20px;
    display: flex; align-items: center; gap: 12px;
  }
  .stat-icon {
    width: 36px; height: 36px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; flex-shrink: 0;
  }
  .stat-cell:nth-child(1) .stat-icon { background: rgba(232,71,42,0.1);  color: var(--accent); }
  .stat-cell:nth-child(2) .stat-icon { background: rgba(245,166,35,0.12); color: #b45309; }
  .stat-cell:nth-child(3) .stat-icon { background: rgba(22,163,74,0.1);   color: var(--green); }
  .stat-cell:nth-child(4) .stat-icon { background: rgba(220,38,38,0.1);   color: var(--red); }
  .stat-info p { font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 2px; }
  .stat-info strong { font-size: 22px; font-weight: 700; }

  /* ── Toolbar ── */
  .rp-toolbar {
    padding: 12px 24px; display: flex; align-items: center;
    gap: 10px; border-bottom: 1px solid var(--border);
    background: #fff; flex-wrap: wrap;
  }
  .search-box { flex: 1; min-width: 180px; position: relative; }
  .search-box i {
    position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
    color: var(--text-muted); font-size: 12px; pointer-events: none;
  }
  .search-box input {
    width: 100%; padding: 8px 10px 8px 32px;
    background: var(--surface2); border: 1px solid var(--border);
    border-radius: 7px; color: var(--text);
    font-family: Arial, Helvetica, sans-serif; font-size: 13px;
    outline: none; transition: border-color 0.2s;
  }
  .search-box input:focus { border-color: var(--accent); background: #fff; }
  .search-box input::placeholder { color: var(--text-muted); }
  .filter-select {
    padding: 8px 28px 8px 10px;
    background: var(--surface2); border: 1px solid var(--border);
    border-radius: 7px; color: var(--text);
    font-family: Arial, Helvetica, sans-serif; font-size: 13px;
    outline: none; cursor: pointer; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%237a8094' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 8px center;
    transition: border-color 0.2s;
  }
  .filter-select:focus { border-color: var(--accent); }

  /* ── Table ── */
  .rp-body { padding: 20px 24px; }
  .table-wrap {
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; overflow: hidden; overflow-x: auto;
  }
  table { width: 100%; border-collapse: collapse; font-size: 13px; min-width: 720px; }
  thead tr { background: #f8f9fb; border-bottom: 1px solid var(--border); }
  th {
    padding: 10px 13px; text-align: left;
    font-size: 10px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.07em; color: var(--text-muted); white-space: nowrap;
  }
  tbody tr { border-bottom: 1px solid var(--border); transition: background 0.12s; cursor: pointer; }
  tbody tr:last-child { border-bottom: none; }
  tbody tr:hover { background: #fafbfc; }
  td { padding: 12px 13px; vertical-align: middle; }

  .reporter-cell { display: flex; align-items: center; gap: 9px; }
  .avatar {
    width: 32px; height: 32px; border-radius: 7px;
    background: var(--surface2); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 700; color: var(--text-sub); flex-shrink: 0;
  }
  .reporter-info strong { display: block; font-size: 13px; font-weight: 700; }
  .reporter-info span   { font-size: 11px; color: var(--text-muted); }

  .badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 8px; border-radius: 20px;
    font-size: 11px; font-weight: 700;
  }
  .badge i { font-size: 9px; }
  .badge-pending  { background: rgba(245,166,35,0.12); color: #92400e; }
  .badge-invest   { background: rgba(37,99,235,0.1);   color: var(--blue); }
  .badge-denied   { background: rgba(220,38,38,0.1);   color: var(--red); }
  .badge-resolved { background: rgba(22,163,74,0.1);   color: var(--green); }
  .badge-office   { background: rgba(124,58,237,0.1);  color: var(--purple); }
  .badge-app      { background: rgba(232,71,42,0.1);   color: var(--accent); }

  .coords-text { font-family: 'Courier New', monospace; font-size: 11px; color: var(--text-sub); }
  .ip-text     { font-family: 'Courier New', monospace; font-size: 11px; color: var(--text-muted); }
  .location-cell strong { display: block; font-size: 13px; font-weight: 700; }
  .location-cell span   { font-size: 11px; color: var(--text-muted); }
  .date-cell strong { display: block; font-size: 13px; font-weight: 700; }
  .date-cell span   { font-size: 11px; color: var(--text-muted); }
  .action-group { display: flex; align-items: center; gap: 5px; }

  .photo-thumb {
    width: 42px; height: 34px; border-radius: 5px;
    background: var(--surface2); border: 1px solid var(--border);
    overflow: hidden; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; cursor: pointer; color: var(--text-muted); font-size: 13px;
  }
  .photo-thumb img { width: 100%; height: 100%; object-fit: cover; }

  /* ── Side Panel ── */
  .detail-panel {
    display: none; position: fixed;
    top: 0; right: 0; bottom: 0; width: 420px;
    background: #fff; border-left: 1px solid var(--border);
    z-index: 1045; overflow-y: auto;
    box-shadow: -4px 0 20px rgba(0,0,0,0.12);
  }
  .detail-panel.open { display: block; animation: slideIn 0.24s ease; }
  @keyframes slideIn {
    from { transform: translateX(28px); opacity: 0; }
    to   { transform: translateX(0);    opacity: 1; }
  }

  .panel-header {
    padding: 16px 20px 14px; border-bottom: 1px solid var(--border);
    position: sticky; top: 0; background: #fff; z-index: 2;
    display: flex; align-items: flex-start; justify-content: space-between; gap: 10px;
  }
  .panel-header h3 { font-size: 14px; font-weight: 700; line-height: 1.3; }
  .panel-header small { font-size: 11px; color: var(--text-muted); margin-top: 3px; display: block; }
  .panel-header-right { display: flex; align-items: center; gap: 7px; flex-shrink: 0; }

  .btn-icon {
    width: 29px; height: 29px; border-radius: 6px;
    background: var(--surface2); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-muted); transition: all 0.15s; font-size: 12px;
  }
  .btn-icon:hover { background: var(--border); color: var(--text); }

  .panel-img { width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block; }
  .panel-img-placeholder {
    width: 100%; aspect-ratio: 16/9; background: var(--surface2);
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 8px; color: var(--text-muted); font-size: 13px;
  }
  .panel-img-placeholder i { font-size: 26px; }

  .panel-section { padding: 14px 20px; border-bottom: 1px solid var(--border); }
  .panel-section:last-child { border-bottom: none; }
  .panel-section h4 {
    font-size: 10px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.08em; color: var(--text-muted); margin-bottom: 10px;
  }
  .info-row { display: flex; align-items: flex-start; gap: 9px; margin-bottom: 8px; }
  .info-row:last-child { margin-bottom: 0; }
  .info-row > i { flex-shrink: 0; margin-top: 2px; color: var(--text-muted); font-size: 12px; width: 14px; text-align: center; }
  .info-row-content strong { display: block; font-size: 13px; font-weight: 700; }
  .info-row-content span   { font-size: 11px; color: var(--text-muted); }

  .detail-text {
    font-size: 13px; color: var(--text-sub); line-height: 1.7;
    background: var(--surface2); border-radius: 7px;
    padding: 10px 12px; border: 1px solid var(--border);
  }

  .panel-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding: 14px 20px; }

  /* ── Modals ── */
  .modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.28); backdrop-filter: blur(2px);
    z-index: 1060; align-items: center; justify-content: center; padding: 16px;
  }
  .modal-overlay.open { display: flex; }

  .modal {
    background: #fff; border: 1px solid var(--border);
    border-radius: 13px; width: 100%; max-height: 90vh;
    overflow-y: auto; box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    animation: modalIn 0.2s ease;
  }
  .modal-sm { max-width: 430px; }
  .modal-lg { max-width: 680px; }
  @keyframes modalIn {
    from { opacity: 0; transform: translateY(12px) scale(0.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
  }

  .modal-header {
    padding: 18px 22px 14px; border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start; justify-content: space-between; gap: 10px;
  }
  .modal-header h2 { font-size: 15px; font-weight: 700; }
  .modal-header p  { font-size: 12px; color: var(--text-muted); margin-top: 3px; }
  .modal-body   { padding: 18px 22px; }
  .modal-footer {
    padding: 14px 22px; border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: flex-end; gap: 8px;
  }

  /* Deny Modal warning */
  .deny-warning {
    background: rgba(220,38,38,0.05); border: 1px solid rgba(220,38,38,0.18);
    border-radius: 8px; padding: 12px 14px; margin-bottom: 16px;
    display: flex; align-items: flex-start; gap: 10px;
  }
  .deny-warning i { color: var(--red); font-size: 14px; margin-top: 1px; flex-shrink: 0; }
  .deny-warning p { font-size: 13px; color: #7f1d1d; line-height: 1.55; }

  /* ── Form fields ── */
  .modal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 13px; }
  .field-group { display: flex; flex-direction: column; gap: 5px; }
  .field-group.full { grid-column: 1 / -1; }
  .field-group label {
    font-size: 10px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.06em; color: var(--text-muted);
  }
  .field-group input,
  .field-group select,
  .field-group textarea {
    background: var(--surface2); border: 1px solid var(--border);
    border-radius: 7px; color: var(--text);
    font-family: Arial, Helvetica, sans-serif; font-size: 13px;
    padding: 8px 11px; outline: none; transition: border-color 0.2s; width: 100%;
  }
  .field-group input:focus,
  .field-group select:focus,
  .field-group textarea:focus { border-color: var(--accent); background: #fff; }
  .field-group input::placeholder,
  .field-group textarea::placeholder { color: var(--text-muted); }
  .field-group textarea { resize: vertical; min-height: 82px; }
  .field-group select {
    appearance: none; cursor: pointer; padding-right: 28px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%237a8094' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 9px center;
  }
  .field-group input.error,
  .field-group textarea.error { border-color: var(--red); }

  /* Source Toggle */
  .source-toggle { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 14px; }
  .source-btn {
    padding: 10px; border-radius: 8px; border: 1.5px solid var(--border);
    background: var(--surface2); color: var(--text-sub);
    font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: 700;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    gap: 7px; transition: all 0.15s;
  }
  .source-btn i { font-size: 13px; }
  .source-btn.active { border-color: var(--purple); background: rgba(124,58,237,0.08); color: var(--purple); }

  .source-tag {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 5px 10px; background: rgba(124,58,237,0.07);
    border: 1px solid rgba(124,58,237,0.18); border-radius: 6px;
    font-size: 11px; color: var(--purple); font-weight: 700; margin-bottom: 14px;
  }

  .upload-area {
    border: 1.5px dashed var(--border); border-radius: 8px;
    padding: 18px; text-align: center; cursor: pointer;
    transition: border-color 0.2s; font-size: 13px; color: var(--text-muted);
  }
  .upload-area:hover { border-color: var(--accent); color: var(--text-sub); }
  .upload-area i { font-size: 20px; display: block; margin: 0 auto 8px; }

  /* ── Backdrop ── */
  .overlay-backdrop {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.35); z-index: 1040;
  }
  .overlay-backdrop.open { display: block; }

  /* ── Toast ── */
  .toast-wrap { position: fixed; bottom: 22px; right: 22px; z-index: 1080; display: flex; flex-direction: column; gap: 8px; }
  .toast {
    background: #fff; border: 1px solid var(--border);
    border-radius: 9px; padding: 11px 15px;
    font-size: 13px; display: flex; align-items: center; gap: 9px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1); min-width: 230px;
    animation: toastIn 0.22s ease;
  }
  @keyframes toastIn {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .toast-icon {
    width: 22px; height: 22px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 11px;
  }
  .toast.success .toast-icon { background: rgba(22,163,74,0.12); color: var(--green); }
  .toast.danger  .toast-icon { background: rgba(220,38,38,0.12);  color: var(--red); }

  /* ── Responsive ── */
  @media (max-width: 1024px) {
    .detail-panel { width: 380px; }
  }
  @media (max-width: 768px) {
    .rp-stats { grid-template-columns: 1fr 1fr; }
    .rp-body, .rp-toolbar, .rp-header { padding-left: 14px; padding-right: 14px; }
    .detail-panel { width: 100%; border-left: none; border-top: 1px solid var(--border); }
    .modal-grid { grid-template-columns: 1fr; }
    .field-group.full { grid-column: 1; }
    th:nth-child(4), td:nth-child(4),
    th:nth-child(5), td:nth-child(5) { display: none; }
  }
  @media (max-width: 540px) {
    .rp-header-actions .btn-label-text { display: none; }
    th:nth-child(2), td:nth-child(2),
    th:nth-child(6), td:nth-child(6) { display: none; }
    .source-toggle { grid-template-columns: 1fr; }
    .panel-actions { grid-template-columns: 1fr; }
    .modal-footer { flex-direction: column-reverse; align-items: stretch; }
    .modal-footer .btn { justify-content: center; }
  }
</style>

<div class="rp-wrap">

  <!-- Loading -->
  <div class="rp-loader" id="rpLoader">
    <div class="rp-spinner"></div>
    <p>Loading reports…</p>
  </div>

  <!-- Header -->
  <div class="rp-header">
    <div class="rp-header-left">
      <div class="rp-logo">AS</div>
      <div class="rp-title-block">
        <h1>Anti-Squatting Reports</h1>
        <span>Complaint Management System</span>
      </div>
    </div>
    <div class="rp-header-actions">
      <button class="btn btn-ghost" onclick="exportReports(this)">
        <i class="fa-solid fa-file-arrow-down"></i>
        <span class="btn-label"><span class="btn-label-text">Export</span><span class="btn-spinner"></span></span>
      </button>
      <button class="btn btn-accent" onclick="openCreateModal()">
        <i class="fa-solid fa-plus"></i>
        <span class="btn-label-text">Create Report Letter</span>
      </button>
    </div>
  </div>

  <!-- Stats -->
  <div class="rp-stats">
    <div class="stat-cell">
      <div class="stat-icon"><i class="fa-solid fa-file-lines"></i></div>
      <div class="stat-info"><p>Total Reports</p><strong>47</strong></div>
    </div>
    <div class="stat-cell">
      <div class="stat-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
      <div class="stat-info"><p>Pending Review</p><strong>18</strong></div>
    </div>
    <div class="stat-cell">
      <div class="stat-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
      <div class="stat-info"><p>Under Investigation</p><strong>21</strong></div>
    </div>
    <div class="stat-cell">
      <div class="stat-icon"><i class="fa-solid fa-circle-xmark"></i></div>
      <div class="stat-info"><p>Denied / Flagged</p><strong>8</strong></div>
    </div>
  </div>

  <!-- Toolbar -->
  <div class="rp-toolbar">
    <div class="search-box">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" placeholder="Search by name, location, IP address…" id="searchInput" oninput="filterTable()">
    </div>
    <select class="filter-select" id="statusFilter" onchange="filterTable()">
      <option value="">All Status</option>
      <option value="pending">Pending</option>
      <option value="investigation">Under Investigation</option>
      <option value="denied">Denied</option>
      <option value="resolved">Resolved</option>
    </select>
    <select class="filter-select" id="sourceFilter" onchange="filterTable()">
      <option value="">All Sources</option>
      <option value="app">App Report</option>
      <option value="office">Office / In-Person</option>
    </select>
    <select class="filter-select" id="dateFilter">
      <option value="">All Dates</option>
      <option value="today">Today</option>
      <option value="week">This Week</option>
      <option value="month">This Month</option>
    </select>
  </div>

  <!-- Table -->
  <div class="rp-body">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Reporter</th>
            <th>Photo</th>
            <th>Location</th>
            <th>Coordinates</th>
            <th>IP Address</th>
            <th>Date Reported</th>
            <th>Source</th>
            <th>Status</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
        <tbody id="tableBody"></tbody>
      </table>
    </div>
  </div>

</div>

<!-- Panel Backdrop -->
<div class="overlay-backdrop" id="panelBackdrop" onclick="closePanel()"></div>

<!-- Side Panel -->
<div class="detail-panel" id="detailPanel">
  <div class="panel-header">
    <div>
      <h3 id="panelTitle">Report Details</h3>
      <small id="panelId">RPT-0000</small>
    </div>
    <div class="panel-header-right">
      <span id="panelStatusBadge" class="badge badge-pending"><i class="fa-solid fa-clock"></i> Pending</span>
      <button class="btn-icon" onclick="closePanel()"><i class="fa-solid fa-xmark"></i></button>
    </div>
  </div>

  <div id="panelImageWrap">
    <div class="panel-img-placeholder">
      <i class="fa-regular fa-image"></i>
      <span>No image attached</span>
    </div>
  </div>

  <div class="panel-section">
    <h4>Reporter Information</h4>
    <div class="info-row"><i class="fa-solid fa-user"></i>
      <div class="info-row-content"><strong id="pReporter">—</strong><span id="pAnon"></span></div>
    </div>
    <div class="info-row"><i class="fa-solid fa-desktop"></i>
      <div class="info-row-content"><strong id="pIP" class="ip-text">—</strong><span>IP Address</span></div>
    </div>
    <div class="info-row"><i class="fa-solid fa-mobile-screen"></i>
      <div class="info-row-content"><strong id="pSource">—</strong><span>Report Source</span></div>
    </div>
  </div>

  <div class="panel-section">
    <h4>Location Details</h4>
    <div class="info-row"><i class="fa-solid fa-location-dot"></i>
      <div class="info-row-content"><strong id="pLocation">—</strong><span id="pAddress"></span></div>
    </div>
    <div class="info-row"><i class="fa-solid fa-earth-asia"></i>
      <div class="info-row-content"><strong id="pCoords" class="coords-text">—</strong><span>GPS Coordinates</span></div>
    </div>
  </div>

  <div class="panel-section">
    <h4>Date &amp; Reference</h4>
    <div class="info-row"><i class="fa-regular fa-calendar"></i>
      <div class="info-row-content"><strong id="pDate">—</strong><span id="pTime"></span></div>
    </div>
  </div>

  <div class="panel-section">
    <h4>Details of Complaint</h4>
    <div class="detail-text" id="pDetails">—</div>
  </div>

  <div class="panel-section">
    <h4>Other Information</h4>
    <div class="detail-text" id="pOther">—</div>
  </div>

  <div class="panel-actions">
    <button class="btn btn-success" id="btnInvestigate" onclick="investigateFromPanel(this)">
      <span class="btn-label">
        <i class="fa-solid fa-magnifying-glass"></i> Proceed to Investigation
        <span class="btn-spinner"></span>
      </span>
    </button>
    <button class="btn btn-danger" onclick="openDenyModal()">
      <i class="fa-solid fa-ban"></i> Deny Report
    </button>
  </div>
</div>

<!-- Deny Modal -->
<div class="modal-overlay" id="denyModal">
  <div class="modal modal-sm">
    <div class="modal-header">
      <div>
        <h2>Deny Report</h2>
        <p id="denySubtitle">Provide a remark before denying.</p>
      </div>
      <button class="btn-icon" onclick="closeDenyModal()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="deny-warning">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <p>This will mark the report as <strong>Denied</strong>. Please select or provide a remark explaining the reason.</p>
      </div>
      <div class="field-group" style="margin-bottom:10px">
        <label>Common Reason</label>
        <select id="remarkPreset" onchange="applyPreset()">
          <option value="">— Select a reason —</option>
          <option value="Scam / Fraudulent report">Scam / Fraudulent report</option>
          <option value="Duplicate report">Duplicate report</option>
          <option value="Insufficient evidence">Insufficient evidence</option>
          <option value="Complainant has no legal standing">Complainant has no legal standing</option>
          <option value="Occupants have a valid lease agreement">Occupants have a valid lease agreement</option>
          <option value="Property under pending court dispute">Property under pending court dispute</option>
          <option value="custom">Other (specify below)</option>
        </select>
      </div>
      <div class="field-group">
        <label>Additional Remarks <span style="color:var(--red)">*</span></label>
        <textarea id="remarkInput" rows="3" placeholder="Describe the reason for denial…"></textarea>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeDenyModal()">Cancel</button>
      <button class="btn btn-danger" id="btnConfirmDeny" onclick="confirmDeny(this)">
        <span class="btn-label">
          <i class="fa-solid fa-ban"></i> Confirm Denial
          <span class="btn-spinner"></span>
        </span>
      </button>
    </div>
  </div>
</div>

<!-- Create Report Letter Modal -->
<div class="modal-overlay" id="createModal">
  <div class="modal modal-lg">
    <div class="modal-header">
      <div>
        <h2>Create Report Letter</h2>
        <p>Manually log a complaint received at the office or via phone.</p>
      </div>
      <button class="btn-icon" onclick="closeCreateModal()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="source-toggle">
        <button class="source-btn active" id="srcOffice" onclick="setSource('office')">
          <i class="fa-solid fa-building"></i> Office / In-Person
        </button>
        <button class="source-btn" id="srcPhone" onclick="setSource('phone')">
          <i class="fa-solid fa-phone"></i> Phone Report
        </button>
      </div>
      <div class="source-tag" id="sourceLabel">
        <i class="fa-solid fa-building"></i> Walk-in / Office Report
      </div>
      <div class="modal-grid">
        <div class="field-group">
          <label>Reporter Name</label>
          <input type="text" placeholder="Full name (leave blank for anonymous)">
        </div>
        <div class="field-group">
          <label>Contact Number</label>
          <input type="text" placeholder="+63 9XX XXX XXXX">
        </div>
        <div class="field-group full">
          <label>Address / Location of Incident</label>
          <input type="text" placeholder="Street, Barangay, City, Province">
        </div>
        <div class="field-group">
          <label>GPS Coordinates (optional)</label>
          <input type="text" placeholder="e.g. 14.5995° N, 120.9842° E">
        </div>
        <div class="field-group">
          <label>Date of Incident</label>
          <input type="date">
        </div>
        <div class="field-group">
          <label>Received By (Officer)</label>
          <input type="text" placeholder="Officer name / badge number">
        </div>
        <div class="field-group">
          <label>Priority Level</label>
          <select><option>Normal</option><option>High</option><option>Urgent</option></select>
        </div>
        <div class="field-group full">
          <label>Details of Complaint</label>
          <textarea placeholder="Describe the squatting incident in detail…"></textarea>
        </div>
        <div class="field-group full">
          <label>Other Information / Evidence Notes</label>
          <textarea style="min-height:66px" placeholder="Notes, witnesses, evidence collected…"></textarea>
        </div>
        <div class="field-group full">
          <label>Attach Supporting Document / Image</label>
          <div class="upload-area" onclick="document.getElementById('fileUpload').click()">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            Click to upload photo, PDF, or document
            <br><small style="font-size:11px;color:var(--text-muted)">JPG, PNG, PDF up to 10MB</small>
          </div>
          <input type="file" id="fileUpload" style="display:none" accept="image/*,.pdf">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeCreateModal()">Cancel</button>
      <button class="btn btn-accent" onclick="submitReport(this)">
        <span class="btn-label">
          <i class="fa-solid fa-paper-plane"></i> Submit Report Letter
          <span class="btn-spinner"></span>
        </span>
      </button>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
const REPORTS = [
  { id:'RPT-2025-001', name:'Maria Santos',      anonymous:false, initials:'MS', image:null,
    location:'Barangay Tondo',  address:'Sta. Ana Street, Tondo, Manila',
    coords:'14.6194° N, 120.9683° E', ip:'112.198.42.17', date:'2025-07-14', time:'09:32 AM',
    source:'app', status:'pending',
    details:'A group of approximately 8 individuals have been occupying the vacant lot at the corner of Sta. Ana and Dagupan Streets since March 2025. They have erected makeshift shelters using corrugated tin and tarpaulin without the consent of the property owner.',
    other:'Property is registered under TCT No. T-12345. Owner is currently abroad. Caretaker has been threatened when attempting to remove the occupants.' },
  { id:'RPT-2025-002', name:'Anonymous',          anonymous:true,  initials:'?', image:null,
    location:'Pasig City',      address:'Kapitolyo, Pasig City, Metro Manila',
    coords:'14.5667° N, 121.0750° E', ip:'180.191.77.233', date:'2025-07-12', time:'02:14 PM',
    source:'app', status:'investigation',
    details:'Three families have been squatting on the riverside area behind the commercial building on Brixton Street since the floods last year.',
    other:'Estimated 3 families, around 15 individuals. No utilities connected officially.' },
  { id:'RPT-2025-003', name:'Jose Reyes',         anonymous:false, initials:'JR', image:null,
    location:'Quezon City',     address:'Commonwealth Ave., QC, Metro Manila',
    coords:'14.6760° N, 121.0437° E', ip:'122.53.110.89', date:'2025-07-10', time:'11:05 AM',
    source:'office', status:'pending',
    details:'Complainant personally appeared at the office to report that his inherited property has been occupied by unknown persons. He was assisted by front desk staff.',
    other:'Complainant brought a copy of land title and photos. Case referred by Barangay Batasan Hills.' },
  { id:'RPT-2025-004', name:'Lourdes Dela Cruz',  anonymous:false, initials:'LD', image:null,
    location:'Caloocan City',   address:'Grace Park, Caloocan City',
    coords:'14.6572° N, 120.9847° E', ip:'49.148.22.61', date:'2025-07-08', time:'04:47 PM',
    source:'app', status:'denied',
    details:'Complainant reported squatters on a lot she claims to own. Upon verification, the occupants have a valid lease agreement predating the complaint.',
    other:'Report marked as invalid. Occupants have legal standing under current court order.' },
  { id:'RPT-2025-005', name:'Anonymous',          anonymous:true,  initials:'?', image:null,
    location:'Marikina City',   address:'Sto. Niño, Marikina City',
    coords:'14.6350° N, 121.1028° E', ip:'202.90.144.55', date:'2025-07-07', time:'08:19 AM',
    source:'app', status:'resolved',
    details:'Reported illegal structures along the Marikina riverbank within the 3-meter easement zone. Structures were already identified by MMDA and demolished on July 9, 2025.',
    other:'Case resolved after coordination with MMDA Marikina.' },
  { id:'RPT-2025-006', name:'Rodrigo Villanueva', anonymous:false, initials:'RV', image:null,
    location:'Valenzuela City', address:'Ugong Norte, Valenzuela City',
    coords:'14.6951° N, 120.9773° E', ip:'112.204.88.13', date:'2025-07-05', time:'01:30 PM',
    source:'office', status:'investigation',
    details:'Approximately 20 families have erected semi-permanent structures on a commercial lot. Occupation estimated to have started in late 2024.',
    other:'Barangay mediation failed. Evidence of unauthorized electrical connections.' }
];

let currentReport = null;
let denyTargetId  = null;
let currentSource = 'office';

function sc(s) { return {pending:'badge-pending',investigation:'badge-invest',denied:'badge-denied',resolved:'badge-resolved'}[s]||'badge-pending'; }
function sl(s) { return {pending:'Pending Review',investigation:'Under Investigation',denied:'Denied',resolved:'Resolved'}[s]||s; }
function si(s) { return {pending:'fa-clock',investigation:'fa-magnifying-glass',denied:'fa-ban',resolved:'fa-circle-check'}[s]||'fa-circle'; }

function renderTable(data) {
  const tbody = document.getElementById('tableBody');
  if (!data.length) {
    tbody.innerHTML = `<tr><td colspan="9" style="text-align:center;padding:32px;color:var(--text-muted)"><i class="fa-solid fa-inbox" style="font-size:22px;display:block;margin-bottom:8px"></i>No reports found</td></tr>`;
    return;
  }
  tbody.innerHTML = data.map(r => `
    <tr onclick="openPanel('${r.id}')">
      <td><div class="reporter-cell">
        <div class="avatar">${r.initials}</div>
        <div class="reporter-info"><strong>${r.name}</strong><span>${r.anonymous?'Anonymous':'Named Reporter'}</span></div>
      </div></td>
      <td><div class="photo-thumb">${r.image?`<img src="${r.image}" alt="Evidence">`:`<i class="fa-regular fa-image"></i>`}</div></td>
      <td><div class="location-cell"><strong>${r.location}</strong><span>${r.address.split(',')[0]}</span></div></td>
      <td><span class="coords-text">${r.coords}</span></td>
      <td><span class="ip-text">${r.ip}</span></td>
      <td><div class="date-cell"><strong>${r.date}</strong><span>${r.time}</span></div></td>
      <td><span class="badge ${r.source==='office'?'badge-office':'badge-app'}">
        <i class="fa-solid ${r.source==='office'?'fa-building':'fa-mobile-screen'}"></i>
        ${r.source==='office'?'Office':'App'}
      </span></td>
      <td><span class="badge ${sc(r.status)}"><i class="fa-solid ${si(r.status)}"></i> ${sl(r.status)}</span></td>
      <td style="text-align:right"><div class="action-group" style="justify-content:flex-end">
        <button class="btn btn-ghost btn-sm" onclick="event.stopPropagation();openPanel('${r.id}')">
          <i class="fa-solid fa-eye"></i> View
        </button>
        ${r.status==='pending'?`
        <button class="btn btn-success btn-sm" title="Proceed to Investigation" onclick="event.stopPropagation();quickInvestigate('${r.id}',this)">
          <span class="btn-label"><i class="fa-solid fa-magnifying-glass"></i><span class="btn-spinner"></span></span>
        </button>
        <button class="btn btn-danger btn-sm" title="Deny Report" onclick="event.stopPropagation();openDenyForId('${r.id}')">
          <i class="fa-solid fa-ban"></i>
        </button>`:''}
      </div></td>
    </tr>`).join('');
}

function filterTable() {
  const q=document.getElementById('searchInput').value.toLowerCase();
  const st=document.getElementById('statusFilter').value;
  const src=document.getElementById('sourceFilter').value;
  renderTable(REPORTS.filter(r=>{
    const mQ=!q||r.name.toLowerCase().includes(q)||r.location.toLowerCase().includes(q)||r.ip.includes(q)||r.address.toLowerCase().includes(q);
    return mQ&&(!st||r.status===st)&&(!src||r.source===src);
  }));
}

function openPanel(id) {
  const r=REPORTS.find(x=>x.id===id); if(!r) return;
  currentReport=r;
  document.getElementById('panelTitle').textContent=r.location+' Complaint';
  document.getElementById('panelId').textContent=r.id;
  const b=document.getElementById('panelStatusBadge');
  b.className=`badge ${sc(r.status)}`;
  b.innerHTML=`<i class="fa-solid ${si(r.status)}"></i> ${sl(r.status)}`;
  document.getElementById('pReporter').textContent=r.name;
  document.getElementById('pAnon').textContent=r.anonymous?'Anonymous — identity withheld':'Named complainant';
  document.getElementById('pIP').textContent=r.ip;
  document.getElementById('pSource').innerHTML=r.source==='office'
    ?'<i class="fa-solid fa-building"></i> Office / In-Person Report'
    :'<i class="fa-solid fa-mobile-screen"></i> Anti-Squatting Mobile App';
  document.getElementById('pLocation').textContent=r.location;
  document.getElementById('pAddress').textContent=r.address;
  document.getElementById('pCoords').textContent=r.coords;
  document.getElementById('pDate').textContent=r.date;
  document.getElementById('pTime').textContent=r.time;
  document.getElementById('pDetails').textContent=r.details;
  document.getElementById('pOther').textContent=r.other;
  document.getElementById('panelImageWrap').innerHTML=r.image
    ?`<img class="panel-img" src="${r.image}" alt="Evidence">`
    :`<div class="panel-img-placeholder"><i class="fa-regular fa-image"></i><span>No image attached</span></div>`;
  document.getElementById('detailPanel').classList.add('open');
  document.getElementById('panelBackdrop').classList.add('open');
}

function closePanel() {
  document.getElementById('detailPanel').classList.remove('open');
  document.getElementById('panelBackdrop').classList.remove('open');
  currentReport=null;
}

function setStatus(id, status) {
  const r=REPORTS.find(x=>x.id===id); if(!r) return;
  r.status=status; filterTable();
  if(currentReport&&currentReport.id===id) {
    const b=document.getElementById('panelStatusBadge');
    b.className=`badge ${sc(status)}`;
    b.innerHTML=`<i class="fa-solid ${si(status)}"></i> ${sl(status)}`;
  }
}

function investigateFromPanel(btn) {
  if(!currentReport) return;
  setLoading(btn,true);
  setTimeout(()=>{ setLoading(btn,false); setStatus(currentReport.id,'investigation'); showToast('success','<i class="fa-solid fa-magnifying-glass"></i> Moved to <strong>Under Investigation</strong>'); },900);
}

function quickInvestigate(id, btn) {
  setLoading(btn,true);
  setTimeout(()=>{ setLoading(btn,false); setStatus(id,'investigation'); showToast('success',`<i class="fa-solid fa-magnifying-glass"></i> ${id} moved to Investigation`); },900);
}

function openDenyModal() {
  denyTargetId=currentReport?currentReport.id:null;
  document.getElementById('denySubtitle').textContent=currentReport?`Report ${currentReport.id} — ${currentReport.location}`:'';
  resetDenyForm();
  document.getElementById('denyModal').classList.add('open');
}

function openDenyForId(id) {
  denyTargetId=id;
  const r=REPORTS.find(x=>x.id===id);
  document.getElementById('denySubtitle').textContent=r?`Report ${r.id} — ${r.location}`:'';
  resetDenyForm();
  document.getElementById('denyModal').classList.add('open');
}

function closeDenyModal() { document.getElementById('denyModal').classList.remove('open'); resetDenyForm(); }

function resetDenyForm() {
  document.getElementById('remarkPreset').value='';
  document.getElementById('remarkInput').value='';
  document.getElementById('remarkInput').classList.remove('error');
}

function applyPreset() {
  const v=document.getElementById('remarkPreset').value;
  if(v&&v!=='custom') document.getElementById('remarkInput').value=v;
}

function confirmDeny(btn) {
  const preset=document.getElementById('remarkPreset').value;
  const custom=document.getElementById('remarkInput').value.trim();
  const remark=custom||(preset!=='custom'?preset:'');
  if(!remark) { document.getElementById('remarkInput').classList.add('error'); document.getElementById('remarkInput').focus(); return; }
  setLoading(btn,true);
  setTimeout(()=>{
    setLoading(btn,false);
    setStatus(denyTargetId,'denied');
    if(currentReport&&currentReport.id===denyTargetId) closePanel();
    closeDenyModal();
    showToast('danger',`<i class="fa-solid fa-ban"></i> Report denied — <em>${remark}</em>`);
    denyTargetId=null;
  },900);
}

function openCreateModal()  { document.getElementById('createModal').classList.add('open'); }
function closeCreateModal() { document.getElementById('createModal').classList.remove('open'); }

function setSource(src) {
  currentSource=src;
  document.getElementById('srcOffice').classList.toggle('active',src==='office');
  document.getElementById('srcPhone').classList.toggle('active',src==='phone');
  document.getElementById('sourceLabel').innerHTML=src==='office'
    ?'<i class="fa-solid fa-building"></i> Walk-in / Office Report'
    :'<i class="fa-solid fa-phone"></i> Phone / Call-In Report';
}

function submitReport(btn) {
  setLoading(btn,true);
  setTimeout(()=>{ setLoading(btn,false); closeCreateModal(); showToast('success','<i class="fa-solid fa-circle-check"></i> Report letter submitted successfully'); },1200);
}

function exportReports(btn) {
  setLoading(btn,true);
  setTimeout(()=>{ setLoading(btn,false); showToast('success','<i class="fa-solid fa-file-arrow-down"></i> Reports exported to CSV'); },1000);
}

function setLoading(btn, on) {
  if(!btn) return;
  btn.disabled=on; btn.classList.toggle('loading',on);
}

function showToast(type, msg) {
  const wrap=document.getElementById('toastWrap');
  const t=document.createElement('div');
  t.className=`toast ${type}`;
  t.innerHTML=`<div class="toast-icon"><i class="fa-solid ${type==='success'?'fa-check':'fa-xmark'}"></i></div><span>${msg}</span>`;
  wrap.appendChild(t);
  setTimeout(()=>t.remove(),3800);
}

document.getElementById('createModal').addEventListener('click',e=>{ if(e.target===e.currentTarget) closeCreateModal(); });
document.getElementById('denyModal').addEventListener('click',  e=>{ if(e.target===e.currentTarget) closeDenyModal(); });

window.addEventListener('DOMContentLoaded',()=>{
  renderTable(REPORTS);
  setTimeout(()=>document.getElementById('rpLoader').classList.add('hidden'),800);
});
</script>

@endsection