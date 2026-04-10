@extends('admin.layout')

@section('content')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0
  }

  .sec-wrap {
    font-family: Arial, sans-serif;
    padding: 24px 20px;
    max-width: 960px;
    margin: 0 auto
  }

  .sec-wrap * {
    font-family: Arial, sans-serif
  }

  :root {
    --s-red: #C0392B;
    --s-red-h: #a93226;
    --s-red-light: #FDECEA;
    --s-white: #fff;
    --s-gray-50: #F9F9F9;
    --s-gray-100: #F1F1F1;
    --s-gray-200: #E0E0E0;
    --s-gray-400: #9E9E9E;
    --s-gray-600: #555;
    --s-gray-800: #222;
    --s-green: #27AE60;
    --s-green-light: #EAFAF1;
    --s-blue: #2980B9;
    --s-blue-light: #EAF4FB;
    --s-amber: #E67E22;
    --s-amber-light: #FEF9EC;
    --s-radius: 8px;
    --s-radius-sm: 5px;
    --s-radius-lg: 12px;
  }

  /* ── Page header ─────────────────────────── */
  .sec-page-header {
    margin-bottom: 24px
  }

  .sec-page-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--s-gray-800);
    display: flex;
    align-items: center;
    gap: 10px
  }

  .sec-page-sub {
    font-size: 13px;
    color: var(--s-gray-400);
    margin-top: 4px
  }

  /* ── Card ────────────────────────────────── */
  .sec-card {
    background: var(--s-white);
    border: 1px solid var(--s-gray-200);
    border-radius: var(--s-radius-lg);
    margin-bottom: 18px;
    overflow: hidden
  }

  .sec-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid var(--s-gray-100);
    flex-wrap: wrap;
    gap: 8px
  }

  .sec-card-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--s-gray-800);
    display: flex;
    align-items: center;
    gap: 8px
  }

  .sec-card-sub {
    font-size: 11px;
    color: var(--s-gray-400);
    margin-top: 2px
  }

  .sec-card-body {
    padding: 20px
  }

  /* ── Buttons ─────────────────────────────── */
  .sec-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 16px;
    border-radius: var(--s-radius);
    font-family: Arial;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    border: 1.5px solid transparent;
    transition: all .15s
  }

  .sec-btn-red {
    background: var(--s-red);
    color: #fff;
    border-color: var(--s-red)
  }

  .sec-btn-red:hover {
    background: var(--s-red-h)
  }

  .sec-btn-outline {
    background: var(--s-white);
    border-color: var(--s-gray-200);
    color: var(--s-gray-600)
  }

  .sec-btn-outline:hover {
    border-color: var(--s-red);
    color: var(--s-red)
  }

  .sec-btn-ghost {
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px 8px;
    border-radius: var(--s-radius-sm);
    color: var(--s-gray-400);
    display: flex;
    align-items: center;
    transition: all .15s
  }

  .sec-btn-ghost:hover {
    color: var(--s-red);
    background: var(--s-red-light)
  }

  .sec-btn-sm {
    padding: 6px 12px;
    font-size: 12px
  }

  .sec-btn:disabled {
    opacity: .5;
    cursor: not-allowed
  }

  /* ── Toggle ──────────────────────────────── */
  .sec-toggle {
    position: relative;
    width: 44px;
    height: 24px;
    flex-shrink: 0
  }

  .sec-toggle input {
    opacity: 0;
    width: 0;
    height: 0;
    position: absolute
  }

  .sec-toggle-slider {
    position: absolute;
    inset: 0;
    background: var(--s-gray-200);
    border-radius: 24px;
    cursor: pointer;
    transition: background .2s
  }

  .sec-toggle-slider::before {
    content: '';
    position: absolute;
    width: 18px;
    height: 18px;
    background: #fff;
    border-radius: 50%;
    top: 3px;
    left: 3px;
    transition: transform .2s;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .2)
  }

  .sec-toggle input:checked+.sec-toggle-slider {
    background: var(--s-red)
  }

  .sec-toggle input:checked+.sec-toggle-slider::before {
    transform: translateX(20px)
  }

  /* ── Settings row ────────────────────────── */
  .sec-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid var(--s-gray-100);
    gap: 12px;
    flex-wrap: wrap
  }

  .sec-row:last-child {
    border-bottom: none;
    padding-bottom: 0
  }

  .sec-row:first-child {
    padding-top: 0
  }

  .sec-row-info {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0
  }

  .sec-row-icon {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0
  }

  .sec-row-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--s-gray-800)
  }

  .sec-row-desc {
    font-size: 11px;
    color: var(--s-gray-400);
    margin-top: 2px
  }

  .sec-row-action {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 8px
  }

  /* ── Select ──────────────────────────────── */
  .sec-select {
    padding: 8px 12px;
    border: 1.5px solid var(--s-gray-200);
    border-radius: var(--s-radius);
    font-family: Arial;
    font-size: 13px;
    color: var(--s-gray-600);
    outline: none;
    background: var(--s-white);
    cursor: pointer;
    transition: border .15s;
    min-width: 220px
  }

  .sec-select:focus {
    border-color: var(--s-red)
  }

  /* ── Input ───────────────────────────────── */
  .sec-input {
    width: 100%;
    padding: 10px 12px;
    border: 1.5px solid var(--s-gray-200);
    border-radius: var(--s-radius);
    font-family: Arial;
    font-size: 13px;
    color: var(--s-gray-800);
    outline: none;
    background: var(--s-white);
    transition: border .2s
  }

  .sec-input:focus {
    border-color: var(--s-red)
  }

  .sec-input.error {
    border-color: var(--s-red)
  }

  .sec-input.success {
    border-color: var(--s-green)
  }

  .sec-input-wrap {
    position: relative
  }

  .sec-input-wrap .sec-eye {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: var(--s-gray-400);
    padding: 4px;
    display: flex;
    align-items: center
  }

  .sec-input-wrap .sec-eye:hover {
    color: var(--s-red)
  }

  /* ── Password strength ───────────────────── */
  .sec-strength-bar {
    display: flex;
    gap: 4px;
    margin-top: 8px
  }

  .sec-strength-seg {
    flex: 1;
    height: 4px;
    border-radius: 4px;
    background: var(--s-gray-200);
    transition: background .3s
  }

  .sec-strength-label {
    font-size: 11px;
    margin-top: 5px;
    font-weight: 700
  }

  /* ── Field ───────────────────────────────── */
  .sec-field {
    margin-bottom: 16px
  }

  .sec-field:last-child {
    margin-bottom: 0
  }

  .sec-field label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: var(--s-gray-600);
    margin-bottom: 6px
  }

  .sec-field-hint {
    font-size: 11px;
    color: var(--s-gray-400);
    margin-top: 5px
  }

  .sec-field-err {
    font-size: 11px;
    color: var(--s-red);
    margin-top: 5px;
    display: none
  }

  .sec-field-err.show {
    display: block
  }

  /* ── Policy badge ────────────────────────── */
  .sec-policy-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700
  }

  .sec-policy-weak {
    background: #FEF9EC;
    color: var(--s-amber)
  }

  .sec-policy-medium {
    background: var(--s-blue-light);
    color: var(--s-blue)
  }

  .sec-policy-strong {
    background: var(--s-green-light);
    color: var(--s-green)
  }

  /* ── Status badge ────────────────────────── */
  .sec-status {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700
  }

  .sec-status-on {
    background: var(--s-green-light);
    color: var(--s-green)
  }

  .sec-status-off {
    background: var(--s-gray-100);
    color: var(--s-gray-600)
  }

  .sec-status-warn {
    background: var(--s-red-light);
    color: var(--s-red)
  }

  /* ── Session table ───────────────────────── */
  .sec-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px
  }

  .sec-table thead tr {
    background: var(--s-gray-50);
    border-bottom: 1.5px solid var(--s-gray-200)
  }

  .sec-table th {
    padding: 10px 12px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    color: var(--s-gray-600);
    letter-spacing: .04em;
    text-transform: uppercase
  }

  .sec-table tbody tr {
    border-bottom: 1px solid var(--s-gray-100);
    transition: background .12s
  }

  .sec-table tbody tr:hover {
    background: var(--s-red-light)
  }

  .sec-table tbody tr:last-child {
    border-bottom: none
  }

  .sec-table td {
    padding: 11px 12px;
    color: var(--s-gray-800);
    vertical-align: middle
  }

  .sec-this-device {
    font-size: 10px;
    font-weight: 700;
    background: var(--s-green-light);
    color: var(--s-green);
    padding: 1px 6px;
    border-radius: 20px;
    margin-left: 5px
  }

  /* ── Divider ─────────────────────────────── */
  .sec-divider {
    border: none;
    border-top: 1px solid var(--s-gray-100);
    margin: 16px 0
  }

  /* ── 2FA steps ───────────────────────────── */
  .sec-steps {
    display: flex;
    gap: 10px;
    margin-bottom: 18px;
    flex-wrap: wrap
  }

  .sec-step {
    flex: 1;
    min-width: 120px;
    text-align: center;
    padding: 14px 10px;
    border: 1.5px solid var(--s-gray-200);
    border-radius: var(--s-radius);
    background: var(--s-gray-50)
  }

  .sec-step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--s-gray-200);
    color: var(--s-gray-600);
    font-size: 12px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px
  }

  .sec-step.done .sec-step-num {
    background: var(--s-red);
    color: #fff
  }

  .sec-step-text {
    font-size: 11px;
    color: var(--s-gray-600);
    font-weight: 600
  }

  /* ── OTP input ───────────────────────────── */
  .sec-otp-row {
    display: flex;
    gap: 8px;
    justify-content: center;
    margin: 18px 0
  }

  .sec-otp-input {
    width: 44px;
    height: 52px;
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    border: 1.5px solid var(--s-gray-200);
    border-radius: var(--s-radius);
    outline: none;
    color: var(--s-gray-800);
    transition: border .15s;
    background: var(--s-white)
  }

  .sec-otp-input:focus {
    border-color: var(--s-red)
  }

  .sec-otp-input.filled {
    border-color: var(--s-red);
    background: var(--s-red-light);
    color: var(--s-red)
  }

  /* ── Overlay / Modal ─────────────────────── */
  .sec-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, .45);
    z-index: 9000;
    align-items: center;
    justify-content: center;
    padding: 16px
  }

  .sec-overlay.open {
    display: flex
  }

  .sec-modal {
    background: var(--s-white);
    border-radius: var(--s-radius-lg);
    width: 100%;
    max-width: 480px;
    max-height: 92vh;
    overflow-y: auto;
    box-shadow: 0 8px 40px rgba(0, 0, 0, .18)
  }

  .sec-modal-sm {
    max-width: 380px
  }

  .sec-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 20px 14px;
    border-bottom: 1px solid var(--s-gray-200);
    position: sticky;
    top: 0;
    background: var(--s-white);
    z-index: 1
  }

  .sec-modal-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--s-gray-800);
    display: flex;
    align-items: center;
    gap: 8px
  }

  .sec-modal-close {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--s-gray-400);
    padding: 4px;
    border-radius: var(--s-radius-sm);
    display: flex;
    transition: all .15s
  }

  .sec-modal-close:hover {
    color: var(--s-red);
    background: var(--s-red-light)
  }

  .sec-modal-body {
    padding: 22px
  }

  .sec-modal-footer {
    padding: 14px 20px;
    border-top: 1px solid var(--s-gray-200);
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    position: sticky;
    bottom: 0;
    background: var(--s-white)
  }

  /* ── Spinner ─────────────────────────────── */
  @keyframes sec-spin {
    to {
      transform: rotate(360deg)
    }
  }

  .sec-spinner {
    width: 18px;
    height: 18px;
    border: 2.5px solid rgba(255, 255, 255, .4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: sec-spin .7s linear infinite;
    flex-shrink: 0
  }

  .sec-spinner-dark {
    border-color: rgba(192, 57, 43, .25);
    border-top-color: var(--s-red)
  }

  /* ── Loading overlay ─────────────────────── */
  .sec-loading-overlay {
    display: none;
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, .8);
    z-index: 10;
    align-items: center;
    justify-content: center;
    border-radius: var(--s-radius-lg)
  }

  .sec-loading-overlay.show {
    display: flex
  }

  /* ── Toast ───────────────────────────────── */
  .sec-toast-wrap {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 10000;
    display: flex;
    flex-direction: column;
    gap: 8px;
    pointer-events: none
  }

  .sec-toast {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    padding: 12px 16px;
    border-radius: var(--s-radius);
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 4px 16px rgba(0, 0, 0, .2);
    opacity: 0;
    transform: translateY(10px);
    transition: all .25s;
    pointer-events: auto;
    min-width: 220px;
    max-width: 340px
  }

  .sec-toast.show {
    opacity: 1;
    transform: translateY(0)
  }

  .sec-toast.success {
    background: var(--s-green)
  }

  .sec-toast.error {
    background: var(--s-red)
  }

  .sec-toast.info {
    background: var(--s-blue)
  }

  .sec-toast.warning {
    background: var(--s-amber)
  }

  .sec-toast-msg {
    flex: 1
  }

  .sec-toast-x {
    background: none;
    border: none;
    cursor: pointer;
    color: rgba(255, 255, 255, .7);
    font-size: 16px;
    line-height: 1
  }

  .sec-toast-x:hover {
    color: #fff
  }

  /* ── QR placeholder ──────────────────────── */
  .sec-qr {
    width: 140px;
    height: 140px;
    border: 2px dashed var(--s-gray-200);
    border-radius: var(--s-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--s-gray-50);
    flex-shrink: 0
  }

  /* ── Password checklist ──────────────────── */
  .sec-checklist {
    list-style: none;
    padding: 0;
    margin-top: 10px
  }

  .sec-checklist li {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    color: var(--s-gray-400);
    padding: 2px 0;
    transition: color .2s
  }

  .sec-checklist li.pass {
    color: var(--s-green)
  }

  .sec-checklist li svg {
    flex-shrink: 0
  }

  /* ── Login history ───────────────────────── */
  .sec-log-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--s-gray-100)
  }

  .sec-log-item:last-child {
    border-bottom: none
  }

  .sec-log-icon {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0
  }

  .sec-log-detail {
    flex: 1;
    min-width: 0
  }

  .sec-log-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--s-gray-800)
  }

  .sec-log-meta {
    font-size: 11px;
    color: var(--s-gray-400);
    margin-top: 2px
  }

  /* ── Grid ────────────────────────────────── */
  .sec-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px
  }

  /* ── Responsive ──────────────────────────── */
  @media(max-width:640px) {
    .sec-wrap {
      padding: 14px 10px
    }

    .sec-grid-2 {
      grid-template-columns: 1fr
    }

    .sec-modal {
      max-width: 100%
    }

    .sec-otp-input {
      width: 38px;
      height: 46px;
      font-size: 18px
    }

    .sec-steps {
      flex-direction: column
    }

    .sec-select {
      min-width: 160px
    }

    .sec-row {
      flex-direction: column;
      align-items: flex-start
    }

    .sec-row-action {
      width: 100%;
      justify-content: flex-end
    }
  }
</style>

<div class="sec-wrap">

  {{-- ── Page Header ─────────────────────────── --}}
  <div class="sec-page-header">
    <div class="sec-page-title">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
      </svg>
      Security Settings
    </div>
    <div class="sec-page-sub">Manage your account security, authentication, and access policies</div>
  </div>

  {{-- ── Security Score ──────────────────────── --}}
  <div class="sec-card" style="margin-bottom:18px">
    <div style="padding:18px 20px;display:flex;align-items:center;gap:18px;flex-wrap:wrap">
      <div style="position:relative;width:72px;height:72px;flex-shrink:0">
        <svg viewBox="0 0 36 36" style="width:72px;height:72px;transform:rotate(-90deg)">
          <circle cx="18" cy="18" r="15.9" fill="none" stroke="var(--s-gray-100)" stroke-width="3" />
          <circle cx="18" cy="18" r="15.9" fill="none" stroke="var(--s-amber)" stroke-width="3"
            stroke-dasharray="65 35" stroke-linecap="round" id="secScoreCircle" />
        </svg>
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:700;color:var(--s-gray-800)" id="secScoreNum">65</div>
      </div>
      <div style="flex:1;min-width:180px">
        <div style="font-size:14px;font-weight:700;color:var(--s-gray-800);margin-bottom:4px">Security Score: <span id="secScoreLabel" style="color:var(--s-amber)">Fair</span></div>
        <div style="font-size:12px;color:var(--s-gray-400);margin-bottom:10px">Enable 2FA and use a strong password to improve your score</div>
        <div style="display:flex;gap:8px;flex-wrap:wrap" id="secScoreItems">
          <span class="sec-status sec-status-on">&#10003; Strong Password</span>
          <span class="sec-status sec-status-warn">&#9679; 2FA Off</span>
          <span class="sec-status sec-status-on">&#10003; Email Verified</span>
          <span class="sec-status sec-status-warn">&#9679; Phone Unlinked</span>
        </div>
      </div>
    </div>
  </div>

  <div class="sec-grid-2">

    {{-- ── Left Column ──────────────────────── --}}
    <div>

      {{-- Password Settings --}}
      <div class="sec-card" style="position:relative">
        <div class="sec-loading-overlay" id="secPwdLoading">
          <div style="display:flex;flex-direction:column;align-items:center;gap:10px">
            <div class="sec-spinner sec-spinner-dark" style="width:28px;height:28px;border-width:3px"></div>
            <span style="font-size:12px;color:var(--s-gray-600)">Saving…</span>
          </div>
        </div>
        <div class="sec-card-header">
          <div>
            <div class="sec-card-title">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              </svg>
              Password Policy
            </div>
            <div class="sec-card-sub">Set the minimum security level for user passwords</div>
          </div>
        </div>
        <div class="sec-card-body">
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">Policy Level</div>
                <div class="sec-row-desc">Applies to all new passwords</div>
              </div>
            </div>
            <div class="sec-row-action">
              <select class="sec-select" id="secPolicySelect" onchange="secUpdatePolicyBadge()">
                <option value="weak">Weak — min 6 chars</option>
                <option value="medium" selected>Medium — 8 chars + numbers</option>
                <option value="strong">Strong — 12 chars + symbols</option>
              </select>
            </div>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">Current Policy</div>
              </div>
            </div>
            <span class="sec-policy-badge sec-policy-medium" id="secPolicyBadge">&#9679; Medium</span>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">Password Expiry</div>
                <div class="sec-row-desc">Force password reset after period</div>
              </div>
            </div>
            <select class="sec-select" id="secExpiry">
              <option value="never">Never</option>
              <option value="30">30 days</option>
              <option value="60">60 days</option>
              <option value="90" selected>90 days</option>
              <option value="180">180 days</option>
            </select>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">Prevent Password Reuse</div>
                <div class="sec-row-desc">Block last 5 passwords</div>
              </div>
            </div>
            <label class="sec-toggle">
              <input type="checkbox" id="secNoReuse" checked>
              <span class="sec-toggle-slider"></span>
            </label>
          </div>
          <div style="margin-top:16px;display:flex;gap:8px;justify-content:flex-end">
            <button class="sec-btn sec-btn-outline sec-btn-sm" onclick="secOpenChangePwd()">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
              </svg>
              Change My Password
            </button>
            <button class="sec-btn sec-btn-red sec-btn-sm" onclick="secSavePolicy()">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                <polyline points="17 21 17 13 7 13 7 21" />
              </svg>
              Save Policy
            </button>
          </div>
        </div>
      </div>

      {{-- Account Lock Policy --}}
      <div class="sec-card">
        <div class="sec-card-header">
          <div>
            <div class="sec-card-title">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
              </svg>
              Account Lock Policy
            </div>
            <div class="sec-card-sub">Protect against brute-force login attempts</div>
          </div>
        </div>
        <div class="sec-card-body">
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">Lock After Failed Attempts</div>
                <div class="sec-row-desc">Number of failed logins before lockout</div>
              </div>
            </div>
            <select class="sec-select" id="secLockAttempts" style="min-width:120px">
              <option>3</option>
              <option selected>5</option>
              <option>10</option>
              <option>Never</option>
            </select>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">Lock Duration</div>
                <div class="sec-row-desc">How long account stays locked</div>
              </div>
            </div>
            <select class="sec-select" id="secLockDuration" style="min-width:120px">
              <option>5 min</option>
              <option selected>15 min</option>
              <option>30 min</option>
              <option>1 hour</option>
              <option>Permanent</option>
            </select>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">CAPTCHA on Login</div>
                <div class="sec-row-desc">Show CAPTCHA after 3 failed attempts</div>
              </div>
            </div>
            <label class="sec-toggle">
              <input type="checkbox" id="secCaptcha" checked>
              <span class="sec-toggle-slider"></span>
            </label>
          </div>
          <div style="margin-top:16px;display:flex;justify-content:flex-end">
            <button class="sec-btn sec-btn-red sec-btn-sm" onclick="secSaveLock()">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                <polyline points="17 21 17 13 7 13 7 21" />
              </svg>
              Save
            </button>
          </div>
        </div>
      </div>

    </div>{{-- end left --}}

    {{-- ── Right Column ─────────────────────── --}}
    <div>

      {{-- Two-Factor Authentication --}}
      <div class="sec-card">
        <div class="sec-card-header">
          <div>
            <div class="sec-card-title">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
                <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
                <line x1="12" y1="18" x2="12.01" y2="18" />
              </svg>
              Two-Factor Authentication
            </div>
            <div class="sec-card-sub">Add an extra layer of security to your account</div>
          </div>
          <span class="sec-status sec-status-off" id="sec2FAStatus">&#9679; Disabled</span>
        </div>
        <div class="sec-card-body">
          <div class="sec-row">
            <div class="sec-row-info">
              <div class="sec-row-icon" style="background:var(--s-red-light)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
                  <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
                  <line x1="12" y1="18" x2="12.01" y2="18" />
                </svg>
              </div>
              <div>
                <div class="sec-row-label">Enable 2FA</div>
                <div class="sec-row-desc">SMS or Authenticator App</div>
              </div>
            </div>
            <label class="sec-toggle">
              <input type="checkbox" id="sec2FAToggle" onchange="secHandle2FA(this)">
              <span class="sec-toggle-slider"></span>
            </label>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div class="sec-row-icon" style="background:var(--s-blue-light)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--s-blue)" stroke-width="2">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.49 2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l1.06-.97a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
              </div>
              <div>
                <div class="sec-row-label">Phone Number</div>
                <div class="sec-row-desc" id="secPhoneDisplay">Not linked</div>
              </div>
            </div>
            <button class="sec-btn sec-btn-outline sec-btn-sm" onclick="secOpenPhoneModal()">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
              </svg>
              Link Phone
            </button>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div class="sec-row-icon" style="background:var(--s-green-light)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--s-green)" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                  <line x1="9" y1="9" x2="15" y2="15" />
                  <line x1="15" y1="9" x2="9" y2="15" />
                </svg>
              </div>
              <div>
                <div class="sec-row-label">Authenticator App</div>
                <div class="sec-row-desc">Google/Microsoft Authenticator</div>
              </div>
            </div>
            <button class="sec-btn sec-btn-outline sec-btn-sm" onclick="secOpenAuthApp()">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="16 16 12 12 8 16" />
                <line x1="12" y1="12" x2="12" y2="21" />
                <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29" />
              </svg>
              Setup
            </button>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div class="sec-row-icon" style="background:var(--s-amber-light)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--s-amber)" stroke-width="2">
                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                </svg>
              </div>
              <div>
                <div class="sec-row-label">Backup Codes</div>
                <div class="sec-row-desc">Emergency access codes</div>
              </div>
            </div>
            <button class="sec-btn sec-btn-outline sec-btn-sm" onclick="secViewBackupCodes()">View Codes</button>
          </div>
        </div>
      </div>

      {{-- Session Security --}}
      <div class="sec-card">
        <div class="sec-card-header">
          <div>
            <div class="sec-card-title">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                <line x1="8" y1="21" x2="16" y2="21" />
                <line x1="12" y1="17" x2="12" y2="21" />
              </svg>
              Session Security
            </div>
            <div class="sec-card-sub">Manage active sessions and timeouts</div>
          </div>
        </div>
        <div class="sec-card-body">
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">Session Timeout</div>
                <div class="sec-row-desc">Auto logout after inactivity</div>
              </div>
            </div>
            <select class="sec-select" style="min-width:120px">
              <option>15 min</option>
              <option selected>30 min</option>
              <option>1 hour</option>
              <option>4 hours</option>
              <option>Never</option>
            </select>
          </div>
          <div class="sec-row">
            <div class="sec-row-info">
              <div>
                <div class="sec-row-label">Single Device Login</div>
                <div class="sec-row-desc">Logout other devices on new login</div>
              </div>
            </div>
            <label class="sec-toggle">
              <input type="checkbox" id="secSingleDevice">
              <span class="sec-toggle-slider"></span>
            </label>
          </div>
          <div style="margin-top:14px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
            <span style="font-size:12px;color:var(--s-gray-600)">3 active sessions</span>
            <div style="display:flex;gap:6px">
              <button class="sec-btn sec-btn-outline sec-btn-sm" onclick="secOpenSessions()">Manage Sessions</button>
              <button class="sec-btn sec-btn-sm" style="background:var(--s-red-light);color:var(--s-red);border:none" onclick="secRevokeAll()">Revoke All</button>
            </div>
          </div>
        </div>
      </div>

    </div>{{-- end right --}}

  </div>{{-- end grid --}}

  {{-- ── Login History ────────────────────────── --}}
  <div class="sec-card">
    <div class="sec-card-header">
      <div>
        <div class="sec-card-title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
          </svg>
          Recent Login Activity
        </div>
        <div class="sec-card-sub">Last 5 login events on your account</div>
      </div>
      <button class="sec-btn sec-btn-outline sec-btn-sm" onclick="secOpenFullHistory()">View Full History</button>
    </div>
    <div class="sec-card-body" style="padding-top:8px">
      <div id="secLoginLog">
        <div class="sec-log-item">
          <div class="sec-log-icon" style="background:var(--s-green-light)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-green)" stroke-width="2">
              <polyline points="20 6 9 17 4 12" />
            </svg>
          </div>
          <div class="sec-log-detail">
            <div class="sec-log-label">Successful login <span class="sec-this-device">This device</span></div>
            <div class="sec-log-meta">Chrome 123 · Windows 11 · 192.168.1.1 · Today 08:12 AM</div>
          </div>
        </div>
        <div class="sec-log-item">
          <div class="sec-log-icon" style="background:var(--s-green-light)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-green)" stroke-width="2">
              <polyline points="20 6 9 17 4 12" />
            </svg>
          </div>
          <div class="sec-log-detail">
            <div class="sec-log-label">Successful login</div>
            <div class="sec-log-meta">Safari 17 · iPhone iOS 17 · 112.204.x.x · Yesterday 06:45 PM</div>
          </div>
        </div>
        <div class="sec-log-item">
          <div class="sec-log-icon" style="background:var(--s-red-light)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18" />
              <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
          </div>
          <div class="sec-log-detail">
            <div class="sec-log-label" style="color:var(--s-red)">Failed login attempt</div>
            <div class="sec-log-meta">Unknown · 45.76.xxx.xxx · Apr 8 · 11:22 PM</div>
          </div>
        </div>
        <div class="sec-log-item">
          <div class="sec-log-icon" style="background:var(--s-green-light)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-green)" stroke-width="2">
              <polyline points="20 6 9 17 4 12" />
            </svg>
          </div>
          <div class="sec-log-detail">
            <div class="sec-log-label">Successful login</div>
            <div class="sec-log-meta">Firefox 124 · Windows 11 · 192.168.1.1 · Apr 8 · 09:00 AM</div>
          </div>
        </div>
        <div class="sec-log-item">
          <div class="sec-log-icon" style="background:var(--s-amber-light)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-amber)" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
          </div>
          <div class="sec-log-detail">
            <div class="sec-log-label">Password changed</div>
            <div class="sec-log-meta">Chrome 123 · Windows 11 · 192.168.1.1 · Apr 7 · 03:15 PM</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ── Active Sessions ──────────────────────── --}}
  <div class="sec-card" id="secSessionsCard" style="display:none">
    <div class="sec-card-header">
      <div class="sec-card-title">Active Sessions</div>
      <button class="sec-btn-ghost" onclick="document.getElementById('secSessionsCard').style.display='none'">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div style="overflow-x:auto">
      <table class="sec-table">
        <thead>
          <tr>
            <th>Device</th>
            <th>Browser</th>
            <th>IP</th>
            <th>Last Active</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Windows 11 <span class="sec-this-device">Current</span></td>
            <td>Chrome 123</td>
            <td>192.168.1.1</td>
            <td>Now</td>
            <td><button class="sec-btn sec-btn-outline sec-btn-sm" disabled>Active</button></td>
          </tr>
          <tr>
            <td>iPhone iOS 17</td>
            <td>Safari 17</td>
            <td>112.204.x.x</td>
            <td>1h ago</td>
            <td><button class="sec-btn sec-btn-sm" style="background:var(--s-red-light);color:var(--s-red);border:none" onclick="secRevokeSession(this,'iPhone iOS 17')">Revoke</button></td>
          </tr>
          <tr>
            <td>Windows 11</td>
            <td>Firefox 124</td>
            <td>192.168.1.1</td>
            <td>3h ago</td>
            <td><button class="sec-btn sec-btn-sm" style="background:var(--s-red-light);color:var(--s-red);border:none" onclick="secRevokeSession(this,'Firefox 124')">Revoke</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>{{-- end .sec-wrap --}}


{{-- ════════════════════════════════════ --}}
{{-- CHANGE PASSWORD MODAL               --}}
{{-- ════════════════════════════════════ --}}
<div class="sec-overlay" id="secPwdOverlay">
  <div class="sec-modal" role="dialog" aria-modal="true">
    <div class="sec-modal-header">
      <span class="sec-modal-title">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
          <path d="M7 11V7a5 5 0 0 1 10 0v4" />
        </svg>
        Change Password
      </span>
      <button class="sec-modal-close" onclick="secCloseModal('secPwdOverlay')">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="sec-modal-body">
      <div class="sec-field">
        <label>Current Password</label>
        <div class="sec-input-wrap">
          <input type="password" class="sec-input" id="secCurPwd" placeholder="Enter current password">
          <button class="sec-eye" onclick="secTogglePwd('secCurPwd',this)" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
              <circle cx="12" cy="12" r="3" />
            </svg>
          </button>
        </div>
      </div>
      <div class="sec-field">
        <label>New Password</label>
        <div class="sec-input-wrap">
          <input type="password" class="sec-input" id="secNewPwd" placeholder="Enter new password" oninput="secCheckStrength(this.value)">
          <button class="sec-eye" onclick="secTogglePwd('secNewPwd',this)" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
              <circle cx="12" cy="12" r="3" />
            </svg>
          </button>
        </div>
        <div class="sec-strength-bar" id="secStrengthBar">
          <div class="sec-strength-seg" id="secSeg1"></div>
          <div class="sec-strength-seg" id="secSeg2"></div>
          <div class="sec-strength-seg" id="secSeg3"></div>
          <div class="sec-strength-seg" id="secSeg4"></div>
        </div>
        <div class="sec-strength-label" id="secStrengthLabel" style="color:var(--s-gray-400)">Type to check strength</div>
        <ul class="sec-checklist" id="secChecklist">
          <li id="chk-len">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <circle cx="12" cy="12" r="10" />
            </svg>
            At least 8 characters
          </li>
          <li id="chk-upper">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <circle cx="12" cy="12" r="10" />
            </svg>
            One uppercase letter
          </li>
          <li id="chk-num">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <circle cx="12" cy="12" r="10" />
            </svg>
            One number
          </li>
          <li id="chk-sym">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <circle cx="12" cy="12" r="10" />
            </svg>
            One special character (!@#$…)
          </li>
        </ul>
      </div>
      <div class="sec-field">
        <label>Confirm New Password</label>
        <div class="sec-input-wrap">
          <input type="password" class="sec-input" id="secConfPwd" placeholder="Repeat new password" oninput="secCheckMatch()">
          <button class="sec-eye" onclick="secTogglePwd('secConfPwd',this)" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
              <circle cx="12" cy="12" r="3" />
            </svg>
          </button>
        </div>
        <div class="sec-field-err" id="secPwdMatchErr">Passwords do not match</div>
      </div>
    </div>
    <div class="sec-modal-footer">
      <button class="sec-btn sec-btn-outline" onclick="secCloseModal('secPwdOverlay')">Cancel</button>
      <button class="sec-btn sec-btn-red" onclick="secSubmitPwdChange()" id="secPwdSubmitBtn">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="9 11 12 14 22 4" />
          <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
        </svg>
        Continue
      </button>
    </div>
  </div>
</div>


{{-- ════════════════════════════════════ --}}
{{-- OTP VERIFICATION MODAL              --}}
{{-- ════════════════════════════════════ --}}
<div class="sec-overlay" id="secOtpOverlay">
  <div class="sec-modal sec-modal-sm" role="dialog" aria-modal="true">
    <div class="sec-modal-header">
      <span class="sec-modal-title">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
          <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
          <line x1="12" y1="18" x2="12.01" y2="18" />
        </svg>
        Verify Your Identity
      </span>
      <button class="sec-modal-close" onclick="secCloseModal('secOtpOverlay')">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="sec-modal-body" style="text-align:center">
      <div style="width:56px;height:56px;background:var(--s-red-light);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
          <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
          <line x1="12" y1="18" x2="12.01" y2="18" />
        </svg>
      </div>
      <div style="font-size:15px;font-weight:700;color:var(--s-gray-800);margin-bottom:6px">Enter OTP Code</div>
      <div style="font-size:13px;color:var(--s-gray-400);margin-bottom:4px">
        A 6-digit code was sent to <strong id="secOtpDest">+63 9XX XXX XXXX</strong>
      </div>
      <div style="font-size:12px;color:var(--s-gray-400);margin-bottom:2px">Code expires in: <strong id="secOtpTimer" style="color:var(--s-red)">05:00</strong></div>
      <div class="sec-otp-row">
        <input class="sec-otp-input" type="text" maxlength="1" id="otp0" oninput="secOtpInput(0,this)" onkeydown="secOtpKey(0,event)">
        <input class="sec-otp-input" type="text" maxlength="1" id="otp1" oninput="secOtpInput(1,this)" onkeydown="secOtpKey(1,event)">
        <input class="sec-otp-input" type="text" maxlength="1" id="otp2" oninput="secOtpInput(2,this)" onkeydown="secOtpKey(2,event)">
        <input class="sec-otp-input" type="text" maxlength="1" id="otp3" oninput="secOtpInput(3,this)" onkeydown="secOtpKey(3,event)">
        <input class="sec-otp-input" type="text" maxlength="1" id="otp4" oninput="secOtpInput(4,this)" onkeydown="secOtpKey(4,event)">
        <input class="sec-otp-input" type="text" maxlength="1" id="otp5" oninput="secOtpInput(5,this)" onkeydown="secOtpKey(5,event)">
      </div>
      <div class="sec-field-err" id="secOtpErr" style="text-align:center;margin-bottom:8px">Invalid OTP. Please try again.</div>
      <div style="font-size:12px;color:var(--s-gray-400)">
        Didn't receive a code?
        <button class="sec-btn-ghost" id="secResendBtn" style="font-size:12px;font-weight:700;color:var(--s-red);padding:0 4px;display:inline-flex" onclick="secResendOtp()">Resend</button>
      </div>
    </div>
    <div class="sec-modal-footer" style="justify-content:center">
      <button class="sec-btn sec-btn-outline" onclick="secCloseModal('secOtpOverlay')">Cancel</button>
      <button class="sec-btn sec-btn-red" id="secOtpVerifyBtn" onclick="secVerifyOtp()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="20 6 9 17 4 12" />
        </svg>
        Verify
      </button>
    </div>
  </div>
</div>


{{-- ════════════════════════════════════ --}}
{{-- LINK PHONE MODAL                    --}}
{{-- ════════════════════════════════════ --}}
<div class="sec-overlay" id="secPhoneOverlay">
  <div class="sec-modal sec-modal-sm" role="dialog" aria-modal="true">
    <div class="sec-modal-header">
      <span class="sec-modal-title">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.49 2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l1.06-.97a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
        </svg>
        Link Phone Number
      </span>
      <button class="sec-modal-close" onclick="secCloseModal('secPhoneOverlay')">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="sec-modal-body">
      <div class="sec-field">
        <label>Mobile Number</label>
        <input type="tel" class="sec-input" id="secPhoneInput" placeholder="+63 9XX XXX XXXX">
        <div class="sec-field-hint">Include country code. An OTP will be sent to verify.</div>
      </div>
    </div>
    <div class="sec-modal-footer">
      <button class="sec-btn sec-btn-outline" onclick="secCloseModal('secPhoneOverlay')">Cancel</button>
      <button class="sec-btn sec-btn-red" onclick="secSendPhoneOtp()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="22" y1="2" x2="11" y2="13" />
          <polygon points="22 2 15 22 11 13 2 9 22 2" />
        </svg>
        Send OTP
      </button>
    </div>
  </div>
</div>


{{-- ════════════════════════════════════ --}}
{{-- AUTHENTICATOR APP MODAL             --}}
{{-- ════════════════════════════════════ --}}
<div class="sec-overlay" id="secAuthAppOverlay">
  <div class="sec-modal" role="dialog" aria-modal="true">
    <div class="sec-modal-header">
      <span class="sec-modal-title">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
          <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
          <line x1="9" y1="9" x2="15" y2="15" />
          <line x1="15" y1="9" x2="9" y2="15" />
        </svg>
        Setup Authenticator App
      </span>
      <button class="sec-modal-close" onclick="secCloseModal('secAuthAppOverlay')">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="sec-modal-body">
      <div class="sec-steps">
        <div class="sec-step done">
          <div class="sec-step-num">1</div>
          <div class="sec-step-text">Install App</div>
        </div>
        <div class="sec-step" id="secAuthStep2">
          <div class="sec-step-num">2</div>
          <div class="sec-step-text">Scan QR</div>
        </div>
        <div class="sec-step" id="secAuthStep3">
          <div class="sec-step-num">3</div>
          <div class="sec-step-text">Verify Code</div>
        </div>
      </div>
      <div id="secAuthContent">
        <p style="font-size:13px;color:var(--s-gray-600);margin-bottom:14px">Install <strong>Google Authenticator</strong> or <strong>Microsoft Authenticator</strong> on your phone, then scan the QR code below.</p>
        <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
          <div class="sec-qr">
            <svg width="60" height="60" viewBox="0 0 100 100" fill="var(--s-gray-400)">
              <rect x="10" y="10" width="30" height="30" rx="3" fill="none" stroke="currentColor" stroke-width="6" />
              <rect x="18" y="18" width="14" height="14" rx="1" />
              <rect x="60" y="10" width="30" height="30" rx="3" fill="none" stroke="currentColor" stroke-width="6" />
              <rect x="68" y="18" width="14" height="14" rx="1" />
              <rect x="10" y="60" width="30" height="30" rx="3" fill="none" stroke="currentColor" stroke-width="6" />
              <rect x="18" y="68" width="14" height="14" rx="1" />
              <rect x="60" y="60" width="8" height="8" />
              <rect x="72" y="60" width="8" height="8" />
              <rect x="84" y="60" width="8" height="8" />
              <rect x="60" y="72" width="8" height="8" />
              <rect x="72" y="72" width="8" height="8" />
              <rect x="84" y="84" width="8" height="8" />
            </svg>
          </div>
          <div style="flex:1;min-width:160px">
            <div style="font-size:12px;font-weight:700;color:var(--s-gray-600);margin-bottom:4px">Or enter this code manually:</div>
            <div style="font-family:monospace;font-size:13px;font-weight:700;color:var(--s-gray-800);background:var(--s-gray-50);padding:8px 10px;border-radius:var(--s-radius);letter-spacing:.1em;border:1px solid var(--s-gray-200)">JBSW YYTC MFRA</div>
            <div style="font-size:11px;color:var(--s-gray-400);margin-top:6px">Account: admin@antisquatting.ph</div>
          </div>
        </div>
        <div class="sec-field" style="margin-top:20px">
          <label>Enter the 6-digit code from your app</label>
          <div class="sec-otp-row" style="justify-content:flex-start">
            <input class="sec-otp-input" type="text" maxlength="1" id="atp0" oninput="secOtpInput2(0,this)" onkeydown="secOtpKey2(0,event)">
            <input class="sec-otp-input" type="text" maxlength="1" id="atp1" oninput="secOtpInput2(1,this)" onkeydown="secOtpKey2(1,event)">
            <input class="sec-otp-input" type="text" maxlength="1" id="atp2" oninput="secOtpInput2(2,this)" onkeydown="secOtpKey2(2,event)">
            <input class="sec-otp-input" type="text" maxlength="1" id="atp3" oninput="secOtpInput2(3,this)" onkeydown="secOtpKey2(3,event)">
            <input class="sec-otp-input" type="text" maxlength="1" id="atp4" oninput="secOtpInput2(4,this)" onkeydown="secOtpKey2(4,event)">
            <input class="sec-otp-input" type="text" maxlength="1" id="atp5" oninput="secOtpInput2(5,this)" onkeydown="secOtpKey2(5,event)">
          </div>
        </div>
      </div>
    </div>
    <div class="sec-modal-footer">
      <button class="sec-btn sec-btn-outline" onclick="secCloseModal('secAuthAppOverlay')">Cancel</button>
      <button class="sec-btn sec-btn-red" onclick="secConfirmAuthApp()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="20 6 9 17 4 12" />
        </svg>
        Confirm Setup
      </button>
    </div>
  </div>
</div>


{{-- ════════════════════════════════════ --}}
{{-- BACKUP CODES MODAL                  --}}
{{-- ════════════════════════════════════ --}}
<div class="sec-overlay" id="secBackupOverlay">
  <div class="sec-modal sec-modal-sm" role="dialog" aria-modal="true">
    <div class="sec-modal-header">
      <span class="sec-modal-title">Backup Codes</span>
      <button class="sec-modal-close" onclick="secCloseModal('secBackupOverlay')">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="sec-modal-body">
      <div style="background:var(--s-amber-light);border:1px solid var(--s-amber);border-radius:var(--s-radius);padding:10px 12px;margin-bottom:16px;font-size:12px;color:var(--s-amber);display:flex;gap:8px">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
          <line x1="12" y1="9" x2="12" y2="13" />
          <line x1="12" y1="17" x2="12.01" y2="17" />
        </svg>
        <span>Store these codes safely. Each code can only be used once. Regenerating codes will invalidate all existing ones.</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px" id="secBackupCodesGrid">
        <div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">ABCD-1234</div>
        <div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">EFGH-5678</div>
        <div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">IJKL-9012</div>
        <div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">MNOP-3456</div>
        <div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">QRST-7890</div>
        <div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">UVWX-1357</div>
        <div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">YZAB-2468</div>
        <div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">CDEX-9753</div>
      </div>
    </div>
    <div class="sec-modal-footer">
      <button class="sec-btn sec-btn-outline" onclick="secCloseModal('secBackupOverlay')">Close</button>
      <button class="sec-btn sec-btn-outline" onclick="secCopyCodes()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="9" y="9" width="13" height="13" rx="2" ry="2" />
          <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
        </svg>
        Copy All
      </button>
      <button class="sec-btn sec-btn-red" onclick="secRegenCodes()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="1 4 1 10 7 10" />
          <path d="M3.51 15a9 9 0 1 0 .49-3.51" />
        </svg>
        Regenerate
      </button>
    </div>
  </div>
</div>


{{-- ════════════════════════════════════ --}}
{{-- REVOKE ALL CONFIRM MODAL            --}}
{{-- ════════════════════════════════════ --}}
<div class="sec-overlay" id="secRevokeOverlay">
  <div class="sec-modal sec-modal-sm" role="dialog" aria-modal="true">
    <div class="sec-modal-body" style="text-align:center;padding:28px 24px">
      <div style="width:52px;height:52px;border-radius:50%;background:var(--s-red-light);display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--s-red)" stroke-width="2">
          <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
          <line x1="8" y1="21" x2="16" y2="21" />
          <line x1="12" y1="17" x2="12" y2="21" />
          <line x1="3" y1="8" x2="21" y2="8" />
        </svg>
      </div>
      <div style="font-size:15px;font-weight:700;color:var(--s-gray-800);margin-bottom:8px">Revoke All Sessions?</div>
      <div style="font-size:13px;color:var(--s-gray-600);line-height:1.5">You will be logged out from all other devices. You'll need to log in again on those devices.</div>
    </div>
    <div class="sec-modal-footer" style="justify-content:center;gap:10px">
      <button class="sec-btn sec-btn-outline" onclick="secCloseModal('secRevokeOverlay')">Cancel</button>
      <button class="sec-btn sec-btn-red" onclick="secConfirmRevokeAll()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="20 6 9 17 4 12" />
        </svg>
        Yes, Revoke All
      </button>
    </div>
  </div>
</div>


{{-- ════════════════════════════════════ --}}
{{-- TOAST CONTAINER                     --}}
{{-- ════════════════════════════════════ --}}
<div class="sec-toast-wrap" id="secToastWrap"></div>


<script>
  /* ═══════════════════════════════════════════════
   MODAL HELPERS
═══════════════════════════════════════════════ */
  function secOpenModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function secCloseModal(id) {
    document.getElementById(id).classList.remove('open');
    if (!document.querySelector('.sec-overlay.open')) document.body.style.overflow = '';
  }
  document.querySelectorAll('.sec-overlay').forEach(o => {
    o.addEventListener('click', function(e) {
      if (e.target === this) secCloseModal(this.id);
    });
  });
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
      const o = document.querySelector('.sec-overlay.open');
      if (o) secCloseModal(o.id);
    }
  });

  /* ═══════════════════════════════════════════════
     TOAST
  ═══════════════════════════════════════════════ */
  function secToast(msg, type = 'info') {
    const wrap = document.getElementById('secToastWrap');
    const t = document.createElement('div');
    t.className = `sec-toast ${type}`;
    const icons = {
      success: '<polyline points="20 6 9 17 4 12"/>',
      error: '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
      warning: '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
      info: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>'
    };
    t.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0">${icons[type]||icons.info}</svg><span class="sec-toast-msg">${msg}</span><button class="sec-toast-x" onclick="this.parentElement.remove()">&#10005;</button>`;
    wrap.appendChild(t);
    requestAnimationFrame(() => requestAnimationFrame(() => t.classList.add('show')));
    setTimeout(() => {
      t.classList.remove('show');
      setTimeout(() => t.remove(), 300);
    }, 3500);
  }

  /* ═══════════════════════════════════════════════
     LOADING SPINNER (card overlay)
  ═══════════════════════════════════════════════ */
  function secShowLoading(id) {
    document.getElementById(id).classList.add('show');
  }

  function secHideLoading(id) {
    document.getElementById(id).classList.remove('show');
  }

  /* ═══════════════════════════════════════════════
     BUTTON LOADING STATE
  ═══════════════════════════════════════════════ */
  function secBtnLoading(btn, loading) {
    if (loading) {
      btn._orig = btn.innerHTML;
      btn.disabled = true;
      btn.innerHTML = `<div class="sec-spinner"></div> Processing…`;
    } else {
      btn.innerHTML = btn._orig || btn.innerHTML;
      btn.disabled = false;
    }
  }

  /* ═══════════════════════════════════════════════
     PASSWORD TOGGLE
  ═══════════════════════════════════════════════ */
  function secTogglePwd(id, btn) {
    const inp = document.getElementById(id);
    const show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    btn.innerHTML = show ?
      `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>` :
      `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
  }

  /* ═══════════════════════════════════════════════
     PASSWORD STRENGTH
  ═══════════════════════════════════════════════ */
  function secCheckStrength(val) {
    const rules = [val.length >= 8, /[A-Z]/.test(val), /[0-9]/.test(val), /[^A-Za-z0-9]/.test(val)];
    const score = rules.filter(Boolean).length;
    const colors = ['', '#E74C3C', '#E67E22', '#2980B9', '#27AE60'];
    const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
    for (let i = 1; i <= 4; i++) document.getElementById('secSeg' + i).style.background = i <= score ? colors[score] : 'var(--s-gray-200)';
    const lbl = document.getElementById('secStrengthLabel');
    lbl.textContent = score ? labels[score] : 'Type to check strength';
    lbl.style.color = score ? colors[score] : 'var(--s-gray-400)';
    const ids = ['chk-len', 'chk-upper', 'chk-num', 'chk-sym'];
    rules.forEach((pass, i) => {
      const el = document.getElementById(ids[i]);
      el.className = pass ? 'pass' : '';
      el.querySelector('svg').innerHTML = pass ?
        '<polyline points="20 6 9 17 4 12" stroke="var(--s-green)" stroke-width="2.5"/>' :
        '<circle cx="12" cy="12" r="10"/>';
    });
  }

  function secCheckMatch() {
    const np = document.getElementById('secNewPwd').value;
    const cp = document.getElementById('secConfPwd').value;
    const err = document.getElementById('secPwdMatchErr');
    if (cp && np !== cp) err.classList.add('show');
    else err.classList.remove('show');
  }

  /* ═══════════════════════════════════════════════
     OTP INPUTS (password change OTP)
  ═══════════════════════════════════════════════ */
  function secOtpInput(i, el) {
    el.value = el.value.replace(/\D/g, '');
    el.classList.toggle('filled', el.value !== '');
    if (el.value && i < 5) document.getElementById('otp' + (i + 1)).focus();
  }

  function secOtpKey(i, e) {
    if (e.key === 'Backspace' && !document.getElementById('otp' + i).value && i > 0) document.getElementById('otp' + (i - 1)).focus();
  }

  function secGetOtp(prefix) {
    return Array.from({
      length: 6
    }, (_, i) => document.getElementById(prefix + i).value).join('');
  }

  /* Authenticator app OTP */
  function secOtpInput2(i, el) {
    el.value = el.value.replace(/\D/g, '');
    el.classList.toggle('filled', el.value !== '');
    if (el.value && i < 5) document.getElementById('atp' + (i + 1)).focus();
  }

  function secOtpKey2(i, e) {
    if (e.key === 'Backspace' && !document.getElementById('atp' + i).value && i > 0) document.getElementById('atp' + (i - 1)).focus();
  }

  /* ═══════════════════════════════════════════════
     OTP TIMER
  ═══════════════════════════════════════════════ */
  let secOtpTimerInt = null;

  function secStartOtpTimer() {
    let secs = 300;
    clearInterval(secOtpTimerInt);
    const el = document.getElementById('secOtpTimer');
    secOtpTimerInt = setInterval(() => {
      secs--;
      const m = String(Math.floor(secs / 60)).padStart(2, '0');
      const s = String(secs % 60).padStart(2, '0');
      if (el) el.textContent = `${m}:${s}`;
      if (secs <= 0) {
        clearInterval(secOtpTimerInt);
        if (el) el.style.color = 'var(--s-gray-400)';
      }
    }, 1000);
  }

  /* ═══════════════════════════════════════════════
     PASSWORD CHANGE FLOW
  ═══════════════════════════════════════════════ */
  function secOpenChangePwd() {
    document.getElementById('secCurPwd').value = '';
    document.getElementById('secNewPwd').value = '';
    document.getElementById('secConfPwd').value = '';
    document.getElementById('secPwdMatchErr').classList.remove('show');
    secOpenModal('secPwdOverlay');
  }

  function secSubmitPwdChange() {
    const cur = document.getElementById('secCurPwd').value.trim();
    const np = document.getElementById('secNewPwd').value;
    const cp = document.getElementById('secConfPwd').value;
    if (!cur) {
      secToast('Enter your current password', 'warning');
      return;
    }
    if (np.length < 8) {
      secToast('New password is too short', 'warning');
      return;
    }
    if (np !== cp) {
      document.getElementById('secPwdMatchErr').classList.add('show');
      return;
    }
    const btn = document.getElementById('secPwdSubmitBtn');
    secBtnLoading(btn, true);
    // Simulate API call
    setTimeout(() => {
      secBtnLoading(btn, false);
      secCloseModal('secPwdOverlay');
      // Show OTP modal
      document.getElementById('secOtpDest').textContent = '+63 9XX XXX XXXX';
      document.getElementById('secOtpErr').classList.remove('show');
      for (let i = 0; i < 6; i++) {
        const el = document.getElementById('otp' + i);
        el.value = '';
        el.classList.remove('filled');
      }
      secOpenModal('secOtpOverlay');
      secStartOtpTimer();
      secOtpContext = 'password_change';
    }, 1200);
  }

  /* ═══════════════════════════════════════════════
     OTP VERIFY
  ═══════════════════════════════════════════════ */
  let secOtpContext = 'password_change';

  function secVerifyOtp() {
    const code = secGetOtp('otp');
    if (code.length < 6) {
      secToast('Enter the complete 6-digit code', 'warning');
      return;
    }
    const btn = document.getElementById('secOtpVerifyBtn');
    secBtnLoading(btn, true);
    setTimeout(() => {
      secBtnLoading(btn, false);
      // Demo: accept any 6-digit code
      if (code === '000000') {
        document.getElementById('secOtpErr').classList.add('show');
      } else {
        clearInterval(secOtpTimerInt);
        secCloseModal('secOtpOverlay');
        if (secOtpContext === 'password_change') secToast('Password changed successfully!', 'success');
        else if (secOtpContext === 'phone_link') {
          secToast('Phone number linked successfully!', 'success');
          document.getElementById('secPhoneDisplay').textContent = document.getElementById('secPhoneInput').value || '+63 9XX XXX XXXX';
        } else if (secOtpContext === '2fa_enable') {
          secToast('Two-factor authentication enabled!', 'success');
          secUpdate2FAStatus(true);
        }
      }
    }, 1000);
  }

  function secResendOtp() {
    const btn = document.getElementById('secResendBtn');
    btn.disabled = true;
    btn.textContent = 'Sending…';
    setTimeout(() => {
      btn.disabled = false;
      btn.textContent = 'Resend';
      secStartOtpTimer();
      secToast('A new code has been sent', 'info');
    }, 1500);
  }

  /* ═══════════════════════════════════════════════
     PHONE LINK
  ═══════════════════════════════════════════════ */
  function secOpenPhoneModal() {
    secOpenModal('secPhoneOverlay');
  }

  function secSendPhoneOtp() {
    const ph = document.getElementById('secPhoneInput').value.trim();
    if (!ph) {
      secToast('Enter a phone number', 'warning');
      return;
    }
    secCloseModal('secPhoneOverlay');
    document.getElementById('secOtpDest').textContent = ph;
    document.getElementById('secOtpErr').classList.remove('show');
    for (let i = 0; i < 6; i++) {
      const el = document.getElementById('otp' + i);
      el.value = '';
      el.classList.remove('filled');
    }
    secOpenModal('secOtpOverlay');
    secStartOtpTimer();
    secOtpContext = 'phone_link';
    secToast('OTP sent to ' + ph, 'info');
  }

  /* ═══════════════════════════════════════════════
     2FA
  ═══════════════════════════════════════════════ */
  function secHandle2FA(cb) {
    if (cb.checked) {
      cb.checked = false; // revert until verified
      secOtpContext = '2fa_enable';
      document.getElementById('secOtpDest').textContent = '+63 9XX XXX XXXX';
      document.getElementById('secOtpErr').classList.remove('show');
      for (let i = 0; i < 6; i++) {
        const el = document.getElementById('otp' + i);
        el.value = '';
        el.classList.remove('filled');
      }
      secOpenModal('secOtpOverlay');
      secStartOtpTimer();
    } else {
      secUpdate2FAStatus(false);
      secToast('Two-factor authentication disabled', 'warning');
    }
  }

  function secUpdate2FAStatus(on) {
    const badge = document.getElementById('sec2FAStatus');
    const toggle = document.getElementById('sec2FAToggle');
    toggle.checked = on;
    badge.className = 'sec-status ' + (on ? 'sec-status-on' : 'sec-status-off');
    badge.textContent = on ? '✓ Enabled' : '● Disabled';
    secUpdateScore(on);
  }

  /* ═══════════════════════════════════════════════
     AUTH APP SETUP
  ═══════════════════════════════════════════════ */
  function secOpenAuthApp() {
    secOpenModal('secAuthAppOverlay');
  }

  function secConfirmAuthApp() {
    const code = Array.from({
      length: 6
    }, (_, i) => {
      const el = document.getElementById('atp' + i);
      return el ? el.value : '';
    }).join('');
    if (code.length < 6) {
      secToast('Enter the 6-digit code from your authenticator app', 'warning');
      return;
    }
    secCloseModal('secAuthAppOverlay');
    secToast('Authenticator app configured!', 'success');
  }

  /* ═══════════════════════════════════════════════
     BACKUP CODES
  ═══════════════════════════════════════════════ */
  function secViewBackupCodes() {
    secOpenModal('secBackupOverlay');
  }

  function secCopyCodes() {
    const codes = Array.from(document.querySelectorAll('#secBackupCodesGrid div')).map(d => d.textContent).join('\n');
    navigator.clipboard.writeText(codes).then(() => secToast('Codes copied to clipboard', 'success'));
  }

  function secRegenCodes() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    const grid = document.getElementById('secBackupCodesGrid');
    grid.innerHTML = Array.from({
      length: 8
    }, () => {
      const a = Array.from({
        length: 4
      }, () => chars[Math.floor(Math.random() * chars.length)]).join('');
      const b = Array.from({
        length: 4
      }, () => chars[Math.floor(Math.random() * chars.length)]).join('');
      return `<div style="font-family:monospace;font-size:13px;background:var(--s-gray-50);border:1px solid var(--s-gray-200);padding:8px 10px;border-radius:var(--s-radius-sm);text-align:center">${a}-${b}</div>`;
    }).join('');
    secToast('Backup codes regenerated', 'success');
  }

  /* ═══════════════════════════════════════════════
     SESSIONS
  ═══════════════════════════════════════════════ */
  function secOpenSessions() {
    const card = document.getElementById('secSessionsCard');
    card.style.display = card.style.display === 'none' ? 'block' : 'none';
    card.scrollIntoView({
      behavior: 'smooth',
      block: 'nearest'
    });
  }

  function secRevokeSession(btn, name) {
    btn.closest('tr').remove();
    secToast(`Session revoked: ${name}`, 'info');
  }

  function secRevokeAll() {
    secOpenModal('secRevokeOverlay');
  }

  function secConfirmRevokeAll() {
    secCloseModal('secRevokeOverlay');
    secToast('All other sessions revoked', 'success');
    document.querySelector('#secSessionsCard tbody').innerHTML = `<tr><td colspan="5" style="text-align:center;padding:20px;color:var(--s-gray-400);font-style:italic">No other active sessions</td></tr>`;
  }

  /* ═══════════════════════════════════════════════
     SAVE SETTINGS
  ═══════════════════════════════════════════════ */
  function secSavePolicy() {
    secShowLoading('secPwdLoading');
    setTimeout(() => {
      secHideLoading('secPwdLoading');
      secToast('Password policy saved', 'success');
    }, 1100);
  }

  function secSaveLock() {
    secToast('Account lock policy saved', 'success');
  }

  /* ═══════════════════════════════════════════════
     POLICY BADGE
  ═══════════════════════════════════════════════ */
  function secUpdatePolicyBadge() {
    const v = document.getElementById('secPolicySelect').value;
    const badge = document.getElementById('secPolicyBadge');
    const map = {
      weak: ['sec-policy-weak', '&#9679; Weak'],
      medium: ['sec-policy-medium', '&#9679; Medium'],
      strong: ['sec-policy-strong', '&#10003; Strong'],
    };
    badge.className = 'sec-policy-badge ' + map[v][0];
    badge.innerHTML = map[v][1];
  }

  /* ═══════════════════════════════════════════════
     SECURITY SCORE
  ═══════════════════════════════════════════════ */
  function secUpdateScore(twoFaOn) {
    const score = twoFaOn ? 90 : 65;
    const color = score >= 80 ? 'var(--s-green)' : score >= 60 ? 'var(--s-amber)' : 'var(--s-red)';
    const label = score >= 80 ? 'Strong' : score >= 60 ? 'Fair' : 'Weak';
    document.getElementById('secScoreNum').textContent = score;
    document.getElementById('secScoreLabel').textContent = label;
    document.getElementById('secScoreLabel').style.color = color;
    const dashArr = `${score} ${100-score}`;
    document.getElementById('secScoreCircle').setAttribute('stroke-dasharray', dashArr);
    document.getElementById('secScoreCircle').setAttribute('stroke', color);
    if (twoFaOn) {
      const items = document.getElementById('secScoreItems');
      items.innerHTML = `
      <span class="sec-status sec-status-on">&#10003; Strong Password</span>
      <span class="sec-status sec-status-on">&#10003; 2FA Enabled</span>
      <span class="sec-status sec-status-on">&#10003; Email Verified</span>
      <span class="sec-status sec-status-warn">&#9679; Phone Unlinked</span>`;
    }
  }

  function secOpenFullHistory() {
    secToast('Full login history — wire to your backend route', 'info');
  }
</script>

@endsection