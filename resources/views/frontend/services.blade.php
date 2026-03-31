<!-- resources/views/frontend/services.blade.php -->
<section id="services" class="py-32 bg-ev-dark overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="relative">
                <div class="absolute -inset-4 bg-ev-green/20 blur-3xl rounded-full"></div>
                <img src="{{ (isset($settings['services_image']) && $settings['services_image']) ? (Str::startsWith($settings['services_image'], 'settings/') ? asset('storage/' . $settings['services_image']) : asset($settings['services_image'])) : asset('storage/ev_charger_product_1773856128972.png') }}" alt="EV Charger" class="relative rounded-3xl border border-white/10 shadow-2xl">
            </div>
            <div>
                <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">{{ $settings['services_badge'] ?? 'Our Expertise' }}</h3>
                <h2 class="text-4xl lg:text-5xl font-bold mb-8 leading-tight">{{ $settings['services_title'] ?? 'Expert EV Charging Specialist' }}</h2>
                <p class="text-gray-400 text-lg leading-relaxed mb-10 font-light">
                    {{ $settings['services_content'] ?? 'We provide comprehensive EV charging solutions tailored to your needs, ensuring a seamless experience from start to finish.' }}
                </p>
                <div class="space-y-6">
                    @foreach($services as $service)
                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 bg-ev-green/20 rounded-full flex items-center justify-center">
                            @if(str_starts_with($service->icon, 'heroicon'))
                                @svg($service->icon, 'text-ev-green w-4 h-4')
                            @else
                                <svg class="text-ev-green w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            @endif
                        </div>
                        <span class="font-semibold text-gray-200">{{ $service->title }}</span>
                    </div>
                    @endforeach
                </div>
                <a href="#contact" class="inline-block mt-12 btn-ev">Get a Quote</a>
            </div>
        </div>
    </div>
</section>
