<x-app-layout>
    <x-slot:title>Add New Gallery Photo</x-slot:title>
    <x-slot name="header">
        Upload Photo
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.gallery-items.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Photo Title (Optional)</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="premium-input" placeholder="e.g. Home Installation Project">
                    @error('title') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Select Image</label>
                    <input type="file" name="image_file" required accept="image/*" class="premium-input px-4 py-3">
                    @error('image_file') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="premium-input">
                    @error('sort_order') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    UPLOAD PHOTO
                </button>
                <a href="{{ route('admin.gallery-items.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
