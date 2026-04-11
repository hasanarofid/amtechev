@extends('frontend.layouts.app')

@section('title', 'Price Estimator - AMTECH EV Specialist')

@section('content')
<script>
    function bookingForm() {
        return {
            selectedItems: [],
            totalPrice: 0,
            selectedDate: '',
            availability: {},
            calendarWeeks: [],
            todayStr: '',

            init() {
                console.log('Booking form initializing...');
                this.todayStr = this.formatYMD(new Date());
                this.generateCalendar();
                this.fetchAvailability();
                console.log('Booking form initialized with today:', this.todayStr);
            },

            formatYMD(date) {
                const y = date.getFullYear();
                const m = String(date.getMonth() + 1).padStart(2, '0');
                const d = String(date.getDate()).padStart(2, '0');
                return `${y}-${m}-${d}`;
            },

            async fetchAvailability() {
                try {
                    const response = await fetch('{{ route("api.booking-availability") }}');
                    const result = await response.json();
                    this.availability = result.data || {};
                    console.log('Availability loaded:', Object.keys(this.availability).length, 'days');
                } catch (error) {
                    console.error('Failed to fetch availability', error);
                }
            },

            generateCalendar() {
                const weeks = [];
                const start = new Date();
                start.setHours(0, 0, 0, 0);
                
                let current = new Date(start);
                const dayOfWeek = current.getDay();
                const diff = (dayOfWeek === 0 ? 6 : dayOfWeek - 1);
                current.setDate(current.getDate() - diff);

                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                let lastMonth = -1;

                for (let w = 0; w < 8; w++) {
                    const weekDays = [];
                    let monthHeader = null;

                    for (let d = 0; d < 7; d++) {
                        const dateStr = this.formatYMD(current);
                        const month = current.getMonth();
                        
                        if (month !== lastMonth && lastMonth !== -1 && d === 0) {
                            monthHeader = monthNames[month];
                        } else if (lastMonth === -1 && d === 0) {
                            monthHeader = monthNames[month];
                        }

                        weekDays.push({
                            dateStr: dateStr,
                            dayNum: current.getDate(),
                            disabled: current < start,
                            isOtherMonth: current.getMonth() !== month
                        });
                        
                        lastMonth = month;
                        current.setDate(current.getDate() + 1);
                    }
                    weeks.push({
                        days: weekDays,
                        monthHeader: monthHeader
                    });
                }
                this.calendarWeeks = weeks;
                console.log('Calendar generated:', this.calendarWeeks.length, 'weeks');
            },

            handleDateClick(dateStr) {
                console.log('CLICK TRIGGERED for:', dateStr);
                const day = this.calendarWeeks.flatMap(w => w.days).find(d => d.dateStr === dateStr);
                
                if (day && (day.disabled || (this.availability[dateStr]?.is_full))) {
                    console.log('Date is disabled or full');
                    return;
                }
                
                this.selectedDate = dateStr;
                console.log('selectedDate updated to:', this.selectedDate);
                // Temporary alert to confirm the click reached JS
                // alert('Date Selected: ' + dateStr);
            },

            isToday(dateStr) {
                return dateStr === this.todayStr;
            },

            formatDate(dateStr) {
                if (!dateStr) return '';
                const parts = dateStr.split('-');
                if (parts.length !== 3) return dateStr;
                const date = new Date(parts[0], parts[1]-1, parts[2]);
                return date.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' });
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

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 xl:gap-14">
            <!-- Left: Packages & Add-ons -->
            <div class="lg:col-span-5 space-y-12">
                <!-- Main Packages -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Select Package
                    </h2>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach($packages->where('category', 'Standard Package') as $package)
                            <div class="ev-card glassmorphism p-6 relative overflow-hidden group cursor-pointer border-2 transition-all duration-300"
                                :class="isSelected({{ $package->id }}) ? 'border-ev-green bg-ev-green/5' : 'border-white/10 hover:border-ev-green/50'"
                                @click="togglePackage({{ json_encode($package) }})">
                                
                                <div class="flex flex-col gap-4">
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
                                            <h3 class="text-lg font-black mb-1 leading-tight">{{ $package->name }}</h3>
                                            <div class="text-xl font-black text-ev-green">RM{{ number_format($package->price, 0) }}</div>
                                        </div>
                                    </div>
                                    @if($package->features)
                                        <ul class="text-[10px] text-gray-400 space-y-1">
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
                        @endforeach
                    </div>
                </div>

                <!-- Additional Works -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Additional Works
                    </h2>

                    <div class="space-y-8">
                        @foreach($packages->where('category', '!=', 'Standard Package')->groupBy('category') as $category => $items)
                            <div class="space-y-4">
                                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-ev-green px-2">{{ $category }}</h3>
                                <div class="grid grid-cols-1 gap-4">
                                    @foreach($items as $item)
                                        <div class="ev-card glassmorphism p-4 border-2 transition-all duration-300 flex flex-col justify-between"
                                            :class="isSelected({{ $item->id }}) ? 'border-ev-green bg-ev-green/5' : 'border-white/5 hover:border-ev-green/30'">
                                            
                                            <div class="flex justify-between items-start gap-4">
                                                <div class="flex items-start gap-3 cursor-pointer" @click="togglePackage({{ json_encode($item) }})">
                                                    <div class="flex-shrink-0 mt-1">
                                                        <div class="w-4 h-4 rounded border-2 flex items-center justify-center transition-colors"
                                                            :class="isSelected({{ $item->id }}) ? 'bg-ev-green border-ev-green' : 'border-gray-600'">
                                                            <svg x-show="isSelected({{ $item->id }})" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-black" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="font-bold text-sm text-gray-200 leading-tight">{{ $item->name }}</p>
                                                        <p class="text-[10px] text-ev-green font-black">RM{{ number_format($item->price, 0) }} {{ $item->price_unit ? '/ '.$item->price_unit : '' }}</p>
                                                    </div>
                                                </div>
                                                <div x-show="isSelected({{ $item->id }})" class="flex items-center gap-2">
                                                    <button @click="updateQty({{ $item->id }}, -1)" class="w-6 h-6 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-white text-xs">-</button>
                                                    <span class="text-xs font-black w-4 text-center" x-text="getQty({{ $item->id }})"></span>
                                                    <button @click="updateQty({{ $item->id }}, 1)" class="w-6 h-6 rounded-full bg-ev-green/20 hover:bg-ev-green/30 flex items-center justify-center text-ev-green text-xs">+</button>
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

            <!-- Middle: Custom Calendar -->
            <div class="lg:col-span-4 space-y-8">
                <div class="sticky top-32">
                    <h2 class="text-2xl font-black mb-8 flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Select Installation Date
                        <template x-if="selectedDate">
                            <span class="text-xs font-normal text-ev-green bg-ev-green/10 px-3 py-1 rounded-full animate-reveal" x-text="'Selected: ' + formatDate(selectedDate)"></span>
                        </template>
                    </h2>
                    
                    <div class="ev-card glassmorphism p-6 border-white/10">
                        <!-- Calendar Header -->
                        <div class="grid grid-cols-7 gap-1 mb-6">
                            <template x-for="day in ['M', 'T', 'W', 'T', 'F', 'S', 'S']">
                                <div class="text-[10px] font-black text-gray-500 text-center py-2" x-text="day"></div>
                            </template>
                        </div>

                        <!-- Calendar Grid -->
                        <div class="space-y-4 max-h-[500px] overflow-y-auto custom-scrollbar pr-2">
                            <template x-for="(week, weekIndex) in calendarWeeks" :key="weekIndex">
                                <div>
                                    <!-- Month Divider -->
                                    <template x-if="week.monthHeader">
                                        <div class="flex items-center gap-4 py-4">
                                            <div class="h-px bg-white/10 flex-grow"></div>
                                            <span class="text-xs font-black uppercase tracking-widest text-white" x-text="week.monthHeader"></span>
                                            <div class="h-px bg-white/10 flex-grow"></div>
                                        </div>
                                    </template>
                                    
                                    <div class="grid grid-cols-7 gap-1">
                                        <template x-for="day in week.days" :key="day.dateStr">
                                            <div class="relative flex flex-col items-center py-2 cursor-pointer group"
                                                @click="handleDateClick(day.dateStr)"
                                            >
                                                <div 
                                                    class="w-10 h-10 flex items-center justify-center text-sm font-bold rounded-full transition-all duration-300 relative"
                                                    :class="{
                                                        'text-white group-hover:bg-white/10': !day.disabled && selectedDate !== day.dateStr && !isToday(day.dateStr),
                                                        'bg-red-500 text-white shadow-lg shadow-red-500/20': isToday(day.dateStr) && selectedDate !== day.dateStr,
                                                        'calendar-day-selected border-2 border-white': selectedDate === day.dateStr,
                                                        'text-white/10': day.disabled || (availability[day.dateStr]?.is_full),
                                                        'opacity-50': day.isOtherMonth
                                                    }"
                                                >
                                                    <span class="pointer-events-none" x-text="day.dayNum"></span>
                                                </div>
                                                
                                                <!-- Full Slot Indicator (Purple Bar) -->
                                                <div x-show="availability[day.dateStr]?.is_full" class="absolute bottom-0 w-6 h-[2px] bg-[#9333ea] rounded-full pointer-events-none"></div>
                                                
                                                <!-- Available Indicator (Blue Bar) -->
                                                <div x-show="!day.disabled && !availability[day.dateStr]?.is_full && selectedDate !== day.dateStr && !isToday(day.dateStr)" 
                                                    class="absolute bottom-0 w-6 h-[1px] bg-ev-green/30 rounded-full pointer-events-none"></div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="mt-8 pt-6 border-t border-white/5 space-y-3">
                            <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-gray-500">
                                <div class="w-3 h-[2px] bg-[#9333ea] rounded-full"></div>
                                Full Slot
                            </div>
                            <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-gray-500">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                Today
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Summary & Form -->
            <div class="lg:col-span-3">
                <div class="sticky top-32 space-y-8">
                    <!-- Price Summary -->
                    <div class="ev-card glassmorphism p-6 border-t-2 border-t-ev-green">
                        <h2 class="text-xl font-black mb-4">Summary</h2>
                        
                        <div class="space-y-3 mb-6">
                            <template x-for="item in selectedItems" :key="item.id">
                                <div class="flex justify-between items-start text-xs">
                                    <div class="text-gray-400">
                                        <span x-text="item.name"></span>
                                        <span x-show="item.quantity > 1" class="text-ev-green ml-1" x-text="'x' + item.quantity"></span>
                                    </div>
                                    <div class="font-bold text-white shrink-0 ml-2" x-text="'RM' + (item.price * item.quantity).toLocaleString()"></div>
                                </div>
                            </template>
                            
                            <div x-show="selectedItems.length === 0" class="text-gray-500 italic text-[10px] py-2">
                                No items selected.
                            </div>
                        </div>

                        <div class="pt-4 border-t border-white/10 group">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1">Estimated Total</p>
                            <p class="text-3xl font-black text-ev-green leading-none mb-1">RM<span x-text="totalPrice.toLocaleString()"></span></p>
                            <p class="text-[8px] text-gray-600 font-bold uppercase italic">Inc. SST</p>
                        </div>

                        <div class="mt-4 pt-4 border-t border-white/10" x-show="selectedDate">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1">Date Selected</p>
                            <p class="text-xs font-bold text-white" x-text="formatDate(selectedDate)"></p>
                        </div>
                    </div>

                    <!-- Client Info Form (Compact) -->
                    <div class="ev-card glassmorphism p-6 border-white/10">
                        <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="preferred_date" :value="selectedDate" required>
                            
                            <!-- Honeypot field for bot protection -->
                            <div style="display: none;">
                                <input type="text" name="_website_url" tabindex="-1" autocomplete="off">
                            </div>
                            
                            <template x-for="(item, index) in selectedItems" :key="item.id">
                                <div>
                                    <input type="hidden" :name="'items['+index+'][id]'" :value="item.id">
                                    <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.quantity">
                                </div>
                            </template>

                            <div class="space-y-4">
                                <div class="group">
                                    <input type="text" name="customer_name" required value="{{ old('customer_name') }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                        placeholder="Full Name">
                                </div>

                                <div class="group">
                                    <input type="tel" name="phone_number" required value="{{ old('phone_number') }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                        placeholder="WhatsApp Number">
                                </div>

                                <div class="group">
                                    <input type="email" name="email" required value="{{ old('email') }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                        placeholder="Email Address">
                                </div>

                                <div class="group">
                                    <textarea name="address" required rows="2"
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-ev-green focus:ring-1 focus:ring-ev-green transition-all"
                                        placeholder="Installation Address...">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <button type="submit" :disabled="selectedItems.length === 0 || !selectedDate"
                                class="w-full group relative inline-flex items-center justify-center px-6 py-4 font-black text-black transition-all duration-300 bg-ev-green rounded-full hover:bg-white hover:scale-[1.02] active:scale-95 shadow-xl shadow-ev-green/20 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span class="relative uppercase tracking-widest text-[10px]" x-text="selectedDate ? 'Book Now' : 'Select Date'"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Scrollbar for Calendar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(34, 197, 94, 0.2);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(34, 197, 94, 0.4);
    }
    
    .font-outline-2 {
        -webkit-text-stroke: 1px #22c55e;
        color: transparent;
    }

    .calendar-day-selected {
        background-color: #22c55e !important;
        color: black !important;
        transform: scale(1.1);
        box-shadow: 0 10px 20px -5px rgba(34, 197, 94, 0.5) !important;
    }
</style>

@endsection
