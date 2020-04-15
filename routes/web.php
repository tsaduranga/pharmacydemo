<?php

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
    return view('pharmacy.welcome');
});


Route::get('/pharmacy', 'HomeController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {

});


Route::get('/customers', 'CustomerController@index');
Route::post('/customers', 'CustomerController@store');


Route::post('/pharmacy/status/{id}','HomeController@changeStatus');
