<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Dashboard' }} | {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/premium.css', 'resources/js/app.js'])
        <script>
            (function() {
                const theme = localStorage.getItem('theme') || 'dark';
                document.documentElement.setAttribute('data-theme', theme);
            })();
        </script>
    </head>
    <body class="font-sans antialiased text-main">
        <div class="min-h-screen flex">
            @include('layouts.sidebar')

            <!-- Page Content -->
            <main class="flex-1 ml-[260px] p-8 relative">
                <!-- Header Actions Top Right -->
                <div class="absolute top-8 right-8 z-50 flex items-center gap-3">
                    <button id="theme-toggle" class="p-2.5 bg-glass border border-glass-border rounded-xl text-text-muted hover:text-accent hover:border-accent hover:bg-accent/10 transition-all shadow-sm group glass-card" title="Toggle Theme">
                        <svg id="sun-icon" class="hidden transition-transform group-hover:rotate-45" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                        <svg id="moon-icon" class="hidden transition-transform group-hover:-rotate-12" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                    </button>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="p-2.5 bg-glass border border-glass-border rounded-xl text-text-muted hover:text-red-500 hover:border-red-500 hover:bg-red-500/10 transition-all shadow-sm group glass-card flex items-center gap-2" title="Logout">
                            <span class="text-[10px] font-black uppercase tracking-widest hidden sm:inline-block ml-1">Logout</span>
                            <svg class="transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        </button>
                    </form>
                </div>

                @isset($header)
                    <header class="mb-8 animate-fade-in">
                        <div class="max-w-7xl mx-auto">
                            <h2 class="text-3xl font-extrabold tracking-tight text-main">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endisset

                <div class="animate-fade-in">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const btn = document.getElementById('theme-toggle');
                if(!btn) return;
                
                const sun = document.getElementById('sun-icon');
                const moon = document.getElementById('moon-icon');
                
                const updateUI = (theme) => {
                    if (theme === 'light') {
                        sun.classList.remove('hidden');
                        moon.classList.add('hidden');
                    } else {
                        sun.classList.add('hidden');
                        moon.classList.remove('hidden');
                    }
                };

                let currentTheme = localStorage.getItem('theme') || 'dark';
                updateUI(currentTheme);

                btn.addEventListener('click', () => {
                    currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-theme', currentTheme);
                    localStorage.setItem('theme', currentTheme);
                    updateUI(currentTheme);
                });
            });
        </script>
    </body>
</html>
