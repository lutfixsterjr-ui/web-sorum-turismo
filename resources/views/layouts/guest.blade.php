<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TURISMO</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,800,900" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-neutral-900">
        <div class="min-h-screen relative flex flex-col items-center justify-center px-6 py-12 bg-neutral-950 overflow-hidden">
            <span class="page-hero-word !text-[16vw]">TURISMO</span>
            <div class="absolute inset-0 hero-glow"></div>

            <a href="{{ route('home') }}" class="relative text-3xl font-black tracking-[0.3em] text-white">
                TURISMO<span class="text-red-600">.</span>
            </a>

            <div class="relative w-full sm:max-w-md mt-8 p-8 bg-white shadow-2xl">
                {{ $slot }}
            </div>

            <a href="{{ route('home') }}" class="relative mt-8 text-[11px] font-bold tracking-[0.25em] text-neutral-500 hover:text-white transition">← KEMBALI KE BERANDA</a>
        </div>
    </body>
</html>
