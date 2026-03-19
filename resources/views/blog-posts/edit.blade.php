<x-app-layout>
    <x-slot:title>Edit Post</x-slot:title>
    <x-slot name="header">
        Edit Post
    </x-slot>

    <div class="max-w-4xl">
        <form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Post Title</label>
                        <input type="text" name="title" value="{{ old('title', $blogPost->title) }}" required class="premium-input">
                        @error('title') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Category</label>
                        <input type="text" name="category" value="{{ old('category', $blogPost->category) }}" class="premium-input">
                        @error('category') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Author Name</label>
                        <input type="text" name="author_name" value="{{ old('author_name', $blogPost->author_name) }}" required class="premium-input">
                        @error('author_name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Publish Date</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', $blogPost->published_at ? $blogPost->published_at->format('Y-m-d\TH:i') : '') }}" class="premium-input">
                        @error('published_at') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Excerpt (Short Summary)</label>
                    <textarea name="excerpt" class="premium-input min-h-[80px]">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
                    @error('excerpt') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Main Content</label>
                    <textarea name="content" required class="premium-input min-h-[300px]">{{ old('content', $blogPost->content) }}</textarea>
                    @error('content') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Featured Image URL</label>
                    <input type="text" name="image_url" value="{{ old('image_url', $blogPost->image_url) }}" class="premium-input">
                    @error('image_url') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    UPDATE POST
                </button>
                <a href="{{ route('admin.blog-posts.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
