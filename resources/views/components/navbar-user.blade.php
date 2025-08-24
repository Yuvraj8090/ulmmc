@php
    // Current locale and segments
    $locale = app()->getLocale();

    $localePrefix = $locale === 'hi' ? 'hi' : 'en'; // 'en' or 'hi'
    $firstSegment = request()->segment(1);
    $currentSlug = request()->segment(2) ?? request()->segment(1);
    $pageTitle = $page->translated_title ?? ($page->title ?? 'Home');
    $currentLang = $firstSegment ?? 'en';

    // Determine target language and URL for language switcher
    if ($firstSegment === 'hi') {
        // Currently in Hindi, switch to English
        $switchUrl =
            '/' .
            collect(request()->segments())
                ->slice(1)
                ->implode('/');
        $switchText = 'English';
    } else {
        // Currently in English, switch to Hindi
        $switchUrl = '/hi/' . collect(request()->segments())->implode('/');
        $switchText = 'हिन्दी';
    }

    // Fix for root URL
    if ($switchUrl === '') {
        $switchUrl = '/';
    }
@endphp



<div class="topbar py-1">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="d-flex align-items-center gap-3">
            <span><i class="bi bi-calendar-event me-2"></i><span id="today"></span></span>
            <span class="d-none d-md-inline"><i class="bi bi-geo-alt me-2"></i> Dehradun, Uttarakhand</span>
            <span class="badge rounded-pill ms-1">Government Portal</span>
        </div>
        <div class="d-flex gap-3">
            <a href="#skip" class="">Skip to content</a>
            <a href="{{ $switchUrl }}" class="font-medium hover:underline">
                {{ $locale === 'hi' ? 'English' : 'हिन्दी' }}
            </a>
            <a href="#access" class=""><i class="bi bi-universal-access me-1"></i>Accessibility</a>
        </div>
    </div>
</div>

<!-- Brand bar -->
<div class="brandbar py-2">
    <div class="container d-flex justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" class="logo-img" alt="Emblem" />
            <img src="{{ asset('img/govt_uk.png') }}" class="logo-img" alt="State Seal" />
            <div class="brand-text">
                <h5 class="mb-0 fw-bold">ULMCC</h5>
                <small>(Government of Uttarakhand)</small>
            </div>
        </div>
        <div class="d-none d-md-flex align-items-center gap-2">
            <i class="bi bi-telephone me-1"></i><span>Helpline: 1800-123-456</span>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg,var(--brand-2),#0c87ab);">
    <div class="container">
        <!-- Home Link -->
        <a class="navbar-brand fw-semibold" href="{{ route('welcome.default') }}">Home</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav"
            aria-controls="offcanvasNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Dynamic Navbar Items -->
        <!-- Dynamic Navbar Items -->
<ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-lg-2">
    @foreach($allNavbarItems->where('is_footer', false) as $item)
        @php
            $itemTitle = $locale === 'hi' ? ($item['title_hi'] ?? $item['title']) : $item['title'];
            $itemUrl = url($localePrefix . '/' . $item['slug']);
        @endphp

        @if($item->children->isEmpty())
            <li class="nav-item">
                <a href="{{ $itemUrl }}" target="{{ $item->target ?? '_self' }}" 
                   class="nav-link">{{ $itemTitle }}</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ $itemUrl }}" role="button" data-bs-toggle="dropdown">
                    {{ $itemTitle }}
                </a>
                <ul class="dropdown-menu dropdown-menu-dark shadow">
                    @foreach($item->children->where('is_footer', false) as $child)
                        @php
                            $childUrl = url($localePrefix . '/' . $child['slug']);
                            $childTitle = $locale === 'hi' ? ($child['translated_title'] ?? $child['title']) : $child['title'];
                        @endphp
                        <li>
                            <a class="dropdown-item" href="{{ $childUrl }}">{{ $childTitle }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    @endforeach
</ul>


        <!-- Offcanvas / Sign In -->
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNav"
            aria-labelledby="offcanvasNavLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavLabel">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-md btn-sign"><i
                            class="bi bi-box-arrow-in-right me-1"></i>Sign in</a>
                </div>
            </div>
        </div>
    </div>
</nav>
