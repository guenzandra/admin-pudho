<?php
// resources/views/admin/login.blade.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PUDHO — Admin Portal</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --red:       #C0202F;
            --red-dark:  #9A1520;
            --red-mid:   #D63545;
            --red-light: #E8667380;
            --white:     #ffffff;
            --off:       #FDF7F7;
            --pale:      #FFF0F1;
            --line:      #F0D5D7;
            --text:      #2A0A0E;
            --text-mid:  #6B2A30;
            --text-soft: #A87A80;
        }

        html, body {
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            position: relative;
            overflow: hidden;
            background: #fff;
        }
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        /* Soft gradient wash — white top, warm red bottom */
        .bg-canvas::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(160deg,
                    #ffffff 0%,
                    #fff5f5 30%,
                    #ffe0e2 60%,
                    #fbc8cc 80%,
                    #f0a0a8 100%);
        }

        /* Animated soft blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.55;
        }
        .blob-1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, #e8505e, transparent 70%);
            top: -200px; right: -150px;
            animation: floatA 14s ease-in-out infinite alternate;
        }
        .blob-2 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #ff8a95, transparent 70%);
            bottom: -150px; left: -100px;
            animation: floatB 18s ease-in-out infinite alternate;
        }
        .blob-3 {
            width: 350px; height: 350px;
            background: radial-gradient(circle, #ffd0d4, transparent 70%);
            top: 40%; left: 30%;
            animation: floatC 12s ease-in-out infinite alternate;
        }
        @keyframes floatA { to { transform: translate(-80px, 100px) scale(1.1); } }
        @keyframes floatB { to { transform: translate(100px, -80px) scale(1.15); } }
        @keyframes floatC { to { transform: translate(60px, -50px) scale(0.9); } }

        /* Floating mini house silhouettes in BG */
        .bg-houses {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }
        .bg-house {
            position: absolute;
            opacity: 0.07;
        }
        .bg-house svg { fill: var(--red-dark); }

        /* Subtle dot grid */
        .bg-dots {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(192,32,47,0.12) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        /* ═══════════════════════════════════
           LOADING OVERLAY
        ═══════════════════════════════════ */
        #loadingOverlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(255, 242, 244, 0.92);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s ease;
        }
        #loadingOverlay.active { opacity: 1; pointer-events: all; }

        /* Animated House Loader */
        .house-loader {
            position: relative;
            width: 100px;
            height: 90px;
            margin-bottom: 20px;
        }
        /* House body */
        .h-body {
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 60px; height: 44px;
            background: var(--red);
            border-radius: 3px 3px 4px 4px;
        }
        /* Door */
        .h-door {
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 16px; height: 24px;
            background: var(--red-dark);
            border-radius: 8px 8px 0 0;
        }
        /* Window left */
        .h-win-l {
            position: absolute;
            bottom: 18px; left: 8px;
            width: 12px; height: 12px;
            background: white;
            border-radius: 2px;
            animation: windowBlink 2.5s ease-in-out infinite;
        }
        /* Window right */
        .h-win-r {
            position: absolute;
            bottom: 18px; right: 8px;
            width: 12px; height: 12px;
            background: white;
            border-radius: 2px;
            animation: windowBlink 2.5s ease-in-out infinite 0.8s;
        }
        @keyframes windowBlink {
            0%, 100% { background: white; box-shadow: none; }
            50% { background: #ffe066; box-shadow: 0 0 8px 2px rgba(255,220,80,0.6); }
        }
        /* Roof */
        .h-roof {
            position: absolute;
            bottom: 44px; left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 32px solid var(--red-dark);
            filter: drop-shadow(0 -2px 4px rgba(192,32,47,0.3));
        }
        /* Chimney */
        .h-chimney {
            position: absolute;
            bottom: 68px; right: 22px;
            width: 10px; height: 16px;
            background: var(--red-dark);
            border-radius: 2px 2px 0 0;
        }
        /* Smoke puffs */
        .smoke {
            position: absolute;
            bottom: 84px; right: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }
        .smoke-puff {
            width: 8px; height: 8px;
            background: rgba(192,32,47,0.2);
            border-radius: 50%;
            animation: smokeRise 2s ease-out infinite;
        }
        .smoke-puff:nth-child(2) { animation-delay: 0.6s; width: 6px; height: 6px; }
        .smoke-puff:nth-child(3) { animation-delay: 1.2s; width: 5px; height: 5px; }
        @keyframes smokeRise {
            0%   { opacity: 0.7; transform: translateY(0) scale(1); }
            100% { opacity: 0; transform: translateY(-24px) scale(2.5); }
        }
        /* Bounce animation for whole house */
        .house-loader { animation: houseFloat 2s ease-in-out infinite; }
        @keyframes houseFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        /* Ground line */
        .h-ground {
            position: absolute;
            bottom: -6px; left: 50%;
            transform: translateX(-50%);
            width: 80px; height: 3px;
            background: var(--red);
            border-radius: 2px;
            opacity: 0.3;
            animation: groundPulse 2s ease-in-out infinite;
        }
        @keyframes groundPulse {
            0%, 100% { width: 80px; opacity: 0.3; }
            50% { width: 55px; opacity: 0.15; }
        }

        .loader-progress {
            width: 160px;
            height: 3px;
            background: var(--line);
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 12px;
        }
        .loader-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--red), var(--red-mid));
            border-radius: 3px;
            animation: loadProgress 1.8s ease-in-out infinite;
        }
        @keyframes loadProgress {
            0% { width: 0%; margin-left: 0%; }
            50% { width: 70%; margin-left: 15%; }
            100% { width: 0%; margin-left: 100%; }
        }
        .loader-text {
            font-size: 12px;
            color: var(--text-mid);
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        /* ═══════════════════════════════════
           CARD
        ═══════════════════════════════════ */
        .card-wrap {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            animation: riseUp 0.65s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        @keyframes riseUp {
            from { opacity: 0; transform: translateY(28px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow:
                0 0 0 1px rgba(192,32,47,0.1),
                0 8px 32px rgba(192,32,47,0.15),
                0 32px 64px rgba(0,0,0,0.12);
        }

        /* ── HEADER ── */
        .card-header {
            background: linear-gradient(145deg, var(--red-dark) 0%, var(--red) 55%, var(--red-mid) 100%);
            padding: 30px 36px 26px;
            position: relative;
            overflow: hidden;
        }
        /* Decorative circle top-right */
        .card-header::before {
            content: '';
            position: absolute;
            top: -50px; right: -50px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }
        .card-header::after {
            content: '';
            position: absolute;
            bottom: -30px; left: -30px;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: rgba(0,0,0,0.06);
        }

        /* Small animated house in header corner */
        .header-house {
            position: absolute;
            right: 36px;
            bottom: 20px;
            opacity: 0.18;
            animation: headerHouseFloat 3s ease-in-out infinite;
        }
        @keyframes headerHouseFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .header-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .header-logo {
            width: 60px; height: 60px;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid rgba(255,255,255,0.35);
            flex-shrink: 0;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
            background: rgba(255,255,255,0.15);
        }
        .header-logo img { width: 100%; height: 100%; object-fit: cover; }

        /* Fallback logo when no image */
        .logo-fallback {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 900; color: white;
            background: rgba(255,255,255,0.2);
        }

        .header-titles { flex: 1; }
        .header-eyebrow {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            margin-bottom: 5px;
        }
        .header-name {
            font-size: 15px;
            font-weight: 700;
            color: white;
            line-height: 1.25;
            letter-spacing: 0.01em;
        }
        .header-loc {
            font-size: 11px;
            color: rgba(255,255,255,0.65);
            margin-top: 3px;
        }

        /* Secure badge */
        .secure-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 20px;
            padding: 4px 11px;
            font-size: 9.5px;
            font-weight: 700;
            color: rgba(255,255,255,0.9);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-top: 14px;
        }
        .live-dot {
            width: 6px; height: 6px;
            background: #7dffaa;
            border-radius: 50%;
            animation: livePulse 2s ease-in-out infinite;
        }
        @keyframes livePulse {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(125,255,170,0.5); }
            50% { opacity: 0.5; box-shadow: 0 0 0 4px rgba(125,255,170,0); }
        }

        /* ── FORM SECTION ── */
        .card-body { padding: 28px 36px 24px; }

        .form-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }
        .form-sub {
            font-size: 12px;
            color: var(--text-soft);
            margin-bottom: 22px;
        }

        /* Flash messages */
        .flash {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            padding: 11px 13px;
            border-radius: 8px;
            font-size: 12.5px;
            line-height: 1.5;
            margin-bottom: 18px;
        }
        .flash.error {
            background: #fff3f4;
            border: 1px solid #fcc;
            border-left: 3px solid var(--red);
            color: #7a1010;
        }
        .flash.success {
            background: #f0fff5;
            border: 1px solid #b3f0c8;
            border-left: 3px solid #1a8a3a;
            color: #0f4a20;
        }
        .flash svg { flex-shrink: 0; margin-top: 1px; }

        #errorAlert {
            display: none;
            align-items: flex-start;
            gap: 9px;
            background: #fff3f4;
            border: 1px solid #fcc;
            border-left: 3px solid var(--red);
            border-radius: 8px;
            padding: 11px 13px;
            margin-bottom: 18px;
            font-size: 12.5px;
            color: #7a1010;
            line-height: 1.5;
        }
        #errorAlert.show { display: flex; }
        #errorAlert svg { flex-shrink: 0; margin-top: 1px; color: var(--red); }

        /* Fields */
        .field { margin-bottom: 16px; }
        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-mid);
            text-transform: uppercase;
            letter-spacing: 0.09em;
            margin-bottom: 6px;
        }
        .field-wrap { position: relative; }
        .field-icon {
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--red);
            pointer-events: none;
            border-right: 1px solid var(--line);
        }
        .field-input {
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13.5px;
            color: var(--text);
            background: var(--off);
            border: 1.5px solid var(--line);
            border-radius: 8px;
            padding: 11px 12px 11px 48px;
            outline: none;
            transition: all 0.2s;
        }
        .field-input::placeholder { color: #d0b0b4; }
        .field-input:focus {
            border-color: var(--red);
            background: white;
            box-shadow: 0 0 0 3px rgba(192,32,47,0.1);
        }
        .field-input.pr { padding-right: 42px; }
        .eye-btn {
            position: absolute;
            right: 11px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; color: var(--text-soft);
            padding: 2px; display: flex;
            transition: color 0.2s;
        }
        .eye-btn:hover { color: var(--red); }

        /* Divider */
        .divider { height: 1px; background: var(--line); margin: 6px 0 18px; }

        /* Meta row */
        .meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .check-wrap {
            display: flex; align-items: center; gap: 7px;
            cursor: pointer; font-size: 12.5px; color: var(--text-soft);
        }
        .check-wrap input { width: 14px; height: 14px; accent-color: var(--red); cursor: pointer; }
        .forgot-btn {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12.5px; font-weight: 700;
            color: var(--red); background: none; border: none;
            cursor: pointer; padding: 0;
            transition: opacity 0.15s;
        }
        .forgot-btn:hover { opacity: 0.7; text-decoration: underline; }

        /* Submit */
        .submit-btn {
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px; font-weight: 700;
            letter-spacing: 0.06em; text-transform: uppercase;
            color: white;
            background: linear-gradient(135deg, var(--red) 0%, var(--red-dark) 100%);
            border: none; border-radius: 9px;
            padding: 13px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 9px;
            transition: all 0.2s;
            box-shadow: 0 4px 16px rgba(192,32,47,0.35), 0 1px 4px rgba(0,0,0,0.1);
            position: relative; overflow: hidden;
        }
        .submit-btn::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 60%);
        }
        .submit-btn:hover {
            background: linear-gradient(135deg, var(--red-mid) 0%, var(--red) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(192,32,47,0.4), 0 2px 6px rgba(0,0,0,0.12);
        }
        .submit-btn:active { transform: translateY(0); }
        .submit-btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; }
        .btn-arrow { transition: transform 0.2s; }
        .submit-btn:hover .btn-arrow { transform: translateX(4px); }

        /* ── FOOTER ── */
        .card-footer {
            padding: 13px 36px;
            background: var(--pale);
            border-top: 1px solid var(--line);
            display: flex; align-items: center; justify-content: space-between;
        }
        .footer-copy { font-size: 10.5px; color: var(--text-soft); }
        .footer-links { display: flex; gap: 14px; }
        .footer-link {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5px; color: var(--text-soft);
            background: none; border: none; cursor: pointer;
            padding: 0; text-decoration: none;
            transition: color 0.2s;
        }
        .footer-link:hover { color: var(--red); }

        /* ═══════════════════════════════════
           FLOATING HOUSES ANIMATION (BG)
        ═══════════════════════════════════ */
        @keyframes floatHouseUp {
            0%   { transform: translateY(0px) rotate(-2deg); opacity: 0.06; }
            50%  { opacity: 0.1; }
            100% { transform: translateY(-20px) rotate(2deg); opacity: 0.06; }
        }
        .bh1 { top: 8%; left: 5%;   animation: floatHouseUp 7s ease-in-out infinite alternate; }
        .bh2 { top: 15%; right: 6%; animation: floatHouseUp 9s ease-in-out infinite alternate 1s; }
        .bh3 { bottom: 20%; left: 8%; animation: floatHouseUp 8s ease-in-out infinite alternate 2s; }
        .bh4 { bottom: 12%; right: 5%; animation: floatHouseUp 10s ease-in-out infinite alternate 0.5s; }
        .bh5 { top: 50%; left: 2%;  animation: floatHouseUp 6s ease-in-out infinite alternate 1.5s; }

        /* ═══════════════════════════════════
           TOAST
        ═══════════════════════════════════ */
        #toastContainer {
            position: fixed; top: 18px; right: 18px;
            z-index: 10000;
            display: flex; flex-direction: column; gap: 8px;
        }
        .toast {
            font-family: Arial, Helvetica, sans-serif;
            display: flex; align-items: center; gap: 10px;
            padding: 11px 14px; border-radius: 9px;
            font-size: 12.5px; color: white;
            min-width: 270px; max-width: 340px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.18);
            animation: tIn 0.28s ease forwards;
        }
        .toast.hide { animation: tOut 0.25s ease forwards; }
        .toast.success { background: #1a6e35; }
        .toast.error   { background: var(--red-dark); }
        .toast.info    { background: #2a3a6a; }
        .toast span { flex: 1; line-height: 1.4; }
        .toast-x { background: none; border: none; cursor: pointer; color: rgba(255,255,255,0.6); padding: 0; display: flex; flex-shrink: 0; }
        .toast-x:hover { color: white; }
        @keyframes tIn  { from { transform: translateX(110%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes tOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(110%); opacity: 0; } }

        @media (max-width: 520px) {
            .card-header { padding: 24px 22px 20px; }
            .card-body   { padding: 22px 22px 18px; }
            .card-footer { padding: 11px 22px; }
        }
    </style>
</head>
<body>

    <!-- ═══ ANIMATED BACKGROUND ═══ -->
    <div class="bg-canvas">
        <div class="bg-dots"></div>
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <!-- Floating house silhouettes -->
        <div class="bg-houses">
            <!-- House SVG repeated at different positions/sizes -->
            <div class="bg-house bh1">
                <svg width="72" height="64" viewBox="0 0 72 64">
                    <polygon points="36,4 68,28 4,28" fill="currentColor"/>
                    <rect x="12" y="28" width="48" height="36" rx="2"/>
                    <rect x="28" y="40" width="16" height="24" rx="3"/>
                    <rect x="16" y="34" width="10" height="10" rx="1"/>
                    <rect x="46" y="34" width="10" height="10" rx="1"/>
                    <rect x="48" y="10" width="8" height="18"/>
                </svg>
            </div>
            <div class="bg-house bh2">
                <svg width="56" height="50" viewBox="0 0 72 64">
                    <polygon points="36,4 68,28 4,28" fill="currentColor"/>
                    <rect x="12" y="28" width="48" height="36" rx="2"/>
                    <rect x="28" y="40" width="16" height="24" rx="3"/>
                </svg>
            </div>
            <div class="bg-house bh3">
                <svg width="90" height="80" viewBox="0 0 72 64">
                    <polygon points="36,4 68,28 4,28" fill="currentColor"/>
                    <rect x="12" y="28" width="48" height="36" rx="2"/>
                    <rect x="28" y="40" width="16" height="24" rx="3"/>
                    <rect x="16" y="34" width="10" height="10" rx="1"/>
                    <rect x="46" y="34" width="10" height="10" rx="1"/>
                </svg>
            </div>
            <div class="bg-house bh4">
                <svg width="64" height="56" viewBox="0 0 72 64">
                    <polygon points="36,4 68,28 4,28" fill="currentColor"/>
                    <rect x="12" y="28" width="48" height="36" rx="2"/>
                    <rect x="28" y="40" width="16" height="24" rx="3"/>
                </svg>
            </div>
            <div class="bg-house bh5">
                <svg width="48" height="42" viewBox="0 0 72 64">
                    <polygon points="36,4 68,28 4,28" fill="currentColor"/>
                    <rect x="12" y="28" width="48" height="36" rx="2"/>
                    <rect x="28" y="40" width="16" height="24" rx="3"/>
                    <rect x="16" y="34" width="10" height="10" rx="1"/>
                    <rect x="46" y="34" width="10" height="10" rx="1"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- ═══ LOADING OVERLAY ═══ -->
    <div id="loadingOverlay">
        <div class="house-loader">
            <div class="smoke">
                <div class="smoke-puff"></div>
                <div class="smoke-puff"></div>
                <div class="smoke-puff"></div>
            </div>
            <div class="h-chimney"></div>
            <div class="h-roof"></div>
            <div class="h-body">
                <div class="h-win-l"></div>
                <div class="h-win-r"></div>
                <div class="h-door"></div>
            </div>
            <div class="h-ground"></div>
        </div>
        <div class="loader-progress">
            <div class="loader-bar"></div>
        </div>
        <p class="loader-text">Authenticating…</p>
    </div>

    <!-- TOAST -->
    <div id="toastContainer"></div>

    <!-- ═══ CARD ═══ -->
    <div class="card-wrap">
        <div class="card">

            <!-- Header -->
            <div class="card-header">
                <!-- Decorative mini house in corner -->
                <div class="header-house">
                    <svg width="64" height="56" viewBox="0 0 72 64" fill="white">
                        <polygon points="36,4 68,28 4,28"/>
                        <rect x="12" y="28" width="48" height="36" rx="2"/>
                        <rect x="28" y="40" width="16" height="24" rx="3" fill="rgba(0,0,0,0.25)"/>
                        <rect x="16" y="34" width="10" height="10" rx="1" fill="rgba(255,255,255,0.4)"/>
                        <rect x="46" y="34" width="10" height="10" rx="1" fill="rgba(255,255,255,0.4)"/>
                    </svg>
                </div>

                <div class="header-inner">
                    <div class="header-logo">
                        <img src="{{ asset('build/assets/images/logo-pudho.jpg') }}"
                             alt="PUDHO Logo"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="logo-fallback" style="display:none">P</div>
                    </div>
                    <div class="header-titles">
                        <div class="header-eyebrow">Republic of the Philippines</div>
                        <div class="header-name">Provincial Urban Development<br>and Housing Office</div>
                        <div class="header-loc">Province of Laguna</div>
                    </div>
                </div>
                <div>
                    <span class="secure-badge">
                        <span class="live-dot"></span>
                        Secure Admin Portal
                    </span>
                </div>
            </div>

            <!-- Body -->
            <div class="card-body">
                <div class="form-title">Welcome back</div>
                <div class="form-sub">Sign in with your administrator credentials to continue.</div>

                @if(session('error'))
                <div class="flash error">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
                @endif
                @if(session('success'))
                <div class="flash success">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
                @endif

                <div id="errorAlert">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span id="errorMessage"></span>
                </div>

                <form id="loginForm" onsubmit="return false;">
                    @csrf

                    <div class="field">
                        <label class="field-label" for="username">Username or Email</label>
                        <div class="field-wrap">
                            <div class="field-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" id="username" name="username"
                                   class="field-input"
                                   placeholder="Enter your username or email"
                                   autocomplete="username" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="password">Password</label>
                        <div class="field-wrap">
                            <div class="field-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password"
                                   class="field-input pr"
                                   placeholder="Enter your password"
                                   autocomplete="current-password" required>
                            <button type="button" class="eye-btn" onclick="togglePassword()">
                                <svg id="eyeIcon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="meta-row">
                        <label class="check-wrap">
                            <input type="checkbox" id="remember" name="remember">
                            Remember me
                        </label>
                        <button type="button" class="forgot-btn" onclick="showForgotPassword()">Forgot password?</button>
                    </div>

                    <button type="submit" class="submit-btn" id="loginButton">
                        <span id="buttonText">Sign In to Dashboard</span>
                        <svg class="btn-arrow" width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="card-footer">
                <span class="footer-copy">&copy; {{ date('Y') }} PUDHO &mdash; Province of Laguna</span>
                <div class="footer-links">
                    <button class="footer-link" onclick="showTerms()">Terms</button>
                    <button class="footer-link" onclick="showPrivacy()">Privacy</button>
                    <a href="mailto:support@pudho-laguna.gov.ph" class="footer-link">Support</a>
                </div>
            </div>

        </div>
    </div>

    <script>
        let isSubmitting = false;

        function showLoading() { document.getElementById('loadingOverlay').classList.add('active'); }
        function hideLoading() { document.getElementById('loadingOverlay').classList.remove('active'); }

        function showToast(msg, type = 'success', dur = 3500) {
            const c = document.getElementById('toastContainer');
            const id = 'toast-' + Date.now();
            const paths = {
                success: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                error:   'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                info:    'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
            };
            c.insertAdjacentHTML('beforeend', `
                <div id="${id}" class="toast ${type}">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${paths[type]||paths.info}"/>
                    </svg>
                    <span>${msg}</span>
                    <button class="toast-x" onclick="closeToast('${id}')">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>`);
            setTimeout(() => closeToast(id), dur);
        }
        function closeToast(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.add('hide');
            setTimeout(() => el.remove(), 260);
        }

        function togglePassword() {
            const inp = document.getElementById('password');
            const ico = document.getElementById('eyeIcon');
            if (inp.type === 'password') {
                inp.type = 'text';
                ico.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                inp.type = 'password';
                ico.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }

        function showError(msg) {
            const el = document.getElementById('errorAlert');
            document.getElementById('errorMessage').textContent = msg;
            el.classList.add('show');
            setTimeout(() => el.classList.remove('show'), 6000);
        }

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            if (isSubmitting) return;
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;
            if (!username || !password) { showError('Please enter both username and password.'); return; }

            isSubmitting = true;
            const btn = document.getElementById('loginButton');
            document.getElementById('buttonText').textContent = 'Signing in…';
            btn.disabled = true;
            showLoading();

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]').content;
                const res  = await fetch('/admin/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                    body: JSON.stringify({ username, password, remember })
                });
                const data = await res.json();
                if (data.success) {
                    if (data.user) sessionStorage.setItem('user', JSON.stringify(data.user));
                    showToast('Login successful. Redirecting…', 'success');
                    setTimeout(() => { window.location.href = data.redirect || '/admin/dashboard'; }, 700);
                } else {
                    hideLoading();
                    showError(data.message || 'Invalid credentials. Please try again.');
                    showToast(data.message || 'Login failed.', 'error');
                    document.getElementById('buttonText').textContent = 'Sign In to Dashboard';
                    btn.disabled = false;
                    isSubmitting = false;
                }
            } catch (err) {
                hideLoading();
                const msg = !navigator.onLine ? 'No internet connection.' : 'Connection error. Please try again.';
                showError(msg); showToast(msg, 'error');
                document.getElementById('buttonText').textContent = 'Sign In to Dashboard';
                btn.disabled = false;
                isSubmitting = false;
            }
        });

        function showForgotPassword() { showToast('Please contact your system administrator to reset your password.', 'info'); }
        function showTerms()   { showToast('Terms of service will be available soon.', 'info'); }
        function showPrivacy() { showToast('Privacy policy will be available soon.', 'info'); }

        document.addEventListener('DOMContentLoaded', () => {
            fetch('/admin/check-auth', {
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            }).then(r => r.json()).then(d => {
                if (d.authenticated) window.location.href = d.redirect || '/admin/dashboard';
            }).catch(() => {});
        });

        window.history.pushState(null, null, window.location.href);
        window.addEventListener('popstate', () => { window.history.pushState(null, null, window.location.href); });
    </script>
</body>
</html>