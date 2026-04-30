<x-app-layout>
    <x-slot:title>Affiliate Commissions</x-slot:title>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-main">Commission Logs</h2>
                <p class="text-[11px] text-text-muted font-medium mt-1">Review and approve referral commissions.</p>
            </div>
        </div>
    </x-slot>

    <div class="glass-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-[10px] font-black uppercase tracking-widest text-text-muted border-b border-glass-border">
                    <tr>
                        <th class="px-6 py-4">Partner</th>
                        <th class="px-6 py-4">Transaction</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-glass-border">
                    @forelse($commissions as $comm)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm text-main font-bold">{{ $comm->affiliate->user->name }}</div>
                            <div class="text-[10px] text-accent font-mono">{{ $comm->affiliate->referral_code }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs text-main font-bold">#{{ $comm->order_id ?: $comm->booking_id }}</div>
                            <div class="text-[10px] text-text-muted italic">{{ $comm->order_id ? 'Product' : 'Booking' }}</div>
                        </td>
                        <td class="px-6 py-4 text-xs font-black text-green-500">RM {{ number_format($comm->amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="text-[9px] font-black px-2 py-1 rounded-md uppercase {{ $comm->status == 'approved' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                                {{ $comm->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($comm->status == 'pending')
                            <form action="{{ route('admin.affiliates.commissions.approve', $comm) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-[10px] font-black py-2 px-4 bg-green-500/10 text-green-500 border border-green-500/20 rounded-lg uppercase hover:bg-green-500 hover:text-white transition-all">Approve</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-xs text-text-muted">No commissions logged.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $commissions->links() }}
    </div>
</x-app-layout>
