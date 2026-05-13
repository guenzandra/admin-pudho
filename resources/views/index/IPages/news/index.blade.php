@extends('index.layout')

@section('title', 'News & Accomplishments – PUDHO Laguna')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-24">
    
    <!-- Hero Header -->
    <div class="relative bg-gray-900 rounded-[3.5rem] p-12 md:p-24 overflow-hidden shadow-2xl text-center border border-gray-800">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(220,38,38,0.2),_transparent)]"></div>
        <div class="relative z-10 space-y-8">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
                <div class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></div>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em]">Latest Updates</span>
            </div>
            <h1 class="text-4xl md:text-7xl font-black text-white uppercase tracking-tighter leading-[0.95]">
                News & <span class="text-red-600">Accomplishments</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-400 font-medium max-w-2xl mx-auto leading-relaxed">
                Stay informed about the latest housing developments, community initiatives, and office milestones across the Province of Laguna.
            </p>
        </div>
    </div>

    <!-- Featured Article (Top 1) -->
    @if(count($articles) > 0)
    <div class="space-y-10">
        <div class="flex items-center gap-4 px-4">
            <h2 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Featured Highlight</h2>
            <div class="h-px flex-grow bg-gray-100"></div>
        </div>
        <div class="group bg-white rounded-[4rem] border border-gray-100 overflow-hidden hover:shadow-[0_48px_80px_-16px_rgba(220,38,38,0.12)] transition-all duration-700">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <a href="{{ route('news.show', $articles[0]['slug']) }}" class="block relative aspect-square lg:aspect-auto overflow-hidden bg-gray-50">
                    <img src="{{ $articles[0]['image'] }}" alt="{{ $articles[0]['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s] ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-12 left-12 lg:hidden">
                         <span class="px-5 py-2 bg-red-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-xl">
                            {{ $articles[0]['category'] }}
                        </span>
                    </div>
                </a>
                <div class="p-10 lg:p-20 flex flex-col justify-center space-y-10">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <span class="px-4 py-1.5 rounded-lg bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest border border-red-100">Featured</span>
                            <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $articles[0]['category'] }}</span>
                        </div>
                        <h2 class="text-3xl lg:text-5xl font-black text-gray-900 leading-[1.05] tracking-tight group-hover:text-red-700 transition-colors uppercase">
                            <a href="{{ route('news.show', $articles[0]['slug']) }}">
                                {{ $articles[0]['title'] }}
                            </a>
                        </h2>
                        <p class="text-gray-500 text-lg leading-relaxed font-medium">
                            {{ $articles[0]['excerpt'] }}
                        </p>
                        <div class="flex items-center gap-8 pt-8 border-t border-gray-50">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-calendar-alt text-[10px] text-red-600"></i>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $articles[0]['date'] }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-user-edit text-[10px] text-red-600"></i>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $articles[0]['author'] }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <a href="{{ route('news.show', $articles[0]['slug']) }}" class="inline-flex items-center gap-4 px-10 py-5 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition-all shadow-2xl shadow-gray-900/10 active:scale-95 group/btn">
                            Read Full Story 
                            <i class="fa-solid fa-arrow-right-long transition-transform group-hover/btn:translate-x-1.5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Articles Grid (Remaining) -->
    <div class="space-y-12">
        <div class="flex items-center gap-4 px-4">
             <h2 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">More Stories</h2>
             <div class="h-px flex-1 bg-gray-100"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach(array_slice($articles, 1) as $article)
            <article class="group bg-white rounded-[3rem] border border-gray-100 overflow-hidden hover:shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] hover:-translate-y-2 transition-all duration-500 flex flex-col">
                <!-- Image Wrap -->
                <a href="{{ route('news.show', $article['slug']) }}" class="block relative aspect-[16/11] overflow-hidden bg-gray-100">
                    <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute top-6 left-6">
                        <span class="px-4 py-1.5 rounded-xl bg-white/95 backdrop-blur-md text-[9px] font-black uppercase tracking-widest text-red-700 shadow-sm border border-white/20">
                            {{ $article['category'] }}
                        </span>
                    </div>
                </a>

                <!-- Content -->
                <div class="p-10 flex flex-col flex-1 space-y-6">
                    <div class="flex items-center gap-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                        <span>{{ $article['date'] }}</span>
                        <span class="w-1 h-1 rounded-full bg-red-600"></span>
                        <span>{{ $article['author'] }}</span>
                    </div>

                    <h2 class="text-xl font-black text-gray-900 leading-[1.25] group-hover:text-red-700 transition-colors uppercase tracking-tight">
                        <a href="{{ route('news.show', $article['slug']) }}">
                            {{ $article['title'] }}
                        </a>
                    </h2>

                    <p class="text-gray-500 text-xs leading-relaxed font-medium line-clamp-3">
                        {{ $article['excerpt'] }}
                    </p>

                    <div class="mt-auto pt-8 border-t border-gray-50">
                        <a href="{{ route('news.show', $article['slug']) }}" class="inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-red-600 group/link">
                            Read Story 
                            <i class="fa-solid fa-arrow-right-long transition-transform group-hover/link:translate-x-1.5"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>

    <!-- Newsletter Simple -->
    <div class="mt-24 bg-gray-900 rounded-[4rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl border border-gray-800">
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 blur-[130px] rounded-full translate-x-1/3 -translate-y-1/3"></div>
        <div class="relative z-10 space-y-10">
            <div class="space-y-4">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-red-600 rounded-2xl text-white text-xl mb-4 rotate-3 shadow-2xl shadow-red-900/40">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter">Stay Updated with PUDHO</h2>
                <p class="text-gray-400 max-w-xl mx-auto font-medium">Get the latest news and announcements sent directly to your inbox. Subscribe to our monthly newsletter.</p>
            </div>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto bg-white/5 p-2 rounded-[2rem] border border-white/10 backdrop-blur-sm">
                <input type="email" placeholder="Your email address" class="flex-1 bg-transparent border-none rounded-2xl px-6 py-4 text-white placeholder:text-gray-500 focus:outline-none transition-all font-medium text-sm">
                <button type="submit" class="bg-red-600 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-white hover:text-red-700 transition-all shadow-xl shadow-red-900/20 active:scale-95">Subscribe</button>
            </form>
        </div>
    </div>

</div>
@endsection
