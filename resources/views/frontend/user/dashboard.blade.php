<x-app-layout>
    <x-slot:title>Member Dashboard</x-slot:title>

    <div class="p-4 sm:p-8 max-w-7xl mx-auto space-y-10">
        <!-- Welcome Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tight text-main leading-tight mb-2">Welcome Back, <span class="text-accent underline decoration-accent/20 decoration-4 underline-offset-8">{{ Auth::user()->name }}</span>!</h1>
                <p class="text-text-muted font-medium tracking-wide uppercase text-[10px] opacity-80 flex items-center gap-2">
                    <span class="h-1.5 w-1.5 bg-accent rounded-full animate-pulse"></span>
                    Ready to power up your EV experience today?
                </p>
            </div>
            <div class="flex items-center gap-3 bg-glass border border-glass-border px-5 py-3 rounded-2xl backdrop-blur-md">
                <div class="h-10 w-10 bg-accent/10 rounded-xl flex items-center justify-center text-accent">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-[9px] font-black uppercase text-text-muted">Today's Date</p>
                    <p class="text-xs font-bold text-main">{{ now()->format('D, M d Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <div class="glass-card overflow-hidden group">
                <div class="p-6 flex items-start justify-between relative">
                    <div class="space-y-4">
                        <div class="h-12 w-12 bg-accent/10 rounded-2xl flex items-center justify-center text-accent group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-main">0</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted">Ongoing Orders</p>
                        </div>
                    </div>
                    <span class="text-[9px] font-black text-accent py-1 px-3 bg-accent/10 rounded-lg uppercase tracking-widest border border-accent/20">Active</span>
                </div>
            </div>

            <div class="glass-card overflow-hidden group">
                <div class="p-6 flex items-start justify-between relative">
                    <div class="space-y-4">
                        <div class="h-12 w-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-main">RM 0.00</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted">Total Spending</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden group">
                <div class="p-6 flex items-start justify-between relative">
                    <div class="space-y-4">
                        <div class="h-12 w-12 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-500 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-main">0</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted">Active Tickets</p>
                        </div>
                    </div>
                    <a href="#" class="text-[9px] font-black text-purple-500 hover:scale-105 transition-transform uppercase tracking-widest border border-purple-500/20 py-1 px-3 bg-purple-500/10 rounded-lg">Support</a>
                </div>
            </div>
        </div>

        <!-- Recent Installations Section -->
        <div class="space-y-6">
            <div class="flex items-center justify-between border-b border-glass-border pb-4">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-1 bg-accent rounded-full"></div>
                    <h2 class="text-xl font-black text-main uppercase tracking-tight">Recent Installations</h2>
                </div>
                <a href="{{ route('user.orders') }}" class="text-[10px] font-black text-accent hover:underline uppercase tracking-widest flex items-center gap-2 group transition-all">
                    View All Orders 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-accent/10 to-blue-500/10 rounded-[36px] blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                <div class="relative bg-glass border border-glass-border rounded-[32px] p-20 text-center backdrop-blur-2xl">
                    <div class="mb-8 relative inline-block">
                        <div class="h-24 w-24 bg-accent/5 rounded-[40px] flex items-center justify-center mx-auto text-accent shadow-inner animate-bounce-slow">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <div class="absolute -bottom-2 -right-2 h-8 w-8 bg-accent rounded-full border-4 border-[var(--bg-card)] flex items-center justify-center text-black font-black text-xs shadow-lg">?</div>
                    </div>
                    <h3 class="text-2xl font-bold text-main mb-3">Your power history is empty</h3>
                    <p class="text-text-muted text-sm max-w-sm mx-auto leading-relaxed mb-10">You haven't ordered any installation services yet. AMTECH EV specialized solutions are waiting to upgrade your setup.</p>
                    <a href="{{ route('installation') }}" class="inline-flex items-center gap-3 px-12 py-4 bg-accent text-black font-black rounded-2xl hover:scale-105 transition-all shadow-2xl shadow-accent/20 uppercase tracking-widest text-xs group">
                        <span>Get Started Now</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
