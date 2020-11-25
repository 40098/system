<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/orders');
});

Route::resource('orders', App\Http\Controllers\OrderController::class)->middleware([ 'auth']);

Route::resource('products', App\Http\Controllers\ProductController::class)->middleware([ 'auth']);

Route::resource('customers', App\Http\Controllers\CustomerController::class)->middleware([ 'auth']);

Auth::routes();

