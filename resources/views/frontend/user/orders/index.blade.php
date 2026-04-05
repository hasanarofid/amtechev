<x-app-layout>
    <x-slot:title>My Orders</x-slot:title>

    <div class="p-4 sm:p-8 max-w-7xl mx-auto space-y-10">
        <div class="flex items-center gap-4 border-b border-glass-border pb-6">
            <div class="h-10 w-2 bg-accent rounded-full"></div>
            <div>
                <h1 class="text-4xl font-black tracking-tight text-main uppercase italic">My Orders</h1>
                <p class="text-[10px] font-black text-text-muted mt-1 uppercase tracking-[0.3em]">Track your specialized EV installations</p>
            </div>
        </div>

        @if($orders->isEmpty())
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-accent/10 to-blue-500/10 rounded-[36px] blur opacity-25"></div>
                <div class="relative bg-glass border border-glass-border rounded-[32px] p-20 text-center backdrop-blur-2xl">
                    <div class="mb-10 h-24 w-24 bg-accent/5 rounded-[40px] flex items-center justify-center mx-auto text-accent shadow-inner">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-main mb-3">No orders found</h2>
                    <p class="text-text-muted text-sm max-w-sm mx-auto leading-relaxed mb-10">You haven't placed any orders yet. Once you do, they will appear here for tracking.</p>
                    <a href="{{ route('installation') }}" class="inline-flex items-center gap-3 px-12 py-4 bg-accent text-black font-black rounded-2xl hover:scale-105 transition-all shadow-2xl shadow-accent/20 uppercase tracking-widest text-xs">
                        <span>Browse Services</span>
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6">
                @foreach($orders as $order)
                    <div class="glass-card hover:border-accent/30 transition-all duration-300 p-8 flex flex-col md:flex-row justify-between items-center gap-6 group">
                        <div class="flex items-center gap-6 w-full md:w-auto">
                            <div class="h-16 w-16 bg-accent/5 rounded-2xl flex items-center justify-center text-accent group-hover:bg-accent/10 transition-colors">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-black text-main">#{{ $order->order_number }}</h4>
                                <p class="text-xs text-text-muted mt-1 uppercase tracking-widest font-bold">{{ $order->service->name ?? 'Special Installation' }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-3 w-full md:w-auto">
                            <span class="text-[9px] font-black py-1.5 px-4 rounded-lg uppercase tracking-widest {{ $order->status === 'completed' ? 'bg-accent/10 text-accent border border-accent/20' : 'bg-glass-border text-text-muted border border-glass-border' }}">
                                {{ $order->status }}
                            </span>
                            <p class="text-2xl font-black text-main tabular-nums">RM {{ number_format($order->total_price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</x-app-layout>
