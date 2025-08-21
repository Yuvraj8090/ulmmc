<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Edit User') }}
            </h2>
            
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded">
                        <ul class="list-disc list-inside text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
<a href="{{ route('admin.users.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow">
                Back to Users
            </a>
                {{-- Edit User Form --}}
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter user name">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter user email">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-gray-700 font-medium">
                            Password <span class="text-gray-400 text-sm">(Leave blank to keep current)</span>
                        </label>
                        <input type="password" name="password"
                            class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter new password">
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Re-enter new password">
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Role</label>
                        <select name="role_id"
                            class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.users.index') }}"
                            class="px-5 py-2 rounded bg-gray-500 text-white hover:bg-gray-600 transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2 rounded bg-yellow-500 text-white hover:bg-yellow-600 transition">
                            Update User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
