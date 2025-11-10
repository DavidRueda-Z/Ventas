<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


//Rutas públicas

Route::get('/', function () {
    return view('welcome');
});


//Rutas protegidas (requieren login)

Route::middleware(['auth'])->group(function () {

    
//Rutas del panel de usuario (vendedores)
    
    
    Route::resource('sales', SaleController::class);

    // Productos visibles solo si el usuario tiene permiso (ej. vendedor)
    Route::resource('products', ProductController::class)->middleware('role:vendedor|admin');

    
    //Rutas del panel de administración (solo admin)
    
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        // Gestión de productos
        Route::get('products', [AdminController::class, 'productsIndex'])->name('products.index');
        Route::get('products/create', [AdminController::class, 'createProduct'])->name('products.create');
        Route::post('products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::get('products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
        Route::put('products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');

        // Gestión de usuarios y roles
        Route::post('users/{user}/promote', [AdminController::class, 'promoteToAdmin'])->name('users.promote');
        Route::post('users/{user}/assign-vendedor', [AdminController::class, 'assignVendedor'])->name('users.assign-vendedor');

        // Gestión de roles
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/roles/assign/{userId}', [RoleController::class, 'assignRole'])->name('roles.assign');
    });



    
    //Perfil de usuario
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    //Dashboard general
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');
});


//Rutas de autenticación (login, register, logout)

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:vendedor'])->group(function () {
    Route::get('/vendedor', [VendedorController::class, 'index'])->name('vendedor.index');
    Route::get('/vendedor/crear', [VendedorController::class, 'create'])->name('vendedor.create');
    Route::post('/vendedor', [VendedorController::class, 'store'])->name('vendedor.store');
    Route::get('/vendedor/{id}', [VendedorController::class, 'show'])->name('vendedor.show');
});
