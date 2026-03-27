<!-- resources/views/frontend/about.blade.php -->
<section id="about" class="py-32 bg-black relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">⚡ ABOUT US</h3>
                <h2 class="text-4xl lg:text-5xl font-bold mb-8 leading-tight">
                    {{ $settings['about_title'] ?? 'Why Choose Amtech EVC Specialist?' }}
                </h2>
                <div class="text-gray-400 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        At Amtech EVC Specialist, we provide the best value EV charger installation in Malaysia with a trusted and experienced team.
                    </p>
                    <p>
                        We take pride in clean and <span class="text-white font-semibold italic">kemas</span> workmanship — every installation is done professionally, and we will adjust until you are fully satisfied.
                    </p>
                    <p class="text-ev-green font-bold">
                        We don’t just install — we guide you from A to Z.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <img src="{{ asset('galery/galeri1.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-700">
                    <img src="{{ asset('galery/galeri2.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-700">
                </div>
                <div class="space-y-4 pt-12">
                    <img src="{{ asset('galery/galeri3.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-700">
                    <img src="{{ asset('galery/galeri4.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-700">
                </div>
            </div>
        </div>
    </div>
</section>
