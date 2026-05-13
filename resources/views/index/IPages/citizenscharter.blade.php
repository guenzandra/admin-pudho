@extends('index.layout')

@section('title', 'Citizen\'s Charter – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-20">
    
    <!-- Hero Title -->
    <div class="relative bg-gray-900 rounded-[3rem] p-12 md:p-20 overflow-hidden shadow-2xl text-center">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(220,38,38,0.15),_transparent)]"></div>
        <div class="relative z-10 space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/5 border border-white/10 rounded-full">
                <i class="fa-solid fa-stamp text-red-500 text-[10px]"></i>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Official Document</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter leading-none">
                Citizen's <span class="text-red-500">Charter</span>
            </h1>
            <p class="text-gray-400 text-sm md:text-lg max-w-2xl mx-auto font-medium">
                Our commitment to transparency, accountability, and excellence in public service delivery.
            </p>
        </div>
    </div>

    <!-- Rights and Obligations Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <div class="space-y-8">
            <div class="space-y-4">
                <div class="h-1 w-20 bg-red-600 rounded-full"></div>
                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">Legal Framework &<br>Public Rights</h2>
            </div>
            <div class="space-y-6">
                <div class="p-8 bg-gray-50 rounded-[2.5rem] border border-gray-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-700">
                        <i class="fa-solid fa-scale-balanced text-9xl"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-medium relative z-10">
                        Republic Act 9485 (Citizen's Charter Act of 2007) requires government agencies to develop a Citizen's Charter. This has been mandated as a means to inform the public of the rights and obligations of clients and the duties and responsibilities of government offices as defined in the Citizen's Charter.
                    </p>
                </div>
                <p class="text-base text-gray-500 leading-relaxed font-medium px-4">
                    The public promotes the integrity, accountability, and public participation of public affairs and public property as well as to establish effective, reliable, and efficient government service systems through appropriate information dissemination.
                </p>
                <div class="pt-4 px-4 flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                    <i class="fa-solid fa-link text-red-600/50"></i>
                    Source: <a href="https://occ.gov.ph/citizens-charter" class="hover:text-red-700 transition-colors underline decoration-red-600/30">Official Government Channel</a>
                </div>
            </div>
        </div>

        <!-- Manual Section -->
        <div class="space-y-8">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter">Charter Manual</h3>
                <a href="#" class="text-[10px] font-black text-red-600 uppercase tracking-widest flex items-center gap-2 border-b-2 border-red-100 hover:border-red-600 transition-all pb-1">
                    Download Full PDF <i class="fa-solid fa-download"></i>
                </a>
            </div>

            <!-- Enhanced Document Preview -->
            <div class="bg-white rounded-[3rem] border border-gray-200 shadow-2xl overflow-hidden p-8 flex flex-col items-center gap-10 group relative">
                <!-- Mock Page -->
                <div class="w-full aspect-[1/1.414] bg-white border border-gray-100 shadow-2xl relative flex flex-col items-center justify-between p-12 text-center group/page cursor-zoom-in overflow-hidden rounded-xl">
                    <!-- Texture effect -->
                    <div class="absolute inset-0 opacity-[0.02] pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/paper-fibers.png')]"></div>
                    
                    <div class="relative z-10 w-full flex flex-col items-center gap-6">
                         <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Seal_of_Laguna.svg/1200px-Seal_of_Laguna.svg.png" alt="Laguna Seal" class="w-24 h-24 drop-shadow-lg">
                         <div class="space-y-4">
                             <div class="h-px w-12 bg-gray-200 mx-auto"></div>
                             <h4 class="text-sm font-black text-gray-400 uppercase tracking-[0.3em]">Provincial Government</h4>
                             <h3 class="text-xl font-black text-gray-900 uppercase leading-none tracking-tight">
                                 Urban Development &<br>Housing Office
                             </h3>
                         </div>
                    </div>

                    <div class="relative z-10 py-10 w-full">
                        <div class="h-px bg-red-100 w-full mb-8"></div>
                        <h4 class="text-4xl font-black text-red-700 uppercase tracking-tighter leading-none">
                            CITIZEN'S<br>CHARTER
                        </h4>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.5em] mt-6">Revision 2026</p>
                    </div>

                    <div class="relative z-10 w-full text-[10px] font-black text-gray-300 uppercase tracking-widest space-y-2">
                        <p>Province of Laguna</p>
                        <div class="flex justify-between items-center px-4">
                            <span>Page 01</span>
                            <span>Official Release</span>
                        </div>
                    </div>

                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-gray-900/10 opacity-0 group-hover/page:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                        <div class="bg-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3">
                            <i class="fa-solid fa-magnifying-glass-plus text-red-600"></i>
                            <span class="text-xs font-black uppercase tracking-widest text-gray-900">Interactive Preview</span>
                        </div>
                    </div>
                </div>

                <!-- Professional Pagination -->
                <div class="flex items-center gap-6 bg-gray-50 px-6 py-3 rounded-2xl border border-gray-100">
                    <button class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all shadow-sm">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <div class="flex flex-col items-center">
                        <span class="text-[10px] font-black text-gray-900 uppercase tracking-widest">Page 01</span>
                        <span class="text-[8px] font-bold text-gray-400 uppercase">of 07</span>
                    </div>
                    <button class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all shadow-sm">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Assurance Section -->
    <div class="text-center space-y-4 max-w-2xl mx-auto py-8">
        <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center text-red-600 mx-auto border border-red-100 mb-4">
             <i class="fa-solid fa-shield-heart text-2xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-medium leading-relaxed italic">
            "We are committed to serving you with honesty and efficiency. Our Citizen's Charter is our guarantee of quality service."
        </p>
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
            For inquiries about this document, please contact our office directly.
        </p>
    </div>

</div>
@endsection
