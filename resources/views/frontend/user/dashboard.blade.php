<!-- resources/views/frontend/user/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard – {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }}</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0a0a0a; color: #ffffff; }
        .sidebar-link { display: flex; items-center: center; gap: 12px; padding: 12px 20px; border-radius: 12px; color: #9ca3af; transition: all 0.3s ease; }
        .sidebar-link:hover { background-color: rgba(255,255,255,0.05); color: #ffffff; }
        .sidebar-link.active { background-color: #22c55e; color: #000000; font-weight: 700; }
        .stat-card { background-color: #141414; border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px; }
    </style>
</head>
<body class="antialiased">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-72 border-r border-white/5 bg-black p-8 fixed h-full hidden lg:block">
            <div class="mb-12">
                <a href="/">
                    <img src="{{ asset('logo/amtech-removebg.png') }}" alt="Logo" class="h-8 w-auto">
                </a>
            </div>

            <nav class="space-y-4">
                <a href="{{ route('user.dashboard') }}" class="sidebar-link active">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="#" class="sidebar-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    My Orders
                </a>
                <a href="#" class="sidebar-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Services
                </a>
                <a href="#" class="sidebar-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    My Profile
                </a>
                <a href="#" class="sidebar-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
            </nav>

            <div class="absolute bottom-8 left-8 right-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full sidebar-link text-red-400 hover:bg-red-500/10 hover:text-red-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4-4H7m6 4v1h3v1h-3v1h3v1h-3v1h3v1h-3v1h3v1h-3v1h3v1h-3v1h3Z"></path></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-72 bg-black min-h-screen">
            <!-- Header -->
            <header class="p-8 border-b border-white/5 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-black tracking-tight">Welcome, {{ Auth::user()->name }}!</h2>
                    <p class="text-sm text-gray-500 mt-1">Ready to power up your EV today?</p>
                </div>
                <div class="flex items-center gap-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold uppercase tracking-widest text-ev-green">Premium Member</p>
                        <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-widest">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="h-12 w-12 rounded-2xl bg-ev-green/10 flex items-center justify-center text-ev-green font-black">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <div class="p-8">
                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="stat-card">
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">Ongoing Orders</p>
                        <div class="flex items-end justify-between">
                            <h3 class="text-4xl font-black">0</h3>
                            <span class="text-xs font-bold text-ev-green py-1 px-3 bg-ev-green/10 rounded-full">Tracking</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">Total Spending</p>
                        <div class="flex items-end justify-between">
                            <h3 class="text-4xl font-black">RM 0.00</h3>
                            <span class="text-xs font-bold text-gray-400 py-1 px-3 bg-white/5 rounded-full">Secure</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">Support Tickets</p>
                        <div class="flex items-end justify-between">
                            <h3 class="text-4xl font-black">0</h3>
                            <a href="#" class="text-xs font-bold text-ev-green hover:underline">Get Help</a>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold">Recent Installations</h3>
                        <a href="#" class="text-sm font-bold text-ev-green hover:underline">View All</a>
                    </div>
                    <div class="bg-[#141414] rounded-3xl border border-white/5 p-12 text-center">
                        <div class="mb-6 h-16 w-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto text-gray-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold mb-2">No installations found</h4>
                        <p class="text-gray-500 text-sm max-w-sm mx-auto">You haven't ordered any installation services yet. Ready to switch to EV charging?</p>
                        <a href="{{ route('catalog') }}" class="mt-8 inline-block px-8 py-3 bg-ev-green text-black font-bold rounded-full hover:scale-105 transition-transform">Browse Catalog</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
