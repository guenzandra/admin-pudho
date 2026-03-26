@extends('admin.layout')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  *,
  *::before,
  *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  :root {
    --red: #D0172B;
    --red-2: #b01020;
    --red-soft: #fff0f2;
    --red-mid: #fcc9cf;
    --ink: #18181b;
    --ink-2: #3f3f46;
    --ink-3: #71717a;
    --ink-4: #a1a1aa;
    --line: #e4e4e7;
    --line-2: #f4f4f5;
    --surface: #ffffff;
    --page: #f7f7f8;
    --green: #16a34a;
    --green-bg: #f0fdf4;
    --amber: #d97706;
    --amber-bg: #fffbeb;
    --blue: #2563eb;
    --blue-bg: #eff6ff;
    --r: 10px;
    --r-sm: 7px;
    --sh: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
    --sh-md: 0 4px 14px rgba(0, 0, 0, .09);
    --font: 'DM Sans', Arial, sans-serif;
  }

  .db {
    font-family: var(--font);
    background: var(--page);
    padding: 0;
    min-height: 100vh;
    color: var(--ink);
  }

  /* ── PAGE INTRO ── */
  .db-intro {
    margin-bottom: 22px;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
  }

  .db-intro-title {
    font-size: 21px;
    font-weight: 700;
    color: var(--ink);
    letter-spacing: -.4px;
  }

  .db-intro-sub {
    font-size: 13px;
    color: var(--ink-3);
    margin-top: 3px;
  }

  .db-live {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--ink-3);
    font-weight: 500;
  }

  .db-live-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--green);
    box-shadow: 0 0 0 3px #dcfce7;
  }

  /* ── TOOLBAR ── */
  .toolbar {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--r);
    padding: 14px 18px;
    margin-bottom: 28px;
    box-shadow: var(--sh);
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .tb-top {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  .tb-bottom {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    padding-top: 10px;
    border-top: 1px solid var(--line-2);
  }

  .search-wrap {
    position: relative;
    flex: 1;
    min-width: 200px;
    max-width: 300px;
  }

  .search-wrap .si {
    position: absolute;
    left: 11px;
    top: 50%;
    transform: translateY(-50%);
    width: 15px;
    height: 15px;
    stroke: var(--ink-4);
    pointer-events: none;
    flex-shrink: 0;
  }

  .search-input {
    width: 100%;
    font-family: var(--font);
    font-size: 13px;
    padding: 9px 10px 9px 34px;
    border: 1px solid var(--line);
    border-radius: var(--r-sm);
    background: var(--page);
    color: var(--ink);
    outline: none;
    transition: border-color .15s, box-shadow .15s;
  }

  .search-input::placeholder {
    color: var(--ink-4);
  }

  .search-input:focus {
    border-color: var(--red);
    box-shadow: 0 0 0 3px rgba(208, 23, 43, .1);
  }

  .tb-label {
    font-size: 11px;
    font-weight: 700;
    color: var(--ink-4);
    text-transform: uppercase;
    letter-spacing: .5px;
    white-space: nowrap;
  }

  .tb-sep {
    width: 1px;
    height: 26px;
    background: var(--line);
    flex-shrink: 0;
  }

  .tb-select {
    font-family: var(--font);
    font-size: 12.5px;
    color: var(--ink-2);
    background: var(--page);
    border: 1px solid var(--line);
    border-radius: var(--r-sm);
    padding: 8px 10px;
    outline: none;
    cursor: pointer;
    transition: border-color .15s;
    min-width: 130px;
  }

  .tb-select:focus {
    border-color: var(--red);
  }

  .tb-tags {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    flex: 1;
    align-items: center;
  }

  .tb-tag {
    font-family: var(--font);
    font-size: 12px;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 99px;
    cursor: pointer;
    border: 1px solid var(--line);
    background: var(--page);
    color: var(--ink-3);
    transition: all .15s;
  }

  .tb-tag:hover {
    border-color: var(--red);
    color: var(--red);
    background: var(--red-soft);
  }

  .tb-tag.active {
    background: var(--red);
    color: #fff;
    border-color: var(--red);
  }

  .tb-btn {
    font-family: var(--font);
    font-size: 12.5px;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: var(--r-sm);
    cursor: pointer;
    border: none;
    transition: background .15s, transform .1s;
    white-space: nowrap;
  }

  .tb-btn:active {
    transform: scale(.97);
  }

  .tb-btn-p {
    background: var(--red);
    color: #fff;
  }

  .tb-btn-p:hover {
    background: var(--red-2);
  }

  .tb-btn-g {
    background: transparent;
    color: var(--ink-3);
    border: 1px solid var(--line);
  }

  .tb-btn-g:hover {
    background: var(--line-2);
  }

  /* ── SECTION HEADER ── */
  .sh {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
  }

  .sh-title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--ink-3);
    white-space: nowrap;
  }

  .sh-line {
    flex: 1;
    height: 1px;
    background: var(--line);
  }

  /* ── METRIC CARDS ── */
  .metrics {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 28px;
  }

  .mc {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--r);
    padding: 20px;
    box-shadow: var(--sh);
    transition: transform .18s, box-shadow .18s;
    animation: fadeSlide .4s ease both;
  }

  .mc:hover {
    transform: translateY(-2px);
    box-shadow: var(--sh-md);
  }

  .mc:nth-child(1) {
    animation-delay: .05s
  }

  .mc:nth-child(2) {
    animation-delay: .10s
  }

  .mc:nth-child(3) {
    animation-delay: .15s
  }

  .mc:nth-child(4) {
    animation-delay: .20s
  }

  .mc-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 14px;
  }

  .mc-icon {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .mc-icon svg {
    width: 18px;
    height: 18px;
  }

  .ic-r {
    background: var(--red-soft);
  }

  .ic-r svg {
    stroke: var(--red);
  }

  .ic-n {
    background: var(--line-2);
  }

  .ic-n svg {
    stroke: var(--ink-3);
  }

  .ic-g {
    background: var(--green-bg);
  }

  .ic-g svg {
    stroke: var(--green);
  }

  .ic-a {
    background: var(--amber-bg);
  }

  .ic-a svg {
    stroke: var(--amber);
  }

  .mc-badge {
    font-size: 10px;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 99px;
  }

  .mb-r {
    background: var(--red-soft);
    color: var(--red);
    border: 1px solid var(--red-mid);
  }

  .mb-g {
    background: var(--green-bg);
    color: var(--green);
    border: 1px solid #bbf7d0;
  }

  .mb-a {
    background: var(--amber-bg);
    color: var(--amber);
    border: 1px solid #fde68a;
  }

  .mb-n {
    background: var(--line-2);
    color: var(--ink-3);
    border: 1px solid var(--line);
  }

  .mc-label {
    font-size: 11.5px;
    color: var(--ink-3);
    font-weight: 500;
    margin-bottom: 4px;
  }

  .mc-value {
    font-size: 32px;
    font-weight: 700;
    color: var(--ink);
    line-height: 1;
    letter-spacing: -1.5px;
  }

  .mc-value-r {
    color: var(--red);
  }

  .mc-delta {
    font-size: 11.5px;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 3px;
    font-weight: 500;
  }

  .dd-up {
    color: var(--green);
  }

  .dd-dn {
    color: var(--red);
  }

  .dd-n {
    color: var(--ink-4);
  }

  .mc-red-border {
    border-left: 3px solid var(--red);
  }

  /* ── CARD ── */
  .card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--r);
    box-shadow: var(--sh);
    overflow: hidden;
  }

  .ch {
    padding: 16px 20px 14px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    border-bottom: 1px solid var(--line-2);
    flex-wrap: wrap;
  }

  .ch-l .ch-title {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--ink);
  }

  .ch-l .ch-sub {
    font-size: 11px;
    color: var(--ink-4);
    margin-top: 2px;
  }

  .cb {
    padding: 16px 20px 20px;
  }

  .c-sel {
    font-family: var(--font);
    font-size: 11.5px;
    color: var(--ink-3);
    background: var(--page);
    border: 1px solid var(--line);
    border-radius: var(--r-sm);
    padding: 5px 9px;
    outline: none;
    cursor: pointer;
    transition: border-color .15s;
    flex-shrink: 0;
  }

  .c-sel:focus {
    border-color: var(--red);
  }

  /* ── LAYOUT ROWS ── */
  .row-3 {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 28px;
  }

  .row-6-4 {
    display: grid;
    grid-template-columns: minmax(0, 1.55fr) minmax(0, 1fr);
    gap: 14px;
    margin-bottom: 28px;
  }

  .row-5-5 {
    display: grid;
    grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
    gap: 14px;
  }

  /* ── LEGEND ── */
  .legend {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 12px;
  }

  .li {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11.5px;
    color: var(--ink-3);
  }

  .ld {
    width: 9px;
    height: 9px;
    border-radius: 2px;
    flex-shrink: 0;
  }

  /* ── DONUT STATS ── */
  .d-stats {
    display: flex;
    gap: 6px;
    margin-top: 12px;
  }

  .ds {
    flex: 1;
    background: var(--page);
    border: 1px solid var(--line);
    border-radius: var(--r-sm);
    padding: 9px 10px;
    text-align: center;
  }

  .ds-lbl {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .4px;
    color: var(--ink-4);
  }

  .ds-val {
    font-size: 19px;
    font-weight: 700;
    margin-top: 2px;
  }

  .dsv-r {
    color: var(--red);
  }

  .dsv-g {
    color: var(--green);
  }

  .dsv-n {
    color: var(--ink-2);
  }

  /* ── GAUGE ── */
  .gauge-wrap {
    position: relative;
  }

  .gauge-ctr {
    position: absolute;
    bottom: 6%;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    pointer-events: none;
  }

  .gauge-pct {
    font-size: 28px;
    font-weight: 700;
    color: var(--red);
    line-height: 1;
  }

  .gauge-desc {
    font-size: 10px;
    color: var(--ink-4);
    margin-top: 2px;
    white-space: nowrap;
  }

  .rate-pills {
    display: flex;
    gap: 7px;
    margin-top: 10px;
  }

  .rp {
    flex: 1;
    background: var(--page);
    border: 1px solid var(--line);
    border-radius: var(--r-sm);
    padding: 8px 10px;
  }

  .rp-lbl {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .4px;
    color: var(--ink-4);
  }

  .rp-val {
    font-size: 15px;
    font-weight: 700;
    color: var(--ink);
    margin-top: 2px;
  }

  .rp-val-r {
    color: var(--red);
  }

  /* ── MUNI BARS ── */
  .muni-item {
    padding: 11px 0;
    border-bottom: 1px solid var(--line-2);
  }

  .muni-item:last-child {
    border-bottom: none;
  }

  .muni-r1 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 6px;
  }

  .muni-name {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--ink);
  }

  .muni-chips {
    display: flex;
    gap: 8px;
  }

  .mc-chip {
    font-size: 11px;
    color: var(--ink-3);
  }

  .mc-chip b {
    color: var(--ink-2);
  }

  .mc-chip-r b {
    color: var(--red);
  }

  .btrack {
    height: 5px;
    background: var(--line-2);
    border-radius: 3px;
    overflow: hidden;
  }

  .btrack+.btrack {
    margin-top: 3px;
  }

  .bfill {
    height: 100%;
    border-radius: 3px;
    transition: width .65s cubic-bezier(.4, 0, .2, 1);
  }

  .bf-n {
    background: var(--ink-3);
  }

  .bf-r {
    background: var(--red);
  }

  /* ── STAFF ── */
  .staff-item {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 10px 0;
    border-bottom: 1px solid var(--line-2);
  }

  .staff-item:last-child {
    border-bottom: none;
  }

  .av {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    font-size: 11.5px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .av-r {
    background: #fde8ea;
    color: var(--red);
  }

  .av-b {
    background: #dbeafe;
    color: #1d4ed8;
  }

  .av-g {
    background: #dcfce7;
    color: #15803d;
  }

  .av-a {
    background: #fef9c3;
    color: #a16207;
  }

  .av-p {
    background: #ede9fe;
    color: #6d28d9;
  }

  .s-name {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--ink);
  }

  .s-role {
    font-size: 11px;
    color: var(--ink-4);
    margin-top: 1px;
  }

  .s-right {
    margin-left: auto;
    text-align: right;
    flex-shrink: 0;
  }

  .s-cnt {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--ink);
  }

  .s-loc {
    font-size: 10.5px;
    color: var(--ink-4);
    margin-top: 1px;
  }

  /* ── POSTS ── */
  .post-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--line-2);
  }

  .post-item:last-child {
    border-bottom: none;
  }

  .pbar {
    width: 3px;
    height: 38px;
    border-radius: 2px;
    flex-shrink: 0;
  }

  .pb-g {
    background: var(--green);
  }

  .pb-a {
    background: var(--amber);
  }

  .pb-r {
    background: var(--red);
  }

  .pb-b {
    background: var(--blue);
  }

  .p-title {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.4;
  }

  .p-meta {
    font-size: 11px;
    color: var(--ink-4);
    margin-top: 2px;
  }

  /* ── PROGRESS ── */
  .prg-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 0;
    border-bottom: 1px solid var(--line-2);
  }

  .prg-item:last-child {
    border-bottom: none;
  }

  .prg-name {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--ink);
    width: 90px;
    flex-shrink: 0;
  }

  .prg-track {
    flex: 1;
    height: 7px;
    background: var(--line-2);
    border-radius: 4px;
    overflow: hidden;
  }

  .prg-fill {
    height: 100%;
    border-radius: 4px;
    transition: width .6s ease;
  }

  .prg-pct {
    font-size: 12px;
    font-weight: 700;
    color: var(--ink-2);
    width: 34px;
    text-align: right;
    flex-shrink: 0;
  }

  .prg-summary {
    display: flex;
    gap: 8px;
    margin-top: 14px;
  }

  .ps {
    flex: 1;
    border-radius: var(--r-sm);
    padding: 10px 12px;
  }

  .ps-r {
    background: var(--red-soft);
    border: 1px solid var(--red-mid);
  }

  .ps-g {
    background: var(--green-bg);
    border: 1px solid #bbf7d0;
  }

  .ps-n {
    background: var(--line-2);
    border: 1px solid var(--line);
  }

  .ps-lbl {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .4px;
  }

  .psl-r {
    color: var(--red);
  }

  .psl-g {
    color: var(--green);
  }

  .psl-n {
    color: var(--ink-4);
  }

  .ps-val {
    font-size: 20px;
    font-weight: 700;
    margin-top: 2px;
  }

  .psv-r {
    color: var(--red);
  }

  .psv-g {
    color: var(--green);
  }

  .psv-n {
    color: var(--ink-2);
  }

  /* ── BADGE ── */
  .badge {
    display: inline-flex;
    align-items: center;
    font-size: 10px;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 99px;
    text-transform: uppercase;
    letter-spacing: .3px;
    white-space: nowrap;
  }

  .bg-r {
    background: var(--red-soft);
    color: var(--red);
    border: 1px solid var(--red-mid);
  }

  .bg-g {
    background: var(--green-bg);
    color: var(--green);
    border: 1px solid #bbf7d0;
  }

  .bg-a {
    background: var(--amber-bg);
    color: var(--amber);
    border: 1px solid #fde68a;
  }

  .bg-b {
    background: var(--blue-bg);
    color: var(--blue);
    border: 1px solid #bfdbfe;
  }

  .bg-n {
    background: var(--line-2);
    color: var(--ink-3);
    border: 1px solid var(--line);
  }

  /* ── EMPTY STATE ── */
  .empty {
    font-size: 13px;
    color: var(--ink-4);
    padding: 14px 0;
  }

  /* ── ANIMATIONS ── */
  @keyframes fadeSlide {
    from {
      opacity: 0;
      transform: translateY(8px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* ── RESPONSIVE ── */
  @media (max-width:1100px) {
    .metrics {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .row-3,
    .row-6-4,
    .row-5-5 {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width:640px) {
    .db {
      padding: 18px 16px 40px;
    }

    .metrics {
      grid-template-columns: 1fr;
    }

    .search-wrap {
      max-width: 100%;
    }
  }
</style>

<div class="db">

  {{-- ── INTRO ──────────────────────────────────────────── --}}
  <div class="db-intro">
    <div>
      <div class="db-intro-title">Dashboard Overview</div>
    </div>
  </div>

  {{-- ── TOOLBAR ─────────────────────────────────────────── --}}
  <div class="toolbar">

    {{-- top row: search + period + apply --}}
    <div class="tb-top">
      <div class="search-wrap">
        <svg class="si" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input class="search-input" id="globalSearch" type="text"
          placeholder="Search residents, cases, reports, staff…"
          oninput="handleSearch(this.value)">
      </div>

      <div class="tb-sep"></div>

      <span class="tb-label">Period</span>
      <select class="tb-select" id="fPeriod" onchange="applyFilters()">
        <option value="month">This Month</option>
        <option value="last">Last Month</option>
        <option value="q1">Q1 2026</option>
        <option value="q4">Q4 2025</option>
        <option value="ytd">Year to Date</option>
      </select>

      <div class="tb-sep"></div>

      <span class="tb-label">Source</span>
      <select class="tb-select" id="fSource" onchange="applyFilters()">
        <option value="">All Sources</option>
        <option value="app">App</option>
        <option value="municipality">Municipality</option>
        <option value="field">Field Officer</option>
      </select>

      <div style="margin-left:auto; display:flex; gap:8px;">
        <button class="tb-btn tb-btn-p" onclick="applyFilters()">Apply</button>
        <button class="tb-btn tb-btn-g" onclick="resetFilters()">Reset</button>
      </div>
    </div>

    {{-- bottom row: quick-filter pills --}}
    <div class="tb-bottom">
      <span class="tb-label">Municipality</span>
      <div class="tb-tags" id="muniTags">
        <button class="tb-tag active" onclick="tagClick(this,'')">All</button>
        <button class="tb-tag" onclick="tagClick(this,'Calamba')">Calamba</button>
        <button class="tb-tag" onclick="tagClick(this,'San Pedro')">San Pedro</button>
        <button class="tb-tag" onclick="tagClick(this,'Biñan')">Biñan</button>
        <button class="tb-tag" onclick="tagClick(this,'Santa Rosa')">Santa Rosa</button>
        <button class="tb-tag" onclick="tagClick(this,'Cabuyao')">Cabuyao</button>
        <button class="tb-tag" onclick="tagClick(this,'Calauan')">Calauan</button>
      </div>
      <div class="tb-sep"></div>
      <span class="tb-label">Status</span>
      <div class="tb-tags" id="statusTags">
        <button class="tb-tag active" onclick="statusClick(this,'')">All</button>
        <button class="tb-tag" onclick="statusClick(this,'confirmed')">Confirmed</button>
        <button class="tb-tag" onclick="statusClick(this,'review')">Pending</button>
        <button class="tb-tag" onclick="statusClick(this,'resolved')">Resolved</button>
        <button class="tb-tag" onclick="statusClick(this,'rejected')">Rejected</button>
      </div>
    </div>

  </div>

  {{-- ── METRIC CARDS ─────────────────────────────────────── --}}
  <div class="sh"><span class="sh-title">Overview</span>
    <div class="sh-line"></div>
  </div>
  <div class="metrics">

    <div class="mc">
      <div class="mc-top">
        <div class="mc-icon ic-n">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
        </div>
        <span class="mc-badge mb-g">+3.2%</span>
      </div>
      <div class="mc-label">Registered Residents</div>
      <div class="mc-value">12,234</div>
      <div class="mc-delta dd-up">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="18 15 12 9 6 15" />
        </svg>
        245 added this month
      </div>
    </div>

    <div class="mc mc-red-border">
      <div class="mc-top">
        <div class="mc-icon ic-r">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg>
        </div>
        <span class="mc-badge mb-r">Alert</span>
      </div>
      <div class="mc-label">Illegal Squatters</div>
      <div class="mc-value mc-value-r">500</div>
      <div class="mc-delta dd-dn">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="6 9 12 15 18 9" />
        </svg>
        +12 new cases this week
      </div>
    </div>

    <div class="mc">
      <div class="mc-top">
        <div class="mc-icon ic-a">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
            <line x1="16" y1="13" x2="8" y2="13" />
            <line x1="16" y1="17" x2="8" y2="17" />
          </svg>
        </div>
        <span class="mc-badge mb-a">+58</span>
      </div>
      <div class="mc-label">Total Reports Filed</div>
      <div class="mc-value">1,847</div>
      <div class="mc-delta dd-up">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="18 15 12 9 6 15" />
        </svg>
        58 new this week
      </div>
    </div>

    <div class="mc">
      <div class="mc-top">
        <div class="mc-icon ic-g">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
          </svg>
        </div>
        <span class="mc-badge mb-n">Active</span>
      </div>
      <div class="mc-label">Under Investigation</div>
      <div class="mc-value">134</div>
      <div class="mc-delta dd-n">23 resolved this week</div>
    </div>

  </div>

  {{-- ── RATE CHARTS ──────────────────────────────────────── --}}
  <div class="sh"><span class="sh-title">Rate Visualizations</span>
    <div class="sh-line"></div>
  </div>
  <div class="row-3">

    <div class="card">
      <div class="ch">
        <div class="ch-l">
          <div class="ch-title">Monthly Report Volume</div>
          <div class="ch-sub">App vs Municipality submissions</div>
        </div>
        <select class="c-sel" onchange="updateVolChart(this.value)">
          <option value="6">Last 6 months</option>
          <option value="3">Last 3 months</option>
          <option value="12">All year</option>
        </select>
      </div>
      <div class="cb">
        <div class="legend">
          <div class="li">
            <div class="ld" style="background:var(--red)"></div>App reports
          </div>
          <div class="li">
            <div class="ld" style="background:var(--ink-4)"></div>Municipality
          </div>
        </div>
        <div style="position:relative;width:100%;height:160px"><canvas id="chartVol"></canvas></div>
      </div>
    </div>

    <div class="card">
      <div class="ch">
        <div class="ch-l">
          <div class="ch-title">Case Breakdown</div>
          <div class="ch-sub">Confirmed · Pending · Resolved</div>
        </div>
        <select class="c-sel">
          <option>All time</option>
          <option>This month</option>
        </select>
      </div>
      <div class="cb">
        <div style="position:relative;width:100%;height:125px"><canvas id="chartDonut"></canvas></div>
        <div class="d-stats">
          <div class="ds">
            <div class="ds-lbl">Confirmed</div>
            <div class="ds-val dsv-r">312</div>
          </div>
          <div class="ds">
            <div class="ds-lbl">Pending</div>
            <div class="ds-val dsv-n">188</div>
          </div>
          <div class="ds">
            <div class="ds-lbl">Resolved</div>
            <div class="ds-val dsv-g">89</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="ch">
        <div class="ch-l">
          <div class="ch-title">Squatter Rate</div>
          <div class="ch-sub">% of registered residents</div>
        </div>
        <span class="badge bg-r">High Alert</span>
      </div>
      <div class="cb">
        <div class="gauge-wrap" style="position:relative;width:100%;height:125px">
          <canvas id="chartGauge"></canvas>
          <div class="gauge-ctr">
            <div class="gauge-pct">4.09%</div>
            <div class="gauge-desc">of residents</div>
          </div>
        </div>
        <div class="rate-pills">
          <div class="rp">
            <div class="rp-lbl">Province avg</div>
            <div class="rp-val">3.12%</div>
          </div>
          <div class="rp">
            <div class="rp-lbl">YoY change</div>
            <div class="rp-val rp-val-r">+0.4%</div>
          </div>
          <div class="rp">
            <div class="rp-lbl">Highest</div>
            <div class="rp-val">Calamba</div>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- ── MUNICIPALITY + STAFF ─────────────────────────────── --}}
  <div class="sh"><span class="sh-title">Municipality & Staff</span>
    <div class="sh-line"></div>
  </div>
  <div class="row-6-4">

    <div class="card">
      <div class="ch">
        <div class="ch-l">
          <div class="ch-title">Residents & Cases per Municipality</div>
          <div class="ch-sub">Dual bar — residents vs squatter cases</div>
        </div>
        <select class="c-sel" onchange="sortMunis(this.value)">
          <option value="residents">Sort: Residents</option>
          <option value="cases">Sort: Cases</option>
          <option value="rate">Sort: Rate</option>
        </select>
      </div>
      <div class="cb">
        <div class="legend">
          <div class="li">
            <div class="ld" style="background:var(--ink-3)"></div>Residents (scaled)
          </div>
          <div class="li">
            <div class="ld" style="background:var(--red)"></div>Squatter cases
          </div>
        </div>
        <div id="muniList"></div>
      </div>
    </div>

    <div class="card">
      <div class="ch">
        <div class="ch-l">
          <div class="ch-title">Staff Assignments</div>
          <div class="ch-sub">Editors · Inspectors · Investigators</div>
        </div>
        <select class="c-sel" onchange="filterStaff(this.value)">
          <option value="">All roles</option>
          <option>Field Inspector</option>
          <option>Investigator</option>
          <option>Editor</option>
        </select>
      </div>
      <div class="cb" id="staffList"></div>
    </div>

  </div>

  {{-- ── POSTS + PROGRESS ─────────────────────────────────── --}}
  <div class="sh"><span class="sh-title">Content & Investigation Reports</span>
    <div class="sh-line"></div>
  </div>
  <div class="row-5-5">

    <div class="card">
      <div class="ch">
        <div class="ch-l">
          <div class="ch-title">Posts & Content Status</div>
          <div class="ch-sub">Published, drafts, and pending content</div>
        </div>
        <div style="display:flex;gap:7px;flex-wrap:wrap;">
          <select class="c-sel" id="pStatusF" onchange="renderPosts()">
            <option value="">All statuses</option>
            <option value="published">Published</option>
            <option value="review">Pending review</option>
            <option value="draft">Draft</option>
            <option value="rejected">Rejected</option>
          </select>
          <select class="c-sel" id="pAuthorF" onchange="renderPosts()">
            <option value="">All authors</option>
            <option value="field">Field Officers</option>
            <option value="editor">Editors</option>
          </select>
        </div>
      </div>
      <div class="cb" id="postsList"></div>
    </div>

    <div class="card">
      <div class="ch">
        <div class="ch-l">
          <div class="ch-title">Investigation Progress</div>
          <div class="ch-sub">Visitation completion rate</div>
        </div>
        <select class="c-sel" onchange="filterProgress(this.value)">
          <option value="">All municipalities</option>
          <option>Calamba</option>
          <option>San Pedro</option>
          <option>Biñan</option>
          <option>Santa Rosa</option>
          <option>Cabuyao</option>
          <option>Calauan</option>
        </select>
      </div>
      <div class="cb">
        <div id="progressList"></div>
        <div class="prg-summary">
          <div class="ps ps-r">
            <div class="ps-lbl psl-r">Pending</div>
            <div class="ps-val psv-r">34</div>
          </div>
          <div class="ps ps-g">
            <div class="ps-lbl psl-g">Closed</div>
            <div class="ps-val psv-g">89</div>
          </div>
          <div class="ps ps-n">
            <div class="ps-lbl psl-n">Done</div>
            <div class="ps-val psv-n">68%</div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>{{-- end .db --}}

{{-- ── SCRIPTS ────────────────────────────────────────────── --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
  /* date */
  (function() {
    const e = document.getElementById('dbDate');
    if (e) e.textContent = new Date().toLocaleDateString('en-PH', {
      dateStyle: 'long'
    });
  })();

  /* data */
  const MUNIS = [{
      name: 'Calamba',
      residents: 3200,
      cases: 120,
      resolved: 42
    },
    {
      name: 'San Pedro',
      residents: 2800,
      cases: 95,
      resolved: 38
    },
    {
      name: 'Biñan',
      residents: 2100,
      cases: 87,
      resolved: 29
    },
    {
      name: 'Santa Rosa',
      residents: 1900,
      cases: 74,
      resolved: 31
    },
    {
      name: 'Cabuyao',
      residents: 1400,
      cases: 58,
      resolved: 20
    },
    {
      name: 'Calauan',
      residents: 830,
      cases: 40,
      resolved: 12
    },
  ];
  const STAFF = [{
      initials: 'MR',
      name: 'Reyes, Manny',
      role: 'Field Inspector',
      muni: 'Calamba',
      cases: 28,
      av: 'av-r'
    },
    {
      initials: 'JS',
      name: 'Santos, Joan',
      role: 'Editor',
      muni: 'San Pedro',
      cases: 14,
      av: 'av-b'
    },
    {
      initials: 'AC',
      name: 'Cruz, Aldo',
      role: 'Field Inspector',
      muni: 'Biñan',
      cases: 22,
      av: 'av-g'
    },
    {
      initials: 'LB',
      name: 'Bautista, Lea',
      role: 'Investigator',
      muni: 'Santa Rosa',
      cases: 19,
      av: 'av-a'
    },
    {
      initials: 'PG',
      name: 'Garcia, Paolo',
      role: 'Editor',
      muni: 'Cabuyao',
      cases: 9,
      av: 'av-p'
    },
    {
      initials: 'RM',
      name: 'Molina, Rico',
      role: 'Investigator',
      muni: 'Calauan',
      cases: 11,
      av: 'av-r'
    },
  ];
  const POSTS = [{
      title: 'Barangay notice: illegal settlers Sitio Mabini',
      status: 'published',
      bar: 'pb-g',
      meta: 'Published · 2h ago',
      type: 'field'
    },
    {
      title: 'Investigation update: 12 cases Calamba South',
      status: 'review',
      bar: 'pb-a',
      meta: 'Pending review · 4h ago',
      type: 'editor'
    },
    {
      title: 'Eviction order — Barangay Banay-banay',
      status: 'draft',
      bar: 'pb-b',
      meta: 'Draft · Yesterday',
      type: 'field'
    },
    {
      title: 'Quarterly progress report Q1 2026',
      status: 'review',
      bar: 'pb-a',
      meta: 'Pending review · 2d ago',
      type: 'editor'
    },
    {
      title: 'Alert: new squatter cluster, Lagunatown Road',
      status: 'published',
      bar: 'pb-g',
      meta: 'Published · 2d ago',
      type: 'field'
    },
    {
      title: 'Rejected: incomplete documentation filed',
      status: 'rejected',
      bar: 'pb-r',
      meta: 'Rejected · 3d ago',
      type: 'editor'
    },
  ];
  const PROGRESS = [{
      name: 'Calamba',
      pct: 72
    }, {
      name: 'San Pedro',
      pct: 65
    }, {
      name: 'Biñan',
      pct: 58
    },
    {
      name: 'Santa Rosa',
      pct: 80
    }, {
      name: 'Cabuyao',
      pct: 45
    }, {
      name: 'Calauan',
      pct: 60
    },
  ];
  const badgeMap = {
    published: '<span class="badge bg-g">Published</span>',
    review: '<span class="badge bg-a">Review</span>',
    draft: '<span class="badge bg-b">Draft</span>',
    rejected: '<span class="badge bg-r">Rejected</span>',
  };

  /* tag pills */
  let activeMuni = '',
    activeStatus = '';

  function tagClick(el, v) {
    document.querySelectorAll('#muniTags .tb-tag').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    activeMuni = v;
    applyFilters();
  }

  function statusClick(el, v) {
    document.querySelectorAll('#statusTags .tb-tag').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    activeStatus = v;
    document.getElementById('pStatusF').value = v || '';
    renderPosts();
    renderMunis(activeMuni ? MUNIS.filter(m => m.name === activeMuni) : MUNIS);
  }

  /* render munis */
  function renderMunis(data) {
    const maxR = Math.max(...data.map(m => m.residents));
    const maxC = Math.max(...data.map(m => m.cases));
    document.getElementById('muniList').innerHTML = data.length ? data.map(m => `
    <div class="muni-item">
      <div class="muni-r1">
        <div class="muni-name">${m.name}</div>
        <div class="muni-chips">
          <span class="mc-chip">Residents: <b>${m.residents.toLocaleString()}</b></span>
          <span class="mc-chip mc-chip-r">Cases: <b>${m.cases}</b></span>
          <span class="mc-chip mc-chip-r">Rate: <b>${(m.cases/m.residents*100).toFixed(1)}%</b></span>
        </div>
      </div>
      <div class="btrack"><div class="bfill bf-n" style="width:${Math.round(m.residents/maxR*100)}%"></div></div>
      <div class="btrack"><div class="bfill bf-r" style="width:${Math.round(m.cases/maxC*100)}%"></div></div>
    </div>`).join('') :
      '<p class="empty">No municipalities match this filter.</p>';
  }
  renderMunis(MUNIS);

  function sortMunis(k) {
    const d = activeMuni ? MUNIS.filter(m => m.name === activeMuni) : [...MUNIS];
    d.sort((a, b) => k === 'residents' ? b.residents - a.residents : k === 'cases' ? b.cases - a.cases : (b.cases / b.residents) - (a.cases / a.residents));
    renderMunis(d);
  }

  /* render staff */
  function renderStaff(role) {
    const d = role ? STAFF.filter(s => s.role === role) : STAFF;
    document.getElementById('staffList').innerHTML = d.length ? d.map(s => `
    <div class="staff-item">
      <div class="av ${s.av}">${s.initials}</div>
      <div><div class="s-name">${s.name}</div><div class="s-role">${s.role}</div></div>
      <div class="s-right"><div class="s-cnt">${s.cases} cases</div><div class="s-loc">${s.muni}</div></div>
    </div>`).join('') :
      '<p class="empty">No staff found.</p>';
  }
  renderStaff('');

  function filterStaff(r) {
    renderStaff(r);
  }

  /* render posts */
  function renderPosts() {
    const st = document.getElementById('pStatusF').value || activeStatus;
    const au = document.getElementById('pAuthorF').value;
    let d = [...POSTS];
    if (st) d = d.filter(p => p.status === st || activeStatus === st);
    if (au) d = d.filter(p => p.type === au);
    document.getElementById('postsList').innerHTML = d.length ? d.map(p => `
    <div class="post-item">
      <div class="pbar ${p.bar}"></div>
      <div style="flex:1"><div class="p-title">${p.title}</div><div class="p-meta">${p.meta}</div></div>
      ${badgeMap[p.status]}
    </div>`).join('') :
      '<p class="empty">No posts match this filter.</p>';
  }
  renderPosts();

  /* render progress */
  function renderProgress(f) {
    const d = f ? PROGRESS.filter(p => p.name === f) : PROGRESS;
    document.getElementById('progressList').innerHTML = d.map(p => `
    <div class="prg-item">
      <div class="prg-name">${p.name}</div>
      <div class="prg-track"><div class="prg-fill" style="width:${p.pct}%;background:${p.pct>=70?'var(--red)':'var(--ink-4)'}"></div></div>
      <div class="prg-pct">${p.pct}%</div>
    </div>`).join('');
  }
  renderProgress('');

  function filterProgress(v) {
    renderProgress(v);
  }

  /* global search */
  function handleSearch(q) {
    q = q.toLowerCase().trim();
    if (!q) {
      renderMunis(MUNIS);
      renderStaff('');
      renderPosts();
      return;
    }
    renderMunis(MUNIS.filter(m => m.name.toLowerCase().includes(q)));
    const sf = STAFF.filter(s => [s.name, s.role, s.muni].join(' ').toLowerCase().includes(q));
    document.getElementById('staffList').innerHTML = sf.length ? sf.map(s => `
    <div class="staff-item">
      <div class="av ${s.av}">${s.initials}</div>
      <div><div class="s-name">${s.name}</div><div class="s-role">${s.role}</div></div>
      <div class="s-right"><div class="s-cnt">${s.cases} cases</div><div class="s-loc">${s.muni}</div></div>
    </div>`).join('') : '<p class="empty">No staff found.</p>';
    const pf = POSTS.filter(p => p.title.toLowerCase().includes(q) || p.meta.toLowerCase().includes(q));
    document.getElementById('postsList').innerHTML = pf.length ? pf.map(p => `
    <div class="post-item">
      <div class="pbar ${p.bar}"></div>
      <div style="flex:1"><div class="p-title">${p.title}</div><div class="p-meta">${p.meta}</div></div>
      ${badgeMap[p.status]}
    </div>`).join('') : '<p class="empty">No posts found.</p>';
  }

  /* global filter apply */
  function applyFilters() {
    const d = activeMuni ? MUNIS.filter(m => m.name === activeMuni) : MUNIS;
    renderMunis(d);
    renderProgress(activeMuni);
    const sf = activeMuni ? STAFF.filter(s => s.muni === activeMuni) : STAFF;
    document.getElementById('staffList').innerHTML = sf.length ? sf.map(s => `
    <div class="staff-item">
      <div class="av ${s.av}">${s.initials}</div>
      <div><div class="s-name">${s.name}</div><div class="s-role">${s.role}</div></div>
      <div class="s-right"><div class="s-cnt">${s.cases} cases</div><div class="s-loc">${s.muni}</div></div>
    </div>`).join('') : '<p class="empty">No staff for this municipality.</p>';
  }

  function resetFilters() {
    activeMuni = '';
    activeStatus = '';
    document.querySelectorAll('#muniTags .tb-tag').forEach((t, i) => t.classList.toggle('active', i === 0));
    document.querySelectorAll('#statusTags .tb-tag').forEach((t, i) => t.classList.toggle('active', i === 0));
    ['fPeriod', 'fSource'].forEach(id => document.getElementById(id).selectedIndex = 0);
    document.getElementById('globalSearch').value = '';
    document.getElementById('pStatusF').value = '';
    document.getElementById('pAuthorF').value = '';
    renderMunis(MUNIS);
    renderStaff('');
    renderPosts();
    renderProgress('');
  }

  /* charts */
  const VL = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
  const VA = [210, 245, 190, 320, 290, 340];
  const VM = [130, 150, 110, 180, 160, 210];

  const vc = new Chart(document.getElementById('chartVol'), {
    type: 'bar',
    data: {
      labels: VL,
      datasets: [{
          label: 'App',
          data: VA,
          backgroundColor: '#D0172B',
          borderRadius: 5,
          barPercentage: .55
        },
        {
          label: 'Muni',
          data: VM,
          backgroundColor: '#c4c4c8',
          borderRadius: 5,
          barPercentage: .55
        },
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          },
          ticks: {
            font: {
              size: 11
            },
            color: '#a1a1aa'
          }
        },
        y: {
          grid: {
            color: 'rgba(0,0,0,0.05)'
          },
          ticks: {
            font: {
              size: 11
            },
            color: '#a1a1aa'
          }
        }
      }
    }
  });

  function updateVolChart(n) {
    const m = parseInt(n);
    vc.data.labels = VL.slice(-m);
    vc.data.datasets[0].data = VA.slice(-m);
    vc.data.datasets[1].data = VM.slice(-m);
    vc.update();
  }

  new Chart(document.getElementById('chartDonut'), {
    type: 'doughnut',
    data: {
      labels: ['Confirmed', 'Pending', 'Resolved'],
      datasets: [{
        data: [312, 188, 89],
        backgroundColor: ['#D0172B', '#c4c4c8', '#16a34a'],
        borderWidth: 0,
        hoverOffset: 5
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '68%',
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });

  new Chart(document.getElementById('chartGauge'), {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [4.09, 95.91],
        backgroundColor: ['#D0172B', '#f4f4f5'],
        borderWidth: 0,
        circumference: 270,
        rotation: 225
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '72%',
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          enabled: false
        }
      }
    }
  });
</script>

@endsection