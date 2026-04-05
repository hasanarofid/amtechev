<x-app-layout>
    <x-slot:title>Contact Inquiries</x-slot:title>
    <x-slot name="header">
        Contact Inquiries
    </x-slot>

    <div class="flex justify-between items-center mb-8">
        <p class="text-text-muted text-sm font-medium">View and manage messages sent by users from the contact form.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="glass-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-glass-border bg-white/5">
                        <th class="p-4 text-[10px] font-black uppercase tracking-widest text-text-muted">Status</th>
                        <th class="p-4 text-[10px] font-black uppercase tracking-widest text-text-muted">Name</th>
                        <th class="p-4 text-[10px] font-black uppercase tracking-widest text-text-muted">Email</th>
                        <th class="p-4 text-[10px] font-black uppercase tracking-widest text-text-muted">Date</th>
                        <th class="p-4 text-[10px] font-black uppercase tracking-widest text-text-muted text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-glass-border">
                    @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="p-4">
                                @if($inquiry->replied_at)
                                    <span class="px-2 py-1 bg-blue-500/10 text-blue-500 text-[10px] font-black uppercase tracking-widest rounded border border-blue-500/20">Replied</span>
                                @elseif($inquiry->status === 'pending')
                                    <span class="px-2 py-1 bg-amber-500/10 text-amber-500 text-[10px] font-black uppercase tracking-widest rounded border border-amber-500/20">New</span>
                                @else
                                    <span class="px-2 py-1 bg-ev-green/10 text-ev-green text-[10px] font-black uppercase tracking-widest rounded border border-ev-green/20">Read</span>
                                @endif
                            </td>
                            <td class="p-4 font-bold text-main uppercase tracking-tight text-sm">{{ $inquiry->name }}</td>
                            <td class="p-4 text-text-muted text-sm">{{ $inquiry->email }}</td>
                            <td class="p-4 text-text-muted text-[10px] uppercase tracking-widest">{{ $inquiry->created_at->format('M d, Y H:i') }}</td>
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.contact-inquiries.show', $inquiry) }}" class="text-[10px] font-black uppercase tracking-widest text-ev-green hover:underline">View</a>
                                    <form action="{{ route('admin.contact-inquiries.destroy', $inquiry) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-text-muted">
                                <svg class="mx-auto mb-4 opacity-20" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                <p class="text-lg">No inquiries yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
