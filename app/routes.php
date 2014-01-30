<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Login / Logout
Route::group(array('before' => 'guest'), function(){
    Route::get('BantuanHukum', 'BantuanHukumController@index');
	Route::post('Masuk', 'LoginController@signin');// Registrasi
    Route::post('Reset', 'ForgetPasswordController@reset');// Reset Password
    Route::get('registrasi', 'RegistrasiController@form');
	Route::post('Kirim', 'RegistrasiController@send');
	Route::get('/', 'HomeController@index');
	Route::get('error', 'LoginController@error');
	Route::get('manual_registrasi', 'HomeController@download_manual');

    Route::get('tabelbahu', 'BantuanHukumController@datatable');
    Route::get('log_banhuk', 'BantuanHukumController@tablelog');
    Route::get('addbahu', 'BantuanHukumController@add');
    Route::get('detail_banhuk', 'BantuanHukumController@detail');
    Route::get('delete_banhuk', 'BantuanHukumController@delete');
    Route::post('save', 'BantuanHukumController@save');
    Route::post('banhuk_update', 'BantuanHukumController@update');


    Route::resource('user', 'UserController');
    Route::resource('bantuanhukum', 'BantuanHukumController');
    Route::resource('forget', 'ForgetPasswordController@index');

//    Route::resource('account', 'AdminController');
    Route::resource('pelembagaan', 'PelembagaanController');
    
});

Route::group(array('before' => 'auth'), function(){
//    Route::get('BantuanHukum', 'BantuanHukumController@index');
	Route::get('LihatLampiran', 'RegistrasiController@lihatLampiran');
	Route::get('DownloadLampiran', 'VerifikasiController@downloadLampiran');
	Route::get('setting', 'RegistrasiController@setting');
	Route::put('setting/save', 'RegistrasiController@save');
	Route::get('Keluar', 'LoginController@signout');
	Route::get('download', 'RegistrasiController@download');
});

Route::group(array('before' => 'auth|user'), function(){
//	Route::get('home', 'HomeController@index');
//    Route::get('BantuanHukum', 'BantuanHukumController@index');
	Route::post('update', 'RegistrasiController@update');
});


Route::group(array('prefix' => 'admreg', 'before' => 'auth|admin_region'), function()
{
	Route::get('Verifikasi', 'VerifikasiController@index');
	Route::get('Datatable', 'VerifikasiController@datatable');
	Route::get('Detail', 'VerifikasiController@detail');
	Route::post('VerifikasiUser', 'VerifikasiController@verifikasi');
	Route::get('Profile', 'VerifikasiController@downloadProfile');
});

Route::group(array('prefix' => 'admin', 'before' => 'auth|super_admin'), function()
{
	Route::get('/', function(){return "Hello World";});

	Route::resource('account', 'AdminController');
    Route::get('Index', 'AdminController@index');
    Route::get('Home', 'AdminController@home');
    Route::get('setting', 'AdminController@setting');
    Route::put('setting/save', 'AdminController@save');

    //Layanan Kelembagaan
    Route::get('layanankelembagaan/edit', 'LayananKelembagaanController@create');


});

Route::group(array('prefix' => 'per-uu'), function() {
	Route::get('/', array('as' => 'index_per_uu', 'uses' => 'PeruuController@index'));
	Route::get('usulan', array('as' => 'pengajuan_per_uu', 'uses' => 'PeruuController@pengajuanUsulan'));
	Route::post('usulan', array('as' => 'proses_pengajuan', 'uses' => 'PeruuController@prosesPengajuan'));
	Route::get('update/{id}', array('as' => 'update_per_uu', 'uses' => 'PeruuController@updateUsulan'));
	Route::post('update', array('as' => 'proses_update_per_uu', 'uses' => 'PeruuController@prosesUpdateUsulan'));
	Route::post('delete', array('as' => 'hapus_usulan', 'uses' => 'PeruuController@hapusUsulan'));
});

Route::group(array('prefix' => 'layanan_kelembagaan'), function() {
    Route::get('index', 'LayananKelembagaanController@index');
    Route::get('CreateInfo', 'LayananKelembagaanController@create');
    Route::post('SubmitBerita', 'LayananKelembagaanController@submit');
});

