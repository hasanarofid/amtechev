<x-app-layout>
    <x-slot:title>Add Video Feedback</x-slot:title>
    <x-slot name="header">
        Create Video Testimonial
    </x-slot>

    <div class="max-w-4xl">
        <!-- Technical Tip Alert -->
        <div class="mb-10 p-6 glass-card border-ev-green/20 bg-ev-green/5 flex gap-6 items-start animate-reveal">
            <div class="w-10 h-10 bg-ev-green/20 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-ev-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h4 class="text-[10px] font-bold uppercase tracking-widest text-ev-green mb-2">Technical Guide for Successful Upload</h4>
                <p class="text-text-muted text-[10px] leading-relaxed uppercase font-medium">To ensure a smooth upload on your server, please keep videos under <strong class="text-white">2MB</strong>. We recommend <strong class="text-white">720p resolution</strong> and using a tool like <a href="https://handbrake.fr/" target="_blank" class="text-ev-green hover:underline">Handbrake</a> to compress your file before uploading.</p>
            </div>
        </div>

        <form action="{{ route('admin.video-testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="videoForm">
            @csrf

            <div class="glass-card p-10 space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Video Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="premium-input text-sm" placeholder="e.g. My Experience with Amtech EV">
                        @error('title') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Customer Name</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required class="premium-input text-sm" placeholder="e.g. Ahmad Kamal">
                        @error('customer_name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Video File (MP4, Max 2MB)</label>
                        <div class="premium-input flex flex-col items-center justify-center py-10 border-dashed border-2 hover:border-ev-green/50 transition-colors group cursor-pointer relative" id="dropZone" onclick="document.getElementById('videoInput').click()">
                            <input type="file" name="video" id="videoInput" required class="absolute inset-0 opacity-0 cursor-pointer" accept="video/*" onchange="validateVideo(this)">
                            <svg class="w-10 h-10 text-white/20 group-hover:text-ev-green/50 transition-colors mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-text-muted" id="videoFileName">Click to select video</span>
                        </div>
                        <p id="sizeLimitError" class="hidden mt-4 text-[10px] text-red-500 font-bold uppercase text-center bg-red-500/10 p-3 rounded-lg border border-red-500/20">This video is too large for the current server limit (Max 2MB).</p>
                        @error('video') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Thumbnail Image (Optional)</label>
                        <div class="premium-input flex flex-col items-center justify-center py-10 border-dashed border-2 hover:border-ev-green/50 transition-colors group cursor-pointer relative" onclick="document.getElementById('thumbInput').click()">
                            <input type="file" name="thumbnail" id="thumbInput" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" onchange="updateFileName(this, 'thumbFileName')">
                            <svg class="w-10 h-10 text-white/20 group-hover:text-ev-green/50 transition-colors mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-text-muted" id="thumbFileName">Click to select thumbnail</span>
                        </div>
                        @error('thumbnail') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-10">
                    <div class="flex-1">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="premium-input text-sm">
                    </div>
                    
                    <label class="flex items-center gap-4 cursor-pointer pt-6">
                        <div class="relative">
                            <input type="checkbox" name="is_published" value="1" checked class="sr-only peer">
                            <div class="w-12 h-6 bg-white/10 rounded-full peer-checked:bg-ev-green/50 transition-colors border border-white/10"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white/40 rounded-full transition-transform peer-checked:translateX-6 peer-checked:bg-ev-green"></div>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-text-muted">Published</span>
                    </label>
                </div>
            </div>

            <div id="progressContainer" class="hidden glass-card p-6 border-ev-green/30">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-ev-green">Processing Video...</span>
                    <span id="progressText" class="text-[10px] font-bold text-main">0%</span>
                </div>
                <div class="w-full h-1 bg-white/10 rounded-full overflow-hidden">
                    <div id="progressBar" class="w-0 h-full bg-ev-green transition-all duration-300"></div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" id="submitBtn" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]" onclick="showProgress()">
                    CREATE VIDEO TESTIMONIAL
                </button>
                <a href="{{ route('admin.video-testimonials.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none uppercase">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        function validateVideo(input) {
            const errorElement = document.getElementById('sizeLimitError');
            const fileNameElement = document.getElementById('videoFileName');
            const submitBtn = document.getElementById('submitBtn');
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (input.files && input.files[0]) {
                fileNameElement.textContent = input.files[0].name;
                fileNameElement.classList.remove('text-text-muted');
                fileNameElement.classList.add('text-ev-green');

                if (input.files[0].size > maxSize) {
                    errorElement.classList.remove('hidden');
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.5';
                    submitBtn.style.cursor = 'not-allowed';
                } else {
                    errorElement.classList.add('hidden');
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor = 'pointer';
                }
            }
        }

        function updateFileName(input, targetId) {
            if (input.files && input.files[0]) {
                document.getElementById(targetId).textContent = input.files[0].name;
                document.getElementById(targetId).classList.remove('text-text-muted');
                document.getElementById(targetId).classList.add('text-ev-green');
            }
        }

        function showProgress() {
            const videoInput = document.getElementById('videoInput');
            if (videoInput.files.length > 0 && !document.getElementById('submitBtn').disabled) {
                document.getElementById('progressContainer').classList.remove('hidden');
                let progress = 0;
                const interval = setInterval(() => {
                    progress += 2;
                    if (progress > 98) clearInterval(interval);
                    document.getElementById('progressBar').style.width = progress + '%';
                    document.getElementById('progressText').textContent = progress + '%';
                }, 400);
            }
        }
    </script>
</x-app-layout>
