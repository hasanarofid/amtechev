<x-app-layout>
    <x-slot:title>Edit Testimonial</x-slot:title>
    <x-slot name="header">
        Edit Testimonial
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Customer Name</label>
                    <input type="text" name="author_name" value="{{ old('author_name', $testimonial->author_name) }}" required class="premium-input">
                    @error('author_name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Role / Designation</label>
                    <input type="text" name="author_role" value="{{ old('author_role', $testimonial->author_role) }}" class="premium-input">
                    @error('author_role') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Testimonial Content</label>
                    <textarea name="content" required class="premium-input min-h-[120px]">{{ old('content', $testimonial->content) }}</textarea>
                    @error('content') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Rating (1-5)</label>
                    <select name="rating" class="premium-input">
                        @for($i=5; $i>=1; $i--)
                            <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                        @endfor
                    </select>
                    @error('rating') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Author Image URL</label>
                    <input type="text" name="author_image" value="{{ old('author_image', $testimonial->author_image) }}" class="premium-input">
                    @error('author_image') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    UPDATE TESTIMONIAL
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
