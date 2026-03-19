<x-app-layout>
    <x-slot:title>Manage Chargers</x-slot:title>
    <x-slot name="header">
        EV Chargers
    </x-slot>

    <div class="flex justify-between items-center mb-8">
        <p class="text-text-muted text-sm font-medium">Manage your featured EV charging products on the landing page.</p>
        <a href="{{ route('admin.chargers.create') }}" class="btn-premium">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Charger
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($chargers as $charger)
            <div class="glass-card overflow-hidden flex flex-col group">
                <div class="relative aspect-square bg-white/5 flex items-center justify-center p-12 overflow-hidden">
                    <img src="{{ $charger->image_url ?: asset('storage/ev_charger_product_1773856128972.png') }}" alt="{{ $charger->name }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                    @if($charger->is_featured)
                        <span class="absolute top-4 right-4 px-2 py-1 bg-ev-green/20 text-ev-green text-[10px] font-black uppercase tracking-widest rounded border border-ev-green/20">Featured</span>
                    @endif
                </div>
                
                <div class="p-8 flex-1">
                    <h3 class="text-xl font-bold uppercase tracking-tight text-main mb-2">{{ $charger->name }}</h3>
                    <p class="text-text-muted text-xs leading-relaxed mb-6">{{ Str::limit($charger->description, 100) }}</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl font-black text-ev-green">{{ $charger->price }}</span>
                    </div>
                </div>

                <div class="p-4 bg-glass border-t border-glass-border flex gap-2">
                    <a href="{{ route('admin.chargers.edit', $charger) }}" class="flex-1 text-center py-2 text-[10px] font-bold uppercase tracking-widest text-text-muted hover:text-main transition-colors">Edit</a>
                    <form action="{{ route('admin.chargers.destroy', $charger) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-center py-2 text-[10px] font-bold uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                <svg class="mb-4 opacity-20" xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                <p class="text-lg">No chargers available yet.</p>
                <a href="{{ route('admin.chargers.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Create your first charger</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
