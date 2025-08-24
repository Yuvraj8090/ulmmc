<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.navbar-items.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create Navbar Item
            </h2>
        </div>
    </x-slot>

    <div class="py-6 container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600">
                <h3 class="text-lg font-medium text-white flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> New Navigation Item
                </h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.navbar-items.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title Field -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span class="text-indigo-600 dark:text-indigo-400">*</span> Title
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150"
                                placeholder="Home">
                        </div>

                        <!-- Slug Field -->
                        <div class="space-y-2">
                            <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span class="text-indigo-600 dark:text-indigo-400">*</span> Slug
                            </label>
                            <div class="relative">
                                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                                    class="block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150"
                                    placeholder="home">
                                <button type="button" onclick="generateSlug()"
                                    class="absolute right-2 top-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Parent Item -->
                        <div class="space-y-2">
                            <label for="parent_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Parent Item
                            </label>
                            <select name="parent_id" id="parent_id"
                                class="block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150">
                                <option value="">None (Top Level)</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Is Dropdown -->
                        <div class="space-y-2 flex items-center">
                            <input type="hidden" name="is_dropdown" value="0">
                            <input type="checkbox" name="is_dropdown" id="is_dropdown" value="1" {{ old('is_dropdown') ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded transition duration-150">
                            <label for="is_dropdown" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Is Dropdown</label>
                        </div>

                        <!-- Is Footer -->
                        <div class="space-y-2 flex items-center">
                            <input type="hidden" name="is_footer" value="0">
                            <input type="checkbox" name="is_footer" id="is_footer" value="1" {{ old('is_footer') ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded transition duration-150">
                            <label for="is_footer" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Show in Footer</label>
                        </div>

                        <!-- Order -->
                        <div class="space-y-2">
                            <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order</label>
                            <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                                class="block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150">
                        </div>

                        <!-- Is Active -->
                        <div class="space-y-2 flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded transition duration-150">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Is Active</label>
                        </div>

                        <!-- Route Name -->
                        <div class="space-y-2">
                            <label for="route" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Route Name</label>
                            <input type="text" name="route" id="route" value="{{ old('route') }}"
                                class="block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150"
                                placeholder="home.index">
                        </div>

                        <!-- Custom URL -->
                        <div class="space-y-2">
                            <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Custom URL</label>
                            <input type="text" name="url" id="url" value="{{ old('url') }}"
                                class="block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150"
                                placeholder="/home">
                        </div>

                        <!-- Icon Class -->
                        <div class="space-y-2">
                            <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Icon Class</label>
                            <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                                class="block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150"
                                placeholder="fas fa-home">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fas fa-save mr-2"></i> Create Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function generateSlug() {
            const title = document.getElementById('title').value;
            if (title) {
                const slug = title.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                document.getElementById('slug').value = slug;
            }
        }

        document.getElementById('title').addEventListener('input', function() {
            if (!document.getElementById('slug').value) {
                generateSlug();
            }
        });
    </script>
</x-app-layout>
