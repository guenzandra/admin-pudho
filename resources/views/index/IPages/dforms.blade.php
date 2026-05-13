@extends('index.layout')

@section('title', 'Downloadable Forms – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-24">
    
    <!-- Hero Header -->
    <div class="relative bg-gray-900 rounded-[3rem] p-12 md:p-20 overflow-hidden shadow-2xl text-center">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(220,38,38,0.15),_transparent)]"></div>
        <div class="relative z-10 space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/5 border border-white/10 rounded-full">
                <i class="fa-solid fa-file-arrow-down text-red-500 text-[10px]"></i>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Resource Center</span>
            </div>
            <h1 class="text-4xl md:text-7xl font-black text-white uppercase tracking-tighter leading-none">
                Downloadable <span class="text-red-500">Forms</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-400 font-medium max-w-3xl mx-auto leading-relaxed">
                Access official documents and applications for housing programs and administrative procedures.
            </p>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 items-start">
        
        <!-- Sticky Sidebar Filters -->
        <div class="lg:col-span-1 lg:sticky lg:top-24 space-y-8">
            <div class="space-y-4">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4">Filter by Category</p>
                <div class="flex flex-col gap-2" id="categoryFilters">
                    <button class="w-full text-left px-6 py-4 rounded-2xl border border-transparent bg-gray-900 text-white text-[10px] font-black uppercase tracking-widest shadow-xl transition-all" data-category="all">
                        All Documents
                    </button>
                    @foreach(['Housing Programs', 'Registration', 'General', 'Support', 'Inspection', 'Training', 'Loans'] as $cat)
                    <button class="w-full text-left px-6 py-4 rounded-2xl border border-gray-100 bg-white text-gray-500 text-[10px] font-black uppercase tracking-widest hover:border-red-200 hover:text-red-700 hover:shadow-xl transition-all" data-category="{{ str($cat)->slug() }}">
                        {{ $cat }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Quick Help Box -->
            <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 space-y-4">
                <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center text-white shadow-lg">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-tight">Need Assistance?</h3>
                <p class="text-[11px] text-gray-500 font-medium leading-relaxed">If you're unsure which form you need, contact our technical division.</p>
                <a href="mailto:pudho@laguna.gov.ph" class="block text-[10px] font-black text-red-600 uppercase tracking-widest border-b border-red-100 hover:border-red-600 transition-all w-fit">Email Support</a>
            </div>
        </div>

        <!-- Forms Grid Section -->
        <div class="lg:col-span-3 space-y-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="formsGrid">
                @php
                    $forms = [
                        ['name' => 'Evaluation and Feedback Form', 'category' => 'Support', 'icon' => 'fa-comment-dots', 'desc' => 'Form for evaluating services and providing feedback to PUDHO', 'file' => '001-EVALUATION-AND-FEEDBACK-FORM.docx'],
                        ['name' => 'Learning Action Plan (LAP) Form', 'category' => 'Training', 'icon' => 'fa-graduation-cap', 'desc' => 'Action plan form for learning and development sessions', 'file' => '002-LEARNING-ACTION-PLAN-LAP-Form.docx'],
                        ['name' => 'Complaints and Arbitration Report', 'category' => 'Support', 'icon' => 'fa-gavel', 'desc' => 'Report form for filing housing-related complaints and arbitration', 'file' => '003-COMPLAINTS-AND-ARBITRATION-REPORT.doc'],
                        ['name' => 'Activity Evaluation Report', 'category' => 'General', 'icon' => 'fa-chart-line', 'desc' => 'Standard report for evaluating conducted activities and events', 'file' => '004-ACTIVITY-EVALUATION-REPORT.docx'],
                        ['name' => 'Preliminary Information Sheet', 'category' => 'General', 'icon' => 'fa-user-plus', 'desc' => 'Initial information gathering sheet for housing applicants', 'file' => '005-PRELIMINARY-INFORMATION-SHEET.doc'],
                        ['name' => 'Executive Summary of HOA', 'category' => 'Registration', 'icon' => 'fa-users-gear', 'desc' => 'Summary template for Homeowners Association registration', 'file' => '006-EXECUTIVE-SUMMARY-OF-HOA.doc'],
                        ['name' => 'Socio-Eco Form', 'category' => 'General', 'icon' => 'fa-users', 'desc' => 'Socio-economic profiling form for community members', 'file' => '007-SOCIO-ECO-FORM.docx'],
                        ['name' => 'Checklist for PUDHO Certification', 'category' => 'General', 'icon' => 'fa-list-check', 'desc' => 'Requirements checklist for obtaining PUDHO certification', 'file' => '008-CHECKLIST-OF-REQUIREMENTS-FOR-ISSUANCE-OF-PUDHO-CERTIFICATION.docx'],
                        ['name' => 'Routing Slip (External)', 'category' => 'General', 'icon' => 'fa-route', 'desc' => 'Standard routing slip for external document tracking', 'file' => '011-ROUTING-SLIP-External.docx'],
                        ['name' => 'Interoffice Routing Slip', 'category' => 'General', 'icon' => 'fa-shuffle', 'desc' => 'Standard routing slip for internal office document flow', 'file' => '012-INTEROFFICE-ROUTING-SLIP.docx'],
                        ['name' => 'Attendance Sheet', 'category' => 'General', 'icon' => 'fa-clipboard-user', 'desc' => 'General attendance sheet for meetings and activities', 'file' => '013-ATTENDANCE-SHEET.doc'],
                    ];
                @endphp

                @foreach($forms as $form)
                <div class="bg-white rounded-[2.5rem] border border-gray-200 p-8 flex flex-col justify-between group hover:shadow-2xl hover:border-red-200 hover:shadow-red-900/5 transition-all duration-300 form-card" data-cat="{{ str($form['category'])->slug() }}">
                    <div class="space-y-6">
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-red-600 group-hover:text-white transition-all shadow-sm">
                                <i class="fa-solid {{ $form['icon'] ?? (str($form['file'])->endsWith(['.doc', '.docx']) ? 'fa-file-word' : 'fa-file-pdf') }} text-xl"></i>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-base font-black text-gray-900 leading-tight group-hover:text-red-700 transition-colors uppercase tracking-tight">{{ $form['name'] }}</h3>
                                <div class="inline-flex px-2 py-0.5 bg-gray-100 rounded text-[9px] font-bold text-gray-500 uppercase tracking-widest">
                                    {{ $form['category'] }}
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed font-medium">
                            {{ $form['desc'] }}
                        </p>
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between">
                        <span class="text-[9px] font-black text-gray-300 uppercase tracking-[0.2em]">Format: {{ strtoupper(pathinfo($form['file'], PATHINFO_EXTENSION)) }}</span>
                        <a href="{{ asset('forms/' . $form['file']) }}" download="{{ $form['file'] }}" class="flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg active:scale-95">
                            Download <i class="fa-solid fa-download"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- No Results State (Hidden by default) -->
            <div id="noResults" class="hidden py-32 text-center space-y-6">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-gray-300 mx-auto">
                    <i class="fa-solid fa-file-circle-xmark text-3xl"></i>
                </div>
                <div class="space-y-2">
                    <h4 class="text-xl font-black text-gray-900 uppercase tracking-tight">No forms found</h4>
                    <p class="text-sm text-gray-500 font-medium tracking-tight">Try selecting a different category or view all documents.</p>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="bg-gray-50 rounded-[3rem] p-10 md:p-16 border border-gray-100 relative overflow-hidden group">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_rgba(59,130,246,0.03),_transparent)]"></div>
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <h3 class="text-lg font-black text-gray-900 uppercase tracking-tighter">Submission Guidelines</h3>
                        <ul class="space-y-3">
                            @foreach([
                                'Print on standard letter size (8.5 x 11) paper.',
                                'Ensure all signatures are original and in blue ink.',
                                'Submit 3 copies for official registration processes.',
                                'Forms must be submitted within 30 days of filling.'
                            ] as $item)
                            <li class="flex items-start gap-3 text-xs text-gray-600 font-medium">
                                <i class="fa-solid fa-circle-check text-red-600 mt-0.5"></i>
                                {{ $item }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="p-8 bg-white rounded-3xl border border-gray-200 shadow-sm space-y-4">
                         <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 shadow-sm">
                                <i class="fa-solid fa-envelope-open-text text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Electronic Submission</h4>
                                <p class="text-xs font-black text-gray-900">pudho@laguna.gov.ph</p>
                            </div>
                         </div>
                         <p class="text-[10px] text-gray-400 font-medium leading-relaxed">
                            For preliminary assessment, you may send scanned copies of your forms via email. Physical copies are still required for final approval.
                         </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('#categoryFilters button');
        const cards = document.querySelectorAll('.form-card');
        const noResults = document.getElementById('noResults');

        filters.forEach(btn => {
            btn.addEventListener('click', () => {
                const category = btn.getAttribute('data-category');

                // Update Button Styles
                filters.forEach(b => {
                    b.classList.remove('bg-gray-900', 'text-white', 'shadow-xl');
                    b.classList.add('bg-white', 'text-gray-500', 'border-gray-100');
                });
                btn.classList.add('bg-gray-900', 'text-white', 'shadow-xl');
                btn.classList.remove('bg-white', 'text-gray-500', 'border-gray-100');

                // Filter Cards
                let foundMatch = false;
                cards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-cat') === category) {
                        card.style.display = 'flex';
                        foundMatch = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Handle No Results
                if (foundMatch) {
                    noResults.classList.add('hidden');
                } else {
                    noResults.classList.remove('hidden');
                }
            });
        });
    });
</script>
@endsection
