@extends('admin.layout')

@section('title', 'Help & Support')

@section('content')

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
    --red-dark: #8C111E;
    --red-mid: #E8424F;
    --red-light: #F9EAEB;
    --red-pale: #FEF5F5;
    --red-pale2: #FDE8EA;
    --border: #EDE0E1;
    --text: #1A0508;
    --text-mid: #7A4A50;
    --text-muted: #B08888;
    --surface: #FFFFFF;
    --bg: #F7F1F2;
    --radius: 10px;
    --shadow: 0 1px 4px rgba(192, 32, 47, 0.07);
    --shadow-md: 0 4px 16px rgba(192, 32, 47, 0.10);
  }

  body {
    font-family: Arial, sans-serif;
    background: var(--bg);
    color: var(--text);
  }

  /* ── HERO BANNER ── */
  .help-hero {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 36px 32px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 28px;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
  }

  .help-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--red-dark), var(--red), rgba(220, 100, 112, 0.3));
  }

  .help-hero::after {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: var(--red-pale);
    pointer-events: none;
  }

  .hero-icon {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: var(--red-light);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
  }

  .hero-icon svg {
    width: 32px;
    height: 32px;
    color: var(--red);
  }

  .hero-text {
    position: relative;
    z-index: 1;
    flex: 1;
  }

  .hero-text h1 {
    font-size: 22px;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 6px;
  }

  .hero-text p {
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.6;
    max-width: 560px;
  }

  /* Search bar in hero */
  .help-search {
    position: relative;
    margin-top: 16px;
    max-width: 460px;
  }

  .help-search input {
    font-family: Arial, sans-serif;
    font-size: 14px;
    width: 100%;
    padding: 11px 16px 11px 42px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    background: var(--surface);
    color: var(--text);
    outline: none;
    transition: border-color .15s, box-shadow .15s;
  }

  .help-search input:focus {
    border-color: var(--red);
    box-shadow: 0 0 0 3px rgba(192, 32, 47, 0.08);
  }

  .help-search input::placeholder {
    color: var(--text-muted);
  }

  .help-search svg {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    color: var(--text-muted);
    pointer-events: none;
  }

  .search-clear {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 4px;
    border-radius: 4px;
    transition: color .12s;
  }

  .search-clear:hover {
    color: var(--red);
  }

  .search-clear svg {
    width: 14px;
    height: 14px;
  }

  /* ── LAYOUT ── */
  .help-body {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 20px;
    align-items: start;
  }

  @media (max-width: 900px) {
    .help-body {
      grid-template-columns: 1fr;
    }
  }

  /* ── QUICK LINKS ── */
  .quick-links {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 20px;
  }

  @media (max-width: 640px) {
    .quick-links {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media (max-width: 400px) {
    .quick-links {
      grid-template-columns: 1fr;
    }
  }

  .ql-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    cursor: pointer;
    text-decoration: none;
    transition: border-color .15s, box-shadow .15s, background .15s;
    box-shadow: var(--shadow);
  }

  .ql-card:hover {
    border-color: var(--red);
    background: var(--red-pale);
    box-shadow: var(--shadow-md);
  }

  .ql-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .ql-icon svg {
    width: 18px;
    height: 18px;
  }

  .ql-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
  }

  .ql-desc {
    font-size: 12px;
    color: var(--text-muted);
    line-height: 1.4;
  }

  /* ── SECTION CARD ── */
  .section-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 16px;
  }

  .section-head {
    padding: 14px 18px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--red-pale);
  }

  .section-head svg {
    width: 16px;
    height: 16px;
    color: var(--red);
    flex-shrink: 0;
  }

  .section-head h2 {
    font-size: 14px;
    font-weight: 700;
    color: var(--text);
  }

  .section-body {
    padding: 18px;
  }

  /* ── FAQ ACCORDION ── */
  .faq-item {
    border: 1px solid var(--border);
    border-radius: 9px;
    margin-bottom: 8px;
    overflow: hidden;
    transition: border-color .15s;
  }

  .faq-item:last-child {
    margin-bottom: 0;
  }

  .faq-item.open {
    border-color: var(--red);
  }

  .faq-q {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 13px 16px;
    cursor: pointer;
    background: var(--surface);
    transition: background .12s;
    border: none;
    width: 100%;
    text-align: left;
    font-family: Arial, sans-serif;
  }

  .faq-q:hover {
    background: var(--red-pale);
  }

  .faq-item.open .faq-q {
    background: var(--red-pale);
  }

  .faq-q-text {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text);
    line-height: 1.4;
  }

  .faq-arrow {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background .15s, transform .2s;
  }

  .faq-arrow svg {
    width: 10px;
    height: 10px;
    color: var(--text-mid);
  }

  .faq-item.open .faq-arrow {
    background: var(--red);
    transform: rotate(180deg);
  }

  .faq-item.open .faq-arrow svg {
    color: #fff;
  }

  .faq-a {
    max-height: 0;
    overflow: hidden;
    transition: max-height .28s ease, padding .2s;
    background: #FFFAFA;
    font-size: 13.5px;
    color: var(--text-mid);
    line-height: 1.65;
    padding: 0 16px;
  }

  .faq-item.open .faq-a {
    max-height: 300px;
    padding: 12px 16px 14px;
  }

  /* ── GUIDE STEPS ── */
  .guide-steps {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .guide-step {
    display: flex;
    gap: 14px;
    align-items: flex-start;
    padding: 13px 14px;
    border: 1px solid var(--border);
    border-radius: 9px;
    background: var(--surface);
    transition: border-color .15s, background .15s;
    cursor: default;
  }

  .guide-step:hover {
    border-color: var(--red);
    background: var(--red-pale);
  }

  .step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--red);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
  }

  .step-title {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 3px;
  }

  .step-desc {
    font-size: 12.5px;
    color: var(--text-mid);
    line-height: 1.5;
  }

  /* ── RIGHT SIDEBAR ── */
  .sidebar-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow);
    margin-bottom: 16px;
  }

  .sidebar-head {
    padding: 13px 16px;
    border-bottom: 1px solid var(--border);
    background: var(--red-pale);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .sidebar-head svg {
    width: 15px;
    height: 15px;
    color: var(--red);
  }

  .sidebar-head h3 {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
  }

  .sidebar-body {
    padding: 16px;
  }

  /* Contact card */
  .contact-item {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    padding: 11px 0;
    border-bottom: 1px solid var(--border);
  }

  .contact-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }

  .contact-icon {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .contact-icon svg {
    width: 15px;
    height: 15px;
  }

  .contact-label {
    font-size: 11px;
    color: var(--text-muted);
    margin-bottom: 2px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    font-weight: 700;
  }

  .contact-val {
    font-size: 13px;
    font-weight: 600;
    color: var(--text);
  }

  .contact-val a {
    color: var(--red);
    text-decoration: none;
  }

  .contact-val a:hover {
    text-decoration: underline;
  }

  /* Status indicator */
  .status-row {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 9px 0;
    border-bottom: 1px solid var(--border);
  }

  .status-row:last-child {
    border-bottom: none;
  }

  .status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
  }

  .dot-green {
    background: #22c55e;
  }

  .dot-yellow {
    background: #EAB308;
  }

  .dot-red {
    background: var(--red);
  }

  .status-svc {
    font-size: 13px;
    color: var(--text-mid);
    flex: 1;
  }

  .status-badge {
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
  }

  .sb-online {
    background: #DCFCE7;
    color: #15803D;
  }

  .sb-degraded {
    background: #FEF9C3;
    color: #A16207;
  }

  .sb-down {
    background: #FFE4E6;
    color: #BE123C;
  }

  /* ── CONTACT FORM ── */
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 12px;
  }

  @media (max-width: 500px) {
    .form-row {
      grid-template-columns: 1fr;
    }
  }

  .form-group {
    margin-bottom: 12px;
  }

  .form-label {
    display: block;
    font-size: 11.5px;
    font-weight: 700;
    color: var(--text-mid);
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
  }

  .form-control {
    font-family: Arial, sans-serif;
    font-size: 13px;
    width: 100%;
    padding: 9px 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--surface);
    color: var(--text);
    outline: none;
    transition: border-color .15s, box-shadow .15s;
  }

  .form-control:focus {
    border-color: var(--red);
    box-shadow: 0 0 0 3px rgba(192, 32, 47, 0.08);
  }

  textarea.form-control {
    resize: vertical;
    min-height: 90px;
    line-height: 1.5;
  }

  /* ── BUTTONS ── */
  .btn {
    font-family: Arial, sans-serif;
    font-size: 13px;
    font-weight: 700;
    padding: 9px 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    transition: background .15s, color .15s, transform .1s;
  }

  .btn:active {
    transform: scale(0.98);
  }

  .btn svg {
    width: 14px;
    height: 14px;
  }

  .btn-red {
    background: var(--red);
    color: #fff;
  }

  .btn-red:hover {
    background: var(--red-dark);
  }

  .btn-outline {
    background: var(--surface);
    border: 1px solid var(--border);
    color: var(--text-mid);
  }

  .btn-outline:hover {
    background: var(--red-pale);
    color: var(--red);
    border-color: var(--red);
  }

  .btn-block {
    width: 100%;
    justify-content: center;
  }

  /* ── NO RESULTS ── */
  .no-results {
    text-align: center;
    padding: 32px 16px;
    color: var(--text-muted);
    display: none;
  }

  .no-results svg {
    width: 36px;
    height: 36px;
    margin-bottom: 10px;
    opacity: 0.35;
  }

  .no-results p {
    font-size: 13px;
  }

  /* ── TOAST ── */
  .toast-container {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 500;
    display: flex;
    flex-direction: column;
    gap: 8px;
    pointer-events: none;
  }

  .toast {
    background: var(--surface);
    border: 1px solid var(--border);
    border-left: 4px solid var(--red);
    border-radius: 10px;
    padding: 12px 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
    pointer-events: auto;
    animation: toastIn .22s ease;
    min-width: 240px;
    max-width: 320px;
    font-family: Arial, sans-serif;
  }

  .toast.t-success {
    border-left-color: #16a34a;
  }

  .toast.t-info {
    border-left-color: #3B82F6;
  }

  .toast svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
  }

  .toast-msg {
    font-size: 13px;
    color: var(--text);
    font-weight: 500;
    flex: 1;
    line-height: 1.4;
  }

  .toast-x {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    display: flex;
    padding: 2px;
    border-radius: 4px;
  }

  .toast-x:hover {
    color: var(--text);
  }

  .toast-x svg {
    width: 12px;
    height: 12px;
  }

  @keyframes toastIn {
    from {
      opacity: 0;
      transform: translateX(16px);
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 600px) {
    .help-hero {
      flex-direction: column;
      align-items: flex-start;
      padding: 22px 18px;
    }

    .hero-icon {
      display: none;
    }
  }
</style>

<!-- Toast container -->
<div class="toast-container" id="toastContainer"></div>

<!-- HERO -->
<div class="help-hero">
  <div class="hero-icon">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
  </div>
  <div class="hero-text">
    <h1>Help &amp; Support</h1>
    <p>Find answers to common questions, get step-by-step guides, or reach out to the PUDHO development team directly. We're here to keep your system running smoothly.</p>
    <div class="help-search">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
      <input type="text" id="faqSearch" placeholder="Search help topics, FAQs…" oninput="searchFAQ(this.value)">
      <button class="search-clear" id="searchClear" onclick="clearSearch()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- QUICK LINKS -->
<div class="quick-links">
  <a class="ql-card" onclick="scrollTo('faqSection')">
    <div class="ql-icon" style="background:var(--red-light)">
      <svg fill="none" stroke="var(--red)" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <div class="ql-title">FAQs</div>
    <div class="ql-desc">Answers to the most common questions.</div>
  </a>
  <a class="ql-card" onclick="scrollTo('guideSection')">
    <div class="ql-icon" style="background:#EFF6FF">
      <svg fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
      </svg>
    </div>
    <div class="ql-title">Getting Started</div>
    <div class="ql-desc">Step-by-step guides for new admins.</div>
  </a>
  <a class="ql-card" onclick="scrollTo('contactSection')">
    <div class="ql-icon" style="background:#DCFCE7">
      <svg fill="none" stroke="#16a34a" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
      </svg>
    </div>
    <div class="ql-title">Contact Support</div>
    <div class="ql-desc">Reach the dev team directly.</div>
  </a>
  <a class="ql-card" onclick="scrollTo('statusSection')">
    <div class="ql-icon" style="background:#FEF9C3">
      <svg fill="none" stroke="#A16207" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <div class="ql-title">System Status</div>
    <div class="ql-desc">Check if all services are online.</div>
  </a>
  <a class="ql-card" href="{{ route('admin.logs') }}">
    <div class="ql-icon" style="background:#F3E8FF">
      <svg fill="none" stroke="#7C3AED" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
    </div>
    <div class="ql-title">Audit Logs</div>
    <div class="ql-desc">Review system and user activity.</div>
  </a>
  <a class="ql-card" href="{{ route('admin.general') }}">
    <div class="ql-icon" style="background:#FEF0F1">
      <svg fill="none" stroke="var(--red)" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
    </div>
    <div class="ql-title">Settings</div>
    <div class="ql-desc">Manage system configuration.</div>
  </a>
</div>

<!-- MAIN BODY -->
<div class="help-body">

  <!-- LEFT COLUMN -->
  <div>

    <!-- FAQ -->
    <div class="section-card" id="faqSection">
      <div class="section-head">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h2>Frequently Asked Questions</h2>
      </div>
      <div class="section-body">
        <div id="faqList">

          <div class="faq-item" data-q="how do i reset my password forgot password">
            <button class="faq-q" onclick="toggleFAQ(this)">
              <span class="faq-q-text">How do I reset my password?</span>
              <span class="faq-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg></span>
            </button>
            <div class="faq-a">Go to the login page and click <strong>Forgot Password</strong>. Enter your registered email address and you will receive a reset link within a few minutes. If you do not receive the email, check your spam folder or contact the system administrator.</div>
          </div>

          <div class="faq-item" data-q="add new user account staff admin create">
            <button class="faq-q" onclick="toggleFAQ(this)">
              <span class="faq-q-text">How do I add a new user account?</span>
              <span class="faq-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg></span>
            </button>
            <div class="faq-a">Navigate to <strong>Administration → User Management</strong> and click the <strong>Add User</strong> button. Fill in the required fields (name, email, role) and submit. The new user will receive an email invitation to set their password.</div>
          </div>

          <div class="faq-item" data-q="upload document file size limit format pdf">
            <button class="faq-q" onclick="toggleFAQ(this)">
              <span class="faq-q-text">What file types and sizes are allowed for uploads?</span>
              <span class="faq-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg></span>
            </button>
            <div class="faq-a">The system accepts <strong>PDF, DOCX, JPG, PNG, and XLSX</strong> files. The maximum file size per upload is <strong>10 MB</strong>. For larger files, please contact the system administrator for an alternative transfer method.</div>
          </div>

          <div class="faq-item" data-q="anti squatting report how submit flag resident">
            <button class="faq-q" onclick="toggleFAQ(this)">
              <span class="faq-q-text">How do I submit an anti-squatting report?</span>
              <span class="faq-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg></span>
            </button>
            <div class="faq-a">Go to <strong>Anti-Squatting → Reports</strong> and click <strong>New Report</strong>. Fill in the location details, describe the situation, and attach supporting photos if available. Reports are reviewed by the investigation team within 3 business days.</div>
          </div>

          <div class="faq-item" data-q="export download data residents logs report excel pdf">
            <button class="faq-q" onclick="toggleFAQ(this)">
              <span class="faq-q-text">How do I export data to PDF or Excel?</span>
              <span class="faq-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg></span>
            </button>
            <div class="faq-a">Most data tables have a <strong>Download</strong> button in the top-right corner. Click it to open the export dialog, select your format (PDF or Excel), specify a date range if applicable, and click <strong>Download</strong>. The file will be generated and saved to your device.</div>
          </div>

          <div class="faq-item" data-q="session logout automatically timeout login again">
            <button class="faq-q" onclick="toggleFAQ(this)">
              <span class="faq-q-text">Why does the system log me out automatically?</span>
              <span class="faq-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg></span>
            </button>
            <div class="faq-a">For security, the system ends sessions that have been inactive for <strong>30 minutes</strong>. This protects sensitive resident data. You can adjust the timeout duration in <strong>Settings → Security</strong> if you have administrator privileges.</div>
          </div>

          <div class="faq-item" data-q="resident record duplicate merge verify">
            <button class="faq-q" onclick="toggleFAQ(this)">
              <span class="faq-q-text">What do I do if I find a duplicate resident record?</span>
              <span class="faq-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg></span>
            </button>
            <div class="faq-a">Open both resident records and use the <strong>Flag as Duplicate</strong> option in the action menu. The records will be queued for review by a supervisor. Do not delete records manually — the merge process ensures no data is lost.</div>
          </div>

          <div class="faq-item" data-q="browser support compatible chrome firefox edge">
            <button class="faq-q" onclick="toggleFAQ(this)">
              <span class="faq-q-text">Which browsers are supported?</span>
              <span class="faq-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg></span>
            </button>
            <div class="faq-a">The system is fully supported on the latest versions of <strong>Google Chrome, Mozilla Firefox, Microsoft Edge, and Safari</strong>. Internet Explorer is not supported. For the best experience, keep your browser up to date.</div>
          </div>

        </div>
        <div class="no-results" id="noFAQ">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <p>No FAQs match your search. Try different keywords or <button onclick="scrollTo('contactSection')" style="background:none;border:none;color:var(--red);cursor:pointer;font-family:Arial;font-size:13px;font-weight:700;padding:0">contact support</button>.</p>
        </div>
      </div>
    </div>

    <!-- GETTING STARTED GUIDE -->
    <div class="section-card" id="guideSection">
      <div class="section-head">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <h2>Getting Started Guide</h2>
      </div>
      <div class="section-body">
        <div class="guide-steps">
          <div class="guide-step">
            <div class="step-num">1</div>
            <div>
              <div class="step-title">Log in and secure your account</div>
              <div class="step-desc">Use your official government email to sign in. Go to <strong>My Profile</strong> and update your password on first login. Enable two-factor authentication under <strong>Settings → Security</strong> for extra protection.</div>
            </div>
          </div>
          <div class="guide-step">
            <div class="step-num">2</div>
            <div>
              <div class="step-title">Explore the Dashboard</div>
              <div class="step-desc">The Dashboard gives you a real-time overview of residents, pending files, unread messages, and active reports. Use the sidebar to navigate between modules.</div>
            </div>
          </div>
          <div class="guide-step">
            <div class="step-num">3</div>
            <div>
              <div class="step-title">Manage Resident Records</div>
              <div class="step-desc">Go to <strong>Residents</strong> to view, add, or update records. Use the search and filter tools to quickly find specific residents. Always verify documents before approving an application.</div>
            </div>
          </div>
          <div class="guide-step">
            <div class="step-num">4</div>
            <div>
              <div class="step-title">Handle Anti-Squatting Reports</div>
              <div class="step-desc">Navigate to <strong>Anti-Squatting → Reports</strong> to manage incoming reports. Assign investigations, update statuses, and coordinate with field teams via the Map View module.</div>
            </div>
          </div>
          <div class="guide-step">
            <div class="step-num">5</div>
            <div>
              <div class="step-title">Monitor Audit Logs regularly</div>
              <div class="step-desc">Under <strong>Administration → Audit Logs</strong>, review user and system activity. Download reports periodically for compliance records. Flag any suspicious activity immediately.</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CONTACT FORM -->
    <div class="section-card" id="contactSection">
      <div class="section-head">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <h2>Send a Support Request</h2>
      </div>
      <div class="section-body">
        <p style="font-size:13px;color:var(--text-muted);margin-bottom:18px;line-height:1.55">Can't find what you need? Send us a message and the PUDHO development team will respond within <strong>1–2 business days</strong>.</p>
        <form id="supportForm" onsubmit="submitSupport(event)">
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Your Name</label>
              <input type="text" class="form-control" id="sName" placeholder="e.g. Juan dela Cruz" required>
            </div>
            <div class="form-group">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" id="sEmail" placeholder="you@pudho-laguna.gov.ph" required>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Category</label>
            <select class="form-control" id="sCategory" required>
              <option value="">Select a category…</option>
              <option>Account / Login Issue</option>
              <option>Resident Records</option>
              <option>File Management</option>
              <option>Anti-Squatting Module</option>
              <option>Reports &amp; Analytics</option>
              <option>User Management</option>
              <option>System Error / Bug</option>
              <option>Feature Request</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Priority</label>
            <select class="form-control" id="sPriority">
              <option value="low">Low — General question</option>
              <option value="medium" selected>Medium — Something isn't working right</option>
              <option value="high">High — Blocking my work</option>
              <option value="critical">Critical — System down / data loss</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Subject</label>
            <input type="text" class="form-control" id="sSubject" placeholder="Brief description of the issue" required>
          </div>
          <div class="form-group">
            <label class="form-label">Message</label>
            <textarea class="form-control" id="sMessage" placeholder="Describe the issue in detail. Include any error messages, steps to reproduce, and what you expected to happen…" required></textarea>
          </div>
          <div style="display:flex;gap:10px;justify-content:flex-end;flex-wrap:wrap">
            <button type="button" class="btn btn-outline" onclick="resetForm()">Clear</button>
            <button type="submit" class="btn btn-red">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
              </svg>
              Send Request
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <!-- RIGHT COLUMN -->
  <div>

    <!-- CONTACT INFO -->
    <div class="sidebar-card">
      <div class="sidebar-head">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
        </svg>
        <h3>Contact Information</h3>
      </div>
      <div class="sidebar-body">
        <div class="contact-item">
          <div class="contact-icon" style="background:var(--red-light)">
            <svg fill="none" stroke="var(--red)" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <div>
            <div class="contact-label">Email Support</div>
            <div class="contact-val"><a href="mailto:devteam@pudho-laguna.gov.ph">devteam@pudho-laguna.gov.ph</a></div>
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-icon" style="background:#EFF6FF">
            <svg fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
          </div>
          <div>
            <div class="contact-label">Hotline</div>
            <div class="contact-val">(049) 123-4567</div>
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-icon" style="background:#DCFCE7">
            <svg fill="none" stroke="#16a34a" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div>
            <div class="contact-label">Support Hours</div>
            <div class="contact-val">Mon – Fri, 8:00 AM – 5:00 PM</div>
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-icon" style="background:#FEF9C3">
            <svg fill="none" stroke="#A16207" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <div>
            <div class="contact-label">Office</div>
            <div class="contact-val">Capitol Compound, Sta. Cruz, Laguna</div>
          </div>
        </div>
      </div>
    </div>

    <!-- SYSTEM STATUS -->
    <div class="sidebar-card" id="statusSection">
      <div class="sidebar-head">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3>System Status</h3>
      </div>
      <div class="sidebar-body">
        <div class="status-row">
          <span class="status-dot dot-green"></span>
          <span class="status-svc">Web Application</span>
          <span class="status-badge sb-online">Online</span>
        </div>
        <div class="status-row">
          <span class="status-dot dot-green"></span>
          <span class="status-svc">Database Server</span>
          <span class="status-badge sb-online">Online</span>
        </div>
        <div class="status-row">
          <span class="status-dot dot-green"></span>
          <span class="status-svc">File Storage</span>
          <span class="status-badge sb-online">Online</span>
        </div>
        <div class="status-row">
          <span class="status-dot dot-yellow"></span>
          <span class="status-svc">Email Service</span>
          <span class="status-badge sb-degraded">Degraded</span>
        </div>
        <div class="status-row">
          <span class="status-dot dot-green"></span>
          <span class="status-svc">Backup Service</span>
          <span class="status-badge sb-online">Online</span>
        </div>
        <div style="margin-top:12px;padding-top:12px;border-top:1px solid var(--border);font-size:11.5px;color:var(--text-muted)">
          Last checked: <span id="lastChecked"></span>
        </div>
      </div>
    </div>

    <!-- QUICK TIPS -->
    <div class="sidebar-card">
      <div class="sidebar-head">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
        </svg>
        <h3>Quick Tips</h3>
      </div>
      <div class="sidebar-body" style="display:flex;flex-direction:column;gap:11px">
        <div style="display:flex;gap:9px;align-items:flex-start">
          <span style="color:var(--red);font-size:15px;margin-top:1px;flex-shrink:0">&#9679;</span>
          <span style="font-size:12.5px;color:var(--text-mid);line-height:1.5">Use the sidebar search to quickly jump to any module.</span>
        </div>
        <div style="display:flex;gap:9px;align-items:flex-start">
          <span style="color:var(--red);font-size:15px;margin-top:1px;flex-shrink:0">&#9679;</span>
          <span style="font-size:12.5px;color:var(--text-mid);line-height:1.5">Press <kbd style="background:var(--bg);border:1px solid var(--border);border-radius:4px;padding:1px 5px;font-size:11px;font-family:monospace">Esc</kbd> to close any open dialog.</span>
        </div>
        <div style="display:flex;gap:9px;align-items:flex-start">
          <span style="color:var(--red);font-size:15px;margin-top:1px;flex-shrink:0">&#9679;</span>
          <span style="font-size:12.5px;color:var(--text-mid);line-height:1.5">Export data regularly as a backup — use Audit Logs for accountability.</span>
        </div>
        <div style="display:flex;gap:9px;align-items:flex-start">
          <span style="color:var(--red);font-size:15px;margin-top:1px;flex-shrink:0">&#9679;</span>
          <span style="font-size:12.5px;color:var(--text-mid);line-height:1.5">Never share your account credentials. Each staff member should have their own login.</span>
        </div>
        <div style="display:flex;gap:9px;align-items:flex-start">
          <span style="color:var(--red);font-size:15px;margin-top:1px;flex-shrink:0">&#9679;</span>
          <span style="font-size:12.5px;color:var(--text-mid);line-height:1.5">If you see a red error banner, note the error code before contacting support.</span>
        </div>
      </div>
    </div>

    <!-- VERSION INFO -->
    <div class="sidebar-card">
      <div class="sidebar-head">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3>System Information</h3>
      </div>
      <div class="sidebar-body">
        <table style="width:100%;font-size:12.5px;border-collapse:collapse">
          <tr>
            <td style="color:var(--text-muted);padding:5px 0;border-bottom:1px solid var(--border)">Version</td>
            <td style="color:var(--text);font-weight:600;text-align:right;padding:5px 0;border-bottom:1px solid var(--border)">v2.4.1</td>
          </tr>
          <tr>
            <td style="color:var(--text-muted);padding:5px 0;border-bottom:1px solid var(--border)">Last Updated</td>
            <td style="color:var(--text);font-weight:600;text-align:right;padding:5px 0;border-bottom:1px solid var(--border)">June 1, 2024</td>
          </tr>
          <tr>
            <td style="color:var(--text-muted);padding:5px 0;border-bottom:1px solid var(--border)">Environment</td>
            <td style="color:var(--text);font-weight:600;text-align:right;padding:5px 0;border-bottom:1px solid var(--border)">Production</td>
          </tr>
          <tr>
            <td style="color:var(--text-muted);padding:5px 0">Developer</td>
            <td style="color:var(--red);font-weight:600;text-align:right;padding:5px 0">PUDHO Dev Team</td>
          </tr>
        </table>
      </div>
    </div>

  </div>
</div>

<script>
  // ── FAQ ACCORDION ─────────────────────────────────────────────────
  function toggleFAQ(btn) {
    var item = btn.closest('.faq-item');
    var isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(function(i) {
      i.classList.remove('open');
    });
    if (!isOpen) item.classList.add('open');
  }

  // ── FAQ SEARCH ────────────────────────────────────────────────────
  function searchFAQ(val) {
    var q = val.trim().toLowerCase();
    var items = document.querySelectorAll('#faqList .faq-item');
    var visible = 0;
    document.getElementById('searchClear').style.display = q ? 'flex' : 'none';
    items.forEach(function(item) {
      var text = (item.getAttribute('data-q') || '') + ' ' + item.querySelector('.faq-q-text').textContent.toLowerCase();
      var match = !q || text.indexOf(q) !== -1;
      item.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    document.getElementById('noFAQ').style.display = (visible === 0) ? 'block' : 'none';
  }

  function clearSearch() {
    document.getElementById('faqSearch').value = '';
    searchFAQ('');
  }

  // ── SCROLL TO SECTION ─────────────────────────────────────────────
  function scrollTo(id) {
    var el = document.getElementById(id);
    if (el) el.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
  }

  // ── SUPPORT FORM ──────────────────────────────────────────────────
  function submitSupport(e) {
    e.preventDefault();
    var btn = e.target.querySelector('[type="submit"]');
    btn.disabled = true;
    btn.textContent = 'Sending…';
    setTimeout(function() {
      showToast('Support request sent! We\'ll respond within 1–2 business days.', 'success');
      document.getElementById('supportForm').reset();
      btn.disabled = false;
      btn.innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg> Send Request';
    }, 1200);
  }

  function resetForm() {
    document.getElementById('supportForm').reset();
    showToast('Form cleared.', 'info');
  }

  // ── SYSTEM STATUS TIMESTAMP ───────────────────────────────────────
  (function() {
    var el = document.getElementById('lastChecked');
    if (!el) return;
    var now = new Date();
    el.textContent = now.toLocaleTimeString('en-US', {
      hour: '2-digit',
      minute: '2-digit'
    });
  })();

  // ── TOAST ─────────────────────────────────────────────────────────
  function showToast(msg, type) {
    type = type || 'info';
    var icons = {
      success: '<svg fill="none" stroke="#16a34a" viewBox="0 0 24 24" width="15" height="15"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
      error: '<svg fill="none" stroke="#BE123C" viewBox="0 0 24 24" width="15" height="15"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
      info: '<svg fill="none" stroke="#3B82F6" viewBox="0 0 24 24" width="15" height="15"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
    };
    var colors = {
      success: '#16a34a',
      error: '#BE123C',
      info: '#3B82F6'
    };
    var t = document.createElement('div');
    t.className = 'toast';
    t.style.borderLeftColor = colors[type] || colors.info;
    t.innerHTML = (icons[type] || icons.info) +
      '<span class="toast-msg">' + msg + '</span>' +
      '<button class="toast-x" onclick="this.parentElement.remove()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>';
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(function() {
      if (t.parentElement) t.remove();
    }, 5000);
  }
</script>

@endsection