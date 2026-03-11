@extends('editor.layout')

@section('title', 'News & Accomplishments')

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

    /* ── Page header ── */
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
        line-height: 1.2;
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
        transition: background 0.15s, transform 0.1s;
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

    /* ── Filter bar ── */
    .filter-bar {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 13px;
        padding: 18px 20px;
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: 1fr auto auto auto;
        gap: 12px;
        align-items: end;
    }

    @media (max-width: 900px) {
        .filter-bar {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 580px) {
        .filter-bar {
            grid-template-columns: 1fr;
        }
    }

    .filter-group label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-muted);
        margin-bottom: 6px;
    }

    .filter-input,
    .filter-select {
        width: 100%;
        padding: 9px 12px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-primary);
        background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s;
        outline: none;
        appearance: none;
    }

    .filter-input:focus,
    .filter-select:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, 0.08);
    }

    .search-wrap {
        position: relative;
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

    .search-wrap .filter-input {
        padding-left: 34px;
        padding-right: 32px;
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

    .select-wrap {
        position: relative;
    }

    .select-wrap svg {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 14px;
        height: 14px;
        color: var(--text-muted);
        pointer-events: none;
    }

    /* ── Stats row ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    @media (max-width: 800px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .stats-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 12px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 18px;
        height: 18px;
    }

    .stat-val {
        font-size: 22px;
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

    /* ── Table card ── */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 13px;
        overflow: hidden;
    }

    .table-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--red-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .table-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .result-count {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead tr {
        background: var(--bg);
        border-bottom: 1px solid var(--red-border);
    }

    th {
        padding: 11px 16px;
        text-align: left;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-muted);
        white-space: nowrap;
    }

    tbody tr {
        border-bottom: 1px solid #FFF4F5;
        transition: background 0.1s;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    tbody tr:hover {
        background: var(--red-pale);
    }

    td {
        padding: 14px 16px;
        vertical-align: middle;
        font-size: 13px;
    }

    /* Thumbnail */
    .thumb {
        width: 80px;
        height: 52px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--border);
        flex-shrink: 0;
    }

    /* Article info */
    .art-title {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--text-primary);
        line-height: 1.35;
        margin-bottom: 3px;
    }

    .art-desc {
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .tag-pill {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        margin: 2px 2px 2px 0;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-news {
        background: #EFF6FF;
        color: #1E40AF;
    }

    .badge-accomplishment {
        background: #FFF7ED;
        color: #9A3412;
    }

    .badge-published {
        background: #F0FDF4;
        color: #166534;
    }

    .badge-draft {
        background: #FFF9C4;
        color: #854D0E;
    }

    .badge-archived {
        background: #F3F4F6;
        color: #374151;
    }

    .badge-scheduled {
        background: #F5F3FF;
        color: #5B21B6;
    }

    /* Scheduled time display */
    .scheduled-time {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #7C3AED;
        margin-top: 4px;
        font-weight: 500;
    }

    .scheduled-time svg {
        width: 12px;
        height: 12px;
    }

    /* Action buttons */
    .action-btns {
        display: flex;
        align-items: center;
        gap: 4px;
        flex-wrap: wrap;
    }

    .act-btn {
        padding: 5px 10px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: background 0.12s, color 0.12s;
        white-space: nowrap;
    }

    .act-btn-edit {
        background: var(--red-pale);
        color: var(--red);
    }

    .act-btn-edit:hover {
        background: var(--red-pale2);
    }

    .act-btn-preview {
        background: #EFF6FF;
        color: #1D4ED8;
    }

    .act-btn-preview:hover {
        background: #DBEAFE;
    }

    .act-btn-publish {
        background: #F0FDF4;
        color: #166534;
    }

    .act-btn-publish:hover {
        background: #DCFCE7;
    }

    .act-btn-unpublish {
        background: #FFF9C4;
        color: #854D0E;
    }

    .act-btn-unpublish:hover {
        background: #FEF08A;
    }

    .act-btn-archive {
        background: #F3F4F6;
        color: #374151;
    }

    .act-btn-archive:hover {
        background: #E5E7EB;
    }

    .act-btn-delete {
        background: #FFF0F1;
        color: var(--red);
    }

    .act-btn-delete:hover {
        background: var(--red-pale2);
    }

    .act-btn-schedule {
        background: #F5F3FF;
        color: #5B21B6;
    }

    .act-btn-schedule:hover {
        background: #EDE9FE;
    }

    /* Dropdown more menu */
    .more-menu-wrap {
        position: relative;
        display: inline-block;
    }

    .more-btn {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        border: none;
        background: var(--bg);
        color: var(--text-muted);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.12s;
    }

    .more-btn:hover {
        background: var(--red-pale);
        color: var(--red);
    }

    .more-btn svg {
        width: 15px;
        height: 15px;
    }

    .more-dropdown {
        position: absolute;
        right: 0;
        top: calc(100% + 6px);
        background: #fff;
        border: 1px solid var(--red-border);
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(192, 32, 47, 0.12);
        z-index: 50;
        min-width: 160px;
        display: none;
        overflow: hidden;
        animation: dropIn 0.14s ease;
    }

    .more-dropdown.open {
        display: block;
    }

    @keyframes dropIn {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .more-dropdown button {
        display: flex;
        align-items: center;
        gap: 9px;
        width: 100%;
        padding: 9px 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-secondary);
        border: none;
        background: none;
        cursor: pointer;
        text-align: left;
        transition: background 0.1s, color 0.1s;
    }

    .more-dropdown button:hover {
        background: var(--red-pale);
        color: var(--red);
    }

    .more-dropdown button svg {
        width: 14px;
        height: 14px;
        color: inherit;
        flex-shrink: 0;
    }

    .more-dropdown button.danger {
        color: var(--red);
    }

    .more-dropdown button.danger:hover {
        background: var(--red-pale2);
    }

    .more-dropdown .sep {
        height: 1px;
        background: var(--red-border);
        margin: 4px 0;
    }

    /* Pagination */
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
        transition: all 0.12s;
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
        opacity: 0.4;
        cursor: not-allowed;
    }

    .page-btn svg {
        width: 14px;
        height: 14px;
    }

    /* Loading skeleton */
    .skeleton-row td {
        padding: 14px 16px;
    }

    .skeleton {
        background: linear-gradient(90deg, #f0e8e9 25%, #fde8ea 50%, #f0e8e9 75%);
        background-size: 200% 100%;
        animation: shimmer 1.4s infinite;
        border-radius: 6px;
        display: block;
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    /* Empty state */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state svg {
        width: 48px;
        height: 48px;
        color: var(--red-border);
        margin: 0 auto 12px;
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

    /* ══════════════════════════════════
     MODAL SYSTEM
  ══════════════════════════════════ */
    .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(20, 0, 5, 0.5);
        backdrop-filter: blur(4px);
        z-index: 200;
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
        box-shadow: 0 20px 60px rgba(192, 32, 47, 0.18);
        width: 100%;
        max-width: 680px;
        margin: auto;
        animation: modalIn 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }

    .modal.modal-sm {
        max-width: 420px;
    }

    .modal.modal-lg {
        max-width: 820px;
    }

    @keyframes modalIn {
        from {
            opacity: 0;
            transform: scale(0.94) translateY(20px);
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
        transition: background 0.12s, color 0.12s;
        flex-shrink: 0;
    }

    .modal-close:hover {
        background: var(--red-pale);
        color: var(--red);
    }

    .modal-close svg {
        width: 16px;
        height: 16px;
    }

    .modal-body {
        padding: 20px 24px;
    }

    .modal-footer {
        padding: 0 24px 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    .modal-sep {
        height: 1px;
        background: var(--red-border);
        margin: 0 24px 16px;
    }

    /* Form fields */
    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-muted);
        margin-bottom: 7px;
    }

    .form-label span {
        color: var(--red);
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 10px 13px;
        border: 1.5px solid var(--border);
        border-radius: 9px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-primary);
        background: #fff;
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
        appearance: none;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, 0.09);
    }

    .form-textarea {
        resize: vertical;
        min-height: 110px;
        line-height: 1.6;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 520px) {
        .form-grid-2 {
            grid-template-columns: 1fr;
        }
    }

    /* Select wrapper */
    .sel-wrap {
        position: relative;
    }

    .sel-wrap svg {
        position: absolute;
        right: 11px;
        top: 50%;
        transform: translateY(-50%);
        width: 14px;
        height: 14px;
        color: var(--text-muted);
        pointer-events: none;
    }

    /* Tags */
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 8px;
        border: 1.5px solid var(--border);
        border-radius: 9px;
        min-height: 42px;
        cursor: text;
        transition: border-color 0.15s;
    }

    .tags-container:focus-within {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, 0.09);
    }

    .tag-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: var(--red-pale2);
        color: var(--red);
    }

    .tag-chip button {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--red);
        padding: 0;
        line-height: 1;
        opacity: 0.6;
        transition: opacity 0.1s;
    }

    .tag-chip button:hover {
        opacity: 1;
    }

    .tag-chip button svg {
        width: 10px;
        height: 10px;
        display: block;
    }

    .tag-input-inline {
        border: none;
        outline: none;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        color: var(--text-primary);
        background: transparent;
        min-width: 80px;
        flex: 1;
        padding: 3px 4px;
    }

    .tag-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 8px;
    }

    .tag-sug-btn {
        padding: 3px 10px;
        border-radius: 20px;
        border: 1.5px solid var(--border);
        background: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 11.5px;
        font-weight: 600;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.12s;
    }

    .tag-sug-btn:hover {
        border-color: var(--red);
        color: var(--red);
        background: var(--red-pale);
    }

    /* Image upload */
    .upload-zone {
        border: 2px dashed var(--red-border);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.15s, background 0.15s;
    }

    .upload-zone:hover,
    .upload-zone.drag-over {
        border-color: var(--red);
        background: var(--red-pale);
    }

    .upload-zone svg {
        width: 28px;
        height: 28px;
        color: var(--red-border);
        margin: 0 auto 8px;
        display: block;
    }

    .upload-zone p {
        font-size: 12.5px;
        color: var(--text-muted);
    }

    .upload-zone p strong {
        color: var(--red);
    }

    .img-preview-main {
        width: 100%;
        max-height: 160px;
        object-fit: cover;
        border-radius: 9px;
        border: 1px solid var(--border);
        margin-bottom: 8px;
        display: none;
    }

    .gallery-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .gallery-item {
        position: relative;
        width: 70px;
        height: 54px;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 7px;
        border: 1px solid var(--border);
    }

    .gallery-item button {
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
        font-size: 10px;
        line-height: 1;
    }

    .gallery-item button svg {
        width: 9px;
        height: 9px;
    }

    /* Btn variants */
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
        transition: all 0.12s;
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
        transition: background 0.12s;
    }

    .btn-danger:hover {
        background: var(--red-dark);
    }

    /* ── PREVIEW MODAL ── */
    .preview-modal .modal {
        max-width: 760px;
    }

    .preview-hero {
        width: 100%;
        max-height: 280px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 16px;
        display: block;
    }

    .preview-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .preview-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.35;
        margin-bottom: 8px;
    }

    .preview-body {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.7;
        white-space: pre-wrap;
    }

    .preview-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 16px;
    }

    .preview-gallery img {
        height: 80px;
        width: auto;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--border);
    }

    /* ── SCHEDULE MODAL ── */
    .schedule-notice {
        background: #F5F3FF;
        border: 1px solid #DDD6FE;
        border-radius: 9px;
        padding: 12px 14px;
        font-size: 12.5px;
        color: #5B21B6;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
    }

    .schedule-notice svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    /* ── TOAST SYSTEM ── */
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
        box-shadow: 0 8px 30px rgba(20, 0, 5, 0.15);
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        color: var(--text-primary);
        min-width: 240px;
        max-width: 340px;
        pointer-events: auto;
        animation: toastIn 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        border-left: 4px solid var(--red);
    }

    .toast.success {
        border-left-color: #22c55e;
    }

    .toast.warning {
        border-left-color: #EAB308;
    }

    .toast.info {
        border-left-color: #3B82F6;
    }

    .toast.error {
        border-left-color: var(--red);
    }

    .toast-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .toast.success .toast-icon {
        color: #22c55e;
    }

    .toast.warning .toast-icon {
        color: #EAB308;
    }

    .toast.info .toast-icon {
        color: #3B82F6;
    }

    .toast.error .toast-icon {
        color: var(--red);
    }

    .toast-msg {
        flex: 1;
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
        animation: toastOut 0.22s ease forwards;
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

    /* ── CONFIRM MODAL ── */
    .confirm-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
    }

    .confirm-icon svg {
        width: 24px;
        height: 24px;
    }

    .confirm-icon.danger {
        background: var(--red-pale2);
        color: var(--red);
    }

    .confirm-icon.warning {
        background: #FFF9C4;
        color: #854D0E;
    }

    .confirm-body {
        text-align: center;
        padding: 20px 24px 0;
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

    /* ── Loading overlay ── */
    .loading-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(2px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 13px;
        display: none;
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
        animation: spin 0.7s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Inline spinner for buttons */
    .btn-spinner {
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255, 255, 255, 0.4);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
        flex-shrink: 0;
    }

    /* Responsive tweaks */
    @media (max-width: 720px) {

        th.hide-sm,
        td.hide-sm {
            display: none;
        }
    }

    @media (max-width: 540px) {

        th.hide-xs,
        td.hide-xs {
            display: none;
        }

        .action-btns {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="page-wrap">

    <!-- ── PAGE HEADER ── -->
    <div class="page-header">
        <div>
            <div class="page-title">News & Accomplishments</div>
            <div class="page-sub">Manage all news articles and accomplishment reports</div>
        </div>
        <button class="btn-primary" onclick="openCreateModal()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Add Article
        </button>
    </div>

    <!-- ── STATS ── -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon" style="background:#FEF0F1">
                <svg fill="none" stroke="#C0202F" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="statTotal">97</div>
                <div class="stat-lbl">Total Articles</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#F0FDF4">
                <svg fill="none" stroke="#166534" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="statPublished">54</div>
                <div class="stat-lbl">Published</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#FFF9C4">
                <svg fill="none" stroke="#854D0E" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="statDraft">28</div>
                <div class="stat-lbl">Drafts</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#F5F3FF">
                <svg fill="none" stroke="#5B21B6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <div class="stat-val" id="statScheduled">7</div>
                <div class="stat-lbl">Scheduled</div>
            </div>
        </div>
    </div>

    <!-- ── FILTER BAR ── -->
    <div class="filter-bar">
        <div class="filter-group">
            <label>Search</label>
            <div class="search-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="searchInput" class="filter-input" placeholder="Search articles…" oninput="triggerFilter()">
                <button class="search-clear" id="searchClear" onclick="clearSearch()">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="filter-group">
            <label>Type</label>
            <div class="select-wrap">
                <select id="filterType" class="filter-select" onchange="triggerFilter()">
                    <option value="">All Types</option>
                    <option value="news">News</option>
                    <option value="accomplishment">Accomplishment</option>
                </select>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
        <div class="filter-group">
            <label>Status</label>
            <div class="select-wrap">
                <select id="filterStatus" class="filter-select" onchange="triggerFilter()">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="archived">Archived</option>
                </select>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
        <div class="filter-group">
            <label>Year</label>
            <div class="select-wrap">
                <select id="filterYear" class="filter-select" onchange="triggerFilter()">
                    <option value="">All Years</option>
                    <option value="2026">2026</option>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                </select>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </div>

    <!-- ── TABLE CARD ── -->
    <div class="table-card" style="position:relative">
        <div class="loading-overlay" id="tableLoader">
            <div class="spinner"></div>
        </div>

        <div class="table-card-header">
            <div class="table-card-title">Articles</div>
            <div class="result-count" id="resultCount">Showing <strong>1–4</strong> of <strong>97</strong> articles</div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width:90px">Thumbnail</th>
                        <th>Article</th>
                        <th class="hide-sm">Type</th>
                        <th class="hide-sm">Date</th>
                        <th>Status</th>
                        <th style="width:180px">Actions</th>
                    </tr>
                </thead>
                <tbody id="articlesBody">
                    <!-- JS will render rows -->
                </tbody>
            </table>
            <div class="empty-state" id="emptyState" style="display:none">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3>No articles found</h3>
                <p>Try adjusting your search or filter criteria.</p>
            </div>
        </div>

        <div class="pagination-bar">
            <div class="page-info" id="pageInfo">Showing <strong>1</strong> to <strong>4</strong> of <strong>97</strong> results</div>
            <div class="page-btns" id="pageBtns"></div>
        </div>
    </div>

</div>

<!-- ══════════════════════════
     CREATE / EDIT MODAL
══════════════════════════ -->
<div class="modal-backdrop" id="articleModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <div class="modal-title" id="modalTitle">Add Article</div>
            <button class="modal-close" onclick="closeArticleModal()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body" style="overflow-y:auto; max-height:75vh;">
            <div class="form-grid-2">
                <div class="form-group" style="grid-column:1/-1">
                    <label class="form-label">Title <span>*</span></label>
                    <input type="text" id="fTitle" class="form-input" placeholder="Enter article title">
                </div>
                <div class="form-group">
                    <label class="form-label">Type <span>*</span></label>
                    <div class="sel-wrap">
                        <select id="fType" class="form-select">
                            <option value="news">News</option>
                            <option value="accomplishment">Accomplishment</option>
                        </select>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status <span>*</span></label>
                    <div class="sel-wrap">
                        <select id="fStatus" class="form-select" onchange="toggleScheduleField()">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Schedule date (shows when Scheduled) -->
                <div class="form-group" id="scheduleRow" style="display:none; grid-column:1/-1">
                    <div class="schedule-notice">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        This article will automatically publish at the scheduled date and time.
                    </div>
                    <label class="form-label">Schedule Date & Time <span>*</span></label>
                    <input type="datetime-local" id="fSchedule" class="form-input">
                </div>

                <div class="form-group" style="grid-column:1/-1">
                    <label class="form-label">Content <span>*</span></label>
                    <textarea id="fContent" class="form-textarea" placeholder="Write the article content here…" style="min-height:140px"></textarea>
                </div>

                <!-- Tags -->
                <div class="form-group" style="grid-column:1/-1">
                    <label class="form-label">Tags</label>
                    <div class="tags-container" id="tagsContainer" onclick="document.getElementById('tagInputInline').focus()">
                        <input type="text" id="tagInputInline" class="tag-input-inline" placeholder="Type and press Enter…" onkeydown="handleTagKey(event)">
                    </div>
                    <div class="tag-suggestions" id="tagSuggestions">
                        <span style="font-size:11px;color:var(--text-muted);align-self:center">Suggestions:</span>
                    </div>
                </div>

                <!-- Featured image -->
                <div class="form-group" style="grid-column:1/-1">
                    <label class="form-label">Featured Image</label>
                    <img id="mainImgPreview" class="img-preview-main" src="" alt="">
                    <div class="upload-zone" id="mainUploadZone"
                        onclick="document.getElementById('mainImageFile').click()"
                        ondragover="handleDragOver(event,'mainUploadZone')"
                        ondragleave="handleDragLeave('mainUploadZone')"
                        ondrop="handleDrop(event,'main')">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p><strong>Click to upload</strong> or drag & drop</p>
                        <p style="font-size:11px;margin-top:4px">PNG, JPG, WEBP up to 5MB</p>
                    </div>
                    <input type="file" id="mainImageFile" accept="image/*" class="hidden" style="display:none" onchange="previewMain(event)">
                </div>

                <!-- Gallery -->
                <div class="form-group" style="grid-column:1/-1">
                    <label class="form-label">Image Gallery <span style="color:var(--text-muted);text-transform:none;letter-spacing:0">(optional)</span></label>
                    <div class="gallery-grid" id="galleryGrid"></div>
                    <button type="button" onclick="document.getElementById('galleryFile').click()" style="margin-top:10px;display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px;border:1.5px dashed var(--red-border);background:#fff;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:600;color:var(--text-muted);cursor:pointer;transition:all 0.12s" onmouseover="this.style.borderColor='var(--red)';this.style.color='var(--red)'" onmouseout="this.style.borderColor='var(--red-border)';this.style.color='var(--text-muted)'">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Gallery Images
                    </button>
                    <input type="file" id="galleryFile" accept="image/*" multiple style="display:none" onchange="addGallery(event)">
                </div>
            </div>
        </div>
        <div class="modal-sep"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeArticleModal()">Cancel</button>
            <button class="btn-secondary" id="previewDraftBtn" onclick="previewFromForm()">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;margin-right:5px;vertical-align:-2px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Preview
            </button>
            <button class="btn-primary" id="saveBtn" onclick="saveArticle()">
                Save Article
            </button>
        </div>
    </div>
</div>

<!-- ══════════════════════════
     PREVIEW MODAL
══════════════════════════ -->
<div class="modal-backdrop preview-modal" id="previewModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <div class="modal-title">Article Preview</div>
            <button class="modal-close" onclick="closePreview()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body" style="overflow-y:auto;max-height:78vh">
            <img id="prevHeroImg" class="preview-hero" src="" alt="">
            <div class="preview-meta" id="prevMeta"></div>
            <div class="preview-title" id="prevTitle"></div>
            <div class="preview-body" id="prevBody"></div>
            <div class="preview-gallery" id="prevGallery"></div>
        </div>
        <div class="modal-sep"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closePreview()">Close</button>
            <button class="btn-primary" id="previewEditBtn" onclick="closePreview()">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;margin-right:4px;vertical-align:-2px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Back to Edit
            </button>
        </div>
    </div>
</div>

<!-- ══════════════════════════
     SCHEDULE MODAL
══════════════════════════ -->
<div class="modal-backdrop" id="scheduleModal">
    <div class="modal modal-sm">
        <div class="modal-header">
            <div class="modal-title">Schedule Article</div>
            <button class="modal-close" onclick="closeModal('scheduleModal')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="schedule-notice">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                The article will auto-publish at the selected date and time.
            </div>
            <div class="form-group">
                <label class="form-label">Publish Date & Time <span style="color:var(--red)">*</span></label>
                <input type="datetime-local" id="scheduleDateTime" class="form-input">
            </div>
        </div>
        <div class="modal-sep"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeModal('scheduleModal')">Cancel</button>
            <button class="btn-primary" onclick="confirmSchedule()">Set Schedule</button>
        </div>
    </div>
</div>

<!-- ══════════════════════════
     CONFIRM MODAL
══════════════════════════ -->
<div class="modal-backdrop" id="confirmModal">
    <div class="modal modal-sm">
        <div class="confirm-body" id="confirmBody">
            <div class="confirm-icon danger" id="confirmIcon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 id="confirmTitle">Are you sure?</h3>
            <p id="confirmText">This action cannot be undone.</p>
        </div>
        <div class="modal-sep" style="margin-top:16px"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeModal('confirmModal')">Cancel</button>
            <button class="btn-danger" id="confirmOkBtn" onclick="">Confirm</button>
        </div>
    </div>
</div>

<!-- Toast container -->
<div id="toastContainer"></div>

<script>

    let articles = [{
            id: 1,
            title: 'PUDHO Monthly Housing Report',
            desc: 'Comprehensive report on housing developments across Laguna province.',
            type: 'news',
            year: 2026,
            date: 'Mar 2, 2026',
            status: 'published',
            tags: ['Housing', 'Policy', 'Report'],
            img: 'https://picsum.photos/seed/art1/400/200'
        },
        {
            id: 2,
            title: 'Housing Project Completion Q1',
            desc: 'Successfully completed 50 housing units this quarter in District 3.',
            type: 'accomplishment',
            year: 2026,
            date: 'Mar 1, 2026',
            status: 'published',
            tags: ['Accomplishment', 'Housing', 'Project'],
            img: 'https://picsum.photos/seed/art2/400/200'
        },
        {
            id: 3,
            title: 'New Housing Policy Update 2026',
            desc: 'Important changes to application requirements effective April 2026.',
            type: 'news',
            year: 2026,
            date: 'Feb 28, 2026',
            status: 'draft',
            tags: ['Policy', 'Update'],
            img: 'https://picsum.photos/seed/art3/400/200'
        },
        {
            id: 4,
            title: 'Community Outreach — February',
            desc: 'Successfully served 500 families across 4 municipalities this month.',
            type: 'accomplishment',
            year: 2026,
            date: 'Feb 27, 2026',
            status: 'archived',
            tags: ['Accomplishment', 'Community', 'Success'],
            img: 'https://picsum.photos/seed/art4/400/200'
        },
        {
            id: 5,
            title: 'Urban Resettlement Program Launch',
            desc: 'New resettlement program for informal settlers in Calamba City.',
            type: 'news',
            year: 2026,
            date: 'Feb 20, 2026',
            status: 'scheduled',
            tags: ['Housing', 'Program'],
            img: 'https://picsum.photos/seed/art5/400/200',
            scheduledAt: '2026-03-20 09:00 AM'
        },
        {
            id: 6,
            title: 'Awards: Best Housing Project 2025',
            desc: 'PUDHO Laguna recognized for outstanding housing service.',
            type: 'accomplishment',
            year: 2025,
            date: 'Dec 15, 2025',
            status: 'published',
            tags: ['Awards', 'Accomplishment'],
            img: 'https://picsum.photos/seed/art6/400/200'
        },
        {
            id: 7,
            title: 'Year-End Report 2025',
            desc: 'Annual accomplishment summary for fiscal year 2025.',
            type: 'news',
            year: 2025,
            date: 'Dec 31, 2025',
            status: 'published',
            tags: ['Report', 'Annual'],
            img: 'https://picsum.photos/seed/art7/400/200'
        },
        {
            id: 8,
            title: 'HUDCC Compliance Update',
            desc: 'Updates on compliance with national housing standards.',
            type: 'news',
            year: 2025,
            date: 'Nov 10, 2025',
            status: 'draft',
            tags: ['Compliance', 'Policy'],
            img: 'https://picsum.photos/seed/art8/400/200'
        },
    ];

    let filteredArticles = [...articles];
    let currentPage = 1;
    const perPage = 5;
    let filterTimer = null;
    let scheduleTargetId = null;
    let confirmCallback = null;

    // Active tags for form
    let formTags = [];
    let editingId = null;

    const suggestedTags = ['Housing', 'Policy', 'Community', 'Development', 'Update', 'Accomplishment', 'Project', 'Success', 'Annual', 'Report', 'Compliance'];

    function renderTable() {
        const body = document.getElementById('articlesBody');
        const empty = document.getElementById('emptyState');

        if (filteredArticles.length === 0) {
            body.innerHTML = '';
            empty.style.display = '';
            document.getElementById('resultCount').innerHTML = 'No results found';
            document.getElementById('pageInfo').innerHTML = 'Showing <strong>0</strong> results';
            document.getElementById('pageBtns').innerHTML = '';
            return;
        }

        empty.style.display = 'none';
        const total = filteredArticles.length;
        const totalPages = Math.ceil(total / perPage);
        if (currentPage > totalPages) currentPage = 1;
        const start = (currentPage - 1) * perPage;
        const end = Math.min(start + perPage, total);
        const page = filteredArticles.slice(start, end);

        document.getElementById('resultCount').innerHTML = `Showing <strong>${start+1}–${end}</strong> of <strong>${total}</strong> articles`;
        document.getElementById('pageInfo').innerHTML = `Showing <strong>${start+1}</strong> to <strong>${end}</strong> of <strong>${total}</strong> results`;

        body.innerHTML = page.map(a => {
            const badge = statusBadge(a.status);
            const typeBadge = a.type === 'news' ?
                `<span class="badge badge-news">News</span>` :
                `<span class="badge badge-accomplishment">Accomplishment</span>`;
            const tags = (a.tags || []).map(t => `<span class="tag-pill" style="background:var(--red-pale2);color:var(--red)">${t}</span>`).join('');
            const sched = a.status === 'scheduled' && a.scheduledAt ?
                `<div class="scheduled-time"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>${a.scheduledAt}</div>` :
                '';
            return `
    <tr>
      <td>
        <img src="${a.img}" class="thumb" alt="" onerror="this.src='https://via.placeholder.com/80x52?text=IMG'">
      </td>
      <td>
        <div class="art-title">${a.title}</div>
        <div class="art-desc">${a.desc}</div>
        <div>${tags}</div>
      </td>
      <td class="hide-sm">${typeBadge}</td>
      <td class="hide-sm">
        <div style="font-size:12.5px;color:var(--text-secondary);font-weight:500">${a.date}</div>
        ${sched}
      </td>
      <td>${badge}</td>
      <td>
        <div class="action-btns">
          <button class="act-btn act-btn-edit" onclick="openEditModal(${a.id})">Edit</button>
          <button class="act-btn act-btn-preview" onclick="openPreview(${a.id})">Preview</button>
          <div class="more-menu-wrap">
            <button class="more-btn" onclick="toggleMoreMenu(event, 'more_${a.id}')">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
            </button>
            <div class="more-dropdown" id="more_${a.id}">
              ${getMoreMenuItems(a)}
            </div>
          </div>
        </div>
      </td>
    </tr>`;
        }).join('');

        renderPagination(total, totalPages);
    }

    function statusBadge(s) {
        const map = {
            published: `<span class="badge badge-published">Published</span>`,
            draft: `<span class="badge badge-draft">Draft</span>`,
            archived: `<span class="badge badge-archived">Archived</span>`,
            scheduled: `<span class="badge badge-scheduled">Scheduled</span>`,
        };
        return map[s] || `<span class="badge badge-draft">${s}</span>`;
    }

    function getMoreMenuItems(a) {
        let items = '';
        if (a.status === 'draft') items += `<button onclick="changeStatus(${a.id},'published')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Publish</button>`;
        if (a.status === 'published') items += `<button onclick="changeStatus(${a.id},'draft')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>Unpublish</button>`;
        if (a.status !== 'scheduled') items += `<button onclick="openScheduleModal(${a.id})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Schedule</button>`;
        if (a.status !== 'archived') items += `<button onclick="changeStatus(${a.id},'archived')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>Archive</button>`;
        else items += `<button onclick="changeStatus(${a.id},'draft')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>Restore</button>`;
        items += `<div class="sep"></div>`;
        items += `<button class="danger" onclick="confirmDelete(${a.id})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Delete</button>`;
        return items;
    }

    function renderPagination(total, totalPages) {
        const wrap = document.getElementById('pageBtns');
        if (totalPages <= 1) {
            wrap.innerHTML = '';
            return;
        }
        let html = `<button class="page-btn" onclick="goPage(${currentPage-1})" ${currentPage===1?'disabled':''}>
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
  </button>`;
        for (let i = 1; i <= totalPages; i++) {
            if (totalPages > 7 && i > 2 && i < totalPages - 1 && Math.abs(i - currentPage) > 1) {
                if (i === 3 || i === totalPages - 2) html += `<button class="page-btn" disabled style="border:none">…</button>`;
                continue;
            }
            html += `<button class="page-btn ${i===currentPage?'active':''}" onclick="goPage(${i})">${i}</button>`;
        }
        html += `<button class="page-btn" onclick="goPage(${currentPage+1})" ${currentPage===totalPages?'disabled':''}>
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
  </button>`;
        wrap.innerHTML = html;
    }

    function goPage(p) {
        const totalPages = Math.ceil(filteredArticles.length / perPage);
        if (p < 1 || p > totalPages) return;
        currentPage = p;
        renderTable();
    }

    function triggerFilter() {
        const searchInput = document.getElementById('searchInput');
        const clearBtn = document.getElementById('searchClear');
        clearBtn.style.display = searchInput.value ? 'block' : 'none';
        clearTimeout(filterTimer);
        filterTimer = setTimeout(applyFilter, 300);
    }

    function clearSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchClear').style.display = 'none';
        applyFilter();
    }

    function applyFilter() {
        const q = document.getElementById('searchInput').value.toLowerCase().trim();
        const type = document.getElementById('filterType').value;
        const status = document.getElementById('filterStatus').value;
        const year = document.getElementById('filterYear').value;

        showTableLoader();

        setTimeout(() => {
            filteredArticles = articles.filter(a => {
                const matchQ = !q || a.title.toLowerCase().includes(q) || a.desc.toLowerCase().includes(q) || (a.tags || []).some(t => t.toLowerCase().includes(q));
                const matchType = !type || a.type === type;
                const matchStatus = !status || a.status === status;
                const matchYear = !year || String(a.year) === year;
                return matchQ && matchType && matchStatus && matchYear;
            });
            currentPage = 1;
            hideTableLoader();
            renderTable();
        }, 350);
    }

    function showTableLoader() {
        document.getElementById('tableLoader').classList.add('show');
    }

    function hideTableLoader() {
        document.getElementById('tableLoader').classList.remove('show');
    }

    function openCreateModal() {
        editingId = null;
        document.getElementById('modalTitle').textContent = 'Add Article';
        document.getElementById('fTitle').value = '';
        document.getElementById('fType').value = 'news';
        document.getElementById('fStatus').value = 'draft';
        document.getElementById('fContent').value = '';
        document.getElementById('fSchedule').value = '';
        document.getElementById('mainImgPreview').style.display = 'none';
        document.getElementById('mainUploadZone').style.display = '';
        document.getElementById('galleryGrid').innerHTML = '';
        resetFormTags();
        toggleScheduleField();
        openModal('articleModal');
    }

    function openEditModal(id) {
        const a = articles.find(x => x.id === id);
        if (!a) return;
        editingId = id;
        document.getElementById('modalTitle').textContent = 'Edit Article';
        document.getElementById('fTitle').value = a.title;
        document.getElementById('fType').value = a.type;
        document.getElementById('fStatus').value = a.status;
        document.getElementById('fContent').value = a.desc;
        document.getElementById('fSchedule').value = '';
        if (a.img) {
            const prev = document.getElementById('mainImgPreview');
            prev.src = a.img;
            prev.style.display = '';
            document.getElementById('mainUploadZone').style.display = 'none';
        } else {
            document.getElementById('mainImgPreview').style.display = 'none';
            document.getElementById('mainUploadZone').style.display = '';
        }
        document.getElementById('galleryGrid').innerHTML = '';
        resetFormTags(a.tags || []);
        toggleScheduleField();
        openModal('articleModal');
    }

    function toggleScheduleField() {
        const status = document.getElementById('fStatus').value;
        document.getElementById('scheduleRow').style.display = status === 'scheduled' ? '' : 'none';
    }

    function saveArticle() {
        const title = document.getElementById('fTitle').value.trim();
        const type = document.getElementById('fType').value;
        const status = document.getElementById('fStatus').value;
        const content = document.getElementById('fContent').value.trim();
        const sched = document.getElementById('fSchedule').value;

        if (!title || !content) {
            showToast('error', 'Missing Fields', 'Title and content are required.');
            return;
        }
        if (status === 'scheduled' && !sched) {
            showToast('error', 'Schedule Required', 'Please set a scheduled date and time.');
            return;
        }

        const btn = document.getElementById('saveBtn');
        btn.innerHTML = '<div class="btn-spinner"></div> Saving…';
        btn.disabled = true;

        setTimeout(() => {
            const now = new Date();
            const dateStr = now.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });

            if (editingId) {
                const idx = articles.findIndex(a => a.id === editingId);
                if (idx > -1) {
                    articles[idx] = {
                        ...articles[idx],
                        title,
                        type,
                        status,
                        desc: content,
                        tags: [...formTags],
                        year: now.getFullYear(),
                        ...(status === 'scheduled' ? {
                            scheduledAt: new Date(sched).toLocaleString('en-US', {
                                month: 'short',
                                day: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: '2-digit'
                            })
                        } : {})
                    };
                }
                showToast('success', 'Article Updated', 'Your changes have been saved.');
            } else {
                const newId = Math.max(...articles.map(a => a.id)) + 1;
                articles.unshift({
                    id: newId,
                    title,
                    type,
                    status,
                    desc: content,
                    tags: [...formTags],
                    year: now.getFullYear(),
                    date: dateStr,
                    img: document.getElementById('mainImgPreview').src || 'https://picsum.photos/seed/new/400/200',
                    ...(status === 'scheduled' ? {
                        scheduledAt: new Date(sched).toLocaleString('en-US', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: '2-digit'
                        })
                    } : {})
                });
                showToast('success', 'Article Created', 'New article has been added successfully.');
            }

            btn.innerHTML = 'Save Article';
            btn.disabled = false;
            closeArticleModal();
            applyFilter();
        }, 600);
    }

    function closeArticleModal() {
        closeModal('articleModal');
    }

    function openPreview(id) {
        const a = articles.find(x => x.id === id);
        if (!a) return;
        buildPreview(a.img, a.title, a.type, a.status, a.date, a.desc, a.tags, []);
        openModal('previewModal');
    }

    function previewFromForm() {
        const title = document.getElementById('fTitle').value.trim() || '(No title)';
        const type = document.getElementById('fType').value;
        const status = document.getElementById('fStatus').value;
        const content = document.getElementById('fContent').value.trim() || '(No content)';
        const imgSrc = document.getElementById('mainImgPreview').src;

        const galleryImgs = [...document.querySelectorAll('#galleryGrid img')].map(i => i.src);
        buildPreview(imgSrc, title, type, status, 'Preview', content, formTags, galleryImgs);
        openModal('previewModal');
    }

    function buildPreview(img, title, type, status, date, body, tags, gallery) {
        const hero = document.getElementById('prevHeroImg');
        if (img && !img.includes('undefined') && !img.includes('null')) {
            hero.src = img;
            hero.style.display = '';
        } else {
            hero.style.display = 'none';
        }

        document.getElementById('prevTitle').textContent = title;
        document.getElementById('prevBody').textContent = body;

        const typeBadge = type === 'news' ?
            `<span class="badge badge-news">News</span>` :
            `<span class="badge badge-accomplishment">Accomplishment</span>`;
        document.getElementById('prevMeta').innerHTML = `
    ${typeBadge} ${statusBadge(status)}
    <span style="font-size:12px;color:var(--text-muted);font-weight:500">${date}</span>
    ${(tags||[]).map(t=>`<span class="tag-pill" style="background:var(--red-pale2);color:var(--red)">${t}</span>`).join('')}
  `;

        const pg = document.getElementById('prevGallery');
        pg.innerHTML = gallery.map(s => `<img src="${s}" alt="" onerror="this.style.display='none'">`).join('');
    }

    function closePreview() {
        closeModal('previewModal');
    }

    function openScheduleModal(id) {
        scheduleTargetId = id;
        document.getElementById('scheduleDateTime').value = '';
        openModal('scheduleModal');
        closeAllMoreMenus();
    }

    function confirmSchedule() {
        const dt = document.getElementById('scheduleDateTime').value;
        if (!dt) {
            showToast('error', 'Date Required', 'Please select a date and time.');
            return;
        }
        const idx = articles.findIndex(a => a.id === scheduleTargetId);
        if (idx > -1) {
            articles[idx].status = 'scheduled';
            articles[idx].scheduledAt = new Date(dt).toLocaleString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit'
            });
            showToast('info', 'Article Scheduled', articles[idx].title + ' will publish on ' + articles[idx].scheduledAt);
            closeModal('scheduleModal');
            applyFilter();
        }
    }

    function changeStatus(id, newStatus) {
        closeAllMoreMenus();
        const idx = articles.findIndex(a => a.id === id);
        if (idx < 0) return;
        articles[idx].status = newStatus;
        const labels = {
            published: 'Published',
            draft: 'Moved to Draft',
            archived: 'Archived',
            scheduled: 'Scheduled'
        };
        showToast('success', labels[newStatus] || 'Updated', `"${articles[idx].title}" status changed.`);
        applyFilter();
    }

    function confirmDelete(id) {
        closeAllMoreMenus();
        const a = articles.find(x => x.id === id);
        if (!a) return;
        document.getElementById('confirmTitle').textContent = 'Delete Article?';
        document.getElementById('confirmText').textContent = `"${a.title}" will be permanently deleted and cannot be recovered.`;
        document.getElementById('confirmIcon').className = 'confirm-icon danger';
        document.getElementById('confirmOkBtn').onclick = () => doDelete(id);
        document.getElementById('confirmOkBtn').textContent = 'Delete';
        document.getElementById('confirmOkBtn').className = 'btn-danger';
        openModal('confirmModal');
    }

    function doDelete(id) {
        articles = articles.filter(a => a.id !== id);
        closeModal('confirmModal');
        showToast('success', 'Deleted', 'Article has been permanently deleted.');
        applyFilter();
    }

    function toggleMoreMenu(e, menuId) {
        e.stopPropagation();
        const menu = document.getElementById(menuId);
        const wasOpen = menu.classList.contains('open');
        closeAllMoreMenus();
        if (!wasOpen) menu.classList.add('open');
    }

    function closeAllMoreMenus() {
        document.querySelectorAll('.more-dropdown.open').forEach(m => m.classList.remove('open'));
    }

    document.addEventListener('click', () => closeAllMoreMenus());

    function resetFormTags(initial = []) {
        formTags = [...initial];
        renderFormTags();
        buildSuggestions();
    }

    function renderFormTags() {
        const container = document.getElementById('tagsContainer');
        const input = document.getElementById('tagInputInline');
        container.innerHTML = '';
        formTags.forEach((t, i) => {
            const chip = document.createElement('span');
            chip.className = 'tag-chip';
            chip.innerHTML = `${t}<button type="button" onclick="removeFormTag(${i})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg></button>`;
            container.appendChild(chip);
        });
        container.appendChild(input);
    }

    function removeFormTag(i) {
        formTags.splice(i, 1);
        renderFormTags();
        buildSuggestions();
    }

    function handleTagKey(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const val = e.target.value.trim().replace(/,/g, '');
            if (val && !formTags.includes(val)) {
                formTags.push(val);
                renderFormTags();
                buildSuggestions();
            } else e.target.value = '';
        }
        if (e.key === 'Backspace' && e.target.value === '' && formTags.length) {
            formTags.pop();
            renderFormTags();
            buildSuggestions();
        }
    }

    function buildSuggestions() {
        const box = document.getElementById('tagSuggestions');
        const avail = suggestedTags.filter(t => !formTags.includes(t));
        box.innerHTML = avail.length ?
            `<span style="font-size:11px;color:var(--text-muted);align-self:center">Suggestions:</span>` + avail.map(t =>
                `<button type="button" class="tag-sug-btn" onclick="addSugTag('${t}')">${t}</button>`).join('') :
            '';
    }

    function addSugTag(t) {
        if (!formTags.includes(t)) {
            formTags.push(t);
            renderFormTags();
            buildSuggestions();
        }
    }

    function previewMain(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            const prev = document.getElementById('mainImgPreview');
            prev.src = ev.target.result;
            prev.style.display = '';
            document.getElementById('mainUploadZone').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    function addGallery(e) {
        const grid = document.getElementById('galleryGrid');
        for (const file of e.target.files) {
            if (!file.type.startsWith('image/')) continue;
            const reader = new FileReader();
            reader.onload = ev => {
                const div = document.createElement('div');
                div.className = 'gallery-item';
                div.innerHTML = `<img src="${ev.target.result}" alt=""><button type="button" onclick="this.parentElement.remove()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg></button>`;
                grid.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    }

    function handleDragOver(e, zoneId) {
        e.preventDefault();
        document.getElementById(zoneId).classList.add('drag-over');
    }

    function handleDragLeave(zoneId) {
        document.getElementById(zoneId).classList.remove('drag-over');
    }

    function handleDrop(e, target) {
        e.preventDefault();
        document.getElementById('mainUploadZone').classList.remove('drag-over');
        const file = e.dataTransfer.files[0];
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = ev => {
            const prev = document.getElementById('mainImgPreview');
            prev.src = ev.target.result;
            prev.style.display = '';
            document.getElementById('mainUploadZone').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    function openModal(id) {
        document.getElementById(id).classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
        document.body.style.overflow = '';
    }

    // Close backdrop click
    document.querySelectorAll('.modal-backdrop').forEach(bd => {
        bd.addEventListener('click', e => {
            if (e.target === bd) closeModal(bd.id);
        });
    });

    const toastIcons = {
        success: `<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
        error: `<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
        warning: `<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`,
        info: `<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
    };

    function showToast(type, title, msg) {
        const container = document.getElementById('toastContainer');
        const el = document.createElement('div');
        el.className = `toast ${type}`;
        el.innerHTML = `${toastIcons[type]}<div class="toast-msg"><strong>${title}</strong><span>${msg}</span></div>`;
        container.appendChild(el);
        setTimeout(() => {
            el.classList.add('toast-out');
            setTimeout(() => el.remove(), 220);
        }, 3500);
    }

    applyFilter();
    buildSuggestions();
</script>

@endsection