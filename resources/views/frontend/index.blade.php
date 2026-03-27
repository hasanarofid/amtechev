<!-- resources/views/frontend/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['site_title'] ?? 'AMTECH EV Specialist' }} – Leading EV Charging Solutions in Malaysia</title>
    
    <!-- SEO -->
    <meta name="description" content="Amtech EV Specialist makes EV charging accessible in Malaysia with high-quality products and services for homes and businesses. Today, enjoy seamless charging!">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0a0a0a; color: #ffffff; }
        .hero-bg {
            background-image: linear-gradient(rgba(10, 10, 10, 0.7), rgba(10, 10, 10, 0.9)), url('{{ asset('storage/ev_hero_bg_1773856111374.png') }}');
            background-size: cover;
            background-position: center;
        }
        .btn-ev {
            padding: 1rem 2rem;
            background-color: #22c55e;
            color: #000;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            border-radius: 9999px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
            display: inline-block;
        }
        .btn-ev:hover {
            background-color: #ffffff;
            transform: scale(1.05);
        }
        .ev-card {
            background-color: #1a1a1a;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2.5rem;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .ev-card:hover {
            border-color: rgba(34, 197, 94, 0.3);
            transform: translateY(-0.5rem);
        }
        .ev-hero-gradient {
            background: radial-gradient(circle at 20% 30%, rgba(34, 197, 94, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 80% 70%, rgba(34, 197, 94, 0.1) 0%, transparent 50%);
        }
        .ev-glow {
            filter: drop-shadow(0 0 15px rgba(34, 197, 94, 0.2));
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    @include('frontend.header')

    <main>
        @include('frontend.hero')
        @include('frontend.features')
        @include('frontend.services')
        @include('frontend.products')
        @include('frontend.brands')
        @include('frontend.testimonials')
        @include('frontend.blog')
    </main>

    @include('frontend.footer')

</body>
</html>
