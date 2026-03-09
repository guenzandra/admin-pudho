@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
  :root {
    --border:  #e2e5ea;
    --surface: #f4f5f7;
    --accent:  #e8472a;
    --text:    #1a1d23;
    --muted:   #7a8094;
    --sub:     #4a5068;
    --green:   #16a34a;
    --red:     #dc2626;
    --blue:    #2563eb;
    --amber:   #d97706;
    --purple:  #7c3aed;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  .mv-wrap {
    font-family: Arial, Helvetica, sans-serif;
    color: var(--text);
    display: flex;
    flex-direction: column;
    height: calc(100vh - 64px); /* fill below admin navbar */
    overflow: hidden;
    position: relative;
  }

  /* ── Top Bar ── */
  .mv-topbar {
    background: #fff;
    border-bottom: 1px solid var(--border);
    padding: 11px 20px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 12px; flex-wrap: wrap;
    flex-shrink: 0; z-index: 10;
  }
  .mv-topbar-left { display: flex; align-items: center; gap: 11px; }
  .mv-icon {
    width: 34px; height: 34px; background: var(--accent); border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 14px; flex-shrink: 0;
  }
  .mv-title h1 { font-size: 14px; font-weight: 700; line-height: 1.2; }
  .mv-title span { font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: .05em; }

  .mv-topbar-right { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

  /* filter pills */
  .filter-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 11px; border-radius: 20px; font-size: 12px; font-weight: 700;
    border: 1.5px solid var(--border); background: var(--surface); color: var(--muted);
    cursor: pointer; transition: all .15s; user-select: none;
  }
  .filter-pill i { font-size: 10px; }
  .filter-pill.all.on    { border-color: #444; background: #1a1d23; color: #fff; }
  .filter-pill.pending.on  { border-color: var(--amber);  background: rgba(217,119,6,.1);  color: var(--amber); }
  .filter-pill.active.on   { border-color: var(--blue);   background: rgba(37,99,235,.1);  color: var(--blue); }
  .filter-pill.done.on     { border-color: var(--green);  background: rgba(22,163,74,.1);  color: var(--green); }
  .filter-pill.denied.on   { border-color: var(--red);    background: rgba(220,38,38,.1);  color: var(--red); }
  .filter-pill.stopped.on  { border-color: var(--purple); background: rgba(124,58,237,.1); color: var(--purple); }

  .btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 13px; border-radius: 7px; border: none;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px; font-weight: 700; cursor: pointer;
    transition: all .15s; white-space: nowrap; line-height: 1;
  }
  .btn i { font-size: 11px; }
  .btn-ghost { background: transparent; color: var(--sub); border: 1px solid var(--border); }
  .btn-ghost:hover { background: var(--surface); }
  .btn-ghost.active { background: var(--surface); border-color: var(--blue); color: var(--blue); }

  /* ── Main content area ── */
  .mv-main {
    display: flex;
    flex: 1;
    overflow: hidden;
  }

  /* ── Sidebar ── */
  .mv-sidebar {
    width: 310px;
    flex-shrink: 0;
    background: #fff;
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    overflow: hidden;
    transition: width .25s ease;
  }
  .mv-sidebar.collapsed { width: 0; overflow: hidden; }

  .sidebar-search {
    padding: 12px 14px;
    border-bottom: 1px solid var(--border);
    flex-shrink: 0;
  }
  .sidebar-search .sb-input {
    width: 100%; position: relative;
  }
  .sidebar-search .sb-input i {
    position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
    color: var(--muted); font-size: 12px; pointer-events: none;
  }
  .sidebar-search input {
    width: 100%; padding: 8px 10px 8px 30px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 7px; color: var(--text);
    font-family: Arial, Helvetica, sans-serif; font-size: 13px;
    outline: none; transition: border-color .2s;
  }
  .sidebar-search input:focus { border-color: var(--blue); background: #fff; }
  .sidebar-search input::placeholder { color: var(--muted); }

  .sidebar-list {
    flex: 1;
    overflow-y: auto;
    padding: 6px 0;
  }
  .sidebar-list::-webkit-scrollbar { width: 4px; }
  .sidebar-list::-webkit-scrollbar-track { background: transparent; }
  .sidebar-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

  .report-item {
    padding: 10px 14px;
    cursor: pointer;
    border-bottom: 1px solid var(--border);
    transition: background .12s;
    display: flex; align-items: flex-start; gap: 10px;
  }
  .report-item:hover { background: #fafbfc; }
  .report-item.active { background: rgba(37,99,235,.05); border-left: 3px solid var(--blue); padding-left: 11px; }
  .report-item:last-child { border-bottom: none; }

  .ri-dot {
    width: 10px; height: 10px; border-radius: 50%;
    flex-shrink: 0; margin-top: 4px;
  }
  .ri-body { flex: 1; min-width: 0; }
  .ri-id   { font-size: 10px; color: var(--muted); font-weight: 700; margin-bottom: 2px; }
  .ri-loc  { font-size: 13px; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .ri-sub  { font-size: 11px; color: var(--muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .ri-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 2px 7px; border-radius: 20px;
    font-size: 10px; font-weight: 700; flex-shrink: 0; margin-top: 2px;
  }
  .ri-badge i { font-size: 8px; }

  .badge-pending  { background: rgba(217,119,6,.1);   color: var(--amber); }
  .badge-active   { background: rgba(37,99,235,.1);   color: var(--blue); }
  .badge-done     { background: rgba(22,163,74,.1);   color: var(--green); }
  .badge-denied   { background: rgba(220,38,38,.1);   color: var(--red); }
  .badge-stopped  { background: rgba(124,58,237,.1);  color: var(--purple); }

  .sidebar-empty {
    padding: 32px 16px; text-align: center; color: var(--muted); font-size: 13px;
  }
  .sidebar-empty i { font-size: 24px; display: block; margin-bottom: 8px; }

  .sidebar-footer {
    padding: 10px 14px;
    border-top: 1px solid var(--border);
    font-size: 11px; color: var(--muted);
    display: flex; align-items: center; justify-content: space-between;
    flex-shrink: 0;
  }

  /* ── Map ── */
  .mv-map-wrap {
    flex: 1;
    position: relative;
    overflow: hidden;
  }

  #mvMap {
    width: 100%;
    height: 100%;
  }

  /* ── Map overlay controls ── */
  .map-legend {
    position: absolute;
    bottom: 28px; left: 16px;
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; padding: 12px 14px;
    box-shadow: 0 4px 16px rgba(0,0,0,.1);
    z-index: 1000; min-width: 160px;
    font-size: 12px;
  }
  .map-legend h5 {
    font-size: 10px; font-weight: 700; text-transform: uppercase;
    letter-spacing: .07em; color: var(--muted); margin-bottom: 9px;
  }
  .legend-row {
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 7px; font-size: 12px; font-weight: 600;
  }
  .legend-row:last-child { margin-bottom: 0; }
  .legend-dot {
    width: 12px; height: 12px; border-radius: 50%;
    border: 2px solid rgba(0,0,0,.15); flex-shrink: 0;
  }

  .map-stats-overlay {
    position: absolute;
    top: 12px; right: 12px;
    display: flex; gap: 8px; flex-wrap: wrap;
    z-index: 1000;
  }
  .map-stat-chip {
    background: #fff; border: 1px solid var(--border);
    border-radius: 8px; padding: 7px 12px;
    font-size: 12px; font-weight: 700;
    box-shadow: 0 2px 8px rgba(0,0,0,.08);
    display: flex; align-items: center; gap: 6px;
  }
  .map-stat-chip i { font-size: 11px; }

  /* ── Popup styling (Leaflet override) ── */
  .leaflet-popup-content-wrapper {
    border-radius: 10px !important;
    border: 1px solid var(--border) !important;
    box-shadow: 0 8px 24px rgba(0,0,0,.12) !important;
    padding: 0 !important;
    overflow: hidden !important;
    font-family: Arial, Helvetica, sans-serif !important;
  }
  .leaflet-popup-content {
    margin: 0 !important;
    width: 280px !important;
  }
  .leaflet-popup-tip-container { display: none; }
  .leaflet-popup-close-button {
    top: 8px !important; right: 8px !important;
    width: 22px !important; height: 22px !important;
    font-size: 16px !important; color: var(--muted) !important;
    background: var(--surface) !important;
    border-radius: 5px !important;
    display: flex !important; align-items: center !important; justify-content: center !important;
    padding: 0 !important;
  }

  .popup-inner { padding: 14px 16px 16px; }
  .popup-top {
    display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;
    margin-bottom: 10px;
  }
  .popup-id   { font-size: 10px; color: var(--muted); font-weight: 700; margin-bottom: 3px; }
  .popup-loc  { font-size: 14px; font-weight: 700; line-height: 1.3; }
  .popup-addr { font-size: 12px; color: var(--muted); margin-top: 2px; }
  .popup-rows { display: flex; flex-direction: column; gap: 6px; margin-bottom: 12px; }
  .popup-row  {
    display: flex; align-items: flex-start; gap: 7px; font-size: 12px; color: var(--sub);
  }
  .popup-row i { color: var(--muted); font-size: 11px; width: 12px; text-align: center; flex-shrink: 0; margin-top: 1px; }
  .popup-row strong { color: var(--text); font-weight: 700; }
  .popup-actions { display: flex; gap: 7px; }
  .popup-btn {
    flex: 1; padding: 7px; border-radius: 7px; border: none; cursor: pointer;
    font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 700;
    display: flex; align-items: center; justify-content: center; gap: 5px;
    transition: all .15s;
  }
  .popup-btn i { font-size: 11px; }
  .popup-btn.view { background: var(--surface); color: var(--sub); border: 1px solid var(--border); }
  .popup-btn.view:hover { background: var(--border); }
  .popup-btn.inv  { background: var(--blue); color: #fff; }
  .popup-btn.inv:hover { background: #1d4ed8; }

  /* ── Area cluster badge ── */
  .area-cluster {
    background: #fff; border: 2px solid #444;
    border-radius: 50%; width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 12px; color: #1a1d23;
    box-shadow: 0 2px 8px rgba(0,0,0,.2);
  }

  /* ── Detail drawer (mobile-friendly) ── */
  .detail-drawer {
    display: none; position: absolute;
    bottom: 0; left: 0; right: 0;
    background: #fff; border-top: 1px solid var(--border);
    border-radius: 14px 14px 0 0;
    padding: 16px 20px 20px;
    box-shadow: 0 -4px 20px rgba(0,0,0,.1);
    z-index: 1001;
    max-height: 55%;
    overflow-y: auto;
  }
  .detail-drawer.open { display: block; animation: drawerUp .25s ease; }
  @keyframes drawerUp {
    from { transform: translateY(20px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
  }
  .drawer-handle {
    width: 36px; height: 4px; background: var(--border);
    border-radius: 2px; margin: 0 auto 14px;
  }

  /* ── Toast ── */
  .toast-wrap {
    position: fixed; bottom: 22px; right: 22px; z-index: 1080;
    display: flex; flex-direction: column; gap: 8px;
  }
  .toast {
    background: #fff; border: 1px solid var(--border);
    border-radius: 9px; padding: 11px 15px;
    font-size: 13px; display: flex; align-items: center; gap: 9px;
    box-shadow: 0 4px 16px rgba(0,0,0,.1); min-width: 230px;
    animation: tIn .22s ease;
  }
  @keyframes tIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
  .toast-ic { width:22px; height:22px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:11px; }
  .toast.success .toast-ic { background:rgba(22,163,74,.12); color:var(--green); }
  .toast.info    .toast-ic { background:rgba(37,99,235,.12);  color:var(--blue); }

  /* ── Responsive ── */
  @media (max-width: 768px) {
    .mv-sidebar { position: absolute; top: 0; left: 0; bottom: 0; z-index: 20; width: 280px; box-shadow: 4px 0 16px rgba(0,0,0,.12); }
    .mv-sidebar.collapsed { width: 0; }
    .mv-wrap { height: calc(100vh - 56px); }
    .map-stats-overlay { display: none; }
  }
</style>

<div class="mv-wrap">

  <!-- Top Bar -->
  <div class="mv-topbar">
    <div class="mv-topbar-left">
      <div class="mv-icon"><i class="fa-solid fa-map-location-dot"></i></div>
      <div class="mv-title">
        <h1>Map View</h1>
        <span>Squatting Incident Locations</span>
      </div>
    </div>
    <div class="mv-topbar-right">
      <!-- Filter Pills -->
      <span class="filter-pill all on" data-filter="all" onclick="setFilter('all', this)">
        <i class="fa-solid fa-layer-group"></i> All
      </span>
      <span class="filter-pill pending" data-filter="pending" onclick="setFilter('pending', this)">
        <i class="fa-solid fa-hourglass-half"></i> Pending
      </span>
      <span class="filter-pill active" data-filter="active" onclick="setFilter('active', this)">
        <i class="fa-solid fa-magnifying-glass"></i> Investigating
      </span>
      <span class="filter-pill done" data-filter="done" onclick="setFilter('done', this)">
        <i class="fa-solid fa-circle-check"></i> Resolved
      </span>
      <span class="filter-pill denied" data-filter="denied" onclick="setFilter('denied', this)">
        <i class="fa-solid fa-ban"></i> Denied
      </span>
      <button class="btn btn-ghost active" id="btnSidebar" onclick="toggleSidebar()">
        <i class="fa-solid fa-list"></i> List
      </button>
      <button class="btn btn-ghost" onclick="recenterMap()">
        <i class="fa-solid fa-crosshairs"></i> Recenter
      </button>
    </div>
  </div>

  <!-- Main -->
  <div class="mv-main">

    <!-- Sidebar -->
    <div class="mv-sidebar" id="mvSidebar">
      <div class="sidebar-search">
        <div class="sb-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" id="sidebarSearch" placeholder="Search location, ID, reporter…" oninput="filterSidebar()">
        </div>
      </div>
      <div class="sidebar-list" id="sidebarList"></div>
      <div class="sidebar-footer">
        <span id="sidebarCount">0 reports</span>
        <span id="sidebarFiltered" style="color:var(--blue)"></span>
      </div>
    </div>

    <!-- Map -->
    <div class="mv-map-wrap">
      <div id="mvMap"></div>

      <!-- Map Stats Overlay -->
      <div class="map-stats-overlay">
        <div class="map-stat-chip" style="border-left:3px solid var(--amber)">
          <i class="fa-solid fa-hourglass-half" style="color:var(--amber)"></i>
          <span id="chipPending">0</span> Pending
        </div>
        <div class="map-stat-chip" style="border-left:3px solid var(--blue)">
          <i class="fa-solid fa-magnifying-glass" style="color:var(--blue)"></i>
          <span id="chipActive">0</span> Investigating
        </div>
        <div class="map-stat-chip" style="border-left:3px solid var(--green)">
          <i class="fa-solid fa-circle-check" style="color:var(--green)"></i>
          <span id="chipDone">0</span> Resolved
        </div>
        <div class="map-stat-chip" style="border-left:3px solid var(--red)">
          <i class="fa-solid fa-ban" style="color:var(--red)"></i>
          <span id="chipDenied">0</span> Denied
        </div>
      </div>

      <!-- Legend -->
      <div class="map-legend">
        <h5><i class="fa-solid fa-circle-dot" style="margin-right:4px"></i>Legend</h5>
        <div class="legend-row"><div class="legend-dot" style="background:var(--amber)"></div>Pending Review</div>
        <div class="legend-row"><div class="legend-dot" style="background:var(--blue)"></div>Under Investigation</div>
        <div class="legend-row"><div class="legend-dot" style="background:var(--green)"></div>Resolved</div>
        <div class="legend-row"><div class="legend-dot" style="background:var(--red)"></div>Denied</div>
        <div class="legend-row"><div class="legend-dot" style="background:var(--purple)"></div>Stopped</div>
      </div>

    </div><!-- /.mv-map-wrap -->

  </div><!-- /.mv-main -->

</div><!-- /.mv-wrap -->

<!-- Toast -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
/* ═══════════════════════════════════════════════
   DATA — swap this with your actual backend data
   ═══════════════════════════════════════════════ */
const REPORTS = [
  {
    id: 'RPT-2025-001', invId: 'INV-2025-001',
    location: 'Barangay Tondo, Manila',
    address: 'Sta. Ana Street, Tondo, Manila',
    reporter: 'Maria Santos', date: '2025-07-14',
    ip: '112.198.42.17', coords: [14.6194, 120.9683],
    status: 'active', priority: 'High',
    details: 'Group of ~8 individuals occupying a vacant lot with makeshift shelters.',
    assignee: 'Juan Dela Cruz'
  },
  {
    id: 'RPT-2025-002', invId: 'INV-2025-002',
    location: 'Pasig City',
    address: 'Kapitolyo, Pasig City, Metro Manila',
    reporter: 'Anonymous', date: '2025-07-12',
    ip: '180.191.77.233', coords: [14.5667, 121.0750],
    status: 'pending', priority: 'Normal',
    details: 'Three families squatting on riverbank area behind commercial building.',
    assignee: null
  },
  {
    id: 'RPT-2025-003', invId: 'INV-2025-003',
    location: 'Quezon City',
    address: 'Commonwealth Ave., QC, Metro Manila',
    reporter: 'Jose Reyes', date: '2025-07-10',
    ip: '122.53.110.89', coords: [14.6760, 121.0437],
    status: 'active', priority: 'Urgent',
    details: 'Inherited property occupied — complainant appeared in person with land title.',
    assignee: 'Maria Aguilar'
  },
  {
    id: 'RPT-2025-004', invId: null,
    location: 'Caloocan City',
    address: 'Grace Park, Caloocan City',
    reporter: 'Lourdes Dela Cruz', date: '2025-07-08',
    ip: '49.148.22.61', coords: [14.6572, 120.9847],
    status: 'denied', priority: 'Normal',
    details: 'Property under pending land dispute — occupants have valid lease.',
    assignee: null
  },
  {
    id: 'RPT-2025-005', invId: 'INV-2025-004',
    location: 'Marikina City',
    address: 'Sto. Niño, Marikina City',
    reporter: 'Anonymous', date: '2025-07-07',
    ip: '202.90.144.55', coords: [14.6350, 121.1028],
    status: 'done', priority: 'Normal',
    details: 'Illegal structures along Marikina riverbank — demolished by MMDA.',
    assignee: 'Roberto Cruz'
  },
  {
    id: 'RPT-2025-006', invId: 'INV-2025-005',
    location: 'Valenzuela City',
    address: 'Ugong Norte, Valenzuela City',
    reporter: 'Rodrigo Villanueva', date: '2025-07-05',
    ip: '112.204.88.13', coords: [14.6951, 120.9773],
    status: 'active', priority: 'High',
    details: '~20 families with semi-permanent concrete structures. Long-term occupation.',
    assignee: 'Lorna Reyes'
  },
  {
    id: 'RPT-2025-007', invId: null,
    location: 'Sta. Cruz, Laguna',
    address: 'Brgy. Poblacion, Sta. Cruz, Laguna',
    reporter: 'Pedro Bautista', date: '2025-07-03',
    ip: '120.28.100.22', coords: [14.2817, 121.4172],
    status: 'pending', priority: 'High',
    details: 'Vacant lot near public market occupied by 5 families.',
    assignee: null
  },
  {
    id: 'RPT-2025-008', invId: null,
    location: 'Pagsanjan, Laguna',
    address: 'Brgy. Pinagsanjan, Pagsanjan, Laguna',
    reporter: 'Elena Santos', date: '2025-07-01',
    ip: '112.200.44.18', coords: [14.2738, 121.4580],
    status: 'pending', priority: 'Normal',
    details: 'Riverbank area occupied along Pagsanjan River.',
    assignee: null
  },
  {
    id: 'RPT-2025-009', invId: 'INV-2025-006',
    location: 'Calamba, Laguna',
    address: 'Brgy. Parian, Calamba, Laguna',
    reporter: 'Ramon Cruz', date: '2025-06-28',
    ip: '122.54.88.11', coords: [14.2116, 121.1653],
    status: 'active', priority: 'Urgent',
    details: 'Industrial zone boundary encroached by informal settlers.',
    assignee: 'Eduardo Pascual'
  },
  {
    id: 'RPT-2025-010', invId: null,
    location: 'San Pablo, Laguna',
    address: 'Brgy. Concepcion, San Pablo, Laguna',
    reporter: 'Anonymous', date: '2025-06-25',
    ip: '180.190.33.77', coords: [14.0679, 121.3248],
    status: 'done', priority: 'Normal',
    details: 'Agricultural lot cleared of illegal structures after coordination with LGU.',
    assignee: 'Sandra Bautista'
  },
  {
    id: 'RPT-2025-011', invId: null,
    location: 'Los Baños, Laguna',
    address: 'Brgy. Bayog, Los Baños, Laguna',
    reporter: 'Rosa Fernandez', date: '2025-06-20',
    ip: '49.150.22.99', coords: [14.1706, 121.2413],
    status: 'denied', priority: 'Normal',
    details: 'Complainant could not establish ownership — case denied.',
    assignee: null
  },
  {
    id: 'RPT-2025-012', invId: 'INV-2025-007',
    location: 'Bay, Laguna',
    address: 'Brgy. Tagumpay, Bay, Laguna',
    reporter: 'Arturo Villanueva', date: '2025-06-18',
    ip: '120.29.55.43', coords: [14.1781, 121.2878],
    status: 'active', priority: 'High',
    details: 'Lakeside property along Laguna de Bay occupied by informal settlers.',
    assignee: 'Juan Dela Cruz'
  },
];

/* ═══════════════════════════════════════════════
   CONFIG
   ═══════════════════════════════════════════════ */
const STATUS_COLORS = {
  pending:  '#d97706',
  active:   '#2563eb',
  done:     '#16a34a',
  denied:   '#dc2626',
  stopped:  '#7c3aed',
};
const STATUS_LABELS = {
  pending:  'Pending Review',
  active:   'Investigating',
  done:     'Resolved',
  denied:   'Denied',
  stopped:  'Stopped',
};
const STATUS_ICONS = {
  pending:  'fa-hourglass-half',
  active:   'fa-magnifying-glass',
  done:     'fa-circle-check',
  denied:   'fa-ban',
  stopped:  'fa-stop',
};

let map, markers = [], markerLayer = {};
let currentFilter = 'all';
let sidebarOpen   = true;
let activeMarkerId = null;

/* ═══════════════════════════════════════════════
   INIT MAP
   ═══════════════════════════════════════════════ */
function initMap() {
  map = L.map('mvMap', {
    center: [14.4426, 121.0699], // centered on Metro Manila / Laguna
    zoom: 10,
    zoomControl: false,
  });

  // Tile layer — OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    maxZoom: 19,
  }).addTo(map);

  // Custom zoom control position
  L.control.zoom({ position: 'bottomright' }).addTo(map);

  addMarkers(REPORTS);
  renderSidebar(REPORTS);
  updateChips(REPORTS);
}

/* ═══════════════════════════════════════════════
   MARKERS
   ═══════════════════════════════════════════════ */
function makeIcon(status, active = false) {
  const color = STATUS_COLORS[status] || '#7a8094';
  const size  = active ? 20 : 16;
  const pulse = active ? `
    <circle cx="10" cy="10" r="10" fill="${color}" opacity=".2">
      <animate attributeName="r" from="8" to="16" dur="1.5s" repeatCount="indefinite"/>
      <animate attributeName="opacity" from=".3" to="0" dur="1.5s" repeatCount="indefinite"/>
    </circle>` : '';
  const svg = `
    <svg xmlns="http://www.w3.org/2000/svg" width="${size*2}" height="${size*2}" viewBox="0 0 20 20">
      ${pulse}
      <circle cx="10" cy="10" r="7" fill="${color}" stroke="#fff" stroke-width="2.5"/>
    </svg>`;
  return L.divIcon({
    html: svg,
    className: '',
    iconSize:   [size * 2, size * 2],
    iconAnchor: [size, size],
    popupAnchor:[0, -size],
  });
}

function addMarkers(data) {
  // Clear existing
  markers.forEach(m => map.removeLayer(m));
  markers = [];
  markerLayer = {};

  data.forEach(r => {
    if (!r.coords) return;
    const m = L.marker(r.coords, { icon: makeIcon(r.status) });
    m.reportId = r.id;

    m.bindPopup(buildPopup(r), {
      maxWidth: 300,
      className: 'mv-popup',
    });

    m.on('click', () => {
      setActiveMarker(r.id);
      highlightSidebarItem(r.id);
    });

    m.addTo(map);
    markers.push(m);
    markerLayer[r.id] = m;
  });
}

function buildPopup(r) {
  const color = STATUS_COLORS[r.status];
  const icon  = STATUS_ICONS[r.status];
  const label = STATUS_LABELS[r.status];
  return `
    <div class="popup-inner">
      <div class="popup-top">
        <div>
          <div class="popup-id">${r.id}${r.invId ? ` · ${r.invId}` : ''}</div>
          <div class="popup-loc">${r.location}</div>
          <div class="popup-addr">${r.address}</div>
        </div>
        <span class="ri-badge badge-${r.status}">
          <i class="fa-solid ${icon}"></i> ${label}
        </span>
      </div>
      <div class="popup-rows">
        <div class="popup-row"><i class="fa-solid fa-user"></i><span><strong>${r.reporter}</strong> &nbsp;·&nbsp; ${r.date}</span></div>
        <div class="popup-row"><i class="fa-solid fa-desktop"></i><span style="font-family:monospace;font-size:11px">${r.ip}</span></div>
        <div class="popup-row"><i class="fa-solid fa-earth-asia"></i><span style="font-family:monospace;font-size:11px">${r.coords[0].toFixed(4)}° N, ${r.coords[1].toFixed(4)}° E</span></div>
        ${r.assignee ? `<div class="popup-row"><i class="fa-solid fa-user-tie"></i><span>Assigned: <strong>${r.assignee}</strong></span></div>` : ''}
        <div class="popup-row"><i class="fa-solid fa-flag" style="color:${r.priority==='Urgent'?'var(--red)':r.priority==='High'?'var(--amber)':'var(--muted)'}"></i>
          <span>Priority: <strong style="color:${r.priority==='Urgent'?'var(--red)':r.priority==='High'?'var(--amber)':'var(--muted)'}">${r.priority}</strong></span>
        </div>
        <div class="popup-row"><i class="fa-solid fa-align-left"></i><span style="color:var(--muted)">${r.details.substring(0,80)}${r.details.length>80?'…':''}</span></div>
      </div>
      <div class="popup-actions">
        <button class="popup-btn view" onclick="viewReport('${r.id}')">
          <i class="fa-solid fa-eye"></i> View Report
        </button>
        ${r.invId ? `
        <button class="popup-btn inv" onclick="viewInvestigation('${r.invId}')">
          <i class="fa-solid fa-magnifying-glass"></i> Investigation
        </button>` : `
        <button class="popup-btn inv" onclick="sendToInvestigation('${r.id}')">
          <i class="fa-solid fa-plus"></i> Start Investigation
        </button>`}
      </div>
    </div>`;
}

function setActiveMarker(id) {
  // Reset previous
  if (activeMarkerId && markerLayer[activeMarkerId]) {
    const prev = REPORTS.find(r => r.id === activeMarkerId);
    if (prev) markerLayer[activeMarkerId].setIcon(makeIcon(prev.status, false));
  }
  activeMarkerId = id;
  const curr = REPORTS.find(r => r.id === id);
  if (curr && markerLayer[id]) {
    markerLayer[id].setIcon(makeIcon(curr.status, true));
  }
}

/* ═══════════════════════════════════════════════
   SIDEBAR
   ═══════════════════════════════════════════════ */
function renderSidebar(data) {
  const list = document.getElementById('sidebarList');
  document.getElementById('sidebarCount').textContent = `${data.length} report${data.length !== 1 ? 's' : ''}`;

  if (!data.length) {
    list.innerHTML = `<div class="sidebar-empty"><i class="fa-solid fa-inbox"></i>No reports found</div>`;
    return;
  }

  list.innerHTML = data.map(r => `
    <div class="report-item ${activeMarkerId === r.id ? 'active' : ''}" id="si-${r.id}" onclick="focusMarker('${r.id}')">
      <div class="ri-dot" style="background:${STATUS_COLORS[r.status]}"></div>
      <div class="ri-body">
        <div class="ri-id">${r.id}${r.invId ? ` · ${r.invId}` : ''}</div>
        <div class="ri-loc">${r.location}</div>
        <div class="ri-sub">${r.reporter} &nbsp;·&nbsp; ${r.date}</div>
        <div style="margin-top:4px;display:flex;align-items:center;gap:6px;flex-wrap:wrap">
          <span class="ri-badge badge-${r.status}"><i class="fa-solid ${STATUS_ICONS[r.status]}"></i> ${STATUS_LABELS[r.status]}</span>
          <span style="font-size:10px;color:var(--muted)"><i class="fa-solid fa-flag" style="color:${r.priority==='Urgent'?'var(--red)':r.priority==='High'?'var(--amber)':'var(--muted)'}"></i> ${r.priority}</span>
        </div>
      </div>
    </div>`).join('');
}

function filterSidebar() {
  const q = document.getElementById('sidebarSearch').value.toLowerCase();
  const filtered = getFilteredReports().filter(r =>
    !q || r.location.toLowerCase().includes(q) || r.id.toLowerCase().includes(q) || r.reporter.toLowerCase().includes(q) || r.address.toLowerCase().includes(q)
  );
  renderSidebar(filtered);
  document.getElementById('sidebarFiltered').textContent = q ? `${filtered.length} matched` : '';
}

function highlightSidebarItem(id) {
  document.querySelectorAll('.report-item').forEach(el => el.classList.remove('active'));
  const el = document.getElementById(`si-${id}`);
  if (el) { el.classList.add('active'); el.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }
}

function focusMarker(id) {
  const r = REPORTS.find(x => x.id === id);
  if (!r || !r.coords) return;
  map.flyTo(r.coords, 15, { duration: 0.8 });
  setTimeout(() => {
    if (markerLayer[id]) { markerLayer[id].openPopup(); }
  }, 900);
  setActiveMarker(id);
  highlightSidebarItem(id);
}

/* ═══════════════════════════════════════════════
   FILTER
   ═══════════════════════════════════════════════ */
function getFilteredReports() {
  return currentFilter === 'all' ? REPORTS : REPORTS.filter(r => r.status === currentFilter);
}

function setFilter(filter, el) {
  currentFilter = filter;
  document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('on'));
  el.classList.add('on');
  const data = getFilteredReports();
  addMarkers(data);
  renderSidebar(data);
  updateChips(REPORTS); // chips always show totals
}

function updateChips(data) {
  document.getElementById('chipPending').textContent = data.filter(r => r.status === 'pending').length;
  document.getElementById('chipActive').textContent  = data.filter(r => r.status === 'active').length;
  document.getElementById('chipDone').textContent    = data.filter(r => r.status === 'done').length;
  document.getElementById('chipDenied').textContent  = data.filter(r => r.status === 'denied').length;
}

/* ═══════════════════════════════════════════════
   SIDEBAR TOGGLE
   ═══════════════════════════════════════════════ */
function toggleSidebar() {
  sidebarOpen = !sidebarOpen;
  const sb  = document.getElementById('mvSidebar');
  const btn = document.getElementById('btnSidebar');
  sb.classList.toggle('collapsed', !sidebarOpen);
  btn.classList.toggle('active', sidebarOpen);
  setTimeout(() => map.invalidateSize(), 260);
}

/* ═══════════════════════════════════════════════
   RECENTER
   ═══════════════════════════════════════════════ */
function recenterMap() {
  map.flyTo([14.4426, 121.0699], 10, { duration: 1 });
  showToast('info', '<i class="fa-solid fa-crosshairs"></i> Map recentered');
}

/* ═══════════════════════════════════════════════
   POPUP ACTIONS
   ═══════════════════════════════════════════════ */
function viewReport(id) {
  showToast('info', `<i class="fa-solid fa-eye"></i> Opening report <strong>${id}</strong>…`);
  // window.location.href = `/admin/reports?id=${id}`;
}

function viewInvestigation(invId) {
  showToast('info', `<i class="fa-solid fa-magnifying-glass"></i> Opening investigation <strong>${invId}</strong>…`);
  // window.location.href = `/admin/investigations?id=${invId}`;
}

function sendToInvestigation(id) {
  const r = REPORTS.find(x => x.id === id);
  if (r) {
    r.status = 'active';
    r.invId  = 'INV-NEW';
    showToast('success', `<i class="fa-solid fa-circle-check"></i> <strong>${id}</strong> moved to Investigation`);
    const data = getFilteredReports();
    addMarkers(data);
    renderSidebar(data);
  }
}

/* ═══════════════════════════════════════════════
   TOAST
   ═══════════════════════════════════════════════ */
function showToast(type, msg) {
  const wrap = document.getElementById('toastWrap');
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  t.innerHTML = `<div class="toast-ic"><i class="fa-solid ${type==='success'?'fa-check':type==='danger'?'fa-xmark':'fa-info'}"></i></div><span>${msg}</span>`;
  wrap.appendChild(t);
  setTimeout(() => t.remove(), 3800);
}

/* ═══════════════════════════════════════════════
   BOOT
   ═══════════════════════════════════════════════ */
window.addEventListener('DOMContentLoaded', initMap);
</script>

@endsection