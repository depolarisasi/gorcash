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

Route::get('logout', [App\Http\Controllers\UserController::class, 'logout'])->middleware('auth');

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->middleware('auth');



Route::group(['prefix' => 'user'], function() {
 Route::get('/',[App\Http\Controllers\UserController::class, 'index'])->middleware('admin');
 Route::get('/detail/{id}',[App\Http\Controllers\UserController::class, 'show'])->middleware('admin');
 Route::get('/new',[App\Http\Controllers\UserController::class, 'create'])->middleware('admin');
 Route::post('/store',[App\Http\Controllers\UserController::class, 'store'])->middleware('admin');
 Route::get('/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->middleware('admin');
 Route::post('/update',[App\Http\Controllers\UserController::class, 'update'])->middleware('admin');
 Route::get('/delete/{id}',[App\Http\Controllers\UserController::class, 'delete'])->middleware('admin');

});

Route::group(['prefix' => 'vendors'], function() {
    Route::get('/',[App\Http\Controllers\VendorController::class, 'index'])->middleware('auth');
    Route::get('/detail/{id}',[App\Http\Controllers\VendorController::class, 'show'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\VendorController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\VendorController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\VendorController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\VendorController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\VendorController::class, 'delete'])->middleware('auth');
    Route::get('/import',[App\Http\Controllers\VendorController::class, 'importdata'])->middleware('auth');
    Route::post('/importing',[App\Http\Controllers\VendorController::class, 'importing'])->middleware('auth');
    Route::post('/massdelete',[App\Http\Controllers\VendorController::class, 'apimassdelete'])->middleware('auth');

   });


Route::group(['prefix' => 'size'], function() {
    Route::get('/',[App\Http\Controllers\SizeController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\SizeController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\SizeController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\SizeController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\SizeController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\SizeController::class, 'delete'])->middleware('auth');
    Route::get('/import',[App\Http\Controllers\SizeController::class, 'importdata'])->middleware('auth');
    Route::post('/importing',[App\Http\Controllers\SizeController::class, 'importing'])->middleware('auth');
    Route::post('/massdelete',[App\Http\Controllers\SizeController::class, 'apimassdelete'])->middleware('auth');
   });

   Route::group(['prefix' => 'type'], function() {
    Route::get('/',[App\Http\Controllers\TypeProductController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\TypeProductController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\TypeProductController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\TypeProductController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\TypeProductController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\TypeProductController::class, 'delete'])->middleware('auth');
    Route::get('/import',[App\Http\Controllers\TypeProductController::class, 'importdata'])->middleware('auth');
    Route::post('/importing',[App\Http\Controllers\TypeProductController::class, 'importing'])->middleware('auth');
    Route::post('/massdelete',[App\Http\Controllers\TypeProductController::class, 'apimassdelete'])->middleware('auth');
   });

   Route::group(['prefix' => 'color'], function() {
    Route::get('/',[App\Http\Controllers\ColorController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\ColorController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\ColorController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\ColorController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\ColorController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\ColorController::class, 'delete'])->middleware('auth');
    Route::get('/import',[App\Http\Controllers\ColorController::class, 'importdata'])->middleware('auth');
    Route::post('/importing',[App\Http\Controllers\ColorController::class, 'importing'])->middleware('auth');
    Route::post('/massdelete',[App\Http\Controllers\ColorController::class, 'apimassdelete'])->middleware('auth');
   });

   Route::group(['prefix' => 'band'], function() {
    Route::get('/',[App\Http\Controllers\BandController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\BandController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\BandController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\BandController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\BandController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\BandController::class, 'delete'])->middleware('auth');
    Route::get('/import',[App\Http\Controllers\BandController::class, 'importdata'])->middleware('auth');
    Route::post('/importing',[App\Http\Controllers\BandController::class, 'importing'])->middleware('auth');
    Route::post('/massdelete',[App\Http\Controllers\BandController::class, 'apimassdelete'])->middleware('auth');

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
    Route::post('/getso',[App\Http\Controllers\StokOpnameController::class, 'getso'])->middleware('auth');
    Route::post('/simpanso',[App\Http\Controllers\StokOpnameController::class, 'pausesomingguan'])->middleware('auth');
    Route::post('/simpansobulanan',[App\Http\Controllers\StokOpnameController::class, 'pausesobulanan'])->middleware('auth');
   });

   Route::group(['prefix' => 'publish'], function() {
    Route::get('/',[App\Http\Controllers\PublishController::class, 'index'])->middleware('auth');
    Route::get('/{groupname}',[App\Http\Controllers\PublishController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\PublishController::class, 'update'])->middleware('auth');
    Route::get('/detail/{groupname}',[App\Http\Controllers\PublishController::class, 'show'])->middleware('auth');
    Route::get('/delete/{groupname}',[App\Http\Controllers\PublishController::class, 'delete'])->middleware('auth');
   });

   Route::group(['prefix' => 'kasir'], function() {
    Route::get('/',[App\Http\Controllers\PenjualanController::class, 'kasir'])->middleware('sales');
    Route::post('/store',[App\Http\Controllers\PenjualanController::class, 'addpenjualan'])->middleware('sales');
   });

   Route::group(['prefix' => 'productapi'], function() {
    Route::post('getproduct',[App\Http\Controllers\ProductController::class, 'getproduct']);
    Route::post('/apiaddbarangkasir',[App\Http\Controllers\PenjualanController::class, 'apiaddbarang']);
    Route::post('/apitambahqtykasir',[App\Http\Controllers\PenjualanController::class, 'apiaddqtybarang']);
    Route::post('/apikurangqtykasir',[App\Http\Controllers\PenjualanController::class, 'apiminqtybarang']);
    Route::post('/apideletebarangkasir',[App\Http\Controllers\PenjualanController::class, 'apidelbarang']);
   });


   Route::group(['prefix' => 'penjualan'], function() {
    Route::get('/',[App\Http\Controllers\PenjualanController::class, 'index'])->middleware('sales');
    Route::get('/detail/{id}',[App\Http\Controllers\PenjualanController::class, 'show'])->middleware('sales');
    Route::get('/new',[App\Http\Controllers\PenjualanController::class, 'create'])->middleware('sales');
    Route::post('/store',[App\Http\Controllers\PenjualanController::class, 'store'])->middleware('sales');
    Route::get('/edit/{id}',[App\Http\Controllers\PenjualanController::class, 'edit'])->middleware('sales');
    Route::post('/update',[App\Http\Controllers\PenjualanController::class, 'update'])->middleware('sales');
    Route::get('/delete/{id}',[App\Http\Controllers\PenjualanController::class, 'delete'])->middleware('sales');
    Route::get('/struk/{id?}',[App\Http\Controllers\PenjualanController::class, 'receipt'])->middleware('sales');

   });

    Route::group(['prefix' => 'stokopname'], function() {
    Route::get('/',[App\Http\Controllers\StokOpnameController::class, 'pilihso'])->middleware('warehouse');
    Route::get('/mingguan',[App\Http\Controllers\StokOpnameController::class, 'indexmingguan'])->middleware('warehouse');
    Route::get('/mingguan/{pubid}',[App\Http\Controllers\StokOpnameController::class, 'somingguan'])->middleware('warehouse');
    Route::get('/mingguan/edit/{pubid}',[App\Http\Controllers\StokOpnameController::class, 'resumesomingguan'])->middleware('warehouse');
    Route::post('/mingguan/store',[App\Http\Controllers\StokOpnameController::class, 'storesomingguan'])->middleware('warehouse');
    Route::post('/mingguan/update',[App\Http\Controllers\StokOpnameController::class, 'updatesomingguan'])->middleware('warehouse');
    Route::get('/bulanan',[App\Http\Controllers\StokOpnameController::class, 'indexbulanan'])->middleware('warehouse');
    Route::get('/bulanan/{pubid}',[App\Http\Controllers\StokOpnameController::class, 'sobulanan'])->middleware('warehouse');
    Route::get('/bulanan/edit/{pubid}',[App\Http\Controllers\StokOpnameController::class, 'resumesobulanan'])->middleware('warehouse');
    Route::post('/bulanan/store',[App\Http\Controllers\StokOpnameController::class, 'storesobulanan'])->middleware('warehouse');
    Route::post('/bulanan/update',[App\Http\Controllers\StokOpnameController::class, 'updatesobulanan'])->middleware('warehouse');
    Route::get('/laporan/{pubid}',[App\Http\Controllers\StokOpnameController::class, 'laporan'])->middleware('warehouse');
    Route::get('/laporan/download/{pubid}',[App\Http\Controllers\StokOpnameController::class, 'laporanpdf'])->middleware('warehouse');

   });

   Route::group(['prefix' => 'barcode'], function() {
    Route::get('/',[App\Http\Controllers\BarcodeDBController::class, 'index'])->middleware('warehouse');
    Route::get('/new',[App\Http\Controllers\BarcodeDBController::class, 'create'])->middleware('warehouse');
    Route::post('/store',[App\Http\Controllers\BarcodeDBController::class, 'store'])->middleware('warehouse');
    Route::get('/edit/{id}',[App\Http\Controllers\BarcodeDBController::class, 'edit'])->middleware('warehouse');
    Route::post('/update',[App\Http\Controllers\BarcodeDBController::class, 'update'])->middleware('warehouse');
    Route::get('/delete/{id}',[App\Http\Controllers\BarcodeDBController::class, 'delete'])->middleware('warehouse');
    Route::get('/import',[App\Http\Controllers\BarcodeDBController::class, 'importdata'])->middleware('warehouse');
    Route::post('/importing',[App\Http\Controllers\BarcodeDBController::class, 'importing'])->middleware('warehouse');
   });

   Route::group(['prefix' => 'agenda'], function() {
    Route::get('/',[App\Http\Controllers\AgendaController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\AgendaController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\AgendaController::class, 'store'])->middleware('auth');
    Route::get('/detail/{id}',[App\Http\Controllers\AgendaController::class, 'show'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\AgendaController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\AgendaController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\AgendaController::class, 'delete'])->middleware('auth');

   });


   Route::group(['prefix' => 'note'], function() {
    Route::get('/',[App\Http\Controllers\NoteController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\NoteController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\NoteController::class, 'store'])->middleware('auth');
    Route::get('/detail/{id}',[App\Http\Controllers\NoteController::class, 'show'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\NoteController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\NoteController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\NoteController::class, 'delete'])->middleware('auth');

   });

   Route::group(['prefix' => 'informasi'], function() {
    Route::get('/',[App\Http\Controllers\InformasiController::class, 'index'])->middleware('accountant');
    Route::get('/new',[App\Http\Controllers\InformasiController::class, 'create'])->middleware('accountant');
    Route::post('/store',[App\Http\Controllers\InformasiController::class, 'store'])->middleware('accountant');
    Route::get('/detail/{id}',[App\Http\Controllers\InformasiController::class, 'show'])->middleware('accountant');
    Route::get('/edit/{id}',[App\Http\Controllers\InformasiController::class, 'edit'])->middleware('accountant');
    Route::post('/update',[App\Http\Controllers\InformasiController::class, 'update'])->middleware('accountant');
    Route::get('/delete/{id}',[App\Http\Controllers\InformasiController::class, 'delete'])->middleware('accountant');

   });

   Route::group(['prefix' => 'workflow'], function() {
    Route::get('/',[App\Http\Controllers\BandController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\BandController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\BandController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\BandController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\BandController::class, 'update'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\BandController::class, 'delete'])->middleware('auth');

   });

   Route::group(['prefix' => 'turunbarang'], function() {
    Route::get('/',[App\Http\Controllers\TurunBarangController::class, 'index'])->middleware('auth');
    Route::get('/new',[App\Http\Controllers\TurunBarangController::class, 'create'])->middleware('auth');
    Route::post('/store',[App\Http\Controllers\TurunBarangController::class, 'store'])->middleware('auth');
    Route::get('/edit/{id}',[App\Http\Controllers\TurunBarangController::class, 'edit'])->middleware('auth');
    Route::post('/update',[App\Http\Controllers\TurunBarangController::class, 'update'])->middleware('auth');

    Route::get('/kembali/{id}',[App\Http\Controllers\TurunBarangController::class, 'kembali'])->middleware('auth');
    Route::post('/kembalikan',[App\Http\Controllers\TurunBarangController::class, 'kembalikan'])->middleware('auth');
    Route::get('/delete/{id}',[App\Http\Controllers\TurunBarangController::class, 'delete'])->middleware('auth');

   });


require __DIR__.'/auth.php';
