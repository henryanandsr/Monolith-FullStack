<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PenggunaController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatalogBarangController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [PenggunaController::class, 'create'])->name('register');
Route::post('/register', [PenggunaController::class, 'store'])->name('register.store');

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/katalog-barang', [KatalogBarangController::class, 'katalogBarang'])->name('katalog.barang');
Route::get('/barang/{id}', [KatalogBarangController::class, 'detailBarang'])->name('detail.barang');
Route::get('/beli/{id}', [KatalogBarangController::class, 'beliBarang'])->name('beli.barang');
Route::post('/orders', [OrdersController::class, 'store'])->middleware('auth')->name('orders.store');
Route::get('/riwayat-pembelian', [OrdersController::class, 'getAuthenticatedUserOrders'])->middleware('auth')->name('riwayat_pembelian');