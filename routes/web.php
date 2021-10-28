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

Route::group(['prefix' => 'vendor'], function() {
    Route::get('/',[App\Http\Controllers\VendorController::class, 'index'])->middleware('auth');
    Route::get('/detail/{id}',[App\Http\Controllers\VendorController::class, 'show'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\VendorController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\VendorController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\VendorController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\VendorController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\VendorController::class, 'delete'])->middleware('auth');

   });


require __DIR__.'/auth.php';
