<section class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
    {{-- Section Header --}}
    <div class="mb-6 space-y-2">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Latest Announcement</h2>
            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-sm rounded-full ml-2">Just Released</span>
        </div>
        <div class="h-1 w-16 bg-gradient-to-r from-blue-500 to-transparent rounded-full"></div>
    </div>

    {{-- Announcement Content --}}
    <div class="group relative rounded-lg overflow-hidden border border-gray-100 transition-transform duration-300 hover:-translate-y-1">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/30 to-transparent z-10"></div>
        <img 
            src="/announcements/announcement-1.png" 
            alt="Platform Update 2024 Preview"
            class="w-full h-full object-cover aspect-[1600/900]"
        >
        <div class="absolute bottom-0 left-0 right-0 p-4 text-white z-20">
            <h3 class="text-lg font-semibold mb-1">Platform Update 2024</h3>
            <p class="text-sm opacity-90">Discover new features and improvements</p>
        </div>
    </div>

    {{-- View More --}}
    <div class="mt-4 text-right">
        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
            View Details
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
