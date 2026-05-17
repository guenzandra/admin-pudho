<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100" id="mainNav">
  <div class="max-w-[1280px] mx-auto px-6 h-20 flex items-center justify-between">
    
    <!-- Logo Section -->
    <a href="{{ route('home') }}" class="flex items-center gap-4 group">
      <div class="relative">
        <div class="absolute -inset-1 bg-red-600/20 rounded-full blur opacity-0 group-hover:opacity-100 transition duration-500"></div>
        <img src="{{ Vite::asset('resources/images/pudho-logo.png') }}" class="w-12 h-12 relative object-contain" alt="Laguna Seal" />
      </div>
      <div class="flex flex-col">
        <span class="text-xl font-black text-gray-900 uppercase tracking-tighter leading-none group-hover:text-red-700 transition-colors">PUDHO <span class="text-red-600 group-hover:text-gray-900">LAGUNA</span></span>
        <span class="text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] leading-relaxed">Provincial Urban Development & Housing Office</span>
      </div>
    </a>

    <!-- Desktop Navigation -->
    <div class="hidden lg:flex items-center gap-1">
      <a href="{{ route('home') }}" class="px-5 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-500 hover:text-red-700 hover:bg-red-50 transition-all {{ request()->routeIs('home') ? 'bg-red-50 text-red-700' : '' }}">Home</a>
      <a href="{{ route('iabout') }}" class="px-5 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-500 hover:text-red-700 hover:bg-red-50 transition-all {{ request()->routeIs('iabout') ? 'bg-red-50 text-red-700' : '' }}">About</a>
      <a href="{{ route('news.index') }}" class="px-5 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-500 hover:text-red-700 hover:bg-red-50 transition-all {{ request()->routeIs('news.*') ? 'bg-red-50 text-red-700' : '' }}">Milestones</a>
      
      <!-- Dropdown -->
      <div class="relative group">
        <button class="px-5 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-500 hover:text-red-700 hover:bg-red-50 transition-all flex items-center gap-2 group-hover:text-red-700 group-hover:bg-red-50">
          Services <i class="fa-solid fa-chevron-down text-[8px] transition-transform group-hover:rotate-180"></i>
        </button>
        <div class="absolute top-[calc(100%+8px)] left-0 w-64 bg-white rounded-2xl border border-gray-100 shadow-2xl p-2 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300">
           <a href="{{ route('iservices') }}#query-handling" class="block px-6 py-4 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-500 hover:bg-red-50 hover:text-red-700 transition-all">Query Handling</a>
           <a href="{{ route('iservices') }}#seminars" class="block px-6 py-4 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-500 hover:bg-red-50 hover:text-red-700 transition-all">Empowerment Seminars</a>
           <a href="{{ route('iservices') }}#tech-assistance" class="block px-6 py-4 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-500 hover:bg-red-50 hover:text-red-700 transition-all">Technical Assistance</a>
        </div>
      </div>

      <a href="{{ route('citizenscharter') }}" class="px-5 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-500 hover:text-red-700 hover:bg-red-50 transition-all">Citizen's Charter</a>
      <a href="{{ route('dforms') }}" class="px-5 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-500 hover:text-red-700 hover:bg-red-50 transition-all">Resources</a>
      <a href="{{ route('landing.faqs') }}" class="px-5 py-3 ml-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition-all shadow-xl active:scale-95">Support Hub</a>
    </div>

    <!-- Mobile Toggle -->
    <button class="lg:hidden w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-900 focus:outline-none active:scale-95 transition-all" id="navToggle">
       <i class="fa-solid fa-bars-staggered"></i>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div class="lg:hidden absolute top-20 left-0 right-0 bg-white border-b border-gray-100 px-6 py-8 space-y-6 hidden shadow-2xl z-[60]" id="navContent">
    <div class="flex flex-col gap-2">
        <a href="{{ route('home') }}" class="px-6 py-4 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-900 {{ request()->routeIs('home') ? 'bg-red-50 text-red-700' : 'bg-gray-50' }}">Home</a>
        <a href="{{ route('iabout') }}" class="px-6 py-4 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-900 {{ request()->routeIs('iabout') ? 'bg-red-50 text-red-700' : '' }}">About Our Office</a>
        <a href="{{ route('news.index') }}" class="px-6 py-4 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-900 {{ request()->routeIs('news.*') ? 'bg-red-50 text-red-700' : '' }}">News & Archive</a>
        <a href="{{ route('iservices') }}" class="px-6 py-4 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-900 {{ request()->routeIs('iservices') ? 'bg-red-50 text-red-700' : '' }}">Official Services</a>
        <a href="{{ route('citizenscharter') }}" class="px-6 py-4 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-900 {{ request()->routeIs('citizenscharter') ? 'bg-red-50 text-red-700' : '' }}">Citizen's Charter</a>
        <a href="{{ route('dforms') }}" class="px-6 py-4 rounded-xl text-[11px] font-black uppercase tracking-widest text-gray-900 {{ request()->routeIs('dforms') ? 'bg-red-50 text-red-700' : '' }}">Download Forms</a>
    </div>
    <div class="pt-6 border-t border-gray-100">
        <a href="{{ route('landing.faqs') }}" class="block w-full py-5 bg-red-600 text-white rounded-2xl text-center text-[11px] font-black uppercase tracking-widest shadow-xl shadow-red-900/20 active:scale-95 transition-all">Access Support Hub</a>
    </div>
  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('navToggle');
    const navContent = document.getElementById('navContent');
    
    if(navToggle && navContent) {
      navToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const isExpanded = !navContent.classList.contains('hidden');
        
        if (isExpanded) {
          navContent.classList.add('hidden');
          navToggle.querySelector('i').className = 'fa-solid fa-bars-staggered';
        } else {
          navContent.classList.remove('hidden');
          navToggle.querySelector('i').className = 'fa-solid fa-xmark';
        }
      });

      // Close menu when clicking outside
      document.addEventListener('click', (e) => {
        if (!navContent.classList.contains('hidden') && !navContent.contains(e.target) && !navToggle.contains(e.target)) {
          navContent.classList.add('hidden');
          navToggle.querySelector('i').className = 'fa-solid fa-bars-staggered';
        }
      });

      // Prevent closing menu when clicking inside
      navContent.addEventListener('click', (e) => {
        e.stopPropagation();
      });
    }
  });
</script>
