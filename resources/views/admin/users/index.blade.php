<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users Management') }}
            </h2>

            <!-- Create User Button -->
            
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success Message -->
            @if(session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif
<a href="{{ route('admin.users.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                Create User
            </a>
            <!-- Users Table -->
            <div class="bg-white shadow rounded-lg p-4">
                <x-data-table 
                    :id="'users-table'"
                    :headers="['Name', 'Email', 'Role', 'Action']"
                    :rows="$users"
                    :title="'Users Management'"
                    :excel="true"
                    :print="true"
                    :pageLength="10"
                    :lengthMenu="[5, 10, 25, 50, -1]"
                    :lengthMenuLabels="['5', '10', '25', '50', 'All']"
                    :searchPlaceholder="'Search users...'"
                    :resourceName="'users'"
                >
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name ?? '-' }}</td>
                            <td class="text-center space-x-1">
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">
                                    Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                                <a href="{{ route('admin.users.show', $user->id) }}" 
                                   class="bg-gray-500 hover:bg-gray-600 text-white px-2 py-1 rounded">
                                    Show
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </x-data-table>
            </div>

        </div>
    </div>
</x-app-layout>
