<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

Route::get('/','App\Http\Controllers\PageController@getIndex')->name('trang-chu1');
Route::get('index','App\Http\Controllers\PageController@getIndex')->name('trang-chu');
Route::get('loai-san-pham/{type}', 'App\Http\Controllers\PageController@getLoaiSp')->name('loaisanpham'); 
Route::get('chi-tiet-san-pham/{id}', 'App\Http\Controllers\PageController@getChitiet')->name('chitietsanpham'); 
Route::get('lien-he', 'App\Http\Controllers\PageController@getLienHe')->name('lienhe'); 
Route::get('gioi-thieu', 'App\Http\Controllers\PageController@getGioiThieu')->name('gioithieu');
Route::get('add-to-cart/{id}','App\Http\Controllers\PageController@getAddtoCart')->name('themgiohang');

Route::get('dang-ki','App\Http\Controllers\PageController@getSignin')->name('signin');
Route::post('dang-ki-post','App\Http\Controllers\PageController@postSignin')->name('signinPost');

Route::get('dang-nhap','App\Http\Controllers\PageController@getLogin')->name('login');
Route::post('dang-nhap-post','App\Http\Controllers\PageController@postLognin')->name('loginPost');
Route::get('dang-xuat','App\Http\Controllers\PageController@postLogout')->name('logout');
Route::get('search','App\Http\Controllers\PageController@getSearch')->name('search');
Route::post('tao-sach-post','App\Http\Controllers\BooksController@createPost')->name('createPost');

Route::get('tao-sach','App\Http\Controllers\BooksController@create')->name('create');
Route::post('luu-sach','App\Http\Controllers\BooksController@store')->name('store');

Route::get('xoa-sach/{id}','App\Http\Controllers\BooksController@destroy')->name('destroy');

Route::get('edit/{id}','App\Http\Controllers\BooksController@edit')->name('edit');
Route::post('edit-post/{id}','App\Http\Controllers\BooksController@editPost')->name('editPost');

Route::get('add-to-cart/{id}',[
	'as' => 'themgiohang',
	'uses' => 'App\Http\Controllers\PageController@getAddToCart'
]);


Route::get('del-cart/{id}',[
	'as' => 'xoagiohang',
	'uses' => 'App\Http\Controllers\PageController@getDetailItemCart'
]);


Route::get('dat-hang',[
	'as' =>'dathang',
	'uses' => 'App\Http\Controllers\PageController@getCheckout'
]);

Route::post('dat-hang',[
	'as' => 'dathang1',
	'uses' => 'App\Http\Controllers\PageController@postCheckout'
]);






