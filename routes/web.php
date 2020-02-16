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

// Route::get('/','HomeController@index');
Route::get('/admin', 'HomeController@index')->name('home.index')->middleware('auth:admin');
// Route::get('/kategori','CategoriesController@index');
// Route::get('/tambah-kategori','CategoriesController@create');
Route::resource('/admin/kategori', 'CategoriesController')->middleware('auth:admin');
Route::resource('/admin/produk', 'ProdukController')->middleware('auth:admin');
Route::get('/admin/posting/edit/{cat}','PostingController@edit')->name('posting.edit')->middleware('auth:admin');
Route::put('/admin/posting/update/{cat}', 'PostingController@update')->name('posting.update')->middleware('auth:admin');
Route::resource('/admin/aboutus', 'PostingController')->middleware('auth:admin');
//Untuk Login
Route::get('/login', 'LoginController@index')->middleware('guest');
Route::post('/login', 'LoginController@postLogin')->name('login.submit');
Route::get('/registration', 'LoginController@registration');
Route::post('/post-registration', 'LoginController@postRegistration'); 
Route::get('/dashboard', 'LoginController@dashboard'); 
Route::get('/logout', 'LoginController@logout');