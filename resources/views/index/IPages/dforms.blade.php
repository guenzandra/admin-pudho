@extends('index.layout')

@section('title', 'Downloadable Forms – Provincial Urban Development & Housing Office')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
    
    <!-- Hero Title -->
    <div class="text-center space-y-4">
        <h1 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tighter">Downloadable Forms</h1>
        <p class="text-xs font-bold text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Access and download all necessary forms for your transactions with the Provincial Urban Development and Housing Office.
        </p>
    </div>

    <!-- Category Filters -->
    <div class="flex flex-wrap justify-center gap-2 max-w-4xl mx-auto" id="categoryFilters">
        <button class="px-4 py-1.5 rounded-full border border-gray-200 text-[10px] font-bold uppercase tracking-widest bg-gray-900 text-white transition-all hover:bg-gray-800" data-category="all">All Categories</button>
        @foreach(['Housing Programs', 'Registration', 'General', 'Support', 'Inspection', 'Training', 'Loans'] as $cat)
        <button class="px-4 py-1.5 rounded-full border border-gray-200 text-[10px] font-bold uppercase tracking-widest bg-white text-gray-600 transition-all hover:border-red-200 hover:text-red-700" data-category="{{ Str::slug($cat) }}">{{ $cat }}</button>
        @endforeach
    </div>

    <!-- Forms Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="formsGrid">
        @php
            $forms = [
                ['name' => 'Application Form for Housing Assistance', 'category' => 'Housing Programs', 'desc' => 'Complete application form for requesting housing assistance programs'],
                ['name' => 'Community Association Registration Form', 'category' => 'Registration', 'desc' => 'Form for registering a community association with the office'],
                ['name' => 'Inquiry Form', 'category' => 'General', 'desc' => 'Submit inquiries and queries to the office'],
                ['name' => 'Complaint Form', 'category' => 'Support', 'desc' => 'File complaints and concerns regarding housing matters'],
                ['name' => 'Site Inspection Request Form', 'category' => 'Inspection', 'desc' => 'Request a site inspection for housing projects'],
                ['name' => 'Seminar Registration Form', 'category' => 'Training', 'desc' => 'Register for seminars and training programs'],
                ['name' => 'Loan Application Form', 'category' => 'Loans', 'desc' => 'Apply for Community Mortgage Program (CMP) loans'],
                ['name' => 'Technical Assistance Request', 'category' => 'General', 'desc' => 'Request technical assistance for community projects'],
            ];
        @endphp

        @foreach($forms as $form)
        <div class="bg-white rounded-2xl border border-gray-200 p-6 flex flex-col justify-between group hover:shadow-lg hover:border-red-200 transition-all form-card" data-cat="{{ Str::slug($form['category']) }}">
            <div class="space-y-4">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-600 shrink-0">
                        <i class="fa-solid fa-file-pdf text-xl"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-sm font-bold text-gray-900 group-hover:text-red-900 transition-colors">{{ $form['name'] }}</h3>
                        <p class="text-[11px] text-gray-500 leading-relaxed">{{ $form['desc'] }}</p>
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest pt-1">Category: {{ $form['category'] }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-4 border-t border-gray-50 flex justify-end">
                <a href="#" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-red-700 transition-colors flex items-center gap-2">
                    Download Form
                    <i class="fa-solid fa-download"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Information Box -->
    <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-8 space-y-4 max-w-4xl mx-auto">
        <h2 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
            <i class="fa-solid fa-info-circle text-blue-500"></i>
            Information
        </h2>
        <ul class="space-y-2 text-xs text-gray-600 leading-relaxed list-disc pl-5 font-medium">
            <li>All forms are available in PDF format for easy printing and filling</li>
            <li>Completed forms can be submitted in person or via email to pudho@laguna.gov.ph</li>
            <li>Please ensure all required fields are completed before submission</li>
            <li>Contact our office if you need assistance filling out any form</li>
        </ul>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('#categoryFilters button');
        const cards = document.querySelectorAll('.form-card');

        filters.forEach(btn => {
            btn.addEventListener('click', () => {
                const category = btn.getAttribute('data-category');

                // Update Button Styles
                filters.forEach(b => {
                    b.classList.remove('bg-gray-900', 'text-white');
                    b.classList.add('bg-white', 'text-gray-600');
                });
                btn.classList.add('bg-gray-900', 'text-white');
                btn.classList.remove('bg-white', 'text-gray-600');

                // Filter Cards
                cards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-cat') === category) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection
