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
    Route::get('registrasi', 'RegistrasiController@form');
	Route::post('Kirim', 'RegistrasiController@send');
	Route::get('/', 'HomeController@index');
	Route::get('error', 'LoginController@error');
	Route::get('manual_registrasi', 'HomeController@download_manual');

    Route::get('tabelbahu', 'BantuanHukumController@datatable');
    Route::get('add', 'BantuanHukumController@add');
    Route::post('save', 'BantuanHukumController@save');

    Route::resource('user', 'UserController');
    Route::resource('bantuanhukum', 'BantuanHukumController');
});

Route::group(array('before' => 'auth'), function(){
//    Route::get('BantuanHukum', 'BantuanHukumController@index');
	Route::get('LihatLampiran', 'RegistrasiController@lihatLampiran');
	Route::get('DownloadLampiran', 'VerifikasiController@downloadLampiran');
	Route::get('setting', 'RegistrasiController@setting');
	Route::put('setting/save', 'RegistrasiController@save');
	Route::get('Keluar', 'LoginController@signout');
	Route::get('download', 'RegistrasiController@download');
	Route::get('pdf', 'VerifikasiController@MakePDF');
	Route::get('excel', 'VerifikasiController@MakeExcel');
	Route::get('getProvinsi', 'ApiController@getProvinsi');
	Route::get('getBpnb', 'ApiController@getBpnb');
	Route::post('saveBpnb', 'ApiController@saveBpnb');
	Route::get('finalisasi', 'RegistrasiController@finalisasi');
});

Route::group(array('before' => 'auth|user'), function(){
	Route::get('edit', 'RegistrasiController@edit');
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

Route::group(array('prefix' => 'admin', 'before' => 'auth|admin_center'), function()
{
	Route::get('/', function(){return "Hello World";});

	Route::get('Verifikasi', 'VerifikasiController@index');
	Route::get('Datatable', 'VerifikasiController@datatable');
	Route::get('Detail', 'VerifikasiController@detail');
	Route::post('VerifikasiUser', 'VerifikasiController@verifikasi');
	Route::get('Profile', 'VerifikasiController@downloadProfile');
	
	Route::resource('region', 'RegionController');
	Route::resource('provinsi', 'ProvinsiController');
	Route::resource('account', 'AdminController');
	Route::resource('bpnb', 'BpnbController');

	//
	Route::get('estimasi_pendaftaran', 'EstimasiPendaftaranController@estimasi_pendaftaran');
	Route::post('SaveEstimasi', 'EstimasiPendaftaranController@send');
	Route::post('UpdateEstimasi', 'EstimasiPendaftaranController@update');
});

// Routing Per-UU
//Route::get('per-uu', array("as" => "UsulanPerUU", "uses" => "PeruuController@pengajuanUsulan"));
//Route::post('per-uu', array("as" => "prosesPengajuan", "uses" => "PeruuController@prosesPengajuan"));

// Routing Pelembagaan
Route::get('usulan-pelembagaan', array("as" => "UsulanPelembagaan", "uses" => "PelembagaanController@pengajuanUsulan"));
Route::post('usulan-pelembagaan', array("as" => "prosesPengajuan", "uses" => "PelembagaanController@prosesPengajuan"));

Route::get('usulan-list', array("as" => "ListUsulanPelembagaan", "uses" => "PelembagaanController@listUsulan"));

    Route::get('tabelpelembagaan', 'PelembagaanController@datatable');



/*
Route::group(array('prefix' => 'pelembagaan'), function()
{
	Route::get('/', 'PelembagaanController@index');

        Route::get('usulan', 'PelembagaanController@pengajuanUsulan');
        Route::post('ver', 'PelembagaanController@prosesPengajuan');
 	
//	Route::get('usulan', array("as" => "UsulanPelembagaan", "uses" => "PelembagaanController@pengajuanUsulan"));
//	Route::post('usulan', array("as" => "ProsesPelembagaan", "uses" => "PelembagaanController@prosesPengajuan"));
});

*/




