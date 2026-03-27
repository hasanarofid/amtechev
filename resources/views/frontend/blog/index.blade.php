<!-- resources/views/frontend/blog/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogs – {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #ffffff; color: #1a1a1a; }
        .hero-blog {
            background-color: #0a0a0a;
            color: #ffffff;
            padding: 140px 0 80px;
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.9)), url('{{ asset('storage/ev_hero_bg_1773856111374.png') }}');
            background-size: cover;
            background-position: center;
            text-align: center;
        }
        .post-card { border-bottom: 1px solid #f3f4f6; padding-bottom: 60px; margin-bottom: 60px; }
        .post-card:last-child { border-bottom: none; }
        .post-image { border-radius: 20px; overflow: hidden; transition: transform 0.5s ease; }
        .post-card:hover .post-image { transform: translateY(-8px); }
        .btn-read { display: inline-block; padding: 12px 32px; background-color: #22c55e; color: white; border-radius: 99px; font-weight: 700; font-size: 14px; transition: all 0.3s ease; }
        .btn-read:hover { background-color: #16a34a; transform: translateX(5px); }
    </style>
</head>
<body class="antialiased">

    @include('frontend.header')

    <!-- Hero Section -->
    <section class="hero-blog">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <h1 class="text-4xl lg:text-6xl font-black mb-6">Your Guide to <span class="text-ev-green">EV Charging</span><br>& Clean Energy</h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
                Stay updated with the latest news, maintenance tips, and technology in the world of Electric Vehicles.
            </p>
        </div>
    </section>

    <!-- Blog Posts List -->
    <main class="max-w-5xl mx-auto px-6 lg:px-14 py-24">
        @if($posts->count() > 0)
            @php $featured = $posts->first(); @endphp
            <!-- Featured Post -->
            <div class="mb-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="post-image aspect-[16/10]">
                        <img src="{{ str_starts_with($featured->image_url, 'http') ? $featured->image_url : asset('storage/' . $featured->image_url) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="text-ev-green font-bold text-xs uppercase tracking-widest mb-4">Latest Update</div>
                        <h2 class="text-3xl font-black mb-6 leading-tight">{{ $featured->title }}</h2>
                        <div class="text-gray-400 text-sm mb-6">{{ $featured->created_at ? $featured->created_at->format('M d, Y') : 'Mar 21, 2026' }} • By Admin</div>
                        <p class="text-gray-600 mb-8 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($featured->content), 200) }}
                        </p>
                        <a href="{{ route('blog.show', $featured->slug) }}" class="btn-read">Read Article</a>
                    </div>
                </div>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12">
                @foreach($posts->skip(1) as $post)
                <div class="post-card">
                    <div class="post-image aspect-[16/10] mb-8">
                        <img src="{{ str_starts_with($post->image_url, 'http') ? $post->image_url : asset('storage/' . $post->image_url) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="text-gray-400 text-xs mb-3">{{ $post->created_at ? $post->created_at->format('M d, Y') : 'Mar 21, 2026' }}</div>
                    <a href="{{ route('blog.show', $post->slug) }}">
                        <h3 class="text-xl font-bold mb-4 line-clamp-2 hover:text-ev-green transition-colors cursor-pointer">{{ $post->title }}</h3>
                    </a>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 leading-relaxed">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-2 text-ev-green font-bold text-sm group">
                        Read more
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7-7 7M3 12h18"></path></svg>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-400 italic">No blog posts found. Stay tuned!</p>
            </div>
        @endif
    </main>

    @include('frontend.footer')

</body>
</html>
