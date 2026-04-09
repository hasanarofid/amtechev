<x-app-layout>
    <x-slot:title>Manage Booking Status</x-slot:title>
    <x-slot name="header">
        Manage Status: #{{ $booking->id }}
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Booking Status</label>
                    <select name="status" required class="premium-input bg-[#0a0a0a]">
                        <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ $booking->status == 'Confirmed' ? 'selected' : '' }}>Confirmed (Ready to Install)</option>
                        <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed (Installation Done)</option>
                        <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Internal Notes / Status Updates (Optional)</label>
                    <textarea name="notes" rows="6" class="premium-input" placeholder="Add information about installation progress...">{{ old('notes', $booking->notes) }}</textarea>
                    @error('notes') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    SAVE CHANGES
                </button>
                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
