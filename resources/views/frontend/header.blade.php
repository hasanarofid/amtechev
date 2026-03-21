<!-- resources/views/frontend/header.blade.php -->
<nav class="fixed top-0 left-0 w-full z-50 px-6 lg:px-14 py-5 flex justify-between items-center bg-black/40 backdrop-blur-xl border-b border-white/5">
    <div class="flex items-center gap-3 group cursor-pointer">
        <div class="relative">
            <div class="absolute -inset-2 bg-ev-green/20 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <img src="/logo/amtech-removebg.png" alt="Amtech EV Logo" class="h-9 w-auto relative">
        </div>
        <h1 class="text-lg font-bold tracking-tighter hidden md:block text-white">
            AMTECH <span class="text-ev-green italic">EV</span>
        </h1>
    </div>
    
    <div class="hidden md:flex gap-8 items-center text-sm font-medium text-gray-300">
        <a href="{{ route('home') }}" class="transition-all duration-300 {{ request()->routeIs('home') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
            Home
        </a>
        <a href="{{ route('catalog') }}" class="transition-all duration-300 {{ request()->routeIs('catalog') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
            EV Chargers Catalogue
        </a>
        <a href="{{ route('installation') }}" class="transition-all duration-300 {{ request()->routeIs('installation') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
            EV Charger Installation
        </a>
        <a href="{{ route('blog') }}" class="transition-all duration-300 {{ request()->routeIs('blog') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
            Blogs
        </a>
        <a href="{{ route('contact') }}" class="transition-all duration-300 {{ request()->routeIs('contact') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
            Contact Us
        </a>
    </div>

    <div class="flex items-center gap-6">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-ev px-6 py-2 text-[10px] uppercase font-black tracking-widest">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-white hover:text-ev-green transition-colors uppercase text-[10px] font-black tracking-[0.2em]">Login</a>
            @endauth
        @endif
    </div>
</nav>
