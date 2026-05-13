<footer class="bg-gray-50 pt-24 pb-12 overflow-hidden relative">
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
    
    <div class="max-w-[1280px] mx-auto px-6 space-y-16">
        <!-- Top Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <!-- Branding -->
            <div class="lg:col-span-5 space-y-8">
                <a href="{{ route('home') }}" class="flex items-center gap-4 group">
                    <img src="{{ Vite::asset('resources/images/pudho-logo.png') }}" class="w-16 h-16 object-contain" alt="Laguna Seal" />
                    <div class="flex flex-col">
                        <span class="text-2xl font-black text-gray-900 uppercase tracking-tighter leading-none">PUDHO <span class="text-red-700">LAGUNA</span></span>
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] leading-relaxed">Provincial Urban Development & Housing Office</span>
                    </div>
                </a>
                <p class="text-sm text-gray-500 font-medium leading-loose max-w-sm">
                    Pioneering sustainable urban development and providing affordable housing solutions to empower every Lagunense family.
                </p>
                <div class="flex items-center gap-3">
                    @foreach(['facebook-f',] as $icon)
                    <a href="#" class="w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all shadow-sm">
                        <i class="fab fa-{{ $icon }} text-sm"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Links Grid -->
            <div class="lg:col-span-7 grid grid-cols-2 md:grid-cols-3 gap-12">
                <!-- Navigation -->
                <div class="space-y-6">
                    <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.2em]">Platform</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}" class="text-xs font-bold text-gray-500 hover:text-red-700 transition-colors uppercase tracking-widest">Home</a></li>
                        <li><a href="{{ route('iabout') }}" class="text-xs font-bold text-gray-500 hover:text-red-700 transition-colors uppercase tracking-widest">About Us</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-xs font-bold text-gray-500 hover:text-red-700 transition-colors uppercase tracking-widest">Archive</a></li>
                        <li><a href="{{ route('iservices') }}" class="text-xs font-bold text-gray-500 hover:text-red-700 transition-colors uppercase tracking-widest">Services</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div class="space-y-6">
                    <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.2em]">Resources</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('dforms') }}" class="text-xs font-bold text-gray-500 hover:text-red-700 transition-colors uppercase tracking-widest">Forms</a></li>
                        <li><a href="{{ route('citizenscharter') }}" class="text-xs font-bold text-gray-500 hover:text-red-700 transition-colors uppercase tracking-widest">Charter</a></li>
                        <li><a href="{{ route('landing.faqs') }}" class="text-xs font-bold text-gray-500 hover:text-red-700 transition-colors uppercase tracking-widest">Support</a></li>
                        <li><a href="#" class="text-xs font-bold text-gray-500 hover:text-red-700 transition-colors uppercase tracking-widest">Transparency</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-6 col-span-2 md:col-span-1">
                    <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.2em]">Contact</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <i class="fa-solid fa-map-pin text-red-600 mt-1"></i>
                            <p class="text-[11px] font-bold text-gray-500 leading-relaxed uppercase tracking-tight">
                                Provincial Capitol,<br>Santa Cruz, Laguna
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="fa-solid fa-phone text-red-600"></i>
                            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-tight">(049) 501-0423</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-12 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-6">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                    &copy; {{ date('Y') }} PUDHO - Province of Laguna. All rights reserved.
                </p>
            </div>
            <div class="flex items-center gap-6">
                <a href="#" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-900">Privacy Policy</a>
                <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                <a href="#" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-900">Terms of Service</a>
                <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                <div class="flex items-center gap-2 px-3 py-1 bg-gray-100 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                   <!-- <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Network Live</span> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-red-600/5 blur-[100px] rounded-full translate-x-1/2 translate-y-1/2"></div>
</footer>

