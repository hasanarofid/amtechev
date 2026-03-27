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
                    {{ $settings['mission_content'] ?? 'Our mission is to make EV charging simple, safe, and accessible for everyone in Malaysia.' }}
                </p>
                <div class="p-8 rounded-3xl bg-ev-green text-black">
                    <p class="text-xl font-black">From consultation to installation, we handle everything — so you can enjoy a seamless EV experience.</p>
                </div>
            </div>
        </div>
    </div>
</section>
