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

  .ov-wrap {
    font-family: Arial, Helvetica, sans-serif;
    background: var(--surface);
    color: var(--text);
    min-height: 100vh;
    padding: 20px 24px 32px;
  }

  /* ── Section label ── */
  .section-label {
    font-size: 10px; font-weight: 700; text-transform: uppercase;
    letter-spacing: .08em; color: var(--muted); margin-bottom: 10px;
    display: flex; align-items: center; gap: 7px;
  }
  .section-label::after {
    content: ''; flex: 1; height: 1px; background: var(--border);
  }

  /* ── KPI Row ── */
  .kpi-row {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
    margin-bottom: 20px;
  }

  .kpi-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; padding: 14px 16px;
    display: flex; align-items: center; gap: 12px;
    transition: box-shadow .18s;
    cursor: default;
  }
  .kpi-card:hover { box-shadow: 0 4px 14px rgba(0,0,0,.07); }
  .kpi-ic {
    width: 38px; height: 38px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
  }
  .kpi-info p { font-size: 10px; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 3px; }
  .kpi-info strong { font-size: 22px; font-weight: 700; line-height: 1; }
  .kpi-info .kpi-delta {
    font-size: 11px; font-weight: 700; margin-top: 2px;
    display: flex; align-items: center; gap: 3px;
  }
  .kpi-delta.up   { color: var(--green); }
  .kpi-delta.down { color: var(--red); }
  .kpi-delta.flat { color: var(--muted); }

  /* ── Main Grid ── */
  .ov-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: auto auto;
    gap: 16px;
    margin-bottom: 20px;
  }

  .card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; overflow: hidden;
  }
  .card-head {
    padding: 13px 16px 11px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; gap: 8px;
  }
  .card-head h3 { font-size: 13px; font-weight: 700; display: flex; align-items: center; gap: 7px; }
  .card-head h3 i { font-size: 12px; color: var(--muted); }
  .card-body { padding: 14px 16px; }

  .link-btn {
    font-size: 11px; font-weight: 700; color: var(--blue);
    background: none; border: none; cursor: pointer;
    display: flex; align-items: center; gap: 4px; padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    white-space: nowrap;
  }
  .link-btn:hover { text-decoration: underline; }
  .link-btn i { font-size: 10px; }

  /* ── Status Donut ── */
  .donut-wrap {
    display: flex; align-items: center; gap: 20px;
  }
  .donut-svg { flex-shrink: 0; }
  .donut-legend { flex: 1; display: flex; flex-direction: column; gap: 8px; }
  .dl-row {
    display: flex; align-items: center; justify-content: space-between; gap: 8px;
  }
  .dl-label { display: flex; align-items: center; gap: 7px; font-size: 12px; color: var(--sub); }
  .dl-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
  .dl-val { font-size: 13px; font-weight: 700; }
  .dl-pct { font-size: 11px; color: var(--muted); min-width: 30px; text-align: right; }

  /* ── Bar chart ── */
  .bar-chart { display: flex; flex-direction: column; gap: 9px; }
  .bar-row { display: flex; align-items: center; gap: 10px; }
  .bar-label { font-size: 11px; color: var(--sub); width: 90px; flex-shrink: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .bar-track { flex: 1; height: 8px; background: var(--surface); border-radius: 4px; overflow: hidden; }
  .bar-fill  { height: 100%; border-radius: 4px; transition: width .6s ease; }
  .bar-num   { font-size: 11px; font-weight: 700; color: var(--text); min-width: 18px; text-align: right; }

  /* ── Mini map ── */
  .mini-map-card { grid-column: 1 / -1; }
  #ovMiniMap { width: 100%; height: 240px; }
  .mini-map-overlay-badge {
    position: absolute; top: 10px; left: 10px; z-index: 400;
    background: #fff; border: 1px solid var(--border);
    border-radius: 8px; padding: 7px 12px;
    font-size: 12px; font-weight: 700;
    box-shadow: 0 2px 8px rgba(0,0,0,.08);
    display: flex; align-items: center; gap: 6px;
  }

  /* ── Recent Reports Table ── */
  .span-2 { grid-column: span 2; }

  .rr-table { width: 100%; border-collapse: collapse; font-size: 12px; }
  .rr-table thead tr { background: var(--surface); border-bottom: 1px solid var(--border); }
  .rr-table th {
    padding: 8px 10px; text-align: left; font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .06em; color: var(--muted);
  }
  .rr-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; cursor: pointer; }
  .rr-table tbody tr:last-child { border-bottom: none; }
  .rr-table tbody tr:hover { background: #fafbfc; }
  .rr-table td { padding: 9px 10px; vertical-align: middle; }

  .badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 2px 7px; border-radius: 20px;
    font-size: 10px; font-weight: 700; white-space: nowrap;
  }
  .badge i { font-size: 8px; }
  .badge-pending  { background: rgba(217,119,6,.1);   color: var(--amber); }
  .badge-active   { background: rgba(37,99,235,.1);   color: var(--blue); }
  .badge-done     { background: rgba(22,163,74,.1);   color: var(--green); }
  .badge-denied   { background: rgba(220,38,38,.1);   color: var(--red); }
  .badge-stopped  { background: rgba(124,58,237,.1);  color: var(--purple); }

  .rep-cell { display: flex; align-items: center; gap: 7px; }
  .av-xs {
    width: 26px; height: 26px; border-radius: 6px;
    background: var(--surface); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 700; color: var(--sub); flex-shrink: 0;
  }

  /* ── Investigation progress list ── */
  .inv-list { display: flex; flex-direction: column; gap: 10px; }
  .inv-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 10px; border: 1px solid var(--border);
    border-radius: 8px; transition: background .12s; cursor: pointer;
  }
  .inv-item:hover { background: #fafbfc; }
  .inv-av {
    width: 30px; height: 30px; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 700; color: #fff; flex-shrink: 0;
  }
  .inv-info { flex: 1; min-width: 0; }
  .inv-id   { font-size: 10px; color: var(--muted); font-weight: 700; }
  .inv-loc  { font-size: 12px; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .inv-prog-wrap { width: 60px; flex-shrink: 0; }
  .inv-prog-label { font-size: 10px; color: var(--muted); text-align: right; margin-bottom: 3px; }
  .inv-prog-bar { height: 5px; background: var(--surface); border-radius: 3px; overflow: hidden; }
  .inv-prog-fill { height: 100%; border-radius: 3px; }

  /* ── Activity Feed ── */
  .activity-feed { display: flex; flex-direction: column; }
  .af-item {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 10px 0; border-bottom: 1px solid var(--border);
  }
  .af-item:last-child { border-bottom: none; }
  .af-ic {
    width: 28px; height: 28px; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; flex-shrink: 0; margin-top: 1px;
  }
  .af-text { flex: 1; font-size: 12px; color: var(--sub); line-height: 1.5; }
  .af-text strong { color: var(--text); font-weight: 700; }
  .af-time { font-size: 10px; color: var(--muted); flex-shrink: 0; margin-top: 3px; white-space: nowrap; }

  /* ── Source Breakdown ── */
  .source-row {
    display: flex; align-items: center; gap: 12px; padding: 9px 0;
    border-bottom: 1px solid var(--border);
  }
  .source-row:last-child { border-bottom: none; }
  .src-ic {
    width: 32px; height: 32px; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; flex-shrink: 0;
  }
  .src-info { flex: 1; }
  .src-name { font-size: 12px; font-weight: 700; }
  .src-sub  { font-size: 11px; color: var(--muted); }
  .src-count { font-size: 18px; font-weight: 700; flex-shrink: 0; }

  /* ── Staff workload ── */
  .staff-list { display: flex; flex-direction: column; gap: 8px; }
  .staff-row {
    display: flex; align-items: center; gap: 10px;
  }
  .staff-av {
    width: 28px; height: 28px; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 700; color: #fff; flex-shrink: 0;
  }
  .staff-name-wrap { flex: 1; min-width: 0; }
  .staff-nm { font-size: 12px; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .staff-rl { font-size: 10px; color: var(--muted); }
  .staff-cases {
    font-size: 12px; font-weight: 700; flex-shrink: 0;
    display: flex; align-items: center; gap: 4px;
  }
  .staff-status-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }

  /* ── Area Heat Table ── */
  .heat-table { width: 100%; border-collapse: collapse; font-size: 12px; }
  .heat-table thead tr { background: var(--surface); border-bottom: 1px solid var(--border); }
  .heat-table th { padding: 7px 10px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing:.06em; color: var(--muted); text-align: left; }
  .heat-table tbody tr { border-bottom: 1px solid var(--border); }
  .heat-table tbody tr:last-child { border-bottom: none; }
  .heat-table td { padding: 8px 10px; }
  .heat-cell { display: flex; align-items: center; gap: 8px; }
  .heat-bar { flex: 1; height: 6px; background: var(--surface); border-radius: 3px; overflow: hidden; }
  .heat-fill { height: 100%; border-radius: 3px; background: var(--accent); }

  /* ── Leaflet overrides ── */
  .leaflet-popup-content-wrapper {
    border-radius: 9px !important; border: 1px solid var(--border) !important;
    box-shadow: 0 6px 20px rgba(0,0,0,.1) !important;
    font-family: Arial, Helvetica, sans-serif !important; padding: 0 !important; overflow: hidden !important;
  }
  .leaflet-popup-content { margin: 0 !important; width: 200px !important; }
  .leaflet-popup-tip-container { display: none; }
  .mini-popup { padding: 10px 12px; font-size: 12px; }
  .mini-popup strong { display: block; font-size: 13px; font-weight: 700; margin-bottom: 3px; }
  .mini-popup span { color: var(--muted); }

  /* ── Responsive ── */
  @media (max-width: 1100px) {
    .kpi-row { grid-template-columns: repeat(3,1fr); }
    .ov-grid { grid-template-columns: 1fr 1fr; }
    .span-2 { grid-column: span 1; }
    .mini-map-card { grid-column: 1 / -1; }
  }
  @media (max-width: 768px) {
    .ov-wrap { padding: 14px 14px 28px; }
    .kpi-row { grid-template-columns: repeat(2,1fr); }
    .ov-grid { grid-template-columns: 1fr; }
    .span-2, .mini-map-card { grid-column: span 1; }
    .donut-wrap { flex-direction: column; }
  }
</style>

<div class="ov-wrap">

  <!-- KPI Row -->
  <div class="section-label"><i class="fa-solid fa-chart-simple"></i> Key Metrics</div>
  <div class="kpi-row">
    <div class="kpi-card">
      <div class="kpi-ic" style="background:rgba(232,71,42,.1);color:var(--accent)"><i class="fa-solid fa-file-lines"></i></div>
      <div class="kpi-info">
        <p>Total Reports</p>
        <strong>47</strong>
        <div class="kpi-delta up"><i class="fa-solid fa-arrow-trend-up"></i> +5 this month</div>
      </div>
    </div>
    <div class="kpi-card">
      <div class="kpi-ic" style="background:rgba(217,119,6,.1);color:var(--amber)"><i class="fa-solid fa-hourglass-half"></i></div>
      <div class="kpi-info">
        <p>Pending Review</p>
        <strong>18</strong>
        <div class="kpi-delta down"><i class="fa-solid fa-arrow-trend-down"></i> -2 since last week</div>
      </div>
    </div>
    <div class="kpi-card">
      <div class="kpi-ic" style="background:rgba(37,99,235,.1);color:var(--blue)"><i class="fa-solid fa-magnifying-glass"></i></div>
      <div class="kpi-info">
        <p>Investigating</p>
        <strong>21</strong>
        <div class="kpi-delta up"><i class="fa-solid fa-arrow-trend-up"></i> +3 this week</div>
      </div>
    </div>
    <div class="kpi-card">
      <div class="kpi-ic" style="background:rgba(22,163,74,.1);color:var(--green)"><i class="fa-solid fa-circle-check"></i></div>
      <div class="kpi-info">
        <p>Resolved</p>
        <strong>12</strong>
        <div class="kpi-delta up"><i class="fa-solid fa-arrow-trend-up"></i> +4 this month</div>
      </div>
    </div>
    <div class="kpi-card">
      <div class="kpi-ic" style="background:rgba(220,38,38,.1);color:var(--red)"><i class="fa-solid fa-ban"></i></div>
      <div class="kpi-info">
        <p>Denied</p>
        <strong>8</strong>
        <div class="kpi-delta flat"><i class="fa-solid fa-minus"></i> No change</div>
      </div>
    </div>
    <div class="kpi-card">
      <div class="kpi-ic" style="background:rgba(124,58,237,.1);color:var(--purple)"><i class="fa-solid fa-user-tie"></i></div>
      <div class="kpi-info">
        <p>Active Staff</p>
        <strong>6</strong>
        <div class="kpi-delta flat"><i class="fa-solid fa-minus"></i> Full capacity</div>
      </div>
    </div>
  </div>

  <!-- Main Grid -->
  <div class="section-label"><i class="fa-solid fa-table-cells-large"></i> Overview Panels</div>
  <div class="ov-grid">

    <!-- Report Status Donut -->
    <div class="card">
      <div class="card-head">
        <h3><i class="fa-solid fa-chart-pie"></i> Report Status Breakdown</h3>
        <button class="link-btn" onclick="goTo('reports')"><i class="fa-solid fa-arrow-right"></i> All Reports</button>
      </div>
      <div class="card-body">
        <div class="donut-wrap">
          <svg class="donut-svg" width="110" height="110" viewBox="0 0 42 42">
            <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="#f4f5f7" stroke-width="5"/>
            <!-- Investigating: 21/47 = 44.7% -->
            <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--blue)"  stroke-width="5" stroke-dasharray="44.7 55.3" stroke-dashoffset="25" stroke-linecap="round"/>
            <!-- Pending: 18/47 = 38.3% -->
            <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--amber)" stroke-width="5" stroke-dasharray="38.3 61.7" stroke-dashoffset="-19.7" stroke-linecap="round"/>
            <!-- Resolved: 12/47 = 25.5% -->
            <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--green)" stroke-width="5" stroke-dasharray="25.5 74.5" stroke-dashoffset="-58" stroke-linecap="round"/>
            <!-- Denied: 8/47 = 17% -->
            <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--red)"   stroke-width="5" stroke-dasharray="17 83" stroke-dashoffset="-83.5" stroke-linecap="round"/>
            <text x="21" y="19" text-anchor="middle" font-size="6" font-weight="700" fill="#1a1d23" font-family="Arial">47</text>
            <text x="21" y="25" text-anchor="middle" font-size="3.5" fill="#7a8094" font-family="Arial">TOTAL</text>
          </svg>
          <div class="donut-legend">
            <div class="dl-row"><div class="dl-label"><div class="dl-dot" style="background:var(--blue)"></div>Investigating</div><div class="dl-val">21</div><div class="dl-pct">44.7%</div></div>
            <div class="dl-row"><div class="dl-label"><div class="dl-dot" style="background:var(--amber)"></div>Pending</div><div class="dl-val">18</div><div class="dl-pct">38.3%</div></div>
            <div class="dl-row"><div class="dl-label"><div class="dl-dot" style="background:var(--green)"></div>Resolved</div><div class="dl-val">12</div><div class="dl-pct">25.5%</div></div>
            <div class="dl-row"><div class="dl-label"><div class="dl-dot" style="background:var(--red)"></div>Denied</div><div class="dl-val">8</div><div class="dl-pct">17.0%</div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Reports by Area -->
    <div class="card">
      <div class="card-head">
        <h3><i class="fa-solid fa-location-dot"></i> Reports by Area</h3>
        <button class="link-btn" onclick="goTo('map')"><i class="fa-solid fa-map"></i> Map View</button>
      </div>
      <div class="card-body">
        <div class="bar-chart" id="areaBarChart"></div>
      </div>
    </div>

    <!-- Source Breakdown -->
    <div class="card">
      <div class="card-head">
        <h3><i class="fa-solid fa-mobile-screen"></i> Report Sources</h3>
      </div>
      <div class="card-body">
        <div class="source-row">
          <div class="src-ic" style="background:rgba(232,71,42,.1);color:var(--accent)"><i class="fa-solid fa-mobile-screen"></i></div>
          <div class="src-info">
            <div class="src-name">Mobile App</div>
            <div class="src-sub">Anti-Squatting Android App</div>
          </div>
          <div class="src-count">31</div>
        </div>
        <div class="source-row">
          <div class="src-ic" style="background:rgba(124,58,237,.1);color:var(--purple)"><i class="fa-solid fa-building"></i></div>
          <div class="src-info">
            <div class="src-name">Office / Walk-in</div>
            <div class="src-sub">In-person reports logged by staff</div>
          </div>
          <div class="src-count">11</div>
        </div>
        <div class="source-row">
          <div class="src-ic" style="background:rgba(37,99,235,.1);color:var(--blue)"><i class="fa-solid fa-phone"></i></div>
          <div class="src-info">
            <div class="src-name">Phone / Call-in</div>
            <div class="src-sub">Verbal reports logged manually</div>
          </div>
          <div class="src-count">5</div>
        </div>
        <div style="margin-top:14px">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;font-size:11px;color:var(--muted)">
            <span>App</span><span>Office</span><span>Phone</span>
          </div>
          <div style="height:8px;border-radius:4px;overflow:hidden;display:flex;gap:2px">
            <div style="flex:31;background:var(--accent);border-radius:4px 0 0 4px"></div>
            <div style="flex:11;background:var(--purple)"></div>
            <div style="flex:5;background:var(--blue);border-radius:0 4px 4px 0"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Reports -->
    <div class="card span-2">
      <div class="card-head">
        <h3><i class="fa-solid fa-clock-rotate-left"></i> Recent Reports</h3>
        <button class="link-btn" onclick="goTo('reports')"><i class="fa-solid fa-arrow-right"></i> View All</button>
      </div>
      <div class="card-body" style="padding:0">
        <table class="rr-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Reporter</th>
              <th>Location</th>
              <th>Date</th>
              <th>Source</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="recentReportsBody"></tbody>
        </table>
      </div>
    </div>

    <!-- Active Investigations -->
    <div class="card">
      <div class="card-head">
        <h3><i class="fa-solid fa-magnifying-glass"></i> Active Investigations</h3>
        <button class="link-btn" onclick="goTo('investigation')"><i class="fa-solid fa-arrow-right"></i> View All</button>
      </div>
      <div class="card-body">
        <div class="inv-list" id="invList"></div>
      </div>
    </div>

    <!-- Staff Workload -->
    <div class="card">
      <div class="card-head">
        <h3><i class="fa-solid fa-users"></i> Staff Workload</h3>
      </div>
      <div class="card-body">
        <div class="staff-list" id="staffList"></div>
      </div>
    </div>

    <!-- Activity Feed -->
    <div class="card">
      <div class="card-head">
        <h3><i class="fa-solid fa-bell"></i> Recent Activity</h3>
      </div>
      <div class="card-body" style="padding:0 16px">
        <div class="activity-feed" id="activityFeed"></div>
      </div>
    </div>

    <!-- Area Hotspot Table -->
    <div class="card span-2">
      <div class="card-head">
        <h3><i class="fa-solid fa-fire"></i> Hotspot Areas</h3>
        <button class="link-btn" onclick="goTo('map')"><i class="fa-solid fa-map-location-dot"></i> Open Map</button>
      </div>
      <div class="card-body" style="padding:0">
        <table class="heat-table">
          <thead>
            <tr>
              <th>#</th><th>Area / Municipality</th><th>Reports</th><th>Active Inv.</th><th>Resolved</th><th>Incident Rate</th>
            </tr>
          </thead>
          <tbody id="hotspotBody"></tbody>
        </table>
      </div>
    </div>

    <!-- Mini Map -->
    <div class="card">
      <div class="card-head">
        <h3><i class="fa-solid fa-map-location-dot"></i> Incident Map Preview</h3>
        <button class="link-btn" onclick="goTo('map')"><i class="fa-solid fa-expand"></i> Full Map</button>
      </div>
      <div style="position:relative">
        <div id="ovMiniMap"></div>
      </div>
    </div>

  </div>

</div><!-- /.ov-wrap -->

<!-- Toast -->
<div style="position:fixed;bottom:22px;right:22px;z-index:1080;display:flex;flex-direction:column;gap:8px" id="toastWrap"></div>

<script>
/* ── Static Data ── */
const RECENT_REPORTS = [
  { id:'RPT-2025-001', reporter:'Maria Santos',     initials:'MS', location:'Barangay Tondo, Manila',  date:'Jul 14', source:'app',    status:'active'  },
  { id:'RPT-2025-002', reporter:'Anonymous',        initials:'?',  location:'Pasig City',              date:'Jul 12', source:'app',    status:'pending' },
  { id:'RPT-2025-003', reporter:'Jose Reyes',       initials:'JR', location:'Quezon City',             date:'Jul 10', source:'office', status:'active'  },
  { id:'RPT-2025-004', reporter:'Lourdes Dela Cruz',initials:'LD', location:'Caloocan City',           date:'Jul 8',  source:'app',    status:'denied'  },
  { id:'RPT-2025-005', reporter:'Anonymous',        initials:'?',  location:'Marikina City',           date:'Jul 7',  source:'app',    status:'done'    },
  { id:'RPT-2025-006', reporter:'Rodrigo V.',       initials:'RV', location:'Valenzuela City',         date:'Jul 5',  source:'office', status:'active'  },
];

const INVESTIGATIONS = [
  { id:'INV-2025-001', location:'Barangay Tondo, Manila',  assignee:'JD', color:'#2563eb', progress:60, status:'active' },
  { id:'INV-2025-003', location:'Quezon City',             assignee:'MA', color:'#16a34a', progress:80, status:'active' },
  { id:'INV-2025-005', location:'Valenzuela City',         assignee:'LR', color:'#7c3aed', progress:40, status:'active' },
  { id:'INV-2025-006', location:'Calamba, Laguna',         assignee:'EP', color:'#d97706', progress:25, status:'active' },
  { id:'INV-2025-007', location:'Bay, Laguna',             assignee:'JD', color:'#2563eb', progress:55, status:'active' },
];

const STAFF = [
  { id:'JD', name:'Juan Dela Cruz',    role:'Field Investigator', color:'#2563eb', cases:2, status:'busy'  },
  { id:'MA', name:'Maria Aguilar',     role:'Senior Investigator',color:'#16a34a', cases:3, status:'busy'  },
  { id:'RC', name:'Roberto Cruz',      role:'Field Investigator', color:'#d97706', cases:0, status:'free'  },
  { id:'LR', name:'Lorna Reyes',       role:'Legal Officer',      color:'#7c3aed', cases:2, status:'busy'  },
  { id:'EP', name:'Eduardo Pascual',   role:'Field Investigator', color:'#dc2626', cases:1, status:'busy'  },
  { id:'SB', name:'Sandra Bautista',   role:'Community Liaison',  color:'#2563eb', cases:1, status:'busy'  },
];

const ACTIVITY = [
  { type:'blue',  icon:'fa-user-check', text:'<strong>Juan Dela Cruz</strong> submitted a field update for <strong>INV-2025-001</strong>.',  time:'5m ago' },
  { type:'green', icon:'fa-circle-check',text:'Investigation <strong>INV-2025-004</strong> marked as <strong>Completed</strong> by Admin.', time:'1h ago' },
  { type:'amber', icon:'fa-file-lines', text:'New report <strong>RPT-2025-007</strong> received from Sta. Cruz, Laguna.',                   time:'2h ago' },
  { type:'red',   icon:'fa-ban',        text:'Report <strong>RPT-2025-004</strong> denied — Occupants have valid lease agreement.',         time:'4h ago' },
  { type:'blue',  icon:'fa-paper-plane',text:'Task dispatched to <strong>Lorna Reyes</strong> for site visit in Valenzuela City.',          time:'6h ago' },
  { type:'amber', icon:'fa-file-lines', text:'New report <strong>RPT-2025-006</strong> logged via walk-in at the office.',                  time:'Yesterday' },
];

const AREA_DATA = [
  { area:'Metro Manila',    count:24, color:'var(--accent)' },
  { area:'Calamba, Laguna', count:5,  color:'var(--blue)'   },
  { area:'Sta. Cruz, Lag.', count:4,  color:'var(--amber)'  },
  { area:'Bay, Laguna',     count:3,  color:'var(--purple)' },
  { area:'Los Baños, Lag.', count:3,  color:'var(--green)'  },
  { area:'Pagsanjan, Lag.', count:2,  color:'var(--red)'    },
];

const HOTSPOTS = [
  { area:'Tondo, Manila',      reports:8, active:3, resolved:2, rate:85 },
  { area:'Quezon City',        reports:6, active:2, resolved:3, rate:72 },
  { area:'Valenzuela City',    reports:5, active:2, resolved:1, rate:68 },
  { area:'Calamba, Laguna',    reports:5, active:1, resolved:2, rate:55 },
  { area:'Pasig City',         reports:4, active:1, resolved:1, rate:45 },
  { area:'Sta. Cruz, Laguna',  reports:4, active:0, resolved:2, rate:40 },
  { area:'Bay, Laguna',        reports:3, active:1, resolved:1, rate:35 },
];

const MAP_POINTS = [
  { coords:[14.6194,120.9683], label:'Barangay Tondo',  status:'active'  },
  { coords:[14.5667,121.0750], label:'Pasig City',      status:'pending' },
  { coords:[14.6760,121.0437], label:'Quezon City',     status:'active'  },
  { coords:[14.6572,120.9847], label:'Caloocan City',   status:'denied'  },
  { coords:[14.6350,121.1028], label:'Marikina City',   status:'done'    },
  { coords:[14.6951,120.9773], label:'Valenzuela City', status:'active'  },
  { coords:[14.2817,121.4172], label:'Sta. Cruz, Lag.', status:'pending' },
  { coords:[14.2738,121.4580], label:'Pagsanjan, Lag.', status:'pending' },
  { coords:[14.2116,121.1653], label:'Calamba, Lag.',   status:'active'  },
  { coords:[14.0679,121.3248], label:'San Pablo, Lag.', status:'done'    },
  { coords:[14.1706,121.2413], label:'Los Baños, Lag.', status:'denied'  },
  { coords:[14.1781,121.2878], label:'Bay, Laguna',     status:'active'  },
];

const STATUS_COLORS = { pending:'#d97706', active:'#2563eb', done:'#16a34a', denied:'#dc2626', stopped:'#7c3aed' };
const STATUS_LABELS = { pending:'Pending', active:'Investigating', done:'Resolved', denied:'Denied', stopped:'Stopped' };
const STATUS_ICONS  = { pending:'fa-hourglass-half', active:'fa-magnifying-glass', done:'fa-circle-check', denied:'fa-ban', stopped:'fa-stop' };
const BADGE_CLASSES = { pending:'badge-pending', active:'badge-active', done:'badge-done', denied:'badge-denied', stopped:'badge-stopped' };

/* ── Recent Reports ── */
function renderRecentReports() {
  document.getElementById('recentReportsBody').innerHTML = RECENT_REPORTS.map(r => `
    <tr>
      <td style="font-size:11px;font-weight:700;color:var(--muted)">${r.id}</td>
      <td><div class="rep-cell"><div class="av-xs">${r.initials}</div><span style="font-size:12px;font-weight:700">${r.reporter}</span></div></td>
      <td style="font-size:12px;color:var(--sub)">${r.location}</td>
      <td style="font-size:12px;color:var(--muted)">${r.date}</td>
      <td>
        <span style="font-size:11px;font-weight:700;color:${r.source==='app'?'var(--accent)':'var(--purple)'}">
          <i class="fa-solid ${r.source==='app'?'fa-mobile-screen':'fa-building'}"></i>
          ${r.source==='app'?'App':'Office'}
        </span>
      </td>
      <td><span class="badge ${BADGE_CLASSES[r.status]}"><i class="fa-solid ${STATUS_ICONS[r.status]}"></i> ${STATUS_LABELS[r.status]}</span></td>
    </tr>`).join('');
}

/* ── Investigations ── */
function renderInvestigations() {
  document.getElementById('invList').innerHTML = INVESTIGATIONS.map(i => {
    const pColor = i.progress >= 70 ? 'var(--green)' : i.progress >= 40 ? 'var(--blue)' : 'var(--amber)';
    return `
    <div class="inv-item" onclick="goTo('investigation')">
      <div class="inv-av" style="background:${i.color}">${i.assignee}</div>
      <div class="inv-info">
        <div class="inv-id">${i.id}</div>
        <div class="inv-loc">${i.location}</div>
      </div>
      <div class="inv-prog-wrap">
        <div class="inv-prog-label" style="color:${pColor}">${i.progress}%</div>
        <div class="inv-prog-bar"><div class="inv-prog-fill" style="width:${i.progress}%;background:${pColor}"></div></div>
      </div>
    </div>`;
  }).join('');
}

/* ── Staff ── */
function renderStaff() {
  document.getElementById('staffList').innerHTML = STAFF.map(s => `
    <div class="staff-row">
      <div class="staff-av" style="background:${s.color}">${s.id}</div>
      <div class="staff-name-wrap">
        <div class="staff-nm">${s.name}</div>
        <div class="staff-rl">${s.role}</div>
      </div>
      <div class="staff-cases">
        <div class="staff-status-dot" style="background:${s.status==='free'?'var(--green)':'var(--amber)'}"></div>
        ${s.cases} case${s.cases !== 1 ? 's' : ''}
      </div>
    </div>`).join('');
}

/* ── Activity Feed ── */
function renderActivity() {
  const colorMap = { blue:'rgba(37,99,235,.1)', green:'rgba(22,163,74,.1)', amber:'rgba(217,119,6,.1)', red:'rgba(220,38,38,.1)' };
  const iconColorMap = { blue:'var(--blue)', green:'var(--green)', amber:'var(--amber)', red:'var(--red)' };
  document.getElementById('activityFeed').innerHTML = ACTIVITY.map(a => `
    <div class="af-item">
      <div class="af-ic" style="background:${colorMap[a.type]};color:${iconColorMap[a.type]}">
        <i class="fa-solid ${a.icon}"></i>
      </div>
      <div class="af-text">${a.text}</div>
      <div class="af-time">${a.time}</div>
    </div>`).join('');
}

/* ── Area Bar Chart ── */
function renderAreaBars() {
  const max = Math.max(...AREA_DATA.map(a => a.count));
  document.getElementById('areaBarChart').innerHTML = AREA_DATA.map(a => `
    <div class="bar-row">
      <div class="bar-label" title="${a.area}">${a.area}</div>
      <div class="bar-track">
        <div class="bar-fill" style="width:${(a.count/max)*100}%;background:${a.color}"></div>
      </div>
      <div class="bar-num">${a.count}</div>
    </div>`).join('');
}

/* ── Hotspot Table ── */
function renderHotspots() {
  const max = Math.max(...HOTSPOTS.map(h => h.reports));
  document.getElementById('hotspotBody').innerHTML = HOTSPOTS.map((h, i) => `
    <tr>
      <td style="font-size:11px;font-weight:700;color:var(--muted);width:28px">${i+1}</td>
      <td style="font-size:13px;font-weight:700">${h.area}</td>
      <td>
        <div class="heat-cell">
          <div class="heat-bar"><div class="heat-fill" style="width:${(h.reports/max)*100}%"></div></div>
          <span style="font-size:12px;font-weight:700;min-width:16px">${h.reports}</span>
        </div>
      </td>
      <td><span class="badge badge-active"><i class="fa-solid fa-magnifying-glass"></i> ${h.active}</span></td>
      <td><span class="badge badge-done"><i class="fa-solid fa-circle-check"></i> ${h.resolved}</span></td>
      <td>
        <div class="heat-cell">
          <div class="heat-bar"><div class="heat-fill" style="width:${h.rate}%;background:${h.rate>70?'var(--red)':h.rate>50?'var(--amber)':'var(--blue)'}"></div></div>
          <span style="font-size:12px;font-weight:700;color:${h.rate>70?'var(--red)':h.rate>50?'var(--amber)':'var(--blue)'}">${h.rate}%</span>
        </div>
      </td>
    </tr>`).join('');
}

/* ── Mini Map ── */
function initMiniMap() {
  const map = L.map('ovMiniMap', {
    center: [14.44, 121.07], zoom: 9,
    zoomControl: false, dragging: false,
    scrollWheelZoom: false, doubleClickZoom: false,
    touchZoom: false, keyboard: false,
    attributionControl: false,
  });

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom:19 }).addTo(map);

  MAP_POINTS.forEach(p => {
    const color = STATUS_COLORS[p.status] || '#7a8094';
    const icon = L.divIcon({
      html: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <circle cx="9" cy="9" r="6" fill="${color}" stroke="#fff" stroke-width="2.5"/>
      </svg>`,
      className: '', iconSize:[18,18], iconAnchor:[9,9], popupAnchor:[0,-9],
    });
    L.marker(p.coords, { icon })
      .bindPopup(`<div class="mini-popup"><strong>${p.label}</strong><span>${STATUS_LABELS[p.status]}</span></div>`, { maxWidth:200 })
      .addTo(map);
  });

  // Click to go full map
  map.getContainer().style.cursor = 'pointer';
  map.on('click', () => goTo('map'));
}

/* ── Nav ── */
function goTo(page) {
  const routes = {
    reports:      '/admin/reports',
    investigation:'/admin/investigation',
    map:          '/admin/map-view',
  };
  showToast('info', `<i class="fa-solid fa-arrow-right"></i> Navigating to ${page}…`);
  // Uncomment when routes are live:
  // window.location.href = routes[page];
}

/* ── Toast ── */
function showToast(type, msg) {
  const wrap = document.getElementById('toastWrap');
  const t = document.createElement('div');
  t.style.cssText = 'background:#fff;border:1px solid #e2e5ea;border-radius:9px;padding:11px 15px;font-size:13px;display:flex;align-items:center;gap:9px;box-shadow:0 4px 16px rgba(0,0,0,.1);min-width:230px;font-family:Arial,sans-serif;animation:tIn .22s ease';
  const iconBg = type==='success'?'rgba(22,163,74,.12)':type==='danger'?'rgba(220,38,38,.12)':'rgba(37,99,235,.12)';
  const iconC  = type==='success'?'#16a34a':type==='danger'?'#dc2626':'#2563eb';
  const iconI  = type==='success'?'fa-check':type==='danger'?'fa-xmark':'fa-info';
  t.innerHTML = `<div style="width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:${iconBg};color:${iconC};font-size:11px;flex-shrink:0"><i class="fa-solid ${iconI}"></i></div><span>${msg}</span>`;
  wrap.appendChild(t);
  setTimeout(() => t.remove(), 3800);
}

/* ── Init ── */
window.addEventListener('DOMContentLoaded', () => {
  renderRecentReports();
  renderInvestigations();
  renderStaff();
  renderActivity();
  renderAreaBars();
  renderHotspots();
  initMiniMap();
});
</script>

@endsection