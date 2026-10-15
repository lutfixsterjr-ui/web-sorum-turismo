@extends('layouts.turismo')

@section('title', 'Keranjang | TURISMO')

@section('content')
@include('partials.page-header', ['eyebrow' => 'BELANJA', 'title' => 'Keranjang', 'sub' => 'Periksa kembali pilihanmu sebelum membuat pesanan.'])

<div class="max-w-7xl mx-auto px-6 py-14">

    @if($products->isEmpty())
        <div class="border border-dashed border-neutral-300 py-24 text-center">
            <svg class="w-14 h-14 mx-auto text-neutral-300" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12l1 13H5L6 7zM9 7a3 3 0 016 0"/></svg>
            <p class="text-2xl font-black mt-6">KERANJANG MASIH KOSONG</p>
            <p class="text-neutral-500 mt-2">Temukan Sportcar, SUV, atau Sedan favoritmu.</p>
            <a href="{{ route('home') }}#inventory" class="btn btn-dark mt-8">LIHAT KOLEKSI</a>
        </div>
    @else
        <div class="grid lg:grid-cols-[1fr_400px] gap-10 items-start">

            {{-- Daftar item --}}
            <div class="space-y-4">
                @foreach($products as $p)
                    <div class="bg-white border border-neutral-200 flex flex-col sm:flex-row sm:items-center gap-5 p-5">
                        <a href="{{ route('products.show', $p) }}" class="car-stage w-full sm:w-44 aspect-[16/10] flex items-center justify-center p-3 shrink-0">
                            @if($p->image_url)
                                <img src="{{ $p->image_url }}" class="max-h-full object-contain" alt="{{ $p->name }}">
                            @endif
                        </a>

                        <div class="flex-1 min-w-0">
                            <span class="chip">{{ $p->segment_label }}</span>
                            <p class="text-xl font-black uppercase mt-2">{{ $p->name }}</p>
                            <p class="text-sm text-neutral-500 mt-1">{{ \App\Models\Product::rupiah($p->price) }} × {{ $cart[$p->id] }}</p>
                        </div>

                        <div class="sm:text-right">
                            <p class="text-lg font-black">{{ \App\Models\Product::rupiah($p->price * $cart[$p->id]) }}</p>
                            <form action="{{ route('cart.remove', $p) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-xs font-bold tracking-widest hover:underline">HAPUS</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <a href="{{ route('home') }}#inventory" class="inline-block pt-4 text-xs font-bold tracking-widest text-neutral-500 hover:text-black">← LANJUT BELANJA</a>
            </div>

            {{-- Ringkasan + checkout --}}
            <aside class="bg-white border border-neutral-200 p-8 lg:sticky lg:top-28">
                <p class="eyebrow">RINGKASAN</p>
                <div class="flex justify-between items-baseline mt-4 pb-6 border-b">
                    <p class="text-sm font-bold tracking-widest">TOTAL</p>
                    <p class="text-2xl font-black">{{ \App\Models\Product::rupiah($total) }}</p>
                </div>

                @auth
                    <h2 class="text-xl font-black mt-8 mb-6">DATA PEMBELI</h2>

                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf

                        <div class="mb-5">
                            <label class="field-label">NAMA LENGKAP</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" class="field">
                            @error('customer_name') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="field-label">NOMOR TELEPON</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" class="field">
                            @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-8">
                            <label class="field-label">ALAMAT</label>
                            <textarea name="address" rows="3" class="field">{{ old('address') }}</textarea>
                            @error('address') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <button class="btn btn-dark w-full !py-5">BUAT PESANAN</button>
                    </form>
                @else
                    <div class="mt-8 text-center">
                        <p class="text-neutral-600 text-sm mb-5">Login dulu untuk melanjutkan checkout.</p>
                        <a href="{{ route('login') }}" class="btn btn-dark w-full">LOGIN</a>
                        <a href="{{ route('register') }}" class="block mt-4 text-xs font-bold tracking-widest underline hover:text-red-600">BELUM PUNYA AKUN? DAFTAR</a>
                    </div>
                @endauth
            </aside>
        </div>
    @endif
</div>
@endsection
