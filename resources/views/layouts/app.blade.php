<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">

        <title>{{ $title ?? 'Dashboard' }} | {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/premium.css', 'resources/js/app.js'])
        @stack('styles')
        <script>
            (function() {
                const theme = localStorage.getItem('theme') || 'dark';
                document.documentElement.setAttribute('data-theme', theme);
            })();
        </script>
    </head>
    <body class="font-sans antialiased text-main" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex flex-col lg:flex-row">
            <!-- Sidebar Overlay -->
            <div 
                x-show="sidebarOpen" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebarOpen = false"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[110] lg:hidden"
                style="display: none;"
            ></div>


            @include('layouts.sidebar')

            <!-- Page Content -->
            <main class="flex-1 lg:ml-[260px] p-4 lg:p-8 relative">
            <!-- Professional Responsive Navigation Header -->
            <div class="sticky lg:absolute top-0 right-0 left-0 lg:left-0 z-50 
                        bg-ev-dark/80 dark:bg-black/40 backdrop-blur-md lg:backdrop-blur-none border-b border-glass-border lg:border-none 
                        px-4 lg:px-8 h-[70px] lg:h-auto flex items-center justify-between lg:justify-end transition-all duration-300">
                <!-- Mobile Logo Area -->
                <div class="flex items-center gap-3 lg:hidden pt-1">
                    <img src="/logo/amtech-removebg.png" alt="Amtech EV Logo" class="h-8 w-auto">
                    <h1 class="text-lg font-bold tracking-tight text-main">AMTECH <span class="text-ev-green italic">EV</span></h1>
                </div>

                <!-- Actions Container -->
                <div class="flex items-center gap-2 lg:gap-3">
                    <!-- Mobile Sidebar Toggle -->
                    <button @click="sidebarOpen = true" class="lg:hidden p-2.5 bg-glass border border-glass-border rounded-xl text-text-muted hover:text-accent hover:border-accent hover:bg-accent/10 transition-all shadow-sm flex items-center justify-center" title="Menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </button>

                    <button id="theme-toggle" class="p-2.5 lg:p-3 bg-glass border border-glass-border rounded-xl text-text-muted hover:text-accent hover:border-accent hover:bg-accent/10 transition-all shadow-sm group flex items-center justify-center" title="Toggle Theme">
                        <svg id="sun-icon" class="hidden transition-transform group-hover:rotate-45" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                        <svg id="moon-icon" class="hidden transition-transform group-hover:-rotate-12" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                    </button>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="p-2.5 lg:p-3 bg-glass border border-glass-border rounded-xl text-text-muted hover:text-red-500 hover:border-red-500 hover:bg-red-500/10 transition-all shadow-sm group flex items-center gap-2" title="Logout">
                            <span class="text-[10px] font-black uppercase tracking-widest hidden sm:inline-block ml-1">Logout</span>
                            <svg class="transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        </button>
                    </form>
                </div>
            </div>

                @isset($header)
                    <header class="mb-6 lg:mb-8 animate-fade-in mt-6 lg:mt-12">
                        <div class="max-w-7xl mx-auto">
                            <h2 class="text-2xl lg:text-3xl font-extrabold tracking-tight text-main">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endisset

                <div class="max-w-7xl mx-auto">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-ev-green/10 border border-ev-green/20 text-ev-green rounded-xl text-[10px] font-black uppercase tracking-[0.2em] animate-fade-in flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-ev-green shadow-[0_0_10px_rgba(59,183,126,0.5)]"></div>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] animate-fade-in">
                            <ul class="space-y-2">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center gap-3">
                                        <div class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.5)]"></div>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="animate-fade-in">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Theme Toggle
                const btn = document.getElementById('theme-toggle');
                const sun = document.getElementById('sun-icon');
                const moon = document.getElementById('moon-icon');
                
                const updateUI = (theme) => {
                    if (theme === 'light') {
                        sun?.classList.remove('hidden');
                        moon?.classList.add('hidden');
                    } else {
                        sun?.classList.add('hidden');
                        moon?.classList.remove('hidden');
                    }
                };

                let currentTheme = localStorage.getItem('theme') || 'dark';
                updateUI(currentTheme);

                btn?.addEventListener('click', () => {
                    currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-theme', currentTheme);
                    localStorage.setItem('theme', currentTheme);
                    updateUI(currentTheme);
                });
            });
        </script>
        @stack('scripts')
    </body>
</html>
