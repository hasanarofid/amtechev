<!-- resources/views/frontend/testimonials.blade.php -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    .testimonials-swiper {
        padding: 40px 20px 80px !important;
        margin: -40px -20px 0 !important;
    }
    
    .testimonial-card-bg {
        background: linear-gradient(145deg, rgba(15, 15, 15, 0.4) 0%, rgba(5, 5, 5, 0.6) 100%);
    }

    .testimonial-stars-glow {
        filter: drop-shadow(0 0 8px rgba(34, 197, 94, 0.3));
    }

    /* Swiper custom styles */
    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.2) !important;
        opacity: 1 !important;
        width: 8px !important;
        height: 8px !important;
        transition: all 0.5s ease !important;
    }
    .swiper-pagination-bullet-active {
        background: #22c55e !important;
        width: 32px !important;
        border-radius: 9999px !important;
        box-shadow: 0 0 15px rgba(34, 197, 94, 0.4);
    }
</style>

<section class="py-32 bg-black overflow-hidden border-t border-white/5 relative">
    <!-- Decore background -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-ev-green/5 blur-[120px] rounded-full -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-ev-green/5 blur-[120px] rounded-full translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10">
        <div class="text-center mb-20 animate-reveal">
            <h2 class="text-4xl lg:text-6xl font-bold mb-6 italic tracking-tight">
                Amtech EV reviews from <span class="text-ev-green">owners</span> and <span class="text-ev-green">experts</span>
            </h2>
            <div class="flex items-center justify-center gap-4">
                <div class="h-[1px] w-12 bg-ev-green/30"></div>
                <p class="text-gray-500 uppercase tracking-[0.3em] text-xs font-black">EXPERIENCE THE Amtech Ev DIFFERENCE TODAY</p>
                <div class="h-[1px] w-12 bg-ev-green/30"></div>
            </div>
        </div>

        <div class="{{ count($testimonials) > 3 ? 'swiper testimonials-swiper' : '' }}">
            <div class="{{ count($testimonials) > 3 ? 'swiper-wrapper' : 'grid grid-cols-1 md:grid-cols-3 gap-8 pb-10' }}">
                @foreach($testimonials as $testimonial)
                <div class="{{ count($testimonials) > 3 ? 'swiper-slide h-auto' : '' }}">
                    <div class="testimonial-card-bg border border-white/5 rounded-[2.5rem] p-10 h-full flex flex-col transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] backdrop-blur-md hover:border-ev-green/30 hover:-translate-y-4 hover:bg-[#111111] hover:shadow-[0_30px_60px_-20px_rgba(0,0,0,0.8),0_0_20px_rgba(34,197,94,0.05)] group">
                        <div class="flex gap-1 mb-8 text-ev-green testimonial-stars-glow">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>

                        <div class="text-gray-300 italic mb-10 leading-relaxed text-lg lg:text-xl font-light">
                            "{!! strip_tags($testimonial->content) !!}"
                        </div>

                        <div class="mt-auto flex items-center gap-5">
                            <div class="relative">
                                <div class="w-14 h-14 bg-ev-green/10 rounded-full overflow-hidden border border-white/10 group-hover:border-ev-green/50 transition-all duration-500">
                                    @if($testimonial->author_image)
                                        <img src="{{ str_starts_with($testimonial->author_image, 'http') ? $testimonial->author_image : asset('storage/' . $testimonial->author_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-ev-green/20">
                                            <span class="text-ev-green font-bold text-lg">{{ substr($testimonial->author_name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-ev-green rounded-full flex items-center justify-center border-2 border-black">
                                    <svg class="w-2.5 h-2.5 text-black fill-current" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-base lg:text-lg tracking-wide uppercase">{{ $testimonial->author_name }}</h4>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold mt-1">{{ $testimonial->author_role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if(count($testimonials) > 3)
                <div class="swiper-pagination !bottom-0"></div>
            @endif
        </div>
    </div>
</section>

@if(count($testimonials) > 3)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 32,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1150: {
                    slidesPerView: 3,
                }
            },
            speed: 1000,
            grabCursor: true,
        });
    });
</script>
@endif
