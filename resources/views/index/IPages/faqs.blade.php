@extends('index.layout')

@section('title', 'FAQS – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
    
    <!-- Hero Title -->
    <div class="text-center space-y-4">
        <h1 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter">Frequently Asked Questions</h1>
        <p class="text-xs font-bold text-gray-500 max-w-2xl mx-auto leading-relaxed uppercase tracking-widest">
            Find answers to common questions about our services, housing programs, and registration processes.
        </p>
    </div>

    @php
        $faqCategories = [
            [
                'name' => 'Housing Assistance',
                'faqs' => [
                    ['q' => 'What are the requirements for housing assistance?', 'a' => 'The requirements include valid government IDs, proof of income, certificate of no land holding, and residence certificate from your barangay. Specific programs may require additional documentation.'],
                    ['q' => 'How long does the application process take?', 'a' => 'The processing time varies depending on the specific program and the completeness of your documentation. Generally, an initial assessment is completed within 15-30 working days.'],
                    ['q' => 'Who are eligible for the socialized housing program?', 'a' => 'Eligibility is prioritized for underprivileged and homeless citizens, as defined by RA 7279, who do not own any real property and have a monthly income within the socialized housing limit.'],
                ]
            ],
            [
                'name' => 'HOA Registration',
                'faqs' => [
                    ['q' => 'What are the requirements for HOA registration?', 'a' => 'Requirements include Articles of Incorporation, Bylaws, list of members, and minutes of the organizational meeting. Please refer to the Downloadable Forms section for the complete checklist.'],
                    ['q' => 'Can we register an existing community group?', 'a' => 'Yes, existing community groups can be formalized into a Homeowners Association (HOA) provided they meet the legal requirements and have the consensus of the majority of residents.'],
                    ['q' => 'Is there a registration fee for HOAs?', 'a' => 'Yes, there are statutory fees for registration and filing. Please contact our office for the updated schedule of fees.'],
                ]
            ],
            [
                'name' => 'CMP & Loans',
                'faqs' => [
                    ['q' => 'What is the Community Mortgage Program (CMP)?', 'a' => 'The CMP is a mortgage financing program that assists legally organized associations of underprivileged and homeless citizens to purchase and develop a tract of land under the concept of community ownership.'],
                    ['q' => 'How do we apply for a CMP loan?', 'a' => 'The association must first be registered and accredited. Applications are processed through accredited originators. Our office provides technical assistance throughout this process.'],
                    ['q' => 'What is the maximum loan term?', 'a' => 'Standard CMP loans typically have a maximum term of 25 to 30 years, depending on the current guidelines of the Social Housing Finance Corporation (SHFC).'],
                ]
            ]
        ];
    @endphp

    <!-- FAQ Categories -->
    <div class="max-w-[900px] mx-auto space-y-16">
        @foreach($faqCategories as $category)
            <div class="space-y-6">
                <h2 class="text-lg font-black text-gray-900 uppercase tracking-widest border-l-4 border-red-700 pl-4">
                    {{ $category['name'] }}
                </h2>
                
                <div class="space-y-4">
                    @foreach($category['faqs'] as $index => $faq)
                        <div class="faq-item group">
                            <button class="w-full text-left bg-gray-100 hover:bg-gray-200 p-4 rounded-xl flex items-center justify-between transition-all faq-toggle">
                                <span class="text-sm font-bold text-gray-800 uppercase tracking-tight">{{ $faq['q'] }}</span>
                                <i class="fa-solid fa-chevron-down text-gray-400 group-hover:text-red-700 transition-transform text-xs"></i>
                            </button>
                            <div class="faq-answer hidden overflow-hidden transition-all bg-gray-50/50 rounded-b-xl border-x border-b border-gray-100">
                                <div class="p-6 text-sm text-gray-600 leading-relaxed italic">
                                    {{ $faq['a'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Contact CTA -->
    <div class="max-w-[900px] mx-auto text-center pt-10 border-t border-gray-100">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Still have questions?</p>
        <div class="flex flex-col md:flex-row items-center justify-center gap-6">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-envelope text-red-700"></i>
                <span class="text-xs font-bold text-gray-600">pudho@laguna.gov.ph</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-phone text-red-700"></i>
                <span class="text-xs font-bold text-gray-600">(049) 501 0423</span>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqToggles = document.querySelectorAll('.faq-toggle');

        faqToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const item = toggle.parentElement;
                const answer = item.querySelector('.faq-answer');
                const icon = toggle.querySelector('i');
                const isHidden = answer.classList.contains('hidden');

                // Close other items if you want (optional)
                // document.querySelectorAll('.faq-answer').forEach(el => el.classList.add('hidden'));
                // document.querySelectorAll('.faq-toggle i').forEach(i => i.classList.remove('rotate-180'));

                if (isHidden) {
                    answer.classList.remove('hidden');
                    icon.classList.add('rotate-180', 'text-red-700');
                    toggle.classList.add('bg-white', 'shadow-sm', 'border', 'border-gray-100', 'rounded-b-none');
                } else {
                    answer.classList.add('hidden');
                    icon.classList.remove('rotate-180', 'text-red-700');
                    toggle.classList.remove('bg-white', 'shadow-sm', 'border', 'border-gray-100', 'rounded-b-none');
                }
            });
        });
    });
</script>
@endsection

