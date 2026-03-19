<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Dashboard' }} | {{ config('app.name', 'Laravel') }}</title>

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
    <body class="font-sans antialiased text-main">
        <div class="min-h-screen flex">
            @include('layouts.sidebar')

            <!-- Page Content -->
            <main class="flex-1 ml-[260px] p-8">
                @isset($header)
                    <header class="mb-8 animate-fade-in">
                        <div class="max-w-7xl mx-auto">
                            <h2 class="text-3xl font-extrabold tracking-tight text-main">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endisset

                <div class="animate-fade-in">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
