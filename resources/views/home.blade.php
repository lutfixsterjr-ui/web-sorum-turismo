@extends('layouts.turismo')

@section('title', 'TURISMO | Sportcar, SUV & Sedan Premium')

@section('content')

@php
    // Urutan slide hero mengikuti kategori
    $heroOrder = ['sportcar', 'suv', 'sedan'];
    $titles = ['sportcar' => 'SPORTCAR SERIES', 'suv' => 'SUV SERIES', 'sedan' => 'SEDAN SERIES'];
    $taglines = [
        'sportcar' => 'Performa murni. Lahir di sirkuit.',
        'suv'      => 'Lincah di kota, siap untuk petualangan.',
        'sedan'    => 'Kemewahan yang tetap bertenaga.',
    ];
    $heroProducts = collect($heroOrder)->map(fn ($seg) => $products->firstWhere('segment', $seg))->filter();
@endphp

{{-- ================= HERO SLIDER ================= --}}
<section class="bg-neutral-950 text-white overflow-hidden">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            @foreach($heroProducts as $p)
                <div class="swiper-slide">
                    <div class="relative hero-glow min-h-[620px] h-[calc(100vh-5rem)] max-h-[860px] flex flex-col items-center justify-center px-6 pb-16">

                        <span class="absolute inset-0 flex items-center justify-center text-[17vw] font-black whitespace-nowrap text-white/[0.04] select-none pointer-events-none">
                            {{ strtoupper($p->name) }}
                        </span>

                        <div class="hero-copy relative text-center">
                            <p class="eyebrow">{{ $titles[$p->segment] }}</p>
                            <h1 class="text-6xl md:text-8xl font-black tracking-tight mt-2">{{ strtoupper($p->name) }}</h1>
                            <p class="text-neutral-400 mt-3 text-base md:text-lg">{{ $taglines[$p->segment] }}</p>
                        </div>

                        <img src="{{ $p->image_url }}" alt="{{ $p->name }}"
                             class="hero-car relative w-[880px] max-w-[92%] my-8 md:my-10 drop-shadow-[0_30px_40px_rgba(0,0,0,.6)]">

                        <div class="hero-copy relative flex flex-col items-center gap-8">
                            @if($p->power)
                                <div class="grid grid-cols-3 gap-6 md:gap-14 text-center">
                                    <div>
                                        <p class="text-xl md:text-3xl font-black">{{ $p->power }}</p>
                                        <p class="text-[10px] tracking-[0.25em] text-neutral-500 mt-1">TENAGA</p>
                                    </div>
                                    <div>
                                        <p class="text-xl md:text-3xl font-black">{{ $p->acceleration }}</p>
                                        <p class="text-[10px] tracking-[0.25em] text-neutral-500 mt-1">0–100 KM/JAM</p>
                                    </div>
                                    <div>
                                        <p class="text-xl md:text-3xl font-black">{{ $p->top_speed }}</p>
                                        <p class="text-[10px] tracking-[0.25em] text-neutral-500 mt-1">TOP SPEED</p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('products.show', $p) }}" class="btn btn-red">LIHAT DETAIL</a>
                                <a href="#inventory" data-explore="{{ $p->segment }}" class="btn btn-outline">EXPLORE COLLECTIONS</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

{{-- ================= MARQUEE ================= --}}
<section class="bg-red-600 text-white overflow-hidden py-4">
    <div class="marquee-track flex w-max whitespace-nowrap text-xs font-black tracking-[0.35em]">
        @for($i = 0; $i < 2; $i++)
            <div class="flex shrink-0">
                @foreach(['SPORTCAR', 'SUV', 'SEDAN', 'GARANSI RESMI', 'PEMESANAN ONLINE', 'TEST DRIVE', 'LAYANAN PURNAJUAL'] as $word)
                    <span class="mx-8">{{ $word }}</span><span class="opacity-50">●</span>
                @endforeach
            </div>
        @endfor
    </div>
</section>

{{-- ================= 3 KATEGORI ================= --}}
<section class="max-w-7xl mx-auto px-6 pt-24">
    <div class="reveal text-center max-w-2xl mx-auto">
        <p class="eyebrow">KATEGORI</p>
        <h2 class="text-4xl md:text-6xl font-black tracking-tight mt-2">PILIH GAYAMU</h2>
        <p class="text-neutral-500 mt-4">Tiga karakter berbeda, satu standar kualitas yang sama.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mt-14">
        @foreach($heroProducts as $i => $p)
            <a href="{{ route('home', ['kategori' => $p->segment]) }}#inventory" data-explore="{{ $p->segment }}"
               class="reveal car-card group relative block car-stage-dark text-white overflow-hidden aspect-[4/5]"
               style="transition-delay: {{ $i * 120 }}ms">
                <div class="absolute top-6 left-6">
                    <p class="text-[10px] tracking-[0.3em] text-neutral-500">0{{ $i + 1 }}</p>
                    <h3 class="text-3xl font-black mt-1">{{ strtoupper($p->segment_label) }}</h3>
                    <p class="text-neutral-400 text-sm mt-1">{{ $p->name }}</p>
                </div>

                <img src="{{ $p->image_url }}" alt="{{ $p->name }}"
                     class="car-img absolute left-1/2 top-1/2 w-[135%] max-w-none -translate-x-1/2 -translate-y-[10%] drop-shadow-[0_20px_25px_rgba(0,0,0,.6)]">

                <div class="absolute bottom-0 inset-x-0 p-6 flex items-center justify-between bg-gradient-to-t from-black/80 to-transparent">
                    <span class="text-xs font-bold tracking-[0.25em]">LIHAT KOLEKSI</span>
                    <span class="w-10 h-10 rounded-full border border-white/30 flex items-center justify-center group-hover:bg-red-600 group-hover:border-red-600 transition">→</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

{{-- ================= INVENTORY ================= --}}
<section id="inventory" class="max-w-7xl mx-auto px-6 pt-28 scroll-mt-20">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
            <p class="eyebrow">INVENTORY</p>
            <h2 class="text-5xl md:text-6xl font-black tracking-tight mt-1">THE COLLECTION</h2>
        </div>
        <div class="relative w-full md:w-96">
            <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></svg>
            <input id="search" type="text" placeholder="CARI MODEL..." class="field !pl-11 tracking-widest text-xs">
        </div>
    </div>

    {{-- Tab kategori --}}
    <div id="tabs" class="flex gap-8 mt-12 border-b overflow-x-auto overflow-y-hidden">
        @foreach(['all' => 'SEMUA MODEL', 'sportcar' => 'SPORTCAR', 'suv' => 'SUV', 'sedan' => 'SEDAN'] as $key => $label)
            <button data-filter="{{ $key }}"
                    class="tab pb-4 -mb-px text-xs font-bold tracking-widest whitespace-nowrap border-b-2 border-transparent text-neutral-500 hover:text-black transition">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Grid produk --}}
    <div id="grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
        @foreach($products as $p)
            <article class="card car-card group reveal bg-white border border-neutral-200 hover:shadow-2xl hover:-translate-y-1 transition duration-300"
                     data-segment="{{ $p->segment }}" data-name="{{ strtolower($p->name) }}">

                <a href="{{ route('products.show', $p) }}" class="relative block car-stage aspect-[4/3] overflow-hidden">
                    <span class="chip absolute top-4 left-4 bg-white z-10">{{ $p->segment_label }}</span>

                    @if($p->image_url)
                        <img src="{{ $p->image_url }}" alt="{{ $p->name }}"
                             class="car-img absolute inset-0 m-auto w-[88%] max-h-[80%] object-contain drop-shadow-[0_18px_18px_rgba(0,0,0,.25)]">
                    @else
                        <span class="absolute inset-0 flex items-center justify-center text-neutral-400 text-sm">NO IMAGE</span>
                    @endif
                </a>

                <div class="p-6">
                    <div class="flex items-start justify-between gap-4">
                        <h3 class="text-2xl font-black uppercase">{{ $p->name }}</h3>
                        <div class="text-right shrink-0">
                            <p class="text-[10px] tracking-widest text-neutral-500">MULAI DARI</p>
                            <p class="text-base font-black">{{ $p->price_formatted }}</p>
                        </div>
                    </div>

                    <p class="text-neutral-500 text-sm mt-3 line-clamp-2">{{ $p->description }}</p>

                    @if($p->power)
                        <div class="grid grid-cols-3 gap-2 mt-5 pt-5 border-t text-center">
                            <div>
                                <p class="text-sm font-black">{{ $p->power }}</p>
                                <p class="text-[9px] tracking-widest text-neutral-500">TENAGA</p>
                            </div>
                            <div>
                                <p class="text-sm font-black">{{ $p->acceleration }}</p>
                                <p class="text-[9px] tracking-widest text-neutral-500">0–100</p>
                            </div>
                            <div>
                                <p class="text-sm font-black">{{ $p->drivetrain }}</p>
                                <p class="text-[9px] tracking-widest text-neutral-500">PENGGERAK</p>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-[1fr_auto] gap-2 mt-6">
                        <a href="{{ route('products.show', $p) }}" class="btn btn-dark !py-4">LIHAT DETAIL</a>
                        <form action="{{ route('cart.add', $p) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-dark !py-4 !px-5 h-full" title="Tambah ke keranjang" aria-label="Tambah ke keranjang">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <p id="empty" class="hidden text-center text-neutral-500 py-20">Model tidak ditemukan.</p>
</section>

{{-- ================= KEUNGGULAN ================= --}}
<section class="bg-neutral-950 text-white mt-28 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal max-w-2xl">
            <p class="eyebrow">KENAPA TURISMO</p>
            <h2 class="text-4xl md:text-6xl font-black tracking-tight mt-2">BELI MOBIL,<br>TANPA RIBET.</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-px bg-white/10 mt-16 border border-white/10">
            @foreach([
                ['01', 'Unit Terkurasi', 'Hanya model pilihan dari tiga kategori terbaik: Sportcar, SUV, dan Sedan.'],
                ['02', 'Pesan Online', 'Pilih model, masukkan ke keranjang, dan buat pesanan dalam hitungan menit.'],
                ['03', 'Struk Digital', 'Setiap pesanan punya kode unik dan struk yang bisa dicetak atau disimpan PDF.'],
                ['04', 'Dukungan Pembeli', 'Tim kami siap membantu dari pemilihan model sampai serah terima unit.'],
            ] as $i => [$no, $title, $text])
                <div class="reveal bg-neutral-950 p-8 hover:bg-neutral-900 transition" style="transition-delay: {{ $i * 100 }}ms">
                    <p class="text-red-600 font-black text-sm tracking-widest">{{ $no }}</p>
                    <h3 class="text-xl font-black mt-6">{{ $title }}</h3>
                    <p class="text-neutral-400 text-sm mt-3 leading-relaxed">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= CTA ================= --}}
<section class="max-w-7xl mx-auto px-6 pt-24">
    <div class="reveal relative overflow-hidden bg-red-600 text-white px-8 md:px-16 py-16 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
        <span class="absolute -right-10 -bottom-16 text-[18rem] leading-none font-black text-black/10 select-none pointer-events-none">T</span>
        <div class="relative">
            <h2 class="text-3xl md:text-5xl font-black tracking-tight">SIAP MENEMUKAN<br>MOBIL IMPIANMU?</h2>
            <p class="mt-4 text-white/80 max-w-md">Buat akun gratis untuk menyimpan keranjang dan memantau pesananmu.</p>
        </div>
        <div class="relative flex gap-3">
            @auth
                <a href="#inventory" class="btn btn-dark">LIHAT KOLEKSI</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-dark">DAFTAR SEKARANG</a>
                <a href="{{ route('login') }}" class="btn border border-white/60 text-white hover:bg-white hover:text-black">LOGIN</a>
            @endauth
        </div>
    </div>
</section>

@endsection
