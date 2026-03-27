<!-- resources/views/frontend/brands.blade.php -->
<section class="py-32 bg-ev-dark border-y border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
        <h3 class="text-gray-500 font-bold uppercase tracking-[0.3em] mb-12 text-sm italic">FOR EVERY BRAND & MODEL</h3>
        <div class="flex flex-wrap justify-center gap-12 opacity-40 grayscale hover:grayscale-0 transition-all duration-700">
            @foreach($brands as $brand)
            <div class="h-16 w-32 flex items-center justify-center p-2 group">
                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="max-h-full max-w-full object-contain filter brightness-200 group-hover:brightness-100 transition-all">
            </div>
            @endforeach
        </div>
    </div>
</section>
