<?php

use App\Http\Controllers\Dark\BasketController;
use App\Http\Controllers\Dark\FavoriteProductsController;
use App\Http\Controllers\Dark\HomeController;
use App\Http\Controllers\Dark\OrderController;
use App\Http\Controllers\Dark\ProductController;
use App\Http\Controllers\Light\AboutController;
use App\Http\Controllers\Light\ContactController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{id}', [ProductController::class, 'products'])->name('products');
Route::post('/products-filter', [ProductController::class, 'filters'])->name('filters');
Route::get('/category/{category}', [ProductController::class, 'categoryProduct'])->name('categoryProduct');
//Light
Route::get('/light/products/{id}', [ProductController::class, 'products'])->name('products.light');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/basket/index', [BasketController::class, 'index'])->name('basket.index');
    Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
    Route::post('/basket/quantity_minus', [BasketController::class, 'decreaseQuantity'])->name('basket.quantity_minus');
    Route::post('/basket/remove', [BasketController::class, 'remove'])->name('basket.remove');
    Route::get('/basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');
    Route::post('/favorites/add', [FavoriteProductsController::class, 'addFavorite'])->name('favorites.add');
    Route::post('/favorites/remove', [FavoriteProductsController::class, 'removeFavorite'])->name('favorites.remove');
    Route::get('/favorites', [FavoriteProductsController::class, 'favorites'])->name('favorites');
    Route::post('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
//    Light
    Route::post('/basket/light/add', [BasketController::class, 'add'])->name('basket.light.add');
    Route::post('/basket/light/remove', [BasketController::class, 'remove'])->name('basket.light.remove');
    Route::get('/basket/light', [BasketController::class, 'basket'])->name('basket.light');
    Route::post('/favorites/light/add', [FavoriteProductsController::class, 'addFavorite'])->name('favorites.light.add');
    Route::post('/favorites/light/remove', [FavoriteProductsController::class, 'removeFavorite'])->name('favorites.light.remove');
    Route::get('/favorites/light', [FavoriteProductsController::class, 'favorites'])->name('favorites.light');
    Route::get('/contact/light', [ContactController::class, 'contact'])->name('contact.light');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.us.store');
    Route::get('/category/light/{category}', [ProductController::class, 'categoryProduct'])->name('categoryProduct.light');
    Route::get('/about/light', [AboutController::class, 'index'])->name('about.light');

});
