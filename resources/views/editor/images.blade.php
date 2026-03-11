@extends('editor.layout')

@section('title', 'Image Gallery')

@section('content')

<style>
    :root {
        --red: #C0202F;
        --red-dark: #8C111E;
        --red-pale: #FEF0F1;
        --red-pale2: #FDE8EA;
        --red-border: #F3CACE;
        --text-primary: #1A0508;
        --text-secondary: #7A4A50;
        --text-muted: #B08888;
        --surface: #FFFFFF;
        --bg: #F6F1F2;
        --border: #EDE0E1;
    }

    * {
        box-sizing: border-box;
    }

    .page-wrap {
        font-family: 'DM Sans', sans-serif;
        color: var(--text-primary);
    }

    /* ── Page Header ── */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .page-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .page-sub {
        font-size: 13px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--red);
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 9px;
        border: none;
        cursor: pointer;
        transition: background .15s, transform .1s;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-primary:hover {
        background: var(--red-dark);
        transform: translateY(-1px);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-primary svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    /* ── Stats Row ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    @media (max-width: 900px) {
        .stats-row {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 560px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 11px;
        cursor: pointer;
        transition: border-color .15s, box-shadow .15s, background .15s;
    }

    .stat-card:hover {
        border-color: var(--red);
        box-shadow: 0 4px 14px rgba(192, 32, 47, .1);
    }

    .stat-card.active-filter {
        border-color: var(--red);
        background: var(--red-pale);
        box-shadow: 0 4px 14px rgba(192, 32, 47, .12);
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 17px;
        height: 17px;
    }

    .stat-val {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
    }

    .stat-lbl {
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 2px;
        font-weight: 500;
    }

    /* ── Filter / Toolbar ── */
    .toolbar {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 13px;
        padding: 16px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .search-wrap {
        position: relative;
        flex: 1;
        min-width: 180px;
    }

    .search-wrap svg {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: var(--text-muted);
        pointer-events: none;
    }

    .search-wrap input {
        width: 100%;
        padding: 9px 32px 9px 32px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-primary);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .search-wrap input:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, .08);
    }

    .search-clear {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--text-muted);
        padding: 2px;
        display: none;
    }

    .search-clear:hover {
        color: var(--red);
    }

    .sel-wrap {
        position: relative;
    }

    .sel-wrap select {
        padding: 9px 30px 9px 12px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-primary);
        background: #fff;
        outline: none;
        appearance: none;
        cursor: pointer;
        transition: border-color .15s, box-shadow .15s;
    }

    .sel-wrap select:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, .08);
    }

    .sel-wrap svg {
        position: absolute;
        right: 9px;
        top: 50%;
        transform: translateY(-50%);
        width: 13px;
        height: 13px;
        color: var(--text-muted);
        pointer-events: none;
    }

    .view-toggle {
        display: flex;
        align-items: center;
        gap: 3px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        padding: 3px;
        background: var(--bg);
    }

    .view-btn {
        width: 30px;
        height: 30px;
        border: none;
        background: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--text-muted);
        transition: all .12s;
    }

    .view-btn:hover {
        color: var(--red);
    }

    .view-btn.active {
        background: #fff;
        color: var(--red);
        box-shadow: 0 1px 4px rgba(0, 0, 0, .1);
    }

    .view-btn svg {
        width: 15px;
        height: 15px;
    }

    .result-label {
        font-size: 12.5px;
        color: var(--text-muted);
        font-weight: 500;
        white-space: nowrap;
    }

    /* ── Gallery Grid ── */
    .gallery-section {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 13px;
        overflow: hidden;
        position: relative;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1px;
        background: var(--red-border);
    }

    .gallery-grid.list-view {
        grid-template-columns: 1fr;
        background: transparent;
        gap: 0;
    }

    /* ── Image Card ── */
    .img-card {
        background: var(--surface);
        position: relative;
        cursor: pointer;
        overflow: hidden;
        transition: transform .2s;
    }

    .img-card:hover {
        z-index: 2;
        transform: scale(1.02);
        box-shadow: 0 8px 30px rgba(192, 32, 47, .15);
    }

    .img-thumb-wrap {
        position: relative;
        padding-bottom: 66%;
        overflow: hidden;
        background: var(--bg);
    }

    .img-thumb {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .3s;
    }

    .img-card:hover .img-thumb {
        transform: scale(1.06);
    }

    /* Category badge on image */
    .img-cat-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        padding: 3px 9px;
        border-radius: 20px;
        font-size: 10.5px;
        font-weight: 700;
        backdrop-filter: blur(6px);
        z-index: 2;
    }

    /* Hover overlay */
    .img-overlay {
        position: absolute;
        inset: 0;
        background: rgba(26, 5, 8, .5);
        opacity: 0;
        transition: opacity .2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        z-index: 3;
    }

    .img-card:hover .img-overlay {
        opacity: 1;
    }

    .ov-btn {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, .92);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--text-primary);
        transition: background .12s, color .12s;
        z-index: 4;
    }

    .ov-btn:hover {
        background: #fff;
        color: var(--red);
    }

    .ov-btn svg {
        width: 16px;
        height: 16px;
    }

    /* Card footer */
    .img-card-body {
        padding: 10px 12px;
        border-top: 1px solid var(--bg);
    }

    .img-filename {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 2px;
    }

    .img-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .img-date {
        font-size: 11px;
        color: var(--text-muted);
    }

    .img-size {
        font-size: 11px;
        color: var(--text-muted);
    }

    .img-card-actions {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 8px;
    }

    .ico-btn {
        width: 28px;
        height: 28px;
        border: none;
        border-radius: 7px;
        background: var(--bg);
        color: var(--text-muted);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .12s, color .12s;
        flex-shrink: 0;
    }

    .ico-btn:hover {
        background: var(--red-pale);
        color: var(--red);
    }

    .ico-btn.danger:hover {
        background: var(--red-pale2);
        color: var(--red);
    }

    .ico-btn svg {
        width: 13px;
        height: 13px;
    }

    /* ── List View ── */
    .gallery-grid.list-view .img-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        border-bottom: 1px solid var(--bg);
        transform: none !important;
        box-shadow: none !important;
    }

    .gallery-grid.list-view .img-card:hover {
        background: var(--red-pale);
    }

    .gallery-grid.list-view .img-thumb-wrap {
        width: 80px;
        height: 54px;
        flex-shrink: 0;
        padding-bottom: 0;
        border-radius: 8px;
        overflow: hidden;
    }

    .gallery-grid.list-view .img-thumb {
        position: static;
        width: 80px;
        height: 54px;
        border-radius: 8px;
    }

    .gallery-grid.list-view .img-overlay {
        border-radius: 8px;
    }

    .gallery-grid.list-view .img-cat-badge {
        display: none;
    }

    .gallery-grid.list-view .img-card-body {
        flex: 1;
        padding: 0;
        border: none;
    }

    .gallery-grid.list-view .img-filename {
        margin-bottom: 3px;
    }

    .gallery-grid.list-view .img-card-actions {
        margin-top: 0;
    }

    .list-cat-badge {
        display: none;
        padding: 2px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .gallery-grid.list-view .list-cat-badge {
        display: inline-flex;
    }

    /* ── Skeleton ── */
    .skeleton-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1px;
        background: var(--red-border);
    }

    .skeleton-card {
        background: var(--surface);
    }

    .skeleton-img {
        padding-bottom: 66%;
        background: linear-gradient(90deg, #f0e8e9 25%, #fde8ea 50%, #f0e8e9 75%);
        background-size: 200%;
        animation: shimmer 1.4s infinite;
    }

    .skeleton-body {
        padding: 10px 12px;
    }

    .skeleton-line {
        height: 10px;
        border-radius: 5px;
        background: linear-gradient(90deg, #f0e8e9 25%, #fde8ea 50%, #f0e8e9 75%);
        background-size: 200%;
        animation: shimmer 1.4s infinite;
        margin-bottom: 6px;
    }

    .skeleton-line.short {
        width: 60%;
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    /* ── Empty State ── */
    .empty-state {
        padding: 70px 20px;
        text-align: center;
    }

    .empty-state svg {
        width: 52px;
        height: 52px;
        color: var(--red-border);
        margin: 0 auto 14px;
        display: block;
    }

    .empty-state h3 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
    }

    .empty-state p {
        font-size: 13px;
        color: var(--text-muted);
    }

    /* ── Pagination ── */
    .pagination-bar {
        padding: 14px 20px;
        border-top: 1px solid var(--red-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .page-info {
        font-size: 12.5px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .page-info strong {
        color: var(--text-primary);
    }

    .page-btns {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .page-btn {
        min-width: 32px;
        height: 32px;
        border-radius: 7px;
        border: 1.5px solid var(--border);
        background: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-secondary);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 8px;
        transition: all .12s;
    }

    .page-btn:hover {
        background: var(--red-pale);
        color: var(--red);
        border-color: var(--red-border);
    }

    .page-btn.active {
        background: var(--red);
        color: #fff;
        border-color: var(--red);
    }

    .page-btn:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    .page-btn svg {
        width: 13px;
        height: 13px;
    }

    /* ════════════════════
     MODAL SYSTEM
  ════════════════════ */
    .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(20, 0, 5, .55);
        backdrop-filter: blur(4px);
        z-index: 300;
        display: none;
        align-items: flex-start;
        justify-content: center;
        padding: 24px 16px;
        overflow-y: auto;
    }

    .modal-backdrop.open {
        display: flex;
    }

    .modal {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 24px 60px rgba(192, 32, 47, .18);
        width: 100%;
        max-width: 560px;
        margin: auto;
        animation: modalIn .2s cubic-bezier(.34, 1.56, .64, 1);
        overflow: hidden;
    }

    .modal.modal-lg {
        max-width: 780px;
    }

    .modal.modal-sm {
        max-width: 420px;
    }

    .modal.modal-full {
        max-width: 960px;
    }

    @keyframes modalIn {
        from {
            opacity: 0;
            transform: scale(.94) translateY(20px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .modal-header {
        padding: 20px 24px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .modal-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .modal-close {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        background: var(--bg);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        transition: background .12s, color .12s;
        flex-shrink: 0;
    }

    .modal-close:hover {
        background: var(--red-pale);
        color: var(--red);
    }

    .modal-close svg {
        width: 15px;
        height: 15px;
    }

    .modal-body {
        padding: 20px 24px;
        overflow-y: auto;
        max-height: 72vh;
    }

    .modal-sep {
        height: 1px;
        background: var(--red-border);
        margin: 0 24px 16px;
    }

    .modal-footer {
        padding: 0 24px 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Form */
    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .09em;
        color: var(--text-muted);
        margin-bottom: 7px;
    }

    .form-label span {
        color: var(--red);
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 10px 13px;
        border: 1.5px solid var(--border);
        border-radius: 9px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-primary);
        background: #fff;
        outline: none;
        appearance: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, .09);
    }

    .form-sel-wrap {
        position: relative;
    }

    .form-sel-wrap svg {
        position: absolute;
        right: 11px;
        top: 50%;
        transform: translateY(-50%);
        width: 13px;
        height: 13px;
        color: var(--text-muted);
        pointer-events: none;
    }

    /* Upload zone */
    .upload-zone {
        border: 2px dashed var(--red-border);
        border-radius: 10px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color .15s, background .15s;
        position: relative;
    }

    .upload-zone:hover,
    .upload-zone.drag-over {
        border-color: var(--red);
        background: var(--red-pale);
    }

    .upload-zone input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-zone svg {
        width: 34px;
        height: 34px;
        color: var(--red-border);
        margin: 0 auto 10px;
        display: block;
    }

    .upload-zone p {
        font-size: 13px;
        color: var(--text-muted);
    }

    .upload-zone p strong {
        color: var(--red);
    }

    .upload-zone p.hint {
        font-size: 11px;
        margin-top: 4px;
    }

    /* Preview strip */
    .upload-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 14px;
    }

    .upload-preview-item {
        position: relative;
        width: 80px;
        height: 62px;
    }

    .upload-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border);
    }

    .upload-preview-item .remove-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 18px;
        height: 18px;
        background: var(--red);
        color: #fff;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
    }

    .upload-preview-item .remove-btn svg {
        width: 9px;
        height: 9px;
    }

    /* Progress bar */
    .progress-bar-wrap {
        margin-top: 16px;
        display: none;
    }

    .progress-bar-wrap.show {
        display: block;
    }

    .progress-label {
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 6px;
        font-weight: 500;
        display: flex;
        justify-content: space-between;
    }

    .progress-track {
        height: 6px;
        background: var(--bg);
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--red-dark), var(--red));
        border-radius: 10px;
        transition: width .3s;
        width: 0%;
    }

    /* Image preview modal */
    .preview-img-full {
        width: 100%;
        max-height: 500px;
        object-fit: contain;
        border-radius: 10px;
        background: #0a0205;
        display: block;
    }

    .preview-info-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid var(--red-border);
    }

    .preview-info-item {
        flex: 1;
        min-width: 120px;
    }

    .preview-info-label {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--text-muted);
    }

    .preview-info-val {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-primary);
        margin-top: 2px;
    }

    /* Confirm modal */
    .confirm-body {
        text-align: center;
        padding: 20px 24px 0;
    }

    .confirm-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        background: var(--red-pale2);
        color: var(--red);
    }

    .confirm-icon svg {
        width: 24px;
        height: 24px;
    }

    .confirm-body h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .confirm-body p {
        font-size: 13.5px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    /* Btns */
    .btn-secondary {
        padding: 10px 18px;
        border-radius: 9px;
        border: 1.5px solid var(--border);
        background: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all .12s;
    }

    .btn-secondary:hover {
        border-color: var(--red);
        color: var(--red);
        background: var(--red-pale);
    }

    .btn-danger {
        padding: 10px 18px;
        border-radius: 9px;
        border: none;
        background: var(--red);
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
        transition: background .12s;
    }

    .btn-danger:hover {
        background: var(--red-dark);
    }

    .btn-spinner {
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255, 255, 255, .4);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin .6s linear infinite;
        flex-shrink: 0;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Loading overlay */
    .loading-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, .75);
        backdrop-filter: blur(2px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 13px;
    }

    .loading-overlay.show {
        display: flex;
    }

    .spinner {
        width: 36px;
        height: 36px;
        border: 3px solid var(--red-border);
        border-top-color: var(--red);
        border-radius: 50%;
        animation: spin .7s linear infinite;
    }

    /* ── TOAST ── */
    #toastContainer {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    }

    .toast {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 13px 16px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 8px 30px rgba(20, 0, 5, .15);
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        color: var(--text-primary);
        min-width: 240px;
        max-width: 340px;
        pointer-events: auto;
        animation: toastIn .25s cubic-bezier(.34, 1.56, .64, 1);
        border-left: 4px solid var(--red);
    }

    .toast.success {
        border-left-color: #22c55e;
    }

    .toast.info {
        border-left-color: #3B82F6;
    }

    .toast.warning {
        border-left-color: #EAB308;
    }

    .toast-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .toast.success .toast-icon {
        color: #22c55e;
    }

    .toast.info .toast-icon {
        color: #3B82F6;
    }

    .toast.error .toast-icon {
        color: var(--red);
    }

    .toast.warning .toast-icon {
        color: #EAB308;
    }

    .toast-msg strong {
        display: block;
        font-weight: 700;
        margin-bottom: 1px;
    }

    .toast-msg span {
        font-size: 12px;
        color: var(--text-muted);
    }

    .toast-out {
        animation: toastOut .22s ease forwards;
    }

    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateX(40px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes toastOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(40px);
        }
    }

    /* Category colors */
    .cat-carousel {
        background: #EFF6FF;
        color: #1E40AF;
    }

    .cat-news {
        background: #F0FDF4;
        color: #166534;
    }

    .cat-services {
        background: #F5F3FF;
        color: #5B21B6;
    }

    .cat-orgchart {
        background: #FFF9C4;
        color: #854D0E;
    }

    .cat-announcements {
        background: var(--red-pale);
        color: var(--red);
    }

    .cat-documents {
        background: #F0F9FF;
        color: #075985;
    }

    .cat-general {
        background: #F3F4F6;
        color: #374151;
    }
</style>

<div class="page-wrap">

    <!-- ── PAGE HEADER ── -->
    <div class="page-header">
        <div>
            <div class="page-title">Image Gallery</div>
            <div class="page-sub">Central media library for all uploaded images across every module</div>
        </div>
        <button class="btn-primary" onclick="openUploadModal()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            Upload Images
        </button>
    </div>

    <!-- ── STATS / CATEGORY FILTER ── -->
    <div class="stats-row">
        <div class="stat-card active-filter" id="cat_all" onclick="filterByCategory('all','cat_all')">
            <div class="stat-icon" style="background:var(--red-pale)">
                <svg fill="none" stroke="var(--red)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="cnt_all">24</div>
                <div class="stat-lbl">All Images</div>
            </div>
        </div>
        <div class="stat-card" id="cat_carousel" onclick="filterByCategory('carousel','cat_carousel')">
            <div class="stat-icon" style="background:#EFF6FF">
                <svg fill="none" stroke="#1E40AF" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="cnt_carousel">6</div>
                <div class="stat-lbl">Carousel</div>
            </div>
        </div>
        <div class="stat-card" id="cat_news" onclick="filterByCategory('news','cat_news')">
            <div class="stat-icon" style="background:#F0FDF4">
                <svg fill="none" stroke="#166534" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="cnt_news">7</div>
                <div class="stat-lbl">News</div>
            </div>
        </div>
        <div class="stat-card" id="cat_announcements" onclick="filterByCategory('announcements','cat_announcements')">
            <div class="stat-icon" style="background:var(--red-pale)">
                <svg fill="none" stroke="var(--red)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="cnt_announcements">4</div>
                <div class="stat-lbl">Announcements</div>
            </div>
        </div>
        <div class="stat-card" id="cat_services" onclick="filterByCategory('services','cat_services')">
            <div class="stat-icon" style="background:#F5F3FF">
                <svg fill="none" stroke="#5B21B6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="cnt_services">4</div>
                <div class="stat-lbl">Services</div>
            </div>
        </div>
    </div>

    <!-- ── TOOLBAR ── -->
    <div class="toolbar">
        <div class="search-wrap">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" id="searchInput" placeholder="Search by filename or module…" oninput="triggerSearch()">
            <button class="search-clear" id="searchClear" onclick="clearSearch()">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="sel-wrap">
            <select id="sortSelect" onchange="applyFilter()">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="name_asc">Name A–Z</option>
                <option value="name_desc">Name Z–A</option>
                <option value="size_desc">Largest First</option>
            </select>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        <div class="view-toggle">
            <button class="view-btn active" id="viewGrid" onclick="setView('grid')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </button>
            <button class="view-btn" id="viewList" onclick="setView('list')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
            </button>
        </div>
        <div class="result-label" id="resultLabel">24 images</div>
    </div>

    <!-- ── GALLERY CARD ── -->
    <div class="gallery-section">
        <div class="loading-overlay" id="galleryLoader">
            <div class="spinner"></div>
        </div>

        <!-- Skeleton (shown initially) -->
        <div class="skeleton-grid" id="skeletonGrid">
            ${Array(12).fill(0).map(()=>`<div class="skeleton-card">
                <div class="skeleton-img"></div>
                <div class="skeleton-body">
                    <div class="skeleton-line"></div>
                    <div class="skeleton-line short"></div>
                </div>
            </div>`).join('')}
        </div>

        <div class="gallery-grid" id="galleryGrid" style="display:none"></div>

        <div class="empty-state" id="emptyState" style="display:none">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h3>No images found</h3>
            <p>Try adjusting your search or filter, or upload a new image.</p>
        </div>

        <div class="pagination-bar">
            <div class="page-info" id="pageInfo">Showing <strong>1</strong>–<strong>12</strong> of <strong>24</strong></div>
            <div class="page-btns" id="pageBtns"></div>
        </div>
    </div>

</div>

<!-- ═══════════════════════════
     UPLOAD MODAL
═══════════════════════════ -->
<div class="modal-backdrop" id="uploadModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <div class="modal-title">Upload Images</div>
            <button class="modal-close" onclick="closeModal('uploadModal')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <!-- Drop zone -->
            <div class="upload-zone" id="dropZone" ondragover="handleDragOver(event)" ondragleave="handleDragLeave()" ondrop="handleDrop(event)">
                <input type="file" id="uploadFileInput" accept="image/*" multiple onchange="handleFilePick(event)">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p><strong>Click to browse</strong> or drag & drop images here</p>
                <p class="hint">PNG, JPG, WEBP, GIF — up to 5MB each · Multiple files allowed</p>
            </div>

            <!-- Preview items -->
            <div class="upload-previews" id="uploadPreviews"></div>

            <!-- Progress -->
            <div class="progress-bar-wrap" id="progressWrap">
                <div class="progress-label"><span id="progressLabel">Uploading…</span><span id="progressPct">0%</span></div>
                <div class="progress-track">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
            </div>

            <!-- Module & alt text -->
            <div style="margin-top:18px">
                <div class="form-group">
                    <label class="form-label">Module / Usage <span>*</span></label>
                    <div class="form-sel-wrap">
                        <select id="uploadModule" class="form-select">
                            <option value="carousel">Carousel</option>
                            <option value="news">News & Accomplishments</option>
                            <option value="announcements">Announcements</option>
                            <option value="services">Services</option>
                            <option value="orgchart">Organizational Chart</option>
                            <option value="documents">Documents</option>
                            <option value="general">General / Uncategorized</option>
                        </select>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Alt Text (Accessibility)</label>
                    <input type="text" id="uploadAlt" class="form-input" placeholder="Describe the image for accessibility…">
                </div>
            </div>
        </div>
        <div class="modal-sep"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeModal('uploadModal')">Cancel</button>
            <button class="btn-primary" id="uploadBtn" onclick="doUpload()">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;margin-right:5px;vertical-align:-2px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                Upload
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════
     IMAGE PREVIEW MODAL
═══════════════════════════ -->
<div class="modal-backdrop" id="previewModal">
    <div class="modal modal-full">
        <div class="modal-header">
            <div class="modal-title" id="prevModalTitle">Image Preview</div>
            <button class="modal-close" onclick="closeModal('previewModal')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <img id="prevImgFull" src="" alt="" class="preview-img-full">
            <div class="preview-info-row">
                <div class="preview-info-item">
                    <div class="preview-info-label">Filename</div>
                    <div class="preview-info-val" id="prevFilename">—</div>
                </div>
                <div class="preview-info-item">
                    <div class="preview-info-label">Module</div>
                    <div class="preview-info-val" id="prevModule">—</div>
                </div>
                <div class="preview-info-item">
                    <div class="preview-info-label">Size</div>
                    <div class="preview-info-val" id="prevSize">—</div>
                </div>
                <div class="preview-info-item">
                    <div class="preview-info-label">Uploaded</div>
                    <div class="preview-info-val" id="prevDate">—</div>
                </div>
                <div class="preview-info-item">
                    <div class="preview-info-label">Dimensions</div>
                    <div class="preview-info-val" id="prevDimensions">—</div>
                </div>
            </div>
        </div>
        <div class="modal-sep"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeModal('previewModal')">Close</button>
            <button class="btn-secondary" id="prevCopyBtn" onclick="">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;margin-right:5px;vertical-align:-2px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                Copy URL
            </button>
            <button class="btn-primary" id="prevEditBtn" onclick="">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;margin-right:5px;vertical-align:-2px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════
     EDIT USAGE MODAL
═══════════════════════════ -->
<div class="modal-backdrop" id="editModal">
    <div class="modal modal-sm">
        <div class="modal-header">
            <div class="modal-title">Edit Image Details</div>
            <button class="modal-close" onclick="closeModal('editModal')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="editId">
            <div class="form-group">
                <label class="form-label">Filename</label>
                <input type="text" id="editFilename" class="form-input" placeholder="filename.jpg">
            </div>
            <div class="form-group">
                <label class="form-label">Module / Usage <span>*</span></label>
                <div class="form-sel-wrap">
                    <select id="editModule" class="form-select">
                        <option value="carousel">Carousel</option>
                        <option value="news">News & Accomplishments</option>
                        <option value="announcements">Announcements</option>
                        <option value="services">Services</option>
                        <option value="orgchart">Organizational Chart</option>
                        <option value="documents">Documents</option>
                        <option value="general">General / Uncategorized</option>
                    </select>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Alt Text</label>
                <input type="text" id="editAlt" class="form-input" placeholder="Describe the image…">
            </div>
        </div>
        <div class="modal-sep"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeModal('editModal')">Cancel</button>
            <button class="btn-primary" onclick="saveEdit()">Save Changes</button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════
     CONFIRM DELETE MODAL
═══════════════════════════ -->
<div class="modal-backdrop" id="confirmModal">
    <div class="modal modal-sm">
        <div class="confirm-body">
            <div class="confirm-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <h3>Delete Image?</h3>
            <p id="confirmText">This image will be permanently removed from the gallery and any modules using it. This cannot be undone.</p>
        </div>
        <div class="modal-sep" style="margin-top:18px"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeModal('confirmModal')">Cancel</button>
            <button class="btn-danger" id="confirmDeleteBtn">Delete Image</button>
        </div>
    </div>
</div>

<!-- Toast container -->
<div id="toastContainer"></div>

<script>
    // ═══════════════════════════════
    // DATA
    // ═══════════════════════════════
    const MODULE_LABELS = {
        carousel: 'Carousel',
        news: 'News',
        announcements: 'Announcements',
        services: 'Services',
        orgchart: 'Org Chart',
        documents: 'Documents',
        general: 'General'
    };

    let images = [{
            id: 1,
            filename: 'carousel_hero_01.jpg',
            module: 'carousel',
            alt: 'PUDHO main carousel banner 1',
            size: '1.2 MB',
            dimensions: '1920×600',
            date: 'Mar 1, 2026',
            src: 'https://picsum.photos/seed/img1/600/400'
        },
        {
            id: 2,
            filename: 'news_announcement_01.jpg',
            module: 'news',
            alt: 'PUDHO news header image',
            size: '820 KB',
            dimensions: '1200×630',
            date: 'Feb 28, 2026',
            src: 'https://picsum.photos/seed/img2/600/400'
        },
        {
            id: 3,
            filename: 'service_healthcare_01.jpg',
            module: 'services',
            alt: 'Healthcare service image',
            size: '650 KB',
            dimensions: '800×600',
            date: 'Feb 25, 2026',
            src: 'https://picsum.photos/seed/img3/600/400'
        },
        {
            id: 4,
            filename: 'org_chart_director_01.jpg',
            module: 'orgchart',
            alt: 'Director photo',
            size: '430 KB',
            dimensions: '400×400',
            date: 'Feb 20, 2026',
            src: 'https://picsum.photos/seed/img4/600/400'
        },
        {
            id: 5,
            filename: 'carousel_hero_02.jpg',
            module: 'carousel',
            alt: 'PUDHO main carousel banner 2',
            size: '1.1 MB',
            dimensions: '1920×600',
            date: 'Feb 15, 2026',
            src: 'https://picsum.photos/seed/img5/600/400'
        },
        {
            id: 6,
            filename: 'news_event_01.jpg',
            module: 'news',
            alt: 'Community event coverage',
            size: '710 KB',
            dimensions: '1200×630',
            date: 'Feb 10, 2026',
            src: 'https://picsum.photos/seed/img6/600/400'
        },
        {
            id: 7,
            filename: 'service_education_01.jpg',
            module: 'services',
            alt: 'Education program banner',
            size: '590 KB',
            dimensions: '800×600',
            date: 'Feb 5, 2026',
            src: 'https://picsum.photos/seed/img7/600/400'
        },
        {
            id: 8,
            filename: 'org_chart_manager_01.jpg',
            module: 'orgchart',
            alt: 'Manager photo',
            size: '390 KB',
            dimensions: '400×400',
            date: 'Feb 1, 2026',
            src: 'https://picsum.photos/seed/img8/600/400'
        },
        {
            id: 9,
            filename: 'announcement_banner_01.jpg',
            module: 'announcements',
            alt: 'Important announcement visual',
            size: '540 KB',
            dimensions: '1200×400',
            date: 'Jan 28, 2026',
            src: 'https://picsum.photos/seed/img9/600/400'
        },
        {
            id: 10,
            filename: 'carousel_event_03.jpg',
            module: 'carousel',
            alt: 'PUDHO carousel event photo',
            size: '980 KB',
            dimensions: '1920×600',
            date: 'Jan 25, 2026',
            src: 'https://picsum.photos/seed/img10/600/400'
        },
        {
            id: 11,
            filename: 'news_housing_02.jpg',
            module: 'news',
            alt: 'Housing project photo',
            size: '870 KB',
            dimensions: '1200×630',
            date: 'Jan 20, 2026',
            src: 'https://picsum.photos/seed/img11/600/400'
        },
        {
            id: 12,
            filename: 'service_livelihood_01.jpg',
            module: 'services',
            alt: 'Livelihood program photo',
            size: '620 KB',
            dimensions: '800×600',
            date: 'Jan 15, 2026',
            src: 'https://picsum.photos/seed/img12/600/400'
        },
        {
            id: 13,
            filename: 'announcement_event_02.jpg',
            module: 'announcements',
            alt: 'Seminar announcement image',
            size: '490 KB',
            dimensions: '1200×400',
            date: 'Jan 10, 2026',
            src: 'https://picsum.photos/seed/img13/600/400'
        },
        {
            id: 14,
            filename: 'news_report_q1.jpg',
            module: 'news',
            alt: 'Q1 report cover photo',
            size: '750 KB',
            dimensions: '1200×630',
            date: 'Jan 5, 2026',
            src: 'https://picsum.photos/seed/img14/600/400'
        },
        {
            id: 15,
            filename: 'carousel_awards_04.jpg',
            module: 'carousel',
            alt: 'PUDHO awards night banner',
            size: '1.0 MB',
            dimensions: '1920×600',
            date: 'Dec 30, 2025',
            src: 'https://picsum.photos/seed/img15/600/400'
        },
        {
            id: 16,
            filename: 'org_chart_staff_03.jpg',
            module: 'orgchart',
            alt: 'Staff member photo',
            size: '360 KB',
            dimensions: '400×400',
            date: 'Dec 20, 2025',
            src: 'https://picsum.photos/seed/img16/600/400'
        },
        {
            id: 17,
            filename: 'announcement_closure.jpg',
            module: 'announcements',
            alt: 'Office closure notice banner',
            size: '470 KB',
            dimensions: '1200×400',
            date: 'Dec 15, 2025',
            src: 'https://picsum.photos/seed/img17/600/400'
        },
        {
            id: 18,
            filename: 'news_accomplishment_03.jpg',
            module: 'news',
            alt: 'Year-end accomplishment photo',
            size: '890 KB',
            dimensions: '1200×630',
            date: 'Dec 10, 2025',
            src: 'https://picsum.photos/seed/img18/600/400'
        },
        {
            id: 19,
            filename: 'service_housing_03.jpg',
            module: 'services',
            alt: 'Housing assistance program',
            size: '680 KB',
            dimensions: '800×600',
            date: 'Dec 5, 2025',
            src: 'https://picsum.photos/seed/img19/600/400'
        },
        {
            id: 20,
            filename: 'carousel_outreach_05.jpg',
            module: 'carousel',
            alt: 'Community outreach carousel',
            size: '940 KB',
            dimensions: '1920×600',
            date: 'Dec 1, 2025',
            src: 'https://picsum.photos/seed/img20/600/400'
        },
        {
            id: 21,
            filename: 'general_logo_use.png',
            module: 'general',
            alt: 'PUDHO official logo',
            size: '140 KB',
            dimensions: '512×512',
            date: 'Nov 20, 2025',
            src: 'https://picsum.photos/seed/img21/600/400'
        },
        {
            id: 22,
            filename: 'services_permit_04.jpg',
            module: 'services',
            alt: 'Building permit service',
            size: '600 KB',
            dimensions: '800×600',
            date: 'Nov 15, 2025',
            src: 'https://picsum.photos/seed/img22/600/400'
        },
        {
            id: 23,
            filename: 'carousel_hero_06.jpg',
            module: 'carousel',
            alt: 'PUDHO banner November',
            size: '1.15 MB',
            dimensions: '1920×600',
            date: 'Nov 10, 2025',
            src: 'https://picsum.photos/seed/img23/600/400'
        },
        {
            id: 24,
            filename: 'news_event_06.jpg',
            module: 'news',
            alt: 'Barangay housing event photo',
            size: '830 KB',
            dimensions: '1200×630',
            date: 'Nov 5, 2025',
            src: 'https://picsum.photos/seed/img24/600/400'
        },
    ];

    let filtered = [...images];
    let currentCat = 'all';
    let currentView = 'grid';
    let currentPage = 1;
    const perPage = 12;
    let searchTimer = null;
    let pendingFiles = [];
    let deleteTargetId = null;

    // ═══════════════════════════════
    // INIT
    // ═══════════════════════════════
    window.addEventListener('DOMContentLoaded', () => {
        // Simulate initial load
        setTimeout(() => {
            document.getElementById('skeletonGrid').style.display = 'none';
            document.getElementById('galleryGrid').style.display = '';
            updateCounts();
            applyFilter();
        }, 800);
    });

    // ═══════════════════════════════
    // COUNTS
    // ═══════════════════════════════
    function updateCounts() {
        const cats = ['carousel', 'news', 'announcements', 'services', 'orgchart', 'documents', 'general'];
        document.getElementById('cnt_all').textContent = images.length;
        cats.forEach(c => {
            const el = document.getElementById('cnt_' + c);
            if (el) el.textContent = images.filter(i => i.module === c).length;
        });
    }

    // ═══════════════════════════════
    // FILTER / SEARCH
    // ═══════════════════════════════
    function filterByCategory(cat, cardId) {
        currentCat = cat;
        currentPage = 1;
        document.querySelectorAll('.stat-card').forEach(c => c.classList.remove('active-filter'));
        document.getElementById(cardId).classList.add('active-filter');
        applyFilter();
    }

    function triggerSearch() {
        const val = document.getElementById('searchInput').value;
        document.getElementById('searchClear').style.display = val ? 'block' : 'none';
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            currentPage = 1;
            applyFilter();
        }, 300);
    }

    function clearSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchClear').style.display = 'none';
        currentPage = 1;
        applyFilter();
    }

    function applyFilter() {
        const q = document.getElementById('searchInput').value.toLowerCase().trim();
        const sort = document.getElementById('sortSelect').value;

        showLoader();

        setTimeout(() => {
            let res = images.filter(img => {
                const matchCat = currentCat === 'all' || img.module === currentCat;
                const matchQ = !q || img.filename.toLowerCase().includes(q) || img.module.toLowerCase().includes(q) || img.alt.toLowerCase().includes(q);
                return matchCat && matchQ;
            });

            // Sort
            res.sort((a, b) => {
                if (sort === 'newest') return b.id - a.id;
                if (sort === 'oldest') return a.id - b.id;
                if (sort === 'name_asc') return a.filename.localeCompare(b.filename);
                if (sort === 'name_desc') return b.filename.localeCompare(a.filename);
                return 0;
            });

            filtered = res;
            hideLoader();
            renderGallery();
        }, 350);
    }

    // ═══════════════════════════════
    // RENDER
    // ═══════════════════════════════
    function renderGallery() {
        const grid = document.getElementById('galleryGrid');
        const empty = document.getElementById('emptyState');

        if (filtered.length === 0) {
            grid.innerHTML = '';
            empty.style.display = '';
            document.getElementById('pageInfo').innerHTML = 'No results found';
            document.getElementById('pageBtns').innerHTML = '';
            document.getElementById('resultLabel').textContent = '0 images';
            return;
        }

        empty.style.display = 'none';
        const total = filtered.length;
        const totalPages = Math.ceil(total / perPage);
        if (currentPage > totalPages) currentPage = 1;
        const start = (currentPage - 1) * perPage;
        const end = Math.min(start + perPage, total);
        const page = filtered.slice(start, end);

        document.getElementById('resultLabel').textContent = total + ' image' + (total === 1 ? '' : 's');
        document.getElementById('pageInfo').innerHTML = `Showing <strong>${start+1}</strong>–<strong>${end}</strong> of <strong>${total}</strong>`;

        grid.className = 'gallery-grid' + (currentView === 'list' ? ' list-view' : '');

        grid.innerHTML = page.map(img => {
            const catClass = 'cat-' + img.module;
            const catLabel = MODULE_LABELS[img.module] || img.module;
            return `
    <div class="img-card">
      <div class="img-thumb-wrap">
        <img class="img-thumb" src="${img.src}" alt="${img.alt}" loading="lazy" onerror="this.src='https://via.placeholder.com/300x200?text=IMG'">
        <span class="img-cat-badge ${catClass}">${catLabel}</span>
        <div class="img-overlay">
          <button class="ov-btn" onclick="openPreview(${img.id})" title="Full Preview">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          </button>
          <button class="ov-btn" onclick="copyUrl(${img.id})" title="Copy URL">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
          </button>
          <button class="ov-btn" onclick="openEdit(${img.id})" title="Edit">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
          </button>
        </div>
      </div>
      <div class="img-card-body">
        <div class="img-filename" title="${img.filename}">${img.filename}</div>
        <div class="img-meta">
          <span class="img-date">${img.date}</span>
          <span class="img-size">${img.size}</span>
        </div>
        <div class="img-card-actions">
          <span class="img-cat-badge list-cat-badge ${catClass}" style="font-size:11px;padding:2px 8px">${catLabel}</span>
          <div style="flex:1"></div>
          <button class="ico-btn" onclick="openEdit(${img.id})" title="Edit">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
          </button>
          <button class="ico-btn" onclick="copyUrl(${img.id})" title="Copy URL">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
          </button>
          <button class="ico-btn danger" onclick="confirmDelete(${img.id})" title="Delete">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
          </button>
        </div>
      </div>
    </div>`;
        }).join('');

        renderPagination(total, totalPages);
    }

    function renderPagination(total, totalPages) {
        const wrap = document.getElementById('pageBtns');
        if (totalPages <= 1) {
            wrap.innerHTML = '';
            return;
        }
        let html = `<button class="page-btn" onclick="goPage(${currentPage-1})" ${currentPage===1?'disabled':''}><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg></button>`;
        for (let i = 1; i <= totalPages; i++) {
            if (totalPages > 7 && i > 2 && i < totalPages - 1 && Math.abs(i - currentPage) > 1) {
                if (i === 3 || i === totalPages - 2) html += `<button class="page-btn" disabled style="border:none">…</button>`;
                continue;
            }
            html += `<button class="page-btn ${i===currentPage?'active':''}" onclick="goPage(${i})">${i}</button>`;
        }
        html += `<button class="page-btn" onclick="goPage(${currentPage+1})" ${currentPage===totalPages?'disabled':''}><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></button>`;
        wrap.innerHTML = html;
    }

    function goPage(p) {
        const totalPages = Math.ceil(filtered.length / perPage);
        if (p < 1 || p > totalPages) return;
        currentPage = p;
        renderGallery();
        document.querySelector('.gallery-section').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    // ═══════════════════════════════
    // VIEW TOGGLE
    // ═══════════════════════════════
    function setView(v) {
        currentView = v;
        document.getElementById('viewGrid').classList.toggle('active', v === 'grid');
        document.getElementById('viewList').classList.toggle('active', v === 'list');
        renderGallery();
    }

    // ═══════════════════════════════
    // PREVIEW
    // ═══════════════════════════════
    function openPreview(id) {
        const img = images.find(i => i.id === id);
        if (!img) return;
        document.getElementById('prevImgFull').src = img.src;
        document.getElementById('prevModalTitle').textContent = img.filename;
        document.getElementById('prevFilename').textContent = img.filename;
        document.getElementById('prevModule').textContent = MODULE_LABELS[img.module] || img.module;
        document.getElementById('prevSize').textContent = img.size;
        document.getElementById('prevDate').textContent = img.date;
        document.getElementById('prevDimensions').textContent = img.dimensions;
        document.getElementById('prevCopyBtn').onclick = () => copyUrl(id);
        document.getElementById('prevEditBtn').onclick = () => {
            closeModal('previewModal');
            openEdit(id);
        };
        openModal('previewModal');
    }

    // ═══════════════════════════════
    // COPY URL
    // ═══════════════════════════════
    function copyUrl(id) {
        const img = images.find(i => i.id === id);
        const url = img ? img.src : `https://pudho-laguna.gov.ph/images/${id}`;
        navigator.clipboard.writeText(url).then(() => {
            showToast('success', 'URL Copied', 'Image URL has been copied to clipboard.');
        }).catch(() => {
            showToast('error', 'Copy Failed', 'Could not copy the URL to clipboard.');
        });
    }

    // ═══════════════════════════════
    // EDIT
    // ═══════════════════════════════
    function openEdit(id) {
        const img = images.find(i => i.id === id);
        if (!img) return;
        document.getElementById('editId').value = id;
        document.getElementById('editFilename').value = img.filename;
        document.getElementById('editModule').value = img.module;
        document.getElementById('editAlt').value = img.alt;
        openModal('editModal');
    }

    function saveEdit() {
        const id = parseInt(document.getElementById('editId').value);
        const idx = images.findIndex(i => i.id === id);
        if (idx < 0) return;
        images[idx].filename = document.getElementById('editFilename').value.trim() || images[idx].filename;
        images[idx].module = document.getElementById('editModule').value;
        images[idx].alt = document.getElementById('editAlt').value.trim();
        closeModal('editModal');
        updateCounts();
        applyFilter();
        showToast('success', 'Image Updated', 'Image details have been saved successfully.');
    }

    // ═══════════════════════════════
    // DELETE
    // ═══════════════════════════════
    function confirmDelete(id) {
        const img = images.find(i => i.id === id);
        deleteTargetId = id;
        document.getElementById('confirmText').textContent = img ?
            `"${img.filename}" will be permanently removed. This cannot be undone.` :
            'This image will be permanently removed.';
        document.getElementById('confirmDeleteBtn').onclick = doDelete;
        openModal('confirmModal');
    }

    function doDelete() {
        images = images.filter(i => i.id !== deleteTargetId);
        closeModal('confirmModal');
        updateCounts();
        applyFilter();
        showToast('success', 'Image Deleted', 'The image has been permanently removed.');
    }

    // ═══════════════════════════════
    // UPLOAD
    // ═══════════════════════════════
    function openUploadModal() {
        pendingFiles = [];
        document.getElementById('uploadPreviews').innerHTML = '';
        document.getElementById('progressWrap').classList.remove('show');
        document.getElementById('progressFill').style.width = '0%';
        document.getElementById('uploadFileInput').value = '';
        openModal('uploadModal');
    }

    function handleFilePick(e) {
        addFiles(e.target.files);
    }

    function handleDragOver(e) {
        e.preventDefault();
        document.getElementById('dropZone').classList.add('drag-over');
    }

    function handleDragLeave() {
        document.getElementById('dropZone').classList.remove('drag-over');
    }

    function handleDrop(e) {
        e.preventDefault();
        document.getElementById('dropZone').classList.remove('drag-over');
        addFiles(e.dataTransfer.files);
    }

    function addFiles(fileList) {
        for (const file of fileList) {
            if (!file.type.startsWith('image/')) continue;
            if (file.size > 5 * 1024 * 1024) {
                showToast('warning', 'File Too Large', `"${file.name}" exceeds the 5MB limit.`);
                continue;
            }
            pendingFiles.push(file);
            renderUploadPreview(file);
        }
    }

    function renderUploadPreview(file) {
        const reader = new FileReader();
        reader.onload = ev => {
            const wrap = document.getElementById('uploadPreviews');
            const div = document.createElement('div');
            div.className = 'upload-preview-item';
            div.setAttribute('data-name', file.name);
            div.innerHTML = `
      <img src="${ev.target.result}" alt="${file.name}">
      <button type="button" class="remove-btn" onclick="removePending('${file.name}')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>`;
            wrap.appendChild(div);
        };
        reader.readAsDataURL(file);
    }

    function removePending(name) {
        pendingFiles = pendingFiles.filter(f => f.name !== name);
        const el = document.querySelector(`.upload-preview-item[data-name="${name}"]`);
        if (el) el.remove();
    }

    function doUpload() {
        if (pendingFiles.length === 0) {
            showToast('warning', 'No Files', 'Please select at least one image to upload.');
            return;
        }

        const module_val = document.getElementById('uploadModule').value;
        const alt_val = document.getElementById('uploadAlt').value.trim();
        const btn = document.getElementById('uploadBtn');

        btn.innerHTML = '<div class="btn-spinner"></div> Uploading…';
        btn.disabled = true;

        const wrap = document.getElementById('progressWrap');
        const fill = document.getElementById('progressFill');
        const pct = document.getElementById('progressPct');
        const lbl = document.getElementById('progressLabel');
        wrap.classList.add('show');

        let progress = 0;
        const interval = setInterval(() => {
            progress = Math.min(progress + Math.random() * 18, 95);
            fill.style.width = progress + '%';
            pct.textContent = Math.round(progress) + '%';
            lbl.textContent = `Uploading ${pendingFiles.length} image${pendingFiles.length>1?'s':''}…`;
        }, 120);

        setTimeout(() => {
            clearInterval(interval);
            fill.style.width = '100%';
            pct.textContent = '100%';
            lbl.textContent = 'Upload complete!';

            // Add to images array
            const now = new Date();
            const dateStr = now.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            pendingFiles.forEach((file, i) => {
                const seed = 'new' + (images.length + i + 1);
                images.unshift({
                    id: images.length ? Math.max(...images.map(x => x.id)) + i + 1 : i + 1,
                    filename: file.name,
                    module: module_val,
                    alt: alt_val || file.name,
                    size: (file.size / 1024).toFixed(0) + ' KB',
                    dimensions: '—',
                    date: dateStr,
                    src: `https://picsum.photos/seed/${seed}/600/400`,
                });
            });

            btn.innerHTML = 'Upload';
            btn.disabled = false;
            closeModal('uploadModal');
            updateCounts();
            applyFilter();
            showToast('success', `${pendingFiles.length} Image${pendingFiles.length>1?'s':''} Uploaded`, 'Images are now available in the gallery.');
            pendingFiles = [];
        }, 1800);
    }

    // ═══════════════════════════════
    // LOADER
    // ═══════════════════════════════
    function showLoader() {
        document.getElementById('galleryLoader').classList.add('show');
    }

    function hideLoader() {
        document.getElementById('galleryLoader').classList.remove('show');
    }

    // ═══════════════════════════════
    // MODALS
    // ═══════════════════════════════
    function openModal(id) {
        document.getElementById(id).classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.modal-backdrop').forEach(bd => {
        bd.addEventListener('click', e => {
            if (e.target === bd) closeModal(bd.id);
        });
    });

    // ═══════════════════════════════
    // TOAST
    // ═══════════════════════════════
    const toastIcons = {
        success: `<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
        error: `<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
        warning: `<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`,
        info: `<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
    };

    function showToast(type, title, msg) {
        const el = document.createElement('div');
        el.className = `toast ${type}`;
        el.innerHTML = `${toastIcons[type]}<div class="toast-msg"><strong>${title}</strong><span>${msg}</span></div>`;
        document.getElementById('toastContainer').appendChild(el);
        setTimeout(() => {
            el.classList.add('toast-out');
            setTimeout(() => el.remove(), 220);
        }, 3500);
    }
</script>

@endsection