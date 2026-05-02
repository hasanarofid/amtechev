<!-- resources/views/frontend/catalog/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products – {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }}</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    
    <!-- AdSense Script -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7190047001129861" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #ffffff; color: #1a1a1a; }
        .text-muted { color: #6b7280; }
        .filter-title { font-size: 0.875rem; font-weight: 600; padding-bottom: 0.75rem; border-bottom: 1px solid #e5e7eb; margin-bottom: 1rem; }
        .product-card img { transition: transform 0.5s ease; }
        .product-card:hover img { transform: scale(1.05); }
    </style>
</head>
<body class="antialiased">

    @include('frontend.header')

    <!-- Catalog Content -->
    <main class="max-w-7xl mx-auto px-6 lg:px-14 pt-32 pb-24">
        <h1 class="text-4xl font-bold mb-12">Products</h1>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-64 flex-shrink-0">
                <div class="mb-8">
                    <p class="text-xs uppercase tracking-widest text-muted mb-4">Filter:</p>
                    
                    <div class="mb-6">
                        <button class="flex justify-between items-center w-full py-2 text-sm font-semibold border-b border-gray-100 mb-4">
                            Availability
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="space-y-3 px-2">
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-ev-green focus:ring-ev-green">
                                In stock ({{ $chargers->count() }})
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-400 cursor-pointer">
                                <input type="checkbox" disabled class="rounded border-gray-200">
                                Out of stock (0)
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <button class="flex justify-between items-center w-full py-2 text-sm font-semibold border-b border-gray-100 mb-4">
                            Price
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Product Grid -->
            <div class="flex-1">
                <div class="flex justify-between items-center mb-10 text-sm">
                    <div class="flex items-center gap-4">
                        <span class="text-muted">Sort by:</span>
                        <select class="border-none bg-transparent font-semibold focus:ring-0 cursor-pointer">
                            <option>Alphabetically, A-Z</option>
                            <option>Price, low to high</option>
                            <option>Price, high to low</option>
                            <option>Date, new to old</option>
                        </select>
                    </div>
                    <span class="text-muted">{{ $chargers->count() }} products</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                    @foreach($chargers as $charger)
                    <a href="{{ route('catalog.show', $charger->id) }}" class="product-card group cursor-pointer">
                        <div class="aspect-square bg-gray-50 rounded-xl overflow-hidden mb-6 relative">
                            <img src="{{ str_starts_with($charger->image_url, 'http') ? $charger->image_url : asset('storage/' . $charger->image_url) }}" 
                                 alt="{{ $charger->name }}" 
                                 class="w-full h-full object-contain p-8">
                            
                            <!-- Quick View Overlay -->
                            <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="bg-white px-6 py-2 rounded-full text-xs font-bold shadow-lg">View Details</span>
                            </div>
                        </div>
                        <h3 class="text-sm font-medium mb-2 group-hover:underline leading-relaxed">{{ $charger->name }}</h3>
                        <p class="text-gray-900 font-bold">{{ $charger->price }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    @include('frontend.footer')

</body>
</html>
