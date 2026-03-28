<!-- resources/views/frontend/brands.blade.php -->
<section class="py-32 bg-ev-dark border-y border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
        <h3 class="text-gray-500 font-bold uppercase tracking-[0.3em] mb-12 text-sm italic">FOR EVERY BRAND & MODEL</h3>
        <div class="flex flex-wrap justify-center items-center gap-12 md:gap-x-16 md:gap-y-12">
            @foreach($brands as $brand)
            <div class="h-16 w-36 md:h-24 md:w-56 flex items-center justify-center p-4 transition-all duration-300 transform hover:scale-110">
                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="max-h-full max-w-full object-contain brightness-100 hover:brightness-110 transition-all duration-300">
            </div>
            @endforeach
        </div>
    </div>
</section>
