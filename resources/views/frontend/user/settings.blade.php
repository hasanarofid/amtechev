<x-app-layout>
    <x-slot:title>Account Settings</x-slot:title>

    <div class="p-4 sm:p-8 max-w-7xl mx-auto space-y-10">
        <div class="flex items-center gap-4 border-b border-glass-border pb-6">
            <div class="h-10 w-2 bg-accent rounded-full"></div>
            <div>
                <h1 class="text-4xl font-black tracking-tight text-main uppercase italic">Account Settings</h1>
                <p class="text-[10px] font-black text-text-muted mt-1 uppercase tracking-[0.3em]">Manage your dashboard preferences and security</p>
            </div>
        </div>

        <div class="max-w-4xl space-y-8">
            <div class="glass-card p-8 lg:p-10 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:scale-110 transition-transform duration-700">
                    <svg class="w-24 h-24 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                
                <h3 class="text-xl font-black text-main mb-8 flex items-center gap-3">
                    <span class="h-6 w-1 bg-accent rounded-full"></span>
                    Dashboard Preferences
                </h3>
                
                <div class="space-y-6">
                    <div class="flex items-center justify-between p-6 bg-glass/40 rounded-[24px] border border-glass-border hover:border-accent/30 transition-all duration-300">
                        <div>
                            <h4 class="font-bold text-main tracking-tight">Email Notifications</h4>
                            <p class="text-[10px] uppercase font-bold text-text-muted mt-1 tracking-wider">Installation & order status tracking</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-accent shadow-xl"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-6 bg-glass/40 rounded-[24px] border border-glass-border hover:border-accent/30 transition-all duration-300">
                        <div>
                            <h4 class="font-bold text-main tracking-tight">Marketing Communications</h4>
                            <p class="text-[10px] uppercase font-bold text-text-muted mt-1 tracking-wider">New chargers & exclusive member deals</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-accent shadow-xl"></div>
                        </label>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button class="px-10 py-3.5 bg-accent text-black font-black rounded-xl hover:scale-105 transition-all uppercase tracking-widest text-[10px] shadow-2xl shadow-accent/20">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>

            <div class="glass-card p-8 rounded-[32px] border border-red-500/10 flex items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="h-14 w-14 bg-red-500/5 rounded-2xl flex items-center justify-center text-red-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-main">Advanced Security</h3>
                        <p class="text-xs text-text-muted leading-relaxed">Update password or manage account deletion via your <a href="{{ route('user.profile.edit') }}" class="text-accent font-black hover:underline uppercase tracking-tighter">Profile Page</a></p>
                    </div>
                </div>
                <svg class="w-6 h-6 text-text-muted/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
