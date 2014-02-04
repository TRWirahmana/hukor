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
    Route::get('delete_log_banhuk', 'BantuanHukumController@deletelog');
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

//    berita
    Route::resource('berita', 'BeritaController');
    Route::get('IndexBerita', 'BeritaController@index');
    Route::get('HomeBerita', 'BeritaController@home');
    Route::put('saveberita', 'BeritaController@save');

    // Per UU
    Route::group(array("prefix" => "per_uu"), function(){
        Route::get('/', array('as' => 'index_per_uu', 'uses' => 'PeruuController@index'));
        Route::get('update/{id}', array('as' => 'update_per_uu', 'uses' => 'PeruuController@updateUsulan'));
        Route::post('update', array('as' => 'proses_update_per_uu', 'uses' => 'PeruuController@prosesUpdateUsulan'));
        Route::post('delete', array('as' => 'hapus_usulan', 'uses' => 'PeruuController@hapusUsulan'));     
    });

});


Route::group(array('prefix' => 'admin/layanankelembagaan', 'before' => 'auth|super_admin'), function()
{
    Route::get('/', function(){return "Hello World";});

    Route::resource('account', 'AdminController');
    Route::get('Index', 'AdminController@index');
    Route::get('Home', 'AdminController@home');
    Route::get('setting', 'AdminController@setting');
    Route::put('setting/save', 'AdminController@save');

    //Layanan Kelembagaan
    Route::resource('layanankelembagaan', 'LayananKelembagaanController');
    Route::post('SubmitBerita', 'LayananKelembagaanController@submit');
    Route::get('edit_kelembagaan', 'LayananKelembagaanController@create');

//pembentukan
    Route::get('edit_pembentukan', 'LayananKelembagaanController@create_pembentukan');

//penataan
    Route::get('edit_penataan', 'LayananKelembagaanController@create_penataan');

//statuta
    Route::get('edit_statuta', 'LayananKelembagaanController@create_statuta');

//penutupan
    Route::get('edit_penutupan', 'LayananKelembagaanController@create_penutupan');

});

Route::group(array('prefix' => 'per-uu'), function() {
	Route::get('usulan', array('as' => 'pengajuan_per_uu', 'uses' => 'PeruuController@pengajuanUsulan'));
	Route::post('usulan', array('as' => 'proses_pengajuan', 'uses' => 'PeruuController@prosesPengajuan'));
});

Route::group(array('prefix' => 'layanan_kelembagaan'), function() {
    //index
    Route::get('index', 'LayananKelembagaanController@index');
    Route::get('pembentukan', 'LayananKelembagaanController@pembentukan');
    Route::get('penataan', 'LayananKelembagaanController@penataan');
    Route::get('penutupan', 'LayananKelembagaanController@penutupan');
    Route::get('statuta', 'LayananKelembagaanController@statuta');

    //proses
    Route::get('CreateInfo', 'LayananKelembagaanController@create');
    Route::post('SubmitBerita', 'LayananKelembagaanController@submit');

    //pembentukan
    //penataan
    //statuta
    //penutupan
});

Route::group(array('prefix' => 'layanan_ketatalaksanaan'), function() {
    Route::get('index', 'LayananKetatalaksanaanController@index');
    Route::get('spk', 'LayananKetatalaksanaanController@spk');
    Route::get('smm', 'LayananKetatalaksanaanController@smm');
    Route::get('analisis_jabatan', 'LayananKetatalaksanaanController@analisis_jabatan');
    Route::get('pbk', 'LayananKetatalaksanaanController@pbk');
    Route::get('tata_nilai', 'LayananKetatalaksanaanController@tata_nilai');
    Route::get('pelayanan_publik', 'LayananKetatalaksanaanController@pelayanan_publik');
    Route::get('tnd', 'LayananKetatalaksanaanController@tnd');

	Route::get('CreateInfo', 'LayananKetatalaksanaanController@create');
    Route::post('SubmitBerita', 'LayananKetatalaksanaanController@submit'); 
});

/*
Route::group(array('prefix' => 'spk'), function() {
    Route::get('index', 'SpkController@index');
    Route::get('CreateInfo', 'SpkController@create');
    Route::post('SubmitBerita', 'SpkController@submit'); 
});
*/


// Route::get('forumdiskusi', "HomeController@showForum");
