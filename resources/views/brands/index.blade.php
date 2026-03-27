<x-app-layout>
    <x-slot:title>Manage Brands</x-slot:title>
    <x-slot name="header">
        EV Brands
    </x-slot>

    <div class="flex justify-between items-center mb-8">
        <p class="text-text-muted text-sm font-medium">Manage the car brands displayed on the landing page.</p>
        <a href="{{ route('admin.brands.create') }}" class="btn-premium">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Brand
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($brands as $brand)
            <div class="glass-card overflow-hidden flex flex-col group">
                <div class="relative aspect-square bg-white/5 flex items-center justify-center p-8 overflow-hidden">
                    <img src="{{ $brand->logo ? asset('storage/' . $brand->logo) : asset('storage/ev_hero_bg_1773856111374.png') }}" alt="{{ $brand->name }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                    @if(!$brand->is_active)
                        <span class="absolute top-4 right-4 px-2 py-1 bg-red-500/20 text-red-500 text-[10px] font-black uppercase tracking-widest rounded border border-red-500/20">Inactive</span>
                    @endif
                </div>
                
                <div class="p-6 flex-1 text-center">
                    <h3 class="text-lg font-bold uppercase tracking-tight text-main">{{ $brand->name }}</h3>
                    <p class="text-text-muted text-[10px] mt-2 uppercase tracking-widest">Order: {{ $brand->sort_order }}</p>
                </div>

                <div class="p-4 bg-glass border-t border-glass-border flex gap-2">
                    <a href="{{ route('admin.brands.edit', $brand) }}" class="flex-1 text-center py-2 text-[10px] font-bold uppercase tracking-widest text-text-muted hover:text-main transition-colors">Edit</a>
                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-center py-2 text-[10px] font-bold uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                <svg class="mb-4 opacity-20" xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                <p class="text-lg">No brands available yet.</p>
                <a href="{{ route('admin.brands.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Create your first brand</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
