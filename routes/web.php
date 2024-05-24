<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\TransbankController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LibroController::class, 'welcome']);


Route::post('/iniciar_compra', [TransbankController::class, 'iniciar_compra']);
Route::get('/confirmar_pago', [TransbankController::class, 'confirmar_pago'])->name('confirmar_pago');

Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
Route::get('/libros/create', [LibroController::class, 'create'])->name('libros.create');
Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');
Route::get('/libros/{libro}/edit', [LibroController::class, 'edit'])->name('libros.edit');
Route::put('/libros/{libro}', [LibroController::class, 'update'])->name('libros.update');
Route::delete('/libros/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy');

Route::get('/carrito', [CompraController::class, 'verCarrito'])->name('carrito.ver');
Route::post('/agregar-al-carrito/{libro}', [CompraController::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::delete('/eliminar-del-carrito/{libro}', [CompraController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');