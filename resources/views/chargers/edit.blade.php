<x-app-layout>
    <x-slot:title>Edit Charger</x-slot:title>
    <x-slot name="header">
        Edit Charger
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.chargers.update', $charger) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Charger Name</label>
                    <input type="text" name="name" value="{{ old('name', $charger->name) }}" required class="premium-input">
                    @error('name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Price Label</label>
                    <input type="text" name="price" value="{{ old('price', $charger->price) }}" class="premium-input">
                    @error('price') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Description</label>
                    <textarea name="description" class="premium-input min-h-[120px]">{{ old('description', $charger->description) }}</textarea>
                    @error('description') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Image URL</label>
                    <input type="text" name="image_url" value="{{ old('image_url', $charger->image_url) }}" class="premium-input">
                    @error('image_url') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-4 py-4 border-t border-glass-border">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ $charger->is_featured ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-glass border border-glass-border rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ev-green"></div>
                        <span class="ml-3 text-[11px] font-bold uppercase tracking-widest text-main">Featured Product</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    UPDATE CHARGER
                </button>
                <a href="{{ route('admin.chargers.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
