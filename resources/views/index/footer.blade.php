<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Footer – Provincial Capitol of Laguna</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      background: #f0f0f0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .page-content {
      flex: 1;
      padding: 60px 40px;
      text-align: center;
      color: #999;
      font-size: 13px;
    }

    /* ══════════════════
       FOOTER
    ══════════════════ */
    footer.main-footer {
      background: #ffffff;
      border-top: 3px solid #d1d5db;
    }

    .footer-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 48px 32px 36px;
      display: grid;
      grid-template-columns: 1.6fr 1.2fr 1fr;
      gap: 48px;
    }

    /* ── SECTION HEADING ── */
    .footer-col h2 {
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: #374151;
      margin-bottom: 18px;
      padding-bottom: 10px;
      border-bottom: 2px solid #e5e7eb;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .footer-col h2 i {
      color: #6b7280;
      font-size: 11px;
    }

    /* ── COL 1: BRAND ── */
    .footer-brand {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .footer-logo-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    /* Placeholder box shown when no image is set yet */
    .logo-placeholder {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: #e5e7eb;
      border: 2px dashed #9ca3af;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .logo-placeholder i {
      font-size: 18px;
      color: #9ca3af;
    }

    .footer-logo-text .name {
      font-size: 15px;
      font-weight: 700;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: #111827;
      line-height: 1.2;
    }

    .footer-logo-text .sub {
      font-size: 7.5px;
      font-weight: 600;
      letter-spacing: 0.7px;
      text-transform: uppercase;
      color: #6b7280;
      line-height: 1.6;
    }

    .footer-desc {
      font-size: 12.5px;
      color: #6b7280;
      line-height: 1.8;
      max-width: 290px;
    }

    .footer-socials {
      display: flex;
      gap: 8px;
      margin-top: 2px;
    }

    .footer-socials a {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      border: 1.5px solid #d1d5db;
      background: #f9fafb;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6b7280;
      font-size: 13px;
      text-decoration: none;
      transition: background .18s, border-color .18s, color .18s;
    }

    .footer-socials a:hover {
      background: #1a5fa8;
      border-color: #1a5fa8;
      color: #fff;
    }

    /* ── COL 2: CONTACT ── */
    .contact-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .contact-item {
      display: flex;
      align-items: flex-start;
      gap: 11px;
    }

    .contact-item .ci-icon {
      width: 28px;
      height: 28px;
      border-radius: 6px;
      background: #f3f4f6;
      border: 1px solid #e5e7eb;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .contact-item .ci-icon i {
      font-size: 11px;
      color: #4b5563;
    }

    .contact-item a {
      font-size: 12.5px;
      color: #4b5563;
      text-decoration: none;
      line-height: 1.6;
      transition: color .17s;
    }

    .contact-item a:hover {
      color: #1a5fa8;
    }

    /* ── COL 3: QUICK LINKS ── */
    .quick-links {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .quick-links a {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12.5px;
      color: #4b5563;
      text-decoration: none;
      transition: color .17s, gap .17s;
    }

    .quick-links a i {
      font-size: 10px;
      color: #9ca3af;
      transition: color .17s, transform .17s;
    }

    .quick-links a:hover {
      color: #1a5fa8;
      gap: 12px;
    }

    .quick-links a:hover i {
      color: #1a5fa8;
      transform: translateX(2px);
    }

    /* ── BOTTOM BAR ── */
    .footer-bottom {
      background: #f3f4f6;
      border-top: 1px solid #e5e7eb;
    }

    .footer-bottom-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 14px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 8px;
    }

    .footer-bottom p,
    .footer-bottom a {
      font-size: 11.5px;
      color: #9ca3af;
      text-decoration: none;
    }

    .footer-bottom a:hover {
      color: #1a5fa8;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
      .footer-inner {
        grid-template-columns: 1fr;
        gap: 32px;
        padding: 36px 20px 28px;
      }

      .footer-bottom-inner {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>

<body>

  <div class="page-content">
    <p>Page content goes here…</p>
  </div>

  <footer class="main-footer">
    <div class="footer-inner">

      <!-- ── COL 1: BRAND ── -->
      <div class="footer-brand">
        <div class="footer-logo-row">

          <!--
          ┌─────────────────────────────────────────────┐
          │  REPLACE THIS BLOCK WITH YOUR LOGO IMAGE    │
          │                                             │                │
          │                                             │
          │  Laravel Blade:                             │
          │  <img src="{{ asset('images/laguna-logo.png') }}"
          │       class="footer-logo-img"               │
          │       alt="Laguna Logo"/>                   │
          └─────────────────────────────────────────────┘
        -->
          <div class="logo-placeholder">
            <i class="fas fa-image"></i>
          </div>

          <div class="footer-logo-text">
            <div class="name">Laguna</div>
            <div class="sub">Provincial Urban</div>
            <div class="sub">Development &amp; Housing Office</div>
          </div>
        </div>

        <p class="footer-desc">
          Committed to providing accessible, efficient, and transparent government services to every Laguneño.
        </p>

        <div class="footer-socials">
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" aria-label="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
          <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- ── COL 2: GET IN TOUCH ── -->
      <div class="footer-col">
        <h2><i class="fas fa-headset"></i> Get in Touch with Us</h2>
        <div class="contact-list">

          <div class="contact-item">
            <div class="ci-icon"><i class="fas fa-location-dot"></i></div>
            <a href="https://maps.google.com/?q=Provincial+Capitol+Santa+Cruz+Laguna" target="_blank">
              Provincial Capitol, P. Guevarra St.<br>Santa Cruz, Laguna
            </a>
          </div>

          <div class="contact-item">
            <div class="ci-icon"><i class="fas fa-envelope"></i></div>
            <a href="mailto:pudho@laguna.gov.ph">pudho@laguna.gov.ph</a>
          </div>

          <div class="contact-item">
            <div class="ci-icon"><i class="fas fa-phone"></i></div>
            <a href="tel:+63495010423">(049) 501-0423</a>
          </div>

        </div>
      </div>

      <!-- ── COL 3: QUICK LINKS ── -->
      <div class="footer-col">
        <h2><i class="fas fa-link"></i> Quick Links</h2>
        <div class="quick-links">
          <a href="{{ route('iabout') }}"><i class="fas fa-chevron-right"></i> About Us</a>
          <a href="{{ route('citizenscharter') }}"><i class="fas fa-chevron-right"></i> Citizen's Charter</a>
          <a href="{{ route('faqs') }}"><i class="fas fa-chevron-right"></i> News and Updates</a>
          <a href="{{ route('dforms') }}"><i class="fas fa-chevron-right"></i> Downloadable Forms</a>
        </div>
      </div>

    </div>

    <!-- BOTTOM BAR -->
    <div class="footer-bottom">
      <div class="footer-bottom-inner">
        <p>&copy; 2025 Provincial Urban Development &amp; Housing Office – Laguna. All rights reserved.</p>
        <a href="#">Privacy Policy</a>
      </div>
    </div>
  </footer>

</body>

</html>