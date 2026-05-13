@extends('index.layout')

@section('title', 'Services – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-24">
    
    <!-- Hero Title -->
    <div class="relative bg-gray-50 rounded-[3rem] p-12 md:p-20 border border-gray-200 overflow-hidden text-center group">
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-red-600/5 blur-[100px] rounded-full"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-blue-600/5 blur-[100px] rounded-full"></div>
        
        <div class="relative z-10 space-y-6">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] block">Our Mission in Action</span>
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 uppercase tracking-tighter leading-tight">
                Our <span class="text-red-700">Services</span>
            </h1>
            <div class="h-1.5 w-24 bg-red-700 mx-auto rounded-full"></div>
            <p class="text-sm md:text-lg font-medium text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Committed to providing comprehensive housing solutions and technical support for the province of Laguna.
            </p>
        </div>
    </div>

    <!-- Services Container -->
    <div class="space-y-32">
        
        <!-- 1. Handling of Queries -->
        <div class="group" id="query-handling">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="space-y-8">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-4">
                            <span class="text-7xl font-black text-red-600/10">01</span>
                            <div class="h-1 w-12 bg-red-600 rounded-full"></div>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter leading-none">
                            Handling of Queries on<br><span class="text-red-700">Housing Concerns</span>
                        </h2>
                    </div>
                    <p class="text-base text-gray-600 leading-relaxed font-medium">
                        Our agency takes the responsibility to answer queries from individual clients, groups, or Local Government Units regarding provincial housing concerns. We provide expert advice on land acquisition, relocation processes, and housing rights.
                    </p>
                    <div class="pt-2">
                         <a href="{{ route('landing.faqs') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl active:scale-95">
                            Check common questions
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-[4/3] bg-gray-100 rounded-[3rem] overflow-hidden border border-gray-200 shadow-2xl group-hover:-translate-y-2 transition-all duration-700">
                        <img src="https://images.unsplash.com/photo-1573491959002-b2433bc4d341?auto=format&fit=crop&q=80&w=1200" alt="Query Handling" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-red-600 rounded-[2rem] flex items-center justify-center text-white shadow-2xl z-10 rotate-12 group-hover:rotate-0 transition-transform duration-500">
                        <i class="fa-solid fa-comments-question text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Provision of Seminars -->
        <div class="group" id="seminars">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="aspect-[4/3] bg-gray-100 rounded-[3rem] overflow-hidden border border-gray-200 shadow-2xl group-hover:-translate-y-2 transition-all duration-700">
                        <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=1200" alt="Provision of Seminars" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-gray-900 rounded-[2rem] flex items-center justify-center text-white shadow-2xl z-10 -rotate-12 group-hover:rotate-0 transition-transform duration-500">
                        <i class="fa-solid fa-graduation-cap text-3xl"></i>
                    </div>
                </div>
                <div class="order-1 lg:order-2 space-y-8">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-4">
                            <span class="text-7xl font-black text-red-600/10">02</span>
                            <div class="h-1 w-12 bg-red-600 rounded-full"></div>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter leading-none">
                            Provision of<br><span class="text-red-700">Educational Seminars</span>
                        </h2>
                    </div>
                    <p class="text-base text-gray-600 leading-relaxed font-medium">
                        The Agency, in coordination with national agencies, provides seminars regarding housing programs and services. We facilitate information sessions on government funding, cooperative principles, and community management.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('dforms') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl active:scale-95">
                           Register for next seminar
                           <i class="fa-solid fa-calendar-check"></i>
                       </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Technical Assistance (Special Contrast Card) -->
        <div class="group" id="tech-assistance">
            <div class="bg-gray-900 rounded-[4rem] p-10 md:p-20 text-white overflow-hidden relative shadow-2xl">
                <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 blur-[100px] rounded-full"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600/5 blur-[100px] rounded-full"></div>
                
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16">
                    <div class="space-y-10">
                        <div class="space-y-6">
                            <div class="inline-flex items-center gap-4">
                                <span class="text-7xl font-black text-white/5">03</span>
                                <div class="h-1 w-12 bg-red-600 rounded-full"></div>
                            </div>
                            <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter leading-tight">
                                Technical Assistance for<br><span class="text-red-500">Community Associations</span>
                            </h2>
                        </div>
                        <p class="text-base text-gray-400 font-medium leading-relaxed max-w-md">
                            We provide comprehensive technical support for communities seeking to formalize and improve their housing situation through organized planning and legal assistance.
                        </p>
                        <div class="pt-4 flex items-center gap-4">
                            <div class="flex -space-x-4">
                                @foreach(range(1, 3) as $i)
                                <div class="w-12 h-12 rounded-full border-4 border-gray-900 bg-gray-800 flex items-center justify-center">
                                    <i class="fa-solid fa-user text-xs text-red-500/50"></i>
                                </div>
                                @endforeach
                            </div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Supporting 500+ Communities</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @php
                            $techAssistance = [
                                ['label' => 'Community meeting', 'icon' => 'fa-users'],
                                ['label' => 'Site inspection', 'icon' => 'fa-location-dot'],
                                ['label' => 'Technical plans', 'icon' => 'fa-drafting-compass'],
                                ['label' => 'Loan documentation', 'icon' => 'fa-file-invoice-dollar'],
                                ['label' => 'HLURB Registration', 'icon' => 'fa-id-card'],
                                ['label' => 'Loan Originatorship', 'icon' => 'fa-hand-holding-dollar']
                            ];
                        @endphp
                        @foreach($techAssistance as $item)
                        <div class="flex flex-col gap-4 bg-white/5 p-6 rounded-3xl border border-white/10 hover:bg-white/10 hover:border-red-500/30 transition-all group/item">
                            <div class="w-10 h-10 rounded-xl bg-red-600/20 flex items-center justify-center text-red-500 group-hover/item:scale-110 transition-transform">
                                <i class="fa-solid {{ $item['icon'] }} text-lg"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-widest leading-tight">{{ $item['label'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Housing Projects -->
        <div class="group" id="housing-projects">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="space-y-8">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-4">
                            <span class="text-7xl font-black text-red-600/10">04</span>
                            <div class="h-1 w-12 bg-red-600 rounded-full"></div>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter leading-none">
                            Housing Projects Implementation<br><span class="text-red-700">(CMP/DPS)</span>
                        </h2>
                    </div>
                    <p class="text-base text-gray-600 leading-relaxed font-medium">
                        The Agency implements the Urban Development and Housing Act of 1992 (RA 7279) by assisting community associations in their registration to housing programs such as the Community Mortgage Program (CMP) and Direct Purchase System (DPS).
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('citizenscharter') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl active:scale-95">
                           View Citizen's Charter
                           <i class="fa-solid fa-shield-halved"></i>
                       </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-[4/3] bg-gray-100 rounded-[3rem] overflow-hidden border border-gray-200 shadow-2xl group-hover:-translate-y-2 transition-all duration-700">
                        <img src="https://images.unsplash.com/photo-1582408921715-18e7806365c1?auto=format&fit=crop&q=80&w=1200" alt="Housing Projects" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-red-600 rounded-[2rem] flex items-center justify-center text-white shadow-2xl z-10 rotate-12 group-hover:rotate-0 transition-transform duration-500">
                        <i class="fa-solid fa-trowel-bricks text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Mediation and Arbitration -->
        <div class="group" id="mediation">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="aspect-[4/3] bg-gray-100 rounded-[3rem] overflow-hidden border border-gray-200 shadow-2xl group-hover:-translate-y-2 transition-all duration-700">
                        <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=1200" alt="Mediation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-gray-900 rounded-[2rem] flex items-center justify-center text-white shadow-2xl z-10 -rotate-12 group-hover:rotate-0 transition-transform duration-500">
                        <i class="fa-solid fa-gavel text-3xl"></i>
                    </div>
                </div>
                <div class="order-1 lg:order-2 space-y-8">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-4">
                            <span class="text-7xl font-black text-red-600/10">05</span>
                            <div class="h-1 w-12 bg-red-600 rounded-full"></div>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter leading-none">
                            Mediation and<br><span class="text-red-700">Dispute Resolution</span>
                        </h2>
                    </div>
                    <p class="text-base text-gray-600 leading-relaxed font-medium">
                        We provide initial assessment, evaluation, and action on complaints involving housing disputes. Our goal is to resolve conflicts at the provincial level before referring them to national agencies, ensuring community harmony.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('dforms') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl active:scale-95">
                           Download complaint form
                           <i class="fa-solid fa-file-contract"></i>
                       </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Final CTA -->
    <div class="bg-red-700 rounded-[3rem] p-12 md:p-20 text-center space-y-8 shadow-2xl relative overflow-hidden group">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(255,255,255,0.1),_transparent)] group-hover:scale-110 transition-transform duration-1000"></div>
        <div class="relative z-10 space-y-6">
            <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter">Need specialized assistance?</h2>
            <p class="text-red-100 font-medium max-w-xl mx-auto">
                Our team is ready to help you navigate through your housing concerns and urban development needs.
            </p>
            <div class="pt-4">
                <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-3 px-10 py-5 bg-white text-red-700 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-gray-100 transition-all shadow-2xl active:scale-95">
                    Contact Our Team <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
