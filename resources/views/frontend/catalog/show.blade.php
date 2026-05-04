@extends('frontend.layouts.app')

@section('title', $charger->name . ' – ' . ($settings['site_title'] ?? 'AMTECH EV Specialist'))

@section('content')
    <main class="max-w-7xl mx-auto px-6 lg:px-14 pt-32 pb-24">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-xs font-medium uppercase tracking-widest text-gray-400 gap-2">
            <a href="{{ route('home') }}" class="hover:text-ev-green">Home</a>
            <span>/</span>
            <a href="{{ route('catalog') }}" class="hover:text-ev-green">Products</a>
            <span>/</span>
            <span class="text-gray-900 dark:text-white">{{ $charger->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Image Gallery -->
            <div class="flex flex-col-reverse md:flex-row gap-4" x-data="{ activeImage: '{{ str_starts_with($charger->image_url, 'http') ? $charger->image_url : asset('storage/' . $charger->image_url) }}' }">
                <!-- Thumbnails -->
                <div class="flex md:flex-col gap-4 w-full md:w-20 overflow-x-auto md:overflow-visible pb-2 md:pb-0">
                    @php
                        $images = $charger->images ?? [$charger->image_url ?: asset('storage/ev_charger_product_1773856128972.png')];
                    @endphp
                    @foreach($images as $image)
                    <div @click="activeImage = '{{ $image }}'" 
                         :class="activeImage === '{{ $image }}' ? 'border-ev-green' : 'border-gray-100'"
                         class="aspect-square bg-gray-50 dark:bg-white/5 rounded-lg overflow-hidden border cursor-pointer hover:border-ev-green transition-colors p-2 shrink-0 w-20 h-20">
                        <img src="{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}" class="w-full h-full object-contain">
                    </div>
                    @endforeach
                </div>
                <!-- Main Image -->
                <div class="flex-1 aspect-square bg-gray-50 dark:bg-white/5 rounded-2xl overflow-hidden p-12 border border-gray-50 dark:border-white/5 flex items-center justify-center">
                    <img :src="activeImage" 
                         alt="{{ $charger->name }}" 
                         class="max-w-full max-h-full object-contain">
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-ev-green mb-4">MY STORE</p>
                <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">{{ $charger->name }}</h1>
                <p class="text-xl font-bold text-gray-900 dark:text-white mb-8">{{ $charger->price }} MYR</p>

                <form action="{{ route('cart.add', $charger->id) }}" method="POST" class="space-y-6 mb-10">
                    @csrf
                    <!-- Options -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Color</label>
                            <select class="w-full bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-lg px-4 py-3 text-sm focus:ring-ev-green focus:border-ev-green appearance-none cursor-pointer text-gray-900 dark:text-white">
                                <option>Black</option>
                                <option>White</option>
                                <option>Silver</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Length Of Cable</label>
                            <select class="w-full bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-lg px-4 py-3 text-sm focus:ring-ev-green focus:border-ev-green appearance-none cursor-pointer text-gray-900 dark:text-white">
                                <option>5m</option>
                                <option>7m</option>
                                <option>10m</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Need a qualified installer?</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative flex cursor-pointer group">
                                    <input type="radio" name="installation" value="no" class="peer sr-only" checked>
                                    <div class="w-full flex flex-col items-center justify-center py-4 bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-xl border-2 transition-all peer-checked:border-ev-green peer-checked:bg-ev-green/5 hover:border-ev-green/30">
                                        <span class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-ev-green transition-colors peer-checked:text-ev-green">No</span>
                                    </div>
                                </label>
                                <label class="relative flex cursor-pointer group">
                                    <input type="radio" name="installation" value="yes" class="peer sr-only">
                                    <div class="w-full flex flex-col items-center justify-center py-4 bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-xl border-2 transition-all peer-checked:border-ev-green peer-checked:bg-ev-green/5 hover:border-ev-green/30 text-center px-2">
                                        <span class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-ev-green transition-colors peer-checked:text-ev-green">Yes</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div x-data="{ count: 1 }">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Quantity</label>
                        <div class="flex items-center w-32 border border-gray-200 dark:border-white/10 rounded-lg overflow-hidden">
                            <button @click="if(count > 1) count--" type="button" class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 dark:hover:bg-white/5">－</button>
                            <input type="number" name="quantity" x-model="count" class="w-12 h-10 border-none text-center text-sm focus:ring-0 bg-transparent text-gray-900 dark:text-white">
                            <button @click="count++" type="button" class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 dark:hover:bg-white/5">＋</button>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 pt-4">
                        <button type="submit" class="w-full bg-[#3BB77E] hover:bg-[#34a871] text-white font-bold py-4 rounded-xl transition-colors text-sm tracking-widest uppercase shadow-lg shadow-ev-green/20">
                            Add to cart
                        </button>
                        
                        @if(isset($settings['whatsapp_number']))
                            @php
                                $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
                                $waText = urlencode("Looking For " . $charger->name . " Installation " . ($settings['site_name'] ?? 'AMTECH EV'));
                                $waLink = "https://wa.me/" . $waNumber . "?text=" . $waText;
                            @endphp
                            <a href="{{ $waLink }}" target="_blank" class="w-full border border-[#3BB77E] text-[#3BB77E] hover:bg-[#3BB77E] hover:text-white font-bold py-4 rounded-xl transition-all text-sm tracking-widest uppercase text-center">
                                Get Instant Quote
                            </a>
                        @endif
                    </div>
                </form>

                <button class="flex items-center gap-2 text-xs font-semibold text-gray-400 hover:text-ev-green transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0-10.628a2.25 2.25 0 1 0 2.146-2.186 2.25 2.25 0 0 0-2.146 2.186Zm0 10.628a2.25 2.25 0 1 0 2.146 2.186 2.25 2.25 0 0 0-2.146-2.186Z" />
                    </svg>
                    Share
                </button>
            </div>
        </div>

        <div class="mt-24 max-w-4xl bg-gray-50/50 dark:bg-white/5 rounded-3xl p-8 md:p-12 border border-gray-100 dark:border-white/5 prose prose-lg prose-green prose-headings:font-black prose-headings:tracking-tight dark:prose-invert">
            {!! $charger->description !!}
            
            <div class="mt-12 not-prose">
                <a href="{{ $waLink ?? '#' }}" class="inline-flex items-center gap-2 text-sm font-black text-[#3BB77E] hover:underline uppercase tracking-widest">
                    📞 Get Installation Quote or Chat Now
                </a>
            </div>
        </div>
    </main>
@endsection

