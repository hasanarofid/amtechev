@if($tiktokVideos->count() > 0)
<section class="py-24 bg-ev-dark relative overflow-hidden" id="tiktok-videos">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-ev-green/5 rounded-full blur-[120px] mix-blend-screen pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16" x-data x-intersect="$el.classList.add('animate-fade-in-up')">
            <h2 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green mb-4 flex items-center justify-center gap-4">
                <span class="w-12 h-px bg-ev-green/50"></span>
                Social Media
                <span class="w-12 h-px bg-ev-green/50"></span>
            </h2>
            <h3 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-white mb-6">
                AMTECH on <span class="text-transparent bg-clip-text bg-gradient-to-r from-ev-green to-emerald-400 italic">TikTok</span>
            </h3>
            <p class="text-lg text-gray-400">Ikuti keseruan dan edukasi seputar EV Charger bersama kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($tiktokVideos as $video)
                <div class="relative rounded-2xl overflow-hidden bg-black/40 border border-white/5 hover:border-ev-green/30 transition-all duration-300 transform hover:-translate-y-2 flex items-center justify-center p-4">
                    <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@thedaddyamtech/video/{{ $video->video_id }}" data-video-id="{{ $video->video_id }}" style="max-width: 605px;min-width: 325px;" > <section></section> </blockquote> 
                    <script async src="https://www.tiktok.com/embed.js"></script>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="https://www.tiktok.com/@thedaddyamtech" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 px-8 py-4 bg-white text-black font-black uppercase tracking-widest text-sm hover:bg-ev-green hover:text-white transition-all duration-300 rounded-none group shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_30px_rgba(34,197,94,0.3)]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor"><path d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z"/></svg>
                VIEW ALL TIKTOK VIDEOS
            </a>
        </div>
    </div>
</section>
@endif
