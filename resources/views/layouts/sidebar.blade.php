<aside 
    class="sidebar"
    :class="{ 'open': sidebarOpen }"
>
    <div class="mb-10 px-4 pt-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="/logo/amtech-removebg.png" alt="Amtech EV Logo" class="h-10 w-auto">
            <h1 class="text-xl font-bold tracking-tight text-main">AMTECH <span class="text-ev-green italic tracking-tighter">EV</span></h1>
        </div>
        <button @click="sidebarOpen = false" class="lg:hidden p-2 text-text-muted hover:text-accent transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>

    <nav class="flex flex-col gap-2 px-2" x-data="{ 
        activeGroup: localStorage.getItem('sidebar_active_group') || 'landing',
        toggleGroup(group) {
            this.activeGroup = this.activeGroup === group ? '' : group;
            localStorage.setItem('sidebar_active_group', this.activeGroup);
        }
    }">
        <a href="{{ auth()->user()->isAdmin() ? route('dashboard') : route('user.dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            Dashboard
        </a>
        
        @if(auth()->user()->isMember())
        <!-- Member Menus -->
        <a href="{{ route('user.orders') }}" class="nav-link {{ request()->routeIs('user.orders') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 11V7a4 4 0 0 0-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            My Orders
        </a>
        <a href="{{ route('affiliate.dashboard') }}" class="nav-link {{ request()->routeIs('affiliate.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            Affiliate Center
        </a>
        <a href="{{ route('user.profile.edit') }}" class="nav-link {{ request()->routeIs('user.profile.edit') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            My Profile
        </a>
        @endif

        @if(auth()->user()->isAdmin())
        
        <!-- Group: Landing Page -->
        <div class="mt-4">
            <button @click="toggleGroup('landing')" class="w-full flex items-center justify-between px-4 py-2 text-[10px] uppercase tracking-widest text-text-muted font-black hover:text-main transition-colors group">
                <span>Landing Page</span>
                <svg class="w-3 h-3 transition-transform duration-300" :class="activeGroup === 'landing' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div x-show="activeGroup === 'landing'" x-collapse class="flex flex-col gap-1 mt-1">
                <a href="{{ route('admin.site-settings.hero') }}" class="nav-link {{ request()->routeIs('admin.site-settings.hero') ? 'active' : '' }} scale-95 origin-left">
                    Manage Hero Section
                </a>
                <a href="{{ route('admin.site-settings.about') }}" class="nav-link {{ request()->routeIs('admin.site-settings.about') ? 'active' : '' }} scale-95 origin-left">
                    About Section Details
                </a>
                <a href="{{ route('admin.site-settings.mission') }}" class="nav-link {{ request()->routeIs('admin.site-settings.mission') ? 'active' : '' }} scale-95 origin-left">
                    Our Mission Page
                </a>
                <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }} scale-95 origin-left">
                    Manage Services
                </a>
                <a href="{{ route('admin.gallery-items.index') }}" class="nav-link {{ request()->routeIs('admin.gallery-items.*') ? 'active' : '' }} scale-95 origin-left">
                    Gallery Workmanship
                </a>
                <a href="{{ route('admin.quality-brands.index') }}" class="nav-link {{ request()->routeIs('admin.quality-brands.*') ? 'active' : '' }} scale-95 origin-left">
                    Quality Brands
                </a>
                <a href="{{ route('admin.chargers.index') }}" class="nav-link {{ request()->routeIs('admin.chargers.*') ? 'active' : '' }} scale-95 origin-left">
                    Manage Chargers
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }} scale-95 origin-left">
                    Testimonials
                </a>
                <a href="{{ route('admin.video-testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.video-testimonials.*') ? 'active' : '' }} scale-95 origin-left">
                    Video Feedback
                </a>
                <a href="{{ route('admin.blog-posts.index') }}" class="nav-link {{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }} scale-95 origin-left">
                    Insights & Blog
                </a>
            </div>
        </div>

        <!-- Group: Booking Management -->
        <div class="mt-2">
            <button @click="toggleGroup('booking')" class="w-full flex items-center justify-between px-4 py-2 text-[10px] uppercase tracking-widest text-text-muted font-black hover:text-main transition-colors group">
                <span>Booking System</span>
                <svg class="w-3 h-3 transition-transform duration-300" :class="activeGroup === 'booking' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div x-show="activeGroup === 'booking'" x-collapse class="flex flex-col gap-1 mt-1">
                <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.index') || request()->routeIs('admin.bookings.show') || request()->routeIs('admin.bookings.edit') ? 'active' : '' }} scale-95 origin-left">
                    View All Bookings
                </a>
                <a href="{{ route('admin.bookings.calendar') }}" class="nav-link {{ request()->routeIs('admin.bookings.calendar') ? 'active' : '' }} scale-95 origin-left">
                    Booking Calendar
                </a>
                <a href="{{ route('admin.installation-packages.index') }}" class="nav-link {{ request()->routeIs('admin.installation-packages.*') ? 'active' : '' }} scale-95 origin-left">
                    Manage Packages
                </a>
                <a href="{{ route('admin.slots.index') }}" class="nav-link {{ request()->routeIs('admin.slots.*') ? 'active' : '' }} scale-95 origin-left">
                    Manage Slots
                </a>
            </div>
        </div>

        <!-- Group: Affiliate Management -->
        <div class="mt-2">
            <button @click="toggleGroup('affiliate')" class="w-full flex items-center justify-between px-4 py-2 text-[10px] uppercase tracking-widest text-text-muted font-black hover:text-main transition-colors group">
                <span>Affiliate System</span>
                <svg class="w-3 h-3 transition-transform duration-300" :class="activeGroup === 'affiliate' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div x-show="activeGroup === 'affiliate'" x-collapse class="flex flex-col gap-1 mt-1">
                <a href="{{ route('admin.affiliates.index') }}" class="nav-link {{ request()->routeIs('admin.affiliates.*') ? 'active' : '' }} scale-95 origin-left">
                    Partner List
                </a>
                <a href="{{ route('admin.affiliates.commissions') }}" class="nav-link {{ request()->routeIs('admin.affiliates.commissions') ? 'active' : '' }} scale-95 origin-left">
                    Commission Log
                </a>
                <a href="{{ route('admin.affiliates.payouts') }}" class="nav-link {{ request()->routeIs('admin.affiliates.payouts') ? 'active' : '' }} scale-95 origin-left">
                    Payout Requests
                </a>
            </div>
        </div>

        <!-- Group: Configuration -->
        <div class="mt-2">
            <button @click="toggleGroup('config')" class="w-full flex items-center justify-between px-4 py-2 text-[10px] uppercase tracking-widest text-text-muted font-black hover:text-main transition-colors group">
                <span>Settings & Config</span>
                <svg class="w-3 h-3 transition-transform duration-300" :class="activeGroup === 'config' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div x-show="activeGroup === 'config'" x-collapse class="flex flex-col gap-1 mt-1">
                <a href="{{ route('admin.contact-inquiries.index') }}" class="nav-link {{ request()->routeIs('admin.contact-inquiries.*') ? 'active' : '' }} scale-95 origin-left">
                    Contact Inquiries
                </a>
                <a href="{{ route('admin.brands.index') }}" class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }} scale-95 origin-left">
                    Supported Brands
                </a>
                <a href="{{ route('admin.site-settings.index') }}" class="nav-link {{ request()->routeIs('admin.site-settings.index') ? 'active' : '' }} scale-95 origin-left">
                    Site Settings
                </a>
            </div>
        </div>
        @endif
    </nav>

    <div class="mt-auto px-4 py-6 border-t border-glass-border">
        <p class="text-[10px] font-black uppercase tracking-widest text-text-muted mb-1 opacity-50">developer by</p>
        <a href="https://hasanarofid.site" target="_blank" class="text-[11px] font-bold text-main hover:text-ev-green transition-colors flex items-center gap-2 group">
            hasanarofid.site
            <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
        </a>
    </div>
</aside>
