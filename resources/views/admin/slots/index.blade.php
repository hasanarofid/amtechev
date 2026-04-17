<x-app-layout>
    <x-slot:title>Manage Booking Slots</x-slot:title>
    <x-slot name="header">
        Booking Slots & Capacity Management
    </x-slot>

    <div class="w-full space-y-8">
        @if(session('success'))
            <div class="p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Global Capacity -->
            <div class="glass-card p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-ev-green/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green">Global Capacity</h3>
                        <p class="text-[10px] text-text-muted uppercase tracking-widest mt-1">Default armada available per day</p>
                    </div>
                </div>

                <form action="{{ route('admin.slots.update-global') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Total Armada Slots</label>
                        <input type="number" name="value" value="{{ $globalLimit->value ?? 2 }}" min="1" required
                            class="w-full bg-white/5 border border-glass-border rounded-xl px-4 py-3 text-sm text-main focus:outline-none focus:border-ev-green transition-all">
                    </div>
                    <button type="submit" class="w-full py-3 bg-ev-green text-black font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-white transition-all">
                        Update Global Limit
                    </button>
                </form>
            </div>

            <!-- Add Custom Date slot -->
            <div class="glass-card p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-accent">Specific Date Override</h3>
                        <p class="text-[10px] text-text-muted uppercase tracking-widest mt-1">Override capacity for a specific date</p>
                    </div>
                </div>

                <form action="{{ route('admin.slots.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Select Date</label>
                            <input type="date" name="date" required
                                class="w-full bg-white/5 border border-glass-border rounded-xl px-4 py-3 text-sm text-main focus:outline-none focus:border-ev-green transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Capacity</label>
                            <input type="number" name="capacity" min="0" required
                                class="w-full bg-white/5 border border-glass-border rounded-xl px-4 py-3 text-sm text-main focus:outline-none focus:border-ev-green transition-all">
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3 bg-accent text-black font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-white transition-all">
                        Add Override
                    </button>
                </form>
            </div>
        </div>

        <!-- Overrides List -->
        <div class="glass-card overflow-hidden">
            <div class="p-6 border-b border-glass-border bg-white/5">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-main">Active Date Overrides</h3>
            </div>
            <div class="table-responsive">
                <table class="w-full text-left text-xs uppercase tracking-widest">
                    <thead>
                        <tr class="border-b border-glass-border bg-white/[0.02]">
                            <th class="px-6 py-4 font-black">Date</th>
                            <th class="px-6 py-4 font-black">Capacity</th>
                            <th class="px-6 py-4 font-black text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-glass-border">
                        @forelse($slots as $slot)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 text-main font-bold whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($slot->date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 rounded-full bg-accent/10 text-accent border border-accent/20 font-black">
                                        {{ $slot->capacity }} Armada
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <form action="{{ route('admin.slots.destroy', $slot) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 font-bold hover:underline" onclick="return confirm('Remove this override?')">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-text-muted">
                                    No custom date overrides set.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($slots->hasPages())
                <div class="p-6 border-t border-glass-border">
                    {{ $slots->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
