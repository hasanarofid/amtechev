<!-- resources/views/frontend/features.blade.php -->
<section class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="text-center mb-16">
            <h2 class="text-2xl font-bold uppercase tracking-[0.3em] text-ev-green mb-4">🔥 KEY BENEFITS</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['title' => '1-Year Warranty', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['title' => 'FREE Site Visit (Selangor & KL)', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                ['title' => 'Installation Across Malaysia', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['title' => 'Full A–Z Consultation', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z']
            ] as $info)
            <div class="flex flex-col items-center text-center group">
                <div class="w-16 h-16 bg-ev-green/10 border border-ev-green/20 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-ev-green group-hover:text-black transition-all">
                    <svg class="w-8 h-8 text-ev-green group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"></path></svg>
                </div>
                <h4 class="text-xs font-bold uppercase tracking-widest transition-colors group-hover:text-ev-green">{{ $info['title'] }}</h4>
            </div>
            @endforeach
        </div>
    </div>
</section>
