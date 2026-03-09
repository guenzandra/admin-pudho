@extends('admin.layout')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  :root {
    --border:     #e2e5ea;
    --surface:    #f4f5f7;
    --accent:     #e8472a;
    --text:       #1a1d23;
    --muted:      #7a8094;
    --sub:        #4a5068;
    --green:      #16a34a;
    --red:        #dc2626;
    --blue:       #2563eb;
    --amber:      #d97706;
    --purple:     #7c3aed;
    --bg:         #f7f8fa;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  .iv-wrap {
    font-family: Arial, Helvetica, sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    position: relative;
  }

  /* ── Page Loader ── */
  .iv-loader {
    position: absolute; inset: 0; background: rgba(247,248,250,0.9);
    z-index: 50; display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 12px; transition: opacity 0.3s;
  }
  .iv-loader.hidden { opacity: 0; pointer-events: none; }
  .iv-spinner {
    width: 38px; height: 38px; border: 3px solid var(--border);
    border-top-color: var(--accent); border-radius: 50%;
    animation: spin 0.7s linear infinite;
  }
  .iv-loader p { font-size: 13px; color: var(--muted); }
  @keyframes spin { to { transform: rotate(360deg); } }

  /* ── Page Header ── */
  .iv-header {
    background: #fff; border-bottom: 1px solid var(--border);
    padding: 14px 24px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 12px; flex-wrap: wrap;
  }
  .iv-header-left { display: flex; align-items: center; gap: 12px; }
  .iv-icon-box {
    width: 36px; height: 36px; background: var(--blue);
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 15px; flex-shrink: 0;
  }
  .iv-title h1 { font-size: 15px; font-weight: 700; line-height: 1.2; }
  .iv-title span { font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; }
  .iv-header-actions { display: flex; align-items: center; gap: 8px; }

  /* ── Buttons ── */
  .btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 14px; border-radius: 7px; border: none;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px; font-weight: 700; cursor: pointer;
    transition: all 0.15s; white-space: nowrap; line-height: 1;
  }
  .btn i { font-size: 12px; }
  .btn-ghost { background: transparent; color: var(--sub); border: 1px solid var(--border); }
  .btn-ghost:hover { background: var(--surface); color: var(--text); }
  .btn-primary { background: var(--blue); color: #fff; }
  .btn-primary:hover { background: #1d4ed8; }
  .btn-accent { background: var(--accent); color: #fff; }
  .btn-accent:hover { background: #d63d22; }
  .btn-success { background: rgba(22,163,74,0.1); color: var(--green); border: 1px solid rgba(22,163,74,0.25); }
  .btn-success:hover { background: rgba(22,163,74,0.2); }
  .btn-danger { background: rgba(220,38,38,0.1); color: var(--red); border: 1px solid rgba(220,38,38,0.25); }
  .btn-danger:hover { background: rgba(220,38,38,0.2); }
  .btn-warn { background: rgba(217,119,6,0.1); color: var(--amber); border: 1px solid rgba(217,119,6,0.25); }
  .btn-warn:hover { background: rgba(217,119,6,0.2); }
  .btn-sm { padding: 5px 10px; font-size: 12px; }
  .btn-sm i { font-size: 11px; }
  .btn:disabled { opacity: 0.55; cursor: not-allowed; }
  .btn .bsp {
    width: 12px; height: 12px; border: 2px solid rgba(255,255,255,0.3);
    border-top-color: currentColor; border-radius: 50%;
    animation: spin 0.6s linear infinite; display: none; flex-shrink: 0;
  }
  .btn.loading .bsp { display: inline-block; }
  .btn.loading .bl  { display: none; }

  /* ── Stats ── */
  .iv-stats {
    display: grid; grid-template-columns: repeat(4,1fr);
    gap: 1px; background: var(--border);
    border-bottom: 1px solid var(--border);
  }
  .stat-cell {
    background: #fff; padding: 14px 20px;
    display: flex; align-items: center; gap: 12px;
  }
  .stat-ic {
    width: 34px; height: 34px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; flex-shrink: 0;
  }
  .stat-cell:nth-child(1) .stat-ic { background: rgba(37,99,235,0.1);  color: var(--blue); }
  .stat-cell:nth-child(2) .stat-ic { background: rgba(217,119,6,0.1);  color: var(--amber); }
  .stat-cell:nth-child(3) .stat-ic { background: rgba(22,163,74,0.1);  color: var(--green); }
  .stat-cell:nth-child(4) .stat-ic { background: rgba(220,38,38,0.1);  color: var(--red); }
  .stat-info p { font-size: 10px; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 2px; }
  .stat-info strong { font-size: 20px; font-weight: 700; }

  /* ── Toolbar ── */
  .iv-toolbar {
    padding: 12px 24px; display: flex; align-items: center;
    gap: 10px; border-bottom: 1px solid var(--border);
    background: #fff; flex-wrap: wrap;
  }
  .search-box { flex: 1; min-width: 180px; position: relative; }
  .search-box i {
    position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
    color: var(--muted); font-size: 12px; pointer-events: none;
  }
  .search-box input {
    width: 100%; padding: 8px 10px 8px 32px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 7px; color: var(--text);
    font-family: Arial, Helvetica, sans-serif; font-size: 13px;
    outline: none; transition: border-color 0.2s;
  }
  .search-box input:focus { border-color: var(--blue); background: #fff; }
  .search-box input::placeholder { color: var(--muted); }
  .filter-sel {
    padding: 8px 28px 8px 10px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 7px; color: var(--text);
    font-family: Arial, Helvetica, sans-serif; font-size: 13px;
    outline: none; cursor: pointer; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%237a8094' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 8px center;
    transition: border-color 0.2s;
  }
  .filter-sel:focus { border-color: var(--blue); }

  /* ── Main Layout ── */
  .iv-body { padding: 20px 24px; }

  /* ── Cards Grid ── */
  .iv-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 16px;
  }

  .iv-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; overflow: hidden;
    cursor: pointer; transition: box-shadow 0.18s, transform 0.18s;
  }
  .iv-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.08); transform: translateY(-2px); }
  .iv-card.active { border-color: var(--blue); box-shadow: 0 0 0 2px rgba(37,99,235,0.15); }

  .card-top {
    padding: 14px 16px 12px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;
  }
  .card-id { font-size: 11px; color: var(--muted); font-weight: 700; margin-bottom: 3px; }
  .card-title { font-size: 14px; font-weight: 700; line-height: 1.3; }
  .card-addr { font-size: 12px; color: var(--muted); margin-top: 2px; }

  .badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 8px; border-radius: 20px;
    font-size: 11px; font-weight: 700; white-space: nowrap; flex-shrink: 0;
  }
  .badge i { font-size: 9px; }
  .badge-active   { background: rgba(37,99,235,0.1);   color: var(--blue); }
  .badge-pending  { background: rgba(217,119,6,0.1);   color: var(--amber); }
  .badge-done     { background: rgba(22,163,74,0.1);   color: var(--green); }
  .badge-stopped  { background: rgba(220,38,38,0.1);   color: var(--red); }
  .badge-new      { background: rgba(124,58,237,0.1);  color: var(--purple); }

  .card-meta {
    padding: 10px 16px;
    display: flex; align-items: center; gap: 14px; flex-wrap: wrap;
  }
  .meta-item { display: flex; align-items: center; gap: 5px; font-size: 12px; color: var(--muted); }
  .meta-item i { font-size: 11px; }
  .meta-item strong { color: var(--text); font-weight: 600; }

  .card-assignee {
    padding: 10px 16px; border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; gap: 8px;
  }
  .assignee-info { display: flex; align-items: center; gap: 8px; }
  .av-sm {
    width: 26px; height: 26px; border-radius: 6px;
    background: var(--surface); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 700; color: var(--sub); flex-shrink: 0;
  }
  .av-sm.blue  { background: rgba(37,99,235,0.12);  color: var(--blue); }
  .av-sm.green { background: rgba(22,163,74,0.12);  color: var(--green); }
  .av-sm.amber { background: rgba(217,119,6,0.12);  color: var(--amber); }
  .assignee-name { font-size: 12px; font-weight: 600; color: var(--text); }
  .assignee-role { font-size: 11px; color: var(--muted); }

  .prog-bar-wrap { height: 4px; background: var(--surface); }
  .prog-bar { height: 4px; background: var(--blue); border-radius: 0 2px 2px 0; transition: width 0.4s; }
  .prog-bar.done   { background: var(--green); }
  .prog-bar.warn   { background: var(--amber); }

  /* ── Detail Panel ── */
  .detail-panel {
    display: none; position: fixed;
    top: 0; right: 0; bottom: 0; width: 480px;
    background: #fff; border-left: 1px solid var(--border);
    z-index: 1045; overflow-y: auto;
    box-shadow: -4px 0 24px rgba(0,0,0,0.1);
  }
  .detail-panel.open { display: block; animation: slideIn 0.24s ease; }
  @keyframes slideIn {
    from { transform: translateX(30px); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
  }

  .panel-hdr {
    padding: 16px 20px 14px; border-bottom: 1px solid var(--border);
    position: sticky; top: 0; background: #fff; z-index: 2;
    display: flex; align-items: flex-start; justify-content: space-between; gap: 10px;
  }
  .panel-hdr h3 { font-size: 14px; font-weight: 700; line-height: 1.3; }
  .panel-hdr small { font-size: 11px; color: var(--muted); margin-top: 3px; display: block; }
  .btn-icon {
    width: 29px; height: 29px; border-radius: 6px;
    background: var(--surface); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--muted); transition: all 0.15s; font-size: 12px;
    flex-shrink: 0;
  }
  .btn-icon:hover { background: var(--border); color: var(--text); }

  .panel-section { padding: 16px 20px; border-bottom: 1px solid var(--border); }
  .panel-section:last-child { border-bottom: none; }
  .panel-section h4 {
    font-size: 10px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.08em; color: var(--muted); margin-bottom: 12px;
    display: flex; align-items: center; gap: 7px;
  }
  .panel-section h4 i { font-size: 11px; }

  .info-row { display: flex; align-items: flex-start; gap: 9px; margin-bottom: 8px; }
  .info-row:last-child { margin-bottom: 0; }
  .info-row > i { flex-shrink: 0; margin-top: 2px; color: var(--muted); font-size: 12px; width: 14px; text-align: center; }
  .info-val strong { display: block; font-size: 13px; font-weight: 700; }
  .info-val span   { font-size: 11px; color: var(--muted); }

  /* ── Assignee Block ── */
  .assignee-block {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 8px; padding: 12px 14px;
    display: flex; align-items: center; justify-content: space-between; gap: 10px;
  }
  .assignee-block .av {
    width: 36px; height: 36px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; color: #fff;
    flex-shrink: 0;
  }
  .assignee-block .av.blue  { background: var(--blue); }
  .assignee-block .av.green { background: var(--green); }
  .assignee-block .av.amber { background: var(--amber); }
  .assignee-block .av.red   { background: var(--red); }
  .assignee-block .av.purple{ background: var(--purple); }
  .asgn-name { font-size: 13px; font-weight: 700; }
  .asgn-role { font-size: 11px; color: var(--muted); }
  .unassigned-block {
    background: var(--surface); border: 1.5px dashed var(--border);
    border-radius: 8px; padding: 14px;
    text-align: center; color: var(--muted); font-size: 13px;
  }
  .unassigned-block i { display: block; font-size: 20px; margin-bottom: 6px; color: var(--border); }

  /* ── Timeline ── */
  .timeline { position: relative; padding-left: 20px; }
  .timeline::before {
    content: ''; position: absolute; left: 7px; top: 6px; bottom: 6px;
    width: 1.5px; background: var(--border);
  }
  .tl-item { position: relative; margin-bottom: 16px; }
  .tl-item:last-child { margin-bottom: 0; }
  .tl-dot {
    position: absolute; left: -17px; top: 3px;
    width: 10px; height: 10px; border-radius: 50%;
    border: 2px solid #fff; flex-shrink: 0;
  }
  .tl-dot.blue   { background: var(--blue); box-shadow: 0 0 0 2px rgba(37,99,235,0.2); }
  .tl-dot.green  { background: var(--green); box-shadow: 0 0 0 2px rgba(22,163,74,0.2); }
  .tl-dot.amber  { background: var(--amber); box-shadow: 0 0 0 2px rgba(217,119,6,0.2); }
  .tl-dot.red    { background: var(--red); box-shadow: 0 0 0 2px rgba(220,38,38,0.2); }
  .tl-dot.grey   { background: var(--border); }
  .tl-time { font-size: 10px; color: var(--muted); margin-bottom: 3px; }
  .tl-text { font-size: 13px; line-height: 1.5; }
  .tl-text strong { font-weight: 700; }
  .tl-author { font-size: 11px; color: var(--muted); margin-top: 2px; }

  /* Update attachment thumbnail */
  .tl-attach {
    display: flex; align-items: center; gap: 8px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 7px; padding: 8px 10px; margin-top: 8px;
    font-size: 12px; color: var(--sub);
  }
  .tl-attach i { color: var(--muted); font-size: 14px; }

  /* ── Dispatch Form ── */
  .dispatch-form {
    background: rgba(37,99,235,0.04); border: 1px solid rgba(37,99,235,0.15);
    border-radius: 8px; padding: 14px;
  }
  .dispatch-form .field-group { margin-bottom: 10px; }
  .dispatch-form .field-group:last-child { margin-bottom: 0; }

  .field-group label {
    display: block; font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.06em;
    color: var(--muted); margin-bottom: 5px;
  }
  .field-group input,
  .field-group select,
  .field-group textarea {
    width: 100%; background: #fff; border: 1px solid var(--border);
    border-radius: 7px; color: var(--text);
    font-family: Arial, Helvetica, sans-serif; font-size: 13px;
    padding: 8px 11px; outline: none; transition: border-color 0.2s;
  }
  .field-group input:focus,
  .field-group select:focus,
  .field-group textarea:focus { border-color: var(--blue); }
  .field-group input::placeholder,
  .field-group textarea::placeholder { color: var(--muted); }
  .field-group textarea { resize: vertical; min-height: 70px; }
  .field-group select {
    appearance: none; cursor: pointer; padding-right: 28px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%237a8094' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 9px center;
    background-color: #fff;
  }
  .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

  .notify-row {
    display: flex; align-items: center; gap: 8px;
    font-size: 12px; color: var(--sub); flex-wrap: wrap; margin-top: 6px;
  }
  .notify-chip {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 9px; border-radius: 20px; font-size: 11px; font-weight: 700;
    cursor: pointer; border: 1px solid var(--border);
    background: var(--surface); color: var(--muted);
    transition: all 0.15s; user-select: none;
  }
  .notify-chip.on { background: rgba(37,99,235,0.1); border-color: rgba(37,99,235,0.3); color: var(--blue); }
  .notify-chip i { font-size: 10px; }

  /* ── Update Form (staff progress) ── */
  .update-form {
    background: rgba(22,163,74,0.04); border: 1px solid rgba(22,163,74,0.15);
    border-radius: 8px; padding: 14px;
  }
  .upload-area {
    border: 1.5px dashed var(--border); border-radius: 7px;
    padding: 14px; text-align: center; cursor: pointer;
    font-size: 12px; color: var(--muted); transition: border-color 0.2s;
  }
  .upload-area:hover { border-color: var(--blue); }
  .upload-area i { display: block; font-size: 18px; margin-bottom: 6px; }

  /* ── Admin Decision Bar ── */
  .decision-bar {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 8px; padding: 12px 14px;
    display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
  }
  .decision-bar p { font-size: 13px; color: var(--sub); flex: 1; min-width: 160px; }
  .decision-bar p strong { color: var(--text); }
  .decision-actions { display: flex; gap: 8px; flex-shrink: 0; }

  /* ── Full backdrop ── */
  .iv-backdrop {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.32); z-index: 1040;
  }
  .iv-backdrop.open { display: block; }

  /* ── Modals ── */
  .modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.28); backdrop-filter: blur(2px);
    z-index: 1060; align-items: center; justify-content: center; padding: 16px;
  }
  .modal-overlay.open { display: flex; }
  .modal {
    background: #fff; border: 1px solid var(--border);
    border-radius: 13px; width: 100%; max-height: 90vh; overflow-y: auto;
    box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    animation: mIn 0.2s ease;
  }
  .modal-sm { max-width: 440px; }
  .modal-md { max-width: 580px; }
  @keyframes mIn {
    from { opacity: 0; transform: translateY(12px) scale(0.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
  }
  .modal-hdr {
    padding: 18px 22px 14px; border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start; justify-content: space-between; gap: 10px;
  }
  .modal-hdr h2 { font-size: 15px; font-weight: 700; }
  .modal-hdr p  { font-size: 12px; color: var(--muted); margin-top: 3px; }
  .modal-body { padding: 18px 22px; }
  .modal-foot {
    padding: 14px 22px; border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: flex-end; gap: 8px;
  }

  /* Staff picker grid */
  .staff-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 14px; }
  .staff-card {
    border: 1.5px solid var(--border); border-radius: 8px; padding: 10px 12px;
    cursor: pointer; transition: all 0.15s; display: flex; align-items: center; gap: 10px;
  }
  .staff-card:hover { border-color: var(--blue); background: rgba(37,99,235,0.04); }
  .staff-card.selected { border-color: var(--blue); background: rgba(37,99,235,0.08); }
  .staff-card .av {
    width: 32px; height: 32px; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; color: #fff; flex-shrink: 0;
  }
  .staff-name { font-size: 13px; font-weight: 700; line-height: 1.2; }
  .staff-role { font-size: 11px; color: var(--muted); }
  .staff-status { font-size: 10px; font-weight: 700; }
  .staff-status.free { color: var(--green); }
  .staff-status.busy { color: var(--amber); }

  /* Warning box */
  .warn-box {
    background: rgba(220,38,38,0.05); border: 1px solid rgba(220,38,38,0.18);
    border-radius: 8px; padding: 12px 14px; margin-bottom: 14px;
    display: flex; align-items: flex-start; gap: 9px;
  }
  .warn-box i { color: var(--red); font-size: 14px; margin-top: 1px; flex-shrink: 0; }
  .warn-box p { font-size: 13px; color: #7f1d1d; line-height: 1.5; }

  /* Toast */
  .toast-wrap { position: fixed; bottom: 22px; right: 22px; z-index: 1080; display: flex; flex-direction: column; gap: 8px; }
  .toast {
    background: #fff; border: 1px solid var(--border);
    border-radius: 9px; padding: 11px 15px;
    font-size: 13px; display: flex; align-items: center; gap: 9px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1); min-width: 230px;
    animation: tIn 0.22s ease;
  }
  @keyframes tIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
  .toast-ic { width:22px; height:22px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:11px; }
  .toast.success .toast-ic { background:rgba(22,163,74,0.12); color:var(--green); }
  .toast.danger  .toast-ic { background:rgba(220,38,38,0.12);  color:var(--red); }
  .toast.info    .toast-ic { background:rgba(37,99,235,0.12);   color:var(--blue); }

  /* Responsive */
  @media (max-width: 768px) {
    .iv-stats { grid-template-columns: 1fr 1fr; }
    .iv-body, .iv-toolbar, .iv-header { padding-left: 14px; padding-right: 14px; }
    .detail-panel { width: 100%; border-left: none; border-top: 1px solid var(--border); }
    .iv-grid { grid-template-columns: 1fr; }
    .field-row { grid-template-columns: 1fr; }
    .staff-grid { grid-template-columns: 1fr; }
  }
  @media (max-width: 540px) {
    .iv-stats { grid-template-columns: 1fr 1fr; }
    .decision-bar { flex-direction: column; align-items: stretch; }
    .modal-foot { flex-direction: column-reverse; }
    .modal-foot .btn { justify-content: center; }
  }
</style>

<div class="iv-wrap">

  <!-- Loader -->
  <div class="iv-loader" id="ivLoader">
    <div class="iv-spinner"></div>
    <p>Loading investigations…</p>
  </div>

  <!-- Header -->
  <div class="iv-header">
    <div class="iv-header-left">
      <div class="iv-icon-box"><i class="fa-solid fa-magnifying-glass"></i></div>
      <div class="iv-title">
        <h1>Investigation Management</h1>
        <span>Anti-Squatting Complaint Investigations</span>
      </div>
    </div>
    <div class="iv-header-actions">
      <button class="btn btn-ghost btn-sm" onclick="exportInvestigations(this)">
        <span class="bl"><i class="fa-solid fa-file-arrow-down"></i> Export</span>
        <span class="bsp"></span>
      </button>
    </div>
  </div>

  <!-- Stats -->
  <div class="iv-stats">
    <div class="stat-cell">
      <div class="stat-ic"><i class="fa-solid fa-folder-open"></i></div>
      <div class="stat-info"><p>Total Active</p><strong id="statActive">0</strong></div>
    </div>
    <div class="stat-cell">
      <div class="stat-ic"><i class="fa-solid fa-hourglass-half"></i></div>
      <div class="stat-info"><p>Pending Assignment</p><strong id="statPending">0</strong></div>
    </div>
    <div class="stat-cell">
      <div class="stat-ic"><i class="fa-solid fa-circle-check"></i></div>
      <div class="stat-info"><p>Completed</p><strong id="statDone">0</strong></div>
    </div>
    <div class="stat-cell">
      <div class="stat-ic"><i class="fa-solid fa-ban"></i></div>
      <div class="stat-info"><p>Stopped</p><strong id="statStopped">0</strong></div>
    </div>
  </div>

  <!-- Toolbar -->
  <div class="iv-toolbar">
    <div class="search-box">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="ivSearch" placeholder="Search by case ID, location, reporter…" oninput="filterCases()">
    </div>
    <select class="filter-sel" id="ivStatus" onchange="filterCases()">
      <option value="">All Status</option>
      <option value="active">In Progress</option>
      <option value="pending">Pending Assignment</option>
      <option value="done">Completed</option>
      <option value="stopped">Stopped</option>
    </select>
    <select class="filter-sel" id="ivAssignee" onchange="filterCases()">
      <option value="">All Assignees</option>
      <option value="unassigned">Unassigned</option>
      <option value="JD">Juan Dela Cruz</option>
      <option value="MA">Maria Aguilar</option>
      <option value="RC">Roberto Cruz</option>
      <option value="LR">Lorna Reyes</option>
    </select>
  </div>

  <!-- Cards -->
  <div class="iv-body">
    <div class="iv-grid" id="ivGrid"></div>
  </div>

</div><!-- /.iv-wrap -->

<!-- Backdrop -->
<div class="iv-backdrop" id="ivBackdrop" onclick="closePanel()"></div>

<!-- ── Detail Panel ── -->
<div class="detail-panel" id="detailPanel">
  <div class="panel-hdr">
    <div>
      <h3 id="pTitle">Investigation Details</h3>
      <small id="pId">CASE-0000</small>
    </div>
    <div style="display:flex;align-items:center;gap:7px">
      <span id="pBadge" class="badge badge-active"><i class="fa-solid fa-circle-notch fa-spin"></i> In Progress</span>
      <button class="btn-icon" onclick="closePanel()"><i class="fa-solid fa-xmark"></i></button>
    </div>
  </div>

  <!-- Report Summary -->
  <div class="panel-section">
    <h4><i class="fa-solid fa-file-lines"></i> Report Summary</h4>
    <div class="info-row"><i class="fa-solid fa-user"></i>
      <div class="info-val"><strong id="pReporter">—</strong><span>Reporter</span></div>
    </div>
    <div class="info-row"><i class="fa-solid fa-location-dot"></i>
      <div class="info-val"><strong id="pLocation">—</strong><span id="pAddress"></span></div>
    </div>
    <div class="info-row"><i class="fa-regular fa-calendar"></i>
      <div class="info-val"><strong id="pDate">—</strong><span>Date Reported</span></div>
    </div>
    <div class="info-row"><i class="fa-solid fa-desktop"></i>
      <div class="info-val"><strong id="pIP" style="font-family:'Courier New',monospace;font-size:12px">—</strong><span>IP Address</span></div>
    </div>
    <div style="margin-top:10px">
      <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:5px">Complaint Details</div>
      <div id="pDetails" style="font-size:13px;color:var(--sub);line-height:1.7;background:var(--surface);border-radius:7px;padding:10px 12px;border:1px solid var(--border)">—</div>
    </div>
  </div>

  <!-- Assignment -->
  <div class="panel-section">
    <h4><i class="fa-solid fa-user-tie"></i> Assigned Investigator</h4>
    <div id="assigneeBlock">
      <div class="unassigned-block">
        <i class="fa-regular fa-user"></i>
        No investigator assigned yet
      </div>
    </div>
    <button class="btn btn-primary btn-sm" style="margin-top:10px;width:100%" onclick="openAssignModal()">
      <i class="fa-solid fa-user-plus"></i> Assign / Reassign Investigator
    </button>
  </div>

  <!-- Dispatch Task -->
  <div class="panel-section" id="dispatchSection">
    <h4><i class="fa-solid fa-paper-plane"></i> Dispatch Task to Investigator</h4>
    <div class="dispatch-form">
      <div class="field-group">
        <label>Task Instruction</label>
        <textarea id="taskInstruction" placeholder="e.g. Please visit the site and photograph the illegal structures. Interview neighbors if possible."></textarea>
      </div>
      <div class="field-row">
        <div class="field-group">
          <label>Visit Date</label>
          <input type="date" id="taskDate">
        </div>
        <div class="field-group">
          <label>Priority</label>
          <select id="taskPriority">
            <option>Normal</option>
            <option>High</option>
            <option>Urgent</option>
          </select>
        </div>
      </div>
      <div class="field-group">
        <label>Additional Notes</label>
        <input type="text" id="taskNotes" placeholder="Coordinates, landmark, contact person on site…">
      </div>
      <div class="notify-row">
        <span style="font-size:11px;color:var(--muted);font-weight:700">Notify via:</span>
        <span class="notify-chip on" id="notifyEmail" onclick="toggleChip(this)"><i class="fa-solid fa-envelope"></i> Email</span>
        <span class="notify-chip on" id="notifySMS" onclick="toggleChip(this)"><i class="fa-solid fa-mobile-screen"></i> SMS</span>
        <span class="notify-chip" id="notifyApp" onclick="toggleChip(this)"><i class="fa-solid fa-bell"></i> In-App</span>
      </div>
    </div>
    <button class="btn btn-primary" style="margin-top:10px;width:100%" onclick="dispatchTask(this)">
      <span class="bl"><i class="fa-solid fa-paper-plane"></i> Send Task to Investigator</span>
      <span class="bsp"></span>
    </button>
  </div>

  <!-- Progress Updates -->
  <div class="panel-section">
    <h4><i class="fa-solid fa-timeline"></i> Investigation Progress</h4>
    <div class="timeline" id="pTimeline">
      <div style="text-align:center;padding:16px 0;color:var(--muted);font-size:13px">
        <i class="fa-regular fa-clock" style="display:block;font-size:20px;margin-bottom:6px"></i>
        No updates yet
      </div>
    </div>
  </div>

  <!-- Submit Update (simulates staff view) -->
  <div class="panel-section">
    <h4><i class="fa-solid fa-upload"></i> Submit Progress Update <span style="font-size:10px;color:var(--muted);font-weight:400;text-transform:none;letter-spacing:0">(Staff)</span></h4>
    <div class="update-form">
      <div class="field-group" style="margin-bottom:10px">
        <label>Update / Remarks</label>
        <textarea id="updateRemark" placeholder="Describe findings, observations, or progress…"></textarea>
      </div>
      <div class="field-group" style="margin-bottom:10px">
        <label>Attach Screenshot / Document</label>
        <div class="upload-area" onclick="document.getElementById('updateFile').click()">
          <i class="fa-solid fa-cloud-arrow-up"></i>
          Click to attach photo, screenshot, or PDF
          <br><small style="font-size:11px">JPG, PNG, PDF up to 10MB</small>
        </div>
        <input type="file" id="updateFile" style="display:none" accept="image/*,.pdf" onchange="fileSelected(this)">
        <div id="filePreview" style="display:none;margin-top:6px"></div>
      </div>
      <div class="field-group">
        <label>Update Type</label>
        <select id="updateType">
          <option value="update">Progress Update</option>
          <option value="finding">Field Finding</option>
          <option value="issue">Issue / Blocker</option>
          <option value="complete">Mark as Complete</option>
        </select>
      </div>
    </div>
    <button class="btn btn-success" style="margin-top:10px;width:100%" onclick="submitUpdate(this)">
      <span class="bl"><i class="fa-solid fa-circle-check"></i> Submit Update</span>
      <span class="bsp"></span>
    </button>
  </div>

  <!-- Admin Decision -->
  <div class="panel-section">
    <h4><i class="fa-solid fa-gavel"></i> Admin Decision</h4>
    <div class="decision-bar">
      <p id="decisionMsg">Review the progress updates and decide whether to <strong>complete</strong> or <strong>stop</strong> this investigation.</p>
      <div class="decision-actions">
        <button class="btn btn-success btn-sm" onclick="adminDecide('done', this)">
          <span class="bl"><i class="fa-solid fa-circle-check"></i> Mark Complete</span>
          <span class="bsp"></span>
        </button>
        <button class="btn btn-danger btn-sm" onclick="openStopModal()">
          <i class="fa-solid fa-stop"></i> Stop Investigation
        </button>
      </div>
    </div>
  </div>

</div><!-- /.detail-panel -->

<!-- ── Assign Modal ── -->
<div class="modal-overlay" id="assignModal">
  <div class="modal modal-md">
    <div class="modal-hdr">
      <div><h2>Assign Investigator</h2><p id="assignSubtitle">Select a staff member to assign to this investigation.</p></div>
      <button class="btn-icon" onclick="closeAssignModal()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="staff-grid" id="staffGrid"></div>
      <div class="field-group">
        <label>Assignment Note (Optional)</label>
        <textarea id="assignNote" rows="2" placeholder="Any special instructions for this investigator…"></textarea>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeAssignModal()">Cancel</button>
      <button class="btn btn-primary" id="btnConfirmAssign" onclick="confirmAssign(this)">
        <span class="bl"><i class="fa-solid fa-user-check"></i> Confirm Assignment</span>
        <span class="bsp"></span>
      </button>
    </div>
  </div>
</div>

<!-- ── Stop Investigation Modal ── -->
<div class="modal-overlay" id="stopModal">
  <div class="modal modal-sm">
    <div class="modal-hdr">
      <div><h2>Stop Investigation</h2><p>This will halt the investigation and archive it.</p></div>
      <button class="btn-icon" onclick="closeStopModal()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="warn-box">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <p>Stopping an investigation is <strong>permanent</strong>. The case will be archived and the assigned investigator will be notified.</p>
      </div>
      <div class="field-group" style="margin-bottom:10px">
        <label>Reason for Stopping <span style="color:var(--red)">*</span></label>
        <select id="stopReason">
          <option value="">— Select a reason —</option>
          <option>Insufficient evidence to proceed</option>
          <option>Complainant withdrew the report</option>
          <option>Issue resolved before investigation completed</option>
          <option>Duplicate case — merged with another</option>
          <option>Outside jurisdiction</option>
          <option>other">Other (specify below)</option>
        </select>
      </div>
      <div class="field-group">
        <label>Additional Remarks</label>
        <textarea id="stopRemarks" rows="3" placeholder="Provide additional context for this decision…"></textarea>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeStopModal()">Cancel</button>
      <button class="btn btn-danger" onclick="confirmStop(this)">
        <span class="bl"><i class="fa-solid fa-stop"></i> Confirm Stop</span>
        <span class="bsp"></span>
      </button>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
/* ── Static Data ── */
const STAFF = [
  { id:'JD', name:'Juan Dela Cruz',   role:'Field Investigator', color:'blue',   status:'free', active:1 },
  { id:'MA', name:'Maria Aguilar',    role:'Senior Investigator',color:'green',  status:'busy', active:3 },
  { id:'RC', name:'Roberto Cruz',     role:'Field Investigator', color:'amber',  status:'free', active:0 },
  { id:'LR', name:'Lorna Reyes',      role:'Legal Officer',      color:'purple', status:'busy', active:2 },
  { id:'EP', name:'Eduardo Pascual',  role:'Field Investigator', color:'red',    status:'free', active:0 },
  { id:'SB', name:'Sandra Bautista',  role:'Community Liaison',  color:'blue',   status:'free', active:1 },
];

const CASES = [
  {
    id:'INV-2025-001', reportId:'RPT-2025-001',
    location:'Barangay Tondo, Manila', address:'Sta. Ana Street, Tondo, Manila',
    reporter:'Maria Santos', date:'2025-07-14', ip:'112.198.42.17',
    status:'active', assignee:'JD', priority:'High',
    details:'A group of approximately 8 individuals occupying a vacant lot without consent. Makeshift shelters erected using corrugated tin and tarpaulin.',
    progress:60,
    updates:[
      { type:'blue',  time:'Jul 14, 2025 10:00 AM', text:'Case opened and moved to investigation.', author:'Admin', attach:null },
      { type:'blue',  time:'Jul 14, 2025 11:30 AM', text:'Assigned to <strong>Juan Dela Cruz</strong>. Site visit scheduled for July 16.', author:'Admin', attach:null },
      { type:'amber', time:'Jul 16, 2025 02:15 PM', text:'Field Finding: Site visited. Confirmed 8 structures. Residents present. Photographs taken. Will return for further verification.', author:'Juan Dela Cruz', attach:{ name:'site-photos-jul16.jpg', type:'image' } },
    ]
  },
  {
    id:'INV-2025-002', reportId:'RPT-2025-002',
    location:'Pasig City', address:'Kapitolyo, Pasig City, Metro Manila',
    reporter:'Anonymous', date:'2025-07-12', ip:'180.191.77.233',
    status:'pending', assignee:null, priority:'Normal',
    details:'Three families squatting on the riverside area behind a commercial building on Brixton Street.',
    progress:10,
    updates:[
      { type:'blue', time:'Jul 12, 2025 03:00 PM', text:'Case opened and moved to investigation queue.', author:'Admin', attach:null },
    ]
  },
  {
    id:'INV-2025-003', reportId:'RPT-2025-003',
    location:'Quezon City', address:'Commonwealth Ave., QC, Metro Manila',
    reporter:'Jose Reyes', date:'2025-07-10', ip:'122.53.110.89',
    status:'active', assignee:'MA', priority:'Urgent',
    details:'Inherited property occupied by unknown persons. Complainant appeared in person with land title and photos.',
    progress:80,
    updates:[
      { type:'blue',  time:'Jul 10, 2025 12:00 PM', text:'Case opened. Office report — complainant visited in person.', author:'Admin', attach:null },
      { type:'blue',  time:'Jul 10, 2025 01:00 PM', text:'Assigned to <strong>Maria Aguilar</strong> — urgent priority due to land title dispute.', author:'Admin', attach:null },
      { type:'amber', time:'Jul 11, 2025 09:30 AM', text:'Field Finding: Visited site. Met with complainant. Structures identified. Barangay officials contacted.', author:'Maria Aguilar', attach:{ name:'qc-site-report.pdf', type:'pdf' } },
      { type:'green', time:'Jul 13, 2025 04:00 PM', text:'Progress Update: Barangay clearance obtained. Notice to vacate being drafted by legal team.', author:'Maria Aguilar', attach:null },
    ]
  },
  {
    id:'INV-2025-004', reportId:'RPT-2025-005',
    location:'Marikina City', address:'Sto. Niño, Marikina City',
    reporter:'Anonymous', date:'2025-07-07', ip:'202.90.144.55',
    status:'done', assignee:'RC', priority:'Normal',
    details:'Illegal structures along the Marikina riverbank within the 3-meter easement zone.',
    progress:100,
    updates:[
      { type:'blue',  time:'Jul 7, 2025 09:00 AM', text:'Case opened.', author:'Admin', attach:null },
      { type:'blue',  time:'Jul 7, 2025 10:00 AM', text:'Assigned to <strong>Roberto Cruz</strong>.', author:'Admin', attach:null },
      { type:'amber', time:'Jul 8, 2025 11:00 AM', text:'Site verified. MMDA already aware of structures. Coordination initiated.', author:'Roberto Cruz', attach:{ name:'mmda-coordination.pdf', type:'pdf' } },
      { type:'green', time:'Jul 9, 2025 03:00 PM', text:'Structures demolished by MMDA. Case resolved successfully.', author:'Admin', attach:null },
    ]
  },
  {
    id:'INV-2025-005', reportId:'RPT-2025-006',
    location:'Valenzuela City', address:'Ugong Norte, Valenzuela City',
    reporter:'Rodrigo Villanueva', date:'2025-07-05', ip:'112.204.88.13',
    status:'active', assignee:'LR', priority:'High',
    details:'Approximately 20 families with semi-permanent concrete structures. Long-term occupation since late 2024.',
    progress:40,
    updates:[
      { type:'blue',  time:'Jul 5, 2025 02:00 PM', text:'Case opened.', author:'Admin', attach:null },
      { type:'blue',  time:'Jul 5, 2025 03:00 PM', text:'Assigned to <strong>Lorna Reyes</strong> — legal officer for complex case.', author:'Admin', attach:null },
      { type:'amber', time:'Jul 7, 2025 10:00 AM', text:'Issue: Multiple families have been there for years. Legal review needed before any action.', author:'Lorna Reyes', attach:null },
    ]
  },
];

let currentCase = null;
let selectedStaff = null;

/* ── Helpers ── */
function badgeClass(s) {
  return { active:'badge-active', pending:'badge-pending', done:'badge-done', stopped:'badge-stopped' }[s] || 'badge-pending';
}
function badgeLabel(s) {
  return { active:'In Progress', pending:'Pending Assignment', done:'Completed', stopped:'Stopped' }[s] || s;
}
function badgeIcon(s) {
  return { active:'fa-circle-notch fa-spin', pending:'fa-hourglass-half', done:'fa-circle-check', stopped:'fa-stop' }[s] || 'fa-circle';
}
function priorityColor(p) {
  return { Urgent:'color:var(--red)', High:'color:var(--amber)', Normal:'color:var(--muted)' }[p] || '';
}
function staffById(id) { return STAFF.find(s => s.id === id); }

/* ── Stats ── */
function updateStats() {
  document.getElementById('statActive').textContent  = CASES.filter(c => c.status === 'active').length;
  document.getElementById('statPending').textContent = CASES.filter(c => c.status === 'pending').length;
  document.getElementById('statDone').textContent    = CASES.filter(c => c.status === 'done').length;
  document.getElementById('statStopped').textContent = CASES.filter(c => c.status === 'stopped').length;
}

/* ── Render Cards ── */
function renderCards(data) {
  const grid = document.getElementById('ivGrid');
  if (!data.length) {
    grid.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)"><i class="fa-solid fa-inbox" style="font-size:28px;display:block;margin-bottom:10px"></i>No investigations found</div>`;
    return;
  }
  grid.innerHTML = data.map(c => {
    const staff = staffById(c.assignee);
    const prog  = c.progress || 0;
    const pgClass = prog >= 100 ? 'done' : prog >= 60 ? '' : 'warn';
    return `
    <div class="iv-card ${currentCase && currentCase.id === c.id ? 'active' : ''}" onclick="openPanel('${c.id}')">
      <div class="prog-bar-wrap"><div class="prog-bar ${pgClass}" style="width:${prog}%"></div></div>
      <div class="card-top">
        <div>
          <div class="card-id">${c.id} &nbsp;·&nbsp; ${c.reportId}</div>
          <div class="card-title">${c.location}</div>
          <div class="card-addr">${c.address}</div>
        </div>
        <span class="badge ${badgeClass(c.status)}">
          <i class="fa-solid ${badgeIcon(c.status)}"></i> ${badgeLabel(c.status)}
        </span>
      </div>
      <div class="card-meta">
        <div class="meta-item"><i class="fa-solid fa-user"></i> <strong>${c.reporter}</strong></div>
        <div class="meta-item"><i class="fa-regular fa-calendar"></i> ${c.date}</div>
        <div class="meta-item"><i class="fa-solid fa-flag" style="${priorityColor(c.priority)}"></i> <strong style="${priorityColor(c.priority)}">${c.priority}</strong></div>
        <div class="meta-item"><i class="fa-solid fa-chart-simple"></i> ${prog}%</div>
      </div>
      <div class="card-assignee">
        ${staff ? `
        <div class="assignee-info">
          <div class="av-sm ${staff.color}">${staff.id}</div>
          <div>
            <div class="assignee-name">${staff.name}</div>
            <div class="assignee-role">${staff.role}</div>
          </div>
        </div>` : `
        <div class="assignee-info">
          <div class="av-sm"><i class="fa-regular fa-user" style="font-size:10px"></i></div>
          <div><div class="assignee-name" style="color:var(--muted)">Unassigned</div></div>
        </div>`}
        <div class="meta-item"><i class="fa-solid fa-message"></i> ${c.updates.length} update${c.updates.length !== 1 ? 's' : ''}</div>
      </div>
    </div>`;
  }).join('');
}

function filterCases() {
  const q  = document.getElementById('ivSearch').value.toLowerCase();
  const st = document.getElementById('ivStatus').value;
  const as = document.getElementById('ivAssignee').value;
  renderCards(CASES.filter(c => {
    const mQ  = !q  || c.location.toLowerCase().includes(q) || c.id.toLowerCase().includes(q) || c.reporter.toLowerCase().includes(q);
    const mSt = !st || c.status === st;
    const mAs = !as || (as === 'unassigned' ? !c.assignee : c.assignee === as);
    return mQ && mSt && mAs;
  }));
}

/* ── Panel ── */
function openPanel(id) {
  const c = CASES.find(x => x.id === id);
  if (!c) return;
  currentCase = c;

  document.getElementById('pTitle').textContent   = c.location + ' Investigation';
  document.getElementById('pId').textContent       = `${c.id} · ${c.reportId}`;
  const badge = document.getElementById('pBadge');
  badge.className = `badge ${badgeClass(c.status)}`;
  badge.innerHTML = `<i class="fa-solid ${badgeIcon(c.status)}"></i> ${badgeLabel(c.status)}`;

  document.getElementById('pReporter').textContent = c.reporter;
  document.getElementById('pLocation').textContent = c.location;
  document.getElementById('pAddress').textContent  = c.address;
  document.getElementById('pDate').textContent     = c.date;
  document.getElementById('pIP').textContent       = c.ip;
  document.getElementById('pDetails').textContent  = c.details;

  // Assignee block
  const staff = staffById(c.assignee);
  document.getElementById('assigneeBlock').innerHTML = staff ? `
    <div class="assignee-block">
      <div style="display:flex;align-items:center;gap:10px">
        <div class="av ${staff.color}">${staff.id}</div>
        <div>
          <div class="asgn-name">${staff.name}</div>
          <div class="asgn-role">${staff.role}</div>
        </div>
      </div>
      <span class="badge ${staff.status === 'free' ? 'badge-done' : 'badge-pending'}">
        <i class="fa-solid ${staff.status === 'free' ? 'fa-circle-check' : 'fa-hourglass-half'}"></i>
        ${staff.status === 'free' ? 'Available' : 'Busy'}
      </span>
    </div>` : `
    <div class="unassigned-block">
      <i class="fa-regular fa-user"></i>No investigator assigned yet
    </div>`;

  // Timeline
  renderTimeline(c.updates);

  // Decision message
  if (c.status === 'done') {
    document.getElementById('decisionMsg').innerHTML = '<strong>Investigation completed.</strong> This case is archived.';
  } else if (c.status === 'stopped') {
    document.getElementById('decisionMsg').innerHTML = '<strong>Investigation stopped.</strong> This case has been halted.';
  } else {
    document.getElementById('decisionMsg').innerHTML = 'Review progress updates and decide whether to <strong>complete</strong> or <strong>stop</strong> this investigation.';
  }

  document.getElementById('detailPanel').classList.add('open');
  document.getElementById('ivBackdrop').classList.add('open');
  filterCases(); // refresh card active state
}

function closePanel() {
  document.getElementById('detailPanel').classList.remove('open');
  document.getElementById('ivBackdrop').classList.remove('open');
  currentCase = null;
  filterCases();
}

function renderTimeline(updates) {
  const tl = document.getElementById('pTimeline');
  if (!updates.length) {
    tl.innerHTML = `<div style="text-align:center;padding:16px 0;color:var(--muted);font-size:13px"><i class="fa-regular fa-clock" style="display:block;font-size:20px;margin-bottom:6px"></i>No updates yet</div>`;
    return;
  }
  tl.innerHTML = [...updates].reverse().map(u => `
    <div class="tl-item">
      <div class="tl-dot ${u.type}"></div>
      <div class="tl-time">${u.time}</div>
      <div class="tl-text">${u.text}</div>
      <div class="tl-author"><i class="fa-solid fa-user" style="font-size:9px;margin-right:3px"></i>${u.author}</div>
      ${u.attach ? `
      <div class="tl-attach">
        <i class="fa-solid ${u.attach.type === 'pdf' ? 'fa-file-pdf' : 'fa-image'}"></i>
        ${u.attach.name}
        <span style="margin-left:auto;font-size:11px;color:var(--blue);cursor:pointer">View</span>
      </div>` : ''}
    </div>`).join('');
}

/* ── Assign Modal ── */
function openAssignModal() {
  selectedStaff = null;
  document.getElementById('assignNote').value = '';
  document.getElementById('assignSubtitle').textContent = currentCase
    ? `Case: ${currentCase.id} — ${currentCase.location}`
    : 'Select a staff member.';
  renderStaffGrid();
  document.getElementById('assignModal').classList.add('open');
}
function closeAssignModal() { document.getElementById('assignModal').classList.remove('open'); }

function renderStaffGrid() {
  document.getElementById('staffGrid').innerHTML = STAFF.map(s => `
    <div class="staff-card ${selectedStaff === s.id ? 'selected' : ''}" onclick="selectStaff('${s.id}', this)">
      <div class="av ${s.color}">${s.id}</div>
      <div>
        <div class="staff-name">${s.name}</div>
        <div class="staff-role">${s.role}</div>
        <div class="staff-status ${s.status}">${s.status === 'free' ? 'Available' : `Busy · ${s.active} active`}</div>
      </div>
    </div>`).join('');
}

function selectStaff(id, el) {
  selectedStaff = id;
  document.querySelectorAll('.staff-card').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
}

function confirmAssign(btn) {
  if (!selectedStaff) { showToast('danger', '<i class="fa-solid fa-triangle-exclamation"></i> Please select a staff member first.'); return; }
  setLoading(btn, true);
  setTimeout(() => {
    setLoading(btn, false);
    if (currentCase) {
      const oldAssignee = currentCase.assignee;
      currentCase.assignee = selectedStaff;
      currentCase.status   = 'active';
      const staff = staffById(selectedStaff);
      const now   = new Date().toLocaleString('en-US', { month:'short', day:'numeric', year:'numeric', hour:'numeric', minute:'2-digit' });
      currentCase.updates.push({
        type: 'blue',
        time: now,
        text: `${oldAssignee ? 'Reassigned' : 'Assigned'} to <strong>${staff.name}</strong>. Notifications sent via Email & SMS.`,
        author: 'Admin',
        attach: null
      });
      closeAssignModal();
      openPanel(currentCase.id);
      showToast('success', `<i class="fa-solid fa-user-check"></i> Assigned to <strong>${staff.name}</strong> — notified via Email & SMS`);
    }
  }, 1000);
}

/* ── Dispatch ── */
function toggleChip(el) { el.classList.toggle('on'); }

function dispatchTask(btn) {
  const instruction = document.getElementById('taskInstruction').value.trim();
  if (!instruction) {
    document.getElementById('taskInstruction').style.borderColor = 'var(--red)';
    document.getElementById('taskInstruction').focus();
    return;
  }
  if (!currentCase || !currentCase.assignee) {
    showToast('danger', '<i class="fa-solid fa-triangle-exclamation"></i> Please assign an investigator first.');
    return;
  }
  setLoading(btn, true);
  const emailOn = document.getElementById('notifyEmail').classList.contains('on');
  const smsOn   = document.getElementById('notifySMS').classList.contains('on');
  const appOn   = document.getElementById('notifyApp').classList.contains('on');
  const channels = [emailOn && 'Email', smsOn && 'SMS', appOn && 'In-App'].filter(Boolean).join(', ') || 'none';
  setTimeout(() => {
    setLoading(btn, false);
    const staff = staffById(currentCase.assignee);
    const now   = new Date().toLocaleString('en-US', { month:'short', day:'numeric', year:'numeric', hour:'numeric', minute:'2-digit' });
    const date  = document.getElementById('taskDate').value;
    const prio  = document.getElementById('taskPriority').value;
    currentCase.updates.push({
      type: 'blue',
      time: now,
      text: `Task dispatched to <strong>${staff.name}</strong>. Priority: <strong>${prio}</strong>${date ? ` · Visit date: ${date}` : ''}. Notified via: ${channels}.`,
      author: 'Admin',
      attach: null
    });
    document.getElementById('taskInstruction').value = '';
    document.getElementById('taskDate').value = '';
    document.getElementById('taskNotes').value = '';
    document.getElementById('taskInstruction').style.borderColor = '';
    renderTimeline(currentCase.updates);
    showToast('success', `<i class="fa-solid fa-paper-plane"></i> Task sent to ${staff.name} via ${channels}`);
  }, 1000);
}

/* ── Staff Update ── */
function fileSelected(input) {
  const preview = document.getElementById('filePreview');
  if (input.files && input.files[0]) {
    const f = input.files[0];
    preview.style.display = 'flex';
    preview.innerHTML = `
      <div class="tl-attach" style="width:100%">
        <i class="fa-solid ${f.type.includes('pdf') ? 'fa-file-pdf' : 'fa-image'}"></i>
        ${f.name}
        <span style="margin-left:auto;font-size:11px;color:var(--red);cursor:pointer" onclick="clearFile()">Remove</span>
      </div>`;
  }
}
function clearFile() {
  document.getElementById('updateFile').value = '';
  document.getElementById('filePreview').style.display = 'none';
  document.getElementById('filePreview').innerHTML = '';
}

function submitUpdate(btn) {
  const remark = document.getElementById('updateRemark').value.trim();
  if (!remark) {
    document.getElementById('updateRemark').style.borderColor = 'var(--red)';
    document.getElementById('updateRemark').focus();
    return;
  }
  setLoading(btn, true);
  const type     = document.getElementById('updateType').value;
  const fileEl   = document.getElementById('updateFile');
  const hasFile  = fileEl.files && fileEl.files[0];
  const typeMap  = { update:'green', finding:'amber', issue:'red', complete:'green' };
  const labelMap = { update:'Progress Update', finding:'Field Finding', issue:'Issue / Blocker', complete:'Marked Complete' };
  const staff    = currentCase && currentCase.assignee ? staffById(currentCase.assignee) : null;
  const now      = new Date().toLocaleString('en-US', { month:'short', day:'numeric', year:'numeric', hour:'numeric', minute:'2-digit' });

  setTimeout(() => {
    setLoading(btn, false);
    const update = {
      type: typeMap[type],
      time: now,
      text: `<strong>${labelMap[type]}:</strong> ${remark}`,
      author: staff ? staff.name : 'Staff',
      attach: hasFile ? { name: fileEl.files[0].name, type: fileEl.files[0].type.includes('pdf') ? 'pdf' : 'image' } : null
    };
    currentCase.updates.push(update);

    if (type === 'complete') {
      currentCase.status   = 'done';
      currentCase.progress = 100;
      const badge = document.getElementById('pBadge');
      badge.className = 'badge badge-done';
      badge.innerHTML = `<i class="fa-solid fa-circle-check"></i> Completed`;
      document.getElementById('decisionMsg').innerHTML = '<strong>Investigation completed.</strong> This case is archived.';
    } else {
      currentCase.progress = Math.min(90, (currentCase.progress || 0) + 15);
    }

    document.getElementById('updateRemark').value = '';
    document.getElementById('updateRemark').style.borderColor = '';
    clearFile();
    renderTimeline(currentCase.updates);
    filterCases();
    showToast('success', `<i class="fa-solid fa-circle-check"></i> Update submitted successfully`);
  }, 900);
}

/* ── Admin Decision ── */
function adminDecide(decision, btn) {
  if (!currentCase) return;
  setLoading(btn, true);
  setTimeout(() => {
    setLoading(btn, false);
    currentCase.status   = decision;
    currentCase.progress = decision === 'done' ? 100 : currentCase.progress;
    const now = new Date().toLocaleString('en-US', { month:'short', day:'numeric', year:'numeric', hour:'numeric', minute:'2-digit' });
    currentCase.updates.push({
      type: decision === 'done' ? 'green' : 'red',
      time: now,
      text: decision === 'done'
        ? '<strong>Admin Decision:</strong> Investigation marked as <strong>Complete</strong>. Case closed successfully.'
        : '<strong>Admin Decision:</strong> Investigation <strong>stopped</strong>.',
      author: 'Admin',
      attach: null
    });
    openPanel(currentCase.id);
    updateStats();
    showToast('success', `<i class="fa-solid fa-circle-check"></i> Investigation marked as ${decision === 'done' ? 'Complete' : 'Stopped'}`);
  }, 900);
}

/* ── Stop Modal ── */
function openStopModal() { document.getElementById('stopModal').classList.add('open'); }
function closeStopModal() { document.getElementById('stopModal').classList.remove('open'); }
function confirmStop(btn) {
  const reason  = document.getElementById('stopReason').value;
  const remarks = document.getElementById('stopRemarks').value.trim();
  if (!reason) { document.getElementById('stopReason').style.borderColor='var(--red)'; return; }
  setLoading(btn, true);
  setTimeout(() => {
    setLoading(btn, false);
    closeStopModal();
    if (currentCase) {
      currentCase.status = 'stopped';
      const now = new Date().toLocaleString('en-US', { month:'short', day:'numeric', year:'numeric', hour:'numeric', minute:'2-digit' });
      currentCase.updates.push({
        type: 'red', time: now,
        text: `<strong>Investigation Stopped.</strong> Reason: ${reason}${remarks ? `. ${remarks}` : ''}`,
        author: 'Admin', attach: null
      });
      openPanel(currentCase.id);
      updateStats();
      showToast('danger', `<i class="fa-solid fa-stop"></i> Investigation stopped — ${reason}`);
    }
  }, 900);
}

function exportInvestigations(btn) {
  setLoading(btn, true);
  setTimeout(() => { setLoading(btn, false); showToast('info', '<i class="fa-solid fa-file-arrow-down"></i> Investigations exported to CSV'); }, 1000);
}

/* ── Utility ── */
function setLoading(btn, on) {
  if (!btn) return;
  btn.disabled = on; btn.classList.toggle('loading', on);
}

function showToast(type, msg) {
  const wrap = document.getElementById('toastWrap');
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  t.innerHTML = `<div class="toast-ic"><i class="fa-solid ${type==='success'?'fa-check':type==='danger'?'fa-xmark':'fa-info'}"></i></div><span>${msg}</span>`;
  wrap.appendChild(t);
  setTimeout(() => t.remove(), 4000);
}

/* ── Close modals on backdrop ── */
document.getElementById('assignModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeAssignModal(); });
document.getElementById('stopModal').addEventListener('click',   e => { if (e.target === e.currentTarget) closeStopModal(); });

/* ── Init ── */
window.addEventListener('DOMContentLoaded', () => {
  updateStats();
  renderCards(CASES);
  setTimeout(() => document.getElementById('ivLoader').classList.add('hidden'), 700);
});
</script>

@endsection