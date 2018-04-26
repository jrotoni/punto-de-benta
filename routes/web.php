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

Route::get('/sales', 'SaleController@show');

Route::get('/staff', function () {
    return view('settings/staff');
});

Route::get('/products', 'ProductController@show');
Route::post('/products/additem', 'ProductController@additem');
Route::post('/products/edititem', 'ProductController@edititem');
Route::post('/products/deleteitem', 'ProductController@deleteitem');
Route::post('/products/updatepicture', 'ProductController@updatepicture');
Route::post('/products/updateitem', 'ProductController@updateitem');
Route::get('/products/search', 'ProductController@search');
Route::get('/products/searchbycategory', 'ProductController@searchbycategory');
Route::get('/products/searchitems', 'ProductController@searchitems');
Route::get('/products/searchcategory', 'ProductController@searchcategory');

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
