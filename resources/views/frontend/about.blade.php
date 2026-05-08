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
                    <div class="flex items-center gap-3 pt-4">
                        <div class="px-3 py-1 bg-ev-green/10 border border-ev-green/20 rounded-lg flex items-center gap-2">
                            <svg class="w-4 h-4 text-ev-green" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-xs font-bold text-white uppercase tracking-wider">SSM Registered</span>
                        </div>
                        <a href="{{ asset('documents/AmliftSSMCert.pdf') }}" target="_blank" class="text-xs text-gray-500 hover:text-ev-green underline transition-colors">View Certification</a>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <img src="{{ (isset($settings['about_image_1']) && $settings['about_image_1']) ? (Str::startsWith($settings['about_image_1'], 'settings/') ? asset('storage/' . $settings['about_image_1']) : asset($settings['about_image_1'])) : asset('galery/galeri1.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 hover:scale-[1.02] transition-all duration-700">
                    <img src="{{ (isset($settings['about_image_2']) && $settings['about_image_2']) ? (Str::startsWith($settings['about_image_2'], 'settings/') ? asset('storage/' . $settings['about_image_2']) : asset($settings['about_image_2'])) : asset('galery/galeri2.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 hover:scale-[1.02] transition-all duration-700">
                </div>
                <div class="space-y-4 pt-12">
                    <img src="{{ (isset($settings['about_image_3']) && $settings['about_image_3']) ? (Str::startsWith($settings['about_image_3'], 'settings/') ? asset('storage/' . $settings['about_image_3']) : asset($settings['about_image_3'])) : asset('galery/galeri3.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 hover:scale-[1.02] transition-all duration-700">
                    <img src="{{ (isset($settings['about_image_4']) && $settings['about_image_4']) ? (Str::startsWith($settings['about_image_4'], 'settings/') ? asset('storage/' . $settings['about_image_4']) : asset($settings['about_image_4'])) : asset('galery/galeri4.jpeg') }}" alt="Workmanship" class="rounded-2xl border border-white/10 hover:scale-[1.02] transition-all duration-700">
                </div>
            </div>
        </div>
    </div>
</section>
