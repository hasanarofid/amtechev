<x-app-layout>
    <x-slot:title>Edit Testimonial</x-slot:title>
    <x-slot name="header">
        Edit Testimonial
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Customer Name</label>
                    <input type="text" name="author_name" value="{{ old('author_name', $testimonial->author_name) }}" required class="premium-input">
                    @error('author_name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Role / Designation</label>
                    <input type="text" name="author_role" value="{{ old('author_role', $testimonial->author_role) }}" class="premium-input">
                    @error('author_role') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Testimonial Content</label>
                    <div id="quill-editor" class="bg-glass text-main min-h-[150px] rounded-b-xl border border-glass-border"></div>
                    <input type="hidden" name="content" id="quill-hidden-input" value="{{ old('content', $testimonial->content) }}">
                    @error('content') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Rating (1-5)</label>
                    <select name="rating" class="premium-input">
                        @for($i=5; $i>=1; $i--)
                            <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                        @endfor
                    </select>
                    @error('rating') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Upload Author Image (Leave blank to keep current)</label>
                    <input type="file" name="image_file" accept="image/*" class="premium-input px-4 py-3">
                    @if($testimonial->author_image)
                        <div class="mt-4 p-2 bg-glass border border-glass-border rounded-xl inline-block">
                            <img src="{{ str_starts_with($testimonial->author_image, 'http') || str_starts_with($testimonial->author_image, '/') ? $testimonial->author_image : asset('storage/' . $testimonial->author_image) }}" class="h-20 w-auto rounded-full object-cover">
                        </div>
                    @endif
                    @error('image_file') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    UPDATE TESTIMONIAL
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
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
                var html = quill.root.innerHTML;
                if(html === '<p><br></p>') html = '';
                document.getElementById('quill-hidden-input').value = html;
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
