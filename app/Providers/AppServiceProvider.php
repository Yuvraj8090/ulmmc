<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\{Blade, View, Cache, App};
use App\Models\{NavbarItem, Setting};
use App\Helpers\TranslationHelper;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->setApplicationLocale();
        $this->registerBladeDirectives();
        $this->registerViewComposers();
    }

    /**
     * Set application locale based on session
     */
    protected function setApplicationLocale(): void
    {
        $locale = session('locale', config('app.locale', 'en'));
        App::setLocale($locale);
        View::share('locale', $locale);
    }

    /**
     * Register custom Blade directives
     */
    protected function registerBladeDirectives(): void
    {
        Blade::if('canview', function ($routeName) {
            return in_array($routeName, view()->shared('allowedRoutes', []));
        });
    }

    /**
     * Register view composers for shared data
     */
    protected function registerViewComposers(): void
    {
        View::composer('*', function ($view) {
            $this->shareSettings($view);
            $this->shareNavbarItems($view);
        });
    }

    /**
     * Share all settings with views
     */
    protected function shareSettings($view): void
    {
        $cacheKey = 'all_settings';
        $settings = Cache::remember($cacheKey, now()->addHours(1), function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });

        $view->with('settings', $settings);
    }

    /**
     * Share navbar items with views
     */
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

    /**
     * Process a single navbar item (helper)
     */
    protected function processNavbarItem($item, string $locale): void
    {
        if ($locale === 'hi' && !empty($item->title_hi)) {
            $item->translated_title = $item->title_hi;
        } else {
            $item->translated_title = TranslationHelper::translate($item->title, $locale);
        }

        // Process children recursively
        $item->children->each(function ($child) use ($locale) {
            if ($locale === 'hi' && !empty($child->title_hi)) {
                $child->translated_title = $child->title_hi;
            } else {
                $child->translated_title = TranslationHelper::translate($child->title, $locale);
            }
        });
    }
}
