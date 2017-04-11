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
    return view('welcome');
});

/*Brand*/

//Route::resource('brand', 'BrandController');

Route::get('brand', 'BrandController@index')->name('brand.index');
Route::get('brand/show/{id}', 'BrandController@show')->where('id', '[0-9]+')->name('brand.show');

Route::get('brand/create', 'BrandController@create')->name('brand.create');
Route::post('brand/store', 'BrandController@store')->name('brand.store');

Route::get('brand/edit/{id}', 'BrandController@edit')->where('id', '[0-9]+')->name('brand.edit');
Route::put('brand/update/{id}', 'BrandController@update')->where('id', '[0-9]+')->name('brand.update');

Route::delete('brand/destroy/{id}', 'BrandController@destroy')->where('id', '[0-9]+')->name('brand.destroy');