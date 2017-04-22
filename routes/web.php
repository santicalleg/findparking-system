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

Route::auth();

Route::get('/home', 'HomeController@index');

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');

	Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
	Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function() {
	Route::get('/', 'AdministratorController@index')->name('admin.dashboard');
	/*Brand*/
	Route::get('/brand', 'BrandController@index')->name('brand.index');
	Route::get('/brand/show/{id}', 'BrandController@show')->where('id', '[0-9]+')->name('brand.show');

	Route::get('/brand/create', 'BrandController@create')->name('brand.create');
	Route::post('/brand/store', 'BrandController@store')->name('brand.store');

	Route::get('/brand/edit/{id}', 'BrandController@edit')->where('id', '[0-9]+')->name('brand.edit');
	Route::put('/brand/update/{id}', 'BrandController@update')->where('id', '[0-9]+')->name('brand.update');

	Route::delete('/brand/destroy/{id}', 'BrandController@destroy')->where('id', '[0-9]+')->name('brand.destroy');

	/*Parking*/
	Route::get('/parking', 'ParkingController@index')->name('parking.index');
	Route::get('/parking/show/{id}', 'ParkingController@show')->where('id', '[0-9]+')->name('parking.show');

	Route::get('/parking/create', 'ParkingController@create')->name('parking.create');
	Route::post('/parking/store', 'ParkingController@store')->name('parking.store');

	Route::get('/parking/edit/{id}', 'ParkingController@edit')->where('id', '[0-9]+')->name('parking.edit');
	Route::put('/parking/update/{id}', 'ParkingController@update')->where('id', '[0-9]+')->name('parking.update');

	Route::delete('/parking/destroy/{id}', 'ParkingController@destroy')->where('id', '[0-9]+')->name('parking.destroy');
});