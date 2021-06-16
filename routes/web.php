<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OpenOrderController;

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

Route::resource('/open-orders', OpenOrderController::class)->middleware(['auth'])->except([
    'create', 'store', 'destroy'
]);

Route::resource('/orders', OrderController::class)->middleware(['auth']);
route::post('/orders/search', [OrderController::class, 'search'])->middleware(['auth']);
route::get('/orders/{order}/done', [OrderController::class, 'done'])->middleware(['auth'])->name('orders.done');
route::get('/orders/{order}/printer', [OrderController::class, 'printer'])->middleware(['auth'])->name('orders.printer');
route::post('/orders/{order}/print-label', [OrderController::class, 'printLabel'])->middleware(['auth'])->name('orders.print-label');

Route::resource('/customers', CustomerController::class)->middleware([ 'auth']);
route::post('/customers/search', [CustomerController::class, 'search'])->middleware(['auth']);

Auth::routes();

