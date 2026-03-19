<x-app-layout>
    <x-slot:title>Main Dashboard</x-slot:title>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-main">Main Dashboard</h2>
                <p class="text-[11px] text-text-muted font-medium mt-1">Monitor your EV charger specialist metrics.</p>
            </div>
            <div class="flex items-center gap-3">

            </div>
        </div>
    </x-slot>

    <!-- Balanced 4-Column Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Members Card -->
        <div class="glass-card p-6 border-l-4 border-l-ev-green hover:scale-[1.02] transition-transform group">
            <div class="flex justify-between items-start mb-6">
                <div class="p-2.5 bg-ev-green/10 rounded-xl text-ev-green group-hover:bg-ev-green group-hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="px-2 py-0.5 bg-ev-green/10 text-ev-green text-[10px] font-bold rounded-full">
                    +12.5% ↑
                </div>
            </div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted mb-2">Total Customers</h4>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-main">{{ $stats['total_customers'] }}</span>
                <span class="text-[11px] text-text-muted font-medium italic">Active</span>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="glass-card p-6 border-l-4 border-l-ev-green hover:scale-[1.02] transition-transform group">
            <div class="flex justify-between items-start mb-6">
                <div class="p-2.5 bg-ev-green/10 rounded-xl text-ev-green group-hover:bg-ev-green group-hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <div class="px-2 py-0.5 bg-ev-green/10 text-ev-green text-[10px] font-bold rounded-full">
                    +5.4% ↑
                </div>
            </div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted mb-2">Charger Products</h4>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-main">{{ $stats['total_chargers'] }}</span>
                <span class="text-[11px] text-text-muted font-medium italic">Listed</span>
            </div>
        </div>

        <!-- Check-ins Card -->
        <div class="glass-card p-6 border-l-4 border-l-purple-500 hover:scale-[1.02] transition-transform group">
            <div class="flex justify-between items-start mb-6">
                <div class="p-2.5 bg-purple-500/10 rounded-xl text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div class="flex items-center gap-1.5 px-2 py-0.5 bg-purple-500/10 text-purple-500 rounded-full border border-purple-500/20">
                    <span class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-ping"></span>
                    <span class="text-[9px] font-black uppercase tracking-tighter">Live</span>
                </div>
            </div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted mb-2">Testimonials</h4>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-main">{{ $stats['total_testimonials'] }}</span>
                <span class="text-[11px] text-text-muted font-medium italic">Published</span>
            </div>
        </div>

        <!-- Classes Card -->
        <div class="glass-card p-6 border-l-4 border-l-accent hover:scale-[1.02] transition-transform group">
            <div class="flex justify-between items-start mb-6">
                <div class="p-2.5 bg-accent/10 rounded-xl text-accent group-hover:bg-accent group-hover:text-dark transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                </div>
                <div class="px-2 py-0.5 bg-accent/10 text-accent text-[10px] font-bold rounded-full uppercase tracking-widest">
                    {{ now()->format('D') }}
                </div>
            </div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted mb-2">Blog Posts</h4>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-main">{{ $stats['total_blog_posts'] }}</span>
                <span class="text-[11px] text-text-muted font-medium italic">Insights</span>
            </div>
        </div>
    </div>

    <!-- Activity & Sidebar Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Activity Feed -->
        <div class="lg:col-span-2 space-y-8">
            <div class="glass-card p-8 bg-gradient-to-br from-transparent to-glass/5">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black tracking-tight text-main">Charging Activity</h3>
                </div>
                
                <div class="space-y-4">
                    <p class="text-sm text-text-muted italic">System ready for EV operations. Manage your landing page sections from the sidebar.</p>
                </div>
            </div>
        </div>

        <!-- Sidebar Insights -->
        <div class="space-y-8">
            <!-- Maintenance Insight -->
            <div class="glass-card p-8 bg-accent group cursor-default overflow-hidden relative">
                <div class="absolute -right-12 -bottom-12 w-40 h-40 bg-dark/10 rounded-full group-hover:scale-150 transition-all duration-1000"></div>
                <h4 class="text-dark text-[10px] font-black uppercase tracking-[0.2em] mb-4 relative z-10">Maintenance Alert</h4>
                <p class="text-dark/80 text-xs font-bold leading-relaxed mb-6 relative z-10">
                    Charger ID #EV-X1 is reporting low voltage. We recommend scheduling an inspection soon.
                </p>
                <div class="inline-flex items-center gap-2 px-6 py-3 bg-dark text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl relative z-10">
                    System Alert active
                </div>
            </div>

            <!-- Health Analytics -->
            <div class="glass-card p-6">
                <h4 class="text-[10px] font-black text-text-muted uppercase tracking-[0.2em] mb-6">Engagement Analytics</h4>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[11px] font-bold text-main italic">Customer Retention</span>
                            <span class="text-accent text-[11px] font-black">94%</span>
                        </div>
                        <div class="h-1.5 w-full bg-glass rounded-full overflow-hidden">
                            <div class="h-full bg-accent w-[94%] shadow-[0_0_10px_var(--accent-glow)]"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[11px] font-bold text-main italic">New Signups</span>
                            <span class="text-ev-green text-[11px] font-black">78%</span>
                        </div>
                        <div class="h-1.5 w-full bg-glass rounded-full overflow-hidden">
                            <div class="h-full bg-ev-green w-[78%]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
