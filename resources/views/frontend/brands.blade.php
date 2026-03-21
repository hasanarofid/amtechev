<!-- resources/views/frontend/brands.blade.php -->
<section class="py-32 bg-ev-dark border-y border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
        <h3 class="text-gray-500 font-bold uppercase tracking-[0.3em] mb-12 text-sm italic">FOR EVERY BRAND & MODEL</h3>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-8 opacity-30 grayscale hover:grayscale-0 transition-all duration-700">
            @for($i=0; $i<12; $i++)
            <div class="h-12 bg-white/10 rounded-lg flex items-center justify-center text-[10px] font-bold uppercase tracking-widest">BRAND {{ $i+1 }}</div>
            @endfor
        </div>
    </div>
</section>
