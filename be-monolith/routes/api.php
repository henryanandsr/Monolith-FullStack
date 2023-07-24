<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/pengguna', 'App\Http\Controllers\API\PenggunaController@index');
Route::get('/barang', 'App\Http\Controllers\API\OrdersController@index');
Route::post('/register', 'App\Http\Controllers\API\PenggunaController@store');
Route::group(['middleware' => 'jwt.auth'], function() {
    Route::post('/barang/create', 'App\Http\Controllers\API\OrdersController@store');
    Route::get('/orders/user', 'App\Http\Controllers\API\OrdersController@getAuthenticatedUserOrders');
});
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});