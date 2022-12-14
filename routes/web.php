<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/shop/{id}', [ShopController::class, 'productDetails'])->name('product_details');

Route::get('cart', [ShopController::class, 'cart'])->name('cart');
// Route::get('add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('add.to.cart');
// Route::patch('update-cart', [ShopController::class, 'update'])->name('update.cart');
// Route::delete('remove-from-cart', [ShopController::class, 'remove'])->name('remove.from.cart');


// Admin Routes

Route::group(['prefix'=>'admin','middleware'  => 'auth'],function(){

    // Resource Routes
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubcategoryController::class);
    Route::resource('product', ProductController::class);
    


    // Custom Routes
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/get-subcategory/{id}', [ProductController::class, 'getSubcategory']);
});