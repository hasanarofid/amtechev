@extends('frontend.layouts.app')

@section('title', 'Book Installation - AMTECH EV Specialist')

@section('content')
<div class="pt-32 pb-20 px-6 lg:px-14">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-16 text-center lg:text-left">
            <h1 class="text-5xl lg:text-7xl font-black tracking-tighter mb-6 leading-none">
                Installation <span class="text-ev-green font-outline-2">Booking</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl font-light">
                Professional EV charger installation service for your home or business. Select a package and fill out the form below.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-12 p-6 bg-ev-green/10 border border-ev-green/20 rounded-3xl text-ev-green flex items-center gap-4 animate-reveal">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-lg font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Left: Packages & Price Table -->
            <div class="lg:col-span-7 space-y-12">
                <!-- Main Package Highlight -->
                @php $mainPackage = $packages->where('category', 'Standard Package')->first(); @endphp
                @if($mainPackage)
                    <div class="ev-card glassmorphism p-8 lg:p-12 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 px-6 py-2 bg-ev-green text-black font-black text-xs uppercase tracking-widest rounded-bl-2xl">
                            Best Value
                        </div>
                        <h3 class="text-ev-green font-bold uppercase tracking-widest text-sm mb-4">Recommended</h3>
                        <h2 class="text-4xl font-black mb-6">{{ $mainPackage->name }}</h2>
                        
                        <div class="flex items-baseline gap-2 mb-8">
                            <span class="text-4xl font-black">RM{{ number_format($mainPackage->price, 0) }}</span>
                            @if($mainPackage->price_unit)
                                <span class="text-gray-500 font-medium">/ {{ $mainPackage->price_unit }}</span>
                            @endif
                        </div>

                        <ul class="space-y-4 mb-10">
                            @foreach($mainPackage->features ?? [] as $feature)
                                <li class="flex items-center gap-4 text-gray-300">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-ev-green/10 border border-ev-green/20 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ev-green" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="p-6 bg-white/5 border border-white/10 rounded-2xl">
                            <div class="flex items-center gap-4 text-ev-green mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="font-bold uppercase tracking-widest text-sm">Free Site Inspection</span>
                            </div>
                            <p class="text-gray-400 text-sm italic">Waived upon confirmation (Selangor & KL only)</p>
                        </div>
                    </div>
                @endif

                <!-- Additional Works Table -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Additional Works <span class="text-xs font-medium text-gray-500 uppercase tracking-widest">(If Required)</span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($packages->where('category', '!=', 'Standard Package')->groupBy('category') as $category => $items)
                            <div class="ev-card glassmorphism p-6 border-l-4 border-l-ev-green/50">
                                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-ev-green mb-4">{{ $category }}</h3>
                                <div class="space-y-4">
                                    @foreach($items as $item)
                                        <div class="flex justify-between items-start gap-4">
                                            <div>
                                                <p class="font-bold text-gray-200">{{ $item->name }}</p>
                                                @if($item->description)
                                                    <p class="text-[10px] text-gray-500 uppercase italic">{{ $item->description }}</p>
                                                @endif
                                            </div>
                                            <div class="text-right flex-shrink-0">
                                                <p class="text-ev-green font-black">RM{{ number_format($item->price, 0) }}</p>
                                                @if($item->price_unit)
                                                    <p class="text-[10px] text-gray-600 uppercase">/ {{ $item->price_unit }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right: Booking Form -->
            <div class="lg:col-span-5">
                <div class="sticky top-32">
                    <div class="ev-card glassmorphism p-8 lg:p-10 border-t-4 border-t-ev-green">
                        <h2 class="text-3xl font-black mb-8">Booking Form</h2>
                        
                        <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="group">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within:text-ev-green transition-colors">Full Name</label>
                                <input type="text" name="customer_name" required value="{{ old('customer_name') }}"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                    placeholder="e.g. Hasan Arofiid">
                                @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within:text-ev-green transition-colors">WhatsApp Number</label>
                                    <input type="tel" name="phone_number" required value="{{ old('phone_number') }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                        placeholder="012-3456789">
                                    @error('phone_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="group">
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within:text-ev-green transition-colors">Email (Optional)</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                        placeholder="your@email.com">
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within:text-ev-green transition-colors">Installation Address</label>
                                <textarea name="address" required rows="3"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                    placeholder="Full address for installation...">{{ old('address') }}</textarea>
                                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="group">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within:text-ev-green transition-colors">Select Package</label>
                                <select name="installation_package_id" required
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all appearance-none cursor-pointer">
                                    <option value="" class="bg-ev-dark">Choose a package...</option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}" {{ old('installation_package_id') == $package->id ? 'selected' : '' }} class="bg-ev-dark">
                                            {{ $package->name }} - RM{{ number_format($package->price, 0) }} {{ $package->price_unit ? '/ '.$package->price_unit : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('installation_package_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="group">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within:text-ev-green transition-colors">Additional Notes</label>
                                <textarea name="notes" rows="2"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                    placeholder="Special requests or requirements...">{{ old('notes') }}</textarea>
                                @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" 
                                class="w-full group relative inline-flex items-center justify-center px-10 py-5 font-black text-black transition-all duration-300 bg-ev-green rounded-full hover:bg-white hover:scale-[1.02] active:scale-95 shadow-2xl shadow-ev-green/20">
                                <span class="relative uppercase tracking-widest text-sm">Submit Booking Request</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
