<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('products', [AdminController::class, 'productsIndex'])->name('products.index');
        Route::get('products/create', [AdminController::class, 'createProduct'])->name('products.create');
        Route::post('products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::get('products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
        Route::put('products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');

        Route::post('users/{user}/promote', [AdminController::class, 'promoteToAdmin'])->name('users.promote');
        Route::post('users/{user}/assign-vendedor', [AdminController::class, 'assignVendedor'])->name('users.assign-vendedor');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('productos', ProductoController::class);
});

Route::resource('ventas', VentaController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('sales', [VentaController::class, 'index'])->name('sales.index');
    Route::get('sales/create', [VentaController::class, 'create'])->name('sales.create');
    Route::post('sales', [VentaController::class, 'store'])->name('sales.store');
    Route::get('sales/{sale}', [VentaController::class, 'show'])->name('sales.show');
});
