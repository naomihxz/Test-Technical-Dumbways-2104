<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

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

Route::get('/brands', 'BrandController@index')->name('brand_index');
Route::post('/brands/store', 'BrandController@store')->name('brand_store');
Route::patch('/brands/update/{brand}', 'BrandController@update')->name('brand_update');
Route::delete('/brands/delete/{brand}', 'BrandController@destroy')->name('brand_destroy');

Route::get('/cars', 'CarController@index')->name('car_index');
Route::post('/cars/store', 'CarController@store')->name('car_store');
Route::get('cars/img/{id}', 'CarController@showImg')->name('car_img');
Route::patch('/cars/tambah_stok/{car}', 'CarController@tambahStok')->name('car_stock');
Route::delete('/cars/delete/{car}', 'CarController@destroy')->name('car_destroy');

Route::get('/customers', 'CustomerController@index')->name('customer_index');
Route::post('/customers/store', 'CustomerController@store')->name('customer_store');
Route::patch('/customers/update/{customer}', 'CustomerController@update')->name('customer_update');
Route::delete('/customers/delete/{customer}', 'CustomerController@destroy')->name('customer_destroy');
