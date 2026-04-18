<x-app-layout>
    <x-slot:title>Create New Booking</x-slot:title>
    <x-slot name="header">
        Add Manual Booking
    </x-slot>

    @push('styles')
    <style>
        /* ── Calendar Styles ───────────────────────────────────────── */
        .cal-mini {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--glass-border);
            border-radius: 1.5rem;
            padding: 1.5rem;
        }

        .cal-mini-nav {
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--glass-border);
            background: var(--glass);
            color: var(--text-main);
            transition: all 0.2s ease;
        }
        .cal-mini-nav:hover:not(:disabled) {
            background: var(--ev-green);
            color: #000;
            border-color: var(--ev-green);
        }
        .cal-mini-nav:disabled { opacity: 0.3; cursor: not-allowed; }

        .cal-mini-day {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            color: var(--text-main);
        }
        .cal-mini-day:hover:not(.disabled):not(.full) {
            background: rgba(0, 166, 81, 0.15);
        }
        .cal-mini-day.today {
            background: rgba(0, 166, 81, 0.1);
            color: var(--ev-green);
            font-weight: 800;
            border: 1px solid rgba(0, 166, 81, 0.3);
        }
        .cal-mini-day.selected {
            background: var(--ev-green) !important;
            color: #000 !important;
            font-weight: 900;
            box-shadow: 0 4px 12px rgba(0, 166, 81, 0.4);
        }
        .cal-mini-day.disabled,
        .cal-mini-day.other-month { opacity: 0.2; cursor: not-allowed; }
        .cal-mini-day.full { 
            color: #ef4444; 
            text-decoration: line-through; 
            opacity: 0.5;
            cursor: not-allowed; 
        }
        .cal-mini-day.full::after {
            content: 'FULL';
            position: absolute;
            bottom: -2px;
            font-size: 6px;
            font-weight: 900;
            letter-spacing: 0.05em;
        }

        /* ── Input Styling ────────────────────────────────────────── */
        .premium-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .premium-input:focus {
            box-shadow: 0 0 0 4px rgba(0, 166, 81, 0.1);
        }
    </style>
    @endpush

    <div class="w-full max-w-7xl transition-all duration-500" x-data="adminBookingForm()">
        <form action="{{ route('admin.bookings.store') }}" method="POST" class="space-y-6 lg:space-y-8">
            @csrf

            <input type="hidden" name="preferred_date" :value="selectedDate" required>

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 lg:gap-8 items-start">
                
                {{-- Left Column: Customer Details (4/12) --}}
                <div class="xl:col-span-4 space-y-6">
                    <div class="glass-card p-6 sm:p-8 space-y-6 backdrop-blur-xl border-ev-green/10">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-ev-green/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-ev-green">Customer Identity</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-2">Full Name</label>
                                <input type="text" name="customer_name" required value="{{ old('customer_name') }}" 
                                    class="premium-input bg-[#0a0a0a]/50" placeholder="John Doe">
                                @error('customer_name') <p class="mt-1 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-2">Email (Client Target)</label>
                                <input type="email" name="email" required value="{{ old('email') }}" 
                                    class="premium-input bg-[#0a0a0a]/50" placeholder="john@example.com">
                                @error('email') <p class="mt-1 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-2">Phone Number</label>
                                <input type="tel" name="phone_number" required value="{{ old('phone_number') }}" 
                                    class="premium-input bg-[#0a0a0a]/50" placeholder="0123456789">
                                @error('phone_number') <p class="mt-1 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-2">Installation Address</label>
                                <textarea name="address" rows="3" required class="premium-input bg-[#0a0a0a]/50" 
                                    placeholder="Full address...">{{ old('address') }}</textarea>
                                @error('address') <p class="mt-1 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-6 sm:p-8 backdrop-blur-xl border-ev-green/5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-amber-500">Internal Notes</h3>
                        </div>
                        <textarea name="notes" rows="3" class="premium-input bg-[#0a0a0a]/50" 
                            placeholder="Special instructions or requests...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                {{-- Middle Column: Calendar (4/12) --}}
                <div class="xl:col-span-4 space-y-6">
                    <div class="glass-card p-6 sm:p-8 backdrop-blur-xl border-ev-green/10 min-h-[500px]">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-ev-green/20 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-ev-green">Installation Schedule</h3>
                            </div>
                        </div>

                        {{-- Alpine Calendar Port --}}
                        <div class="cal-mini">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h4 class="font-black text-xs uppercase tracking-widest text-main" x-text="monthLabel"></h4>
                                    <p class="text-[9px] font-bold text-text-muted mt-0.5">Select available date</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" class="cal-mini-nav" @click="prevMonth()" :disabled="!canGoPrev()">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                                    </button>
                                    <button type="button" class="cal-mini-nav" @click="nextMonth()">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-7 gap-1 mb-3">
                                <template x-for="d in ['MON','TUE','WED','THU','FRI','SAT','SUN']">
                                    <div class="text-center text-[8px] font-black text-text-muted py-1" x-text="d"></div>
                                </template>
                            </div>

                            <div class="grid grid-cols-7 gap-1">
                                <template x-for="day in calendarDays" :key="day.dateStr">
                                    <div class="flex items-center justify-center">
                                        <div
                                            class="cal-mini-day"
                                            :class="{
                                                'today': isToday(day.dateStr) && !day.isOtherMonth,
                                                'selected': selectedDate === day.dateStr,
                                                'disabled': day.disabled && !day.isOtherMonth,
                                                'other-month': day.isOtherMonth,
                                                'full': isFull(day.dateStr) && !day.disabled && !day.isOtherMonth
                                            }"
                                            @click="handleDateClick(day)"
                                            x-text="day.dayNum"
                                        ></div>
                                    </div>
                                </template>
                            </div>

                            <div class="mt-8 pt-6 border-t border-glass-border space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-[9px] font-black uppercase tracking-widest text-text-muted">Selected Date:</span>
                                    <span class="text-[10px] font-black text-ev-green" x-text="selectedDate ? formatDate(selectedDate) : 'PLEASE PICK A DATE'"></span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                        <span class="text-[8px] font-bold text-text-muted uppercase tracking-tighter">Full Capacity</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-2 h-2 rounded-full border border-ev-green/50 bg-ev-green/10"></div>
                                        <span class="text-[8px] font-bold text-text-muted uppercase tracking-tighter">Current Day</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Items (4/12) --}}
                <div class="xl:col-span-4 space-y-6">
                    <div class="glass-card p-6 sm:p-8 backdrop-blur-xl border-ev-green/10 min-h-[500px] flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-ev-green/20 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-ev-green">Installation Items</h3>
                            </div>
                            <button type="button" @click="addItem()" class="text-[9px] font-black uppercase tracking-widest bg-ev-green text-[#000] px-3 py-1.5 rounded-lg hover:scale-105 transition-all">
                                + ADD ITEM
                            </button>
                        </div>

                        <div class="space-y-4 flex-1 overflow-y-auto pr-1 custom-scroll max-h-[400px]">
                            <template x-for="(item, index) in selectedItems" :key="index">
                                <div class="p-4 bg-white/5 border border-glass-border rounded-2xl relative group animate-fade-in">
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-[8px] font-bold uppercase tracking-widest text-text-muted mb-1.5">Package</label>
                                            <select :name="'items['+index+'][id]'" x-model="item.id" @change="updatePrice(index)" required class="premium-input bg-[#111] text-xs">
                                                <option value="">-- Select Package --</option>
                                                @foreach($packages as $package)
                                                    <option value="{{ $package->id }}" data-price="{{ $package->price }}">{{ $package->name }} (RM{{ number_format($package->price, 0) }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div class="flex-1">
                                                <label class="block text-[8px] font-bold uppercase tracking-widest text-text-muted mb-1.5">Quantity</label>
                                                <input type="number" :name="'items['+index+'][quantity]'" x-model="item.quantity" @input="updatePrice(index)" min="1" required 
                                                    class="premium-input bg-[#111] text-center text-xs">
                                            </div>
                                            <button type="button" @click="removeItem(index)" x-show="selectedItems.length > 1" class="mt-4 p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-all" title="Remove">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="mt-6 pt-6 border-t border-glass-border">
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-[10px] font-black uppercase tracking-widest text-text-muted">Grand Total</span>
                                <div class="text-right">
                                    <span class="text-2xl font-black text-ev-green leading-none">RM<span x-text="totalPrice.toLocaleString()"></span></span>
                                    <p class="text-[8px] font-bold text-text-muted uppercase">Inc. SST & Manual CC</p>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3">
                                <button type="submit" 
                                    class="w-full bg-ev-green text-[#000] font-black text-[10px] tracking-[0.2em] py-4 rounded-xl hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-lg shadow-ev-green/20"
                                    :disabled="!selectedDate || selectedItems.some(i => !i.id)">
                                    CREATE BOOKING & SEND EMAIL
                                </button>
                                <a href="{{ route('admin.bookings.index') }}" class="w-full bg-white/5 border border-glass-border text-center font-black text-[10px] tracking-[0.2em] py-4 rounded-xl hover:bg-white/10 transition-all">
                                    CANCEL & BACK
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function adminBookingForm() {
            return {
                selectedItems: [{ id: '', quantity: 1, price: 0 }],
                totalPrice: 0,
                selectedDate: '',
                fullDates: {{ Js::from($fullDates->pluck('preferred_date')) }},
                monthNames: ["January","February","March","April","May","June","July","August","September","October","November","December"],
                currentMonth: new Date().getMonth(),
                currentYear: new Date().getFullYear(),
                calendarDays: [],
                todayStr: '',

                init() {
                    const now = new Date();
                    this.todayStr = this.formatYMD(now);
                    this.buildCalendar();
                },

                formatYMD(date) {
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');
                    return `${y}-${m}-${d}`;
                },

                buildCalendar() {
                    const days = [];
                    const firstDay = new Date(this.currentYear, this.currentMonth, 1);
                    const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
                    const today = new Date(); today.setHours(0,0,0,0);

                    // padding for Monday start
                    let startPad = firstDay.getDay() - 1;
                    if (startPad < 0) startPad = 6;

                    for (let i = startPad - 1; i >= 0; i--) {
                        const d = new Date(firstDay);
                        d.setDate(firstDay.getDate() - i - 1);
                        days.push({ dateStr: this.formatYMD(d), dayNum: d.getDate(), isOtherMonth: true, disabled: true });
                    }

                    for (let i = 1; i <= lastDay.getDate(); i++) {
                        const d = new Date(this.currentYear, this.currentMonth, i);
                        days.push({ 
                            dateStr: this.formatYMD(d), 
                            dayNum: i, 
                            isOtherMonth: false, 
                            disabled: d < today 
                        });
                    }

                    const remaining = 42 - days.length;
                    for (let i = 1; i <= remaining; i++) {
                        const d = new Date(lastDay);
                        d.setDate(lastDay.getDate() + i);
                        days.push({ dateStr: this.formatYMD(d), dayNum: d.getDate(), isOtherMonth: true, disabled: true });
                    }

                    this.calendarDays = days;
                },

                prevMonth() {
                    if (!this.canGoPrev()) return;
                    if (this.currentMonth === 0) { this.currentMonth = 11; this.currentYear--; }
                    else { this.currentMonth--; }
                    this.buildCalendar();
                },

                nextMonth() {
                    if (this.currentMonth === 11) { this.currentMonth = 0; this.currentYear++; }
                    else { this.currentMonth++; }
                    this.buildCalendar();
                },

                canGoPrev() {
                    const now = new Date();
                    return !(this.currentYear === now.getFullYear() && this.currentMonth === now.getMonth());
                },

                handleDateClick(day) {
                    if (day.disabled || day.isOtherMonth) return;
                    if (this.isFull(day.dateStr)) return;
                    this.selectedDate = day.dateStr;
                },

                isToday(d) { return d === this.todayStr; },
                isFull(d) { return this.fullDates.includes(d); },

                addItem() {
                    this.selectedItems.push({ id: '', quantity: 1, price: 0 });
                },
                removeItem(index) {
                    this.selectedItems.splice(index, 1);
                    this.calculateTotal();
                },
                updatePrice(index) {
                    const select = document.querySelectorAll('select')[index];
                    const selectedOption = select.options[select.selectedIndex];
                    const price = selectedOption ? parseFloat(selectedOption.getAttribute('data-price') || 0) : 0;
                    this.selectedItems[index].price = price;
                    this.calculateTotal();
                },
                calculateTotal() {
                    this.totalPrice = this.selectedItems.reduce((acc, item) => acc + (item.price * item.quantity), 0);
                },
                formatDate(d) {
                    if (!d) return '';
                    const date = new Date(d);
                    return date.toLocaleDateString('en-MY', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
                },
                get monthLabel() {
                    return `${this.monthNames[this.currentMonth]} ${this.currentYear}`;
                }
            }
        }
    </script>
    @endpush
</x-app-layout>
