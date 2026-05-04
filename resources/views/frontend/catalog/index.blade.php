@extends('frontend.layouts.app')

@section('title', 'Products – ' . ($settings['site_title'] ?? 'AMTECH EV Specialist'))

@push('styles')
<style>
    .filter-title { font-size: 0.875rem; font-weight: 600; padding-bottom: 0.75rem; border-bottom: 1px solid #e5e7eb; margin-bottom: 1rem; }
    .product-card img { transition: transform 0.5s ease; }
    .product-card:hover img { transform: scale(1.05); }
</style>
@endpush

@section('content')
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
                        <p class="text-gray-900 font-bold dark:text-white">{{ $charger->price }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

