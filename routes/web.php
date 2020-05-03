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

Route::get('products', 'ProductController@index');
Route::get('products/{product}', 'ProductController@show');
Route::post('cart', 'CartController@add');
Route::get('cart', 'CartController@show');
Route::delete('cart/{product}', 'CartController@remove');
Route::post('order', 'OrderController@make');


