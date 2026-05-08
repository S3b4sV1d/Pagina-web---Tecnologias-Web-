<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProductoController;



Route::view('/', 'index')->name('home');
Route::view('/login', 'pages.login')->name('login');
Route::view('/acerca', 'pages.acercade')->name('about');
//Route::view('/productos', 'pages.products')->name('products');
Route::get('/productos', [ProductoController::class, 'index'])->name('products');

Route::get('/carrito/agregar/{id}', [CarritoController::class, 'agregar']);


Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

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




Route::middleware(['auth'])->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index']);
    Route::get('/carrito/agregar/{id}', [CarritoController::class, 'agregar']);
    Route::post('/checkout', [CheckoutController::class, 'procesar']);
});