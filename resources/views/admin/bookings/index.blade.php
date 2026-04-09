<x-app-layout>
    <x-slot:title>Manage Bookings</x-slot:title>
    <x-slot name="header">
        Installation Bookings Management
    </x-slot>

    <div class="w-full space-y-6">
        <div class="flex justify-between items-center border-b border-ev-green/20 pb-4">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green">ALL BOOKINGS</h3>
        </div>

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
                        <th class="px-6 py-4 font-black">Package</th>
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
                                <span class="text-main font-bold">{{ $booking->package->name ?? 'N/A' }}</span>
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
