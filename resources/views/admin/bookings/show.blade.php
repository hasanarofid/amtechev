<x-app-layout>
    <x-slot:title>Booking Details</x-slot:title>
    <x-slot name="header">
        Booking: #{{ $booking->id }}
    </x-slot>

    <div class="max-w-4xl space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Customer Info -->
            <div class="glass-card p-8 space-y-6">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4">CUSTOMER INFORMATION</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Name</label>
                        <p class="text-lg font-bold text-main">{{ $booking->customer_name }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">WhatsApp / Phone</label>
                        <p class="text-lg font-bold text-main">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->phone_number) }}" class="hover:text-ev-green underline">{{ $booking->phone_number }}</a>
                        </p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Email</label>
                        <p class="text-xs font-bold text-main">{{ $booking->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Address</label>
                        <p class="text-xs font-bold text-main leading-relaxed italic">{{ $booking->address }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Info -->
            <div class="glass-card p-8 space-y-6 text-right">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4 text-left">BOOKING DETAILS</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Booking Date</label>
                        <p class="text-xs font-bold text-main">{{ $booking->created_at->format('d F Y, H:i') }}</p>
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
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-1">Selected Package</label>
                        <p class="text-lg font-bold text-ev-green">{{ $booking->package->name ?? 'N/A' }}</p>
                        <p class="text-[10px] text-text-muted uppercase tracking-widest">RM{{ number_format($booking->package->price ?? 0, 0) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="glass-card p-8 space-y-6">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4">CUSTOMER NOTES</h3>
            <p class="text-xs text-main leading-relaxed whitespace-pre-line">{{ $booking->notes ?? 'No notes provided by the customer.' }}</p>
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
