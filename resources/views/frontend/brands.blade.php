<!-- resources/views/frontend/brands.blade.php -->
<section class="py-24 bg-gray-50 border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
        <div class="mb-16">
            <h3 class="text-gray-400 font-bold uppercase tracking-[0.3em] text-xs md:text-sm mb-3">Professional Charging Solutions</h3>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Compatible With All Major Brands</h2>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-8">
            @foreach($brands as $brand)
            <div class="group relative flex items-center justify-center h-32 md:h-40 p-6 bg-white rounded-2xl border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-md hover:border-ev-green/30 hover:-translate-y-1">
                <img src="{{ asset('storage/' . $brand->logo) }}" 
                     alt="{{ $brand->name }}" 
                     class="max-h-full max-w-full object-contain transition-all duration-500 opacity-90 group-hover:opacity-100 scale-90 group-hover:scale-105"
                     style="mix-blend-mode: multiply; filter: contrast(1.1) brightness(1.05);">
                
                {{-- Tooltip highlight --}}
                <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[10px] py-1 px-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap font-bold tracking-widest uppercase shadow-lg z-10">
                    {{ $brand->name }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
