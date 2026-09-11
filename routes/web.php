<?php

use App\Http\Controllers\ProfileController;
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
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // Products - Import
    Route::get('/products-import', [
        Product\ProductController::class,
        'import',
    ])
        ->middleware('permission:import-products')
        ->name('products.import');

    Route::post('/products-import', [
        Product\ProductController::class,
        'storeImport',
    ])
        ->middleware('permission:import-products')
        ->name('products.import.store');


    // Products - Import template
    Route::get('/products-import/template', [
        Product\ProductController::class,
        'downloadTemplate',
    ])
        ->middleware('permission:import-products')
        ->name('products.import.template');


    // Products - Export
    Route::get('/products-export', [
        Product\ProductController::class,
        'export',
    ])
        ->middleware('permission:export-products')
        ->name('products.export');


    // Products - List
    Route::get('/products', [
        Product\ProductController::class,
        'index',
    ])
        ->middleware('permission:view-products')
        ->name('products.index');


    // Products - Create
    Route::get('/products/create', [
        Product\ProductController::class,
        'create',
    ])
        ->middleware('permission:create-products')
        ->name('products.create');

    Route::post('/products', [
        Product\ProductController::class,
        'store',
    ])
        ->middleware('permission:create-products')
        ->name('products.store');


    // Products - Show
    Route::get('/products/{product}', [
        Product\ProductController::class,
        'show',
    ])
        ->middleware('permission:view-products')
        ->name('products.show');


    // Products - Edit
    Route::get('/products/{product}/edit', [
        Product\ProductController::class,
        'edit',
    ])
        ->middleware('permission:edit-products')
        ->name('products.edit');

    Route::put('/products/{product}', [
        Product\ProductController::class,
        'update',
    ])
        ->middleware('permission:edit-products')
        ->name('products.update');


    // Products - Delete
    Route::delete('/products/{product}', [
        Product\ProductController::class,
        'destroy',
    ])
        ->middleware('permission:delete-products')
        ->name('products.destroy');
});

require __DIR__ . '/auth.php';
