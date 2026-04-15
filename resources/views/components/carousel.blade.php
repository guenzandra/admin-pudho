@php
    $autoPlayInterval = $autoPlayInterval ?? 5000;
    $carouselId = 'carousel-' . uniqid();
@endphp

<div
    class="relative w-full rounded-lg overflow-hidden bg-gray-900 aspect-video md:aspect-[21/9]"
    x-data="carousel({{ count($items) }}, {{ $autoPlayInterval }})"
    x-init="init()"
>
    {{-- Slides --}}
    @foreach ($items as $index => $item)
        <div
            class="absolute inset-0 transition-opacity duration-700"
            :class="{{ $index }} === currentIndex ? 'opacity-100' : 'opacity-0 pointer-events-none'"
        >
            <img
                src="{{ $item['image'] }}"
                alt="{{ $item['title'] }}"
                class="w-full h-full object-contain"
            />
            @if (!empty($item['title']))
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent px-6 py-4">
                    <p class="text-white font-semibold text-sm sm:text-base">{{ $item['title'] }}</p>
                </div>
            @endif
        </div>
    @endforeach

    {{-- Previous Button --}}
    <button
        @click="previous()"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white shadow-md z-10 rounded-full p-2"
        aria-label="Previous slide"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    {{-- Next Button --}}
    <button
        @click="next()"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white shadow-md z-10 rounded-full p-2"
        aria-label="Next slide"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Dot Indicators --}}
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
        @foreach ($items as $index => $item)
            <button
                @click="currentIndex = {{ $index }}"
                :class="{{ $index }} === currentIndex ? 'bg-red-600 w-6' : 'bg-white/60 w-2'"
                class="h-2 rounded-full transition-all duration-300"
                aria-label="Go to slide {{ $index + 1 }}"
            ></button>
        @endforeach
    </div>
</div>

@once
@push('scripts')
<script>
    function carousel(total, interval) {
        return {
            currentIndex: 0,
            total: total,
            timer: null,
            init() {
                this.timer = setInterval(() => this.next(), interval);
            },
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.total;
            },
            previous() {
                this.currentIndex = (this.currentIndex - 1 + this.total) % this.total;
            },
        }
    }
</script>
@endpush
@endonce