<!-- resources/views/frontend/blog.blade.php -->
<section id="blog" class="py-32 bg-ev-dark border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
            <div>
                <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">Insights</h3>
                <h2 class="text-4xl lg:text-6xl font-black uppercase">Curious to <span class="italic text-ev-green">learn more?</span></h2>
            </div>
            <a href="{{ route('blog') }}" class="btn-ev px-8 py-3 text-sm">View All Posts</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($posts as $post)
            <a  href="{{ route('blog.show', $post->slug) }}" class="group cursor-pointer">
                <div class="relative aspect-video rounded-3xl overflow-hidden mb-8 border border-white/5">
                    @php
                        $postSrc = str_starts_with($post->image_url, 'http') ? $post->image_url : (str_starts_with($post->image_url, 'blog-assets/') ? asset($post->image_url) : asset('storage/' . $post->image_url));
                    @endphp
                    <img src="{{ $postSrc }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <h4 class="text-xl font-bold leading-tight group-hover:text-ev-green transition-colors">{{ $post->title }}</h4>
            </a>
            @endforeach
        </div>
    </div>
</section>
