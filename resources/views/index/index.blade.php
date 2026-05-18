@extends('index.layout')

@section('title', 'Home | Laguna PUDHO')

@section('content')

{{-- =====================================================================
     LAGUNA PUDHO — REDESIGNED HOMEPAGE
     Aesthetic: Editorial Government — structured authority meets
     warm civic trust. Deep navy + crimson + warm cream.
     Font: Arial (headings + body)
     ===================================================================== --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<style>
    :root {
        --navy: #0d1b2a;
        --navy2: #1b2d42;
        --red: #c0392b;
        --red2: #e74c3c;
        --cream: #faf8f4;
        --gold: #d4a017;
        --text: #1a1a2e;
        --muted: #6b7280;
        --border: #e5e1d8;
    }

    /* ── Base ── */
    .pudho-page * {
        font-family: 'Arial', sans-serif;
        box-sizing: border-box;
    }

    .pudho-page h1,
    .pudho-page h2,
    .pudho-page h3,
    .pudho-page .serif {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
    }

    /* ── Hero ── */
    .hero-section {
        position: relative;
        border-radius: 2rem;
        overflow: hidden;
    }

    .hero-slide {
        min-width: 100%;
        height: 100%;
    }

    .hero-overlay {
        background: linear-gradient(135deg,
                rgba(13, 27, 42, 0.85) 0%,
                rgba(13, 27, 42, 0.5) 50%,
                transparent 100%);
    }

    /* ── Ticker ── */
    .ticker-wrap {
        overflow: hidden;
        white-space: nowrap;
    }

    .ticker-inner {
        display: inline-flex;
        gap: 3rem;
        animation: ticker 30s linear infinite;
    }

    @keyframes ticker {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-50%);
        }
    }

    /* ── Cards ── */
    .card-lift {
        transition: transform 0.35s cubic-bezier(.25, .8, .25, 1),
            box-shadow 0.35s cubic-bezier(.25, .8, .25, 1);
    }

    .card-lift:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 48px rgba(13, 27, 42, 0.12);
    }

    /* ── Stats counter ── */
    .stat-num {
        font-family: 'Arial', sans-serif;
        font-weight: 900;
        color: var(--red);
    }

    /* ── FB embed placeholder ── */
    .fb-feed-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 1.5rem;
        overflow: hidden;
        transition: box-shadow 0.3s;
    }

    .fb-feed-card:hover {
        box-shadow: 0 12px 40px rgba(13, 27, 42, 0.08);
    }

    /* ── Section label ── */
    .section-label {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-size: .65rem;
        font-weight: 700;
        letter-spacing: .25em;
        text-transform: uppercase;
        color: var(--red);
    }

    .section-label::before {
        content: '';
        display: block;
        width: 1.75rem;
        height: 2px;
        background: var(--red);
    }

    /* ── Progress bar ── */
    #heroProgress {
        height: 3px;
        background: var(--red);
    }

    /* ── Dot nav ── */
    .hero-dot {
        height: 3px;
        border-radius: 2px;
        background: rgba(255, 255, 255, 0.35);
        border: 0;
        padding: 0;
        cursor: pointer;
        transition: all .4s;
    }

    .hero-dot.active {
        background: #fff;
        width: 2.5rem !important;
    }

    .hero-dot:not(.active) {
        width: 1.5rem;
    }

    /* ── Alert pulse (keep for other uses) ── */
    .alert-pulse {
        animation: pulse-ring 2s ease-in-out infinite;
    }

    @keyframes pulse-ring {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .5;
        }
    }

    /* ── Scroll reveal ── */
    .reveal {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity .7s ease, transform .7s ease;
    }

    .reveal.visible {
        opacity: 1;
        transform: none;
    }

    /* icon sizes */
    .icon-sm {
        width: 1rem;
        height: 1rem;
    }

    .icon-md {
        width: 1.25rem;
        height: 1.25rem;
    }

    .icon-lg {
        width: 1.5rem;
        height: 1.5rem;
    }

    .icon-xl {
        width: 2rem;
        height: 2rem;
    }

    .icon-2xl {
        width: 2.5rem;
        height: 2.5rem;
    }
</style>

<div class="pudho-page max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-16">

    {{-- ================================================================
     1. HERO SLIDER — REDUCED TEXT SIZE FOR BETTER BUTTON VISIBILITY
     USING LOCAL IMAGES (pudho1.jpg to pudho4.jpg)
     ================================================================ --}}
    @php
    $heroSlides = [
    [
    'eyebrow' => 'Welcome to Laguna PUDHO',
    'headline' => 'Building Sustainable<br>Urban Communities',
    'description' => 'Transforming provincial urban development through inclusive planning, housing support, and community-centered services.',
    'cta_label' => 'Our Programs',
    'cta_route' => 'iservices',
    'image' => 'pudho1.jpg',
    ],
    [
    'eyebrow' => 'Service Excellence',
    'headline' => 'Committed to<br>Responsive Public Service',
    'description' => 'Providing clear guidance, timely assistance, and meaningful urban development initiatives for Laguna communities.',
    'cta_label' => 'Our Services',
    'cta_route' => 'iservices',
    'image' => 'pudho2.jpg',
    ],
    [
    'eyebrow' => 'Community Driven',
    'headline' => 'Supporting Inclusive<br>Neighborhood Growth',
    'description' => 'Driving local progress with sustainable housing, urban design, and neighborhood revitalization strategies.',
    'cta_label' => 'About Us',
    'cta_route' => 'iabout',
    'image' => 'pudho3.jpg',
    ],
    [
    'eyebrow' => 'Laguna PUDHO',
    'headline' => 'Your Partner in<br>Urban Development',
    'description' => 'Committed to providing quality housing and urban planning services for every Lagunense.',
    'cta_label' => 'Contact Us',
    'cta_route' => 'icontact',
    'image' => 'pudho4.jpg',
    ],
    ];
    @endphp

    {{-- ================================================================
     1. HERO SLIDER — WITH LOCAL IMAGES (WORKING!)
     ================================================================ --}}
    @php
    $heroSlides = [
    [
    'eyebrow' => 'Welcome to Laguna PUDHO',
    'headline' => 'Building Sustainable<br>Urban Communities',
    'description' => 'Transforming provincial urban development through inclusive planning, housing support, and community-centered services.',
    'cta_label' => 'Our Programs',
    'cta_route' => 'iservices',
    'image' => 'pudho1.jpg',
    ],
    [
    'eyebrow' => 'Service Excellence',
    'headline' => 'Committed to<br>Responsive Public Service',
    'description' => 'Providing clear guidance, timely assistance, and meaningful urban development initiatives for Laguna communities.',
    'cta_label' => 'Our Services',
    'cta_route' => 'iservices',
    'image' => 'pudho2.jpg',
    ],
    [
    'eyebrow' => 'Community Driven',
    'headline' => 'Supporting Inclusive<br>Neighborhood Growth',
    'description' => 'Driving local progress with sustainable housing, urban design, and neighborhood revitalization strategies.',
    'cta_label' => 'About Us',
    'cta_route' => 'iabout',
    'image' => 'pudho3.jpg',
    ],
    [
    'eyebrow' => 'Laguna PUDHO',
    'headline' => 'Your Partner in<br>Urban Development',
    'description' => 'Committed to providing quality housing and urban planning services for every Lagunense.',
    'cta_label' => 'Contact Us',
    'cta_route' => 'icontact',
    'image' => 'pudho4.jpg',
    ],
    ];
    @endphp

    <section class="hero-section bg-[var(--navy)] aspect-[21/9] lg:aspect-[21/8] shadow-2xl group max-h-[88vh]">
        <div id="heroSlider" class="flex h-full" style="transition: transform 1s cubic-bezier(.4,0,.2,1)">
            @foreach($heroSlides as $slide)
            <div class="hero-slide relative flex-shrink-0">
                {{-- ✅ CORRECT PATH — images are now in public/images/ --}}
                <img src="{{ asset('images/' . $slide['image']) }}"
                    class="w-full h-full object-cover"
                    alt="{{ strip_tags($slide['headline']) }}" loading="lazy">

                <div class="hero-overlay absolute inset-0"></div>

                <div class="absolute inset-0 flex items-center"
                    style="padding: 0 clamp(1rem,5vw,5rem)">
                    <div class="max-w-[min(48rem,85%)] space-y-3">

                        <p class="section-label text-white/70 text-[10px] md:text-[11px]">
                            {{ $slide['eyebrow'] }}
                        </p>

                        <h1 class="serif font-black text-white uppercase leading-[1.1] tracking-tight"
                            style="font-size:clamp(1.4rem,4vw,3.5rem);">
                            {!! $slide['headline'] !!}
                        </h1>

                        <p class="text-white/80 font-medium leading-relaxed max-w-xl"
                            style="font-size:clamp(0.7rem,1.2vw,0.9rem);">
                            {{ $slide['description'] }}
                        </p>

                        <div class="flex flex-wrap items-center gap-3 pt-3">
                            <a href=""
                                class="inline-flex items-center gap-1.5 bg-[var(--red)] hover:bg-[var(--red2)] text-white px-5 py-2.5 md:px-6 md:py-3 rounded-xl font-bold uppercase tracking-wider text-[10px] md:text-[11px] transition-all shadow-md active:scale-95">
                                {{ $slide['cta_label'] }}
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                            <a href="{{ route('iabout') }}"
                                class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white border border-white/25 px-5 py-2.5 md:px-6 md:py-3 rounded-xl font-bold uppercase tracking-wider text-[10px] md:text-[11px] transition-all active:scale-95">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div id="heroProgress" class="absolute bottom-0 left-0 z-20" style="width:0%"></div>

        <button id="heroPrev" aria-label="Previous"
            class="absolute left-3 top-1/2 -translate-y-1/2 z-30 flex items-center justify-center bg-white/10 hover:bg-white/30 backdrop-blur-md rounded-full text-white transition-all -translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 shadow-md"
            style="width:clamp(1.75rem,3.5vw,2.5rem);height:clamp(1.75rem,3.5vw,2.5rem)">
            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="heroNext" aria-label="Next"
            class="absolute right-3 top-1/2 -translate-y-1/2 z-30 flex items-center justify-center bg-white/10 hover:bg-white/30 backdrop-blur-md rounded-full text-white transition-all translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 shadow-md"
            style="width:clamp(1.75rem,3.5vw,2.5rem);height:clamp(1.75rem,3.5vw,2.5rem)">
            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <div class="absolute z-30 flex gap-2" style="bottom:1rem;right:1.5rem">
            @foreach($heroSlides as $i => $s)
            <button class="hero-dot {{ $i===0 ? 'active' : '' }}" data-index="{{ $i }}" aria-label="Slide {{ $i+1 }}"></button>
            @endforeach
        </div>

        <div class="absolute z-30 bottom-3 left-5 text-white/50 font-mono text-[10px] tracking-widest hidden md:block">
            <span id="slideCounter">01</span> / 0{{ count($heroSlides) }}
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slider = document.getElementById('heroSlider');
            const dots = [...document.querySelectorAll('.hero-dot')];
            const counter = document.getElementById('slideCounter');
            const progress = document.getElementById('heroProgress');
            const TOTAL = dots.length;
            let cur = 0,
                timer;

            function startProgress() {
                progress.style.transition = 'none';
                progress.style.width = '0%';
                requestAnimationFrame(() => requestAnimationFrame(() => {
                    progress.style.transition = 'width 6000ms linear';
                    progress.style.width = '100%';
                }));
            }

            function goTo(idx) {
                cur = (idx + TOTAL) % TOTAL;
                slider.style.transform = `translateX(-${cur * 100}%)`;
                dots.forEach((d, i) => d.classList.toggle('active', i === cur));
                if (counter) counter.textContent = String(cur + 1).padStart(2, '0');
                startProgress();
            }

            function resetTimer() {
                clearInterval(timer);
                timer = setInterval(() => goTo(cur + 1), 6000);
            }

            const prevBtn = document.getElementById('heroPrev');
            const nextBtn = document.getElementById('heroNext');
            if (prevBtn) prevBtn.addEventListener('click', () => {
                goTo(cur - 1);
                resetTimer();
            });
            if (nextBtn) nextBtn.addEventListener('click', () => {
                goTo(cur + 1);
                resetTimer();
            });

            dots.forEach(d => d.addEventListener('click', () => {
                goTo(+d.dataset.index);
                resetTimer();
            }));

            goTo(0);
            resetTimer();
        });
    </script>

    {{-- ================================================================
     2. SCROLLING TICKER — quick announcements (no emoji)
     ================================================================ --}}
    <div class="rounded-2xl overflow-hidden border border-[var(--border)] bg-[var(--navy)]">
        <div class="flex items-stretch">
            <div class="flex-shrink-0 bg-[var(--red)] px-5 flex items-center gap-2">
                <svg class="icon-sm text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="text-white font-bold uppercase tracking-widest text-[10px]">Updates</span>
            </div>
            <div class="ticker-wrap flex-1 py-3 px-4">
                <div class="ticker-inner text-white/80 text-xs font-medium">
                    @php $tickers = [
                    '[INFO] Housing beneficiary list for Q2 2026 is now available at the PUDHO main office.',
                    '[PROJECT] Urban resettlement program registration opens June 1, 2026.',
                    '[EVENT] CLUP review public hearing scheduled for May 28, 2026 at the Capitol.',
                    '[UPDATE] Pabahay Pangil Phase 2 site validation ongoing. Affected families please coordinate with your barangay.',
                    '[INFO] Housing beneficiary list for Q2 2026 is now available at the PUDHO main office.',
                    '[PROJECT] Urban resettlement program registration opens June 1, 2026.',
                    '[EVENT] CLUP review public hearing scheduled for May 28, 2026 at the Capitol.',
                    '[UPDATE] Pabahay Pangil Phase 2 site validation ongoing. Affected families please coordinate with your barangay.',
                    ]; @endphp
                    @foreach($tickers as $t)
                    <span class="px-6 border-r border-white/10">{{ $t }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================
     3. STATS BAND
     ================================================================ --}}
    @php
    $stats = [
    ['num' => '27', 'suffix' => '', 'label' => 'Municipalities Served'],
    ['num' => '12,400', 'suffix' => '+', 'label' => 'Housing Beneficiaries'],
    ['num' => '38', 'suffix' => '', 'label' => 'Active Programs'],
    ['num' => '95', 'suffix' => '%', 'label' => 'Client Satisfaction'],
    ];
    @endphp
    <section class="reveal grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($stats as $s)
        <div class="bg-[var(--cream)] border border-[var(--border)] rounded-2xl p-6 text-center space-y-1 card-lift">
            <p class="stat-num text-4xl md:text-5xl">{{ $s['num'] }}<span class="text-2xl">{{ $s['suffix'] }}</span></p>
            <p class="text-xs font-semibold uppercase tracking-widest text-[var(--muted)]">{{ $s['label'] }}</p>
        </div>
        @endforeach
    </section>

    {{-- ================================================================
     4. ANNOUNCEMENT + LATEST NEWS (2-col)
     ================================================================ --}}
    <div class="reveal grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        {{-- Featured Announcement --}}
        <div class="lg:col-span-2 space-y-5">
            <p class="section-label">Featured Announcement</p>
            <a href="#" class="block rounded-3xl overflow-hidden group card-lift border border-[var(--border)]">
                <div class="aspect-video relative overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?q=80&w=2070&auto=format&fit=crop"
                        alt="Announcement"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[var(--navy)]/80 via-transparent to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-[var(--red)] text-white text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full">
                            Featured Project
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-7">
                        <p class="text-white/60 text-xs font-semibold uppercase tracking-widest mb-1.5">May 2026</p>
                        <h3 class="serif text-2xl md:text-3xl font-bold text-white leading-snug">
                            New Residential Development Phase 1 — Santa Rosa, Laguna
                        </h3>
                        <p class="text-white/70 text-sm mt-2 font-medium leading-relaxed line-clamp-2">
                            Site development works officially commence for Phase 1 of the PUDHO-led socialized housing project targeting 450 families in Santa Rosa.
                        </p>
                    </div>
                </div>
            </a>

            {{-- Quick links bar --}}
            @php
            $quicklinks = [
            ['icon' => 'file-lines', 'label' => 'Application Forms'],
            ['icon' => 'calendar-check', 'label' => 'Schedule a Visit'],
            ['icon' => 'map-location-dot','label' => 'Project Map'],
            ['icon' => 'circle-question', 'label' => 'FAQs'],
            ];
            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach($quicklinks as $ql)
                <a href="#"
                    class="flex flex-col items-center gap-2 bg-white border border-[var(--border)] rounded-2xl py-5 px-3 text-center hover:border-[var(--red)] hover:bg-red-50 group card-lift transition-all">
                    <svg class="icon-xl text-[var(--muted)] group-hover:text-[var(--red)] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        @if($ql['icon'] == 'file-lines')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        @elseif($ql['icon'] == 'calendar-check')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        @elseif($ql['icon'] == 'map-location-dot')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        @elseif($ql['icon'] == 'circle-question')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M12 21a9 9 0 100-18 9 9 0 000 18z"></path>
                        @endif
                    </svg>
                    <span class="text-[9px] font-black uppercase tracking-widest text-[var(--muted)] group-hover:text-[var(--red)] transition-colors">{{ $ql['label'] }}</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Latest News sidebar --}}
        <div class="space-y-5">
            <div class="flex items-center justify-between">
                <p class="section-label">Latest News</p>
                <a href="{{ route('news.index') }}" class="text-[9px] font-bold uppercase tracking-widest text-[var(--muted)] hover:text-[var(--red)] transition-colors">All news →</a>
            </div>

            @php
            $sideNews = [
            ['title' => 'Likhang Sining: Simbolo ng Pag-ibig at Dakilang Layunin', 'date' => 'Feb 14, 2026', 'category' => 'Community',
            'image' => 'https://images.unsplash.com/photo-1517732359359-61316527af7d?q=80&w=400&auto=format&fit=crop'],
            ['title' => 'Serbisyong May Malasakit: Programang Pabahay Pangil', 'date' => 'Feb 11, 2026', 'category' => 'Housing',
            'image' => 'https://images.unsplash.com/photo-1593011394396-85750873449e?q=80&w=400&auto=format&fit=crop'],
            ['title' => 'Tuluy-Tuloy na Ugnayan, Tiyak na Pabahay!', 'date' => 'Feb 05, 2026', 'category' => 'Housing',
            'image' => 'https://images.unsplash.com/photo-1473186578172-c141e6798ee4?q=80&w=400&auto=format&fit=crop'],
            ['title' => 'CLUP Workshop Para sa Pangmatagalang Pagpaplano', 'date' => 'Jan 28, 2026', 'category' => 'Planning',
            'image' => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?q=80&w=400&auto=format&fit=crop'],
            ];
            @endphp

            <div class="bg-white border border-[var(--border)] rounded-3xl divide-y divide-[var(--border)] overflow-hidden shadow-sm">
                @foreach($sideNews as $n)
                <a href="{{ route('news.show', 'sample-article') }}"
                    class="flex items-center gap-4 p-4 hover:bg-[var(--cream)] group transition-colors">
                    <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 border border-[var(--border)]">
                        <img src="{{ $n['image'] }}" alt="{{ $n['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="flex-1 min-w-0 space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="text-[8px] font-black uppercase tracking-widest text-[var(--red)] bg-red-50 px-1.5 py-0.5 rounded">{{ $n['category'] }}</span>
                            <span class="text-[8px] text-[var(--muted)] font-medium">{{ $n['date'] }}</span>
                        </div>
                        <h4 class="text-xs font-bold text-[var(--text)] group-hover:text-[var(--red)] transition-colors leading-snug line-clamp-2">{{ $n['title'] }}</h4>
                    </div>
                </a>
                @endforeach
            </div>

            <a href="{{ route('news.index') }}"
                class="w-full flex items-center justify-center gap-2 py-4 bg-[var(--navy)] text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-[var(--red)] transition-all shadow active:scale-95">
                View All News
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>

    {{-- ================================================================
     5. ABOUT STRIP
     ================================================================ --}}
    <section class="reveal relative bg-[var(--navy)] rounded-[2.5rem] overflow-hidden border border-[var(--navy2)] shadow-2xl">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-[var(--red)]/10 blur-[80px]"></div>
            <div class="absolute -bottom-20 left-0 w-72 h-72 rounded-full bg-blue-600/5 blur-[80px]"></div>
        </div>

        <div class="relative z-10 grid md:grid-cols-2 gap-0">
            <div class="p-10 md:p-16 space-y-7">
                <p class="section-label text-white/40" style="--tw-ring-color:rgba(255,255,255,.2)">Office Overview</p>
                <h2 class="serif text-3xl md:text-4xl font-bold text-white leading-tight">
                    Provincial Urban<br>
                    <span class="text-[var(--red2)]">Development</span> &amp; Housing
                </h2>
                <p class="text-white/60 text-sm leading-relaxed font-medium max-w-md">
                    The Provincial Urban Development and Housing Office leads initiatives to provide decent and affordable housing for low-income Lagunenses while ensuring sustainable urban growth across the province of Laguna.
                </p>
                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="{{ route('iabout') }}"
                        class="inline-flex items-center gap-2 bg-[var(--red)] hover:bg-[var(--red2)] text-white px-8 py-4 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-xl active:scale-95">
                        About Our Office
                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('iservices') }}"
                        class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white border border-white/20 px-8 py-4 rounded-xl text-xs font-black uppercase tracking-widest transition-all active:scale-95">
                        Our Programs
                    </a>
                </div>
            </div>

            <div class="hidden md:flex items-center justify-center p-10 border-l border-white/5">
                <div class="grid grid-cols-2 gap-4 w-full max-w-xs">
                    @php
                    $pillars = [
                    ['icon' => 'house-chimney', 'label' => 'Socialized Housing'],
                    ['icon' => 'seedling', 'label' => 'Sustainable Urban Growth'],
                    ['icon' => 'people-group', 'label' => 'Community Inclusion'],
                    ['icon' => 'landmark-flag', 'label' => 'Policy Development'],
                    ];
                    @endphp
                    @foreach($pillars as $p)
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center space-y-3 hover:bg-white/10 transition-colors">
                        <svg class="icon-2xl text-[var(--red2)] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            @if($p['icon'] == 'house-chimney')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            @elseif($p['icon'] == 'seedling')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            @elseif($p['icon'] == 'people-group')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            @elseif($p['icon'] == 'landmark-flag')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            @endif
                        </svg>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-white/60 leading-snug">{{ $p['label'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
     6. SERVICES GRID
     ================================================================ --}}
    <section class="reveal space-y-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6 border-b border-[var(--border)]">
            <div class="space-y-2">
                <p class="section-label">What We Do</p>
                <h2 class="serif text-4xl md:text-5xl font-bold text-[var(--text)] leading-none">Our Services</h2>
                <p class="text-sm text-[var(--muted)] font-medium max-w-lg">
                    Comprehensive housing and urban development services designed for the needs of Laguna residents.
                </p>
            </div>
            <a href="{{ route('iservices') }}" class="text-xs font-bold text-[var(--red)] uppercase tracking-widest flex items-center gap-2 hover:gap-3 transition-all">
                Browse All Services
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

        @php
        $services = [
        ['title' => 'Housing Assistance', 'icon' => 'house-chimney-user', 'color' => 'bg-red-50 text-red-600 border-red-100 group-hover:bg-red-600 group-hover:text-white',
        'desc' => 'Guidance and support for housing applications, resettlement programs, and beneficiary listing.'],
        ['title' => 'Urban Planning', 'icon' => 'city', 'color' => 'bg-blue-50 text-blue-600 border-blue-100 group-hover:bg-blue-600 group-hover:text-white',
        'desc' => 'Designing sustainable urban frameworks and Comprehensive Land Use Plans for Laguna communities.'],
        ['title' => 'Technical Assistance', 'icon' => 'screwdriver-wrench', 'color' => 'bg-amber-50 text-amber-600 border-amber-100 group-hover:bg-amber-600 group-hover:text-white',
        'desc' => 'Technical expertise for local housing boards, LGU offices, and community project implementation.'],
        ['title' => 'Community Engagement', 'icon' => 'people-group', 'color' => 'bg-green-50 text-green-600 border-green-100 group-hover:bg-green-600 group-hover:text-white',
        'desc' => 'Consultations, barangay outreach, and community development workshops for inclusive planning.'],
        ['title' => 'Site Development', 'icon' => 'helmet-safety', 'color' => 'bg-purple-50 text-purple-600 border-purple-100 group-hover:bg-purple-600 group-hover:text-white',
        'desc' => 'On-site project management for socialized housing subdivisions and urban renewal initiatives.'],
        ['title' => 'Data & Research', 'icon' => 'chart-bar', 'color' => 'bg-teal-50 text-teal-600 border-teal-100 group-hover:bg-teal-600 group-hover:text-white',
        'desc' => 'Housing needs assessment, geographic mapping, and socioeconomic research to guide policy.'],
        ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($services as $svc)
            <div class="group bg-white border border-[var(--border)] rounded-3xl p-8 flex flex-col gap-5 card-lift hover:border-transparent cursor-pointer">
                <div class="w-14 h-14 rounded-2xl border flex items-center justify-center text-xl transition-all duration-400 {{ $svc['color'] }}">
                    <svg class="icon-xl" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        @if($svc['icon'] == 'house-chimney-user')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2a2 2 0 012-2h2a2 2 0 012 2v2z"></path>
                        @elseif($svc['icon'] == 'city')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        @elseif($svc['icon'] == 'screwdriver-wrench')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.42 15.17L17.25 21.5 21.5 17.25l-6.33-5.83m-3.75 3.75l3.75-3.75m0-6.5L3 12l9 9 9-9-9-9z"></path>
                        @elseif($svc['icon'] == 'people-group')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        @elseif($svc['icon'] == 'helmet-safety')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 10.33a9.036 9.036 0 00-1.084-1.026 9.036 9.036 0 00-1.084-1.026M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        @elseif($svc['icon'] == 'chart-bar')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        @endif
                    </svg>
                </div>
                <div class="space-y-2">
                    <h3 class="serif font-bold text-lg text-[var(--text)] group-hover:text-[var(--red)] transition-colors">{{ $svc['title'] }}</h3>
                    <p class="text-sm text-[var(--muted)] leading-relaxed font-medium">{{ $svc['desc'] }}</p>
                </div>
                <span class="mt-auto text-xs font-bold text-[var(--red)] opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                    Learn more
                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </span>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ================================================================
     7. ARTICLES / NEWS LIST — limited to 6 with View All
     ================================================================ --}}
    @php
    $articles = [
    ['id' => 1, 'title' => 'Likhang Sining: Simbolo ng Pag-ibig at Dakilang Layunin',
    'excerpt' => 'Ano nga ba para sa inyo ang kahulugan ng tunay na pag-ibig? Marahil ang pag-ibig sa kapwa ay siyang pinakadakilang adhikain ng bawat opisyal.',
    'date' => 'Feb 14, 2026', 'category' => 'Community', 'read' => '3 min',
    'image' => 'https://images.unsplash.com/photo-1517732359359-61316527af7d?q=80&w=800&auto=format&fit=crop'],
    ['id' => 2, 'title' => 'Serbisyong May Malasakit: Programang Pabahay Pangil',
    'excerpt' => 'Isinagawa nitong Pebrero 11, 2026 ang courtesy visit upang palakasin ang ugnayan ng PUDHO at mga lokal na pamahalaan sa probinsya.',
    'date' => 'Feb 11, 2026', 'category' => 'Housing', 'read' => '4 min',
    'image' => 'https://images.unsplash.com/photo-1593011394396-85750873449e?q=80&w=800&auto=format&fit=crop'],
    ['id' => 3, 'title' => 'Tuluy-Tuloy na Ugnayan, Tiyak na Pabahay!',
    'excerpt' => 'Ang palagiang koordinasyon at malinaw na komunikasyon sa pagitan ng mga ahensya sa pabahay ay susi sa mas mabilis na paghahatid ng serbisyo.',
    'date' => 'Feb 05, 2026', 'category' => 'Housing', 'read' => '5 min',
    'image' => 'https://images.unsplash.com/photo-1473186578172-c141e6798ee4?q=80&w=800&auto=format&fit=crop'],
    ['id' => 4, 'title' => 'CLUP Workshop: Pangmatagalang Pagpaplano ng Lupa',
    'excerpt' => 'Nagtipon ang mga opisyal ng iba\'t ibang munisipyo upang talakayin ang pinakabagong Comprehensive Land Use Plan ng probinsya.',
    'date' => 'Jan 28, 2026', 'category' => 'Planning', 'read' => '6 min',
    'image' => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?q=80&w=800&auto=format&fit=crop'],
    ['id' => 5, 'title' => 'Bagong Resettlement Site Inaugurated sa Calamba City',
    'excerpt' => 'Ang bagong resettlement area na may halos 200 pamilya ang opisyal nang binuksan sa Calamba, isang makasaysayang sandali para sa mga benepisyaryo.',
    'date' => 'Jan 20, 2026', 'category' => 'Housing', 'read' => '4 min',
    'image' => 'https://images.unsplash.com/photo-1448630360428-65456885c650?q=80&w=800&auto=format&fit=crop'],
    ['id' => 6, 'title' => 'PUDHO Joins National Housing Summit 2026',
    'excerpt' => 'Kinatawan ng Laguna PUDHO ang probinsya sa pambansang summit na dinaluhan ng mga eksperto sa urban planning at pabahay mula sa buong bansa.',
    'date' => 'Jan 10, 2026', 'category' => 'Events', 'read' => '3 min',
    'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop'],
    ];
    @endphp

    <section class="reveal space-y-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6 border-b border-[var(--border)]">
            <div class="space-y-2">
                <p class="section-label">Stories &amp; Updates</p>
                <h2 class="serif text-4xl md:text-5xl font-bold text-[var(--text)] leading-none">Articles</h2>
                <p class="text-sm text-[var(--muted)] font-medium">News, programs, and stories from across the province.</p>
            </div>
            <a href="{{ route('news.index') }}"
                class="text-xs font-bold text-[var(--red)] uppercase tracking-widest flex items-center gap-2 hover:gap-3 transition-all">
                View All Articles
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

        {{-- First article — featured large --}}
        <a href="{{ route('news.show', 'sample-article') }}"
            class="block group card-lift rounded-3xl overflow-hidden border border-[var(--border)] bg-white">
            <div class="md:flex">
                <div class="md:w-1/2 aspect-video md:aspect-auto overflow-hidden bg-gray-100">
                    <img src="{{ $articles[0]['image'] }}" alt="{{ $articles[0]['title'] }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 min-h-[220px]">
                </div>
                <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="text-[9px] font-black uppercase tracking-widest text-[var(--red)] bg-red-50 px-2 py-1 rounded-full">{{ $articles[0]['category'] }}</span>
                        <span class="text-[9px] text-[var(--muted)]">{{ $articles[0]['date'] }}</span>
                        <span class="text-[9px] text-[var(--muted)]">· {{ $articles[0]['read'] }} read</span>
                    </div>
                    <h3 class="serif text-2xl md:text-3xl font-bold text-[var(--text)] group-hover:text-[var(--red)] transition-colors leading-snug">
                        {{ $articles[0]['title'] }}
                    </h3>
                    <p class="text-sm text-[var(--muted)] leading-relaxed font-medium">{{ $articles[0]['excerpt'] }}</p>
                    <span class="inline-flex items-center gap-2 text-xs font-bold text-[var(--red)] mt-2">
                        Read Article
                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                </div>
            </div>
        </a>

        {{-- Remaining 5 articles — grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(array_slice($articles, 1, 5) as $art)
            <a href="{{ route('news.show', 'sample-article') }}"
                class="group bg-white border border-[var(--border)] rounded-3xl overflow-hidden flex flex-col card-lift">
                <div class="aspect-video overflow-hidden bg-gray-100">
                    <img src="{{ $art['image'] }}" alt="{{ $art['title'] }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="flex flex-col flex-1 p-6 space-y-3">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-[8px] font-black uppercase tracking-widest text-[var(--red)] bg-red-50 px-2 py-1 rounded-full">{{ $art['category'] }}</span>
                        <span class="text-[8px] text-[var(--muted)]">{{ $art['date'] }}</span>
                    </div>
                    <h3 class="serif text-base font-bold text-[var(--text)] group-hover:text-[var(--red)] transition-colors leading-snug line-clamp-2">
                        {{ $art['title'] }}
                    </h3>
                    <p class="text-xs text-[var(--muted)] leading-relaxed font-medium line-clamp-2 flex-1">{{ $art['excerpt'] }}</p>
                    <span class="text-[9px] font-bold text-[var(--red)] mt-auto flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        Read more
                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        {{-- View All Button --}}
        <div class="text-center pt-4">
            <a href="{{ route('news.index') }}"
                class="inline-flex items-center gap-3 bg-[var(--navy)] hover:bg-[var(--red)] text-white px-12 py-5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl active:scale-95">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                View All Available Articles
            </a>
        </div>
    </section>

    {{-- ================================================================
     8. FACEBOOK / SOCIAL MEDIA FEED
     ================================================================ --}}
    <section class="reveal space-y-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6 border-b border-[var(--border)]">
            <div class="space-y-2">
                <p class="section-label">Social Media</p>
                <h2 class="serif text-4xl md:text-5xl font-bold text-[var(--text)] leading-none">Facebook Updates</h2>
                <p class="text-sm text-[var(--muted)] font-medium">
                    Follow us on Facebook — posts appear here automatically in real time.
                </p>
            </div>
            <a href="https://www.facebook.com/LagunaProvince" target="_blank" rel="noopener"
                class="inline-flex items-center gap-2 bg-[#1877F2] hover:bg-[#0e5ecb] text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow active:scale-95">
                <svg class="icon-sm" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                </svg>
                Follow on Facebook
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            {{-- Facebook Page Plugin embed --}}
            <div class="fb-feed-card overflow-hidden rounded-3xl shadow-sm" style="min-height: 500px;">
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous"
                    src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0"
                    nonce="pudho_fb">
                </script>
                <div class="fb-page"
                    data-href="https://www.facebook.com/YOUR_PAGE_URL"
                    data-tabs="timeline"
                    data-width="600"
                    data-height="500"
                    data-small-header="false"
                    data-adapt-container-width="true"
                    data-hide-cover="false"
                    data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/YOUR_PAGE_URL" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/YOUR_PAGE_URL">Laguna PUDHO — Facebook Page</a>
                    </blockquote>
                </div>
            </div>

            {{-- Static "pinned" social highlights panel --}}
            <div class="space-y-5">
                <h3 class="text-sm font-black uppercase tracking-widest text-[var(--muted)]">Pinned Updates</h3>

                @php
                $fbPosts = [
                ['date' => 'May 15, 2026', 'img' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?q=80&w=400',
                'text' => 'Successful site validation na! Nagpapasalamat kami sa lahat ng dumalo sa aming Pabahay Pangil Phase 2 site visit ngayon. Inaasahan naming maging maayos ang lahat ng proseso.'],
                ['date' => 'May 10, 2026', 'img' => 'https://images.unsplash.com/photo-1591888741764-28d89b32b32c?q=80&w=400',
                'text' => 'PUDHO joins forces with DHSUD for the 2026 Provincial Housing Forum. Our team presented key updates on the Laguna Urban Development Roadmap.'],
                ['date' => 'May 3, 2026', 'img' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=400',
                'text' => 'Nagbibigay pa rin kami ng libreng konsultasyon sa aming opisina! Mag-drop-in tuwing Lunes–Biyernes, 8AM–5PM. Dalhin ang inyong mga katanungan tungkol sa pabahay.'],
                ];
                @endphp

                @foreach($fbPosts as $post)
                <div class="fb-feed-card p-5 flex gap-4">
                    <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 bg-gray-100">
                        <img src="{{ $post['img'] }}" alt="Facebook post" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0 space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black text-[#1877F2] uppercase tracking-widest">
                                <svg class="icon-sm inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                                </svg>
                                Facebook
                            </span>
                            <span class="text-[9px] text-[var(--muted)]">· {{ $post['date'] }}</span>
                        </div>
                        <p class="text-xs text-[var(--text)] leading-relaxed font-medium line-clamp-3">{{ $post['text'] }}</p>
                    </div>
                </div>
                @endforeach

                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 text-center space-y-3">
                    <svg class="icon-xl text-[#1877F2] mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                    </svg>
                    <p class="text-xs text-[var(--muted)] font-medium">The live feed on the left updates automatically as the office posts on Facebook. No manual updates needed.</p>
                    <a href="https://www.facebook.com/YOUR_PAGE_URL" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-2 text-xs font-bold text-[#1877F2] underline underline-offset-2">
                        Open Facebook Page
                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
     9. PROGRAMS / PROJECT HIGHLIGHTS
     ================================================================ --}}
    <section class="reveal space-y-8">
        <div class="flex items-end justify-between pb-6 border-b border-[var(--border)]">
            <div class="space-y-2">
                <p class="section-label">Our Programs</p>
                <h2 class="serif text-4xl md:text-5xl font-bold text-[var(--text)] leading-none">Current Projects</h2>
            </div>
        </div>

        @php
        $projects = [
        ['title' => 'Pabahay Pangil Phase 2', 'location' => 'Pangil, Laguna', 'status' => 'Ongoing', 'pct' => 65,
        'img' => 'https://images.unsplash.com/photo-1448630360428-65456885c650?q=80&w=800&auto=format&fit=crop'],
        ['title' => 'Santa Rosa Resettlement', 'location' => 'Santa Rosa City', 'status' => 'Completed', 'pct' => 100,
        'img' => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?q=80&w=800&auto=format&fit=crop'],
        ['title' => 'Pagsanjan Urban Renewal', 'location' => 'Pagsanjan, Laguna', 'status' => 'Planning', 'pct' => 20,
        'img' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?q=80&w=800&auto=format&fit=crop'],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($projects as $proj)
            @php
            $statusClass = $proj['status'] === 'Completed'
            ? 'bg-green-100 text-green-700'
            : ($proj['status'] === 'Ongoing' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700');
            @endphp
            <div class="group bg-white border border-[var(--border)] rounded-3xl overflow-hidden card-lift flex flex-col">
                <div class="aspect-video overflow-hidden bg-gray-100">
                    <img src="{{ $proj['img'] }}" alt="{{ $proj['title'] }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="p-6 space-y-4 flex flex-col flex-1">
                    <div class="flex items-center gap-2">
                        <span class="text-[9px] font-black uppercase tracking-widest px-2 py-1 rounded-full {{ $statusClass }}">{{ $proj['status'] }}</span>
                        <span class="text-[9px] text-[var(--muted)] flex items-center gap-1">
                            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $proj['location'] }}
                        </span>
                    </div>
                    <h3 class="serif font-bold text-lg text-[var(--text)] group-hover:text-[var(--red)] transition-colors leading-snug">{{ $proj['title'] }}</h3>
                    <div class="mt-auto space-y-1.5">
                        <div class="flex justify-between text-[9px] font-bold uppercase tracking-widest text-[var(--muted)]">
                            <span>Progress</span><span>{{ $proj['pct'] }}%</span>
                        </div>
                        <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full {{ $proj['pct'] === 100 ? 'bg-green-500' : 'bg-[var(--red)]' }} transition-all duration-1000"
                                style="width: {{ $proj['pct'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ================================================================
     10. CONTACT / OFFICE INFO + MAP PLACEHOLDER
     ================================================================ --}}
    <section class="reveal grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-[var(--cream)] border border-[var(--border)] rounded-3xl p-10 space-y-8">
            <div class="space-y-2">
                <p class="section-label">Get In Touch</p>
                <h2 class="serif text-3xl font-bold text-[var(--text)]">Contact Us</h2>
            </div>
            <div class="space-y-5">
                @php
                $contacts = [
                ['icon' => 'location-dot', 'label' => 'Address',
                'value' => 'Provincial Capitol Compound, Brgy. Poblacion, Sta. Cruz, Laguna'],
                ['icon' => 'phone', 'label' => 'Phone', 'value' => '(049) 501-0000'],
                ['icon' => 'envelope', 'label' => 'Email', 'value' => 'pudho@laguna.gov.ph'],
                ['icon' => 'clock', 'label' => 'Office Hours', 'value' => 'Monday – Friday, 8:00 AM – 5:00 PM'],
                ];
                @endphp
                @foreach($contacts as $c)
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[var(--red)] flex items-center justify-center flex-shrink-0">
                        <svg class="icon-md text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($c['icon'] == 'location-dot')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            @elseif($c['icon'] == 'phone')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            @elseif($c['icon'] == 'envelope')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            @elseif($c['icon'] == 'clock')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            @endif
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-widest text-[var(--muted)]">{{ $c['label'] }}</p>
                        <p class="text-sm font-semibold text-[var(--text)] leading-snug mt-0.5">{{ $c['value'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex gap-3 pt-2">
                <a href="mailto:pudho@laguna.gov.ph"
                    class="flex-1 flex items-center justify-center gap-2 bg-[var(--navy)] hover:bg-[var(--red)] text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95">
                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Email Us
                </a>
                <a href="tel:+63495010000"
                    class="flex-1 flex items-center justify-center gap-2 bg-white border border-[var(--border)] hover:border-[var(--red)] text-[var(--text)] hover:text-[var(--red)] py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95">
                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call Now
                </a>
            </div>
        </div>

        {{-- Google Maps embed placeholder --}}
        <div class="rounded-3xl overflow-hidden border border-[var(--border)] shadow-sm min-h-[380px] bg-gray-100 relative">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.2!2d121.4163!3d14.2765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTTCsDE2JzM1LjQiTiAxMjHCsDI0JzU4LjciRQ!5e0!3m2!1sen!2sph!4v1234567890"
                width="100%" height="100%" style="border:0;min-height:380px"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="absolute top-4 left-4 bg-white rounded-xl px-4 py-2 shadow-lg border border-[var(--border)] text-xs font-bold text-[var(--text)]">
                <svg class="icon-sm inline mr-1 text-[var(--red)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Provincial Capitol, Sta. Cruz, Laguna
            </div>
        </div>
    </section>

    {{-- ================================================================
     11. AFFILIATED OFFICES
     ================================================================ --}}
    <section class="reveal bg-[var(--navy)] rounded-[2.5rem] p-12 md:p-20 relative overflow-hidden border border-[var(--navy2)] shadow-2xl">
        <div class="absolute top-0 right-0 w-96 h-96 bg-[var(--red)]/10 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600/5 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="relative z-10 space-y-12">
            <div class="text-center space-y-3">
                <p class="section-label justify-center text-white/40">Our Network</p>
                <h2 class="serif text-3xl font-bold text-white">Affiliated Offices &amp; Partners</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                @foreach(range(1,5) as $i)
                <div class="bg-white/5 backdrop-blur-md rounded-2xl h-28 flex items-center justify-center p-6 border border-white/10 hover:bg-white/15 hover:border-white/30 transition-all cursor-pointer group shadow-lg">
                    <img src="{{ Vite::asset('resources/logos/logo-'.$i.'.png') }}" alt="Office Logo {{ $i }}"
                        class="h-full w-full object-contain grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
     12. TRANSPARENCY / FOI STRIP
     ================================================================ --}}
    <section class="reveal bg-[var(--cream)] border border-[var(--border)] rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-8">
        <div class="flex-shrink-0 w-16 h-16 bg-[var(--gold)] rounded-2xl flex items-center justify-center">
            <svg class="icon-2xl text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 10.33a9.036 9.036 0 00-1.084-1.026 9.036 9.036 0 00-1.084-1.026M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </div>
        <div class="flex-1 space-y-1.5 text-center md:text-left">
            <h3 class="serif font-bold text-xl text-[var(--text)]">Transparency &amp; FOI</h3>
            <p class="text-sm text-[var(--muted)] font-medium">
                In compliance with Executive Order No. 2, s. 2016, the Laguna PUDHO upholds the Freedom of Information policy. Submit requests for government records online.
            </p>
        </div>
        <a href="#"
            class="flex-shrink-0 inline-flex items-center gap-2 bg-[var(--navy)] hover:bg-[var(--red)] text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow active:scale-95 whitespace-nowrap">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Submit FOI Request
        </a>
    </section>

</div>{{-- /pudho-page --}}

{{-- ================================================================
     SCROLL REVEAL — lightweight IntersectionObserver
     ================================================================ --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    });
</script>

@endsection