<!-- resources/views/frontend/footer.blade.php -->
<footer class="bg-black py-24 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-16 mb-20">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-8">
                <img src="{{ (isset($settings['site_logo']) && $settings['site_logo']) ? (Str::startsWith($settings['site_logo'], 'logo/') ? asset($settings['site_logo']) : asset('storage/' . $settings['site_logo'])) : asset('logo/amtech-removebg.png') }}" alt="Amtech EV Logo" class="h-10 w-auto">
                <h1 class="text-3xl font-bold tracking-tight">
                    @php
                        $siteName = $settings['site_title'] ?? 'AMTECH EV';
                            $parts = explode(' ', $siteName);
                            $firstPart = $parts[0] ?? 'AMTECH';
                            $secondPart = $parts[1] ?? 'EV';
                        @endphp
                        {{ $firstPart }} <span class="text-ev-green italic tracking-tighter">{{ $secondPart }}</span>
                    </h1>
                </div>
                <p class="text-gray-400 max-w-sm leading-relaxed">
                    {{ $settings['footer_about'] ?? 'Leading the charge in Malaysia\'s EV revolution. Quality, reliability, and innovation in every connection.' }}
                </p>
            </div>
            <div>
                <h4 class="text-white font-bold uppercase tracking-widest mb-8">Quick Links</h4>
                <ul class="space-y-4 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-ev-green">About Us</a></li>
                    <li><a href="#" class="hover:text-ev-green">Services</a></li>
                    <li><a href="#" class="hover:text-ev-green">Chargers</a></li>
                    <li><a href="#" class="hover:text-ev-green">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold uppercase tracking-widest mb-8">Get Connected</h4>
                <p class="text-sm text-gray-400 mb-6">{{ $settings['contact_address'] ?? 'No 1, Jalan Amtech EV, 50000 Kuala Lumpur' }}</p>
                <a href="mailto:{{ $settings['contact_email'] ?? 'hello@amtechev.com' }}" class="text-ev-green font-bold text-center">{{ $settings['contact_email'] ?? 'hello@amtechev.com' }}</a>
            </div>
        </div>
        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <!-- Registration Badge -->
                <div class="bg-[#FFD700] text-black px-4 py-1.5 rounded-full flex items-center gap-2 shadow-lg shadow-yellow-400/20">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest">Registration No: 202503227566 (JM1030181-M)</span>
                </div>
                
                <div class="flex flex-col md:flex-row items-center gap-2 md:gap-6 text-xs text-gray-500 uppercase tracking-widest">
                    <p>{{ $settings['footer_copyright'] ?? '© 2026 AMTECH EV Specialist. All rights reserved.' }}</p>

                </div>
            </div>
            <div class="flex gap-8 font-bold">
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
