<x-app-layout>
    <x-slot:title>Edit Gallery Photo</x-slot:title>
    <x-slot name="header">
        Modify Photo
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.gallery-items.update', $galleryItem) }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Photo Title</label>
                    <input type="text" name="title" value="{{ old('title', $galleryItem->title) }}" class="premium-input">
                    @error('title') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Change Image</label>
                    @if($galleryItem->image_path)
                        <div class="mb-4 aspect-video w-48 bg-white/5 rounded-lg overflow-hidden border border-glass-border">
                            <img src="{{ asset('storage/' . $galleryItem->image_path) }}" alt="Current Photo" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="image_file" accept="image/*" class="premium-input px-4 py-3">
                    <p class="mt-2 text-[8px] text-text-muted italic uppercase tracking-wider">Leave empty to keep current photo.</p>
                    @error('image_file') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $galleryItem->sort_order) }}" class="premium-input">
                    @error('sort_order') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    SAVE CHANGES
                </button>
                <a href="{{ route('admin.gallery-items.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
