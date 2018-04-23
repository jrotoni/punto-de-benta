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

Route::get('/sales', function () {
    return view('settings/sales');
});

Route::get('/staff', function () {
    return view('settings/staff');
});

Route::get('/products', 'ProductController@show');
Route::post('/products/additem', 'ProductController@additem');
Route::post('/products/addcategory', 'CategoryController@add');
Route::post('/products/removecategory', 'CategoryController@delete');
Route::post('/products/updatecategory', 'CategoryController@update');

Route::post('/registercompany', 'CompanyController@register');
Route::post('/registercompany_check','CompanyController@registered_email');

Route::post('/addcart', 'CartController@add');
Route::post('/removecart', 'CartController@delete');
Route::post('/updatecart', 'CartController@update');

Route::post('/salesregister', 'SaleController@add');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
