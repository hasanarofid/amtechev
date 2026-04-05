<x-app-layout>
    <x-slot:title>Inquiry Details</x-slot:title>
    <x-slot name="header">
        Inquiry Details
    </x-slot>

    <div class="mb-8">
        <a href="{{ route('admin.contact-inquiries.index') }}" class="text-ev-green font-bold text-sm hover:underline flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Inquiries
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl">
        <div class="glass-card overflow-hidden">
            <div class="p-8 border-b border-glass-border bg-white/5 flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-black uppercase tracking-tight text-main">{{ $contact_inquiry->name }}</h2>
                    <p class="text-text-muted mt-1 uppercase tracking-widest text-[10px]">{{ $contact_inquiry->created_at->format('F d, Y @ H:i') }}</p>
                </div>
                <div>
                    @if($contact_inquiry->replied_at)
                        <span class="px-3 py-1 bg-blue-500/10 text-blue-500 text-[10px] font-black uppercase tracking-widest rounded border border-blue-500/20">Replied</span>
                    @elseif($contact_inquiry->status === 'pending')
                        <span class="px-3 py-1 bg-amber-500/10 text-amber-500 text-[10px] font-black uppercase tracking-widest rounded border border-amber-500/20">New Inquiry</span>
                    @else
                        <span class="px-3 py-1 bg-ev-green/10 text-ev-green text-[10px] font-black uppercase tracking-widest rounded border border-ev-green/20">Read</span>
                    @endif
                </div>
            </div>

            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Email Address</label>
                        <p class="text-main font-bold">{{ $contact_inquiry->email }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Phone Number</label>
                        <p class="text-main font-bold">{{ $contact_inquiry->phone_number ?? 'Not provided' }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-text-muted mb-2">Message Content</label>
                    <div class="p-6 bg-white/5 rounded-2xl border border-glass-border text-text-muted leading-relaxed italic">
                        "{{ $contact_inquiry->comment }}"
                    </div>
                </div>

                @if($contact_inquiry->reply_content)
                <div class="pt-8 border-t border-glass-border">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-blue-500 mb-2">Your Response (Sent on {{ $contact_inquiry->replied_at->format('M d, Y H:i') }})</label>
                    <div class="p-6 bg-blue-500/5 rounded-2xl border border-blue-500/20 text-main leading-relaxed">
                        {{ $contact_inquiry->reply_content }}
                    </div>
                </div>
                @endif
            </div>

            @if(!$contact_inquiry->reply_content)
            <div class="p-8 bg-white/5 border-t border-glass-border">
                <h3 class="text-sm font-black uppercase tracking-widest text-main mb-6">Reply to Message</h3>
                <form action="{{ route('admin.contact-inquiries.reply', $contact_inquiry) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <textarea name="reply_message" rows="5" class="w-full bg-white/5 border border-glass-border rounded-2xl p-4 text-main placeholder-text-muted focus:border-ev-green outline-none transition-colors" placeholder="Type your response here..." required></textarea>
                    </div>
                    <div class="flex justify-end gap-4">
                        <button type="submit" class="btn-premium flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            Send Response
                        </button>
                    </div>
                </form>
            </div>
            @endif

            <div class="p-6 bg-white/5 border-t border-glass-border flex justify-end gap-4">
                <form action="{{ route('admin.contact-inquiries.destroy', $contact_inquiry) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-500/10 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-full border border-red-500/20 hover:bg-red-500 hover:text-white transition-all" onclick="return confirm('Delete this inquiry?')">Delete Record</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
