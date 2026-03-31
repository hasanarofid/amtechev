<x-app-layout>
    <x-slot:title>Add New Quality Brand</x-slot:title>
    <x-slot name="header">
        Create Quality Brand
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.quality-brands.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Brand Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="premium-input" placeholder="e.g. Terasaki Japan">
                    @error('name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Description/Subtitle</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="premium-input" placeholder="e.g. Global specialist in energy management">
                    @error('description') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Brand Logo</label>
                    <input type="file" name="logo_file" accept="image/*" class="premium-input px-4 py-3">
                    @error('logo_file') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="premium-input">
                    @error('sort_order') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    CREATE BRAND
                </button>
                <a href="{{ route('admin.quality-brands.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
