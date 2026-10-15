@extends('layouts.turismo')

@section('content')
<section class="grid lg:grid-cols-2 min-h-[calc(100vh-5rem)]">

    {{-- Panel kiri: branding --}}
    <div class="hidden lg:flex relative car-stage-dark text-white items-center overflow-hidden">
        <span class="page-hero-word !text-[12vw]">TURISMO</span>
        <div class="relative px-14 xl:px-20 w-full">
            <p class="eyebrow">WELCOME BACK</p>
            <h1 class="text-6xl xl:text-7xl font-black tracking-tight mt-3 leading-[0.95]">DRIVE YOUR<br>DREAM.</h1>
            <p class="text-neutral-400 mt-6 max-w-sm">Masuk untuk menjelajahi koleksi Sportcar, SUV, dan Sedan terbaik kami.</p>
            <img src="{{ asset('img/cars/gt3-rs.png') }}" alt="" class="w-[115%] max-w-none mt-12 -ml-6 drop-shadow-[0_25px_30px_rgba(0,0,0,.6)]">
        </div>
    </div>

    {{-- Panel kanan: form --}}
    <div class="flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md">
            <p class="eyebrow">ACCOUNT</p>
            <h2 class="text-5xl font-black tracking-tight mt-1">LOGIN</h2>

            @if (session('status'))
                <div class="mt-6 bg-green-100 text-green-800 text-sm px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-10">
                @csrf

                {{-- Email --}}
                <div class="mb-6">
                    <label for="email" class="field-label">EMAIL</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="username"
                           class="field">
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label for="password" class="field-label">PASSWORD</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="current-password"
                           class="field">
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember + lupa password --}}
                <div class="flex items-center justify-between mb-8">
                    <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-neutral-600">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="border-neutral-800 text-black focus:ring-0">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-neutral-500 underline hover:text-black">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                        class="btn btn-dark w-full !py-5">
                    LOG IN
                </button>
            </form>

            {{-- Tautan register --}}
            <div class="mt-8 pt-8 border-t text-sm text-neutral-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-black underline hover:text-red-600">
                    Daftar sekarang
                </a>
            </div>
        </div>
    </div>
</section>
@endsection