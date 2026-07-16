<x-app-layout>
    <x-slot:title>Manage TikTok Videos</x-slot:title>
    <x-slot name="header">
        TikTok Videos
    </x-slot>

    <div class="space-y-12">
        <div class="flex justify-between items-center">
            <h3 class="text-[10px] font-bold uppercase tracking-[0.3em] text-ev-green">Current TikTok Videos</h3>
            <a href="{{ route('admin.tiktok-videos.create') }}" class="btn-premium px-8 py-3 text-[10px] tracking-widest">
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
                    <div class="relative aspect-[9/16] bg-black/40 flex items-center justify-center p-4">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@thedaddyamtech/video/{{ $video->video_id }}" data-video-id="{{ $video->video_id }}" style="max-width: 605px;min-width: 325px;" > <section></section> </blockquote> 
                        <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>

                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[8px] font-bold uppercase tracking-[0.2em] {{ $video->is_active ? 'text-ev-green' : 'text-red-500' }}">
                                {{ $video->is_active ? 'ACTIVE' : 'DRAFT' }}
                            </span>
                            <span class="text-[10px] text-text-muted">ORDER: {{ $video->sort_order }}</span>
                        </div>

                        <h4 class="text-xl font-bold uppercase tracking-tight text-main mb-6">{{ $video->title ?? 'Untitled' }}</h4>

                        <div class="flex gap-4 pt-6 border-t border-glass-border mt-auto">
                            <a href="{{ route('admin.tiktok-videos.edit', $video) }}" class="flex-1 text-center py-2 text-[10px] font-bold uppercase tracking-widest text-text-muted hover:text-main transition-colors">Edit</a>
                            <form action="{{ route('admin.tiktok-videos.destroy', $video) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center py-2 text-[10px] font-bold uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                    <p class="text-lg">No TikTok video available.</p>
                    <a href="{{ route('admin.tiktok-videos.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Add first video</a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
