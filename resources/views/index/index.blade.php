@extends('index.layout')

@section('title', 'Home | Laguna PUDHO')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-12">
    
    <!-- Hero Banner -->
    @php
        $heroSlides = collect($heroSlides ?? [
            [
                'eyebrow' => 'Welcome to Laguna PUDHO',
                'headline' => 'Building sustainable urban communities for better living',
                'description' => 'Transforming provincial urban development through inclusive planning, housing support, and community-centered services.',
                'button_text' => 'Learn More',
                'button_url' => route('iabout'),
                'bg_class' => 'bg-[radial-gradient(circle_at_center,_rgba(248,113,113,0.6),_rgba(153,27,27,0.9))]',
                'eyebrow_class' => 'text-red-200',
                'image' => 'resources/slide1.jpg',
            ],
            [
                'eyebrow' => 'Service Excellence',
                'headline' => 'Committed to efficient and responsive public service',
                'description' => 'Providing clear guidance, timely assistance, and meaningful urban development initiatives for local communities.',
                'button_text' => 'Learn More',
                'button_url' => route('iabout'),
                'bg_class' => 'bg-[radial-gradient(circle_at_center,_rgba(59,130,246,0.6),_rgba(30,58,138,0.9))]',
                'eyebrow_class' => 'text-sky-200',
                'image' => 'resources/slide2.jpg',
            ],
            [
                'eyebrow' => 'Community Driven',
                'headline' => 'Supporting inclusive growth and stronger neighborhoods',
                'description' => 'Driving local progress with sustainable housing, urban design, and neighborhood revitalization.',
                'button_text' => 'Learn More',
                'button_url' => route('iabout'),
                'bg_class' => 'bg-[radial-gradient(circle_at_center,_rgba(34,197,94,0.6),_rgba(4,120,87,0.9))]',
                'eyebrow_class' => 'text-emerald-200',
                'image' => 'resources/slide3.jpg',
            ],
        ])->map(function ($slide) {
            return [
                'eyebrow' => data_get($slide, 'eyebrow', data_get($slide, 'title', '')),
                'headline' => data_get($slide, 'headline', ''),
                'description' => data_get($slide, 'description', ''),
                'button_text' => data_get($slide, 'button_text', data_get($slide, 'button_label', 'Learn More')),
                'button_url' => data_get($slide, 'button_url', data_get($slide, 'button_link', route('iabout'))),
                'bg_class' => data_get($slide, 'bg_class', 'bg-[radial-gradient(circle_at_center,_rgba(248,113,113,0.6),_rgba(153,27,27,0.9))]'),
                'eyebrow_class' => data_get($slide, 'eyebrow_class', 'text-red-200'),
                'image' => data_get($slide, 'image', 'resources/slide1.jpg'),
            ];
        })->all();
    @endphp

    <section class="relative bg-gray-900 rounded-2xl overflow-hidden aspect-[21/7]">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative h-full overflow-hidden">
            <div id="heroSlider" class="flex h-full transition-transform duration-700" style="transform: translateX(0%);">
                @foreach($heroSlides as $slide)
                <div class="min-w-full h-full">
                    <img src="{{ asset($slide['image']) }}" class="w-full h-full object-cover" alt="{{ $slide['headline'] }}">
                </div>
                @endforeach
            </div>
        </div>

        <button id="heroPrev" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-all shadow-lg shadow-black/20">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button id="heroNext" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-all shadow-lg shadow-black/20">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
            @foreach($heroSlides as $index => $slide)
            <button data-index="{{ $index }}" class="hero-dot h-3 w-3 rounded-full {{ $index === 0 ? 'bg-white/90' : 'bg-white/40' }} ring-white hover:bg-white/80"></button>
            @endforeach
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('heroSlider');
            const dots = Array.from(document.querySelectorAll('.hero-dot'));
            const prevBtn = document.getElementById('heroPrev');
            const nextBtn = document.getElementById('heroNext');
            if (!slider || dots.length === 0 || !prevBtn || !nextBtn) {
                return;
            }

            let currentIndex = 0;
            const slideCount = dots.length;

            function updateSlider(index) {
                currentIndex = (index + slideCount) % slideCount;
                slider.style.transform = `translateX(-${currentIndex * 100}%)`;
                dots.forEach((dot, idx) => {
                    dot.classList.toggle('bg-white/90', idx === currentIndex);
                    dot.classList.toggle('bg-white/40', idx !== currentIndex);
                });
            }

            prevBtn.addEventListener('click', () => updateSlider(currentIndex - 1));
            nextBtn.addEventListener('click', () => updateSlider(currentIndex + 1));
            dots.forEach(dot => dot.addEventListener('click', () => updateSlider(parseInt(dot.dataset.index, 10))));

            updateSlider(0);
            let autoSlide = setInterval(() => updateSlider(currentIndex + 1), 6000);
            [prevBtn, nextBtn, ...dots].forEach(item => item.addEventListener('click', () => {
                clearInterval(autoSlide);
                autoSlide = setInterval(() => updateSlider(currentIndex + 1), 6000);
            }));
        });
    </script>

    <!-- Announcement & Latest News -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
        <!-- Announcement -->
        <div class="lg:col-span-2 space-y-4 h-full">
            <div class="flex items-center gap-4">
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest bg-gray-200 px-3 py-1 rounded">Announcement</h2>
                <div class="h-px bg-red-200 flex-grow"></div>
            </div>
            <div class="bg-gray-100 rounded-xl overflow-hidden border border-gray-200 h-full">
                <img src="{{ Vite::asset('resources/images/announcement-1.png') }}" alt="Announcement" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Latest News -->
        <div class="space-y-4 h-full">
            <div class="flex items-center gap-4">
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest bg-gray-200 px-3 py-1 rounded">Latest News</h2>
                <div class="h-px bg-red-200 flex-grow"></div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4 space-y-4 h-full flex flex-col">
                <div class="flex justify-end">
                    <button class="text-[10px] font-bold text-gray-600 uppercase tracking-widest border border-gray-300 px-4 py-1.5 rounded-full hover:bg-gray-50 transition-colors">View all</button>
                </div>
                
                <!-- News Items -->
                @php
                    $articles = [
                        [
                            'id' => 1,
                            'title' => 'Likhang Sining: Simbolo ng Pag-ibig at Dakilang Layunin',
                            'description' => 'Ano nga ba para sa inyo ang kahulugan ng tunay na pag-ibig? Marahil ang pag-ibig sa kapwa ay siyang pinakadakilang...',
                            'excerpt' => 'Ano nga ba para sa inyo ang kahulugan ng tunay na pag-ibig? Marahil ang pag-ibig sa kapwa ay siyang pinakadakilang...',
                            'date' => 'February 14, 2026',
                            'author' => 'PUDHO Staff',
                            'category' => 'Community',
                            'tags' => ['#AkayniGobActionCenter', '#GobyernongMaySolusyon', '#GobSolAragones', '#SOLidLaguna', '#pudholaguna'],
                            'content' => 'Ano nga ba para sa inyo ang kahulugan ng tunay na pag-ibig? Marahil ang pag-ibig sa kapwa ay siyang pinakadakilang demonstrasyon ng pagmamahal, hindi nasusukat kusa mo itong maipapahiwatig at mararamdaman.

Sa obra maestra na ipinagkaloob ni Architect Al Casabuena sa ating Provincial Urban Development and Housing Action Officer Mamerto A. Punio ay dama ang dakilang layunin ng pag-ibig sa kapwa na maisakatuparan ang dalawang program proposals sa ilalim ng Gobyernong May Solusyon, ang Ten-Year Sustainable Resettlement Program for Informal Settlers Families (ISF\'s) at Akay Pabahay na inklusibo ang 24 na munisipalidad at 6 na siyudad sa ating mahal na lalawigan.

Sa ganitong pagkilala, tunay po na patuloy itong tatanawin at magiging inspirasyon upang maabot ang mga minimithing abot kayang pabahay para sa mga Lagunenses.

"𝓜𝓪𝔂 𝓜𝓪𝓵𝓪𝓼𝓪𝓴𝓲𝓽, 𝓐𝓴𝓼𝔂𝓸𝓷 𝓪𝓽 𝓟𝓪𝓷𝓲𝓷𝓲𝓷𝓭𝓲𝓰𝓪𝓷: 𝓣𝓪𝓽𝓪𝓴 𝓷𝓰 𝓲𝓼𝓪𝓷𝓰 𝓖𝓸𝓫𝔂𝓮𝓻𝓷𝓸𝓷𝓰 𝓶𝓪𝔂 𝓢𝓸𝓵𝓾𝓼𝔂𝓸𝓷!"',
                            'url' => '#',
                            'image' => '/news/article-1.jpg',
                        ],
                        [
                            'id' => 2,
                            'title' => 'Serbisyong May Malasakit: Programang Pabahay para sa mga ISF ng Bayan ng Pangil',
                            'description' => 'Isinagawa nitong Pebrero 11, 2026, sa opisina ng Punong Bayan ng Pangil ang courtesy visit sa pangunguna ni G. Mamerto A. Punio, Action Officer for Urban Development and Housing...',
                            'excerpt' => 'Isinagawa nitong Pebrero 11, 2026, sa opisina ng Punong Bayan ng Pangil ang courtesy visit sa pangunguna ni G. Mamerto A. Punio, Action Officer for Urban Development and Housing...',
                            'date' => 'February 11, 2026',
                            'author' => 'PUDHO Staff',
                            'category' => 'Housing',
                            'tags' => ['#AkayniGobActionCenter', '#GobyernongMaySolusyon', '#GobSolAragones', '#SOLidLaguna', '#pudholaguna'],
                            'content' => 'Isinagawa nitong Pebrero 11, 2026, sa opisina ng Punong Bayan ng Pangil ang courtesy visit sa pangunguna ni G. Mamerto A. Punio, Action Officer for Urban Development and Housing, kasama sina G. Zolan T. Bernardino, District IV-B Housing Coordinator, at Bb. Maria Susan M. Pascual, District IV-B Technical. Malugod ang naging pagtanggap ng mga opisyal ng Pamahalaang Bayan ng Pangil sa pangunguna ni Kgg. Gerald A. Aritao, Punong Bayan, kasama sina G. Eugene Reniva, Municipal Administrator, Engr. Vinzon David Valois, Bb. Judelie Dalit, at Bb. May Cosico.

Sa isinagawang talakayan, inilahad ang mga pangunahing programa ng Gobyernong May Solusyon, kabilang ang Akay Pabahay Program at ang 10-Year Sustainable Resettlement Program for Informal Settler Families (ISF). Layunin ng mga programang ito na magbigay ng agarang tulong sa pabahay at pangmatagalang solusyon sa paninirahan ng mga informal settlers sa pamamagitan ng maayos at planadong resettlement. Natalakay din ang pagsasagawa ng pagpupulong ng Local Housing Board na ang layunin ay upang mapalakas ang suporta at koordinasyon sa implementasyon ng mga programang pabahay sa lokal na antas.

"𝓜𝓪𝓵𝓪𝓼𝓪𝓴𝓲𝓽, 𝓐𝓴𝓼𝔂𝓸𝓷 𝓪𝓽 𝓟𝓪𝓷𝓲𝓷𝓲𝓷𝓭𝓲𝓰𝓪𝓷: 𝓣𝓪𝓽𝓪𝓴 𝓷𝓰 𝓲𝓼𝓪𝓷𝓰 𝓖𝓸𝓫𝔂𝓮𝓻𝓷𝓸𝓷𝓰 𝓶𝓪𝔂 𝓢𝓸𝓵𝓾𝓼𝔂𝓸𝓷!"',
                            'url' => '#',
                            'image' => '/news/article-2.jpg',
                        ],
                        [
                            'id' => 3,
                            'title' => 'Tuluy-Tuloy na Ugnayan, Tiyak na Pabahay!',
                            'description' => 'Ang palagiang koordinasyon at malinaw na komunikasyon sa pagitan ng mga ahensya sa pabahay, tulad ng National Housing Authority (NHA) Region IV-A – Laguna District Office at ng...',
                            'excerpt' => 'Ang palagiang koordinasyon at malinaw na komunikasyon sa pagitan ng mga ahensya sa pabahay, tulad ng National Housing Authority (NHA) Region IV-A – Laguna District Office at ng...',
                            'date' => 'February 5, 2026',
                            'author' => 'PUDHO Staff',
                            'category' => 'Housing',
                            'tags' => ['#AkayniGobActionCenter', '#GobyernongMaySolusyon', '#GobSolAragones', '#SOLidLaguna'],
                            'content' => 'Ang palagiang koordinasyon at malinaw na komunikasyon sa pagitan ng mga ahensya sa pabahay, tulad ng National Housing Authority (NHA) Region IV-A – Laguna District Office at ng City Urban Development and Housing Affairs Office (CUDHAO), siyudad ng Cabuyao ay mahalagang pundasyon sa matagumpay na pagpapatupad ng dalawang pangunahing programa ng Gobyernong May Solusyon sa Lalawigan ng Laguna: ang Akay Pabahay at ang Ten-Year Sustainable Resettlement Program for Informal Settlers.

Sa tulong ng Housing Coordinators na sina Floi Daniel C. Barrientos, miyembro ng Technical and Special Project Unit at Crispina L. Manrique, Presidente ng HOA Federation sa Cabuyao, pinangunahan ni Action Officer Mamerto A. Punio, nitong Pebrero 3, 2026 ay mas malinaw at organisadong naiparating ang mahahalagang program proposals para sa pabahay ng ating mga kababayan.

Lubos ang aming pasasalamat sa patuloy at bukas na suporta ng NHA Region IV-A at ng City Urban Development and Housing Affairs Office, sa pamumuno ni Engr. Nathaniel F. Dela, RMEE, OIC CUDHAO, kasama si Senior Administrative Assistant II, HOA Focal Person Rhea A. Jastillana, sa kanilang walang sawang pakikiisa para sa iisang layunin— matiyak ang ligtas, maayos, at pangmatagalang pabahay para sa bawat pamilyang Lagunense. Sa sama-samang pagkilos, ang pabahay ay hindi na pangarap—kundi isang realidad.

"𝓜𝓪𝓵𝓪𝓼𝓪𝓴𝓲𝓽, 𝓐𝓴𝓼𝔂𝓸𝓷 𝓪𝓽 𝓟𝓪𝓷𝓲𝓷𝓲𝓷𝓭𝓲𝓰𝓪𝓷: 𝓣𝓪𝓽𝓪𝓴 𝓷𝓰 𝓲𝓼𝓪𝓷𝓰 𝓖𝓸𝓫𝔂𝓮𝓻𝓷𝓸𝓷𝓰 𝓶𝓪𝔂 𝓢𝓸𝓵𝓾𝓼𝔂𝓸𝓷!"',
                            'url' => '#',
                            'image' => '/news/article-3.jpg',
                        ],
                        [
                            'id' => 4,
                            'title' => 'SA CABUYAO NA ANG SUSUNOD NA HAKBANG MO!',
                            'description' => 'Hindi na lamang dating bayan ang Lungsod ng Cabuyao, ito na ngayon ay isang FIRST-CLASS CITY, ang pinakabagong sentro ng industriya ng pabahay sa CALABARZON...',
                            'excerpt' => 'Hindi na lamang dating bayan ang Lungsod ng Cabuyao, ito na ngayon ay isang FIRST-CLASS CITY, ang pinakabagong sentro ng industriya ng pabahay sa CALABARZON...',
                            'date' => 'January 28, 2026',
                            'author' => 'PUDHO Staff',
                            'category' => 'Development',
                            'tags' => ['#AkayniGobActionCenter', '#GobyernongMaySolusyon', '#GobSolAragones', '#SOLidLaguna'],
                            'content' => 'Hindi na lamang dating bayan ang Lungsod ng Cabuyao, ito na ngayon ay isang FIRST-CLASS CITY, ang pinakabagong sentro ng industriya ng pabahay sa CALABARZON, puno ng mga oportunidad, trabaho at abot-kayang tahanan!

Kaakibat ng patuloy na pag-unlad, ang social responsibility alinsunod dito ang Provincial Urban Development and Housing Office ay magalang na nagtungo sa City Hall ng Cabuyao nitong Pebrero 3, 2026, para sa "courtesy visit" at malugod na napa-unlakan ni Vice Mayor James Onofre D. Batallones sa ngalan ni Mayor Dennis Felipe C. Hain kasama ang lahat ng bumubuo ng Sangguniang Panglungsod ng Cabuyao.

Sa malayang talakayan, nailahad ng ating Action Officer Mamerto A. Punio kaakay sina Housing Coordinators Floi Daniel C. Barrientos Technical and Special Project Unit member, at Gng. Crispina L. Manrique, Presidente ng Homeowners Federation ng Cabuyao, ang flagship programs ng Gobyernong May Solusyon ang Akay Pabahay at Ten-Year Sustainable Resettlement Program for Informal Settler Families (ISF) at magalang din na hiniling na ito ay maipaliwanag sa susunod na schedule ng Housing Board ng siyudad.

Sa lahat ng ito, patunay na ang Cabuyao ay hindi lamang umaasenso bilang lungsod, ito rin ay isang lugar na tunay na nag-aalaga sa kinabukasan ng kanyang mamamayan.

"𝓜𝓪𝔂 𝓜𝓪𝓵𝓪𝓼𝓪𝓴𝓲𝓽, 𝓐𝓴𝓼𝔂𝓸𝓷 𝓪𝓽 𝓟𝓪𝓷𝓲𝓷𝓲𝓷𝓭𝓲𝓰𝓪𝓷: 𝓣𝓪𝓽𝓪𝓴 𝓷𝓰 𝓲𝓼𝓪𝓷𝓰 𝓖𝓸𝓫𝔂𝓮𝓻𝓷𝓸𝓷𝓰 𝓶𝓪𝔂 𝓢𝓸𝓵𝓾𝓼𝔂𝓸𝓷!"',
                            'url' => '#',
                            'image' => '/news/article-4.jpg',
                        ],
                    ];
                @endphp
                    @foreach($articles as $article)
                    <div class="flex gap-4 group cursor-pointer">
                        <div class="h-20 w-20 bg-gray-100 rounded-lg shrink-0 flex items-center justify-center overflow-hidden border border-gray-200 group-hover:border-red-200 transition-colors">
                            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover" />
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-red-900 transition-colors">{{ $article['title'] }}</h3>
                            <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed">{{ $article['description'] }}</p>
                            <a href="{{ $article['url'] }}" class="text-[10px] font-bold text-red-600 uppercase tracking-widest flex items-center gap-1 hover:gap-2 transition-all">
                                Read Now
                                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                            </a>
                        </div>
                    </div>
                    @if(!$loop->last) <div class="h-px bg-gray-100"></div> @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="bg-gray-100 rounded-2xl p-8 md:p-12 border border-gray-200 relative overflow-hidden">
        <div class="max-w-3xl space-y-6 relative z-10">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">The</p>
                <h2 class="text-2xl md:text-3xl font-extrabold text-red-900 uppercase leading-tight tracking-tighter">
                    Provincial Urban Development<br>& Housing Office
                </h2>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed max-w-2xl">
                is in charge of various lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat sed magna eget molestie. Integer lacinia ornare pellentesque. Mauris sed justo aliquam, euismod sapien in, tristique nulla. Praesent a interdum sapien. Proin in imperdiet risus.
            </p>
            <a href="{{ route('iabout') }}" class="inline-block bg-red-700 hover:bg-red-800 text-white px-8 py-3 rounded-lg text-sm font-bold uppercase tracking-widest transition-all shadow-lg shadow-red-900/20 active:scale-95">
                Learn More
            </a>
        </div>
        <!-- Decorative Icon -->
        <div class="absolute right-12 top-1/2 -translate-y-1/2 opacity-10 hidden lg:block">
            <i class="fa-solid fa-building-shield text-[12rem]"></i>
        </div>
    </section>

    <!-- Our Services -->
    <section class="space-y-12 py-8">
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <h2 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">Our Services</h2>
            <p class="text-sm text-gray-500 leading-relaxed font-medium">
                The Provincial Urban Development and Housing Office shall be the primary lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat sed magna eget molestie. Integer lacinia ornare pellentesque. Mauris sed justo aliquam, euismod sapien in, tristique nulla. Praesent a interdum sapien. Proin in imperdiet risus.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(['Service #1', 'Service #2', 'Service #3'] as $service)
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden group hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center border-b border-gray-100">
                    <i class="fa-solid fa-house-chimney-user text-6xl text-gray-200 group-hover:text-red-100 transition-colors"></i>
                </div>
                <div class="p-6 space-y-3 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">{{ $service }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat sed magna eget molestie.
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Affiliated Offices -->
    <section class="bg-gray-100 rounded-3xl p-10 border border-gray-200 space-y-10">
        <h2 class="text-xl font-extrabold text-gray-900 uppercase tracking-widest text-center">Affiliated Offices</h2>
         {{-- First row: 3 items --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
        @foreach(range(1, 3) as $i)
        <div class="bg-white rounded-xl h-24 flex items-center justify-center border border-gray-200 hover:border-red-200 transition-colors cursor-pointer group overflow-hidden">
            <img src="{{ Vite::asset('resources/logos/logo-'.$i.'.png') }}" alt="Office Logo {{ $i }}" class="h-full w-full object-contain p-1 bg-white" />
        </div>
        @endforeach
    </div>

    {{-- Second row: 2 items centered --}}
    <div class="grid grid-cols-2 gap-6 md:w-2/3 mx-auto">
        @foreach(range(4, 5) as $i)
        <div class="bg-white rounded-xl h-24 flex items-center justify-center border border-gray-200 hover:border-red-200 transition-colors cursor-pointer group overflow-hidden">
            <img src="{{ Vite::asset('resources/logos/logo-'.$i.'.png') }}" alt="Office Logo {{ $i }}" class="h-full w-full object-contain p-1 bg-white" />
        </div>
        @endforeach
    </div>
    </section>

</div>
@endsection
