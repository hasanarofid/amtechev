<x-app-layout>
    <x-slot:title>Add New Brand</x-slot:title>
    <x-slot name="header">
        Add New Brand
    </x-slot>

    <div class="max-w-4xl">
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="glass-card p-10">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Brand Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-white/5 border border-glass-border focus:border-ev-green/50 focus:ring-0 rounded-xl px-5 py-3 text-main transition-all duration-300">
                        @error('name')<p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" required class="w-full bg-white/5 border border-glass-border focus:border-ev-green/50 focus:ring-0 rounded-xl px-5 py-3 text-main transition-all duration-300">
                        @error('sort_order')<p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-4 py-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
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
                            <img id="logo-preview" class="absolute inset-0 w-full h-full object-contain p-8 hidden animate-fade-in">
                            <div id="upload-placeholder" class="text-center transition-opacity duration-300">
                                <svg class="w-10 h-10 text-white/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M16 8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-white/30">Click to upload logo</p>
                            </div>
                        </div>
                        @error('logo_file')<p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium flex-1 py-4 text-sm tracking-[0.2em]">Create Brand</button>
                <a href="{{ route('admin.brands.index') }}" class="px-10 py-4 glass-card border-white/5 hover:border-white/10 text-[10px] font-black uppercase tracking-widest text-text-muted hover:text-main flex items-center justify-center transition-all duration-300">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('logo-preview');
            const placeholder = document.getElementById('upload-placeholder');
            
            reader.onload = function() {
                preview.src = reader.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('opacity-0');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @endpush
</x-app-layout>
