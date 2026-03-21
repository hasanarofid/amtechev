<!-- resources/views/frontend/footer.blade.php -->
<footer class="bg-black py-24 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-16 mb-20">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-8">
                    <img src="/logo/amtech-removebg.png" alt="Amtech EV Logo" class="h-10 w-auto">
                    <h1 class="text-3xl font-bold tracking-tight">AMTECH <span class="text-ev-green italic tracking-tighter">EV</span></h1>
                </div>
                <p class="text-gray-400 max-w-sm leading-relaxed">
                    Leading the charge in Malaysia's EV revolution. Quality, reliability, and innovation in every connection.
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
            <p class="text-xs text-gray-500 uppercase tracking-widest">&copy; 2026 Amtech EV Malaysia. All rights reserved.</p>
            <div class="flex gap-8 text-[10px] font-bold uppercase tracking-widest text-gray-500">
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <a href="#" class="hover:text-white">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
