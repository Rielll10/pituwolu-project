<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

// ─── Public Website ───────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', fn () => view('about'));
Route::get('/menu', [HomeController::class, 'menu']);
Route::get('/gallery', [HomeController::class, 'gallery']);
Route::get('/contact', fn () => view('contact'));
Route::get('/reservasi', fn () => view('reservasi'));

// Frontend POST routes
Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

// ─── Admin Auth ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Menu
        Route::get('/menu', [AdminMenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/create', [AdminMenuController::class, 'create'])->name('menu.create');
        Route::post('/menu', [AdminMenuController::class, 'store'])->name('menu.store');
        Route::get('/menu/{menu}/edit', [AdminMenuController::class, 'edit'])->name('menu.edit');
        Route::put('/menu/{menu}', [AdminMenuController::class, 'update'])->name('menu.update');
        Route::delete('/menu/{menu}', [AdminMenuController::class, 'destroy'])->name('menu.destroy');
        Route::patch('/menu/{menu}/best-seller', [AdminMenuController::class, 'toggleBestSeller'])->name('menu.toggleBestSeller');

        // Review
        Route::get('/review', [AdminReviewController::class, 'index'])->name('review.index');
        Route::patch('/review/{review}/status', [AdminReviewController::class, 'updateStatus'])->name('review.updateStatus');
        Route::delete('/review/{review}', [AdminReviewController::class, 'destroy'])->name('review.destroy');

        // Gallery
        Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::get('/gallery/create', [AdminGalleryController::class, 'create'])->name('gallery.create');
        Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::get('/gallery/{gallery}/edit', [AdminGalleryController::class, 'edit'])->name('gallery.edit');
        Route::put('/gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

        // Promo & Event
        Route::get('/event', [AdminEventController::class, 'index'])->name('event.index');
        Route::get('/event/create', [AdminEventController::class, 'create'])->name('event.create');
        Route::post('/event', [AdminEventController::class, 'store'])->name('event.store');
        Route::get('/event/{event}/edit', [AdminEventController::class, 'edit'])->name('event.edit');
        Route::put('/event/{event}', [AdminEventController::class, 'update'])->name('event.update');
        Route::delete('/event/{event}', [AdminEventController::class, 'destroy'])->name('event.destroy');
    });
});
