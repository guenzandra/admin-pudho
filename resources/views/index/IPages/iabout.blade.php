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
            The Provincial Urban Development and Housing Office (PUDHO) is committed to addressing the housing needs of the people of Laguna. We strive to create sustainable communities and provide accessible housing solutions through innovative urban planning and dedicated public service.
        </p>
        <p class="text-sm text-gray-500 italic">
            [Additional information about the office's history and mandate can be placed here to provide more context to the visitors.]
        </p>
    </div>

    <!-- Vision, Mission, Core Values Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
        <!-- Vision -->
        <div class="space-y-4 text-center lg:text-right order-2 lg:order-1">
            <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Vision</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                A province where every Laguneño family enjoys a decent, safe, and sustainable shelter within a well-planned and inclusive community.
            </p>
        </div>

        <!-- Center Icon -->
        <div class="flex justify-center order-1 lg:order-2">
            <div class="relative group">
                <div class="absolute -inset-4 bg-red-100 rounded-full blur-2xl opacity-50 group-hover:opacity-75 transition-opacity"></div>
                <div class="relative bg-white p-8 rounded-3xl border-2 border-red-100 shadow-xl">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Seal_of_Laguna.svg/1200px-Seal_of_Laguna.svg.png" alt="Laguna Seal" class="w-32 h-32 object-contain">
                </div>
            </div>
        </div>

        <!-- Mission -->
        <div class="space-y-4 text-center lg:text-left order-3">
            <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Mission</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                To formulate and implement comprehensive urban development and housing programs that empower communities and improve the quality of life for all residents.
            </p>
        </div>
    </div>

    <!-- Core Values -->
    <div class="max-w-xl mx-auto text-center space-y-4">
        <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Core Values</h3>
        <p class="text-sm text-gray-600 leading-relaxed">
            Integrity, Excellence, Compassion, and Transparency in every service we provide to the Provincial Government and the people of Laguna.
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
                <div class="bg-gray-50 rounded-xl p-12 flex flex-col items-center justify-center border border-dashed border-gray-300">
                    <i class="fa-solid fa-sitemap text-5xl text-gray-300 mb-4"></i>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Organizational Chart Placeholder</p>
                    <p class="text-xs text-gray-400 mt-2">The detailed structure of PUDHO will be displayed here.</p>
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
</script>

<style>
    .rotate-90 {
        transform: rotate(90deg);
    }
</style>
@endsection
