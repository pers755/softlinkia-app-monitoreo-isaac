<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Softlinkia | Monitoreo</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="antialiased bg-[#FDFDFC] text-[#1b1b18] font-sans">
        
        @if (Route::has('login'))
            <nav class="fixed top-0 right-0 p-8 z-50">
                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold hover:text-blue-600 transition-colors">Registrarse</a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif

        <main class="relative flex flex-col items-center justify-center min-h-screen px-6">
            
            <div class="mb-8 flex items-center space-x-2 bg-green-50 border border-green-100 px-4 py-1.5 rounded-full shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-[11px] font-bold text-green-700 uppercase tracking-widest">Sistemas Online</span>
            </div>

            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-3xl shadow-xl shadow-blue-200 mb-6 transform hover:rotate-3 transition-transform">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl md:text-6xl font-black tracking-tighter uppercase mb-4">
                    SOFT<span class="text-blue-600">LINKIA</span>
                </h1>
                <p class="text-lg text-gray-500 font-medium max-w-lg mx-auto leading-relaxed">
                    Supervisión técnica y gestión de incidencias en tiempo real para infraestructura de red y dispositivos IoT.
                </p>
            </div>

            <div class="flex flex-col items-center space-y-4">
                <a href="{{ route('login') }}" class="inline-flex items-center px-10 py-4 bg-[#1b1b18] text-white font-bold rounded-2xl hover:bg-blue-600 transition-all duration-300 shadow-xl hover:shadow-blue-200">
                    Entrar al Panel
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
                <p class="text-xs text-gray-400 font-semibold tracking-wide">HERMOSILLO, SONORA</p>
            </div>

            <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-4 w-full max-w-2xl opacity-60">
                <div class="border border-gray-100 p-4 rounded-xl text-center">
                    <span class="block text-xl font-bold italic">0.2ms</span>
                    <span class="text-[10px] text-gray-400 uppercase font-black">Latencia</span>
                </div>
                <div class="border border-gray-100 p-4 rounded-xl text-center">
                    <span class="block text-xl font-bold italic">100%</span>
                    <span class="text-[10px] text-gray-400 uppercase font-black">Uptime</span>
                </div>
                <div class="border border-gray-100 p-4 rounded-xl text-center">
                    <span class="block text-xl font-bold italic">SSL</span>
                    <span class="text-[10px] text-gray-400 uppercase font-black">Secure</span>
                </div>
                <div class="border border-gray-100 p-4 rounded-xl text-center">
                    <span class="block text-xl font-bold italic">24/7</span>
                    <span class="text-[10px] text-gray-400 uppercase font-black">Soporte</span>
                </div>
            </div>

        </main>
    </body>
</html>