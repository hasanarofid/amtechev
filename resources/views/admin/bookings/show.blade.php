<x-app-layout>
    <x-slot:title>Booking Details</x-slot:title>
    <x-slot name="header">
        Booking: #{{ $booking->id }}
    </x-slot>

    <div class="max-w-4xl space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Customer Info -->
            <div class="glass-card p-8 space-y-6 text-main">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4">CUSTOMER INFORMATION</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Name</label>
                        <p class="text-lg font-bold">{{ $booking->customer_name }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">WhatsApp / Phone</label>
                        <p class="text-lg font-bold">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->phone_number) }}" class="hover:text-ev-green underline">{{ $booking->phone_number }}</a>
                        </p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Email</label>
                        <p class="text-xs font-bold">{{ $booking->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Address</label>
                        <p class="text-xs font-bold leading-relaxed italic">{{ $booking->address }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Preferred Installation Date</label>
                        <p class="text-lg font-black text-ev-green">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Info -->
            <div class="glass-card p-8 space-y-6 text-right text-main">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4 text-left">BOOKING STATUS</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Booking Date</label>
                        <p class="text-xs font-bold">{{ $booking->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Status</label>
                        <div class="flex justify-end mt-2">
                            <span class="px-4 py-1 rounded-full text-[10px] font-black tracking-widest
                                @if($booking->status == 'Pending') bg-amber-500/10 text-amber-500 border border-amber-500/20
                                @elseif($booking->status == 'Confirmed') bg-ev-green/10 text-ev-green border border-ev-green/20
                                @elseif($booking->status == 'Completed') bg-blue-500/10 text-blue-500 border border-blue-500/20
                                @else bg-red-500/10 text-red-500 border border-red-500/20 @endif">
                                {{ $booking->status }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Total Amount</label>
                        <p class="text-3xl font-black text-ev-green">RM{{ number_format($booking->total_price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items Section -->
        <div class="glass-card p-8 space-y-6 text-main">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4">SELECTED PACKAGES & ADD-ONS</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black uppercase tracking-widest text-text-muted border-b border-white/10">
                            <th class="py-4">Item Name</th>
                            <th class="py-4 text-center">Qty</th>
                            <th class="py-4 text-right">Price</th>
                            <th class="py-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($booking->items as $item)
                        <tr class="text-xs font-bold">
                            <td class="py-4">
                                {{ $item->installationPackage->name ?? 'Deleted Package' }}
                                <span class="block text-[10px] font-normal text-text-muted mt-1 uppercase tracking-tighter">{{ $item->installationPackage->category }}</span>
                            </td>
                            <td class="py-4 text-center">{{ $item->quantity }}</td>
                            <td class="py-4 text-right">RM{{ number_format($item->price_at_booking, 2) }}</td>
                            <td class="py-4 text-right">RM{{ number_format($item->price_at_booking * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-white/10">
                            <td colspan="3" class="py-6 text-right text-[10px] font-black uppercase tracking-widest text-text-muted">Total Price</td>
                            <td class="py-6 text-right text-lg font-black text-ev-green">RM{{ number_format($booking->total_price, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="glass-card p-8 space-y-6 text-main">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4">CUSTOMER NOTES</h3>
            <p class="text-xs leading-relaxed whitespace-pre-line">{{ $booking->notes ?? 'No notes provided by the customer.' }}</p>
        </div>

        <!-- Admin Actions -->
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.bookings.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                BACK TO LIST
            </a>
            <div class="flex gap-4">
                <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    MANAGE STATUS
                </a>
                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-premium bg-red-500/10 border-red-500/20 text-red-500 hover:bg-red-500/20 px-8 py-4 text-xs tracking-[0.2em] shadow-none" onclick="return confirm('Are you sure you want to delete this booking?')">
                        DELETE
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
