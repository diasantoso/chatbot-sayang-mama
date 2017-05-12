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
    return view('user/landingpage');
});




//user
Route::get('User', 'UserController@index')->name('user.index');
Route::post('User.store', 'UserController@store')->name('user.store');
Route::post('Admin.store', 'UserController@storeadmin')->name('admin.store');
Route::patch('User.update', 'PegawaiController@update')->name('user.update');
Route::get('User.delete/{id}', 'UserController@destroy')->name('user.delete');


//prodi

Route::get('Prodi', 'ProdiController@index')->name('prodi.index');
Route::post('Prodi.store', 'ProdiController@store')->name('prodi.store');
Route::patch('Prodi.update', 'ProdiController@update')->name('prodi.update');
Route::get('Prodi.delete/{id}', 'ProdiController@destroy')->name('prodi.delete');