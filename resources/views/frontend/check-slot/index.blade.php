@extends('frontend.layouts.app')

@section('title', 'Check & Book Slot - AMTECH EV Specialist')

@section('content')
<script>
    function slotChecker() {
        return {
            selectedDate: '',
            availability: {},
            calendarWeeks: [],
            todayStr: '',
            isLoading: true,

            init() {
                this.todayStr = this.formatYMD(new Date());
                this.generateCalendar();
                this.fetchAvailability();
            },

            formatYMD(date) {
                const y = date.getFullYear();
                const m = String(date.getMonth() + 1).padStart(2, '0');
                const d = String(date.getDate()).padStart(2, '0');
                return `${y}-${m}-${d}`;
            },

            async fetchAvailability() {
                this.isLoading = true;
                try {
                    const response = await fetch('{{ route("api.booking-availability") }}');
                    const result = await response.json();
                    this.availability = result.data || {};
                } catch (error) {
                    console.error('Failed to fetch availability', error);
                } finally {
                    this.isLoading = false;
                }
            },

            generateCalendar() {
                const weeks = [];
                const start = new Date();
                start.setDate(1); // Start from beginning of current month
                start.setHours(0, 0, 0, 0);
                
                let current = new Date(start);
                const dayOfWeek = current.getDay();
                const diff = (dayOfWeek === 0 ? 6 : dayOfWeek - 1);
                current.setDate(current.getDate() - diff);

                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                let lastMonth = -1;

                // Generate 8 weeks from start of current month
                for (let w = 0; w < 12; w++) {
                    const weekDays = [];
                    let monthHeader = null;

                    for (let d = 0; d < 7; d++) {
                        const dateStr = this.formatYMD(current);
                        const month = current.getMonth();
                        
                        if (month !== lastMonth && d === 0) {
                            monthHeader = monthNames[month];
                        }

                        weekDays.push({
                            dateStr: dateStr,
                            dayNum: current.getDate(),
                            disabled: current < new Date().setHours(0,0,0,0),
                            isOtherMonth: current.getMonth() !== new Date().getMonth() && w < 2 // Simplistic month check
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
            },

            handleDateClick(dateStr) {
                const day = this.calendarWeeks.flatMap(w => w.days).find(d => d.dateStr === dateStr);
                if (day && day.disabled) return;
                
                if (!this.availability[dateStr]?.is_full) {
                    window.location.href = `{{ route('booking.index') }}?date=${dateStr}`;
                }
            },

            isToday(dateStr) {
                return dateStr === this.todayStr;
            },

            formatDate(dateStr) {
                if (!dateStr) return '';
                const parts = dateStr.split('-');
                const date = new Date(parts[0], parts[1]-1, parts[2]);
                return date.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' });
            }
        }
    }
</script>

<div class="pt-32 pb-20 px-6 lg:px-14" x-data="slotChecker()">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-16 text-center lg:text-left">
            <h1 class="text-5xl lg:text-7xl font-black tracking-tighter mb-6 leading-none uppercase">
                Installation <span class="text-ev-green font-outline-2">Schedule</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl font-light">
                Check our availability and book your preferred installation slot.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Left: Calendar -->
            <div class="lg:col-span-8">
                <div class="ev-card glassmorphism p-8 border-white/10">
                    <!-- Calendar Header -->
                    <div class="grid grid-cols-7 gap-1 mb-8">
                        <template x-for="day in ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN']">
                            <div class="text-xs font-black text-gray-500 text-center py-2" x-text="day"></div>
                        </template>
                    </div>

                    <!-- Calendar Grid -->
                    <div class="space-y-6">
                        <template x-for="(week, weekIndex) in calendarWeeks" :key="weekIndex">
                            <div>
                                <template x-if="week.monthHeader">
                                    <div class="flex items-center gap-4 py-6">
                                        <div class="h-px bg-white/10 flex-grow"></div>
                                        <span class="text-sm font-black uppercase tracking-[0.3em] text-white" x-text="week.monthHeader"></span>
                                        <div class="h-px bg-white/10 flex-grow"></div>
                                    </div>
                                </template>
                                
                                <div class="grid grid-cols-7 gap-1 min-h-[120px]">
                                    <template x-for="day in week.days" :key="day.dateStr">
                                        <div class="relative flex flex-col p-2 border border-white/5 transition-all duration-300 group min-h-[120px]"
                                            :class="{
                                                'bg-white/[0.02] cursor-pointer hover:bg-white/[0.05]': !day.disabled,
                                                'bg-black/20 opacity-40 grayscale': day.disabled,
                                                'border-ev-green/20': isToday(day.dateStr)
                                            }"
                                            @click="handleDateClick(day.dateStr)"
                                        >
                                            <div class="flex justify-between items-start mb-2">
                                                <span class="text-sm font-bold" 
                                                    :class="isToday(day.dateStr) ? 'text-ev-green' : 'text-gray-400'" 
                                                    x-text="day.dayNum"></span>
                                                <template x-if="isToday(day.dateStr)">
                                                    <span class="text-[8px] font-black uppercase tracking-tighter text-ev-green bg-ev-green/10 px-1.5 py-0.5 rounded">Today</span>
                                                </template>
                                            </div>

                                            <!-- Bookings / Labels -->
                                            <div class="space-y-1 overflow-hidden">
                                                <template x-for="booking in (availability[day.dateStr]?.bookings || [])">
                                                    <div class="text-[9px] leading-tight p-1.5 rounded bg-ev-green/10 text-ev-green font-bold border border-ev-green/20 truncate" 
                                                        x-text="booking.label"></div>
                                                </template>
                                                
                                                <template x-if="availability[day.dateStr]?.is_full">
                                                    <div class="text-[9px] leading-tight p-1.5 rounded bg-red-500/10 text-red-500 font-black border border-red-500/20 text-center uppercase">Full Slot</div>
                                                </template>
                                                
                                                <template x-if="!day.disabled && !availability[day.dateStr]?.is_full">
                                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity text-[9px] text-center text-gray-500 font-bold uppercase py-2">Click to Book</div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Right: Info -->
            <div class="lg:col-span-4">
                <div class="sticky top-32 space-y-8">
                    <div class="ev-card glassmorphism p-8 border-t-4 border-t-ev-green">
                        <h2 class="text-2xl font-black mb-6">Booking Info</h2>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-ev-green/10 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white leading-tight">Fast Service</h3>
                                    <p class="text-sm text-gray-500">Typical installation takes 2-4 hours depending on complexity.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-ev-green/10 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ev-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white leading-tight">Certified Installers</h3>
                                    <p class="text-sm text-gray-500">All works are performed by Suruhanjaya Tenaga certified wiremen.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 pt-8 border-t border-white/10">
                            <h4 class="text-xs font-black uppercase tracking-widest text-gray-500 mb-4">Legend</h4>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded bg-ev-green/20 border border-ev-green/40"></div>
                                    <span class="text-xs font-bold text-gray-400">Scheduled Task</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded bg-red-500/20 border border-red-500/40"></div>
                                    <span class="text-xs font-bold text-gray-400">Fully Booked</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded border border-white/20 bg-white/5"></div>
                                    <span class="text-xs font-bold text-gray-400">Available Date</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('booking.index') }}" 
                        class="w-full group relative inline-flex items-center justify-center px-8 py-5 font-black text-black transition-all duration-300 bg-ev-green rounded-full hover:bg-white hover:scale-[1.02] shadow-xl shadow-ev-green/20">
                        <span class="relative uppercase tracking-widest text-xs">Estimate & Book Now</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .font-outline-2 {
        -webkit-text-stroke: 1px #22c55e;
        color: transparent;
    }
</style>
@endsection
