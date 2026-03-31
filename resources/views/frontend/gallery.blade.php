<!-- resources/views/frontend/gallery.blade.php -->
<section id="gallery" class="py-32 bg-black relative overflow-hidden">
    <!-- Header -->
    <div class="max-w-7xl mx-auto px-6 lg:px-14 mb-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-2xl">
                <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm animate-fade-in">Experience Excellence</h3>
                <h2 class="text-4xl lg:text-5xl font-bold leading-tight animate-fade-in">Our Expert Workmanship</h2>
            </div>
            <div class="flex gap-4">
                <button class="gallery-prev group p-4 rounded-2xl border border-white/10 bg-white/5 hover:bg-ev-green hover:border-ev-green transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:text-black"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                </button>
                <button class="gallery-next group p-4 rounded-2xl border border-white/10 bg-white/5 hover:bg-ev-green hover:border-ev-green transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:text-black"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Slider Container -->
    <div class="swiper gallerySwiper px-6 lg:px-14">
        <div class="swiper-wrapper">
            @foreach($galleryItems as $item)
            <div class="swiper-slide cursor-pointer" onclick="openLightbox('{{ asset($item->image_path) }}', '{{ $item->title }}')">
                <div class="relative group overflow-hidden rounded-[2rem] border border-white/10 aspect-[4/5]">
                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000 grayscale-[0.5] group-hover:grayscale-0">
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                    
                    <!-- Content -->
                    <div class="absolute inset-x-0 bottom-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="flex items-end justify-between">
                            <div>
                                <span class="text-ev-green font-bold text-[10px] uppercase tracking-widest block mb-2 opacity-0 group-hover:opacity-100 transition-opacity delay-100">Verified Project</span>
                                <h4 class="text-xl font-bold text-white">{{ $item->title }}</h4>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-ev-green flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 scale-50 group-hover:scale-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="gallery-lightbox" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 md:p-10 pointer-events-none">
        <div class="absolute inset-0 bg-black/95 backdrop-blur-xl transition-opacity duration-500 opacity-0" id="lightbox-bg"></div>
        
        <div class="relative max-w-5xl w-full h-full flex flex-col items-center justify-center scale-95 opacity-0 transition-all duration-500" id="lightbox-content">
            <button onclick="closeLightbox()" class="absolute -top-12 right-0 md:-right-12 text-white/50 hover:text-ev-green transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl shadow-ev-green/10">
            <h4 id="lightbox-title" class="text-white text-2xl font-bold mt-8"></h4>
        </div>
    </div>
</section>

<!-- Include Swiper CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        new Swiper(".gallerySwiper", {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".gallery-next",
                prevEl: ".gallery-prev",
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    });

    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxBg = document.getElementById('lightbox-bg');
    const lightboxContent = document.getElementById('lightbox-content');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');

    function openLightbox(img, title) {
        lightboxImg.src = img;
        lightboxTitle.innerText = title;
        
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        
        // Use timeout to trigger animations
        setTimeout(() => {
            lightbox.classList.add('pointer-events-auto');
            lightboxBg.classList.replace('opacity-0', 'opacity-100');
            lightboxContent.classList.replace('opacity-0', 'opacity-100');
            lightboxContent.classList.replace('scale-95', 'scale-100');
        }, 10);
    }

    function closeLightbox() {
        lightboxBg.classList.replace('opacity-100', 'opacity-0');
        lightboxContent.classList.replace('opacity-100', 'opacity-0');
        lightboxContent.classList.replace('scale-100', 'scale-95');
        lightbox.classList.remove('pointer-events-auto');
        
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        }, 500);
    }

    // Close on escape
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
