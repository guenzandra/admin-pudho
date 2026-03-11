@extends('editor.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Categories</title>
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
            --blue: #1A4DB7;
            --blue-bg: #EAF0FF;
            --purple: #5B21B6;
            --purple-bg: #EDE9FE;
            --shadow-sm: 0 2px 6px rgba(0, 0, 0, .08), 0 1px 2px rgba(0, 0, 0, .05);
            --shadow-md: 0 6px 20px rgba(0, 0, 0, .10), 0 2px 6px rgba(0, 0, 0, .06);
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

        .page {
            padding: 1.75rem 2rem;
            width: 100%;
        }

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

        .card {
            background: var(--white);
            border-radius: var(--r);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            width: 100%;
        }

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

        /* Toolbar */
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
            min-width: 180px;
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

        /* Buttons */
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

        .btn-crimson-outline {
            background: transparent;
            color: var(--crimson);
            border: 1.5px solid var(--crimson);
        }

        .btn-crimson-outline:hover {
            background: var(--crimson);
            color: #fff;
        }

        /* Stats */
        .stats-bar {
            display: flex;
            border-bottom: 1px solid var(--border);
        }

        .stat-item {
            flex: 1;
            padding: .85rem 1.5rem;
            border-right: 1px solid var(--border);
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-item .s-val {
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
        }

        .stat-item .s-lbl {
            font-size: 11px;
            color: var(--muted);
            margin-top: .2rem;
        }

        /* Table */
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
            transition: background .12s, box-shadow .12s;
            position: relative;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #FFFBF2;
        }

        tbody tr:hover .row-chevron {
            opacity: 1;
            transform: translateX(0);
        }

        td {
            padding: .9rem 1.25rem;
            vertical-align: middle;
        }

        /* Row chevron hint */
        .row-chevron {
            color: #C5C0B8;
            opacity: 0;
            transform: translateX(-4px);
            transition: opacity .15s, transform .15s;
            display: flex;
            align-items: center;
        }

        /* Color dot */
        .color-dot {
            width: .75rem;
            height: .75rem;
            border-radius: 50%;
            flex-shrink: 0;
            border: 1.5px solid rgba(0, 0, 0, .08);
        }

        /* Pills */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .22rem .65rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .pill-dot {
            width: .38rem;
            height: .38rem;
            border-radius: 50%;
            background: currentColor;
        }

        /* Row hint */
        .row-hint {
            font-size: 11px;
            color: #B0ADA8;
            font-style: italic;
            padding: .4rem 1.25rem .5rem;
            background: #FAFAF8;
            border-top: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: .35rem;
        }

        /* Pagination */
        .pagination {
            padding: .85rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            background: #FAFAF8;
            flex-wrap: wrap;
            gap: .5rem;
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

        /* Empty */
        .empty-state {
            padding: 4rem 1.5rem;
            text-align: center;
        }

        .empty-icon {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            background: var(--gold-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--gold);
        }

        .empty-state h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: .4rem;
        }

        .empty-state p {
            font-size: 13px;
            color: var(--muted);
        }

        /* Skeleton */
        @keyframes shimmer {
            0% {
                background-position: -600px 0;
            }

            100% {
                background-position: 600px 0;
            }
        }

        .skel {
            border-radius: 5px;
            background: linear-gradient(90deg, #EEECE9 25%, #F7F5F2 50%, #EEECE9 75%);
            background-size: 600px 100%;
            animation: shimmer 1.4s infinite linear;
        }

        .skel-sm {
            height: 12px;
        }

        .skel-md {
            height: 12px;
        }

        .skel-pill {
            height: 22px;
            width: 70px;
            border-radius: 999px;
        }

        .skel-dot {
            width: .75rem;
            height: .75rem;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Modals */
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
            max-width: 420px;
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

        .modal.narrow {
            max-width: 380px;
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
            transition: background .12s;
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

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
            background: #FAFAF8;
            border-radius: 0 0 12px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .65rem;
        }

        .footer-left {
            display: flex;
            gap: .5rem;
        }

        .footer-right {
            display: flex;
            gap: .5rem;
            margin-left: auto;
        }

        /* Form */
        .field {
            margin-bottom: 1rem;
        }

        .field:last-child {
            margin-bottom: 0;
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

        .field input {
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

        .field input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13, 107, 99, .10);
        }

        /* Color picker */
        .color-grid {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .color-opt {
            position: relative;
        }

        .color-opt input[type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .color-swatch {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
            transition: border-color .15s, transform .13s, box-shadow .13s;
            position: relative;
        }

        .color-swatch::after {
            content: '';
            position: absolute;
            inset: 3px;
            border-radius: 50%;
        }

        .color-swatch .check-icon {
            display: none;
            position: relative;
            z-index: 1;
        }

        .color-opt input:checked+.color-swatch {
            transform: scale(1.15);
            box-shadow: 0 0 0 3px rgba(196, 124, 12, .25);
            border-color: var(--gold-bright);
        }

        .color-opt input:checked+.color-swatch .check-icon {
            display: flex;
        }

        .color-swatch:hover {
            transform: scale(1.1);
        }

        /* View modal info */
        .view-cat-head {
            display: flex;
            align-items: center;
            gap: .85rem;
            margin-bottom: 1.25rem;
            padding-bottom: 1.1rem;
            border-bottom: 1px solid var(--border);
        }

        .view-cat-icon {
            width: 2.8rem;
            height: 2.8rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .65rem 0;
            border-bottom: 1px solid var(--border-light);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row .lbl {
            font-size: 12px;
            color: var(--muted);
        }

        .info-row .val {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        .faq-list {
            margin-top: .75rem;
            display: flex;
            flex-direction: column;
            gap: .4rem;
        }

        .faq-item {
            background: var(--surface);
            border: 1px solid var(--border-light);
            border-radius: var(--r-sm);
            padding: .55rem .8rem;
            font-size: 12.5px;
            color: var(--ink-2);
            display: flex;
            align-items: flex-start;
            gap: .5rem;
        }

        .faq-item-num {
            font-size: 10px;
            font-weight: 700;
            color: var(--muted);
            margin-top: .15rem;
            flex-shrink: 0;
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

        /* Toast */
        .toast-wrap {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: .5rem;
            z-index: 999;
            pointer-events: none;
        }

        .toast {
            background: var(--ink);
            color: #fff;
            padding: .65rem 1.1rem;
            border-radius: 8px;
            font-size: 13px;
            font-family: Arial, sans-serif;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: .5rem;
            transform: translateX(120%);
            opacity: 0;
            transition: transform .28s cubic-bezier(.34, 1.4, .64, 1), opacity .2s;
            max-width: 320px;
        }

        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast.success {
            background: var(--green);
        }

        .toast.error {
            background: var(--red);
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="page-header">
            <h1>FAQ Categories</h1>
            <p>Organize and manage FAQ categories and their questions</p>
        </div>

        <div class="card">

            <div class="card-header">
                <div>
                    <h2>Category List</h2>
                    <p id="catSubline">Loading categories…</p>
                </div>
                <button class="btn btn-gold" onclick="openAddModal()">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    Add Category
                </button>
            </div>

            <!-- Stats -->
            <div class="stats-bar">
                <div class="stat-item">
                    <div class="s-val" id="statCats">—</div>
                    <div class="s-lbl">Categories</div>
                </div>
                <div class="stat-item">
                    <div class="s-val" id="statFaqs">—</div>
                    <div class="s-lbl">Total FAQs</div>
                </div>
                <div class="stat-item">
                    <div class="s-val" id="statAvg">—</div>
                    <div class="s-lbl">Avg. FAQs / Category</div>
                </div>
            </div>

            <!-- Toolbar -->
            <div class="toolbar">
                <div class="search-wrap">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input type="text" id="catSearch" placeholder="Search categories…">
                </div>
            </div>

            <!-- Table -->
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>FAQs</th>
                            <th>Color</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="catTableBody"></tbody>
                </table>
            </div>

            <div class="row-hint">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                Click any row to view details, edit, or delete
            </div>

            <div class="pagination">
                <p id="pagText">—</p>
                <div class="page-btns">
                    <button class="page-btn" disabled>← Prev</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn" disabled>Next →</button>
                </div>
            </div>

        </div>
    </div>


    <!-- ══ MODAL: Add / Edit Category ══ -->
    <div class="overlay" id="catModal">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <h3 id="catModalTitle">Add Category</h3>
                    <p id="catModalSub">Give the category a name and a color label</p>
                </div>
                <button class="modal-close" onclick="closeModal('catModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="field">
                    <label>Category Name <span class="req">*</span></label>
                    <input type="text" id="fCatName" placeholder="e.g. Services, Requirements…">
                </div>
                <div class="field">
                    <label>Color Label</label>
                    <div class="color-grid" id="colorGrid"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left"></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('catModal')">Cancel</button>
                    <button class="btn btn-gold" onclick="submitCatForm()">Save Category</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ══ MODAL: View Category ══ -->
    <div class="overlay" id="viewModal">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <h3>Category Details</h3>
                    <p>Overview and FAQ items in this category</p>
                </div>
                <button class="modal-close" onclick="closeModal('viewModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="view-cat-head">
                    <div class="view-cat-icon" id="vm-icon">G</div>
                    <div>
                        <div style="font-size:17px;font-weight:700;color:var(--ink)" id="vm-name">General</div>
                        <div style="font-size:12px;color:var(--muted);margin-top:.15rem" id="vm-count">5 FAQs</div>
                    </div>
                </div>
                <div class="info-row">
                    <span class="lbl">Category Name</span>
                    <span class="val" id="vm-name2">—</span>
                </div>
                <div class="info-row">
                    <span class="lbl">Color Label</span>
                    <span id="vm-color-pill">—</span>
                </div>
                <div class="info-row">
                    <span class="lbl">Total FAQs</span>
                    <span class="val" id="vm-faq-count">—</span>
                </div>
                <div style="margin-top:1rem">
                    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:.5rem">FAQ Items</div>
                    <div class="faq-list" id="vm-faqs"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left">
                    <button class="btn btn-danger" id="vm-delete-btn">Delete</button>
                </div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('viewModal')">Close</button>
                    <button class="btn btn-crimson-outline" id="vm-edit-btn">Edit Category</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ══ MODAL: Confirm Delete ══ -->
    <div class="overlay" id="confirmModal">
        <div class="modal narrow">
            <div class="modal-body confirm-body" style="padding:2rem 1.5rem 1.5rem">
                <div class="confirm-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                    </svg>
                </div>
                <h3 id="confirmTitle">Delete Category?</h3>
                <p id="confirmMsg">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <div class="footer-left"></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('confirmModal')">Cancel</button>
                    <button class="btn btn-danger" id="confirmBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-wrap" id="toastWrap"></div>

    <script>
        /* ─── Color config ─── */
        const COLORS = [{
                id: 'gray',
                label: 'Gray',
                bg: '#F0EFED',
                text: '#555550',
                dot: '#9E9E95'
            },
            {
                id: 'green',
                label: 'Green',
                bg: '#E6F5EE',
                text: '#0A6E3F',
                dot: '#0A6E3F'
            },
            {
                id: 'blue',
                label: 'Blue',
                bg: '#EAF0FF',
                text: '#1A4DB7',
                dot: '#1A4DB7'
            },
            {
                id: 'purple',
                label: 'Purple',
                bg: '#EDE9FE',
                text: '#5B21B6',
                dot: '#5B21B6'
            },
            {
                id: 'gold',
                label: 'Gold',
                bg: '#FEF7E6',
                text: '#C47C0C',
                dot: '#C47C0C'
            },
            {
                id: 'red',
                label: 'Red',
                bg: '#FDECEA',
                text: '#C0392B',
                dot: '#C0392B'
            },
            {
                id: 'teal',
                label: 'Teal',
                bg: '#E6F5F3',
                text: '#0D6B63',
                dot: '#0D6B63'
            },
        ];

        /* ─── Data ─── */
        let categories = [{
                id: 1,
                name: 'General',
                color: 'gray',
                faqs: ['What is this website for?', 'How do I contact support?', 'Where can I find more information?', 'What are your office hours?', 'Is this service free?']
            },
            {
                id: 2,
                name: 'Services',
                color: 'green',
                faqs: ['How do I apply for health services?', 'What documents do I need?', 'Can I apply online?', 'How long does processing take?', 'Is there an age requirement?', 'What if I lose my certificate?', 'Can I check my application status?', 'Are services available on weekends?', 'How do I cancel an application?', 'Is there a fee for services?', 'Can a representative apply on my behalf?', 'What if my application is denied?']
            },
            {
                id: 3,
                name: 'Requirements',
                color: 'blue',
                faqs: ['What IDs are accepted?', 'Do I need a barangay clearance?', 'Is a birth certificate required?', 'Can I submit photocopies?', 'Do documents need to be notarized?', 'What if I lost my original documents?', 'Are foreign documents accepted?', 'What is the validity of requirements?']
            },
            {
                id: 4,
                name: 'Contact',
                color: 'purple',
                faqs: ['What is your phone number?', 'How do I send an email?', 'Where is your office located?', 'Do you have a Facebook page?', 'What is the best time to call?', 'Is there a hotline for emergencies?']
            },
            {
                id: 5,
                name: 'Technical',
                color: 'gold',
                faqs: ['The website is not loading, what do I do?', 'How do I reset my password?', 'Is the site mobile-friendly?']
            },
        ];

        let editingId = null;

        /* ── Color helpers ── */
        function getColor(id) {
            return COLORS.find(c => c.id === id) || COLORS[0];
        }

        function colorPill(colorId) {
            const c = getColor(colorId);
            return `<span class="pill" style="background:${c.bg};color:${c.text}"><span class="pill-dot" style="background:${c.dot}"></span>${c.label}</span>`;
        }

        function colorDot(colorId) {
            const c = getColor(colorId);
            return `<div class="color-dot" style="background:${c.bg};border-color:${c.dot}60"></div>`;
        }

        /* ── Build color picker ── */
        function buildColorPicker(selected) {
            document.getElementById('colorGrid').innerHTML = COLORS.map(c => `
    <label class="color-opt" title="${c.label}">
      <input type="radio" name="catColor" value="${c.id}" ${c.id===selected?'checked':''}>
      <div class="color-swatch" style="background:${c.bg};border-color:${c.dot}40">
        <svg class="check-icon" width="12" height="12" fill="none" stroke="${c.text}" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
    </label>`).join('');
        }

        /* ── Filter ── */
        function filtered() {
            const q = document.getElementById('catSearch').value.toLowerCase();
            return categories.filter(c => !q || c.name.toLowerCase().includes(q));
        }

        /* ── Stats ── */
        function updateStats() {
            const total = categories.reduce((a, c) => a + c.faqs.length, 0);
            document.getElementById('statCats').textContent = categories.length;
            document.getElementById('statFaqs').textContent = total;
            document.getElementById('statAvg').textContent = categories.length ? Math.round(total / categories.length) : 0;
        }

        /* ── Skeleton ── */
        function showSkeleton() {
            document.getElementById('catTableBody').innerHTML = Array.from({
                length: 5
            }, () => `
    <tr>
      <td><div style="display:flex;align-items:center;gap:.6rem"><div class="skel skel-dot"></div><div class="skel skel-md" style="width:100px"></div></div></td>
      <td><div class="skel skel-pill"></div></td>
      <td><div class="skel skel-dot" style="width:1.5rem;height:1.5rem;border-radius:4px"></div></td>
      <td></td>
    </tr>`).join('');
        }

        /* ── Render ── */
        function render(instant) {
            if (!instant) {
                showSkeleton();
                setTimeout(_render, 500);
            } else _render();
        }

        function _render() {
            const rows = filtered();
            updateStats();
            document.getElementById('catSubline').textContent = `${categories.length} categor${categories.length!==1?'ies':'y'} · ${categories.reduce((a,c)=>a+c.faqs.length,0)} total FAQs`;
            document.getElementById('pagText').innerHTML = `Showing <b>${rows.length}</b> of <b>${categories.length}</b> categories`;

            if (!rows.length) {
                document.getElementById('catTableBody').innerHTML = `
      <tr><td colspan="4">
        <div class="empty-state">
          <div class="empty-icon"><svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
          <h3>No categories found</h3><p>Try adjusting your search.</p>
        </div>
      </td></tr>`;
                return;
            }

            document.getElementById('catTableBody').innerHTML = rows.map(c => {
                const col = getColor(c.color);
                return `
      <tr onclick="openViewModal(${c.id})">
        <td>
          <div style="display:flex;align-items:center;gap:.65rem">
            <div class="color-dot" style="background:${col.bg};border-color:${col.dot}80"></div>
            <span style="font-weight:700;font-size:13px;color:var(--ink)">${c.name}</span>
          </div>
        </td>
        <td>
          <span class="pill" style="background:${col.bg};color:${col.text}">
            <span class="pill-dot" style="background:${col.dot}"></span>
            ${c.faqs.length} FAQ${c.faqs.length!==1?'s':''}
          </span>
        </td>
        <td>${colorPill(c.color)}</td>
        <td style="width:2rem"><div class="row-chevron"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg></div></td>
      </tr>`;
            }).join('');
        }

        /* ── Modals ── */
        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }
        document.querySelectorAll('.overlay').forEach(o => o.addEventListener('click', e => {
            if (e.target === o) o.classList.remove('open');
        }));

        /* ── Add / Edit ── */
        function openAddModal() {
            editingId = null;
            document.getElementById('catModalTitle').textContent = 'Add Category';
            document.getElementById('catModalSub').textContent = 'Give the category a name and a color label';
            document.getElementById('fCatName').value = '';
            buildColorPicker('gray');
            openModal('catModal');
        }

        function openEditModal(id) {
            const c = categories.find(x => x.id === id);
            if (!c) return;
            editingId = id;
            document.getElementById('catModalTitle').textContent = 'Edit Category';
            document.getElementById('catModalSub').textContent = c.name;
            document.getElementById('fCatName').value = c.name;
            buildColorPicker(c.color);
            closeModal('viewModal');
            openModal('catModal');
        }

        function submitCatForm() {
            const name = document.getElementById('fCatName').value.trim();
            if (!name) {
                toast('Category name is required.', 'error');
                return;
            }
            const color = document.querySelector('input[name="catColor"]:checked')?.value || 'gray';
            if (editingId) {
                const c = categories.find(x => x.id === editingId);
                if (c) {
                    c.name = name;
                    c.color = color;
                }
                toast('Category updated.', 'success');
            } else {
                const newId = categories.length ? Math.max(...categories.map(x => x.id)) + 1 : 1;
                categories.push({
                    id: newId,
                    name,
                    color,
                    faqs: []
                });
                toast('Category added.', 'success');
            }
            closeModal('catModal');
            render(true);
        }

        /* ── View modal ── */
        function openViewModal(id) {
            const c = categories.find(x => x.id === id);
            if (!c) return;
            const col = getColor(c.color);

            // icon initials
            const iconEl = document.getElementById('vm-icon');
            iconEl.textContent = c.name[0].toUpperCase();
            iconEl.style.background = col.bg;
            iconEl.style.color = col.text;

            document.getElementById('vm-name').textContent = c.name;
            document.getElementById('vm-count').textContent = `${c.faqs.length} FAQ${c.faqs.length!==1?'s':''}`;
            document.getElementById('vm-name2').textContent = c.name;
            document.getElementById('vm-color-pill').innerHTML = colorPill(c.color);
            document.getElementById('vm-faq-count').textContent = c.faqs.length;

            const faqList = document.getElementById('vm-faqs');
            if (c.faqs.length) {
                faqList.innerHTML = c.faqs.map((f, i) => `
      <div class="faq-item">
        <span class="faq-item-num">${i+1}.</span>
        <span>${f}</span>
      </div>`).join('');
            } else {
                faqList.innerHTML = `<div style="font-size:12px;color:var(--muted);padding:.5rem 0;font-style:italic">No FAQ items yet.</div>`;
            }

            document.getElementById('vm-edit-btn').onclick = () => openEditModal(id);
            document.getElementById('vm-delete-btn').onclick = () => {
                closeModal('viewModal');
                confirmDelete(id);
            };
            openModal('viewModal');
        }

        /* ── Confirm delete ── */
        function confirmDelete(id) {
            const c = categories.find(x => x.id === id);
            document.getElementById('confirmTitle').textContent = 'Delete "' + (c ? c.name : 'Category') + '"?';
            document.getElementById('confirmMsg').textContent = c && c.faqs.length ?
                `This will also remove ${c.faqs.length} FAQ${c.faqs.length!==1?'s':''} inside it. This cannot be undone.` :
                'This action cannot be undone.';
            document.getElementById('confirmBtn').onclick = () => {
                categories = categories.filter(x => x.id !== id);
                closeModal('confirmModal');
                render(true);
                toast('Category deleted.', 'success');
            };
            openModal('confirmModal');
        }

        /* ── Toast ── */
        function toast(msg, type = 'info') {
            const icons = {
                success: `<svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>`,
                error: `<svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
            };
            const el = document.createElement('div');
            el.className = `toast ${type}`;
            el.innerHTML = `<span>${icons[type]||''}</span><span>${msg}</span>`;
            document.getElementById('toastWrap').appendChild(el);
            requestAnimationFrame(() => requestAnimationFrame(() => el.classList.add('show')));
            setTimeout(() => {
                el.classList.remove('show');
                setTimeout(() => el.remove(), 350);
            }, 3000);
        }

        /* ── Listener ── */
        document.getElementById('catSearch').addEventListener('input', () => render(true));

        render();
    </script>
</body>

</html>
@endsection