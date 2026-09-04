@extends('frontend.layouts.app')

@section('title', 'Installation Package Pricing & Book - AMTECH EV Specialist')

@section('meta_description', 'Gunakan Pricing AMTECH EV untuk menghitung biaya instalasi charger mobil listrik Anda secara instan. Pilih paket dan jadwal instalasi dengan mudah.')
@section('meta_keywords', 'Pricing EV Charger, Biaya Instalasi EV Charger, Booking Instalasi EV, AMTECH EV Malaysia')

@push('styles')
<style>
    /* ── Page Shell ──────────────────────────────────────────── */
    .booking-page {
        padding-top: 7rem;
        padding-bottom: 5rem;
        min-height: 100vh;
        background: var(--bg-color);
        transition: background 0.3s ease;
    }

    /* ── Section Cards ───────────────────────────────────────── */
    .book-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: 1.5rem;
        padding: 1.75rem;
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    /* ── Package Item ────────────────────────────────────────── */
    .pkg-item {
        border: 2px solid var(--glass-border);
        border-radius: 1rem;
        padding: 1.25rem;
        cursor: pointer;
        transition: all 0.25s ease;
        background: var(--bg-card);
        position: relative;
        overflow: hidden;
    }
    .pkg-item::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,166,81,0.06), transparent);
        opacity: 0;
        transition: opacity 0.25s ease;
    }
    .pkg-item:hover { border-color: rgba(0,166,81,0.4); }
    .pkg-item:hover::before { opacity: 1; }
    .pkg-item--selected {
        border-color: var(--accent) !important;
        background: rgba(0,166,81,0.05) !important;
    }
    .pkg-item--selected::before { opacity: 1 !important; }

    /* ── Checkbox Circle ─────────────────────────────────────── */
    .check-circle {
        width: 1.35rem;
        height: 1.35rem;
        border-radius: 50%;
        border: 2px solid var(--glass-border);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s ease;
        background: transparent;
    }
    .check-circle--checked {
        background: var(--accent);
        border-color: var(--accent);
    }

    /* ── Add-on Checkbox ─────────────────────────────────────── */
    .addon-check {
        width: 1rem;
        height: 1rem;
        border-radius: 0.25rem;
        border: 2px solid var(--glass-border);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }
    .addon-check--checked {
        background: var(--accent);
        border-color: var(--accent);
    }

    /* ── Calendar Card ───────────────────────────────────────── */
    .cal-mini {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: 1.5rem;
        padding: 1.5rem;
    }

    .cal-mini-nav {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--glass-border);
        background: var(--glass);
        color: var(--text-main);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .cal-mini-nav:hover:not(:disabled) {
        background: var(--accent);
        color: #000;
        border-color: var(--accent);
    }
    .cal-mini-nav:disabled { opacity: 0.3; cursor: not-allowed; }

    /* ── Calendar Day Cell ───────────────────────────────────── */
    .cal-mini-day {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 50%;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        color: var(--text-main);
    }
    .cal-mini-day:hover:not(.disabled):not(.full) {
        background: rgba(0,166,81,0.12);
    }
    .cal-mini-day.today {
        background: rgba(0,166,81,0.1);
        color: var(--accent);
        font-weight: 800;
    }
    .cal-mini-day.selected {
        background: var(--accent) !important;
        color: #000 !important;
        font-weight: 900;
        box-shadow: 0 4px 12px rgba(0,166,81,0.4);
    }
    .cal-mini-day.disabled,
    .cal-mini-day.other-month { opacity: 0.25; cursor: not-allowed; }
    .cal-mini-day.full { opacity: 0.35; cursor: not-allowed; }
    .cal-mini-day.has-dot::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #ef4444;
    }

    /* ── Form Inputs ─────────────────────────────────────────── */
    .book-input {
        width: 100%;
        background: var(--glass);
        border: 1px solid var(--glass-border);
        border-radius: 0.75rem;
        color: var(--text-main);
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.25s ease;
        outline: none;
    }
    .book-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(0,166,81,0.15);
    }
    .book-input::placeholder { color: var(--text-muted); opacity: 0.65; }

    /* ── Submit Button ───────────────────────────────────────── */
    .book-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 1rem;
        background: var(--accent);
        color: #000;
        font-weight: 900;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0,166,81,0.3);
    }
    .book-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0,166,81,0.42);
        filter: brightness(1.08);
    }
    .book-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
        box-shadow: none;
    }

    /* ── Qty Buttons ─────────────────────────────────────────── */
    .qty-btn {
        width: 1.6rem;
        height: 1.6rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    .qty-btn-minus {
        background: var(--glass);
        color: var(--text-muted);
    }
    .qty-btn-minus:hover { background: var(--glass-border); }
    .qty-btn-plus {
        background: rgba(0,166,81,0.15);
        color: var(--accent);
    }
    .qty-btn-plus:hover { background: rgba(0,166,81,0.25); }

    /* ── Custom Scrollbar ────────────────────────────────────── */
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: var(--glass-border); border-radius: 10px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: var(--accent); }

    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 768px) {
        .cal-mini-day { width: 2rem; height: 2rem; font-size: 0.72rem; }
    }
</style>
@endpush

@section('content')
<script>
    window.packagesData = @json($packages->keyBy('id'));

    function createBookingForm() {
        return {
            packages: window.packagesData || {},
            selectedItems: [],
            totalPrice: 0,
            selectedDate: '',
            availability: {},
            calendarDays: [],
            todayStr: '',
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            monthNames: ["January","February","March","April","May","June","July","August","September","October","November","December"],
            packagePhases: {},
            packageAddons: {},

            init() {
                this.todayStr = this.formatYMD(new Date());

                // Pre-fill date from URL query param
                const params = new URLSearchParams(window.location.search);
                const urlDate = params.get('date');
                if (urlDate) {
                    const d = new Date(urlDate + 'T00:00:00');
                    this.currentMonth = d.getMonth();
                    this.currentYear  = d.getFullYear();
                    this.selectedDate  = urlDate;
                }

                this.buildCalendar();
                this.fetchAvailability();
            },

            getPackage(id) {
                return this.packages[id] || null;
            },

            formatYMD(date) {
                const y = date.getFullYear();
                const m = String(date.getMonth() + 1).padStart(2, '0');
                const d = String(date.getDate()).padStart(2, '0');
                return `${y}-${m}-${d}`;
            },

            async fetchAvailability() {
                try {
                    const res = await fetch('{{ route("api.booking-availability") }}');
                    const data = await res.json();
                    this.availability = data.data || {};
                } catch(e) {
                    console.error('Failed to fetch availability', e);
                }
            },

            buildCalendar() {
                const days = [];
                const firstDay = new Date(this.currentYear, this.currentMonth, 1);
                const lastDay  = new Date(this.currentYear, this.currentMonth + 1, 0);
                const today    = new Date(); today.setHours(0,0,0,0);

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
                        disabled: d <= today 
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
                if (this.availability[day.dateStr]?.is_full) return;
                this.selectedDate = day.dateStr;
            },

            isToday(d) { return d === this.todayStr; },
            isFull(d)  { return !!this.availability[d]?.is_full; },

            isSelected(id) {
                return (this.selectedItems || []).some(i => String(i.id) === String(id));
            },

            getQty(id) {
                const item = (this.selectedItems || []).find(i => String(i.id) === String(id));
                return item ? item.quantity : 0;
            },

            getPhase(id) { return this.packagePhases[id] || '1phase'; },
            getAddons(id) { return this.packageAddons[id] || []; },

            getDisplayFeatures(pkgId) {
                const pkg = this.getPackage(pkgId);
                if (!pkg || !Array.isArray(pkg.features)) return [];
                
                const phase = this.getPhase(pkgId);
                const addons = this.getAddons(pkgId);
                const addonNames = addons.map(a => (a && a.name) ? String(a.name) : '');

                return pkg.features.filter(feat => feat !== null && feat !== undefined).map(feat => {
                    let text = String(feat || '');
                    if (!text) return '';

                    const lower = text.toLowerCase();

                    if (lower.includes('cable') && !lower.includes('installation')) {
                        if (addonNames.some(n => n.includes('10mm Mega Cable'))) {
                            return '10mm Heavy-Duty Mega Cable (SIRIM & JKR Approved)';
                        } else if (addonNames.some(n => n.includes('6mm Mega Cable'))) {
                            return '6mm Heavy-Duty Mega Cable (SIRIM & JKR Approved)';
                        } else if (addonNames.some(n => n.includes('10mm SIRIM Cable'))) {
                            return '10mm SIRIM Approved Cable (Upgraded)';
                        }
                    }

                    if (phase === '3phase') {
                        if (text.includes('MCB') && !text.includes('4-Pole')) {
                            text = text.replace('MCB', '4-Pole MCB (3 Phase)');
                        } else if (text.includes('RCCB') && !text.includes('4-Pole')) {
                            text = text.replace('RCCB', '4-Pole RCCB (3 Phase)');
                        } else if (text.includes('Isolator') && !text.includes('4-Pole')) {
                            text = text.replace('Isolator', '63A 4-Pole Isolator (3 Phase)');
                        }
                    }

                    return text;
                });
            },

            isAddonSelected(pkgId, addonIndex) {
                const pkg = this.getPackage(pkgId);
                if (!pkg || !pkg.addons || !pkg.addons[addonIndex]) return false;
                const addon = pkg.addons[addonIndex];
                const addons = this.getAddons(pkgId);
                return addons.some(a => a.name === addon.name);
            },

            ensurePackageSelected(pkgId) {
                const pkg = this.getPackage(pkgId);
                if (!pkg) return;
                const addons = this.getAddons(pkg.id);
                const phase = this.getPhase(pkg.id);
                const price = this.getPackageTotalPrice(pkg.id);
                const addonNamesStr = addons.map(a => a.name).join(', ');
                let name = pkg.name;
                if (pkg.price_3phase) {
                    name += (phase === '3phase' ? ' (3 Phase 22kW)' : ' (Single Phase)');
                }
                if (addons.length > 0) {
                    name += ' + ' + addonNamesStr;
                }

                if (!this.isSelected(pkg.id)) {
                    this.selectedItems.push({
                        id: pkg.id,
                        name: name,
                        price: price,
                        selected_phase: phase,
                        selected_addon: addonNamesStr,
                        quantity: 1
                    });
                    this.selectedItems = [...this.selectedItems];
                    this.calculateTotal();
                } else {
                    this.updateSelectedPackageState(pkg.id);
                }
            },

            setPhase(pkgId, phase) {
                this.packagePhases = { ...this.packagePhases, [pkgId]: phase };
                this.ensurePackageSelected(pkgId);
            },

            togglePackageAddon(pkgId, addonIndex) {
                const pkg = this.getPackage(pkgId);
                if (!pkg || !pkg.addons || !pkg.addons[addonIndex]) return;
                const addon = pkg.addons[addonIndex];

                let currentAddons = [...this.getAddons(pkgId)];
                const idx = currentAddons.findIndex(a => a.name === addon.name);
                if (idx > -1) {
                    currentAddons.splice(idx, 1);
                } else {
                    currentAddons.push(addon);
                }
                this.packageAddons = { ...this.packageAddons, [pkgId]: currentAddons };
                this.ensurePackageSelected(pkgId);
            },

            getPackageTotalPrice(pkgId) {
                const pkg = this.getPackage(pkgId);
                if (!pkg) return 0;
                const phase = this.getPhase(pkg.id);
                let price = (phase === '3phase' && pkg.price_3phase) ? parseFloat(pkg.price_3phase) : parseFloat(pkg.price);
                const addons = this.getAddons(pkg.id);
                addons.forEach(addon => {
                    const addonPrice = (phase === '3phase' && addon.price_3phase !== undefined && addon.price_3phase !== null && addon.price_3phase !== '')
                        ? parseFloat(addon.price_3phase)
                        : parseFloat(addon.price || 0);
                    price += addonPrice;
                });
                return price;
            },

            getItemPriceDisplay(pkgId) {
                const p = this.getPackageTotalPrice(pkgId);
                return p.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
            },

            getAddonPriceDisplay(pkgId, addonIndex) {
                const pkg = this.getPackage(pkgId);
                if (!pkg || !pkg.addons || !pkg.addons[addonIndex]) return '0';
                const addon = pkg.addons[addonIndex];
                const phase = this.getPhase(pkgId);
                const addonPrice = (phase === '3phase' && addon.price_3phase !== undefined && addon.price_3phase !== null && addon.price_3phase !== '')
                    ? parseFloat(addon.price_3phase)
                    : parseFloat(addon.price || 0);
                return addonPrice.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
            },

            updateSelectedPackageState(pkgId) {
                const item = this.selectedItems.find(i => String(i.id) === String(pkgId));
                if (!item) return;
                const pkg = this.getPackage(pkgId);
                if (!pkg) return;
                const phase = this.getPhase(pkgId);
                const addons = this.getAddons(pkgId);
                const addonNamesStr = addons.map(a => a.name).join(', ');
                item.selected_phase = phase;
                item.selected_addon = addonNamesStr;
                item.price = this.getPackageTotalPrice(pkgId);
                
                let name = pkg.name;
                if (pkg.price_3phase) {
                    name += (phase === '3phase' ? ' (3 Phase 22kW)' : ' (Single Phase)');
                }
                if (addons.length > 0) {
                    name += ' + ' + addonNamesStr;
                }
                item.name = name;
                this.calculateTotal();
                this.selectedItems = [...this.selectedItems];
            },

            togglePackage(pkgId) {
                const idx = this.selectedItems.findIndex(i => String(i.id) === String(pkgId));
                if (idx > -1) {
                    this.selectedItems.splice(idx, 1);
                } else {
                    const pkg = this.getPackage(pkgId);
                    if (!pkg) return;
                    const phase = this.getPhase(pkg.id);
                    const addons = this.getAddons(pkg.id);
                    const price = this.getPackageTotalPrice(pkg.id);
                    const addonNamesStr = addons.map(a => a.name).join(', ');
                    let name = pkg.name;
                    if (pkg.price_3phase) {
                        name += (phase === '3phase' ? ' (3 Phase 22kW)' : ' (Single Phase)');
                    }
                    if (addons.length > 0) {
                        name += ' + ' + addonNamesStr;
                    }
                    this.selectedItems.push({
                        id: pkg.id,
                        name: name,
                        price: price,
                        selected_phase: phase,
                        selected_addon: addonNamesStr,
                        quantity: 1
                    });
                    this.selectedItems = [...this.selectedItems];
                }
                this.calculateTotal();
            },

            updateQty(id, delta) {
                const item = this.selectedItems.find(i => String(i.id) === String(id));
                if (item) item.quantity = Math.max(1, item.quantity + delta);
                this.calculateTotal();
            },

            calculateTotal() {
                this.totalPrice = (this.selectedItems || []).reduce((s, i) => s + i.price * i.quantity, 0);
            },

            formatDate(d) {
                if (!d) return '';
                const parts = d.split('-');
                const date = new Date(parts[0], parts[1]-1, parts[2]);
                return date.toLocaleDateString('en-MY', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
            },

            get monthLabel() {
                return `${this.monthNames[this.currentMonth]} ${this.currentYear}`;
            }
        };
    }

    window.bookingForm = createBookingForm;
    if (window.Alpine) {
        window.Alpine.data('bookingForm', createBookingForm);
    } else {
        document.addEventListener('alpine:init', () => {
            window.Alpine.data('bookingForm', createBookingForm);
        });
    }
</script>

<div class="booking-page px-4 md:px-6 lg:px-10" x-data="bookingForm()">
    <div class="max-w-7xl mx-auto">

        {{-- ── Page Header ──────────────────────────────────────── --}}
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(0,166,81,0.15);">
                    <svg class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-xs font-black uppercase tracking-[0.3em]" style="color: var(--accent);">Pricing</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black tracking-tighter leading-none mb-3" style="color: var(--text-main);">
                Installation Package
                <span class="font-outline-green">Pricing</span>
            </h1>
            <p class="text-base max-w-xl font-light" style="color: var(--text-muted);">
                Select your package, add-ons, and preferred installation date to get an instant estimate.
            </p>
        </div>

        @if(session('success'))
        <div class="mb-8 p-5 rounded-2xl flex items-center gap-4" style="background: rgba(0,166,81,0.1); border: 1px solid rgba(0,166,81,0.25);">
            <svg class="w-6 h-6 shrink-0" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-bold text-sm" style="color: var(--accent);">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error') || $errors->any())
        <div class="mb-8 p-5 rounded-2xl space-y-2" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25);">
            <div class="flex items-center gap-4">
                <svg class="w-6 h-6 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-bold text-sm text-red-500">{{ session('error') ?: 'There were some issues with your selection.' }}</span>
            </div>
            @if($errors->any())
            <ul class="ml-10 list-disc text-xs font-medium text-red-400/80">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 xl:gap-8">

            {{-- ══ COLUMN 1: Packages & Add-ons ════════════════════ --}}
            <div class="lg:col-span-5 space-y-6">

                {{-- Main Packages --}}
                <div class="book-card">
                    <h2 class="text-base font-black uppercase tracking-widest mb-5 flex items-center gap-2" style="color: var(--text-main);">
                        <svg class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Select Package
                    </h2>

                    <div class="space-y-3">
                        @foreach($packages->where('category', 'Standard Package') as $package)
                        <div class="pkg-item relative select-none"
                            :class="isSelected({{ $package->id }}) ? 'pkg-item--selected' : ''"
                            @click="togglePackage({{ $package->id }})">
                            <div class="flex items-start gap-3">
                                <div class="check-circle mt-0.5"
                                    :class="isSelected({{ $package->id }}) ? 'check-circle--checked' : ''">
                                    <svg x-show="isSelected({{ $package->id }})" xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" fill="#000"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-2">
                                        <h3 class="font-bold text-sm leading-tight" style="color: var(--text-main);">{{ $package->name }}</h3>
                                        <div class="text-base font-black shrink-0" style="color: var(--accent);">
                                            RM<span x-text="getItemPriceDisplay({{ $package->id }})"></span>
                                        </div>
                                    </div>
                                    @if($package->features)
                                    <ul class="mt-2 space-y-1">
                                        <template x-for="(feat, fIdx) in getDisplayFeatures({{ $package->id }})" :key="fIdx">
                                            <li class="flex items-center gap-1.5 text-xs" style="color: var(--text-muted);">
                                                <span class="w-1 h-1 rounded-full shrink-0" style="background: var(--accent);"></span>
                                                <span x-text="feat"></span>
                                            </li>
                                        </template>
                                    </ul>
                                    @endif

                                    @if($package->price_3phase)
                                    <div class="mt-4 pt-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2" style="border-top: 1px solid var(--glass-border);" @click.stop>
                                        <span class="text-[10px] font-bold uppercase tracking-wider shrink-0" style="color: var(--text-muted);">Phase Option:</span>
                                        <div class="inline-flex rounded-xl p-1 gap-1 w-full sm:w-auto" style="background: rgba(0,0,0,0.4); border: 1px solid var(--glass-border);">
                                            <button type="button" 
                                                @click.stop="setPhase({{ $package->id }}, '1phase')"
                                                class="flex-1 px-3 py-1.5 text-[10px] font-bold rounded-lg transition-all duration-200 whitespace-nowrap text-center"
                                                :style="getPhase({{ $package->id }}) === '1phase' ? 'background: var(--accent); color: #000; font-weight: 900;' : 'color: var(--text-muted);'"
                                                :class="getPhase({{ $package->id }}) === '1phase' ? 'shadow-md' : 'hover:text-white'">
                                                Single Phase (7kW)
                                            </button>
                                            <button type="button" 
                                                @click.stop="setPhase({{ $package->id }}, '3phase')"
                                                class="flex-1 px-3 py-1.5 text-[10px] font-bold rounded-lg transition-all duration-200 whitespace-nowrap text-center"
                                                :style="getPhase({{ $package->id }}) === '3phase' ? 'background: var(--accent); color: #000; font-weight: 900;' : 'color: var(--text-muted);'"
                                                :class="getPhase({{ $package->id }}) === '3phase' ? 'shadow-md' : 'hover:text-white'">
                                                3 Phase (22kW)
                                            </button>
                                        </div>
                                    </div>
                                    @endif

                                    @if($package->addons && count($package->addons) > 0)
                                    <div class="mt-4 pt-3 space-y-2" style="border-top: 1px solid var(--glass-border);" @click.stop>
                                        <span class="block text-[10px] font-bold uppercase tracking-wider" style="color: var(--text-muted);">Package Add-ons & Cable Upgrades:</span>
                                        <div class="space-y-2">
                                            @foreach($package->addons as $addonIndex => $addon)
                                            <div class="flex items-center justify-between p-2.5 rounded-xl cursor-pointer transition-all duration-200 text-xs select-none"
                                                :style="isAddonSelected({{ $package->id }}, {{ $addonIndex }}) ? 'background: rgba(0,166,81,0.12); border: 1.5px solid var(--accent);' : 'background: rgba(0,0,0,0.3); border: 1px solid var(--glass-border);'"
                                                @click.stop="togglePackageAddon({{ $package->id }}, {{ $addonIndex }})">
                                                <div class="flex items-center gap-2.5 min-w-0 pr-2">
                                                    <div class="w-4 h-4 rounded flex items-center justify-center border transition-all shrink-0"
                                                        :style="isAddonSelected({{ $package->id }}, {{ $addonIndex }}) ? 'background: var(--accent); border-color: var(--accent);' : 'background: rgba(0,0,0,0.4); border-color: var(--glass-border);'">
                                                        <svg x-show="isAddonSelected({{ $package->id }}, {{ $addonIndex }})" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-black" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                    <span class="font-medium text-[11px] leading-tight" style="color: var(--text-main);">{{ $addon['name'] }}</span>
                                                </div>
                                                <span class="font-black text-[11px] shrink-0" style="color: var(--accent);">
                                                    +RM<span x-text="getAddonPriceDisplay({{ $package->id }}, {{ $addonIndex }})"></span>
                                                </span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Additional Works --}}
                <div class="book-card">
                    <h2 class="text-base font-black uppercase tracking-widest mb-5 flex items-center gap-2" style="color: var(--text-main);">
                        <svg class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                        Add-ons & Works
                    </h2>

                    <div class="space-y-6 max-h-[520px] overflow-y-auto custom-scroll pr-1">
                        @foreach($packages->where('category', '!=', 'Standard Package')->groupBy('category') as $category => $items)
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-3" style="color: var(--accent);">{{ $category }}</p>
                            <div class="space-y-2">
                                @foreach($items as $item)
                                <div class="flex items-center gap-3 p-3 rounded-xl border transition-all duration-200"
                                    :class="isSelected({{ $item->id }}) ? 'border-accent/50' : 'border-transparent hover:border-accent/20'"
                                    style="background: var(--glass);">

                                    <div class="addon-check"
                                        :class="isSelected({{ $item->id }}) ? 'addon-check--checked' : ''"
                                        @click="togglePackage({{ $item->id }})"
                                        style="cursor:pointer;">
                                        <svg x-show="isSelected({{ $item->id }})" class="w-2.5 h-2.5" viewBox="0 0 20 20" fill="#000">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>

                                    <div class="flex-1 min-w-0 cursor-pointer" @click="togglePackage({{ $item->id }})">
                                        <p class="font-semibold text-xs leading-tight" style="color: var(--text-main);">{{ $item->name }}</p>
                                        <p class="text-[10px] font-black mt-0.5" style="color: var(--accent);">
                                            RM{{ number_format($item->price, 0) }} {{ $item->price_unit ? '/ '.$item->price_unit : '' }}
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-1.5 shrink-0" x-show="isSelected({{ $item->id }})">
                                        <button class="qty-btn qty-btn-minus" @click.stop="updateQty({{ $item->id }}, -1)">−</button>
                                        <span class="text-xs font-black w-4 text-center" x-text="getQty({{ $item->id }})" style="color: var(--text-main);"></span>
                                        <button class="qty-btn qty-btn-plus" @click.stop="updateQty({{ $item->id }}, 1)">+</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ══ COLUMN 2: Calendar ═══════════════════════════════ --}}
            <div class="lg:col-span-4">
                <div class="sticky top-32">
                    <div class="cal-mini">
                        {{-- Calendar Header --}}
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="font-black text-sm" style="color: var(--text-main);" x-text="monthLabel"></h3>
                                <p class="text-xs mt-0.5" style="color: var(--text-muted);">Select installation date</p>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <button class="cal-mini-nav" @click="prevMonth()" :disabled="!canGoPrev()">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button class="cal-mini-nav" @click="nextMonth()">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Selected date display --}}
                        <div class="mb-4 px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-300"
                            :class="selectedDate ? 'opacity-100' : 'opacity-0'"
                            style="background: rgba(0,166,81,0.1); color: var(--accent); min-height: 2rem;">
                            <span x-show="selectedDate">
                                ✓ <span x-text="formatDate(selectedDate)"></span>
                            </span>
                        </div>

                        {{-- Day Labels --}}
                        <div class="grid grid-cols-7 gap-0.5 mb-2">
                            <template x-for="d in ['M','T','W','T','F','S','S']">
                                <div class="text-center text-[10px] font-black uppercase py-1" style="color: var(--text-muted);" x-text="d"></div>
                            </template>
                        </div>

                        {{-- Calendar Grid --}}
                        <div class="grid grid-cols-7 gap-0.5">
                            <template x-for="day in calendarDays" :key="day.dateStr">
                                <div class="flex items-center justify-center">
                                    <div
                                        class="cal-mini-day"
                                        :class="{
                                            'today':        isToday(day.dateStr) && !day.isOtherMonth,
                                            'selected':     selectedDate === day.dateStr,
                                            'disabled':     day.disabled && !day.isOtherMonth,
                                            'other-month':  day.isOtherMonth,
                                            'full has-dot': isFull(day.dateStr) && !day.disabled && !day.isOtherMonth
                                        }"
                                        @click="handleDateClick(day)"
                                        x-text="day.dayNum"
                                    ></div>
                                </div>
                            </template>
                        </div>

                        {{-- Legend --}}
                        <div class="flex items-center gap-4 mt-5 pt-4 flex-wrap" style="border-top: 1px solid var(--glass-border);">
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full" style="background: rgba(239,68,68,0.6);"></div>
                                <span class="text-[9px] font-bold uppercase tracking-wide" style="color: var(--text-muted);">Full</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full" style="background: var(--accent); opacity: 0.7;"></div>
                                <span class="text-[9px] font-bold uppercase tracking-wide" style="color: var(--text-muted);">Today</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full" style="background: var(--accent);"></div>
                                <span class="text-[9px] font-bold uppercase tracking-wide" style="color: var(--text-muted);">Selected</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ COLUMN 3: Summary & CTA ════════════════════════ --}}
            <div class="lg:col-span-3">
                <div class="sticky top-32 space-y-5">

                    {{-- Price Summary --}}
                    <div class="book-card" style="border-top: 3px solid var(--accent);">
                        <h3 class="font-black text-sm uppercase tracking-widest mb-4" style="color: var(--text-main);">Estimate Summary</h3>

                        <div class="space-y-2 mb-4 min-h-[4rem]">
                            <template x-for="item in selectedItems" :key="item.id">
                                <div class="flex justify-between items-start gap-2 text-xs">
                                    <div style="color: var(--text-muted);">
                                        <span x-text="item.name"></span>
                                        <span x-show="item.quantity > 1" class="ml-1 font-black" style="color: var(--accent);" x-text="'×' + item.quantity"></span>
                                    </div>
                                    <div class="font-bold shrink-0" style="color: var(--text-main);" x-text="'RM' + (item.price * item.quantity).toLocaleString()"></div>
                                </div>
                            </template>
                            <div x-show="selectedItems.length === 0" class="text-xs italic" style="color: var(--text-muted);">No items selected yet.</div>
                        </div>

                        <div class="pt-3 mb-4" style="border-top: 1px solid var(--glass-border);">
                            <p class="text-[9px] font-black uppercase tracking-widest mb-1" style="color: var(--text-muted);">Estimated Total</p>
                            <p class="text-3xl font-black leading-none" style="color: var(--accent);">RM<span x-text="totalPrice.toLocaleString()"></span></p>
                            <p class="text-[9px] mt-1 italic font-bold" style="color: var(--text-muted);">Inc. SST</p>
                        </div>

                        <div x-show="selectedDate" class="pt-3" style="border-top: 1px solid var(--glass-border);">
                            <p class="text-[9px] font-black uppercase tracking-widest mb-1" style="color: var(--text-muted);">Installation Date</p>
                            <p class="text-xs font-bold" style="color: var(--text-main);" x-text="formatDate(selectedDate)"></p>
                        </div>
                    </div>

                    {{-- Step indicator --}}
                    <div style="display:flex;align-items:center;gap:0.5rem;padding:0 0.25rem;">
                        <div style="width:1.5rem;height:1.5rem;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:900;color:#000;flex-shrink:0;">1</div>
                        <div style="flex:1;height:2px;background:var(--glass-border);border-radius:99px;">
                            <div style="height:100%;background:var(--accent);border-radius:99px;transition:width 0.4s ease;"
                                :style="'width:' + (selectedItems.length > 0 && selectedDate ? '100' : selectedItems.length > 0 ? '50' : '0') + '%'"></div>
                        </div>
                        <div style="width:1.5rem;height:1.5rem;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:900;flex-shrink:0;transition:all 0.3s;"
                            :style="selectedItems.length > 0 && selectedDate ? 'background:var(--accent);color:#000;' : 'background:var(--glass-border);color:var(--text-muted);'">2</div>
                    </div>

                    {{-- CTA Card --}}
                    <div class="book-card">
                        <form action="{{ route('booking.checkout') }}" method="POST" id="proceed-form">
                            @csrf
                            <input type="hidden" name="preferred_date" :value="selectedDate">
                            <template x-for="(item, index) in selectedItems" :key="item.id">
                                <div>
                                    <input type="hidden" :name="'items['+index+'][id]'" :value="item.id">
                                    <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.quantity">
                                    <input type="hidden" :name="'items['+index+'][selected_phase]'" :value="item.selected_phase || '1phase'">
                                    <input type="hidden" :name="'items['+index+'][selected_addon]'" :value="item.selected_addon || ''">
                                </div>
                            </template>

                            {{-- Status hints --}}
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-xs"
                                    :style="selectedItems.length > 0 ? 'color:var(--accent);' : 'color:var(--text-muted);'">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            :d="selectedItems.length > 0 ? 'M5 13l4 4L19 7' : 'M12 5v14M5 12h14'"/>
                                    </svg>
                                    <span x-text="selectedItems.length > 0 ? selectedItems.length + ' item(s) selected' : 'Select at least 1 package'"></span>
                                </div>
                                <div class="flex items-center gap-2 text-xs"
                                    :style="selectedDate ? 'color:var(--accent);' : 'color:var(--text-muted);'">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            :d="selectedDate ? 'M5 13l4 4L19 7' : 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'"/>
                                    </svg>
                                    <span x-text="selectedDate ? formatDate(selectedDate) : 'Choose an installation date'"></span>
                                </div>
                            </div>

                            <button type="submit"
                                class="book-btn"
                                :disabled="selectedItems.length === 0 || !selectedDate"
                                @click.prevent="selectedItems.length > 0 && selectedDate && $el.closest('form').submit()">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                                <span x-text="selectedItems.length === 0 ? 'Pick a Package First' : !selectedDate ? 'Choose a Date First' : 'Add Installation to Cart →'"></span>
                            </button>

                            <p class="text-[9px] text-center font-medium mt-3" style="color: var(--text-muted);">
                                Next: Enter your details & choose payment method
                            </p>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .font-outline-green {
        -webkit-text-stroke: 1.5px var(--accent);
        color: transparent;
    }
    /* Fix: border-accent custom prop inside x-bind doesn't work in Tailwind — use inline style for dynamic borders */
    [class*="border-accent"] { border-color: var(--accent) !important; }
</style>
@endsection
