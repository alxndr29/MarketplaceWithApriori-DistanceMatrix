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
// Route::get('/coba',function(){
//     return view('penjual.produkadd');
// });
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'cektoko']], function () {
    //Penjual
    Route::get('/seller/dashboard', 'penjual\PenjualController@dashboard')->name('seller.dashboard');
    //Toko 
    Route::get('/seller/halamanupdatetoko', 'penjual\PenjualController@halamanUpdateToko')->name('seller.halamanupdatetoko');
    //Etalase Produk
    Route::get('/seller/etalase','penjual\EtalaseProdukController@index')->name('seller.etalaseindex');
    Route::post('/seller/etalase/store', 'penjual\EtalaseProdukController@store')->name('seller.etalasestore');
    Route::put('/seller/etalase/update/{id}', 'penjual\EtalaseProdukController@update')->name('seller.etalaseupdate');
    Route::delete('/seller/etalase/delete/{id}', 'penjual\EtalaseProdukController@delete')->name('seller.etalasedelete');
    //Produk
    Route::get('/seller/produk', 'penjual\ProdukController@index')->name('seller.produkindex');
    Route::get('/seller/produk/add', 'penjual\ProdukController@add')->name('seller.produkadd');
    Route::post('/seller/produk/store', 'penjual\ProdukController@store')->name('seller.produkstore');
    Route::put('/seller/produk/update/{id}', 'penjual\ProdukController@update')->name('seller.produkupdate');
    Route::delete('/seller/produk/delete/{id}', 'penjual\ProdukController@delete')->name('seller.produkdelete');
    //
});
Route::group(['middleware' => ['auth']], function () {
    //Toko
    Route::post('/seller/updatetoko', 'penjual\PenjualController@updateToko')->name('seller.updatetoko');
    Route::post('/seller/storetoko', 'penjual\PenjualController@storeToko')->name('seller.storetoko');
    Route::get('/seller/registoko', 'penjual\PenjualController@regisToko')->name('seller.registoko');
});

