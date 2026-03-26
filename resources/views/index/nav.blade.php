<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
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
    }

    nav.main-nav {
      background: #ffffff;
      border-bottom: 1px solid #e0e0e0;
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.07);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav-inner {
      display: flex;
      align-items: center;
      padding: 0 20px;
      height: 54px;
    }

    /* ── LOGO ── */
    .nav-logo {
      display: flex;
      align-items: center;
      gap: 9px;
      text-decoration: none;
      flex-shrink: 0;
      margin-right: 28px;
    }

    .logo-seal-svg {
      width: 42px;
      height: 42px;
      flex-shrink: 0;
    }

    .logo-text-block {
      display: flex;
      flex-direction: column;
      line-height: 1.2;
    }

    .logo-text-block .main-name {
      font-size: 16px;
      font-weight: 700;
      color: #1a5fa8;
      letter-spacing: 1.5px;
      text-transform: uppercase;
    }

    .logo-text-block .sub-line {
      font-size: 7px;
      font-weight: 600;
      color: #666;
      letter-spacing: 0.6px;
      text-transform: uppercase;
    }

    /* ── NAV LINKS ── */
    .nav-links {
      display: flex;
      align-items: center;
      flex: 1;
    }

    .nav-links>a,
    .dropdown>.drop-btn {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 0 14px;
      height: 54px;
      font-size: 13px;
      font-weight: 600;
      color: #333;
      text-decoration: none;
      background: none;
      border: none;
      border-bottom: 3px solid transparent;
      font-family: inherit;
      cursor: pointer;
      white-space: nowrap;
      transition: color .17s, border-color .17s;
    }

    .nav-links>a:hover,
    .dropdown:hover>.drop-btn,
    .dropdown.open>.drop-btn {
      color: #1a5fa8;
      border-bottom-color: #1a5fa8;
    }

    /* ── DROPDOWN ── */
    .dropdown {
      position: relative;
    }

    .drop-arrow {
      width: 10px;
      height: 10px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2.5;
      stroke-linecap: round;
      stroke-linejoin: round;
      transition: transform .2s;
    }

    .dropdown:hover .drop-arrow,
    .dropdown.open .drop-arrow {
      transform: rotate(180deg);
    }

    .drop-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background: #fff;
      border: 1px solid #ddd;
      border-top: 2px solid #1a5fa8;
      border-radius: 0 0 4px 4px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, .1);
      min-width: 185px;
      z-index: 300;
      animation: dropIn .15s ease;
    }

    @keyframes dropIn {
      from {
        opacity: 0;
        transform: translateY(-4px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .dropdown:hover .drop-menu,
    .dropdown.open .drop-menu {
      display: block;
    }

    .drop-menu a {
      display: block;
      padding: 10px 16px;
      font-size: 13px;
      font-weight: 500;
      color: #333;
      text-decoration: none;
      border-left: 3px solid transparent;
      transition: background .14s, color .14s, border-color .14s;
    }

    .drop-menu a:hover {
      background: #edf3fb;
      color: #1a5fa8;
      border-left-color: #1a5fa8;
    }

    /* ── SEARCH ── */
    .nav-search {
      display: flex;
      align-items: center;
      gap: 6px;
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 20px;
      padding: 5px 14px;
      margin-left: 16px;
      flex-shrink: 0;
      transition: border-color .2s, box-shadow .2s;
    }

    .nav-search:focus-within {
      border-color: #1a5fa8;
      box-shadow: 0 0 0 3px rgba(26, 95, 168, .1);
    }

    .nav-search svg {
      width: 13px;
      height: 13px;
      stroke: #999;
      fill: none;
      stroke-width: 2.2;
      stroke-linecap: round;
      flex-shrink: 0;
    }

    .nav-search input {
      border: none;
      background: none;
      outline: none;
      font-family: inherit;
      font-size: 13px;
      color: #333;
      width: 140px;
    }

    .nav-search input::placeholder {
      color: #bbb;
    }

    /* demo */
    .demo {
      padding: 60px;
      text-align: center;
      color: #999;
      font-family: 'Open Sans', sans-serif;
    }
  </style>
</head>

<body>

  <nav class="main-nav" id="mainNav">
    <div class="nav-inner">

      <!-- LOGO -->
      <a href="{{ route('index') }}" class="nav-logo">
        <img />
        <div class="logo-text-block">
          <span class="main-name">Laguna</span>
          <span class="sub-line">Provincial Urban</span>
          <span class="sub-line">Development &amp; Housing Office</span>
        </div>
      </a>

      <!-- LINKS -->
      <div class="nav-links">
        <a href="{{ route('index') }}">Home</a>
        <a href="{{ route('iabout') }}">About</a>

        <div class="dropdown">
          <button class="drop-btn">
            Services
            <svg class="drop-arrow" viewBox="0 0 24 24">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </button>
          <div class="drop-menu">
            <a href="#">Service 1</a>
            <a href="#">Service 2</a>
            <a href="#">Service 3</a>
          </div>
        </div>

        <a href="{{ route('citizenscharter') }}">Citizen's Charter</a>
        <a href="{{ route('dforms') }}">Downloadable Forms</a>
        <a href="{{ route('faqs') }}">FAQS</a>
      </div>

      <!-- SEARCH -->
      <div class="nav-search">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input type="text" placeholder="Search..." aria-label="Search" />
      </div>

    </div>
  </nav>

  <script>
    document.querySelectorAll('.dropdown').forEach(dd => {
      dd.querySelector('.drop-btn').addEventListener('click', () => dd.classList.toggle('open'));
    });
    document.addEventListener('click', e => {
      if (!e.target.closest('.dropdown'))
        document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('open'));
    });
  </script>
</body>

</html>