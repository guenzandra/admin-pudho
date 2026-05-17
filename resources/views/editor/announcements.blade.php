@extends('editor.layout')

@section('title', 'Announcements')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">

<style>
    /* Your existing CSS remains the same */
    :root {
        --red: #C0202F;
        --red-dark: #8C111E;
        --red-pale: #FFF0F1;
        --red-pale2: #FFE4E6;
        --red-border: #F0C8CB;
        --txt-1: #1C0608;
        --txt-2: #7B4A50;
        --txt-3: #B89096;
        --surface: #fff;
        --bg: #F5F0F1;
        --border: #EDE0E1;
        --green: #16a34a;
        --green-bg: #f0fdf4;
        --green-border: #bbf7d0;
        --amber: #d97706;
        --amber-bg: #fffbeb;
        --amber-border: #fde68a;
        --blue: #2563eb;
        --blue-bg: #eff6ff;
        --blue-border: #bfdbfe;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Sora', sans-serif;
    }

    /* Keep all your existing styles here */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
        gap: 16px;
        flex-wrap: wrap;
    }

    .page-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--txt-1);
        line-height: 1.2;
    }

    .page-sub {
        font-size: 13px;
        color: var(--txt-3);
        margin-top: 4px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 18px;
        background: var(--red);
        color: #fff;
        font-family: 'Sora', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: background .15s, transform .1s, box-shadow .15s;
        box-shadow: 0 2px 10px rgba(192, 32, 47, .25);
        text-decoration: none;
    }

    .btn-primary:hover {
        background: var(--red-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(192, 32, 47, .3);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-primary svg {
        width: 16px;
        height: 16px;
    }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        background: none;
        color: var(--txt-2);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 500;
        border: 1.5px solid var(--border);
        border-radius: 9px;
        cursor: pointer;
        transition: all .15s;
    }

    .btn-ghost:hover {
        background: var(--red-pale);
        color: var(--red);
        border-color: var(--red-border);
    }

    .btn-ghost svg {
        width: 15px;
        height: 15px;
    }

    .stats-row {
        display: flex;
        gap: 12px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 13px;
        padding: 16px 20px;
        flex: 1;
        min-width: 120px;
        display: flex;
        align-items: center;
        gap: 13px;
        box-shadow: 0 1px 8px rgba(192, 32, 47, .05);
        cursor: pointer;
        transition: box-shadow .15s, transform .15s, border-color .15s;
    }

    .stat-card:hover {
        box-shadow: 0 4px 18px rgba(192, 32, 47, .12);
        transform: translateY(-2px);
    }

    .stat-card.active-stat {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, .1);
    }

    .stat-icon {
        width: 38px;
        height: 38px;
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
        color: var(--txt-1);
        line-height: 1;
        font-family: 'JetBrains Mono', monospace;
    }

    .stat-lbl {
        font-size: 11px;
        color: var(--txt-3);
        margin-top: 2px;
        font-weight: 500;
    }

    .time-filter-wrap {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 14px;
        margin-bottom: 16px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(192, 32, 47, .05);
    }

    .year-tabs-bar {
        display: flex;
        align-items: center;
        padding: 0 16px;
        background: linear-gradient(135deg, #FFF5F6, #fff);
        border-bottom: 1px solid var(--red-border);
        overflow-x: auto;
        scrollbar-width: none;
    }

    .year-tabs-bar::-webkit-scrollbar {
        display: none;
    }

    .year-tab,
    .year-tab-all {
        padding: 13px 16px;
        font-size: 13px;
        font-weight: 600;
        color: var(--txt-3);
        cursor: pointer;
        border: none;
        background: none;
        font-family: 'Sora', sans-serif;
        border-bottom: 2.5px solid transparent;
        transition: color .15s, border-color .15s;
        white-space: nowrap;
        margin-bottom: -1px;
    }

    .year-tab:hover,
    .year-tab-all:hover {
        color: var(--txt-2);
    }

    .year-tab.active,
    .year-tab-all.active {
        color: var(--red);
        border-bottom-color: var(--red);
    }

    .month-chips-bar {
        display: flex;
        gap: 6px;
        padding: 12px 16px;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--border);
        background: #FFFAFB;
    }

    .month-chip {
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 20px;
        border: 1.5px solid var(--border);
        background: var(--bg);
        color: var(--txt-2);
        cursor: pointer;
        font-family: 'Sora', sans-serif;
        transition: all .12s;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .month-chip:hover {
        background: var(--red-pale);
        color: var(--red);
        border-color: var(--red-border);
    }

    .month-chip.active {
        background: var(--red);
        color: #fff;
        border-color: var(--red);
    }

    .month-chip .dot-ind {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
        opacity: .6;
        flex-shrink: 0;
    }

    .filter-row {
        display: flex;
        gap: 12px;
        padding: 12px 16px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-wrap {
        position: relative;
        flex: 1;
        min-width: 200px;
    }

    .search-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: var(--txt-3);
        pointer-events: none;
    }

    .filter-input,
    .filter-select {
        padding: 9px 12px;
        border: 1.5px solid var(--border);
        border-radius: 9px;
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        color: var(--txt-1);
        background: var(--bg);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        width: 100%;
    }

    .filter-input:focus,
    .filter-select:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, .08);
        background: #fff;
    }

    .search-wrap .filter-input {
        padding-left: 34px;
    }

    .filter-pills {
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
        padding: 0 16px 12px;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        background: var(--red-pale2);
        color: var(--red);
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        border: 1px solid var(--red-border);
    }

    .filter-pill button {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--red);
        display: flex;
        align-items: center;
        padding: 0;
        line-height: 1;
    }

    .filter-pill button svg {
        width: 12px;
        height: 12px;
    }

    .table-wrap {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(192, 32, 47, .06);
        position: relative;
    }

    /* Table loading overlay */
    .table-loading {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, .8);
        backdrop-filter: blur(2px);
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity .15s;
        border-radius: 14px;
    }

    .table-loading.show {
        opacity: 1;
        pointer-events: auto;
    }

    .table-loading .spinner {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 3px solid var(--red-border);
        border-top-color: var(--red);
        animation: spin .7s linear infinite;
    }

    .table-head {
        padding: 14px 20px;
        border-bottom: 1px solid var(--red-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #FFF5F6, #fff);
    }

    .table-head-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--txt-1);
    }

    .results-count {
        font-size: 12px;
        color: var(--txt-3);
        font-weight: 500;
    }

    .results-count strong {
        color: var(--txt-1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead tr {
        background: #FFF8F8;
        border-bottom: 1px solid var(--red-border);
    }

    thead th {
        padding: 11px 16px;
        text-align: left;
        font-size: 10.5px;
        font-weight: 700;
        color: var(--txt-3);
        text-transform: uppercase;
        letter-spacing: .08em;
        white-space: nowrap;
    }

    thead th:first-child {
        padding-left: 20px;
    }

    thead th.sortable {
        cursor: pointer;
        user-select: none;
    }

    thead th.sortable:hover {
        color: var(--red);
    }

    .sort-icon {
        display: inline-block;
        margin-left: 4px;
        opacity: .4;
        font-size: 10px;
    }

    thead th.sort-asc .sort-icon::after {
        content: '↑';
        opacity: 1;
    }

    thead th.sort-desc .sort-icon::after {
        content: '↓';
        opacity: 1;
    }

    thead th:not(.sort-asc):not(.sort-desc) .sort-icon::after {
        content: '↕';
    }

    tbody tr {
        border-bottom: 1px solid #FFF0F1;
        transition: background .1s;
        position: relative;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    tbody tr:hover {
        background: var(--red-pale);
    }

    tbody td {
        padding: 0;
        vertical-align: top;
    }

    .title-cell {
        padding: 0;
    }

    .title-cell-inner {
        padding: 13px 16px 6px 20px;
        display: flex;
        align-items: flex-start;
        gap: 13px;
    }

    .row-thumb {
        width: 48px;
        height: 48px;
        border-radius: 9px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1.5px solid var(--red-border);
    }

    .row-title-wrap {
        flex: 1;
        min-width: 0;
    }

    .row-title {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--txt-1);
        line-height: 1.35;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 340px;
    }

    .row-desc {
        font-size: 11.5px;
        color: var(--txt-3);
        margin-top: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 340px;
    }

    .row-actions {
        display: flex;
        align-items: center;
        gap: 2px;
        padding: 5px 16px 11px 20px;
        opacity: 0;
        transform: translateY(-5px);
        transition: opacity .15s, transform .15s;
        pointer-events: none;
    }

    tbody tr:hover .row-actions {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .row-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        font-size: 11.5px;
        font-weight: 600;
        border: 1.5px solid transparent;
        border-radius: 7px;
        cursor: pointer;
        font-family: 'Sora', sans-serif;
        background: none;
        transition: all .12s;
        white-space: nowrap;
    }

    .row-action-btn svg {
        width: 12px;
        height: 12px;
    }

    .row-action-btn.edit {
        color: var(--blue);
        border-color: var(--blue-border);
        background: var(--blue-bg);
    }

    .row-action-btn.edit:hover {
        background: #dbeafe;
        border-color: var(--blue);
    }

    .row-action-btn.preview-btn {
        color: #7c3aed;
        border-color: #e9d5ff;
        background: #f5f3ff;
    }

    .row-action-btn.preview-btn:hover {
        background: #ede9fe;
        border-color: #7c3aed;
    }

    .row-action-btn.delete {
        color: var(--red);
        border-color: var(--red-border);
        background: var(--red-pale);
    }

    .row-action-btn.delete:hover {
        background: var(--red-pale2);
        border-color: var(--red);
    }

    .row-action-btn.publish {
        color: var(--green);
        border-color: var(--green-border);
        background: var(--green-bg);
    }

    .row-action-btn.publish:hover {
        background: #dcfce7;
        border-color: var(--green);
    }

    .row-action-btn.unpublish {
        color: var(--amber);
        border-color: var(--amber-border);
        background: var(--amber-bg);
    }

    .row-action-btn.unpublish:hover {
        background: #fef3c7;
        border-color: var(--amber);
    }

    .action-sep {
        width: 1px;
        height: 14px;
        background: var(--border);
        margin: 0 2px;
        flex-shrink: 0;
    }

    .cell-pad {
        padding: 14px 16px;
        font-size: 13px;
        color: var(--txt-2);
        white-space: nowrap;
        vertical-align: middle;
    }

    .date-main {
        font-size: 13px;
        font-weight: 600;
        color: var(--txt-1);
    }

    .date-sub {
        font-size: 11px;
        color: var(--txt-3);
        margin-top: 1px;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .badge.published {
        background: var(--green-bg);
        color: var(--green);
        border: 1px solid var(--green-border);
    }

    .badge.published::before {
        background: var(--green);
    }

    .badge.draft {
        background: var(--amber-bg);
        color: var(--amber);
        border: 1px solid var(--amber-border);
    }

    .badge.draft::before {
        background: var(--amber);
    }

    .badge.scheduled {
        background: var(--blue-bg);
        color: var(--blue);
        border: 1px solid var(--blue-border);
    }

    .badge.scheduled::before {
        background: var(--blue);
    }

    .pagination {
        padding: 14px 20px;
        border-top: 1px solid var(--red-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        background: #FFF8F8;
    }

    .pagination-info {
        font-size: 12.5px;
        color: var(--txt-3);
    }

    .pagination-info strong {
        color: var(--txt-1);
    }

    .pagination-btns {
        display: flex;
        gap: 4px;
    }

    .pag-btn {
        min-width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        background: #fff;
        font-size: 12.5px;
        font-weight: 600;
        color: var(--txt-2);
        cursor: pointer;
        font-family: 'Sora', sans-serif;
        padding: 0 6px;
        transition: all .12s;
    }

    .pag-btn:hover {
        background: var(--red-pale);
        color: var(--red);
        border-color: var(--red-border);
    }

    .pag-btn.active {
        background: var(--red);
        color: #fff;
        border-color: var(--red);
    }

    .pag-btn:disabled {
        opacity: .35;
        cursor: not-allowed;
    }

    .empty-state {
        padding: 64px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 16px;
        color: var(--red-border);
    }

    .empty-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--txt-1);
        margin-bottom: 6px;
    }

    .empty-sub {
        font-size: 13px;
        color: var(--txt-3);
    }

    .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(20, 3, 6, .6);
        backdrop-filter: blur(5px);
        z-index: 200;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        pointer-events: none;
        transition: opacity .2s;
    }

    .modal-backdrop.show {
        opacity: 1;
        pointer-events: auto;
    }

    .modal {
        background: #fff;
        border-radius: 18px;
        width: 100%;
        max-width: 860px;
        box-shadow: 0 24px 64px rgba(192, 32, 47, .2);
        transform: translateY(20px) scale(.97);
        transition: transform .22s cubic-bezier(.34, 1.56, .64, 1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        max-height: 90vh;
    }

    .modal-backdrop.show .modal {
        transform: translateY(0) scale(1);
    }

    .modal-sm {
        max-width: 420px;
    }

    .modal-md {
        max-width: 640px;
    }

    .modal-lg {
        max-width: 860px;
    }

    .modal-header {
        padding: 18px 22px;
        border-bottom: 1px solid var(--red-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #FFF5F6, #fff);
        flex-shrink: 0;
    }

    .modal-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--txt-1);
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
        color: var(--txt-3);
        transition: all .12s;
    }

    .modal-close:hover {
        background: var(--red-pale2);
        color: var(--red);
    }

    .modal-body {
        padding: 22px;
        overflow-y: auto;
        flex: 1;
    }

    .modal-footer {
        padding: 16px 22px;
        border-top: 1px solid var(--red-border);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        background: #FFF8F8;
        flex-shrink: 0;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--txt-2);
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 7px;
    }

    .form-label .req {
        color: var(--red);
        margin-left: 2px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 10px 13px;
        border: 1.5px solid var(--border);
        border-radius: 9px;
        font-family: 'Sora', sans-serif;
        font-size: 13.5px;
        color: var(--txt-1);
        background: var(--bg);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(192, 32, 47, .08);
        background: #fff;
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    .form-hint {
        font-size: 11px;
        color: var(--txt-3);
        margin-top: 5px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media(max-width:520px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .upload-zone {
        border: 2px dashed var(--red-border);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        cursor: pointer;
        transition: all .15s;
        background: var(--bg);
        position: relative;
        overflow: hidden;
    }

    .upload-zone:hover {
        border-color: var(--red);
        background: var(--red-pale);
    }

    .upload-zone.has-image {
        padding: 0;
        border-style: solid;
    }

    .upload-zone input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-zone img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 10px;
        display: none;
    }

    .upload-zone.has-image img {
        display: block;
    }

    .upload-placeholder {
        pointer-events: none;
    }

    .upload-zone.has-image .upload-placeholder {
        display: none;
    }

    .upload-icon {
        width: 36px;
        height: 36px;
        margin: 0 auto 10px;
        color: var(--txt-3);
    }

    .upload-text {
        font-size: 13px;
        color: var(--txt-2);
        font-weight: 500;
    }

    .upload-hint-txt {
        font-size: 11px;
        color: var(--txt-3);
        margin-top: 4px;
    }

    .upload-change {
        position: absolute;
        bottom: 8px;
        right: 8px;
        z-index: 2;
        background: rgba(0, 0, 0, .6);
        color: #fff;
        border: none;
        border-radius: 7px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Sora', sans-serif;
        display: none;
    }

    .upload-zone.has-image .upload-change {
        display: block;
    }

    .char-counter {
        font-size: 11px;
        color: var(--txt-3);
        text-align: right;
        margin-top: 4px;
    }

    .char-counter.warn {
        color: var(--amber);
    }

    .char-counter.over {
        color: var(--red);
    }

    .schedule-field {
        overflow: hidden;
        max-height: 0;
        transition: max-height .25s ease, opacity .25s;
        opacity: 0;
    }

    .schedule-field.show {
        max-height: 100px;
        opacity: 1;
    }

    .rich-toolbar {
        display: flex;
        gap: 3px;
        padding: 8px 10px;
        border: 1.5px solid var(--border);
        border-bottom: none;
        border-radius: 9px 9px 0 0;
        background: var(--bg);
        flex-wrap: wrap;
    }

    .rich-toolbar+.form-textarea,
    .rich-toolbar+[contenteditable] {
        border-radius: 0 0 9px 9px;
    }

    .tb-btn {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: none;
        border-radius: 6px;
        cursor: pointer;
        color: var(--txt-2);
        font-size: 12px;
        font-weight: 700;
        transition: all .1s;
    }

    .tb-btn:hover {
        background: var(--red-pale);
        color: var(--red);
    }

    .tb-sep {
        width: 1px;
        height: 20px;
        background: var(--border);
        margin: 5px 3px;
        align-self: center;
    }

    #previewModalBg {
        z-index: 400;
        padding: 0;
    }

    #previewModalBg>.modal {
        max-width: 100%;
        width: 100%;
        height: 100vh;
        max-height: 100vh;
        border-radius: 0;
    }

    .preview-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        height: 54px;
        background: #110204;
        border-bottom: 1px solid rgba(255, 255, 255, .07);
        flex-shrink: 0;
        gap: 12px;
    }

    .preview-topbar-left {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        flex: 1;
    }

    .preview-topbar-badge {
        background: rgba(192, 32, 47, .35);
        color: #ff9aa0;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 5px;
        border: 1px solid rgba(192, 32, 47, .4);
        white-space: nowrap;
        text-transform: uppercase;
    }

    .preview-topbar-name {
        font-size: 13.5px;
        font-weight: 600;
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 360px;
    }

    .preview-device-group {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .device-btn {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        border-radius: 7px;
        border: 1.5px solid rgba(255, 255, 255, .12);
        background: transparent;
        font-size: 12px;
        font-weight: 600;
        color: rgba(255, 255, 255, .45);
        cursor: pointer;
        transition: all .12s;
    }

    .device-btn svg {
        width: 14px;
        height: 14px;
    }

    .device-btn.active {
        background: rgba(192, 32, 47, .35);
        color: #fff;
        border-color: rgba(192, 32, 47, .7);
    }

    .preview-topbar-right {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-shrink: 0;
    }

    .pv-btn-pub {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 7px 16px;
        border-radius: 8px;
        border: none;
        background: var(--red);
        color: #fff;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all .12s;
    }

    .pv-btn-close {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 7px 13px;
        border-radius: 8px;
        border: 1.5px solid rgba(255, 255, 255, .14);
        background: rgba(255, 255, 255, .06);
        color: rgba(255, 255, 255, .65);
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all .12s;
    }

    .preview-scroll-area {
        flex: 1;
        overflow: auto;
        background: #1a0204;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 24px 24px 40px;
    }

    .browser-shell {
        width: 100%;
        transition: max-width .3s cubic-bezier(.4, 0, .2, 1);
    }

    .browser-shell.desktop {
        max-width: 1400px;
    }

    .browser-shell.tablet {
        max-width: 768px;
    }

    .browser-shell.mobile {
        max-width: 390px;
    }

    .browser-chrome-bar {
        background: #2a0507;
        border-radius: 12px 12px 0 0;
        padding: 10px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, .05);
    }

    .b-dots {
        display: flex;
        gap: 5px;
    }

    .b-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
    }

    .b-url {
        flex: 1;
        background: rgba(255, 255, 255, .07);
        border-radius: 6px;
        padding: 5px 12px;
        font-size: 11.5px;
        color: rgba(255, 255, 255, .35);
        font-family: 'JetBrains Mono', monospace;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .browser-page {
        background: #fff;
        border-radius: 0 0 12px 12px;
        overflow: hidden;
        box-shadow: 0 28px 70px rgba(0, 0, 0, .5);
    }

    .pub-nav {
        background: linear-gradient(90deg, #8C111E, #C0202F);
        padding: 0 48px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 60px;
    }

    .pub-nav.tablet {
        padding: 0 32px;
    }

    .pub-nav.mobile {
        padding: 0 16px;
        height: 52px;
    }

    .pub-logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pub-logo-img {
        width: 34px;
        height: 34px;
        border-radius: 7px;
        border: 1.5px solid rgba(255, 255, 255, .3);
        object-fit: cover;
    }

    .pub-logo-text {
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
    }

    .pub-logo-sub {
        font-size: 9.5px;
        color: rgba(255, 255, 255, .55);
        margin-top: 1px;
    }

    .pub-links {
        display: flex;
        gap: 20px;
    }

    .pub-links.hidden {
        display: none;
    }

    .pub-link {
        font-size: 12.5px;
        color: rgba(255, 255, 255, .7);
        text-decoration: none;
        font-weight: 500;
        padding: 4px 0;
        border-bottom: 2px solid transparent;
        transition: color .12s, border-color .12s;
    }

    .pub-link.active {
        color: #fff;
        border-bottom-color: rgba(255, 255, 255, .6);
    }

    .pub-breadcrumb {
        background: #FFF8F8;
        border-bottom: 1px solid var(--border);
        padding: 11px 48px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--txt-3);
    }

    .pub-breadcrumb.tablet {
        padding: 10px 32px;
    }

    .pub-breadcrumb.mobile {
        padding: 9px 16px;
    }

    .pub-bc-link {
        color: var(--red);
        text-decoration: none;
        font-weight: 600;
    }

    .pub-article {
        padding: 48px 48px 72px;
    }

    .pub-article-inner {
        max-width: 760px;
        margin: 0 auto;
    }

    .pub-cat {
        display: inline-block;
        padding: 4px 12px;
        background: var(--red-pale2);
        color: var(--red);
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .pub-title {
        font-size: 34px;
        font-weight: 700;
        color: var(--txt-1);
        line-height: 1.28;
        margin-bottom: 12px;
    }

    .pub-meta {
        display: flex;
        align-items: center;
        gap: 18px;
        font-size: 12.5px;
        color: var(--txt-3);
        flex-wrap: wrap;
        padding-bottom: 22px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 28px;
    }

    .pub-feat-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 32px;
    }

    .pub-body {
        font-size: 16.5px;
        color: #374151;
        line-height: 1.85;
    }

    .pub-related {
        background: var(--bg);
        border-top: 1px solid var(--border);
        padding: 32px 48px;
    }

    .pub-related-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .pub-related-card {
        background: #fff;
        border-radius: 10px;
        padding: 14px;
        border: 1px solid var(--red-border);
    }

    .pub-footer {
        background: #110204;
        padding: 20px 48px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .pub-footer-text {
        font-size: 11px;
        color: rgba(255, 255, 255, .28);
    }

    .delete-modal-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #FFF0F1;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .delete-modal-icon svg {
        width: 26px;
        height: 26px;
        color: var(--red);
    }

    .delete-modal-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--txt-1);
        text-align: center;
        margin-bottom: 8px;
    }

    .delete-modal-sub {
        font-size: 13.5px;
        color: var(--txt-3);
        text-align: center;
        line-height: 1.55;
    }

    .delete-modal-name {
        font-weight: 700;
        color: var(--txt-1);
    }

    #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    }

    .toast {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 18px;
        border-radius: 12px;
        min-width: 280px;
        max-width: 380px;
        background: #fff;
        border: 1.5px solid var(--border);
        box-shadow: 0 8px 28px rgba(0, 0, 0, .12);
        font-size: 13.5px;
        font-weight: 500;
        color: var(--txt-1);
        pointer-events: auto;
        animation: toastIn .28s cubic-bezier(.34, 1.56, .64, 1) forwards;
    }

    .toast.hiding {
        animation: toastOut .2s ease forwards;
    }

    .toast-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .toast.success .toast-icon {
        background: var(--green-bg);
        color: var(--green);
    }

    .toast.error .toast-icon {
        background: var(--red-pale);
        color: var(--red);
    }

    .toast.info .toast-icon {
        background: var(--blue-bg);
        color: var(--blue);
    }

    .toast-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        color: var(--txt-3);
    }

    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateX(40px) scale(.92);
        }

        to {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }

    @keyframes toastOut {
        to {
            opacity: 0;
            transform: translateX(40px) scale(.92);
        }
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div id="toast-container"></div>

<div class="page-header">
    <div>
        <h1 class="page-title">Announcements</h1>
        <p class="page-sub">Manage all announcements and their publication status</p>
    </div>
    <div class="header-actions">
        <button class="btn-ghost" onclick="exportData()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="15" height="15">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Export
        </button>
        <button class="btn-primary" onclick="openCreateModal()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            New Announcement
        </button>
    </div>
</div>

<div class="stats-row">
    <div class="stat-card" id="statAll" onclick="filterByStatus('')">
        <div class="stat-icon" style="background:#FFF0F1"><svg fill="none" stroke="#C0202F" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
            </svg></div>
        <div>
            <div class="stat-val" id="svTotal">0</div>
            <div class="stat-lbl">All</div>
        </div>
    </div>
    <div class="stat-card" id="statPub" onclick="filterByStatus('published')">
        <div class="stat-icon" style="background:var(--green-bg)"><svg fill="none" stroke="var(--green)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></div>
        <div>
            <div class="stat-val" id="svPub">0</div>
            <div class="stat-lbl">Published</div>
        </div>
    </div>
    <div class="stat-card" id="statDra" onclick="filterByStatus('draft')">
        <div class="stat-icon" style="background:var(--amber-bg)"><svg fill="none" stroke="var(--amber)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6M3 17.25V21h3.75l9.06-9.06-3.75-3.75L3 17.25z" />
            </svg></div>
        <div>
            <div class="stat-val" id="svDra">0</div>
            <div class="stat-lbl">Drafts</div>
        </div>
    </div>
    <div class="stat-card" id="statSch" onclick="filterByStatus('scheduled')">
        <div class="stat-icon" style="background:var(--blue-bg)"><svg fill="none" stroke="var(--blue)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></div>
        <div>
            <div class="stat-val" id="svSch">0</div>
            <div class="stat-lbl">Scheduled</div>
        </div>
    </div>
</div>

<div class="time-filter-wrap">
    <div class="year-tabs-bar" id="yearTabsBar">
        <button class="year-tab-all active" data-year="" onclick="setYearFilter('')">All Years</button>
    </div>
    <div class="month-chips-bar" id="monthChipsBar"></div>
    <div class="filter-row">
        <div class="search-wrap">
            <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" id="filterSearch" class="filter-input" placeholder="Search by title or author…" oninput="handleSearchInput()">
        </div>
        <div style="min-width:150px;">
            <select id="filterStatus" class="filter-select" onchange="applyFilters()">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="scheduled">Scheduled</option>
            </select>
        </div>
        <button class="btn-ghost" onclick="clearAllFilters()" style="flex-shrink:0;">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Clear
        </button>
    </div>
    <div class="filter-pills" id="filterPills"></div>
</div>

<div class="table-wrap" id="tableWrap">
    <div class="table-loading" id="tableLoading">
        <div class="spinner"></div>
    </div>
    <div class="table-head">
        <div class="table-head-title" id="tableHeadTitle">All Announcements</div>
        <span class="results-count" id="resultsCount"></span>
    </div>
    <div style="overflow-x:auto;">
        <table id="announcementsTable">
            <thead>
                <tr>
                    <th style="width:44%">Title</th>
                    <th class="sortable" id="thDate" onclick="toggleSort()">Date Posted<span class="sort-icon"></span></th>
                    <th>Status</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody id="announcementsBody"></tbody>
        </table>
    </div>
    <div id="emptyState" class="empty-state" style="display:none;">
        <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <div class="empty-title">No announcements found</div>
        <div class="empty-sub">Try adjusting your filters or create a new announcement.</div>
    </div>
    <div class="pagination" id="paginationWrap">
        <div class="pagination-info" id="paginationInfo"></div>
        <div class="pagination-btns" id="paginationBtns"></div>
    </div>
</div>

<!-- CREATE/EDIT MODAL -->
<div class="modal-backdrop" id="createModalBg">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h3 id="createModalTitle">New Announcement</h3>
            <button class="modal-close" onclick="closeCreateModal()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Title <span class="req">*</span></label>
                <input type="text" id="fTitle" class="form-input" placeholder="e.g. Office Holiday Schedule Update" maxlength="120" oninput="updateCharCount(this,'titleCount',120)">
                <div class="char-counter" id="titleCount">0 / 120</div>
            </div>
            <div class="form-group">
                <label class="form-label">Content <span class="req">*</span></label>
                <div class="rich-toolbar">
                    <button class="tb-btn" type="button" onclick="formatText('bold')"><b>B</b></button>
                    <button class="tb-btn" type="button" onclick="formatText('italic')"><i>I</i></button>
                    <button class="tb-btn" type="button" onclick="formatText('underline')"><u>U</u></button>
                    <div class="tb-sep"></div>
                    <button class="tb-btn" type="button" onclick="formatText('insertUnorderedList')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg></button>
                    <button class="tb-btn" type="button" onclick="formatText('removeFormat')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg></button>
                </div>
                <div id="fContent" contenteditable="true" class="form-textarea" style="min-height:130px;outline:none;border-radius:0 0 9px 9px;border:1.5px solid var(--border);padding:10px 13px;font-family:'Sora',sans-serif;font-size:13.5px;line-height:1.6;background:var(--bg);"></div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Featured Image</label>
                    <div class="upload-zone" id="uploadZone">
                        <input type="file" id="fImage" accept="image/*" onchange="previewImageUpload(event)">
                        <div class="upload-placeholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div class="upload-text">Click or drag to upload</div>
                            <div class="upload-hint-txt">PNG, JPG up to 5MB · 1200×630 recommended</div>
                        </div>
                        <img id="fImagePreview" alt="Preview">
                        <button type="button" class="upload-change" onclick="document.getElementById('fImage').click();event.stopPropagation()">Change</button>
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">Status <span class="req">*</span></label>
                        <select id="fStatus" class="form-select" onchange="onStatusChange()">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                        <div class="form-hint">Set <em>Published</em> to go live immediately.</div>
                    </div>
                    <div class="schedule-field" id="scheduleField">
                        <label class="form-label">Publish Date &amp; Time <span class="req">*</span></label>
                        <input type="datetime-local" id="fSchedule" class="form-input">
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">Author</label>
                        <input type="text" id="fAuthor" class="form-input" value="{{ Auth::user()->first_name ?? 'Editor' }}" placeholder="Author name">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-ghost" onclick="closeCreateModal()">Cancel</button>
            <button class="btn-ghost" onclick="openPreviewFromForm()" style="color:#7c3aed;border-color:#e9d5ff;background:#f5f3ff;">Preview</button>
            <button class="btn-primary" id="savBtn" onclick="saveAnnouncement()">Save Announcement</button>
        </div>
    </div>
</div>

<!-- PREVIEW MODAL -->
<div class="modal-backdrop" id="previewModalBg">
    <div class="modal" style="border-radius:0;max-width:100%;width:100%;height:100vh;max-height:100vh;">
        <div class="preview-topbar">
            <div class="preview-topbar-left"><span class="preview-topbar-badge">Preview</span><span class="preview-topbar-name" id="pvName">Announcement Title</span></div>
            <div class="preview-device-group">
                <button class="device-btn active" onclick="setDevice('desktop')">Desktop</button>
                <button class="device-btn" onclick="setDevice('tablet')">Tablet</button>
                <button class="device-btn" onclick="setDevice('mobile')">Mobile</button>
            </div>
            <div class="preview-topbar-right">
                <button class="pv-btn-pub" onclick="closePreviewAndPublish()">Publish Now</button>
                <button class="pv-btn-close" onclick="closePreviewModal()">Close</button>
            </div>
        </div>
        <div class="preview-scroll-area">
            <div class="browser-shell desktop" id="browserShell">
                <div class="browser-chrome-bar">
                    <div class="b-dots">
                        <div class="b-dot" style="background:#ff5f57"></div>
                        <div class="b-dot" style="background:#febc2e"></div>
                        <div class="b-dot" style="background:#28c840"></div>
                    </div>
                    <div class="b-url"><span class="b-url-secure">🔒</span><span id="pvUrl">pudho-laguna.gov.ph/announcements/…</span></div>
                </div>
                <div class="browser-page">
                    <div class="pub-nav" id="pvNav">
                        <div class="pub-logo"><img class="pub-logo-img" src="{{ asset('build/assets/images/logo-pudho.jpg') }}" onerror="this.src='https://via.placeholder.com/34/fff/C0202F?text=P'">
                            <div>
                                <div class="pub-logo-text">LAGUNA PUDHO</div>
                                <div class="pub-logo-sub">Urban Development & Housing</div>
                            </div>
                        </div>
                        <div class="pub-links" id="pvLinks"><a class="pub-link" href="#">Home</a><a class="pub-link active" href="#">Announcements</a><a class="pub-link" href="#">Services</a><a class="pub-link" href="#">About</a><a class="pub-link" href="#">Contact</a></div>
                    </div>
                    <div class="pub-breadcrumb" id="pvBreadcrumb"><a class="pub-bc-link" href="#">Home</a><span class="pub-bc-sep">›</span><a class="pub-bc-link" href="#">Announcements</a><span class="pub-bc-sep">›</span><span id="pvBcTitle" style="color:var(--txt-3)">Loading…</span></div>
                    <div class="pub-article" id="pvArticle">
                        <div class="pub-article-inner" id="pvArticleInner">
                            <span class="pub-cat">Announcement</span>
                            <h1 class="pub-title" id="pvTitle">Announcement Title</h1>
                            <div class="pub-meta">
                                <div class="pub-meta-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="13" height="13">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg><span id="pvAuthor">Editor</span></div>
                                <div class="pub-meta-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="13" height="13">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg><span id="pvDate">March 10, 2026</span></div>
                            </div>
                            <img id="pvFeatImg" class="pub-feat-img" src="" alt="Featured image" style="display:none;">
                            <div class="pub-body" id="pvBody">
                                <p>Your announcement content will appear here.</p>
                            </div>
                        </div>
                    </div>
                    <div class="pub-related" id="pvRelated">
                        <div class="pub-related-title">More Announcements</div>
                        <div class="pub-related-cards" id="pvRelatedCards"></div>
                    </div>
                    <div class="pub-footer" id="pvFooter"><span class="pub-footer-text">© 2026 PUDHO Laguna — Province of Laguna Urban Development & Housing Office</span><span class="pub-footer-text">All rights reserved.</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal-backdrop" id="deleteModalBg">
    <div class="modal modal-sm">
        <div class="modal-header">
            <h3>Delete Announcement</h3><button class="modal-close" onclick="closeDeleteModal()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg></button>
        </div>
        <div class="modal-body" style="text-align:center;padding:28px 24px;">
            <div class="delete-modal-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="26" height="26">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg></div>
            <div class="delete-modal-title">Are you sure?</div>
            <div class="delete-modal-sub">Permanently delete<br><span class="delete-modal-name" id="deleteTargetName">"Announcement"</span>?<br>This cannot be undone.</div>
        </div>
        <div class="modal-footer" style="justify-content:center;gap:12px;"><button class="btn-ghost" onclick="closeDeleteModal()">Cancel</button><button class="btn-primary" onclick="confirmDelete()" style="background:#dc2626;">Yes, Delete</button></div>
    </div>
</div>

<script>
    // Global variables
    let currentPage = 1;
    let currentSort = 'desc';
    let currentFilters = {
        status: '',
        year: '',
        month: '',
        search: ''
    };
    let allAnnouncements = [];
    let deleteId = null;
    let editId = null;
    let searchDebounceTimer;
    const ITEMS_PER_PAGE = 5; // Limit to 5 items per page

    // Helper functions
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function showToast(type, msg) {
        const container = document.getElementById('toast-container');
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.innerHTML = `<div class="toast-icon">${type === 'success' ? '✓' : type === 'error' ? '✗' : 'ℹ'}</div><span>${msg}</span><button class="toast-close" onclick="this.parentElement.remove()">✕</button>`;
        container.appendChild(t);
        setTimeout(() => {
            t.classList.add('hiding');
            setTimeout(() => t.remove(), 300);
        }, 4000);
    }

    function showTableLoading() {
        document.getElementById('tableLoading').classList.add('show');
    }

    function hideTableLoading() {
        document.getElementById('tableLoading').classList.remove('show');
    }

    function showModal(id) {
        document.getElementById(id).classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function hideModal(id) {
        document.getElementById(id).classList.remove('show');
        document.body.style.overflow = '';
    }

    function getCSRFToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // Load announcements from API
    async function loadAnnouncements() {
        showTableLoading();
        try {
            const response = await fetch('/editor/announcements/data', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const result = await response.json();

            if (result.success) {
                allAnnouncements = result.data;

                // Update stats
                document.getElementById('svTotal').textContent = result.stats.total;
                document.getElementById('svPub').textContent = result.stats.published;
                document.getElementById('svDra').textContent = result.stats.draft;
                document.getElementById('svSch').textContent = result.stats.scheduled;

                // Build year filter
                buildYearFilter();

                // Apply current filters
                applyFilters();
            } else {
                showToast('error', 'Failed to load announcements');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('error', 'Failed to load announcements');
        } finally {
            hideTableLoading();
        }
    }

    // Build year filter from data
    function buildYearFilter() {
        const years = [...new Set(allAnnouncements.map(a => new Date(a.dateObj).getFullYear()))].sort((a, b) => b - a);
        const yearBar = document.getElementById('yearTabsBar');
        const allBtn = yearBar.querySelector('.year-tab-all');

        // Clear existing years
        const existingYears = yearBar.querySelectorAll('.year-tab:not(.year-tab-all)');
        existingYears.forEach(btn => btn.remove());

        // Add year buttons
        years.forEach(year => {
            const btn = document.createElement('button');
            btn.className = 'year-tab';
            if (currentFilters.year == year) btn.classList.add('active');
            btn.textContent = year;
            btn.onclick = () => setYearFilter(year);
            yearBar.appendChild(btn);
        });

        // Update All Years button active state
        if (!currentFilters.year) {
            allBtn.classList.add('active');
        } else {
            allBtn.classList.remove('active');
        }
    }

    // Build month filter
    function buildMonthFilter() {
        if (!currentFilters.year) {
            document.getElementById('monthChipsBar').style.display = 'none';
            return;
        }

        document.getElementById('monthChipsBar').style.display = 'flex';
        const monthBar = document.getElementById('monthChipsBar');
        monthBar.innerHTML = '';

        const months = allAnnouncements
            .filter(a => new Date(a.dateObj).getFullYear() == currentFilters.year)
            .map(a => new Date(a.dateObj).getMonth())
            .filter((v, i, a) => a.indexOf(v) === i)
            .sort((a, b) => a - b);

        months.forEach(month => {
            const chip = document.createElement('button');
            chip.className = 'month-chip';
            if (currentFilters.month == month) chip.classList.add('active');
            chip.innerHTML = `<span class="dot-ind"></span>${getMonthName(month)}`;
            chip.onclick = () => setMonthFilter(month);
            monthBar.appendChild(chip);
        });

        if (months.length === 0) {
            const noneMsg = document.createElement('div');
            noneMsg.textContent = 'No announcements for this year';
            noneMsg.style.padding = '5px 14px';
            noneMsg.style.color = 'var(--txt-3)';
            monthBar.appendChild(noneMsg);
        }
    }

    function getMonthName(month) {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return months[month];
    }

    // Filter functions
    function filterByStatus(status) {
        currentFilters.status = status;
        document.getElementById('filterStatus').value = status;
        currentPage = 1;
        applyFilters();
        updateActiveStatCard(status);
    }

    function updateActiveStatCard(status) {
        const cards = ['statAll', 'statPub', 'statDra', 'statSch'];
        cards.forEach(card => {
            document.getElementById(card).classList.remove('active-stat');
        });

        if (!status) {
            document.getElementById('statAll').classList.add('active-stat');
        } else if (status === 'published') {
            document.getElementById('statPub').classList.add('active-stat');
        } else if (status === 'draft') {
            document.getElementById('statDra').classList.add('active-stat');
        } else if (status === 'scheduled') {
            document.getElementById('statSch').classList.add('active-stat');
        }
    }

    function setYearFilter(year) {
        currentFilters.year = year;
        currentFilters.month = '';
        currentPage = 1;
        buildYearFilter();
        buildMonthFilter();
        applyFilters();
    }

    function setMonthFilter(month) {
        currentFilters.month = month;
        currentPage = 1;
        buildMonthFilter();
        applyFilters();
    }

    function toggleSort() {
        currentSort = currentSort === 'desc' ? 'asc' : 'desc';
        const th = document.getElementById('thDate');
        th.classList.remove('sort-asc', 'sort-desc');
        th.classList.add(currentSort === 'desc' ? 'sort-desc' : 'sort-asc');
        applyFilters();
    }

    function applyFilters() {
        // Get filter values
        currentFilters.status = document.getElementById('filterStatus').value;
        currentFilters.search = document.getElementById('filterSearch').value;

        // Apply filters to data
        let filtered = [...allAnnouncements];

        // Status filter
        if (currentFilters.status) {
            filtered = filtered.filter(a => a.status === currentFilters.status);
        }

        // Year filter
        if (currentFilters.year) {
            filtered = filtered.filter(a => new Date(a.dateObj).getFullYear() == currentFilters.year);
        }

        // Month filter
        if (currentFilters.month !== '') {
            filtered = filtered.filter(a => new Date(a.dateObj).getMonth() == currentFilters.month);
        }

        // Search filter
        if (currentFilters.search) {
            const searchLower = currentFilters.search.toLowerCase();
            filtered = filtered.filter(a =>
                a.title.toLowerCase().includes(searchLower) ||
                a.author.toLowerCase().includes(searchLower)
            );
        }

        // Sort
        filtered.sort((a, b) => {
            const dateA = new Date(a.dateObj);
            const dateB = new Date(b.dateObj);
            return currentSort === 'desc' ? dateB - dateA : dateA - dateB;
        });

        // Render table with pagination
        renderTable(filtered);
        updateFilterPills();
    }

    function renderTable(announcements) {
        const tbody = document.getElementById('announcementsBody');
        const emptyState = document.getElementById('emptyState');
        const table = document.getElementById('announcementsTable');
        const pagination = document.getElementById('paginationWrap');

        if (announcements.length === 0) {
            emptyState.style.display = 'block';
            table.style.display = 'none';
            pagination.style.display = 'none';
            document.getElementById('resultsCount').innerHTML = 'Showing <strong>0</strong> of <strong>0</strong>';
            return;
        }

        emptyState.style.display = 'none';
        table.style.display = '';
        pagination.style.display = '';

        // Pagination with 5 items per page
        const totalPages = Math.ceil(announcements.length / ITEMS_PER_PAGE);

        // Ensure current page is valid
        if (currentPage > totalPages) {
            currentPage = totalPages;
        }
        if (currentPage < 1) {
            currentPage = 1;
        }

        const start = (currentPage - 1) * ITEMS_PER_PAGE;
        const end = start + ITEMS_PER_PAGE;
        const pageItems = announcements.slice(start, end);

        // Update results count
        document.getElementById('resultsCount').innerHTML = `Showing <strong>${start + 1}–${Math.min(end, announcements.length)}</strong> of <strong>${announcements.length}</strong>`;

        // Render rows
        tbody.innerHTML = '';
        pageItems.forEach(a => {
            const row = tbody.insertRow();
            const dateObj = new Date(a.dateObj);
            const statusClass = a.status;
            const statusText = a.status.charAt(0).toUpperCase() + a.status.slice(1);
            const thumb = a.img || `https://via.placeholder.com/48x48/FFECEE/C0202F?text=${a.title.charAt(0)}`;

            row.innerHTML = `
                <td class="title-cell">
                    <div class="title-cell-inner">
                        <img class="row-thumb" src="${thumb}" alt="">
                        <div class="row-title-wrap">
                            <div class="row-title">${escapeHtml(a.title)}</div>
                            <div class="row-desc">${escapeHtml(a.desc)}</div>
                        </div>
                    </div>
                    <div class="row-actions">
                        <button class="row-action-btn edit" onclick="openEditModal(${a.id})">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="12" height="12">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6M3 17.25V21h3.75l9.06-9.06-3.75-3.75L3 17.25z"/>
                            </svg>
                            Edit
                        </button>
                        <div class="action-sep"></div>
                        <button class="row-action-btn preview-btn" onclick="openPreviewModal(${a.id})">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="12" height="12">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Preview
                        </button>
                        <div class="action-sep"></div>
                        ${a.status === 'published' 
                            ? `<button class="row-action-btn unpublish" onclick="toggleStatus(${a.id})">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="12" height="12">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                                Unpublish
                            </button>`
                            : `<button class="row-action-btn publish" onclick="toggleStatus(${a.id})">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="12" height="12">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Publish
                            </button>`
                        }
                        <div class="action-sep"></div>
                        <button class="row-action-btn delete" onclick="openDeleteModal(${a.id}, '${escapeHtml(a.title)}')">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="12" height="12">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </button>
                    </div>
                </td>
                <td class="cell-pad">
                    <div class="date-main">${dateObj.getDate()} ${getMonthName(dateObj.getMonth())}</div>
                    <div class="date-sub">${dateObj.getFullYear()}</div>
                </td>
                <td class="cell-pad"><span class="badge ${statusClass}">${statusText}</span></td>
                <td class="cell-pad">${escapeHtml(a.author)}</td>
            `;
        });

        // Render pagination
        renderPagination(currentPage, totalPages, announcements.length);
    }

    function renderPagination(current, total, totalItems) {
        const container = document.getElementById('paginationBtns');
        container.innerHTML = '';

        // Previous button
        const prevBtn = document.createElement('button');
        prevBtn.className = 'pag-btn';
        prevBtn.textContent = '←';
        prevBtn.disabled = current === 1;
        prevBtn.onclick = () => {
            if (current > 1) {
                currentPage--;
                applyFilters();
            }
        };
        container.appendChild(prevBtn);

        // Page numbers - show limited pages
        const startPage = Math.max(1, current - 2);
        const endPage = Math.min(total, current + 2);

        if (startPage > 1) {
            const firstBtn = document.createElement('button');
            firstBtn.className = 'pag-btn';
            firstBtn.textContent = '1';
            firstBtn.onclick = () => {
                currentPage = 1;
                applyFilters();
            };
            container.appendChild(firstBtn);

            if (startPage > 2) {
                const dots = document.createElement('span');
                dots.className = 'pag-btn';
                dots.textContent = '...';
                dots.style.cursor = 'default';
                container.appendChild(dots);
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.className = 'pag-btn';
            if (i === current) pageBtn.classList.add('active');
            pageBtn.textContent = i;
            pageBtn.onclick = () => {
                currentPage = i;
                applyFilters();
            };
            container.appendChild(pageBtn);
        }

        if (endPage < total) {
            if (endPage < total - 1) {
                const dots = document.createElement('span');
                dots.className = 'pag-btn';
                dots.textContent = '...';
                dots.style.cursor = 'default';
                container.appendChild(dots);
            }

            const lastBtn = document.createElement('button');
            lastBtn.className = 'pag-btn';
            lastBtn.textContent = total;
            lastBtn.onclick = () => {
                currentPage = total;
                applyFilters();
            };
            container.appendChild(lastBtn);
        }

        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.className = 'pag-btn';
        nextBtn.textContent = '→';
        nextBtn.disabled = current === total;
        nextBtn.onclick = () => {
            if (current < total) {
                currentPage++;
                applyFilters();
            }
        };
        container.appendChild(nextBtn);

        // Update pagination info
        const startItem = (current - 1) * ITEMS_PER_PAGE + 1;
        const endItem = Math.min(current * ITEMS_PER_PAGE, totalItems);
        document.getElementById('paginationInfo').innerHTML = `Showing ${startItem} to ${endItem} of ${totalItems} entries`;
    }

    function updateFilterPills() {
        const pillsContainer = document.getElementById('filterPills');
        pillsContainer.innerHTML = '';

        const activeFilters = [];

        if (currentFilters.status) {
            activeFilters.push({
                label: `Status: ${currentFilters.status}`,
                type: 'status'
            });
        }
        if (currentFilters.year) {
            activeFilters.push({
                label: `Year: ${currentFilters.year}`,
                type: 'year'
            });
        }
        if (currentFilters.month !== '') {
            activeFilters.push({
                label: `Month: ${getMonthName(currentFilters.month)}`,
                type: 'month'
            });
        }
        if (currentFilters.search) {
            activeFilters.push({
                label: `Search: ${currentFilters.search}`,
                type: 'search'
            });
        }

        if (activeFilters.length === 0) {
            pillsContainer.style.display = 'none';
            return;
        }

        pillsContainer.style.display = 'flex';
        activeFilters.forEach(filter => {
            const pill = document.createElement('div');
            pill.className = 'filter-pill';
            pill.innerHTML = `
                ${filter.label}
                <button onclick="removeFilter('${filter.type}')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
            pillsContainer.appendChild(pill);
        });
    }

    function removeFilter(type) {
        switch (type) {
            case 'status':
                currentFilters.status = '';
                document.getElementById('filterStatus').value = '';
                updateActiveStatCard('');
                break;
            case 'year':
                currentFilters.year = '';
                buildYearFilter();
                buildMonthFilter();
                break;
            case 'month':
                currentFilters.month = '';
                buildMonthFilter();
                break;
            case 'search':
                currentFilters.search = '';
                document.getElementById('filterSearch').value = '';
                break;
        }
        currentPage = 1;
        applyFilters();
    }

    function clearAllFilters() {
        currentFilters = {
            status: '',
            year: '',
            month: '',
            search: ''
        };
        document.getElementById('filterStatus').value = '';
        document.getElementById('filterSearch').value = '';
        currentPage = 1;
        updateActiveStatCard('');
        buildYearFilter();
        buildMonthFilter();
        applyFilters();
    }

    function handleSearchInput() {
        clearTimeout(searchDebounceTimer);
        searchDebounceTimer = setTimeout(() => {
            currentPage = 1;
            applyFilters();
        }, 300);
    }

    // Modal functions
    function openCreateModal() {
        editId = null;
        document.getElementById('createModalTitle').textContent = 'New Announcement';
        document.getElementById('fTitle').value = '';
        document.getElementById('fContent').innerHTML = '';
        document.getElementById('fAuthor').value = '{{ Auth::user()->first_name ?? '
        Editor ' }}';
        document.getElementById('fStatus').value = 'draft';
        document.getElementById('fSchedule').value = '';
        document.getElementById('scheduleField').classList.remove('show');
        const uploadZone = document.getElementById('uploadZone');
        uploadZone.classList.remove('has-image');
        document.getElementById('fImagePreview').src = '';
        document.getElementById('fImage').value = '';
        updateCharCount(document.getElementById('fTitle'), 'titleCount', 120);
        showModal('createModalBg');
    }

    function closeCreateModal() {
        hideModal('createModalBg');
        editId = null;
    }

    async function openEditModal(id) {
        showTableLoading();
        try {
            const response = await fetch(`/editor/announcements/${id}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const result = await response.json();
            if (result.success) {
                editId = id;
                document.getElementById('createModalTitle').textContent = 'Edit Announcement';
                document.getElementById('fTitle').value = result.data.title;
                document.getElementById('fContent').innerHTML = result.data.content;
                document.getElementById('fAuthor').value = result.data.author;
                document.getElementById('fStatus').value = result.data.status;

                // Handle schedule date
                let scheduleDate = result.data.scheduled_at || result.data.scheduled_date || result.data.publish_date;
                if (scheduleDate) {
                    const date = new Date(scheduleDate);
                    if (!isNaN(date.getTime())) {
                        const formattedDate = date.toISOString().slice(0, 16);
                        document.getElementById('fSchedule').value = formattedDate;
                    }
                }

                // Show/hide schedule field based on status
                if (result.data.status === 'scheduled') {
                    const scheduleField = document.getElementById('scheduleField');
                    scheduleField.classList.add('show');

                    const tomorrow = new Date();
                    tomorrow.setDate(tomorrow.getDate() + 1);
                    tomorrow.setMinutes(0);
                    document.getElementById('fSchedule').min = tomorrow.toISOString().slice(0, 16);
                } else {
                    document.getElementById('scheduleField').classList.remove('show');
                }

                // Handle image
                const imagePath = result.data.image_path || result.data.img;
                if (imagePath) {
                    const uploadZone = document.getElementById('uploadZone');
                    uploadZone.classList.add('has-image');
                    document.getElementById('fImagePreview').src = imagePath;
                }

                updateCharCount(document.getElementById('fTitle'), 'titleCount', 120);
                showModal('createModalBg');
            } else {
                showToast('error', 'Failed to load announcement');
            }
        } catch (error) {
            console.error('Error loading announcement:', error);
            showToast('error', 'Failed to load announcement');
        } finally {
            hideTableLoading();
        }
    }

    async function saveAnnouncement() {
        const title = document.getElementById('fTitle').value.trim();
        const content = document.getElementById('fContent').innerHTML;
        const author = document.getElementById('fAuthor').value.trim();
        const status = document.getElementById('fStatus').value;
        const schedule = document.getElementById('fSchedule').value;

        // Validation
        if (!title || !content) {
            showToast('error', 'Please fill in title and content');
            return;
        }

        // Validate schedule date for scheduled status
        if (status === 'scheduled') {
            if (!schedule) {
                showToast('error', 'Please set a publish date and time for scheduled announcements');
                return;
            }

            const scheduleDate = new Date(schedule);
            const now = new Date();
            if (scheduleDate <= now) {
                showToast('error', 'Schedule date must be in the future');
                return;
            }
        }

        showTableLoading();

        const formData = new FormData();
        formData.append('title', title);
        formData.append('content', content);
        formData.append('author', author);
        formData.append('status', status);

        if (status === 'scheduled' && schedule) {
            formData.append('scheduled_date', schedule);
            formData.append('scheduled_at', schedule);
            formData.append('publish_date', schedule);
        }

        const imageFile = document.getElementById('fImage').files[0];
        if (imageFile) {
            if (imageFile.size > 5 * 1024 * 1024) {
                showToast('error', 'Image size must be less than 5MB');
                hideTableLoading();
                return;
            }

            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!validTypes.includes(imageFile.type)) {
                showToast('error', 'Please upload JPEG, PNG, or WEBP images only');
                hideTableLoading();
                return;
            }

            formData.append('image', imageFile);
        }

        if (editId) {
            formData.append('_method', 'PUT');
        }

        const url = editId ? `/editor/announcements/${editId}` : '/editor/announcements';

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': getCSRFToken(),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.success) {
                showToast('success', result.message || 'Announcement saved successfully');
                closeCreateModal();
                await loadAnnouncements();
            } else {
                if (result.errors) {
                    const errorMessages = Object.values(result.errors).flat();
                    showToast('error', errorMessages[0] || 'Failed to save announcement');
                } else if (result.message) {
                    showToast('error', result.message);
                } else {
                    showToast('error', 'Failed to save announcement');
                }
                console.error('Save error response:', result);
            }
        } catch (error) {
            console.error('Save error:', error);
            showToast('error', 'Network error. Please try again.');
        } finally {
            hideTableLoading();
        }
    }

    async function toggleStatus(id) {
        showTableLoading();
        try {
            const response = await fetch(`/editor/announcements/${id}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': getCSRFToken(),
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const result = await response.json();
            if (result.success) {
                showToast('success', result.message);
                await loadAnnouncements();
            } else {
                showToast('error', result.message || 'Failed to toggle status');
            }
        } catch (error) {
            showToast('error', 'Failed to toggle status');
        } finally {
            hideTableLoading();
        }
    }

    function openDeleteModal(id, title) {
        deleteId = id;
        document.getElementById('deleteTargetName').textContent = `"${title}"`;
        showModal('deleteModalBg');
    }

    function closeDeleteModal() {
        hideModal('deleteModalBg');
        deleteId = null;
    }

    async function confirmDelete() {
        if (!deleteId) return;
        showTableLoading();
        try {
            const response = await fetch(`/editor/announcements/${deleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': getCSRFToken(),
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const result = await response.json();
            if (result.success) {
                showToast('success', result.message);
                closeDeleteModal();
                await loadAnnouncements();
            } else {
                showToast('error', result.message || 'Failed to delete');
            }
        } catch (error) {
            showToast('error', 'Failed to delete');
        } finally {
            hideTableLoading();
            deleteId = null;
        }
    }

    function openPreviewModal(id) {
        const announcement = allAnnouncements.find(a => a.id === id);
        if (announcement) {
            document.getElementById('pvName').textContent = announcement.title;
            document.getElementById('pvTitle').textContent = announcement.title;
            document.getElementById('pvBody').innerHTML = announcement.content;
            document.getElementById('pvAuthor').textContent = announcement.author;
            document.getElementById('pvBcTitle').textContent = announcement.title;

            const dateObj = new Date(announcement.dateObj);
            document.getElementById('pvDate').textContent = dateObj.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            if (announcement.img) {
                const img = document.getElementById('pvFeatImg');
                img.src = announcement.img;
                img.style.display = 'block';
            } else {
                document.getElementById('pvFeatImg').style.display = 'none';
            }

            showModal('previewModalBg');
        }
    }

    function closePreviewModal() {
        hideModal('previewModalBg');
    }

    function setDevice(device) {
        const shell = document.getElementById('browserShell');
        shell.className = `browser-shell ${device}`;

        document.querySelectorAll('.device-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.textContent.toLowerCase().includes(device)) {
                btn.classList.add('active');
            }
        });
    }

    function openPreviewFromForm() {
        const title = document.getElementById('fTitle').value;
        const content = document.getElementById('fContent').innerHTML;
        const author = document.getElementById('fAuthor').value;

        if (!title || !content) {
            showToast('error', 'Please fill in title and content first');
            return;
        }

        document.getElementById('pvName').textContent = title;
        document.getElementById('pvTitle').textContent = title;
        document.getElementById('pvBody').innerHTML = content;
        document.getElementById('pvAuthor').textContent = author;
        document.getElementById('pvBcTitle').textContent = title;
        document.getElementById('pvDate').textContent = new Date().toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        const imagePreview = document.getElementById('fImagePreview');
        if (imagePreview.src) {
            document.getElementById('pvFeatImg').src = imagePreview.src;
            document.getElementById('pvFeatImg').style.display = 'block';
        } else {
            document.getElementById('pvFeatImg').style.display = 'none';
        }

        showModal('previewModalBg');
    }

    function closePreviewAndPublish() {
        closePreviewModal();
        document.getElementById('fStatus').value = 'published';
        saveAnnouncement();
    }

    function onStatusChange() {
        const status = document.getElementById('fStatus').value;
        const scheduleField = document.getElementById('scheduleField');
        const scheduleInput = document.getElementById('fSchedule');

        if (status === 'scheduled') {
            scheduleField.classList.add('show');

            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tomorrow.setMinutes(0);
            const minDateTime = tomorrow.toISOString().slice(0, 16);
            scheduleInput.min = minDateTime;

            if (!scheduleInput.value) {
                tomorrow.setHours(9, 0, 0);
                scheduleInput.value = tomorrow.toISOString().slice(0, 16);
            }
        } else {
            scheduleField.classList.remove('show');
        }
    }

    function formatText(command) {
        document.execCommand(command, false, null);
        document.getElementById('fContent').focus();
    }

    function updateCharCount(input, counterId, max) {
        const count = input.value.length;
        const counter = document.getElementById(counterId);
        counter.textContent = `${count} / ${max}`;
        if (count > max) {
            counter.classList.add('over');
        } else if (count > max * 0.9) {
            counter.classList.add('warn');
        } else {
            counter.classList.remove('warn', 'over');
        }
    }

    function previewImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const uploadZone = document.getElementById('uploadZone');
                uploadZone.classList.add('has-image');
                document.getElementById('fImagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    function exportData() {
        showToast('info', 'Export feature will be available soon');
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        loadAnnouncements();

        const th = document.getElementById('thDate');
        th.classList.add('sort-desc');
    });
</script>
@endsection