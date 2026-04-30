<x-app-layout>
    <x-slot:title>Affiliate Dashboard</x-slot:title>

    <div class="p-4 sm:p-8 max-w-7xl mx-auto space-y-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tight text-main leading-tight mb-2">Affiliate <span class="text-accent underline decoration-accent/20 decoration-4 underline-offset-8">Dashboard</span></h1>
                <p class="text-text-muted font-medium tracking-wide uppercase text-[10px] opacity-80 flex items-center gap-2">
                    <span class="h-1.5 w-1.5 bg-accent rounded-full animate-pulse"></span>
                    Track your referrals and earnings in real-time
                </p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <div class="glass-card overflow-hidden group">
                <div class="p-6 flex items-start justify-between relative">
                    <div class="space-y-4">
                        <div class="h-12 w-12 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-main">RM {{ number_format($stats['balance'], 2) }}</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted">Available Balance</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="glass-card overflow-hidden group">
                <div class="p-6 flex items-start justify-between relative">
                    <div class="space-y-4">
                        <div class="h-12 w-12 bg-accent/10 rounded-2xl flex items-center justify-center text-accent group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-main">RM {{ number_format($stats['total_earnings'], 2) }}</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted">Total Earnings</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="glass-card overflow-hidden group">
                <div class="p-6 flex items-start justify-between relative">
                    <div class="space-y-4">
                        <div class="h-12 w-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-main">{{ $stats['total_clicks'] }}</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted">Total Clicks</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="glass-card overflow-hidden group">
                <div class="p-6 flex items-start justify-between relative">
                    <div class="space-y-4">
                        <div class="h-12 w-12 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-500 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-main">RM {{ number_format($stats['pending_earnings'], 2) }}</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-text-muted">Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <!-- Referral Link -->
                <div class="glass-card p-8">
                    <h5 class="text-main font-black uppercase text-xs mb-4 tracking-widest">Your Referral Link</h5>
                    <div class="flex gap-3">
                        <input type="text" class="flex-1 bg-white/5 border border-glass-border rounded-xl px-4 py-3 text-sm text-main focus:outline-none focus:border-accent" id="referralLink" value="{{ url('/ref/' . $affiliate->referral_code) }}" readonly>
                        <button class="bg-accent text-black font-black px-6 rounded-xl text-[10px] uppercase tracking-widest hover:scale-105 transition-transform" onclick="copyLink()">Copy</button>
                    </div>
                </div>

                <!-- Recent Commissions -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between border-b border-glass-border pb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1 bg-accent rounded-full"></div>
                            <h2 class="text-xl font-black text-main uppercase tracking-tight">Recent Commissions</h2>
                        </div>
                    </div>
                    <div class="glass-card overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-white/5 text-[10px] font-black uppercase tracking-widest text-text-muted border-b border-glass-border">
                                    <tr>
                                        <th class="px-6 py-4">Date</th>
                                        <th class="px-6 py-4">Amount</th>
                                        <th class="px-6 py-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-glass-border">
                                    @forelse($commissions as $comm)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-6 py-4 text-xs text-main">{{ $comm->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-xs font-bold text-green-500">RM {{ number_format($comm->amount, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <span class="text-[9px] font-black px-2 py-1 rounded-md uppercase {{ $comm->status == 'approved' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                                                {{ $comm->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-xs text-text-muted">No commissions yet.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <div class="glass-card p-8 text-center space-y-6">
                    <div class="h-16 w-16 bg-accent/10 rounded-3xl flex items-center justify-center text-accent mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-main font-black uppercase text-sm mb-2">Request Payout</h4>
                        <p class="text-[10px] text-text-muted leading-relaxed">Minimum payout amount is RM 50.00. Your earnings are verified before withdrawal.</p>
                    </div>
                    <button class="w-full py-4 bg-white/5 border border-glass-border text-main font-black text-[10px] rounded-2xl uppercase tracking-widest hover:bg-accent hover:text-black transition-all disabled:opacity-50" {{ $stats['balance'] < 50 ? 'disabled' : '' }}>
                        Request Withdrawal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function copyLink() {
        var copyText = document.getElementById("referralLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        alert("Referral link copied!");
    }
    </script>
</x-app-layout>
