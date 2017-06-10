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

//Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/user/edit', 'UserController@edit')->name('user.edit');
	Route::put('/user/update', 'UserController@update')->name('user.update');

	Route::get('/home', 'CheckinController@index');
	Route::get('/checkin', 'CheckinController@index')->name('checkin.index');
	Route::post('/checkin/store', 'CheckinController@store')->name('checkin.store');
	Route::post('/checkout/store', 'CheckoutController@store')->name('checkout.store');

	/*Vehicle*/
	Route::get('/vehicle', 'VehicleController@index')->name('vehicle.index');

	Route::get('/vehicle/create', 'VehicleController@create')->name('vehicle.create');
	Route::post('/vehicle/store', 'VehicleController@store')->name('vehicle.store');

	Route::get('/vehicle/edit/{id}', 'VehicleController@edit')->where('id', '[0-9]+')->name('vehicle.edit');
	Route::put('/vehicle/update/{id}', 'VehicleController@update')->where('id', '[0-9]+')->name('vehicle.update');

	Route::delete('/vehicle/destroy/{id}', 'VehicleController@destroy')->where('id', '[0-9]+')->name('vehicle.destroy');

	/*Rating*/
	Route::get('/rating/getByUser', 'RatingController@getByUser')->name('rating.getByUser');

	Route::post('/rating/store', 'RatingController@store')->name('rating.store');
	Route::put('/vehicle/update', 'RatingController@update')->name('rating.update');

	/*Parking*/
	Route::get('/parking/getAll', 'ParkingController@getAll')->name('parking.getAll');
	Route::get('/parking/detail/{id}', 'ParkingController@detail')->where('id', '[0-9]+')->name('parking.detail');
});

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');

	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
	Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function() {
	Route::get('/', 'ParkingController@index')->name('admin.dashboard');

	Route::get('/administrator/edit', 'AdministratorController@edit')->name('admin.edit');
	Route::put('/administrator/update', 'AdministratorController@update')->name('admin.update');

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

	/*Slot*/
	Route::get('/slot/{id}', 'SlotController@index')->where('id', '[0-9]+')->name('slot.index');

	Route::get('/slot/create/{id}', 'SlotController@create')->where('id', '[0-9]+')->name('slot.create');
	Route::post('/slot/store', 'SlotController@store')->name('slot.store');

	Route::get('/slot/edit/{id}', 'SlotController@edit')->where('id', '[0-9]+')->name('slot.edit');
	Route::put('/slot/update/{id}', 'SlotController@update')->where('id', '[0-9]+')->name('slot.update');

	Route::delete('/slot/destroy/{id}', 'SlotController@destroy')->where('id', '[0-9]+')->name('slot.destroy');
});