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

<footer class="text-light pt-5"
    style="background: linear-gradient(90deg,var(--brand-2),#0c87ab); position:relative; overflow:hidden;">

    <!-- Decorative background pattern -->
    <div
        style="position:absolute; top:-50px; right:-50px; width:200px; height:200px; background:rgba(255,255,255,0.05); border-radius:50%;">
    </div>
    <div
        style="position:absolute; bottom:-60px; left:-60px; width:250px; height:250px; background:rgba(255,255,255,0.05); border-radius:50%;">
    </div>

    <div class="container position-relative">
        <div class="row g-4">

            <!-- About -->
            <div class="col-md-3">
                <h5 class="fw-bold mb-3 position-relative">ABOUT ULMMC
                    <span class="d-block bg-warning" style="width:50px; height:3px; margin-top:6px;"></span>
                </h5>
                <p class="small opacity-75">
                    Established vide Government Order No. 204/XVIII-(B-2)/21-05(UDRP-AF)/2021, Dated 14.03.2022 and
                    registered under Societies Registration Act 1860.
                </p>
                <p class="small opacity-75">
                    Act as a Centre of Excellence to provide sustainable solutions for Landslide Mitigation and
                    Management. Provide services on PAN India basis.
                </p>
            </div>

            <!-- Address -->
            <div class="col-md-3">
                <h5 class="fw-bold mb-3 position-relative">ADDRESS
                    <span class="d-block bg-warning" style="width:50px; height:3px; margin-top:6px;"></span>
                </h5>
                <p class="small mb-1 opacity-75">
                    Uttarakhand Landslide Mitigation and Management Center <br>
                    6th Floor, Plot No 36, IT Park, Sahastradhara Road, <br>
                    Dehradun, Uttarakhand - 248001
                </p>
                <p class="small mb-1"><i class="bi bi-telephone-fill me-2 text-warning"></i> +91 822-88-67-005</p>
                <p class="small mb-1"><i class="bi bi-envelope-fill me-2 text-warning"></i> uklmmc@gmail.com</p>
                <p class="small mb-1"><i class="bi bi-envelope-fill me-2 text-warning"></i> ulmmc.uk@gmail.com</p>
                <p class="small"><i class="bi bi-envelope-fill me-2 text-warning"></i> ulmmc.ddn@gmail.com</p>
            </div>

            <!-- Quick Links -->
            <!-- Quick Links -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-3 position-relative">QUICK LINKS
                    <span class="d-block bg-warning" style="width:50px; height:3px; margin-top:6px;"></span>
                </h5>
                <ul class="list-unstyled small">
                    @foreach ($allNavbarItems->where('is_footer', true)->sortBy('order') as $item)
                        @php
                            $itemTitle = $locale === 'hi' ? $item['title_hi'] ?? $item['title'] : $item['title'];
                            $itemUrl = url($localePrefix . '/' . $item['slug']);
                        @endphp

                        @if ($item->children->where('is_footer', true)->isEmpty())
                            <li>
                                <a href="{{ $itemUrl }}" class="footer-link d-block py-1">
                                    <i class="bi bi-chevron-right me-1"></i>{{ $itemTitle }}
                                </a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="{{ $itemUrl }}" class="footer-link d-block py-1 dropdown-toggle"
                                    data-bs-toggle="dropdown">
                                    <i class="bi bi-chevron-right me-1"></i>{{ $itemTitle }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($item->children->where('is_footer', true)->sortBy('order') as $child)
                                        @php
                                            $childUrl = url($localePrefix . '/' . $child['slug']);
                                            $childTitle =
                                                $locale === 'hi'
                                                    ? $child['translated_title'] ?? $child['title']
                                                    : $child['title'];
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
            </div>


            <!-- Social -->
            <div class="col-md-2">
                <h5 class="fw-bold mb-3 position-relative">FOLLOW US
                    <span class="d-block bg-warning" style="width:50px; height:3px; margin-top:6px;"></span>
                </h5>
                <p class="small opacity-75">Follow Us for the latest updates and news.</p>
                <div class="d-flex gap-2">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-top mt-4 pt-4 pb-4 text-center">
            <p class="small mb-0 opacity-75">© 2025. All Rights Reserved |
                <a href="#" class="footer-link">Copyright Policy</a> |
                <a href="#" class="footer-link">Hyperlinking Policy</a> |
                <a href="#" class="footer-link">Terms and Conditions</a>
            </p>
        </div>
    </div>
</footer>

<a href="#" class="btn btn-primary rounded-pill back-to-top"><i class="bi bi-arrow-up"></i></a>
