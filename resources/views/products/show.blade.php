@extends('layouts.turismo')

@section('title', $product->name . ' | TURISMO')

@section('content')

{{-- ===== Panggung mobil ===== --}}
<section class="relative bg-neutral-950 text-white overflow-hidden">
    <div class="car-stage-dark absolute inset-0"></div>
    <span class="page-hero-word !text-[20vw]">{{ strtoupper($product->name) }}</span>

    <div class="relative max-w-7xl mx-auto px-6 pt-8 pb-16 md:pb-24">
        <nav class="text-[11px] font-bold tracking-[0.2em] text-neutral-500 flex items-center gap-3">
            <a href="{{ route('home') }}" class="hover:text-white">HOME</a>
            <span>/</span>
            <a href="{{ route('home', ['kategori' => $product->segment]) }}#inventory" class="hover:text-white">{{ strtoupper($product->segment_label) }}</a>
            <span>/</span>
            <span class="text-white">{{ strtoupper($product->name) }}</span>
        </nav>

        <div class="text-center mt-10">
            <span class="chip-dark">{{ $product->segment_label }} SERIES</span>
            <h1 class="text-6xl md:text-9xl font-black tracking-tight mt-4">{{ strtoupper($product->name) }}</h1>
        </div>

        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                 class="relative mx-auto w-[960px] max-w-full mt-6 drop-shadow-[0_35px_40px_rgba(0,0,0,.65)]">
        @endif
    </div>
</section>

{{-- ===== Info & pembelian ===== --}}
<section class="max-w-7xl mx-auto px-6 -mt-10 relative">
    <div class="grid lg:grid-cols-[1fr_380px] gap-10">

        <div class="bg-white border border-neutral-200 p-8 md:p-12">
            <p class="eyebrow">TENTANG MODEL</p>
            <h2 class="text-3xl font-black mt-2">{{ $product->name }}</h2>
            <p class="text-neutral-600 leading-relaxed mt-5 max-w-2xl">{{ $product->description }}</p>

            <h3 class="text-xs font-bold tracking-[0.25em] mt-12 mb-5">SPESIFIKASI</h3>
            <dl class="grid grid-cols-2 sm:grid-cols-3 gap-px bg-neutral-200 border border-neutral-200">
                @foreach([
                    'TENAGA'      => $product->power,
                    '0–100 KM/JAM' => $product->acceleration,
                    'KECEPATAN MAKS.' => $product->top_speed,
                    'KAPASITAS'   => $product->seats,
                    'PENGGERAK'   => $product->drivetrain,
                    'SEGMEN'      => $product->segment_label,
                ] as $label => $value)
                    <div class="bg-white p-5">
                        <dt class="text-[10px] font-bold tracking-widest text-neutral-500">{{ $label }}</dt>
                        <dd class="text-xl font-black mt-1">{{ $value ?: '—' }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>

        {{-- Kartu pembelian --}}
        <aside>
            <div class="bg-black text-white p-8 lg:sticky lg:top-28">
                <p class="text-[10px] tracking-[0.3em] text-neutral-400">HARGA MULAI DARI</p>
                <p class="text-3xl md:text-4xl font-black mt-2">{{ $product->price_formatted }}</p>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
                    @csrf
                    <button class="btn btn-red w-full !py-5">TAMBAH KE KERANJANG</button>
                </form>

                <a href="{{ route('cart.index') }}" class="btn btn-outline w-full mt-3 !py-5">LIHAT KERANJANG</a>

                <ul class="mt-8 pt-8 border-t border-white/10 space-y-3 text-sm text-neutral-400">
                    <li class="flex gap-3"><span class="text-red-500">✓</span> Unit baru bergaransi resmi</li>
                    <li class="flex gap-3"><span class="text-red-500">✓</span> Struk pemesanan dapat dicetak</li>
                    <li class="flex gap-3"><span class="text-red-500">✓</span> Konsultasi pembelian gratis</li>
                </ul>
            </div>
        </aside>
    </div>
</section>

{{-- ===== Model lainnya ===== --}}
@if($related->count())
<section class="max-w-7xl mx-auto px-6 pt-24">
    <div class="flex items-end justify-between">
        <div>
            <p class="eyebrow">JELAJAHI</p>
            <h2 class="text-4xl md:text-5xl font-black tracking-tight mt-1">MODEL LAINNYA</h2>
        </div>
        <a href="{{ route('home') }}#inventory" class="hidden sm:inline text-xs font-bold tracking-widest underline hover:text-red-600">SEMUA MODEL</a>
    </div>

    <div class="grid md:grid-cols-2 gap-8 mt-10">
        @foreach($related as $r)
            <a href="{{ route('products.show', $r) }}" class="car-card group block bg-white border border-neutral-200 hover:shadow-2xl transition">
                <div class="relative car-stage aspect-[16/9] overflow-hidden">
                    <span class="chip absolute top-4 left-4 bg-white z-10">{{ $r->segment_label }}</span>
                    @if($r->image_url)
                        <img src="{{ $r->image_url }}" alt="{{ $r->name }}" class="car-img absolute inset-0 m-auto w-[80%] max-h-[75%] object-contain drop-shadow-[0_15px_15px_rgba(0,0,0,.25)]">
                    @endif
                </div>
                <div class="p-6 flex items-center justify-between">
                    <h3 class="text-xl font-black uppercase">{{ $r->name }}</h3>
                    <p class="font-black">{{ $r->price_formatted }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

@endsection
