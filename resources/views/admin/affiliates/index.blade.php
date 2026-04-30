<x-app-layout>
    <x-slot:title>Affiliate Partners</x-slot:title>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-main">Affiliate Partners</h2>
                <p class="text-[11px] text-text-muted font-medium mt-1">Manage and monitor your affiliate marketing partners.</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-[10px] font-black uppercase tracking-widest text-text-muted border-b border-glass-border">
                        <tr>
                            <th class="px-6 py-4">Partner Name</th>
                            <th class="px-6 py-4">Referral Code</th>
                            <th class="px-6 py-4">Total Commissions</th>
                            <th class="px-6 py-4">Joined Date</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-glass-border">
                        @forelse($affiliates as $affiliate)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm text-main font-bold">{{ $affiliate->user->name }}</div>
                                <div class="text-[10px] text-text-muted">{{ $affiliate->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-accent">{{ $affiliate->referral_code }}</td>
                            <td class="px-6 py-4 text-xs text-main">{{ $affiliate->commissions_count }} Trx</td>
                            <td class="px-6 py-4 text-xs text-text-muted">{{ $affiliate->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="text-[10px] font-black py-2 px-4 bg-white/5 border border-glass-border rounded-lg uppercase hover:bg-accent hover:text-black transition-all">Details</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center text-xs text-text-muted">No affiliate partners found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
