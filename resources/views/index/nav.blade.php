<style>
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
    justify-content: space-between;
    padding: 0 20px;
    height: 60px;
    max-width: 1280px;
    margin: 0 auto;
  }

  .nav-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    flex-shrink: 0;
  }

  .logo-seal-img {
    width: 44px;
    height: 44px;
    object-fit: contain;
  }

  .logo-text-block {
    display: flex;
    flex-direction: column;
    line-height: 1.1;
  }

  .logo-text-block .main-name {
    font-size: 17px;
    font-weight: 800;
    color: #b91c1c;
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  .logo-text-block .sub-line {
    font-size: 8px;
    font-weight: 700;
    color: #666;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    white-space: nowrap;
  }

  /* Hamburger Menu */
  .nav-toggle {
    display: none;
    background: none;
    border: none;
    padding: 10px;
    cursor: pointer;
    color: #333;
  }

  .nav-toggle svg {
    width: 24px;
    height: 24px;
  }

  .nav-content {
    display: flex;
    align-items: center;
    flex: 1;
    justify-content: space-between;
    margin-left: 30px;
  }

  .nav-links {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .nav-links > a,
  .dropdown > .drop-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 0 12px;
    height: 60px;
    font-size: 13px;
    font-weight: 600;
    color: #444;
    text-decoration: none;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    font-family: inherit;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.2s;
  }

  .nav-links > a:hover,
  .dropdown:hover > .drop-btn {
    color: #b91c1c;
    border-bottom-color: #b91c1c;
    background: #fdf2f2;
  }

  .dropdown {
    position: relative;
    height: 100%;
  }

  .drop-arrow {
    width: 10px;
    height: 10px;
    stroke: currentColor;
    fill: none;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
    transition: transform .2s;
  }

  .dropdown:hover .drop-arrow {
    transform: rotate(180deg);
  }

  .drop-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    border: 1px solid #eee;
    border-top: 2px solid #b91c1c;
    border-radius: 0 0 8px 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    min-width: 200px;
    padding: 8px 0;
    z-index: 300;
  }

  .dropdown:hover .drop-menu {
    display: block;
    animation: fadeIn 0.2s ease-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .drop-menu a {
    display: block;
    padding: 10px 20px;
    font-size: 13px;
    font-weight: 500;
    color: #444;
    text-decoration: none;
    transition: all 0.15s;
  }

  .drop-menu a:hover {
    background: #fdf2f2;
    color: #b91c1c;
    padding-left: 24px;
  }

  .nav-search {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f5f5f5;
    padding: 8px 16px;
    border-radius: 20px;
    border: 1px solid transparent;
    transition: all 0.2s;
  }

  .nav-search:focus-within {
    background: #fff;
    border-color: #b91c1c;
    box-shadow: 0 0 0 4px rgba(185, 28, 28, 0.05);
  }

  .nav-search svg {
    width: 14px;
    height: 14px;
    stroke: #888;
    fill: none;
    stroke-width: 2.5;
  }

  .nav-search input {
    border: none;
    background: none;
    outline: none;
    font-size: 13px;
    color: #333;
    width: 120px;
    font-weight: 500;
  }

  /* Responsive Design */
  @media (max-width: 1024px) {
    .nav-toggle {
      display: block;
    }

    .nav-content {
      position: absolute;
      top: 60px;
      left: 0;
      right: 0;
      background: #fff;
      flex-direction: column;
      align-items: stretch;
      margin-left: 0;
      border-top: 1px solid #eee;
      box-shadow: 0 10px 15px rgba(0,0,0,0.05);
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out;
    }

    .nav-content.active {
      max-height: 100vh;
      overflow-y: auto;
    }

    .nav-links {
      flex-direction: column;
      gap: 0;
    }

    .nav-links > a,
    .dropdown > .drop-btn {
      height: 50px;
      padding: 0 20px;
      border-bottom: none;
      border-left: 4px solid transparent;
      width: 100%;
      justify-content: space-between;
    }

    .nav-links > a:hover,
    .dropdown.active > .drop-btn {
      border-left-color: #b91c1c;
      background: #fdf2f2;
    }

    .dropdown {
      height: auto;
    }

    .drop-menu {
      position: static;
      box-shadow: none;
      border: none;
      background: #fafafa;
      padding: 0;
      display: none;
    }

    .dropdown.active .drop-menu {
      display: block;
    }

    .drop-menu a {
      padding: 12px 40px;
    }

    .nav-search {
      margin: 20px;
      background: #f9f9f9;
    }

    .nav-search input {
      width: 100%;
    }
  }
</style>

<nav class="main-nav" id="mainNav">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="nav-logo">
      <img src="{{ Vite::asset('resources/images/pudho-logo.png') }}" class="logo-seal-img" alt="Laguna Seal" />
      <div class="logo-text-block">
        <span class="main-name">Laguna</span>
        <span class="sub-line">Provincial Urban</span>
        <span class="sub-line">Development &amp; Housing Office</span>
      </div>
    </a>

    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg>
    </button>

    <div class="nav-content" id="navContent">
      <div class="nav-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('iabout') }}">About</a>
         <a href="{{ route('news.index') }}">News</a>
        <div class="dropdown">
          <button class="drop-btn">
            Services
            <svg class="drop-arrow" viewBox="0 0 24 24">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </button>
          <div class="drop-menu">
            <a href="{{ route('iservices') }}#query-handling">Query Handling</a>
            <a href="{{ route('iservices') }}#seminars">Seminars</a>
            <a href="{{ route('iservices') }}#tech-assistance">Technical Assistance</a>
          </div>
        </div>
        <a href="{{ route('citizenscharter') }}">Citizen's Charter</a>
        <a href="{{ route('dforms') }}">Downloadable Forms</a>
        <a href="{{ route('landing.faqs') }}">FAQS</a>
      </div>

      <div class="nav-search">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" x2="16.65" y1="21" y2="16.65" />
        </svg>
        <input type="text" placeholder="Search..." aria-label="Search" />
      </div>
    </div>
  </div>
</nav>

<script>
  // Mobile Menu Toggle
  const navToggle = document.getElementById('navToggle');
  const navContent = document.getElementById('navContent');

  if (navToggle && navContent) {
    navToggle.addEventListener('click', () => {
      navContent.classList.toggle('active');
      // Change icon
      const icon = navToggle.querySelector('svg');
      if (navContent.classList.contains('active')) {
        icon.innerHTML = '<line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>';
      } else {
        icon.innerHTML = '<line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>';
      }
    });
  }

  // Mobile Dropdown Toggle
  document.querySelectorAll('.dropdown').forEach(dropdown => {
    const btn = dropdown.querySelector('.drop-btn');
    if (btn) {
      btn.addEventListener('click', (e) => {
        if (window.innerWidth <= 1024) {
          e.preventDefault();
          dropdown.classList.toggle('active');
        }
      });
    }
  });

  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
    if (navContent && navContent.classList.contains('active') && !navToggle.contains(e.target) && !navContent.contains(e.target)) {
      navToggle.click();
    }
  });
</script>
