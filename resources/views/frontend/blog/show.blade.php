<!-- resources/views/frontend/blog/show.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} – {{ $settings['site_title'] ?? 'Amtech EV' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #ffffff; color: #1a1a1a; }
        .blog-header {
            padding: 140px 0 60px;
            background-color: #0a0a0a;
            color: #ffffff;
            position: relative;
        }
        .prose img { border-radius: 24px; margin: 40px 0; border: 1px solid #f3f4f6; }
        .prose h2 { font-weight: 800; color: #111827; }
        .prose p { line-height: 1.8; color: #374151; }
    </style>
</head>
<body class="antialiased">

    @include('frontend.header')

    <!-- Article Header -->
    <header class="blog-header">
        <div class="max-w-4xl mx-auto px-6 lg:px-14">
            <div class="flex items-center gap-3 text-ev-green font-bold text-xs uppercase tracking-[0.2em] mb-6">
                <span>{{ $post->category ?? 'Insights' }}</span>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <span class="text-white/40 uppercase">{{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</span>
            </div>
            <h1 class="text-4xl lg:text-6xl font-black mb-8 leading-tight">{{ $post->title }}</h1>
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-ev-green/20 flex items-center justify-center text-ev-green font-bold text-xs">A</div>
                <div class="text-sm font-medium">
                    <p class="text-white">Admin</p>
                    <p class="text-white/40">Expert in EV Solutions</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 lg:px-14 py-20">
        @if($post->image_url)
        <div class="mb-16 aspect-video rounded-[32px] overflow-hidden border border-gray-100 shadow-2xl">
            <img src="{{ str_starts_with($post->image_url, 'http') ? $post->image_url : asset('storage/' . $post->image_url) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <article class="prose prose-lg max-w-none prose-green prose-headings:font-black prose-headings:tracking-tight prose-a:text-ev-green">
            {!! $post->content !!}
        </article>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <div class="mt-32 pt-16 border-t border-gray-100">
            <h2 class="text-2xl font-black mb-12">More to <span class="italic text-ev-green">read</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $related)
                <a href="{{ route('blog.show', $related->slug) }}" class="group">
                    <div class="aspect-video rounded-2xl overflow-hidden mb-4 bg-gray-50 border border-gray-100">
                        <img src="{{ $related->image_url ? (str_starts_with($related->image_url, 'http') ? $related->image_url : asset('storage/' . $related->image_url)) : asset('storage/ev_charger_product_1773856128972.png') }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                    </div>
                    <h4 class="font-bold leading-tight group-hover:text-ev-green transition-colors">{{ $related->title }}</h4>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </main>

    @include('frontend.header') <!-- Using header as footer or should use footer? -->
    @include('frontend.footer')

</body>
</html>
