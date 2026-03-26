<?php
// resources/views/login/login.blade.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>PUDHO — Admin Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --red: #C0202F;
      --red-dark: #8E1420;
      --red-mid: #D63545;
      --white: #ffffff;
      --off: #FDF6F6;
      --pale: #FFF0F1;
      --line: #ECDCDE;
      --text: #1E0608;
      --text-mid: #6B2A30;
      --text-soft: #A87A80;
      --shadow-red: rgba(192, 32, 47, 0.18);
    }

    html,
    body {
      height: 100%;
      font-family: 'DM Sans', sans-serif;
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

    /* ═══════════════════════════════════
           ANIMATED BACKGROUND
        ═══════════════════════════════════ */
    .bg-canvas {
      position: fixed;
      inset: 0;
      z-index: 0;
      overflow: hidden;
    }

    .bg-canvas::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(155deg,
          #ffffff 0%,
          #fff8f8 25%,
          #ffe6e8 55%,
          #fac4c9 80%,
          #f0a0a8 100%);
    }

    /* Animated blobs */
    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.5;
    }

    .blob-1 {
      width: 620px;
      height: 620px;
      background: radial-gradient(circle, #d94455, transparent 70%);
      top: -220px;
      right: -160px;
      animation: floatA 15s ease-in-out infinite alternate;
    }

    .blob-2 {
      width: 520px;
      height: 520px;
      background: radial-gradient(circle, #ff8a95, transparent 70%);
      bottom: -160px;
      left: -110px;
      animation: floatB 19s ease-in-out infinite alternate;
    }

    .blob-3 {
      width: 360px;
      height: 360px;
      background: radial-gradient(circle, #ffd0d4, transparent 70%);
      top: 38%;
      left: 28%;
      animation: floatC 13s ease-in-out infinite alternate;
    }

    @keyframes floatA {
      to {
        transform: translate(-80px, 100px) scale(1.08);
      }
    }

    @keyframes floatB {
      to {
        transform: translate(100px, -80px) scale(1.14);
      }
    }

    @keyframes floatC {
      to {
        transform: translate(60px, -50px) scale(0.9);
      }
    }

    /* Dot grid */
    .bg-dots {
      position: absolute;
      inset: 0;
      background-image: radial-gradient(circle, rgba(192, 32, 47, 0.1) 1px, transparent 1px);
      background-size: 30px 30px;
    }

    /* Floating house silhouettes */
    .bg-houses {
      position: absolute;
      inset: 0;
      pointer-events: none;
    }

    .bg-house {
      position: absolute;
      opacity: 0.065;
    }

    .bg-house svg {
      fill: var(--red-dark);
    }

    .bh1 {
      top: 7%;
      left: 4%;
      animation: floatHouseUp 7s ease-in-out infinite alternate;
    }

    .bh2 {
      top: 14%;
      right: 5%;
      animation: floatHouseUp 9s ease-in-out infinite alternate 1s;
    }

    .bh3 {
      bottom: 19%;
      left: 7%;
      animation: floatHouseUp 8s ease-in-out infinite alternate 2s;
    }

    .bh4 {
      bottom: 11%;
      right: 4%;
      animation: floatHouseUp 10s ease-in-out infinite alternate 0.5s;
    }

    .bh5 {
      top: 49%;
      left: 2%;
      animation: floatHouseUp 6s ease-in-out infinite alternate 1.5s;
    }

    @keyframes floatHouseUp {
      0% {
        transform: translateY(0px) rotate(-2deg);
        opacity: 0.065;
      }

      50% {
        opacity: 0.1;
      }

      100% {
        transform: translateY(-18px) rotate(2deg);
        opacity: 0.065;
      }
    }

    /* ═══════════════════════════════════
           LOADING OVERLAY
        ═══════════════════════════════════ */
    #loadingOverlay {
      position: fixed;
      inset: 0;
      z-index: 9999;
      background: rgba(255, 242, 244, 0.92);
      backdrop-filter: blur(12px);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.35s ease;
    }

    #loadingOverlay.active {
      opacity: 1;
      pointer-events: all;
    }

    /* Animated house loader */
    .house-loader {
      position: relative;
      width: 100px;
      height: 90px;
      margin-bottom: 20px;
      animation: houseFloat 2s ease-in-out infinite;
    }

    @keyframes houseFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-8px);
      }
    }

    .h-body {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 44px;
      background: var(--red);
      border-radius: 3px 3px 4px 4px;
    }

    .h-door {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 16px;
      height: 24px;
      background: var(--red-dark);
      border-radius: 8px 8px 0 0;
    }

    .h-win-l {
      position: absolute;
      bottom: 18px;
      left: 8px;
      width: 12px;
      height: 12px;
      background: white;
      border-radius: 2px;
      animation: windowBlink 2.5s ease-in-out infinite;
    }

    .h-win-r {
      position: absolute;
      bottom: 18px;
      right: 8px;
      width: 12px;
      height: 12px;
      background: white;
      border-radius: 2px;
      animation: windowBlink 2.5s ease-in-out infinite 0.8s;
    }

    @keyframes windowBlink {

      0%,
      100% {
        background: white;
        box-shadow: none;
      }

      50% {
        background: #ffe066;
        box-shadow: 0 0 8px 2px rgba(255, 220, 80, 0.6);
      }
    }

    .h-roof {
      position: absolute;
      bottom: 44px;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 0;
      border-left: 40px solid transparent;
      border-right: 40px solid transparent;
      border-bottom: 32px solid var(--red-dark);
      filter: drop-shadow(0 -2px 4px rgba(192, 32, 47, 0.28));
    }

    .h-chimney {
      position: absolute;
      bottom: 68px;
      right: 22px;
      width: 10px;
      height: 16px;
      background: var(--red-dark);
      border-radius: 2px 2px 0 0;
    }

    .smoke {
      position: absolute;
      bottom: 84px;
      right: 24px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 2px;
    }

    .smoke-puff {
      width: 8px;
      height: 8px;
      background: rgba(192, 32, 47, 0.2);
      border-radius: 50%;
      animation: smokeRise 2s ease-out infinite;
    }

    .smoke-puff:nth-child(2) {
      animation-delay: 0.6s;
      width: 6px;
      height: 6px;
    }

    .smoke-puff:nth-child(3) {
      animation-delay: 1.2s;
      width: 5px;
      height: 5px;
    }

    @keyframes smokeRise {
      0% {
        opacity: 0.7;
        transform: translateY(0) scale(1);
      }

      100% {
        opacity: 0;
        transform: translateY(-24px) scale(2.5);
      }
    }

    .h-ground {
      position: absolute;
      bottom: -6px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: var(--red);
      border-radius: 2px;
      opacity: 0.3;
      animation: groundPulse 2s ease-in-out infinite;
    }

    @keyframes groundPulse {

      0%,
      100% {
        width: 80px;
        opacity: 0.3;
      }

      50% {
        width: 55px;
        opacity: 0.15;
      }
    }

    .loader-progress {
      width: 160px;
      height: 3px;
      background: var(--line);
      border-radius: 3px;
      overflow: hidden;
      margin-bottom: 13px;
    }

    .loader-bar {
      height: 100%;
      background: linear-gradient(90deg, var(--red), var(--red-mid));
      border-radius: 3px;
      animation: loadProgress 1.8s ease-in-out infinite;
    }

    @keyframes loadProgress {
      0% {
        width: 0%;
        margin-left: 0%;
      }

      50% {
        width: 70%;
        margin-left: 15%;
      }

      100% {
        width: 0%;
        margin-left: 100%;
      }
    }

    .loader-text {
      font-family: 'DM Sans', sans-serif;
      font-size: 11.5px;
      font-weight: 500;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--text-mid);
    }

    /* ═══════════════════════════════════
           CARD
        ═══════════════════════════════════ */
    .card-wrap {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 468px;
      animation: riseUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes riseUp {
      from {
        opacity: 0;
        transform: translateY(30px) scale(0.97);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .card {
      background: white;
      border-radius: 22px;
      overflow: hidden;
      box-shadow:
        0 0 0 1px rgba(192, 32, 47, 0.09),
        0 8px 30px rgba(192, 32, 47, 0.14),
        0 32px 60px rgba(0, 0, 0, 0.11);
    }

    /* ── HEADER ── */
    .card-header {
      background: linear-gradient(148deg, var(--red-dark) 0%, var(--red) 52%, var(--red-mid) 100%);
      padding: 30px 36px 26px;
      position: relative;
      overflow: hidden;
    }

    .card-header::before {
      content: '';
      position: absolute;
      top: -55px;
      right: -55px;
      width: 190px;
      height: 190px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.065);
    }

    .card-header::after {
      content: '';
      position: absolute;
      bottom: -32px;
      left: -32px;
      width: 130px;
      height: 130px;
      border-radius: 50%;
      background: rgba(0, 0, 0, 0.055);
    }

    /* Decorative house in header */
    .header-house {
      position: absolute;
      right: 34px;
      bottom: 18px;
      opacity: 0.16;
      animation: headerHouseFloat 3.2s ease-in-out infinite;
    }

    @keyframes headerHouseFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-5px);
      }
    }

    .header-inner {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .header-logo {
      width: 58px;
      height: 58px;
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid rgba(255, 255, 255, 0.3);
      flex-shrink: 0;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.22);
      background: rgba(255, 255, 255, 0.14);
    }

    .header-logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .logo-fallback {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'DM Serif Display', serif;
      font-size: 24px;
      color: white;
      background: rgba(255, 255, 255, 0.18);
    }

    .header-titles {
      flex: 1;
    }

    .header-eyebrow {
      font-size: 9px;
      font-weight: 600;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.55);
      margin-bottom: 5px;
    }

    .header-name {
      font-family: 'DM Serif Display', serif;
      font-size: 15px;
      font-style: italic;
      color: white;
      line-height: 1.3;
    }

    .header-loc {
      font-size: 11px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.6);
      margin-top: 4px;
    }

    .secure-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(255, 255, 255, 0.13);
      border: 1px solid rgba(255, 255, 255, 0.22);
      border-radius: 20px;
      padding: 4px 12px;
      font-size: 9.5px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.88);
      letter-spacing: 0.09em;
      text-transform: uppercase;
      margin-top: 14px;
    }

    .live-dot {
      width: 6px;
      height: 6px;
      background: #7dffaa;
      border-radius: 50%;
      animation: livePulse 2s ease-in-out infinite;
    }

    @keyframes livePulse {

      0%,
      100% {
        opacity: 1;
        box-shadow: 0 0 0 0 rgba(125, 255, 170, 0.5);
      }

      50% {
        opacity: 0.5;
        box-shadow: 0 0 0 4px rgba(125, 255, 170, 0);
      }
    }

    /* ── FORM BODY ── */
    .card-body {
      padding: 28px 36px 24px;
    }

    .form-title {
      font-family: 'DM Serif Display', serif;
      font-size: 20px;
      color: var(--text);
      margin-bottom: 4px;
    }

    .form-sub {
      font-size: 12.5px;
      font-weight: 400;
      color: var(--text-soft);
      margin-bottom: 22px;
      line-height: 1.55;
    }

    /* Flash messages (Blade) */
    .flash {
      display: flex;
      align-items: flex-start;
      gap: 9px;
      padding: 11px 13px;
      border-radius: 9px;
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

    .flash svg {
      flex-shrink: 0;
      margin-top: 1px;
    }

    /* JS error alert */
    #errorAlert {
      display: none;
      align-items: flex-start;
      gap: 9px;
      background: #fff3f4;
      border: 1px solid #fcc;
      border-left: 3px solid var(--red);
      border-radius: 9px;
      padding: 11px 13px;
      margin-bottom: 18px;
      font-size: 12.5px;
      color: #7a1010;
      line-height: 1.5;
    }

    #errorAlert.show {
      display: flex;
    }

    #errorAlert svg {
      flex-shrink: 0;
      margin-top: 1px;
      color: var(--red);
    }

    /* Fields */
    .field {
      margin-bottom: 15px;
    }

    .field-label {
      display: block;
      font-size: 10.5px;
      font-weight: 600;
      color: var(--text-mid);
      text-transform: uppercase;
      letter-spacing: 0.1em;
      margin-bottom: 6px;
    }

    .field-wrap {
      position: relative;
    }

    .field-icon {
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
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
      font-family: 'DM Sans', sans-serif;
      font-size: 13.5px;
      font-weight: 400;
      color: var(--text);
      background: var(--off);
      border: 1.5px solid var(--line);
      border-radius: 9px;
      padding: 11px 12px 11px 48px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }

    .field-input::placeholder {
      color: #d0b0b4;
    }

    .field-input:focus {
      border-color: var(--red);
      background: white;
      box-shadow: 0 0 0 3px rgba(192, 32, 47, 0.09);
    }

    .field-input.pr {
      padding-right: 42px;
    }

    .eye-btn {
      position: absolute;
      right: 11px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-soft);
      padding: 2px;
      display: flex;
      transition: color 0.2s;
    }

    .eye-btn:hover {
      color: var(--red);
    }

    /* Divider */
    .divider {
      height: 1px;
      background: var(--line);
      margin: 6px 0 17px;
    }

    /* Meta row */
    .meta-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .check-wrap {
      display: flex;
      align-items: center;
      gap: 7px;
      cursor: pointer;
      font-size: 12.5px;
      color: var(--text-soft);
    }

    .check-wrap input {
      width: 14px;
      height: 14px;
      accent-color: var(--red);
      cursor: pointer;
    }

    .forgot-btn {
      font-family: 'DM Sans', sans-serif;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--red);
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      transition: opacity 0.15s;
    }

    .forgot-btn:hover {
      opacity: 0.7;
      text-decoration: underline;
    }

    /* Submit button */
    .submit-btn {
      width: 100%;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: white;
      background: linear-gradient(135deg, var(--red) 0%, var(--red-dark) 100%);
      border: none;
      border-radius: 10px;
      padding: 13px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
      box-shadow: 0 4px 18px rgba(192, 32, 47, 0.34), 0 1px 4px rgba(0, 0, 0, 0.1);
      position: relative;
      overflow: hidden;
    }

    .submit-btn::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.14) 0%, transparent 60%);
    }

    .submit-btn:hover {
      background: linear-gradient(135deg, var(--red-mid) 0%, var(--red) 100%);
      transform: translateY(-2px);
      box-shadow: 0 8px 26px rgba(192, 32, 47, 0.4), 0 2px 6px rgba(0, 0, 0, 0.12);
    }

    .submit-btn:active {
      transform: translateY(0);
    }

    .submit-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    .btn-arrow {
      transition: transform 0.2s;
    }

    .submit-btn:hover .btn-arrow {
      transform: translateX(4px);
    }

    /* ── FOOTER ── */
    .card-footer {
      padding: 13px 36px;
      background: var(--pale);
      border-top: 1px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .footer-copy {
      font-size: 10.5px;
      font-weight: 400;
      color: var(--text-soft);
    }

    .footer-links {
      display: flex;
      gap: 14px;
    }

    .footer-link {
      font-family: 'DM Sans', sans-serif;
      font-size: 10.5px;
      color: var(--text-soft);
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-link:hover {
      color: var(--red);
    }

    /* ═══════════════════════════════════
           TOAST
        ═══════════════════════════════════ */
    #toastContainer {
      position: fixed;
      top: 18px;
      right: 18px;
      z-index: 10000;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .toast {
      font-family: 'DM Sans', sans-serif;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 11px 14px;
      border-radius: 10px;
      font-size: 12.5px;
      color: white;
      min-width: 270px;
      max-width: 340px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16);
      animation: tIn 0.28s ease forwards;
    }

    .toast.hide {
      animation: tOut 0.25s ease forwards;
    }

    .toast.success {
      background: #1a6e35;
    }

    .toast.error {
      background: var(--red-dark);
    }

    .toast.info {
      background: #2a3a6a;
    }

    .toast span {
      flex: 1;
      line-height: 1.45;
    }

    .toast-x {
      background: none;
      border: none;
      cursor: pointer;
      color: rgba(255, 255, 255, 0.6);
      padding: 0;
      display: flex;
      flex-shrink: 0;
    }

    .toast-x:hover {
      color: white;
    }

    @keyframes tIn {
      from {
        transform: translateX(110%);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes tOut {
      from {
        transform: translateX(0);
        opacity: 1;
      }

      to {
        transform: translateX(110%);
        opacity: 0;
      }
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 520px) {
      .card-header {
        padding: 22px 20px 18px;
      }

      .card-body {
        padding: 22px 20px 18px;
      }

      .card-footer {
        padding: 11px 20px;
        flex-direction: column;
        gap: 8px;
        align-items: flex-start;
      }
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

    <div class="bg-houses">
      <div class="bg-house bh1">
        <svg width="72" height="64" viewBox="0 0 72 64">
          <polygon points="36,4 68,28 4,28" />
          <rect x="12" y="28" width="48" height="36" rx="2" />
          <rect x="28" y="40" width="16" height="24" rx="3" />
          <rect x="16" y="34" width="10" height="10" rx="1" />
          <rect x="46" y="34" width="10" height="10" rx="1" />
          <rect x="48" y="10" width="8" height="18" />
        </svg>
      </div>
      <div class="bg-house bh2">
        <svg width="56" height="50" viewBox="0 0 72 64">
          <polygon points="36,4 68,28 4,28" />
          <rect x="12" y="28" width="48" height="36" rx="2" />
          <rect x="28" y="40" width="16" height="24" rx="3" />
        </svg>
      </div>
      <div class="bg-house bh3">
        <svg width="90" height="80" viewBox="0 0 72 64">
          <polygon points="36,4 68,28 4,28" />
          <rect x="12" y="28" width="48" height="36" rx="2" />
          <rect x="28" y="40" width="16" height="24" rx="3" />
          <rect x="16" y="34" width="10" height="10" rx="1" />
          <rect x="46" y="34" width="10" height="10" rx="1" />
        </svg>
      </div>
      <div class="bg-house bh4">
        <svg width="64" height="56" viewBox="0 0 72 64">
          <polygon points="36,4 68,28 4,28" />
          <rect x="12" y="28" width="48" height="36" rx="2" />
          <rect x="28" y="40" width="16" height="24" rx="3" />
        </svg>
      </div>
      <div class="bg-house bh5">
        <svg width="48" height="42" viewBox="0 0 72 64">
          <polygon points="36,4 68,28 4,28" />
          <rect x="12" y="28" width="48" height="36" rx="2" />
          <rect x="28" y="40" width="16" height="24" rx="3" />
          <rect x="16" y="34" width="10" height="10" rx="1" />
          <rect x="46" y="34" width="10" height="10" rx="1" />
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

  <!-- ═══ TOAST CONTAINER ═══ -->
  <div id="toastContainer"></div>

  <!-- ═══ CARD ═══ -->
  <div class="card-wrap">
    <div class="card">

      <!-- Header -->
      <div class="card-header">
        <div class="header-house">
          <svg width="64" height="56" viewBox="0 0 72 64" fill="white">
            <polygon points="36,4 68,28 4,28" />
            <rect x="12" y="28" width="48" height="36" rx="2" />
            <rect x="28" y="40" width="16" height="24" rx="3" fill="rgba(0,0,0,0.25)" />
            <rect x="16" y="34" width="10" height="10" rx="1" fill="rgba(255,255,255,0.38)" />
            <rect x="46" y="34" width="10" height="10" rx="1" fill="rgba(255,255,255,0.38)" />
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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="flash success">
          <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          {{ session('success') }}
        </div>
        @endif

        <div id="errorAlert">
          <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
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
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
              </div>
              <input type="password" id="password" name="password"
                class="field-input pr"
                placeholder="Enter your password"
                autocomplete="current-password" required>
              <button type="button" class="eye-btn" onclick="togglePassword()">
                <svg id="eyeIcon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
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

    /* ── Loading overlay ── */
    function showLoading() {
      document.getElementById('loadingOverlay').classList.add('active');
    }

    function hideLoading() {
      document.getElementById('loadingOverlay').classList.remove('active');
    }

    /* ── Toast ── */
    function showToast(msg, type = 'success', dur = 3500) {
      const c = document.getElementById('toastContainer');
      const id = 'toast-' + Date.now();
      const paths = {
        success: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        error: 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        info: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
      };
      c.insertAdjacentHTML('beforeend', `
                <div id="${id}" class="toast ${type}">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${paths[type] || paths.info}"/>
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

    /* ── Password toggle ── */
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

    /* ── Inline error ── */
    function showError(msg) {
      const el = document.getElementById('errorAlert');
      document.getElementById('errorMessage').textContent = msg;
      el.classList.add('show');
      setTimeout(() => el.classList.remove('show'), 6000);
    }

    /* ── Form submit ── */
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      if (isSubmitting) return;

      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value;
      const remember = document.getElementById('remember').checked;

      if (!username || !password) {
        showError('Please enter both username and password.');
        return;
      }

      isSubmitting = true;
      const btn = document.getElementById('loginButton');
      document.getElementById('buttonText').textContent = 'Signing in…';
      btn.disabled = true;
      showLoading();

      try {
        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        const res = await fetch('/admin/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            username,
            password,
            remember
          })
        });
        const data = await res.json();

        if (data.success) {
          if (data.user) sessionStorage.setItem('user', JSON.stringify(data.user));
          showToast('Login successful. Redirecting…', 'success');
          setTimeout(() => {
            window.location.href = data.redirect || '/admin/dashboard';
          }, 700);
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
        const msg = !navigator.onLine ?
          'No internet connection.' :
          'Connection error. Please try again.';
        showError(msg);
        showToast(msg, 'error');
        document.getElementById('buttonText').textContent = 'Sign In to Dashboard';
        btn.disabled = false;
        isSubmitting = false;
      }
    });

    /* ── Utility buttons ── */
    function showForgotPassword() {
      showToast('Please contact your system administrator to reset your password.', 'info');
    }

    function showTerms() {
      showToast('Terms of service will be available soon.', 'info');
    }

    function showPrivacy() {
      showToast('Privacy policy will be available soon.', 'info');
    }

    /* ── Auto-redirect if already authenticated ── */
    document.addEventListener('DOMContentLoaded', () => {
      fetch('/admin/check-auth', {
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        })
        .then(r => r.json())
        .then(d => {
          if (d.authenticated) window.location.href = d.redirect || '/admin/dashboard';
        })
        .catch(() => {});
    });

    /* ── Prevent back navigation after login ── */
    window.history.pushState(null, null, window.location.href);
    window.addEventListener('popstate', () => {
      window.history.pushState(null, null, window.location.href);
    });
  </script>
</body>

</html>