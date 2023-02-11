<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShippingController;
use App\Http\Controllers\Frontend\WishlistController;

Route::controller(CartController::class)->prefix('/cart')->group(function(){
    Route::get('/index', 'index')->name('cart.index');
    Route::post('/store', 'store')->name('cart.store');
    Route::get('/show', 'show')->name('cart.show');
    Route::post('/incrementStore', 'incrementStore')->name('cart.incrementStore');
    Route::post('/decrementStore', 'decrementStore')->name('cart.decrementStore');
    Route::get('/delete/{id}', 'delete')->name('cart.delete');
    Route::delete('/destroy', 'destroy')->name('cart.destroy');
});

Route::controller(WishlistController::class)->prefix('/wishlist')->group(function(){
    Route::get('/index', 'index')->name('wishlist.index');
    Route::post('/store', 'store')->name('wishlist.store');
    Route::get('/show', 'show')->name('wishlist.show');
    // Route::post('/incrementStore', 'incrementStore')->name('wishlist.incrementStore');
    // Route::post('/decrementStore', 'decrementStore')->name('wishlist.decrementStore');
    Route::get('/delete/{id}', 'delete')->name('wishlist.delete');
    Route::delete('/destroy', 'destroy')->name('wishlist.destroy');
});


Route::controller(ShippingController::class)->prefix('/shipping')->group(function(){
    Route::get('/', 'index')->name('shipping.index');
    Route::post('/', 'store')->name('shipping.store');
    Route::get('/multi', 'shippingMulti')->name('shipping.shippingMulti');
    Route::post('/multiple/store', 'multipleStore')->name('shipping.multipleStore');
    Route::post('/confirm', 'confirm')->name('shipping.confirm');
});
