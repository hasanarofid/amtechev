<!-- resources/views/frontend/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['site_title'] ?? 'AMTECH EV Specialist' }} – Leading EV Charging Solutions in Malaysia</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    
    <!-- SEO -->
    <meta name="description" content="Amtech EV Specialist makes EV charging accessible in Malaysia with high-quality products and services. Best value EV charger installation with FREE site visit.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #030303; color: #ffffff; }
        .hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8)), url('{{ asset('amtechawal.jpeg') }}');
            background-size: cover;
            background-position: center;
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
        .btn-ev:hover {
            background-color: #ffffff;
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(255, 255, 255, 0.2);
        }
        .ev-card {
            background-color: #0a0a0a;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2.5rem;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .ev-card:hover {
            border-color: rgba(34, 197, 94, 0.3);
            transform: translateY(-1rem);
            background-color: #111111;
        }
        .ev-hero-gradient {
            background: radial-gradient(circle at 10% 20%, rgba(34, 197, 94, 0.2) 0%, transparent 60%),
                        radial-gradient(circle at 90% 80%, rgba(34, 197, 94, 0.15) 0%, transparent 60%);
        }
        .ev-glow {
            filter: drop-shadow(0 0 20px rgba(34, 197, 94, 0.3));
        }
        .glassmorphism {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .text-ev-green { color: #22c55e; }
        .bg-ev-green { background-color: #22c55e; }
        .bg-ev-dark { background-color: #050505; }
        
        @keyframes pulse-green {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.5); }
        }
        .animate-pulse-green {
            animation: pulse-green 2s infinite;
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden selection:bg-ev-green selection:text-black">

    @include('frontend.header')

    <main>
        @include('frontend.hero')
        @include('frontend.about')
        @include('frontend.services')
        @include('frontend.quality')
        @include('frontend.products')
        @include('frontend.gallery')
        @include('frontend.mission')
        @include('frontend.brands')
        @include('frontend.testimonials')
        @include('frontend.blog')
    </main>

    @include('frontend.footer')

</body>
</html>
