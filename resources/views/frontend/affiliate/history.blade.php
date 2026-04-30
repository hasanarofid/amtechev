<x-app-layout>
    <x-slot:title>Commission History</x-slot:title>

    <div class="p-4 sm:p-8 max-w-7xl mx-auto space-y-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tight text-main leading-tight mb-2">Commission <span class="text-accent underline decoration-accent/20 decoration-4 underline-offset-8">History</span></h1>
                <p class="text-text-muted font-medium tracking-wide uppercase text-[10px] opacity-80 flex items-center gap-2">
                    <span class="h-1.5 w-1.5 bg-accent rounded-full animate-pulse"></span>
                    Track all your earnings and their status
                </p>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-[10px] font-black uppercase tracking-widest text-text-muted border-b border-glass-border">
                        <tr>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Reference</th>
                            <th class="px-6 py-4">Transaction Amount</th>
                            <th class="px-6 py-4">Your Commission</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-glass-border">
                        @forelse($commissions as $comm)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-xs text-main font-bold">{{ $comm->created_at->format('d M Y') }}</div>
                                <div class="text-[9px] text-text-muted">{{ $comm->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] font-black px-2 py-1 bg-white/10 rounded text-main uppercase">#{{ $comm->order_id ?: $comm->booking_id }}</span>
                                <div class="text-[9px] text-text-muted mt-1">{{ $comm->order_id ? 'Product Purchase' : 'Service Booking' }}</div>
                            </td>
                            <td class="px-6 py-4 text-xs text-main font-medium">RM {{ number_format($comm->order_id ? $comm->order->total_price : $comm->booking->total_price, 2) }}</td>
                            <td class="px-6 py-4 text-xs font-black text-green-500">+ RM {{ number_format($comm->amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="text-[9px] font-black px-3 py-1 rounded-full uppercase {{ $comm->status == 'approved' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                                    {{ $comm->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center text-xs text-text-muted italic">No transactions found yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $commissions->links() }}
        </div>
    </div>
</x-app-layout>
