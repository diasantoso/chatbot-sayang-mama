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
Route::post('doLogin', 'UserController@doLogin')->name('doLogin');
Route::post('doLogout', 'UserController@doLogout')->name('doLogout');

//prodi

Route::get('Prodi', 'ProdiController@index')->name('prodi.index');
Route::post('Prodi.store', 'ProdiController@store')->name('prodi.store');
Route::patch('Prodi.update', 'ProdiController@update')->name('prodi.update');
Route::get('Prodi.delete/{id}', 'ProdiController@destroy')->name('prodi.delete');

//sesi

Route::get('sesi-index', 'SesiController@index')->name('sesi.index');
Route::get('sesi-create', 'SesiController@create')->name('sesi.create');
Route::post('sesi-store', 'SesiController@store')->name('sesi.store');
Route::get('sesi-edit/{id}', 'SesiController@edit')->name('sesi.edit');
Route::patch('sesi-update/{id}', 'SesiController@update')->name('sesi.update');
Route::get('sesi-delete/{id}', 'SesiController@destroy')->name('sesi.destroy');
Route::get('sesiTerhapus-restore/{id}', 'SesiController@terhapusRestore')->name('sesiTerhapus.restore');


//makul

Route::get('makul-index', 'MakulController@index')->name('makul.index');
Route::get('makul-create', 'MakulController@create')->name('makul.create');
Route::post('makul-store', 'MakulController@store')->name('makul.store');
Route::get('makul-edit/{id}', 'MakulController@edit')->name('makul.edit');
Route::patch('makul-update/{id}', 'MakulController@update')->name('makul.update');
Route::get('makul-delete/{id}', 'MakulController@destroy')->name('makul.destroy');
Route::get('makulTerhapus-restore/{id}', 'MakulController@terhapusRestore')->name('makulTerhapus.restore');


//fakultas

Route::get('fakultas-index', 'FakultasController@index')->name('fakultas.index');
Route::get('fakultas-store/{input}', 'FakultasController@store')->name('fakultas.store');
Route::get('fakultas-update/{id}/{input}', 'FakultasController@update')->name('fakultas.update');
Route::get('fakultas-delete/{id}', 'FakultasController@destroy')->name('fakultas.destroy');

Route::get('fakultasTerhapus-restore/{id}', 'FakultasController@terhapusRestore')->name('fakultasTerhapus.restore');
Route::get('fakultasTerhapus-destroy/{id}', 'FakultasController@terhapusDestroy')->name('fakultasTerhapus.destroy');
