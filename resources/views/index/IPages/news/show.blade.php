@extends('index.layout')

@section('title', $article['title'] . ' – PUDHO Laguna')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-gray-400 mb-12">
        <a href="{{ route('home') }}" class="hover:text-red-600">Home</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <a href="{{ route('news.index') }}" class="hover:text-red-600">News</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-gray-900 truncate max-w-[200px]">{{ $article['title'] }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        
        <!-- Main Content -->
        <article class="lg:col-span-8 space-y-12">
            <!-- Header -->
            <header class="space-y-6">
                <div class="inline-block px-3 py-1 rounded-full bg-red-50 text-red-700 text-[10px] font-black uppercase tracking-widest border border-red-100">
                    {{ $article['category'] }}
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-[1.1] tracking-tight">
                    {{ $article['title'] }}
                </h1>
                
                <div class="flex items-center gap-6 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Posted By</span>
                            <span class="text-xs font-bold text-gray-900">{{ $article['author'] }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Published</span>
                        <span class="text-xs font-bold text-gray-900">{{ $article['date'] }}</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <div class="aspect-[16/9] rounded-[2rem] overflow-hidden border border-gray-200">
                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover">
            </div>

            <!-- Body Content -->
            <div class="prose prose-red max-w-none prose-p:text-gray-600 prose-p:text-lg prose-p:leading-relaxed prose-headings:text-gray-900 prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tight prose-strong:text-gray-900">
                {!! $article['content'] !!}
            </div>

            <!-- Share Section -->
            <div class="pt-12 border-t border-gray-100 flex flex-col sm:flex-row items-center gap-6 justify-between">
                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Share this Story</span>
                    <div class="flex gap-2">
                        <button class="w-10 h-10 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-600 hover:bg-red-600 hover:text-white transition-all">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </button>
                        <button class="w-10 h-10 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-600 hover:bg-red-600 hover:text-white transition-all">
                            <i class="fa-brands fa-x-twitter text-sm"></i>
                        </button>
                        <button class="w-10 h-10 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-600 hover:bg-red-600 hover:text-white transition-all">
                            <i class="fa-solid fa-link text-sm"></i>
                        </button>
                    </div>
                </div>
                <a href="{{ route('news.index') }}" class="text-[11px] font-black uppercase tracking-widest text-gray-400 hover:text-red-600 transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Back to News
                </a>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="lg:col-span-4 space-y-12">
            <!-- Search -->
            <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6">Search News</h3>
                <div class="relative">
                    <input type="text" placeholder="Type keywords..." class="w-full bg-white border border-gray-200 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-600/10 focus:border-red-600 transition-all">
                    <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600 transition-colors">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Categories -->
            <div class="bg-white rounded-3xl p-8 border border-gray-200">
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6">Categories</h3>
                <div class="space-y-3">
                    @foreach(['Accomplishment', 'Announcement', 'Training', 'Meeting', 'Events'] as $cat)
                    <a href="#" class="flex items-center justify-between group">
                        <span class="text-sm font-bold text-gray-500 group-hover:text-red-700 transition-colors">{{ $cat }}</span>
                        <div class="w-6 h-6 rounded-lg bg-gray-50 text-[10px] font-bold text-gray-400 flex items-center justify-center group-hover:bg-red-50 group-hover:text-red-700 transition-all">
                            {{ rand(1, 15) }}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Office Info Card -->
            <div class="bg-gray-900 rounded-[2rem] p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-600/20 blur-[50px] rounded-full"></div>
                <div class="relative z-10 space-y-6">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Seal_of_Laguna.svg/1200px-Seal_of_Laguna.svg.png" alt="Seal" class="w-12 h-12 object-contain brightness-0 invert opacity-50">
                    <h3 class="text-lg font-black uppercase tracking-tight leading-tight">Provincial Urban Development & Housing Office</h3>
                    <p class="text-xs text-gray-400 leading-relaxed font-medium">Providing decent and affordable housing units for low-income Lagunenses since 1996.</p>
                    <a href="{{ route('iabout') }}" class="inline-flex py-3 px-6 bg-red-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-red-700 transition-all">About Our Office</a>
                </div>
            </div>
        </aside>

    </div>
</div>
@endsection
