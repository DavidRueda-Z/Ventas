<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VendedorController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (solo para usuarios autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PANEL DE ADMINISTRADOR (solo rol: admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Gestión de productos (solo admin)
            Route::get('/products', [AdminController::class, 'productsIndex'])->name('products.index');
            Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
            Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
            Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
            Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');

            // Gestión de usuarios y roles
            Route::post('/users/{user}/promote', [AdminController::class, 'promoteToAdmin'])->name('users.promote');
            Route::post('/users/{user}/assign-vendedor', [AdminController::class, 'assignVendedor'])->name('users.assign-vendedor');

            // Administración de roles
            Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
            Route::post('/roles/assign/{userId}', [RoleController::class, 'assignRole'])->name('roles.assign');
        });

    /*
    |--------------------------------------------------------------------------
    | PANEL DE VENDEDOR (solo rol: vendedor)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:vendedor'])
        ->prefix('vendedor')
        ->name('vendedor.')
        ->group(function () {
            Route::get('/', [VendedorController::class, 'index'])->name('index');
            Route::get('/crear', [VendedorController::class, 'create'])->name('create');
            Route::post('/', [VendedorController::class, 'store'])->name('store');
            Route::get('/{id}', [VendedorController::class, 'show'])->name('show');
        });

    /*
    |--------------------------------------------------------------------------
    | RUTAS COMPARTIDAS (Admin y Vendedor)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin|vendedor'])->group(function () {
        Route::resource('sales', SaleController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | PERFIL Y DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


