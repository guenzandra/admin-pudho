@extends('editor.layout')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Arial:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

        :root {
            --bg: #f0f2f7;
            --surface: #ffffff;
            --surface2: #f8f9fc;
            --border: #e4e8f0;
            --text-primary: #1a1f36;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;
            --blue: #3b6ef8;
            --blue-light: #eff3ff;
            --green: #10b981;
            --green-light: #ecfdf5;
            --purple: #8b5cf6;
            --purple-light: #f5f3ff;
            --orange: #f59e0b;
            --orange-light: #fffbeb;
            --red: #ef4444;
            --red-light: #fef2f2;
            --teal: #14b8a6;
            --teal-light: #f0fdfa;
            --indigo: #4f46e5;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
            --radius: 14px;
            --radius-sm: 8px;
        }

        body {
            font-family: 'Arial', Arial, sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
        }

        .dashboard {
            padding: 32px 32px 48px;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 32px;
            animation: fadeUp 0.5s ease both;
        }

        .header-left h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.3px;
        }

        .header-left p {
            font-size: 13.5px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-date {
            font-size: 12.5px;
            color: var(--text-muted);
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 7px 14px;
            border-radius: 20px;
            font-weight: 500;
        }

        .header-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        /* ── TOAST ── */
        #toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 14px 18px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            max-width: 380px;
            animation: slideInRight 0.35s cubic-bezier(.22, 1, .36, 1) both;
            font-size: 13.5px;
        }

        .toast.hiding {
            animation: slideOutRight 0.3s ease forwards;
        }

        .toast-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-success .toast-icon {
            background: var(--green-light);
            color: var(--green);
        }

        .toast-info .toast-icon {
            background: var(--blue-light);
            color: var(--blue);
        }

        .toast-warning .toast-icon {
            background: var(--orange-light);
            color: var(--orange);
        }

        .toast-body {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 13px;
        }

        .toast-msg {
            color: var(--text-secondary);
            font-size: 12px;
            margin-top: 2px;
        }

        .toast-close {
            cursor: pointer;
            color: var(--text-muted);
            font-size: 16px;
            line-height: 1;
            padding: 2px;
        }

        .toast-close:hover {
            color: var(--text-primary);
        }

        /* ── STAT CARDS ROW ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px 20px 18px;
            position: relative;
            overflow: hidden;
            cursor: default;
            transition: transform 0.2s, box-shadow 0.2s;
            animation: fadeUp 0.5s ease both;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .stat-card.blue::before {
            background: var(--blue);
        }

        .stat-card.green::before {
            background: var(--green);
        }

        .stat-card.purple::before {
            background: var(--purple);
        }

        .stat-card.orange::before {
            background: var(--orange);
        }

        .stat-card.red::before {
            background: var(--red);
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.10s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.20s;
        }

        .stat-card:nth-child(5) {
            animation-delay: 0.25s;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .stat-icon svg {
            width: 20px;
            height: 20px;
        }

        .stat-card.blue .stat-icon {
            background: var(--blue-light);
            color: var(--blue);
        }

        .stat-card.green .stat-icon {
            background: var(--green-light);
            color: var(--green);
        }

        .stat-card.purple.stat-icon {
            background: var(--purple-light);
            color: var(--purple);
        }

        .stat-card.orange.stat-icon {
            background: var(--orange-light);
            color: var(--orange);
        }

        .stat-card.red .stat-icon {
            background: var(--red-light);
            color: var(--red);
        }

        .stat-card.purple .stat-icon {
            background: var(--purple-light);
            color: var(--purple);
        }

        .stat-card.orange .stat-icon {
            background: var(--orange-light);
            color: var(--orange);
        }

        .stat-card.red .stat-icon {
            background: var(--red-light);
            color: var(--red);
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 30px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 4px 0 2px;
            letter-spacing: -1px;
            line-height: 1;
        }

        .stat-sub {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 12px;
            margin-top: 6px;
        }

        .badge-up {
            background: var(--green-light);
            color: var(--green);
        }

        .badge-down {
            background: var(--red-light);
            color: var(--red);
        }

        .badge-same {
            background: var(--blue-light);
            color: var(--blue);
        }

        /* ── SECOND ROW: FAQ SPLIT + SYSTEM HEALTH ── */
        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr 1.2fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px 22px 18px;
            animation: fadeUp 0.5s ease both;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .card-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 12px;
        }

        /* FAQ Donut */
        .faq-donut-wrap {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .donut-svg {
            flex-shrink: 0;
        }

        .donut-legend {
            flex: 1;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-label {
            font-size: 12px;
            color: var(--text-secondary);
            flex: 1;
        }

        .legend-value {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* System Health */
        .health-items {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .health-item-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .health-item-label span:first-child {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .health-item-label span:last-child {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .progress-track {
            height: 7px;
            background: var(--bg);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: 4px;
            transition: width 1.2s cubic-bezier(.22, 1, .36, 1);
        }

        .progress-bar.blue {
            background: var(--blue);
        }

        .progress-bar.green {
            background: var(--green);
        }

        .progress-bar.orange {
            background: var(--orange);
        }

        .progress-bar.red {
            background: var(--red);
        }

        .progress-bar.purple {
            background: var(--purple);
        }

        .health-summary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 16px;
        }

        .health-mini {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 12px;
        }

        .health-mini-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .health-mini-val {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 2px;
        }

        /* ── QUICK ACTIONS ── */
        .quick-actions-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            margin-bottom: 24px;
            animation: fadeUp 0.5s 0.3s ease both;
        }

        .qa-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 16px;
        }

        .qa-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 20px 14px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            background: var(--surface2);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-family: 'Arial', Arial, sans-serif;
            position: relative;
            overflow: hidden;
        }

        .qa-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .qa-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .qa-btn:hover::after {
            opacity: 1;
        }

        .qa-btn:active {
            transform: translateY(0);
        }

        .qa-btn.btn-blue {
            border-color: #c7d7fd;
        }

        .qa-btn.btn-green {
            border-color: #a7f3d0;
        }

        .qa-btn.btn-purple {
            border-color: #ddd6fe;
        }

        .qa-btn.btn-orange {
            border-color: #fde68a;
        }

        .qa-btn.btn-teal {
            border-color: #99f6e4;
        }

        .qa-btn.btn-red {
            border-color: #fecaca;
        }

        .qa-btn.btn-indigo {
            border-color: #c7d2fe;
        }

        .qa-btn.btn-gray {
            border-color: var(--border);
        }

        .qa-btn:hover.btn-blue {
            background: var(--blue-light);
            border-color: var(--blue);
        }

        .qa-btn:hover.btn-green {
            background: var(--green-light);
            border-color: var(--green);
        }

        .qa-btn:hover.btn-purple {
            background: var(--purple-light);
            border-color: var(--purple);
        }

        .qa-btn:hover.btn-orange {
            background: var(--orange-light);
            border-color: var(--orange);
        }

        .qa-btn:hover.btn-teal {
            background: var(--teal-light);
            border-color: var(--teal);
        }

        .qa-btn:hover.btn-red {
            background: var(--red-light);
            border-color: var(--red);
        }

        .qa-btn:hover.btn-indigo {
            background: #eef2ff;
            border-color: var(--indigo);
        }

        .qa-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qa-icon svg {
            width: 22px;
            height: 22px;
        }

        .qa-btn.btn-blue .qa-icon {
            background: var(--blue-light);
            color: var(--blue);
        }

        .qa-btn.btn-green .qa-icon {
            background: var(--green-light);
            color: var(--green);
        }

        .qa-btn.btn-purple .qa-icon {
            background: var(--purple-light);
            color: var(--purple);
        }

        .qa-btn.btn-orange .qa-icon {
            background: var(--orange-light);
            color: var(--orange);
        }

        .qa-btn.btn-teal .qa-icon {
            background: var(--teal-light);
            color: var(--teal);
        }

        .qa-btn.btn-red .qa-icon {
            background: var(--red-light);
            color: var(--red);
        }

        .qa-btn.btn-indigo .qa-icon {
            background: #eef2ff;
            color: var(--indigo);
        }

        .qa-btn.btn-gray .qa-icon {
            background: var(--bg);
            color: var(--text-secondary);
        }

        .qa-label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-primary);
            text-align: center;
            line-height: 1.3;
        }

        /* ── BOTTOM ROW ── */
        .bottom-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 16px;
        }

        /* Activity Feed */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 11px 10px;
            border-radius: var(--radius-sm);
            transition: background 0.15s;
            cursor: default;
        }

        .activity-item:hover {
            background: var(--surface2);
        }

        .activity-dot {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .activity-dot svg {
            width: 15px;
            height: 15px;
        }

        .activity-dot.blue {
            background: var(--blue-light);
            color: var(--blue);
        }

        .activity-dot.green {
            background: var(--green-light);
            color: var(--green);
        }

        .activity-dot.purple {
            background: var(--purple-light);
            color: var(--purple);
        }

        .activity-dot.orange {
            background: var(--orange-light);
            color: var(--orange);
        }

        .activity-dot.red {
            background: var(--red-light);
            color: var(--red);
        }

        .activity-dot.teal {
            background: var(--teal-light);
            color: var(--teal);
        }

        .activity-body {
            flex: 1;
        }

        .activity-text {
            font-size: 13px;
            color: var(--text-primary);
            font-weight: 500;
            line-height: 1.4;
        }

        .activity-text span {
            color: var(--text-secondary);
            font-weight: 400;
        }

        .activity-time {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .activity-tag {
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 10px;
            align-self: center;
            white-space: nowrap;
        }

        /* Notifications */
        .notif-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.15s;
            position: relative;
        }

        .notif-item:hover {
            border-color: var(--border);
            background: var(--surface2);
        }

        .notif-item.unread::before {
            content: '';
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--blue);
        }

        .notif-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notif-icon svg {
            width: 16px;
            height: 16px;
        }

        .notif-icon.blue {
            background: var(--blue-light);
            color: var(--blue);
        }

        .notif-icon.green {
            background: var(--green-light);
            color: var(--green);
        }

        .notif-icon.orange {
            background: var(--orange-light);
            color: var(--orange);
        }

        .notif-body {
            flex: 1;
        }

        .notif-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .notif-desc {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .notif-time {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.2s ease;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            width: 100%;
            max-width: 480px;
            padding: 28px;
            animation: scaleIn 0.25s cubic-bezier(.22, 1, .36, 1) both;
            position: relative;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .modal-close {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            background: var(--surface2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--text-muted);
            transition: background 0.15s;
            font-family: Arial, sans-serif;
        }

        .modal-close:hover {
            background: var(--bg);
            color: var(--text-primary);
        }

        .modal-body {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .modal-footer {
            margin-top: 24px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn {
            padding: 9px 20px;
            border-radius: var(--radius-sm);
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.15s;
            font-family: Arial, sans-serif;
        }

        .btn-primary {
            background: var(--blue);
            color: #fff;
        }

        .btn-primary:hover {
            background: #2d5ef0;
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        .btn-ghost:hover {
            background: var(--surface2);
        }

        /* ── SKELETON LOADER ── */
        .skeleton {
            background: linear-gradient(90deg, #e8ecf0 25%, #f4f6f8 50%, #e8ecf0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 6px;
        }

        .skeleton-line {
            height: 12px;
            margin-bottom: 8px;
        }

        .skeleton-line.w-3of4 {
            width: 75%;
        }

        .skeleton-line.w-1of2 {
            width: 50%;
        }

        .loading-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px 20px 18px;
        }

        /* ── LOADING SPINNER ── */
        .spinner {
            width: 20px;
            height: 20px;
            border: 2.5px solid rgba(255, 255, 255, 0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: inline-block;
        }

        /* ── PULSE DOT ── */
        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--green);
            position: relative;
            display: inline-block;
        }

        .pulse-dot::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: var(--green);
            opacity: 0;
            animation: pulse 2s ease-out infinite;
        }

        /* ── VIEW ALL LINK ── */
        .view-all {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--blue);
            text-decoration: none;
            cursor: pointer;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        /* ── DIVIDER ── */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 4px 0;
        }

        /* Section title */
        .section-eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 14px;
        }

        /* ── KEYFRAMES ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.93);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(32px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(32px);
            }
        }

        @keyframes shimmer {
            from {
                background-position: 200% 0;
            }

            to {
                background-position: -200% 0;
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            100% {
                transform: scale(2.4);
                opacity: 0;
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .qa-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .row-2 {
                grid-template-columns: 1fr 1fr;
            }

            .bottom-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .qa-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .row-2 {
                grid-template-columns: 1fr;
            }
        }
</style>

<!-- TOAST CONTAINER -->
<div id="toast-container"></div>

    <!-- MODAL -->
    <div class="modal-overlay" id="modal" onclick="closeModal(event)">
        <div class="modal">
            <div class="modal-header">
                <span class="modal-title" id="modal-title">Confirm Action</span>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modal-body">
                This action will redirect you to the content creation form.
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" onclick="closeModal()">Cancel</button>
                <button class="btn btn-primary" id="modal-confirm-btn" onclick="handleModalConfirm()">Continue</button>
            </div>
        </div>
    </div>

    <div class="dashboard">

        <!-- HEADER -->
        <div class="header">
            <div class="header-left">
                <h1>Editor Dashboard</h1>
                <p>Welcome back, Editor — here's what's happening today.</p>
            </div>
            <div class="header-right">
                <div class="header-date" id="live-date">—</div>
                <div style="display:flex;align-items:center;gap:6px;background:var(--surface);border:1px solid var(--border);padding:6px 12px;border-radius:20px;">
                    <span class="pulse-dot"></span>
                    <span style="font-size:12px;font-weight:600;color:var(--green);">System Online</span>
                </div>
                <div class="header-avatar">ED</div>
            </div>
        </div>

        <!-- STAT CARDS -->
        <div class="stats-grid" id="stats-grid">
            <!-- skeleton shown first, replaced by JS -->
            <div class="loading-card">
                <div class="skeleton skeleton-line" style="width:60%;height:10px;"></div>
                <div class="skeleton skeleton-line" style="width:40%;height:26px;margin-top:10px;"></div>
            </div>
            <div class="loading-card">
                <div class="skeleton skeleton-line" style="width:60%;height:10px;"></div>
                <div class="skeleton skeleton-line" style="width:40%;height:26px;margin-top:10px;"></div>
            </div>
            <div class="loading-card">
                <div class="skeleton skeleton-line" style="width:60%;height:10px;"></div>
                <div class="skeleton skeleton-line" style="width:40%;height:26px;margin-top:10px;"></div>
            </div>
            <div class="loading-card">
                <div class="skeleton skeleton-line" style="width:60%;height:10px;"></div>
                <div class="skeleton skeleton-line" style="width:40%;height:26px;margin-top:10px;"></div>
            </div>
            <div class="loading-card">
                <div class="skeleton skeleton-line" style="width:60%;height:10px;"></div>
                <div class="skeleton skeleton-line" style="width:40%;height:26px;margin-top:10px;"></div>
            </div>
        </div>

        <!-- ROW 2: FAQ answered/unanswered + System Health -->
        <div class="row-2">
            <!-- FAQ Answered -->
            <div class="card" style="animation-delay:0.3s">
                <div class="card-header">
                    <span class="card-title">FAQ Overview</span>
                    <span class="card-badge" style="background:var(--orange-light);color:var(--orange);">3 Unanswered</span>
                </div>
                <div class="faq-donut-wrap">
                    <svg class="donut-svg" width="90" height="90" viewBox="0 0 90 90">
                        <circle cx="45" cy="45" r="35" fill="none" stroke="#e4e8f0" stroke-width="10" />
                        <!-- answered: 78% -->
                        <circle cx="45" cy="45" r="35" fill="none" stroke="#10b981" stroke-width="10"
                            stroke-dasharray="171.9 48.9" stroke-dashoffset="55" stroke-linecap="round"
                            style="transition:stroke-dasharray 1.2s ease" transform="rotate(-90 45 45)" />
                        <!-- unanswered: 22% -->
                        <circle cx="45" cy="45" r="35" fill="none" stroke="#f59e0b" stroke-width="10"
                            stroke-dasharray="48 172.8" stroke-dashoffset="-116.9" stroke-linecap="round"
                            transform="rotate(-90 45 45)" />
                        <text x="45" y="42" text-anchor="middle" font-size="14" font-weight="700" fill="#1a1f36" font-family="Arial">78%</text>
                        <text x="45" y="55" text-anchor="middle" font-size="9" fill="#9ca3af" font-family="Arial">Answered</text>
                    </svg>
                    <div class="donut-legend">
                        <div class="legend-item">
                            <div class="legend-dot" style="background:var(--green)"></div>
                            <span class="legend-label">Answered</span>
                            <span class="legend-value">{{ $answeredFAQs ?? 18 }}</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background:var(--orange)"></div>
                            <span class="legend-label">Unanswered</span>
                            <span class="legend-value">{{ $unansweredFAQs ?? 5 }}</span>
                        </div>
                        <div style="height:1px;background:var(--border);margin:6px 0 8px;"></div>
                        <div class="legend-item" style="margin-bottom:0">
                            <div class="legend-dot" style="background:var(--blue)"></div>
                            <span class="legend-label">Total FAQs</span>
                            <span class="legend-value">{{ $totalFAQs ?? 23 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unanswered Details -->
            <div class="card" style="animation-delay:0.35s">
                <div class="card-header">
                    <span class="card-title">Pending FAQs</span>
                    <a class="view-all" onclick="showToast('info','Navigating...','Opening FAQ management.')">View All</a>
                </div>
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <div style="display:flex;align-items:flex-start;gap:10px;padding:10px;background:var(--orange-light);border-radius:8px;border:1px solid #fde68a;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" style="flex-shrink:0;margin-top:1px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div style="flex:1">
                            <div style="font-size:12.5px;font-weight:600;color:var(--text-primary);">How to renew expired documents?</div>
                            <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">Submitted 2 days ago</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:10px;padding:10px;background:var(--orange-light);border-radius:8px;border:1px solid #fde68a;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" style="flex-shrink:0;margin-top:1px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div style="flex:1">
                            <div style="font-size:12.5px;font-weight:600;color:var(--text-primary);">Requirements for senior citizen ID</div>
                            <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">Submitted 4 days ago</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:10px;padding:10px;background:var(--orange-light);border-radius:8px;border:1px solid #fde68a;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" style="flex-shrink:0;margin-top:1px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div style="flex:1">
                            <div style="font-size:12.5px;font-weight:600;color:var(--text-primary);">Online payment options available?</div>
                            <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">Submitted 1 week ago</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="card" style="animation-delay:0.4s">
                <div class="card-header">
                    <span class="card-title">System Health</span>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <span class="pulse-dot"></span>
                        <span style="font-size:12px;font-weight:600;color:var(--green);">Healthy</span>
                    </div>
                </div>
                <div class="health-items">
                    <div>
                        <div class="health-item-label">
                            <span>Storage Used</span>
                            <span>1.24 GB / 5 GB</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-bar blue" data-width="25" style="width:0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="health-item-label">
                            <span>Uploaded Files</span>
                            <span>847 MB</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-bar green" data-width="17" style="width:0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="health-item-label">
                            <span>Media Assets</span>
                            <span>312 MB</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-bar purple" data-width="6" style="width:0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="health-item-label">
                            <span>Database Size</span>
                            <span>84 MB</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-bar orange" data-width="2" style="width:0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="health-item-label">
                            <span>Cache</span>
                            <span>21 MB</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-bar red" data-width="0.4" style="width:0%"></div>
                        </div>
                    </div>
                </div>
                <div class="health-summary">
                    <div class="health-mini">
                        <div class="health-mini-label">Free Space</div>
                        <div class="health-mini-val" style="color:var(--green)">3.76 GB</div>
                    </div>
                    <div class="health-mini">
                        <div class="health-mini-label">Total Files</div>
                        <div class="health-mini-val">1,284</div>
                    </div>
                    <div class="health-mini">
                        <div class="health-mini-label">Last Backup</div>
                        <div class="health-mini-val" style="font-size:13px;">Today 04:00</div>
                    </div>
                    <div class="health-mini">
                        <div class="health-mini-label">Uptime</div>
                        <div class="health-mini-val" style="color:var(--green)">99.98%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="quick-actions-card">
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <div class="card-title" style="font-size:15px;">Quick Actions</div>
                    <div style="font-size:12.5px;color:var(--text-muted);margin-top:2px;">Create and manage content quickly</div>
                </div>
            </div>
            <div class="qa-grid">
                <button class="qa-btn btn-blue" onclick="openModal('Add News Article','This will open the news creation form where you can write and publish a new article.','add-news')">
                    <div class="qa-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z" />
                        </svg>
                    </div>
                    <span class="qa-label">Add News</span>
                </button>
                <button class="qa-btn btn-purple" onclick="openModal('Add Service','This will open the service creation form to add a new government service listing.','add-service')">
                    <div class="qa-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="qa-label">Add Service</span>
                </button>
                <button class="qa-btn btn-orange" onclick="openModal('Add FAQ','This will open the FAQ creation form. You can add a question and its corresponding answer.','add-faq')">
                    <div class="qa-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="qa-label">Add FAQ</span>
                </button>
                <button class="qa-btn btn-green" onclick="openModal('Add Announcement','This will open the announcement creation form for publishing new official announcements.','add-announcement')">
                    <div class="qa-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <span class="qa-label">Add Announcement</span>
                </button>
                <button class="qa-btn btn-red" onclick="openModal('Upload Downloadable Form','This will open the file upload form for adding downloadable government forms.','upload-form')">
                    <div class="qa-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="qa-label">Upload Form</span>
                </button>
                <button class="qa-btn btn-teal" onclick="openModal('Edit Pages','This will open the page editor where you can update static content pages like About and Contact.','edit-pages')">
                    <div class="qa-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                    </div>
                    <span class="qa-label">Edit Pages</span>
                </button>
                <button class="qa-btn btn-indigo" onclick="openModal('Manage Gallery','This will open the media gallery manager where you can upload, arrange, and delete images.','manage-gallery')">
                    <div class="qa-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="qa-label">Manage Gallery</span>
                </button>
                <button class="qa-btn btn-gray" onclick="openModal('View Reports','This will open the reports & analytics section to view content performance data.','view-reports')">
                    <div class="qa-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <span class="qa-label">View Reports</span>
                </button>
            </div>
        </div>

        <!-- BOTTOM ROW -->
        <div class="bottom-row">

            <!-- Recent Activity -->
            <div class="card" style="animation-delay:0.45s">
                <div class="card-header">
                    <span class="card-title">Recent Activity</span>
                    <a class="view-all" onclick="showToast('info','Opening Activity Log','Full activity log loading...')">View All</a>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-dot blue">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="activity-body">
                            <div class="activity-text">New article <span>"PUDHO Monthly Report"</span> was published</div>
                            <div class="activity-time">March 2, 2026 · 10:24 AM</div>
                        </div>
                        <span class="activity-tag" style="background:var(--blue-light);color:var(--blue)">News</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot green">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <div class="activity-body">
                            <div class="activity-text"><span>"Office Holiday Schedule"</span> announcement was added</div>
                            <div class="activity-time">Feb 28, 2026 · 3:12 PM</div>
                        </div>
                        <span class="activity-tag" style="background:var(--green-light);color:var(--green)">Announcement</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot purple">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </div>
                        <div class="activity-body">
                            <div class="activity-text"><span>"Vision & Mission Statement"</span> page was updated</div>
                            <div class="activity-time">Feb 28, 2026 · 11:05 AM</div>
                        </div>
                        <span class="activity-tag" style="background:var(--purple-light);color:var(--purple)">Page</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot orange">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <div class="activity-body">
                            <div class="activity-text">New form <span>"Application Form 2026"</span> was uploaded</div>
                            <div class="activity-time">Feb 27, 2026 · 2:45 PM</div>
                        </div>
                        <span class="activity-tag" style="background:var(--orange-light);color:var(--orange)">Form</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot teal">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="activity-body">
                            <div class="activity-text">FAQ <span>"Application Requirements"</span> was answered</div>
                            <div class="activity-time">Feb 27, 2026 · 9:00 AM</div>
                        </div>
                        <span class="activity-tag" style="background:var(--teal-light);color:var(--teal)">FAQ</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot red">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div class="activity-body">
                            <div class="activity-text"><span>"Outdated Service Policy v1"</span> was removed</div>
                            <div class="activity-time">Feb 26, 2026 · 4:30 PM</div>
                        </div>
                        <span class="activity-tag" style="background:var(--red-light);color:var(--red)">Deleted</span>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="card" style="animation-delay:0.5s">
                <div class="card-header">
                    <span class="card-title">Notifications</span>
                    <span class="card-badge" style="background:var(--red-light);color:var(--red)">3 New</span>
                </div>
                <div class="notif-list">
                    <div class="notif-item unread" onclick="markRead(this)">
                        <div class="notif-icon blue">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="notif-body">
                            <div class="notif-title">Announcement Pending Approval</div>
                            <div class="notif-desc">New announcement requires your review before publishing.</div>
                            <div class="notif-time">2 hours ago</div>
                        </div>
                    </div>
                    <div class="notif-item unread" onclick="markRead(this)">
                        <div class="notif-icon green">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="notif-body">
                            <div class="notif-title">Article Published Successfully</div>
                            <div class="notif-desc">PUDHO Monthly Report is now live on the website.</div>
                            <div class="notif-time">5 hours ago</div>
                        </div>
                    </div>
                    <div class="notif-item unread" onclick="markRead(this)">
                        <div class="notif-icon orange">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="notif-body">
                            <div class="notif-title">Service Update Needs Review</div>
                            <div class="notif-desc">Housing Application Process was recently modified.</div>
                            <div class="notif-time">1 day ago</div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="notif-item" onclick="markRead(this)">
                        <div class="notif-icon" style="background:var(--surface2);color:var(--text-muted)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="notif-body">
                            <div class="notif-title" style="color:var(--text-secondary)">New Downloadable Form Added</div>
                            <div class="notif-desc">Application Form 2026 has been uploaded.</div>
                            <div class="notif-time">2 days ago</div>
                        </div>
                    </div>
                    <div class="notif-item" onclick="markRead(this)">
                        <div class="notif-icon" style="background:var(--surface2);color:var(--text-muted)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="notif-body">
                            <div class="notif-title" style="color:var(--text-secondary)">FAQ Responded</div>
                            <div class="notif-desc">Application Requirements FAQ was answered by admin.</div>
                            <div class="notif-time">3 days ago</div>
                        </div>
                    </div>
                </div>
                <div style="margin-top:14px;text-align:center;">
                    <button onclick="showToast('info','All Caught Up','No more notifications to load.')" style="font-size:12.5px;font-weight:600;color:var(--blue);background:none;border:none;cursor:pointer;font-family:Arial,sans-serif;padding:6px 12px;border-radius:6px;transition:background 0.15s;" onmouseover="this.style.background='var(--blue-light)'" onmouseout="this.style.background='none'">Load More Notifications</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        // ── LIVE DATE ──
        function updateDate() {
            const now = new Date();
            const opts = {
                weekday: 'short',
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            };
            document.getElementById('live-date').textContent = now.toLocaleDateString('en-US', opts);
        }
        updateDate();

        // ── LOAD STAT CARDS after short delay ──
        const statsData = [{
                label: 'Total Announcements',
                value: '{{ $totalAnnouncements ?? 24 }}',
                sub: 'All time',
                badge: '+3 this month',
                badgeType: 'up',
                color: 'blue',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>'
            },
            {
                label: 'Total News',
                value: '{{ $totalNews ?? 58 }}',
                sub: 'Published articles',
                badge: '+7 this month',
                badgeType: 'up',
                color: 'green',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h8v4H7v-4z"/>'
            },
            {
                label: 'Total Services',
                value: '{{ $totalServices ?? 12 }}',
                sub: 'Active listings',
                badge: 'No change',
                badgeType: 'same',
                color: 'purple',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'
            },
            {
                label: 'Total FAQs',
                value: '{{ $totalFAQs ?? 23 }}',
                sub: '5 unanswered',
                badge: '-2 resolved',
                badgeType: 'down',
                color: 'orange',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
            },
            {
                label: 'Downloadable Forms',
                value: '{{ $totalForms ?? 9 }}',
                sub: 'Available for download',
                badge: '+1 this week',
                badgeType: 'up',
                color: 'red',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'
            },
        ];

        setTimeout(() => {
            const grid = document.getElementById('stats-grid');
            grid.innerHTML = statsData.map((s, i) => `
      <div class="stat-card ${s.color}" style="animation-delay:${0.05 + i * 0.06}s">
        <div class="stat-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">${s.icon}</svg>
        </div>
        <p class="stat-label">${s.label}</p>
        <p class="stat-value">${s.value}</p>
        <p class="stat-sub">${s.sub}</p>
        <span class="stat-badge badge-${s.badgeType}">
          ${s.badgeType==='up'?'↑':s.badgeType==='down'?'↓':'→'} ${s.badge}
        </span>
      </div>
    `).join('');
        }, 700);

        // ── ANIMATE PROGRESS BARS ──
        setTimeout(() => {
            document.querySelectorAll('.progress-bar[data-width]').forEach(bar => {
                bar.style.width = bar.dataset.width + '%';
            });
        }, 900);

        // ── TOAST ──
        function showToast(type, title, msg, duration = 3500) {
            const icons = {
                success: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>',
                info: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                warning: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            };
            const t = document.createElement('div');
            t.className = `toast toast-${type}`;
            t.innerHTML = `
      <div class="toast-icon">${icons[type]||icons.info}</div>
      <div class="toast-body"><div class="toast-title">${title}</div><div class="toast-msg">${msg}</div></div>
      <span class="toast-close" onclick="dismissToast(this.parentElement)">&times;</span>`;
            document.getElementById('toast-container').appendChild(t);
            setTimeout(() => dismissToast(t), duration);
        }

        function dismissToast(el) {
            el.classList.add('hiding');
            setTimeout(() => el.remove(), 300);
        }

        // ── MODAL ──
        let pendingRoute = null;

        function openModal(title, body, route) {
            pendingRoute = route;
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-body').textContent = body;
            document.getElementById('modal').classList.add('open');
        }

        function closeModal(e) {
            if (!e || e.target === document.getElementById('modal')) {
                document.getElementById('modal').classList.remove('open');
            }
        }

        function handleModalConfirm() {
            closeModal();
            const btn = document.getElementById('modal-confirm-btn');
            btn.innerHTML = '<span class="spinner"></span>';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = 'Continue';
                btn.disabled = false;
                showToast('info', 'Redirecting...', 'Opening the content creation form.');
                // In production: window.location.href = routes[pendingRoute];
            }, 900);
        }

        // ── MARK NOTIFICATION AS READ ──
        function markRead(el) {
            el.classList.remove('unread');
            showToast('success', 'Notification Read', 'Marked as read.');
        }

        // ── WELCOME TOAST ON LOAD ──
        setTimeout(() => {
            showToast('success', 'Welcome back, Editor!', 'Dashboard loaded successfully. Have a great day!', 4000);
        }, 1200);
    </script>
@endsection