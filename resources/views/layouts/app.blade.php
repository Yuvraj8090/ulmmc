<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ allsettings('site.title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
    <script src="{{asset('js/all.min.js')}}"></script>
    <script src="{{asset('js/tinymce.min.js')}}"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <div x-data="{ sidebarOpen: window.innerWidth >= 1024, darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }" class="flex h-screen transition-colors duration-300">

        <!-- Dark Mode Toggle -->
        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
            class="fixed bottom-4 right-4 z-50 p-3 bg-indigo-600 dark:bg-indigo-800 text-white rounded-full shadow-lg hover:bg-indigo-700 dark:hover:bg-indigo-900 transition-colors">
            <i x-show="!darkMode" class="fas fa-moon"></i>
            <i x-show="darkMode" class="fas fa-sun"></i>
        </button>

        <!-- Sidebar Backdrop (for mobile) -->
        <div x-show="sidebarOpen && window.innerWidth < 1024" @click="sidebarOpen = false"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 lg:hidden"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-gray-800 border-r dark:border-gray-700 overflow-y-auto transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-lg">
            <div class="h-16 flex items-center justify-between px-4 border-b dark:border-gray-700">
                <a href="{{ route('dashboard') }}"
                    class="text-xl font-bold text-indigo-600 dark:text-indigo-400 flex items-center">
                    <i class="fas fa-cube mr-2"></i>
                    {{ allsettings('admin.title') }}
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 dark:text-gray-400">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <x-sidebar />


            <div class="absolute bottom-0 w-full p-4 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                <div class="flex items-center">
                    <img class="h-9 w-9 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" />
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</p>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow-sm z-10 border-b dark:border-gray-700">
                <div class="flex justify-between items-center p-4 sm:px-6">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true"
                            class="lg:hidden mr-4 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $header ?? 'Dashboard' }}
                        </h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Search Bar -->
                        <div class="hidden md:block relative">
                            <input type="text" placeholder="Search..."
                                class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent w-64">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

                        <!-- Notifications -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="p-2 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-bell"></i>
                                <span
                                    class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg border dark:border-gray-700 py-1 z-50"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95">
                                <div class="px-4 py-2 border-b dark:border-gray-700">
                                    <h3 class="text-sm font-medium text-gray-800 dark:text-gray-200">Notifications</h3>
                                </div>
                                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                                    <a href="#" class="flex px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <div
                                            class="flex-shrink-0 bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-400 rounded-full p-2">
                                            <i class="fas fa-user-plus text-xs"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">New user
                                                registered</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">2 minutes ago</p>
                                        </div>
                                    </a>
                                    <a href="#" class="flex px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <div
                                            class="flex-shrink-0 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 rounded-full p-2">
                                            <i class="fas fa-server text-xs"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Server
                                                restarted</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">45 minutes ago</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-4 py-2 border-t dark:border-gray-700">
                                    <a href="#"
                                        class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">View all
                                        notifications</a>
                                </div>
                            </div>
                        </div>

                        <!-- User dropdown -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span
                                        class="hidden md:inline mr-2 text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                                    <img class="h-8 w-8 rounded-full object-cover border-2 border-white dark:border-gray-600"
                                        src="{{ Auth::user()->profile_photo_url }}" />
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profile.show') }}" class="flex items-center">
                                    <i class="fas fa-user mr-2 text-gray-400"></i> Profile
                                </x-dropdown-link>
                                <x-dropdown-link href="#" class="flex items-center">
                                    <i class="fas fa-cog mr-2 text-gray-400"></i> Settings
                                </x-dropdown-link>
                                <div class="border-t border-gray-100 dark:border-gray-700"></div>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit()"
                                        class="flex items-center text-red-600 dark:text-red-400">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
    <script>
        // Store sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            // Check for dark mode preference
            if (localStorage.getItem('darkMode') === 'true' ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches &&
                    localStorage.getItem('darkMode') !== 'false')) {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</body>

</html>
