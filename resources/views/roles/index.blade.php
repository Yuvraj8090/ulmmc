<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Roles Management') }}
            </h2>
            <a href="{{ route('admin.roles.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition-colors">
                <i class="fas fa-plus mr-1"></i> Create Role
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success Message -->
            @if(session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg dark:bg-green-900 dark:border-green-700 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Roles Table -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 md:p-6">
                <x-data-table 
                    :id="'roles-table'"
                    :headers="['Name', 'Description', 'Created At', 'Action']"
                    :rows="$roles"
                    :title="'Roles Management'"
                    :excel="true"
                    :print="true"
                    :pageLength="10"
                    :lengthMenu="[5, 10, 25, 50, -1]"
                    :lengthMenuLabels="['5', '10', '25', '50', 'All']"
                    :searchPlaceholder="'Search roles...'"
                    :resourceName="'roles'"
                >
                    @foreach($roles as $role)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3">{{ $role->name }}</td>
                            <td class="px-4 py-3">{{ $role->description ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $role->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('admin.roles.show', $role->id) }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm transition-colors">
                                    <i class="fas fa-eye mr-1"></i> Show
                                </a>
                                <a href="{{ route('admin.roles.edit', $role->id) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-sm transition-colors">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-sm transition-colors">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-data-table>
            </div>

        </div>
    </div>
</x-app-layout>