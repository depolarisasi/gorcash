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

   Route::group(['prefix' => 'band'], function() {
    Route::get('/',[App\Http\Controllers\BandController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\BandController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\BandController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\BandController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\BandController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\BandController::class, 'delete'])->middleware('auth');

   });

   Route::group(['prefix' => 'produk'], function() {
    Route::get('/',[App\Http\Controllers\ProdukController::class, 'index'])->middleware('auth');
    Route::get('/detail/{id}',[App\Http\Controllers\ProdukController::class, 'show'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\ProdukController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\ProdukController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\ProdukController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\ProdukController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\ProdukController::class, 'delete'])->middleware('auth');

   });



require __DIR__.'/auth.php';
