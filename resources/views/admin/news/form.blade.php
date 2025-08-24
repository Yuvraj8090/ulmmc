@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title (EN)</label>
        <input type="text" name="title" value="{{ old('title', $news->title ?? '') }}" required
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title (HI)</label>
        <input type="text" name="title_hi" value="{{ old('title_hi', $news->title_hi ?? '') }}"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>

    <div>
        <label for="body_eng" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            <i class="fas fa-language text-blue-500 mr-1"></i> Body (EN)
        </label>
        <textarea name="body_eng" id="body_eng" rows="10" required
            class="tinymce-editor w-full px-4 py-2 border rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('body_eng', $news->body_eng ?? '') }}</textarea>
    </div>

    <!-- Body HI -->
    <div>
        <label for="body_hindi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            <i class="fas fa-language text-yellow-500 mr-1"></i> Body (HI)
        </label>
        <textarea name="body_hindi" id="body_hindi" rows="10"
            class="tinymce-editor w-full px-4 py-2 border rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('body_hindi', $news->body_hindi ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $news->meta_title ?? '') }}"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
            <input type="text" name="meta_description"
                value="{{ old('meta_description', $news->meta_description ?? '') }}"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords</label>
            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $news->meta_keywords ?? '') }}"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
    </div>

    @if (isset($news))
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
            <select name="status"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="1" {{ old('status', $news->status ?? 0) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $news->status ?? 0) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '.tinymce-editor',
            promotion: false,
            branding: false,
            menubar: false,
            plugins: 'link lists table code help',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link table | code help',
            skin: 'oxide',
            content_css: 'default',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    });
</script>
