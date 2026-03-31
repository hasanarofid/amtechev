<x-app-layout>
    <x-slot:title>Quality Section & Brands</x-slot:title>
    <x-slot name="header">
        Quality & Safety Management
    </x-slot>

    <div class="w-full space-y-12">
        <!-- Quality Section Settings -->
        <form action="{{ route('admin.site-settings.update', 0) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4">QUALITY SECTION CONTENT</h3>
            
            <div class="glass-card p-8 space-y-8">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Quality Section Title</label>
                    <input type="text" name="quality_title" value="{{ old('quality_title', $settings['quality_title'] ?? '') }}" class="premium-input">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Quality Section Description</label>
                    <textarea name="quality_content" rows="4" class="premium-input">{{ old('quality_content', $settings['quality_content'] ?? '') }}</textarea>
                </div>

                <div class="flex">
                    <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-widest">
                        UPDATE TEXT CONTENT
                    </button>
                </div>
            </div>
        </form>

        <!-- Brands Management -->
        <div class="space-y-6">
            <div class="flex justify-between items-center border-b border-ev-green/20 pb-4">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green">QUALITY PARTNER BRANDS</h3>
                <a href="{{ route('admin.quality-brands.create') }}" class="btn-premium py-2 px-6 text-[10px] tracking-widest">
                    ADD NEW BRAND
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($brands as $brand)
                    <div class="glass-card overflow-hidden flex flex-col group">
                        <div class="relative aspect-video bg-white flex items-center justify-center p-8 overflow-hidden">
                            <img src="{{ $brand->logo ? asset('storage/' . $brand->logo) : asset('storage/ev_charger_product_1773856128972.png') }}" alt="{{ $brand->name }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                        </div>
                        
                        <div class="p-6 flex-1">
                            <h4 class="text-lg font-bold uppercase tracking-tight text-main mb-2">{{ $brand->name }}</h4>
                            <p class="text-text-muted text-[10px] leading-relaxed">{{ Str::limit($brand->description, 100) }}</p>
                        </div>

                        <div class="p-4 bg-glass border-t border-glass-border flex gap-2">
                            <a href="{{ route('admin.quality-brands.edit', $brand) }}" class="flex-1 text-center py-2 text-[10px] font-bold uppercase tracking-widest text-text-muted hover:text-main transition-colors">Edit</a>
                            <form action="{{ route('admin.quality-brands.destroy', $brand) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center py-2 text-[10px] font-bold uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                        <p class="text-lg">No quality brands added yet.</p>
                        <a href="{{ route('admin.quality-brands.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Add your first brand</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
