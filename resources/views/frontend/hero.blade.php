<!-- resources/views/frontend/hero.blade.php -->
<section class="relative min-h-[90vh] lg:min-h-screen flex items-center pt-24 hero-bg overflow-hidden">
    <div class="ev-hero-gradient absolute inset-0 pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10 w-full py-20">
        <div class="max-w-4xl">
            <!-- Badge -->
            <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-white/5 border border-white/10 rounded-full mb-10 animate-reveal">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-ev-green opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-ev-green"></span>
                </span>
                <span class="text-[11px] font-bold uppercase tracking-[0.3em] text-gray-300">
                    {{ $settings['hero_badge'] ?? "BEST VALUE • EXPERT WORKMANSHIP" }}
                </span>
            </div>

            <!-- Title -->
            <h2 class="text-6xl lg:text-8xl font-black tracking-tighter mb-8 leading-[0.9] animate-reveal animation-delay-200">
                {!! $settings['hero_title'] ?? "Malaysia's <span class=\"text-ev-green font-outline-2\">Electric Vehicle</span><br>Charger Specialist" !!}
            </h2>

            <!-- Price Tag & Subtitle Container -->
            <div class="flex flex-col md:flex-row md:items-center gap-6 mb-12 animate-reveal animation-delay-400">
                <div class="px-6 py-3 bg-ev-green text-black font-black text-xl rounded-2xl rotate-[-2deg] shadow-xl shadow-ev-green/20">
                    Starting from RM898.00
                </div>
                <p class="text-xl text-gray-300 max-w-xl leading-relaxed font-light">
                    {{ $settings['hero_subtitle'] ?? 'Enjoy a hassle-free EV charger installation with a FREE site visit across Selangor & Kuala Lumpur.' }}
                </p>
            </div>

            <!-- CTAs -->
            <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-center animate-reveal animation-delay-600">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '601167686742') }}?text={{ urlencode($settings['whatsapp_bubble_text'] ?? 'Hi, I want to install an EV charger') }}" 
                   class="group relative inline-flex items-center justify-center px-10 py-5 font-black text-black transition-all duration-300 bg-ev-green rounded-full hover:bg-white hover:scale-105 active:scale-95 shadow-2xl shadow-ev-green/20">
                    <span class="relative uppercase tracking-widest text-sm">{{ $settings['hero_cta_main'] ?? 'WhatsApp Now' }}</span>
                </a>
                
                <a href="{{ route('contact') }}" class="group relative inline-flex items-center justify-center px-10 py-5 font-bold text-white transition-all duration-300 border border-white/20 rounded-full hover:bg-white/5 hover:border-white/40 active:scale-95 backdrop-blur-sm">
                    <span class="relative uppercase tracking-widest text-sm">{{ $settings['hero_cta_secondary'] ?? 'Get Free Site Visit' }}</span>
                </a>
                
                <div class="hidden lg:block ml-4 pl-8 border-l border-white/10">
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest font-black mb-1">Response Time</p>
                    <p class="text-sm text-gray-400 font-medium italic">~ 5 Minutes Average</p>
                </div>
            </div>
        </div>
    </div>
</section>
