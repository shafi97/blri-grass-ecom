<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ProductController;

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


Route::get('/registration', [AuthController::class, 'registerView'])->name('frontend.registerView');
Route::get('/getUpazila', [AuthController::class, 'getUpazila'])->name('frontend.getUpazila');
Route::get('/getUnion', [AuthController::class, 'getUnion'])->name('frontend.getUnion');
Route::post('/store', [AuthController::class, 'store'])->name('frontend.store');
Route::get('/f_login', [AuthController::class, 'login'])->name('frontend.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('frontend.logout');


Route::get('/', [IndexController::class, 'index'])->name('index');



Route::controller(ProductController::class)->prefix('product')->group(function(){
    Route::get('/show/{product_id}', 'show')->name('product.show');
    Route::get('/by-category/{cat_id}', 'productByCat')->name('productByCat');
    Route::get('/by-sub-category/{sub_cat_id}', 'productBySubCat')->name('productBySubCat');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');




