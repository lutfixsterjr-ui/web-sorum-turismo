@extends('layouts.turismo')

@section('content')
<section class="grid lg:grid-cols-2 min-h-[calc(100vh-5rem)]">

    {{-- Panel kiri: branding --}}
    <div class="hidden lg:flex relative car-stage-dark text-white items-center overflow-hidden">
        <span class="page-hero-word !text-[12vw]">TURISMO</span>
        <div class="relative px-14 xl:px-20 w-full">
            <p class="eyebrow">JOIN US</p>
            <h1 class="text-6xl xl:text-7xl font-black tracking-tight mt-3 leading-[0.95]">START YOUR<br>JOURNEY.</h1>
            <p class="text-neutral-400 mt-6 max-w-sm">Buat akun untuk menyimpan pilihan model, mengelola keranjang, dan memantau pesananmu.</p>
            <img src="{{ asset('img/cars/macan.png') }}" alt="" class="w-[115%] max-w-none mt-12 -ml-6 drop-shadow-[0_25px_30px_rgba(0,0,0,.6)]">
        </div>
    </div>

    {{-- Panel kanan: form --}}
    <div class="flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md">
            <p class="eyebrow">ACCOUNT</p>
            <h2 class="text-5xl font-black tracking-tight mt-1">REGISTER</h2>

            <form method="POST" action="{{ route('register') }}" class="mt-10">
                @csrf

                {{-- Nama --}}
                <div class="mb-6">
                    <label for="name" class="field-label">NAMA</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                           required autofocus autocomplete="name"
                           class="field">
                    @error('name')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-6">
                    <label for="email" class="field-label">EMAIL</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autocomplete="username"
                           class="field">
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label for="password" class="field-label">PASSWORD</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="new-password"
                           class="field">
                    <p class="text-xs text-neutral-500 mt-1">Minimal 8 karakter.</p>
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi password --}}
                <div class="mb-8">
                    <label for="password_confirmation" class="field-label">KONFIRMASI PASSWORD</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           required autocomplete="new-password"
                           class="field">
                    @error('password_confirmation')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="btn btn-dark w-full !py-5">
                    REGISTER
                </button>
            </form>

            <div class="mt-8 pt-8 border-t text-sm text-neutral-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-black underline hover:text-red-600">
                    Login di sini
                </a>
            </div>
        </div>
    </div>
</section>
@endsection