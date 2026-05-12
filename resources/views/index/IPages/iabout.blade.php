@extends('index.layout')

@section('title', 'About – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    
    <!-- Header Section -->
    <div class="text-center space-y-4">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 uppercase tracking-tighter">About Our Office</h1>
        <div class="bg-gray-100 py-6 px-8 rounded-2xl border border-gray-200 inline-block w-full max-w-4xl">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Province of Laguna</p>
            <h2 class="text-xl md:text-2xl font-extrabold text-red-900 uppercase tracking-tight">
                Provincial Urban Development and Housing Office
            </h2>
        </div>
    </div>

     <!-- Main Description -->
    <div class="max-w-3xl mx-auto text-center space-y-6">
        <div class="inline-block px-4 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold uppercase tracking-widest border border-red-100">
            Main Description
        </div>
        <p class="text-lg text-gray-600 leading-relaxed">
            Formerly known as Housing Office, is mandated under Republic Act No. 7279 (Urban Development and Housing Act of 1992) to deliver comprehensive and continuing urban development and housing programs by providing affordable and decent housing units for low-income Lagunenses. 
            The Provincial Urban Development and Housing Office (PUDHO) is committed to addressing the housing needs of the people of Laguna. We strive to create sustainable communities and provide accessible housing solutions through innovative urban planning and dedicated public service.
        </p>
        <p class="text-sm text-gray-500 italic">
           Former Laguna Governor JOEY D. LINA, JR., the author of Republic Act No. 7279 or the Urban Development and Housing Act of 1992, wanted the Province of Laguna be a model in regard to the implementation of the pro-poor law. By January 1996, he created an office directly under the 
           Office of the Governor to ensure Laguna can provide housing programs to its constituents. PUDHO started with a total of 22 personnel who handled 120 homeowners’ associations which is composed of 92,075 families all over the Province of Laguna.
        </p>
    </div>

    <!-- Vision, Mission, Core Values Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
        <!-- Vision -->
        <div class="space-y-4 text-center lg:text-right order-2 lg:order-1">
            <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Vision</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                “A PROVINCE FREE OF INFORMAL SETTLERS” through the provision of decent and affordable homelots to the poor and homeless Lagunenses.
            </p>
        </div>

        <!-- Center Icon -->
        <div class="flex justify-center order-1 lg:order-2">
            <div class="relative group">
                <div class="absolute -inset-4 bg-red-100 rounded-full blur-2xl opacity-50 group-hover:opacity-75 transition-opacity"></div>
                <div class="relative bg-white p-8 rounded-3xl border-2 border-red-100 shadow-xl">
                    <img src="{{ Vite::asset('resources/images/pudho-logo.png') }}" alt="Laguna Seal" class="w-32 h-32 object-contain">
                </div>
            </div>
        </div>

        <!-- Mission -->
        <div class="space-y-4 text-center lg:text-left order-3">
            <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Mission</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              To fully implement the Urban Development Act of 1992.
            </p>
        </div>
    </div>

    <!-- Objectives -->
    <div class="max-w-xl mx-auto text-center space-y-4">
        <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Objectives</h3>
        <p class="text-sm text-gray-600 leading-relaxed">
           <ul class="text-sm text-gray-600 leading-relaxed list-disc list-inside">
            <li>To institutionalize the housing program by creating Housing Offices in all cities and municipalities of the province.</li>
            <li>To establish the Provincial Shelter Plan and intensify housing programs through “Responsible Laguna Housing” of the province.</li>
            <li>To lessen demolition and similar cases through planning and dialogues among LGUs, lot owners and judicial branch.</li>
            <li>To generate funds through the implementation of Art. XI Sec. 42 Items c-g and Sec. 43 of UDHA 1992 and other province-initiated projects.</li>
            <li>To provide decent and affordable housing/homelot units to the poor and low-income Lagunenses.</li>
        </ul>
       </p>
    </div>

    <!-- Accordion Sections -->
    <div class="space-y-4 max-w-4xl mx-auto">
        
        <!-- News Updates & Accomplishments -->
        <div class="group border border-gray-200 rounded-2xl overflow-hidden bg-white hover:border-red-200 transition-all">
            <button class="w-full px-8 py-6 flex items-center justify-between text-left hover:bg-gray-50 transition-colors" onclick="toggleAccordion('news-section')">
                <span class="text-lg font-bold text-gray-900 uppercase tracking-tight">News Updates & Accomplishments</span>
                <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-red-600 transition-all" id="news-icon"></i>
            </button>
   <div id="news-section" class="hidden px-8 pb-8 space-y-6 border-t border-gray-100 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(range(1, 4) as $i)
                    <div class="flex gap-4 group/item cursor-pointer">
                        <div class="h-20 w-20 bg-gray-100 rounded-lg shrink-0 flex items-center justify-center border border-gray-200 group-hover/item:border-red-200 transition-colors">
                            <i class="fa-solid fa-image text-xl text-gray-300"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-gray-900 group-hover/item:text-red-900 transition-colors">Accomplishment Report Q{{ $i }}</h4>
                            <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed">Summary of key achievements and project milestones for the quarter.</p>
                            <span class="text-[10px] font-bold text-red-600 uppercase tracking-widest flex items-center gap-1">
                                View Details <i class="fa-solid fa-arrow-right text-[8px]"></i>
                            </span>
                        </div>
                           </div>
                    @endforeach
                </div>
            </div>
        </div>

    <!-- Organizational Structure -->
    <div class="group border border-gray-200 rounded-2xl overflow-hidden bg-white hover:border-red-200 transition-all">
        <button class="w-full px-8 py-6 flex items-center justify-between text-left hover:bg-gray-50 transition-colors" onclick="toggleAccordion('org-section')">
            <span class="text-lg font-bold text-gray-900 uppercase tracking-tight">Organizational Structure</span>
            <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-red-600 transition-all" id="org-icon"></i>
        </button>
        <div id="org-section" class="hidden px-8 pb-8 border-t border-gray-100 pt-6">
            <div class="space-y-6">
                <div class="relative overflow-hidden rounded-xl border border-gray-200 cursor-crosshair bg-white" id="zoom-container">
                    <img id="org-image" src="{{ Vite::asset('resources/images/orgchart.png') }}" alt="Organizational Structure" class="w-full h-auto block" onmousemove="moveLens(event)" onmouseleave="hideLens()">
                    <div id="zoom-lens" class="absolute border-2 border-red-500 rounded-md pointer-events-none opacity-0 shadow-2xl transition-opacity duration-300 bg-no-repeat z-[50]" style="width: 250px; height: 180px;"></div>
                </div>
                <div class="flex flex-wrap justify-center gap-4">
                    <button onclick="viewFullScreen()" class="px-6 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-red-900/20 active:scale-95">
                        <i class="fa-solid fa-expand mr-2"></i> View Full Screen
                    </button>
                    <p class="w-full text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest pt-2">
                        <i class="fa-solid fa-circle-info mr-1"></i> Hover over the chart to magnify details
                    </p>
                </div>
            </div>
        </div>
    </div>

        <!-- District Offices -->
        <div class="group border border-gray-200 rounded-2xl overflow-hidden bg-white hover:border-red-200 transition-all">
            <button class="w-full px-8 py-6 flex items-center justify-between text-left hover:bg-gray-50 transition-colors" onclick="toggleAccordion('district-section')">
                <span class="text-lg font-bold text-gray-900 uppercase tracking-tight">District Offices</span>
                <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-red-600 transition-all" id="district-icon"></i>
            </button>
            <div id="district-section" class="hidden px-8 pb-8 border-t border-gray-100 pt-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach(['1st District Office', '2nd District Office', '3rd District Office', '4th District Office'] as $district)
                    <div class="p-4 rounded-xl bg-gray-50 border border-gray-200 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center text-red-700">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">{{ $district }}</h4>
                            <p class="text-xs text-gray-500">Laguna Provincial Capitol</p>
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
            icon.classList.add('rotate-90');
        } else {
            section.classList.add('hidden');
            icon.classList.remove('rotate-90');
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
        const zoom = 2; // Increase for more zoom
        
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