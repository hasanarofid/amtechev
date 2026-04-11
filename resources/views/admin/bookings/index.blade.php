<x-app-layout>
    <x-slot:title>Manage Bookings</x-slot:title>
    <x-slot name="header">
        Installation Bookings Management
    </x-slot>

    <div class="w-full space-y-6">
        <div class="flex justify-between items-center border-b border-ev-green/20 pb-4">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green">ALL BOOKINGS</h3>
        </div>

        @if($fullDates->count() > 0)
            <div class="glass-card p-6 border-red-500/30">
                <div class="flex items-center gap-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-red-500">Dates at Full Capacity (Limit: {{ $limit }})</h4>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($fullDates as $dateInfo)
                        <div class="px-4 py-2 bg-red-500/10 border border-red-500/20 rounded-xl text-[10px] font-bold text-red-500">
                            {{ \Carbon\Carbon::parse($dateInfo->preferred_date)->format('d M Y') }}
                            <span class="ml-1 opacity-50">({{ $dateInfo->count }} Bookings)</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="glass-card p-6 border-ev-green/20">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ev-green" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-ev-green">All dates have available slots (Limit: {{ $limit }})</h4>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="glass-card overflow-hidden">
            <table class="w-full text-left text-xs uppercase tracking-widest">
                <thead>
                    <tr class="border-b border-glass-border bg-white/5">
                        <th class="px-6 py-4 font-black">Date</th>
                        <th class="px-6 py-4 font-black">Customer</th>
                        <th class="px-6 py-4 font-black">Items</th>
                        <th class="px-6 py-4 font-black text-right">Total</th>
                        <th class="px-6 py-4 font-black text-center">Status</th>
                        <th class="px-6 py-4 font-black text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-glass-border">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 text-text-muted">
                                {{ $booking->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-main">{{ $booking->customer_name }}</div>
                                <div class="text-[10px] text-text-muted lowercase tracking-normal">{{ $booking->phone_number }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-main font-bold">{{ $booking->items->count() }} items</span>
                                <div class="text-[10px] text-text-muted italic">{{ $booking->items->first()?->installationPackage?->name ?? 'N/A' }}...</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-ev-green font-bold">RM{{ number_format($booking->total_price, 2) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black tracking-widest
                                        @if($booking->status == 'Pending') bg-amber-500/10 text-amber-500 border border-amber-500/20
                                        @elseif($booking->status == 'Confirmed') bg-ev-green/10 text-ev-green border border-ev-green/20
                                        @elseif($booking->status == 'Completed') bg-blue-500/10 text-blue-500 border border-blue-500/20
                                        @else bg-red-500/10 text-red-500 border border-red-500/20 @endif">
                                        {{ $booking->status }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="text-ev-green font-bold hover:underline">View Details</a>
                                    <a href="{{ route('admin.bookings.edit', $booking) }}" class="text-text-muted font-bold hover:underline">Manage</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center text-text-muted">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    </div>
</x-app-layout>
