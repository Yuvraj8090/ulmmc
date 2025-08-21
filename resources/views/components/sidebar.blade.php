<div class="px-4 py-6 bg-white dark:bg-gray-800 h-full flex flex-col justify-between">
    <!-- Navigation Section -->
    <div>
        <p class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-3 ml-2">Navigation</p>
        <nav class="space-y-1">
            <!-- Dashboard -->
            <x-nav-link href="{{ route('dashboard') }}" 
                        :active="request()->routeIs('dashboard')"
                        class="w-full group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               text-gray-700 dark:text-gray-200 
                               hover:text-gray-900 dark:hover:text-white">
                <i class="fas fa-home mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                Dashboard
            </x-nav-link>

            <!-- Users -->
            <x-nav-link href="{{ route('admin.users.index') }}" 
                        :active="request()->routeIs('admin.users.*')"
                        class="w-full group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               text-gray-700 dark:text-gray-200 
                               hover:text-gray-900 dark:hover:text-white">
                <i class="fas fa-users mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                Users
            </x-nav-link>

            <!-- Roles -->
            <x-nav-link href="{{ route('admin.roles.index') }}" 
                        :active="request()->routeIs('admin.roles.*')"
                        class="w-full  group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               text-gray-700 dark:text-gray-200 
                               hover:text-gray-900 dark:hover:text-white">
                <i class="fas fa-user-tag mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                Roles
            </x-nav-link>

            <!-- Leaders -->
            <x-nav-link href="{{ route('admin.leaders.index') }}" 
                        :active="request()->routeIs('admin.leaders.*')"
                        class="w-full  group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               text-gray-700 dark:text-gray-200 
                               hover:text-gray-900 dark:hover:text-white">
                <i class="fas fa-chess-king mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                Leaders
            </x-nav-link>

            <!-- Tenders -->
            <x-nav-link href="{{ route('admin.tenders.index') }}" 
                        :active="request()->routeIs('admin.tenders.*')"
                        class="w-full  group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               text-gray-700 dark:text-gray-200 
                               hover:text-gray-900 dark:hover:text-white">
                <i class="fas fa-file-contract mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                Tenders
            </x-nav-link>

            <!-- News -->
            <x-nav-link href="{{ route('admin.news.list') }}" 
                        :active="request()->routeIs('admin.news.*')"
                        class="w-full  group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               text-gray-700 dark:text-gray-200 
                               hover:text-gray-900 dark:hover:text-white">
                <i class="fas fa-newspaper mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                News
            </x-nav-link>

            <!-- Navbar Items -->
            <x-nav-link href="{{ route('admin.navbar-items.index') }}" 
                        :active="request()->routeIs('admin.navbar-items.*')"
                        class="w-full  group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               text-gray-700 dark:text-gray-200 
                               hover:text-gray-900 dark:hover:text-white">
                <i class="fas fa-bars mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                Nav Items
            </x-nav-link>

            <!-- Pages -->
           <x-nav-link href="{{ route('admin.pages.list') }}" 
            :active="request()->routeIs('admin.pages.*')"
            class="group flex items-center w-full px-3 py-2 text-sm font-medium rounded-md transition-colors 
                   hover:bg-gray-100 dark:hover:bg-gray-700
                   text-gray-700 dark:text-gray-200 
                   hover:text-gray-900 dark:hover:text-white">
    <i class="fas fa-file-alt mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
    Pages
</x-nav-link>


            <!-- Settings -->
            <x-nav-link href="{{ route('admin.settings.index') }}" 
                        :active="request()->routeIs('admin.settings.*')"
                        class="w-full  group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               text-gray-700 dark:text-gray-200 
                               hover:text-gray-900 dark:hover:text-white">
                <i class="fas fa-cogs mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                Settings
            </x-nav-link>
        </nav>
    </div>

    <!-- Resources Section -->
    <div class="mt-10">
        <p class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-3 ml-2">Resources</p>
        <a href="#"
           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 
                  hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fas fa-book mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
            Documentation
        </a>
        <a href="#"
           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 
                  hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fas fa-question-circle mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
            Support
        </a>
    </div>
</div>
