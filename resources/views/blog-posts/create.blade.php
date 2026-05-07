<x-app-layout>
    <x-slot:title>Write New Post</x-slot:title>
    <x-slot name="header">
        Create Post
    </x-slot>

    <div class="w-full" x-data="{ activeTab: 'en' }">
        <div class="flex gap-4 mb-8">
            <button @click="activeTab = 'en'" :class="activeTab === 'en' ? 'bg-ev-green text-black' : 'bg-glass border border-glass-border text-text-muted'" class="px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg">
                English Version
            </button>
            <button @click="activeTab = 'ms'" :class="activeTab === 'ms' ? 'bg-ev-green text-black' : 'bg-glass border border-glass-border text-text-muted'" class="px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg">
                Malaysia Version
            </button>
        </div>

        <form action="{{ route('admin.blog-posts.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf

            <div class="glass-card p-8 space-y-6">
                <!-- English Tab Content -->
                <div x-show="activeTab === 'en'" class="space-y-6 animate-fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Post Title (English)</label>
                            <input type="text" name="title" value="{{ old('title') }}" required class="premium-input" placeholder="e.g. Best Home EV Charger Malaysia 2026">
                            @error('title') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Category</label>
                            <input type="text" name="category" value="{{ old('category') }}" class="premium-input" placeholder="e.g. Guides, News">
                            @error('category') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Excerpt (English - Short Summary)</label>
                        <textarea name="excerpt" class="premium-input min-h-[80px]" placeholder="Brief summary of the post in English...">{{ old('excerpt') }}</textarea>
                        @error('excerpt') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Main Content (English)</label>
                        <div id="quill-editor-en" class="bg-glass text-main min-h-[300px] rounded-b-xl border border-glass-border"></div>
                        <input type="hidden" name="content" id="quill-hidden-input-en" value="{{ old('content') }}">
                        @error('content') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Malaysia Tab Content -->
                <div x-show="activeTab === 'ms'" x-cloak class="space-y-6 animate-fade-in">
                    <div class="flex justify-end">
                        <button type="button" @click="copyFromEnglish()" class="text-[8px] font-black uppercase tracking-[0.2em] px-4 py-2 bg-ev-green/20 text-ev-green rounded-lg hover:bg-ev-green hover:text-black transition-all">
                            Copy from English
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Post Title (Malaysia)</label>
                            <input type="text" name="title_ms" value="{{ old('title_ms') }}" class="premium-input" placeholder="e.g. Pengecas EV Rumah Terbaik Malaysia 2026">
                            @error('title_ms') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Category (Inherited from English)</label>
                            <input type="text" disabled class="premium-input opacity-50" placeholder="Use Category field in English tab">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Excerpt (Malaysia - Ringkasan Pendek)</label>
                        <textarea name="excerpt_ms" class="premium-input min-h-[80px]" placeholder="Ringkasan pendek dalam Bahasa Melayu...">{{ old('excerpt_ms') }}</textarea>
                        @error('excerpt_ms') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Main Content (Malaysia)</label>
                        <div id="quill-editor-ms" class="bg-glass text-main min-h-[300px] rounded-b-xl border border-glass-border"></div>
                        <input type="hidden" name="content_ms" id="quill-hidden-input-ms" value="{{ old('content_ms') }}">
                        @error('content_ms') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- General Info -->
                <div class="pt-6 border-t border-glass-border space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Author Name</label>
                            <input type="text" name="author_name" value="{{ old('author_name', 'Amtech Admin') }}" required class="premium-input">
                            @error('author_name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Publish Date</label>
                            <input type="datetime-local" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" class="premium-input">
                            @error('published_at') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Upload Featured Image</label>
                        <input type="file" name="image_file" accept="image/*" class="premium-input px-4 py-3">
                        @error('image_file') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    PUBLISH POST
                </button>
                <a href="{{ route('admin.blog-posts.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const configs = {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            };

            // English Editor
            var quillEn = new Quill('#quill-editor-en', configs);
            var oldContentEn = document.getElementById('quill-hidden-input-en').value;
            if(oldContentEn) quillEn.root.innerHTML = oldContentEn;
            quillEn.on('text-change', function() {
                var html = quillEn.root.innerHTML;
                document.getElementById('quill-hidden-input-en').value = (html === '<p><br></p>') ? '' : html;
            });

            // Malaysia Editor
            var quillMs = new Quill('#quill-editor-ms', configs);
            var oldContentMs = document.getElementById('quill-hidden-input-ms').value;
            if(oldContentMs) quillMs.root.innerHTML = oldContentMs;
            quillMs.on('text-change', function() {
                var html = quillMs.root.innerHTML;
                document.getElementById('quill-hidden-input-ms').value = (html === '<p><br></p>') ? '' : html;
            });

            // Copy Function
            window.copyFromEnglish = function() {
                document.querySelector('input[name="title_ms"]').value = document.querySelector('input[name="title"]').value;
                document.querySelector('textarea[name="excerpt_ms"]').value = document.querySelector('textarea[name="excerpt"]').value;
                quillMs.root.innerHTML = quillEn.root.innerHTML;
                document.getElementById('quill-hidden-input-ms').value = quillEn.root.innerHTML;
            };
        });
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .ql-toolbar.ql-snow {
            border-color: var(--glass-border);
            border-radius: 12px 12px 0 0;
            background: var(--glass);
        }
        .ql-container.ql-snow {
            border-color: var(--glass-border);
            border-radius: 0 0 12px 12px;
        }
        .ql-editor { font-family: inherit; }
        .ql-snow .ql-stroke { stroke: var(--text-main); }
        .ql-snow .ql-fill, .ql-snow .ql-stroke.ql-fill { fill: var(--text-main); }
        .ql-snow .ql-picker { color: var(--text-main); }
    </style>
</x-app-layout>
