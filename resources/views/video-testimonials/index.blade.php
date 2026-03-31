<x-app-layout>
    <x-slot:title>Manage Video Testimonials</x-slot:title>
    <x-slot name="header">
        Video Customer Feedback
    </x-slot>

    <div class="space-y-12">
        <div class="flex justify-between items-center">
            <h3 class="text-[10px] font-bold uppercase tracking-[0.3em] text-ev-green">Current Video Reviews</h3>
            <a href="{{ route('admin.video-testimonials.create') }}" class="btn-premium px-8 py-3 text-[10px] tracking-widest">
                ADD NEW VIDEO
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($videos as $video)
                <div class="glass-card overflow-hidden group flex flex-col h-full">
                    <div class="relative aspect-video bg-black/40">
                        @if($video->thumbnail_path)
                            <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="{{ $video->title }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-text-muted">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/20">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-white border border-white/20 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">Preview</span>
                        </div>
                    </div>

                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[8px] font-bold uppercase tracking-[0.2em] {{ $video->is_published ? 'text-ev-green' : 'text-red-500' }}">
                                {{ $video->is_published ? 'PUBLISHED' : 'DRAFT' }}
                            </span>
                            <span class="text-[10px] text-text-muted">ORDER: {{ $video->sort_order }}</span>
                        </div>

                        <h4 class="text-xl font-bold uppercase tracking-tight text-main mb-2">{{ $video->title }}</h4>
                        <p class="text-text-muted text-[10px] uppercase font-bold tracking-widest mb-6">Customer: {{ $video->customer_name }}</p>

                        <div class="flex gap-4 pt-6 border-t border-glass-border mt-auto">
                            <a href="{{ route('admin.video-testimonials.edit', $video) }}" class="flex-1 text-center py-2 text-[10px] font-bold uppercase tracking-widest text-text-muted hover:text-main transition-colors">Edit</a>
                            <form action="{{ route('admin.video-testimonials.destroy', $video) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center py-2 text-[10px] font-bold uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                    <p class="text-lg">No video feedback available.</p>
                    <a href="{{ route('admin.video-testimonials.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Add first video</a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
