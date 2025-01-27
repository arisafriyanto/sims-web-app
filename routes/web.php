<?php

use App\Exports\ProductsExport;
use App\Http\Controllers\Auth\{LoginController, LogoutControllers};
use App\Http\Controllers\{ProductController, ProductExportController, ProfileController};
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', LogoutControllers::class)->name('logout');

Route::get('products/export', [ProductController::class, 'export'])->name('products.export')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/profile', ProfileController::class)->name('profile.index');
});
