<div x-data="{ 
    mobileMenuOpen: false, 
    cartOpen: {{ session('open_cart') ? 'true' : 'false' }} 
}" @keydown.escape="cartOpen = false" class="relative">
    <!-- Overlay for Cart Drawer Background -->
    <div x-show="cartOpen" @click="cartOpen = false" class="fixed inset-0 bg-black/40 z-[90] backdrop-blur-sm" style="display: none;"></div>

    <nav class="fixed top-0 left-0 w-full z-50 px-4 md:px-14 py-4 md:py-5 flex justify-between items-center bg-black/60 backdrop-blur-xl border-b border-white/5 transition-all duration-300">
        <a href="{{ route('home') }}" class="flex items-center gap-2 md:gap-3 group cursor-pointer">
            <div class="relative">
                <div class="absolute -inset-2 bg-ev-green/20 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <img src="{{ (isset($settings['site_logo']) && $settings['site_logo']) ? (Str::startsWith($settings['site_logo'], 'logo/') ? asset($settings['site_logo']) : asset('storage/' . $settings['site_logo'])) : asset('logo/amtech-removebg.png') }}" alt="Amtech EV Logo" class="h-8 md:h-9 w-auto relative">
            </div>
            <h1 class="text-base md:text-lg font-bold tracking-tighter text-white">
                @php
                    $siteName = $settings['site_title'] ?? 'AMTECH EV';
                    $parts = explode(' ', $siteName);
                    $firstPart = $parts[0] ?? 'AMTECH';
                    $secondPart = $parts[1] ?? 'EV';
                @endphp
                {{ $firstPart }} <span class="text-ev-green italic">{{ $secondPart }}</span>
            </h1>
        </a>
        
        <div class="hidden md:flex gap-8 items-center text-sm font-medium text-gray-300">
            <a href="{{ route('home') }}" class="transition-all duration-300 {{ request()->routeIs('home') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
                Home
            </a>
            <a href="{{ route('booking.index') }}" class="transition-all duration-300 {{ request()->routeIs('booking.index') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
                Price Estimator
            </a>
            <a href="{{ route('check-slot.index') }}" class="transition-all duration-300 {{ request()->routeIs('check-slot.index') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
                Check & Book Slot
            </a>
            <a href="{{ route('catalog') }}" class="transition-all duration-300 {{ request()->routeIs('catalog') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
                EV Chargers Catalogue
            </a>
            <a href="{{ route('installation') }}" class="transition-all duration-300 {{ request()->routeIs('installation') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
                EV Charger Installation
            </a>
            <a href="{{ route('blog') }}" class="transition-all duration-300 {{ request()->routeIs('blog') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
                Blogs
            </a>
            <a href="{{ route('contact') }}" class="transition-all duration-300 {{ request()->routeIs('contact') ? 'px-5 py-2 border border-ev-green text-ev-green rounded-full font-bold' : 'hover:text-ev-green' }}">
                Contact Us
            </a>
        </div>
    
        <div class="flex items-center gap-3 md:gap-6">
            <!-- Search Icon -->
            <button class="text-white hover:text-ev-green transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 md:w-6 md:h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
    
            <!-- Profile Icon -->
            @if (Route::has('login'))
                @auth
                    @if(Auth::user()->role === 'member')
                        <a href="{{ route('user.dashboard') }}" class="text-white hover:text-ev-green transition-colors">
                    @else
                        <a href="{{ url('/dashboard') }}" class="text-white hover:text-ev-green transition-colors">
                    @endif
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 md:w-8 md:h-8">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12c0 2.754 1.144 5.241 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('user.login') }}" class="text-white hover:text-ev-green transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 md:w-8 md:h-8">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12c0 2.754 1.144 5.241 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endauth
            @endif
    
            <!-- Cart Icon -->
            <button @click="cartOpen = !cartOpen" class="text-white hover:text-ev-green transition-colors relative group/cart focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 md:w-6 md:h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                @php
                    $cartCount = count(session('cart', []));
                @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 bg-ev-green text-black text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center border border-black group-hover:scale-110 transition-transform">
                        {{ $cartCount }}
                    </span>
                @endif
            </button>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white hover:text-ev-green transition-colors focus:outline-none">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="fixed inset-0 z-40 md:hidden"
        style="display: none;"
    >
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md" @click="mobileMenuOpen = false"></div>
        
        <!-- Menu Content -->
        <div class="relative bg-black/90 border-b border-white/10 pt-24 pb-10 px-6">
            <div class="flex flex-col gap-6 text-center">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="text-xl font-medium tracking-tight {{ request()->routeIs('home') ? 'text-ev-green' : 'text-white' }}">
                    Home
                </a>
                <a href="{{ route('booking.index') }}" @click="mobileMenuOpen = false" class="text-xl font-medium tracking-tight {{ request()->routeIs('booking.index') ? 'text-ev-green' : 'text-white' }}">
                    Price Estimator
                </a>
                <a href="{{ route('check-slot.index') }}" @click="mobileMenuOpen = false" class="text-xl font-medium tracking-tight {{ request()->routeIs('check-slot.index') ? 'text-ev-green' : 'text-white' }}">
                    Check & Book Slot
                </a>
                <a href="{{ route('catalog') }}" @click="mobileMenuOpen = false" class="text-xl font-medium tracking-tight {{ request()->routeIs('catalog') ? 'text-ev-green' : 'text-white' }}">
                    EV Chargers Catalogue
                </a>
                <a href="{{ route('installation') }}" @click="mobileMenuOpen = false" class="text-xl font-medium tracking-tight {{ request()->routeIs('installation') ? 'text-ev-green' : 'text-white' }}">
                    EV Charger Installation
                </a>
                <a href="{{ route('blog') }}" @click="mobileMenuOpen = false" class="text-xl font-medium tracking-tight {{ request()->routeIs('blog') ? 'text-ev-green' : 'text-white' }}">
                    Blogs
                </a>
                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false" class="text-xl font-medium tracking-tight {{ request()->routeIs('contact') ? 'text-ev-green' : 'text-white' }}">
                    Contact Us
                </a>

                <div class="pt-6 border-t border-white/10">
                    @auth
                        @if(Auth::user()->role === 'member')
                            <a href="{{ route('user.dashboard') }}" @click="mobileMenuOpen = false" class="text-xl font-bold text-ev-green tracking-tight">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" @click="mobileMenuOpen = false" class="text-xl font-bold text-ev-green tracking-tight">
                                Admin Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('user.login') }}" @click="mobileMenuOpen = false" class="text-xl font-bold text-ev-green tracking-tight border border-ev-green rounded-full py-3">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div 
        x-show="cartOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 w-full md:w-[450px] bg-white z-[100] shadow-2xl flex flex-col"
        style="display: none;"
    >
        <!-- Drawer Header -->
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <h2 class="text-2xl font-bold text-gray-900">Your cart</h2>
            <button @click="cartOpen = false" class="text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Drawer Content -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-white">
            @php
                $cart = session('cart', []);
                $total = 0;
            @endphp
            
            @forelse($cart as $id => $item)
                @php
                    $price = (float)str_replace(['RM', ',', ' '], '', $item['price'] ?? 0);
                    $itemTotal = $price * (int)($item['quantity'] ?? 1);
                    $total += $itemTotal;
                @endphp
                <div class="flex gap-4 group/item">
                    <div class="w-24 h-24 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100 p-2">
                        <img src="{{ $item['image'] }}" class="w-full h-full object-contain">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start gap-2 mb-1">
                            <h3 class="text-xs font-bold text-gray-900 leading-snug truncate">{{ $item['name'] }}</h3>
                            <p class="text-[10px] font-black whitespace-nowrap">RM{{ number_format($itemTotal, 2) }} MYR</p>
                        </div>
                        <p class="text-[10px] text-gray-500 mb-3">RM{{ number_format($price, 2) }} MYR</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden h-8">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                    <button type="submit" @if($item['quantity'] <= 1) disabled @endif class="w-8 h-full flex items-center justify-center hover:bg-gray-50 disabled:opacity-30 text-xs">－</button>
                                </form>
                                <span class="w-10 text-center text-[10px] font-bold">{{ $item['quantity'] }}</span>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                    <button type="submit" class="w-8 h-full flex items-center justify-center hover:bg-gray-50 text-xs">＋</button>
                                </form>
                            </div>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="h-64 flex flex-col items-center justify-center text-gray-400 space-y-4">
                    <svg class="w-16 h-16 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p class="text-sm font-medium">Your cart is empty</p>
                    <a href="{{ route('catalog') }}" @click="cartOpen = false" class="text-xs font-black text-ev-green uppercase tracking-widest hover:underline">Continue Shopping</a>
                </div>
            @endforelse
        </div>

        <!-- Drawer Footer -->
        @if(count($cart) > 0)
        <div class="p-6 border-t border-gray-100 space-y-6 bg-white shadow-[0_-10px_30px_rgba(0,0,0,0.05)]">
            <div class="flex justify-between items-end">
                <div>
                    <p class="text-base font-bold text-gray-900 mb-1">Estimated total</p>
                    <p class="text-[10px] text-gray-400">Taxes, discounts and shipping calculated at checkout.</p>
                </div>
                <p class="text-lg font-black">RM{{ number_format($total, 2) }} MYR</p>
            </div>
            <a href="{{ route('checkout') }}" class="w-full bg-[#3BB77E] hover:bg-[#34a871] text-white font-bold py-4 rounded-xl transition-all text-sm tracking-widest uppercase text-center block shadow-lg shadow-ev-green/20 scale-100 hover:scale-[1.02]">
                Check out
            </a>
        </div>
        @endif
    </div>

    @if(isset($settings['whatsapp_number']) && $settings['whatsapp_number'])
    <div x-data="{ whatsappOpen: false }" class="fixed bottom-8 right-8 z-[60]">
        <!-- Mobile WhatsApp Bubble Backdrop -->
        <div x-show="whatsappOpen" @click="whatsappOpen = false" class="fixed inset-0 bg-black/20 z-[90] md:hidden" style="display: none;"></div>
        
        <!-- Bubble Button -->
        <button @click="whatsappOpen = !whatsappOpen" class="bg-[#25D366] hover:bg-[#128C7E] text-white p-4 rounded-full shadow-2xl transition-all hover:scale-110 group relative border-4 border-white">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </button>

        <!-- Chat Popup -->
        <div x-show="whatsappOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-10 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             class="absolute bottom-20 right-0 w-[calc(100vw-2rem)] sm:w-80 bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100 z-[100]"
             style="display: none;">
            <!-- Popup Header -->
            <div class="bg-[#075E54] p-6 text-white text-center">
                <p class="font-bold text-lg mb-1">WhatsApp</p>
                <p class="text-[10px] opacity-80 uppercase tracking-widest font-black">Typically replies within minutes</p>
                <button @click="whatsappOpen = false" class="absolute top-4 right-4 opacity-50 hover:opacity-100 transition-opacity">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <!-- Popup Body -->
            <div class="p-4 bg-[#e5ddd5] min-h-[150px] relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 100 100\'%3E%3Cpath d=\'M30.5 15.5l-1.1 2c-.2.4-.6.6-1 .6H25c-1.1 0-2 .9-2 2v3c0 1.1.9 2 2 2h2.4c.4 0 .8.2 1 .6l1.1 2c.6 1.1 2.3 1.1 2.9 0l1.1-2c.2-.4.6-.6 1-.6H35c1.1 0 2-.9 2-2v-3c0-1.1-.9-2-2-2h-2.4c-.4 0-.8-.2-1-.6l-1.1-2c-.6-1.1-2.3-1.1-2.9 0z\' fill=\'%23000\' fill-opacity=\'.1\'/%3E%3C/svg%3E');"></div>
                <div class="bg-white p-4 rounded-lg rounded-tl-none shadow-sm relative z-10 max-w-[90%]">
                    <p class="text-sm text-gray-800">{{ $settings['whatsapp_bubble_text'] ?? 'Hi, I want to install an EV charger - Amtech EV' }}</p>
                </div>
            </div>

            <!-- Popup Footer -->
            <div class="p-4 bg-white">
                @php
                    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
                    $waText = urlencode($settings['whatsapp_bubble_text'] ?? 'Hi, I want to install an EV charger - Amtech EV');
                    $waLink = "https://wa.me/" . $waNumber . "?text=" . $waText;
                @endphp
                <a href="{{ $waLink }}" target="_blank" class="flex items-center justify-between bg-[#25D366] hover:bg-[#128C7E] text-white px-4 py-3 rounded-full font-bold text-sm transition-colors">
                    Send message
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
