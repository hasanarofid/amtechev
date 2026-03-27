<!-- resources/views/frontend/gallery.blade.php -->
<section id="gallery" class="py-32 bg-black relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="text-center mb-20">
            <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">Gallery</h3>
            <h2 class="text-4xl lg:text-5xl font-bold mb-8 leading-tight">Our Workmanship</h2>
        </div>
        
        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
            @foreach(range(1, 9) as $i)
            <div class="break-inside-avoid relative group overflow-hidden rounded-3xl border border-white/10">
                <img src="{{ asset('galery/galeri' . $i . '.jpeg') }}" alt="Gallery {{ $i }}" class="w-full transform group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                    <p class="text-white font-bold">Installation #{{ $i }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
