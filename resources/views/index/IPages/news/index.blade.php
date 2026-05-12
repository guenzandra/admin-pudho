@extends('index.layout')

@section('title', 'News & Accomplishments – PUDHO Laguna')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Hero Section -->
    <div class="text-center space-y-4 mb-16">
        <div class="inline-block px-4 py-1.5 rounded-full bg-red-50 text-red-700 text-[10px] font-black uppercase tracking-[0.2em] border border-red-100">
            Latest Updates
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 uppercase tracking-tighter">News & Accomplishments</h1>
        <p class="text-gray-500 max-w-2xl mx-auto font-medium">
            Stay informed about the latest housing developments, community initiatives, and office milestones across the Province of Laguna.
        </p>
    </div>

    <!-- Featured Article (Top 1) -->
    @if(count($articles) > 0)
    <div class="mb-16">
        <div class="group bg-white rounded-[3rem] border border-gray-200 overflow-hidden hover:shadow-2xl hover:shadow-red-900/5 transition-all duration-500">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <a href="{{ route('news.show', $articles[0]['slug']) }}" class="block relative aspect-square lg:aspect-auto overflow-hidden bg-gray-100">
                    <img src="{{ $articles[0]['image'] }}" alt="{{ $articles[0]['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </a>
                <div class="p-8 lg:p-16 flex flex-col justify-center">
                    <div class="flex items-center gap-3 text-[10px] font-bold text-red-600 uppercase tracking-[0.2em] mb-6">
                        <span class="px-2 py-0.5 rounded bg-red-50 border border-red-100">Featured</span>
                        <span>{{ $articles[0]['category'] }}</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-black text-gray-900 leading-tight mb-6 group-hover:text-red-700 transition-colors">
                        <a href="{{ route('news.show', $articles[0]['slug']) }}">
                            {{ $articles[0]['title'] }}
                        </a>
                    </h2>
                    <p class="text-gray-500 text-lg leading-relaxed mb-8">
                        {{ $articles[0]['excerpt'] }}
                    </p>
                    <div class="flex items-center gap-6 mb-10 pt-6 border-t border-gray-100">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-calendar text-[10px] text-gray-400"></i>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $articles[0]['date'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-user text-[10px] text-gray-400"></i>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $articles[0]['author'] }}</span>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('news.show', $articles[0]['slug']) }}" class="inline-flex items-center gap-3 px-8 py-4 bg-red-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl shadow-red-900/20 active:scale-95">
                            Read Full Story <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Articles Grid (Remaining) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach(array_slice($articles, 1) as $article)
        <article class="group bg-white rounded-3xl border border-gray-200 overflow-hidden hover:shadow-2xl hover:shadow-red-900/5 hover:-translate-y-1 transition-all duration-300 flex flex-col">
            <!-- Image Wrap -->
            <a href="{{ route('news.show', $article['slug']) }}" class="block relative aspect-[16/10] overflow-hidden bg-gray-100">
                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-md text-[10px] font-black uppercase tracking-widest text-red-700 shadow-sm">
                        {{ $article['category'] }}
                    </span>
                </div>
            </a>

            <!-- Content -->
            <div class="p-8 flex flex-col flex-1">
                <div class="flex items-center gap-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">
                    <span>{{ $article['date'] }}</span>
                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                    <span>{{ $article['author'] }}</span>
                </div>

                <h2 class="text-xl font-extrabold text-gray-900 leading-tight mb-4 group-hover:text-red-700 transition-colors">
                    <a href="{{ route('news.show', $article['slug']) }}">
                        {{ $article['title'] }}
                    </a>
                </h2>

                <p class="text-gray-500 text-sm leading-relaxed mb-8 line-clamp-3">
                    {{ $article['excerpt'] }}
                </p>

                <div class="mt-auto">
                    <a href="{{ route('news.show', $article['slug']) }}" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-red-600 group/link">
                        Read Story 
                        <i class="fa-solid fa-arrow-right transition-transform group-hover/link:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Newsletter Simple -->
    <div class="mt-24 bg-gray-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-red-600/10 blur-[100px] rounded-full"></div>
        <div class="relative z-10 space-y-8">
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tighter">Stay Updated with PUDHO</h2>
            <p class="text-gray-400 max-w-xl mx-auto">Get the latest news and announcements sent directly to your inbox. Subscribe to our monthly newsletter.</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Your email address" class="flex-1 bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600 transition-all font-medium">
                <button type="submit" class="bg-red-600 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-red-700 transition-colors shadow-lg shadow-red-900/20">Subscribe</button>
            </form>
        </div>
    </div>

</div>
@endsection
