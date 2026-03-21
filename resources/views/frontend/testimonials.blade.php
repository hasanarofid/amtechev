<!-- resources/views/frontend/testimonials.blade.php -->
<section class="py-32 bg-black overflow-hidden border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="text-center mb-20">
            <div class="flex justify-center gap-1 mb-6">
                @for($i=0; $i<5; $i++)
                    <svg class="w-5 h-5 text-ev-green fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                @endfor
            </div>
            <h2 class="text-3xl lg:text-5xl font-bold mb-4 italic">EVSifu reviews from owners and experts</h2>
            <p class="text-gray-500 uppercase tracking-widest text-sm font-bold">EXPERIENCE THE EV SIFU DIFFERENCE TODAY</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="ev-card p-10">
                <p class="text-gray-300 italic mb-8 leading-relaxed">"{{ $testimonial->content }}"</p>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-ev-green/20 rounded-full overflow-hidden">
                        @if($testimonial->author_image)
                            <img src="{{ $testimonial->author_image }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div>
                        <p class="font-bold text-sm">{{ $testimonial->author_name }}</p>
                        <p class="text-xs text-gray-500">{{ $testimonial->author_role }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
