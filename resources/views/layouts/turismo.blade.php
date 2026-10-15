<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TURISMO | Showroom Mobil Premium')</title>
    <meta name="description" content="TURISMO — showroom mobil premium: Sportcar, SUV, dan Sedan pilihan.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,800,900" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-neutral-900 flex flex-col min-h-screen">

@php
    $cartCount = array_sum(session('cart', []));
    $isHome = request()->routeIs('home');
@endphp

<header class="sticky top-0 z-50 bg-black/95 backdrop-blur text-white border-b border-white/10" x-data="{ menu: false }">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between gap-6">

        {{-- Kiri: menu (mobile) + logo --}}
        <div class="flex items-center gap-4">
            <button @click="menu = true" class="lg:hidden p-1" aria-label="Buka menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-black tracking-[0.3em]">
                TURISMO<span class="text-red-600">.</span>
            </a>
        </div>

        {{-- Tengah: navigasi desktop --}}
        <nav class="hidden lg:flex items-center gap-9 text-[11px] font-bold tracking-[0.2em]">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition {{ $isHome ? 'text-red-500' : '' }}">HOME</a>
            <a href="{{ route('home', ['kategori' => 'sportcar']) }}#inventory" data-explore="sportcar" class="hover:text-red-500 transition">SPORTCAR</a>
            <a href="{{ route('home', ['kategori' => 'suv']) }}#inventory" data-explore="suv" class="hover:text-red-500 transition">SUV</a>
            <a href="{{ route('home', ['kategori' => 'sedan']) }}#inventory" data-explore="sedan" class="hover:text-red-500 transition">SEDAN</a>
            @auth
                <a href="{{ route('orders.index') }}" class="hover:text-red-500 transition {{ request()->routeIs('orders.*') ? 'text-red-500' : '' }}">PESANAN</a>
            @endauth
        </nav>

        {{-- Kanan --}}
        <div class="flex items-center justify-end gap-4 sm:gap-5">

            {{-- Keranjang --}}
            <a href="{{ route('cart.index') }}" class="relative p-1" aria-label="Keranjang">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12l1 13H5L6 7zM9 7a3 3 0 016 0"/>
                </svg>
                @if($cartCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-red-600 text-white text-[10px] font-bold min-w-[18px] h-[18px] px-1 rounded-full flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @auth
                {{-- Dropdown akun --}}
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
                    <button @click="open = !open" class="flex items-center gap-2 text-xs font-bold tracking-widest">
                        <span class="w-9 h-9 rounded-full bg-red-600 text-white flex items-center justify-center">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <span class="hidden md:inline max-w-[120px] truncate">{{ strtoupper(auth()->user()->name) }}</span>
                        <svg class="w-3 h-3 hidden md:block" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                    </button>

                    <div x-show="open" x-cloak x-transition.origin.top.right
                         class="absolute right-0 mt-4 w-56 bg-white text-neutral-900 shadow-2xl border text-sm">
                        <a href="{{ route('profile.edit') }}" class="block px-5 py-3 hover:bg-neutral-100 font-semibold">Profil Saya</a>
                        <a href="{{ route('orders.index') }}" class="block px-5 py-3 hover:bg-neutral-100 font-semibold">Pesanan Saya</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.products.index') }}" class="block px-5 py-3 hover:bg-neutral-100 font-semibold text-red-600">Admin Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="border-t">
                            @csrf
                            <button class="w-full text-left px-5 py-3 hover:bg-neutral-100 font-semibold">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('register') }}" class="hidden sm:inline text-[11px] font-bold tracking-[0.2em] hover:text-red-500 transition">REGISTER</a>
                <a href="{{ route('login') }}" class="btn btn-red !px-6 !py-3">LOGIN</a>
            @endauth
        </div>
    </div>

    {{-- Menu mobile --}}
    <div x-show="menu" x-cloak class="fixed inset-0 z-50 flex" @keydown.escape.window="menu = false">
        <div x-show="menu" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             class="w-80 max-w-[85%] bg-neutral-950 text-white h-full p-8 shadow-2xl overflow-y-auto">
            <div class="flex items-center justify-between mb-12">
                <span class="text-xl font-black tracking-[0.3em]">TURISMO<span class="text-red-600">.</span></span>
                <button @click="menu = false" class="text-sm font-bold" aria-label="Tutup">✕</button>
            </div>

            <nav class="flex flex-col gap-6 text-xl font-black tracking-wide">
                <a href="{{ route('home') }}" @click="menu = false">HOME</a>
                <a href="{{ route('home', ['kategori' => 'sportcar']) }}#inventory" data-explore="sportcar" @click="menu = false">SPORTCAR</a>
                <a href="{{ route('home', ['kategori' => 'suv']) }}#inventory" data-explore="suv" @click="menu = false">SUV</a>
                <a href="{{ route('home', ['kategori' => 'sedan']) }}#inventory" data-explore="sedan" @click="menu = false">SEDAN</a>
                <a href="{{ route('cart.index') }}">KERANJANG</a>

                @auth
                    <div class="border-t border-white/10 pt-6 flex flex-col gap-6">
                        <a href="{{ route('profile.edit') }}">PROFIL</a>
                        <a href="{{ route('orders.index') }}">PESANAN SAYA</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.products.index') }}" class="text-red-500">ADMIN PANEL</a>
                        @endif
                    </div>
                @else
                    <div class="border-t border-white/10 pt-6 flex flex-col gap-6">
                        <a href="{{ route('login') }}">LOGIN</a>
                        <a href="{{ route('register') }}">REGISTER</a>
                    </div>
                @endauth
            </nav>
        </div>
        <div class="flex-1 bg-black/60" @click="menu = false"></div>
    </div>
</header>

{{-- Pesan flash --}}
@if(session('success'))
    <div class="bg-green-50 border-b border-green-200 text-green-800 text-sm text-center py-3 px-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-50 border-b border-red-200 text-red-800 text-sm text-center py-3 px-6">
        {{ session('error') }}
    </div>
@endif

<main class="flex-1">
    @yield('content')
</main>

<footer class="bg-neutral-950 text-neutral-400 mt-24">
    <div class="max-w-7xl mx-auto px-6 py-16 grid gap-12 md:grid-cols-4">
        <div class="md:col-span-2">
            <p class="text-white text-2xl font-black tracking-[0.3em]">TURISMO<span class="text-red-600">.</span></p>
            <p class="mt-5 max-w-sm text-sm leading-relaxed">
                Showroom mobil premium untuk pencinta performa dan kenyamanan.
                Pilih Sportcar, SUV, atau Sedan impianmu dan pesan langsung secara online.
            </p>
        </div>

        <div>
            <p class="text-white text-xs font-bold tracking-[0.25em] mb-5">KOLEKSI</p>
            <ul class="space-y-3 text-sm">
                <li><a href="{{ route('home', ['kategori' => 'sportcar']) }}#inventory" data-explore="sportcar" class="hover:text-white transition">Sportcar Series</a></li>
                <li><a href="{{ route('home', ['kategori' => 'suv']) }}#inventory" data-explore="suv" class="hover:text-white transition">SUV Series</a></li>
                <li><a href="{{ route('home', ['kategori' => 'sedan']) }}#inventory" data-explore="sedan" class="hover:text-white transition">Sedan Series</a></li>
            </ul>
        </div>

        <div>
            <p class="text-white text-xs font-bold tracking-[0.25em] mb-5">AKUN</p>
            <ul class="space-y-3 text-sm">
                @auth
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-white transition">Profil</a></li>
                    <li><a href="{{ route('orders.index') }}" class="hover:text-white transition">Pesanan Saya</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Register</a></li>
                @endauth
                <li><a href="{{ route('cart.index') }}" class="hover:text-white transition">Keranjang</a></li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10">
        <p class="max-w-7xl mx-auto px-6 py-6 text-[11px] tracking-widest">
            © {{ date('Y') }} TURISMO. ALL RIGHTS RESERVED.
        </p>
    </div>
</footer>

</body>
</html>
