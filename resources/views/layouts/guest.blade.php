<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">

        <title>{{ $title ?? 'Welcome' }} | Amtech EV Specialist</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/premium.css', 'resources/js/app.js'])
        <script>
            (function() {
                const theme = localStorage.getItem('theme') || 'dark';
                document.documentElement.setAttribute('data-theme', theme);
            })();
        </script>
    </head>
    <body class="font-sans antialiased text-main bg-black min-h-screen relative overflow-x-hidden">
        <!-- Dynamic Background -->
        <div class="fixed inset-0 z-[-1] transition-all duration-1000">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000" 
                 style="background-image: url('{{ $background ?? asset('bg/member-login.png') }}');">
            </div>
            <!-- Overlay to ensure readability and "brightness" as requested -->
            <div class="absolute inset-0 bg-white/20 backdrop-blur-[2px]"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/">
                    <img src="/logo/amtech-removebg.png" alt="Amtech EV Logo" class="h-16 w-auto">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 glass-card animate-fade-in">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
