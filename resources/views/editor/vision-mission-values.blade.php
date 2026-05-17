@extends('editor.layout')

@section('content')
<style>
    /* Your existing CSS styles remain exactly the same */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

    :root {
        --red: #C0272D;
        --red-dk: #8B1A1E;
        --red-lt: #FFF0F0;
        --red-glow: rgba(192, 39, 45, .18);
        --green: #15803D;
        --green-lt: #F0FDF4;
        --green-br: #BBF7D0;
        --ink: #0F172A;
        --ink2: #1E293B;
        --muted: #64748B;
        --faint: #94A3B8;
        --border: #E2E8F0;
        --surface: #FFFFFF;
        --bg: #F8FAFC;
        --bg2: #F1F5F9;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
        --shadow: 0 4px 16px rgba(0, 0, 0, .07), 0 2px 4px rgba(0, 0, 0, .04);
        --shadow-lg: 0 20px 60px rgba(0, 0, 0, .12), 0 8px 20px rgba(0, 0, 0, .06);
        --tr: .2s cubic-bezier(.4, 0, .2, 1);
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    #vmcv-root {
        font-family: 'DM Sans', system-ui, sans-serif;
        background: var(--bg);
        min-height: 100vh;
        padding: 36px 40px 60px;
        color: var(--ink);
    }

    .vmcv-page-header {
        margin-bottom: 40px;
        position: relative;
    }

    .vmcv-page-header-inner {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .vmcv-breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--muted);
        font-weight: 500;
        margin-bottom: 10px;
        letter-spacing: .03em;
    }

    .vmcv-breadcrumb span {
        color: var(--faint)
    }

    .vmcv-page-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 34px;
        font-weight: 900;
        color: var(--ink);
        letter-spacing: -.02em;
        line-height: 1.15;
    }

    .vmcv-page-title em {
        font-style: italic;
        color: var(--red);
    }

    .vmcv-page-sub {
        font-size: 14px;
        color: var(--muted);
        margin-top: 6px;
        font-weight: 400;
    }

    .vmcv-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--green-lt);
        border: 1px solid var(--green-br);
        border-radius: 30px;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        color: var(--green);
    }

    .vmcv-header-badge .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--green);
        animation: pulse-green 2s ease-in-out infinite;
    }

    @keyframes pulse-green {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: .5;
            transform: scale(1.4);
        }
    }

    .vmcv-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
        transition: box-shadow var(--tr);
    }

    .vmcv-card:hover {
        box-shadow: var(--shadow);
    }

    .vmcv-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px 28px;
        border-bottom: 1px solid var(--border);
        position: relative;
        overflow: hidden;
    }

    .vmcv-card-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(192, 39, 45, .05) 0%, transparent 60%);
        pointer-events: none;
    }

    .vmcv-card-header-num {
        font-family: 'Playfair Display', serif;
        font-size: 44px;
        font-weight: 900;
        color: rgba(192, 39, 45, .08);
        line-height: 1;
        flex-shrink: 0;
        user-select: none;
        letter-spacing: -.04em;
    }

    .vmcv-card-header-info {
        flex: 1
    }

    .vmcv-card-header-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--red);
        margin-bottom: 2px;
    }

    .vmcv-card-header-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--ink);
    }

    .vmcv-card-header-meta {
        font-size: 12px;
        color: var(--muted);
        margin-top: 2px;
    }

    .vmcv-card-header-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--red-lt);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .vmcv-card-header-icon svg {
        width: 22px;
        height: 22px;
        color: var(--red);
    }

    .vmcv-card-body {
        padding: 28px;
    }

    .vmcv-two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
    }

    @media (max-width: 900px) {
        .vmcv-two-col {
            grid-template-columns: 1fr;
        }

        #vmcv-root {
            padding: 20px 18px 48px;
        }

        .vmcv-page-title {
            font-size: 26px;
        }
    }

    .vmcv-editor-panel {}

    .vmcv-preview-panel {}

    .vmcv-panel-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--faint);
        margin-bottom: 12px;
    }

    .vmcv-toolbar {
        display: flex;
        align-items: center;
        gap: 2px;
        padding: 6px 8px;
        background: var(--bg2);
        border: 1px solid var(--border);
        border-bottom: none;
        border-radius: 10px 10px 0 0;
    }

    .vmcv-toolbar-btn {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 6px;
        background: transparent;
        color: var(--muted);
        cursor: pointer;
        transition: all .15s;
    }

    .vmcv-toolbar-btn:hover {
        background: var(--surface);
        color: var(--ink);
        box-shadow: var(--shadow-sm);
    }

    .vmcv-toolbar-btn svg {
        width: 14px;
        height: 14px;
    }

    .vmcv-toolbar-sep {
        width: 1px;
        height: 20px;
        background: var(--border);
        margin: 0 4px;
    }

    .vmcv-editor {
        min-height: 200px;
        max-height: 320px;
        overflow-y: auto;
        padding: 16px;
        border: 1.5px solid var(--border);
        border-radius: 0 0 10px 10px;
        outline: none;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        line-height: 1.7;
        color: var(--ink2);
        background: var(--surface);
        transition: border-color .15s, box-shadow .15s;
    }

    .vmcv-editor:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px var(--red-glow);
    }

    .vmcv-editor ul,
    .vmcv-editor ol {
        padding-left: 20px;
        margin: 8px 0;
    }

    .vmcv-editor li {
        margin: 3px 0;
    }

    .vmcv-editor strong {
        font-weight: 700;
    }

    .vmcv-editor-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 12px;
        gap: 10px;
    }

    .vmcv-wordcount {
        font-family: 'DM Mono', monospace;
        font-size: 11px;
        color: var(--faint);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .vmcv-wordcount svg {
        width: 12px;
        height: 12px;
    }

    .vmcv-save-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 20px;
        background: linear-gradient(135deg, var(--red) 0%, var(--red-dk) 100%);
        color: #fff;
        border: none;
        border-radius: 9px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all var(--tr);
        box-shadow: 0 2px 10px var(--red-glow);
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    .vmcv-save-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px var(--red-glow);
    }

    .vmcv-save-btn:active {
        transform: translateY(0);
    }

    .vmcv-save-btn svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    .vmcv-save-btn.loading {
        pointer-events: none;
        opacity: .75;
    }

    .vmcv-save-btn .btn-spinner {
        display: none;
        width: 13px;
        height: 13px;
        border: 2px solid rgba(255, 255, 255, .3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin .6s linear infinite;
        flex-shrink: 0;
    }

    .vmcv-save-btn.loading .btn-icon {
        display: none;
    }

    .vmcv-save-btn.loading .btn-spinner {
        display: block;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .vmcv-preview-box {
        background: linear-gradient(135deg, var(--bg) 0%, var(--bg2) 100%);
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 20px;
        min-height: 200px;
        max-height: 320px;
        overflow-y: auto;
    }

    .vmcv-preview-box .prose {
        font-size: 14px;
        line-height: 1.7;
        color: var(--ink2);
    }

    .vmcv-preview-box .prose ul,
    .vmcv-preview-box .prose ol {
        padding-left: 20px;
        margin: 8px 0;
    }

    .vmcv-preview-box .prose li {
        margin: 4px 0;
    }

    .vmcv-preview-box .prose strong {
        color: var(--ink);
        font-weight: 700;
    }

    .vmcv-updated-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
        padding: 9px 14px;
        background: var(--green-lt);
        border-left: 3px solid var(--green);
        border-radius: 0 8px 8px 0;
        font-size: 12px;
        color: #166534;
        transition: all var(--tr);
    }

    .vmcv-updated-badge svg {
        width: 13px;
        height: 13px;
        flex-shrink: 0;
        color: var(--green);
    }

    .vmcv-updated-badge.updated {
        background: #DCFCE7;
        border-left-color: #166534;
        animation: badgePulse 0.5s ease;
    }

    @keyframes badgePulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.02);
            background: #BBF7D0;
        }
    }

    .vmcv-history-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px;
        margin-top: 24px;
        box-shadow: var(--shadow-sm);
    }

    .vmcv-history-title {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .vmcv-history-title svg {
        width: 18px;
        height: 18px;
        color: var(--muted);
    }

    .vmcv-history-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-radius: 10px;
        background: var(--bg);
        border: 1px solid var(--border);
        margin-bottom: 8px;
        transition: background var(--tr), border-color var(--tr);
    }

    .vmcv-history-row:last-child {
        margin-bottom: 0;
    }

    .vmcv-history-row:hover {
        background: var(--bg2);
        border-color: var(--border);
    }

    .vmcv-history-row-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink2);
    }

    .vmcv-history-row-meta {
        font-size: 11px;
        color: var(--muted);
        margin-top: 2px;
    }

    .vmcv-view-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        color: var(--red);
        background: var(--red-lt);
        border: 1px solid rgba(192, 39, 45, .15);
        border-radius: 7px;
        padding: 5px 12px;
        cursor: pointer;
        transition: all .15s;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .vmcv-view-btn:hover {
        background: rgba(192, 39, 45, .12);
        transform: translateX(2px);
    }

    .vmcv-view-btn svg {
        width: 12px;
        height: 12px;
    }

    .vmcv-modal-bg {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .55);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .vmcv-modal-bg.show {
        display: flex;
        animation: bgIn .2s ease;
    }

    @keyframes bgIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .vmcv-modal {
        background: var(--surface);
        border-radius: 16px;
        width: 100%;
        max-width: 480px;
        box-shadow: var(--shadow-lg);
        animation: modalIn .3s cubic-bezier(.34, 1.3, .64, 1) both;
        overflow: hidden;
    }

    @keyframes modalIn {
        from {
            opacity: 0;
            transform: translateY(20px) scale(.96);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .vmcv-modal-hd {
        padding: 22px 24px 0;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .vmcv-modal-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .vmcv-modal-icon svg {
        width: 22px;
        height: 22px;
    }

    .vmcv-modal-icon.success {
        background: var(--green-lt);
        color: var(--green);
    }

    .vmcv-modal-icon.warning {
        background: #FFFBEB;
        color: #D97706;
    }

    .vmcv-modal-hd-text h3 {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--ink);
    }

    .vmcv-modal-hd-text p {
        font-size: 13px;
        color: var(--muted);
        margin-top: 4px;
        line-height: 1.5;
    }

    .vmcv-modal-body {
        padding: 16px 24px 0;
    }

    .vmcv-modal-detail {
        background: var(--bg2);
        border-radius: 10px;
        padding: 14px 16px;
        font-size: 13px;
        color: var(--ink2);
        line-height: 1.6;
        border: 1px solid var(--border);
    }

    .vmcv-modal-detail strong {
        color: var(--ink);
        font-weight: 700;
    }

    .vmcv-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 20px 24px 24px;
    }

    .vmcv-modal-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 22px;
        border-radius: 9px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all .15s;
        border: none;
    }

    .vmcv-modal-btn.secondary {
        background: var(--bg2);
        color: var(--ink2);
        border: 1.5px solid var(--border);
    }

    .vmcv-modal-btn.secondary:hover {
        background: var(--border);
    }

    .vmcv-modal-btn.primary {
        background: linear-gradient(135deg, var(--red), var(--red-dk));
        color: #fff;
        box-shadow: 0 2px 10px var(--red-glow);
    }

    .vmcv-modal-btn.primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 16px var(--red-glow);
    }

    .vmcv-modal-btn svg {
        width: 14px;
        height: 14px;
    }

    #vmcv-toasts {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 8px;
        pointer-events: none;
        width: 340px;
    }

    .vmcv-toast {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        background: var(--ink);
        border-radius: 12px;
        box-shadow: 0 8px 28px rgba(0, 0, 0, .2);
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: #fff;
        pointer-events: all;
        animation: toastIn .3s cubic-bezier(.34, 1.3, .64, 1) both;
        border-left: 4px solid transparent;
        cursor: pointer;
        transition: transform .2s ease;
    }

    .vmcv-toast:hover {
        transform: translateX(-4px);
    }

    .vmcv-toast.success {
        border-left-color: #4ADE80;
    }

    .vmcv-toast.error {
        border-left-color: #F87171;
    }

    .vmcv-toast.info {
        border-left-color: #60A5FA;
    }

    .vmcv-toast.warning {
        border-left-color: #FBBF24;
    }

    .vmcv-toast-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .vmcv-toast.success .vmcv-toast-icon {
        color: #4ADE80;
    }

    .vmcv-toast.error .vmcv-toast-icon {
        color: #F87171;
    }

    .vmcv-toast.info .vmcv-toast-icon {
        color: #60A5FA;
    }

    .vmcv-toast.warning .vmcv-toast-icon {
        color: #FBBF24;
    }

    .vmcv-toast-msg {
        flex: 1;
    }

    .vmcv-toast-title {
        font-weight: 700;
        margin-bottom: 2px;
        font-size: 14px;
    }

    .vmcv-toast-sub {
        font-size: 11px;
        color: rgba(255, 255, 255, .7);
    }

    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateX(30px) scale(.96);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes toastOut {
        to {
            opacity: 0;
            transform: translateX(30px) scale(.96);
        }
    }

    .vmcv-loading-overlay {
        position: fixed;
        inset: 0;
        background: rgba(248, 250, 252, .95);
        backdrop-filter: blur(8px);
        z-index: 2000;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 24px;
    }

    .vmcv-loading-overlay.show {
        display: flex;
        animation: bgIn .2s ease;
    }

    .vmcv-loader-ring {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: 3px solid rgba(192, 39, 45, .15);
        border-top-color: var(--red);
        animation: spin .7s linear infinite;
    }

    .vmcv-loader-text {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--muted);
        letter-spacing: .02em;
    }

    .vmcv-editor::-webkit-scrollbar,
    .vmcv-preview-box::-webkit-scrollbar {
        width: 4px;
    }

    .vmcv-editor::-webkit-scrollbar-track,
    .vmcv-preview-box::-webkit-scrollbar-track {
        background: transparent;
    }

    .vmcv-editor::-webkit-scrollbar-thumb,
    .vmcv-preview-box::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 2px;
    }

    .vmcv-card {
        animation: cardIn .4s cubic-bezier(.4, 0, .2, 1) both;
    }

    .vmcv-card:nth-child(1) {
        animation-delay: .05s;
    }

    .vmcv-card:nth-child(2) {
        animation-delay: .12s;
    }

    .vmcv-card:nth-child(3) {
        animation-delay: .19s;
    }

    @keyframes cardIn {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .vmcv-history-card {
        animation: cardIn .4s .26s cubic-bezier(.4, 0, .2, 1) both;
    }

    /* Success animation for save button */
    .vmcv-save-btn.success {
        background: linear-gradient(135deg, var(--green) 0%, #0F5B2E 100%);
        animation: btnSuccess 0.5s ease;
    }

    @keyframes btnSuccess {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    /* Validation highlight */
    .vmcv-editor.invalid {
        border-color: #F87171;
        box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.1);
    }

    /* Auto-save indicator */
    .auto-save-indicator {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--ink);
        color: white;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .auto-save-indicator.show {
        opacity: 1;
    }

    .auto-save-indicator svg {
        width: 14px;
        height: 14px;
        animation: spin 1s linear infinite;
    }
</style>

<div id="vmcv-root">
    <!-- AUTO-SAVE INDICATOR -->
    <div class="auto-save-indicator" id="autoSaveIndicator">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        <span>Auto-saving...</span>
    </div>

    <!-- LOADING OVERLAY -->
    <div class="vmcv-loading-overlay" id="vmcvLoader">
        <div class="vmcv-loader-ring"></div>
        <div class="vmcv-loader-text" id="vmcvLoaderText">Saving changes…</div>
    </div>

    <!-- TOAST CONTAINER -->
    <div id="vmcv-toasts"></div>

    <!-- CONFIRM MODAL -->
    <div class="vmcv-modal-bg" id="vmcvConfirmModal">
        <div class="vmcv-modal">
            <div class="vmcv-modal-hd">
                <div class="vmcv-modal-icon warning">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="vmcv-modal-hd-text">
                    <h3>Confirm Save</h3>
                    <p id="vmcvConfirmSubtitle">Are you sure you want to save changes to this section?</p>
                </div>
            </div>
            <div class="vmcv-modal-body">
                <div class="vmcv-modal-detail" id="vmcvConfirmDetail">
                    Your edits will be published immediately and visible to all users.
                </div>
            </div>
            <div class="vmcv-modal-footer">
                <button class="vmcv-modal-btn secondary" onclick="closeConfirmModal()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </button>
                <button class="vmcv-modal-btn primary" id="vmcvConfirmBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Yes, Save It
                </button>
            </div>
        </div>
    </div>

    <!-- SUCCESS MODAL -->
    <div class="vmcv-modal-bg" id="vmcvSuccessModal">
        <div class="vmcv-modal">
            <div class="vmcv-modal-hd">
                <div class="vmcv-modal-icon success">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="vmcv-modal-hd-text">
                    <h3 id="successModalTitle">Success!</h3>
                    <p id="successModalMessage">Your changes have been saved successfully.</p>
                </div>
            </div>
            <div class="vmcv-modal-footer" style="justify-content: center;">
                <button class="vmcv-modal-btn primary" onclick="closeSuccessModal()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Got it
                </button>
            </div>
        </div>
    </div>

    <!-- VERSION HISTORY MODAL -->
    <div class="vmcv-modal-bg" id="vmcvHistoryModal">
        <div class="vmcv-modal" style="max-width:520px">
            <div class="vmcv-modal-hd">
                <div class="vmcv-modal-icon" style="background:#EFF6FF; color:#1D4ED8">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="vmcv-modal-hd-text">
                    <h3 id="vmcvHistoryTitle">Version Details</h3>
                    <p id="vmcvHistoryMeta">Viewing saved snapshot</p>
                </div>
            </div>
            <div class="vmcv-modal-body">
                <div class="vmcv-modal-detail" id="vmcvHistoryContent" style="font-size:13px;line-height:1.7;"></div>
            </div>
            <div class="vmcv-modal-footer">
                <button class="vmcv-modal-btn secondary" onclick="closeHistoryModal()">Close</button>
                <button class="vmcv-modal-btn primary" id="vmcvRestoreBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                    </svg>
                    Restore This Version
                </button>
            </div>
        </div>
    </div>

    <!-- PAGE HEADER -->
    <div class="vmcv-page-header">
        <div class="vmcv-breadcrumb">
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
            <span>›</span>
            Page Management
            <span>›</span>
            Vision, Mission & Values
        </div>
        <div class="vmcv-page-header-inner">
            <div>
                <h1 class="vmcv-page-title">Vision, Mission &<br><em>Core Values</em></h1>
                <p class="vmcv-page-sub">Manage the organization's foundational statements and guiding principles</p>
            </div>
            <div class="vmcv-header-badge">
                <span class="dot"></span>
                Auto-save enabled
            </div>
        </div>
    </div>

    <!-- VISION SECTION -->
    <div class="vmcv-card">
        <div class="vmcv-card-header">
            <div class="vmcv-card-header-num">01</div>
            <div class="vmcv-card-header-info">
                <div class="vmcv-card-header-label">Section One</div>
                <div class="vmcv-card-header-title">Vision Statement</div>
                <div class="vmcv-card-header-meta" id="vision-last-updated">
                    Last updated: {{ $vision ? $vision->updated_at->format('F j, Y \a\t g:i A') : 'Not yet saved' }}
                </div>
            </div>
            <div class="vmcv-card-header-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
        </div>
        <div class="vmcv-card-body">
            <div class="vmcv-two-col">
                <div class="vmcv-editor-panel">
                    <div class="vmcv-panel-label">Edit Content</div>
                    <div class="vmcv-toolbar" id="vision-toolbar">
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('bold', 'visionEditor')" title="Bold (Ctrl+B)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('italic', 'visionEditor')" title="Italic (Ctrl+I)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4M14 4l-4 16m-4 0h4" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('underline', 'visionEditor')" title="Underline (Ctrl+U)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M9 16h6M7 20h10" />
                            </svg>
                        </button>
                        <div class="vmcv-toolbar-sep"></div>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('insertUnorderedList', 'visionEditor')" title="Bullet list">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('insertOrderedList', 'visionEditor')" title="Numbered list">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6h11M10 12h11M10 18h11M4 6h.01M4 12h.01M4 18h.01" />
                            </svg>
                        </button>
                        <div class="vmcv-toolbar-sep"></div>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('removeFormat', 'visionEditor')" title="Clear formatting">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div id="visionEditor" class="vmcv-editor" contenteditable="true" oninput="handleEditorInput('vision')">
                        {!! $vision ? $vision->content : '<p><strong>To be the leading provider</strong> of quality housing solutions and sustainable community development in the region, empowering families to achieve their dreams of homeownership and improved quality of life.</p>' !!}
                    </div>
                    <div class="vmcv-editor-footer">
                        <div class="vmcv-wordcount">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 8h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span id="vision-wordcount">0 words</span>
                        </div>
                        <button type="button" class="vmcv-save-btn" id="vision-save-btn" onclick="requestSave('vision')">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <div class="btn-spinner"></div>
                            Save Vision
                        </button>
                    </div>
                </div>
                <div class="vmcv-preview-panel">
                    <div class="vmcv-panel-label">Live Preview</div>
                    <div class="vmcv-preview-box">
                        <div id="visionPreview" class="prose">
                            {!! $vision ? $vision->content : '<p><strong>To be the leading provider</strong> of quality housing solutions and sustainable community development in the region, empowering families to achieve their dreams of homeownership and improved quality of life.</p>' !!}
                        </div>
                    </div>
                    <div class="vmcv-updated-badge" id="vision-updated-badge">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><strong>Last saved:</strong> {{ $vision ? $vision->updated_at->format('F j, Y \a\t g:i A') : 'Not yet saved' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MISSION SECTION -->
    <div class="vmcv-card">
        <div class="vmcv-card-header">
            <div class="vmcv-card-header-num">02</div>
            <div class="vmcv-card-header-info">
                <div class="vmcv-card-header-label">Section Two</div>
                <div class="vmcv-card-header-title">Mission Statement</div>
                <div class="vmcv-card-header-meta" id="mission-last-updated">
                    Last updated: {{ $mission ? $mission->updated_at->format('F j, Y \a\t g:i A') : 'Not yet saved' }}
                </div>
            </div>
            <div class="vmcv-card-header-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
        </div>
        <div class="vmcv-card-body">
            <div class="vmcv-two-col">
                <div class="vmcv-editor-panel">
                    <div class="vmcv-panel-label">Edit Content</div>
                    <div class="vmcv-toolbar">
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('bold', 'missionEditor')" title="Bold (Ctrl+B)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('italic', 'missionEditor')" title="Italic (Ctrl+I)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4M14 4l-4 16m-4 0h4" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('underline', 'missionEditor')" title="Underline (Ctrl+U)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M9 16h6M7 20h10" />
                            </svg>
                        </button>
                        <div class="vmcv-toolbar-sep"></div>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('insertUnorderedList', 'missionEditor')" title="Bullet list">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('insertOrderedList', 'missionEditor')" title="Numbered list">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6h11M10 12h11M10 18h11M4 6h.01M4 12h.01M4 18h.01" />
                            </svg>
                        </button>
                        <div class="vmcv-toolbar-sep"></div>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('removeFormat', 'missionEditor')" title="Clear formatting">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div id="missionEditor" class="vmcv-editor" contenteditable="true" oninput="handleEditorInput('mission')">
                        {!! $mission ? $mission->content : '<p><strong>We are committed</strong> to providing accessible, affordable, and sustainable housing solutions through:</p>
                        <ul>
                            <li>Professional service and community engagement</li>
                            <li>Innovative development programs</li>
                            <li>Partnerships with stakeholders</li>
                            <li>Environmental responsibility</li>
                        </ul>' !!}
                    </div>
                    <div class="vmcv-editor-footer">
                        <div class="vmcv-wordcount">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 8h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span id="mission-wordcount">0 words</span>
                        </div>
                        <button type="button" class="vmcv-save-btn" id="mission-save-btn" onclick="requestSave('mission')">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <div class="btn-spinner"></div>
                            Save Mission
                        </button>
                    </div>
                </div>
                <div class="vmcv-preview-panel">
                    <div class="vmcv-panel-label">Live Preview</div>
                    <div class="vmcv-preview-box">
                        <div id="missionPreview" class="prose">
                            {!! $mission ? $mission->content : '<p><strong>We are committed</strong> to providing accessible, affordable, and sustainable housing solutions through:</p>
                            <ul>
                                <li>Professional service and community engagement</li>
                                <li>Innovative development programs</li>
                                <li>Partnerships with stakeholders</li>
                                <li>Environmental responsibility</li>
                            </ul>' !!}
                        </div>
                    </div>
                    <div class="vmcv-updated-badge" id="mission-updated-badge">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><strong>Last saved:</strong> {{ $mission ? $mission->updated_at->format('F j, Y \a\t g:i A') : 'Not yet saved' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CORE VALUES SECTION -->
    <div class="vmcv-card">
        <div class="vmcv-card-header">
            <div class="vmcv-card-header-num">03</div>
            <div class="vmcv-card-header-info">
                <div class="vmcv-card-header-label">Section Three</div>
                <div class="vmcv-card-header-title">Core Values</div>
                <div class="vmcv-card-header-meta" id="values-last-updated">
                    Last updated: {{ $coreValues->isNotEmpty() ? $coreValues->first()->updated_at->format('F j, Y \a\t g:i A') : 'Not yet saved' }}
                </div>
            </div>
            <div class="vmcv-card-header-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
        </div>
        <div class="vmcv-card-body">
            <div class="vmcv-two-col">
                <div class="vmcv-editor-panel">
                    <div class="vmcv-panel-label">Edit Content</div>
                    <div class="vmcv-toolbar">
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('bold', 'valuesEditor')" title="Bold (Ctrl+B)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('italic', 'valuesEditor')" title="Italic (Ctrl+I)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4M14 4l-4 16m-4 0h4" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('underline', 'valuesEditor')" title="Underline (Ctrl+U)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M9 16h6M7 20h10" />
                            </svg>
                        </button>
                        <div class="vmcv-toolbar-sep"></div>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('insertUnorderedList', 'valuesEditor')" title="Bullet list">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                            </svg>
                        </button>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('insertOrderedList', 'valuesEditor')" title="Numbered list">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6h11M10 12h11M10 18h11M4 6h.01M4 12h.01M4 18h.01" />
                            </svg>
                        </button>
                        <div class="vmcv-toolbar-sep"></div>
                        <button type="button" class="vmcv-toolbar-btn" onclick="formatText('removeFormat', 'valuesEditor')" title="Clear formatting">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div id="valuesEditor" class="vmcv-editor" contenteditable="true" oninput="handleEditorInput('values')">
                        @php
                        $defaultValues = '<p><strong>Our core values guide</strong> everything we do:</p>
                        <ul>
                            <li><strong>Integrity</strong> – We act with honesty and transparency</li>
                            <li><strong>Excellence</strong> – We strive for the highest standards</li>
                            <li><strong>Compassion</strong> – We care for our community</li>
                            <li><strong>Innovation</strong> – We embrace creative solutions</li>
                            <li><strong>Sustainability</strong> – We protect our environment</li>
                        </ul>';
                        @endphp
                        {!! $coreValues->isNotEmpty() ?
                        '<p><strong>Our core values guide</strong> everything we do:</p>
                        <ul>' .
                            implode('', $coreValues->map(function($value) {
                            return "<li><strong>{$value->value_title}</strong> – {$value->content}</li>";
                            })->toArray()) . '</ul>' :
                        $defaultValues
                        !!}
                    </div>
                    <div class="vmcv-editor-footer">
                        <div class="vmcv-wordcount">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 8h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span id="values-wordcount">0 words</span>
                        </div>
                        <button type="button" class="vmcv-save-btn" id="values-save-btn" onclick="requestSave('values')">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <div class="btn-spinner"></div>
                            Save Core Values
                        </button>
                    </div>
                </div>
                <div class="vmcv-preview-panel">
                    <div class="vmcv-panel-label">Live Preview</div>
                    <div class="vmcv-preview-box">
                        <div id="valuesPreview" class="prose">
                            {!! $coreValues->isNotEmpty() ?
                            '<p><strong>Our core values guide</strong> everything we do:</p>
                            <ul>' .
                                implode('', $coreValues->map(function($value) {
                                return "<li><strong>{$value->value_title}</strong> – {$value->content}</li>";
                                })->toArray()) . '</ul>' :
                            $defaultValues
                            !!}
                        </div>
                    </div>
                    <div class="vmcv-updated-badge" id="values-updated-badge">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><strong>Last saved:</strong> {{ $coreValues->isNotEmpty() ? $coreValues->first()->updated_at->format('F j, Y \a\t g:i A') : 'Not yet saved' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VERSION HISTORY -->
    <div class="vmcv-history-card">
        <div class="vmcv-history-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Version History
        </div>

        @if($visionHistory->count() > 0 || $missionHistory->count() > 0 || $valuesHistory->count() > 0)
        @foreach($visionHistory as $history)
        <div class="vmcv-history-row">
            <div>
                <div class="vmcv-history-row-title">Vision Statement — Version {{ $history->id }}</div>
                <div class="vmcv-history-row-meta">Updated by {{ $history->author->name ?? 'System' }} on {{ $history->created_at->format('F j, Y \a\t g:i A') }}</div>
            </div>
            <button type="button" class="vmcv-view-btn" onclick="viewHistory('vision', {{ $history->id }}, '{{ $history->author->name ?? 'System' }}', '{{ $history->created_at->format('F j, Y \a\t g:i A') }}')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View
            </button>
        </div>
        @endforeach

        @foreach($missionHistory as $history)
        <div class="vmcv-history-row">
            <div>
                <div class="vmcv-history-row-title">Mission Statement — Version {{ $history->id }}</div>
                <div class="vmcv-history-row-meta">Updated by {{ $history->author->name ?? 'System' }} on {{ $history->created_at->format('F j, Y \a\t g:i A') }}</div>
            </div>
            <button type="button" class="vmcv-view-btn" onclick="viewHistory('mission', {{ $history->id }}, '{{ $history->author->name ?? 'System' }}', '{{ $history->created_at->format('F j, Y \a\t g:i A') }}')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View
            </button>
        </div>
        @endforeach

        @foreach($valuesHistory as $history)
        <div class="vmcv-history-row">
            <div>
                <div class="vmcv-history-row-title">Core Values — Version {{ $history->id }}</div>
                <div class="vmcv-history-row-meta">Updated by {{ $history->author->name ?? 'System' }} on {{ $history->created_at->format('F j, Y \a\t g:i A') }}</div>
            </div>
            <button type="button" class="vmcv-view-btn" onclick="viewHistory('values', {{ $history->id }}, '{{ $history->author->name ?? 'System' }}', '{{ $history->created_at->format('F j, Y \a\t g:i A') }}')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View
            </button>
        </div>
        @endforeach
        @else
        <div style="text-align: center; padding: 40px; color: var(--muted);">
            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-bottom: 12px;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p>No version history available yet.</p>
            <p style="font-size: 12px; margin-top: 4px;">Save changes to track version history</p>
        </div>
        @endif
    </div>
</div>

<script>
    // State variables
    let pendingSaveSection = null;
    let currentHistorySection = null;
    let currentHistoryId = null;
    let currentHistoryContent = null;
    let autoSaveTimer = null;
    let isAutoSaving = false;

    // Store original/default content for each section
    const defaultContents = {
        vision: '<p><strong>To be the leading provider</strong> of quality housing solutions and sustainable community development in the region, empowering families to achieve their dreams of homeownership and improved quality of life.</p>',
        mission: '<p><strong>We are committed</strong> to providing accessible, affordable, and sustainable housing solutions through:</p>\n<ul>\n<li>Professional service and community engagement</li>\n<li>Innovative development programs</li>\n<li>Partnerships with stakeholders</li>\n<li>Environmental responsibility</li>\n</ul>',
        values: '<p><strong>Our core values guide</strong> everything we do:</p>\n<ul>\n<li><strong>Integrity</strong> – We act with honesty and transparency</li>\n<li><strong>Excellence</strong> – We strive for the highest standards</li>\n<li><strong>Compassion</strong> – We care for our community</li>\n<li><strong>Innovation</strong> – We embrace creative solutions</li>\n<li><strong>Sustainability</strong> – We protect our environment</li>\n</ul>'
    };

    // Helper functions
    function formatText(command, editorId) {
        const editor = document.getElementById(editorId);
        editor.focus();
        document.execCommand(command, false, null);
        const section = editorId.replace('Editor', '');
        syncPreview(section);
    }

    function syncPreview(section) {
        const editor = document.getElementById(section + 'Editor');
        const preview = document.getElementById(section + 'Preview');
        if (editor && preview) {
            // Only update preview while editing, don't change editor content
            preview.innerHTML = editor.innerHTML;
            updateWordCount(section);
        }
    }

    function updateWordCount(section) {
        const editor = document.getElementById(section + 'Editor');
        if (editor) {
            const text = editor.innerText || editor.textContent || '';
            const words = text.trim().split(/\s+/).filter(w => w.length > 0).length;
            const wordCountSpan = document.getElementById(section + '-wordcount');
            if (wordCountSpan) {
                wordCountSpan.textContent = words + (words === 1 ? ' word' : ' words');
            }
        }
    }

    function handleEditorInput(section) {
        syncPreview(section);

        // Auto-save feature (after 3 seconds of inactivity)
        if (autoSaveTimer) clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            autoSave(section);
        }, 3000);
    }

    async function autoSave(section) {
        if (isAutoSaving) return;

        const content = document.getElementById(section + 'Editor').innerHTML;

        // Only auto-save if content is not empty and has changed
        if (!content || content === '<p><br></p>' || content === '<br>') return;

        isAutoSaving = true;
        const indicator = document.getElementById('autoSaveIndicator');
        indicator.classList.add('show');

        try {
            await performSave(section, true);
        } finally {
            isAutoSaving = false;
            setTimeout(() => {
                indicator.classList.remove('show');
            }, 1000);
        }
    }

    // Toast notifications
    function showToast(title, message, type = 'success', duration = 3500) {
        const icons = {
            success: '<svg class="vmcv-toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            error: '<svg class="vmcv-toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            info: '<svg class="vmcv-toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            warning: '<svg class="vmcv-toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>'
        };

        const toast = document.createElement('div');
        toast.className = `vmcv-toast ${type}`;
        toast.innerHTML = `${icons[type]}<div class="vmcv-toast-msg"><div class="vmcv-toast-title">${title}</div><div class="vmcv-toast-sub">${message}</div></div>`;
        toast.onclick = () => {
            toast.style.animation = 'toastOut .25s ease forwards';
            setTimeout(() => toast.remove(), 260);
        };
        document.getElementById('vmcv-toasts').appendChild(toast);

        setTimeout(() => {
            if (toast.parentNode) {
                toast.style.animation = 'toastOut .25s ease forwards';
                setTimeout(() => toast.remove(), 260);
            }
        }, duration);
    }

    // Loading overlay
    function showLoading(text = 'Saving changes...') {
        document.getElementById('vmcvLoaderText').textContent = text;
        document.getElementById('vmcvLoader').classList.add('show');
    }

    function hideLoading() {
        document.getElementById('vmcvLoader').classList.remove('show');
    }

    // Save functionality
    function requestSave(section) {
        // Validate content
        const content = document.getElementById(section + 'Editor').innerHTML.trim();
        if (!content || content === '<p><br></p>' || content === '<br>') {
            showToast('Validation Error', 'Please enter some content before saving', 'warning', 3000);
            document.getElementById(section + 'Editor').classList.add('invalid');
            setTimeout(() => {
                document.getElementById(section + 'Editor').classList.remove('invalid');
            }, 2000);
            return;
        }

        pendingSaveSection = section;
        const sectionNames = {
            vision: 'Vision Statement',
            mission: 'Mission Statement',
            values: 'Core Values'
        };

        document.getElementById('vmcvConfirmSubtitle').textContent = `Save changes to the ${sectionNames[section]}?`;
        document.getElementById('vmcvConfirmDetail').textContent = `Your edits to the "${sectionNames[section]}" will be published immediately and visible to all site visitors.`;
        document.getElementById('vmcvConfirmModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeConfirmModal() {
        document.getElementById('vmcvConfirmModal').classList.remove('show');
        document.body.style.overflow = '';
        pendingSaveSection = null;
    }

    function showSuccessModal(title, message) {
        document.getElementById('successModalTitle').textContent = title;
        document.getElementById('successModalMessage').textContent = message;
        document.getElementById('vmcvSuccessModal').classList.add('show');
        document.body.style.overflow = 'hidden';

        // Auto close after 2 seconds
        setTimeout(() => {
            closeSuccessModal();
        }, 2000);
    }

    function closeSuccessModal() {
        document.getElementById('vmcvSuccessModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    async function performSave(section, isAuto = false) {
        const content = document.getElementById(section + 'Editor').innerHTML;
        let url = '';
        let payload = {};

        switch (section) {
            case 'vision':
                url = '{{ route("save.vision") }}';
                payload = {
                    content: content,
                    _token: '{{ csrf_token() }}'
                };
                break;
            case 'mission':
                url = '{{ route("save.mission") }}';
                payload = {
                    content: content,
                    _token: '{{ csrf_token() }}'
                };
                break;
            case 'values':
                url = '{{ route("save.core-values") }}';
                payload = {
                    content: content,
                    _token: '{{ csrf_token() }}'
                };
                break;
        }

        try {
            if (!isAuto) showLoading(`Saving ${section}...`);

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();
            if (!isAuto) hideLoading();

            if (data.success) {
                // IMPORTANT: Clear the editor content after successful save
                const editor = document.getElementById(section + 'Editor');
                if (editor) {
                    editor.innerHTML = ''; // Clear the editor
                    updateWordCount(section);
                }

                // Update preview with the saved content from database
                const preview = document.getElementById(section + 'Preview');
                if (preview) {
                    preview.innerHTML = data.data.content; // Use saved content from database
                }

                // Update timestamps and metadata
                const lastUpdatedSpan = document.getElementById(section + '-last-updated');
                if (lastUpdatedSpan) {
                    lastUpdatedSpan.textContent = `Last updated: ${data.data.updated_at}`;
                }

                // Update the badge in preview panel with animation
                const badge = document.getElementById(section + '-updated-badge');
                if (badge) {
                    const span = badge.querySelector('span');
                    if (span) span.innerHTML = `<strong>Last saved:</strong> ${data.data.updated_at}`;
                    badge.classList.add('updated');
                    setTimeout(() => badge.classList.remove('updated'), 500);
                }

                // Animate save button
                const saveBtn = document.getElementById(section + '-save-btn');
                if (saveBtn) {
                    saveBtn.classList.add('success');
                    setTimeout(() => saveBtn.classList.remove('success'), 500);
                }

                if (!isAuto) {
                    showSuccessModal('Success!', `${section.charAt(0).toUpperCase() + section.slice(1)} has been saved successfully. The editor has been cleared for new input.`);
                    showToast('Saved!', `${section.charAt(0).toUpperCase() + section.slice(1)} saved. Editor cleared for new content.`, 'success', 3000);
                } else {
                    showToast('Auto-saved', `${section.charAt(0).toUpperCase() + section.slice(1)} auto-saved`, 'info', 1500);
                }

                return true;
            } else {
                if (!isAuto) {
                    showToast('Error', data.message || 'Failed to save', 'error');
                }
                return false;
            }
        } catch (error) {
            if (!isAuto) {
                hideLoading();
                showToast('Error', 'Network error. Please try again.', 'error');
            }
            return false;
        }
    }

    async function saveSection(section) {
        await performSave(section, false);
    }

    // Version history
    async function viewHistory(type, id, author, date) {
        currentHistorySection = type;
        currentHistoryId = id;

        try {
            showLoading('Loading version...');
            const response = await fetch(`/get-version/${type}/${id}`);
            const data = await response.json();
            hideLoading();

            if (data.success) {
                currentHistoryContent = data.content;
                const sectionNames = {
                    vision: 'Vision Statement',
                    mission: 'Mission Statement',
                    values: 'Core Values'
                };
                document.getElementById('vmcvHistoryTitle').textContent = `${sectionNames[type]} — Version ${id}`;
                document.getElementById('vmcvHistoryMeta').textContent = `Saved by ${author} on ${date}`;
                document.getElementById('vmcvHistoryContent').innerHTML = data.content || '<em>No content available.</em>';
                document.getElementById('vmcvHistoryModal').classList.add('show');
                document.body.style.overflow = 'hidden';
            } else {
                showToast('Error', 'Failed to load version content', 'error');
            }
        } catch (error) {
            hideLoading();
            showToast('Error', 'Failed to load version', 'error');
        }
    }

    function closeHistoryModal() {
        document.getElementById('vmcvHistoryModal').classList.remove('show');
        document.body.style.overflow = '';
        currentHistorySection = null;
        currentHistoryId = null;
        currentHistoryContent = null;
    }

    async function restoreVersion() {
        if (!currentHistorySection || !currentHistoryContent) {
            showToast('Error', 'No version selected to restore', 'error');
            return;
        }

        closeHistoryModal();

        try {
            showLoading(`Restoring ${currentHistorySection}...`);

            // Use URLSearchParams for proper form data encoding
            const formData = new URLSearchParams();
            formData.append('type', currentHistorySection);
            formData.append('content', currentHistoryContent);
            formData.append('_token', '{{ csrf_token() }}');

            const response = await fetch('/restore-version', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData.toString()
            });

            const data = await response.json();
            hideLoading();

            if (data.success) {
                showToast('Success', 'Version restored successfully! Refreshing page...', 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showToast('Error', data.message || 'Failed to restore version', 'error');
            }
        } catch (error) {
            hideLoading();
            console.error('Restore error:', error);
            showToast('Error', 'Failed to restore version: ' + error.message, 'error');
        }
    }

    // Function to reset form (clear editor but keep preview showing latest)
    function resetForm(section) {
        const editor = document.getElementById(section + 'Editor');
        if (editor) {
            editor.innerHTML = '';
            updateWordCount(section);
        }
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', () => {
        ['vision', 'mission', 'values'].forEach(section => {
            // Make sure preview shows the latest saved content
            const preview = document.getElementById(section + 'Preview');
            const editor = document.getElementById(section + 'Editor');

            // Clear editor on page load so user can input new content
            if (editor) {
                editor.innerHTML = '';
                updateWordCount(section);
            }
        });

        // Confirm save button
        document.getElementById('vmcvConfirmBtn').addEventListener('click', () => {
            if (pendingSaveSection) {
                closeConfirmModal();
                saveSection(pendingSaveSection);
                pendingSaveSection = null;
            }
        });

        // Restore button
        document.getElementById('vmcvRestoreBtn').addEventListener('click', restoreVersion);

        // Close modals on backdrop click
        document.getElementById('vmcvConfirmModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('vmcvConfirmModal')) closeConfirmModal();
        });
        document.getElementById('vmcvSuccessModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('vmcvSuccessModal')) closeSuccessModal();
        });
        document.getElementById('vmcvHistoryModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('vmcvHistoryModal')) closeHistoryModal();
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            const ctrl = e.ctrlKey || e.metaKey;
            const active = document.activeElement;
            const isEditor = active && active.contentEditable === 'true';

            if (ctrl && isEditor) {
                if (e.key === 'b') {
                    e.preventDefault();
                    formatText('bold', active.id);
                }
                if (e.key === 'i') {
                    e.preventDefault();
                    formatText('italic', active.id);
                }
                if (e.key === 'u') {
                    e.preventDefault();
                    formatText('underline', active.id);
                }
                if (e.key === 's') {
                    e.preventDefault();
                    const section = active.id.replace('Editor', '');
                    requestSave(section);
                }
            }
            if (e.key === 'Escape') {
                closeConfirmModal();
                closeSuccessModal();
                closeHistoryModal();
            }
        });
    });
</script>
@endsection