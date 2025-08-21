<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NavbarItemController;
use App\Http\Controllers\PageController;

Route::get('/en/{slug}', [PageController::class, 'showPage'])->name('page.show');
Route::get('/hi/{slug}', [PageController::class, 'showPageHi'])->name('page.show.hi');
Route::get('/{lang}/{slug}', [PageController::class, 'showLocalizedPage'])
    ->where(['lang' => 'en|hi'])
    ->name('pages.localized');
    Route::get('/{lang}', [PageController::class, 'showWelcomePage'])
    ->where('lang', 'en|hi')
    ->name('welcome.localized');
    Route::get('/', [PageController::class, 'showWelcomePage'])->name('welcome.default');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post('/admin/clear-cache', [PageController::class, 'clearCache'])
  
    ->name('admin.clear.cache');

    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin routes group
    Route::prefix('admin')->name('admin.')->group(function () {
         Route::resource('navbar-items', NavbarItemController::class);
            Route::post('navbar-items/update-order', [NavbarItemController::class, 'updateOrder'])->name('navbar-items.update-order');

         Route::get('/pages', [PageController::class, 'listPages'])->name('pages.list');
            Route::get('/pages/create', [PageController::class, 'showCreateForm'])->name('pages.create.form');
            Route::post('/pages/create', [PageController::class, 'createPage'])->name('pages.create');
            Route::get('/pages/edit/{id}', [PageController::class, 'showEditForm'])->name('pages.edit.form');
            Route::put('/pages/edit/{id}', [PageController::class, 'updatePage'])->name('pages.update');
            Route::post('/pages/delete/{id}', [PageController::class, 'deletePage'])->name('pages.delete');

        // CRUD routes for Roles and Users under /admin
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
});
