<!-- resources/views/frontend/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login – {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }}</title>
    
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
        .input-ev { width: 100%; padding: 14px 20px; background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; color: white; font-size: 14px; transition: all 0.3s ease; }
        .input-ev:focus { outline: none; border-color: #22c55e; background-color: rgba(255,255,255,0.1); }
        .btn-ev { width: 100%; padding: 14px; background-color: #22c55e; color: black; border-radius: 99px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; transition: all 0.3s ease; }
        .btn-ev:hover { background-color: #16a34a; transform: translateY(-2px); box-shadow: 0 4px 20px rgba(34, 197, 94, 0.4); }
    </style>
</head>
<body class="antialiased h-screen flex items-center justify-center p-6 hero-bg">

    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <a href="/">
                <img src="{{ asset('logo/amtech-removebg.png') }}" alt="Logo" class="h-12 w-auto mx-auto mb-6">
            </a>
            <h1 class="text-4xl font-black mb-2 tracking-tight whitespace-nowrap">Welcome Back</h1>
            <p class="text-gray-400">Login to your AMTECH account</p>
        </div>

        <div class="bg-white/5 backdrop-blur-xl p-10 rounded-[2.5rem] border border-white/10 shadow-2xl">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" required autofocus class="input-ev" placeholder="name@example.com">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Password</label>
                    <input type="password" name="password" required class="input-ev" placeholder="••••••••">
                </div>
                
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer text-gray-400 hover:text-white transition-colors">
                        <input type="checkbox" name="remember" class="rounded border-white/10 bg-white/5 text-ev-green focus:ring-ev-green">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-ev-green font-bold hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="btn-ev">Log In</button>
            </form>

            <div class="mt-8 pt-8 border-t border-white/5 text-center">
                <p class="text-gray-400 text-sm">Don't have an account? <a href="{{ route('register') }}" class="text-ev-green font-bold hover:underline">Register Now</a></p>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="/" class="text-xs font-bold uppercase tracking-[0.3em] text-gray-500 hover:text-white transition-colors">← Back to Home</a>
        </div>
    </div>

</body>
</html>
