<x-app-layout>
    <x-slot:title>Add New Testimonial</x-slot:title>
    <x-slot name="header">
        Add Testimonial
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Customer Name</label>
                    <input type="text" name="author_name" value="{{ old('author_name') }}" required class="premium-input" placeholder="e.g. John Doe">
                    @error('author_name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Role / Designation</label>
                    <input type="text" name="author_role" value="{{ old('author_role') }}" class="premium-input" placeholder="e.g. Tesla Model 3 Owner">
                    @error('author_role') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Testimonial Content</label>
                    <textarea name="content" required class="premium-input min-h-[120px]" placeholder="What they said about Amtech EV...">{{ old('content') }}</textarea>
                    @error('content') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Rating (1-5)</label>
                    <select name="rating" class="premium-input">
                        @for($i=5; $i>=1; $i--)
                            <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                        @endfor
                    </select>
                    @error('rating') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Author Image URL (Optional)</label>
                    <input type="text" name="author_image" value="{{ old('author_image') }}" class="premium-input" placeholder="e.g. https://api.dicebear.com/7.x/avataaars/svg?seed=John">
                    @error('author_image') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    SAVE TESTIMONIAL
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
