@extends('frontend.layouts.app')

@section('title', 'Price Estimator - AMTECH EV Specialist')

@section('content')
<div class="pt-32 pb-20 px-6 lg:px-14" x-data="bookingForm()">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-16 text-center lg:text-left">
            <h1 class="text-5xl lg:text-7xl font-black tracking-tighter mb-6 leading-none">
                EVC Installation   <span class="text-ev-green font-outline-2">Price Estimator</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl font-light">
                Customize your installation and see your estimated cost instantly.
                <!-- Professional EV charger installation service for your home or business. Select a package and add-ons below. -->
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
            <!-- Left: Packages & Add-ons -->
            <div class="lg:col-span-7 space-y-12">
                <!-- Main Packages -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Select Package to Get Your Estimate.
                    </h2>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach($packages->where('category', 'Standard Package') as $package)
                            <div class="ev-card glassmorphism p-6 lg:p-8 relative overflow-hidden group cursor-pointer border-2 transition-all duration-300"
                                :class="isSelected({{ $package->id }}) ? 'border-ev-green bg-ev-green/5' : 'border-white/10 hover:border-ev-green/50'"
                                @click="togglePackage({{ json_encode($package) }})">
                                
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-colors"
                                                :class="isSelected({{ $package->id }}) ? 'bg-ev-green border-ev-green' : 'border-gray-600'">
                                                <svg x-show="isSelected({{ $package->id }})" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-black mb-2">{{ $package->name }}</h3>
                                            @if($package->features)
                                                <ul class="text-xs text-gray-400 space-y-1">
                                                    @foreach($package->features as $feature)
                                                        <li class="flex items-center gap-2">
                                                            <span class="w-1 h-1 bg-ev-green rounded-full"></span>
                                                            {{ $feature }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-2xl font-black text-ev-green">RM{{ number_format($package->price, 0) }}</div>
                                        @if($package->price_unit)
                                            <div class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">/ {{ $package->price_unit }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Additional Works -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Additional Works <span class="text-xs font-medium text-gray-500 uppercase tracking-widest">(If Required)</span>
                    </h2>

                    <div class="grid grid-cols-1 gap-4">
                        @foreach($packages->where('category', '!=', 'Standard Package')->groupBy('category') as $category => $items)
                            <div class="space-y-4">
                                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-ev-green px-2">{{ $category }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($items as $item)
                                        <div class="ev-card glassmorphism p-5 border-2 transition-all duration-300 flex flex-col justify-between"
                                            :class="isSelected({{ $item->id }}) ? 'border-ev-green bg-ev-green/5' : 'border-white/5 hover:border-ev-green/30'">
                                            
                                            <div class="flex justify-between items-start gap-4 mb-4">
                                                <div class="flex items-start gap-3 cursor-pointer" @click="togglePackage({{ json_encode($item) }})">
                                                    <div class="flex-shrink-0 mt-1">
                                                        <div class="w-5 h-5 rounded border-2 flex items-center justify-center transition-colors"
                                                            :class="isSelected({{ $item->id }}) ? 'bg-ev-green border-ev-green' : 'border-gray-600'">
                                                            <svg x-show="isSelected({{ $item->id }})" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-black" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="font-bold text-sm text-gray-200 leading-tight">{{ $item->name }}</p>
                                                        <p class="text-[10px] text-ev-green font-black mt-1">RM{{ number_format($item->price, 0) }} {{ $item->price_unit ? '/ '.$item->price_unit : '' }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div x-show="isSelected({{ $item->id }})" class="mt-auto pt-4 border-t border-white/10 flex items-center justify-between">
                                                <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Quantity</span>
                                                <div class="flex items-center gap-3">
                                                    <button @click="updateQty({{ $item->id }}, -1)" class="w-7 h-7 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition-colors">-</button>
                                                    <span class="text-sm font-black w-6 text-center" x-text="getQty({{ $item->id }})"></span>
                                                    <button @click="updateQty({{ $item->id }}, 1)" class="w-7 h-7 rounded-full bg-ev-green/20 hover:bg-ev-green/30 flex items-center justify-center text-ev-green transition-colors">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right: Summary & Form -->
            <div class="lg:col-span-5">
                <div class="sticky top-32 space-y-8">
                    <!-- Price Summary -->
                    <div class="ev-card glassmorphism p-8 border-t-4 border-t-ev-green">
                        <h2 class="text-2xl font-black mb-6">Booking Summary</h2>
                        
                        <div class="space-y-4 mb-8">
                            <template x-for="item in selectedItems" :key="item.id">
                                <div class="flex justify-between items-center text-sm">
                                    <div class="text-gray-400">
                                        <span x-text="item.name"></span>
                                        <span x-show="item.quantity > 1" class="text-ev-green ml-1" x-text="'x' + item.quantity"></span>
                                    </div>
                                    <div class="font-bold text-white" x-text="'RM' + (item.price * item.quantity).toLocaleString()"></div>
                                </div>
                            </template>
                            
                            <div x-show="selectedItems.length === 0" class="text-gray-500 italic text-sm py-4">
                                No items selected yet. Please select a package.
                            </div>
                        </div>

                        <div class="pt-6 border-t border-white/10 flex justify-between items-end">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1">Estimated Total</p>
                                <p class="text-4xl font-black text-ev-green leading-none">RM<span x-text="totalPrice.toLocaleString()"></span></p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-500 font-bold uppercase italic">SST Inc.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Client Info Form -->
                    <div class="ev-card glassmorphism p-8 border-white/10">
                        <h2 class="text-2xl font-black mb-8">Contact Information</h2>
                        
                        <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Hidden inputs for items -->
                            <template x-for="(item, index) in selectedItems" :key="item.id">
                                <div>
                                    <input type="hidden" :name="'items['+index+'][id]'" :value="item.id">
                                    <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.quantity">
                                </div>
                            </template>

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

                            <div class="group" wire:ignore>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-4 group-focus-within:text-ev-green transition-colors">Select Installation Date</label>
                                <div id="calendar-container" class="flatpickr-dark">
                                    <input type="text" name="preferred_date" id="preferred_date" required 
                                        class="hidden"
                                        x-model="selectedDate">
                                    <div id="booking-calendar"></div>
                                </div>
                                @error('preferred_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                
                                <div class="mt-4 flex items-center gap-6 text-[10px] font-black uppercase tracking-widest text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-ev-green"></span>
                                        Available
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full bg-red-500/50"></span>
                                        Full Slot
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within:text-ev-green transition-colors">Additional Notes</label>
                                <textarea name="notes" rows="2"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                    placeholder="Special requests or requirements...">{{ old('notes') }}</textarea>
                                @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" :disabled="selectedItems.length === 0 || !selectedDate"
                                class="w-full group relative inline-flex items-center justify-center px-10 py-5 font-black text-black transition-all duration-300 bg-ev-green rounded-full hover:bg-white hover:scale-[1.02] active:scale-95 shadow-2xl shadow-ev-green/20 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                                <span class="relative uppercase tracking-widest text-sm" x-text="selectedDate ? 'Submit Booking Request' : 'Select a Date First'"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Flatpickr Dark Theme for EV Specialist */
    .flatpickr-calendar {
        background: #0a0a0a !important;
        border: 1px solid rgba(34, 197, 94, 0.2) !important;
        box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.8) !important;
        border-radius: 32px !important;
        color: white !important;
        font-family: 'Outfit', sans-serif !important;
        margin-top: 15px !important;
        overflow: hidden !important;
        width: 315px !important;
        padding-bottom: 8px !important;
    }
    .flatpickr-innerContainer, .flatpickr-days, .dayContainer, .flatpickr-calendar.inline {
        background: transparent !important;
    }
    .flatpickr-months {
        background: transparent !important;
        padding: 20px 10px 10px !important;
    }
    .flatpickr-month {
        color: white !important;
        height: 40px !important;
    }
    .flatpickr-current-month {
        font-size: 1.1rem !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        color: white !important;
        padding: 0 !important;
    }
    .flatpickr-current-month .flatpickr-monthDropdown-months {
        font-weight: 900 !important;
    }
    .flatpickr-current-month input.cur-year {
        font-weight: 300 !important;
        color: rgba(255, 255, 255, 0.5) !important;
    }
    .flatpickr-months .flatpickr-prev-month, 
    .flatpickr-months .flatpickr-next-month {
        color: #22c55e !important;
        fill: #22c55e !important;
        top: 20px !important;
        padding: 10px !important;
        border-radius: 12px !important;
        background: rgba(34, 197, 94, 0.1) !important;
        transition: all 0.3s ease !important;
    }
    .flatpickr-months .flatpickr-prev-month:hover, 
    .flatpickr-months .flatpickr-next-month:hover {
        background: #22c55e !important;
        color: black !important;
        fill: black !important;
    }
    .flatpickr-calendar .flatpickr-innerContainer .flatpickr-weekdays,
    .flatpickr-weekdays {
        background: transparent !important;
        padding: 0 10px !important;
        border: none !important;
    }
    .flatpickr-weekday {
        color: #22c55e !important;
        font-weight: 900 !important;
        text-transform: uppercase !important;
        font-size: 11px !important;
        letter-spacing: 0.1em !important;
        padding-bottom: 10px !important;
    }
    .flatpickr-day {
        color: white !important;
        border-radius: 14px !important;
        height: 38px !important;
        line-height: 38px !important;
        margin: 2px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
        border: 1px solid transparent !important;
    }
    .flatpickr-day.today {
        border-color: #22c55e !important;
        color: #22c55e !important;
        background: rgba(34, 197, 94, 0.05) !important;
    }
    .flatpickr-day.selected, .flatpickr-day.selected:hover {
        background: #22c55e !important;
        border-color: #22c55e !important;
        color: black !important;
        box-shadow: 0 8px 20px -4px rgba(34, 197, 94, 0.5) !important;
        transform: scale(1.1);
    }
    .flatpickr-day:hover {
        background: rgba(34, 197, 94, 0.1) !important;
        border-color: rgba(34, 197, 94, 0.3) !important;
    }
    .flatpickr-day.flatpickr-disabled, .flatpickr-day.flatpickr-disabled:hover {
        color: rgba(255, 255, 255, 0.1) !important;
        background: transparent !important;
    }
    .flatpickr-day.is-full {
        background: rgba(239, 68, 68, 0.1) !important;
        color: #ef4444 !important;
        text-decoration: line-through !important;
        border-color: rgba(239, 68, 68, 0.2) !important;
    }
    .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay {
        color: rgba(255, 255, 255, 0.15) !important;
    }
</style>

<script>
    function bookingForm() {
        return {
            selectedItems: [],
            totalPrice: 0,
            selectedDate: '',
            availability: {},
            flatpickrInstance: null,

            init() {
                this.fetchAvailability();
            },

            async fetchAvailability() {
                try {
                    const response = await fetch('{{ route("api.booking-availability") }}');
                    const result = await response.json();
                    this.availability = result.data;
                    this.initCalendar();
                } catch (error) {
                    console.error('Failed to fetch availability', error);
                    this.initCalendar();
                }
            },

            initCalendar() {
                const self = this;
                this.flatpickrInstance = flatpickr("#booking-calendar", {
                    inline: true,
                    minDate: new Date().fp_incr(1), // Tomorrow
                    dateFormat: "Y-m-d",
                    disable: [
                        function(date) {
                            const dateStr = date.toISOString().split('T')[0];
                            return self.availability[dateStr]?.is_full || false;
                        }
                    ],
                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        const dateStr = dayElem.dateObj.toISOString().split('T')[0];
                        if (self.availability[dateStr]?.is_full) {
                            dayElem.classList.add("is-full");
                            dayElem.title = "Slots Full";
                        }
                    },
                    onChange: function(selectedDates, dateStr) {
                        self.selectedDate = dateStr;
                    }
                });
            },

            isSelected(id) {
                return this.selectedItems.some(item => item.id === id);
            },

            getQty(id) {
                const item = this.selectedItems.find(item => item.id === id);
                return item ? item.quantity : 0;
            },

            togglePackage(pkg) {
                const index = this.selectedItems.findIndex(item => item.id === pkg.id);
                if (index > -1) {
                    this.selectedItems.splice(index, 1);
                } else {
                    this.selectedItems.push({
                        id: pkg.id,
                        name: pkg.name,
                        price: parseFloat(pkg.price),
                        quantity: 1
                    });
                }
                this.calculateTotal();
            },

            updateQty(id, delta) {
                const item = this.selectedItems.find(item => item.id === id);
                if (item) {
                    item.quantity = Math.max(1, item.quantity + delta);
                }
                this.calculateTotal();
            },

            calculateTotal() {
                this.totalPrice = this.selectedItems.reduce((sum, item) => {
                    return sum + (item.price * item.quantity);
                }, 0);
            }
        }
    }
</script>
@endsection
