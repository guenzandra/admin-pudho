@extends('index.layout')

@section('title', 'Home | Laguna PUDHO')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-12">
    
    <!-- Hero Banner -->
    <section class="relative bg-gray-200 rounded-2xl overflow-hidden aspect-[21/7] group">
        <div class="absolute inset-0 flex items-center justify-center bg-gray-300">
            <div class="text-center text-gray-500">
                <i class="fa-solid fa-image text-5xl mb-3 opacity-30"></i>
                <p class="text-sm font-bold uppercase tracking-widest">PUDHO Photo Banner</p>
            </div>
        </div>
        
        <!-- Slider Controls -->
        <button class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-all opacity-0 group-hover:opacity-100">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-all opacity-0 group-hover:opacity-100">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
        
        <!-- Dots -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
            <div class="h-2 w-2 rounded-full bg-red-500"></div>
            <div class="h-2 w-2 rounded-full bg-gray-400"></div>
            <div class="h-2 w-2 rounded-full bg-gray-400"></div>
        </div>
    </section>

    <!-- Announcement & Latest News -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Announcement -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center gap-4">
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest bg-gray-200 px-3 py-1 rounded">Announcement</h2>
                <div class="h-px bg-red-200 flex-grow"></div>
            </div>
            <div class="bg-gray-100 rounded-xl aspect-video flex items-center justify-center border border-gray-200">
                <i class="fa-solid fa-image text-6xl text-gray-300"></i>
            </div>
        </div>

        <!-- Latest News -->
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest bg-gray-200 px-3 py-1 rounded">Latest News</h2>
                <div class="h-px bg-red-200 flex-grow"></div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4 space-y-4">
                <div class="flex justify-end">
                    <button class="text-[10px] font-bold text-gray-600 uppercase tracking-widest border border-gray-300 px-4 py-1.5 rounded-full hover:bg-gray-50 transition-colors">View all</button>
                </div>
                
                <!-- News Items -->
                @foreach(range(1, 4) as $i)
                <div class="flex gap-4 group cursor-pointer">
                    <div class="h-20 w-20 bg-gray-100 rounded-lg shrink-0 flex items-center justify-center border border-gray-200 group-hover:border-red-200 transition-colors">
                        <i class="fa-solid fa-image text-xl text-gray-300"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-sm font-bold text-gray-900 group-hover:text-red-900 transition-colors">Article Title</h3>
                        <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed">small preview of the article here lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="#" class="text-[10px] font-bold text-red-600 uppercase tracking-widest flex items-center gap-1 hover:gap-2 transition-all">
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
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @foreach(range(1, 6) as $i)
            <div class="bg-white rounded-xl h-24 flex items-center justify-center border border-gray-200 hover:border-red-200 transition-colors cursor-pointer group">
                <i class="fa-solid fa-image text-3xl text-gray-200 group-hover:text-red-200 transition-colors"></i>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection
