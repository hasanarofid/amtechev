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
                        {{ $settings['about_content_1'] ?? 'At Amtech EVC Specialist, we provide the best value EV charger installation in Malaysia with a trusted and experienced team.' }}
                    </p>
                    <p>
                        {{ $settings['about_content_2'] ?? 'We take pride in clean, precise workmanship — every installation is done with attention to detail, ensuring a neat and professional finish.' }}
                    </p>
                    <p class="text-ev-green font-bold">
                        {{ $settings['about_highlight'] ?? 'Installation is just one part - We take care of the full process.' }}
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <img src="{{ (isset($settings['about_image_1']) && $settings['about_image_1']) ? (Str::startsWith($settings['about_image_1'], 'settings/') ? asset('storage/' . $settings['about_image_1']) : asset($settings['about_image_1'])) : asset('galery/galeri1.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-700">
                    <img src="{{ (isset($settings['about_image_2']) && $settings['about_image_2']) ? (Str::startsWith($settings['about_image_2'], 'settings/') ? asset('storage/' . $settings['about_image_2']) : asset($settings['about_image_2'])) : asset('galery/galeri2.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-700">
                </div>
                <div class="space-y-4 pt-12">
                    <img src="{{ (isset($settings['about_image_3']) && $settings['about_image_3']) ? (Str::startsWith($settings['about_image_3'], 'settings/') ? asset('storage/' . $settings['about_image_3']) : asset($settings['about_image_3'])) : asset('galery/galeri3.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-700">
                    <img src="{{ (isset($settings['about_image_4']) && $settings['about_image_4']) ? (Str::startsWith($settings['about_image_4'], 'settings/') ? asset('storage/' . $settings['about_image_4']) : asset($settings['about_image_4'])) : asset('galery/galeri4.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-700">
                </div>
            </div>
        </div>
    </div>
</section>
