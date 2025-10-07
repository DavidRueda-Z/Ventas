<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

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
