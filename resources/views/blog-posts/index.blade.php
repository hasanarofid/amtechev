<x-app-layout>
    <x-slot:title>Manage Blog Posts</x-slot:title>
    <x-slot name="header">
        Insights & News
    </x-slot>

    <div class="flex justify-between items-center mb-8">
        <p class="text-text-muted text-sm font-medium">Manage news, guides, and insights for the charging community.</p>
        <a href="{{ route('admin.blog-posts.create') }}" class="btn-premium">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Write New Post
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <div class="glass-card overflow-hidden flex flex-col group">
                <div class="relative aspect-video bg-white/5 overflow-hidden">
                    <img src="{{ $post->image_url ? (str_starts_with($post->image_url, 'http') ? $post->image_url : asset('storage/' . $post->image_url)) : asset('storage/ev_hero_bg_1773856111374.png') }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @if($post->category)
                        <span class="absolute top-4 left-4 px-2 py-1 bg-black/50 backdrop-blur-md text-[10px] font-black uppercase tracking-widest rounded border border-white/10">{{ $post->category }}</span>
                    @endif
                </div>
                
                <div class="p-8 flex-1">
                    <div class="flex items-center gap-2 mb-4 text-[10px] font-bold uppercase tracking-widest text-text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                        {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                    </div>
                    <h3 class="text-lg font-bold uppercase tracking-tight text-main mb-4 group-hover:text-ev-green transition-colors line-clamp-2 leading-snug">{{ $post->title }}</h3>
                    <p class="text-text-muted text-xs leading-relaxed mb-6 line-clamp-3">{{ $post->excerpt }}</p>
                </div>

                <div class="p-4 bg-glass border-t border-glass-border flex gap-2">
                    <a href="{{ route('admin.blog-posts.edit', $post) }}" class="flex-1 text-center py-2 text-[10px] font-bold uppercase tracking-widest text-text-muted hover:text-main transition-colors">Edit</a>
                    <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-center py-2 text-[10px] font-bold uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                <svg class="mb-4 opacity-20" xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                <p class="text-lg">No blog posts available yet.</p>
                <a href="{{ route('admin.blog-posts.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Write your first post</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
