@extends('index.layout')

@section('title', 'FAQS – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-20">
    
    <!-- FAQ Hero -->
    <div class="relative bg-gray-900 rounded-[3rem] p-12 md:p-20 overflow-hidden shadow-2xl text-center">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(220,38,38,0.1),_transparent)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(59,130,246,0.05),_transparent)]"></div>
        
        <div class="relative z-10 space-y-8">
            <div class="space-y-4">
                <span class="text-[10px] font-black text-red-500 uppercase tracking-[0.4em] block">Knowledge Center</span>
                <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter leading-tight">
                    Frequently Asked <span class="text-red-600">Questions</span>
                </h1>
            </div>

            <!-- Mock Search Bar (Aesthetic only) -->
            <div class="max-w-2xl mx-auto relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-red-900 rounded-2xl blur opacity-20 group-hover:opacity-40 transition-opacity"></div>
                <div class="relative flex items-center bg-white rounded-2xl shadow-2xl overflow-hidden">
                    <div class="pl-6 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" placeholder="Search for housing programs, requirements, or documents..." class="w-full px-6 py-5 text-sm font-medium text-gray-900 placeholder-gray-400 focus:outline-none" readonly>
                    <div class="pr-3">
                        <button class="bg-gray-900 text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all">Search</button>
                    </div>
                </div>
            </div>

            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-4">
                <span>Recent Updates</span>
                <span class="w-1 h-1 bg-gray-600 rounded-full"></span>
                <span>2026 Housing Guidelines</span>
            </p>
        </div>
    </div>

    @php
        $faqCategories = [
            [
                'id' => 'housing',
                'name' => 'Housing Assistance',
                'icon' => 'fa-house-chimney-user',
                'faqs' => [
                    ['q' => 'What are the requirements for housing assistance?', 'a' => 'The requirements include valid government IDs (2 copies), proof of income or Indigency Certificate, certificate of no land holding from the Assessor\'s Office, and a recent residence certificate from your barangay. Specific programs like CMP may require additional community profiling.'],
                    ['q' => 'How long does the application process take?', 'a' => 'The processing time varies depending on the specific program and the completeness of your documentation. Initial assessment and profiling are typically completed within 15-30 working days. National agency approvals (SHFC/DHSUD) follow their respective timelines.'],
                    ['q' => 'Who are eligible for the socialized housing program?', 'a' => 'Eligibility is prioritized for underprivileged and homeless citizens, as defined by RA 7279 (UDHA), who do not own any real property and have a monthly income within the socialized housing limit set by the national government.'],
                ]
            ],
            [
                'id' => 'hoa',
                'name' => 'HOA Registration',
                'icon' => 'fa-users-gear',
                'faqs' => [
                    ['q' => 'What are the requirements for HOA registration?', 'a' => 'Standard requirements include Approved Articles of Incorporation, Bylaws, a complete list of members with signatures, and minutes of the organizational meeting. You must also provide a certification from the developer or LGU regarding the site status.'],
                    ['q' => 'Can we register an existing community group?', 'a' => 'Yes, informal community groups can be formalized into a Homeowners Association (HOA) provided they meet the legal requirements under RA 9904 and have the consensus of the majority of bona fide residents.'],
                    ['q' => 'Is there a registration fee for HOAs?', 'a' => 'Yes, there are statutory fees for registration, filing, and name reservation as mandated by DHSUD. Please consult our technical division for the current schedule of fees as these are subject to periodic updates.'],
                ]
            ],
            [
                'id' => 'cmp',
                'name' => 'CMP & Loans',
                'icon' => 'fa-hand-holding-dollar',
                'faqs' => [
                    ['q' => 'What is the Community Mortgage Program (CMP)?', 'a' => 'The CMP is a mortgage financing program that assists organized associations of underprivileged citizens to purchase and develop land under the concept of community ownership. It is administered by the SHFC with PUDHO providing local technical support.'],
                    ['q' => 'How do we apply for a CMP loan?', 'a' => 'The community association must first be legally registered. Applications must be facilitated through an accredited CMP Originator (like PUDHO or accredited NGOs). We guide associations from profiling to loan release.'],
                    ['q' => 'What is the maximum loan term?', 'a' => 'Standard CMP loans typically offer a term of up to 25 to 30 years with highly subsidized interest rates, making it affordable for low-income families. Monthly amortizations are collected through the association.'],
                ]
            ]
        ];
    @endphp

    <!-- Main FAQ Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        
        <!-- Side Navigation -->
        <div class="lg:col-span-1 space-y-6">
            <div class="sticky top-24 space-y-2">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4 mb-4">Categories</p>
                @foreach($faqCategories as $category)
                <button onclick="scrollToCategory('{{ $category['id'] }}')" class="w-full text-left px-6 py-4 rounded-2xl border border-transparent hover:bg-white hover:border-gray-200 hover:shadow-xl transition-all group flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-red-50 group-hover:text-red-700 transition-colors">
                        <i class="fa-solid {{ $category['icon'] }}"></i>
                    </div>
                    <span class="text-xs font-black text-gray-500 group-hover:text-gray-900 uppercase tracking-tight">{{ $category['name'] }}</span>
                </button>
                @endforeach
            </div>
        </div>

        <!-- FAQ Content -->
        <div class="lg:col-span-3 space-y-20">
            @foreach($faqCategories as $category)
            <section id="{{ $category['id'] }}" class="space-y-8 scroll-mt-24">
                <div class="flex items-center gap-6">
                    <div class="w-14 h-14 rounded-2xl bg-red-600 flex items-center justify-center text-white shadow-xl shadow-red-900/20">
                        <i class="fa-solid {{ $category['icon'] }} text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">{{ $category['name'] }}</h2>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @foreach($category['faqs'] as $index => $faq)
                    <div class="faq-item group">
                        <button class="w-full text-left bg-white border border-gray-200 p-6 md:p-8 rounded-[2rem] flex items-start justify-between gap-6 transition-all hover:border-red-200 hover:shadow-2xl hover:shadow-red-900/5 faq-toggle">
                            <span class="text-base md:text-lg font-black text-gray-900 uppercase tracking-tight leading-tight group-hover:text-red-700 transition-colors">{{ $faq['q'] }}</span>
                            <div class="mt-1 w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-red-600 group-hover:text-white transition-all">
                                <i class="fa-solid fa-plus text-[10px]"></i>
                            </div>
                        </button>
                        <div class="faq-answer hidden overflow-hidden transition-all duration-500">
                             <div class="px-8 pb-10 pt-6">
                                 <div class="bg-gray-50 rounded-[2.5rem] p-10 relative overflow-hidden group/ans">
                                     <div class="absolute right-0 bottom-0 opacity-[0.03] group-hover/ans:scale-110 transition-transform">
                                         <i class="fa-solid fa-quote-right text-9xl"></i>
                                     </div>
                                     <p class="text-base text-gray-600 leading-relaxed font-medium relative z-10 italic">
                                         "{{ $faq['a'] }}"
                                     </p>
                                 </div>
                             </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endforeach
        </div>

    </div>

    <!-- Contact Support -->
    <div class="bg-white rounded-[4rem] p-12 md:p-20 border border-gray-100 shadow-sm text-center relative overflow-hidden group">
        <div class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-transparent via-red-600 to-transparent"></div>
        <div class="space-y-10 relative z-10">
            <div class="space-y-4">
                <h3 class="text-3xl font-black text-gray-900 uppercase tracking-tighter leading-none">Could not find what<br>you are looking for?</h3>
                <p class="text-gray-500 font-medium max-w-xl mx-auto">Our dedicated support team is available during office hours (Mon-Fri, 8 AM - 5 PM) to assist you with specialized inquiries.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-[2.5rem] bg-gray-50 border border-gray-100 hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-red-600 shadow-sm mx-auto mb-4">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Call Us</p>
                    <p class="text-sm font-black text-gray-900">(049) 501 0423</p>
                </div>
                <div class="p-8 rounded-[2.5rem] bg-gray-50 border border-gray-100 hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-red-600 shadow-sm mx-auto mb-4">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Email Support</p>
                    <p class="text-sm font-black text-gray-900">pudho@laguna.gov.ph</p>
                </div>
                <div class="p-8 rounded-[2.5rem] bg-gray-50 border border-gray-100 hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-red-600 shadow-sm mx-auto mb-4">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Visit Office</p>
                    <p class="text-sm font-black text-gray-900 leading-tight">Provincial Capitol Compound, Sta. Cruz, Laguna</p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function scrollToCategory(id) {
        document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const faqToggles = document.querySelectorAll('.faq-toggle');

        faqToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const item = toggle.parentElement;
                const answer = item.querySelector('.faq-answer');
                const icon = toggle.querySelector('i');
                const isHidden = answer.classList.contains('hidden');

                if (isHidden) {
                    answer.classList.remove('hidden');
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                    toggle.classList.add('border-red-200', 'bg-gray-50/20');
                    toggle.querySelector('div').classList.add('bg-red-600', 'text-white');
                } else {
                    answer.classList.add('hidden');
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                    toggle.classList.remove('border-red-200', 'bg-gray-50/20');
                    toggle.querySelector('div').classList.remove('bg-red-600', 'text-white');
                }
            });
        });
    });
</script>
@endsection
