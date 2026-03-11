@extends('editor.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
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
        .card {
            background: var(--white);
            border-radius: var(--r);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            width: 100%;
        }
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
        .stats-bar {
            display: flex;
            gap: 0;
            border-bottom: 1px solid var(--border);
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

        .stat-item.pub .s-val {
            color: var(--green);
        }

        .stat-item.dft .s-val {
            color: var(--gold);
        }
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

        .btn-teal {
            background: var(--teal);
            color: #fff;
        }

        .btn-teal:hover {
            background: #0A5850;
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
        .btn-save-order {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .42rem .9rem;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            font-family: Arial, sans-serif;
            cursor: pointer;
            border: none;
            background: linear-gradient(135deg, var(--teal) 0%, #0A9688 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(13, 107, 99, .28);
            transition: box-shadow .18s, transform .13s;
            white-space: nowrap;
        }

        .btn-save-order:hover {
            box-shadow: 0 4px 14px rgba(13, 107, 99, .38);
            transform: translateY(-1px);
        }

        .btn-save-order:active {
            transform: scale(.96);
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

        .icon-btn:hover.image {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-bg);
        }

        .icon-btn:hover.pub {
            border-color: var(--green);
            color: var(--green);
            background: var(--green-bg);
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

        .pill-gold {
            background: var(--gold-bg);
            color: var(--gold);
        }

        .pill-gray {
            background: var(--gray-bg);
            color: var(--gray-text);
        }

        .pill-dot {
            width: .38rem;
            height: .38rem;
            border-radius: 50%;
            background: currentColor;
        }
        .services-grid {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 1.25rem;
        }

        .svc-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: box-shadow .18s, transform .15s, border-color .18s;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .svc-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: #D4CFC9;
        }

        .svc-card.dragging {
            opacity: .45;
            transform: scale(.97);
        }

        .svc-card.drag-over {
            border-color: var(--gold-bright);
            box-shadow: 0 0 0 2px var(--gold-bright);
        }
        .drag-handle {
            position: absolute;
            top: .6rem;
            left: .6rem;
            z-index: 2;
            background: rgba(255, 255, 255, .85);
            border: 1px solid var(--border);
            border-radius: 5px;
            padding: .28rem .3rem;
            cursor: grab;
            color: #B5B0A8;
            display: flex;
            align-items: center;
            transition: background .13s, color .13s;
        }

        .drag-handle:hover {
            background: #fff;
            color: var(--muted);
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .svc-img-wrap {
            position: relative;
            height: 160px;
            background: var(--surface);
            overflow: hidden;
            flex-shrink: 0;
        }

        .svc-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .3s;
            display: none;
        }

        .svc-img-wrap img.loaded {
            display: block;
        }

        .svc-card:hover .svc-img-wrap img {
            transform: scale(1.04);
        }

        .svc-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .svc-img-placeholder svg {
            color: #D4CFC9;
        }

        .svc-status-badge {
            position: absolute;
            top: .6rem;
            right: .6rem;
        }

        .svc-body {
            padding: 1rem 1rem .75rem;
            flex: 1;
        }

        .svc-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: .4rem;
            line-height: 1.3;
        }

        .svc-desc {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.55;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .svc-steps-preview {
            padding: .6rem 1rem;
            background: var(--surface);
            border-top: 1px solid var(--border-light);
            font-size: 11px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: .35rem;
        }

        .svc-steps-preview strong {
            color: var(--ink-2);
        }

        .svc-footer {
            padding: .75rem 1rem;
            border-top: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #FAFAF8;
        }

        .svc-actions {
            display: flex;
            gap: .35rem;
        }
        .services-table-wrap {
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

        tbody tr.dragging {
            opacity: .45;
        }

        tbody tr.drag-over {
            border-top: 2px solid var(--gold-bright);
        }

        td {
            padding: .85rem 1.25rem;
            vertical-align: middle;
        }

        .tbl-thumb {
            width: 3.5rem;
            height: 2.5rem;
            border-radius: 6px;
            object-fit: cover;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .tbl-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .tbl-thumb img.loaded {
            display: block;
        }

        .tbl-name {
            font-weight: 700;
            font-size: 13px;
            color: var(--ink);
        }

        .tbl-steps {
            font-size: 11px;
            color: var(--muted);
            margin-top: .15rem;
        }

        .desc-text {
            font-size: 12px;
            color: var(--muted);
            max-width: 280px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .drag-col {
            color: #C5C0B8;
            cursor: grab;
            padding: .85rem .75rem .85rem 1.25rem;
        }

        .drag-col:active {
            cursor: grabbing;
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

        .skel-img {
            width: 100%;
            height: 160px;
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
            width: 90%;
        }

        .skel-pill {
            height: 20px;
            width: 70px;
            border-radius: 999px;
        }

        .skel-thumb {
            width: 3.5rem;
            height: 2.5rem;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .skel-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
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
            max-height: 92vh;
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
            max-width: 780px;
        }

        .modal.narrow {
            max-width: 420px;
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

        .field label .opt {
            color: var(--muted);
            font-weight: 400;
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
            min-height: 80px;
        }
        .form-section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            padding: .6rem 0 .3rem;
            border-bottom: 1px solid var(--border-light);
            margin-bottom: .75rem;
        }
        .steps-list {
            display: flex;
            flex-direction: column;
            gap: .5rem;
            margin-bottom: .6rem;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: .5rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            padding: .6rem .75rem;
        }

        .step-num {
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            background: var(--gold-bg);
            border: 1px solid #E8C97A;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: var(--gold);
            flex-shrink: 0;
            margin-top: .1rem;
        }

        .step-input {
            flex: 1;
            border: none;
            background: transparent;
            font-size: 13px;
            font-family: Arial, sans-serif;
            color: var(--ink);
            resize: none;
            min-height: 36px;
            padding: 0;
        }

        .step-input:focus {
            outline: none;
        }

        .step-del {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #C5C0B8;
            padding: .15rem;
            transition: color .13s;
            flex-shrink: 0;
        }

        .step-del:hover {
            color: var(--red);
        }

        .btn-add-step {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .35rem .75rem;
            border-radius: var(--r-sm);
            font-size: 12px;
            font-weight: 700;
            font-family: Arial, sans-serif;
            cursor: pointer;
            border: 1.5px dashed var(--border);
            background: transparent;
            color: var(--muted);
            transition: border-color .15s, color .15s, background .15s;
        }

        .btn-add-step:hover {
            border-color: var(--teal);
            color: var(--teal);
            background: var(--teal-light);
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
        .view-svc-head {
            margin-bottom: 1.25rem;
        }

        .view-svc-img {
            width: 100%;
            height: 180px;
            border-radius: 8px;
            object-fit: cover;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .view-svc-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .view-svc-img img.loaded {
            display: block;
        }

        .view-svc-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: .4rem;
        }

        .view-svc-desc {
            font-size: 13px;
            color: var(--ink-2);
            line-height: 1.6;
        }

        .section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            margin-bottom: .6rem;
            margin-top: 1.25rem;
        }
        .steps-display {
            display: flex;
            flex-direction: column;
            gap: .55rem;
        }

        .step-display-item {
            display: flex;
            align-items: flex-start;
            gap: .75rem;
        }

        .step-display-num {
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 50%;
            background: var(--gold-bg);
            border: 1.5px solid #E8C97A;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--gold);
            flex-shrink: 0;
            margin-top: .1rem;
        }

        .step-display-line {
            flex: 1;
        }

        .step-display-text {
            font-size: 13px;
            color: var(--ink);
        }
        .full-desc-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            padding: .85rem 1rem;
            font-size: 13px;
            color: var(--ink-2);
            line-height: 1.65;
            white-space: pre-wrap;
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

            .services-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .stats-bar {
                flex-wrap: wrap;
            }

            .stat-item {
                min-width: 50%;
            }
        }
    </style>
</head>

<body>
    <div class="page">

        <div class="page-header">
            <h1>Manage Services</h1>
            <p>Create, organize, and publish services with step-by-step instructions for the public</p>
        </div>

        <div class="card">

            <!-- Card header -->
            <div class="card-header">
                <div>
                    <h2>Service Directory</h2>
                    <p id="svcSubline">Loading services…</p>
                </div>
                <button class="btn btn-gold" onclick="openAddModal()">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    Add Service
                </button>
            </div>

            <!-- Stats -->
            <div class="stats-bar">
                <div class="stat-item">
                    <div class="s-val" id="statTotal">—</div>
                    <div class="s-lbl">Total Services</div>
                </div>
                <div class="stat-item pub">
                    <div class="s-val" id="statPub">—</div>
                    <div class="s-lbl">Published</div>
                </div>
                <div class="stat-item dft">
                    <div class="s-val" id="statDraft">—</div>
                    <div class="s-lbl">Draft</div>
                </div>
                <div class="stat-item">
                    <div class="s-val" id="statSteps">—</div>
                    <div class="s-lbl">Avg. Steps</div>
                </div>
            </div>

            <!-- Toolbar -->
            <div class="toolbar">
                <div class="search-wrap">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input type="text" id="svcSearch" placeholder="Search services…">
                </div>
                <select id="svcFilter">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
                <button class="btn-save-order" onclick="saveOrder()">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V2" />
                    </svg>
                    Save Order
                </button>
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

            <!-- Grid view -->
            <div id="gridView" class="services-grid"></div>

            <!-- List view -->
            <div id="listView" class="services-table-wrap hidden">
                <table>
                    <thead>
                        <tr>
                            <th style="width:2rem"></th>
                            <th>Service</th>
                            <th>Description</th>
                            <th>Steps</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="listBody"></tbody>
                </table>
                <div class="row-hint">Click any row to view full details · Drag to reorder</div>
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


    <!-- ══ MODAL: Add / Edit Service ══ -->
    <div class="overlay" id="svcModal">
        <div class="modal wide">
            <div class="modal-header">
                <div>
                    <h3 id="svcModalTitle">Add Service</h3>
                    <p id="svcModalSub">Fill in the service details and instructions</p>
                </div>
                <button class="modal-close" onclick="closeModal('svcModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-grid">

                    <!-- Basic info -->
                    <div class="field">
                        <label>Service Name <span class="req">*</span></label>
                        <input type="text" id="fName" placeholder="e.g. Health Services">
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select id="fStatus">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="field full">
                        <label>Short Description <span class="req">*</span></label>
                        <textarea id="fDesc" placeholder="Brief summary shown on the service card (2–3 sentences)…" style="min-height:64px"></textarea>
                    </div>
                    <div class="field full">
                        <label>Full Description <span class="opt">(Optional)</span></label>
                        <textarea id="fFullDesc" placeholder="Detailed explanation of what this service offers, who it's for, and any requirements…" style="min-height:96px"></textarea>
                    </div>

                    <!-- How-to Steps -->
                    <div class="field full">
                        <div class="form-section-title">
                            How-To Instructions
                            <span style="font-weight:400;text-transform:none;letter-spacing:0;font-size:11px;color:var(--muted);margin-left:.5rem">— Step-by-step guide shown to the public</span>
                        </div>
                        <div class="steps-list" id="stepsList"></div>
                        <button type="button" class="btn-add-step" onclick="addStep()">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                            Add Step
                        </button>
                    </div>

                    <!-- Image -->
                    <div class="field full">
                        <div class="form-section-title">Service Image</div>
                        <div class="upload-area" onclick="document.getElementById('fImage').click()">
                            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p>Click to upload service image</p>
                            <small>PNG, JPG up to 5MB · Recommended 1200×600px</small>
                            <input type="file" id="fImage" accept="image/*" class="hidden" onchange="previewImg(event)">
                        </div>
                        <div id="imgPreviewWrap" class="hidden" style="margin-top:.65rem;display:flex;align-items:center;gap:.75rem">
                            <img id="imgPreviewEl" style="width:5rem;height:3.5rem;border-radius:6px;object-fit:cover;border:1px solid var(--border)" alt="">
                            <div>
                                <div style="font-size:12px;font-weight:700;color:var(--ink)" id="imgFileName">—</div>
                                <div style="font-size:11px;color:var(--muted)" id="imgFileSize">—</div>
                            </div>
                            <button type="button" onclick="clearImg()" style="margin-left:auto;background:transparent;border:none;cursor:pointer;color:var(--muted);font-size:11px">Remove</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left"></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('svcModal')">Cancel</button>
                    <button class="btn btn-gold" onclick="submitForm()">Save Service</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ══ MODAL: View Service ══ -->
    <div class="overlay" id="viewModal">
        <div class="modal wide">
            <div class="modal-header">
                <div>
                    <h3>Service Details</h3>
                    <p>Public-facing information and instructions</p>
                </div>
                <button class="modal-close" onclick="closeModal('viewModal')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="view-svc-head">
                    <div class="view-svc-img" id="vm-img">
                        <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:#D4CFC9">
                            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;margin-bottom:.6rem">
                        <span class="pill" id="vm-status"><span class="pill-dot"></span>Published</span>
                    </div>
                    <div class="view-svc-name" id="vm-name">—</div>
                    <div class="view-svc-desc" id="vm-desc">—</div>
                </div>

                <!-- Full description -->
                <div id="vm-full-wrap" class="hidden">
                    <div class="section-label">Full Description</div>
                    <div class="full-desc-box" id="vm-full">—</div>
                </div>

                <!-- How-to steps -->
                <div id="vm-steps-wrap" class="hidden">
                    <div class="section-label">How-To Instructions</div>
                    <div class="steps-display" id="vm-steps"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="footer-left">
                    <button class="btn btn-danger" id="vm-delete-btn">Delete</button>
                </div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('viewModal')">Close</button>
                    <button class="btn btn-ghost" id="vm-toggle-btn">Unpublish</button>
                    <button class="btn btn-crimson-outline" id="vm-edit-btn">Edit Service</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ══ MODAL: Confirm Delete ══ -->
    <div class="overlay" id="confirmModal">
        <div class="modal narrow">
            <div class="modal-body confirm-body" style="padding:2rem 1.5rem 1.5rem">
                <div class="confirm-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                    </svg>
                </div>
                <h3 id="confirmTitle">Delete Service?</h3>
                <p id="confirmMsg">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <div class="footer-left"></div>
                <div class="footer-right">
                    <button class="btn btn-ghost" onclick="closeModal('confirmModal')">Cancel</button>
                    <button class="btn btn-danger" id="confirmBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-wrap" id="toastWrap"></div>

    <script>
        let services = [{
                id: 1,
                name: 'Health Services',
                status: 'published',
                desc: 'Comprehensive healthcare programs including medical check-ups, vaccinations, and health education for the community.',
                fullDesc: 'Our health services provide a full range of preventive and primary care including free consultations, vaccination drives, maternal care, and community wellness campaigns. Open to all qualified residents.',
                steps: ['Visit the Municipal Health Office at the ground floor, City Hall', 'Present a valid government-issued ID and barangay clearance', 'Fill out the Health Services Request Form', 'Wait for your queue number to be called', 'Receive your medical assessment or service certificate'],
                image: '',
                order: 0
            },
            {
                id: 2,
                name: 'Education Programs',
                status: 'published',
                desc: 'Educational assistance programs, scholarship opportunities, and skills development training for residents.',
                fullDesc: 'We offer scholarships, tutorial services, free vocational training, and educational assistance grants for qualified students and out-of-school youth within the municipality.',
                steps: ['Download the application form from the Municipal Website or pick one up at the DECS Desk', 'Gather required documents: report card, enrollment form, and 2 valid IDs', 'Submit completed application to the Education Office, Room 104', 'Attend the applicant briefing (schedule will be provided upon submission)', 'Wait for approval notification via SMS or email'],
                image: '',
                order: 1
            },
            {
                id: 3,
                name: 'Housing Assistance',
                status: 'draft',
                desc: 'Affordable housing programs, home repair assistance, and shelter support for qualified low-income residents.',
                fullDesc: 'The Housing Assistance Program covers emergency shelter, home repair grants, and relocation support for informal settlers and families affected by calamities.',
                steps: ['Secure a Barangay Certificate of Indigency', 'Proceed to the Housing Office, 2nd floor, Annex Building', 'Submit documentary requirements (proof of residency, income, and household composition)', 'Undergo interview and property assessment', 'Receive determination of eligibility within 15 working days'],
                image: '',
                order: 2
            },
            {
                id: 4,
                name: 'Business Support',
                status: 'published',
                desc: 'Business registration assistance, entrepreneurship training, and microfinance support for local businesses.',
                fullDesc: 'One-stop shop for business permits, enterprise development coaching, and access to microfinance programs for MSMEs and solo entrepreneurs.',
                steps: ['Attend a free Business Orientation Seminar (every Monday, 9 AM)', 'Submit a Business Plan to the MSME Desk', 'Complete business registration requirements at the Business Permits and Licensing Office', 'Apply for microfinance or livelihood loan if qualified', 'Receive your Business Permit and Certificate of Registration'],
                image: '',
                order: 3
            },
            {
                id: 5,
                name: 'Social Welfare Services',
                status: 'published',
                desc: 'Financial aid, senior citizen benefits, PWD assistance, and 4Ps coordination for eligible families.',
                fullDesc: 'The Municipal Social Welfare and Development Office administers cash assistance, senior citizen pensions, PWD booklets, and coordinates with 4Ps beneficiaries.',
                steps: ['Check eligibility at the MSWD Office, Ground Floor, Annex Building', 'Submit a filled-out Intake Form with supporting documents', 'Undergo a Social Case Study conducted by a Social Worker', 'Wait for case conference approval (within 10 working days)', 'Claim benefits or assistance at the MSWD Releasing Window'],
                image: '',
                order: 4
            },
        ];

        let currentView = 'grid';
        let editingId = null;
        let stepCount = 0;
        let selectedImg = null;
        let dragSrc = null;

        function statusPill(s) {
            return s === 'published' ?
                `<span class="pill pill-green"><span class="pill-dot"></span>Published</span>` :
                `<span class="pill pill-gold"><span class="pill-dot"></span>Draft</span>`;
        }

        function filtered() {
            const q = document.getElementById('svcSearch').value.toLowerCase();
            const f = document.getElementById('svcFilter').value;
            return services
                .filter(s => (!q || s.name.toLowerCase().includes(q) || s.desc.toLowerCase().includes(q)) && (!f || s.status === f))
                .sort((a, b) => a.order - b.order);
        }

        function updateStats() {
            document.getElementById('statTotal').textContent = services.length;
            document.getElementById('statPub').textContent = services.filter(s => s.status === 'published').length;
            document.getElementById('statDraft').textContent = services.filter(s => s.status === 'draft').length;
            const avg = services.length ? Math.round(services.reduce((a, s) => a + s.steps.length, 0) / services.length) : 0;
            document.getElementById('statSteps').textContent = avg;
        }

        function showSkeleton() {
            if (currentView === 'grid') {
                document.getElementById('gridView').innerHTML = Array.from({
                    length: 4
                }, () => `
      <div class="skel-card">
        <div class="skel skel-img"></div>
        <div style="padding:1rem">
          <div class="skel skel-lg" style="margin-bottom:.5rem"></div>
          <div class="skel skel-md" style="margin-bottom:.35rem"></div>
          <div class="skel skel-sm"></div>
        </div>
      </div>`).join('');
            } else {
                document.getElementById('listBody').innerHTML = Array.from({
                    length: 4
                }, () => `
      <tr>
        <td></td>
        <td><div class="flex items-center gap-2"><div class="skel skel-thumb"></div><div class="skel skel-md"></div></div></td>
        <td><div class="skel skel-lg"></div></td>
        <td><div class="skel skel-sm"></div></td>
        <td><div class="skel" style="height:20px;width:70px;border-radius:999px"></div></td>
        <td></td>
      </tr>`).join('');
            }
        }

        function render(instant) {
            if (!instant) {
                showSkeleton();
                setTimeout(_render, 550);
            } else _render();
        }

        function _render() {
            const rows = filtered();
            updateStats();
            document.getElementById('svcSubline').textContent = `${services.length} service${services.length!==1?'s':''} · drag to reorder`;
            document.getElementById('pagText').innerHTML = `Showing <b>${rows.length}</b> of <b>${services.length}</b> services`;

            if (currentView === 'grid') {
                if (!rows.length) {
                    document.getElementById('gridView').innerHTML = `
        <div class="empty-state" style="grid-column:1/-1">
          <div class="empty-icon"><svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></div>
          <h3>No services found</h3><p>Try adjusting your search or filters.</p>
        </div>`;
                    return;
                }
                document.getElementById('gridView').innerHTML = rows.map(s => `
      <div class="svc-card" data-id="${s.id}" draggable="true" onclick="openViewModal(${s.id})">
        <div class="drag-handle" onclick="event.stopPropagation()" title="Drag to reorder">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="5" r="1.2" fill="currentColor"/><circle cx="15" cy="5" r="1.2" fill="currentColor"/><circle cx="9" cy="12" r="1.2" fill="currentColor"/><circle cx="15" cy="12" r="1.2" fill="currentColor"/><circle cx="9" cy="19" r="1.2" fill="currentColor"/><circle cx="15" cy="19" r="1.2" fill="currentColor"/></svg>
        </div>
        <div class="svc-img-wrap">
          ${s.image ? `<img src="${s.image}" alt="" onload="this.classList.add('loaded')">` : '<div class="svc-img-placeholder"><svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>'}
          <div class="svc-status-badge">${statusPill(s.status)}</div>
        </div>
        <div class="svc-body">
          <div class="svc-name">${s.name}</div>
          <div class="svc-desc">${s.desc}</div>
        </div>
        ${s.steps.length ? `<div class="svc-steps-preview"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg><strong>${s.steps.length}</strong> how-to step${s.steps.length!==1?'s':''} included</div>` : ''}
        <div class="svc-footer">
          <div class="svc-actions">
            <button class="icon-btn edit" title="Edit" onclick="event.stopPropagation();openEditModal(${s.id})">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>
            <button class="icon-btn image" title="Upload Image" onclick="event.stopPropagation();document.getElementById('fImage').click();editingId=${s.id}">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </button>
            <button class="icon-btn pub" title="${s.status==='published'?'Unpublish':'Publish'}" onclick="event.stopPropagation();togglePublish(${s.id})">
              ${s.status==='published'
                ? `<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`
                : `<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>`}
            </button>
            <button class="icon-btn delete" title="Delete" onclick="event.stopPropagation();confirmDelete(${s.id})">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
            </button>
          </div>
        </div>
      </div>`).join('');
                initDragGrid();
            } else {
                if (!rows.length) {
                    document.getElementById('listBody').innerHTML = `<tr><td colspan="6" style="text-align:center;padding:3rem;color:var(--muted);font-size:13px">No services found.</td></tr>`;
                    return;
                }
                document.getElementById('listBody').innerHTML = rows.map(s => `
      <tr data-id="${s.id}" draggable="true" onclick="openViewModal(${s.id})">
        <td class="drag-col" onclick="event.stopPropagation()" title="Drag to reorder">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="5" r="1" fill="currentColor"/><circle cx="15" cy="5" r="1" fill="currentColor"/><circle cx="9" cy="12" r="1" fill="currentColor"/><circle cx="15" cy="12" r="1" fill="currentColor"/><circle cx="9" cy="19" r="1" fill="currentColor"/><circle cx="15" cy="19" r="1" fill="currentColor"/></svg>
        </td>
        <td>
          <div class="flex items-center gap-2">
            <div class="tbl-thumb">${s.image ? `<img src="${s.image}" alt="" onload="this.classList.add('loaded')">` : `<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:#D4CFC9"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`}</div>
            <div>
              <div class="tbl-name">${s.name}</div>
              ${s.steps.length ? `<div class="tbl-steps">${s.steps.length} step${s.steps.length!==1?'s':''}</div>` : ''}
            </div>
          </div>
        </td>
        <td><div class="desc-text" title="${s.desc}">${s.desc}</div></td>
        <td style="font-size:12px;color:var(--muted)">${s.steps.length ? `${s.steps.length} step${s.steps.length!==1?'s':''}` : '—'}</td>
        <td>${statusPill(s.status)}</td>
        <td onclick="event.stopPropagation()">
          <div class="row-actions">
            <button class="icon-btn edit" title="Edit" onclick="openEditModal(${s.id})">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>
            <button class="icon-btn pub" title="${s.status==='published'?'Unpublish':'Publish'}" onclick="togglePublish(${s.id})">
              ${s.status==='published'
                ? `<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`
                : `<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>`}
            </button>
            <button class="icon-btn delete" title="Delete" onclick="confirmDelete(${s.id})">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
            </button>
          </div>
        </td>
      </tr>`).join('');
                initDragList();
            }
        }

        function initDragGrid() {
            document.querySelectorAll('.svc-card[data-id]').forEach(card => {
                card.addEventListener('dragstart', e => {
                    dragSrc = card;
                    card.classList.add('dragging');
                    e.dataTransfer.effectAllowed = 'move';
                });
                card.addEventListener('dragend', () => {
                    card.classList.remove('dragging');
                    document.querySelectorAll('.svc-card').forEach(c => c.classList.remove('drag-over'));
                });
                card.addEventListener('dragover', e => {
                    e.preventDefault();
                    card.classList.add('drag-over');
                });
                card.addEventListener('dragleave', () => card.classList.remove('drag-over'));
                card.addEventListener('drop', e => {
                    e.preventDefault();
                    e.stopPropagation();
                    if (dragSrc && dragSrc !== card) swapOrder(+dragSrc.dataset.id, +card.dataset.id);
                });
            });
        }

        function initDragList() {
            document.querySelectorAll('#listBody tr[data-id]').forEach(row => {
                row.addEventListener('dragstart', e => {
                    dragSrc = row;
                    row.classList.add('dragging');
                    e.dataTransfer.effectAllowed = 'move';
                });
                row.addEventListener('dragend', () => {
                    row.classList.remove('dragging');
                    document.querySelectorAll('#listBody tr').forEach(r => r.classList.remove('drag-over'));
                });
                row.addEventListener('dragover', e => {
                    e.preventDefault();
                    row.classList.add('drag-over');
                });
                row.addEventListener('dragleave', () => row.classList.remove('drag-over'));
                row.addEventListener('drop', e => {
                    e.preventDefault();
                    e.stopPropagation();
                    if (dragSrc && dragSrc !== row) swapOrder(+dragSrc.dataset.id, +row.dataset.id);
                });
            });
        }

        function swapOrder(id1, id2) {
            const a = services.find(s => s.id === id1);
            const b = services.find(s => s.id === id2);
            if (a && b) {
                const tmp = a.order;
                a.order = b.order;
                b.order = tmp;
            }
            render(true);
        }

        function saveOrder() {
            toast('Service order saved.', 'success');
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
        document.querySelectorAll('.overlay').forEach(o => o.addEventListener('click', e => {
            if (e.target === o) o.classList.remove('open');
        }));

        function rebuildSteps(steps) {
            stepCount = 0;
            document.getElementById('stepsList').innerHTML = '';
            (steps || []).forEach(s => addStep(s));
        }

        function addStep(text = '') {
            stepCount++;
            const n = stepCount;
            const li = document.createElement('div');
            li.className = 'step-item';
            li.dataset.step = n;
            li.innerHTML = `
    <div class="step-num">${n}</div>
    <textarea class="step-input" rows="2" placeholder="Describe step ${n}…">${text}</textarea>
    <button type="button" class="step-del" onclick="removeStep(this)" title="Remove step">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>`;
            document.getElementById('stepsList').appendChild(li);
        }

        function removeStep(btn) {
            btn.closest('.step-item').remove();
            renumberSteps();
        }

        function renumberSteps() {
            document.querySelectorAll('.step-item').forEach((item, i) => {
                item.querySelector('.step-num').textContent = i + 1;
                item.querySelector('.step-input').placeholder = `Describe step ${i+1}…`;
            });
        }

        function getSteps() {
            return [...document.querySelectorAll('.step-input')].map(t => t.value.trim()).filter(Boolean);
        }

        function openAddModal() {
            editingId = null;
            selectedImg = null;
            document.getElementById('svcModalTitle').textContent = 'Add Service';
            document.getElementById('svcModalSub').textContent = 'Fill in the service details and instructions';
            ['fName', 'fDesc', 'fFullDesc'].forEach(id => document.getElementById(id).value = '');
            document.getElementById('fStatus').value = 'published';
            rebuildSteps([]);
            clearImg();
            openModal('svcModal');
        }

        function openEditModal(id) {
            const s = services.find(x => x.id === id);
            if (!s) return;
            editingId = id;
            selectedImg = null;
            document.getElementById('svcModalTitle').textContent = 'Edit Service';
            document.getElementById('svcModalSub').textContent = s.name;
            document.getElementById('fName').value = s.name;
            document.getElementById('fDesc').value = s.desc;
            document.getElementById('fFullDesc').value = s.fullDesc || '';
            document.getElementById('fStatus').value = s.status;
            rebuildSteps(s.steps);
            clearImg();
            closeModal('viewModal');
            openModal('svcModal');
        }

        function submitForm() {
            const name = document.getElementById('fName').value.trim();
            if (!name) {
                toast('Service name is required.', 'error');
                return;
            }
            const desc = document.getElementById('fDesc').value.trim();
            if (!desc) {
                toast('Short description is required.', 'error');
                return;
            }
            const data = {
                name,
                desc,
                fullDesc: document.getElementById('fFullDesc').value.trim(),
                status: document.getElementById('fStatus').value,
                steps: getSteps(),
                image: selectedImg || (editingId ? (services.find(s => s.id === editingId) || {}).image || '' : ''),
            };
            if (editingId) {
                const s = services.find(x => x.id === editingId);
                if (s) Object.assign(s, data);
                toast('Service updated.', 'success');
            } else {
                const newId = services.length ? Math.max(...services.map(x => x.id)) + 1 : 1;
                services.push({
                    id: newId,
                    order: services.length,
                    ...data
                });
                toast('Service added.', 'success');
            }
            closeModal('svcModal');
            render(true);
        }

        function openViewModal(id) {
            const s = services.find(x => x.id === id);
            if (!s) return;
            // Image
            const imgEl = document.getElementById('vm-img');
            if (s.image) {
                imgEl.innerHTML = `<img src="${s.image}" alt="" onload="this.classList.add('loaded'); this.parentElement.style.background='none'">`;
            } else {
                imgEl.innerHTML = `<svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:#D4CFC9"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`;
                imgEl.style.background = '';
            }
            document.getElementById('vm-status').className = 'pill ' + (s.status === 'published' ? 'pill-green' : 'pill-gold');
            document.getElementById('vm-status').innerHTML = `<span class="pill-dot"></span>${s.status==='published'?'Published':'Draft'}`;
            document.getElementById('vm-name').textContent = s.name;
            document.getElementById('vm-desc').textContent = s.desc;

            // Full desc
            const fw = document.getElementById('vm-full-wrap');
            if (s.fullDesc) {
                fw.classList.remove('hidden');
                document.getElementById('vm-full').textContent = s.fullDesc;
            } else fw.classList.add('hidden');

            // Steps
            const sw = document.getElementById('vm-steps-wrap');
            if (s.steps.length) {
                sw.classList.remove('hidden');
                document.getElementById('vm-steps').innerHTML = s.steps.map((step, i) => `
      <div class="step-display-item">
        <div class="step-display-num">${i+1}</div>
        <div class="step-display-line"><div class="step-display-text">${step}</div></div>
      </div>`).join('');
            } else sw.classList.add('hidden');

            document.getElementById('vm-toggle-btn').textContent = s.status === 'published' ? 'Unpublish' : 'Publish';
            document.getElementById('vm-toggle-btn').onclick = () => {
                togglePublish(id);
                closeModal('viewModal');
            };
            document.getElementById('vm-edit-btn').onclick = () => openEditModal(id);
            document.getElementById('vm-delete-btn').onclick = () => {
                closeModal('viewModal');
                confirmDelete(id);
            };
            openModal('viewModal');
        }

        function togglePublish(id) {
            const s = services.find(x => x.id === id);
            if (!s) return;
            s.status = s.status === 'published' ? 'draft' : 'published';
            render(true);
            toast(s.name + ' is now ' + s.status + '.', 'success');
        }

        function confirmDelete(id) {
            const s = services.find(x => x.id === id);
            document.getElementById('confirmTitle').textContent = 'Delete ' + (s ? s.name : 'service') + '?';
            document.getElementById('confirmMsg').textContent = 'This service and all its instructions will be permanently removed.';
            document.getElementById('confirmBtn').onclick = () => {
                services = services.filter(x => x.id !== id);
                closeModal('confirmModal');
                render(true);
                toast('Service deleted.', 'success');
            };
            openModal('confirmModal');
        }

        function previewImg(e) {
            const file = e.target.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) {
                toast('File too large. Max 5MB.', 'error');
                return;
            }
            const r = new FileReader();
            r.onload = ev => {
                selectedImg = ev.target.result;
                document.getElementById('imgPreviewEl').src = ev.target.result;
                document.getElementById('imgFileName').textContent = file.name;
                document.getElementById('imgFileSize').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                const w = document.getElementById('imgPreviewWrap');
                w.classList.remove('hidden');
                w.style.display = 'flex';
            };
            r.readAsDataURL(file);
        }

        function clearImg() {
            selectedImg = null;
            document.getElementById('fImage').value = '';
            document.getElementById('imgPreviewWrap').classList.add('hidden');
        }

        function toast(msg, type = 'info') {
            const icons = {
                success: `<svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>`,
                error: `<svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
                info: `<svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`,
            };
            const el = document.createElement('div');
            el.className = `toast ${type}`;
            el.innerHTML = `<span>${icons[type]||icons.info}</span><span>${msg}</span>`;
            document.getElementById('toastWrap').appendChild(el);
            requestAnimationFrame(() => requestAnimationFrame(() => el.classList.add('show')));
            setTimeout(() => {
                el.classList.remove('show');
                setTimeout(() => el.remove(), 350);
            }, 3000);
        }

        document.getElementById('svcSearch').addEventListener('input', () => render(true));
        document.getElementById('svcFilter').addEventListener('change', () => render(true));

        render();
    </script>
</body>

</html>
@endsection