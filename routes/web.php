<?php

use App\Http\Controllers\ShippingPartnersController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\CoffeeProductController;
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
    return redirect()->route('login');
});

Route::redirect('/dashboard', '/sales');

// Route::get('/sales', function () {
//     return view('coffee_sales');
// })->middleware(['auth'])->name('coffee.sales');

// Route::get('/shipping-partners', function () {
//     return view('shipping_partners');
// })->middleware(['auth'])->name('shipping.partners');


Route::middleware('auth:web')->group(function () {
    Route::controller(ShippingPartnersController::class)->group(function () {
        Route::get('/shipping-partners', 'index')->name('shipping.partners');
        Route::get('/shipping-cost-add', 'create')->name('shipping-cost-add');
        Route::post('/shipping-cost-addAction', 'store')->name('shipping-cost-addAction');
        Route::get("/shipping-cost-edit/{id}", "edit");
        Route::post("/shipping-cost-edit-action", "update");
        Route::post("/shipping-cost-delete", "delete");
        Route::post('/shipping-cost-changeStatus', 'changeStatus')->name('shipping-cost-changeStatus');
    });
    Route::controller(CoffeeController::class)->group(function () {
        Route::get('/sales', 'index')->name('coffee.sales');
        Route::get('/coffe-sales-add', 'create');
        Route::post('/coffe-sales-addAction', 'calculatePrice')->name('coffe-sales-addAction');
    });
    Route::controller(CoffeeProductController::class)->group(function () {
        Route::get('/sales-product', 'index')->name('coffee_product.sales');
        Route::get('/coffe-product-sales-add', 'create');
        Route::post('/coffe-product-sales-addAction', 'calculatePrice')->name('coffe-product-sales-addAction');
    });
});

require __DIR__ . '/auth.php';
