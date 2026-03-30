<!-- resources/views/frontend/products.blade.php -->
<section id="products" class="py-32 bg-black">
    <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
        <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">Our Selection</h3>
        <h2 class="text-4xl lg:text-6xl font-black mb-20 uppercase">Featured <span class="italic text-ev-green">Chargers</span></h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($chargers as $charger)
            <div class="ev-card p-10 flex flex-col items-center">
                <img src="{{ str_starts_with($charger->image_url, 'http') ? $charger->image_url : asset('storage/' . $charger->image_url) }}" alt="{{ $charger->name }}" class="w-48 h-48 object-contain mb-8 ev-glow">
                <h4 class="text-xl font-bold mb-2">{{ $charger->name }}</h4>
                <span class="text-ev-green font-bold text-lg mb-8">{{ $charger->price }}</span>
                <a href="{{ route('catalog.show', $charger->id) }}" class="px-8 py-3 border border-white/10 rounded-full text-xs font-bold uppercase tracking-widest hover:border-ev-green hover:text-ev-green transition-all w-full text-center">View Details</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
