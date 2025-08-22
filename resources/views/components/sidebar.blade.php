<div class="px-4 py-6 bg-white dark:bg-gray-800 h-full flex flex-col justify-between">

    <!-- Navigation Section -->
    <div>
        <p class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-3 ml-2">
            Navigation
        </p>

        <nav class="space-y-1">

            <!-- Success / Error Toasts -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-800 dark:border-green-600 dark:text-green-100 rounded-md flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-800 dark:border-red-600 dark:text-red-100 rounded-md flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @php
                $links = [
                    ['route' => 'dashboard', 'icon' => 'fas fa-home', 'label' => 'Dashboard', 'pattern' => 'dashboard'],
                    ['route' => 'admin.users.index', 'icon' => 'fas fa-users', 'label' => 'Users', 'pattern' => 'admin.users.*'],
                    ['route' => 'admin.roles.index', 'icon' => 'fas fa-user-tag', 'label' => 'Roles', 'pattern' => 'admin.roles.*'],
                    ['route' => 'admin.leaders.index', 'icon' => 'fas fa-chess-king', 'label' => 'Leaders', 'pattern' => 'admin.leaders.*'],
                    ['route' => 'admin.media-files.index', 'icon' => 'fas fa-photo-video', 'label' => 'Media Files', 'pattern' => 'admin.media-files.*'],
                    ['route' => 'admin.tenders.index', 'icon' => 'fas fa-file-contract', 'label' => 'Tenders', 'pattern' => 'admin.tenders.*'],
                    ['route' => 'admin.news.list', 'icon' => 'fas fa-newspaper', 'label' => 'News', 'pattern' => 'admin.news.*'],
                    ['route' => 'admin.navbar-items.index', 'icon' => 'fas fa-bars', 'label' => 'Nav Items', 'pattern' => 'admin.navbar-items.*'],
                    ['route' => 'admin.pages.list', 'icon' => 'fas fa-file-alt', 'label' => 'Pages', 'pattern' => 'admin.pages.*'],
                    ['route' => 'admin.settings.index', 'icon' => 'fas fa-cogs', 'label' => 'Settings', 'pattern' => 'admin.settings.*'],
                ];
            @endphp

            @foreach($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="w-full group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors
                   {{ request()->routeIs($link['pattern']) ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="{{ $link['icon'] }} mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                    {{ $link['label'] }}
                </a>
            @endforeach

            <!-- Clear Cache (form-based) -->
            <form method="POST" action="{{ route('admin.clear.cache') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                        hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                    <i class="fas fa-broom mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                    Clear Cache
                </button>
            </form>

        </nav>
    </div>

    <!-- Resources Section -->
    <div class="mt-10">
        <p class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-3 ml-2">Resources</p>
        <a href="#"
           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fas fa-book mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
            Documentation
        </a>
        <a href="#"
           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fas fa-question-circle mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
            Support
        </a>
    </div>

</div>

<!-- Optional Floating Toast Script -->
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.createElement('div');
        toast.innerText = "{{ session('success') }}";
        toast.className = "fixed bottom-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50";
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    });
</script>
@endif
