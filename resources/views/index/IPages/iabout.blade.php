@extends('index.layout')

@section('title', 'About – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-24">
    
    <!-- Hero Header Section -->
    <div class="relative bg-gray-900 rounded-[3rem] p-12 md:p-20 overflow-hidden shadow-2xl">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(220,38,38,0.15),_transparent)]"></div>
        <div class="relative z-10 text-center space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-red-600/20 border border-red-500/30 rounded-full">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] font-black text-red-200 uppercase tracking-[0.3em]">Province of Laguna</span>
            </div>
            <h1 class="text-4xl md:text-7xl font-black text-white uppercase tracking-tighter leading-none">
                About Our <span class="text-red-500">Office</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-400 font-medium max-w-3xl mx-auto leading-relaxed">
                Provincial Urban Development and Housing Office
            </p>
        </div>
    </div>

    <!-- Main Narrative Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8">
            <div class="space-y-4">
                <div class="h-1 w-20 bg-red-600 rounded-full"></div>
                <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter">Our Mandate &<br>Commitment</h2>
            </div>
            <div class="space-y-6">
                <p class="text-lg text-gray-600 leading-relaxed font-medium">
                    Formerly known as Housing Office, the Provincial Urban Development and Housing Office (PUDHO) is mandated under Republic Act No. 7279 (Urban Development and Housing Act of 1992) to deliver comprehensive and continuing urban development and housing programs by providing affordable and decent housing units for low-income Lagunenses.
                </p>
                <div class="p-8 bg-gray-50 rounded-3xl border-l-4 border-red-600 space-y-4">
                    <p class="text-sm text-gray-500 italic font-medium leading-loose">
                        Former Laguna Governor JOEY D. LINA, JR., the author of RA 7279, envisioned Laguna as a model for pro-poor housing laws. By January 1996, he established an office directly under the Governor to ensure housing programs reached the constituents. PUDHO started with 22 personnel handling 120 homeowners' associations, serving over 92,000 families across the province.
                    </p>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="aspect-square bg-gray-100 rounded-[3rem] overflow-hidden border border-gray-200 shadow-xl group">
                <div class="absolute inset-0 bg-red-900/10 group-hover:bg-transparent transition-colors duration-500"></div>
                <img src="{{ Vite::asset('resources/images/office-building.jpg') }}" alt="Office Header" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800'">
            </div>
            <!-- Decorative Badge -->
            <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-2xl border border-gray-100 hidden md:block">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-600">
                        <i class="fa-solid fa-medal text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Est.</p>
                        <p class="text-lg font-black text-gray-900">Since 1999</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vision & Mission Grid -->
    <div class="bg-gray-50 rounded-[4rem] p-8 md:p-20 border border-gray-100 space-y-20 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/5 blur-[100px] rounded-full"></div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start relative z-10">
            <!-- Vision -->
            <div class="space-y-6 group">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-red-600 shadow-lg border border-gray-100 group-hover:bg-red-600 group-hover:text-white transition-all duration-500 transform group-hover:-rotate-6">
                    <i class="fa-solid fa-eye text-2xl"></i>
                </div>
                <div class="space-y-3">
                    <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Vision</h3>
                    <p class="text-base text-gray-600 leading-relaxed font-medium">
                        “A PROVINCE FREE OF INFORMAL SETTLERS” through the provision of decent and affordable homelots to the poor and homeless Lagunenses.
                    </p>
                </div>
            </div>

            <!-- Logo Center (Desktop Only) -->
            <div class="hidden lg:flex justify-center py-4">
                <div class="relative group">
                    <div class="absolute -inset-8 bg-red-600/10 rounded-full blur-[40px] group-hover:bg-red-600/20 transition-all duration-700 animate-pulse"></div>
                    <div class="relative bg-white p-10 rounded-[3rem] border border-gray-100 shadow-2xl transform hover:scale-110 transition-transform duration-500">
                        <img src="{{ Vite::asset('resources/images/pudho-logo.png') }}" alt="Laguna Seal" class="w-32 h-32 object-contain">
                    </div>
                </div>
            </div>

            <!-- Mission -->
            <div class="space-y-6 group lg:text-right">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-red-600 shadow-lg border border-gray-100 group-hover:bg-red-600 group-hover:text-white transition-all duration-500 transform group-hover:rotate-6 ml-auto">
                    <i class="fa-solid fa-bullseye text-2xl"></i>
                </div>
                <div class="space-y-3">
                    <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Mission</h3>
                    <p class="text-base text-gray-600 leading-relaxed font-medium">
                        To fully implement the Urban Development Act of 1992.
                    </p>
                </div>
            </div>
        </div>

        <!-- Objectives Section -->
        <div class="bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-sm text-center space-y-10 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-b from-red-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            <div class="relative z-10 space-y-8">
                <div class="space-y-2">
                    <p class="text-[10px] font-black text-red-600 uppercase tracking-[0.4em]">Strategy</p>
                    <h3 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">Our Objectives</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-red-200 transition-colors">
                        <p class="text-xs font-bold text-gray-600 leading-relaxed">Institutionalize housing programs by creating Housing Offices in all cities and municipalities of the province.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-red-200 transition-colors">
                        <p class="text-xs font-bold text-gray-600 leading-relaxed">Establish the Provincial Shelter Plan and intensify housing programs through “Responsible Laguna Housing”.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-red-200 transition-colors">
                        <p class="text-xs font-bold text-gray-600 leading-relaxed">Lessens demolition and similar cases through planning and dialogues among LGUs, lot owners and judicial branch.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-red-200 transition-colors md:col-span-2 lg:col-span-1">
                        <p class="text-xs font-bold text-gray-600 leading-relaxed">Generate funds through legal implementation of UDHA 1992 and other province-initiated projects.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-red-100 bg-red-50/30 md:col-span-2 lg:col-span-2">
                        <p class="text-xs font-bold text-red-900 leading-relaxed">Provide decent and affordable housing/homelot units to the poor and low-income Lagunenses.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Values Row -->
        <div class="bg-gray-900 rounded-[2.5rem] p-10 border border-gray-800 shadow-2xl text-center space-y-6 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-r from-red-50/50 via-transparent to-red-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            <div class="relative z-10 space-y-4">
                <h3 class="text-xl font-black text-white uppercase tracking-widest">Our Core Values</h3>
                <div class="flex flex-wrap justify-center gap-4 md:gap-12">
                    @foreach(['Integrity', 'Excellence', 'Compassion', 'Transparency'] as $value)
                    <div class="flex flex-col items-center gap-2">
                        <span class="text-red-500 font-black text-lg md:text-2xl">{{ $value }}</span>
                        <div class="h-1 w-12 bg-gray-800 rounded-full group-hover:bg-red-600 transition-colors"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Disclosure Sections (Accordions) -->
    <div class="space-y-6 max-w-4xl mx-auto">
        <div class="text-center space-y-2 mb-12">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em]">Governance & Data</p>
            <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">Transparency Hub</h2>
        </div>
        
        <!-- News Updates & Accomplishments -->
        <div class="group border border-gray-200 rounded-[2rem] overflow-hidden bg-white hover:border-red-200 hover:shadow-2xl hover:shadow-red-900/5 transition-all duration-300">
            <button class="w-full px-10 py-8 flex items-center justify-between text-left hover:bg-gray-50/50 transition-colors" onclick="toggleAccordion('news-section')">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600">
                        <i class="fa-solid fa-newspaper text-xl"></i>
                    </div>
                    <span class="text-lg font-black text-gray-900 uppercase tracking-tight">News Updates & Accomplishments</span>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 transition-all duration-300" id="news-icon"></i>
            </button>
            <div id="news-section" class="hidden px-10 pb-10 border-t border-gray-50 pt-8 mt-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach(range(1, 4) as $i)
                    <div class="flex gap-6 group/item cursor-pointer p-4 rounded-2xl hover:bg-red-50/50 transition-colors">
                        <div class="h-20 w-20 bg-white rounded-xl shrink-0 flex items-center justify-center border border-gray-100 group-hover/item:border-red-200 shadow-sm">
                            <i class="fa-solid fa-file-invoice text-2xl text-red-600"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-black text-gray-900 group-hover/item:text-red-700 transition-colors uppercase tracking-tight">Accomplishment Report Q{{ $i }}</h4>
                            <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed font-medium">Detailed summary of key achievements and project milestones for the quarter.</p>
                            <span class="text-[9px] font-black text-red-600 uppercase tracking-[0.2em] flex items-center gap-2 pt-1 mt-2">
                                Access Report <i class="fa-solid fa-arrow-right-long text-[8px] transition-transform group-hover/item:translate-x-1"></i>
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-12 text-center">
                    <a href="{{ route('news.index') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-2xl hover:bg-red-600 text-[10px] font-black uppercase tracking-widest transition-all shadow-xl active:scale-95">
                        <i class="fa-solid fa-archive"></i> View Full Archive
                    </a>
                </div>
            </div>
        </div>

        <!-- Organizational Structure -->
        <div class="group border border-gray-200 rounded-[2rem] overflow-hidden bg-white hover:border-red-200 hover:shadow-2xl hover:shadow-red-900/5 transition-all duration-300">
            <button class="w-full px-10 py-8 flex items-center justify-between text-left hover:bg-gray-50/50 transition-colors" onclick="toggleAccordion('org-section')">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600">
                        <i class="fa-solid fa-sitemap text-xl"></i>
                    </div>
                    <span class="text-lg font-black text-gray-900 uppercase tracking-tight">Organizational Structure</span>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 transition-all duration-300" id="org-icon"></i>
            </button>
            <div id="org-section" class="hidden px-10 pb-10 border-t border-gray-50 pt-8 mt-2">
                <div class="space-y-8">
                    <div class="relative overflow-hidden rounded-[2rem] border border-gray-200 cursor-crosshair bg-white shadow-sm" id="zoom-container">
                        <img id="org-image" src="{{ Vite::asset('resources/images/orgchart.png') }}" alt="Organizational Structure" class="w-full h-auto block" onmousemove="moveLens(event)" onmouseleave="hideLens()">
                        <div id="zoom-lens" class="absolute border-4 border-red-600 rounded-[1.5rem] pointer-events-none opacity-0 shadow-2xl transition-opacity duration-300 bg-no-repeat z-[50]" style="width: 280px; height: 200px;"></div>
                    </div>
                    <div class="flex flex-col items-center gap-4">
                        <button onclick="viewFullScreen()" class="px-10 py-4 bg-gray-900 text-white rounded-2xl hover:bg-red-700 text-xs font-black uppercase tracking-widest transition-all shadow-xl active:scale-95">
                            <i class="fa-solid fa-expand mr-2"></i> View High-Resolution Chart
                        </button>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-red-600"></span> Double click or hover for interactive lens
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- District Offices -->
        <div class="group border border-gray-200 rounded-[2rem] overflow-hidden bg-white hover:border-red-200 hover:shadow-2xl hover:shadow-red-900/5 transition-all duration-300">
            <button class="w-full px-10 py-8 flex items-center justify-between text-left hover:bg-gray-50/50 transition-colors" onclick="toggleAccordion('district-section')">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600">
                        <i class="fa-solid fa-location-dot text-xl"></i>
                    </div>
                    <span class="text-lg font-black text-gray-900 uppercase tracking-tight">District Field Offices</span>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 transition-all duration-300" id="district-icon"></i>
            </button>
            <div id="district-section" class="hidden px-10 pb-10 border-t border-gray-50 pt-8 mt-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach(['1st District Office', '2nd District Office', '3rd District Office', '4th District Office'] as $district)
                    <div class="p-6 rounded-[2rem] bg-gray-50 border border-gray-100 flex items-center gap-6 group/item hover:bg-white hover:shadow-xl hover:border-red-100 transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-red-700 shadow-sm group-hover/item:bg-red-600 group-hover/item:text-white transition-colors">
                            <i class="fa-solid fa-building-circle-check text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-black text-gray-900 uppercase tracking-tight">{{ $district }}</h4>
                            <p class="text-xs text-gray-500 font-medium">Laguna Provincial Capitol Compound</p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">Satellite Service Center</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleAccordion(id) {
        const section = document.getElementById(id);
        const icon = document.getElementById(id.replace('section', 'icon'));
        
        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            icon.classList.add('rotate-90', 'text-red-600');
        } else {
            section.classList.add('hidden');
            icon.classList.remove('rotate-90', 'text-red-600');
        }
    }

    function moveLens(e) {
        const img = document.getElementById('org-image');
        const lens = document.getElementById('zoom-lens');
        const container = document.getElementById('zoom-container');
        
        lens.style.opacity = '1';
        
        const rect = img.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        // Prevent lens from going outside
        let lensX = x - lens.offsetWidth / 2;
        let lensY = y - lens.offsetHeight / 2;
        
        if (lensX > img.width - lens.offsetWidth) lensX = img.width - lens.offsetWidth;
        if (lensX < 0) lensX = 0;
        if (lensY > img.height - lens.offsetHeight) lensY = img.height - lens.offsetHeight;
        if (lensY < 0) lensY = 0;
        
        lens.style.left = lensX + 'px';
        lens.style.top = lensY + 'px';
        
        // Magnification factor
        const zoom = 2.5; 
        
        lens.style.backgroundImage = `url("${img.src}")`;
        lens.style.backgroundSize = (img.width * zoom) + 'px ' + (img.height * zoom) + 'px';
        lens.style.backgroundPosition = "-" + (lensX * zoom) + "px -" + (lensY * zoom) + "px";
    }

    function hideLens() {
        document.getElementById('zoom-lens').style.opacity = '0';
    }

    function viewFullScreen() {
        const img = document.getElementById('org-image');
        window.open(img.src, '_blank');
    }
</script>

<style>
    .rotate-90 {
        transform: rotate(90deg);
    }
</style>
@endsection
