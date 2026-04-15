@php
$services = [
    [
        'id'          => 1,
        'icon'        => 'building',
        'title'       => 'Handling of Housing Queries',
        'description' => 'Answers queries from clients, groups, and LGUs regarding housing concerns.',
    ],
    [
        'id'          => 2,
        'icon'        => 'home',
        'title'       => 'Provision of Seminars',
        'description' => 'Conducts seminars on housing programs and services in coordination with national agencies.',
    ],
    [
        'id'          => 3,
        'icon'        => 'filetext',
        'title'       => 'Technical Assistance',
        'description' => 'Provides community organizing, lot research, technical plans, and loan documentation support.',
    ],
    [
        'id'          => 4,
        'icon'        => 'users',
        'title'       => 'Housing Projects (CMP/DPS)',
        'description' => 'Assists community associations in registering to suitable housing programs under RA 7279.',
    ],
    [
        'id'          => 5,
        'icon'        => 'zap',
        'title'       => 'Mediation & Arbitration',
        'description' => 'Handles complaints and housing disputes among homeowners at the provincial level.',
    ],
];

$firstRow  = array_slice($services, 0, 3);
$secondRow = array_slice($services, 3);
@endphp

<section class="py-12">

    {{-- Section Header --}}
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Services</h2>
        <p class="text-gray-600 max-w-2xl mx-auto text-sm">
            The Provincial Urban Development and Housing Office provides comprehensive services to support
            sustainable development and quality housing for all residents of Laguna Province.
        </p>
    </div>

    {{-- First Row — 3 items --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
        @foreach ($firstRow as $service)
            @include('components.partials.service-card', ['service' => $service])
        @endforeach
    </div>

    {{-- Second Row — 2 items centered --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:flex md:justify-center md:gap-6">
        @foreach ($secondRow as $service)
            <div class="md:w-[calc(33.333%-0.75rem)]">
                @include('components.partials.service-card', ['service' => $service])
            </div>
        @endforeach
    </div>

</section>