<x-app-layout>
    <x-slot:title>Join Affiliate Program</x-slot:title>

    <div class="container py-20">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="text-5xl font-black mb-6 text-main">Become an <span class="text-accent">Amtech Partner</span></h1>
                <p class="text-lg mb-12 text-text-muted">Earn generous commissions by referring others to Malaysia's leading EV charger specialist.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 text-left">
                    <div class="glass-card p-8 space-y-4">
                        <div class="h-12 w-12 bg-accent/10 rounded-2xl flex items-center justify-center text-accent">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>
                        <h5 class="font-bold text-main">Share Link</h5>
                        <p class="text-xs text-text-muted leading-relaxed">Share your unique referral link with your network and social media.</p>
                    </div>
                    <div class="glass-card p-8 space-y-4">
                        <div class="h-12 w-12 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h5 class="font-bold text-main">Earn 5%</h5>
                        <p class="text-xs text-text-muted leading-relaxed">Get 5% commission on every successful purchase and installation.</p>
                    </div>
                    <div class="glass-card p-8 space-y-4">
                        <div class="h-12 w-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h5 class="font-bold text-main">Easy Payout</h5>
                        <p class="text-xs text-text-muted leading-relaxed">Withdraw your earnings directly to your bank account with ease.</p>
                    </div>
                </div>

                <form action="{{ route('affiliate.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-12 py-4 bg-accent text-black font-black rounded-2xl hover:scale-105 transition-all shadow-2xl shadow-accent/20 uppercase tracking-widest text-sm">
                        Join Affiliate Program Now
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
