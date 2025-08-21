<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add News
        </h2>
    </x-slot>

    <div class="py-6 container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <form method="POST" action="{{ route('admin.news.create') }}">
                @include('admin.news.form')
                <div class="mt-6">
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg shadow hover:from-indigo-600 hover:to-purple-700">
                        Save News
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
