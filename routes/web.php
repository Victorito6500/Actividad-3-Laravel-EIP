<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Middleware\AdminMiddleware;
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

// Welcome route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    AdminMiddleware::class
])->group(function () {
    // /prestamos
    Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('/prestamos/detalle/{id}', [PrestamoController::class, 'get'])->name('prestamos.get');
    Route::get('/prestamos/crear', [PrestamoController::class, 'createView'])->name('prestamos.createView');
    Route::post('/prestamos/crear', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::get('/prestamos/modificar/{id}', [PrestamoController::class, 'updateView'])->name('prestamos.updateView');
    Route::post('/prestamos/modificar', [PrestamoController::class, 'update'])->name('prestamos.update');
    Route::get('/prestamos/entregar/{id}', [PrestamoController::class, 'entregar'])->name('prestamos.entregar');
    Route::get('/prestamos/eliminar/{id}', [PrestamoController::class, 'delete'])->name('prestamos.delete');

    // /libros
    Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
    Route::get('/libros/detalle/{id}', [LibroController::class, 'get'])->name('libros.get');
    Route::get('/libros/crear', [LibroController::class, 'createView'])->name('libros.createView');
    Route::post('/libros/crear', [LibroController::class, 'create'])->name('libros.create');
    Route::get('/libros/modificar/{id}', [LibroController::class, 'updateView'])->name('libros.updateView');
    Route::post('/libros/modificar', [LibroController::class, 'update'])->name('libros.update');
    Route::get('/libros/eliminar/{id}', [LibroController::class, 'delete'])->name('libros.delete');
});

// Authenticated users routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // /prestamos
    Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('/prestamos/detalle/{id}', [PrestamoController::class, 'get'])->name('prestamos.get');
    Route::get('/prestamos/crear', [PrestamoController::class, 'createView'])->name('prestamos.createView');
    Route::post('/prestamos/crear', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::get('/prestamos/entregar/{id}', [PrestamoController::class, 'entregar'])->name('prestamos.entregar');

    // /libros
    Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
    Route::get('/libros/detalle/{id}', [LibroController::class, 'get'])->name('libros.get');
});


