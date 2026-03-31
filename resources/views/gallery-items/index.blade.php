<x-app-layout>
    <x-slot:title>Manage Gallery</x-slot:title>
    <x-slot name="header">
        Workmanship Gallery
    </x-slot>

    <div class="flex justify-between items-center mb-8">
        <p class="text-text-muted text-sm font-medium">Manage the workmanship and installation photos displayed in your gallery.</p>
        <a href="{{ route('admin.gallery-items.create') }}" class="btn-premium">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Photo
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($items as $item)
            <div class="glass-card overflow-hidden flex flex-col group aspect-square">
                <div class="relative w-full h-full bg-white/5 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center p-4 text-center">
                        <p class="text-white text-[10px] font-bold uppercase tracking-widest mb-4">{{ $item->title ?? 'Untitled' }}</p>
                        <div class="flex gap-2 w-full">
                            <a href="{{ route('admin.gallery-items.edit', $item) }}" class="flex-1 py-2 bg-ev-green text-black text-[9px] font-black uppercase tracking-widest rounded-lg">Edit</a>
                            <form action="{{ route('admin.gallery-items.destroy', $item) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2 bg-red-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                <p class="text-lg">No gallery items yet.</p>
                <a href="{{ route('admin.gallery-items.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Upload your first photo</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
