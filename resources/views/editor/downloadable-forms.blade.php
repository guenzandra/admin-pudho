@extends('editor.layout')
@section('content')

<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .df-wrap {
        font-family: Arial, sans-serif;
        background: #f4f4f2;
        min-height: 100vh;
        padding: 36px 28px 80px;
    }

    /* ─── Page Header ─── */
    .df-page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e5e2dc;
    }

    .df-page-header h1 {
        font-size: 26px;
        font-weight: 700;
        color: #1a1a1a;
        letter-spacing: -.3px;
    }

    .df-page-header p {
        font-size: 13.5px;
        color: #777;
        margin-top: 4px;
    }

    /* ─── Card ─── */
    .df-card {
        background: #fff;
        border: 1px solid #e5e2dc;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        overflow: hidden;
        animation: dfCardUp .38s ease both;
    }

    @keyframes dfCardUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .df-card-header {
        background: linear-gradient(90deg, #7f1d1d 0%, #991b1b 55%, #b91c1c 100%);
        padding: 15px 22px;
        border-left: 4px solid #d97706;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .df-card-header h2 {
        font-size: 15px;
        font-weight: 700;
        color: #fff;
    }

    .df-card-body {
        padding: 22px;
    }

    /* ─── Filters ─── */
    .df-filters {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 20px;
    }

    .df-search-wrap {
        flex: 1;
        min-width: 200px;
        position: relative;
    }

    .df-search-wrap svg {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: #bbb;
        pointer-events: none;
    }

    .df-search {
        width: 100%;
        padding: 8px 12px 8px 34px;
        border: 1px solid #e0ddd8;
        border-radius: 7px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        background: #fafaf8;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .df-search:focus {
        border-color: #b91c1c;
        box-shadow: 0 0 0 3px rgba(185, 28, 28, .07);
        background: #fff;
    }

    .df-filter-sel {
        padding: 8px 12px;
        border: 1px solid #e0ddd8;
        border-radius: 7px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        background: #fafaf8;
        color: #333;
        outline: none;
        cursor: pointer;
        transition: border-color .15s;
    }

    .df-filter-sel:focus {
        border-color: #b91c1c;
    }

    /* ─── Table ─── */
    .df-table-wrap {
        overflow-x: auto;
    }

    table.df-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }

    .df-table thead tr {
        border-bottom: 2px solid #e5e2dc;
    }

    .df-table th {
        padding: 10px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #999;
        white-space: nowrap;
    }

    .df-table tbody tr {
        border-bottom: 1px solid #f0eeea;
        cursor: pointer;
        transition: background .12s;
    }

    .df-table tbody tr:hover {
        background: #fafaf8;
    }

    .df-table tbody tr:hover .df-file-name {
        color: #b91c1c;
    }

    .df-table td {
        padding: 13px 16px;
        vertical-align: middle;
    }

    /* File cell */
    .df-file-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .df-file-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .df-file-icon svg {
        width: 17px;
        height: 17px;
    }

    .df-file-name {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 13.5px;
        line-height: 1.3;
        transition: color .15s;
    }

    .df-file-slug {
        font-size: 11.5px;
        color: #bbb;
        margin-top: 2px;
    }

    /* Category badges */
    .df-cat {
        display: inline-flex;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
        white-space: nowrap;
    }

    .cat-application {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .cat-requirements {
        background: #ede9fe;
        color: #6d28d9;
    }

    .cat-certification {
        background: #dcfce7;
        color: #166534;
    }

    .cat-permit {
        background: #fef3c7;
        color: #b45309;
    }

    .cat-complaint {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* Date cell */
    .df-date-cell {
        font-size: 13px;
        white-space: nowrap;
        line-height: 1.5;
    }

    .df-date-cell .d-main {
        font-weight: 700;
        color: #1a1a1a;
    }

    .df-date-cell .d-year {
        font-size: 11.5px;
        color: #aaa;
        display: block;
    }

    /* Size cell */
    .df-size-cell {
        font-size: 13px;
        font-weight: 600;
        color: #555;
        white-space: nowrap;
    }

    /* ─── Skeleton loader ─── */
    .df-skel {
        animation: dfPulse 1.65s ease-in-out infinite;
    }

    @keyframes dfPulse {

        0%,
        100% {
            opacity: 1
        }

        50% {
            opacity: .38
        }
    }

    .df-skel-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 15px 16px;
        border-bottom: 1px solid #f0eeea;
    }

    .df-skel-block {
        background: #e8e5e0;
        border-radius: 5px;
        flex-shrink: 0;
    }

    /* ─── Empty state ─── */
    .df-empty {
        text-align: center;
        padding: 52px 20px;
        color: #bbb;
        font-size: 13px;
    }

    .df-empty-title {
        font-size: 15px;
        font-weight: 700;
        color: #888;
        margin-bottom: 4px;
    }

    /* ─── Pagination ─── */
    .df-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 18px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .df-pagination-info {
        font-size: 12.5px;
        color: #888;
    }

    .df-pagination-btns {
        display: flex;
        gap: 4px;
    }

    .df-pg-btn {
        padding: 5px 11px;
        border: 1px solid #e0ddd8;
        border-radius: 6px;
        font-family: Arial, sans-serif;
        font-size: 12.5px;
        background: #fff;
        color: #555;
        cursor: pointer;
        transition: all .14s;
    }

    .df-pg-btn:hover:not(:disabled) {
        border-color: #b91c1c;
        color: #b91c1c;
    }

    .df-pg-btn.active {
        background: #b91c1c;
        color: #fff;
        border-color: #b91c1c;
    }

    .df-pg-btn:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    /* ─── Buttons ─── */
    .df-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        border-radius: 7px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        transition: filter .15s, transform .15s, box-shadow .15s;
    }

    .df-btn svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
    }

    .df-btn:hover:not(:disabled) {
        filter: brightness(.91);
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, .12);
    }

    .df-btn:active:not(:disabled) {
        transform: none;
        box-shadow: none;
    }

    .df-btn:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .df-btn-amber {
        background: #d97706;
        color: #fff;
    }

    .df-btn-green {
        background: #15803d;
        color: #fff;
    }

    .df-btn-blue {
        background: #1d4ed8;
        color: #fff;
    }

    .df-btn-danger {
        background: #dc2626;
        color: #fff;
    }

    .df-btn-ghost {
        background: #f3f2ef;
        color: #333;
        border: 1px solid #e0ddd8;
    }

    .df-btn-ghost:hover:not(:disabled) {
        filter: none;
        transform: none;
        box-shadow: none;
        background: #e8e6e1;
    }

    /* ─── Modals ─── */
    .df-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .52);
        backdrop-filter: blur(3px);
        z-index: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        opacity: 0;
        pointer-events: none;
        transition: opacity .22s;
    }

    .df-backdrop.open {
        opacity: 1;
        pointer-events: all;
    }

    .df-modal {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .2), 0 6px 20px rgba(0, 0, 0, .1);
        width: 100%;
        max-width: 560px;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(.96) translateY(10px);
        transition: transform .26s cubic-bezier(.34, 1.56, .64, 1);
    }

    .df-backdrop.open .df-modal {
        transform: none;
    }

    .df-modal.sm {
        max-width: 400px;
    }

    .df-modal.wide {
        max-width: 640px;
    }

    .df-modal-head {
        padding: 18px 22px 16px;
        border-bottom: 1px solid #e5e2dc;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        position: sticky;
        top: 0;
        background: #fff;
        z-index: 2;
        border-radius: 12px 12px 0 0;
    }

    .df-modal-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .df-modal-subtitle {
        font-size: 12px;
        color: #999;
        margin-top: 3px;
    }

    .df-modal-x {
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        border: 1px solid #e5e2dc;
        background: #f3f2ef;
        border-radius: 7px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        transition: all .15s;
    }

    .df-modal-x:hover {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fca5a5;
    }

    .df-modal-x svg {
        width: 14px;
        height: 14px;
    }

    .df-modal-body {
        padding: 22px;
    }

    .df-modal-foot {
        padding: 14px 22px;
        border-top: 1px solid #e5e2dc;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        position: sticky;
        bottom: 0;
        background: #fff;
        border-radius: 0 0 12px 12px;
    }

    /* ─── Form fields ─── */
    .df-field {
        margin-bottom: 16px;
    }

    .df-field label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #888;
        margin-bottom: 6px;
    }

    .df-field label .req {
        color: #dc2626;
    }

    .df-input,
    .df-textarea,
    .df-select {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #e0ddd8;
        border-radius: 7px;
        font-family: Arial, sans-serif;
        font-size: 13.5px;
        color: #1a1a1a;
        background: #fafaf8;
        outline: none;
        transition: border-color .15s, box-shadow .15s, background .15s;
    }

    .df-input:focus,
    .df-textarea:focus,
    .df-select:focus {
        border-color: #b91c1c;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(185, 28, 28, .07);
    }

    .df-textarea {
        resize: vertical;
        min-height: 90px;
        line-height: 1.65;
    }

    .df-input.err,
    .df-textarea.err,
    .df-select.err {
        border-color: #dc2626 !important;
        animation: dfShake .36s ease;
    }

    @keyframes dfShake {

        0%,
        100% {
            transform: none
        }

        20% {
            transform: translateX(-5px)
        }

        40% {
            transform: translateX(5px)
        }

        60% {
            transform: translateX(-3px)
        }

        80% {
            transform: translateX(3px)
        }
    }

    /* Drop zone */
    .df-drop {
        border: 2px dashed #d5d2cc;
        border-radius: 9px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color .18s, background .18s;
        position: relative;
    }

    .df-drop input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .df-drop:hover,
    .df-drop.over {
        border-color: #b91c1c;
        background: #fff5f5;
    }

    .df-drop-icon {
        color: #ddd;
        margin-bottom: 10px;
    }

    .df-drop-title {
        font-size: 13px;
        color: #555;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .df-drop-hint {
        font-size: 11.5px;
        color: #bbb;
    }

    /* File pill */
    .df-file-pill {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 14px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        margin-top: 12px;
        animation: dfCardUp .24s ease;
    }

    .df-file-pill svg {
        width: 20px;
        height: 20px;
        color: #15803d;
        flex-shrink: 0;
    }

    .df-file-pill-name {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .df-file-pill-size {
        font-size: 11.5px;
        color: #777;
    }

    /* Current file block (replace modal) */
    .df-cur-file {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        background: #fafaf8;
        border: 1px solid #e0ddd8;
        border-radius: 8px;
        margin-bottom: 18px;
    }

    .df-cur-file svg {
        width: 20px;
        height: 20px;
        color: #b91c1c;
        flex-shrink: 0;
    }

    .df-cur-file-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .df-cur-file-meta {
        font-size: 12px;
        color: #aaa;
        margin-top: 2px;
    }

    /* View modal file header */
    .df-view-hero {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        background: #fafaf8;
        border: 1px solid #e0ddd8;
        border-radius: 8px;
        margin-bottom: 18px;
    }

    .df-view-hero-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .df-view-hero-icon svg {
        width: 22px;
        height: 22px;
    }

    .df-view-hero-name {
        font-size: 15px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.3;
    }

    .df-view-hero-slug {
        font-size: 12px;
        color: #bbb;
        margin-top: 2px;
    }

    .df-view-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 14px;
    }

    .df-view-cell {
        padding: 11px 14px;
        background: #fafaf8;
        border: 1px solid #e0ddd8;
        border-radius: 8px;
    }

    .df-view-cell-lbl {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #bbb;
        margin-bottom: 4px;
    }

    .df-view-cell-val {
        font-size: 13.5px;
        font-weight: 700;
        color: #1a1a1a;
    }

    /* Warning notice */
    .df-notice {
        display: flex;
        gap: 10px;
        padding: 11px 14px;
        border-radius: 8px;
        font-size: 12.5px;
        line-height: 1.55;
        margin-bottom: 18px;
    }

    .df-notice svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .df-notice-warn {
        background: #fffbeb;
        border: 1px solid #fde68a;
        color: #92400e;
    }

    /* Confirm modal */
    .df-confirm-body {
        text-align: center;
        padding: 32px 28px 24px;
    }

    .df-confirm-ring {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
    }

    .df-confirm-ring.red {
        background: #fee2e2;
    }

    .df-confirm-title {
        font-size: 17px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .df-confirm-text {
        font-size: 13px;
        color: #666;
        line-height: 1.6;
    }

    .df-divider {
        height: 1px;
        background: #e5e2dc;
        margin: 14px 0;
    }

    /* ─── Spinner ─── */
    .df-spinner {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
        border: 2px solid rgba(255, 255, 255, .35);
        border-top-color: #fff;
        border-radius: 50%;
        animation: dfSpin .65s linear infinite;
    }

    @keyframes dfSpin {
        to {
            transform: rotate(360deg);
        }
    }

    /* ─── Toast Stack ─── */
    #df-toasts {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 9px;
        pointer-events: none;
    }

    .df-toast {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 14px;
        background: #fff;
        border: 1px solid #e5e2dc;
        border-radius: 10px;
        box-shadow: 0 8px 28px rgba(0, 0, 0, .12);
        min-width: 260px;
        max-width: 340px;
        pointer-events: all;
        position: relative;
        overflow: hidden;
        animation: dfToastIn .3s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    .df-toast.out {
        animation: dfToastOut .25s ease both;
    }

    @keyframes dfToastIn {
        from {
            opacity: 0;
            transform: translateX(30px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    @keyframes dfToastOut {
        from {
            opacity: 1;
            transform: none
        }

        to {
            opacity: 0;
            transform: translateX(30px)
        }
    }

    .df-toast-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        transform-origin: left;
        animation: dfBarShrink 3.3s linear forwards;
    }

    @keyframes dfBarShrink {
        from {
            transform: scaleX(1)
        }

        to {
            transform: scaleX(0)
        }
    }

    .df-toast-ico {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .df-toast-title {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .df-toast-msg {
        font-size: 12px;
        color: #666;
        margin-top: 1px;
    }

    .df-toast-x {
        background: none;
        border: none;
        cursor: pointer;
        color: #bbb;
        font-size: 16px;
        line-height: 1;
        padding: 0 2px;
        margin-left: auto;
        transition: color .12s;
    }

    .df-toast-x:hover {
        color: #333;
    }

    .df-toast.success .df-toast-ico {
        color: #15803d;
    }

    .df-toast.success .df-toast-bar {
        background: #22c55e;
    }

    .df-toast.error .df-toast-ico {
        color: #dc2626;
    }

    .df-toast.error .df-toast-bar {
        background: #dc2626;
    }

    .df-toast.warning .df-toast-ico {
        color: #d97706;
    }

    .df-toast.warning .df-toast-bar {
        background: #d97706;
    }

    .df-toast.info .df-toast-ico {
        color: #1d4ed8;
    }

    .df-toast.info .df-toast-bar {
        background: #1d4ed8;
    }

    @media(max-width:640px) {
        .df-wrap {
            padding: 18px 14px 60px;
        }

        .df-card-body {
            padding: 14px;
        }

        .df-table th:nth-child(3),
        .df-table td:nth-child(3),
        .df-table th:nth-child(4),
        .df-table td:nth-child(4) {
            display: none;
        }

        .df-view-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="df-wrap">

    {{-- ── Page Header ── --}}
    <div class="df-page-header">
        <div>
            <h1>Downloadable Forms</h1>
            <p>Manage and organize downloadable forms for public access</p>
        </div>
        <button class="df-btn df-btn-amber" onclick="dfOpenModal('dfUploadModal')">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="16 16 12 12 8 16" />
                <line x1="12" y1="12" x2="12" y2="21" />
                <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3" />
            </svg>
            Upload Form
        </button>
    </div>

    {{-- ── Main Card ── --}}
    <div class="df-card">
        <div class="df-card-header">
            <h2>Forms Directory</h2>
        </div>
        <div class="df-card-body">

            {{-- Filters --}}
            <div class="df-filters">
                <div class="df-search-wrap">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input type="text" class="df-search" id="dfSearch" placeholder="Search forms..." oninput="dfRender()">
                </div>
                <select class="df-filter-sel" id="dfCatFilter" onchange="dfRender()">
                    <option value="all">All Categories</option>
                    <option value="application">Application Forms</option>
                    <option value="requirements">Requirements</option>
                    <option value="certification">Certification</option>
                    <option value="permit">Permit Forms</option>
                    <option value="complaint">Complaint Forms</option>
                </select>
            </div>

            {{-- Skeleton --}}
            <div id="dfSkeleton">
                @for($i = 0; $i < 5; $i++)
                    <div class="df-skel-row df-skel">
                    <div class="df-skel-block" style="width:38px;height:38px;border-radius:8px;"></div>
                    <div style="flex:1;display:flex;flex-direction:column;gap:7px;">
                        <div class="df-skel-block" style="width:40%;height:13px;"></div>
                        <div class="df-skel-block" style="width:25%;height:11px;"></div>
                    </div>
                    <div class="df-skel-block" style="width:11%;height:13px;"></div>
                    <div class="df-skel-block" style="width:9%;height:13px;"></div>
                    <div class="df-skel-block" style="width:7%;height:13px;"></div>
            </div>
            @endfor
        </div>

        {{-- Table --}}
        <div class="df-table-wrap" id="dfTableWrap" style="display:none;">
            <table class="df-table">
                <thead>
                    <tr>
                        <th style="width:46%">File Name</th>
                        <th>Category</th>
                        <th>Upload Date</th>
                        <th>Size</th>
                    </tr>
                </thead>
                <tbody id="dfTbody"></tbody>
            </table>

            <div id="dfEmpty" class="df-empty" style="display:none;">
                <div class="df-empty-title">No forms found</div>
                <div>Try adjusting your search or filter.</div>
            </div>

            <div class="df-pagination">
                <div class="df-pagination-info" id="dfPagInfo"></div>
                <div class="df-pagination-btns" id="dfPagBtns"></div>
            </div>
        </div>

    </div>
</div>

</div>

<div id="df-toasts"></div>

{{-- ── Upload Modal ── --}}
<div class="df-backdrop" id="dfUploadModal">
    <div class="df-modal wide">
        <div class="df-modal-head">
            <div>
                <div class="df-modal-title">Upload New Form</div>
                <div class="df-modal-subtitle">Add a downloadable form to the public directory</div>
            </div>
            <button class="df-modal-x" onclick="dfCloseModal('dfUploadModal')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="df-modal-body">
            <div class="df-field">
                <label>Display Name <span class="req">*</span></label>
                <input type="text" class="df-input" id="upName" placeholder="e.g. Housing Application Form">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#888;margin-bottom:6px;">
                        Category <span style="color:#dc2626;">*</span>
                    </label>
                    <select class="df-select" id="upCat">
                        <option value="">— Select —</option>
                        <option value="application">Application Forms</option>
                        <option value="requirements">Requirements</option>
                        <option value="certification">Certification</option>
                        <option value="permit">Permit Forms</option>
                        <option value="complaint">Complaint Forms</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#888;margin-bottom:6px;">
                        Description
                    </label>
                    <input type="text" class="df-input" id="upDesc" placeholder="Short description (optional)">
                </div>
            </div>
            <div>
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#888;margin-bottom:6px;">
                    File <span style="color:#dc2626;">*</span>
                </label>
                <div class="df-drop" id="upDrop">
                    <input type="file" id="upFile" accept=".pdf,.doc,.docx"
                        onchange="dfHandleFile(this,'upPill','upPillName','upPillSize')">
                    <div class="df-drop-icon">
                        <svg width="38" height="38" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <polyline points="16 16 12 12 8 16" />
                            <line x1="12" y1="12" x2="12" y2="21" />
                            <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3" />
                        </svg>
                    </div>
                    <div class="df-drop-title">Click to browse or drag and drop</div>
                    <div class="df-drop-hint">PDF, DOC, DOCX &mdash; up to 10 MB</div>
                </div>
                <div class="df-file-pill" id="upPill" style="display:none;">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                    <div>
                        <div class="df-file-pill-name" id="upPillName">—</div>
                        <div class="df-file-pill-size" id="upPillSize">—</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="df-modal-foot">
            <button class="df-btn df-btn-ghost" onclick="dfCloseModal('dfUploadModal')">Cancel</button>
            <button class="df-btn df-btn-amber" id="upBtn" onclick="dfDoUpload()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="16 16 12 12 8 16" />
                    <line x1="12" y1="12" x2="12" y2="21" />
                    <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3" />
                </svg>
                Upload File
            </button>
        </div>
    </div>
</div>

{{-- ── View Modal ── --}}
<div class="df-backdrop" id="dfViewModal">
    <div class="df-modal">
        <div class="df-modal-head">
            <div>
                <div class="df-modal-title">File Details</div>
                <div class="df-modal-subtitle" id="dfViewSub">—</div>
            </div>
            <button class="df-modal-x" onclick="dfCloseModal('dfViewModal')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="df-modal-body">
            <div class="df-view-hero">
                <div class="df-view-hero-icon" id="dfViewIcon">
                    <svg fill="none" stroke="#1d4ed8" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                    </svg>
                </div>
                <div>
                    <div class="df-view-hero-name" id="dfViewName">—</div>
                    <div class="df-view-hero-slug" id="dfViewSlug">—</div>
                </div>
            </div>
            <div class="df-view-grid">
                <div class="df-view-cell">
                    <div class="df-view-cell-lbl">Category</div>
                    <div class="df-view-cell-val" id="dfViewCat">—</div>
                </div>
                <div class="df-view-cell">
                    <div class="df-view-cell-lbl">File Size</div>
                    <div class="df-view-cell-val" id="dfViewSize">—</div>
                </div>
                <div class="df-view-cell">
                    <div class="df-view-cell-lbl">Upload Date</div>
                    <div class="df-view-cell-val" id="dfViewDate">—</div>
                </div>
                <div class="df-view-cell">
                    <div class="df-view-cell-lbl">File Type</div>
                    <div class="df-view-cell-val" id="dfViewType">—</div>
                </div>
            </div>
            <div class="df-view-cell" id="dfViewDescBlock">
                <div class="df-view-cell-lbl">Description</div>
                <div style="font-size:13px;color:#555;line-height:1.6;font-weight:400;" id="dfViewDesc">—</div>
            </div>
        </div>
        <div class="df-modal-foot">
            <button class="df-btn df-btn-ghost" onclick="dfCloseModal('dfViewModal')">Close</button>
            <button class="df-btn df-btn-danger" onclick="dfTriggerDeleteFromView()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                    <path d="M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                </svg>
                Delete
            </button>
            <button class="df-btn df-btn-green" onclick="dfTriggerReplaceFromView()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="1 4 1 10 7 10" />
                    <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
                </svg>
                Replace File
            </button>
            <button class="df-btn df-btn-blue" onclick="dfTriggerEditFromView()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit Details
            </button>
        </div>
    </div>
</div>

{{-- ── Edit Modal ── --}}
<div class="df-backdrop" id="dfEditModal">
    <div class="df-modal">
        <div class="df-modal-head">
            <div>
                <div class="df-modal-title">Edit File Details</div>
                <div class="df-modal-subtitle">Update name, category, or description</div>
            </div>
            <button class="df-modal-x" onclick="dfCloseModal('dfEditModal')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="df-modal-body">
            <div class="df-field">
                <label>Display Name <span class="req">*</span></label>
                <input type="text" class="df-input" id="edName" placeholder="e.g. Housing Application Form">
            </div>
            <div class="df-field">
                <label>Category <span class="req">*</span></label>
                <select class="df-select" id="edCat">
                    <option value="application">Application Forms</option>
                    <option value="requirements">Requirements</option>
                    <option value="certification">Certification</option>
                    <option value="permit">Permit Forms</option>
                    <option value="complaint">Complaint Forms</option>
                </select>
            </div>
            <div class="df-field" style="margin-bottom:0;">
                <label>Description</label>
                <textarea class="df-textarea" id="edDesc" rows="3" placeholder="Short description (optional)"></textarea>
            </div>
        </div>
        <div class="df-modal-foot">
            <button class="df-btn df-btn-ghost" onclick="dfCloseModal('dfEditModal')">Cancel</button>
            <button class="df-btn df-btn-amber" id="edBtn" onclick="dfDoEdit()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                Save Changes
            </button>
        </div>
    </div>
</div>

{{-- ── Replace Modal ── --}}
<div class="df-backdrop" id="dfReplaceModal">
    <div class="df-modal wide">
        <div class="df-modal-head">
            <div>
                <div class="df-modal-title">Replace File</div>
                <div class="df-modal-subtitle">Upload a new file to overwrite the current one</div>
            </div>
            <button class="df-modal-x" onclick="dfCloseModal('dfReplaceModal')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="df-modal-body">
            <div class="df-notice df-notice-warn">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    <line x1="12" y1="9" x2="12" y2="13" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
                <span><strong>Warning:</strong> This will permanently overwrite the existing file and cannot be undone.</span>
            </div>
            <div style="margin-bottom:18px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#888;margin-bottom:8px;">Current File</label>
                <div class="df-cur-file">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                    <div>
                        <div class="df-cur-file-name" id="repCurName">—</div>
                        <div class="df-cur-file-meta" id="repCurMeta">—</div>
                    </div>
                </div>
            </div>
            <div>
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#888;margin-bottom:8px;">
                    New File <span style="color:#dc2626;">*</span>
                </label>
                <div class="df-drop" id="repDrop">
                    <input type="file" id="repFile" accept=".pdf,.doc,.docx"
                        onchange="dfHandleFile(this,'repPill','repPillName','repPillSize')">
                    <div class="df-drop-icon">
                        <svg width="38" height="38" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <polyline points="1 4 1 10 7 10" />
                            <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
                        </svg>
                    </div>
                    <div class="df-drop-title">Click to browse or drag and drop</div>
                    <div class="df-drop-hint">PDF, DOC, DOCX &mdash; up to 10 MB</div>
                </div>
                <div class="df-file-pill" id="repPill" style="display:none;">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                    <div>
                        <div class="df-file-pill-name" id="repPillName">—</div>
                        <div class="df-file-pill-size" id="repPillSize">—</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="df-modal-foot">
            <button class="df-btn df-btn-ghost" onclick="dfCloseModal('dfReplaceModal')">Cancel</button>
            <button class="df-btn df-btn-green" id="repBtn" onclick="dfDoReplace()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="1 4 1 10 7 10" />
                    <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
                </svg>
                Replace File
            </button>
        </div>
    </div>
</div>

{{-- ── Delete Confirm Modal ── --}}
<div class="df-backdrop" id="dfDeleteModal">
    <div class="df-modal sm">
        <div class="df-confirm-body">
            <div class="df-confirm-ring red">
                <svg width="24" height="24" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                    <path d="M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                </svg>
            </div>
            <div class="df-confirm-title">Delete this file?</div>
            <div class="df-confirm-text">
                <strong id="dfDelName"></strong> will be permanently removed and will no longer be accessible to the public. This cannot be undone.
            </div>
        </div>
        <div class="df-modal-foot" style="justify-content:center;">
            <button class="df-btn df-btn-ghost" onclick="dfCloseModal('dfDeleteModal')">Cancel</button>
            <button class="df-btn df-btn-danger" id="delBtn" onclick="dfDoDelete()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:15px;height:15px;">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                </svg>
                Yes, Delete
            </button>
        </div>
    </div>
</div>

<script>
    (function() {

        // ── Data ──
        let dfData = [{
                id: 1,
                name: 'Housing Application Form',
                slug: 'housing_application.pdf',
                category: 'application',
                date: '2026-03-01',
                size: '2.4 MB',
                type: 'PDF',
                desc: 'Complete application form for housing assistance programs.'
            },
            {
                id: 2,
                name: 'Requirements Checklist',
                slug: 'requirements_checklist.pdf',
                category: 'requirements',
                date: '2026-02-28',
                size: '1.8 MB',
                type: 'PDF',
                desc: 'Checklist of all required documents for various services.'
            },
            {
                id: 3,
                name: 'Residence Certification',
                slug: 'residence_certification.pdf',
                category: 'certification',
                date: '2026-02-25',
                size: '3.2 MB',
                type: 'PDF',
                desc: 'Official residence certification form for residents.'
            },
            {
                id: 4,
                name: 'Business Permit Application',
                slug: 'business_permit.pdf',
                category: 'permit',
                date: '2026-02-20',
                size: '4.1 MB',
                type: 'PDF',
                desc: 'Application form for business permits and licenses.'
            },
            {
                id: 5,
                name: 'Complaint Form',
                slug: 'complaint_form.pdf',
                category: 'complaint',
                date: '2026-02-15',
                size: '1.5 MB',
                type: 'PDF',
                desc: 'Official form for filing complaints and feedback.'
            },
        ];

        const CAT_LABEL = {
            application: 'Application Forms',
            requirements: 'Requirements',
            certification: 'Certification',
            permit: 'Permit Forms',
            complaint: 'Complaint Forms'
        };
        const CAT_CLASS = {
            application: 'cat-application',
            requirements: 'cat-requirements',
            certification: 'cat-certification',
            permit: 'cat-permit',
            complaint: 'cat-complaint'
        };
        const ICON_BG = {
            application: '#dbeafe',
            requirements: '#ede9fe',
            certification: '#dcfce7',
            permit: '#fef3c7',
            complaint: '#fee2e2'
        };
        const ICON_CLR = {
            application: '#1d4ed8',
            requirements: '#6d28d9',
            certification: '#166534',
            permit: '#b45309',
            complaint: '#b91c1c'
        };

        let dfPage = 1;
        let activeId = null;
        let deleteId = null;
        let nextId = 6;
        const PER = 10;

        // ── Helpers ──
        function fmtDate(raw) {
            if (!raw) return {
                short: '—',
                year: '',
                full: '—'
            };
            const d = new Date(raw + 'T00:00:00');
            const mo = d.toLocaleDateString('en-US', {
                month: 'short'
            });
            return {
                short: `${mo} ${d.getDate()},`,
                year: d.getFullYear(),
                full: `${mo} ${d.getDate()}, ${d.getFullYear()}`
            };
        }

        function fileIconSvg(cat, size = 17) {
            const clr = ICON_CLR[cat] || '#475569';
            return `<svg fill="none" stroke="${clr}" stroke-width="2" viewBox="0 0 24 24" style="width:${size}px;height:${size}px;"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>`;
        }

        // ── Init ──
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.getElementById('dfSkeleton').style.display = 'none';
                document.getElementById('dfTableWrap').style.display = 'block';
                dfRender();
            }, 850);
            setupDragDrop('upDrop', 'upFile', 'upPill', 'upPillName', 'upPillSize');
            setupDragDrop('repDrop', 'repFile', 'repPill', 'repPillName', 'repPillSize');
        });

        // ── Render table ──
        window.dfRender = function() {
            const q = document.getElementById('dfSearch').value.toLowerCase();
            const cat = document.getElementById('dfCatFilter').value;
            const list = dfData.filter(f => {
                if (cat !== 'all' && f.category !== cat) return false;
                if (q && !f.name.toLowerCase().includes(q) && !f.slug.toLowerCase().includes(q)) return false;
                return true;
            });
            const total = list.length;
            const pages = Math.max(1, Math.ceil(total / PER));
            if (dfPage > pages) dfPage = pages;
            const slice = list.slice((dfPage - 1) * PER, dfPage * PER);

            const tbody = document.getElementById('dfTbody');
            const empty = document.getElementById('dfEmpty');

            if (!slice.length) {
                tbody.innerHTML = '';
                empty.style.display = 'block';
            } else {
                empty.style.display = 'none';
                tbody.innerHTML = slice.map(f => {
                    const d = fmtDate(f.date);
                    const bg = ICON_BG[f.category] || '#f1f5f9';
                    return `<tr onclick="dfOpenView(${f.id})">
                <td>
                    <div class="df-file-cell">
                        <div class="df-file-icon" style="background:${bg};">${fileIconSvg(f.category)}</div>
                        <div>
                            <div class="df-file-name">${f.name}</div>
                            <div class="df-file-slug">${f.slug}</div>
                        </div>
                    </div>
                </td>
                <td><span class="df-cat ${CAT_CLASS[f.category] || ''}">${CAT_LABEL[f.category] || f.category}</span></td>
                <td>
                    <div class="df-date-cell">
                        <span class="d-main">${d.short}</span>
                        <span class="d-year">${d.year}</span>
                    </div>
                </td>
                <td><span class="df-size-cell">${f.size}</span></td>
            </tr>`;
                }).join('');
            }

            // Pagination
            document.getElementById('dfPagInfo').textContent = `Showing ${slice.length} of ${total} form${total !== 1 ? 's' : ''}`;
            const btns = document.getElementById('dfPagBtns');
            btns.innerHTML = '';
            const mk = (label, p, dis, act) => {
                const b = document.createElement('button');
                b.className = 'df-pg-btn' + (act ? ' active' : '');
                b.textContent = label;
                b.disabled = dis;
                b.onclick = () => {
                    dfPage = p;
                    dfRender();
                };
                return b;
            };
            btns.appendChild(mk('Prev', dfPage - 1, dfPage === 1, false));
            for (let i = 1; i <= pages; i++) btns.appendChild(mk(i, i, false, i === dfPage));
            btns.appendChild(mk('Next', dfPage + 1, dfPage === pages, false));
        };

        // ── View ──
        window.dfOpenView = function(id) {
            const f = dfData.find(x => x.id === id);
            if (!f) return;
            activeId = id;
            const d = fmtDate(f.date);
            document.getElementById('dfViewName').textContent = f.name;
            document.getElementById('dfViewSlug').textContent = f.slug;
            document.getElementById('dfViewSub').textContent = f.slug;
            document.getElementById('dfViewCat').textContent = CAT_LABEL[f.category] || f.category;
            document.getElementById('dfViewSize').textContent = f.size;
            document.getElementById('dfViewDate').textContent = d.full;
            document.getElementById('dfViewType').textContent = f.type;
            document.getElementById('dfViewDesc').textContent = f.desc || '—';
            const icon = document.getElementById('dfViewIcon');
            icon.style.background = ICON_BG[f.category] || '#f1f5f9';
            icon.innerHTML = fileIconSvg(f.category, 22);
            dfOpenModal('dfViewModal');
        };

        window.dfTriggerEditFromView = () => {
            dfCloseModal('dfViewModal');
            setTimeout(() => dfOpenEdit(activeId), 200);
        };
        window.dfTriggerReplaceFromView = () => {
            dfCloseModal('dfViewModal');
            setTimeout(() => dfOpenReplace(activeId), 200);
        };
        window.dfTriggerDeleteFromView = () => {
            deleteId = activeId;
            dfCloseModal('dfViewModal');
            setTimeout(() => {
                document.getElementById('dfDelName').textContent = dfData.find(x => x.id === deleteId)?.name || '';
                dfOpenModal('dfDeleteModal');
            }, 200);
        };

        // ── Edit ──
        function dfOpenEdit(id) {
            const f = dfData.find(x => x.id === id);
            if (!f) return;
            activeId = id;
            document.getElementById('edName').value = f.name;
            document.getElementById('edCat').value = f.category;
            document.getElementById('edDesc').value = f.desc || '';
            dfOpenModal('dfEditModal');
        }
        window.dfDoEdit = function() {
            const name = document.getElementById('edName').value.trim();
            const cat = document.getElementById('edCat').value;
            if (!name) {
                shake('edName');
                dfToast('warning', 'Missing Name', 'Please enter a display name.');
                return;
            }
            const btn = document.getElementById('edBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<div class="df-spinner"></div> Saving...';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                const f = dfData.find(x => x.id === activeId);
                if (f) {
                    f.name = name;
                    f.category = cat;
                    f.desc = document.getElementById('edDesc').value.trim();
                }
                dfCloseModal('dfEditModal');
                dfRender();
                dfToast('success', 'Details Updated', 'File details have been saved.');
            }, 1100);
        };

        // ── Replace ──
        function dfOpenReplace(id) {
            const f = dfData.find(x => x.id === id);
            if (!f) return;
            activeId = id;
            const d = fmtDate(f.date);
            document.getElementById('repCurName').textContent = f.name;
            document.getElementById('repCurMeta').textContent = `${f.size} · ${d.full}`;
            document.getElementById('repPill').style.display = 'none';
            document.getElementById('repFile').value = '';
            dfOpenModal('dfReplaceModal');
        }
        window.dfDoReplace = function() {
            const file = document.getElementById('repFile').files[0];
            if (!file) {
                dfToast('warning', 'No File Selected', 'Please choose a replacement file.');
                return;
            }
            const btn = document.getElementById('repBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<div class="df-spinner"></div> Replacing...';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                const f = dfData.find(x => x.id === activeId);
                if (f) {
                    f.slug = file.name;
                    f.size = (file.size / 1024 / 1024).toFixed(1) + ' MB';
                    f.type = file.name.split('.').pop().toUpperCase();
                    f.date = new Date().toISOString().slice(0, 10);
                }
                dfCloseModal('dfReplaceModal');
                dfRender();
                dfToast('success', 'File Replaced', 'The form has been replaced successfully.');
            }, 1600);
        };

        // ── Upload ──
        window.dfDoUpload = function() {
            const name = document.getElementById('upName').value.trim();
            const cat = document.getElementById('upCat').value;
            const file = document.getElementById('upFile').files[0];
            let ok = true;
            if (!name) {
                shake('upName');
                ok = false;
            }
            if (!cat) {
                shake('upCat');
                ok = false;
            }
            if (!ok) {
                dfToast('warning', 'Missing Fields', 'Please fill in all required fields.');
                return;
            }
            if (!file) {
                dfToast('warning', 'No File Selected', 'Please choose a file to upload.');
                return;
            }

            const btn = document.getElementById('upBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<div class="df-spinner"></div> Uploading...';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                dfData.unshift({
                    id: nextId++,
                    name,
                    slug: file.name,
                    category: cat,
                    date: new Date().toISOString().slice(0, 10),
                    size: (file.size / 1024 / 1024).toFixed(1) + ' MB',
                    type: file.name.split('.').pop().toUpperCase(),
                    desc: document.getElementById('upDesc').value.trim()
                });
                ['upName', 'upDesc'].forEach(id => document.getElementById(id).value = '');
                document.getElementById('upCat').value = '';
                document.getElementById('upFile').value = '';
                document.getElementById('upPill').style.display = 'none';
                dfCloseModal('dfUploadModal');
                dfPage = 1;
                dfRender();
                dfToast('success', 'Form Uploaded', 'The new form is now available for download.');
            }, 1800);
        };

        // ── Delete ──
        window.dfDoDelete = function() {
            const btn = document.getElementById('delBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<div class="df-spinner"></div> Deleting...';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                dfData = dfData.filter(x => x.id !== deleteId);
                dfCloseModal('dfDeleteModal');
                dfRender();
                dfToast('error', 'File Deleted', 'The form has been permanently removed.');
            }, 1000);
        };

        // ── File input handler ──
        window.dfHandleFile = function(input, pillId, nameId, sizeId) {
            const file = input.files[0];
            if (!file) return;
            const valid = ['.pdf', '.doc', '.docx'];
            if (!valid.some(e => file.name.toLowerCase().endsWith(e))) {
                dfToast('error', 'Invalid File Type', 'Only PDF, DOC, or DOCX files are accepted.');
                input.value = '';
                return;
            }
            if (file.size > 10 * 1024 * 1024) {
                dfToast('error', 'File Too Large', 'Maximum allowed size is 10 MB.');
                input.value = '';
                return;
            }
            document.getElementById(nameId).textContent = file.name;
            document.getElementById(sizeId).textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            document.getElementById(pillId).style.display = 'flex';
        };

        // ── Drag & drop ──
        function setupDragDrop(zoneId, inputId, pillId, nameId, sizeId) {
            const dz = document.getElementById(zoneId);
            if (!dz) return;
            dz.addEventListener('dragover', e => {
                e.preventDefault();
                dz.classList.add('over');
            });
            dz.addEventListener('dragleave', () => dz.classList.remove('over'));
            dz.addEventListener('drop', e => {
                e.preventDefault();
                dz.classList.remove('over');
                const file = e.dataTransfer.files[0];
                if (!file) return;
                try {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    const inp = document.getElementById(inputId);
                    inp.files = dt.files;
                    dfHandleFile(inp, pillId, nameId, sizeId);
                } catch (_) {}
            });
        }

        // ── Field shake ──
        function shake(id) {
            const el = document.getElementById(id);
            el.classList.remove('err');
            void el.offsetWidth;
            el.classList.add('err');
            setTimeout(() => el.classList.remove('err'), 500);
        }

        // ── Modal helpers ──
        window.dfOpenModal = id => {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        };
        window.dfCloseModal = id => {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        };
        document.querySelectorAll('.df-backdrop').forEach(bd =>
            bd.addEventListener('click', e => {
                if (e.target === bd) dfCloseModal(bd.id);
            })
        );

        // ── Toast ──
        const T_ICONS = {
            success: `<svg class="df-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>`,
            error: `<svg class="df-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
            warning: `<svg class="df-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>`,
            info: `<svg class="df-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`
        };
        window.dfToast = function(type, title, msg) {
            const s = document.getElementById('df-toasts');
            const el = document.createElement('div');
            el.className = 'df-toast ' + type;
            el.innerHTML = `${T_ICONS[type] || T_ICONS.info}<div><div class="df-toast-title">${title}</div>${msg ? `<div class="df-toast-msg">${msg}</div>` : ''}</div><button class="df-toast-x" onclick="dfDismiss(this.parentElement)">&times;</button><div class="df-toast-bar"></div>`;
            s.appendChild(el);
            setTimeout(() => dfDismiss(el), 3300);
        };
        window.dfDismiss = function(el) {
            if (!el || !el.parentElement) return;
            el.classList.add('out');
            setTimeout(() => el.remove(), 260);
        };

    })();
</script>

@endsection