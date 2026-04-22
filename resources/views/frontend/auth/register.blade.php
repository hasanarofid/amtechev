<!-- resources/views/frontend/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register – {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }}</title>
    
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
<body class="antialiased min-h-screen flex items-center justify-center p-6 hero-bg">

    <div class="max-w-md w-full my-12">
        <div class="text-center mb-10">
            <a href="/">
                <img src="{{ asset('logo/amtech-removebg.png') }}" alt="Logo" class="h-12 w-auto mx-auto mb-6">
            </a>
            <h1 class="text-4xl font-black mb-2 tracking-tight">Join AMTECH</h1>
            <p class="text-gray-400">Experience the future of EV charging</p>
        </div>

        <div class="bg-white/5 backdrop-blur-xl p-10 rounded-[2.5rem] border border-white/10 shadow-2xl">
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-ev-green/10 border border-ev-green/20 text-ev-green text-sm rounded-xl">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded-xl">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus class="input-ev @error('name') border-red-500/50 @enderror" placeholder="John Doe">
                    @error('name')
                        <p class="text-xs text-red-400 mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="input-ev @error('email') border-red-500/50 @enderror" placeholder="name@example.com">
                    @error('email')
                        <p class="text-xs text-red-400 mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Password</label>
                        <div class="relative" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" name="password" required class="input-ev @error('password') border-red-500/50 @enderror pr-10" placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-ev-green focus:outline-none transition-colors">
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.399 8.049 8 4 12 4s8.601 4.049 9.964 8.322a1.012 1.012 0 010 .644C20.601 15.951 16 20 12 20s-8.601-4.049-9.964-8.322z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 20 12 20c1.912 0 3.685-.604 5.12-1.632M17.644 17.644l-11.288-11.288m1.407-1.407A10.477 10.477 0 0112 4c4.756 0 8.774 3.662 10.065 8a10.477 10.477 0 01-2.046 3.774M9.414 9.414a3 3 0 114.242 4.242" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-400 mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Confirm</label>
                        <div class="relative" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" required class="input-ev pr-10" placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-ev-green focus:outline-none transition-colors">
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.399 8.049 8 4 12 4s8.601 4.049 9.964 8.322a1.012 1.012 0 010 .644C20.601 15.951 16 20 12 20s-8.601-4.049-9.964-8.322z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 20 12 20c1.912 0 3.685-.604 5.12-1.632M17.644 17.644l-11.288-11.288m1.407-1.407A10.477 10.477 0 0112 4c4.756 0 8.774 3.662 10.065 8a10.477 10.477 0 01-2.046 3.774M9.414 9.414a3 3 0 114.242 4.242" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-3 text-[11px] text-gray-400 py-2 leading-relaxed">
                    <input type="checkbox" required class="mt-0.5 rounded border-white/10 bg-white/5 text-ev-green focus:ring-ev-green cursor-pointer">
                    <span>By creating an account, I agree to the <a href="#" class="text-white hover:underline transition-all">Terms of Service</a> and <a href="#" class="text-white hover:underline transition-all">Privacy Policy</a>.</span>
                </div>

                <button type="submit" class="btn-ev mt-4">Create Account</button>
            </form>

            <div class="mt-10 pt-8 border-t border-white/5 text-center">
                <p class="text-gray-400 text-sm">Already have an account? <a href="{{ route('user.login') }}" class="text-ev-green font-bold hover:underline ml-1">Log In</a></p>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="/" class="text-xs font-bold uppercase tracking-[0.3em] text-gray-500 hover:text-white transition-colors">← Back to Home</a>
        </div>
    </div>

</body>
</html>
