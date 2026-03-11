@extends('editor.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliated Offices</title>
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

        /* ── Page ── */
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

        /* ── Card ── */
        .card {
            background: var(--white);
            border-radius: var(--r);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            width: 100%;
        }

        /* ── Card header ── */
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

        /* ── Toolbar ── */
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
            min-width: 200px;
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

        .toolbar select {
            padding: .48rem .75rem;
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            font-size: 13px;
            font-family: Arial, sans-serif;
            background: var(--white);
            color: var(--ink);
            cursor: pointer;
        }

        .toolbar select:focus {
            outline: none;
            border-color: var(--gold);
        }

        /* ── View toggle ── */
        .view-toggle {
            display: flex;
            gap: .25rem;
            background: var(--border-light);
            padding: .2rem;
            border-radius: var(--r-sm);
        }

        .vt-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: .3rem .45rem;
            border-radius: 4px;
            color: var(--muted);
            transition: background .13s, color .13s;
            display: flex;
            align-items: center;
        }

        .vt-btn.active {
            background: var(--white);
            color: var(--crimson);
            box-shadow: var(--shadow-sm);
        }

        /* ── Buttons ── */
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

        .btn-green {
            background: var(--green);
            color: #fff;
        }

        .btn-green:hover {
            background: #084F2E;
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

        .btn-sm {
            padding: .32rem .7rem;
            font-size: 12px;
        }

        /* ── Stats bar ── */
        .stats-bar {
            display: flex;
            gap: 0;
            border-bottom: 1px solid var(--border);
            background: var(--white);
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
        .stat-item.active-stat .s-val {
            color: var(--green);
        }
        .stat-item.inactive-stat .s-val {
            color: var(--muted);
        }
        .offices-grid {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
        }
        .office-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: box-shadow .18s, transform .15s, border-color .18s;
            display: flex;
            flex-direction: column;
        }

        .office-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: #D4CFC9;
        }

        .card-top {
            padding: 1.1rem 1.1rem .9rem;
            display: flex;
            align-items: flex-start;
            gap: .75rem;
        }

        .office-logo {
            width: 3rem;
            height: 3rem;
            border-radius: 8px;
            flex-shrink: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            object-fit: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            letter-spacing: .03em;
        }

        .office-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 7px;
            display: none;
        }

        .office-logo img.loaded {
            display: block;
        }

        .office-info {
            flex: 1;
            min-width: 0;
        }

        .office-name {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.3;
            margin-bottom: .3rem;
        }

        .office-type-badge {
            display: inline-flex;
            align-items: center;
            gap: .25rem;
            padding: .18rem .55rem;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .card-body {
            padding: 0 1.1rem .9rem;
            flex: 1;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: .5rem;
            margin-bottom: .5rem;
            font-size: 12px;
            color: var(--muted);
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-row svg {
            flex-shrink: 0;
            margin-top: .1rem;
            color: #B5B0A8;
        }

        .info-row span {
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .info-row a {
            color: #1A5CC8;
            text-decoration: none;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
        }

        .info-row a:hover {
            text-decoration: underline;
        }

        .card-footer {
            padding: .75rem 1.1rem;
            border-top: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #FAFAF8;
            gap: .5rem;
        }

        .card-actions {
            display: flex;
            gap: .35rem;
        }

        .icon-btn {
            background: transparent;
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            padding: .3rem;
            cursor: pointer;
            color: var(--muted);
            transition: all .13s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-btn:hover.edit {
            border-color: var(--teal);
            color: var(--teal);
            background: var(--teal-light);
        }

        .icon-btn:hover.delete {
            border-color: var(--red);
            color: var(--red);
            background: var(--red-bg);
        }

        .status-dot {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            font-size: 11px;
            font-weight: 700;
        }

        .status-dot::before {
            content: '';
            width: .45rem;
            height: .45rem;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
        }

        .status-dot.active {
            color: var(--green);
        }

        .status-dot.inactive {
            color: var(--muted);
        }
        .offices-table-wrap {
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
            transition: background .1s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #FFFBF2;
        }

        td {
            padding: .85rem 1.25rem;
            vertical-align: middle;
        }
        .tbl-logo {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 6px;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            flex-shrink: 0;
            overflow: hidden;
        }
        .tbl-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }
        .tbl-logo img.loaded {
            display: block;
        }
        .tbl-name {
            font-weight: 700;
            font-size: 13px;
            color: var(--ink);
        }
        .tbl-sub {
            font-size: 11px;
            color: var(--muted);
            margin-top: .1rem;
        }
        .date-text {
            font-size: 12px;
            color: var(--muted);
        }
        .link-sm a {
            font-size: 12px;
            color: #1A5CC8;
            text-decoration: none;
        }
        .link-sm a:hover {
            text-decoration: underline;
        }
        .link-sm .none {
            font-size: 12px;
            color: #CCC;
            font-style: italic;
        }
        .row-actions {
            display: flex;
            gap: .35rem;
        }
        .row-hint {
            font-size: 11px;
            color: #B0ADA8;
            font-style: italic;
            padding: .4rem 1.25rem .5rem;
            background: #FAFAF8;
            border-top: 1px solid var(--border-light);
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .22rem .65rem;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .pill-green {
            background: var(--green-bg);
            color: var(--green);
        }

        .pill-gray {
            background: var(--gray-bg);
            color: var(--gray-text);
        }

        .pill-blue {
            background: var(--blue-bg);
            color: var(--blue);
        }

        .pill-gold {
            background: var(--gold-bg);
            color: var(--gold);
        }

        .pill-purple {
            background: var(--purple-bg);
            color: var(--purple);
        }

        .pill-dot {
            width: .38rem;
            height: .38rem;
            border-radius: 50%;
            background: currentColor;
        }

        .pagination {
            padding: .85rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            gap: .5rem;
            background: #FAFAF8;
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

        .skel-card {
            height: 200px;
            border-radius: var(--r);
        }

        .skel-logo {
            width: 3rem;
            height: 3rem;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .skel-sm {
            height: 12px;
            width: 55%;
        }
        .skel-md {
            height: 12px;
            width: 75%;
        }
        .skel-lg {
            height: 14px;
            width: 85%;
        }
        .skel-pill {
            height: 20px;
            width: 70px;
            border-radius: 999px;
        }
        .skel-badge {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 6px;
            flex-shrink: 0;
        }
        .skel-card-full {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 1.1rem;
            box-shadow: var(--shadow-sm);
        }
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
            max-width: 480px;
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
        .modal.wide {
            max-width: 680px;
        }
        .modal.narrow {
            max-width: 400px;
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
            transition: background .12s, color .12s;
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
            flex-wrap: wrap;
        }
        .footer-left {
            display: flex;
            gap: .5rem;
            align-items: center;
        }
        .footer-right {
            display: flex;
            gap: .5rem;
            align-items: center;
            margin-left: auto;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .form-grid .full {
            grid-column: 1 / -1;
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
        .field input,
        .field textarea,
        .field select {
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
        .field input:focus,
        .field textarea:focus,
        .field select:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13, 107, 99, .10);
        }
        .field textarea {
            resize: vertical;
            min-height: 72px;
        }
        .upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--r-sm);
            padding: 1.1rem;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s, background .15s;
        }
        .upload-area:hover {
            border-color: var(--teal);
            background: var(--teal-light);
        }
        .upload-area p {
            font-size: 12px;
            color: var(--muted);
            margin-top: .3rem;
        }
        .upload-area small {
            font-size: 11px;
            color: #aaa;
        }

        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem 1.5rem;
        }

        .info-section .full {
            grid-column: 1 / -1;
        }

        .info-item .lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            margin-bottom: .28rem;
        }

        .info-item .val {
            font-size: 13px;
            color: var(--ink);
        }

        .info-item .val a {
            color: #1A5CC8;
            text-decoration: none;
        }

        .info-item .val a:hover {
            text-decoration: underline;
        }
        .view-office-head {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.3rem;
            padding-bottom: 1.1rem;
            border-bottom: 1px solid var(--border);
        }
        .view-office-logo {
            width: 4rem;
            height: 4rem;
            border-radius: 10px;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            flex-shrink: 0;
            overflow: hidden;
        }
        .view-office-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }
        .view-office-logo img.loaded {
            display: block;
        }
        .view-office-head h3 {
            font-size: 17px;
            font-weight: 700;
            color: var(--ink);
        }
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

        .toast.info {
            background: var(--blue);
        }

        .toast-icon {
            flex-shrink: 0;
        }

        .hidden {
            display: none !important;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .gap-2 {
            gap: .5rem;
        }

        .gap-3 {
            gap: .75rem;
        }

        @media (max-width: 640px) {
            .page {
                padding: 1.1rem 1rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .info-section {
                grid-template-columns: 1fr;
            }

            .offices-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .stats-bar {
                flex-wrap: wrap;
            }

            .stat-item {
                min-width: 50%;
            }

            .modal-body {
                padding: 1.1rem;
            }

            .modal-header {
                padding: 1rem 1.1rem .9rem;
            }

            .modal-footer {
                padding: .85rem 1.1rem;
            }
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="page-header">
            <h1>Affiliated Offices</h1>
            <p>Manage affiliated offices and their public information</p>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h2>Office Directory</h2>
                    <p id="officeSubline">Loading offices…</p>
                </div>
                <button class="btn btn-gold" onclick="openAddModal()">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    Add Office
                </button>
            </div>

            <div class="stats-bar" id="statsBar">
                <div class="stat-item">
                    <div class="s-val" id="statTotal">—</div>
                    <div class="s-lbl">Total Offices</div>
                </div>
                <div class="stat-item active-stat">
                    <div class="s-val" id="statActive">—</div>
                    <div class="s-lbl">Active</div>
                </div>
                <div class="stat-item inactive-stat">
                    <div class="s-val" id="statInactive">—</div>
                    <div class="s-lbl">Inactive</div>
                </div>
                <div class="stat-item">
                    <div class="s-val" id="statGov">—</div>
                    <div class="s-lbl">Government</div>
                </div>
            </div>

            <div class="toolbar">
                <div class="search-wrap">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input type="text" id="officeSearch" placeholder="Search offices…">
                </div>
                <select id="officeTypeFilter">
                    <option value="">All Types</option>
                    <option value="government">Government Agency</option>
                    <option value="ngo">NGO</option>
                    <option value="private">Private Sector</option>
                    <option value="international">International Org</option>
                </select>
                <select id="officeStatusFilter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <select id="officeSort">
                    <option value="name">Sort by Name</option>
                    <option value="type">Sort by Type</option>
                    <option value="status">Sort by Status</option>
                </select>
                <div class="view-toggle">
                    <button class="vt-btn active" id="btnGrid" onclick="setView('grid')" title="Grid view">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" />
                            <rect x="14" y="3" width="7" height="7" />
                            <rect x="3" y="14" width="7" height="7" />
                            <rect x="14" y="14" width="7" height="7" />
                        </svg>
                    </button>
                    <button class="vt-btn" id="btnList" onclick="setView('list')" title="List view">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="8" y1="6" x2="21" y2="6" />
                            <line x1="8" y1="12" x2="21" y2="12" />
                            <line x1="8" y1="18" x2="21" y2="18" />
                            <line x1="3" y1="6" x2="3.01" y2="6" />
                            <line x1="3" y1="12" x2="3.01" y2="12" />
                            <line x1="3" y1="18" x2="3.01" y2="18" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="gridView" class="offices-grid"></div>

            <div id="listView" class="offices-table-wrap hidden">
                <table>
                    <thead>
                        <tr>
                            <th>Office</th>
                            <th>Type</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="listTableBody"></tbody>
                </table>
                <div class="row-hint">Click any row to view full details</div>
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

    <div class="overlay" id="officeModal">
        <div class="modal wide">
            <div class="modal-header">
                <div>
                    <h3 id="officeModalTitle">Add Office</h3>
                    <p id="officeModalSub">Fill in the office details below</p>
                </div>
                <button class="modal-close" onclick="closeModal('officeModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="field">
                        <label>Office Name <span class="req">*</span></label>
                        <input type="text" id="officeName" placeholder="e.g. Department of Education">
                    </div>
                    <div class="field">
                        <label>Office Type</label>
                        <select id="officeType">
                            <option value="government">Government Agency</option>
                            <option value="ngo">NGO</option>
                            <option value="private">Private Sector</option>
                            <option value="international">International Organization</option>
                        </select>
                    </div>
                    <div class="field full">
                        <label>Complete Address <span class="req">*</span></label>
                        <textarea id="officeAddress" placeholder="Enter full address…"></textarea>
                    </div>
                    <div class="field">
                        <label>Contact Number</label>
                        <input type="tel" id="officeContact" placeholder="(02) 123-4567">
                    </div>
                    <div class="field">
                        <label>Email Address</label>
                        <input type="email" id="officeEmail" placeholder="info@office.gov.ph">
                    </div>
                    <div class="field">
                        <label>Website <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                        <input type="url" id="officeWebsite" placeholder="https://www.office.gov.ph">
                    </div>
                    <div class="field">
                        <label>Facebook Page <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                        <input type="url" id="officeFacebook" placeholder="https://facebook.com/office">
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select id="officeStatus">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="field full">
                        <label>Office Logo <span style="font-weight:400;color:var(--muted)">(Optional)</span></label>
                        <div class="upload-area" onclick="document.getElementById('officeLogoInput').click()">
                            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto">
                                <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p>Click to upload logo</p>
                            <small>PNG, JPG up to 2MB</small>
                            <input type="file" id="officeLogoInput" accept="image/*" class="hidden" onchange="previewLogo(event)">
                        </div>
                        <div id="logoPreview" class="hidden" style="margin-top:.6rem;display:flex;align-items:center;gap:.65rem">
                            <img id="logoPreviewImg" style="width:3rem;height:3rem;border-radius:8px;object-fit:cover;border:1px solid var(--border)" alt="">
                            <div>
                                <div style="font-size:12px;font-weight:700;color:var(--ink)" id="logoFileName">—</div>
                                <div style="font-size:11px;color:var(--muted)">Logo preview</div>
                            </div>
                            <button type="button" onclick="clearLogo()" style="margin-left:auto;background:transparent;border:none;cursor:pointer;color:var(--muted);font-size:11px">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left"></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('officeModal')">Cancel</button>
                    <button class="btn btn-gold" onclick="submitOfficeForm()">Save Office</button>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay" id="viewOfficeModal">
        <div class="modal wide">
            <div class="modal-header">
                <div>
                    <h3>Office Details</h3>
                    <p>Publicly visible information</p>
                </div>
                <button class="modal-close" onclick="closeModal('viewOfficeModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="view-office-head">
                    <div class="view-office-logo" id="vo-logo">—</div>
                    <div>
                        <h3 id="vo-name">Office Name</h3>
                        <div style="display:flex;align-items:center;gap:.5rem;margin-top:.35rem">
                            <span class="pill" id="vo-type-badge">Gov</span>
                            <span class="pill" id="vo-status-badge"><span class="pill-dot"></span> Active</span>
                        </div>
                    </div>
                </div>
                <div class="info-section">
                    <div class="info-item full">
                        <div class="lbl">Address</div>
                        <div class="val" id="vo-address">—</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Contact Number</div>
                        <div class="val" id="vo-contact">—</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Email Address</div>
                        <div class="val" id="vo-email">—</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Website</div>
                        <div class="val" id="vo-website">—</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Facebook Page</div>
                        <div class="val" id="vo-facebook">—</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left">
                    <button class="btn btn-danger" id="vo-delete-btn">Delete</button>
                </div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('viewOfficeModal')">Close</button>
                    <button class="btn btn-crimson-outline" id="vo-edit-btn">Edit Office</button>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay" id="confirmModal">
        <div class="modal narrow">
            <div class="modal-body confirm-body" style="padding:2rem 1.5rem 1.5rem">
                <div class="confirm-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                    </svg>
                </div>
                <h3 id="confirmTitle">Delete Office?</h3>
                <p id="confirmMsg">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <div class="footer-left"></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('confirmModal')">Cancel</button>
                    <button class="btn btn-danger" id="confirmActionBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-wrap" id="toastWrap"></div>

    <script>
        let offices = [{
                id: 1,
                name: 'Department of Education',
                type: 'government',
                address: '123 Education Ave, Manila',
                contact: '(02) 123-4567',
                email: 'info@deped.gov.ph',
                website: 'https://deped.gov.ph',
                facebook: 'https://fb.com/depedph',
                status: 'active',
                logo: ''
            },
            {
                id: 2,
                name: 'Department of Health',
                type: 'government',
                address: '456 Health Blvd, Quezon City',
                contact: '(02) 987-6543',
                email: 'info@doh.gov.ph',
                website: 'https://doh.gov.ph',
                facebook: 'https://fb.com/dohgov',
                status: 'active',
                logo: ''
            },
            {
                id: 3,
                name: 'Department of Agriculture',
                type: 'government',
                address: '789 Farm Road, Laguna',
                contact: '(049) 555-1234',
                email: 'info@da.gov.ph',
                website: 'https://da.gov.ph',
                facebook: '',
                status: 'inactive',
                logo: ''
            },
            {
                id: 4,
                name: 'Department of Tourism',
                type: 'government',
                address: '321 Tourism Ave, Pasay',
                contact: '(02) 777-8888',
                email: 'info@tourism.gov.ph',
                website: 'https://tourism.gov.ph',
                facebook: 'https://fb.com/tourismph',
                status: 'active',
                logo: ''
            },
            {
                id: 5,
                name: 'Red Cross Philippines',
                type: 'ngo',
                address: 'Bonifacio Drive, Port Area, Manila',
                contact: '(02) 527-0000',
                email: 'info@redcross.org.ph',
                website: 'https://redcross.org.ph',
                facebook: 'https://fb.com/redcrossph',
                status: 'active',
                logo: ''
            },
            {
                id: 6,
                name: 'UNICEF Philippines',
                type: 'international',
                address: 'Rockwell Center, Makati',
                contact: '(02) 901-0100',
                email: 'manila@unicef.org',
                website: 'https://unicef.org/philippines',
                facebook: '',
                status: 'active',
                logo: ''
            },
        ];

        let currentView = 'grid';
        let editingId = null;
        let selectedLogoData = null;

        /* ── Type config ── */
        const typeConfig = {
            government: {
                label: 'Government',
                pillClass: 'pill-gold'
            },
            ngo: {
                label: 'NGO',
                pillClass: 'pill-green'
            },
            private: {
                label: 'Private',
                pillClass: 'pill-blue'
            },
            international: {
                label: 'Intl. Org',
                pillClass: 'pill-purple'
            },
        };

        function typePill(type) {
            const c = typeConfig[type] || {
                label: type,
                pillClass: 'pill-gray'
            };
            return `<span class="pill ${c.pillClass}">${c.label}</span>`;
        }

        function statusPill(status) {
            return status === 'active' ?
                `<span class="pill pill-green"><span class="pill-dot"></span>Active</span>` :
                `<span class="pill pill-gray"><span class="pill-dot"></span>Inactive</span>`;
        }

        function initials(name) {
            return name.split(' ').map(w => w[0]).slice(0, 3).join('').toUpperCase();
        }

        function filtered() {
            const q = document.getElementById('officeSearch').value.toLowerCase();
            const type = document.getElementById('officeTypeFilter').value;
            const stat = document.getElementById('officeStatusFilter').value;
            const sort = document.getElementById('officeSort').value;

            let rows = offices.filter(o =>
                (!q || o.name.toLowerCase().includes(q) || o.address.toLowerCase().includes(q)) &&
                (!type || o.type === type) &&
                (!stat || o.status === stat)
            );
            if (sort === 'name') rows.sort((a, b) => a.name.localeCompare(b.name));
            if (sort === 'type') rows.sort((a, b) => a.type.localeCompare(b.type));
            if (sort === 'status') rows.sort((a, b) => a.status.localeCompare(b.status));
            return rows;
        }

        /* ── Stats ── */
        function updateStats() {
            document.getElementById('statTotal').textContent = offices.length;
            document.getElementById('statActive').textContent = offices.filter(o => o.status === 'active').length;
            document.getElementById('statInactive').textContent = offices.filter(o => o.status === 'inactive').length;
            document.getElementById('statGov').textContent = offices.filter(o => o.type === 'government').length;
        }

        function showSkeleton() {
            if (currentView === 'grid') {
                document.getElementById('gridView').innerHTML = Array.from({
                    length: 6
                }, () => `
      <div class="skel-card-full">
        <div class="flex gap-2 items-center" style="margin-bottom:.9rem">
          <div class="skel skel-logo"></div>
          <div style="flex:1"><div class="skel skel-lg" style="margin-bottom:.4rem"></div><div class="skel skel-pill"></div></div>
        </div>
        <div class="skel skel-md" style="margin-bottom:.4rem"></div>
        <div class="skel skel-sm" style="margin-bottom:.4rem"></div>
        <div class="skel skel-md"></div>
      </div>`).join('');
            } else {
                document.getElementById('listTableBody').innerHTML = Array.from({
                    length: 5
                }, () => `
      <tr>
        <td><div class="flex items-center gap-2"><div class="skel skel-badge"></div><div class="skel skel-lg"></div></div></td>
        <td><div class="skel skel-pill"></div></td>
        <td><div class="skel skel-sm"></div></td>
        <td><div class="skel skel-md"></div></td>
        <td><div class="skel skel-sm"></div></td>
        <td><div class="skel skel-pill"></div></td>
        <td></td>
      </tr>`).join('');
            }
        }
        function render(instant) {
            if (!instant) {
                showSkeleton();
                setTimeout(_render, 550);
            } else {
                _render();
            }
        }

        function _render() {
            const rows = filtered();
            updateStats();

            document.getElementById('officeSubline').textContent =
                `${offices.length} office${offices.length!==1?'s':''} · click a card to view details`;
            document.getElementById('pagText').innerHTML =
                `Showing <b>${rows.length}</b> of <b>${offices.length}</b> offices`;

            if (currentView === 'grid') {
                if (!rows.length) {
                    document.getElementById('gridView').innerHTML = `
        <div class="empty-state" style="grid-column:1/-1">
          <div class="empty-icon"><svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
          <h3>No offices found</h3>
          <p>Try adjusting your search or filters.</p>
        </div>`;
                    return;
                }
                document.getElementById('gridView').innerHTML = rows.map(o => `
      <div class="office-card" onclick="openViewModal(${o.id})">
        <div class="card-top">
          <div class="office-logo" id="logo-${o.id}">${o.logo ? `<img src="${o.logo}" alt="" onload="this.classList.add('loaded')">` : initials(o.name)}</div>
          <div class="office-info">
            <div class="office-name">${o.name}</div>
            ${typePill(o.type)}
          </div>
        </div>
        <div class="card-body">
          <div class="info-row">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span title="${o.address}">${o.address}</span>
          </div>
          <div class="info-row">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>${o.contact || '—'}</span>
          </div>
          <div class="info-row">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span title="${o.email}">${o.email || '—'}</span>
          </div>
          ${o.website ? `<div class="info-row">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
            <a href="${o.website}" target="_blank" onclick="event.stopPropagation()">${o.website.replace('https://','')}</a>
          </div>` : ''}
        </div>
        <div class="card-footer">
          <span class="status-dot ${o.status}">${o.status==='active'?'Active':'Inactive'}</span>
          <div class="card-actions">
            <button class="icon-btn edit" title="Edit" onclick="event.stopPropagation();openEditModal(${o.id})">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>
            <button class="icon-btn delete" title="Delete" onclick="event.stopPropagation();confirmDelete(${o.id})">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
            </button>
          </div>
        </div>
      </div>`).join('');
            } else {
                if (!rows.length) {
                    document.getElementById('listTableBody').innerHTML = `
        <tr><td colspan="7" style="text-align:center;padding:3rem">
          <div style="color:var(--muted);font-size:13px">No offices found. Try adjusting your search or filters.</div>
        </td></tr>`;
                    return;
                }
                document.getElementById('listTableBody').innerHTML = rows.map(o => `
      <tr onclick="openViewModal(${o.id})">
        <td><div class="flex items-center gap-2">
          <div class="tbl-logo">${o.logo ? `<img src="${o.logo}" alt="" onload="this.classList.add('loaded')">` : initials(o.name)}</div>
          <div><div class="tbl-name">${o.name}</div></div>
        </div></td>
        <td>${typePill(o.type)}</td>
        <td class="date-text">${o.contact||'—'}</td>
        <td class="date-text">${o.email||'—'}</td>
        <td class="link-sm">${o.website?`<a href="${o.website}" target="_blank" onclick="event.stopPropagation()">${o.website.replace('https://','')}</a>`:'<span class="none">—</span>'}</td>
        <td>${statusPill(o.status)}</td>
        <td onclick="event.stopPropagation()">
          <div class="row-actions">
            <button class="icon-btn edit" title="Edit" onclick="openEditModal(${o.id})">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>
            <button class="icon-btn delete" title="Delete" onclick="confirmDelete(${o.id})">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
            </button>
          </div>
        </td>
      </tr>`).join('');
            }
        }

        function setView(v) {
            currentView = v;
            document.getElementById('gridView').classList.toggle('hidden', v !== 'grid');
            document.getElementById('listView').classList.toggle('hidden', v !== 'list');
            document.getElementById('btnGrid').classList.toggle('active', v === 'grid');
            document.getElementById('btnList').classList.toggle('active', v === 'list');
            render(true);
        }

        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }
        document.querySelectorAll('.overlay').forEach(o =>
            o.addEventListener('click', e => {
                if (e.target === o) o.classList.remove('open');
            })
        );

        function openAddModal() {
            editingId = null;
            document.getElementById('officeModalTitle').textContent = 'Add Office';
            document.getElementById('officeModalSub').textContent = 'Fill in the office details below';
            ['officeName', 'officeContact', 'officeAddress', 'officeEmail', 'officeWebsite', 'officeFacebook'].forEach(id => document.getElementById(id).value = '');
            document.getElementById('officeType').value = 'government';
            document.getElementById('officeStatus').value = 'active';
            clearLogo();
            openModal('officeModal');
        }

        function openEditModal(id) {
            const o = offices.find(x => x.id === id);
            if (!o) return;
            editingId = id;
            document.getElementById('officeModalTitle').textContent = 'Edit Office';
            document.getElementById('officeModalSub').textContent = o.name;
            document.getElementById('officeName').value = o.name;
            document.getElementById('officeType').value = o.type;
            document.getElementById('officeAddress').value = o.address;
            document.getElementById('officeContact').value = o.contact;
            document.getElementById('officeEmail').value = o.email;
            document.getElementById('officeWebsite').value = o.website;
            document.getElementById('officeFacebook').value = o.facebook || '';
            document.getElementById('officeStatus').value = o.status;
            clearLogo();
            closeModal('viewOfficeModal');
            openModal('officeModal');
        }

        function submitOfficeForm() {
            const name = document.getElementById('officeName').value.trim();
            if (!name) {
                toast('Office name is required.', 'error');
                return;
            }
            const data = {
                name,
                type: document.getElementById('officeType').value,
                address: document.getElementById('officeAddress').value.trim(),
                contact: document.getElementById('officeContact').value.trim(),
                email: document.getElementById('officeEmail').value.trim(),
                website: document.getElementById('officeWebsite').value.trim(),
                facebook: document.getElementById('officeFacebook').value.trim(),
                status: document.getElementById('officeStatus').value,
                logo: selectedLogoData || '',
            };
            if (editingId) {
                const o = offices.find(x => x.id === editingId);
                if (o) Object.assign(o, data);
                toast('Office updated successfully.', 'success');
            } else {
                const newId = offices.length ? Math.max(...offices.map(x => x.id)) + 1 : 1;
                offices.push({
                    id: newId,
                    ...data
                });
                toast('Office added successfully.', 'success');
            }
            closeModal('officeModal');
            render(true);
        }

        function openViewModal(id) {
            const o = offices.find(x => x.id === id);
            if (!o) return;
            // Logo
            const logoEl = document.getElementById('vo-logo');
            if (o.logo) {
                logoEl.innerHTML = `<img src="${o.logo}" alt="" style="width:100%;height:100%;object-fit:cover" onload="this.style.display='block'">`;
            } else {
                logoEl.textContent = initials(o.name);
            }
            document.getElementById('vo-name').textContent = o.name;
            const tc = typeConfig[o.type] || {
                label: o.type,
                pillClass: 'pill-gray'
            };
            document.getElementById('vo-type-badge').className = 'pill ' + tc.pillClass;
            document.getElementById('vo-type-badge').textContent = tc.label;
            document.getElementById('vo-status-badge').className = 'pill ' + (o.status === 'active' ? 'pill-green' : 'pill-gray');
            document.getElementById('vo-status-badge').innerHTML = `<span class="pill-dot"></span> ${o.status==='active'?'Active':'Inactive'}`;
            document.getElementById('vo-address').textContent = o.address || '—';
            document.getElementById('vo-contact').textContent = o.contact || '—';
            document.getElementById('vo-email').textContent = o.email || '—';
            document.getElementById('vo-website').innerHTML = o.website ? `<a href="${o.website}"  target="_blank">${o.website}</a>` : '—';
            document.getElementById('vo-facebook').innerHTML = o.facebook ? `<a href="${o.facebook}" target="_blank">${o.facebook}</a>` : '—';
            document.getElementById('vo-edit-btn').onclick = () => openEditModal(id);
            document.getElementById('vo-delete-btn').onclick = () => {
                closeModal('viewOfficeModal');
                confirmDelete(id);
            };
            openModal('viewOfficeModal');
        }

        function confirmDelete(id) {
            const o = offices.find(x => x.id === id);
            document.getElementById('confirmTitle').textContent = 'Delete ' + (o ? o.name : 'this office') + '?';
            document.getElementById('confirmMsg').textContent = 'This office will be permanently removed. This cannot be undone.';
            document.getElementById('confirmActionBtn').onclick = () => {
                offices = offices.filter(x => x.id !== id);
                closeModal('confirmModal');
                render(true);
                toast('Office deleted.', 'success');
            };
            openModal('confirmModal');
        }

        function previewLogo(e) {
            const file = e.target.files[0];
            if (!file) return;
            if (file.size > 2 * 1024 * 1024) {
                toast('File too large. Max 2MB.', 'error');
                return;
            }
            const r = new FileReader();
            r.onload = ev => {
                selectedLogoData = ev.target.result;
                document.getElementById('logoPreviewImg').src = ev.target.result;
                document.getElementById('logoFileName').textContent = file.name;
                const p = document.getElementById('logoPreview');
                p.classList.remove('hidden');
                p.style.display = 'flex';
            };
            r.readAsDataURL(file);
        }

        function clearLogo() {
            selectedLogoData = null;
            document.getElementById('officeLogoInput').value = '';
            document.getElementById('logoPreview').classList.add('hidden');
        }

        function toast(msg, type = 'info') {
            const icons = {
                success: `<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>`,
                error: `<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
                info: `<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`,
            };
            const el = document.createElement('div');
            el.className = `toast ${type}`;
            el.innerHTML = `<span class="toast-icon">${icons[type]||icons.info}</span><span>${msg}</span>`;
            document.getElementById('toastWrap').appendChild(el);
            requestAnimationFrame(() => {
                requestAnimationFrame(() => el.classList.add('show'));
            });
            setTimeout(() => {
                el.classList.remove('show');
                setTimeout(() => el.remove(), 350);
            }, 3000);
        }

        ['officeSearch', 'officeTypeFilter', 'officeStatusFilter', 'officeSort'].forEach(id =>
            document.getElementById(id).addEventListener('input', () => render(true))
        );
        document.getElementById('officeSort').addEventListener('change', () => render(true));
        document.getElementById('officeTypeFilter').addEventListener('change', () => render(true));
        document.getElementById('officeStatusFilter').addEventListener('change', () => render(true));
        render();
    </script>
</body>

</html>
@endsection