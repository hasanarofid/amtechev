<!-- resources/views/frontend/mission.blade.php -->
<section id="mission" class="py-32 bg-black relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-ev-green/5 blur-[120px] rounded-full translate-x-1/2"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10">
        <div class="flex flex-col lg:flex-row gap-20 items-center">
            <div class="lg:w-1/2 order-2 lg:order-1">
                <div class="relative group">
                    <div class="absolute -inset-2 bg-ev-green/20 blur-2xl rounded-[3rem] opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <img src="{{ asset('galery/galeri5.jpeg') }}" alt="Mission" class="relative rounded-[3rem] border border-white/10">
                </div>
            </div>
            <div class="lg:w-1/2 order-1 lg:order-2">
                <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">OUR MISSION</h3>
                <h2 class="text-4xl lg:text-5xl font-bold mb-8 leading-tight">
                    {{ $settings['mission_title'] ?? 'Supporting Malaysia’s EV Future' }}
                </h2>
                <p class="text-gray-400 text-lg leading-relaxed mb-10 font-light">
                    {{ $settings['mission_content'] ?? 'Our mission is to make EV charging simple, safe, and accessible for everyone in Malaysia with fair, transparent pricing and no bullshit pricing.' }}
                </p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '601167686742') }}?text={{ urlencode('From consultation to installation, we handle everything — so you can enjoy a seamless EV experience.') }}" 
                   target="_blank" 
                   class="flex flex-col md:flex-row items-center gap-6 p-8 rounded-[2.5rem] bg-ev-green text-black group/cta hover:scale-[1.02] active:scale-[0.98] transition-all duration-500 cursor-pointer shadow-lg hover:shadow-ev-green/20 relative overflow-hidden">
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover/cta:opacity-100 transition-opacity duration-500"></div>
                    <div class="p-4 bg-black/10 rounded-2xl group-hover/cta:bg-black/20 transition-colors shrink-0">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-xl md:text-2xl font-black leading-snug">
                            "From consultation to installation, we handle everything — so you can enjoy a seamless EV experience."
                        </p>
                        <span class="mt-4 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest opacity-60 group-hover/cta:opacity-100 transition-opacity">
                            Click to chat on WhatsApp <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
