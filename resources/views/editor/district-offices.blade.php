@extends('editor.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>District Offices</title>
    <style>
        :root {
            --crimson: #8B1A1A;
            --crimson-dark: #6B1212;
            --gold: #C47C0C;
            --gold-bright: #E08D0E;
            --gold-bg: #FEF7E6;
            --teal: #0D6B63;
            --teal-light: #E6F5F3;
            --ink: #1A1A1A;
            --ink-2: #3D3D3D;
            --muted: #6B6B6B;
            --border: #E0DEDA;
            --border-light: #EEECE9;
            --surface: #F7F5F2;
            --white: #FFFFFF;
            --green: #0A6E3F;
            --green-bg: #E6F5EE;
            --gray-bg: #F0EFED;
            --gray-text: #555550;
            --red: #C0392B;
            --red-bg: #FDECEA;
            --shadow-sm: 0 2px 6px rgba(0, 0, 0, .08), 0 1px 2px rgba(0, 0, 0, .05);
            --shadow-lg: 0 24px 56px rgba(0, 0, 0, .15), 0 8px 18px rgba(0, 0, 0, .08);
            --r: 10px;
            --r-sm: 6px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--surface);
            color: var(--ink);
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.5;
        }

        /* ── Full-width page wrapper ── */
        .page {
            padding: 1.75rem 2rem;
            width: 100%;
        }

        /* ── Page header (no breadcrumb above it) ── */
        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--ink);
        }

        .page-header p {
            font-size: 13px;
            color: var(--muted);
            margin-top: .2rem;
        }

        /* ── Breadcrumb (only shown inside municipality view, below header) ── */
        .breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 1rem;
            background: var(--white);
            border: 1px solid var(--border);
            padding: .3rem .7rem;
            border-radius: 999px;
        }

        .breadcrumb .crumb {
            cursor: pointer;
            transition: color .15s;
        }

        .breadcrumb .crumb:hover {
            color: var(--crimson);
            text-decoration: underline;
        }

        .breadcrumb .sep {
            color: #ccc;
        }

        .breadcrumb .active {
            color: var(--crimson);
            font-weight: 700;
        }

        /* ── Card ── */
        .card {
            background: var(--white);
            border-radius: var(--r);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            width: 100%;
        }

        /* ── Card header ── */
        .card-header {
            background: linear-gradient(110deg, var(--crimson) 0%, var(--crimson-dark) 100%);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            border-left: 4px solid var(--gold-bright);
        }

        .card-header h2 {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
        }

        .card-header p {
            font-size: 11.5px;
            color: rgba(255, 255, 255, .6);
            margin-top: .15rem;
        }

        /* ── Toolbar ── */
        .toolbar {
            padding: .85rem 1.5rem;
            display: flex;
            gap: .65rem;
            align-items: center;
            flex-wrap: wrap;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        .search-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .search-wrap input {
            width: 100%;
            padding: .48rem .75rem .48rem 2.1rem;
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            font-size: 13px;
            font-family: Arial, sans-serif;
            background: var(--white);
            color: var(--ink);
            transition: border-color .15s, box-shadow .15s;
        }

        .search-wrap input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(196, 124, 12, .13);
        }

        .search-wrap svg {
            position: absolute;
            left: .6rem;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
        }

        .toolbar select {
            padding: .48rem .75rem;
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            font-size: 13px;
            font-family: Arial, sans-serif;
            background: var(--white);
            color: var(--ink);
            cursor: pointer;
        }

        .toolbar select:focus {
            outline: none;
            border-color: var(--gold);
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .48rem 1rem;
            border-radius: var(--r-sm);
            font-size: 13px;
            font-weight: 700;
            font-family: Arial, sans-serif;
            cursor: pointer;
            border: none;
            transition: background .15s, transform .1s;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn:active {
            transform: scale(.97);
        }

        .btn-gold {
            background: var(--gold-bright);
            color: #fff;
        }

        .btn-gold:hover {
            background: var(--gold);
        }

        .btn-teal {
            background: var(--teal);
            color: #fff;
        }

        .btn-teal:hover {
            background: #0A5850;
        }

        .btn-ghost {
            background: transparent;
            color: var(--muted);
            border: 1px solid var(--border);
        }

        .btn-ghost:hover {
            background: var(--surface);
            color: var(--ink);
        }

        .btn-danger {
            background: var(--red);
            color: #fff;
        }

        .btn-danger:hover {
            background: #A93226;
        }

        .btn-green {
            background: var(--green);
            color: #fff;
        }

        .btn-green:hover {
            background: #084F2E;
        }

        .btn-crimson-outline {
            background: transparent;
            color: var(--crimson);
            border: 1.5px solid var(--crimson);
        }

        .btn-crimson-outline:hover {
            background: var(--crimson);
            color: #fff;
        }

        /* View Municipalities inline table button */
        .btn-view-muni {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .42rem 1rem;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            font-family: Arial, sans-serif;
            cursor: pointer;
            border: none;
            background: linear-gradient(135deg, var(--teal) 0%, #0A9688 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(13, 107, 99, .30);
            transition: box-shadow .18s, transform .13s, background .18s;
            white-space: nowrap;
            letter-spacing: .01em;
        }

        .btn-view-muni:hover {
            background: linear-gradient(135deg, #0A5850 0%, var(--teal) 100%);
            box-shadow: 0 4px 14px rgba(13, 107, 99, .40);
            transform: translateY(-1px);
        }

        .btn-view-muni:active {
            transform: scale(.96);
            box-shadow: none;
        }

        .btn-view-muni svg {
            transition: transform .18s;
        }

        .btn-view-muni:hover svg {
            transform: translateX(3px);
        }

        /* ── Table ── */
        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: #FAFAF8;
            border-bottom: 2px solid var(--border);
        }

        thead th {
            padding: .7rem 1.25rem;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--muted);
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--border-light);
            cursor: pointer;
            transition: background .1s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #FFFBF2;
        }

        td {
            padding: .9rem 1.25rem;
            vertical-align: middle;
        }

        .row-hint {
            font-size: 11px;
            color: #B0ADA8;
            font-style: italic;
            padding: .4rem 1.25rem .5rem;
            background: #FAFAF8;
            border-top: 1px solid var(--border-light);
        }

        /* ── District badge ── */
        .d-badge {
            width: 2rem;
            height: 2rem;
            border-radius: 6px;
            background: var(--gold-bg);
            border: 1px solid #E8C97A;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--gold);
            flex-shrink: 0;
        }

        .d-name {
            font-weight: 700;
            font-size: 13.5px;
            color: var(--ink);
        }

        /* ── Pills ── */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .22rem .65rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .pill-blue {
            background: #EAF0FF;
            color: #1A4DB7;
        }

        .pill-green {
            background: var(--green-bg);
            color: var(--green);
        }

        .pill-gray {
            background: var(--gray-bg);
            color: var(--gray-text);
        }

        .pill-dot {
            width: .38rem;
            height: .38rem;
            border-radius: 50%;
            background: currentColor;
        }

        .date-text {
            font-size: 12px;
            color: var(--muted);
        }

        .muni-initial {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 7px;
            background: var(--teal-light);
            border: 1px solid #B3DBD7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: var(--teal);
            flex-shrink: 0;
            letter-spacing: .04em;
        }

        .muni-name {
            font-weight: 700;
            font-size: 13.5px;
            color: var(--ink);
        }

        .link-sm a {
            font-size: 12px;
            color: #1A5CC8;
            text-decoration: none;
        }

        .link-sm a:hover {
            text-decoration: underline;
        }

        .link-sm .none {
            font-size: 12px;
            color: #CCC;
            font-style: italic;
        }

        .back-btn {
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #fff;
            padding: .38rem .7rem;
            border-radius: var(--r-sm);
            cursor: pointer;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            gap: .3rem;
            font-size: 12px;
            font-weight: 700;
            transition: background .15s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, .28);
        }

        /* ── Pagination ── */
        .pagination {
            padding: .85rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            gap: .5rem;
            background: #FAFAF8;
        }

        .pagination p {
            font-size: 12px;
            color: var(--muted);
        }

        .page-btns {
            display: flex;
            gap: .3rem;
        }

        .page-btn {
            padding: .3rem .65rem;
            border-radius: var(--r-sm);
            font-size: 12px;
            font-family: Arial, sans-serif;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--muted);
            cursor: pointer;
            transition: all .12s;
        }

        .page-btn:disabled {
            cursor: not-allowed;
            opacity: .45;
        }

        .page-btn.active {
            background: var(--gold-bright);
            color: #fff;
            border-color: var(--gold-bright);
            font-weight: 700;
        }

        /* ══════════════════════
     SKELETON LOADER
  ══════════════════════ */
        @keyframes shimmer {
            0% {
                background-position: -600px 0;
            }

            100% {
                background-position: 600px 0;
            }
        }

        .skeleton-row td {
            padding: .85rem 1.25rem;
        }

        .skel {
            border-radius: 5px;
            height: 14px;
            background: linear-gradient(90deg, #EEECE9 25%, #F7F5F2 50%, #EEECE9 75%);
            background-size: 600px 100%;
            animation: shimmer 1.4s infinite linear;
        }

        .skel-badge {
            width: 2rem;
            height: 2rem;
            border-radius: 6px;
            background: linear-gradient(90deg, #EEECE9 25%, #F7F5F2 50%, #EEECE9 75%);
            background-size: 600px 100%;
            animation: shimmer 1.4s infinite linear;
            flex-shrink: 0;
        }

        .skel-sm {
            width: 60%;
        }

        .skel-md {
            width: 40%;
        }

        .skel-lg {
            width: 80%;
        }

        .skel-pill {
            width: 110px;
            height: 22px;
            border-radius: 999px;
            background: linear-gradient(90deg, #EEECE9 25%, #F7F5F2 50%, #EEECE9 75%);
            background-size: 600px 100%;
            animation: shimmer 1.4s infinite linear;
        }

        /* ══════════════════════
     MODALS
  ══════════════════════ */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(20, 10, 0, .45);
            backdrop-filter: blur(3px);
            z-index: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s;
        }

        .overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background: var(--white);
            border-radius: 12px;
            width: 100%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            transform: translateY(20px) scale(.975);
            transition: transform .22s cubic-bezier(.34, 1.4, .64, 1);
            display: flex;
            flex-direction: column;
        }

        .overlay.open .modal {
            transform: translateY(0) scale(1);
        }

        .modal.wide {
            max-width: 700px;
        }

        .modal.narrow {
            max-width: 400px;
        }

        .modal-header {
            padding: 1.3rem 1.5rem 1.1rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: .75rem;
            position: sticky;
            top: 0;
            background: var(--white);
            z-index: 2;
        }

        .modal-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
        }

        .modal-header p {
            font-size: 12px;
            color: var(--muted);
            margin-top: .2rem;
        }

        .modal-close {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            padding: .3rem;
            cursor: pointer;
            color: var(--muted);
            transition: background .12s, color .12s;
            flex-shrink: 0;
        }

        .modal-close:hover {
            background: var(--border);
            color: var(--ink);
        }

        .modal-body {
            padding: 1.4rem 1.5rem;
            flex: 1;
        }

        /*
    Footer layout:
    - Delete (danger) always on the FAR LEFT
    - Cancel + primary actions on the RIGHT
    - When no danger action: just right-align everything
  */
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
            background: #FAFAF8;
            border-radius: 0 0 12px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .65rem;
            flex-wrap: wrap;
        }

        .footer-left {
            display: flex;
            gap: .5rem;
            align-items: center;
        }

        .footer-right {
            display: flex;
            gap: .5rem;
            align-items: center;
            margin-left: auto;
        }

        /* ── Form ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-grid .full {
            grid-column: 1 / -1;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--ink-2);
            margin-bottom: .38rem;
        }

        .field label .req {
            color: var(--gold-bright);
        }

        .field input,
        .field textarea,
        .field select {
            width: 100%;
            padding: .52rem .8rem;
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            font-size: 13px;
            font-family: Arial, sans-serif;
            color: var(--ink);
            background: var(--white);
            transition: border-color .15s, box-shadow .15s;
        }

        .field input:focus,
        .field textarea:focus,
        .field select:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13, 107, 99, .10);
        }

        .field textarea {
            resize: vertical;
            min-height: 72px;
        }

        .upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--r-sm);
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s, background .15s;
        }

        .upload-area:hover {
            border-color: var(--teal);
            background: var(--teal-light);
        }

        .upload-area p {
            font-size: 12px;
            color: var(--muted);
            margin-top: .3rem;
        }

        .upload-area small {
            font-size: 11px;
            color: #aaa;
        }

        /* ── View info ── */
        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem 1.5rem;
        }

        .info-section .full {
            grid-column: 1 / -1;
        }

        .info-item .lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            margin-bottom: .28rem;
        }

        .info-item .val {
            font-size: 13px;
            color: var(--ink);
        }

        .info-item .val a {
            color: #1A5CC8;
            text-decoration: none;
        }

        .info-item .val a:hover {
            text-decoration: underline;
        }

        .view-muni-head {
            display: flex;
            align-items: center;
            gap: .9rem;
            margin-bottom: 1.3rem;
            padding-bottom: 1.1rem;
            border-bottom: 1px solid var(--border);
        }

        .view-muni-initial {
            width: 3.4rem;
            height: 3.4rem;
            border-radius: 10px;
            background: var(--teal-light);
            border: 1px solid #B3DBD7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: var(--teal);
            letter-spacing: .04em;
            flex-shrink: 0;
        }

        .view-muni-head h3 {
            font-size: 17px;
            font-weight: 700;
            color: var(--ink);
        }

        /* District stat box */
        .stat-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            padding: .9rem 1.1rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .stat-icon {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 8px;
            background: var(--gold-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
        }

        .stat-val {
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
        }

        .stat-lbl {
            font-size: 11px;
            color: var(--muted);
            margin-top: .15rem;
        }

        /* Confirm */
        .confirm-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: var(--red-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto .9rem;
            color: var(--red);
        }

        .confirm-body {
            text-align: center;
        }

        .confirm-body h3 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: .4rem;
        }

        .confirm-body p {
            font-size: 12.5px;
            color: var(--muted);
        }

        /* ── Toast ── */
        #toast {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            background: var(--ink);
            color: #fff;
            padding: .6rem 1.1rem;
            border-radius: 8px;
            font-size: 13px;
            font-family: Arial, sans-serif;
            box-shadow: var(--shadow-lg);
            transform: translateY(4rem);
            opacity: 0;
            transition: all .25s cubic-bezier(.34, 1.4, .64, 1);
            z-index: 999;
            pointer-events: none;
        }

        .hidden {
            display: none !important;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .gap-2 {
            gap: .5rem;
        }

        .gap-3 {
            gap: .75rem;
        }

        @media (max-width: 640px) {
            .page {
                padding: 1.1rem 1rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .info-section {
                grid-template-columns: 1fr;
            }

            .modal-body {
                padding: 1.1rem;
            }

            .modal-header {
                padding: 1rem 1.1rem .9rem;
            }

            .modal-footer {
                padding: .85rem 1.1rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div class="page">

        <!-- Page Header — no breadcrumb above this -->
        <div class="page-header">
            <h1 id="pageTitle">District Offices</h1>
            <p id="pageSubtitle">Manage districts and their municipalities</p>
        </div>

        <!-- ══════ DISTRICT VIEW ══════ -->
        <div id="districtView">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2>District List</h2>
                        <p id="districtSubline">Loading…</p>
                    </div>
                    <button class="btn btn-gold" onclick="openAddDistrictModal()">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        Add District
                    </button>
                </div>

                <div class="toolbar">
                    <div class="search-wrap">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                        <input type="text" id="districtSearch" placeholder="Search districts…">
                    </div>
                    <select id="districtSort">
                        <option value="name">Sort by Name</option>
                        <option value="municipalities">Sort by Municipalities</option>
                        <option value="updated">Sort by Last Updated</option>
                    </select>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>District</th>
                                <th>Municipalities</th>
                                <th>Last Updated</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="districtTableBody">
                            <!-- skeleton rows shown on load -->
                        </tbody>
                    </table>
                </div>
                <div class="row-hint" id="districtHint">Loading data…</div>

                <div class="pagination">
                    <p id="districtPagText">—</p>
                    <div class="page-btns">
                        <button class="page-btn" disabled>← Prev</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn" disabled>Next →</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════ MUNICIPALITY VIEW ══════ -->
        <div id="municipalityView" class="hidden">
            <!-- Breadcrumb pill — only shown here -->
            <div class="breadcrumb" id="breadcrumb" style="margin-bottom:1rem">
                <span class="crumb" onclick="showDistrictView()">District Offices</span>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex items-center gap-3">
                        <button class="back-btn" onclick="showDistrictView()">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                            Back
                        </button>
                        <div>
                            <h2 id="districtTitle">Municipalities</h2>
                            <p id="districtTitleSub">Click a row to view details</p>
                        </div>
                    </div>
                    <button class="btn btn-teal" onclick="openAddMuniModal()">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        Add Municipality
                    </button>
                </div>

                <div class="toolbar">
                    <div class="search-wrap">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                        <input type="text" id="municipalitySearch" placeholder="Search municipalities…">
                    </div>
                    <select id="municipalitySort">
                        <option value="name">Sort by Name</option>
                        <option value="status">Sort by Status</option>
                    </select>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Municipality</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Facebook</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="municipalityTableBody"></tbody>
                    </table>
                </div>
                <div class="row-hint">Click any row to view details and actions</div>

                <div class="pagination">
                    <p id="muniPagText">—</p>
                    <div class="page-btns">
                        <button class="page-btn" disabled>← Prev</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn" disabled>Next →</button>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /page -->


    <!-- ══════════════════════════════════════
     MODAL: Add / Edit District
══════════════════════════════════════ -->
    <div class="overlay" id="districtModal">
        <div class="modal narrow">
            <div class="modal-header">
                <div>
                    <h3 id="districtModalTitle">Add District</h3>
                    <p id="districtModalSub">Fill in the district name below</p>
                </div>
                <button class="modal-close" onclick="closeModal('districtModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="field">
                    <label>District Name <span class="req">*</span></label>
                    <input type="text" id="districtNameInput" placeholder="e.g. 1st District">
                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left"><!-- no danger action --></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('districtModal')">Cancel</button>
                    <button class="btn btn-gold" onclick="submitDistrictForm()">Save District</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ══════════════════════════════════════
     MODAL: View District
     Delete → FAR LEFT | Close · Edit · View Municipalities → RIGHT
══════════════════════════════════════ -->
    <div class="overlay" id="viewDistrictModal">
        <div class="modal narrow">
            <div class="modal-header">
                <div>
                    <h3 id="vd-name">District</h3>
                    <p id="vd-updated">Last updated —</p>
                </div>
                <button class="modal-close" onclick="closeModal('viewDistrictModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="stat-box">
                    <div class="stat-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val" id="vd-count">0</div>
                        <div class="stat-lbl">Municipalities</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Delete stays isolated on the LEFT -->
                <div class="footer-left">
                    <button class="btn btn-danger" id="vd-delete-btn">Delete</button>
                </div>
                <!-- Non-destructive actions on the RIGHT -->
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('viewDistrictModal')">Close</button>
                    <button class="btn btn-crimson-outline" id="vd-edit-btn">Edit</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ══════════════════════════════════════
     MODAL: Add / Edit Municipality
══════════════════════════════════════ -->
    <div class="overlay" id="municipalityModal">
        <div class="modal wide">
            <div class="modal-header">
                <div>
                    <h3 id="muniModalTitle">Add Municipality</h3>
                    <p id="muniModalSub">Fill in the municipality details below</p>
                </div>
                <button class="modal-close" onclick="closeModal('municipalityModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="field">
                        <label>Municipality Name <span class="req">*</span></label>
                        <input type="text" id="muniName" placeholder="e.g. San Juan City">
                    </div>
                    <div class="field">
                        <label>Contact Number</label>
                        <input type="tel" id="muniContact" placeholder="(02) 123-4567">
                    </div>
                    <div class="field full">
                        <label>Complete Address <span class="req">*</span></label>
                        <textarea id="muniAddress" placeholder="Enter the full address…"></textarea>
                    </div>
                    <div class="field">
                        <label>Email Address</label>
                        <input type="email" id="muniEmail" placeholder="info@municipality.gov.ph">
                    </div>
                    <div class="field">
                        <label>Website <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                        <input type="url" id="muniWebsite" placeholder="https://www.municipality.gov.ph">
                    </div>
                    <div class="field">
                        <label>Facebook Page <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                        <input type="url" id="muniFacebook" placeholder="https://www.facebook.com/page">
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select id="muniStatus">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Logo <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                        <div class="upload-area" onclick="document.getElementById('muniLogo').click()">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto">
                                <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p>Click to upload</p>
                            <small>PNG, JPG up to 2MB</small>
                            <input type="file" id="muniLogo" accept="image/*" class="hidden" onchange="previewLogo(event)">
                        </div>
                        <div id="logoPreview" class="hidden" style="margin-top:.5rem;display:flex;align-items:center;gap:.5rem">
                            <img id="logoPreviewImg" style="width:2.2rem;height:2.2rem;border-radius:6px;object-fit:cover;border:1px solid var(--border)" alt="">
                            <span style="font-size:11px;color:var(--muted)">Logo selected</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left"></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('municipalityModal')">Cancel</button>
                    <button class="btn btn-teal" onclick="submitMuniForm()">Save Municipality</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ══════════════════════════════════════
     MODAL: View Municipality
     Delete → LEFT | Close · Edit → RIGHT
══════════════════════════════════════ -->
    <div class="overlay" id="viewMuniModal">
        <div class="modal wide">
            <div class="modal-header">
                <div>
                    <h3>Municipality Details</h3>
                    <p>Publicly visible information</p>
                </div>
                <button class="modal-close" onclick="closeModal('viewMuniModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="view-muni-head">
                    <div class="view-muni-initial" id="vm-initial">SJ</div>
                    <div>
                        <h3 id="vm-name">Municipality</h3>
                        <span class="pill pill-green" id="vm-status" style="margin-top:.3rem">
                            <span class="pill-dot"></span> Active
                        </span>
                    </div>
                </div>
                <div class="info-section">
                    <div class="info-item full">
                        <div class="lbl">Address</div>
                        <div class="val" id="vm-address">—</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Contact Number</div>
                        <div class="val" id="vm-contact">—</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Email Address</div>
                        <div class="val" id="vm-email">—</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Website</div>
                        <div class="val" id="vm-website">—</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Facebook Page</div>
                        <div class="val" id="vm-facebook">—</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left">
                    <button class="btn btn-danger" id="vm-delete-btn">Delete</button>
                </div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('viewMuniModal')">Close</button>
                    <button class="btn btn-green" id="vm-edit-btn">Edit Municipality</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ══════════════════════════════════════
     MODAL: Confirm Delete
══════════════════════════════════════ -->
    <div class="overlay" id="confirmModal">
        <div class="modal narrow">
            <div class="modal-body confirm-body" style="padding:2rem 1.5rem 1.5rem">
                <div class="confirm-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                    </svg>
                </div>
                <h3 id="confirmTitle">Delete?</h3>
                <p id="confirmMsg">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <div class="footer-left"></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('confirmModal')">Cancel</button>
                    <button class="btn btn-danger" id="confirmActionBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div id="toast"></div>

    <script>
        /* ─── Data ─── */
        let districts = [{
                id: 1,
                name: '1st District',
                updated: 'March 1, 2026'
            },
            {
                id: 2,
                name: '2nd District',
                updated: 'February 28, 2026'
            },
            {
                id: 3,
                name: '3rd District',
                updated: 'February 25, 2026'
            },
        ];
        let municipalities = {
            1: [{
                    id: 1,
                    districtId: 1,
                    name: 'San Juan City',
                    address: '123 Main St, San Juan City',
                    contact: '(02) 123-4567',
                    email: 'info@sanjuan.gov.ph',
                    website: 'https://sanjuan.gov.ph',
                    facebook: 'https://fb.com/sanjuan',
                    status: 'active'
                },
                {
                    id: 2,
                    districtId: 1,
                    name: 'Quezon City',
                    address: '456 Gov Ave, Quezon City',
                    contact: '(02) 987-6543',
                    email: 'info@quezoncity.gov.ph',
                    website: 'https://quezoncity.gov.ph',
                    facebook: 'https://fb.com/quezoncity',
                    status: 'active'
                },
                {
                    id: 3,
                    districtId: 1,
                    name: 'Caloocan City',
                    address: '789 City Hall, Caloocan',
                    contact: '(02) 555-1234',
                    email: 'info@caloocan.gov.ph',
                    website: '',
                    facebook: 'https://fb.com/caloocan',
                    status: 'inactive'
                },
            ],
            2: [{
                    id: 4,
                    districtId: 2,
                    name: 'Marikina City',
                    address: '1 Shoe Ave, Marikina',
                    contact: '(02) 888-1111',
                    email: 'info@marikina.gov.ph',
                    website: 'https://marikina.gov.ph',
                    facebook: 'https://fb.com/marikina',
                    status: 'active'
                },
                {
                    id: 5,
                    districtId: 2,
                    name: 'Pasig City',
                    address: 'Caruncho Ave, Pasig',
                    contact: '(02) 643-2000',
                    email: 'info@pasigcity.gov.ph',
                    website: 'https://pasigcity.gov.ph',
                    facebook: 'https://fb.com/pasigcity',
                    status: 'active'
                },
            ],
            3: [{
                    id: 6,
                    districtId: 3,
                    name: 'Taguig City',
                    address: 'Gen. Santos Blvd, Taguig',
                    contact: '(02) 838-0000',
                    email: 'info@taguig.gov.ph',
                    website: 'https://taguig.gov.ph',
                    facebook: 'https://fb.com/taguig',
                    status: 'active'
                },
                {
                    id: 7,
                    districtId: 3,
                    name: 'Pateros',
                    address: 'P. Herrera St, Pateros',
                    contact: '(02) 641-0000',
                    email: 'info@pateros.gov.ph',
                    website: '',
                    facebook: 'https://fb.com/pateros',
                    status: 'active'
                },
            ],
        };

        let currentDistrictId = null;
        let editingDistrictId = null;
        let editingMuniId = null;

        const muniCount = id => (municipalities[id] || []).length;

        /* ─── Skeleton loader ─── */
        function showSkeletonDistricts() {
            const rows = Array.from({
                length: 3
            }, () => `
    <tr class="skeleton-row">
      <td><div class="flex items-center gap-2"><div class="skel-badge"></div><div class="skel skel-lg" style="margin-left:.5rem"></div></div></td>
      <td><div class="skel-pill"></div></td>
      <td><div class="skel skel-md"></div></td>
      <td><div class="skel skel-sm" style="width:130px;height:28px;border-radius:6px"></div></td>
    </tr>`).join('');
            document.getElementById('districtTableBody').innerHTML = rows;
            document.getElementById('districtHint').textContent = 'Loading data…';
            document.getElementById('districtPagText').textContent = '—';
        }

        function showSkeletonMunis() {
            const rows = Array.from({
                length: 4
            }, () => `
    <tr class="skeleton-row">
      <td><div class="flex items-center gap-2"><div class="skel-badge"></div><div class="skel skel-lg" style="margin-left:.5rem"></div></div></td>
      <td><div class="skel skel-lg"></div></td>
      <td><div class="skel skel-sm"></div></td>
      <td><div class="skel skel-md"></div></td>
      <td><div class="skel skel-sm"></div></td>
      <td><div class="skel skel-sm"></div></td>
      <td><div class="skel-pill"></div></td>
    </tr>`).join('');
            document.getElementById('municipalityTableBody').innerHTML = rows;
        }

        /* ─── Render districts (with simulated load delay) ─── */
        function renderDistricts(instant) {
            if (!instant) {
                showSkeletonDistricts();
                setTimeout(_renderDistricts, 600);
            } else {
                _renderDistricts();
            }
        }

        function _renderDistricts() {
            const q = document.getElementById('districtSearch').value.toLowerCase();
            const sort = document.getElementById('districtSort').value;
            let rows = districts.filter(d => d.name.toLowerCase().includes(q));
            if (sort === 'name') rows.sort((a, b) => a.name.localeCompare(b.name));
            else if (sort === 'municipalities') rows.sort((a, b) => muniCount(b.id) - muniCount(a.id));

            document.getElementById('districtTableBody').innerHTML = rows.map(d => `
    <tr onclick="openViewDistrictModal(${d.id})">
      <td><div class="flex items-center gap-2">
        <div class="d-badge">${d.id}</div>
        <span class="d-name">${d.name}</span>
      </div></td>
      <td><span class="pill pill-blue">${muniCount(d.id)} Municipalities</span></td>
      <td class="date-text">${d.updated}</td>
      <td onclick="event.stopPropagation()">
        <button class="btn-view-muni" onclick="showMunicipalityView(${d.id})">
          View Municipalities
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </td>
    </tr>`).join('');

            document.getElementById('districtPagText').innerHTML =
                `Showing <b>${rows.length}</b> of <b>${districts.length}</b> districts`;
            document.getElementById('districtSubline').textContent =
                `${districts.length} district${districts.length !== 1 ? 's' : ''} · click a row to view details`;
            document.getElementById('districtHint').textContent =
                'Click any row to view details and actions';
        }

        /* ─── Render municipalities ─── */
        function renderMunicipalities(instant) {
            if (!instant) {
                showSkeletonMunis();
                setTimeout(_renderMunicipalities, 500);
            } else {
                _renderMunicipalities();
            }
        }

        function _renderMunicipalities() {
            const q = document.getElementById('municipalitySearch').value.toLowerCase();
            const sort = document.getElementById('municipalitySort').value;
            let rows = (municipalities[currentDistrictId] || []).filter(m => m.name.toLowerCase().includes(q));
            if (sort === 'name') rows.sort((a, b) => a.name.localeCompare(b.name));
            else if (sort === 'status') rows.sort((a, b) => a.status.localeCompare(b.status));

            document.getElementById('municipalityTableBody').innerHTML = rows.map(m => `
    <tr onclick="openViewMuniModal(${m.id})">
      <td><div class="flex items-center gap-2">
        <div class="muni-initial">${m.name.substring(0,2).toUpperCase()}</div>
        <span class="muni-name">${m.name}</span>
      </div></td>
      <td class="date-text">${m.address || '—'}</td>
      <td class="date-text">${m.contact  || '—'}</td>
      <td class="date-text">${m.email    || '—'}</td>
      <td class="link-sm">${m.website  ? `<a href="${m.website}"  target="_blank">${m.website.replace('https://','')}</a>` : '<span class="none">—</span>'}</td>
      <td class="link-sm">${m.facebook ? `<a href="${m.facebook}" target="_blank">Facebook</a>` : '<span class="none">—</span>'}</td>
      <td><span class="pill ${m.status==='active'?'pill-green':'pill-gray'}"><span class="pill-dot"></span>${m.status==='active'?'Active':'Inactive'}</span></td>
    </tr>`).join('');

            const d = districts.find(x => x.id === currentDistrictId);
            document.getElementById('districtTitle').textContent = (d ? d.name : '') + ' — Municipalities';
            document.getElementById('districtTitleSub').textContent =
                rows.length + ' municipalities · click a row to view details';
            document.getElementById('muniPagText').innerHTML =
                `Showing <b>${rows.length}</b> of <b>${(municipalities[currentDistrictId]||[]).length}</b> municipalities`;
        }

        /* ─── View switching ─── */
        function showMunicipalityView(id) {
            currentDistrictId = id;
            document.getElementById('districtView').classList.add('hidden');
            document.getElementById('municipalityView').classList.remove('hidden');

            const d = districts.find(x => x.id === id);
            document.getElementById('breadcrumb').innerHTML = `
    <span class="crumb" onclick="showDistrictView()">District Offices</span>
    <span class="sep">›</span>
    <span class="active">${d ? d.name : ''}</span>`;
            document.getElementById('pageTitle').textContent = d ? d.name : '';
            document.getElementById('pageSubtitle').textContent = 'Municipalities in this district';

            renderMunicipalities();
            window.scrollTo(0, 0);
        }

        function showDistrictView() {
            currentDistrictId = null;
            document.getElementById('districtView').classList.remove('hidden');
            document.getElementById('municipalityView').classList.add('hidden');
            document.getElementById('pageTitle').textContent = 'District Offices';
            document.getElementById('pageSubtitle').textContent = 'Manage districts and their municipalities';
            renderDistricts(true); // instant on back-navigation
            window.scrollTo(0, 0);
        }

        /* ─── Modal helpers ─── */
        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }
        document.querySelectorAll('.overlay').forEach(o =>
            o.addEventListener('click', e => {
                if (e.target === o) o.classList.remove('open');
            })
        );

        /* ─── District form ─── */
        function openAddDistrictModal() {
            editingDistrictId = null;
            document.getElementById('districtModalTitle').textContent = 'Add District';
            document.getElementById('districtModalSub').textContent = 'Fill in the district name below';
            document.getElementById('districtNameInput').value = '';
            openModal('districtModal');
        }

        function openEditDistrictModal(id) {
            const d = districts.find(x => x.id === id);
            if (!d) return;
            editingDistrictId = id;
            document.getElementById('districtModalTitle').textContent = 'Edit District';
            document.getElementById('districtModalSub').textContent = d.name;
            document.getElementById('districtNameInput').value = d.name;
            closeModal('viewDistrictModal');
            openModal('districtModal');
        }

        function submitDistrictForm() {
            const name = document.getElementById('districtNameInput').value.trim();
            if (!name) return;
            if (editingDistrictId) {
                const d = districts.find(x => x.id === editingDistrictId);
                if (d) {
                    d.name = name;
                    d.updated = 'March 11, 2026';
                }
                toast('District updated.');
            } else {
                const newId = districts.length ? Math.max(...districts.map(x => x.id)) + 1 : 1;
                districts.push({
                    id: newId,
                    name,
                    updated: 'March 11, 2026'
                });
                municipalities[newId] = [];
                toast('District added.');
            }
            closeModal('districtModal');
            renderDistricts(true);
        }

        /* ─── View District modal ─── */
        function openViewDistrictModal(id) {
            const d = districts.find(x => x.id === id);
            if (!d) return;
            document.getElementById('vd-name').textContent = d.name;
            document.getElementById('vd-updated').textContent = 'Last updated: ' + d.updated;
            document.getElementById('vd-count').textContent = muniCount(id);

            document.getElementById('vd-edit-btn').onclick = () => openEditDistrictModal(id);
            document.getElementById('vd-delete-btn').onclick = () => {
                closeModal('viewDistrictModal');
                confirmDelete('district', id);
            };
            openModal('viewDistrictModal');
        }

        /* ─── Municipality form ─── */
        function openAddMuniModal() {
            editingMuniId = null;
            document.getElementById('muniModalTitle').textContent = 'Add Municipality';
            document.getElementById('muniModalSub').textContent = 'Fill in the municipality details below';
            ['muniName', 'muniContact', 'muniAddress', 'muniEmail', 'muniWebsite', 'muniFacebook']
            .forEach(id => document.getElementById(id).value = '');
            document.getElementById('muniStatus').value = 'active';
            document.getElementById('logoPreview').classList.add('hidden');
            openModal('municipalityModal');
        }

        function openEditMuniModal(id) {
            const m = Object.values(municipalities).flat().find(x => x.id === id);
            if (!m) return;
            editingMuniId = id;
            document.getElementById('muniModalTitle').textContent = 'Edit Municipality';
            document.getElementById('muniModalSub').textContent = m.name;
            document.getElementById('muniName').value = m.name;
            document.getElementById('muniAddress').value = m.address;
            document.getElementById('muniContact').value = m.contact;
            document.getElementById('muniEmail').value = m.email;
            document.getElementById('muniWebsite').value = m.website;
            document.getElementById('muniFacebook').value = m.facebook;
            document.getElementById('muniStatus').value = m.status;
            document.getElementById('logoPreview').classList.add('hidden');
            closeModal('viewMuniModal');
            openModal('municipalityModal');
        }

        function submitMuniForm() {
            const name = document.getElementById('muniName').value.trim();
            if (!name) return;
            const data = {
                name,
                address: document.getElementById('muniAddress').value.trim(),
                contact: document.getElementById('muniContact').value.trim(),
                email: document.getElementById('muniEmail').value.trim(),
                website: document.getElementById('muniWebsite').value.trim(),
                facebook: document.getElementById('muniFacebook').value.trim(),
                status: document.getElementById('muniStatus').value,
            };
            if (editingMuniId) {
                const m = Object.values(municipalities).flat().find(x => x.id === editingMuniId);
                if (m) Object.assign(m, data);
                toast('Municipality updated.');
            } else {
                const ids = Object.values(municipalities).flat().map(x => x.id);
                const newId = ids.length ? Math.max(...ids) + 1 : 1;
                municipalities[currentDistrictId] = municipalities[currentDistrictId] || [];
                municipalities[currentDistrictId].push({
                    id: newId,
                    districtId: currentDistrictId,
                    ...data
                });
                toast('Municipality added.');
            }
            closeModal('municipalityModal');
            renderMunicipalities(true);
        }

        /* ─── View Municipality modal ─── */
        function openViewMuniModal(id) {
            const m = Object.values(municipalities).flat().find(x => x.id === id);
            if (!m) return;
            document.getElementById('vm-name').textContent = m.name;
            document.getElementById('vm-initial').textContent = m.name.substring(0, 2).toUpperCase();
            const st = document.getElementById('vm-status');
            st.className = 'pill ' + (m.status === 'active' ? 'pill-green' : 'pill-gray');
            st.innerHTML = `<span class="pill-dot"></span> ${m.status === 'active' ? 'Active' : 'Inactive'}`;
            document.getElementById('vm-address').textContent = m.address || '—';
            document.getElementById('vm-contact').textContent = m.contact || '—';
            document.getElementById('vm-email').textContent = m.email || '—';
            document.getElementById('vm-website').innerHTML = m.website ? `<a href="${m.website}"  target="_blank">${m.website}</a>` : '—';
            document.getElementById('vm-facebook').innerHTML = m.facebook ? `<a href="${m.facebook}" target="_blank">${m.facebook}</a>` : '—';
            document.getElementById('vm-edit-btn').onclick = () => openEditMuniModal(id);
            document.getElementById('vm-delete-btn').onclick = () => {
                closeModal('viewMuniModal');
                confirmDelete('municipality', id);
            };
            openModal('viewMuniModal');
        }

        function confirmDelete(type, id) {
            if (type === 'district') {
                const d = districts.find(x => x.id === id);
                document.getElementById('confirmTitle').textContent = 'Delete ' + (d ? d.name : 'district') + '?';
                document.getElementById('confirmMsg').textContent = 'All municipalities in this district will also be removed. This cannot be undone.';
                document.getElementById('confirmActionBtn').onclick = () => {
                    districts = districts.filter(x => x.id !== id);
                    delete municipalities[id];
                    closeModal('confirmModal');
                    renderDistricts(true);
                    toast('District deleted.');
                };
            } else {
                const m = Object.values(municipalities).flat().find(x => x.id === id);
                document.getElementById('confirmTitle').textContent = 'Delete ' + (m ? m.name : 'municipality') + '?';
                document.getElementById('confirmMsg').textContent = 'This action cannot be undone.';
                document.getElementById('confirmActionBtn').onclick = () => {
                    Object.keys(municipalities).forEach(k => {
                        municipalities[k] = municipalities[k].filter(x => x.id !== id);
                    });
                    closeModal('confirmModal');
                    renderMunicipalities(true);
                    toast('Municipality deleted.');
                };
            }
            openModal('confirmModal');
        }

        function previewLogo(e) {
            const file = e.target.files[0];
            if (!file) return;
            const r = new FileReader();
            r.onload = ev => {
                document.getElementById('logoPreviewImg').src = ev.target.result;
                const p = document.getElementById('logoPreview');
                p.classList.remove('hidden');
                p.style.display = 'flex';
            };
            r.readAsDataURL(file);
        }

        function toast(msg) {
            const el = document.getElementById('toast');
            el.textContent = msg;
            el.style.transform = 'translateY(0)';
            el.style.opacity = '1';
            setTimeout(() => {
                el.style.transform = 'translateY(4rem)';
                el.style.opacity = '0';
            }, 2800);
        }

        /* ─── Listeners ─── */
        document.getElementById('districtSearch').addEventListener('input', () => renderDistricts(true));
        document.getElementById('districtSort').addEventListener('change', () => renderDistricts(true));
        document.getElementById('municipalitySearch').addEventListener('input', () => renderMunicipalities(true));
        document.getElementById('municipalitySort').addEventListener('change', () => renderMunicipalities(true));

        renderDistricts();
    </script>
</body>

</html>
@endsection