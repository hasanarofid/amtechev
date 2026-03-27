<!-- resources/views/frontend/hero.blade.php -->
<section class="relative min-h-screen flex items-center pt-24 hero-bg overflow-hidden">
    <div class="ev-hero-gradient absolute inset-0 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10 w-full">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-ev-green/10 border border-ev-green/20 rounded-full mb-8">
                <span class="w-2 h-2 bg-ev-green rounded-full animate-pulse-green"></span>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-ev-green">{{ $settings['hero_badge'] ?? "BEST VALUE • EXPERT WORKMANSHIP" }}</span>
            </div>
            <h2 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                {!! $settings['hero_title'] ?? "Malaysia's <span class=\"text-ev-green\">Electric Vehicle</span><br>Charger Specialist" !!}
            </h2>
            <p class="text-2xl font-black text-ev-green mb-8 ev-glow">Starting from RM898.00</p>
            <p class="text-lg text-gray-300 mb-10 max-w-xl leading-relaxed">
                {{ $settings['hero_subtitle'] ?? 'Enjoy a hassle-free EV charger installation with a FREE site visit across Selangor & Kuala Lumpur. No Hidden Charge. No Pressure. Transparent pricing, expert consultation, and clean, precise installation — done right from start to finish.' }}
            </p>
            <div class="flex flex-col gap-4">
                <div class="flex flex-wrap gap-6">
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '601167686742' }}?text={{ urlencode($settings['whatsapp_bubble_text'] ?? 'Hi, I want to install an EV charger') }}" class="btn-ev px-10 py-4">
                        {{ $settings['hero_cta_main'] ?? 'WhatsApp Now' }}
                    </a>
                    <a href="#contact" class="px-10 py-4 border border-white/20 rounded-full font-bold hover:bg-white/5 transition-all text-sm uppercase tracking-widest">
                        {{ $settings['hero_cta_secondary'] ?? 'Get Free Site Visit' }}
                    </a>
                </div>
                <p class="text-xs text-gray-500 italic ml-2">
                    {{ $settings['hero_cta_small'] ?? 'Fast response • No obligation consultation' }}
                </p>
            </div>
        </div>
    </div>
</section>
