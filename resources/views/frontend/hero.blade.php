<!-- resources/views/frontend/hero.blade.php -->
<section class="relative min-h-screen flex items-center pt-24 hero-bg overflow-hidden">
    <div class="ev-hero-gradient absolute inset-0 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10 w-full">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-ev-green/10 border border-ev-green/20 rounded-full mb-8">
                <span class="w-2 h-2 bg-ev-green rounded-full animate-pulse-green"></span>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-ev-green">Malaysia's #1 EV Solutions</span>
            </div>
            <h2 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                {!! $settings['hero_title'] ?? "Malaysia's <span class=\"text-ev-green\">Electric Vehicle</span><br>Charger Specialist" !!}
            </h2>
            <p class="text-lg text-gray-300 mb-10 max-w-xl leading-relaxed">
                {{ $settings['hero_subtitle'] ?? 'Amtech EV makes EV charging accessible in Malaysia with high-quality products and services for homes and businesses. Experience the future of mobility today.' }}
            </p>
            <div class="flex flex-wrap gap-6">
                <a href="#products" class="btn-ev px-10 py-4">Explore Chargers</a>
                <a href="#contact" class="px-10 py-4 border border-white/20 rounded-full font-bold hover:bg-white/5 transition-all text-sm uppercase tracking-widest">Consult Now</a>
            </div>
        </div>
    </div>
</section>
