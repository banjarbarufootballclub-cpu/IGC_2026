<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Indonesia Grassroot Championship Regional Kalselteng 2026</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 text-gray-800 font-sans">
        <div class="relative min-h-screen flex flex-col justify-center items-center selection:bg-red-500 selection:text-white">
            
            <!-- Navigasi / Tombol Pojok Kanan Atas -->
            @if (Route::has('login'))
                <div class="absolute top-6 right-6 flex items-center gap-4 z-10">
                    <a href="/admin/login" class="text-sm font-bold text-gray-700 hover:text-red-700 transition">
                        🔑 Login Admin
                    </a>

                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-red-700 hover:bg-red-800 text-white font-bold px-5 py-2.5 rounded-lg text-sm shadow transition focus:outline focus:outline-2 focus:outline-red-500">Register Tim Baru</a>
                        @endif
                    @endauth
                </div>
            @endif

            <!-- Konten Utama -->
            <div class="max-w-4xl mx-auto p-6 text-center">
                <div class="mb-6 flex justify-center">
                   <!-- Bagian Logo Baru (Lebih Besar) -->
<div class="mb-4 flex justify-center">
    <img src="{{ asset('logo-igc.png') }}" alt="Logo Turnamen" class="h-40 w-auto object-contain drop-shadow-md">
</div>
                </div>

                <h1 class="text-3xl md:text-4xl font-black tracking-tight text-gray-900 mb-2">
                    INDONESIA GRASSROOT CHAMPIONSHIP
                </h1>
                
                <h2 class="text-xl font-bold text-red-700 tracking-wide mb-6">
                    REGIONAL KASELTENG 2026
                </h2>

                <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Sistem informasi registrasi pemain dan official secara online. Silakan buat akun untuk mendaftarkan tim, mengunggah dokumen wajib, dan mencetak ID Card.
                </p>
            </div>

        </div>
    </body>
</html>