<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email – AMTECH EV Specialist</title>
    
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
        .btn-ev { width: 100%; padding: 14px; background-color: #22c55e; color: black; border-radius: 99px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; transition: all 0.3s ease; border: none; cursor: pointer; }
        .btn-ev:hover { background-color: #16a34a; transform: translateY(-2px); box-shadow: 0 4px 20px rgba(34, 197, 94, 0.4); }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center p-6 hero-bg">

    <div class="max-w-md w-full my-12">
        <div class="text-center mb-10">
            <a href="/">
                <img src="{{ asset('logo/amtech-removebg.png') }}" alt="Logo" class="h-12 w-auto mx-auto mb-6">
            </a>
            <h1 class="text-4xl font-black mb-2 tracking-tight">Verify Email</h1>
            <p class="text-gray-400">One last step to join the future</p>
        </div>

        <div class="bg-white/5 backdrop-blur-xl p-10 rounded-[2.5rem] border border-white/10 shadow-2xl">
            <div class="mb-8 text-sm text-gray-400 leading-relaxed text-center">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 p-4 bg-ev-green/10 border border-ev-green/20 rounded-2xl text-ev-green text-sm font-medium text-center animate-pulse">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-ev w-full">
                        {{ __('Resend Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-white transition-colors">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="/" class="text-xs font-bold uppercase tracking-[0.3em] text-gray-500 hover:text-white transition-colors">← Back to Home</a>
        </div>
    </div>

</body>
</html>
