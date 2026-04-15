<section class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
    {{-- Section Header --}}
    <div class="mb-6 space-y-2">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Latest News</h2>
            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">Updates</span>
        </div>
        <div class="h-1 w-16 bg-gradient-to-r from-blue-500 to-transparent rounded-full"></div>
    </div>

    {{-- News List --}}
    <div class="space-y-4">
        @foreach ($latestNews as $item)
            <article class="group relative p-4 rounded-lg border border-gray-100 hover:border-blue-100 bg-gradient-to-b from-white to-gray-50/50 hover:shadow-md transition-all duration-300">
                <div class="flex gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 mb-1">{{ $item->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $item->excerpt }}</p>
                        <a 
                            href="{{ url('/news/' . $item->id) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors>
                            Read More
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <time class="block mt-2 text-xs text-gray-500">{{ $item->created_at->format('M d, Y') }}</time>
            </article>
        @endforeach
    </div>

    {{-- View All Button --}}
    <div class="mt-6 text-center">
        <a 
            href="{{ url('/news') }}" 
            class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg font-medium hover:from-blue-600 hover:to-blue-700 transition-colors duration-300"
        >
            View All News
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
