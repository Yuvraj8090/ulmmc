<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\{Blade, View, Cache, App};
use Illuminate\Pagination\Paginator;
use App\Models\{NavbarItem, Setting, Leader, News}; // ✅ Add News model
use App\Helpers\TranslationHelper;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ✅ Tailwind pagination styling
        Paginator::useTailwind();

        $this->setApplicationLocale();
        $this->registerBladeDirectives();
        $this->registerViewComposers();
    }

    protected function setApplicationLocale(): void
    {
        $locale = session('locale', config('app.locale', 'en'));
        App::setLocale($locale);
        View::share('locale', $locale);
    }

    protected function registerBladeDirectives(): void
    {
        Blade::if('canview', function ($routeName) {
            return in_array($routeName, view()->shared('allowedRoutes', []));
        });
    }

    protected function registerViewComposers(): void
    {
        View::composer('*', function ($view) {
            $this->shareSettings($view);
            $this->shareNavbarItems($view);
            $this->shareAllLeaders($view); 
            $this->shareAllNews($view);   // ✅ Now sharing all news
        });
    }

    protected function shareSettings($view): void
    {
        $cacheKey = 'all_settings';
        $allsettings = Cache::remember($cacheKey, now()->addHours(1), function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });

        $view->with('allsettings', $allsettings);
    }

    protected function shareNavbarItems($view): void
    {
        $locale = App::getLocale();
        $cacheKey = "navbar_items_{$locale}";

        $items = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($locale) {
            return NavbarItem::with('children')
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('order')
                ->get()
                ->each(function ($item) use ($locale) {
                    $this->processNavbarItem($item, $locale);
                });
        });

        $view->with('navbarItems', $items);
    }

    protected function shareAllLeaders($view): void
    {
        $cacheKey = 'all_leaders';
        $allLeaders = Cache::remember($cacheKey, now()->addMinutes(30), function () {
            return Leader::orderBy('id', 'asc')->get();
        });

        $view->with('allLeaders', $allLeaders);
    }

    // ✅ NEW: Share all news globally
    protected function shareAllNews($view): void
    {
        $cacheKey = 'all_news';
        $allNews = Cache::remember($cacheKey, now()->addMinutes(30), function () {
            return News::orderBy('created_at', 'desc')->get();
        });

        $view->with('allNews', $allNews);
    }

    protected function processNavbarItem($item, string $locale): void
    {
        if ($locale === 'hi' && !empty($item->title_hi)) {
            $item->translated_title = $item->title_hi;
        } else {
            $item->translated_title = TranslationHelper::translate($item->title, $locale);
        }

        $item->children->each(function ($child) use ($locale) {
            if ($locale === 'hi' && !empty($child->title_hi)) {
                $child->translated_title = $child->title_hi;
            } else {
                $child->translated_title = TranslationHelper::translate($child->title, $locale);
            }
        });
    }
}
