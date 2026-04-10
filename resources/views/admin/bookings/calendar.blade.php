<x-app-layout>
    <x-slot:title>Booking Calendar</x-slot:title>
    <x-slot name="header">
        Installation Bookings Monitoring
    </x-slot>

    <div class="w-full space-y-6">
        <div class="flex justify-between items-center border-b border-ev-green/20 pb-4">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green">VISUAL MONITORING</h3>
            <div class="flex items-center gap-6 text-[10px] font-black uppercase tracking-widest text-text-muted">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                    Pending
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-ev-green"></span>
                    Confirmed
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                    Completed
                </div>
            </div>
        </div>

        <div class="glass-card p-8">
            <div id="calendar" data-bookings="{{ json_encode($bookings) }}" class="min-h-[700px]"></div>
        </div>
    </div>

    @push('styles')
    <style>
        :root {
            --fc-border-color: rgba(255, 255, 255, 0.1);
            --fc-daygrid-event-dot-width: 8px;
            --fc-page-bg-color: transparent;
            --fc-neutral-bg-color: rgba(255, 255, 255, 0.02);
            --fc-list-event-hover-bg-color: rgba(255, 255, 255, 0.05);
            --fc-today-bg-color: rgba(34, 197, 94, 0.1);
        }

        /* Dark Theme Specifics */
        [data-theme="dark"] {
            --fc-button-text-color: #94a3b8;
            --fc-title-color: #ffffff;
            --fc-header-color: #64748b;
            --fc-day-number-color: #94a3b8;
        }

        /* Light Theme Specifics */
        [data-theme="light"] {
            --fc-border-color: rgba(0, 0, 0, 0.1);
            --fc-button-text-color: #475569;
            --fc-title-color: #0f172a;
            --fc-header-color: #64748b;
            --fc-day-number-color: #475569;
            --fc-neutral-bg-color: rgba(0, 0, 0, 0.02);
        }

        .fc .fc-toolbar-title {
            font-size: 1.25rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--fc-title-color);
        }

        .fc .fc-button-primary {
            background-color: var(--card-bg, rgba(255, 255, 255, 0.05));
            border-color: var(--border-color, rgba(255, 255, 255, 0.1));
            color: var(--fc-button-text-color);
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .fc .fc-button-primary:hover {
            background-color: #22c55e !important;
            border-color: #22c55e !important;
            color: black !important;
        }

        .fc .fc-button-primary:not(:disabled).fc-button-active, 
        .fc .fc-button-primary:not(:disabled):active {
            background-color: #22c55e !important;
            border-color: #22c55e !important;
            color: black !important;
        }

        .fc .fc-col-header-cell-cushion {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--fc-header-color);
            padding: 1.5rem 0;
        }

        .fc .fc-daygrid-day-number {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--fc-day-number-color);
            padding: 1rem;
        }

        .fc .fc-daygrid-event {
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 0.75rem;
            font-weight: 700;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin: 2px 4px;
        }

        .fc .fc-event-title {
            color: black !important;
        }

        .fc .fc-daygrid-day.fc-day-today {
            background-color: var(--fc-today-bg-color);
        }

        .fc-theme-standard td, .fc-theme-standard th {
            border-color: var(--fc-border-color);
        }

        .fc-theme-standard .fc-scrollgrid {
            border-color: var(--fc-border-color);
            border-radius: 20px;
            overflow: hidden;
        }
    </style>
    @endpush

    @push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listMonth'
                },
                events: JSON.parse(calendarEl.dataset.bookings),
                eventClick: function(info) {
                    if (info.event.url) {
                        info.jsEvent.preventDefault();
                        window.location.href = info.event.url;
                    }
                },
                height: 'auto',
                firstDay: 1, // Start week on Monday
            });
            calendar.render();
        });
    </script>
    @endpush
</x-app-layout>
