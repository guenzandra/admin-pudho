@extends('admin.layout')

@section('title', 'Audit Logs')

@section('content')

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
    --red-light: #F9EAEB;
    --red-mid: #E8424F;
    --red-pale: #FEF5F5;
    --border: #EDE0E1;
    --text: #1A0508;
    --text-mid: #7A4A50;
    --text-muted: #B08888;
    --surface: #FFFFFF;
    --bg: #F7F1F2;
    --radius: 10px;
    --shadow: 0 1px 4px rgba(192, 32, 47, 0.07);
  }

  body {
    font-family: Arial, sans-serif;
  }

  /* ── PAGE HEADER ── */
  .logs-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
    margin-bottom: 22px;
  }

  .logs-header-left h2 {
    font-size: 22px;
    font-weight: 700;
    color: var(--text);
    font-family: Arial, sans-serif;
  }

  .logs-header-left p {
    font-size: 13px;
    color: var(--text-muted);
    margin-top: 3px;
  }

  /* ── STAT CHIPS ── */
  .stat-chips {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
  }

  .stat-chip {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 12px 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 140px;
    box-shadow: var(--shadow);
  }

  .stat-chip-icon {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .stat-chip-icon svg {
    width: 16px;
    height: 16px;
  }

  .stat-chip-val {
    font-size: 20px;
    font-weight: 700;
    color: var(--text);
    line-height: 1;
  }

  .stat-chip-lbl {
    font-size: 11px;
    color: var(--text-muted);
    margin-top: 2px;
  }

  /* ── CARD ── */
  .logs-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  /* ── TOOLBAR ── */
  .toolbar {
    padding: 16px 18px;
    border-bottom: 1px solid var(--border);
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    background: var(--red-pale);
  }

  .tab-group {
    display: flex;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
  }

  .tab-btn {
    padding: 8px 15px;
    font-family: Arial, sans-serif;
    font-size: 13px;
    font-weight: 600;
    border: none;
    background: none;
    cursor: pointer;
    color: var(--text-mid);
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background .15s, color .15s;
    white-space: nowrap;
    border-right: 1px solid var(--border);
    position: relative;
  }

  .tab-btn:last-child {
    border-right: none;
  }

  .tab-btn.active {
    background: var(--red);
    color: #fff;
  }

  .tab-btn:not(.active):hover {
    background: var(--red-light);
    color: var(--red);
  }

  .tab-btn .tab-count {
    background: rgba(255, 255, 255, 0.25);
    color: inherit;
    font-size: 10px;
    font-weight: 700;
    padding: 1px 6px;
    border-radius: 10px;
  }

  .tab-btn:not(.active) .tab-count {
    background: var(--red-light);
    color: var(--red);
  }

  .toolbar-right {
    margin-left: auto;
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    align-items: center;
  }

  .search-box {
    position: relative;
  }

  .search-box input {
    font-family: Arial, sans-serif;
    font-size: 13px;
    padding: 8px 12px 8px 34px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--surface);
    color: var(--text);
    outline: none;
    width: 200px;
    transition: border-color .15s;
  }

  .search-box input:focus {
    border-color: var(--red);
  }

  .search-box svg {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 14px;
    height: 14px;
    color: var(--text-muted);
    pointer-events: none;
  }

  .filter-select {
    font-family: Arial, sans-serif;
    font-size: 13px;
    padding: 8px 10px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--surface);
    color: var(--text-mid);
    outline: none;
    cursor: pointer;
    transition: border-color .15s;
  }

  .filter-select:focus {
    border-color: var(--red);
  }

  .btn {
    font-family: Arial, sans-serif;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 14px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background .15s, color .15s;
    white-space: nowrap;
  }

  .btn svg {
    width: 14px;
    height: 14px;
  }

  .btn-red {
    background: var(--red);
    color: #fff;
  }

  .btn-red:hover {
    background: var(--red-dark);
  }

  .btn-outline {
    background: var(--surface);
    border: 1px solid var(--border);
    color: var(--text-mid);
  }

  .btn-outline:hover {
    background: var(--red-pale);
    color: var(--red);
    border-color: var(--red);
  }

  /* ── TABLE ── */
  .table-wrap {
    overflow-x: auto;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 13px;
  }

  thead tr {
    background: var(--red-pale);
    border-bottom: 2px solid var(--border);
  }

  thead th {
    padding: 11px 16px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--text-muted);
    white-space: nowrap;
    user-select: none;
    cursor: pointer;
  }

  thead th:hover {
    color: var(--red);
  }

  thead th svg {
    width: 11px;
    height: 11px;
    vertical-align: middle;
    margin-left: 3px;
  }

  tbody tr {
    border-bottom: 1px solid var(--border);
    cursor: pointer;
    transition: background .12s;
  }

  tbody tr:last-child {
    border-bottom: none;
  }

  tbody tr:hover {
    background: var(--red-pale);
  }

  tbody td {
    padding: 11px 16px;
    color: var(--text-mid);
    vertical-align: middle;
  }

  tbody td.name {
    color: var(--text);
    font-weight: 600;
  }

  .pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
  }

  .pill::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    flex-shrink: 0;
  }

  .pill-success {
    background: #DCFCE7;
    color: #15803D;
  }

  .pill-success::before {
    background: #15803D;
  }

  .pill-warning {
    background: #FEF9C3;
    color: #A16207;
  }

  .pill-warning::before {
    background: #A16207;
  }

  .pill-error {
    background: #FFE4E6;
    color: #BE123C;
  }

  .pill-error::before {
    background: #BE123C;
  }

  .pill-info {
    background: #EFF6FF;
    color: #1D4ED8;
  }

  .pill-info::before {
    background: #1D4ED8;
  }

  .type-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }

  .type-user {
    background: var(--red-light);
    color: var(--red);
  }

  .type-system {
    background: #EFF6FF;
    color: #1D4ED8;
  }

  .type-error {
    background: #FFE4E6;
    color: #BE123C;
  }

  .avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--red);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 7px;
    flex-shrink: 0;
    vertical-align: middle;
  }

  .user-cell {
    display: flex;
    align-items: center;
  }

  /* ── PAGINATION ── */
  .pagination-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 13px 18px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 10px;
    font-size: 13px;
    color: var(--text-muted);
  }

  .pag-btns {
    display: flex;
    gap: 4px;
  }

  .pag-btn {
    font-family: Arial, sans-serif;
    width: 32px;
    height: 32px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: var(--surface);
    color: var(--text-mid);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .12s, color .12s, border-color .12s;
  }

  .pag-btn:hover {
    background: var(--red-pale);
    color: var(--red);
    border-color: var(--red);
  }

  .pag-btn.active {
    background: var(--red);
    color: #fff;
    border-color: var(--red);
  }

  .pag-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
  }

  /* ── MODAL ── */
  .modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(26, 5, 8, 0.45);
    z-index: 200;
    align-items: center;
    justify-content: center;
    padding: 16px;
    backdrop-filter: blur(2px);
  }

  .modal-overlay.show {
    display: flex;
  }

  .modal {
    background: var(--surface);
    border-radius: 14px;
    width: 100%;
    box-shadow: 0 20px 60px rgba(192, 32, 47, 0.18);
    overflow: hidden;
    animation: modalIn .2s ease;
    position: relative;
  }

  .modal-detail {
    max-width: 560px;
  }

  .modal-download {
    max-width: 480px;
  }

  @keyframes modalIn {
    from {
      opacity: 0;
      transform: translateY(-12px) scale(0.98);
    }

    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    background: var(--red-pale);
  }

  .modal-header h3 {
    font-size: 16px;
    font-weight: 700;
    color: var(--text);
    font-family: Arial, sans-serif;
  }

  .modal-close {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    padding: 4px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .12s, color .12s;
  }

  .modal-close:hover {
    background: var(--red-light);
    color: var(--red);
  }

  .modal-close svg {
    width: 18px;
    height: 18px;
  }

  .modal-body {
    padding: 20px;
  }

  /* Detail modal */
  .detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 18px;
  }

  .detail-field {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .detail-field.full {
    grid-column: 1/-1;
  }

  .detail-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--text-muted);
  }

  .detail-value {
    font-size: 14px;
    color: var(--text);
    font-weight: 500;
  }

  .detail-value.mono {
    font-family: monospace;
    font-size: 12.5px;
    background: var(--bg);
    padding: 8px 10px;
    border-radius: 6px;
    border: 1px solid var(--border);
    line-height: 1.5;
    word-break: break-all;
  }

  /* Download modal */
  .dl-format-row {
    display: flex;
    gap: 10px;
    margin-bottom: 16px;
  }

  .dl-format-btn {
    flex: 1;
    padding: 14px 10px;
    border: 2px solid var(--border);
    border-radius: 10px;
    background: var(--surface);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 7px;
    transition: border-color .15s, background .15s;
    font-family: Arial, sans-serif;
  }

  .dl-format-btn:hover {
    border-color: var(--red);
    background: var(--red-pale);
  }

  .dl-format-btn.selected {
    border-color: var(--red);
    background: var(--red-pale);
  }

  .dl-format-btn svg {
    width: 28px;
    height: 28px;
  }

  .dl-format-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
  }

  .dl-format-sub {
    font-size: 11px;
    color: var(--text-muted);
  }

  .form-group {
    margin-bottom: 14px;
  }

  .form-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: var(--text-mid);
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
  }

  .form-input {
    font-family: Arial, sans-serif;
    font-size: 13px;
    width: 100%;
    padding: 9px 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--surface);
    color: var(--text);
    outline: none;
    transition: border-color .15s;
  }

  .form-input:focus {
    border-color: var(--red);
  }

  .date-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }

  .modal-footer {
    padding: 14px 20px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    background: var(--red-pale);
  }

  /* ── TOAST ── */
  .toast-container {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 500;
    display: flex;
    flex-direction: column;
    gap: 8px;
    pointer-events: none;
  }

  .toast {
    background: var(--surface);
    border: 1px solid var(--border);
    border-left: 4px solid var(--red);
    border-radius: 10px;
    padding: 13px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
    pointer-events: auto;
    animation: toastIn .22s ease;
    min-width: 240px;
    max-width: 340px;
    font-family: Arial, sans-serif;
  }

  .toast.toast-success {
    border-left-color: #16a34a;
  }

  .toast.toast-error {
    border-left-color: var(--red);
  }

  .toast.toast-info {
    border-left-color: #3B82F6;
  }

  @keyframes toastIn {
    from {
      opacity: 0;
      transform: translateX(20px);
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .toast svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
  }

  .toast-msg {
    font-size: 13px;
    color: var(--text);
    font-weight: 500;
    flex: 1;
  }

  .toast-dismiss {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    padding: 2px;
    border-radius: 4px;
    display: flex;
  }

  .toast-dismiss:hover {
    color: var(--text);
  }

  .toast-dismiss svg {
    width: 13px;
    height: 13px;
  }

  /* ── EMPTY STATE ── */
  .empty-state {
    text-align: center;
    padding: 48px 20px;
    color: var(--text-muted);
    display: none;
  }

  .empty-state svg {
    width: 44px;
    height: 44px;
    margin-bottom: 12px;
    opacity: 0.35;
  }

  .empty-state p {
    font-size: 14px;
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 768px) {
    .toolbar {
      flex-direction: column;
      align-items: stretch;
    }

    .toolbar-right {
      margin-left: 0;
      flex-direction: column;
    }

    .search-box input {
      width: 100%;
    }

    .stat-chips {
      grid-template-columns: 1fr 1fr;
    }

    .detail-grid {
      grid-template-columns: 1fr;
    }

    .date-row {
      grid-template-columns: 1fr;
    }

    .dl-format-row {
      flex-direction: column;
    }

    .logs-header {
      flex-direction: column;
    }

    .pagination-row {
      flex-direction: column;
      align-items: flex-start;
    }

    .tab-group {
      overflow-x: auto;
      width: 100%;
    }
  }

  @media (max-width: 480px) {
    .stat-chips {
      flex-direction: column;
    }

    .pag-btn {
      width: 28px;
      height: 28px;
      font-size: 12px;
    }
  }
</style>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<!-- Detail Modal -->
<div class="modal-overlay" id="detailModal" onclick="closeModal('detailModal', event)">
  <div class="modal modal-detail">
    <div class="modal-header">
      <h3 id="detailModalTitle">Log Entry Details</h3>
      <button class="modal-close" onclick="closeModalDirect('detailModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="detail-grid" id="detailGrid"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModalDirect('detailModal')">Close</button>
    </div>
  </div>
</div>

<!-- Download Modal -->
<div class="modal-overlay" id="downloadModal" onclick="closeModal('downloadModal', event)">
  <div class="modal modal-download">
    <div class="modal-header">
      <h3>Download Logs</h3>
      <button class="modal-close" onclick="closeModalDirect('downloadModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="modal-body">
      <p style="font-size:13px;color:var(--text-muted);margin-bottom:16px;">Select a format and date range to export the audit logs.</p>

      <div class="dl-format-row">
        <button class="dl-format-btn selected" id="fmtPDF" onclick="selectFormat('PDF')">
          <svg viewBox="0 0 24 24" fill="none">
            <rect x="3" y="2" width="18" height="20" rx="2" fill="#FFE4E6" stroke="#BE123C" stroke-width="1.5" />
            <path d="M7 12h3a1.5 1.5 0 000-3H7v6" stroke="#BE123C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M13 9h2a2 2 0 010 4h-2V9z" stroke="#BE123C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M17 15h-1.5M17 9h0" stroke="#BE123C" stroke-width="1.5" stroke-linecap="round" />
            <text x="5" y="20" font-size="4" fill="#BE123C" font-weight="bold" font-family="Arial">PDF</text>
          </svg>
          <span class="dl-format-label">PDF</span>
          <span class="dl-format-sub">Formatted report</span>
        </button>
        <button class="dl-format-btn" id="fmtExcel" onclick="selectFormat('Excel')">
          <svg viewBox="0 0 24 24" fill="none">
            <rect x="3" y="2" width="18" height="20" rx="2" fill="#DCFCE7" stroke="#15803D" stroke-width="1.5" />
            <path d="M7 9l2.5 3L7 15M11 9h4M11 12h3M11 15h4" stroke="#15803D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <text x="5" y="20" font-size="3.5" fill="#15803D" font-weight="bold" font-family="Arial">XLSX</text>
          </svg>
          <span class="dl-format-label">Excel</span>
          <span class="dl-format-sub">Spreadsheet (.xlsx)</span>
        </button>
      </div>

      <div class="date-row">
        <div class="form-group">
          <label class="form-label">Date From</label>
          <input type="date" class="form-input" id="dateFrom">
        </div>
        <div class="form-group">
          <label class="form-label">Date To</label>
          <input type="date" class="form-input" id="dateTo">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Log Type</label>
        <select class="form-input" id="dlLogType">
          <option value="all">All Logs</option>
          <option value="user">User Activity</option>
          <option value="system">System</option>
          <option value="error">Error</option>
        </select>
      </div>

      <div class="form-group">
        <label class="form-label">Status Filter</label>
        <select class="form-input" id="dlStatus">
          <option value="all">All Statuses</option>
          <option value="success">Success</option>
          <option value="warning">Warning</option>
          <option value="error">Error</option>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModalDirect('downloadModal')">Cancel</button>
      <button class="btn btn-red" onclick="triggerDownload()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Download
      </button>
    </div>
  </div>
</div>

<!-- PAGE CONTENT -->
<div class="logs-header">
  <div class="logs-header-left">
    <h2>Audit Logs</h2>
    <p>Track all user activity, system events, and error records.</p>
  </div>
  <button class="btn btn-red" onclick="openDownloadModal()">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
    </svg>
    Download Logs
  </button>
</div>

<!-- Stat chips -->
<div class="stat-chips">
  <div class="stat-chip">
    <div class="stat-chip-icon" style="background:var(--red-light)">
      <svg fill="none" stroke="var(--red)" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
    </div>
    <div>
      <div class="stat-chip-val" id="countUser">—</div>
      <div class="stat-chip-lbl">User Events</div>
    </div>
  </div>
  <div class="stat-chip">
    <div class="stat-chip-icon" style="background:#EFF6FF">
      <svg fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" />
      </svg>
    </div>
    <div>
      <div class="stat-chip-val" id="countSystem">—</div>
      <div class="stat-chip-lbl">System Events</div>
    </div>
  </div>
  <div class="stat-chip">
    <div class="stat-chip-icon" style="background:#FFE4E6">
      <svg fill="none" stroke="#BE123C" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <div>
      <div class="stat-chip-val" id="countError">—</div>
      <div class="stat-chip-lbl">Errors</div>
    </div>
  </div>
  <div class="stat-chip">
    <div class="stat-chip-icon" style="background:#DCFCE7">
      <svg fill="none" stroke="#16a34a" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <div>
      <div class="stat-chip-val" id="countSuccess">—</div>
      <div class="stat-chip-lbl">Successful</div>
    </div>
  </div>
</div>

<!-- Logs card -->
<div class="logs-card">
  <!-- Toolbar -->
  <div class="toolbar">
    <div class="tab-group">
      <button class="tab-btn active" data-type="all" onclick="switchTab(this)">
        All <span class="tab-count" id="tcAll">0</span>
      </button>
      <button class="tab-btn" data-type="user" onclick="switchTab(this)">
        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        User Activity <span class="tab-count" id="tcUser">0</span>
      </button>
      <button class="tab-btn" data-type="system" onclick="switchTab(this)">
        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" />
        </svg>
        System <span class="tab-count" id="tcSystem">0</span>
      </button>
      <button class="tab-btn" data-type="error" onclick="switchTab(this)">
        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Errors <span class="tab-count" id="tcError">0</span>
      </button>
    </div>

    <div class="toolbar-right">
      <div class="search-box">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input type="text" id="searchInput" placeholder="Search logs…" oninput="applyFilters()">
      </div>
      <select class="filter-select" id="statusFilter" onchange="applyFilters()">
        <option value="">All Statuses</option>
        <option value="success">Success</option>
        <option value="warning">Warning</option>
        <option value="error">Error</option>
        <option value="info">Info</option>
      </select>
      <button class="btn btn-outline" onclick="clearFilters()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        Reset
      </button>
    </div>
  </div>

  <!-- Table -->
  <div class="table-wrap">
    <table id="logsTable">
      <thead>
        <tr>
          <th onclick="sortTable('date')">Date <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4" />
            </svg></th>
          <th onclick="sortTable('time')">Time</th>
          <th onclick="sortTable('user')">User</th>
          <th onclick="sortTable('type')">Type</th>
          <th onclick="sortTable('activity')">Activity</th>
          <th onclick="sortTable('ip')">IP Address</th>
          <th onclick="sortTable('status')">Status</th>
        </tr>
      </thead>
      <tbody id="logsBody"></tbody>
    </table>
    <div class="empty-state" id="emptyState">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
      </svg>
      <p>No log entries found.</p>
    </div>
  </div>

  <!-- Pagination -->
  <div class="pagination-row">
    <span id="paginationInfo" style="font-size:13px;color:var(--text-muted)"></span>
    <div class="pag-btns" id="paginationBtns"></div>
  </div>
</div>

<script>
  // ── DATA ──────────────────────────────────────────────────────────
  var allLogs = [{
      id: 1,
      date: '2024-06-01',
      time: '10:00 AM',
      user: 'John Doe',
      role: 'Admin',
      type: 'user',
      activity: 'Logged in',
      ip: '192.168.1.10',
      module: 'Authentication',
      status: 'success',
      details: 'User authenticated via password. Session ID: s_a1b2c3.',
      browser: 'Chrome 124',
      os: 'Windows 11'
    },
    {
      id: 2,
      date: '2024-06-01',
      time: '10:05 AM',
      user: 'Jane Smith',
      role: 'Staff',
      type: 'user',
      activity: 'Updated profile',
      ip: '192.168.1.22',
      module: 'User Management',
      status: 'success',
      details: 'Changed display name and contact email.',
      browser: 'Firefox 126',
      os: 'macOS Sonoma'
    },
    {
      id: 3,
      date: '2024-06-01',
      time: '10:12 AM',
      user: 'System',
      role: '—',
      type: 'system',
      activity: 'Backup completed',
      ip: '127.0.0.1',
      module: 'Backup Service',
      status: 'success',
      details: 'Daily automated database backup finished. File: backup_20240601.sql.gz (42 MB).',
      browser: '—',
      os: 'Ubuntu 22.04'
    },
    {
      id: 4,
      date: '2024-06-01',
      time: '10:18 AM',
      user: 'Pedro Lim',
      role: 'Staff',
      type: 'user',
      activity: 'Failed login attempt',
      ip: '203.177.44.21',
      module: 'Authentication',
      status: 'error',
      details: 'Invalid credentials. Attempt 3 of 5. Account not yet locked.',
      browser: 'Safari 17',
      os: 'iOS 17'
    },
    {
      id: 5,
      date: '2024-06-01',
      time: '10:25 AM',
      user: 'System',
      role: '—',
      type: 'error',
      activity: 'Database timeout',
      ip: '127.0.0.1',
      module: 'Database',
      status: 'error',
      details: 'Query exceeded 30s timeout threshold on table residents_data. Query hash: 4f9e2a.',
      browser: '—',
      os: 'Ubuntu 22.04'
    },
    {
      id: 6,
      date: '2024-06-01',
      time: '10:31 AM',
      user: 'Maria Santos',
      role: 'Staff',
      type: 'user',
      activity: 'Uploaded document',
      ip: '192.168.1.15',
      module: 'File Management',
      status: 'success',
      details: 'Uploaded "land_title_2024.pdf" (2.4 MB) to /uploads/residents/santos/.',
      browser: 'Edge 124',
      os: 'Windows 10'
    },
    {
      id: 7,
      date: '2024-06-01',
      time: '10:44 AM',
      user: 'Ana Reyes',
      role: 'Staff',
      type: 'user',
      activity: 'Created new resident record',
      ip: '192.168.1.18',
      module: 'Residents',
      status: 'success',
      details: 'New resident record #1284 created for Barangay Tres.',
      browser: 'Chrome 124',
      os: 'Windows 11'
    },
    {
      id: 8,
      date: '2024-06-01',
      time: '11:02 AM',
      user: 'System',
      role: '—',
      type: 'system',
      activity: 'Email notification sent',
      ip: '127.0.0.1',
      module: 'Notification Service',
      status: 'info',
      details: 'Batch email sent to 12 residents regarding document submission deadline.',
      browser: '—',
      os: 'Ubuntu 22.04'
    },
    {
      id: 9,
      date: '2024-06-02',
      time: '08:15 AM',
      user: 'John Doe',
      role: 'Admin',
      type: 'user',
      activity: 'Deleted user account',
      ip: '192.168.1.10',
      module: 'User Management',
      status: 'warning',
      details: 'User account "temp_user_04" deleted. Reason: inactive for 90 days.',
      browser: 'Chrome 124',
      os: 'Windows 11'
    },
    {
      id: 10,
      date: '2024-06-02',
      time: '08:30 AM',
      user: 'System',
      role: '—',
      type: 'system',
      activity: 'Scheduled maintenance started',
      ip: '127.0.0.1',
      module: 'System',
      status: 'info',
      details: 'Weekly maintenance window started. Expected duration: 30 minutes.',
      browser: '—',
      os: 'Ubuntu 22.04'
    },
    {
      id: 11,
      date: '2024-06-02',
      time: '09:00 AM',
      user: 'System',
      role: '—',
      type: 'system',
      activity: 'Scheduled maintenance ended',
      ip: '127.0.0.1',
      module: 'System',
      status: 'success',
      details: 'Maintenance completed successfully. All services online.',
      browser: '—',
      os: 'Ubuntu 22.04'
    },
    {
      id: 12,
      date: '2024-06-02',
      time: '09:12 AM',
      user: 'Rosa Garcia',
      role: 'Staff',
      type: 'user',
      activity: 'Exported resident list',
      ip: '192.168.1.30',
      module: 'Reports',
      status: 'success',
      details: 'Exported 342 resident records to residents_export_20240602.xlsx.',
      browser: 'Chrome 124',
      os: 'macOS Sonoma'
    },
    {
      id: 13,
      date: '2024-06-02',
      time: '09:45 AM',
      user: 'Pedro Lim',
      role: 'Staff',
      type: 'error',
      activity: 'Access denied',
      ip: '192.168.1.22',
      module: 'Administration',
      status: 'error',
      details: 'Attempted to access admin-only panel without sufficient privileges.',
      browser: 'Safari 17',
      os: 'iOS 17'
    },
    {
      id: 14,
      date: '2024-06-02',
      time: '10:00 AM',
      user: 'Jane Smith',
      role: 'Staff',
      type: 'user',
      activity: 'Approved resident application',
      ip: '192.168.1.22',
      module: 'Residents',
      status: 'success',
      details: 'Application #1280 approved. Notification sent to applicant.',
      browser: 'Firefox 126',
      os: 'macOS Sonoma'
    },
    {
      id: 15,
      date: '2024-06-03',
      time: '07:58 AM',
      user: 'System',
      role: '—',
      type: 'system',
      activity: 'SSL certificate renewed',
      ip: '127.0.0.1',
      module: 'Security',
      status: 'success',
      details: 'SSL certificate auto-renewed. Valid for next 365 days.',
      browser: '—',
      os: 'Ubuntu 22.04'
    },
    {
      id: 16,
      date: '2024-06-03',
      time: '08:30 AM',
      user: 'John Doe',
      role: 'Admin',
      type: 'user',
      activity: 'Changed system settings',
      ip: '192.168.1.10',
      module: 'Settings',
      status: 'warning',
      details: 'Modified max upload file size from 5MB to 10MB.',
      browser: 'Chrome 124',
      os: 'Windows 11'
    },
    {
      id: 17,
      date: '2024-06-03',
      time: '09:10 AM',
      user: 'Maria Santos',
      role: 'Staff',
      type: 'user',
      activity: 'Flagged squatting report',
      ip: '192.168.1.15',
      module: 'Anti-Squatting',
      status: 'warning',
      details: 'Report #57 flagged for investigation. Location: Brgy. Uno, Lot 12-B.',
      browser: 'Edge 124',
      os: 'Windows 10'
    },
    {
      id: 18,
      date: '2024-06-03',
      time: '09:55 AM',
      user: 'Ana Reyes',
      role: 'Staff',
      type: 'user',
      activity: 'Sent message to resident',
      ip: '192.168.1.18',
      module: 'Messages',
      status: 'success',
      details: 'Message sent to resident ID #1284 regarding document requirements.',
      browser: 'Chrome 124',
      os: 'Windows 11'
    },
  ];

  var filteredLogs = allLogs.slice();
  var currentTab = 'all';
  var currentSort = {
    col: 'date',
    dir: 'desc'
  };
  var currentPage = 1;
  var perPage = 10;
  var selectedFormat = 'PDF';

  // ── INIT ──────────────────────────────────────────────────────────
  document.addEventListener('DOMContentLoaded', function() {
    var today = new Date().toISOString().split('T')[0];
    var monthAgo = new Date(Date.now() - 30 * 24 * 60 * 60 * 1000).toISOString().split('T')[0];
    document.getElementById('dateFrom').value = monthAgo;
    document.getElementById('dateTo').value = today;
    updateCounts();
    applyFilters();
  });

  function updateCounts() {
    var user = allLogs.filter(function(l) {
      return l.type === 'user';
    }).length;
    var system = allLogs.filter(function(l) {
      return l.type === 'system';
    }).length;
    var error = allLogs.filter(function(l) {
      return l.type === 'error';
    }).length;
    var success = allLogs.filter(function(l) {
      return l.status === 'success';
    }).length;
    document.getElementById('countUser').textContent = user;
    document.getElementById('countSystem').textContent = system;
    document.getElementById('countError').textContent = error;
    document.getElementById('countSuccess').textContent = success;
    document.getElementById('tcAll').textContent = allLogs.length;
    document.getElementById('tcUser').textContent = user;
    document.getElementById('tcSystem').textContent = system;
    document.getElementById('tcError').textContent = error;
  }

  // ── TABS ──────────────────────────────────────────────────────────
  function switchTab(btn) {
    document.querySelectorAll('.tab-btn').forEach(function(b) {
      b.classList.remove('active');
    });
    btn.classList.add('active');
    currentTab = btn.getAttribute('data-type');
    currentPage = 1;
    applyFilters();
  }

  // ── FILTER / SEARCH ───────────────────────────────────────────────
  function applyFilters() {
    var q = document.getElementById('searchInput').value.toLowerCase();
    var st = document.getElementById('statusFilter').value;
    filteredLogs = allLogs.filter(function(l) {
      var matchTab = currentTab === 'all' || l.type === currentTab;
      var matchStatus = !st || l.status === st;
      var matchQ = !q || [l.user, l.activity, l.ip, l.module, l.details].some(function(v) {
        return v.toLowerCase().indexOf(q) !== -1;
      });
      return matchTab && matchStatus && matchQ;
    });
    sortLogs();
    currentPage = 1;
    renderTable();
  }

  function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    currentTab = 'all';
    document.querySelectorAll('.tab-btn').forEach(function(b) {
      b.classList.remove('active');
    });
    document.querySelector('[data-type="all"]').classList.add('active');
    applyFilters();
    showToast('Filters cleared.', 'info');
  }

  // ── SORT ──────────────────────────────────────────────────────────
  function sortTable(col) {
    if (currentSort.col === col) {
      currentSort.dir = currentSort.dir === 'asc' ? 'desc' : 'asc';
    } else {
      currentSort.col = col;
      currentSort.dir = 'asc';
    }
    sortLogs();
    renderTable();
  }

  function sortLogs() {
    var col = currentSort.col,
      dir = currentSort.dir;
    filteredLogs.sort(function(a, b) {
      var av = a[col] || '',
        bv = b[col] || '';
      return dir === 'asc' ? av.localeCompare(bv) : bv.localeCompare(av);
    });
  }

  // ── RENDER ────────────────────────────────────────────────────────
  function renderTable() {
    var tbody = document.getElementById('logsBody');
    var empty = document.getElementById('emptyState');
    var start = (currentPage - 1) * perPage;
    var page = filteredLogs.slice(start, start + perPage);

    if (filteredLogs.length === 0) {
      tbody.innerHTML = '';
      empty.style.display = 'block';
      document.getElementById('paginationInfo').textContent = '';
      document.getElementById('paginationBtns').innerHTML = '';
      return;
    }
    empty.style.display = 'none';

    var html = '';
    page.forEach(function(l) {
      var initials = l.user.split(' ').map(function(w) {
        return w[0];
      }).join('').substring(0, 2).toUpperCase();
      var avatarColor = l.type === 'system' ? '#3B82F6' : (l.type === 'error' ? '#BE123C' : 'var(--red)');
      var pillCls = {
        success: 'pill-success',
        warning: 'pill-warning',
        error: 'pill-error',
        info: 'pill-info'
      } [l.status] || 'pill-info';
      var typeCls = {
        user: 'type-user',
        system: 'type-system',
        error: 'type-error'
      } [l.type] || 'type-user';
      var typeTxt = {
        user: 'User',
        system: 'System',
        error: 'Error'
      } [l.type] || l.type;
      html += '<tr onclick="openDetail(' + l.id + ')" title="Click to view details">' +
        '<td>' + l.date + '</td>' +
        '<td>' + l.time + '</td>' +
        '<td class="name"><div class="user-cell"><div class="avatar" style="background:' + avatarColor + '">' + initials + '</div>' + l.user + '</div></td>' +
        '<td><span class="type-badge ' + typeCls + '">' + typeTxt + '</span></td>' +
        '<td>' + l.activity + '</td>' +
        '<td style="font-family:monospace;font-size:12px">' + l.ip + '</td>' +
        '<td><span class="pill ' + pillCls + '">' + capitalize(l.status) + '</span></td>' +
        '</tr>';
    });
    tbody.innerHTML = html;
    renderPagination();
  }

  function renderPagination() {
    var total = filteredLogs.length;
    var pages = Math.ceil(total / perPage);
    var start = (currentPage - 1) * perPage + 1;
    var end = Math.min(currentPage * perPage, total);
    document.getElementById('paginationInfo').textContent = 'Showing ' + start + '–' + end + ' of ' + total + ' entries';

    var html = '';
    html += '<button class="pag-btn" onclick="changePage(' + (currentPage - 1) + ')" ' + (currentPage === 1 ? 'disabled' : '') + '>&#8592;</button>';
    for (var i = 1; i <= pages; i++) {
      if (i === 1 || i === pages || Math.abs(i - currentPage) <= 1) {
        html += '<button class="pag-btn' + (i === currentPage ? ' active' : '') + '" onclick="changePage(' + i + ')">' + i + '</button>';
      } else if (Math.abs(i - currentPage) === 2) {
        html += '<span style="padding:0 4px;color:var(--text-muted);line-height:32px">…</span>';
      }
    }
    html += '<button class="pag-btn" onclick="changePage(' + (currentPage + 1) + ')" ' + (currentPage === pages || pages === 0 ? 'disabled' : '') + '>&#8594;</button>';
    document.getElementById('paginationBtns').innerHTML = html;
  }

  function changePage(p) {
    var pages = Math.ceil(filteredLogs.length / perPage);
    if (p < 1 || p > pages) return;
    currentPage = p;
    renderTable();
  }

  // ── DETAIL MODAL ──────────────────────────────────────────────────
  function openDetail(id) {
    var l = allLogs.find(function(x) {
      return x.id === id;
    });
    if (!l) return;
    var pillCls = {
      success: 'pill-success',
      warning: 'pill-warning',
      error: 'pill-error',
      info: 'pill-info'
    } [l.status] || 'pill-info';
    document.getElementById('detailModalTitle').textContent = 'Log #' + l.id + ' — ' + l.activity;
    document.getElementById('detailGrid').innerHTML =
      field('Date & Time', l.date + ' at ' + l.time) +
      field('User', l.user) +
      field('Role', l.role) +
      field('IP Address', l.ip) +
      field('Module', l.module) +
      field('Browser', l.browser) +
      field('Operating System', l.os) +
      field('Status', '<span class="pill ' + pillCls + '">' + capitalize(l.status) + '</span>') +
      '<div class="detail-field full">' +
      '<span class="detail-label">Details</span>' +
      '<div class="detail-value mono">' + l.details + '</div>' +
      '</div>';
    document.getElementById('detailModal').classList.add('show');
  }

  function field(label, val) {
    return '<div class="detail-field"><span class="detail-label">' + label + '</span><span class="detail-value">' + val + '</span></div>';
  }

  // ── DOWNLOAD MODAL ────────────────────────────────────────────────
  function openDownloadModal() {
    document.getElementById('downloadModal').classList.add('show');
  }

  function selectFormat(fmt) {
    selectedFormat = fmt;
    document.getElementById('fmtPDF').classList.toggle('selected', fmt === 'PDF');
    document.getElementById('fmtExcel').classList.toggle('selected', fmt === 'Excel');
  }

  function triggerDownload() {
    var from = document.getElementById('dateFrom').value;
    var to = document.getElementById('dateTo').value;
    if (!from || !to) {
      showToast('Please select a date range.', 'error');
      return;
    }
    if (from > to) {
      showToast('Start date must be before end date.', 'error');
      return;
    }
    closeModalDirect('downloadModal');
    showToast('Preparing ' + selectedFormat + ' download for ' + from + ' to ' + to + '…', 'info');
    setTimeout(function() {
      showToast(selectedFormat + ' export ready! Download started.', 'success');
      // In production: window.location.href = '/admin/logs/export?format='+selectedFormat+'&from='+from+'&to='+to;
    }, 1800);
  }

  // ── MODALS ────────────────────────────────────────────────────────
  function closeModal(id, event) {
    if (event.target.id === id) closeModalDirect(id);
  }

  function closeModalDirect(id) {
    document.getElementById(id).classList.remove('show');
  }
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-overlay.show').forEach(function(m) {
        m.classList.remove('show');
      });
    }
  });

  // ── TOAST ─────────────────────────────────────────────────────────
  function showToast(msg, type) {
    type = type || 'info';
    var icons = {
      success: '<svg fill="none" stroke="#16a34a" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
      error: '<svg fill="none" stroke="#BE123C" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
      info: '<svg fill="none" stroke="#3B82F6" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
      warning: '<svg fill="none" stroke="#A16207" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>'
    };
    var t = document.createElement('div');
    t.className = 'toast toast-' + type;
    t.innerHTML = icons[type] + '<span class="toast-msg">' + msg + '</span><button class="toast-dismiss" onclick="this.parentElement.remove()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>';
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(function() {
      if (t.parentElement) t.remove();
    }, 4000);
  }

  function capitalize(s) {
    return s.charAt(0).toUpperCase() + s.slice(1);
  }
</script>

@endsection