<?php

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

Route::get('/', [\App\Http\Controllers\Dark\HomeController::class, 'index'])->name('home');
Route::get('/products/{id}', [\App\Http\Controllers\Dark\ProductController::class, 'products'])->name('products');
Route::post('/products-filter', [\App\Http\Controllers\Dark\ProductController::class, 'filters'])->name('filters');
Route::get('/category/{category}', [\App\Http\Controllers\Dark\ProductController::class, 'categoryProduct'])->name('categoryProduct');
//Light
Route::get('/light/products/{id}', [\App\Http\Controllers\Light\ProductController::class, 'products'])->name('products.light');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/basket/index', [\App\Http\Controllers\Dark\BasketController::class, 'index'])->name('basket.index');
    Route::post('/basket/add', [\App\Http\Controllers\Dark\BasketController::class, 'add'])->name('basket.add');
    Route::post('/basket/quantity_minus', [\App\Http\Controllers\Dark\BasketController::class, 'decreaseQuantity'])->name('basket.quantity_minus');
    Route::post('/basket/remove', [\App\Http\Controllers\Dark\BasketController::class, 'remove'])->name('basket.remove');
    Route::get('/basket/checkout', [\App\Http\Controllers\Dark\BasketController::class, 'checkout'])->name('basket.checkout');
    Route::post('/favorites/add', [\App\Http\Controllers\Dark\FavoriteProductsController::class, 'addFavorite'])->name('favorites.add');
    Route::post('/favorites/remove', [\App\Http\Controllers\Dark\FavoriteProductsController::class, 'removeFavorite'])->name('favorites.remove');
    Route::get('/favorites', [\App\Http\Controllers\Dark\FavoriteProductsController::class, 'favorites'])->name('favorites');
    Route::post('/order', [\App\Http\Controllers\Dark\OrderController::class, 'index'])->name('order.index');
    Route::get('/order/history', [\App\Http\Controllers\Dark\OrderController::class, 'history'])->name('order.history');
//    Light
    Route::post('/basket/light/add', [\App\Http\Controllers\Light\BasketController::class, 'add'])->name('basket.light.add');
    Route::post('/basket/light/remove', [\App\Http\Controllers\Light\BasketController::class, 'remove'])->name('basket.light.remove');
    Route::get('/basket/light', [\App\Http\Controllers\Light\BasketController::class, 'basket'])->name('basket.light');
    Route::post('/favorites/light/add', [\App\Http\Controllers\Light\FavoriteProductsController::class, 'addFavorite'])->name('favorites.light.add');
    Route::post('/favorites/light/remove', [\App\Http\Controllers\Light\FavoriteProductsController::class, 'removeFavorite'])->name('favorites.light.remove');
    Route::get('/favorites/light', [\App\Http\Controllers\Light\FavoriteProductsController::class, 'favorites'])->name('favorites.light');
    Route::get('/contact/light', [\App\Http\Controllers\Light\ContactController::class, 'contact'])->name('contact.light');
    Route::post('/contact-us', [\App\Http\Controllers\Light\ContactController::class, 'store'])->name('contact.us.store');
    Route::get('/category/light/{category}', [\App\Http\Controllers\Light\ProductController::class, 'categoryProduct'])->name('categoryProduct.light');
    Route::view('/about/light','/Light.about')->name('about.light');
});
