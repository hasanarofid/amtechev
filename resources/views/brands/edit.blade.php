<x-app-layout>
    <x-slot:title>Edit Brand: {{ $brand->name }}</x-slot:title>
    <x-slot name="header">
        Edit Brand
    </x-slot>

    <div class="max-w-4xl">
        <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data" class="glass-card p-10">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Brand Name</label>
                        <input type="text" name="name" value="{{ old('name', $brand->name) }}" required class="w-full bg-white/5 border border-glass-border focus:border-ev-green/50 focus:ring-0 rounded-xl px-5 py-3 text-main transition-all duration-300">
                        @error('name')<p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $brand->sort_order) }}" required class="w-full bg-white/5 border border-glass-border focus:border-ev-green/50 focus:ring-0 rounded-xl px-5 py-3 text-main transition-all duration-300">
                        @error('sort_order')<p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-4 py-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ $brand->is_active ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white/40 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ev-green/40"></div>
                            <span class="ml-3 text-[10px] font-black uppercase tracking-widest text-text-muted">Is Active</span>
                        </label>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-4">Brand Logo</label>
                        <div class="relative group aspect-square rounded-3xl border-2 border-dashed border-glass-border flex flex-col items-center justify-center p-8 hover:border-ev-green/30 transition-all duration-500 cursor-pointer overflow-hidden">
                            <input type="file" name="logo_file" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(event)">
                            <img id="logo-preview" src="{{ asset('storage/' . $brand->logo) }}" class="absolute inset-0 w-full h-full object-contain p-8 animate-fade-in">
                        </div>
                        @error('logo_file')<p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium flex-1 py-4 text-sm tracking-[0.2em]">Update Brand</button>
                <a href="{{ route('admin.brands.index') }}" class="px-10 py-4 glass-card border-white/5 hover:border-white/10 text-[10px] font-black uppercase tracking-widest text-text-muted hover:text-main flex items-center justify-center transition-all duration-300">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('logo-preview');
            
            reader.onload = function() {
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @endpush
</x-app-layout>
