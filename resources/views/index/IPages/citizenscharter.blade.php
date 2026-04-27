@extends('index.layout')

@section('title', 'Citizen\'s Charter – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
    
    <!-- Hero Title -->
    <div class="text-center">
        <h1 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter">Citizen's Charter</h1>
    </div>

    <!-- Rights and Obligations Section -->
    <div class="max-w-4xl mx-auto space-y-6 text-center">
        <h2 class="text-lg font-bold text-gray-900 uppercase tracking-widest">Rights and Obligations</h2>
        <div class="space-y-4 text-sm text-gray-600 leading-relaxed text-justify md:text-center">
            <p>
                Republic Act 9485 (Citizen's Charter Act of 2007) requires government agencies to develop a Citizen's Charter. This has been mandated as a means to inform the public of the rights and obligations of clients and the duties and responsibilities of government offices as defined in the Citizen's Charter.
            </p>
            <p>
                The public promotes the integrity, accountability, and public participation of public affairs and public property as well as to establish effective, reliable, and efficient government service systems through appropriate information dissemination.
            </p>
            <p class="text-xs text-gray-400 italic">
                Source: https://occ.gov.ph/citizens-charter
            </p>
        </div>
        <div class="h-px bg-gray-200"></div>
    </div>

    <!-- Manual Section -->
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex items-center gap-2 text-red-700 hover:text-red-800 transition-colors cursor-pointer group">
            <i class="fa-solid fa-file-pdf text-xl"></i>
            <span class="font-bold border-b-2 border-red-700 group-hover:border-red-800 uppercase tracking-tight">Citizen's Charter Manual</span>
        </div>

        <!-- Document Preview Container -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-4 md:p-10 flex flex-col items-center gap-6">
            <!-- Mock Document Preview -->
            <div class="w-full max-w-[600px] aspect-[1/1.414] bg-white border border-gray-100 shadow-lg relative flex flex-col items-center justify-center p-8 text-center space-y-6 group cursor-zoom-in">
                <div class="absolute inset-0 bg-gray-50/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <span class="bg-gray-900/80 text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest">Click to Zoom</span>
                </div>
                
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Seal_of_Laguna.svg/1200px-Seal_of_Laguna.svg.png" alt="Laguna Seal" class="w-24 h-24 opacity-80">
                
                <div class="space-y-4">
                    <h3 class="text-lg font-black text-gray-900 uppercase leading-tight">
                        PROVINCIAL URBAN DEVELOPMENT &<br>HOUSING OFFICE
                    </h3>
                    <h4 class="text-2xl font-black text-red-900 uppercase tracking-tighter">
                        CITIZEN'S CHARTER
                    </h4>
                </div>
                
                <div class="pt-20 space-y-1">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Provincial Urban Development and Housing Office</p>
                    <p class="text-[9px] text-gray-400 italic">Citizen's Charter 2026</p>
                </div>
                
                <div class="absolute bottom-4 right-4 text-[10px] font-bold text-gray-300 uppercase">2026</div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center gap-4">
                <button class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-red-700 transition-all">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <span class="text-xs font-bold text-gray-500 uppercase">Page 1 of 7</span>
                <button class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-red-700 transition-all">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>

        <p class="text-center text-xs text-gray-400 italic">
            For inquiries about this document, please contact our office directly.
        </p>
    </div>

</div>
@endsection
