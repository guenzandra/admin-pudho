@extends('index.layout')

@section('title', 'Services – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    
    <!-- Hero Title -->
    <div class="text-center space-y-4">
        <h1 class="text-3xl md:text-5xl font-black text-gray-900 uppercase tracking-tighter">Our Services</h1>
        <div class="w-24 h-2 bg-red-700 mx-auto"></div>
        <p class="text-xs font-bold text-gray-500 max-w-xl mx-auto leading-relaxed uppercase tracking-widest">
            Committed to providing comprehensive housing solutions and technical support for the province of Laguna.
        </p>
    </div>

    <!-- Services Container -->
    <div class="grid grid-cols-1 gap-20">
        
        <!-- 1. Handling of Queries -->
        <div class="group" id="query-handling">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-4 text-red-700">
                        <span class="text-6xl font-black opacity-20">01</span>
                        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter leading-tight">
                            Handling of Queries on<br>Housing Concern
                        </h2>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed font-medium">
                        The Agency has the responsibility to answer queries of a client, group or Local Government Units with regards to housing concerns. We provide expert advice and guidance on land acquisition, relocation processes, and housing rights.
                    </p>
                    <div class="pt-4">
                         <a href="{{ route('faqs') }}" class="text-[10px] font-black text-red-700 uppercase tracking-widest border-b-2 border-red-700/30 hover:border-red-700 transition-all flex items-center gap-2 w-fit">
                            Check common questions
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="aspect-video bg-gray-200 rounded-2xl overflow-hidden shadow-2xl shadow-gray-200 group-hover:scale-[1.02] transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1573491959002-b2433bc4d341?auto=format&fit=crop&q=80&w=1200" alt="Query Handling" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <!-- 2. Provision of Seminars -->
        <div class="group" id="seminars">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center lg:flex-row-reverse">
                <div class="order-2 md:order-1 aspect-video bg-gray-200 rounded-2xl overflow-hidden shadow-2xl shadow-gray-200 group-hover:scale-[1.02] transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=1200" alt="Provision of Seminars" class="w-full h-full object-cover">
                </div>
                <div class="order-1 md:order-2 space-y-6">
                    <div class="inline-flex items-center gap-4 text-red-700">
                        <span class="text-6xl font-black opacity-20">02</span>
                        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter leading-tight">
                            Provision of<br>Seminars
                        </h2>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed font-medium">
                        The Agency, in coordination with national agencies, has the responsibility to provide seminars regarding housing programs and services. We facilitate information sessions on government funding, cooperative principles, and community management.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('dforms') }}" class="text-[10px] font-black text-red-700 uppercase tracking-widest border-b-2 border-red-700/30 hover:border-red-700 transition-all flex items-center gap-2 w-fit">
                           Register for next seminar
                           <i class="fa-solid fa-calendar-check"></i>
                       </a>
                   </div>
                </div>
            </div>
        </div>

        <!-- 3. Technical Assistance -->
        <div class="group" id="tech-assistance">
            <div class="bg-gray-900 rounded-[2.5rem] p-8 md:p-16 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 p-12 opacity-5 scale-150">
                    <i class="fa-solid fa-compass-drafting text-9xl"></i>
                </div>
                
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-4 text-red-500">
                            <span class="text-6xl font-black opacity-40">03</span>
                            <h2 class="text-2xl md:text-3xl font-black text-white uppercase tracking-tighter leading-tight">
                                Technical Assistance for<br>Community Associations
                            </h2>
                        </div>
                        <p class="text-sm text-gray-400 font-medium leading-relaxed max-w-md">
                            We provide end-to-end technical support for communities seeking to formalize and improve their housing situation.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @php
                            $techAssistance = [
                                'Community organizing/meeting',
                                'Lot research, site inspection',
                                'Drafting of technical plans',
                                'Profiling and loan documentation',
                                'HLURB Registration',
                                'CMP Loan Originatorship'
                            ];
                        @endphp
                        @foreach($techAssistance as $item)
                        <div class="flex items-center gap-3 bg-white/5 p-4 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                            <i class="fa-solid fa-check text-red-500 text-xs"></i>
                            <span class="text-[11px] font-bold uppercase tracking-widest">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Housing Projects -->
        <div class="group">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-4 text-red-700">
                        <span class="text-6xl font-black opacity-20">04</span>
                        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter leading-tight">
                            Housing Projects<br>(CMP/DPS)
                        </h2>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed font-medium">
                        The Agency performs and implements the Urban Development and Housing Act of 1992 (RA 7279) by assisting community associations in their registration to housing programs suitable to their needs, particularly the Community Mortgage Program (CMP) and Direct Purchase System (DPS).
                    </p>
                </div>
                <div class="aspect-video bg-gray-200 rounded-2xl overflow-hidden shadow-2xl shadow-gray-200 group-hover:scale-[1.02] transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1582408921715-18e7806365c1?auto=format&fit=crop&q=80&w=1200" alt="Housing Projects" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <!-- 5. Mediation and Arbitration -->
        <div class="group">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center lg:flex-row-reverse">
                <div class="order-2 md:order-1 aspect-video bg-gray-200 rounded-2xl overflow-hidden shadow-2xl shadow-gray-200 group-hover:scale-[1.02] transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=1200" alt="Mediation" class="w-full h-full object-cover">
                </div>
                <div class="order-1 md:order-2 space-y-6">
                    <div class="inline-flex items-center gap-4 text-red-700">
                        <span class="text-6xl font-black opacity-20">05</span>
                        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter leading-tight">
                            Mediation and<br>Arbitration of Complaints
                        </h2>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed font-medium">
                        We provide initial assessment, evaluation, and action on complaints involving housing disputes. Our goal is to resolve conflicts at the provincial level before referring them to national agencies, ensuring community harmony.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('dforms') }}" class="text-[10px] font-black text-red-700 uppercase tracking-widest border-b-2 border-red-700/30 hover:border-red-700 transition-all flex items-center gap-2 w-fit">
                           Download complaint form
                           <i class="fa-solid fa-file-contract"></i>
                       </a>
                   </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
