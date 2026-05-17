@extends('editor.layout')

@section('title', 'News & Accomplishments')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
        transition: background 0.15s;
    }

    .btn-primary:hover {
        background: var(--red-dark);
    }

    .btn-primary svg {
        width: 16px;
        height: 16px;
    }

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
        outline: none;
        transition: border-color 0.15s;
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

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 12px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 13px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(192, 32, 47, 0.1);
        border-color: var(--red);
    }

    .stat-card.active {
        border-color: var(--red);
        background: var(--red-pale);
        box-shadow: 0 0 0 2px rgba(192, 32, 47, 0.1);
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

    .table-card {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 13px;
        overflow: hidden;
        position: relative;
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
        position: relative;
    }

    tbody tr:hover {
        background: var(--red-pale);
    }

    td {
        padding: 14px 16px;
        vertical-align: middle;
        font-size: 13px;
    }

    .thumb {
        width: 80px;
        height: 52px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--border);
        flex-shrink: 0;
    }

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
        background: var(--red-pale2);
        color: var(--red);
    }

    /* Status Badge Styles */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-published {
        background: #F0FDF4;
        color: #166534;
        border: 1px solid #BBF7D0;
    }

    .badge-published::before {
        content: "●";
        margin-right: 4px;
        font-size: 8px;
        color: #22C55E;
    }

    .badge-draft {
        background: #FFF9C4;
        color: #854D0E;
        border: 1px solid #FDE68A;
    }

    .badge-draft::before {
        content: "●";
        margin-right: 4px;
        font-size: 8px;
        color: #F59E0B;
    }

    .badge-scheduled {
        background: #F5F3FF;
        color: #5B21B6;
        border: 1px solid #DDD6FE;
    }

    .badge-scheduled::before {
        content: "●";
        margin-right: 4px;
        font-size: 8px;
        color: #8B5CF6;
    }

    /* Type Badge Styles */
    .badge-news {
        background: #EFF6FF;
        color: #1E40AF;
        border: 1px solid #BFDBFE;
    }

    .badge-accomplishment {
        background: #FFF7ED;
        color: #9A3412;
        border: 1px solid #FED7AA;
    }

    /* Action buttons - hidden by default, show on hover */
    .action-btns {
        display: flex;
        align-items: center;
        gap: 6px;
        opacity: 0;
        transform: translateY(-5px);
        transition: opacity 0.2s, transform 0.2s;
        pointer-events: none;
    }

    tbody tr:hover .action-btns {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .act-btn {
        padding: 5px 10px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.12s;
        white-space: nowrap;
    }

    .act-btn-edit {
        background: var(--red-pale);
        color: var(--red);
    }

    .act-btn-edit:hover {
        background: var(--red-pale2);
        transform: scale(1.02);
    }

    .act-btn-preview {
        background: #EFF6FF;
        color: #1D4ED8;
    }

    .act-btn-preview:hover {
        background: #DBEAFE;
        transform: scale(1.02);
    }

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
        transition: all 0.12s;
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
    }

    .more-dropdown.open {
        display: block;
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
        transition: background 0.1s;
    }

    .more-dropdown button:hover {
        background: var(--red-pale);
        color: var(--red);
    }

    .more-dropdown button svg {
        width: 14px;
        height: 14px;
    }

    .more-dropdown button.danger {
        color: var(--red);
    }

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

    .page-btns {
        display: flex;
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

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state svg {
        width: 48px;
        height: 48px;
        color: var(--red-border);
        margin: 0 auto 12px;
        display: block;
    }

    .empty-state h3 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
    }

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

    .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(20, 0, 5, 0.5);
        backdrop-filter: blur(4px);
        z-index: 200;
        display: none;
        align-items: center;
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
        max-width: 760px;
        margin: auto;
        overflow: hidden;
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
        overflow-y: auto;
        max-height: 70vh;
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
        transition: border-color 0.15s;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, 0.09);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
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
        background: #fff;
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
    }

    .tag-sug-btn:hover {
        border-color: var(--red);
        color: var(--red);
        background: var(--red-pale);
    }

    .upload-zone {
        border: 2px dashed var(--red-border);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.15s;
        background: var(--bg);
    }

    .upload-zone:hover {
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

    .img-preview-main {
        width: 100%;
        max-height: 160px;
        object-fit: cover;
        border-radius: 9px;
        border: 1px solid var(--border);
        margin-bottom: 8px;
        display: none;
    }

    .schedule-field {
        display: none;
        margin-top: 16px;
    }

    .schedule-field.show {
        display: block;
    }

    .schedule-notice {
        background: #F5F3FF;
        border: 1px solid #DDD6FE;
        border-radius: 9px;
        padding: 10px 14px;
        font-size: 12px;
        color: #5B21B6;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }

    .schedule-notice svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    .gallery-section {
        margin-top: 16px;
    }

    .gallery-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .gallery-item {
        position: relative;
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-item button {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--red);
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .gallery-item button:hover {
        background: var(--red-dark);
    }

    .add-gallery-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 8px;
        border: 1.5px dashed var(--red-border);
        background: #fff;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        cursor: pointer;
        margin-top: 10px;
    }

    .add-gallery-btn:hover {
        border-color: var(--red);
        color: var(--red);
        background: var(--red-pale);
    }

    .preview-hero {
        width: 100%;
        max-height: 280px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 16px;
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
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border);
    }

    .confirm-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: var(--red-pale2);
        color: var(--red);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
    }

    .confirm-icon svg {
        width: 24px;
        height: 24px;
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
        border-left: 4px solid var(--red);
    }

    .toast.success {
        border-left-color: #22c55e;
    }

    .toast.error {
        border-left-color: var(--red);
    }

    .toast-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
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

    .btn-spinner {
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255, 255, 255, 0.4);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
        display: inline-block;
        margin-right: 6px;
        vertical-align: middle;
    }
</style>

<div class="page-wrap">
    <div class="page-header">
        <div>
            <div class="page-title">News & Accomplishments</div>
            <div class="page-sub">Manage all news articles and accomplishment reports</div>
        </div>
        <button class="btn-primary" id="addArticleBtn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Add Article
        </button>
    </div>

    <div class="stats-row">
        <div class="stat-card" data-filter="all" onclick="filterByStat('all')">
            <div class="stat-icon" style="background:#FEF0F1"><svg fill="none" stroke="#C0202F" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
                </svg></div>
            <div>
                <div class="stat-val" id="statTotal">0</div>
                <div class="stat-lbl">Total Articles</div>
            </div>
        </div>
        <div class="stat-card" data-filter="published" onclick="filterByStat('published')">
            <div class="stat-icon" style="background:#F0FDF4"><svg fill="none" stroke="#166534" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg></div>
            <div>
                <div class="stat-val" id="statPublished">0</div>
                <div class="stat-lbl">Published</div>
            </div>
        </div>
        <div class="stat-card" data-filter="draft" onclick="filterByStat('draft')">
            <div class="stat-icon" style="background:#FFF9C4"><svg fill="none" stroke="#854D0E" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg></div>
            <div>
                <div class="stat-val" id="statDraft">0</div>
                <div class="stat-lbl">Drafts</div>
            </div>
        </div>
        <div class="stat-card" data-filter="scheduled" onclick="filterByStat('scheduled')">
            <div class="stat-icon" style="background:#F5F3FF"><svg fill="none" stroke="#5B21B6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg></div>
            <div>
                <div class="stat-val" id="statScheduled">0</div>
                <div class="stat-lbl">Scheduled</div>
            </div>
        </div>
    </div>

    <div class="filter-bar">
        <div class="filter-group">
            <label>Search</label>
            <div class="search-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="searchInput" class="filter-input" placeholder="Search articles…" oninput="handleSearchInput()">
                <button class="search-clear" id="searchClear" onclick="clearSearch()"><svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg></button>
            </div>
        </div>
        <div class="filter-group">
            <label>Type</label>
            <div class="select-wrap">
                <select id="filterType" class="filter-select" onchange="applyFilters()">
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
            <label>Year</label>
            <div class="select-wrap">
                <select id="filterYear" class="filter-select" onchange="applyFilters()">
                    <option value="">All Years</option>
                </select>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
        <div class="filter-group">
            <label>&nbsp;</label>
            <button class="btn-secondary" onclick="clearFilters()" style="width:100%">Clear Filters</button>
        </div>
    </div>

    <div class="table-card" style="position:relative">
        <div class="loading-overlay" id="tableLoader">
            <div class="spinner"></div>
        </div>
        <div class="table-card-header">
            <div class="table-card-title">Articles</div>
            <div class="result-count" id="resultCount"></div>
        </div>
        <div class="table-responsive">
            <table id="articlesTable">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Article</th>
                        <th class="hide-sm">Type</th>
                        <th class="hide-sm">Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="articlesBody"></tbody>
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
            <div class="page-info" id="pageInfo"></div>
            <div class="page-btns" id="pageBtns"></div>
        </div>
    </div>
</div>

<!-- CREATE/EDIT MODAL -->
<div class="modal-backdrop" id="articleModal">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title" id="modalTitle">Add Article</div>
            <button class="modal-close" onclick="closeArticleModal()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Title <span>*</span></label>
                <input type="text" id="fTitle" class="form-input" placeholder="Enter article title">
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Type <span>*</span></label>
                    <div class="sel-wrap">
                        <select id="fCategory" class="form-select">
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
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="schedule-field" id="scheduleField">
                <div class="schedule-notice">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    This article will automatically publish at the scheduled date and time.
                </div>
                <label class="form-label">Schedule Date & Time <span>*</span></label>
                <input type="datetime-local" id="fSchedule" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label">Content <span>*</span></label>
                <textarea id="fContent" class="form-textarea" placeholder="Write the article content here…"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Tags</label>
                <div class="tags-container" id="tagsContainer" onclick="document.getElementById('tagInputInline').focus()">
                    <input type="text" id="tagInputInline" class="tag-input-inline" placeholder="Type and press Enter…" onkeydown="handleTagKey(event)">
                </div>
                <div class="tag-suggestions" id="tagSuggestions"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Featured Image</label>
                <div id="mainImageContainer">
                    <img id="mainImgPreview" class="img-preview-main" src="" style="display:none">
                    <div class="upload-zone" id="mainUploadZone" onclick="document.getElementById('mainImageFile').click()" ondragover="event.preventDefault();this.classList.add('drag-over')" ondragleave="this.classList.remove('drag-over')" ondrop="handleImageDrop(event)">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p><strong>Click to upload</strong> or drag & drop</p>
                        <p style="font-size:11px;margin-top:4px">PNG, JPG, WEBP up to 5MB (Recommended: 1200x630)</p>
                    </div>
                </div>
                <input type="file" id="mainImageFile" accept="image/*" style="display:none" onchange="previewMainImage(event)">
            </div>
            <div class="gallery-section">
                <label class="form-label">Image Gallery <span style="text-transform:none;letter-spacing:0">(optional)</span></label>
                <div class="gallery-grid" id="galleryGrid"></div>
                <button type="button" class="add-gallery-btn" onclick="document.getElementById('galleryFileInput').click()">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Gallery Images
                </button>
                <input type="file" id="galleryFileInput" accept="image/*" multiple style="display:none" onchange="addGalleryImages(event)">
            </div>
        </div>
        <div class="modal-sep"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeArticleModal()">Cancel</button>
            <button class="btn-secondary" onclick="previewFromForm()">Preview</button>
            <button class="btn-primary" id="saveBtn" onclick="saveArticle()">Save Article</button>
        </div>
    </div>
</div>

<!-- PREVIEW MODAL -->
<div class="modal-backdrop preview-modal" id="previewModal">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">Article Preview</div>
            <button class="modal-close" onclick="closePreview()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg></button>
        </div>
        <div class="modal-body">
            <img id="prevHeroImg" class="preview-hero" src="" style="display:none">
            <div class="preview-title" id="prevTitle"></div>
            <div class="preview-body" id="prevBody"></div>
            <div class="preview-gallery" id="prevGallery"></div>
        </div>
        <div class="modal-sep"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closePreview()">Close</button>
            <button class="btn-primary" onclick="closePreview()">Back to Edit</button>
        </div>
    </div>
</div>

<!-- CONFIRM MODAL -->
<div class="modal-backdrop" id="confirmModal">
    <div class="modal modal-sm">
        <div class="confirm-body">
            <div class="confirm-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg></div>
            <h3 id="confirmTitle">Are you sure?</h3>
            <p id="confirmText">This action cannot be undone.</p>
        </div>
        <div class="modal-sep" style="margin-top:16px"></div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeModal('confirmModal')">Cancel</button>
            <button class="btn-primary" id="confirmOkBtn">Confirm</button>
        </div>
    </div>
</div>

<div id="toastContainer"></div>

<script>
    let articles = [];
    let filteredArticles = [];
    let currentPage = 1;
    const perPage = 5;
    let editingId = null;
    let formTags = [];
    let galleryImages = [];
    let featuredImage = null;
    let currentStatusFilter = 'all';
    let searchDebounceTimer;
    const suggestedTags = ['Housing', 'Policy', 'Community', 'Development', 'Update', 'Accomplishment', 'Project', 'Success', 'Annual', 'Report', 'Compliance'];

    async function fetchArticles() {
        showTableLoader();
        try {
            const response = await fetch('/editor/news/data', {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();
            if (result.success) {
                articles = result.data;
                updateStats(result.stats);
                populateYearFilter();
                applyFilters();
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('error', 'Error', 'Failed to load articles');
        } finally {
            hideTableLoader();
        }
    }

    function populateYearFilter() {
        const yearSelect = document.getElementById('filterYear');
        const years = [...new Set(articles.map(a => a.year).filter(y => y))].sort((a, b) => b - a);
        yearSelect.innerHTML = '<option value="">All Years</option>';
        years.forEach(year => {
            yearSelect.innerHTML += `<option value="${year}">${year}</option>`;
        });
    }

    function updateStats(stats) {
        document.getElementById('statTotal').textContent = stats.total || 0;
        document.getElementById('statPublished').textContent = stats.published || 0;
        document.getElementById('statDraft').textContent = stats.draft || 0;
        document.getElementById('statScheduled').textContent = stats.scheduled || 0;
    }

    function filterByStat(status) {
        currentStatusFilter = status;

        // Update active state on stat cards
        document.querySelectorAll('.stat-card').forEach(card => {
            card.classList.remove('active');
        });
        const activeCard = document.querySelector(`.stat-card[data-filter="${status}"]`);
        if (activeCard) activeCard.classList.add('active');

        // Reset to first page
        currentPage = 1;
        applyFilters();
    }

    function renderTable() {
        const body = document.getElementById('articlesBody');
        const empty = document.getElementById('emptyState');
        const table = document.getElementById('articlesTable');

        if (filteredArticles.length === 0) {
            body.innerHTML = '';
            empty.style.display = 'block';
            table.style.display = 'none';
            document.getElementById('resultCount').innerHTML = 'Showing 0 of 0 articles';
            document.getElementById('pageInfo').innerHTML = '';
            document.getElementById('pageBtns').innerHTML = '';
            return;
        }

        empty.style.display = 'none';
        table.style.display = '';

        const total = filteredArticles.length;
        const totalPages = Math.ceil(total / perPage);
        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;

        const start = (currentPage - 1) * perPage;
        const end = Math.min(start + perPage, total);
        const pageArticles = filteredArticles.slice(start, end);

        // Update result count
        document.getElementById('resultCount').innerHTML = `Showing <strong>${start+1}–${end}</strong> of <strong>${total}</strong> articles`;
        document.getElementById('pageInfo').innerHTML = `Page ${currentPage} of ${totalPages}`;

        body.innerHTML = pageArticles.map(a => {
            const tags = (a.tags ? (Array.isArray(a.tags) ? a.tags : JSON.parse(a.tags)) : []).map(t => `<span class="tag-pill">${escapeHtml(t)}</span>`).join('');

            // Status badge - shows published, draft, or scheduled
            let statusBadge = '';
            if (a.status === 'published') {
                statusBadge = '<span class="badge badge-published">Published</span>';
            } else if (a.status === 'draft') {
                statusBadge = '<span class="badge badge-draft">Draft</span>';
            } else if (a.status === 'scheduled') {
                statusBadge = '<span class="badge badge-scheduled">Scheduled</span>';
            } else {
                statusBadge = '<span class="badge badge-draft">Draft</span>';
            }

            // Type badge
            let typeBadge = '';
            if (a.category === 'news') {
                typeBadge = '<span class="badge badge-news">News</span>';
            } else {
                typeBadge = '<span class="badge badge-accomplishment">Accomplishment</span>';
            }

            const scheduledHtml = a.scheduledAt ? `<div style="font-size:10px;color:var(--text-muted);margin-top:4px;">📅 Scheduled: ${a.scheduledAt}</div>` : '';

            return `<tr>
                <td><img src="${a.img || 'https://via.placeholder.com/80x52?text=No+Image'}" class="thumb" onerror="this.src='https://via.placeholder.com/80x52?text=IMG'"></td>
                <td>
                    <div class="art-title">${escapeHtml(a.title)}</div>
                    <div class="art-desc">${escapeHtml(a.desc)}</div>
                    <div>${tags}</div>
                    ${scheduledHtml}
                </td>
                <td class="hide-sm">${typeBadge}</td>
                <td class="hide-sm"><div style="font-size:12.5px;font-weight:500">${a.date}</div></td>
                <td>${statusBadge}</td>
                <td>
                    <div class="action-btns">
                        <button class="act-btn act-btn-edit" onclick="openEditModal(${a.id})">Edit</button>
                        <button class="act-btn act-btn-preview" onclick="openPreview(${a.id})">Preview</button>
                        <div class="more-menu-wrap">
                            <button class="more-btn" onclick="toggleMoreMenu(event, 'more_${a.id}')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg></button>
                            <div class="more-dropdown" id="more_${a.id}"><button onclick="confirmDelete(${a.id})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Delete</button></div>
                        </div>
                    </div>
                </td>
            </tr>`;
        }).join('');

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        const wrap = document.getElementById('pageBtns');
        if (totalPages <= 1) {
            wrap.innerHTML = '';
            return;
        }

        let html = `<button class="page-btn" onclick="goPage(${currentPage-1})" ${currentPage===1 ? 'disabled' : ''}>←</button>`;

        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);

        if (startPage > 1) {
            html += `<button class="page-btn" onclick="goPage(1)">1</button>`;
            if (startPage > 2) html += `<button class="page-btn" disabled style="border:none">...</button>`;
        }

        for (let i = startPage; i <= endPage; i++) {
            html += `<button class="page-btn ${i===currentPage ? 'active' : ''}" onclick="goPage(${i})">${i}</button>`;
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<button class="page-btn" disabled style="border:none">...</button>`;
            html += `<button class="page-btn" onclick="goPage(${totalPages})">${totalPages}</button>`;
        }

        html += `<button class="page-btn" onclick="goPage(${currentPage+1})" ${currentPage===totalPages ? 'disabled' : ''}>→</button>`;
        wrap.innerHTML = html;
    }

    function goPage(page) {
        const totalPages = Math.ceil(filteredArticles.length / perPage);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        renderTable();
    }

    function applyFilters() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const category = document.getElementById('filterType').value;
        const year = document.getElementById('filterYear').value;

        filteredArticles = articles.filter(a => {
            // Status filter from stat cards
            if (currentStatusFilter !== 'all' && a.status !== currentStatusFilter) return false;

            // Search filter
            const matchSearch = !searchTerm || a.title.toLowerCase().includes(searchTerm) || a.desc.toLowerCase().includes(searchTerm);

            // Category filter
            const matchCategory = !category || a.category === category;

            // Year filter
            const matchYear = !year || String(a.year) === year;

            return matchSearch && matchCategory && matchYear;
        });

        currentPage = 1;
        renderTable();
    }

    function handleSearchInput() {
        const clearBtn = document.getElementById('searchClear');
        clearBtn.style.display = document.getElementById('searchInput').value ? 'block' : 'none';

        clearTimeout(searchDebounceTimer);
        searchDebounceTimer = setTimeout(() => {
            applyFilters();
        }, 300);
    }

    function clearSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchClear').style.display = 'none';
        applyFilters();
    }

    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('filterType').value = '';
        document.getElementById('filterYear').value = '';
        document.getElementById('searchClear').style.display = 'none';
        currentStatusFilter = 'all';

        document.querySelectorAll('.stat-card').forEach(card => {
            card.classList.remove('active');
        });
        document.querySelector('.stat-card[data-filter="all"]').classList.add('active');

        applyFilters();
    }

    function showTableLoader() {
        document.getElementById('tableLoader').classList.add('show');
    }

    function hideTableLoader() {
        document.getElementById('tableLoader').classList.remove('show');
    }

    function toggleScheduleField() {
        const status = document.getElementById('fStatus').value;
        const scheduleField = document.getElementById('scheduleField');
        if (status === 'scheduled') {
            scheduleField.classList.add('show');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tomorrow.setMinutes(0);
            document.getElementById('fSchedule').min = tomorrow.toISOString().slice(0, 16);
        } else {
            scheduleField.classList.remove('show');
        }
    }

    function openCreateModal() {
        editingId = null;
        formTags = [];
        galleryImages = [];
        featuredImage = null;
        document.getElementById('modalTitle').textContent = 'Add Article';
        document.getElementById('fTitle').value = '';
        document.getElementById('fCategory').value = 'news';
        document.getElementById('fStatus').value = 'published';
        document.getElementById('fContent').value = '';
        document.getElementById('fSchedule').value = '';
        document.getElementById('mainImgPreview').style.display = 'none';
        document.getElementById('mainImgPreview').src = '';
        document.getElementById('mainUploadZone').style.display = 'block';
        document.getElementById('galleryGrid').innerHTML = '';
        document.getElementById('scheduleField').classList.remove('show');
        renderFormTags();
        buildSuggestions();
        openModal('articleModal');
    }

    function openEditModal(id) {
        const a = articles.find(x => x.id === id);
        if (!a) return;
        editingId = id;
        formTags = a.tags ? (Array.isArray(a.tags) ? a.tags : JSON.parse(a.tags)) : [];
        galleryImages = a.gallery || [];
        featuredImage = a.img || null;
        document.getElementById('modalTitle').textContent = 'Edit Article';
        document.getElementById('fTitle').value = a.title;
        document.getElementById('fCategory').value = a.category;
        document.getElementById('fStatus').value = a.status || 'published';
        document.getElementById('fContent').value = a.content;

        if (a.img) {
            document.getElementById('mainImgPreview').src = a.img;
            document.getElementById('mainImgPreview').style.display = 'block';
            document.getElementById('mainUploadZone').style.display = 'none';
        } else {
            document.getElementById('mainImgPreview').style.display = 'none';
            document.getElementById('mainUploadZone').style.display = 'block';
        }

        renderGalleryGrid();
        toggleScheduleField();
        if (a.scheduledAt) {
            const date = new Date(a.scheduledAt);
            if (!isNaN(date)) {
                const formatted = date.toISOString().slice(0, 16);
                document.getElementById('fSchedule').value = formatted;
            }
        }
        renderFormTags();
        buildSuggestions();
        openModal('articleModal');
    }

    function renderGalleryGrid() {
        const grid = document.getElementById('galleryGrid');
        grid.innerHTML = '';
        galleryImages.forEach((img, idx) => {
            const div = document.createElement('div');
            div.className = 'gallery-item';
            div.innerHTML = `<img src="${img}" alt="Gallery image"><button type="button" onclick="removeGalleryImage(${idx})">✕</button>`;
            grid.appendChild(div);
        });
    }

    function removeGalleryImage(idx) {
        galleryImages.splice(idx, 1);
        renderGalleryGrid();
    }

    function addGalleryImages(event) {
        const files = event.target.files;
        for (let file of files) {
            if (!file.type.startsWith('image/')) continue;
            const reader = new FileReader();
            reader.onload = (e) => {
                galleryImages.push(e.target.result);
                renderGalleryGrid();
            };
            reader.readAsDataURL(file);
        }
        event.target.value = '';
    }

    function handleImageDrop(event) {
        event.preventDefault();
        const zone = document.getElementById('mainUploadZone');
        zone.classList.remove('drag-over');
        const file = event.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                featuredImage = e.target.result;
                document.getElementById('mainImgPreview').src = featuredImage;
                document.getElementById('mainImgPreview').style.display = 'block';
                document.getElementById('mainUploadZone').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }

    function previewMainImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                featuredImage = e.target.result;
                document.getElementById('mainImgPreview').src = featuredImage;
                document.getElementById('mainImgPreview').style.display = 'block';
                document.getElementById('mainUploadZone').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }

    async function saveArticle() {
        const title = document.getElementById('fTitle').value.trim();
        const category = document.getElementById('fCategory').value;
        const status = document.getElementById('fStatus').value;
        const content = document.getElementById('fContent').value.trim();
        const scheduleDate = document.getElementById('fSchedule').value;

        if (!title || !content) {
            showToast('error', 'Missing Fields', 'Title and content are required.');
            return;
        }
        if (status === 'scheduled' && !scheduleDate) {
            showToast('error', 'Schedule Required', 'Please set a schedule date and time.');
            return;
        }

        const btn = document.getElementById('saveBtn');
        btn.innerHTML = '<span class="btn-spinner"></span>Saving...';
        btn.disabled = true;

        try {
            const formData = new FormData();
            formData.append('title', title);
            formData.append('category', category);
            formData.append('status', status);
            formData.append('content', content);
            formData.append('tags', JSON.stringify(formTags));
            formData.append('gallery', JSON.stringify(galleryImages));
            if (scheduleDate) formData.append('scheduled_date', scheduleDate);
            if (featuredImage && featuredImage.startsWith('data:')) {
                formData.append('featured_image', featuredImage);
            }

            const url = editingId ? `/editor/news/${editingId}` : '/editor/news';
            const method = editingId ? 'PUT' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                showToast('success', editingId ? 'Updated' : 'Created', result.message);
                closeArticleModal();
                fetchArticles();
            } else {
                showToast('error', 'Error', result.message || 'Failed to save');
            }
        } catch (error) {
            console.error('Save error:', error);
            showToast('error', 'Error', 'Network error');
        } finally {
            btn.innerHTML = 'Save Article';
            btn.disabled = false;
        }
    }

    async function confirmDelete(id) {
        closeAllMoreMenus();
        document.getElementById('confirmTitle').textContent = 'Delete Article?';
        document.getElementById('confirmText').textContent = 'This will be permanently deleted.';
        document.getElementById('confirmOkBtn').onclick = async () => {
            closeModal('confirmModal');
            showTableLoader();
            try {
                const response = await fetch(`/editor/news/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const result = await response.json();
                if (result.success) {
                    showToast('success', 'Deleted', result.message);
                    fetchArticles();
                } else {
                    showToast('error', 'Error', 'Failed to delete');
                }
            } catch (error) {
                showToast('error', 'Error', 'Failed to delete');
            } finally {
                hideTableLoader();
            }
        };
        openModal('confirmModal');
    }

    function openPreview(id) {
        const a = articles.find(x => x.id === id);
        if (a) {
            document.getElementById('prevTitle').textContent = a.title;
            document.getElementById('prevBody').innerHTML = a.content;
            if (a.img) {
                document.getElementById('prevHeroImg').src = a.img;
                document.getElementById('prevHeroImg').style.display = 'block';
            } else {
                document.getElementById('prevHeroImg').style.display = 'none';
            }
            const gallery = document.getElementById('prevGallery');
            gallery.innerHTML = '';
            if (a.gallery && a.gallery.length) {
                a.gallery.forEach(img => {
                    const imgEl = document.createElement('img');
                    imgEl.src = img;
                    gallery.appendChild(imgEl);
                });
            }
            openModal('previewModal');
        }
    }

    function previewFromForm() {
        document.getElementById('prevTitle').textContent = document.getElementById('fTitle').value.trim() || '(No title)';
        document.getElementById('prevBody').innerHTML = document.getElementById('fContent').value.trim() || '(No content)';
        const imgSrc = document.getElementById('mainImgPreview').src;
        if (imgSrc) {
            document.getElementById('prevHeroImg').src = imgSrc;
            document.getElementById('prevHeroImg').style.display = 'block';
        } else {
            document.getElementById('prevHeroImg').style.display = 'none';
        }
        const gallery = document.getElementById('prevGallery');
        gallery.innerHTML = '';
        galleryImages.forEach(img => {
            const imgEl = document.createElement('img');
            imgEl.src = img;
            gallery.appendChild(imgEl);
        });
        openModal('previewModal');
    }

    function closeArticleModal() {
        closeModal('articleModal');
    }

    function closePreview() {
        closeModal('previewModal');
    }

    function openModal(id) {
        document.getElementById(id).classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
        document.body.style.overflow = '';
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

    function renderFormTags() {
        const container = document.getElementById('tagsContainer');
        const input = document.getElementById('tagInputInline');
        container.innerHTML = '';
        formTags.forEach((t, i) => {
            const chip = document.createElement('span');
            chip.className = 'tag-chip';
            chip.innerHTML = `${escapeHtml(t)}<button type="button" onclick="removeFormTag(${i})">✕</button>`;
            container.appendChild(chip);
        });
        container.appendChild(input);
        input.focus();
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
            }
            e.target.value = '';
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
        if (avail.length) {
            box.innerHTML = `<span style="font-size:11px;color:var(--text-muted);align-self:center">Suggestions:</span>${avail.map(t => `<button type="button" class="tag-sug-btn" onclick="addSugTag('${t}')">${t}</button>`).join('')}`;
        } else {
            box.innerHTML = '';
        }
    }

    function addSugTag(t) {
        if (!formTags.includes(t)) {
            formTags.push(t);
            renderFormTags();
            buildSuggestions();
        }
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function showToast(type, title, msg) {
        const container = document.getElementById('toastContainer');
        const el = document.createElement('div');
        el.className = `toast ${type}`;
        const icon = type === 'success' ? '✓' : '✗';
        el.innerHTML = `<div class="toast-icon">${icon}</div><div class="toast-msg"><strong>${title}</strong><span>${msg}</span></div>`;
        container.appendChild(el);
        setTimeout(() => {
            el.style.opacity = '0';
            el.style.transform = 'translateX(100%)';
            setTimeout(() => el.remove(), 300);
        }, 3500);
    }

    // Event Listeners
    document.querySelectorAll('.modal-backdrop').forEach(bd => {
        bd.addEventListener('click', e => {
            if (e.target === bd) closeModal(bd.id);
        });
    });
    document.addEventListener('click', () => closeAllMoreMenus());
    document.getElementById('addArticleBtn').addEventListener('click', openCreateModal);

    // Initialize
    fetchArticles();
</script>
@endsection