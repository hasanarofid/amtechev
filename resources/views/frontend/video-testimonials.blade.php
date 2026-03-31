<!-- resources/views/frontend/video-testimonials.blade.php -->
<section id="feedback" class="py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="text-center max-w-3xl mx-auto mb-20 animate-reveal">
            <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">Customer Feedback</h3>
            <h2 class="text-4xl lg:text-5xl font-bold mb-6 text-black tracking-tight leading-tight">What Our Customers <span class="text-ev-green">Experience</span></h2>
            <p class="text-gray-500 text-lg font-light leading-relaxed">
                Real reviews from EV owners who have experienced the Amtech difference. Watch their stories.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($videoTestimonials as $video)
                <div class="group relative animate-reveal animation-delay-{{ $loop->index * 200 }}">
                    <!-- Video Container -->
                    <div class="relative aspect-video rounded-[2rem] overflow-hidden bg-black shadow-2xl shadow-black/5 cursor-pointer" onclick="openVideoModal('{{ asset('storage/' . $video->video_path) }}', '{{ $video->title }}')">
                        @if($video->thumbnail_path)
                            <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="{{ $video->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                        @else
                            <div class="w-full h-full bg-ev-dark/95 flex items-center justify-center opacity-80 group-hover:opacity-100 transition-opacity">
                                <svg class="w-12 h-12 text-ev-green opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif

                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/10 transition-colors">
                            <div class="w-20 h-20 bg-ev-green rounded-full flex items-center justify-center shadow-2xl shadow-ev-green/50 transform group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5.14v14l11-7-11-7z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="mt-8 px-4 text-center">
                        <h4 class="text-xl font-bold text-black mb-1">{{ $video->title }}</h4>
                        <p class="text-ev-green font-bold text-[10px] uppercase tracking-widest">{{ $video->customer_name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Video Lightbox Placeholder -->
    <div id="videoModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 md:p-10 bg-black/95 backdrop-blur-xl" onclick="event.target.id === 'videoModal' && closeVideoModal()">
        <!-- Close Button (Fixed Top Right) -->
        <button onclick="closeVideoModal()" class="fixed top-8 right-8 z-[110] w-14 h-14 bg-white/10 hover:bg-ev-green text-white hover:text-black rounded-full flex items-center justify-center transition-all duration-300 group shadow-2xl">
            <svg class="w-8 h-8 transform group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div class="w-full max-w-5xl aspect-video rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-2xl relative border border-white/10 bg-black">
            <video id="modalVideo" class="w-full h-full object-contain" controls crossorigin playsinline>
                <source id="modalVideoSource" src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <script>
        function openVideoModal(videoSrc, title) {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('modalVideo');
            const source = document.getElementById('modalVideoSource');
            
            source.src = videoSrc;
            video.load();
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            video.play();
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('modalVideo');
            
            video.pause();
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</section>
