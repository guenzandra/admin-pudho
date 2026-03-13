@extends('admin.layout')

@section('content')
<div id="dms-root">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap');

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0
    }

    #dms-root {
      font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
      font-size: 14px;
      line-height: 1.5;
      color: #0F172A;
      background: #F8FAFC;
      min-height: 100vh;
      width: 100%;
      --red: #C0272D;
      --red-dk: #8B1A1E;
      --red-lt: #FFF0F0;
      --red-br: #FECACA;
      --amber: #D97706;
      --amber-lt: #FFFBEB;
      --amber-br: #FDE68A;
      --ink: #0F172A;
      --ink2: #334155;
      --muted: #64748B;
      --faint: #94A3B8;
      --border: #E2E8F0;
      --border2: #CBD5E1;
      --surface: #FFFFFF;
      --bg: #F8FAFC;
      --bg2: #F1F5F9;
      --green: #16A34A;
      --green-lt: #F0FDF4;
      --green-br: #BBF7D0;
      --blue: #1D4ED8;
      --blue-lt: #EFF6FF;
      --blue-br: #BFDBFE;
      --purple: #7C3AED;
      --purple-lt: #F5F3FF;
      --purple-br: #DDD6FE;
      --shadow: 0 1px 3px rgba(0, 0, 0, .08), 0 1px 2px rgba(0, 0, 0, .05);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, .08), 0 2px 4px rgba(0, 0, 0, .05);
      --shadow-lg: 0 12px 40px rgba(0, 0, 0, .12);
      --r: 8px;
      --tr: .15s ease;
    }

    /* ── TOPBAR ── */
    #dms-root .topbar {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 0 24px;
      height: 56px;
      background: var(--red);
      position: relative;
      z-index: 10;
      box-shadow: 0 2px 8px rgba(192, 39, 45, .25);
    }

    #dms-root .topbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
      padding-right: 16px;
      border-right: 1px solid rgba(255, 255, 255, .2);
    }

    #dms-root .topbar-brand svg {
      width: 22px;
      height: 22px;
      color: #fff
    }

    #dms-root .topbar-brand span {
      font-size: 15px;
      font-weight: 800;
      color: #fff;
      letter-spacing: -.03em;
      white-space: nowrap;
    }

    #dms-root .topbar-search {
      flex: 1;
      max-width: 500px;
      position: relative;
    }

    #dms-root .topbar-search input {
      width: 100%;
      padding: 9px 14px 9px 38px;
      background: rgba(255, 255, 255, .15);
      border: 1.5px solid rgba(255, 255, 255, .25);
      border-radius: 8px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13px;
      color: #fff;
      outline: none;
      transition: background var(--tr), border-color var(--tr);
    }

    #dms-root .topbar-search input::placeholder {
      color: rgba(255, 255, 255, .6)
    }

    #dms-root .topbar-search input:focus {
      background: rgba(255, 255, 255, .25);
      border-color: rgba(255, 255, 255, .5)
    }

    #dms-root .topbar-search .si {
      position: absolute;
      left: 11px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      color: rgba(255, 255, 255, .7);
      pointer-events: none;
    }

    #dms-root .topbar-actions {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-left: auto
    }

    #dms-root .topbar-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border: none;
      border-radius: 7px;
      cursor: pointer;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13px;
      font-weight: 600;
      transition: all var(--tr);
      white-space: nowrap;
    }

    #dms-root .topbar-btn-white {
      background: #fff;
      color: var(--red)
    }

    #dms-root .topbar-btn-white:hover {
      background: #fff;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, .3)
    }

    #dms-root .topbar-btn-outline {
      background: rgba(255, 255, 255, .15);
      color: #fff;
      border: 1.5px solid rgba(255, 255, 255, .3)
    }

    #dms-root .topbar-btn-outline:hover {
      background: rgba(255, 255, 255, .25)
    }

    #dms-root .topbar-btn svg {
      width: 15px;
      height: 15px;
      flex-shrink: 0;
    }

    /* ── BODY ── */
    #dms-root .app-body {
      display: flex;
      min-height: calc(100vh - 56px)
    }

    /* ── SIDEBAR ── */
    #dms-root .sidebar {
      width: 220px;
      min-width: 220px;
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      position: relative;
      overflow-y: auto;
    }

    #dms-root .sb-section {
      padding: 16px 0 8px
    }

    #dms-root .sb-label {
      padding: 0 16px 6px;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--faint);
    }

    #dms-root .sb-item {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 8px 16px;
      font-size: 13px;
      font-weight: 500;
      color: var(--ink2);
      cursor: pointer;
      border-left: 2px solid transparent;
      transition: background var(--tr), color var(--tr);
      position: relative;
    }

    #dms-root .sb-item:hover {
      background: var(--bg2);
      color: var(--ink)
    }

    #dms-root .sb-item.active {
      background: var(--red-lt);
      border-left-color: var(--red);
      color: var(--red-dk);
      font-weight: 700;
    }

    #dms-root .sb-item svg {
      width: 15px;
      height: 15px;
      flex-shrink: 0
    }

    #dms-root .sb-cnt {
      margin-left: auto;
      font-size: 10px;
      font-family: 'JetBrains Mono', monospace;
      background: var(--bg2);
      color: var(--muted);
      padding: 2px 7px;
      border-radius: 20px;
      font-weight: 500;
    }

    #dms-root .sb-item.active .sb-cnt {
      background: var(--red-br);
      color: var(--red-dk)
    }

    #dms-root .sb-divider {
      height: 1px;
      background: var(--border);
      margin: 6px 0
    }

    /* ── MAIN ── */
    #dms-root .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      min-width: 0;
      overflow: hidden
    }

    /* ── PAGE HEADER ── */
    #dms-root .page-header {
      padding: 20px 24px 16px;
      background: var(--surface);
      border-bottom: 1px solid var(--border);
    }

    #dms-root .page-header-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
    }

    #dms-root .page-title {
      font-size: 18px;
      font-weight: 800;
      color: var(--ink);
      letter-spacing: -.02em;
    }

    #dms-root .page-subtitle {
      font-size: 12px;
      color: var(--muted);
      margin-top: 2px
    }

    #dms-root .page-header-actions {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap
    }

    /* ── DISTRICT TABS ── */
    #dms-root .dtabs {
      display: flex;
      overflow-x: auto;
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      padding: 0 24px;
      gap: 0;
      scrollbar-width: none;
    }

    #dms-root .dtabs::-webkit-scrollbar {
      display: none
    }

    #dms-root .dtab {
      display: flex;
      align-items: center;
      gap: 7px;
      padding: 12px 16px;
      font-size: 13px;
      font-weight: 600;
      color: var(--muted);
      cursor: pointer;
      border-bottom: 2px solid transparent;
      margin-bottom: -1px;
      transition: color var(--tr);
      white-space: nowrap;
      flex-shrink: 0;
    }

    #dms-root .dtab:hover {
      color: var(--ink)
    }

    #dms-root .dtab.active {
      color: var(--red-dk);
      border-bottom-color: var(--red)
    }

    #dms-root .dtab-cnt {
      font-size: 10px;
      font-family: 'JetBrains Mono', monospace;
      background: var(--red-lt);
      color: var(--red-dk);
      padding: 2px 7px;
      border-radius: 20px;
      font-weight: 700;
    }

    #dms-root .dtab.active .dtab-cnt {
      background: var(--red);
      color: #fff
    }

    /* ── FILTERS BAR ── */
    #dms-root .filters-bar {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
      padding: 12px 24px;
      background: var(--bg2);
      border-bottom: 1px solid var(--border);
    }

    #dms-root .filters-left {
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1;
      flex-wrap: wrap
    }

    #dms-root .filters-right {
      display: flex;
      align-items: center;
      gap: 6px
    }

    #dms-root .f-search {
      position: relative
    }

    #dms-root .f-search input {
      padding: 8px 12px 8px 32px;
      width: 220px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      border: 1.5px solid var(--border);
      border-radius: 7px;
      background: #fff;
      color: var(--ink);
      outline: none;
      transition: border-color var(--tr), width var(--tr);
    }

    #dms-root .f-search input:focus {
      border-color: var(--red);
      width: 260px
    }

    #dms-root .f-search svg {
      position: absolute;
      left: 9px;
      top: 50%;
      transform: translateY(-50%);
      width: 13px;
      height: 13px;
      color: var(--faint);
      pointer-events: none;
    }

    #dms-root select.flt {
      padding: 8px 10px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      border: 1.5px solid var(--border);
      border-radius: 7px;
      color: var(--ink2);
      background: #fff;
      outline: none;
      cursor: pointer;
      transition: border-color var(--tr);
    }

    #dms-root select.flt:focus {
      border-color: var(--red)
    }

    /* ── BUTTONS (scoped — page header / in-page use) ── */
    #dms-root .btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 9px 16px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13px;
      font-weight: 700;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all .18s cubic-bezier(.4, 0, .2, 1);
      white-space: nowrap;
    }

    #dms-root .btn svg {
      width: 14px;
      height: 14px;
      flex-shrink: 0;
    }

    #dms-root .btn-red {
      background: linear-gradient(135deg, #C0272D, #9B1F24);
      color: #fff;
      box-shadow: 0 2px 8px rgba(192, 39, 45, .3), inset 0 1px 0 rgba(255, 255, 255, .12);
    }

    #dms-root .btn-red:hover {
      background: linear-gradient(135deg, #D42D34, #A82228);
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(192, 39, 45, .4);
    }

    #dms-root .btn-out {
      background: #fff;
      color: #334155;
      border: 1.5px solid #E2E8F0;
      box-shadow: 0 1px 3px rgba(0, 0, 0, .06);
    }

    #dms-root .btn-out:hover {
      background: #F8FAFC;
      border-color: #CBD5E1;
    }

    #dms-root .btn-green {
      background: linear-gradient(135deg, #16A34A, #15803D);
      color: #fff;
      box-shadow: 0 2px 8px rgba(22, 163, 74, .25);
    }

    #dms-root .btn-green:hover {
      background: linear-gradient(135deg, #18B854, #16A34A);
      transform: translateY(-1px);
    }

    #dms-root .btn-danger {
      background: linear-gradient(135deg, #DC2626, #991B1B);
      color: #fff;
      box-shadow: 0 2px 8px rgba(220, 38, 38, .25);
    }

    #dms-root .btn-danger:hover {
      background: linear-gradient(135deg, #EF4444, #B91C1C);
      transform: translateY(-1px);
    }

    #dms-root .btn-ghost {
      background: transparent;
      color: var(--muted);
      border: 1.5px solid transparent
    }

    #dms-root .btn-ghost:hover {
      background: var(--bg2);
      color: var(--ink);
      border-color: var(--border)
    }

    #dms-root .btn-sm {
      padding: 6px 12px;
      font-size: 12px;
    }

    #dms-root .btn-sm svg {
      width: 12px;
      height: 12px
    }

    #dms-root .btn-icon {
      padding: 7px;
      aspect-ratio: 1
    }

    /* ── STATS STRIP ── */
    #dms-root .stats-strip {
      display: flex;
      gap: 0;
      background: var(--surface);
      border-bottom: 1px solid var(--border);
    }

    #dms-root .stat-item {
      flex: 1;
      padding: 16px 20px;
      border-right: 1px solid var(--border);
    }

    #dms-root .stat-item:last-child {
      border-right: none
    }

    #dms-root .stat-n {
      font-size: 22px;
      font-weight: 800;
      color: var(--ink);
      line-height: 1;
      font-variant-numeric: tabular-nums;
      letter-spacing: -.02em;
    }

    #dms-root .stat-l {
      font-size: 10px;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: .08em;
      margin-top: 4px;
      font-weight: 600;
    }

    /* ── CONTENT ── */
    #dms-root .content {
      flex: 1;
      padding: 20px 24px;
      overflow-y: auto
    }

    /* ── TABLE ── */
    #dms-root .doc-table-wrap {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: var(--shadow);
    }

    #dms-root .doc-table {
      width: 100%;
      border-collapse: collapse
    }

    #dms-root .doc-table thead tr {
      background: #F8FAFC;
      border-bottom: 1.5px solid var(--border)
    }

    #dms-root .doc-table thead th {
      padding: 11px 14px;
      text-align: left;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--muted);
      white-space: nowrap;
    }

    #dms-root .doc-table thead th:first-child {
      padding-left: 20px
    }

    #dms-root .doc-table thead th:last-child {
      padding-right: 20px;
      text-align: right
    }

    #dms-root .doc-table tbody tr {
      border-bottom: 1px solid var(--border);
      transition: background var(--tr);
      animation: rowIn .2s ease both;
    }

    #dms-root .doc-table tbody tr:last-child {
      border-bottom: none
    }

    #dms-root .doc-table tbody tr:hover {
      background: #FAFAFA
    }

    #dms-root .doc-table td {
      padding: 12px 14px;
      font-size: 13px;
      vertical-align: middle
    }

    #dms-root .doc-table td:first-child {
      padding-left: 20px
    }

    #dms-root .doc-table td:last-child {
      padding-right: 20px
    }

    /* ── TABLE CELLS ── */
    #dms-root .td-title {
      display: flex;
      align-items: center;
      gap: 10px
    }

    #dms-root .td-file-icon {
      width: 34px;
      height: 34px;
      border-radius: 7px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    #dms-root .td-file-icon svg {
      width: 17px;
      height: 17px
    }

    #dms-root .td-doc-name {
      font-weight: 600;
      color: var(--ink);
      line-height: 1.3
    }

    #dms-root .td-doc-slug {
      font-size: 11px;
      color: var(--faint);
      font-family: 'JetBrains Mono', monospace;
      margin-top: 1px
    }

    #dms-root .td-badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 3px 8px;
      border-radius: 20px;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: .04em;
      text-transform: uppercase;
      white-space: nowrap;
    }

    #dms-root .td-date {
      font-size: 12px;
      color: var(--muted);
      white-space: nowrap
    }

    #dms-root .td-actions {
      display: flex;
      align-items: center;
      gap: 4px;
      justify-content: flex-end
    }

    #dms-root .act-btn {
      width: 28px;
      height: 28px;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1.5px solid var(--border);
      background: #fff;
      cursor: pointer;
      color: var(--muted);
      transition: all var(--tr);
    }

    #dms-root .act-btn:hover {
      border-color: var(--red-br);
      color: var(--red);
      background: var(--red-lt)
    }

    #dms-root .act-btn.del:hover {
      border-color: #FECACA;
      color: #991B1B;
      background: #FFF0F0
    }

    #dms-root .act-btn.view:hover {
      border-color: var(--blue-br);
      color: var(--blue);
      background: var(--blue-lt)
    }

    #dms-root .act-btn.dl:hover {
      border-color: var(--green-br);
      color: var(--green);
      background: var(--green-lt)
    }

    #dms-root .act-btn svg {
      width: 13px;
      height: 13px
    }

    /* ── FILE TYPE COLORS ── */
    #dms-root .ft-pdf {
      background: #FEE2E2;
      color: #DC2626
    }

    #dms-root .ft-docx {
      background: #DBEAFE;
      color: #1D4ED8
    }

    #dms-root .ft-xlsx {
      background: #D1FAE5;
      color: #065F46
    }

    #dms-root .ft-pptx {
      background: #FEF3C7;
      color: #92400E
    }

    #dms-root .ft-img {
      background: #EDE9FE;
      color: #6D28D9
    }

    #dms-root .ft-other {
      background: #F1F5F9;
      color: #475569
    }

    #dms-root .bg-pdf {
      background: #FEE2E2;
      color: #DC2626
    }

    #dms-root .bg-docx {
      background: #DBEAFE;
      color: #1D4ED8
    }

    #dms-root .bg-xlsx {
      background: #D1FAE5;
      color: #065F46
    }

    #dms-root .bg-pptx {
      background: #FEF3C7;
      color: #92400E
    }

    #dms-root .bg-img {
      background: #EDE9FE;
      color: #6D28D9
    }

    #dms-root .bg-other {
      background: #F1F5F9;
      color: #475569
    }

    /* ── MUNICIPALITY HEADER ── */
    #dms-root .muni-group-hd {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 20px;
      background: linear-gradient(90deg, var(--bg2) 0%, var(--surface) 100%);
      border-bottom: 1px solid var(--border);
    }

    #dms-root .muni-group-hd-left {
      display: flex;
      align-items: center;
      gap: 8px
    }

    #dms-root .muni-name-hd {
      font-size: 12px;
      font-weight: 700;
      color: var(--ink2);
      letter-spacing: -.01em
    }

    #dms-root .muni-count-hd {
      font-size: 10px;
      color: var(--muted);
      font-family: 'JetBrains Mono', monospace
    }

    /* ── EMPTY STATE ── */
    #dms-root .empty-state {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 60px 20px;
      text-align: center;
      background: var(--surface);
    }

    #dms-root .empty-state .es-icon {
      width: 64px;
      height: 64px;
      border-radius: 16px;
      background: var(--bg2);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 14px;
    }

    #dms-root .empty-state .es-icon svg {
      width: 32px;
      height: 32px;
      color: var(--faint)
    }

    #dms-root .empty-state h3 {
      font-size: 15px;
      font-weight: 700;
      color: var(--ink2);
      margin-bottom: 5px
    }

    #dms-root .empty-state p {
      font-size: 12px;
      color: var(--muted);
      max-width: 280px
    }

    /* ── LOADING ── */
    #dms-root .loading-state {
      display: none;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 60px;
    }

    #dms-root .loading-state.show {
      display: flex
    }

    #dms-root .spin {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      border: 2.5px solid var(--red-lt);
      border-top-color: var(--red);
      animation: spin .6s linear infinite;
    }

    #dms-root .loading-state span {
      font-size: 12px;
      color: var(--muted)
    }

    /* ── OVERVIEW CARDS ── */
    #dms-root .overview-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 12px;
      margin-bottom: 24px;
    }

    #dms-root .district-card {
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 18px;
      cursor: pointer;
      transition: all var(--tr);
      animation: cardIn .25s ease both;
    }

    #dms-root .district-card:hover {
      border-color: var(--red-br);
      box-shadow: var(--shadow-md);
      transform: translateY(-2px);
    }

    #dms-root .dc-num {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--red-dk), var(--red));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      font-weight: 800;
      color: #fff;
      margin-bottom: 12px;
    }

    #dms-root .dc-title {
      font-size: 15px;
      font-weight: 800;
      color: var(--ink);
      margin-bottom: 4px
    }

    #dms-root .dc-meta {
      font-size: 12px;
      color: var(--muted)
    }

    /* ── CATEGORY PILLS ── */
    #dms-root .cat-pill {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 3px 9px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
      background: var(--purple-lt);
      color: var(--purple);
      border: 1px solid var(--purple-br);
    }

    /* ── HELP BUTTON ── */
    #dms-help-btn {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 800;
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background: linear-gradient(135deg, #C0272D, #8B1A1E);
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 20px rgba(192, 39, 45, .4);
      transition: transform .2s, box-shadow .2s;
      animation: popIn .5s 1s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    #dms-help-btn:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 28px rgba(192, 39, 45, .5)
    }

    #dms-help-btn svg {
      width: 20px;
      height: 20px;
      color: #fff
    }

    #dms-help-btn .ping {
      position: absolute;
      top: -2px;
      right: -2px;
      width: 11px;
      height: 11px;
      border-radius: 50%;
      background: #F59E0B;
      border: 2px solid #fff;
      animation: ping 2s ease-in-out infinite;
    }

    /* ── HELP PANEL ── */
    #dms-help-panel {
      position: fixed;
      bottom: 82px;
      right: 24px;
      z-index: 900;
      width: 320px;
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, .12);
      border: 1px solid #E2E8F0;
      display: none;
      flex-direction: column;
      font-family: 'Plus Jakarta Sans', sans-serif;
      overflow: hidden;
    }

    #dms-help-panel.show {
      display: flex;
      animation: modalIn .25s cubic-bezier(.34, 1.3, .64, 1) both
    }

    .help-hd {
      padding: 16px 18px;
      background: linear-gradient(135deg, #8B1A1E, #C0272D)
    }

    .help-hd-row {
      display: flex;
      align-items: center;
      justify-content: space-between
    }

    .help-title {
      font-size: 14px;
      font-weight: 700;
      color: #fff
    }

    .help-sub {
      font-size: 11px;
      color: rgba(255, 255, 255, .65);
      margin-top: 1px
    }

    .help-x {
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, .15);
      border: 1px solid rgba(255, 255, 255, .2);
      border-radius: 5px;
      cursor: pointer;
      color: #fff;
    }

    .help-x:hover {
      background: rgba(255, 255, 255, .25)
    }

    .help-x svg {
      width: 11px;
      height: 11px
    }

    .help-tabs {
      display: flex;
      border-bottom: 1px solid #E2E8F0;
      background: #FAFAFA
    }

    .help-tab {
      flex: 1;
      padding: 9px 8px;
      font-size: 11px;
      font-weight: 700;
      color: #94A3B8;
      text-align: center;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      transition: color .15s;
      text-transform: uppercase;
      letter-spacing: .05em;
    }

    .help-tab.active {
      color: #C0272D;
      border-bottom-color: #C0272D
    }

    .help-body {
      overflow-y: auto;
      max-height: 340px;
      padding: 12px 14px
    }

    .guide-item {
      display: flex;
      gap: 10px;
      padding: 9px 0;
      border-bottom: 1px solid #F8FAFC
    }

    .guide-item:last-child {
      border-bottom: none
    }

    .guide-num {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: #FEE2E2;
      color: #C0272D;
      font-size: 10px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .guide-text h4 {
      font-size: 12px;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 2px
    }

    .guide-text p {
      font-size: 11px;
      color: #64748B;
      line-height: 1.5
    }

    .faq-item {
      padding: 9px 0;
      border-bottom: 1px solid #F8FAFC;
      cursor: pointer
    }

    .faq-item:last-child {
      border-bottom: none
    }

    .faq-q {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 12px;
      font-weight: 600;
      color: #0F172A
    }

    .faq-q svg {
      width: 12px;
      height: 12px;
      color: #94A3B8;
      transition: transform .2s;
      flex-shrink: 0
    }

    .faq-item.open .faq-q svg {
      transform: rotate(180deg)
    }

    .faq-a {
      font-size: 11px;
      color: #64748B;
      line-height: 1.6;
      margin-top: 5px;
      display: none
    }

    .faq-item.open .faq-a {
      display: block
    }

    .sc-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 6px 0;
      border-bottom: 1px solid #F8FAFC;
      font-size: 12px;
      color: #334155
    }

    .sc-row:last-child {
      border-bottom: none
    }

    .kbd-g {
      display: flex;
      gap: 2px
    }

    kbd {
      display: inline-block;
      padding: 2px 6px;
      background: #F1F5F9;
      border: 1px solid #CBD5E1;
      border-bottom: 2px solid #94A3B8;
      border-radius: 4px;
      font-size: 10px;
      font-family: 'JetBrains Mono', monospace;
      color: #334155
    }

    /* SCROLLBAR */
    #dms-root ::-webkit-scrollbar {
      width: 5px;
      height: 5px
    }

    #dms-root ::-webkit-scrollbar-track {
      background: transparent
    }

    #dms-root ::-webkit-scrollbar-thumb {
      background: #CBD5E1;
      border-radius: 3px
    }

    /* KEYFRAMES */
    @keyframes spin {
      to {
        transform: rotate(360deg)
      }
    }

    @keyframes rowIn {
      from {
        opacity: 0;
        transform: translateY(5px)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    @keyframes cardIn {
      from {
        opacity: 0;
        transform: translateY(8px)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    @keyframes bgFadeIn {
      from {
        opacity: 0
      }

      to {
        opacity: 1
      }
    }

    @keyframes modalIn {
      from {
        opacity: 0;
        transform: translateY(16px) scale(.97)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    @keyframes toastIn {
      from {
        opacity: 0;
        transform: translateY(8px) scale(.95)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    @keyframes toastOut {
      to {
        opacity: 0;
        transform: translateY(8px) scale(.95)
      }
    }

    @keyframes popIn {
      from {
        opacity: 0;
        transform: scale(0)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    @keyframes ping {

      0%,
      100% {
        transform: scale(1);
        opacity: 1
      }

      50% {
        transform: scale(1.35);
        opacity: .6
      }
    }

    /* RESPONSIVE */
    @media(max-width:900px) {
      #dms-root .sidebar {
        display: none
      }

      #dms-root .dms-form-grid {
        grid-template-columns: 1fr
      }

      #dms-root .stats-strip {
        flex-wrap: wrap
      }

      #dms-root .stat-item {
        min-width: 50%;
        border-bottom: 1px solid var(--border)
      }
    }

    @media(max-width:640px) {
      #dms-root .topbar {
        padding: 0 14px
      }

      #dms-root .content {
        padding: 14px
      }

      #dms-root .filters-bar {
        padding: 10px 14px
      }

      #dms-root .page-header {
        padding: 14px
      }

      #dms-root .doc-table td:nth-child(3),
      #dms-root .doc-table th:nth-child(3),
      #dms-root .doc-table td:nth-child(5),
      #dms-root .doc-table th:nth-child(5) {
        display: none
      }
    }
  </style>

  <!-- ══ TOPBAR ══ -->
  <div class="topbar">
    <div class="topbar-brand">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
          d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
      </svg>
      <span>Laguna DMS</span>
    </div>
    <div class="topbar-search">
      <svg class="si" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
      <input type="text" id="dmsGlobalSearch" placeholder="Search documents across all districts…"
        oninput="dmsOnGlobalSearch()">
    </div>
    <div class="topbar-actions">
      <button class="topbar-btn topbar-btn-outline" onclick="dmsOpenCategory()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
        </svg>
        Categories
      </button>
      <button class="topbar-btn topbar-btn-white" onclick="dmsOpenUpload()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
        </svg>
        Upload Document
      </button>
    </div>
  </div>

  <div class="app-body">
    <!-- SIDEBAR -->
    <div class="sidebar">
      <div class="sb-section">
        <div class="sb-label">Navigation</div>
        <div class="sb-item active" onclick="dmsNav('all')" id="snav-all">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
          </svg>
          Overview <span class="sb-cnt" id="sbc-all">—</span>
        </div>
        <div class="sb-item" onclick="dmsNav('recent')" id="snav-recent">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Recent
        </div>
      </div>
      <div class="sb-divider"></div>
      <div class="sb-section">
        <div class="sb-label">Districts</div>
        <div class="sb-item" onclick="dmsNavDistrict(1)" id="snav-d1">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          </svg>
          District I <span class="sb-cnt" id="sbc-d1">—</span>
        </div>
        <div class="sb-item" onclick="dmsNavDistrict(2)" id="snav-d2">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          </svg>
          District II <span class="sb-cnt" id="sbc-d2">—</span>
        </div>
        <div class="sb-item" onclick="dmsNavDistrict(3)" id="snav-d3">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          </svg>
          District III <span class="sb-cnt" id="sbc-d3">—</span>
        </div>
        <div class="sb-item" onclick="dmsNavDistrict(4)" id="snav-d4">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          </svg>
          District IV <span class="sb-cnt" id="sbc-d4">—</span>
        </div>
      </div>
      <div class="sb-divider"></div>
      <div class="sb-section">
        <div class="sb-label">Tools</div>
        <div class="sb-item" onclick="dmsOpenCategory()">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
          </svg>
          Manage Categories
        </div>
      </div>
    </div>

    <!-- MAIN -->
    <div class="main">
      <!-- PAGE HEADER -->
      <div class="page-header">
        <div class="page-header-top">
          <div>
            <div class="page-title" id="dmsPageTitle">All Documents</div>
            <div class="page-subtitle" id="dmsPageSub">Province of Laguna Document Management System</div>
          </div>
          <div class="page-header-actions">
            <button class="btn btn-out" onclick="dmsOpenCategory()">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Create Category
            </button>
            <button class="btn btn-red" onclick="dmsOpenUpload()">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
              </svg>
              Upload Document
            </button>
          </div>
        </div>
      </div>

      <!-- DISTRICT TABS -->
      <div class="dtabs">
        <div class="dtab active" id="dtab-all" onclick="dmsSwitchDistrict('all')">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:13px;height:13px">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
          </svg>
          Overview
        </div>
        <div class="dtab" id="dtab-1" onclick="dmsSwitchDistrict(1)">District I <span class="dtab-cnt" id="dtc-1">0</span></div>
        <div class="dtab" id="dtab-2" onclick="dmsSwitchDistrict(2)">District II <span class="dtab-cnt" id="dtc-2">0</span></div>
        <div class="dtab" id="dtab-3" onclick="dmsSwitchDistrict(3)">District III <span class="dtab-cnt" id="dtc-3">0</span></div>
        <div class="dtab" id="dtab-4" onclick="dmsSwitchDistrict(4)">District IV <span class="dtab-cnt" id="dtc-4">0</span></div>
      </div>

      <!-- STATS STRIP -->
      <div class="stats-strip" id="dmsStatsStrip">
        <div class="stat-item">
          <div class="stat-n" id="st-total">—</div>
          <div class="stat-l">Total Documents</div>
        </div>
        <div class="stat-item">
          <div class="stat-n" id="st-mb">—</div>
          <div class="stat-l">MB Used</div>
        </div>
        <div class="stat-item">
          <div class="stat-n" id="st-cat">—</div>
          <div class="stat-l">Categories</div>
        </div>
        <div class="stat-item">
          <div class="stat-n" id="st-muni">—</div>
          <div class="stat-l">Municipalities</div>
        </div>
      </div>

      <!-- FILTERS -->
      <div class="filters-bar">
        <div class="filters-left">
          <div class="f-search">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" id="dmsLocalSearch" placeholder="Filter documents…" oninput="dmsApplyFilter()">
          </div>
          <select class="flt" id="dmsTypeFilter" onchange="dmsApplyFilter()">
            <option value="all">All Types</option>
            <option value="pdf">PDF</option>
            <option value="docx">Word</option>
            <option value="xlsx">Excel</option>
            <option value="pptx">PowerPoint</option>
            <option value="img">Images</option>
          </select>
          <select class="flt" id="dmsCatFilter" onchange="dmsApplyFilter()">
            <option value="all">All Categories</option>
          </select>
          <select class="flt" id="dmsMuniFilter" onchange="dmsApplyFilter()">
            <option value="all">All Municipalities</option>
          </select>
          <select class="flt" id="dmsSortFilter" onchange="dmsApplyFilter()">
            <option value="date">Newest First</option>
            <option value="name">Name A–Z</option>
            <option value="size">Largest First</option>
          </select>
        </div>
        <div class="filters-right">
          <span id="dmsResultCount" style="font-size:11px;color:var(--muted);font-weight:600;font-family:'JetBrains Mono',monospace"></span>
        </div>
      </div>

      <!-- CONTENT -->
      <div class="content" id="dmsContent">
        <div class="loading-state" id="dmsLoader">
          <div class="spin"></div><span>Loading documents…</span>
        </div>
        <div id="dmsMain"></div>
      </div>
    </div>
  </div>
</div>

<!-- ══ TOASTS ══ -->
<div id="dms-toasts"></div>

<!-- ══ HELP BUTTON ══ -->
<button id="dms-help-btn" onclick="dmsToggleHelp()" title="Help">
  <div class="ping"></div>
  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
</button>

<!-- ══ HELP PANEL ══ -->
<div id="dms-help-panel">
  <div class="help-hd">
    <div class="help-hd-row">
      <div>
        <div class="help-title">Help & Guide</div>
        <div class="help-sub">Province of Laguna — DMS</div>
      </div>
      <button class="help-x" onclick="dmsToggleHelp()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
  <div class="help-tabs">
    <div class="help-tab active" onclick="dmsHelpTab('guide',this)">Guide</div>
    <div class="help-tab" onclick="dmsHelpTab('faq',this)">FAQ</div>
    <div class="help-tab" onclick="dmsHelpTab('shortcuts',this)">Keys</div>
  </div>
  <div class="help-body" id="dms-help-body">
    <div id="htab-guide">
      <div class="guide-item">
        <div class="guide-num">1</div>
        <div class="guide-text">
          <h4>Navigate Districts</h4>
          <p>Use the sidebar or tab row to switch between District I–IV. The listing will update accordingly.</p>
        </div>
      </div>
      <div class="guide-item">
        <div class="guide-num">2</div>
        <div class="guide-text">
          <h4>Upload Documents</h4>
          <p>Click Upload Document in the top bar. Fill in the title, district, municipality, and category, then attach a file.</p>
        </div>
      </div>
      <div class="guide-item">
        <div class="guide-num">3</div>
        <div class="guide-text">
          <h4>Create Categories</h4>
          <p>Click Create Category or use the Categories button to add and manage document categories.</p>
        </div>
      </div>
      <div class="guide-item">
        <div class="guide-num">4</div>
        <div class="guide-text">
          <h4>Search & Filter</h4>
          <p>Use the top search bar for global search. Use the filter bar to narrow by type, category, municipality, or sort order.</p>
        </div>
      </div>
      <div class="guide-item">
        <div class="guide-num">5</div>
        <div class="guide-text">
          <h4>Document Actions</h4>
          <p>Hover over any row to reveal View, Download, Edit, and Delete action buttons on the right side.</p>
        </div>
      </div>
    </div>
    <div id="htab-faq" style="display:none">
      <div class="faq-item" onclick="dmsFaqToggle(this)">
        <div class="faq-q">What file types are supported? <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg></div>
        <div class="faq-a">PDF, Word (.docx), Excel (.xlsx), PowerPoint (.pptx), and images (PNG, JPG, GIF, WebP). Maximum 50 MB per file.</div>
      </div>
      <div class="faq-item" onclick="dmsFaqToggle(this)">
        <div class="faq-q">Can I edit a document after uploading? <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg></div>
        <div class="faq-a">Yes — click the Edit (pencil) icon on any document row to update the title, category, and description.</div>
      </div>
      <div class="faq-item" onclick="dmsFaqToggle(this)">
        <div class="faq-q">Can I delete a category? <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg></div>
        <div class="faq-a">Yes, open Manage Categories and click the × on any category to remove it. Documents assigned to that category will retain the category name until reassigned.</div>
      </div>
      <div class="faq-item" onclick="dmsFaqToggle(this)">
        <div class="faq-q">Is search case-sensitive? <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg></div>
        <div class="faq-a">No. All searches are case-insensitive and cover document title and filename.</div>
      </div>
    </div>
    <div id="htab-shortcuts" style="display:none">
      <div class="sc-row">Global search<div class="kbd-g"><kbd>Ctrl</kbd><kbd>K</kbd></div>
      </div>
      <div class="sc-row">Upload document<div class="kbd-g"><kbd>Ctrl</kbd><kbd>U</kbd></div>
      </div>
      <div class="sc-row">Categories<div class="kbd-g"><kbd>Ctrl</kbd><kbd>T</kbd></div>
      </div>
      <div class="sc-row">District I<div class="kbd-g"><kbd>Alt</kbd><kbd>1</kbd></div>
      </div>
      <div class="sc-row">District II<div class="kbd-g"><kbd>Alt</kbd><kbd>2</kbd></div>
      </div>
      <div class="sc-row">District III<div class="kbd-g"><kbd>Alt</kbd><kbd>3</kbd></div>
      </div>
      <div class="sc-row">District IV<div class="kbd-g"><kbd>Alt</kbd><kbd>4</kbd></div>
      </div>
      <div class="sc-row">Close modal<div class="kbd-g"><kbd>Esc</kbd></div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════
     GLOBAL STYLES — applied outside #dms-root for modals
     (modals live outside #dms-root so scoped CSS won't reach them)
     ══════════════════════════════════════════════════════ -->
<style>
  /* ── MODAL BACKDROP & CONTAINER ── */
  .dms-modal-bg {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, .55);
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(3px);
  }

  .dms-modal-bg.show {
    display: flex;
    animation: bgFadeIn .2s ease;
  }

  .dms-modal {
    background: #fff;
    border-radius: 12px;
    width: 100%;
    max-width: 560px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, .12);
    animation: modalIn .3s cubic-bezier(.34, 1.3, .64, 1) both;
    font-family: 'Plus Jakarta Sans', sans-serif;
    overflow: hidden;
  }

  .dms-modal-wide {
    max-width: 680px
  }

  .dms-modal-sm {
    max-width: 420px
  }

  /* ── MODAL HEADER ── */
  .modal-hd {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px;
    border-bottom: 1px solid #F1F5F9;
  }

  .modal-hd-left {
    display: flex;
    align-items: center;
    gap: 12px
  }

  .modal-hd-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .modal-hd-icon svg {
    width: 19px;
    height: 19px
  }

  .modal-hd-title {
    font-size: 16px;
    font-weight: 800;
    color: #0F172A
  }

  .modal-hd-sub {
    font-size: 12px;
    color: #64748B;
    margin-top: 1px
  }

  .modal-close {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid #E2E8F0;
    border-radius: 7px;
    cursor: pointer;
    color: #64748B;
    background: #fff;
    transition: all .15s;
    flex-shrink: 0;
  }

  .modal-close:hover {
    background: #FFF0F0;
    color: #C0272D;
    border-color: #FECACA
  }

  .modal-close svg {
    width: 13px;
    height: 13px
  }

  /* ── MODAL BODY ── */
  .modal-body {
    padding: 22px
  }

  /* ── MODAL FOOTER ── */
  .modal-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    padding: 16px 22px;
    background: #F8FAFC;
    border-top: 1px solid #E2E8F0;
  }

  /* ── GLOBAL BUTTON SYSTEM (works inside & outside #dms-root) ── */
  .dms-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 10px 20px;
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: -.01em;
    border: none;
    border-radius: 9px;
    cursor: pointer;
    transition: all .18s cubic-bezier(.4, 0, .2, 1);
    white-space: nowrap;
    text-decoration: none;
    line-height: 1;
  }

  .dms-btn svg {
    width: 15px !important;
    height: 15px !important;
    flex-shrink: 0;
  }

  /* Primary — red */
  .dms-btn-primary {
    background: linear-gradient(135deg, #C0272D 0%, #9B1F24 100%);
    color: #fff;
    box-shadow: 0 2px 8px rgba(192, 39, 45, .35), inset 0 1px 0 rgba(255, 255, 255, .12);
  }

  .dms-btn-primary:hover {
    background: linear-gradient(135deg, #D42D34 0%, #A82228 100%);
    box-shadow: 0 4px 16px rgba(192, 39, 45, .42);
    transform: translateY(-1px);
  }

  .dms-btn-primary:active {
    transform: translateY(0);
  }

  /* Secondary — outlined */
  .dms-btn-secondary {
    background: #fff;
    color: #334155;
    border: 1.5px solid #E2E8F0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .06);
  }

  .dms-btn-secondary:hover {
    background: #F8FAFC;
    border-color: #CBD5E1;
    color: #0F172A;
  }

  /* Success — green */
  .dms-btn-success {
    background: linear-gradient(135deg, #16A34A 0%, #15803D 100%);
    color: #fff;
    box-shadow: 0 2px 8px rgba(22, 163, 74, .28), inset 0 1px 0 rgba(255, 255, 255, .12);
  }

  .dms-btn-success:hover {
    background: linear-gradient(135deg, #18B854 0%, #16A34A 100%);
    box-shadow: 0 4px 14px rgba(22, 163, 74, .36);
    transform: translateY(-1px);
  }

  /* Danger — deep red */
  .dms-btn-danger {
    background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);
    color: #fff;
    box-shadow: 0 2px 8px rgba(220, 38, 38, .28), inset 0 1px 0 rgba(255, 255, 255, .1);
  }

  .dms-btn-danger:hover {
    background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%);
    box-shadow: 0 4px 14px rgba(220, 38, 38, .36);
    transform: translateY(-1px);
  }

  /* Small modifier */
  .dms-btn-sm {
    padding: 8px 14px;
    font-size: 12px;
    border-radius: 7px;
  }

  .dms-btn-sm svg {
    width: 13px !important;
    height: 13px !important;
  }

  /* Loading state */
  .dms-btn.btn-loading {
    pointer-events: none;
    opacity: .72;
  }

  .dms-btn.btn-loading svg {
    display: none;
  }

  .dms-btn.btn-loading::after {
    content: '';
    width: 13px;
    height: 13px;
    border: 2px solid transparent;
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin .6s linear infinite;
    flex-shrink: 0;
  }

  /* ── FORM ELEMENTS (global, used inside modals) ── */
  .dms-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }

  .dms-fg {
    margin-bottom: 0
  }

  .dms-fg-full {
    grid-column: 1 / -1
  }

  .dms-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: #334155;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: .05em;
  }

  .dms-label .req {
    color: #C0272D
  }

  .dms-input,
  .dms-select {
    width: 100%;
    padding: 9px 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    border: 1.5px solid #E2E8F0;
    border-radius: 7px;
    color: #0F172A;
    outline: none;
    background: #fff;
    transition: border-color .15s, box-shadow .15s;
  }

  .dms-input:focus,
  .dms-select:focus {
    border-color: #C0272D;
    box-shadow: 0 0 0 3px rgba(192, 39, 45, .08);
  }

  .dms-hint {
    font-size: 11px;
    color: #94A3B8;
    margin-top: 3px
  }

  /* ── DROP ZONE ── */
  .dms-drop {
    border: 2px dashed #CBD5E1;
    border-radius: 10px;
    padding: 28px 20px;
    text-align: center;
    background: linear-gradient(135deg, #FAFAFA, #F8FAFC);
    cursor: pointer;
    position: relative;
    transition: all .15s;
  }

  .dms-drop:hover,
  .dms-drop.over {
    border-color: #C0272D;
    background: linear-gradient(135deg, #FFF5F5, #FFF0F0);
  }

  .dms-drop input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
  }

  .dms-drop-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 12px;
    background: #FEE2E2;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .dms-drop-icon svg {
    width: 24px;
    height: 24px;
    color: #C0272D
  }

  .dms-drop-title {
    font-size: 14px;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: 4px
  }

  .dms-drop-sub {
    font-size: 12px;
    color: #64748B
  }

  .dms-chosen {
    display: none;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    background: #F8FAFC;
    border: 1.5px solid #E2E8F0;
    border-radius: 8px;
    margin-top: 8px;
  }

  .dms-chosen.show {
    display: flex
  }

  .dms-chosen-ico {
    width: 36px;
    height: 36px;
    border-radius: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .dms-chosen-ico svg {
    width: 18px;
    height: 18px
  }

  .dms-chosen-info {
    flex: 1;
    min-width: 0
  }

  .dms-chosen-name {
    font-size: 12px;
    font-weight: 600;
    color: #0F172A;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .dms-chosen-size {
    font-size: 11px;
    color: #64748B;
    font-family: 'JetBrains Mono', monospace;
  }

  .dms-chosen-clear {
    width: 24px;
    height: 24px;
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #64748B;
    flex-shrink: 0;
    transition: all .15s;
  }

  .dms-chosen-clear:hover {
    background: #FEE2E2;
    color: #C0272D
  }

  .dms-chosen-clear svg {
    width: 11px;
    height: 11px
  }

  /* ── DELETE MODAL ── */
  .del-body {
    display: flex;
    gap: 14px;
    align-items: flex-start
  }

  .del-icon {
    width: 46px;
    height: 46px;
    background: #FFF0F0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .del-icon svg {
    width: 22px;
    height: 22px;
    color: #C0272D
  }

  .del-name {
    font-size: 15px;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: 4px
  }

  .del-warn {
    font-size: 12px;
    color: #64748B;
    line-height: 1.5
  }

  /* ── CATEGORY LIST ── */
  .cat-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 8px
  }

  .cat-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 10px 5px 12px;
    background: #fff;
    border: 1.5px solid #E2E8F0;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    color: #334155;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .cat-item-del {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #F1F5F9;
    cursor: pointer;
    color: #94A3B8;
    transition: all .15s;
    border: none;
  }

  .cat-item-del:hover {
    background: #FEE2E2;
    color: #DC2626
  }

  .cat-item-del svg {
    width: 9px;
    height: 9px
  }

  /* ── TOAST ── */
  #dms-toasts {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    gap: 6px;
    align-items: center;
    z-index: 9999;
    pointer-events: none;
  }

  .dms-toast {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: #0F172A;
    border-radius: 30px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, .18);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    pointer-events: all;
    white-space: nowrap;
    animation: toastIn .25s ease both;
  }

  .dms-toast svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0
  }

  .dms-toast.success svg {
    color: #4ADE80
  }

  .dms-toast.error svg {
    color: #F87171
  }

  .dms-toast.info svg {
    color: #60A5FA
  }

  .dms-toast.warning svg {
    color: #FBBF24
  }

  .dms-toast-x {
    background: none;
    border: none;
    color: rgba(255, 255, 255, .5);
    cursor: pointer;
    font-size: 13px;
    margin-left: 4px;
    padding: 0;
  }

  /* file-type colors used inside modals */
  .ft-pdf {
    background: #FEE2E2;
    color: #DC2626
  }

  .ft-docx {
    background: #DBEAFE;
    color: #1D4ED8
  }

  .ft-xlsx {
    background: #D1FAE5;
    color: #065F46
  }

  .ft-pptx {
    background: #FEF3C7;
    color: #92400E
  }

  .ft-img {
    background: #EDE9FE;
    color: #6D28D9
  }

  .ft-other {
    background: #F1F5F9;
    color: #475569
  }

  @keyframes bgFadeIn {
    from {
      opacity: 0
    }

    to {
      opacity: 1
    }
  }

  @keyframes modalIn {
    from {
      opacity: 0;
      transform: translateY(16px) scale(.97)
    }

    to {
      opacity: 1;
      transform: none
    }
  }

  @keyframes toastIn {
    from {
      opacity: 0;
      transform: translateY(8px) scale(.95)
    }

    to {
      opacity: 1;
      transform: none
    }
  }

  @keyframes toastOut {
    to {
      opacity: 0;
      transform: translateY(8px) scale(.95)
    }
  }

  @keyframes spin {
    to {
      transform: rotate(360deg)
    }
  }
</style>

<!-- ══════════ MODALS ══════════ -->

<!-- UPLOAD DOCUMENT -->
<div class="dms-modal-bg" id="dmsUploadModal" onclick="dmsBgClose(event,'dmsUploadModal')">
  <div class="dms-modal dms-modal-wide">
    <div class="modal-hd">
      <div class="modal-hd-left">
        <div class="modal-hd-icon" style="background:#FEE2E2">
          <svg fill="none" stroke="#C0272D" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
          </svg>
        </div>
        <div>
          <div class="modal-hd-title">Upload Document</div>
          <div class="modal-hd-sub">Add a new document to the archive</div>
        </div>
      </div>
      <button class="modal-close" onclick="dmsCloseModal('dmsUploadModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="dms-drop" id="upDrop"
        ondragover="dmsDzOver(event,'upDrop')"
        ondragleave="dmsDzLeave('upDrop')"
        ondrop="dmsDzDrop(event,'upFile','upChosen')">
        <input type="file" id="upFile"
          accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.png,.jpg,.jpeg,.gif,.webp"
          onchange="dmsShowChosen(event,'upChosen')">
        <div class="dms-drop-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
          </svg>
        </div>
        <div class="dms-drop-title">Drop your file here</div>
        <div class="dms-drop-sub">or <span style="color:#C0272D;font-weight:700">click to browse</span> — max 50 MB</div>
      </div>
      <div class="dms-chosen" id="upChosen">
        <div class="dms-chosen-ico ft-pdf" id="upChosenIco">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
        <div class="dms-chosen-info">
          <div class="dms-chosen-name" id="upChosenName"></div>
          <div class="dms-chosen-size" id="upChosenSize"></div>
        </div>
        <button class="dms-chosen-clear" onclick="dmsClearFile('upFile','upChosen')" title="Remove">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="dms-form-grid" style="margin-top:18px">
        <div class="dms-fg dms-fg-full">
          <label class="dms-label">Document Title <span class="req">*</span></label>
          <input type="text" id="upTitle" class="dms-input" placeholder="e.g. Q1 Budget Report 2026">
        </div>
        <div class="dms-fg">
          <label class="dms-label">District <span class="req">*</span></label>
          <select id="upDistrict" class="dms-select" onchange="dmsUpMuniLoad()">
            <option value="">— Select District —</option>
            <option value="1">District I</option>
            <option value="2">District II</option>
            <option value="3">District III</option>
            <option value="4">District IV</option>
          </select>
        </div>
        <div class="dms-fg">
          <label class="dms-label">Municipality <span class="req">*</span></label>
          <select id="upMuni" class="dms-select">
            <option value="">— Select District First —</option>
          </select>
        </div>
        <div class="dms-fg">
          <label class="dms-label">Category <span class="req">*</span></label>
          <select id="upCat" class="dms-select">
            <option value="">— Select Category —</option>
          </select>
        </div>
        <div class="dms-fg">
          <label class="dms-label">Description</label>
          <input type="text" id="upDesc" class="dms-input" placeholder="Optional short description…">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="dms-btn dms-btn-secondary" onclick="dmsCloseModal('dmsUploadModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Cancel
      </button>
      <button class="dms-btn dms-btn-primary" onclick="dmsSubmitUpload()" id="upSubmit">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
        </svg>
        Upload Document
      </button>
    </div>
  </div>
</div>

<!-- MANAGE CATEGORIES -->
<div class="dms-modal-bg" id="dmsCategoryModal" onclick="dmsBgClose(event,'dmsCategoryModal')">
  <div class="dms-modal dms-modal-sm">
    <div class="modal-hd">
      <div class="modal-hd-left">
        <div class="modal-hd-icon" style="background:#F5F3FF">
          <svg fill="none" stroke="#7C3AED" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
          </svg>
        </div>
        <div>
          <div class="modal-hd-title">Manage Categories</div>
          <div class="modal-hd-sub">Create and manage document categories</div>
        </div>
      </div>
      <button class="modal-close" onclick="dmsCloseModal('dmsCategoryModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="modal-body">
      <div style="display:flex;gap:8px;margin-bottom:14px">
        <input type="text" id="catNewName" class="dms-input" placeholder="New category name…"
          onkeydown="if(event.key==='Enter')dmsAddCategory()" style="flex:1">
        <button class="dms-btn dms-btn-success dms-btn-sm" onclick="dmsAddCategory()">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
          Add
        </button>
      </div>
      <div class="dms-hint" style="margin-bottom:10px">Existing categories:</div>
      <div class="cat-list" id="catList"></div>
    </div>
    <div class="modal-footer">
      <button class="dms-btn dms-btn-primary" onclick="dmsCloseModal('dmsCategoryModal')">
        Done
      </button>
    </div>
  </div>
</div>

<!-- EDIT DOCUMENT -->
<div class="dms-modal-bg" id="dmsEditModal" onclick="dmsBgClose(event,'dmsEditModal')">
  <div class="dms-modal">
    <div class="modal-hd">
      <div class="modal-hd-left">
        <div class="modal-hd-icon" style="background:#EFF6FF">
          <svg fill="none" stroke="#1D4ED8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
        </div>
        <div>
          <div class="modal-hd-title">Edit Document</div>
          <div class="modal-hd-sub">Update document details</div>
        </div>
      </div>
      <button class="modal-close" onclick="dmsCloseModal('dmsEditModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="dms-form-grid">
        <div class="dms-fg dms-fg-full">
          <label class="dms-label">Document Title <span class="req">*</span></label>
          <input type="text" id="editTitle" class="dms-input">
        </div>
        <div class="dms-fg">
          <label class="dms-label">Category</label>
          <select id="editCat" class="dms-select"></select>
        </div>
        <div class="dms-fg">
          <label class="dms-label">Description</label>
          <input type="text" id="editDesc" class="dms-input">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="dms-btn dms-btn-secondary" onclick="dmsCloseModal('dmsEditModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Cancel
      </button>
      <button class="dms-btn dms-btn-primary" onclick="dmsSubmitEdit()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        Save Changes
      </button>
    </div>
  </div>
</div>

<!-- DELETE -->
<div class="dms-modal-bg" id="dmsDeleteModal" onclick="dmsBgClose(event,'dmsDeleteModal')">
  <div class="dms-modal dms-modal-sm">
    <div class="modal-hd">
      <div class="modal-hd-left">
        <div class="modal-hd-icon" style="background:#FFF0F0">
          <svg fill="none" stroke="#C0272D" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
        </div>
        <div>
          <div class="modal-hd-title">Delete Document</div>
          <div class="modal-hd-sub">This action cannot be undone</div>
        </div>
      </div>
      <button class="modal-close" onclick="dmsCloseModal('dmsDeleteModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="del-body">
        <div class="del-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </div>
        <div>
          <div class="del-name" id="delDocName"></div>
          <div class="del-warn">This document will be permanently removed from the archive and cannot be recovered.</div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="dms-btn dms-btn-secondary" onclick="dmsCloseModal('dmsDeleteModal')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Cancel
      </button>
      <button class="dms-btn dms-btn-danger" id="delBtn" onclick="dmsConfirmDelete()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        Delete Permanently
      </button>
    </div>
  </div>
</div>

<script>
  // ═══════════════════════════════════
  //  DATA STRUCTURES
  // ═══════════════════════════════════
  const DISTRICTS = {
    1: {
      name: 'District I',
      munis: ['Alaminos', 'Bay', 'Calauan', 'Cavinti', 'Famy', 'Kalayaan', 'Liliw', 'Los Baños', 'Luisiana', 'Lumban', 'Mabitac', 'Magdalena', 'Majayjay', 'Nagcarlan', 'Paete', 'Pagsanjan', 'Pakil', 'Pangil', 'Pila', 'Rizal', 'Santa Cruz', 'Siniloan', 'Victoria']
    },
    2: {
      name: 'District II',
      munis: ['Biñan City', 'Cabuyao City', 'Calamba City', 'San Pablo City', 'Santa Rosa City']
    },
    3: {
      name: 'District III',
      munis: ['Calauan', 'Liliw', 'Magdalena', 'Majayjay', 'Nagcarlan', 'Santa Cruz', 'Victoria']
    },
    4: {
      name: 'District IV',
      munis: ['Bay', 'Cavinti', 'Los Baños', 'Lumban', 'Pagsanjan', 'Pakil', 'Pangil', 'Pila']
    }
  };

  let DOCS = [];
  let CATS = ['Budget Report', 'Executive Order', 'Resolution', 'Ordinance', 'Memorandum', 'Project Proposal', 'Audit Report'];
  let EDIT_ID = null,
    DEL_ID = null;
  let ACTIVE_DISTRICT = 'all';
  let FILE_ID = 1000;

  function dmsInit() {
    const seed = [{
        district: 1,
        muni: 'Nagcarlan',
        cat: 'Budget Report',
        type: 'pdf',
        name: 'Nagcarlan Q1 Budget Report 2026',
        slug: 'nagcarlan_budget_q1_2026.pdf',
        size: 2.4,
        date: '2026-03-01'
      },
      {
        district: 1,
        muni: 'Los Baños',
        cat: 'Executive Order',
        type: 'docx',
        name: 'EO No. 001 Los Baños 2026',
        slug: 'eo_001_losbanos.docx',
        size: 0.8,
        date: '2026-02-28'
      },
      {
        district: 1,
        muni: 'Santa Cruz',
        cat: 'Resolution',
        type: 'pdf',
        name: 'Resolution 2026-005 Santa Cruz',
        slug: 'res_2026_005.pdf',
        size: 1.2,
        date: '2026-02-20'
      },
      {
        district: 2,
        muni: 'Calamba City',
        cat: 'Ordinance',
        type: 'pdf',
        name: 'Calamba City Ordinance 2026-012',
        slug: 'calamba_ordinance_012.pdf',
        size: 3.1,
        date: '2026-03-02'
      },
      {
        district: 2,
        muni: 'Santa Rosa City',
        cat: 'Audit Report',
        type: 'xlsx',
        name: 'Santa Rosa Audit Summary 2025',
        slug: 'santarosa_audit_2025.xlsx',
        size: 1.5,
        date: '2026-01-15'
      },
      {
        district: 2,
        muni: 'Biñan City',
        cat: 'Budget Report',
        type: 'xlsx',
        name: 'Biñan City 2026 Annual Budget',
        slug: 'binan_budget_2026.xlsx',
        size: 2.0,
        date: '2026-02-10'
      },
      {
        district: 3,
        muni: 'Magdalena',
        cat: 'Memorandum',
        type: 'docx',
        name: 'Memorandum – Infrastructure Projects 2026',
        slug: 'memo_infra_magdalena.docx',
        size: 0.5,
        date: '2026-02-18'
      },
      {
        district: 3,
        muni: 'Nagcarlan',
        cat: 'Project Proposal',
        type: 'pptx',
        name: 'Road Widening Project Proposal – Nagcarlan',
        slug: 'nagcarlan_road_proposal.pptx',
        size: 4.2,
        date: '2026-03-05'
      },
      {
        district: 4,
        muni: 'Los Baños',
        cat: 'Resolution',
        type: 'pdf',
        name: 'LB Resolution No. 2026-003',
        slug: 'lb_res_2026_003.pdf',
        size: 0.9,
        date: '2026-03-08'
      },
      {
        district: 4,
        muni: 'Pila',
        cat: 'Budget Report',
        type: 'pdf',
        name: 'Pila Municipality Budget 2026',
        slug: 'pila_budget_2026.pdf',
        size: 1.7,
        date: '2026-02-22'
      },
    ];
    seed.forEach(d => DOCS.push({
      id: FILE_ID++,
      ...d,
      desc: ''
    }));
  }

  // ═══════════════════════════════════
  //  NAVIGATION
  // ═══════════════════════════════════
  function dmsNav(s) {
    if (s === 'all') ACTIVE_DISTRICT = 'all';
    document.querySelectorAll('#dms-root .sb-item').forEach(e => e.classList.remove('active'));
    document.getElementById('snav-' + (s === 'all' ? 'all' : 'recent'))?.classList.add('active');
    if (s === 'all') {
      dmsSwitchDistrict('all');
    } else {
      ACTIVE_DISTRICT = 'all';
      document.getElementById('dmsSortFilter').value = 'date';
      dmsRender();
    }
  }

  function dmsNavDistrict(d) {
    document.querySelectorAll('#dms-root .sb-item').forEach(e => e.classList.remove('active'));
    document.getElementById('snav-d' + d)?.classList.add('active');
    dmsSwitchDistrict(d);
  }

  function dmsSwitchDistrict(d) {
    ACTIVE_DISTRICT = d;
    document.querySelectorAll('#dms-root .dtab').forEach(t => t.classList.remove('active'));
    document.getElementById(d === 'all' ? 'dtab-all' : 'dtab-' + d)?.classList.add('active');
    document.getElementById('dmsPageTitle').textContent = d === 'all' ? 'All Documents' : DISTRICTS[d].name + ' — Documents';
    document.getElementById('dmsPageSub').textContent = d === 'all' ? 'Province of Laguna Document Management System' : 'Province of Laguna — ' + DISTRICTS[d].name;
    dmsUpdateMuniFilter();
    dmsRender();
  }

  // ═══════════════════════════════════
  //  RENDER
  // ═══════════════════════════════════
  function dmsRender() {
    const main = document.getElementById('dmsMain');
    const load = document.getElementById('dmsLoader');
    load.classList.add('show');
    main.innerHTML = '';
    setTimeout(() => {
      load.classList.remove('show');
      if (ACTIVE_DISTRICT === 'all') dmsRenderAll(main);
      else dmsRenderDistrict(main, ACTIVE_DISTRICT);
      dmsUpdateStats();
      dmsUpdateCounts();
    }, 200);
  }

  function dmsGetFiltered(districtFilter) {
    const q = (document.getElementById('dmsLocalSearch')?.value || document.getElementById('dmsGlobalSearch')?.value || '').toLowerCase().trim();
    const tf = document.getElementById('dmsTypeFilter')?.value || 'all';
    const cf = document.getElementById('dmsCatFilter')?.value || 'all';
    const mf = document.getElementById('dmsMuniFilter')?.value || 'all';
    const sf = document.getElementById('dmsSortFilter')?.value || 'date';
    let docs = [...DOCS];
    if (districtFilter && districtFilter !== 'all') docs = docs.filter(d => d.district == districtFilter);
    if (q) docs = docs.filter(d => d.name.toLowerCase().includes(q) || d.slug.toLowerCase().includes(q) || d.muni.toLowerCase().includes(q));
    if (tf !== 'all') docs = docs.filter(d => d.type === tf);
    if (cf !== 'all') docs = docs.filter(d => d.cat === cf);
    if (mf !== 'all') docs = docs.filter(d => d.muni === mf);
    const srt = sf === 'date' ? (a, b) => new Date(b.date) - new Date(a.date) : sf === 'size' ? (a, b) => b.size - a.size : (a, b) => a.name.localeCompare(b.name);
    docs.sort(srt);
    return docs;
  }

  function dmsRenderAll(el) {
    const docs = dmsGetFiltered('all');
    document.getElementById('dmsResultCount').textContent = docs.length + ' result' + (docs.length !== 1 ? 's' : '');
    if (!docs.length) {
      el.innerHTML = dmsEmptyHTML('No documents found', 'Try adjusting your search or filter criteria.');
      return;
    }
    const grouped = {};
    docs.forEach(d => {
      const dk = 'd' + d.district;
      if (!grouped[dk]) grouped[dk] = {
        district: d.district,
        munis: {}
      };
      if (!grouped[dk].munis[d.muni]) grouped[dk].munis[d.muni] = [];
      grouped[dk].munis[d.muni].push(d);
    });
    let h = '';
    Object.values(grouped).sort((a, b) => a.district - b.district).forEach(dg => {
      h += `<div style="margin-bottom:20px">
      <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px">
        <div style="width:6px;height:6px;border-radius:50%;background:var(--red);flex-shrink:0"></div>
        <span style="font-size:13px;font-weight:800;color:var(--ink);letter-spacing:-.01em">${dmsEsc(DISTRICTS[dg.district].name)}</span>
        <span style="font-size:11px;color:var(--muted);font-family:'JetBrains Mono',monospace">${Object.values(dg.munis).flat().length} docs</span>
      </div>`;
      Object.entries(dg.munis).forEach(([muni, mdocs]) => {
        h += `<div class="doc-table-wrap" style="margin-bottom:10px">
        <div class="muni-group-hd">
          <div class="muni-group-hd-left">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:13px;height:13px;color:var(--amber)">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            </svg>
            <span class="muni-name-hd">${dmsEsc(muni)}</span>
          </div>
          <span class="muni-count-hd">${mdocs.length} document${mdocs.length!==1?'s':''}</span>
        </div>
        ${dmsTableHTML(mdocs)}
      </div>`;
      });
      h += '</div>';
    });
    el.innerHTML = h;
  }

  function dmsRenderDistrict(el, d) {
    const docs = dmsGetFiltered(d);
    document.getElementById('dmsResultCount').textContent = docs.length + ' result' + (docs.length !== 1 ? 's' : '');
    if (!docs.length) {
      el.innerHTML = dmsEmptyHTML('No documents in ' + DISTRICTS[d].name, 'Upload a document or adjust your filters.');
      return;
    }
    const grouped = {};
    docs.forEach(doc => {
      if (!grouped[doc.muni]) grouped[doc.muni] = [];
      grouped[doc.muni].push(doc);
    });
    let h = '';
    Object.entries(grouped).sort(([a], [b]) => a.localeCompare(b)).forEach(([muni, mdocs]) => {
      h += `<div class="doc-table-wrap" style="margin-bottom:14px">
      <div class="muni-group-hd">
        <div class="muni-group-hd-left">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:13px;height:13px;color:var(--amber)">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
          </svg>
          <span class="muni-name-hd">${dmsEsc(muni)}</span>
        </div>
        <span class="muni-count-hd">${mdocs.length} document${mdocs.length!==1?'s':''}</span>
      </div>
      ${dmsTableHTML(mdocs)}
    </div>`;
    });
    el.innerHTML = h;
  }

  function dmsTableHTML(docs) {
    let rows = '';
    docs.forEach((d, i) => {
      const m = dmsFileMeta(d.type);
      const delay = Math.min(i * 30, 300);
      rows += `<tr style="animation-delay:${delay}ms">
      <td>
        <div class="td-title">
          <div class="td-file-icon ${m.cls}">${m.svg}</div>
          <div>
            <div class="td-doc-name">${dmsEsc(d.name)}</div>
            <div class="td-doc-slug">${dmsEsc(d.slug)}</div>
          </div>
        </div>
      </td>
      <td><span class="td-badge" style="background:var(--purple-lt);color:var(--purple);border:1px solid var(--purple-br)">${dmsEsc(d.cat||'—')}</span></td>
      <td><span style="font-size:12px;color:var(--ink2);font-weight:500">${dmsEsc(d.muni)}</span></td>
      <td><span class="td-badge ${m.cls}">${d.type.toUpperCase()}</span></td>
      <td><div class="td-date">${dmsFmtDate(d.date)}</div><div style="font-size:10px;color:var(--faint);font-family:'JetBrains Mono',monospace">${d.size} MB</div></td>
      <td>
        <div class="td-actions">
          <button class="act-btn view" onclick="dmsDl(${d.id})" title="View / Download">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3-9s-7 4.5-7 9 7 9 7 9 7-4.5 7-9-7-9-7-9z"/>
            </svg>
          </button>
          <button class="act-btn dl" onclick="dmsDl(${d.id})" title="Download">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </button>
          <button class="act-btn" onclick="dmsOpenEdit(${d.id})" title="Edit">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
          </button>
          <button class="act-btn del" onclick="dmsOpenDelete(${d.id},'${dmsEsc(d.name)}')" title="Delete">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
          </button>
        </div>
      </td>
    </tr>`;
    });
    return `<table class="doc-table">
    <thead><tr>
      <th>Document Title</th><th>Category</th><th>Municipality</th><th>Type</th><th>Date Uploaded</th><th></th>
    </tr></thead>
    <tbody>${rows}</tbody>
  </table>`;
  }

  function dmsEmptyHTML(title, sub) {
    return `<div class="doc-table-wrap"><div class="empty-state">
    <div class="es-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
    </svg></div>
    <h3>${title}</h3><p>${sub}</p>
  </div></div>`;
  }

  // ═══════════════════════════════════
  //  STATS & COUNTS
  // ═══════════════════════════════════
  function dmsUpdateStats() {
    const docs = ACTIVE_DISTRICT === 'all' ? DOCS : DOCS.filter(d => d.district == ACTIVE_DISTRICT);
    const munis = [...new Set(docs.map(d => d.muni))].length;
    const mb = docs.reduce((a, d) => a + d.size, 0).toFixed(1);
    document.getElementById('st-total').textContent = DOCS.length;
    document.getElementById('st-mb').textContent = mb;
    document.getElementById('st-cat').textContent = CATS.length;
    document.getElementById('st-muni').textContent = munis;
  }

  function dmsUpdateCounts() {
    let tot = 0;
    [1, 2, 3, 4].forEach(d => {
      const n = DOCS.filter(f => f.district == d).length;
      document.getElementById('sbc-d' + d).textContent = n;
      document.getElementById('dtc-' + d).textContent = n;
      tot += n;
    });
    document.getElementById('sbc-all').textContent = tot;
  }

  // ═══════════════════════════════════
  //  FILTERS
  // ═══════════════════════════════════
  function dmsUpdateMuniFilter() {
    const mf = document.getElementById('dmsMuniFilter');
    const prev = mf.value;
    mf.innerHTML = '<option value="all">All Municipalities</option>';
    const munis = ACTIVE_DISTRICT === 'all' ? [...new Set(DOCS.map(d => d.muni))].sort() :
      (DISTRICTS[ACTIVE_DISTRICT]?.munis || []);
    munis.forEach(m => mf.innerHTML += `<option value="${dmsEsc(m)}">${dmsEsc(m)}</option>`);
    if (munis.includes(prev)) mf.value = prev;
  }

  function dmsUpdateCatFilter() {
    const cf = document.getElementById('dmsCatFilter');
    cf.innerHTML = '<option value="all">All Categories</option>';
    CATS.forEach(c => cf.innerHTML += `<option value="${dmsEsc(c)}">${dmsEsc(c)}</option>`);
  }

  function dmsApplyFilter() {
    dmsRender();
  }

  // ═══════════════════════════════════
  //  SEARCH
  // ═══════════════════════════════════
  let STIMER = null;

  function dmsOnGlobalSearch() {
    clearTimeout(STIMER);
    STIMER = setTimeout(() => {
      document.getElementById('dmsLocalSearch').value = document.getElementById('dmsGlobalSearch').value;
      dmsApplyFilter();
    }, 300);
  }

  // ═══════════════════════════════════
  //  UPLOAD
  // ═══════════════════════════════════
  function dmsOpenUpload() {
    dmsUpMuniLoad();
    dmsRefreshCatSelect('upCat');
    if (ACTIVE_DISTRICT !== 'all') {
      document.getElementById('upDistrict').value = ACTIVE_DISTRICT;
      dmsUpMuniLoad();
    }
    document.getElementById('upTitle').value = '';
    document.getElementById('upDesc').value = '';
    dmsClearFile('upFile', 'upChosen');
    dmsOpenModal('dmsUploadModal');
  }

  function dmsUpMuniLoad() {
    const d = document.getElementById('upDistrict').value;
    const ms = document.getElementById('upMuni');
    ms.innerHTML = '';
    if (!d) {
      ms.innerHTML = '<option value="">— Select District First —</option>';
      return;
    }
    ms.innerHTML = '<option value="">— Select Municipality —</option>';
    (DISTRICTS[d]?.munis || []).forEach(m => ms.innerHTML += `<option value="${dmsEsc(m)}">${dmsEsc(m)}</option>`);
  }

  function dmsSubmitUpload() {
    const title = document.getElementById('upTitle').value.trim();
    const dist = document.getElementById('upDistrict').value;
    const muni = document.getElementById('upMuni').value;
    const cat = document.getElementById('upCat').value;
    const file = document.getElementById('upFile').files[0];
    if (!title) {
      dmsToast('Enter a document title.', 'error');
      return;
    }
    if (!dist) {
      dmsToast('Select a district.', 'error');
      return;
    }
    if (!muni) {
      dmsToast('Select a municipality.', 'error');
      return;
    }
    if (!cat) {
      dmsToast('Select a category.', 'error');
      return;
    }
    if (!file) {
      dmsToast('Select a file to upload.', 'error');
      return;
    }
    const btn = document.getElementById('upSubmit');
    btn.classList.add('btn-loading');
    setTimeout(() => {
      const ext = file.name.split('.').pop().toLowerCase();
      const type = ['pdf'].includes(ext) ? 'pdf' : ['docx', 'doc'].includes(ext) ? 'docx' : ['xlsx', 'xls'].includes(ext) ? 'xlsx' : ['pptx', 'ppt'].includes(ext) ? 'pptx' : ['png', 'jpg', 'jpeg', 'gif', 'webp'].includes(ext) ? 'img' : 'other';
      DOCS.push({
        id: FILE_ID++,
        name: title,
        slug: file.name,
        type,
        district: parseInt(dist),
        muni,
        cat,
        size: parseFloat((file.size / 1024 / 1024).toFixed(2)) || 0.1,
        date: new Date().toISOString().split('T')[0],
        desc: document.getElementById('upDesc').value.trim()
      });
      btn.classList.remove('btn-loading');
      dmsCloseModal('dmsUploadModal');
      dmsToast(`"${title}" uploaded successfully!`, 'success');
      dmsUpdateMuniFilter();
      dmsUpdateCatFilter();
      dmsRender();
    }, 900);
  }

  // ═══════════════════════════════════
  //  CATEGORIES
  // ═══════════════════════════════════
  function dmsOpenCategory() {
    dmsRenderCatList();
    document.getElementById('catNewName').value = '';
    dmsOpenModal('dmsCategoryModal');
  }

  function dmsRenderCatList() {
    const list = document.getElementById('catList');
    if (!CATS.length) {
      list.innerHTML = '<span style="font-size:12px;color:#94A3B8">No categories yet.</span>';
      return;
    }
    list.innerHTML = CATS.map(c =>
      `<div class="cat-item">${dmsEsc(c)}<button class="cat-item-del" onclick="dmsDelCat('${dmsEsc(c)}')" title="Remove"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button></div>`
    ).join('');
  }

  function dmsAddCategory() {
    const n = document.getElementById('catNewName').value.trim();
    if (!n) {
      dmsToast('Enter a category name.', 'error');
      return;
    }
    if (CATS.includes(n)) {
      dmsToast('Category already exists.', 'warning');
      return;
    }
    CATS.push(n);
    document.getElementById('catNewName').value = '';
    dmsRenderCatList();
    dmsUpdateCatFilter();
    dmsToast(`Category "${n}" created.`, 'success');
  }

  function dmsDelCat(name) {
    CATS = CATS.filter(c => c !== name);
    dmsRenderCatList();
    dmsUpdateCatFilter();
    dmsToast(`Category "${name}" removed.`, 'info');
  }

  function dmsRefreshCatSelect(id) {
    const el = document.getElementById(id);
    el.innerHTML = '<option value="">— Select Category —</option>';
    CATS.forEach(c => el.innerHTML += `<option value="${dmsEsc(c)}">${dmsEsc(c)}</option>`);
  }

  // ═══════════════════════════════════
  //  EDIT
  // ═══════════════════════════════════
  function dmsOpenEdit(id) {
    EDIT_ID = id;
    const d = DOCS.find(x => x.id === id);
    if (!d) return;
    document.getElementById('editTitle').value = d.name;
    document.getElementById('editDesc').value = d.desc || '';
    dmsRefreshCatSelect('editCat');
    document.getElementById('editCat').value = d.cat || '';
    dmsOpenModal('dmsEditModal');
  }

  function dmsSubmitEdit() {
    const title = document.getElementById('editTitle').value.trim();
    if (!title) {
      dmsToast('Enter a title.', 'error');
      return;
    }
    const d = DOCS.find(x => x.id === EDIT_ID);
    if (d) {
      d.name = title;
      d.cat = document.getElementById('editCat').value;
      d.desc = document.getElementById('editDesc').value.trim();
    }
    dmsCloseModal('dmsEditModal');
    dmsToast('Document updated.', 'success');
    dmsRender();
  }

  // ═══════════════════════════════════
  //  DELETE
  // ═══════════════════════════════════
  function dmsOpenDelete(id, name) {
    DEL_ID = id;
    document.getElementById('delDocName').textContent = name;
    dmsOpenModal('dmsDeleteModal');
  }

  function dmsConfirmDelete() {
    const btn = document.getElementById('delBtn');
    btn.classList.add('btn-loading');
    setTimeout(() => {
      DOCS = DOCS.filter(d => d.id !== DEL_ID);
      btn.classList.remove('btn-loading');
      dmsCloseModal('dmsDeleteModal');
      dmsToast('Document deleted.', 'error');
      dmsRender();
    }, 700);
  }

  // ═══════════════════════════════════
  //  DOWNLOAD (STUB)
  // ═══════════════════════════════════
  function dmsDl(id) {
    const d = DOCS.find(x => x.id === id);
    if (d) dmsToast(`Downloading "${d.name}"…`, 'info');
  }

  // ═══════════════════════════════════
  //  HELP
  // ═══════════════════════════════════
  let HELP_OPEN = false;

  function dmsToggleHelp() {
    HELP_OPEN = !HELP_OPEN;
    const p = document.getElementById('dms-help-panel');
    HELP_OPEN ? p.classList.add('show') : p.classList.remove('show');
    if (HELP_OPEN) document.querySelector('#dms-help-btn .ping').style.display = 'none';
  }

  function dmsHelpTab(tab, el) {
    document.querySelectorAll('.help-tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    ['guide', 'faq', 'shortcuts'].forEach(t => document.getElementById('htab-' + t).style.display = t === tab ? 'block' : 'none');
  }

  function dmsFaqToggle(el) {
    el.classList.toggle('open')
  }

  // ═══════════════════════════════════
  //  MODAL HELPERS
  // ═══════════════════════════════════
  function dmsOpenModal(id) {
    document.getElementById(id).classList.add('show');
    document.body.style.overflow = 'hidden'
  }

  function dmsCloseModal(id) {
    document.getElementById(id).classList.remove('show');
    document.body.style.overflow = ''
  }

  function dmsBgClose(e, id) {
    if (e.target === document.getElementById(id)) dmsCloseModal(id)
  }

  // DROP ZONE
  function dmsDzOver(e, zid) {
    e.preventDefault();
    document.getElementById(zid).classList.add('over')
  }

  function dmsDzLeave(zid) {
    document.getElementById(zid).classList.remove('over')
  }

  function dmsDzDrop(e, inId, prevId) {
    e.preventDefault();
    dmsDzLeave('upDrop');
    const f = e.dataTransfer.files[0];
    if (!f) return;
    const dt = new DataTransfer();
    dt.items.add(f);
    document.getElementById(inId).files = dt.files;
    dmsShowChosenFile(f, prevId);
  }

  function dmsShowChosen(e, prevId) {
    if (e.target.files[0]) dmsShowChosenFile(e.target.files[0], prevId)
  }

  function dmsShowChosenFile(f, prevId) {
    const p = document.getElementById(prevId);
    p.querySelector('.dms-chosen-name').textContent = f.name;
    p.querySelector('.dms-chosen-size').textContent = (f.size / 1024 / 1024).toFixed(2) + ' MB';
    p.classList.add('show');
    const nameEl = document.getElementById('upTitle');
    if (!nameEl.value) nameEl.value = f.name.replace(/\.[^/.]+$/, '');
  }

  function dmsClearFile(inId, prevId) {
    document.getElementById(inId).value = '';
    document.getElementById(prevId).classList.remove('show');
  }

  // ═══════════════════════════════════
  //  UTILITIES
  // ═══════════════════════════════════
  function dmsFileMeta(t) {
    const SVGs = {
      doc: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`,
      xl: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18M10 3v18M14 3v18"/></svg>`,
      pp: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>`,
      img: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`
    };
    const map = {
      pdf: {
        cls: 'ft-pdf',
        svg: SVGs.doc
      },
      docx: {
        cls: 'ft-docx',
        svg: SVGs.doc
      },
      xlsx: {
        cls: 'ft-xlsx',
        svg: SVGs.xl
      },
      pptx: {
        cls: 'ft-pptx',
        svg: SVGs.pp
      },
      img: {
        cls: 'ft-img',
        svg: SVGs.img
      },
    };
    return map[t] || {
      cls: 'ft-other',
      svg: SVGs.doc
    };
  }

  function dmsFmtDate(d) {
    if (!d) return '—';
    return new Date(d).toLocaleDateString('en-PH', {
      month: 'short',
      day: 'numeric',
      year: 'numeric'
    });
  }

  function dmsEsc(s) {
    return String(s).replace(/[&<>"']/g, c => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;'
    } [c]));
  }

  // ═══════════════════════════════════
  //  TOAST
  // ═══════════════════════════════════
  const TOAST_ICONS = {
    success: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
    error: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
    info: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
    warning: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`
  };

  function dmsToast(msg, type = 'info') {
    const el = document.createElement('div');
    el.className = `dms-toast ${type}`;
    el.innerHTML = `${TOAST_ICONS[type]}<span>${msg}</span><button class="dms-toast-x" onclick="dmsRmToast(this.parentElement)">✕</button>`;
    document.getElementById('dms-toasts').appendChild(el);
    setTimeout(() => dmsRmToast(el), 3500);
  }

  function dmsRmToast(el) {
    if (!el || !el.parentElement) return;
    el.style.animation = 'toastOut .2s ease forwards';
    setTimeout(() => el.remove(), 220);
  }

  // ═══════════════════════════════════
  //  KEYBOARD SHORTCUTS
  // ═══════════════════════════════════
  document.addEventListener('keydown', e => {
    const c = e.ctrlKey || e.metaKey;
    if (c && e.key === 'k') {
      e.preventDefault();
      document.getElementById('dmsGlobalSearch').focus()
    }
    if (c && e.key === 'u') {
      e.preventDefault();
      dmsOpenUpload()
    }
    if (c && e.key === 't') {
      e.preventDefault();
      dmsOpenCategory()
    }
    if (e.altKey && ['1', '2', '3', '4'].includes(e.key)) {
      e.preventDefault();
      dmsNavDistrict(parseInt(e.key))
    }
    if (e.key === 'Escape') {
      document.querySelectorAll('.dms-modal-bg.show').forEach(m => {
        m.classList.remove('show');
        document.body.style.overflow = ''
      });
      if (HELP_OPEN) dmsToggleHelp();
    }
  });

  // ═══════════════════════════════════
  //  INIT
  // ═══════════════════════════════════
  document.addEventListener('DOMContentLoaded', () => {
    dmsInit();
    dmsUpdateCatFilter();
    dmsUpdateMuniFilter();
    dmsRender();
  });
</script>

@endsection