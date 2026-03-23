<x-app-layout>
    <x-slot:title>Add New Charger</x-slot:title>
    <x-slot name="header">
        Add Charger
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.chargers.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Charger Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="premium-input" placeholder="e.g. 11kw Home E1 EV Charger">
                    @error('name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Price Label</label>
                    <input type="text" name="price" value="{{ old('price') }}" class="premium-input" placeholder="e.g. RM 2,499">
                    @error('price') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Description</label>
                    <div id="quill-editor" class="bg-glass text-main min-h-[150px] rounded-b-xl border border-glass-border"></div>
                    <input type="hidden" name="description" id="quill-hidden-input" value="{{ old('description') }}">
                    @error('description') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Upload Image</label>
                    <input type="file" name="image_file" accept="image/*" class="premium-input px-4 py-3">
                    @error('image_file') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-4 py-4 border-t border-glass-border">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-glass border border-glass-border rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ev-green"></div>
                        <span class="ml-3 text-[11px] font-bold uppercase tracking-widest text-main">Featured Product</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    CREATE CHARGER
                </button>
                <a href="{{ route('admin.chargers.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
    
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#quill-editor', {
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
            });
            var oldContent = document.getElementById('quill-hidden-input').value;
            if(oldContent) {
                quill.root.innerHTML = oldContent;
            }
            quill.on('text-change', function() {
                document.getElementById('quill-hidden-input').value = quill.root.innerHTML;
            });
        });
    </script>
    <style>
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
