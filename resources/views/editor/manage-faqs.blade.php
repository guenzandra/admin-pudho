@extends('editor.layout')

@section('content')

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .faq-wrap {
        font-family: Arial, sans-serif;
        background: #f4f4f2;
        min-height: 100vh;
        padding: 36px 28px 72px;
    }

    /* ── Page Header ── */
    .faq-page-header {
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e5e2dc;
    }

    .faq-page-header h1 {
        font-size: 26px;
        font-weight: 700;
        color: #1a1a1a;
        letter-spacing: -.3px;
    }

    .faq-page-header p {
        font-size: 13.5px;
        color: #777;
        margin-top: 4px;
    }

    /* ── Card ── */
    .faq-card {
        background: #fff;
        border: 1px solid #e5e2dc;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        overflow: hidden;
        animation: faqUp .35s ease both;
    }

    @keyframes faqUp {
        from {
            opacity: 0;
            transform: translateY(8px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    .faq-card-header {
        background: linear-gradient(90deg, #7f1d1d 0%, #991b1b 60%, #b91c1c 100%);
        padding: 14px 22px;
        border-left: 4px solid #d97706;
    }

    .faq-card-header h2 {
        font-size: 15px;
        font-weight: 700;
        color: #fff;
    }

    .faq-card-body {
        padding: 22px;
    }

    /* ── Filters row ── */
    .faq-filters {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 18px;
    }

    .faq-seg {
        display: inline-flex;
        background: #f4f4f2;
        border: 1px solid #e0ddd8;
        border-radius: 8px;
        padding: 3px;
        gap: 2px;
    }

    .faq-seg-btn {
        padding: 6px 14px;
        border-radius: 6px;
        border: none;
        font-family: Arial, sans-serif;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        color: #777;
        background: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all .15s;
        white-space: nowrap;
    }

    .faq-seg-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 18px;
        height: 18px;
        border-radius: 9px;
        font-size: 10.5px;
        padding: 0 5px;
        background: rgba(0, 0, 0, .07);
        color: inherit;
    }

    .faq-seg-btn.active {
        background: #fff;
        color: #1a1a1a;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .1);
    }

    .faq-seg-btn.active[data-seg="pending"] {
        color: #b45309;
    }

    .faq-seg-btn.active[data-seg="pending"] .faq-seg-count {
        background: #fef3c7;
        color: #b45309;
    }

    .faq-seg-btn.active[data-seg="answered"] {
        color: #15803d;
    }

    .faq-seg-btn.active[data-seg="answered"] .faq-seg-count {
        background: #dcfce7;
        color: #15803d;
    }

    .faq-seg-btn.active[data-seg="all"] {
        color: #1d4ed8;
    }

    .faq-seg-btn.active[data-seg="all"] .faq-seg-count {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .faq-search-wrap {
        flex: 1;
        min-width: 200px;
        position: relative;
    }

    .faq-search-wrap svg {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: #bbb;
        pointer-events: none;
    }

    .faq-search {
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

    .faq-search:focus {
        border-color: #b91c1c;
        box-shadow: 0 0 0 3px rgba(185, 28, 28, .07);
        background: #fff;
    }

    .faq-filter-sel {
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

    .faq-filter-sel:focus {
        border-color: #b91c1c;
    }

    /* ── Table ── */
    .faq-table-wrap {
        overflow-x: auto;
    }

    table.faq-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }

    .faq-table thead tr {
        border-bottom: 2px solid #e5e2dc;
    }

    .faq-table th {
        padding: 10px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #999;
        white-space: nowrap;
    }

    .faq-table tbody tr {
        border-bottom: 1px solid #f0eeea;
        cursor: pointer;
        transition: background .12s;
    }

    .faq-table tbody tr:hover {
        background: #fafaf8;
    }

    .faq-table tbody tr:hover .faq-q-text {
        color: #b91c1c;
    }

    .faq-table td {
        padding: 14px 16px;
        vertical-align: middle;
    }

    .faq-q-text {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 13.5px;
        line-height: 1.4;
        transition: color .15s;
    }

    .faq-q-from {
        font-size: 12px;
        color: #999;
        margin-top: 3px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .faq-q-from svg {
        width: 11px;
        height: 11px;
        flex-shrink: 0;
    }

    /* ── Badges ── */
    .faq-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: .02em;
        white-space: nowrap;
    }

    .faq-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .faq-badge-pending {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .faq-badge-pending .faq-badge-dot {
        background: #f59e0b;
        animation: faqBlink 1.8s ease-in-out infinite;
    }

    .faq-badge-answered {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .faq-badge-answered .faq-badge-dot {
        background: #22c55e;
    }

    @keyframes faqBlink {

        0%,
        100% {
            opacity: 1
        }

        50% {
            opacity: .35
        }
    }

    .faq-cat-badge {
        display: inline-flex;
        padding: 3px 9px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
    }

    .cat-general {
        background: #f1f5f9;
        color: #475569;
    }

    .cat-services {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .cat-requirements {
        background: #ede9fe;
        color: #6d28d9;
    }

    .cat-contact {
        background: #fce7f3;
        color: #9d174d;
    }

    .cat-technical {
        background: #dcfce7;
        color: #166534;
    }

    /* Date column */
    .faq-date-cell {
        font-size: 13px;
        color: #333;
        white-space: nowrap;
        line-height: 1.5;
    }

    .faq-date-cell .d-main {
        font-weight: 700;
        color: #1a1a1a;
    }

    .faq-date-cell .d-year {
        font-size: 11.5px;
        color: #aaa;
        display: block;
    }

    /* ── Empty ── */
    .faq-empty {
        text-align: center;
        padding: 52px 20px;
        color: #bbb;
        font-size: 13px;
    }

    .faq-empty-title {
        font-size: 15px;
        font-weight: 700;
        color: #888;
        margin-bottom: 4px;
    }

    /* ── Pagination ── */
    .faq-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 18px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .faq-pagination-info {
        font-size: 12.5px;
        color: #888;
    }

    .faq-pagination-btns {
        display: flex;
        gap: 4px;
    }

    .faq-pg-btn {
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

    .faq-pg-btn:hover:not(:disabled) {
        border-color: #b91c1c;
        color: #b91c1c;
    }

    .faq-pg-btn.active {
        background: #b91c1c;
        color: #fff;
        border-color: #b91c1c;
    }

    .faq-pg-btn:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    /* ── Skeleton ── */
    .faq-skeleton {
        animation: faqPulse 1.6s ease-in-out infinite;
    }

    @keyframes faqPulse {

        0%,
        100% {
            opacity: 1
        }

        50% {
            opacity: .4
        }
    }

    .faq-skel-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border-bottom: 1px solid #f0eeea;
    }

    .faq-skel-block {
        background: #e8e6e1;
        border-radius: 5px;
        flex-shrink: 0;
    }

    /* ── Buttons ── */
    .faq-btn {
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
        transition: filter .15s, transform .15s, box-shadow .15s;
        white-space: nowrap;
    }

    .faq-btn svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
    }

    .faq-btn:hover:not(:disabled) {
        filter: brightness(.91);
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, .12);
    }

    .faq-btn:active:not(:disabled) {
        transform: none;
        box-shadow: none;
    }

    .faq-btn:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .faq-btn-amber {
        background: #d97706;
        color: #fff;
    }

    .faq-btn-green {
        background: #15803d;
        color: #fff;
    }

    .faq-btn-danger {
        background: #dc2626;
        color: #fff;
    }

    .faq-btn-blue {
        background: #1d4ed8;
        color: #fff;
    }

    .faq-btn-gray {
        background: #4b5563;
        color: #fff;
    }

    .faq-btn-ghost {
        background: #f3f2ef;
        color: #333;
        border: 1px solid #e0ddd8;
    }

    .faq-btn-ghost:hover:not(:disabled) {
        filter: none;
        transform: none;
        box-shadow: none;
        background: #e8e6e1;
    }

    /* ── Modal ── */
    .faq-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .5);
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

    .faq-modal-backdrop.open {
        opacity: 1;
        pointer-events: all;
    }

    .faq-modal {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .2), 0 6px 20px rgba(0, 0, 0, .1);
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(.96) translateY(10px);
        transition: transform .25s cubic-bezier(.34, 1.56, .64, 1);
    }

    .faq-modal-backdrop.open .faq-modal {
        transform: none;
    }

    .faq-modal.sm {
        max-width: 400px;
    }

    .faq-modal-head {
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

    .faq-modal-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .faq-modal-subtitle {
        font-size: 12px;
        color: #999;
        margin-top: 3px;
    }

    .faq-modal-close {
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

    .faq-modal-close:hover {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fca5a5;
    }

    .faq-modal-close svg {
        width: 14px;
        height: 14px;
    }

    .faq-modal-body {
        padding: 22px;
    }

    .faq-modal-foot {
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

    /* ── Form fields ── */
    .faq-field {
        margin-bottom: 16px;
    }

    .faq-field label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #888;
        margin-bottom: 6px;
    }

    .faq-field label .req {
        color: #dc2626;
    }

    .faq-input,
    .faq-textarea,
    .faq-select {
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

    .faq-input:focus,
    .faq-textarea:focus,
    .faq-select:focus {
        border-color: #b91c1c;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(185, 28, 28, .07);
    }

    .faq-textarea {
        resize: vertical;
        min-height: 110px;
        line-height: 1.65;
    }

    .faq-input.err,
    .faq-textarea.err,
    .faq-select.err {
        border-color: #dc2626 !important;
        animation: faqShake .35s ease;
    }

    @keyframes faqShake {

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

    /* Question box */
    .faq-q-box {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 8px;
        padding: 14px 16px;
        margin-bottom: 20px;
    }

    .faq-q-box-label {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #b45309;
        margin-bottom: 6px;
    }

    .faq-q-box-text {
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.45;
    }

    .faq-q-box-meta {
        font-size: 11.5px;
        color: #aaa;
        margin-top: 5px;
    }

    /* Answer view box */
    .faq-a-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 14px 16px;
        margin-top: 12px;
    }

    .faq-a-box-label {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #15803d;
        margin-bottom: 6px;
    }

    .faq-a-box-text {
        font-size: 13.5px;
        color: #1a1a1a;
        line-height: 1.65;
    }

    .faq-divider {
        height: 1px;
        background: #e5e2dc;
        margin: 18px 0;
    }

    /* Pub status row */
    .faq-pub-row {
        margin-top: 14px;
        padding: 11px 14px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 12.5px;
        color: #555;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Confirm modal */
    .faq-confirm-body {
        text-align: center;
        padding: 32px 28px 24px;
    }

    .faq-confirm-ring {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
    }

    .faq-confirm-ring.green {
        background: #dcfce7;
    }

    .faq-confirm-ring.red {
        background: #fee2e2;
    }

    .faq-confirm-ring.amber {
        background: #fef3c7;
    }

    .faq-confirm-title {
        font-size: 17px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .faq-confirm-text {
        font-size: 13px;
        color: #666;
        line-height: 1.6;
    }

    /* ── Toast ── */
    #faq-toasts {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 9px;
        pointer-events: none;
    }

    .faq-toast {
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
        animation: faqToastIn .3s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    .faq-toast.out {
        animation: faqToastOut .25s ease both;
    }

    @keyframes faqToastIn {
        from {
            opacity: 0;
            transform: translateX(30px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    @keyframes faqToastOut {
        from {
            opacity: 1;
            transform: none
        }

        to {
            opacity: 0;
            transform: translateX(30px)
        }
    }

    .faq-toast-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        transform-origin: left;
        animation: faqShrink 3.3s linear forwards;
    }

    @keyframes faqShrink {
        from {
            transform: scaleX(1)
        }

        to {
            transform: scaleX(0)
        }
    }

    .faq-toast-ico {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .faq-toast-title {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1px;
    }

    .faq-toast-msg {
        font-size: 12px;
        color: #666;
    }

    .faq-toast-x {
        background: none;
        border: none;
        cursor: pointer;
        color: #bbb;
        font-size: 16px;
        line-height: 1;
        padding: 0 2px;
        transition: color .12s;
        margin-left: auto;
    }

    .faq-toast-x:hover {
        color: #333;
    }

    .faq-toast.success .faq-toast-ico {
        color: #15803d;
    }

    .faq-toast.success .faq-toast-bar {
        background: #22c55e;
    }

    .faq-toast.error .faq-toast-ico {
        color: #dc2626;
    }

    .faq-toast.error .faq-toast-bar {
        background: #dc2626;
    }

    .faq-toast.warning .faq-toast-ico {
        color: #d97706;
    }

    .faq-toast.warning .faq-toast-bar {
        background: #d97706;
    }

    .faq-toast.info .faq-toast-ico {
        color: #1d4ed8;
    }

    .faq-toast.info .faq-toast-bar {
        background: #1d4ed8;
    }

    .faq-spinner {
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255, 255, 255, .35);
        border-top-color: #fff;
        border-radius: 50%;
        animation: faqSpin .65s linear infinite;
        flex-shrink: 0;
    }

    @keyframes faqSpin {
        to {
            transform: rotate(360deg)
        }
    }

    @media(max-width:640px) {
        .faq-wrap {
            padding: 18px 14px 60px;
        }

        .faq-card-body {
            padding: 16px;
        }

        .faq-table th:nth-child(4),
        .faq-table td:nth-child(4) {
            display: none;
        }
    }
</style>

<div class="faq-wrap">

    <div class="faq-page-header">
        <h1>Manage FAQs</h1>
        <p>Review questions submitted by the public, write answers, and publish them</p>
    </div>

    <div class="faq-card">
        <div class="faq-card-header">
            <h2>FAQ Directory</h2>
        </div>
        <div class="faq-card-body">

            <div class="faq-filters">
                <div class="faq-seg">
                    <button class="faq-seg-btn active" data-seg="all" onclick="faqSetSeg('all',this)">
                        All <span class="faq-seg-count" id="segAllCount">5</span>
                    </button>
                    <button class="faq-seg-btn" data-seg="pending" onclick="faqSetSeg('pending',this)">
                        Pending <span class="faq-seg-count" id="segPendingCount">3</span>
                    </button>
                    <button class="faq-seg-btn" data-seg="answered" onclick="faqSetSeg('answered',this)">
                        Answered <span class="faq-seg-count" id="segAnsweredCount">2</span>
                    </button>
                </div>

                <div class="faq-search-wrap">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input type="text" class="faq-search" id="faqSearch" placeholder="Search questions..." oninput="faqRender()">
                </div>

                <select class="faq-filter-sel" id="faqCatFilter" onchange="faqRender()">
                    <option value="all">All Categories</option>
                    <option value="general">General</option>
                    <option value="services">Services</option>
                    <option value="requirements">Requirements</option>
                    <option value="contact">Contact</option>
                    <option value="technical">Technical</option>
                </select>
            </div>

            {{-- Skeleton loader --}}
            <div id="faqSkeleton">
                @for($i = 0; $i < 5; $i++)
                    <div class="faq-skel-row faq-skeleton">
                    <div class="faq-skel-block" style="width:45%;height:13px;"></div>
                    <div class="faq-skel-block" style="width:10%;height:13px;margin-left:auto;"></div>
                    <div class="faq-skel-block" style="width:10%;height:13px;"></div>
                    <div class="faq-skel-block" style="width:10%;height:13px;"></div>
            </div>
            @endfor
        </div>

        {{-- Table --}}
        <div class="faq-table-wrap" id="faqTableWrap" style="display:none;">
            <table class="faq-table">
                <thead>
                    <tr>
                        <th style="width:50%">Question</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody id="faqTbody"></tbody>
            </table>

            <div id="faqEmpty" class="faq-empty" style="display:none;">
                <div class="faq-empty-title">No questions found</div>
                <div>Try adjusting your search or filter.</div>
            </div>

            <div class="faq-pagination">
                <div class="faq-pagination-info" id="faqPagInfo"></div>
                <div class="faq-pagination-btns" id="faqPagBtns"></div>
            </div>
        </div>

    </div>
</div>

</div>

<div id="faq-toasts"></div>

{{-- ── Answer / Edit Modal ── --}}
<div class="faq-modal-backdrop" id="faqAnswerModal">
    <div class="faq-modal">
        <div class="faq-modal-head">
            <div>
                <div class="faq-modal-title" id="faqAnswerModalTitle">Answer Question</div>
                <div class="faq-modal-subtitle" id="faqAnswerModalSub">Write an answer and choose whether to save as draft or publish right away.</div>
            </div>
            <button class="faq-modal-close" onclick="faqCloseModal('faqAnswerModal')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="faq-modal-body">

            <div class="faq-q-box">
                <div class="faq-q-box-label">Question from the Public</div>
                <div class="faq-q-box-text" id="faqAnswerQ">—</div>
                <div class="faq-q-box-meta">
                    Submitted by <strong id="faqAnswerFrom">—</strong> &middot; <span id="faqAnswerDate">—</span>
                </div>
            </div>

            <div class="faq-field">
                <label>FAQ Title <span class="req">*</span></label>
                <input type="text" class="faq-input" id="faqAnswerTitle" placeholder="e.g. Requirements for Housing Assistance">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#888;margin-bottom:6px;">
                        Category <span style="color:#dc2626;">*</span>
                    </label>
                    <select class="faq-select" id="faqAnswerCat">
                        <option value="">— Select —</option>
                        <option value="general">General</option>
                        <option value="services">Services</option>
                        <option value="requirements">Requirements</option>
                        <option value="contact">Contact</option>
                        <option value="technical">Technical</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#888;margin-bottom:6px;">
                        Publish Status
                    </label>
                    <select class="faq-select" id="faqAnswerStatus">
                        <option value="draft">Save as Draft</option>
                        <option value="published">Publish Immediately</option>
                    </select>
                </div>
            </div>

            <div class="faq-field" style="margin-bottom:0;">
                <label>Answer <span class="req">*</span></label>
                <textarea class="faq-textarea" id="faqAnswerText" rows="5" placeholder="Write a clear, complete answer..."></textarea>
            </div>

        </div>
        <div class="faq-modal-foot">
            <button class="faq-btn faq-btn-ghost" onclick="faqCloseModal('faqAnswerModal')">Cancel</button>
            <button class="faq-btn faq-btn-danger" onclick="faqTriggerDelete()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                    <path d="M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                </svg>
                Delete
            </button>
            <button class="faq-btn faq-btn-amber" id="faqSaveBtn" onclick="faqSaveAnswer()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                Save Answer
            </button>
        </div>
    </div>
</div>

{{-- ── View Modal (Answered) ── --}}
<div class="faq-modal-backdrop" id="faqViewModal">
    <div class="faq-modal">
        <div class="faq-modal-head">
            <div>
                <div class="faq-modal-title">View FAQ</div>
                <div class="faq-modal-subtitle" id="faqViewSub">—</div>
            </div>
            <button class="faq-modal-close" onclick="faqCloseModal('faqViewModal')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="faq-modal-body">

            <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px;align-items:center;">
                <span class="faq-badge faq-badge-answered"><span class="faq-badge-dot"></span>Answered</span>
                <span id="faqViewCatBadge" class="faq-cat-badge cat-general">—</span>
            </div>

            <div style="margin-bottom:14px;">
                <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#999;margin-bottom:4px;">Title</div>
                <div style="font-size:14px;font-weight:700;color:#1a1a1a;" id="faqViewTitle">—</div>
            </div>

            <div class="faq-q-box">
                <div class="faq-q-box-label">Question</div>
                <div class="faq-q-box-text" id="faqViewQ">—</div>
                <div class="faq-q-box-meta">
                    Submitted by <strong id="faqViewFrom">—</strong> &middot; <span id="faqViewDate">—</span>
                </div>
            </div>

            <div class="faq-a-box">
                <div class="faq-a-box-label">Answer</div>
                <div class="faq-a-box-text" id="faqViewAnswer">—</div>
            </div>

            <div class="faq-pub-row">
                <span>Visibility: <strong id="faqViewPubLabel" style="color:#15803d;">Published</strong></span>
                <button class="faq-btn faq-btn-ghost" id="faqToggleBtn" onclick="faqOpenTogglePublish()" style="padding:6px 14px;font-size:12.5px;">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;">
                        <path d="M18.36 6.64a9 9 0 11-12.73 0" />
                        <line x1="12" y1="2" x2="12" y2="12" />
                    </svg>
                    <span id="faqToggleBtnLabel">Unpublish</span>
                </button>
            </div>

        </div>
        <div class="faq-modal-foot">
            <button class="faq-btn faq-btn-ghost" onclick="faqCloseModal('faqViewModal')">Close</button>
            <button class="faq-btn faq-btn-danger" onclick="faqTriggerDeleteFromView()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                </svg>
                Delete
            </button>
            <button class="faq-btn faq-btn-blue" onclick="faqEditFromView()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit Answer
            </button>
        </div>
    </div>
</div>

{{-- ── Publish / Unpublish Confirm ── --}}
<div class="faq-modal-backdrop" id="faqPublishModal">
    <div class="faq-modal sm">
        <div class="faq-confirm-body">
            <div class="faq-confirm-ring green" id="faqPubConfirmRing">
                <svg width="22" height="22" fill="none" stroke="#15803d" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>
            <div class="faq-confirm-title" id="faqPubConfirmTitle">Publish this FAQ?</div>
            <div class="faq-confirm-text" id="faqPubConfirmText">This will make the FAQ publicly visible on the website.</div>
        </div>
        <div class="faq-modal-foot" style="justify-content:center;">
            <button class="faq-btn faq-btn-ghost" onclick="faqCloseModal('faqPublishModal')">Cancel</button>
            <button class="faq-btn faq-btn-green" id="faqPubConfirmBtn" onclick="faqDoTogglePublish()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:15px;height:15px;">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                <span id="faqPubConfirmBtnLabel">Yes, Publish</span>
            </button>
        </div>
    </div>
</div>

{{-- ── Delete Confirm ── --}}
<div class="faq-modal-backdrop" id="faqDeleteModal">
    <div class="faq-modal sm">
        <div class="faq-confirm-body">
            <div class="faq-confirm-ring red">
                <svg width="22" height="22" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                    <path d="M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                </svg>
            </div>
            <div class="faq-confirm-title">Delete this question?</div>
            <div class="faq-confirm-text">This will permanently remove the question and its answer. This action cannot be undone.</div>
        </div>
        <div class="faq-modal-foot" style="justify-content:center;">
            <button class="faq-btn faq-btn-ghost" onclick="faqCloseModal('faqDeleteModal')">Cancel</button>
            <button class="faq-btn faq-btn-danger" id="faqDeleteConfirmBtn" onclick="faqDoDelete()">
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

        let faqData = [{
                id: 1,
                question: 'What are the requirements for housing assistance?',
                from: 'Juan dela Cruz',
                raw: '2026-03-03',
                status: 'pending',
                published: false,
                title: '',
                category: '',
                answer: ''
            },
            {
                id: 2,
                question: 'How do I apply for educational assistance?',
                from: 'Maria Santos',
                raw: '2026-03-04',
                status: 'answered',
                published: true,
                title: 'Educational Assistance Application',
                category: 'services',
                answer: 'Apply by visiting our office or calling our hotline. Prepare a valid ID, income documents, and a completed application form before coming in.'
            },
            {
                id: 3,
                question: 'What documents do I need to prepare?',
                from: 'Pedro Reyes',
                raw: '2026-03-05',
                status: 'answered',
                published: true,
                title: 'Required Documents for Applications',
                category: 'requirements',
                answer: 'Required: birth certificate, valid government-issued ID, proof of residence, income tax return, and two recent 2x2 ID photos.'
            },
            {
                id: 4,
                question: 'How can I contact the housing office?',
                from: 'Ana Garcia',
                raw: '2026-03-06',
                status: 'pending',
                published: false,
                title: '',
                category: '',
                answer: ''
            },
            {
                id: 5,
                question: 'What are the office hours?',
                from: 'Carlos Lim',
                raw: '2026-03-07',
                status: 'pending',
                published: false,
                title: '',
                category: '',
                answer: ''
            },
        ];

        const catClass = {
            general: 'cat-general',
            services: 'cat-services',
            requirements: 'cat-requirements',
            contact: 'cat-contact',
            technical: 'cat-technical'
        };
        const catLabel = {
            general: 'General',
            services: 'Services',
            requirements: 'Requirements',
            contact: 'Contact',
            technical: 'Technical'
        };

        let seg = 'all';
        let page = 1;
        let activeId = null;
        let deleteId = null;
        const PER = 10;

        function fmtDate(raw) {
            if (!raw) return {
                day: '—',
                year: '',
                full: '—'
            };
            const d = new Date(raw + 'T00:00:00');
            const month = d.toLocaleDateString('en-US', {
                month: 'short'
            });
            const day = d.getDate();
            const year = d.getFullYear();
            return {
                day: `${month} ${day}`,
                year,
                full: `${month} ${day}, ${year}`
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.getElementById('faqSkeleton').style.display = 'none';
                document.getElementById('faqTableWrap').style.display = 'block';
                render();
            }, 800);
        });

        window.faqSetSeg = function(s, btn) {
            document.querySelectorAll('.faq-seg-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            seg = s;
            page = 1;
            render();
        };
        window.faqRender = function() {
            page = 1;
            render();
        };

        function render() {
            const q = document.getElementById('faqSearch').value.toLowerCase();
            const cat = document.getElementById('faqCatFilter').value;

            let list = faqData.filter(f => {
                if (seg === 'pending' && f.status !== 'pending') return false;
                if (seg === 'answered' && f.status !== 'answered') return false;
                if (cat !== 'all' && f.category !== cat) return false;
                if (q && !f.question.toLowerCase().includes(q) && !f.title.toLowerCase().includes(q)) return false;
                return true;
            });

            const total = list.length;
            const pages = Math.max(1, Math.ceil(total / PER));
            if (page > pages) page = pages;
            const slice = list.slice((page - 1) * PER, page * PER);

            const tbody = document.getElementById('faqTbody');
            const empty = document.getElementById('faqEmpty');

            if (!slice.length) {
                tbody.innerHTML = '';
                empty.style.display = 'block';
            } else {
                empty.style.display = 'none';
                tbody.innerHTML = slice.map(rowHtml).join('');
            }

            document.getElementById('faqPagInfo').textContent = `Showing ${slice.length} of ${total} question${total!==1?'s':''}`;
            const btns = document.getElementById('faqPagBtns');
            btns.innerHTML = '';
            const mk = (label, p, dis, act) => {
                const b = document.createElement('button');
                b.className = 'faq-pg-btn' + (act ? ' active' : '');
                b.textContent = label;
                b.disabled = dis;
                b.onclick = () => {
                    page = p;
                    render();
                };
                return b;
            };
            btns.appendChild(mk('Prev', page - 1, page === 1, false));
            for (let i = 1; i <= pages; i++) btns.appendChild(mk(i, i, false, i === page));
            btns.appendChild(mk('Next', page + 1, page === pages, false));

            const pc = faqData.filter(f => f.status === 'pending').length;
            const ac = faqData.filter(f => f.status === 'answered').length;
            document.getElementById('segAllCount').textContent = faqData.length;
            document.getElementById('segPendingCount').textContent = pc;
            document.getElementById('segAnsweredCount').textContent = ac;
        }

        function rowHtml(f) {
            const pending = f.status === 'pending';
            const badge = pending ?
                `<span class="faq-badge faq-badge-pending"><span class="faq-badge-dot"></span>Pending</span>` :
                `<span class="faq-badge faq-badge-answered"><span class="faq-badge-dot"></span>Answered</span>`;
            const cat = f.category ?
                `<span class="faq-cat-badge ${catClass[f.category]||'cat-general'}">${catLabel[f.category]||f.category}</span>` :
                `<span style="font-size:12px;color:#ccc;">—</span>`;
            const d = fmtDate(f.raw);
            const fn = pending ? `faqOpenAnswer(${f.id})` : `faqOpenView(${f.id})`;
            return `<tr onclick="${fn}">
        <td>
            <div class="faq-q-text">${f.question}</div>
            <div class="faq-q-from">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
                ${f.from}
            </div>
        </td>
        <td>${cat}</td>
        <td>${badge}</td>
        <td>
            <div class="faq-date-cell">
                <span class="d-main">${d.day},</span>
                <span class="d-year">${d.year}</span>
            </div>
        </td>
    </tr>`;
        }

        window.faqOpenAnswer = function(id) {
            const f = faqData.find(x => x.id === id);
            if (!f) return;
            activeId = id;
            document.getElementById('faqAnswerModalTitle').textContent = f.status === 'answered' ? 'Edit Answer' : 'Answer Question';
            document.getElementById('faqAnswerModalSub').textContent = f.status === 'answered' ?
                'Update the answer and publish status.' :
                'Write an answer and choose to save as draft or publish right away.';
            document.getElementById('faqAnswerQ').textContent = f.question;
            document.getElementById('faqAnswerFrom').textContent = f.from;
            document.getElementById('faqAnswerDate').textContent = fmtDate(f.raw).full;
            document.getElementById('faqAnswerTitle').value = f.title || '';
            document.getElementById('faqAnswerCat').value = f.category || '';
            document.getElementById('faqAnswerText').value = f.answer || '';
            document.getElementById('faqAnswerStatus').value = f.published ? 'published' : 'draft';
            openModal('faqAnswerModal');
        };

        window.faqSaveAnswer = function() {
            const title = document.getElementById('faqAnswerTitle').value.trim();
            const cat = document.getElementById('faqAnswerCat').value;
            const answer = document.getElementById('faqAnswerText').value.trim();
            const pub = document.getElementById('faqAnswerStatus').value === 'published';
            let ok = true;
            if (!title) {
                shake('faqAnswerTitle');
                ok = false;
            }
            if (!cat) {
                shake('faqAnswerCat');
                ok = false;
            }
            if (!answer) {
                shake('faqAnswerText');
                ok = false;
            }
            if (!ok) {
                toast('warning', 'Missing Fields', 'Please fill in all required fields.');
                return;
            }

            const btn = document.getElementById('faqSaveBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<div class="faq-spinner"></div> Saving...';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                const f = faqData.find(x => x.id === activeId);
                if (f) {
                    f.title = title;
                    f.category = cat;
                    f.answer = answer;
                    f.status = 'answered';
                    f.published = pub;
                }
                closeModal('faqAnswerModal');
                render();
                toast('success', pub ? 'Published!' : 'Draft Saved', pub ? 'FAQ is now publicly visible.' : 'Answer saved. You can publish it anytime.');
            }, 1100);
        };

        window.faqOpenView = function(id) {
            const f = faqData.find(x => x.id === id);
            if (!f) return;
            activeId = id;
            document.getElementById('faqViewQ').textContent = f.question;
            document.getElementById('faqViewAnswer').textContent = f.answer;
            document.getElementById('faqViewTitle').textContent = f.title;
            document.getElementById('faqViewFrom').textContent = f.from;
            document.getElementById('faqViewDate').textContent = fmtDate(f.raw).full;
            document.getElementById('faqViewSub').textContent = f.title;
            const cb = document.getElementById('faqViewCatBadge');
            cb.className = `faq-cat-badge ${catClass[f.category]||'cat-general'}`;
            cb.textContent = catLabel[f.category] || f.category;
            const pl = document.getElementById('faqViewPubLabel');
            pl.textContent = f.published ? 'Published' : 'Draft (not visible publicly)';
            pl.style.color = f.published ? '#15803d' : '#b45309';
            document.getElementById('faqToggleBtnLabel').textContent = f.published ? 'Unpublish' : 'Publish';
            openModal('faqViewModal');
        };

        window.faqEditFromView = function() {
            closeModal('faqViewModal');
            setTimeout(() => faqOpenAnswer(activeId), 200);
        };

        window.faqOpenTogglePublish = function() {
            const f = faqData.find(x => x.id === activeId);
            if (!f) return;
            const willPub = !f.published;
            document.getElementById('faqPubConfirmTitle').textContent = willPub ? 'Publish this FAQ?' : 'Unpublish this FAQ?';
            document.getElementById('faqPubConfirmText').textContent = willPub ?
                'This will make the FAQ publicly visible on the website.' :
                'This will hide the FAQ from public view. You can re-publish it anytime.';
            document.getElementById('faqPubConfirmBtnLabel').textContent = willPub ? 'Yes, Publish' : 'Yes, Unpublish';
            const cb = document.getElementById('faqPubConfirmBtn');
            cb.className = willPub ? 'faq-btn faq-btn-green' : 'faq-btn faq-btn-amber';
            const ring = document.getElementById('faqPubConfirmRing');
            ring.className = willPub ? 'faq-confirm-ring green' : 'faq-confirm-ring amber';
            ring.innerHTML = willPub ?
                `<svg width="22" height="22" fill="none" stroke="#15803d" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>` :
                `<svg width="22" height="22" fill="none" stroke="#b45309" stroke-width="2" viewBox="0 0 24 24"><path d="M18.36 6.64a9 9 0 11-12.73 0"/><line x1="12" y1="2" x2="12" y2="12"/></svg>`;
            closeModal('faqViewModal');
            setTimeout(() => openModal('faqPublishModal'), 200);
        };

        window.faqDoTogglePublish = function() {
            const btn = document.getElementById('faqPubConfirmBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<div class="faq-spinner"></div> Saving...';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                const f = faqData.find(x => x.id === activeId);
                if (f) f.published = !f.published;
                closeModal('faqPublishModal');
                render();
                toast('success', f && f.published ? 'Published!' : 'Unpublished', f && f.published ? 'FAQ is now visible to the public.' : 'FAQ has been hidden from public view.');
            }, 1200);
        };

        window.faqTriggerDelete = function() {
            deleteId = activeId;
            closeModal('faqAnswerModal');
            setTimeout(() => openModal('faqDeleteModal'), 200);
        };
        window.faqTriggerDeleteFromView = function() {
            deleteId = activeId;
            closeModal('faqViewModal');
            setTimeout(() => openModal('faqDeleteModal'), 200);
        };
        window.faqDoDelete = function() {
            const btn = document.getElementById('faqDeleteConfirmBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<div class="faq-spinner"></div> Deleting...';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                faqData = faqData.filter(f => f.id !== deleteId);
                closeModal('faqDeleteModal');
                render();
                toast('error', 'Deleted', 'The question has been permanently removed.');
            }, 1000);
        };

        function shake(id) {
            const el = document.getElementById(id);
            el.classList.remove('err');
            void el.offsetWidth;
            el.classList.add('err');
            setTimeout(() => el.classList.remove('err'), 500);
        }

        function openModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        window.faqCloseModal = function(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        };
        document.querySelectorAll('.faq-modal-backdrop').forEach(bd => bd.addEventListener('click', e => {
            if (e.target === bd) faqCloseModal(bd.id);
        }));

        const TICONS = {
            success: `<svg class="faq-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>`,
            error: `<svg class="faq-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
            warning: `<svg class="faq-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>`,
            info: `<svg class="faq-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`
        };

        function toast(type, title, msg) {
            const s = document.getElementById('faq-toasts');
            const el = document.createElement('div');
            el.className = 'faq-toast ' + type;
            el.innerHTML = `${TICONS[type]||TICONS.info}<div><div class="faq-toast-title">${title}</div>${msg?`<div class="faq-toast-msg">${msg}</div>`:''}</div><button class="faq-toast-x" onclick="faqDismissToast(this.parentElement)">&times;</button><div class="faq-toast-bar"></div>`;
            s.appendChild(el);
            setTimeout(() => faqDismissToast(el), 3300);
        }
        window.faqDismissToast = function(el) {
            if (!el || !el.parentElement) return;
            el.classList.add('out');
            setTimeout(() => el.remove(), 260);
        };

    })();
</script>

@endsection