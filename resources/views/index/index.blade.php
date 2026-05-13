@extends('index.layout')

@section('title', 'Home | Laguna PUDHO')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-12">
    
@php
    $heroSlides = [
        [
            'eyebrow'     => 'Welcome to Laguna PUDHO',
            'headline'    => 'Building sustainable urban communities',
            'description' => 'Transforming provincial urban development through inclusive planning, housing support, and community-centered services.',
            'image'       => 'https://images.unsplash.com/photo-1449156001935-d28bc3dfae2f?q=80&w=2070&auto=format&fit=crop',
        ],
        [
            'eyebrow'     => 'Service Excellence',
            'headline'    => 'Committed to responsive public service',
            'description' => 'Providing clear guidance, timely assistance, and meaningful urban development initiatives for Laguna communities.',
            'image'       => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop',
        ],
        [
            'eyebrow'     => 'Community Driven',
            'headline'    => 'Supporting inclusive neighborhood growth',
            'description' => 'Driving local progress with sustainable housing, urban design, and neighborhood revitalization strategies.',
            'image'       => 'https://images.unsplash.com/photo-1541888946425-d81bb19480c5?q=80&w=2070&auto=format&fit=crop',
        ],
    ];
@endphp

<section class="relative bg-gray-900 rounded-[3.5rem] overflow-hidden aspect-[21/9] lg:aspect-[21/8] shadow-2xl group border border-gray-800 max-h-[90vh]">

    <div id="heroSlider" class="flex h-full transition-transform duration-1000 ease-[cubic-bezier(0.4,0,0.2,1)]">
        @foreach($heroSlides as $slide)
        <div class="min-w-full h-full relative flex-shrink-0">
            <img src="{{ $slide['image'] }}"
                 class="w-full h-full object-cover brightness-[0.6]"
                 alt="{{ $slide['headline'] }}"
                 loading="lazy">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(220,38,38,0.2),_transparent)]"></div>

            <div class="absolute inset-0 flex items-center overflow-hidden">
                {{-- Fluid padding & max-width keeps text from touching edges --}}
                <div class="px-[clamp(1.25rem,5vw,6rem)] max-w-[min(56rem,90%)] flex flex-col overflow-hidden"
                     style="gap: clamp(0.4rem, 1.2vw, 1.5rem)">

                    {{-- Eyebrow --}}
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <span class="w-2 h-2 rounded-full bg-red-600 flex-shrink-0"></span>
                        <span class="text-white font-black uppercase tracking-[0.35em] truncate drop-shadow-lg"
                              style="font-size: clamp(8px, 1vw, 11px)">
                            {{ $slide['eyebrow'] }}
                        </span>
                    </div>

                    {{-- Headline — clamps to 3 lines max --}}
                    <h1 class="font-black text-white uppercase drop-shadow-2xl flex-shrink-0"
                        style="font-size: clamp(1.4rem, 4.5vw, 4.5rem);
                               line-height: 1.05;
                               letter-spacing: -0.03em;
                               display: -webkit-box;
                               -webkit-line-clamp: 3;
                               -webkit-box-orient: vertical;
                               overflow: hidden;">
                        {{ $slide['headline'] }}
                    </h1>

                    {{-- Description — clamps to 2 lines max --}}
                    <p class="text-gray-300 font-medium leading-relaxed drop-shadow-lg flex-shrink-0"
                       style="font-size: clamp(0.7rem, 1.5vw, 1.2rem);
                              display: -webkit-box;
                              -webkit-line-clamp: 2;
                              -webkit-box-orient: vertical;
                              overflow: hidden;">
                        {{ $slide['description'] }}
                    </p>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Progress bar --}}
    <div id="heroProgress" class="absolute bottom-0 left-0 h-[3px] bg-red-600 z-20" style="width:0%"></div>

    {{-- Prev / Next --}}
    <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-4 pointer-events-none">
        <button id="heroPrev"
                aria-label="Previous slide"
                class="pointer-events-auto flex items-center justify-center bg-white/10 hover:bg-white/30 backdrop-blur-md rounded-full text-white transition-all -translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 shadow-xl"
                style="width: clamp(2rem,4vw,3rem); height: clamp(2rem,4vw,3rem); font-size: clamp(12px,1.5vw,16px)">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button id="heroNext"
                aria-label="Next slide"
                class="pointer-events-auto flex items-center justify-center bg-white/10 hover:bg-white/30 backdrop-blur-md rounded-full text-white transition-all translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 shadow-xl"
                style="width: clamp(2rem,4vw,3rem); height: clamp(2rem,4vw,3rem); font-size: clamp(12px,1.5vw,16px)">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    {{-- Dot indicators --}}
    <div class="absolute z-30 flex gap-2"
         style="bottom: clamp(0.75rem,2vw,1.5rem); right: clamp(1rem,3vw,2rem)">
        @foreach($heroSlides as $index => $slide)
        <button data-index="{{ $index }}"
                aria-label="Go to slide {{ $index + 1 }}"
                class="hero-dot h-[3px] rounded-full bg-white/30 hover:bg-white/60 transition-all border-0 p-0
                       {{ $index === 0 ? '!bg-white !w-10' : 'w-6' }}"></button>
        @endforeach
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slider   = document.getElementById('heroSlider');
    const dots     = Array.from(document.querySelectorAll('.hero-dot'));
    const prevBtn  = document.getElementById('heroPrev');
    const nextBtn  = document.getElementById('heroNext');
    const progress = document.getElementById('heroProgress');

    if (!slider || !dots.length) return;

    let cur = 0;
    const total = dots.length;
    let timer;

    function startProgress() {
        progress.style.transition = 'none';
        progress.style.width = '0%';
        requestAnimationFrame(() => requestAnimationFrame(() => {
            progress.style.transition = 'width 6000ms linear';
            progress.style.width = '100%';
        }));
    }

    function goTo(idx) {
        cur = (idx + total) % total;
        slider.style.transform = `translateX(-${cur * 100}%)`;
        dots.forEach((d, i) => {
            d.classList.toggle('!bg-white', i === cur);
            d.classList.toggle('!w-10',    i === cur);
            d.classList.toggle('bg-white/30', i !== cur);
            d.classList.toggle('w-6',      i !== cur);
        });
        startProgress();
    }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(() => goTo(cur + 1), 6000);
    }

    prevBtn?.addEventListener('click', () => { goTo(cur - 1); resetTimer(); });
    nextBtn?.addEventListener('click', () => { goTo(cur + 1); resetTimer(); });
    dots.forEach(d => d.addEventListener('click', () => { goTo(+d.dataset.index); resetTimer(); }));

    goTo(0);
    resetTimer();
});
</script>

    <!-- Announcement & Latest News -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
        <!-- Announcement -->
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center gap-4">
                <h2 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.3em] bg-red-50 text-red-600 px-3 py-1.5 rounded-lg border border-red-100">Announcement</h2>
                <div class="h-px bg-gray-100 flex-grow"></div>
            </div>
            <div class="group bg-white rounded-[3.5rem] overflow-hidden border border-gray-200 shadow-sm hover:shadow-[0_32px_64px_-16px_rgba(220,38,38,0.1)] transition-all duration-700">
                <div class="aspect-video relative overflow-hidden bg-gray-50">
                    <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?q=80&w=2070&auto=format&fit=crop" alt="Announcement" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <p class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-2">Featured Project</p>
                        <h3 class="text-2xl font-black text-white uppercase tracking-tight">New Residential Development Phase 1</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest News -->
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <h2 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.3em] bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200">Latest News</h2>
                <div class="h-px bg-gray-100 flex-grow"></div>
            </div>
            <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 space-y-8 flex flex-col shadow-sm hover:shadow-xl transition-all duration-500">
                @php
                    $articles = [
                        [
                            'id' => 1,
                            'title' => 'Likhang Sining: Simbolo ng Pag-ibig at Dakilang Layunin',
                            'description' => 'Ano nga ba para sa inyo ang kahulugan ng tunay na pag-ibig? Marahil ang pag-ibig sa kapwa ay siyang pinakadakilang...',
                            'date' => 'Feb 14, 2026',
                            'category' => 'Community',
                            'image' => 'https://images.unsplash.com/photo-1517732359359-61316527af7d?q=80&w=800&auto=format&fit=crop',
                        ],
                        [
                            'id' => 2,
                            'title' => 'Serbisyong May Malasakit: Programang Pabahay Pangil',
                            'description' => 'Isinagawa nitong Pebrero 11, 2026, sa opisina ng Punong Bayan ng Pangil ang courtesy visit...',
                            'date' => 'Feb 11, 2026',
                            'category' => 'Housing',
                            'image' => 'https://images.unsplash.com/photo-1593011394396-85750873449e?q=80&w=800&auto=format&fit=crop',
                        ],
                        [
                            'id' => 3,
                            'title' => 'Tuluy-Tuloy na Ugnayan, Tiyak na Pabahay!',
                            'description' => 'Ang palagiang koordinasyon at malinaw na komunikasyon sa pagitan ng mga ahensya sa pabahay...',
                            'date' => 'Feb 05, 2026',
                            'category' => 'Housing',
                            'image' => 'https://images.unsplash.com/photo-1473186578172-c141e6798ee4?q=80&w=800&auto=format&fit=crop',
                        ],
                    ];
                @endphp
                
                <div class="space-y-8 flex-grow">
                    @foreach($articles as $article)
                    <a href="{{ route('news.show', 'sample-article') }}" class="flex gap-5 group">
                        <div class="h-24 w-24 bg-gray-50 rounded-2xl shrink-0 overflow-hidden border border-gray-100 group-hover:border-red-200 transition-all shadow-sm">
                            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-700" />
                        </div>
                        <div class="space-y-2 py-1">
                            <div class="flex items-center gap-3">
                                <span class="text-[8px] font-black uppercase tracking-widest text-red-600 bg-red-50 px-2 py-1 rounded">{{ $article['category'] }}</span>
                                <span class="text-[8px] font-black text-gray-300 uppercase tracking-widest">{{ $article['date'] }}</span>
                            </div>
                            <h3 class="text-sm font-black text-gray-900 group-hover:text-red-700 transition-colors line-clamp-2 leading-tight uppercase tracking-tight">{{ $article['title'] }}</h3>
                        </div>
                    </a>
                    @if(!$loop->last) <div class="h-px bg-gray-50"></div> @endif
                    @endforeach
                </div>

                <div class="pt-4 mt-auto">
                    <a href="{{ route('news.index') }}" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg active:scale-95">
                        View All News <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section Optimized -->
    <section class="bg-gray-50 rounded-[3rem] p-10 md:p-16 border border-gray-200 relative overflow-hidden group">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-red-600/5 blur-[100px] rounded-full group-hover:bg-red-600/10 transition-colors duration-1000"></div>
        <div class="max-w-3xl space-y-8 relative z-10">
            <div class="space-y-2">
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] block">Office Overview</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 uppercase leading-none tracking-tighter">
                    Provincial <span class="text-red-700">Urban</span><br>Development & Housing
                </h2>
            </div>
            <p class="text-base text-gray-600 leading-relaxed max-w-2xl font-medium">
                The Provincial Urban Development and Housing Office is in charge of various initiatives aimed at providing decent and affordable housing units for low-income Lagunenses, ensuring sustainable urban growth across the province.
            </p>
            <div class="flex items-center gap-6">
                <a href="{{ route('iabout') }}" class="inline-flex items-center gap-3 bg-red-700 hover:bg-red-800 text-white px-10 py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-2xl shadow-red-900/20 active:scale-95">
                    About Our Office <i class="fa-solid fa-circle-info"></i>
                </a>
            </div>
        </div>
        
        <div class="absolute right-16 top-1/2 -translate-y-1/2 opacity-[0.03] hidden lg:block group-hover:scale-110 group-hover:opacity-[0.05] transition-all duration-1000 pointer-events-none">
            <i class="fa-solid fa-building-shield text-[18rem]"></i>
        </div>
    </section>

    <!-- Services Grid Optimized -->
    <section class="space-y-16 py-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-gray-100 pb-8">
            <div class="space-y-3">
                <h2 class="text-5xl font-black text-gray-900 uppercase tracking-tighter">Our Services</h2>
                <p class="text-sm font-medium text-gray-500 max-w-xl">
                    Comprehensive housing and urban development services designed specifically for the needs of our provincial residents.
                </p>
            </div>
            <a href="{{ route('iservices') }}" class="text-[10px] font-black text-red-600 uppercase tracking-widest flex items-center gap-2 hover:gap-3 transition-all">
                Browse All Services <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $services = [
                    ['title' => 'Housing Assistance', 'icon' => 'fa-house-chimney-user', 'desc' => 'Providing guidance and support for housing applications and resettlement programs.'],
                    ['title' => 'Urban Planning', 'icon' => 'fa-city', 'desc' => 'Designing sustainable urban frameworks for growing communities across Laguna.'],
                    ['title' => 'Technical Support', 'icon' => 'fa-screwdriver-wrench', 'desc' => 'Offering technical expertise for local housing boards and municipal offices.'],
                ];
            @endphp
            @foreach($services as $service)
            <div class="group bg-white rounded-[2.5rem] border border-gray-200 overflow-hidden hover:shadow-2xl hover:shadow-red-900/5 transition-all duration-500 p-8 flex flex-col items-center text-center space-y-6">
                <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center border border-gray-100 group-hover:bg-red-600 group-hover:border-red-500 group-hover:rotate-6 transition-all duration-500 shadow-sm">
                    <i class="fa-solid {{ $service['icon'] }} text-3xl text-gray-300 group-hover:text-white transition-colors"></i>
                </div>
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-red-700 transition-colors">{{ $service['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                        {{ $service['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Affiliated Offices Optimized -->
    <section class="bg-gray-900 rounded-[3rem] p-12 md:p-20 relative overflow-hidden border border-gray-800 shadow-2xl">
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 blur-[100px] rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600/5 blur-[100px] rounded-full"></div>
        
        <div class="relative z-10 space-y-16">
            <div class="text-center space-y-4">
                <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em]">Our Network</span>
                <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Affiliated Offices</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                @foreach(range(1, 5) as $i)
                <div class="bg-white/5 backdrop-blur-md rounded-2xl h-28 flex items-center justify-center p-6 border border-white/10 hover:bg-white/10 hover:border-white/30 transition-all cursor-pointer group shadow-lg">
                    <img src="{{ Vite::asset('resources/logos/logo-'.$i.'.png') }}" alt="Office Logo {{ $i }}" class="h-full w-full object-contain grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500" />
                </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
@endsection
