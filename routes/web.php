<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{Product};

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/products-import', [
        Product\ProductController::class,
        'import',
    ])->name('products.import');

    Route::post('/products-import', [
        Product\ProductController::class,
        'storeImport',
    ])->name('products.import.store');

    Route::resource(
        'products',
        Product\ProductController::class
    );

    Route::get(
        '/products-import/template',
        [Product\ProductController::class, 'downloadTemplate']
    )->name('products.import.template');

    Route::resource('/products', Product\ProductController::class);

    Route::get('/products-export', [Product\ProductController::class, 'export'])
        ->name('products.export');
});

require __DIR__ . '/auth.php';
