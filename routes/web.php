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

Route::get('dashboard.admin', function () {

    return view('dashboard');
    })->name('dashboard.admin');

Route::get('dashboard.mahasiswa', function () {

    })->name('dashboard.mahasiswa');

//LINE Bot
Route::post('line-updates', 'BotController@updates')->name('linebot.updates');
Route::get('test-cron', 'BotController@test')->name('test.cron');

//user
Route::get('User', 'UserController@index')->name('user.index');
Route::post('User.store', 'UserController@store')->name('user.store');
Route::post('Admin.store', 'UserController@storeadmin')->name('admin.store');
Route::patch('User.update', 'UserController@update')->name('user.update');
Route::patch('User.updateadmin', 'UserController@updateadmin')->name('user.updateadmin');
Route::get('User.delete/{id}', 'UserController@destroy')->name('user.delete');
Route::get('User.aktifkan/{id}', 'UserController@aktifkan')->name('user.aktifkan');



//prodi

Route::get('Prodi', 'ProdiController@index')->name('prodi.index');
Route::post('Prodi.store', 'ProdiController@store')->name('prodi.store');
Route::get('Prodi-edit/{id}', 'ProdiController@edit')->name('prodi.edit');
Route::patch('Prodi.update/{id}', 'ProdiController@update')->name('prodi.update');
Route::get('Prodi.delete/{id}', 'ProdiController@destroy')->name('prodi.delete');


  Route::get('prodiTerhapus-restore/{id}', 'ProdiController@terhapusRestore')->name('prodiTerhapus.restore');
  Route::get('prodiTerhapus-destroy/{id}', 'ProdiController@terhapusDestroy')->name('prodiTerhapus.destroy');

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
Route::patch('makul-update', 'MakulController@update')->name('makul.update');
Route::get('makul-delete/{id}', 'MakulController@destroy')->name('makul.destroy');
Route::get('makulTerhapus-restore/{id}', 'MakulController@terhapusRestore')->name('makulTerhapus.restore');


//fakultas

Route::get('fakultas-index', 'FakultasController@index')->name('fakultas.index');
Route::get('fakultas-store/{input}', 'FakultasController@store')->name('fakultas.store');
Route::get('fakultas-update/{id}/{input}', 'FakultasController@update')->name('fakultas.update');
Route::get('fakultas-delete/{id}', 'FakultasController@destroy')->name('fakultas.destroy');

Route::get('fakultasTerhapus-restore/{id}', 'FakultasController@terhapusRestore')->name('fakultasTerhapus.restore');
Route::get('fakultasTerhapus-destroy/{id}', 'FakultasController@terhapusDestroy')->name('fakultasTerhapus.destroy');

//login
Route::get('login.index', 'LoginController@index')->name('login.index');
Route::get('register.index', 'LoginController@register')->name('login.register');
Route::post('doLogin', 'LoginController@doLogin')->name('doLogin');
Route::get('doLogout', 'LoginController@doLogout')->name('doLogout');
Route::get('admindashboard', 'LoginController@admindashboard')->name('admindashboard');


//jadwal

Route::get('jadwal-index', 'JadwalController@index')->name('jadwal.index');
Route::get('jadwal-create', 'JadwalController@create')->name('jadwal.create');
Route::post('jadwal-store', 'JadwalController@store')->name('jadwal.store');
Route::get('jadwal-edit/{id}', 'JadwalController@edit')->name('jadwal.edit');
Route::patch('jadwal-update/{id}', 'JadwalController@update')->name('jadwal.update');
Route::get('jadwal-delete/{id}', 'JadwalController@destroy')->name('jadwal.destroy');
Route::get('jadwalTerhapus-restore/{id}', 'JadwalController@terhapusRestore')->name('jadwalTerhapus.restore');

//jadwalTambahan

Route::get('jadwalTambahan-index', 'JadwalTambahanController@index')->name('jadwalTambahan.index');
Route::get('jadwalTambahan-create', 'JadwalTambahanController@create')->name('jadwalTambahan.create');
Route::post('jadwalTambahan-store', 'JadwalTambahanController@store')->name('jadwalTambahan.store');
Route::get('jadwalTambahan-edit/{id}', 'JadwalTambahanController@edit')->name('jadwalTambahan.edit');
Route::patch('jadwalTambahan-update/{id}', 'JadwalTambahanController@update')->name('jadwalTambahan.update');
Route::get('jadwalTambahan-delete/{id}', 'JadwalTambahanController@destroy')->name('jadwalTambahan.destroy');
Route::get('jadwalTambahanTerhapus-restore/{id}', 'JadwalTambahanController@terhapusRestore')->name('jadwalTambahanTerhapus.restore');

//Profil
Route::get('Profile-index', 'ProfileController@index')->name('Profile.index');
Route::patch('Profile-update/{id}', 'ProfileController@update')->name('Profile.update');
Route::patch('Profile-updatefoto/{id}', 'ProfileController@updateFoto')->name('Profile.updatefoto');
Route::patch('Profile-updatepass/{id}', 'ProfileController@updatePass')->name('Profile.updatepass');
