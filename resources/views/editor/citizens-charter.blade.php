@extends('editor.layout')

@section('content')

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .cc-wrap {
        font-family: Arial, sans-serif;
        background: #f4f4f2;
        min-height: 100vh;
        padding: 36px 28px 72px;
    }

    /* ── Page Header ── */
    .cc-page-header {
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e5e2dc;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .cc-page-header-left {}

    .cc-page-header h1 {
        font-size: 26px;
        font-weight: 700;
        color: #1a1a1a;
        letter-spacing: -0.3px;
    }

    .cc-page-header p {
        font-size: 13.5px;
        color: #777;
        margin-top: 4px;
    }

    .cc-autosave {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #fff;
        border: 1px solid #e0ddd8;
        border-radius: 20px;
        padding: 5px 13px;
        font-size: 12px;
        color: #555;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
        align-self: center;
    }

    .cc-autosave-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 5px rgba(34, 197, 94, .6);
        animation: blink 2.2s ease-in-out infinite;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1
        }

        50% {
            opacity: .4
        }
    }

    /* ── Cards ── */
    .cc-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #e5e2dc;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05), 0 1px 2px rgba(0, 0, 0, .04);
        margin-bottom: 22px;
        overflow: hidden;
        animation: slideUp .4s ease both;
    }

    .cc-card:nth-child(1) {
        animation-delay: .05s;
    }

    .cc-card:nth-child(2) {
        animation-delay: .12s;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(10px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    .cc-card-header {
        background: linear-gradient(90deg, #7f1d1d 0%, #991b1b 60%, #b91c1c 100%);
        padding: 14px 22px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-left: 4px solid #d97706;
        position: relative;
        overflow: hidden;
    }

    .cc-card-header::after {
        content: '';
        position: absolute;
        right: -30px;
        top: -30px;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
        pointer-events: none;
    }

    .cc-card-header-icon {
        width: 30px;
        height: 30px;
        background: rgba(255, 255, 255, .15);
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .cc-card-header h2 {
        font-size: 15px;
        font-weight: 700;
        color: #fff;
        letter-spacing: .01em;
    }

    .cc-card-body {
        padding: 24px;
    }

    /* ── Tabs ── */
    .cc-tabs {
        display: flex;
        border-bottom: 1.5px solid #e5e2dc;
        margin-bottom: 20px;
        gap: 0;
    }

    .cc-tab {
        padding: 8px 18px;
        background: none;
        border: none;
        border-bottom: 2.5px solid transparent;
        margin-bottom: -1.5px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #888;
        cursor: pointer;
        transition: color .15s, border-color .15s;
        letter-spacing: .01em;
    }

    .cc-tab:hover {
        color: #7f1d1d;
    }

    .cc-tab.active {
        color: #7f1d1d;
        border-bottom-color: #7f1d1d;
    }

    .cc-tab-panel {
        display: none;
    }

    .cc-tab-panel.active {
        display: block;
        animation: fadeIn .2s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    /* ── Toolbar ── */
    .cc-toolbar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 2px;
        background: #fafaf8;
        border: 1px solid #e0ddd8;
        border-bottom: none;
        border-radius: 8px 8px 0 0;
        padding: 7px 10px;
    }

    .cc-tb-btn {
        width: 30px;
        height: 30px;
        border: 1px solid transparent;
        background: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #444;
        font-family: Arial, sans-serif;
        font-size: 12.5px;
        font-weight: 700;
        transition: background .12s, border-color .12s;
    }

    .cc-tb-btn:hover {
        background: #eeede9;
        border-color: #d8d5cf;
    }

    .cc-tb-btn svg {
        width: 13px;
        height: 13px;
    }

    .cc-tb-sep {
        width: 1px;
        height: 20px;
        background: #e0ddd8;
        margin: 0 4px;
    }

    .cc-tb-select {
        height: 30px;
        padding: 0 8px;
        border: 1px solid #e0ddd8;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 12px;
        background: #fff;
        color: #333;
        cursor: pointer;
    }

    /* ── Editor ── */
    .cc-editor {
        min-height: 200px;
        border: 1px solid #e0ddd8;
        border-top: none;
        border-radius: 0 0 8px 8px;
        padding: 16px 18px;
        outline: none;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.75;
        color: #222;
        transition: border-color .2s, box-shadow .2s;
    }

    .cc-editor:focus {
        border-color: #b91c1c;
        box-shadow: 0 0 0 3px rgba(185, 28, 28, .07);
    }

    .cc-editor ul,
    .cc-editor ol {
        padding-left: 22px;
    }

    .cc-editor p {
        margin-bottom: 8px;
    }

    .cc-editor h2 {
        font-size: 16px;
        margin-bottom: 8px;
        color: #1a1a1a;
    }

    .cc-editor h3 {
        font-size: 14.5px;
        margin-bottom: 6px;
        color: #1a1a1a;
    }

    .cc-editor-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 8px;
        font-size: 11.5px;
        color: #aaa;
    }

    /* ── Preview ── */
    .cc-preview {
        background: #fafaf8;
        border: 1px solid #e0ddd8;
        border-radius: 8px;
        padding: 18px 20px;
        min-height: 140px;
        font-size: 14px;
        line-height: 1.75;
        color: #333;
    }

    .cc-preview ul {
        padding-left: 22px;
    }

    .cc-preview p {
        margin-bottom: 8px;
    }

    /* ── Buttons ── */
    .cc-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 7px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: filter .15s, transform .15s, box-shadow .15s;
        white-space: nowrap;
        letter-spacing: .01em;
    }

    .cc-btn svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    .cc-btn:hover:not(:disabled) {
        filter: brightness(.92);
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, .12);
    }

    .cc-btn:active:not(:disabled) {
        transform: none;
        box-shadow: none;
    }

    .cc-btn:disabled {
        opacity: .55;
        cursor: not-allowed;
    }

    .cc-btn-amber {
        background: #d97706;
        color: #fff;
    }

    .cc-btn-red {
        background: #b91c1c;
        color: #fff;
    }

    .cc-btn-blue {
        background: #1d4ed8;
        color: #fff;
    }

    .cc-btn-green {
        background: #15803d;
        color: #fff;
    }

    .cc-btn-gray {
        background: #4b5563;
        color: #fff;
    }

    .cc-btn-danger {
        background: #dc2626;
        color: #fff;
    }

    .cc-btn-ghost {
        background: #f3f2ef;
        color: #333;
        border: 1px solid #e0ddd8;
    }

    .cc-btn-ghost:hover:not(:disabled) {
        background: #e8e6e1;
    }

    /* ── Doc info box ── */
    .cc-doc-info {
        background: #fafaf8;
        border: 1px solid #e0ddd8;
        border-radius: 8px;
        padding: 0;
        overflow: hidden;
    }

    .cc-doc-info-top {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 0;
        border-bottom: 1px solid #e0ddd8;
    }

    .cc-doc-info-cell {
        padding: 14px 18px;
        border-right: 1px solid #e0ddd8;
    }

    .cc-doc-info-cell:last-child {
        border-right: none;
    }

    .cc-doc-info-label {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #999;
        margin-bottom: 4px;
    }

    .cc-doc-info-value {
        font-size: 13.5px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .cc-doc-info-actions {
        padding: 16px 18px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    /* ── Status badge ── */
    .cc-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 9px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: .02em;
    }

    .cc-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .cc-badge-active {
        background: #dcfce7;
        color: #15803d;
    }

    .cc-badge-active .cc-badge-dot {
        background: #22c55e;
        animation: blink 2s infinite;
    }

    .cc-badge-inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .cc-badge-inactive .cc-badge-dot {
        background: #94a3b8;
    }

    /* ── Notice ── */
    .cc-notice {
        display: flex;
        gap: 10px;
        border-radius: 8px;
        padding: 12px 14px;
        font-size: 12.5px;
        line-height: 1.55;
    }

    .cc-notice svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .cc-notice-info {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
    }

    .cc-notice-warn {
        background: #fffbeb;
        border: 1px solid #fde68a;
        color: #92400e;
    }

    /* ── Version history ── */
    .cc-version-list {
        margin-top: 20px;
    }

    .cc-version-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #999;
        margin-bottom: 10px;
    }

    .cc-version-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        border: 1px solid #e5e2dc;
        border-radius: 7px;
        background: #fff;
        margin-bottom: 7px;
        transition: background .15s, border-color .15s;
        flex-wrap: wrap;
        gap: 8px;
    }

    .cc-version-row:hover {
        background: #fafaf8;
        border-color: #d5d2cc;
    }

    .cc-version-tag {
        font-size: 10.5px;
        font-weight: 700;
        background: #fee2e2;
        color: #b91c1c;
        padding: 2px 7px;
        border-radius: 4px;
        margin-right: 10px;
        letter-spacing: .04em;
        font-family: 'Courier New', monospace;
    }

    .cc-version-name {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .cc-version-meta {
        font-size: 11px;
        color: #999;
        margin-top: 2px;
    }

    .cc-version-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ── Modal ── */
    .cc-modal-backdrop {
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

    .cc-modal-backdrop.open {
        opacity: 1;
        pointer-events: all;
    }

    .cc-modal {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .2), 0 6px 20px rgba(0, 0, 0, .1);
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(.96) translateY(10px);
        transition: transform .25s cubic-bezier(.34, 1.56, .64, 1);
    }

    .cc-modal-backdrop.open .cc-modal {
        transform: none;
    }

    .cc-modal-head {
        padding: 18px 22px;
        border-bottom: 1px solid #e5e2dc;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .cc-modal-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .cc-modal-close {
        width: 30px;
        height: 30px;
        border: 1px solid #e5e2dc;
        background: #f3f2ef;
        border-radius: 7px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        transition: background .15s, color .15s;
    }

    .cc-modal-close:hover {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fca5a5;
    }

    .cc-modal-close svg {
        width: 14px;
        height: 14px;
    }

    .cc-modal-body {
        padding: 22px;
    }

    .cc-modal-foot {
        padding: 14px 22px;
        border-top: 1px solid #e5e2dc;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    /* ── Drop zone ── */
    .cc-drop-zone {
        border: 2px dashed #d5d2cc;
        border-radius: 8px;
        padding: 32px 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color .18s, background .18s;
        position: relative;
    }

    .cc-drop-zone input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .cc-drop-zone:hover,
    .cc-drop-zone.drag-over {
        border-color: #b91c1c;
        background: #fff5f5;
    }

    .cc-drop-zone-ico {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .cc-drop-zone p {
        font-size: 13px;
        color: #777;
    }

    .cc-drop-zone strong {
        color: #b91c1c;
    }

    .cc-drop-zone-hint {
        font-size: 11px;
        color: #bbb;
        margin-top: 4px;
    }

    .cc-file-pill {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 14px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        margin-top: 12px;
        animation: slideUp .25s ease;
    }

    .cc-file-pill-ico {
        font-size: 20px;
    }

    .cc-file-pill-name {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .cc-file-pill-size {
        font-size: 11.5px;
        color: #777;
    }

    /* ── Confirm modal ── */
    .cc-confirm-ico {
        width: 52px;
        height: 52px;
        background: #fee2e2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin: 0 auto 14px;
    }

    /* ── Toast ── */
    #cc-toasts {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 9px;
        pointer-events: none;
    }

    .cc-toast {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 14px;
        background: #fff;
        border: 1px solid #e5e2dc;
        border-radius: 10px;
        box-shadow: 0 8px 28px rgba(0, 0, 0, .12), 0 2px 8px rgba(0, 0, 0, .07);
        min-width: 260px;
        max-width: 340px;
        pointer-events: all;
        position: relative;
        overflow: hidden;
        animation: toastIn .3s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    .cc-toast.out {
        animation: toastOut .25s ease both;
    }

    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateX(30px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    @keyframes toastOut {
        from {
            opacity: 1;
            transform: none
        }

        to {
            opacity: 0;
            transform: translateX(30px)
        }
    }

    .cc-toast-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        transform-origin: left;
        animation: shrink 3.3s linear forwards;
    }

    @keyframes shrink {
        from {
            transform: scaleX(1)
        }

        to {
            transform: scaleX(0)
        }
    }

    .cc-toast-ico {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .cc-toast-content {
        flex: 1;
    }

    .cc-toast-title {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1px;
    }

    .cc-toast-msg {
        font-size: 12px;
        color: #666;
    }

    .cc-toast-x {
        background: none;
        border: none;
        cursor: pointer;
        color: #aaa;
        font-size: 16px;
        line-height: 1;
        padding: 0 2px;
        transition: color .12s;
    }

    .cc-toast-x:hover {
        color: #333;
    }

    .cc-toast.success .cc-toast-ico {
        color: #15803d;
    }

    .cc-toast.success .cc-toast-bar {
        background: #22c55e;
    }

    .cc-toast.error .cc-toast-ico {
        color: #dc2626;
    }

    .cc-toast.error .cc-toast-bar {
        background: #dc2626;
    }

    .cc-toast.warning .cc-toast-ico {
        color: #d97706;
    }

    .cc-toast.warning .cc-toast-bar {
        background: #d97706;
    }

    .cc-toast.info .cc-toast-ico {
        color: #1d4ed8;
    }

    .cc-toast.info .cc-toast-bar {
        background: #1d4ed8;
    }

    /* ── Spinner ── */
    .cc-spinner {
        width: 15px;
        height: 15px;
        border: 2px solid rgba(255, 255, 255, .35);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin .65s linear infinite;
        flex-shrink: 0;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg)
        }
    }

    /* ── Divider ── */
    .cc-divider {
        height: 1px;
        background: #e5e2dc;
        margin: 22px 0;
    }

    @media(max-width:600px) {
        .cc-wrap {
            padding: 20px 14px 60px;
        }

        .cc-card-body {
            padding: 16px;
        }

        .cc-doc-info-top {
            grid-template-columns: 1fr 1fr;
        }

        .cc-doc-info-cell {
            border-right: none;
            border-bottom: 1px solid #e0ddd8;
        }

        .cc-page-header {
            flex-direction: column;
        }
    }
</style>

<div class="cc-wrap">

    {{-- ── Page Header ── --}}
    <div class="cc-page-header">
        <div class="cc-page-header-left">
            <h1>Citizen's Charter</h1>
            <p>Manage Citizen's Charter content and document</p>
        </div>
        <div class="cc-autosave" id="autosavePill">
            <div class="cc-autosave-dot" id="autosaveDot"></div>
            <span id="autosaveText">All changes saved</span>
        </div>
    </div>

    {{-- ── Section 1: Intro Content ── --}}
    <div class="cc-card">
        <div class="cc-card-header">
            <div class="cc-card-header-icon">📝</div>
            <h2>Section 1: Intro Content</h2>
        </div>
        <div class="cc-card-body">

            {{-- Tabs --}}
            <div class="cc-tabs">
                <button class="cc-tab active" onclick="ccSwitchTab('edit', this)">Edit Content</button>
                <button class="cc-tab" onclick="ccSwitchTab('preview', this)">Preview</button>
            </div>

            {{-- Edit panel --}}
            <div class="cc-tab-panel active" id="cc-tab-edit">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#999;margin-bottom:8px;">Introduction Text</label>

                {{-- Toolbar --}}
                <div class="cc-toolbar">
                    <button class="cc-tb-btn" onclick="ccFmt('bold')" title="Bold"><b>B</b></button>
                    <button class="cc-tb-btn" onclick="ccFmt('italic')" title="Italic"><i>I</i></button>
                    <button class="cc-tb-btn" onclick="ccFmt('underline')" title="Underline"><u>U</u></button>
                    <button class="cc-tb-btn" onclick="ccFmt('strikeThrough')" title="Strikethrough"><s>S</s></button>
                    <div class="cc-tb-sep"></div>
                    <select class="cc-tb-select" onchange="ccFmtBlock(this.value);this.value=''">
                        <option value="">Format</option>
                        <option value="h2">Heading 2</option>
                        <option value="h3">Heading 3</option>
                        <option value="p">Paragraph</option>
                    </select>
                    <div class="cc-tb-sep"></div>
                    <button class="cc-tb-btn" onclick="ccFmt('insertUnorderedList')" title="Bullet list">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="9" y1="6" x2="21" y2="6" />
                            <line x1="9" y1="12" x2="21" y2="12" />
                            <line x1="9" y1="18" x2="21" y2="18" />
                            <circle cx="4" cy="6" r="1.5" fill="currentColor" />
                            <circle cx="4" cy="12" r="1.5" fill="currentColor" />
                            <circle cx="4" cy="18" r="1.5" fill="currentColor" />
                        </svg>
                    </button>
                    <button class="cc-tb-btn" onclick="ccFmt('insertOrderedList')" title="Numbered list">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="10" y1="6" x2="21" y2="6" />
                            <line x1="10" y1="12" x2="21" y2="12" />
                            <line x1="10" y1="18" x2="21" y2="18" />
                            <path d="M4 6h1v4M4 10h2" />
                            <path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1.5" />
                        </svg>
                    </button>
                    <div class="cc-tb-sep"></div>
                    <button class="cc-tb-btn" onclick="ccFmt('justifyLeft')" title="Align left">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="12" x2="14" y2="12" />
                            <line x1="3" y1="18" x2="17" y2="18" />
                        </svg>
                    </button>
                    <button class="cc-tb-btn" onclick="ccFmt('justifyCenter')" title="Align center">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="6" y1="12" x2="18" y2="12" />
                            <line x1="4" y1="18" x2="20" y2="18" />
                        </svg>
                    </button>
                    <div class="cc-tb-sep"></div>
                    <button class="cc-tb-btn" onclick="ccFmt('undo')" title="Undo">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="1 4 1 10 7 10" />
                            <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
                        </svg>
                    </button>
                    <button class="cc-tb-btn" onclick="ccFmt('redo')" title="Redo">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="23 4 23 10 17 10" />
                            <path d="M20.49 15a9 9 0 11-2.12-9.36L23 10" />
                        </svg>
                    </button>
                </div>

                {{-- Editor --}}
                <div id="ccIntroEditor" contenteditable="true" class="cc-editor">
                    <p>Welcome to the Provincial Disaster Risk Reduction and Management Office (PDRRMO) Citizen's Charter. This document serves as your guide to understanding our services, procedures, and commitments to the public. We are dedicated to providing efficient, transparent, and responsive disaster risk reduction and management services to all citizens of our province.</p>
                    <p>Our charter outlines the following key areas:</p>
                    <ul>
                        <li>Emergency response procedures</li>
                        <li>Disaster preparedness programs</li>
                        <li>Risk assessment and mitigation</li>
                        <li>Public information and education</li>
                        <li>Coordination with partner agencies</li>
                    </ul>
                </div>

                <div class="cc-editor-meta">
                    <span id="ccWordCount" style="font-family:'Courier New',monospace;">Words: 0 · Chars: 0</span>
                    <span>Last edited: <span id="ccLastEdited">just now</span></span>
                </div>
            </div>

            {{-- Preview panel --}}
            <div class="cc-tab-panel" id="cc-tab-preview">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#999;margin-bottom:8px;">Live Preview</label>
                <div class="cc-preview" id="ccPreview"></div>
            </div>

            <div class="cc-divider"></div>

            <div style="display:flex;justify-content:flex-end;">
                <button class="cc-btn cc-btn-amber" id="ccSaveBtn" onclick="ccSaveIntro()">
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

    {{-- ── Section 2: Charter Document ── --}}
    <div class="cc-card">
        <div class="cc-card-header">
            <div class="cc-card-header-icon">📄</div>
            <h2>Section 2: Citizen's Charter Document</h2>
        </div>
        <div class="cc-card-body">

            {{-- Doc info grid --}}
            <div class="cc-doc-info">
                <div class="cc-doc-info-top">
                    <div class="cc-doc-info-cell">
                        <div class="cc-doc-info-label">Current File</div>
                        <div class="cc-doc-info-value" id="ccDocName">Citizen_Charter_2026.pdf</div>
                    </div>
                    <div class="cc-doc-info-cell">
                        <div class="cc-doc-info-label">Upload Date</div>
                        <div class="cc-doc-info-value" id="ccDocDate">March 1, 2026</div>
                    </div>
                    <div class="cc-doc-info-cell">
                        <div class="cc-doc-info-label">File Size</div>
                        <div class="cc-doc-info-value" id="ccDocSize">2.4 MB</div>
                    </div>
                    <div class="cc-doc-info-cell">
                        <div class="cc-doc-info-label">Status</div>
                        <div class="cc-badge cc-badge-active" id="ccDocBadge">
                            <div class="cc-badge-dot"></div>Active
                        </div>
                    </div>
                </div>
                <div class="cc-doc-info-actions">
                    <button class="cc-btn cc-btn-amber" onclick="ccOpenModal('ccUploadModal')">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="16 16 12 12 8 16" />
                            <line x1="12" y1="12" x2="12" y2="21" />
                            <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3" />
                        </svg>
                        Upload PDF
                    </button>
                    <button class="cc-btn cc-btn-blue" onclick="ccViewDoc()">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        View PDF
                    </button>
                    <button class="cc-btn cc-btn-green" onclick="ccOpenModal('ccReplaceModal')">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="1 4 1 10 7 10" />
                            <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
                        </svg>
                        Replace PDF
                    </button>
                    <button class="cc-btn cc-btn-gray" onclick="ccToggleStatus()">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M18.36 6.64a9 9 0 11-12.73 0" />
                            <line x1="12" y1="2" x2="12" y2="12" />
                        </svg>
                        Toggle Status
                    </button>
                    <button class="cc-btn cc-btn-danger" onclick="ccOpenModal('ccDeleteModal')">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                            <path d="M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                        </svg>
                        Delete PDF
                    </button>
                </div>
            </div>

            {{-- Note --}}
            <div class="cc-notice cc-notice-info" style="margin-top:16px;">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                <span><strong>Note:</strong> Only one active Citizen's Charter document can be displayed at a time. When uploading a new document, it will automatically become the active document.</span>
            </div>

            {{-- Version History --}}
            <div class="cc-version-list">
                <div class="cc-version-label">Version History</div>
                <div id="ccVersionHistory">
                    <div class="cc-version-row">
                        <div style="display:flex;align-items:center;">
                            <span class="cc-version-tag">v3</span>
                            <div>
                                <div class="cc-version-name">Citizen_Charter_2026.pdf</div>
                                <div class="cc-version-meta">March 1, 2026 · 2.4 MB · Uploaded by Admin</div>
                            </div>
                        </div>
                        <div class="cc-version-right">
                            <span class="cc-badge cc-badge-active"><span class="cc-badge-dot"></span>Active</span>
                        </div>
                    </div>
                    <div class="cc-version-row">
                        <div style="display:flex;align-items:center;">
                            <span class="cc-version-tag">v2</span>
                            <div>
                                <div class="cc-version-name">Citizen_Charter_2025_rev.pdf</div>
                                <div class="cc-version-meta">June 15, 2025 · 1.9 MB · Uploaded by Admin</div>
                            </div>
                        </div>
                        <div class="cc-version-right">
                            <span class="cc-badge cc-badge-inactive"><span class="cc-badge-dot"></span>Archived</span>
                            <button class="cc-btn cc-btn-ghost" style="padding:5px 10px;font-size:12px;" onclick="ccShowToast('info','Restored','Version restored as active document.')">Restore</button>
                        </div>
                    </div>
                    <div class="cc-version-row">
                        <div style="display:flex;align-items:center;">
                            <span class="cc-version-tag">v1</span>
                            <div>
                                <div class="cc-version-name">Citizen_Charter_2024.pdf</div>
                                <div class="cc-version-meta">January 10, 2024 · 1.5 MB · Uploaded by Admin</div>
                            </div>
                        </div>
                        <div class="cc-version-right">
                            <span class="cc-badge cc-badge-inactive"><span class="cc-badge-dot"></span>Archived</span>
                            <button class="cc-btn cc-btn-ghost" style="padding:5px 10px;font-size:12px;" onclick="ccShowToast('info','Restored','Version restored as active document.')">Restore</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>{{-- /.cc-wrap --}}

{{-- ── Toast Stack ── --}}
<div id="cc-toasts"></div>

{{-- ── Upload Modal ── --}}
<div class="cc-modal-backdrop" id="ccUploadModal">
    <div class="cc-modal">
        <div class="cc-modal-head">
            <span class="cc-modal-title">Upload Citizen's Charter PDF</span>
            <button class="cc-modal-close" onclick="ccCloseModal('ccUploadModal')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="cc-modal-body">
            <div class="cc-notice cc-notice-warn" style="margin-bottom:16px;">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    <line x1="12" y1="9" x2="12" y2="13" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
                <span><strong>Important:</strong> This new PDF will automatically become the active Citizen's Charter document and replace any existing active document.</span>
            </div>
            <div class="cc-drop-zone" id="ccUploadDrop">
                <input type="file" id="ccUploadInput" accept=".pdf" onchange="ccHandleFile(this,'ccUploadPrev')">
                <div class="cc-drop-zone-ico">📂</div>
                <p><strong>Click to upload</strong> or drag and drop</p>
                <p class="cc-drop-zone-hint">PDF files only, up to 10MB</p>
            </div>
            <div class="cc-file-pill" id="ccUploadPrev" style="display:none;">
                <span class="cc-file-pill-ico">📄</span>
                <div>
                    <div class="cc-file-pill-name" id="ccUploadPrevName">—</div>
                    <div class="cc-file-pill-size" id="ccUploadPrevSize">—</div>
                </div>
            </div>
        </div>
        <div class="cc-modal-foot">
            <button class="cc-btn cc-btn-ghost" onclick="ccCloseModal('ccUploadModal')">Cancel</button>
            <button class="cc-btn cc-btn-amber" id="ccUploadSubmit" onclick="ccDoUpload()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="16 16 12 12 8 16" />
                    <line x1="12" y1="12" x2="12" y2="21" />
                    <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3" />
                </svg>
                Upload PDF
            </button>
        </div>
    </div>
</div>

{{-- ── Replace Modal ── --}}
<div class="cc-modal-backdrop" id="ccReplaceModal">
    <div class="cc-modal">
        <div class="cc-modal-head">
            <span class="cc-modal-title">Replace Citizen's Charter PDF</span>
            <button class="cc-modal-close" onclick="ccCloseModal('ccReplaceModal')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
        <div class="cc-modal-body">
            <div class="cc-notice cc-notice-warn" style="margin-bottom:16px;">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    <line x1="12" y1="9" x2="12" y2="13" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
                <span><strong>Warning:</strong> Replacing this document will overwrite the existing Citizen's Charter PDF. This action cannot be undone.</span>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#999;margin-bottom:8px;">Current Document</label>
                <div style="padding:12px 14px;background:#fafaf8;border:1px solid #e0ddd8;border-radius:8px;">
                    <div style="font-size:13.5px;font-weight:700;color:#1a1a1a;" id="ccReplaceCurrentName">Citizen_Charter_2026.pdf</div>
                    <div style="font-size:12px;color:#999;margin-top:2px;" id="ccReplaceCurrentMeta">2.4 MB · March 1, 2026</div>
                </div>
            </div>
            <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#999;margin-bottom:8px;">New PDF Document</label>
            <div class="cc-drop-zone" id="ccReplaceDrop">
                <input type="file" id="ccReplaceInput" accept=".pdf" onchange="ccHandleFile(this,'ccReplacePrev')">
                <div class="cc-drop-zone-ico">🔄</div>
                <p><strong>Click to upload</strong> or drag and drop</p>
                <p class="cc-drop-zone-hint">PDF files only, up to 10MB</p>
            </div>
            <div class="cc-file-pill" id="ccReplacePrev" style="display:none;">
                <span class="cc-file-pill-ico">📄</span>
                <div>
                    <div class="cc-file-pill-name" id="ccReplacePrevName">—</div>
                    <div class="cc-file-pill-size" id="ccReplacePrevSize">—</div>
                </div>
            </div>
        </div>
        <div class="cc-modal-foot">
            <button class="cc-btn cc-btn-ghost" onclick="ccCloseModal('ccReplaceModal')">Cancel</button>
            <button class="cc-btn cc-btn-green" id="ccReplaceSubmit" onclick="ccDoReplace()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="1 4 1 10 7 10" />
                    <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
                </svg>
                Replace PDF
            </button>
        </div>
    </div>
</div>

{{-- ── Delete Confirm Modal ── --}}
<div class="cc-modal-backdrop" id="ccDeleteModal">
    <div class="cc-modal" style="max-width:380px;">
        <div class="cc-modal-body" style="text-align:center;padding:32px 28px;">
            <div class="cc-confirm-ico">🗑</div>
            <div style="font-size:17px;font-weight:700;color:#1a1a1a;margin-bottom:8px;">Delete Document?</div>
            <div style="font-size:13px;color:#666;line-height:1.6;">This will permanently delete <strong id="ccDeleteDocName">Citizen_Charter_2026.pdf</strong>. This action cannot be undone.</div>
        </div>
        <div class="cc-modal-foot" style="justify-content:center;">
            <button class="cc-btn cc-btn-ghost" onclick="ccCloseModal('ccDeleteModal')">Cancel</button>
            <button class="cc-btn cc-btn-danger" id="ccDeleteConfirm" onclick="ccDoDelete()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
        // ── State ──
        let ccDoc = {
            name: 'Citizen_Charter_2026.pdf',
            date: 'March 1, 2026',
            size: '2.4 MB',
            active: true
        };
        let ccAutosaveTimer = null;
        let ccLastSaved = '';

        // ── Tabs ──
        window.ccSwitchTab = function(tab, btn) {
            document.querySelectorAll('.cc-tab').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.cc-tab-panel').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('cc-tab-' + tab).classList.add('active');
            if (tab === 'preview') document.getElementById('ccPreview').innerHTML = document.getElementById('ccIntroEditor').innerHTML;
        };

        // ── Editor ──
        window.ccFmt = function(cmd) {
            document.execCommand(cmd, false, null);
            document.getElementById('ccIntroEditor').focus();
            ccUpdateMeta();
            ccScheduleAutosave();
        };
        window.ccFmtBlock = function(val) {
            if (!val) return;
            document.execCommand('formatBlock', false, val);
            document.getElementById('ccIntroEditor').focus();
        };

        function ccUpdateMeta() {
            const txt = document.getElementById('ccIntroEditor').innerText.trim();
            const words = txt ? txt.split(/\s+/).length : 0;
            document.getElementById('ccWordCount').textContent = 'Words: ' + words + ' · Chars: ' + txt.length;
        }

        document.getElementById('ccIntroEditor').addEventListener('input', () => {
            ccUpdateMeta();
            ccScheduleAutosave();
            ccSetAutosave('saving');
        });

        function ccScheduleAutosave() {
            clearTimeout(ccAutosaveTimer);
            ccAutosaveTimer = setTimeout(() => {
                const c = document.getElementById('ccIntroEditor').innerHTML;
                if (c !== ccLastSaved) {
                    ccLastSaved = c;
                    ccSetAutosave('saved');
                    document.getElementById('ccLastEdited').textContent = 'just now';
                }
            }, 1800);
        }

        function ccSetAutosave(state) {
            const dot = document.getElementById('autosaveDot');
            const txt = document.getElementById('autosaveText');
            if (state === 'saving') {
                dot.style.background = '#f59e0b';
                dot.style.boxShadow = '0 0 5px rgba(245,158,11,.6)';
                txt.textContent = 'Saving…';
            } else {
                dot.style.background = '#22c55e';
                dot.style.boxShadow = '0 0 5px rgba(34,197,94,.6)';
                txt.textContent = 'All changes saved';
            }
        }

        window.ccSaveIntro = function() {
            const btn = document.getElementById('ccSaveBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<div class="cc-spinner"></div> Saving…';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                ccLastSaved = document.getElementById('ccIntroEditor').innerHTML;
                ccSetAutosave('saved');
                document.getElementById('ccLastEdited').textContent = 'just now';
                ccShowToast('success', 'Saved!', 'Introduction content has been updated successfully.');
            }, 1200);
        };

        // ── Modals ──
        window.ccOpenModal = function(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        };
        window.ccCloseModal = function(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        };
        document.querySelectorAll('.cc-modal-backdrop').forEach(bd => bd.addEventListener('click', e => {
            if (e.target === bd) ccCloseModal(bd.id);
        }));

        // ── File handling ──
        window.ccHandleFile = function(input, prevId) {
            const file = input.files[0];
            if (!file) return;
            if (!file.name.toLowerCase().endsWith('.pdf')) {
                ccShowToast('error', 'Invalid File', 'Only PDF files are accepted.');
                input.value = '';
                return;
            }
            if (file.size > 10 * 1024 * 1024) {
                ccShowToast('error', 'File Too Large', 'Maximum file size is 10 MB.');
                input.value = '';
                return;
            }
            document.getElementById(prevId + 'Name').textContent = file.name;
            document.getElementById(prevId + 'Size').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            document.getElementById(prevId).style.display = 'flex';
        };

        // Drag & drop
        document.querySelectorAll('.cc-drop-zone').forEach(dz => {
            dz.addEventListener('dragover', e => {
                e.preventDefault();
                dz.classList.add('drag-over');
            });
            dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
            dz.addEventListener('drop', e => {
                e.preventDefault();
                dz.classList.remove('drag-over');
                const file = e.dataTransfer.files[0];
                if (!file) return;
                const inp = dz.querySelector('input[type=file]');
                try {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    inp.files = dt.files;
                    inp.dispatchEvent(new Event('change'));
                } catch (err) {}
            });
        });

        window.ccDoUpload = function() {
            const file = document.getElementById('ccUploadInput').files[0];
            if (!file) {
                ccShowToast('warning', 'No File Selected', 'Please choose a PDF file to upload.');
                return;
            }
            const btn = document.getElementById('ccUploadSubmit');
            btn.innerHTML = '<div class="cc-spinner"></div> Uploading…';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/></svg> Upload PDF';
                btn.disabled = false;
                ccDoc = {
                    name: file.name,
                    date: new Date().toLocaleDateString('en-US', {
                        month: 'long',
                        day: 'numeric',
                        year: 'numeric'
                    }),
                    size: (file.size / 1024 / 1024).toFixed(1) + ' MB',
                    active: true
                };
                ccRefreshDoc();
                ccAddVersion(file.name, ccDoc.size, ccDoc.date);
                ccCloseModal('ccUploadModal');
                ccShowToast('success', 'Uploaded!', 'The new PDF is now the active charter document.');
            }, 2000);
        };

        window.ccDoReplace = function() {
            const file = document.getElementById('ccReplaceInput').files[0];
            if (!file) {
                ccShowToast('warning', 'No File Selected', 'Please choose a replacement PDF file.');
                return;
            }
            const btn = document.getElementById('ccReplaceSubmit');
            btn.innerHTML = '<div class="cc-spinner"></div> Replacing…';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg> Replace PDF';
                btn.disabled = false;
                ccDoc = {
                    name: file.name,
                    date: new Date().toLocaleDateString('en-US', {
                        month: 'long',
                        day: 'numeric',
                        year: 'numeric'
                    }),
                    size: (file.size / 1024 / 1024).toFixed(1) + ' MB',
                    active: true
                };
                ccRefreshDoc();
                ccAddVersion(file.name, ccDoc.size, ccDoc.date);
                ccCloseModal('ccReplaceModal');
                ccShowToast('success', 'Replaced!', 'Charter document has been replaced successfully.');
            }, 1800);
        };

        window.ccDoDelete = function() {
            const btn = document.getElementById('ccDeleteConfirm');
            btn.innerHTML = '<div class="cc-spinner"></div> Deleting…';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = 'Yes, Delete';
                btn.disabled = false;
                ccDoc = {
                    name: 'No document uploaded',
                    date: '—',
                    size: '—',
                    active: false
                };
                ccRefreshDoc();
                ccCloseModal('ccDeleteModal');
                ccShowToast('error', 'Deleted', 'The charter document has been permanently removed.');
            }, 1400);
        };

        window.ccViewDoc = function() {
            if (ccDoc.name === 'No document uploaded') {
                ccShowToast('warning', 'No Document', 'Please upload a PDF document first.');
                return;
            }
            ccShowToast('info', 'Opening PDF', 'Document is opening in a new tab…');
            // window.open('/documents/citizen_charter.pdf','_blank');
        };

        window.ccToggleStatus = function() {
            ccDoc.active = !ccDoc.active;
            ccRefreshDoc();
            ccShowToast(ccDoc.active ? 'success' : 'warning', ccDoc.active ? 'Status: Active' : 'Status: Inactive', ccDoc.active ? 'Document is now publicly visible.' : 'Document is now hidden from public view.');
        };

        function ccRefreshDoc() {
            document.getElementById('ccDocName').textContent = ccDoc.name;
            document.getElementById('ccDocDate').textContent = ccDoc.date;
            document.getElementById('ccDocSize').textContent = ccDoc.size;
            const badge = document.getElementById('ccDocBadge');
            badge.className = ccDoc.active ? 'cc-badge cc-badge-active' : 'cc-badge cc-badge-inactive';
            badge.innerHTML = ccDoc.active ? '<span class="cc-badge-dot"></span>Active' : '<span class="cc-badge-dot"></span>Inactive';
        }

        function ccAddVersion(name, size, date) {
            const vh = document.getElementById('ccVersionHistory');
            const count = vh.querySelectorAll('.cc-version-tag').length;
            vh.querySelectorAll('.cc-badge-active').forEach(b => {
                b.className = 'cc-badge cc-badge-inactive';
                b.innerHTML = '<span class="cc-badge-dot"></span>Archived';
            });
            const row = document.createElement('div');
            row.className = 'cc-version-row';
            row.style.animation = 'slideUp .3s ease';
            row.innerHTML = `<div style="display:flex;align-items:center;"><span class="cc-version-tag">v${count+1}</span><div><div class="cc-version-name">${name}</div><div class="cc-version-meta">${date} · ${size} · Uploaded by Admin</div></div></div><div class="cc-version-right"><span class="cc-badge cc-badge-active"><span class="cc-badge-dot"></span>Active</span></div>`;
            vh.insertBefore(row, vh.firstChild);
        }

        // ── Toast ──
        const toastIcons = {
            success: `<svg class="cc-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>`,
            error: `<svg class="cc-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
            warning: `<svg class="cc-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>`,
            info: `<svg class="cc-toast-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`
        };
        window.ccShowToast = function(type, title, msg) {
            const stack = document.getElementById('cc-toasts');
            const el = document.createElement('div');
            el.className = 'cc-toast ' + type;
            el.innerHTML = `${toastIcons[type]||toastIcons.info}<div class="cc-toast-content"><div class="cc-toast-title">${title}</div>${msg?`<div class="cc-toast-msg">${msg}</div>`:''}</div><button class="cc-toast-x" onclick="ccDismissToast(this.parentElement)">×</button><div class="cc-toast-bar"></div>`;
            stack.appendChild(el);
            setTimeout(() => ccDismissToast(el), 3300);
        };
        window.ccDismissToast = function(el) {
            if (!el || !el.parentElement) return;
            el.classList.add('out');
            setTimeout(() => el.remove(), 260);
        };

        // ── Init ──
        document.addEventListener('DOMContentLoaded', () => {
            ccUpdateMeta();
            ccLastSaved = document.getElementById('ccIntroEditor').innerHTML;
            document.getElementById('ccDeleteDocName').textContent = ccDoc.name;
        });

        // Sync delete modal doc name on open
        const origOpen = window.ccOpenModal;
        window.ccOpenModal = function(id) {
            if (id === 'ccDeleteModal') document.getElementById('ccDeleteDocName').textContent = ccDoc.name;
            if (id === 'ccReplaceModal') {
                document.getElementById('ccReplaceCurrentName').textContent = ccDoc.name;
                document.getElementById('ccReplaceCurrentMeta').textContent = ccDoc.size + ' · ' + ccDoc.date;
            }
            origOpen(id);
        };
    })();
</script>

@endsection