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


/*Brands*/
Route::get('brand', 'BrandController@index');

Route::get('brand/create', 'BrandController@create');
Route::post('brand', 'BrandController@store');

Route::get('brand/{id}', 'BrandController@show')->where('id', '[0-9]+');