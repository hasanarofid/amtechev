<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AMTECH EV Specialist') – Best Value EV Charging Solutions in Malaysia</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #030303; color: #ffffff; }
        .hero-bg {
            background-image: 
                linear-gradient(to bottom, rgba(3, 3, 3, 0.7) 0%, rgba(3, 3, 3, 0.4) 50%, rgba(3, 3, 3, 0.9) 100%),
                url("{{ (isset($settings['hero_image']) && $settings['hero_image']) ? (Str::startsWith($settings['hero_image'], 'settings/') ? asset('storage/' . $settings['hero_image']) : asset($settings['hero_image'])) : asset('technical_analysis.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .btn-ev {
            padding: 1rem 2.5rem;
            background-color: #22c55e;
            color: #000;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.15em;
            border-radius: 9999px;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.4);
            display: inline-block;
        }
        .ev-card {
            background-color: #0a0a0a;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2.5rem;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .glassmorphism {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .text-ev-green { color: #22c55e; }
        .bg-ev-green { background-color: #22c55e; }
        .font-outline-2 {
            -webkit-text-stroke: 1px currentColor;
            -webkit-text-fill-color: transparent;
        }
        @keyframes reveal {
            from { opacity: 0; transform: translateY(30px); filter: blur(10px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }
        .animate-reveal {
            animation: reveal 1.2s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }
    </style>
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    @stack('styles')
</head>
<body class="antialiased overflow-x-hidden selection:bg-ev-green selection:text-black">

    @include('frontend.header')

    <main>
        @yield('content')
    </main>

    @include('frontend.footer')

    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @stack('scripts')
</body>
</html>
