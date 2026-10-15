{{-- Header gelap untuk halaman dalam. Variabel: $eyebrow, $title, $word (opsional), $sub (opsional) --}}
<section class="page-hero">
    <span class="page-hero-word">{{ $word ?? $title }}</span>
    <div class="relative max-w-7xl mx-auto px-6 py-14 md:py-20">
        <p class="eyebrow">{{ $eyebrow }}</p>
        <h1 class="text-4xl md:text-6xl font-black tracking-tight mt-2 uppercase">{{ $title }}</h1>
        @isset($sub)
            <p class="text-neutral-400 mt-3 max-w-xl">{{ $sub }}</p>
        @endisset
    </div>
</section>
