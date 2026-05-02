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
        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 text-xs text-gray-500 uppercase tracking-widest">
            <div class="flex flex-col md:flex-row items-center gap-2 md:gap-6">
                <p>{{ $settings['footer_copyright'] ?? '© 2026 AMTECH EV Specialist. All rights reserved.' }}</p>
                <div class="hidden md:block w-px h-3 bg-white/10"></div>
                <p>developer by <a href="https://hasanarofid.site" class="text-ev-green hover:text-white transition-colors">hasanarofid.site</a></p>
            </div>
            <div class="flex gap-8 font-bold">
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
