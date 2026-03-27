<!-- resources/views/frontend/quality.blade.php -->
<section id="quality" class="py-32 bg-ev-dark relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">🔧 QUALITY & COMPONENTS</h3>
            <h2 class="text-4xl lg:text-5xl font-bold mb-8 leading-tight">
                {{ $settings['quality_title'] ?? 'Built with Quality & Safety in Mind' }}
            </h2>
            <p class="text-gray-400 text-lg leading-relaxed font-light">
                {{ $settings['quality_content'] ?? 'We use premium-grade components from trusted brands in Japan, France, and Switzerland — ensuring every installation is safe, reliable, and built to last.' }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['country' => 'Japan', 'desc' => 'Precision engineering and reliable electronics.'],
                ['country' => 'France', 'desc' => 'Innovative electrical components and safety standards.'],
                ['country' => 'Switzerland', 'desc' => 'High-performance connectivity and durability.']
            ] as $origin)
            <div class="p-8 rounded-3xl bg-black/40 border border-white/5 hover:border-ev-green/20 transition-all group">
                <div class="text-ev-green font-black text-2xl mb-4 tracking-tighter">{{ $origin['country'] }}</div>
                <p class="text-gray-400 font-light">{{ $origin['desc'] }}</p>
            </div>
            @endforeach
        </div>
        
        <div class="mt-20 p-8 rounded-[3rem] bg-gradient-to-r from-ev-green/20 to-transparent border border-ev-green/10 text-center">
            <p class="text-xl font-bold text-white">Your safety and long-term performance are our top priorities.</p>
        </div>
    </div>
</section>
