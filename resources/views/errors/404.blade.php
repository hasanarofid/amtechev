<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Not Found | {{ config('app.name', 'AMTECH EV Specialist') }}</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #000000; color: #ffffff; }
        .hero-bg {
            background-image: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.9)), url('{{ asset('storage/ev_hero_bg_1773856111374.png') }}');
            background-size: cover;
            background-position: center;
        }
        .btn-ev { display: inline-block; padding: 14px 32px; background-color: #22c55e; color: black; border-radius: 99px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; transition: all 0.3s ease; }
        .btn-ev:hover { background-color: #16a34a; transform: translateY(-2px); box-shadow: 0 4px 20px rgba(34, 197, 94, 0.4); }
    </style>
</head>
<body class="antialiased h-screen flex items-center justify-center p-6 hero-bg">

    <div class="max-w-lg w-full text-center">
        <div class="mb-10">
            <a href="/">
                <img src="{{ asset('logo/amtech-removebg.png') }}" alt="Logo" class="h-16 w-auto mx-auto mb-8 animate-bounce">
            </a>
            <h1 class="text-8xl font-black mb-4 tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">404</h1>
            <h2 class="text-3xl font-bold mb-4 tracking-tight">Page Not Found</h2>
            <p class="text-gray-400 mb-10 text-lg">The charging station you're looking for seems to be offline or repositioned. Let's get you back on track.</p>
            
            <div class="bg-white/5 backdrop-blur-xl p-1 rounded-full border border-white/10 shadow-2xl inline-block">
                <a href="{{ route('home') }}" class="btn-ev">Back to Home</a>
            </div>
        </div>
        
        <div class="mt-12">
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-gray-500">Amtech EV Specialist &copy; {{ date('Y') }}</p>
        </div>
    </div>

</body>
</html>
