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

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->middleware('auth');



Route::group(['prefix' => 'user'], function() {
 Route::get('/',[App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
 Route::get('/detail/{id}',[App\Http\Controllers\UserController::class, 'show'])->middleware('auth');
 Route::get('/new',[App\Http\Controllers\UserController::class, 'create'])->middleware('auth');
 Route::post('/store',[App\Http\Controllers\UserController::class, 'store'])->middleware('auth');
 Route::get('/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->middleware('auth');
 Route::post('/update',[App\Http\Controllers\UserController::class, 'update'])->middleware('auth');
 Route::get('/delete/{id}',[App\Http\Controllers\UserController::class, 'delete'])->middleware('auth');

});

Route::group(['prefix' => 'vendors'], function() {
    Route::get('/',[App\Http\Controllers\VendorController::class, 'index'])->middleware('auth');
    Route::get('/detail/{id}',[App\Http\Controllers\VendorController::class, 'show'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\VendorController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\VendorController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\VendorController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\VendorController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\VendorController::class, 'delete'])->middleware('auth');

   });


Route::group(['prefix' => 'size'], function() {
    Route::get('/',[App\Http\Controllers\SizeController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\SizeController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\SizeController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\SizeController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\SizeController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\SizeController::class, 'delete'])->middleware('auth');
   });

   Route::group(['prefix' => 'type'], function() {
    Route::get('/',[App\Http\Controllers\TypeProductController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\TypeProductController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\TypeProductController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\TypeProductController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\TypeProductController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\TypeProductController::class, 'delete'])->middleware('auth');
   });

   Route::group(['prefix' => 'color'], function() {
    Route::get('/',[App\Http\Controllers\ColorController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\ColorController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\ColorController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\ColorController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\ColorController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\ColorController::class, 'delete'])->middleware('auth');
   });

   Route::group(['prefix' => 'band'], function() {
    Route::get('/',[App\Http\Controllers\BandController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\BandController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\BandController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\BandController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\BandController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\BandController::class, 'delete'])->middleware('auth');

   });

   Route::group(['prefix' => 'produk'], function() {
    Route::get('/',[App\Http\Controllers\ProductController::class, 'index'])->middleware('auth');
    Route::get('/detail/{id}',[App\Http\Controllers\ProductController::class, 'show'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\ProductController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\ProductController::class, 'store'])->middleware('auth');
    Route::get('/select/{mastersku}',[App\Http\Controllers\ProductController::class, 'editselect'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\ProductController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\ProductController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\ProductController::class, 'delete'])->middleware('auth');
    Route::get('/import',[App\Http\Controllers\ProductController::class, 'importdata'])->middleware('auth');
    Route::post('/importing',[App\Http\Controllers\ProductController::class, 'importing'])->middleware('auth');

   });

   Route::group(['prefix' => 'api'], function() {
    Route::post('/massdelete',[App\Http\Controllers\ProductController::class, 'apimassdelete'])->middleware('auth');
    Route::post('/deletesku',[App\Http\Controllers\ProductController::class, 'apideletesku'])->middleware('auth');
    Route::post('/publish',[App\Http\Controllers\PublishController::class, 'apimasspublish'])->middleware('auth');
    Route::get('/getproductmastersku',[App\Http\Controllers\BarcodeDBController::class, 'getproductmastersku'])->middleware('auth');
   });

   Route::group(['prefix' => 'publish'], function() {
    Route::get('/',[App\Http\Controllers\PublishController::class, 'index'])->middleware('auth');
    Route::get('/{groupname}',[App\Http\Controllers\PublishController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\PublishController::class, 'update'])->middleware('auth');
    Route::get('/detail/{groupname}',[App\Http\Controllers\PublishController::class, 'show'])->middleware('auth');
    Route::get('/delete/{groupname}',[App\Http\Controllers\PublishController::class, 'delete'])->middleware('auth');
   });

   Route::group(['prefix' => 'kasir'], function() {
    Route::get('/',[App\Http\Controllers\PenjualanController::class, 'kasir'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\PenjualanController::class, 'addpenjualan'])->middleware('auth');
   });

   Route::group(['prefix' => 'productapi'], function() {
    Route::post('getproduct',[App\Http\Controllers\ProductController::class, 'getproduct'])->middleware('auth');
   });


   Route::group(['prefix' => 'penjualan'], function() {
    Route::get('/',[App\Http\Controllers\PenjualanController::class, 'index'])->middleware('auth');
    Route::get('/detail/{id}',[App\Http\Controllers\PenjualanController::class, 'show'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\PenjualanController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\PenjualanController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\PenjualanController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\PenjualanController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\PenjualanController::class, 'delete'])->middleware('auth');
    Route::get('/struk/{id?}',[App\Http\Controllers\PenjualanController::class, 'receipt'])->middleware('auth');

   });




require __DIR__.'/auth.php';
