@extends('frontend.layouts.app')

@section('title', 'Check & Book Slot - AMTECH EV Specialist')

@push('styles')
<style>
    /* ── Page Layout ─────────────────────────────────────────── */
    .slot-page {
        padding-top: 7rem;
        padding-bottom: 5rem;
        min-height: 100vh;
        background: var(--bg-color);
        transition: background 0.3s ease;
    }

    /* ── Calendar Card ───────────────────────────────────────── */
    .cal-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: 1.5rem;
        padding: 2rem;
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    /* ── Calendar Header Navigation ──────────────────────────── */
    .cal-nav-btn {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid var(--glass-border);
        background: var(--glass);
        color: var(--text-main);
    }
    .cal-nav-btn:hover {
        background: var(--accent);
        color: #000;
        border-color: var(--accent);
    }

    /* ── Day-of-week Headers ─────────────────────────────────── */
    .cal-dow {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-muted);
        text-align: center;
        padding: 0.5rem 0;
    }

    /* ── Individual Day Cell ─────────────────────────────────── */
    .cal-day {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 0.5rem 0.25rem;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
        min-height: 4.5rem;
        gap: 0.25rem;
        border: 1px solid transparent;
    }
    .cal-day:hover:not(.cal-day--disabled):not(.cal-day--full) {
        background: rgba(0, 166, 81, 0.08);
        border-color: rgba(0, 166, 81, 0.3);
    }
    .cal-day--today {
        background: rgba(0, 166, 81, 0.06);
        border-color: rgba(0, 166, 81, 0.25);
    }
    .cal-day--selected {
        background: var(--accent) !important;
        border-color: var(--accent) !important;
    }
    .cal-day--selected .cal-day__num {
        color: #000 !important;
        font-weight: 900;
    }
    .cal-day--disabled {
        opacity: 0.35;
        cursor: not-allowed;
    }
    .cal-day--full {
        cursor: default;
    }
    .cal-day--other-month {
        opacity: 0.3;
    }

    /* ── Day Number ──────────────────────────────────────────── */
    .cal-day__num {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1;
    }
    .cal-day--today .cal-day__num {
        color: var(--accent);
    }

    /* ── Status Pill ─────────────────────────────────────────── */
    .cal-day__badge {
        font-size: 0.55rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.15rem 0.4rem;
        border-radius: 999px;
        white-space: nowrap;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .cal-day__badge--available {
        background: rgba(0, 166, 81, 0.15);
        color: var(--accent);
    }
    .cal-day__badge--full {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
    }
    .cal-day__badge--book {
        background: rgba(0, 166, 81, 0.1);
        color: var(--accent);
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .cal-day:hover .cal-day__badge--book {
        opacity: 1;
    }

    /* ── "Today" tag ─────────────────────────────────────────── */
    .today-tag {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        font-size: 0.5rem;
        font-weight: 900;
        text-transform: uppercase;
        background: var(--accent);
        color: #000;
        padding: 0.1rem 0.3rem;
        border-radius: 999px;
        letter-spacing: 0.05em;
    }

    /* ── Month Separator ─────────────────────────────────────── */
    .cal-month-sep {
        display: grid;
        grid-column: 1 / -1;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0 0.5rem;
    }
    .cal-month-sep__line {
        height: 1px;
        background: var(--glass-border);
    }
    .cal-month-sep__text {
        font-size: 0.7rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--text-muted);
    }

    /* ── Info Sidebar ────────────────────────────────────────── */
    .info-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: 1.5rem;
        padding: 1.75rem;
        transition: background 0.3s ease;
    }
    .info-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.75rem;
        background: rgba(0, 166, 81, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--accent);
    }

    /* ── Legend Items ────────────────────────────────────────── */
    .legend-dot {
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 0.25rem;
        flex-shrink: 0;
    }

    /* ── CTA Button ──────────────────────────────────────────── */
    .cta-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 1rem 1.5rem;
        background: var(--accent);
        color: #000;
        font-weight: 900;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        border-radius: 999px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(0, 166, 81, 0.3);
        text-decoration: none;
    }
    .cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(0, 166, 81, 0.45);
        filter: brightness(1.08);
    }

    /* ── Loading Skeleton ────────────────────────────────────── */
    .skeleton {
        background: linear-gradient(90deg, var(--glass) 25%, var(--glass-border) 50%, var(--glass) 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 0.5rem;
    }
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 768px) {
        .cal-card { padding: 1rem; }
        .cal-day { min-height: 3.5rem; padding: 0.35rem 0.1rem; }
        .cal-day__num { font-size: 0.75rem; }
        .cal-day__badge { display: none; }
        .today-tag { display: none; }
    }
</style>
@endpush

@section('content')
<script>
    function slotChecker() {
        return {
            availability: {},
            calendarDays: [],
            todayStr: '',
            isLoading: true,
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            monthNames: ["January","February","March","April","May","June","July","August","September","October","November","December"],
            dayNames: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],

            init() {
                this.todayStr = this.formatYMD(new Date());
                this.buildCalendar();
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
                    const res = await fetch('{{ route("api.booking-availability") }}');
                    const data = await res.json();
                    this.availability = data.data || {};
                } catch(e) {
                    console.error('Failed to fetch availability', e);
                } finally {
                    this.isLoading = false;
                }
            },

            buildCalendar() {
                const days = [];
                const firstDay = new Date(this.currentYear, this.currentMonth, 1);
                const lastDay  = new Date(this.currentYear, this.currentMonth + 1, 0);
                const today    = new Date(); today.setHours(0,0,0,0);

                // Pad start (Mon=0 ... Sun=6)
                let startPad = firstDay.getDay() - 1;
                if (startPad < 0) startPad = 6;

                for (let i = startPad - 1; i >= 0; i--) {
                    const d = new Date(firstDay);
                    d.setDate(firstDay.getDate() - i - 1);
                    days.push({ dateStr: this.formatYMD(d), dayNum: d.getDate(), isOtherMonth: true, disabled: d < today });
                }

                for (let i = 1; i <= lastDay.getDate(); i++) {
                    const d = new Date(this.currentYear, this.currentMonth, i);
                    days.push({ dateStr: this.formatYMD(d), dayNum: i, isOtherMonth: false, disabled: d < today });
                }

                // Pad end to fill 6 rows
                const remaining = 42 - days.length;
                for (let i = 1; i <= remaining; i++) {
                    const d = new Date(lastDay);
                    d.setDate(lastDay.getDate() + i);
                    days.push({ dateStr: this.formatYMD(d), dayNum: d.getDate(), isOtherMonth: true, disabled: true });
                }

                this.calendarDays = days;
            },

            prevMonth() {
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
                if (this.availability[day.dateStr]?.is_full) return;
                window.location.href = `{{ route('booking.index') }}?date=${day.dateStr}`;
            },

            isToday(dateStr) { return dateStr === this.todayStr; },

            isFull(dateStr) { return !!this.availability[dateStr]?.is_full; },

            hasBooking(dateStr) {
                return !this.isFull(dateStr) && (this.availability[dateStr]?.bookings?.length > 0);
            },

            get monthLabel() {
                return `${this.monthNames[this.currentMonth]} ${this.currentYear}`;
            }
        }
    }
</script>

<div class="slot-page px-4 md:px-6 lg:px-14" x-data="slotChecker()">
    <div class="max-w-7xl mx-auto">

        {{-- ── Page Header ──────────────────────────────────────── --}}
        <div class="mb-10 animate-reveal">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(0,166,81,0.15);">
                    <svg class="w-5 h-5" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-xs font-black uppercase tracking-[0.3em]" style="color: var(--accent);">Schedule &amp; Availability</span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black tracking-tighter leading-none mb-4" style="color: var(--text-main);">
                Installation
                <span class="font-outline-green">Schedule</span>
            </h1>
            <p class="text-base md:text-lg max-w-xl font-light" style="color: var(--text-muted);">
                Browse available dates below and click any open slot to book your EV charger installation.
            </p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            {{-- ── Calendar Panel ───────────────────────────────── --}}
            <div class="xl:col-span-2">
                <div class="cal-card">

                    {{-- Calendar Nav Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-black" style="color: var(--text-main);" x-text="monthLabel"></h2>
                            <p class="text-xs font-medium mt-0.5" style="color: var(--text-muted);">Click an available date to book</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="cal-nav-btn" @click="prevMonth()" :class="{'opacity-30 cursor-not-allowed': !canGoPrev()}" :disabled="!canGoPrev()">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button class="cal-nav-btn" @click="nextMonth()">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Day-of-week labels --}}
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        <template x-for="d in dayNames" :key="d">
                            <div class="cal-dow" x-text="d"></div>
                        </template>
                    </div>

                    {{-- Calendar Grid --}}
                    <div class="grid grid-cols-7 gap-1" x-show="!isLoading">
                        <template x-for="(day, idx) in calendarDays" :key="day.dateStr">
                            <div
                                class="cal-day"
                                :class="{
                                    'cal-day--today':        isToday(day.dateStr) && !day.isOtherMonth,
                                    'cal-day--disabled':     day.disabled && !day.isOtherMonth,
                                    'cal-day--full':         isFull(day.dateStr),
                                    'cal-day--other-month':  day.isOtherMonth
                                }"
                                @click="handleDateClick(day)"
                            >
                                {{-- Today tag --}}
                                <template x-if="isToday(day.dateStr) && !day.isOtherMonth">
                                    <span class="today-tag">Today</span>
                                </template>

                                <span class="cal-day__num" x-text="day.dayNum"></span>

                                {{-- Full badge --}}
                                <template x-if="isFull(day.dateStr) && !day.disabled && !day.isOtherMonth">
                                    <span class="cal-day__badge cal-day__badge--full">Full</span>
                                </template>

                                {{-- Booking badge (has bookings but not full) --}}
                                <template x-if="hasBooking(day.dateStr) && !isFull(day.dateStr) && !day.disabled && !day.isOtherMonth">
                                    <span class="cal-day__badge cal-day__badge--available" x-text="availability[day.dateStr].bookings.length + ' booked'"></span>
                                </template>

                                {{-- Available / hover hint --}}
                                <template x-if="!isFull(day.dateStr) && !day.disabled && !day.isOtherMonth && !hasBooking(day.dateStr)">
                                    <span class="cal-day__badge cal-day__badge--book">Book</span>
                                </template>
                            </div>
                        </template>
                    </div>

                    {{-- Loading skeleton --}}
                    <div class="grid grid-cols-7 gap-1" x-show="isLoading">
                        <template x-for="i in 35" :key="i">
                            <div class="skeleton" style="height: 4.5rem; border-radius: 0.75rem;"></div>
                        </template>
                    </div>

                    {{-- Legend --}}
                    <div class="flex flex-wrap items-center gap-4 mt-6 pt-5" style="border-top: 1px solid var(--glass-border);">
                        <div class="flex items-center gap-2">
                            <div class="legend-dot" style="background: rgba(0,166,81,0.15); border: 1px solid rgba(0,166,81,0.4);"></div>
                            <span class="text-xs font-semibold" style="color: var(--text-muted);">Available</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="legend-dot" style="background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.4);"></div>
                            <span class="text-xs font-semibold" style="color: var(--text-muted);">Fully Booked</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="legend-dot" style="background: rgba(0,166,81,0.08); border: 1px solid rgba(0,166,81,0.3);"></div>
                            <span class="text-xs font-semibold" style="color: var(--text-muted);">Today</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="legend-dot" style="background: var(--glass); border: 1px solid var(--glass-border); opacity: 0.4;"></div>
                            <span class="text-xs font-semibold" style="color: var(--text-muted);">Unavailable</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Sidebar ───────────────────────────────────────── --}}
            <div class="space-y-6 xl:sticky xl:top-32">

                {{-- Info Card --}}
                <div class="info-card" style="border-top: 3px solid var(--accent);">
                    <h3 class="text-lg font-black mb-5" style="color: var(--text-main);">Booking Info</h3>

                    <div class="space-y-5">
                        <div class="flex items-start gap-3">
                            <div class="info-icon">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm mb-1" style="color: var(--text-main);">Fast Service</h4>
                                <p class="text-xs leading-relaxed" style="color: var(--text-muted);">Typical installation takes 2–4 hours depending on complexity.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="info-icon">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm mb-1" style="color: var(--text-main);">Certified Installers</h4>
                                <p class="text-xs leading-relaxed" style="color: var(--text-muted);">All works performed by Suruhanjaya Tenaga certified wiremen.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="info-icon">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm mb-1" style="color: var(--text-main);">Nationwide Coverage</h4>
                                <p class="text-xs leading-relaxed" style="color: var(--text-muted);">We serve residential and commercial clients across Malaysia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Tip --}}
                <div class="info-card" style="background: rgba(0,166,81,0.06); border-color: rgba(0,166,81,0.2);">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5">
                            <svg class="w-5 h-5" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs leading-relaxed font-medium" style="color: var(--text-muted);">
                            <strong style="color: var(--accent);">Tip:</strong> Click on any available date to go to the booking page and complete your reservation. Fully booked dates are not clickable.
                        </p>
                    </div>
                </div>

                {{-- CTA --}}
                <a href="{{ route('booking.index') }}" class="cta-btn">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Estimate &amp; Book Now
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .font-outline-green {
        -webkit-text-stroke: 1.5px var(--accent);
        color: transparent;
    }
    @keyframes reveal {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-reveal {
        animation: reveal 0.9s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    }
</style>
@endsection
