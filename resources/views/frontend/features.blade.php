<!-- resources/views/frontend/features.blade.php -->
<section class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['title' => 'Highest Quality Charger', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['title' => 'Quick Installations', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                ['title' => 'EV Spare Parts', 'icon' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H4a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 011 1v1a2 2 0 114 0V4z'],
                ['title' => 'Eco-Friendly Solutions', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z']
            ] as $info)
            <div class="flex flex-col items-center text-center group">
                <div class="w-16 h-16 bg-ev-green/10 border border-ev-green/20 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-ev-green group-hover:text-black transition-all">
                    <svg class="w-8 h-8 text-ev-green group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"></path></svg>
                </div>
                <h4 class="text-sm font-bold uppercase tracking-widest">{{ $info['title'] }}</h4>
            </div>
            @endforeach
        </div>
    </div>
</section>
