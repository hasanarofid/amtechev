<!-- resources/views/frontend/services.blade.php -->
<section id="services" class="py-32 bg-ev-dark overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="relative">
                <div class="absolute -inset-4 bg-ev-green/20 blur-3xl rounded-full"></div>
                <img src="{{ asset('storage/ev_charger_product_1773856128972.png') }}" alt="EV Charger" class="relative rounded-3xl border border-white/10 shadow-2xl">
            </div>
            <div>
                <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">Empower Your EV Journey</h3>
                <h2 class="text-4xl lg:text-5xl font-bold mb-8 leading-tight">Reliable & Smart 🔌 Charging Solution</h2>
                <p class="text-gray-400 text-lg leading-relaxed mb-10 font-light">
                    Investing in an EV charging station for your home or business is more than just about charging; it's about convenience, cost-efficiency, and contributing to a greener future.
                </p>
                <div class="space-y-6">
                    @foreach(['Home Charging', 'Commercial Solutions', 'Maintenance Services'] as $item)
                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 bg-ev-green/20 rounded-full flex items-center justify-center">
                            <svg class="text-ev-green w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-semibold text-gray-200">{{ $item }}</span>
                    </div>
                    @endforeach
                </div>
                <a href="#contact" class="inline-block mt-12 btn-ev">Learn More</a>
            </div>
        </div>
    </div>
</section>
