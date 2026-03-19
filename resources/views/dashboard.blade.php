<x-app-layout>
    <x-slot:title>Main Dashboard</x-slot:title>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-main">Main Dashboard</h2>
                <p class="text-[11px] text-text-muted font-medium mt-1">Monitor your EV charger specialist metrics.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('check-ins.create') }}" class="btn-premium px-5 py-2.5 bg-accent shadow-[0_4px_15px_rgba(0,166,81,0.3)] hover:shadow-[0_6px_25px_rgba(0,166,81,0.5)]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    New Session
                </a>
                <a href="{{ route('members.create') }}" class="btn-premium px-5 py-2.5 bg-glass border border-glass-border hover:border-accent/40 text-main shadow-none transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                    New Customer
                </a>
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
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted mb-2">Total Chargers</h4>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-main">{{ $stats['members_count'] }}</span>
                <span class="text-[11px] text-text-muted font-medium italic">Installed</span>
            </div>
            <div class="mt-4 pt-4 border-t border-glass-border">
                <p class="text-[9px] text-text-muted uppercase font-bold tracking-widest">Growth this month</p>
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
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted mb-2">Monthly Revenue</h4>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-main">${{ number_format($stats['revenue'], 0) }}</span>
                <span class="text-[11px] text-text-muted font-medium italic">USD</span>
            </div>
            <div class="mt-4 pt-4 border-t border-glass-border">
                <p class="text-[9px] text-text-muted uppercase font-bold tracking-widest">Target: $5,000</p>
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
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted mb-2">Active Sessions</h4>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-main">{{ $stats['checkins_today'] }}</span>
                <span class="text-[11px] text-text-muted font-medium italic">Charging</span>
            </div>
            <div class="mt-4 pt-4 border-t border-glass-border">
                <p class="text-[9px] text-text-muted uppercase font-bold tracking-widest">Peak load: 6 PM - 10 PM</p>
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
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted mb-2">Pending Maintenance</h4>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-main">{{ $stats['active_classes'] }}</span>
                <span class="text-[11px] text-text-muted font-medium italic">Available</span>
            </div>
            <div class="mt-4 pt-4 border-t border-glass-border">
                <p class="text-[9px] text-text-muted uppercase font-bold tracking-widest">Next: Site Audit (14:00 PM)</p>
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
                    <a href="{{ route('check-ins.index') }}" class="btn-premium px-4 py-2 bg-glass border border-glass-border hover:border-accent/30 text-[9px]">Full History</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($recentCheckins as $checkin)
                        <div class="flex items-center justify-between p-4 bg-glass border border-glass-border rounded-xl hover:bg-glass/10 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-accent/10 text-accent border border-accent/20 rounded-xl flex items-center justify-center text-xs font-black uppercase group-hover:bg-accent group-hover:text-dark transition-all">
                                    {{ substr($checkin->user->name, 0, 2) }}
                                </div>
                                <div>
                                    <h5 class="text-sm font-black text-main">{{ $checkin->user->name }}</h5>
                                    <p class="text-[10px] text-text-muted font-bold uppercase tracking-widest">Session at {{ $checkin->checked_at->format('H:i') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 bg-ev-green/10 text-ev-green text-[9px] font-black uppercase tracking-widest rounded-lg border border-ev-green/10">Verified</span>
                                <p class="text-[9px] text-text-muted mt-1">{{ $checkin->checked_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center flex flex-col items-center">
                            <div class="w-16 h-16 bg-glass rounded-full flex items-center justify-center text-text-muted/30 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            </div>
                            <p class="text-sm text-text-muted italic">Charging sessions haven't started yet. Active presence will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Insights -->
        <div class="space-y-8">
            <!-- Peak Times Insight -->
            <div class="glass-card p-8 bg-accent group cursor-default overflow-hidden relative">
                <div class="absolute -right-12 -bottom-12 w-40 h-40 bg-dark/10 rounded-full group-hover:scale-150 transition-all duration-1000"></div>
                <h4 class="text-dark text-[11px] font-black uppercase tracking-[0.2em] mb-4 relative z-10">Smart Scheduling</h4>
                <p class="text-dark/80 text-xs font-bold leading-relaxed mb-6 relative z-10">
                    Your busiest location is approaching! We recommend having <strong>2 technicians</strong> on standby for the next hour.
                </p>
                <a href="{{ route('gym-classes.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-dark text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl hover:shadow-[0_10px_30px_rgba(0,0,0,0.3)] transition-all relative z-10">
                    View Schedule
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
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
