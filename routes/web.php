<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SiteController::class, 'robots'])->name('robots');
Route::get('/project/{slug}', [SiteController::class, 'project'])->name('projects.show');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'store'])->name('admin.login.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/', fn () => redirect()->route('admin.content.index'))->name('index');
    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::get('/content/{section}/edit', [ContentController::class, 'edit'])->name('content.edit');
    Route::put('/content/{section}', [ContentController::class, 'update'])->name('content.update');
});
