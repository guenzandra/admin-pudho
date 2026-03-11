@extends('editor.layout')

@section('title', 'Announcements')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">

<style>
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

    /* Stats */
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

    /* Year/Month filter */
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
        min-height: 0;
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

    /* Table */
    .table-wrap {
        background: var(--surface);
        border: 1px solid var(--red-border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(192, 32, 47, .06);
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

    /* MODALS */
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
        box-shadow: 0 24px 64px rgba(192, 32, 47, .2), 0 4px 16px rgba(0, 0, 0, .08);
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

    .modal-close svg {
        width: 16px;
        height: 16px;
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

    .form-group:last-child {
        margin-bottom: 0;
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
        transition: border-color .15s, box-shadow .15s, background .15s;
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
        font-family: 'Sora', sans-serif;
        transition: all .1s;
    }

    .tb-btn:hover {
        background: var(--red-pale);
        color: var(--red);
    }

    .tb-btn svg {
        width: 14px;
        height: 14px;
    }

    .tb-sep {
        width: 1px;
        height: 20px;
        background: var(--border);
        margin: 5px 3px;
        align-self: center;
    }

    /* ══ FULL SCREEN PREVIEW ══ */
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

    #previewModalBg.show>.modal {
        transform: none;
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
        letter-spacing: .06em;
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
        font-family: 'Sora', sans-serif;
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

    .device-btn:hover:not(.active) {
        background: rgba(255, 255, 255, .07);
        color: rgba(255, 255, 255, .75);
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
        font-family: 'Sora', sans-serif;
        transition: all .12s;
        box-shadow: 0 2px 8px rgba(192, 32, 47, .45);
    }

    .pv-btn-pub:hover {
        background: var(--red-dark);
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
        font-family: 'Sora', sans-serif;
        transition: all .12s;
    }

    .pv-btn-close:hover {
        background: rgba(255, 255, 255, .13);
        color: #fff;
    }

    /* Outer scroll area — dark chrome feel */
    .preview-scroll-area {
        flex: 1;
        overflow: auto;
        background: #1a0204;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 24px 24px 40px;
    }

    /* Browser shell */
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

    .b-url-secure {
        color: rgba(100, 255, 100, .5);
        margin-right: 5px;
    }

    /* Actual page content inside browser */
    .browser-page {
        background: #fff;
        border-radius: 0 0 12px 12px;
        overflow: hidden;
        box-shadow: 0 28px 70px rgba(0, 0, 0, .5);
    }

    /* Site nav */
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

    .pub-link:hover {
        color: #fff;
    }

    /* Hero breadcrumb */
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

    .pub-bc-sep {
        color: var(--red-border);
    }

    /* Article */
    .pub-article {
        padding: 48px 48px 72px;
    }

    .pub-article.tablet {
        padding: 36px 32px 56px;
    }

    .pub-article.mobile {
        padding: 22px 16px 40px;
    }

    .pub-article-inner {
        max-width: 760px;
        margin: 0 auto;
    }

    .pub-article-inner.tablet {
        max-width: 100%;
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
        letter-spacing: .08em;
        margin-bottom: 14px;
    }

    .pub-title {
        font-size: 34px;
        font-weight: 700;
        color: var(--txt-1);
        line-height: 1.28;
        margin-bottom: 12px;
    }

    .pub-title.tablet {
        font-size: 26px;
    }

    .pub-title.mobile {
        font-size: 21px;
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

    .pub-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .pub-meta-item svg {
        width: 13px;
        height: 13px;
    }

    .pub-feat-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 32px;
        display: block;
        background: linear-gradient(135deg, var(--red-pale2), var(--red-border));
    }

    .pub-feat-img.tablet {
        height: 280px;
    }

    .pub-feat-img.mobile {
        height: 200px;
        border-radius: 8px;
        margin-bottom: 22px;
    }

    .pub-feat-img.hidden {
        display: none;
    }

    .pub-body {
        font-size: 16.5px;
        color: #374151;
        line-height: 1.85;
    }

    .pub-body.mobile {
        font-size: 14.5px;
    }

    .pub-body p {
        margin-bottom: 18px;
    }

    /* Related strip */
    .pub-related {
        background: var(--bg);
        border-top: 1px solid var(--border);
        padding: 32px 48px;
    }

    .pub-related.tablet {
        padding: 24px 32px;
    }

    .pub-related.mobile {
        padding: 20px 16px;
    }

    .pub-related-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--txt-1);
        margin-bottom: 16px;
    }

    .pub-related-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .pub-related-cards.mobile {
        grid-template-columns: 1fr;
    }

    .pub-related-card {
        background: #fff;
        border-radius: 10px;
        padding: 14px;
        border: 1px solid var(--red-border);
    }

    .pub-related-card-title {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--txt-1);
        line-height: 1.4;
        margin-bottom: 4px;
    }

    .pub-related-card-meta {
        font-size: 11px;
        color: var(--txt-3);
    }

    /* Site footer */
    .pub-footer {
        background: #110204;
        padding: 20px 48px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .pub-footer.mobile {
        padding: 16px;
    }

    .pub-footer-text {
        font-size: 11px;
        color: rgba(255, 255, 255, .28);
    }

    /* Delete modal */
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

    /* Toast */
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
        font-family: 'Sora', sans-serif;
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

    .toast-icon svg {
        width: 16px;
        height: 16px;
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
        padding: 0;
        flex-shrink: 0;
    }

    .toast-close svg {
        width: 14px;
        height: 14px;
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

    /* Loading */
    .loading-overlay {
        position: fixed;
        inset: 0;
        background: rgba(255, 255, 255, .7);
        backdrop-filter: blur(2px);
        z-index: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity .15s;
    }

    .loading-overlay.show {
        opacity: 1;
        pointer-events: auto;
    }

    .spinner {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 3px solid var(--red-border);
        border-top-color: var(--red);
        animation: spin .7s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* FAB */
    #help-fab {
        position: fixed;
        bottom: 28px;
        right: 28px;
        z-index: 300;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--red), var(--red-dark));
        color: #fff;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 18px rgba(192, 32, 47, .4);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform .2s, box-shadow .2s;
    }

    #help-fab:hover {
        transform: scale(1.1) rotate(10deg);
        box-shadow: 0 6px 24px rgba(192, 32, 47, .5);
    }

    #help-fab svg {
        width: 22px;
        height: 22px;
    }

    .help-pulse {
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        border: 2px solid rgba(192, 32, 47, .35);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: .6
        }

        50% {
            transform: scale(1.18);
            opacity: 0
        }
    }

    .help-step {
        display: flex;
        gap: 16px;
        padding: 18px 0;
        border-bottom: 1px solid var(--red-border);
    }

    .help-step:last-child {
        border-bottom: none;
    }

    .help-step-num {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        flex-shrink: 0;
        background: linear-gradient(135deg, var(--red), var(--red-dark));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
    }

    .help-step-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--txt-1);
        margin-bottom: 4px;
    }

    .help-step-desc {
        font-size: 12.5px;
        color: var(--txt-3);
        line-height: 1.55;
    }

    .help-tip {
        margin-top: 14px;
        padding: 12px 16px;
        background: var(--red-pale);
        border-radius: 10px;
        border-left: 3px solid var(--red);
        font-size: 12.5px;
        color: var(--txt-2);
        line-height: 1.5;
    }

    .help-tip strong {
        color: var(--red);
    }

    #fContent:empty::before {
        content: 'Write your announcement content here…';
        color: var(--txt-3);
        pointer-events: none;
    }
</style>

<div id="toast-container"></div>
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<!-- Header -->
<div class="page-header">
    <div>
        <h1 class="page-title">Announcements</h1>
        <p class="page-sub">Manage all announcements and their publication status</p>
    </div>
    <div class="header-actions">
        <button class="btn-ghost" onclick="exportData()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>Export
        </button>
        <button class="btn-primary" onclick="openCreateModal()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>New Announcement
        </button>
    </div>
</div>

<!-- Stats (clickable) -->
<div class="stats-row">
    <div class="stat-card active-stat" id="statAll" onclick="filterByStatus('')">
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

<!-- Year / Month / Search filter block -->
<div class="time-filter-wrap">
    <div class="year-tabs-bar" id="yearTabsBar">
        <button class="year-tab-all active" data-year="" onclick="setYear('',this)">All Years</button>
    </div>
    <div class="month-chips-bar" id="monthChipsBar" style="display:none;"></div>
    <div class="filter-row">
        <div class="search-wrap">
            <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" id="filterSearch" class="filter-input" placeholder="Search by title or author…" oninput="debounceFilter()">
        </div>
        <div style="min-width:150px;">
            <select id="filterStatus" class="filter-select" onchange="applyFilters()">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="scheduled">Scheduled</option>
            </select>
        </div>
        <button class="btn-ghost" onclick="clearFilters()" style="flex-shrink:0;">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>Clear
        </button>
    </div>
    <div class="filter-pills" id="filterPills"></div>
</div>

<!-- Table -->
<div class="table-wrap">
    <div class="table-head">
        <div class="table-head-title" id="tableHeadTitle">All Announcements</div>
        <span class="results-count" id="resultsCount"></span>
    </div>
    <div style="overflow-x:auto;">
        <table id="announcementsTable">
            <thead>
                <tr>
                    <th style="width:44%">Title</th>
                    <th class="sortable sort-desc" id="thDate" onclick="toggleSort()">Date Posted<span class="sort-icon"></span></th>
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


<!-- ═══ CREATE/EDIT MODAL ═══ -->
<div class="modal-backdrop" id="createModalBg">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h3 id="createModalTitle">New Announcement</h3>
            <button class="modal-close" onclick="closeCreateModal()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <button class="tb-btn" title="Bold" onclick="fmt('bold')"><b>B</b></button>
                    <button class="tb-btn" title="Italic" onclick="fmt('italic')"><i>I</i></button>
                    <button class="tb-btn" title="Underline" onclick="fmt('underline')"><u>U</u></button>
                    <div class="tb-sep"></div>
                    <button class="tb-btn" title="Bullet list" onclick="fmt('insertUnorderedList')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg></button>
                    <button class="tb-btn" title="Clear format" onclick="fmt('removeFormat')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg></button>
                </div>
                <div id="fContent" contenteditable="true" class="form-textarea" style="min-height:130px;outline:none;border-radius:0 0 9px 9px;border:1.5px solid var(--border);padding:10px 13px;font-family:'Sora',sans-serif;font-size:13.5px;line-height:1.6;background:var(--bg);transition:border-color .15s,box-shadow .15s;"></div>
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
                        <input type="text" id="fAuthor" class="form-input" value="Editor" placeholder="Author name">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-ghost" onclick="closeCreateModal()">Cancel</button>
            <button class="btn-ghost" onclick="openPreviewFromForm()" style="color:#7c3aed;border-color:#e9d5ff;background:#f5f3ff;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="15" height="15">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Preview
            </button>
            <button class="btn-primary" id="savBtn" onclick="saveAnnouncement()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="15" height="15">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>Save Announcement
            </button>
        </div>
    </div>
</div>


<!-- ═══ FULL-SCREEN PREVIEW MODAL ═══ -->
<div class="modal-backdrop" id="previewModalBg">
    <div class="modal" style="border-radius:0;max-width:100%;width:100%;height:100vh;max-height:100vh;">
        <!-- Dark topbar -->
        <div class="preview-topbar">
            <div class="preview-topbar-left">
                <span class="preview-topbar-badge">Preview</span>
                <span class="preview-topbar-name" id="pvName">Announcement Title</span>
            </div>
            <div class="preview-device-group">
                <button class="device-btn active" id="devDesktop" onclick="setDevice('desktop')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>Desktop
                </button>
                <button class="device-btn" id="devTablet" onclick="setDevice('tablet')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>Tablet
                </button>
                <button class="device-btn" id="devMobile" onclick="setDevice('mobile')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>Mobile
                </button>
            </div>
            <div class="preview-topbar-right">
                <button class="pv-btn-pub" onclick="closePreviewAndPublish()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>Publish Now
                </button>
                <button class="pv-btn-close" onclick="closePreviewModal()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>Close
                </button>
            </div>
        </div>

        <!-- Dark scroll area with browser shell -->
        <div class="preview-scroll-area">
            <div class="browser-shell desktop" id="browserShell">
                <!-- Browser chrome -->
                <div class="browser-chrome-bar">
                    <div class="b-dots">
                        <div class="b-dot" style="background:#ff5f57"></div>
                        <div class="b-dot" style="background:#febc2e"></div>
                        <div class="b-dot" style="background:#28c840"></div>
                    </div>
                    <div class="b-url"><span class="b-url-secure">🔒</span><span id="pvUrl">pudho-laguna.gov.ph/announcements/…</span></div>
                </div>
                <!-- Full page -->
                <div class="browser-page">
                    <!-- Site nav -->
                    <div class="pub-nav" id="pvNav">
                        <div class="pub-logo">
                            <img class="pub-logo-img" src="{{ asset('build/assets/images/logo-pudho.jpg') }}" onerror="this.src='https://via.placeholder.com/34/fff/C0202F?text=P'" alt="PUDHO">
                            <div>
                                <div class="pub-logo-text">LAGUNA PUDHO</div>
                                <div class="pub-logo-sub">Urban Development & Housing</div>
                            </div>
                        </div>
                        <div class="pub-links" id="pvLinks">
                            <a class="pub-link" href="#">Home</a>
                            <a class="pub-link active" href="#">Announcements</a>
                            <a class="pub-link" href="#">Services</a>
                            <a class="pub-link" href="#">About</a>
                            <a class="pub-link" href="#">Contact</a>
                        </div>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="pub-breadcrumb" id="pvBreadcrumb">
                        <a class="pub-bc-link" href="#">Home</a><span class="pub-bc-sep">›</span>
                        <a class="pub-bc-link" href="#">Announcements</a><span class="pub-bc-sep">›</span>
                        <span id="pvBcTitle" style="color:var(--txt-3)">Loading…</span>
                    </div>
                    <!-- Article -->
                    <div class="pub-article" id="pvArticle">
                        <div class="pub-article-inner" id="pvArticleInner">
                            <span class="pub-cat">Announcement</span>
                            <h1 class="pub-title" id="pvTitle">Announcement Title</h1>
                            <div class="pub-meta">
                                <div class="pub-meta-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg><span id="pvAuthor">Editor</span></div>
                                <div class="pub-meta-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg><span id="pvDate">March 10, 2026</span></div>
                                <div class="pub-meta-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>PUDHO Laguna</div>
                            </div>
                            <img id="pvFeatImg" class="pub-feat-img" src="" alt="Featured image">
                            <div class="pub-body" id="pvBody">
                                <p>Your announcement content will appear here.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Related announcements strip -->
                    <div class="pub-related" id="pvRelated">
                        <div class="pub-related-title">More Announcements</div>
                        <div class="pub-related-cards" id="pvRelatedCards"></div>
                    </div>
                    <!-- Footer -->
                    <div class="pub-footer" id="pvFooter">
                        <span class="pub-footer-text">© 2026 PUDHO Laguna — Province of Laguna Urban Development & Housing Office</span>
                        <span class="pub-footer-text">All rights reserved.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ═══ DELETE MODAL ═══ -->
<div class="modal-backdrop" id="deleteModalBg">
    <div class="modal modal-sm">
        <div class="modal-header">
            <h3>Delete Announcement</h3><button class="modal-close" onclick="closeDeleteModal()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg></button>
        </div>
        <div class="modal-body" style="text-align:center;padding:28px 24px;">
            <div class="delete-modal-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg></div>
            <div class="delete-modal-title">Are you sure?</div>
            <div class="delete-modal-sub">Permanently delete<br><span class="delete-modal-name" id="deleteTargetName">"Announcement"</span>?<br>This cannot be undone.</div>
        </div>
        <div class="modal-footer" style="justify-content:center;gap:12px;">
            <button class="btn-ghost" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn-primary" onclick="confirmDelete()" style="background:#dc2626;box-shadow:0 2px 10px rgba(220,38,38,.25);">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="15" height="15">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>Yes, Delete
            </button>
        </div>
    </div>
</div>


<!-- ═══ HELP MODAL ═══ -->
<div class="modal-backdrop" id="helpModalBg">
    <div class="modal modal-md">
        <div class="modal-header">
            <h3>How to Use Announcements</h3><button class="modal-close" onclick="closeHelpModal()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg></button>
        </div>
        <div class="modal-body">
            <div class="help-step">
                <div class="help-step-num">1</div>
                <div>
                    <div class="help-step-title">Create a New Announcement</div>
                    <div class="help-step-desc">Click <strong>New Announcement</strong> top-right. Fill in title, content (use toolbar for formatting), optional image, status, and author.</div>
                </div>
            </div>
            <div class="help-step">
                <div class="help-step-num">2</div>
                <div>
                    <div class="help-step-title">Set the Status</div>
                    <div class="help-step-desc"><strong>Draft</strong> saves privately. <strong>Published</strong> goes live instantly. <strong>Scheduled</strong> lets you set a future publish date and time.</div>
                </div>
            </div>
            <div class="help-step">
                <div class="help-step-num">3</div>
                <div>
                    <div class="help-step-title">Full-Screen Preview</div>
                    <div class="help-step-desc">Click <strong>Preview</strong> to open a full-screen simulation of the public page — exactly as visitors see it, with Desktop, Tablet, and Mobile views. Use <strong>Publish Now</strong> directly from the preview.</div>
                </div>
            </div>
            <div class="help-step">
                <div class="help-step-num">4</div>
                <div>
                    <div class="help-step-title">Hover for Row Actions</div>
                    <div class="help-step-desc">Hover any table row to reveal <strong>Edit</strong>, <strong>Preview</strong>, <strong>Publish/Unpublish</strong>, and <strong>Delete</strong> buttons beneath the title.</div>
                </div>
            </div>
            <div class="help-step">
                <div class="help-step-num">5</div>
                <div>
                    <div class="help-step-title">Filter by Year &amp; Month</div>
                    <div class="help-step-desc">Click a <strong>year tab</strong> to show only that year's announcements — month chips appear for finer filtering. Click any <strong>stat card</strong> to filter by status instantly.</div>
                </div>
            </div>
            <div class="help-tip"><strong>Tip:</strong> Always preview on mobile before publishing — images that look great on desktop may need adjusting on smaller screens.</div>
        </div>
        <div class="modal-footer"><button class="btn-primary" onclick="closeHelpModal()">Got it!</button></div>
    </div>
</div>

<button id="help-fab" onclick="openHelpModal()">
    <div class="help-pulse"></div>
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
</button>


<script>
    const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const MONTHS_FULL = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    const allData = [{
            id: 1,
            title: 'Office Holiday Schedule Update',
            desc: 'Important announcement regarding office hours during holidays',
            dateObj: new Date('2026-03-02'),
            status: 'published',
            author: 'John Doe',
            img: ''
        },
        {
            id: 2,
            title: 'New Housing Policy Implementation',
            desc: 'Updates to the housing application process',
            dateObj: new Date('2026-03-01'),
            status: 'draft',
            author: 'Jane Smith',
            img: ''
        },
        {
            id: 3,
            title: 'System Maintenance Notice',
            desc: 'Scheduled maintenance for online services',
            dateObj: new Date('2026-02-28'),
            status: 'scheduled',
            author: 'Mike Johnson',
            img: ''
        },
        {
            id: 4,
            title: 'Community Relocation Program Update',
            desc: 'Phase 2 of the urban resettlement project',
            dateObj: new Date('2026-02-15'),
            status: 'published',
            author: 'Maria Cruz',
            img: ''
        },
        {
            id: 5,
            title: 'PUDHO Annual Report 2025 Released',
            desc: 'Full report now available for download',
            dateObj: new Date('2025-12-10'),
            status: 'published',
            author: 'John Doe',
            img: ''
        },
        {
            id: 6,
            title: 'Budget Consultation Meeting Notice',
            desc: 'Public consultation on housing budget allocation',
            dateObj: new Date('2025-11-05'),
            status: 'draft',
            author: 'Ana Reyes',
            img: ''
        },
        {
            id: 7,
            title: 'New District Office Opening – Calamba',
            desc: 'Opening of the 4th District satellite office',
            dateObj: new Date('2025-10-20'),
            status: 'scheduled',
            author: 'Ben Santos',
            img: ''
        },
        {
            id: 8,
            title: 'Emergency Housing Assistance Program',
            desc: 'Assistance for families affected by Typhoon Rosita',
            dateObj: new Date('2025-09-08'),
            status: 'published',
            author: 'Maria Cruz',
            img: ''
        },
        {
            id: 9,
            title: 'Q3 Performance Review Published',
            desc: 'Third quarter accomplishments and key metrics',
            dateObj: new Date('2024-09-30'),
            status: 'published',
            author: 'John Doe',
            img: ''
        },
        {
            id: 10,
            title: 'PUDHO 2024 Work Plan Released',
            desc: 'Annual work plan and priority projects',
            dateObj: new Date('2024-01-15'),
            status: 'published',
            author: 'Ana Reyes',
            img: ''
        },
    ];

    let filteredData = [...allData];
    let currentPage = 1,
        perPage = 6,
        deleteTarget = null,
        editTarget = null;
    let sortDir = 'desc',
        activeYear = '',
        activeMonth = '',
        activeStatus = '',
        uploadedImg = '';

    // ── Year tabs ──
    function buildYearTabs() {
        const years = [...new Set(allData.map(a => a.dateObj.getFullYear()))].sort((a, b) => b - a);
        const bar = document.getElementById('yearTabsBar');
        bar.querySelectorAll('.year-tab').forEach(e => e.remove());
        years.forEach(y => {
            const b = document.createElement('button');
            b.className = 'year-tab';
            b.dataset.year = y;
            b.textContent = y;
            b.onclick = () => setYear(String(y), b);
            bar.appendChild(b);
        });
    }

    function setYear(year, el) {
        activeYear = year;
        activeMonth = '';
        document.querySelectorAll('#yearTabsBar [data-year]').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        buildMonthChips(year);
        applyFilters();
    }

    function buildMonthChips(year) {
        const bar = document.getElementById('monthChipsBar');
        if (!year) {
            bar.style.display = 'none';
            return;
        }
        const months = new Set(allData.filter(a => a.dateObj.getFullYear() === Number(year)).map(a => a.dateObj.getMonth()));
        bar.style.display = 'flex';
        bar.innerHTML = `<button class="month-chip active" data-month="" onclick="setMonth('',this)">All Months</button>`;
        MONTHS.forEach((m, i) => {
            const has = months.has(i);
            const b = document.createElement('button');
            b.className = 'month-chip' + (has ? ' has-data' : '');
            b.dataset.month = i;
            b.style.opacity = has ? '1' : '.4';
            b.innerHTML = has ? `${m}<span class="dot-ind"></span>` : m;
            b.onclick = () => setMonth(String(i), b);
            bar.appendChild(b);
        });
    }

    function setMonth(month, el) {
        activeMonth = month;
        document.querySelectorAll('#monthChipsBar .month-chip').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        applyFilters();
    }

    // ── Stat card filter ──
    function filterByStatus(s) {
        activeStatus = s;
        document.getElementById('filterStatus').value = s;
        ['statAll', 'statPub', 'statDra', 'statSch'].forEach(id => document.getElementById(id).classList.remove('active-stat'));
        const m = {
            '': 'statAll',
            'published': 'statPub',
            'draft': 'statDra',
            'scheduled': 'statSch'
        };
        document.getElementById(m[s]).classList.add('active-stat');
        applyFilters();
    }

    // ── Filter ──
    let ft;

    function debounceFilter() {
        clearTimeout(ft);
        ft = setTimeout(applyFilters, 300);
    }

    function applyFilters() {
        const search = document.getElementById('filterSearch').value.toLowerCase();
        const status = document.getElementById('filterStatus').value;
        activeStatus = status;

        filteredData = allData.filter(a => {
            if (search && !a.title.toLowerCase().includes(search) && !a.author.toLowerCase().includes(search)) return false;
            if (status && a.status !== status) return false;
            if (activeYear && a.dateObj.getFullYear() !== Number(activeYear)) return false;
            if (activeMonth !== '' && a.dateObj.getMonth() !== Number(activeMonth)) return false;
            return true;
        }).sort((a, b) => sortDir === 'desc' ? b.dateObj - a.dateObj : a.dateObj - b.dateObj);

        currentPage = 1;
        updateStats();
        renderPills(search, status);
        updateHeadTitle();
        renderTable();
    }

    function updateStats() {
        document.getElementById('svTotal').textContent = allData.length;
        document.getElementById('svPub').textContent = allData.filter(a => a.status === 'published').length;
        document.getElementById('svDra').textContent = allData.filter(a => a.status === 'draft').length;
        document.getElementById('svSch').textContent = allData.filter(a => a.status === 'scheduled').length;
    }

    function updateHeadTitle() {
        let t = 'All Announcements';
        if (activeYear) {
            t = activeYear;
            if (activeMonth !== '') t += ` · ${MONTHS[Number(activeMonth)]}`;
        }
        if (activeStatus) t += ' — ' + activeStatus.charAt(0).toUpperCase() + activeStatus.slice(1);
        document.getElementById('tableHeadTitle').textContent = t;
    }

    function renderPills(search, status) {
        let h = '';
        if (activeYear) h += pill(`Year: ${activeYear}`, 'clearYear()');
        if (activeMonth !== '') h += pill(`Month: ${MONTHS[Number(activeMonth)]}`, 'clearMonth()');
        if (search) h += pill(`Search: "${search}"`, 'clearSearch()');
        if (status) h += pill(`Status: ${status}`, 'clearStatus()');
        document.getElementById('filterPills').innerHTML = h;
    }

    function pill(label, fn) {
        return `<span class="filter-pill">${label}<button onclick="${fn}"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg></button></span>`;
    }

    function clearYear() {
        activeYear = '';
        activeMonth = '';
        document.querySelector('[data-year=""].year-tab-all').classList.add('active');
        document.querySelectorAll('.year-tab').forEach(b => b.classList.remove('active'));
        document.getElementById('monthChipsBar').style.display = 'none';
        applyFilters();
    }

    function clearMonth() {
        activeMonth = '';
        document.querySelector('[data-month=""]').classList.add('active');
        applyFilters();
    }

    function clearSearch() {
        document.getElementById('filterSearch').value = '';
        applyFilters();
    }

    function clearStatus() {
        filterByStatus('');
    }

    function clearFilters() {
        document.getElementById('filterSearch').value = '';
        activeYear = '';
        activeMonth = '';
        activeStatus = '';
        document.querySelector('[data-year=""].year-tab-all').classList.add('active');
        document.querySelectorAll('.year-tab').forEach(b => b.classList.remove('active'));
        document.getElementById('monthChipsBar').style.display = 'none';
        filterByStatus('');
    }

    // ── Sort ──
    function toggleSort() {
        sortDir = sortDir === 'desc' ? 'asc' : 'desc';
        const th = document.getElementById('thDate');
        th.className = 'sortable ' + (sortDir === 'asc' ? 'sort-asc' : 'sort-desc');
        applyFilters();
    }

    // ── Render table ──
    function renderTable() {
        const tbody = document.getElementById('announcementsBody');
        const start = (currentPage - 1) * perPage;
        const page = filteredData.slice(start, start + perPage);
        const empty = document.getElementById('emptyState');
        const tbl = document.getElementById('announcementsTable');

        if (!filteredData.length) {
            empty.style.display = 'block';
            tbl.style.display = 'none';
            document.getElementById('paginationWrap').style.display = 'none';
            document.getElementById('resultsCount').textContent = 'No results';
            return;
        }
        empty.style.display = 'none';
        tbl.style.display = '';
        document.getElementById('paginationWrap').style.display = '';
        document.getElementById('resultsCount').innerHTML = `Showing <strong>${start+1}–${Math.min(start+perPage,filteredData.length)}</strong> of <strong>${filteredData.length}</strong>`;

        tbody.innerHTML = page.map(a => {
            const d = a.dateObj;
            const thumb = a.img || `https://via.placeholder.com/48x48/FFECEE/C0202F?text=${encodeURIComponent(a.title[0])}`;
            return `
    <tr>
      <td class="title-cell">
        <div class="title-cell-inner">
          <img class="row-thumb" src="${thumb}" alt="">
          <div class="row-title-wrap">
            <div class="row-title">${a.title}</div>
            <div class="row-desc">${a.desc}</div>
          </div>
        </div>
        <div class="row-actions">
          <button class="row-action-btn edit" onclick="openEditModal(${a.id})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6M3 17.25V21h3.75l9.06-9.06-3.75-3.75L3 17.25z"/></svg>Edit</button>
          <div class="action-sep"></div>
          <button class="row-action-btn preview-btn" onclick="openPreviewFromRow(${a.id})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>Preview</button>
          <div class="action-sep"></div>
          ${a.status==='published'
            ?`<button class="row-action-btn unpublish" onclick="toggleStatus(${a.id})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>Unpublish</button>`
            :`<button class="row-action-btn publish" onclick="toggleStatus(${a.id})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Publish</button>`
          }
          <div class="action-sep"></div>
          <button class="row-action-btn delete" onclick="openDeleteModal(${a.id})"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Delete</button>
        </div>
      </td>
      <td class="cell-pad">
        <div class="date-main">${d.getDate()} ${MONTHS[d.getMonth()]}</div>
        <div class="date-sub">${d.getFullYear()}</div>
      </td>
      <td class="cell-pad"><span class="badge ${a.status}">${a.status.charAt(0).toUpperCase()+a.status.slice(1)}</span></td>
      <td class="cell-pad">${a.author}</td>
    </tr>`;
        }).join('');
        renderPagination();
    }

    function renderPagination() {
        const total = filteredData.length,
            pages = Math.ceil(total / perPage);
        const s = (currentPage - 1) * perPage;
        document.getElementById('paginationInfo').innerHTML = `Showing <strong>${s+1}</strong>–<strong>${Math.min(s+perPage,total)}</strong> of <strong>${total}</strong>`;
        let h = `<button class="pag-btn" onclick="goPage(${currentPage-1})" ${currentPage===1?'disabled':''}>‹</button>`;
        for (let i = 1; i <= pages; i++) {
            if (pages > 7 && i > 2 && i < pages - 1 && Math.abs(i - currentPage) > 1) {
                if (i === 3 || i === pages - 2) h += `<button class="pag-btn" disabled>…</button>`;
                continue;
            }
            h += `<button class="pag-btn ${i===currentPage?'active':''}" onclick="goPage(${i})">${i}</button>`;
        }
        h += `<button class="pag-btn" onclick="goPage(${currentPage+1})" ${currentPage===pages||!pages?'disabled':''}>›</button>`;
        document.getElementById('paginationBtns').innerHTML = h;
    }

    function goPage(p) {
        const pages = Math.ceil(filteredData.length / perPage);
        if (p < 1 || p > pages) return;
        currentPage = p;
        renderTable();
    }

    // ── Create / Edit ──
    function openCreateModal() {
        editTarget = null;
        document.getElementById('createModalTitle').textContent = 'New Announcement';
        document.getElementById('savBtn').innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="15" height="15"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Save Announcement';
        document.getElementById('fTitle').value = '';
        document.getElementById('fContent').innerHTML = '';
        document.getElementById('fStatus').value = 'draft';
        document.getElementById('fAuthor').value = 'Editor';
        document.getElementById('fSchedule').value = '';
        document.getElementById('titleCount').textContent = '0 / 120';
        document.getElementById('scheduleField').classList.remove('show');
        resetImgUpload();
        showModal('createModalBg');
    }

    function openEditModal(id) {
        const a = allData.find(x => x.id === id);
        if (!a) return;
        editTarget = id;
        document.getElementById('createModalTitle').textContent = 'Edit Announcement';
        document.getElementById('savBtn').innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="15" height="15"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Update Announcement';
        document.getElementById('fTitle').value = a.title;
        document.getElementById('fContent').innerHTML = a.desc;
        document.getElementById('fStatus').value = a.status;
        document.getElementById('fAuthor').value = a.author;
        document.getElementById('scheduleField').classList.toggle('show', a.status === 'scheduled');
        uploadedImg = a.img || '';
        resetImgUpload();
        updateCharCount(document.getElementById('fTitle'), 'titleCount', 120);
        showModal('createModalBg');
    }

    function closeCreateModal() {
        hideModal('createModalBg');
    }

    function onStatusChange() {
        document.getElementById('scheduleField').classList.toggle('show', document.getElementById('fStatus').value === 'scheduled');
    }

    function saveAnnouncement() {
        const title = document.getElementById('fTitle').value.trim();
        const content = document.getElementById('fContent').innerText.trim();
        if (!title) {
            showToast('error', 'Title is required.');
            return;
        }
        if (!content) {
            showToast('error', 'Content cannot be empty.');
            return;
        }
        showLoading();
        setTimeout(() => {
            hideLoading();
            const status = document.getElementById('fStatus').value;
            const author = document.getElementById('fAuthor').value || 'Editor';
            const htmlContent = document.getElementById('fContent').innerHTML;
            if (editTarget) {
                const a = allData.find(x => x.id === editTarget);
                if (a) {
                    a.title = title;
                    a.desc = content.substring(0, 70) + '…';
                    a.status = status;
                    a.author = author;
                    a.img = uploadedImg;
                    a._html = htmlContent;
                }
                showToast('success', 'Announcement updated.');
            } else {
                allData.unshift({
                    id: Date.now(),
                    title,
                    desc: content.substring(0, 70) + '…',
                    dateObj: new Date(),
                    status,
                    author,
                    img: uploadedImg,
                    _html: htmlContent
                });
                showToast('success', 'Announcement created!');
            }
            buildYearTabs();
            applyFilters();
            closeCreateModal();
        }, 800);
    }

    // ── Preview ──
    function buildPreview(a, isForm) {
        const title = isForm ? document.getElementById('fTitle').value.trim() : a.title;
        const body = isForm ? document.getElementById('fContent').innerHTML : (a._html || `<p>${a.desc}</p>`);
        const author = isForm ? document.getElementById('fAuthor').value.trim() : a.author;
        const img = isForm ? uploadedImg : (a.img || '');
        const d = isForm ? new Date() : a.dateObj;
        const slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');

        document.getElementById('pvName').textContent = title || 'Untitled';
        document.getElementById('pvBcTitle').textContent = title || 'Untitled';
        document.getElementById('pvTitle').textContent = title || 'Announcement Title';
        document.getElementById('pvAuthor').textContent = author || 'Editor';
        document.getElementById('pvDate').textContent = d.toLocaleDateString('en-US', {
            month: 'long',
            day: 'numeric',
            year: 'numeric'
        });
        document.getElementById('pvUrl').textContent = `pudho-laguna.gov.ph/announcements/${slug}`;
        document.getElementById('pvBody').innerHTML = body || '<p>No content provided.</p>';

        const imgEl = document.getElementById('pvFeatImg');
        if (img) {
            imgEl.src = img;
            imgEl.classList.remove('hidden');
        } else {
            imgEl.src = '';
            imgEl.classList.add('hidden');
        }

        // Related announcements
        const related = allData.filter(x => x.id !== (isForm ? -1 : a.id) && x.status === 'published').slice(0, 3);
        document.getElementById('pvRelatedCards').innerHTML = related.map(r => `
    <div class="pub-related-card">
      <div class="pub-related-card-title">${r.title}</div>
      <div class="pub-related-card-meta">${r.dateObj.getDate()} ${MONTHS[r.dateObj.getMonth()]} ${r.dateObj.getFullYear()}</div>
    </div>`).join('');
    }

    function openPreviewFromForm() {
        buildPreview(null, true);
        setDevice('desktop');
        showModal('previewModalBg');
    }

    function openPreviewFromRow(id) {
        const a = allData.find(x => x.id === id);
        if (!a) return;
        buildPreview(a, false);
        setDevice('desktop');
        showModal('previewModalBg');
    }

    function closePreviewModal() {
        hideModal('previewModalBg');
    }

    function closePreviewAndPublish() {
        closePreviewModal();
        document.getElementById('fStatus').value = 'published';
        document.getElementById('scheduleField').classList.remove('show');
        showToast('info', 'Status set to Published. Click Save when ready.');
    }

    function setDevice(d) {
        ['desktop', 'tablet', 'mobile'].forEach(x => {
            document.getElementById('dev' + x.charAt(0).toUpperCase() + x.slice(1)).classList.toggle('active', x === d);
        });
        const shell = document.getElementById('browserShell');
        shell.className = 'browser-shell ' + d;

        const isM = d === 'mobile',
            isT = d === 'tablet';
        document.getElementById('pvNav').className = 'pub-nav' + (isM ? ' mobile' : isT ? ' tablet' : '');
        document.getElementById('pvLinks').className = 'pub-links' + (isM ? ' hidden' : '');
        document.getElementById('pvBreadcrumb').className = 'pub-breadcrumb' + (isM ? ' mobile' : isT ? ' tablet' : '');
        document.getElementById('pvArticle').className = 'pub-article' + (isM ? ' mobile' : isT ? ' tablet' : '');
        document.getElementById('pvArticleInner').className = 'pub-article-inner' + (isT ? ' tablet' : '');
        document.getElementById('pvTitle').className = 'pub-title' + (isM ? ' mobile' : isT ? ' tablet' : '');
        document.getElementById('pvFeatImg').className = 'pub-feat-img' + (document.getElementById('pvFeatImg').classList.contains('hidden') ? ' hidden' : '') + (isM ? ' mobile' : isT ? ' tablet' : '');
        document.getElementById('pvBody').className = 'pub-body' + (isM ? ' mobile' : '');
        document.getElementById('pvRelated').className = 'pub-related' + (isM ? ' mobile' : isT ? ' tablet' : '');
        document.getElementById('pvRelatedCards').className = 'pub-related-cards' + (isM ? ' mobile' : '');
        document.getElementById('pvFooter').className = 'pub-footer' + (isM ? ' mobile' : '');
    }

    // ── Toggle status ──
    function toggleStatus(id) {
        const a = allData.find(x => x.id === id);
        if (!a) return;
        showLoading();
        setTimeout(() => {
            hideLoading();
            a.status = a.status === 'published' ? 'draft' : 'published';
            applyFilters();
            showToast('success', `Announcement ${a.status==='published'?'published':'unpublished'}.`);
        }, 600);
    }

    // ── Delete ──
    function openDeleteModal(id) {
        deleteTarget = id;
        const a = allData.find(x => x.id === id);
        document.getElementById('deleteTargetName').textContent = `"${a?a.title:''}"`;
        showModal('deleteModalBg');
    }

    function closeDeleteModal() {
        hideModal('deleteModalBg');
        deleteTarget = null;
    }

    function confirmDelete() {
        if (!deleteTarget) return;
        showLoading();
        closeDeleteModal();
        setTimeout(() => {
            hideLoading();
            const idx = allData.findIndex(x => x.id === deleteTarget);
            if (idx > -1) allData.splice(idx, 1);
            deleteTarget = null;
            buildYearTabs();
            applyFilters();
            showToast('success', 'Announcement deleted.');
        }, 700);
    }

    function exportData() {
        showToast('info', 'Export — connect to your Laravel controller endpoint.');
    }

    function openHelpModal() {
        showModal('helpModalBg');
    }

    function closeHelpModal() {
        hideModal('helpModalBg');
    }

    function previewImageUpload(e) {
        const file = e.target.files[0];
        if (!file) return;
        const r = new FileReader();
        r.onload = ev => {
            uploadedImg = ev.target.result;
            document.getElementById('fImagePreview').src = ev.target.result;
            document.getElementById('uploadZone').classList.add('has-image');
        };
        r.readAsDataURL(file);
    }

    function resetImgUpload() {
        document.getElementById('fImage').value = '';
        document.getElementById('fImagePreview').src = '';
        document.getElementById('uploadZone').classList.remove('has-image');
    }

    function fmt(cmd) {
        document.getElementById('fContent').focus();
        document.execCommand(cmd, false, null);
    }

    function updateCharCount(el, id, max) {
        const l = el.value.length;
        const c = document.getElementById(id);
        c.textContent = `${l} / ${max}`;
        c.className = 'char-counter' + (l >= max ? ' over' : l > max * .85 ? ' warn' : '');
    }

    // ── Modal helpers ──
    function showModal(id) {
        document.getElementById(id).classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function hideModal(id) {
        document.getElementById(id).classList.remove('show');
        document.body.style.overflow = '';
    }
    document.querySelectorAll('.modal-backdrop').forEach(bg => {
        bg.addEventListener('click', e => {
            if (e.target === bg && bg.id !== 'previewModalBg' && bg.id !== 'createModalBg') {
                bg.classList.remove('show');
                document.body.style.overflow = '';
            }
        });
    });

    // Focus fix for contenteditable
    document.getElementById('fContent').addEventListener('focus', function() {
        this.style.borderColor = 'var(--red)';
        this.style.boxShadow = '0 0 0 3px rgba(192,32,47,.08)';
        this.style.background = '#fff';
    });
    document.getElementById('fContent').addEventListener('blur', function() {
        this.style.borderColor = 'var(--border)';
        this.style.boxShadow = 'none';
        this.style.background = 'var(--bg)';
    });

    // ── Toast ──
    const ICONS = {
        success: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>',
        error: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>',
        info: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
    };

    function showToast(type, msg) {
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.innerHTML = `<div class="toast-icon">${ICONS[type]}</div><span>${msg}</span><button class="toast-close" onclick="dismissToast(this.parentElement)"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg></button>`;
        document.getElementById('toast-container').appendChild(t);
        setTimeout(() => dismissToast(t), 4000);
    }

    function dismissToast(t) {
        if (!t || t.classList.contains('hiding')) return;
        t.classList.add('hiding');
        setTimeout(() => t.remove(), 220);
    }

    function showLoading() {
        document.getElementById('loadingOverlay').classList.add('show');
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').classList.remove('show');
    }

    // ── Init ──
    buildYearTabs();
    updateStats();
    applyFilters();
</script>
@endsection