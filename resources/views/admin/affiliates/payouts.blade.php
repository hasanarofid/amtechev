<x-app-layout>
    <x-slot:title>Payout Requests</x-slot:title>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-main">Payout Requests</h2>
                <p class="text-[11px] text-text-muted font-medium mt-1">Manage withdrawal requests from your partners.</p>
            </div>
        </div>
    </x-slot>

    <div class="glass-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-[10px] font-black uppercase tracking-widest text-text-muted border-b border-glass-border">
                    <tr>
                        <th class="px-6 py-4">Partner</th>
                        <th class="px-6 py-4">Requested Amount</th>
                        <th class="px-6 py-4">Bank Info</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-glass-border">
                    @forelse($payouts as $payout)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm text-main font-bold">{{ $payout->affiliate->user->name }}</div>
                            <div class="text-[10px] text-text-muted italic">{{ $payout->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4 text-xs font-black text-main">RM {{ number_format($payout->amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] text-main font-bold">Bank Transfer</div>
                            <div class="text-[9px] text-text-muted italic">Check user profile for bank details.</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-[9px] font-black px-2 py-1 rounded-md uppercase {{ $payout->status == 'completed' ? 'bg-green-500/10 text-green-500' : 'bg-blue-500/10 text-blue-500' }}">
                                {{ $payout->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($payout->status == 'pending')
                            <form action="{{ route('admin.affiliates.payouts.complete', $payout) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-[10px] font-black py-2 px-4 bg-accent text-black rounded-lg uppercase hover:scale-105 transition-all">Mark Paid</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-xs text-text-muted">No payout requests found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $payouts->links() }}
    </div>
</x-app-layout>
