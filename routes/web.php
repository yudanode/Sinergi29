<?php

use Illuminate\Support\Facades\Route;

// Controllers Public
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PostController as PublicPostController;
use App\Http\Controllers\Public\EventController as PublicEventController;
use App\Http\Controllers\Public\PortofolioController as PublicPortfolioController;
use App\Http\Controllers\Public\FeedbackController as PublicFeedbackController;

// Controllers lainnya
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES — Bisa diakses siapa saja tanpa login
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Berita / Post
Route::prefix('berita')->name('posts.')->group(function () {
    Route::get('/', [PublicPostController::class, 'index'])->name('index');
    Route::get('/{slug}', [PublicPostController::class, 'show'])->name('show');
});

// Event
Route::prefix('event')->name('events.')->group(function () {
    Route::get('/', [PublicEventController::class, 'index'])->name('index');
    Route::get('/{event}', [PublicEventController::class, 'show'])->name('show');
});

// Portfolio
Route::prefix('portfolio')->name('portfolio.')->group(function () {
    Route::get('/', [PublicPortfolioController::class, 'index'])->name('index');
    Route::get('/{portfolio}', [PublicPortfolioController::class, 'show'])->name('show');
});

// Kritik & Saran — siapa saja bisa kirim
Route::get('/kritik-saran', [PublicFeedbackController::class, 'create'])->name('feedback.create');
Route::post('/kritik-saran', [PublicFeedbackController::class, 'store'])->name('feedback.store');

/*
|--------------------------------------------------------------------------
| USER ROUTES — Harus login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Like (polymorphic: post, event, portfolio)
    Route::post('/like/{type}/{id}', [LikeController::class, 'toggle'])->name('like.toggle');

    // Komentar pada post
    Route::post('/berita/{post}/komentar', [PublicPostController::class, 'storeComment'])->name('comments.store');
    Route::delete('/komentar/{comment}', [PublicPostController::class, 'destroyComment'])->name('comments.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN & EDITOR ROUTES — Harus login + role admin atau editor
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,editor'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Berita
        Route::resource('berita', \App\Http\Controllers\Admin\PostController::class);

        // Event
        Route::resource('event', \App\Http\Controllers\Admin\EventController::class);

        // Portfolio
        Route::resource('portfolio', \App\Http\Controllers\Admin\PortofolioController::class);

        // Galeri (file portfolio)
        Route::resource('galeri', \App\Http\Controllers\Admin\GalleryController::class);

        // Komentar
        Route::get('komentar', [\App\Http\Controllers\Admin\ComentController::class, 'index'])->name('komentar.index');
        Route::delete('komentar/{comment}', [\App\Http\Controllers\Admin\ComentController::class, 'destroy'])->name('komentar.destroy');

        // Feedback / Kritik Saran
        Route::get('feedback', [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');
        Route::delete('feedback/{feedback}', [\App\Http\Controllers\Admin\FeedbackController::class, 'destroy'])->name('feedback.destroy');

        /*
        |--------------------------------------------------------------
        | HANYA ADMIN — Kelola user & editor
        |--------------------------------------------------------------
        */
        Route::middleware('role:admin')->group(function () {
            Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        });
    });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES — Bawaan Breeze (login, register, dll)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
