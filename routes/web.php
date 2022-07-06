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
});
Route::group(['middleware' => ['auth']], function () {
    //Toko
    Route::post('/seller/updatetoko', 'penjual\PenjualController@updateToko')->name('seller.updatetoko');
    Route::post('/seller/storetoko', 'penjual\PenjualController@storeToko')->name('seller.storetoko');
    Route::get('/seller/registoko', 'penjual\PenjualController@regisToko')->name('seller.registoko');
});

