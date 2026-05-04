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

@push('head')
    <!-- Primary Meta Tags -->
    <meta name="title" content="{{ $post->title }}">
    <meta name="description" content="{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 160) }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 160) }}">
    <meta property="og:image" content="{{ $post->image_url ? (str_starts_with($post->image_url, 'http') ? $post->image_url : (str_starts_with($post->image_url, 'blog-assets/') ? asset($post->image_url) : asset('storage/' . $post->image_url))) : asset('logo/amtech-removebg.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $post->title }}">
    <meta property="twitter:description" content="{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 160) }}">
    <meta property="twitter:image" content="{{ $post->image_url ? (str_starts_with($post->image_url, 'http') ? $post->image_url : (str_starts_with($post->image_url, 'blog-assets/') ? asset($post->image_url) : asset('storage/' . $post->image_url))) : asset('logo/amtech-removebg.png') }}">
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

        <!-- Share Buttons -->
        <div class="mt-16 py-10 border-y border-gray-100 dark:border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="flex items-center gap-3">
                <span class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 dark:text-white/30">Share this story</span>
            </div>
            <div class="flex flex-wrap items-center gap-3" x-data="{ copied: false }">
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                   class="w-12 h-12 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-[#1877F2] hover:text-white transition-all duration-500 shadow-sm hover:shadow-[#1877F2]/20 hover:shadow-xl" title="Share on Facebook">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                   class="w-12 h-12 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-[#0A66C2] hover:text-white transition-all duration-500 shadow-sm hover:shadow-[#0A66C2]/20 hover:shadow-xl" title="Share on LinkedIn">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>

                <!-- Threads -->
                <a href="https://threads.net/intent/post?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                   class="w-12 h-12 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-black dark:hover:bg-white dark:hover:text-black hover:text-white transition-all duration-500 shadow-sm hover:shadow-black/20 hover:shadow-xl" title="Share on Threads">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.103 12.107c-.292.024-.544.188-.703.416-.159.228-.212.539-.18.84.064.602.618 1.047 1.238 1.047.042 0 .084-.002.127-.007.292-.024.544-.188.703-.416.159-.228.212-.539.18-.84-.064-.602-.618-1.047-1.238-1.047-.042 0-.084.002-.127.007zm1.366-4.88c-.499-.053-.995.016-1.446.233-.451.217-.819.553-1.054.966-.114.2-.18.423-.19.645-.025.547.352 1.033.882 1.144.53.111 1.066-.2 1.282-.692.054-.124.08-.258.083-.393.001-.06.012-.119.034-.175.044-.112.146-.197.268-.225.122-.028.251-.004.354.066.103.07.168.179.177.299.009.12-.04.237-.134.318-.442.381-.663.958-.614 1.543.04.484.225.938.532 1.306.307.368.711.644 1.163.791.452.147.934.17 1.385.066.451-.104.851-.329 1.15-.654.3-.325.485-.733.532-1.173.047-.44-.041-.884-.251-1.272-.21-.388-.535-.7-.932-.897-.397-.197-.847-.282-1.298-.246zm-2.969 5.21c0-.403.11-.784.307-1.123-.16-.06-.326-.11-.497-.149-1.18-.266-2.423-.106-3.5.452-1.077.558-1.898 1.517-2.311 2.698-.413 1.18-.328 2.446.241 3.562.569 1.116 1.564 1.936 2.802 2.311 1.238.375 2.569.24 3.748-.38 1.179-.62 2.046-1.658 2.441-2.923.395-1.265.266-2.618-.363-3.81a4.329 4.329 0 00-1.551-1.748 4.333 4.333 0 00-2.317-.67zm.215 6.795c-.843.443-1.796.539-2.684.271-.888-.268-1.602-.857-2.01-1.658-.408-.8-.469-1.708-.172-2.555.297-.847.886-1.536 1.659-1.937.773-.401 1.664-.516 2.511-.325.847.191 1.579.68 2.059 1.378.48.698.718 1.528.67 2.338-.048.81-.39 1.545-1.033 2.088zM12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"/></svg>
                </a>

                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                   class="w-12 h-12 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-[#25D366] hover:text-white transition-all duration-500 shadow-sm hover:shadow-[#25D366]/20 hover:shadow-xl" title="Share on WhatsApp">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.438 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>

                <!-- Copy Link -->
                <button @click="navigator.clipboard.writeText('{{ url()->current() }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                        class="px-6 h-12 rounded-full bg-gray-100 dark:bg-white/5 flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:bg-ev-green hover:text-black transition-all duration-500 shadow-sm hover:shadow-ev-green/20 hover:shadow-xl group" title="Copy Link">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]" x-text="copied ? 'Copied!' : 'Copy Link'"></span>
                </button>
            </div>
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

