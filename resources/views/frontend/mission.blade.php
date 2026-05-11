<!-- resources/views/frontend/mission.blade.php -->
<section id="mission" class="py-32 bg-black relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-ev-green/5 blur-[120px] rounded-full translate-x-1/2"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10">
        <div class="flex flex-col lg:flex-row gap-20 items-center">
            <div class="lg:w-1/2 order-2 lg:order-1">
                <div class="relative group">
                    <div class="absolute -inset-2 bg-ev-green/20 blur-2xl rounded-[3rem] opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <img src="{{ (isset($settings['mission_image']) && $settings['mission_image']) ? (Str::startsWith($settings['mission_image'], 'settings/') ? asset('storage/' . $settings['mission_image']) : asset($settings['mission_image'])) : asset('galery/galeri5.jpeg') }}" alt="Mission" class="relative rounded-[3rem] border border-white/10">
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
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '601167686742') }}?text={{ urlencode(strip_tags($settings['mission_cta_text'] ?? 'Speak to an EV Charging Specialist')) }}" 
                   class="flex flex-col md:flex-row items-center gap-6 p-8 rounded-[2.5rem] bg-ev-green text-black group/cta hover:scale-[1.02] active:scale-[0.98] transition-all duration-500 cursor-pointer shadow-lg hover:shadow-ev-green/20 relative overflow-hidden">
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover/cta:opacity-100 transition-opacity duration-500"></div>
                    <div class="p-4 bg-black/10 rounded-2xl group-hover/cta:bg-black/20 transition-colors shrink-0">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div class="text-xl md:text-2xl font-black leading-snug">
                            {!! $settings['mission_cta_text'] ?? 'Speak to an EV Charging Specialist — From a Free Site Visit and Consultation to Full Installation , We handle everything with expert workmanship and transparent pricing.' !!}
                        </div>
                        <span class="mt-4 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest opacity-60 group-hover/cta:opacity-100 transition-opacity">
                            Click to chat on WhatsApp <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===== AS SEEN IN / PRESS SECTION ===== --}}
<section id="press" class="relative py-20 overflow-hidden" style="background: linear-gradient(180deg, #000000 0%, #030f05 50%, #000000 100%);">

    {{-- Ambient glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:600px;height:200px;background:radial-gradient(ellipse,rgba(34,197,94,0.08) 0%,transparent 70%);"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10">

        {{-- Top label --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-3 mb-5">
                <div style="height:1px;width:40px;background:rgba(34,197,94,0.5);"></div>
                <span style="color:#22c55e;font-size:0.7rem;font-weight:800;letter-spacing:0.35em;text-transform:uppercase;">Media Coverage</span>
                <div style="height:1px;width:40px;background:rgba(34,197,94,0.5);"></div>
            </div>
            <h2 style="font-size:clamp(1.6rem,3.5vw,2.5rem);font-weight:800;color:#ffffff;line-height:1.2;margin-bottom:1rem;">
                Recognised by leading local media outlets such as
                <span style="color:#22c55e;">NST &amp; SAYS</span>
            </h2>
            <p style="color:#9ca3af;font-size:1rem;max-width:580px;margin:0 auto;line-height:1.7;">
                AMTECH EV has been recognised by leading local media outlets such as <strong style="color:#d1fae5;">NST &amp; SAYS</strong> for contributing insights and expertise in Malaysia's growing EV charging industry.
            </p>
        </div>

        {{-- Press Logo Cards --}}
        <div class="press-cards-wrapper" style="display:flex;flex-wrap:wrap;gap:2rem;justify-content:center;align-items:center;margin-bottom:3rem;">

            {{-- NEW STRAITS TIMES --}}
            <div class="press-card" style="
                display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.75rem;
                background:rgba(255,255,255,0.03);
                border:1px solid rgba(34,197,94,0.15);
                border-radius:1.5rem;
                padding:2rem 2.5rem;
                min-width:220px;
                transition:all 0.4s ease;
                cursor:default;
            " onmouseover="this.style.borderColor='rgba(34,197,94,0.5)';this.style.background='rgba(34,197,94,0.05)';this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 40px rgba(34,197,94,0.1)'"
               onmouseout="this.style.borderColor='rgba(34,197,94,0.15)';this.style.background='rgba(255,255,255,0.03)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
                {{-- NST Logo --}}
                <img src="{{ asset('nst3.png') }}" alt="New Straits Times" style="height:50px;width:auto;object-fit:contain;filter:brightness(0) invert(1);">
                <div class="press-badge" style="background:rgba(34,197,94,0.15);color:#22c55e;font-size:0.65rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;padding:0.3rem 0.85rem;border-radius:999px;border:1px solid rgba(34,197,94,0.3);">
                    As Featured In
                </div>
            </div>

            {{-- SAYS.COM --}}
            <div class="press-card" style="
                display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.75rem;
                background:rgba(255,255,255,0.03);
                border:1px solid rgba(34,197,94,0.15);
                border-radius:1.5rem;
                padding:2rem 2.5rem;
                min-width:220px;
                transition:all 0.4s ease;
                cursor:default;
            " onmouseover="this.style.borderColor='rgba(34,197,94,0.5)';this.style.background='rgba(34,197,94,0.05)';this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 40px rgba(34,197,94,0.1)'"
               onmouseout="this.style.borderColor='rgba(34,197,94,0.15)';this.style.background='rgba(255,255,255,0.03)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
                {{-- Says.com Logo --}}
                <img src="{{ asset('says.png') }}" alt="Says.com" style="height:50px;width:auto;object-fit:contain;filter:brightness(0) invert(1);">
                <div class="press-badge" style="background:rgba(34,197,94,0.15);color:#22c55e;font-size:0.65rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;padding:0.3rem 0.85rem;border-radius:999px;border:1px solid rgba(34,197,94,0.3);">
                    As Featured In
                </div>
            </div>

        </div>

        {{-- Bottom Trust Bar --}}
        <div style="border-top:1px solid rgba(255,255,255,0.06);padding-top:2rem;display:flex;flex-wrap:wrap;gap:1.5rem;justify-content:center;align-items:center;">
            @php
                $trustPoints = [
                    ['icon'=>'🏆','text'=>'Award-Worthy Service'],
                    ['icon'=>'🔌','text'=>'500+ EV Chargers Installed'],
                    ['icon'=>'🛡️','text'=>'Licensed & Insured Installer'],
                    ['icon'=>'⭐','text'=>'5-Star Rated by Customers'],
                ];
            @endphp
            @foreach($trustPoints as $tp)
                <div style="display:flex;align-items:center;gap:0.5rem;color:#9ca3af;font-size:0.8rem;font-weight:600;">
                    <span style="font-size:1rem;">{{ $tp['icon'] }}</span>
                    <span>{{ $tp['text'] }}</span>
                </div>
            @endforeach
        </div>

    </div>

    {{-- Scroll-reveal animation script (scoped) --}}
    <style>
        .press-card {
            opacity: 0;
            transform: translateY(30px);
            animation: pressCardReveal 0.7s ease forwards;
        }
        .press-card:nth-child(1) { animation-delay: 0.1s; }
        .press-card:nth-child(2) { animation-delay: 0.3s; }

        @keyframes pressCardReveal {
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 640px) {
            .press-cards-wrapper { flex-direction: column; align-items: center; }
            .press-card { width: 100%; max-width: 300px; }
        }
    </style>

</section>

