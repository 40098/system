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
    return redirect('/open-orders');
});

Route::get('/open-orders', [App\Http\Controllers\OpenOrderController::class, 'index'])->middleware([ 'auth'])->name('openOrders.index');
Route::put('/open-orders', [App\Http\Controllers\OpenOrderController::class, 'update'])->middleware([ 'auth'])->name('openOrders.update');

Route::resource('/orders', App\Http\Controllers\OrderController::class)->middleware([ 'auth']);
route::post('/orders/search', [App\Http\Controllers\OrderController::class, 'search'])->middleware([ 'auth']);
route::get('/orders/{order}/done', [App\Http\Controllers\OrderController::class, 'done'])->middleware([ 'auth']);

Route::resource('/customers', App\Http\Controllers\CustomerController::class)->middleware([ 'auth']);
route::post('/customers/search', [App\Http\Controllers\CustomerController::class, 'search'])->middleware([ 'auth']);

Auth::routes();

