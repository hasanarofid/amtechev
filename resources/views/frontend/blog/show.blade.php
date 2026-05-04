@extends('frontend.layouts.app')

@section('title', $post->title . ' – ' . ($settings['site_title'] ?? 'AMTECH EV Specialist'))

@push('styles')
<style>
    .blog-header {
        padding: 140px 0 60px;
        background-color: #0a0a0a;
        color: #ffffff;
        position: relative;
    }
</style>
@endpush

@section('content')
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
        <div class="mb-16 aspect-video rounded-[32px] overflow-hidden border border-gray-100 dark:border-white/5 shadow-2xl">
            @php
                $src = str_starts_with($post->image_url, 'http') ? $post->image_url : (str_starts_with($post->image_url, 'blog-assets/') ? asset($post->image_url) : asset('storage/' . $post->image_url));
            @endphp
            <img src="{{ $src }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <div x-data="{ lang: 'en' }">
            <div class="flex gap-4 mb-10">
                <button @click="lang = 'en'" :class="lang === 'en' ? 'bg-ev-green text-black' : 'bg-white/10 text-white/50'" class="px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">English</button>
                @if($post->content_ms)
                <button @click="lang = 'ms'" :class="lang === 'ms' ? 'bg-ev-green text-black' : 'bg-white/10 text-white/50'" class="px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">Malaysia</button>
                @endif
            </div>

            <div x-show="lang === 'en'" class="animate-fade-in">
                <article class="prose prose-lg max-w-none prose-green prose-headings:font-black prose-headings:tracking-tight prose-a:text-ev-green dark:prose-invert">
                    {!! $post->content !!}
                </article>
            </div>

            @if($post->content_ms)
            <div x-show="lang === 'ms'" x-cloak class="animate-fade-in">
                <h1 class="text-4xl lg:text-5xl font-black mb-8 leading-tight dark:text-white">{{ $post->title_ms ?? $post->title }}</h1>
                <article class="prose prose-lg max-w-none prose-green prose-headings:font-black prose-headings:tracking-tight prose-a:text-ev-green dark:prose-invert">
                    {!! $post->content_ms !!}
                </article>
            </div>
            @endif
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <div class="mt-32 pt-16 border-t border-gray-100 dark:border-white/5">
            <h2 class="text-2xl font-black mb-12 dark:text-white">More to <span class="italic text-ev-green">read</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $related)
                <a href="{{ route('blog.show', $related->slug) }}" class="group">
                    <div class="aspect-video rounded-2xl overflow-hidden mb-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5">
                        @php
                            $relatedSrc = $related->image_url ? (str_starts_with($related->image_url, 'http') ? $related->image_url : (str_starts_with($related->image_url, 'blog-assets/') ? asset($related->image_url) : asset('storage/' . $related->image_url))) : asset('storage/ev_charger_product_1773856128972.png');
                        @endphp
                        <img src="{{ $relatedSrc }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                    </div>
                    <h4 class="font-bold leading-tight group-hover:text-ev-green transition-colors dark:text-white">{{ $related->title }}</h4>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </main>
@endsection

