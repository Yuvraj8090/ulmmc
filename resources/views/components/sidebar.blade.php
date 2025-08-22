<div class="flex flex-col h-full bg-white dark:bg-gray-800 px-4 py-6 justify-between">

    <!-- Navigation Section -->
    <div>
        <p class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-3 ml-2">
            Navigation
        </p>

        <nav class="space-y-2">

            {{-- Success Toast --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-800 dark:border-green-600 dark:text-green-100 rounded-md flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error Toast --}}
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-800 dark:border-red-600 dark:text-red-100 rounded-md flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- Navigation Links --}}
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
                   class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors
                   {{ request()->routeIs($link['pattern']) 
                        ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white' 
                        : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <i class="{{ $link['icon'] }} mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                    {{ $link['label'] }}
                </a>
            @endforeach

            {{-- Clear Cache Button --}}
            <form method="POST" action="{{ route('admin.clear.cache') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors 
                        hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                    <i class="fas fa-broom mr-3 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"></i>
                    Clear Cache
                </button>
            </form>

        </nav>
    </div>

    <!-- User Info Section -->
    <div class="mt-6">
        <div class="flex items-center p-3 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-800 rounded-md">
            <img class="h-9 w-9 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</p>
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Administrator</p>
            </div>
        </div>
    </div>

</div>

{{-- Floating Toast Script --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toast = document.createElement('div');
        toast.innerText = "{{ session('success') }}";
        toast.className = "fixed bottom-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50 animate-fade-in-out";
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    });
</script>
@endif

{{-- Optional Tailwind CSS Animation --}}
<style>
    @keyframes fade-in-out {
        0%, 100% { opacity: 0; transform: translateY(20px); }
        10%, 90% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-out { animation: fade-in-out 4s ease forwards; }
</style>
