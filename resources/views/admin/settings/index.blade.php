<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Settings
            </h2>
            <a href="{{ route('admin.settings.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold text-sm rounded-lg shadow hover:from-green-600 hover:to-emerald-600 transition">
                <i class="fas fa-plus-circle mr-2"></i> Add New Setting
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative dark:bg-green-700 dark:text-white dark:border-green-600" role="alert">
                    <strong class="font-bold"><i class="fas fa-check-circle mr-2"></i>Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg border dark:border-gray-700">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-lg font-semibold flex items-center justify-between">
                    <div>
                        <i class="fas fa-cogs mr-2"></i> All Settings
                    </div>
                </div>

                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">Key</th>
                                <th class="px-4 py-2 border">Display Name</th>
                                <th class="px-4 py-2 border">Value</th>
                                <th class="px-4 py-2 border">Type</th>
                                <th class="px-4 py-2 border">Order</th>
                                <th class="px-4 py-2 border">Group</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 dark:text-gray-100">
                            @forelse($settings as $setting)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-2 border">{{ $setting->key }}</td>
                                    <td class="px-4 py-2 border">{{ $setting->display_name }}</td>
                                    <td class="px-4 py-2 border">{{ $setting->value }}</td>
                                    <td class="px-4 py-2 border">{{ $setting->type }}</td>
                                    <td class="px-4 py-2 border">{{ $setting->order }}</td>
                                    <td class="px-4 py-2 border">{{ $setting->group }}</td>
                                    <td class="px-4 py-2 border space-x-2">
                                        <a href="{{ route('admin.settings.edit', $setting->id) }}"
                                           class="inline-flex items-center px-3 py-1 bg-yellow-400 text-white text-xs font-medium rounded hover:bg-yellow-500 transition">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <form action="{{ route('admin.settings.destroy', $setting->id) }}" method="POST" class="inline-block"
                                              onsubmit="return confirm('Are you sure to delete this setting?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-red-500 text-white text-xs font-medium rounded hover:bg-red-600 transition">
                                                <i class="fas fa-trash-alt mr-1"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center px-4 py-3 text-gray-500 dark:text-gray-400">No settings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
