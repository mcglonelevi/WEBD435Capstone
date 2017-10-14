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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::put('/customers/{customer}/changePassword', [
  'uses' => 'CustomersController@changePassword',
  'as' => 'customers.changePassword'
]);
Route::resource('customers', 'CustomersController');
Route::resource('products', 'ProductsController');
Route::resource('orders', 'OrdersController');
Route::resource('orders.orderdetails', 'OrderdetailsController');
Auth::routes();
