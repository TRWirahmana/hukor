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
Route::group(array('before' => 'guest'), function() {
    Route::get('BantuanHukum', 'BantuanHukumController@index');
    Route::post('Masuk', 'LoginController@signin'); // Registrasi
    Route::post('Reset', 'ForgetPasswordController@reset'); // Reset Password
    Route::get('registrasi', 'RegistrasiController@form');
	Route::post('Kirim', 'RegistrasiController@send');
	Route::get('/', 'HomeController@index');
    Route::get('admin/login', 'HomeController@adminlogin');
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
    Route::get('download_banhuk', 'BantuanHukumController@download');
    Route::get('log_banhuk', 'BantuanHukumController@tablelog');


    Route::resource('user', 'UserController');
    Route::resource('bantuanhukum', 'BantuanHukumController');
    Route::resource('forget', 'ForgetPasswordController@index');

//    Route::resource('account', 'AdminController');
//    Route::resource('pelembagaan', 'PelembagaanController');   
//    Route::resource('callcenter','CallCenterController');
//
//    Route::resource('callcenter', 'CallCenterController');
    Route::get('callcenter', 'CallCenterController@index');

    Route::group(array("prefix" => "pelembagaan"), function(){
        Route::get('print', array('as' => 'print_table_pelembagaan', 'uses' => 'PelembagaanController@printTable'));
        Route::get('{id}/download', "PelembagaanController@downloadLampiran");
    });
    
});


Route::group(array('before' => 'auth'), function() {
//    Route::get('BantuanHukum', 'BantuanHukumController@index');
    Route::get('LihatLampiran', 'RegistrasiController@lihatLampiran');
    Route::get('DownloadLampiran', 'VerifikasiController@downloadLampiran');
    Route::get('setting', 'RegistrasiController@setting');
    Route::put('setting/save', 'RegistrasiController@save');
    Route::get('Keluar', 'LoginController@signout');
    Route::get('download', 'RegistrasiController@download');
});

Route::group(array('before' => 'auth|user'), function() {
//	Route::get('home', 'HomeController@index');
//    Route::get('BantuanHukum', 'BantuanHukumController@index');
    Route::post('update', 'RegistrasiController@update');
});

Route::group(array('prefix' => 'admin', 'before' => 'auth|super_admin'), function() {
    Route::get('/', function() {
        return "Hello World";
    });

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

// call center
    Route::resource('callcenter', 'CallCenterController');
//    Route::get('indexcallcenter', 'CallCenterController@index');
    Route::get('editcallcenter', 'CallCenterController@home');
    Route::put('updatecallcenter', 'CallCenterController@update');

    // Per UU
    Route::group(array("prefix" => "per_uu"), function() {
        Route::get('/', array('as' => 'index_per_uu', 'uses' => 'PeruuController@index'));
        Route::get('update/{id}', array('as' => 'update_per_uu', 'uses' => 'PeruuController@updateUsulan'));
        Route::get('download/{id}', "PeruuController@downloadLampiran");
        Route::post('update', array('as' => 'proses_update_per_uu', 'uses' => 'PeruuController@prosesUpdateUsulan'));
        Route::post('delete', array('as' => 'hapus_usulan', 'uses' => 'PeruuController@hapusUsulan'));
        Route::get('print', array('as' => 'print_table', 'uses' => 'PeruuController@printTable'));
    });

    Route::group(array("prefix" => "ketatalaksanaan"), function() {
        Route::get('sistemDanProsedur', array("as" => "index_sistem_dan_prosedur", "uses" => "SistemDanProsedurController@indexSistemDanProsedur"));
        Route::get("updateSistemDanProsedur/{id}", array("as" => "update_status_dan_prosedur", "uses" => "SistemDanProsedurController@updateSistemDanProsedur"));
        Route::post('deleteSistemDanProsedur', array("as" => "delete_sistem_dan_prosedur", "uses" => "SistemDanProsedurController@deleteSistemDanProsedur"));
        Route::post('updateSistemDanProsedur', array("as" => "proses_update_sistem_dan_prosedur", "uses" => "SistemDanProsedurController@prosesUpdateSistemDanProsedur"));
        Route::get('downloadSistemDanProsedur/{id}', array('as' => 'download_sistem_dan_prosedur', 'uses' => "SistemDanProsedurController@downloadSistemDanProsedur"));
        Route::get('printSistemDanProsedur', array('as' => 'print_sistem_dan_prosedur', 'uses' => 'SistemDanProsedurController@printSistemDanProsedur'));

        Route::group(array("prefix" => "analisisJabatan"), function(){
            Route::get('/', array("as" => "index_analisis_jabatan", "uses" => "AnalisisJabatanController@index"));
            Route::get('print', array("as" => "print_analisis_jabatan", "uses" => "AnalisisJabatanController@printTable"));
            Route::get('download/{id}', "AnalisisJabatanController@downloadLampiran");
            Route::post('delete', array('as' => 'hapus_analisis_jabatan', 'uses' => 'AnalisisJabatanController@hapusUsulan'));
            Route::get('update/{id}', array("as" => "update_analisis_jabatan", "uses" => "AnalisisJabatanController@update"));
            Route::post('update', array("as" => "proses_update_analisis_jabatan", "uses" => "AnalisisJabatanController@prosesUpdate"));
        });
    });


    Route::resource('pelembagaan', 'PelembagaanController');   
    
    Route::group(array("prefix" => "pelembagaan"), function(){
        Route::get('print', array('as' => 'print_table_pelembagaan', 'uses' => 'PelembagaanController@printTable'));
        Route::get('{id}/download', "PelembagaanController@downloadLampiran");
    });

    //Managemen Menu
    Route::resource('menu', 'MenuController');
    Route::get('create_menu', 'MenuController@create');
    Route::get('index_menu', 'MenuController@index');
    Route::get('setting_menu', 'MenuController@setting');
    Route::put('setting/save', 'MenuController@save');

});


Route::group(array('prefix' => 'admin/layanankelembagaan', 'before' => 'auth|super_admin'), function() {
    Route::get('/', function() {
        return "Hello World";
    });

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

Route::group(array('prefix' => 'admin/layananketatalaksanaan', 'before' => 'auth|super_admin'), function() {


    Route::resource('ketatalaksanaan', 'LayananKetatalaksanaanController');

    //spm
    Route::get('edit_spk', 'LayananKetatalaksanaanController@create_spk');

    //smm
    Route::get('edit_smm', 'LayananKetatalaksanaanController@create_smm');

    //analisis jabatan
    Route::get('edit_analisis_jabatan', 'LayananKetatalaksanaanController@create_analisis_jabatan');

    //analisis pbk
    Route::get('edit_pbk', 'LayananKetatalaksanaanController@create_pbk');

    //tata nilai
    Route::get('edit_tata_nilai', 'LayananKetatalaksanaanController@create_tata_nilai');

    //tata pelayanan publik
    Route::get('edit_pelayanan_publik', 'LayananKetatalaksanaanController@create_pelayanan_publik');

    // tnd
    Route::get('edit_tnd', 'LayananKetatalaksanaanController@create_tnd');
});

Route::group(array('prefix' => 'per-uu'), function() {
    Route::get('usulan', array('as' => 'pengajuan_per_uu', 'uses' => 'PeruuController@pengajuanUsulan'));
    Route::post('usulan', array('as' => 'proses_pengajuan', 'uses' => 'PeruuController@prosesPengajuan'));
});

Route::group(array('prefix' => "ketatalaksanaan"), function(){
    Route::get('usulanSistemProsedur', array("as" => "usulan_sistem_prosedur", "uses" => "SistemDanProsedurController@usulanSistemProsedur"));
    Route::post('usulanSistemProsedur', array("as" => "proses_usulan_sistem_prosedur", "uses" => "SistemDanProsedurController@prosesUsulanSistemProsedur"));
    Route::get('usulanAnalisisJabatan', array("as" => "usulan_analisis_jabatan", "uses" => "AnalisisJabatanController@usulan"));
    Route::post('usulanAnalisisJabatan', array("as" => "proses_analisis_jabatan", "uses" => "AnalisisJabatanController@prosesUsulan"));
});


Route::group(array('prefix' => 'pelembagaan'), function() {
    Route::get('informasi', array('as' => 'informasi_pelembagaan', 'uses' => 'PelembagaanController@index'));
    Route::get('usulan', array('as' => 'create_pelembagaan', 'uses' => 'PelembagaanController@create'));
    Route::post('usulan', array('as' => 'store_pelembagaan', 'uses' => 'PelembagaanController@store'));
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


Route::get('forumdiskusi', "HomeController@showForum");
