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
		Route::post('Masuk', 'LoginController@signin'); // signin user
		Route::post('SignIn', 'LoginController@signin_admin'); // Registrasi
		Route::post('Reset', 'ForgetPasswordController@reset'); // Reset Password
		Route::get('registrasi', 'RegistrasiController@form');
		Route::get('captcha', 'RegistrasiController@captcha');
		Route::post('Kirim', 'RegistrasiController@send');
		Route::get('/', 'HomeController@index');
		Route::get('site', 'HomeController@main_site');
		Route::get('admin/login', 'HomeController@adminlogin');
		Route::get('error', 'LoginController@error');
		Route::get('manual_registrasi', 'HomeController@download_manual');

		Route::get('download_banhuk', 'BantuanHukumController@download');
		Route::get('news/detail', 'NewsController@detail');
		Route::get('download_banhuk', 'BantuanHukumController@download');

		//bantuan hukum
		Route::group(array("prefix" => "bantuanhukum"), function(){
			Route::resource('bantuan_hukum', 'BantuanHukumController');
			Route::get('informasi',  array('as' => 'informasi_bahu', 'uses' => 'BantuanHukumController@index'));
			Route::get('tabelbahu', 'BantuanHukumController@datatable');
			Route::get('log_banhuk', 'BantuanHukumController@tablelog');
			Route::get('addbahu', array('as' => 'create_bahu', 'uses' => 'BantuanHukumController@add'));
			Route::get('detail_banhuk', 'BantuanHukumController@detail');
			Route::get('delete_banhuk', 'BantuanHukumController@delete');
			Route::get('delete_log_banhuk', 'BantuanHukumController@deletelog');
			Route::post('save',  array('as' => 'save_bahu', 'uses' => 'BantuanHukumController@save'));
			Route::post('convertpdf', 'BantuanHukumController@convertpdf');
			Route::post('banhuk_update', 'BantuanHukumController@update');
			Route::get('download_banhuk', 'BantuanHukumController@download');
			Route::get('log_banhuk', 'BantuanHukumController@tablelog');
			});

		Route::resource('user', 'UserController');
		Route::resource('bantuanhukum', 'BantuanHukumController');
		Route::resource('forget', 'ForgetPasswordController@index');

		Route::resource('document', 'DocumentController');
		Route::get('adddoc', 'DocumentController@add');
		Route::post('savedoc','DocumentController@save');
		Route::get('tabledoc', 'DocumentController@datatable');

		//  Route::resource('account', 'AdminController');

		Route::get('callcenter', 'CallCenterController@index');

		//    Route::resource('pelembagaan', 'PelembagaanController');   
		Route::group(array("prefix" => "pelembagaan"), function(){
				Route::get('print', array('as' => 'print_table_pelembagaan_guest', 'uses' => 'PelembagaanController@printTable'));
				Route::get('{id}/download', 'PelembagaanController@downloadLampiran');
				});

		Route::group(array("prefix" => "produkhukum"), function(){
				Route::get('/', 'ProdukHukumController@index');
				Route::get('{id}/detail', array('as' => 'detail_produkhukum', 'uses' => 'ProdukHukumController@detail'));
				Route::get('{id}/download', 'ProdukHukumController@downloadLampiran');
				});

		//news
		Route::get('news', 'NewsController@index');
});


Route::group(array('before' => 'auth'), function() {
		Route::get('LihatLampiran', 'RegistrasiController@lihatLampiran');
		Route::get('DownloadLampiran', 'VerifikasiController@downloadLampiran');
		Route::get('setting', 'RegistrasiController@setting');
		Route::put('setting/save', 'RegistrasiController@save');
		Route::get('Keluar', 'LoginController@signout');
		Route::get('download', 'RegistrasiController@download');
		});

Route::group(array('before' => 'auth|user'), function() {
		Route::post('update', 'RegistrasiController@update');

		});

//pengaturan route Role ADMIN
Route::group(array('prefix' => 'admin', 'before' => 'auth|super_admin'), function() {

		Route::post('/enableForum', "AdminController@enableForum");

		// Route::resource('account', 'AdminController');
		// Route::get('Index', 'AdminController@index');
		// Route::get('Home', 'AdminController@home');
		// Route::get('setting', 'AdminController@setting');
		// Route::put('setting/save', 'AdminController@save');

		// berita
		Route::resource('berita', 'BeritaController');
		Route::get('IndexBerita', 'BeritaController@index');
		Route::get('HomeBerita', 'BeritaController@home');
		Route::put('saveberita', 'BeritaController@save');

		//    Route::resource('layanan', 'LayananController');
		Route::resource('layanan', 'LayananController');
		Route::post('SubmitLayanan', 'LayananController@submit');

		Route::get('create_layanan', 'LayananController@create');
		Route::get('submenus', 'LayananController@submenu');
		Route::get('index_layanan', 'LayananController@index');

		// call center
		Route::resource('callcenter', 'CallCenterController');
		//    Route::get('indexcallcenter', 'CallCenterController@index');
		Route::get('editcallcenter', 'CallCenterController@home');
		Route::put('updatecallcenter', 'CallCenterController@update');

		// Per UU
		Route::group(array("prefix" => "per_uu"), function() {
				Route::get('/', array('as' => 'index_per_uu', 'uses' => 'PeruuController@index'));
				Route::get('index_per_uu', 'PeruuController@index');
				Route::get('/update/{id}', array('as' => 'update_per_uu', 'uses' => 'PeruuController@updateUsulan'));
				Route::post('update', array('as' => 'proses_update_per_uu', 'uses' => 'PeruuController@prosesUpdateUsulan'));
				Route::post('delete','PeruuController@hapusUsulan');
				});

		Route::resource('pelembagaan', 'PelembagaanController');           
		Route::group(array("prefix" => "pelembagaan"), function(){            
				//       Route::resource('pelembagaan', 'PelembagaanController');
				Route::get('/', 'PelembagaanController@index');
				Route::get('{id}/update', 'PelembagaanController@edit'); // array('as' => 'update_pelembagaan_admin', 'uses' =>  'PelembagaanController@edit'));
				Route::post('update', array('as' => 'proses_update_pelembagaan_admin', 'uses' =>  'PelembagaanController@update'));
				Route::post('delete', array('as' => 'hapus_usulan', 'uses' => 'PelembagaanController@drop'));
				Route::get('print', array('as' => 'print_pelembagaan', 'uses' => 'PelembagaanController@printTable'));
				Route::get('{id}/download', 'PelembagaanController@downloadLampiran');
				Route::post('deletelog/{id}', array('as' => 'deletelog_pelembagaan', 'uses' => 'PelembagaanController@deleteLog'));
		});

		//Managemen Menu
		Route::resource('menu', 'MenuController');
		Route::get('create_menu', 'MenuController@create');
		Route::get('index_menu', 'MenuController@index');
		Route::get('setting_menu', 'MenuController@setting');
		// Route::put('setting/save', 'MenuController@save');

		//bantuan hukum
		Route::group(array("prefix" => "bantuan_hukum"), function(){
				Route::resource('bantuan_hukum', 'BantuanHukumController');
				Route::get('/', 'BantuanHukumController@index');
				Route::get('tabelbahuadmin','BantuanHukumController@datatable');
				Route::get('log_banhuk', 'BantuanHukumController@tablelog');
				Route::get('addbahu', 'BantuanHukumController@add');
				Route::get('detail_banhuk', 'BantuanHukumController@detail');
				Route::get('delete_banhuk', 'BantuanHukumController@delete');
				Route::get('delete_log_banhuk', 'BantuanHukumController@deletelog');
				Route::post('save', 'BantuanHukumController@save');
				Route::post('convertpdf', 'BantuanHukumController@convertpdf');
				Route::post('banhuk_update', array("as" => "banhuk_update", "uses" =>  'BantuanHukumController@update'));
				Route::get('download_banhuk', 'BantuanHukumController@download');
				Route::get('log_banhuk', 'BantuanHukumController@tablelog');
				});

		//Managemen Submenu
		Route::resource('submenu', 'SubmenuController');
		Route::get('create_submenu', 'SubmenuController@create');
		Route::get('index_submenu', 'SubmenuController@index');
		Route::get('setting_submenu', 'SubmenuController@setting');
		// Route::put('settings/save', 'SubmenuController@save');
});


//pengaturan route Kepala Biro sisi ADMIN
Route::group(array('prefix' => 'kepala_biro', 'before' => 'auth|kepala_biro'), function() {
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

		//    Route::resource('layanan', 'LayananController');
		Route::resource('layanan', 'LayananController');
		Route::post('SubmitLayanan', 'LayananController@submit');

		Route::get('create_layanan', 'LayananController@create');
		Route::get('submenu', 'LayananController@submenu');
		Route::get('index_layanan', 'LayananController@index');

		// call center
		Route::resource('callcenter', 'CallCenterController');
		//    Route::get('indexcallcenter', 'CallCenterController@index');
		Route::get('editcallcenter', 'CallCenterController@home');
		Route::put('updatecallcenter', 'CallCenterController@update');

		// Per UU
		// Route::group(array("prefix" => "per_uu"), function() {
		//     Route::get('/', array('as' => 'index_per_uu', 'uses' => 'PeruuController@index'));
		//     Route::get('update/{id}', array('as' => 'update_per_uu', 'uses' => 'PeruuController@updateUsulan'));
		//     Route::get('download/{id}', "PeruuController@downloadLampiran");
		//     Route::post('update', array('as' => 'proses_update_per_uu', 'uses' => 'PeruuController@prosesUpdateUsulan'));
		//     Route::post('delete', array('as' => 'hapus_usulan', 'uses' => 'PeruuController@hapusUsulan'));
		//     Route::get('print', array('as' => 'print_table', 'uses' => 'PeruuController@printTable'));
		// });


		//Managemen Menu
		Route::resource('menu', 'MenuController');
		Route::get('create_menu', 'MenuController@create');
		Route::get('index_menu', 'MenuController@index');
		Route::get('setting_menu', 'MenuController@setting');
		Route::put('setting/save', 'MenuController@save');

});

//pengaturan route Bantuan Hukum sisi ADMIN
Route::group(array('prefix' => 'bantuan_hukum', 'before' => 'auth|bantuan_hukum'), function() {
		Route::get('/', function() {
			return "Hello World";
			});

		Route::resource('account', 'AdminController');
		Route::get('Index', 'AdminController@index');
		Route::get('Home', 'AdminController@home');
		Route::get('setting', 'AdminController@setting');
		Route::put('setting/save', 'AdminController@save');

		//bantuan hukum
		Route::resource('bantuan_hukum', 'BantuanHukumController');
		Route::get('/', 'BantuanHukumController@index');
		Route::get('tabelbahu', 'BantuanHukumController@datatable');
		Route::get('log_banhuk', 'BantuanHukumController@tablelog');
		Route::get('addbahu', 'BantuanHukumController@add');
		Route::get('detail_banhuk', 'BantuanHukumController@detail');
		Route::get('delete_banhuk', 'BantuanHukumController@delete');
		Route::get('delete_log_banhuk', 'BantuanHukumController@deletelog');
		Route::post('save', 'BantuanHukumController@save');
		Route::post('convertpdf', 'BantuanHukumController@convertpdf');
		Route::post('banhuk_update', 'BantuanHukumController@update');
		Route::get('download_banhuk', 'BantuanHukumController@download');
		Route::get('log_banhuk', 'BantuanHukumController@tablelog');

		//peruu
		Route::group(array("prefix" => "per_uu"), function() {
				Route::get('/', 'PeruuController@index');
				Route::get('update/{id}', array('as' => 'update_per_uu', 'uses' => 'PeruuController@updateUsulan'));
				Route::get('download/{id}', "PeruuController@downloadLampiran");
				Route::post('update', array('as' => 'proses_update_per_uu', 'uses' => 'PeruuController@prosesUpdateUsulan'));
				Route::post('delete', array('as' => 'hapus_usulan', 'uses' => 'PeruuController@hapusUsulan'));
				Route::get('print', array('as' => 'print_table', 'uses' => 'PeruuController@printTable'));
				});

		//pelembagaan
		Route::group(array("prefix" => "pelembagaan"), function(){
				Route::resource('pelembagaan', 'PelembagaanController');
				Route::get('/', array('as' => 'index_pelembagaan_admin', 'uses' => 'PelembagaanController@index'));
				//    Route::get('/', array('as' => 'index_pelembagaan', 'uses' =>  'PelembagaanController@index'));
				Route::get('{id}/update', array('as' => 'update_pelembagaan_admin', 'uses' =>  'PelembagaanController@edit'));
				Route::post('update', array('as' => 'proses_update_pelembagaan_bahu', 'uses' =>  'PelembagaanController@update'));
				Route::post('delete', array('as' => 'hapus_usulan', 'uses' => 'PelembagaanController@drop'));
				Route::get('print', array('as' => 'print_pelembagaan', 'uses' => 'PelembagaanController@printTable'));
				Route::get('{id}/download', 'PelembagaanController@downloadLampiran');
				Route::post('deletelog/{id}', array('as' => 'deletelog_pelembagaan', 'uses' => 'PelembagaanController@deleteLog'));

				});
		//Ketatalaksanaan

});

//pengaturan route pelembagaan sisi ADMIN
Route::group(array('prefix' => 'pelembagaan', 'before' => 'auth|pelembagaan'), function() {
		Route::get('/', function() {
			return "Hello World";
			});

		Route::resource('account', 'AdminController');
		Route::get('/', 'AdminController@index');
		Route::get('Home', 'AdminController@home');
		Route::get('setting', 'AdminController@setting');
		Route::put('setting/save', 'AdminController@save');

		Route::resource('pelembagaan', 'PelembagaanController');
		Route::get('index_pelembagaan', 'PelembagaanController@index');
		//    Route::get('/', array('as' => 'index_pelembagaan', 'uses' =>  'PelembagaanController@index'));
		Route::get('{id}/update', array('as' => 'update_pelembagaan', 'uses' =>  'PelembagaanController@edit'));
		Route::post('update', array('as' => 'proses_update_pelembagaan', 'uses' =>  'PelembagaanController@update'));
		Route::get('print', array('as' => 'print_pelembagaan', 'uses' => 'PelembagaanController@printTable'));
		Route::get('{id}/download', "PelembagaanController@downloadLampiran");
		Route::post('deletelog/{id}', array('as' => 'deletelog_pelembagaan', 'uses' => 'PelembagaanController@deleteLog'));


		//     Per UU
		Route::group(array("prefix" => "per_uu"), function() {
				Route::get('/', array('as' => 'index_per_uu', 'uses' => 'PeruuController@index'));
				Route::get('update/{id}', array('as' => 'update_per_uu', 'uses' => 'PeruuController@updateUsulan'));
				Route::get('download/{id}', "PeruuController@downloadLampiran");
				Route::post('update', array('as' => 'proses_update_per_uu', 'uses' => 'PeruuController@prosesUpdateUsulan'));
				Route::post('delete', array('as' => 'hapus_usulan', 'uses' => 'PeruuController@hapusUsulan'));
				Route::get('print', array('as' => 'print_table', 'uses' => 'PeruuController@printTable'));
				});

		//bantuan hukum
		Route::group(array("prefix" => "bantuan_hukum"), function(){
				Route::resource('bantuan_hukum', 'BantuanHukumController');
				Route::get('/', 'BantuanHukumController@index');
				Route::get('tabelbahu', 'BantuanHukumController@datatable');
				Route::get('log_banhuk', 'BantuanHukumController@tablelog');
				Route::get('addbahu', 'BantuanHukumController@add');
				Route::get('detail_banhuk', 'BantuanHukumController@detail');
				Route::get('delete_banhuk', 'BantuanHukumController@delete');
				Route::get('delete_log_banhuk', 'BantuanHukumController@deletelog');
				Route::post('save', 'BantuanHukumController@save');
				Route::post('convertpdf', 'BantuanHukumController@convertpdf');
				Route::post('banhuk_update', 'BantuanHukumController@update');
				Route::get('download_banhuk', 'BantuanHukumController@download');
				Route::get('log_banhuk', 'BantuanHukumController@tablelog');
				});


});

//Route::group(array('prefix' => 'admin/layanan', 'before' => 'auth|super_admin'), function() {
//    Route::get('/', function() {
//        return "Hello World";
//    });
//
//    Route::resource('account', 'AdminController');
////    Route::get('Index', 'AdminController@index');
////    Route::get('Home', 'AdminController@home');
////    Route::get('setting', 'AdminController@setting');
////    Route::put('setting/save', 'AdminController@save');
//
//    //Layanan Kelembagaan
//    Route::resource('layanan', 'LayananController');
//    Route::post('SubmitLayanan', 'LayananController@submit');
//
//    Route::get('create_layanan', 'LayananController@create');
//    Route::get('submenu', 'LayananController@submenu');
//    Route::get('index_layanan', 'LayananController@index');
//});

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
		Route::get('informasi', array('as' => 'per_uu.informasi', 'uses' => 'PeruuController@informasi'));
		});

Route::group(array('prefix' => 'pelembagaan'), function() {
		Route::get('informasi', array('as' => 'informasi_pelembagaan', 'uses' => 'PelembagaanController@index'));
		Route::get('usulan', array('as' => 'create_pelembagaan', 'uses' => 'PelembagaanController@create'));
		Route::post('usulan', array('as' => 'store_pelembagaan', 'uses' => 'PelembagaanController@store'));
		Route::get('print', array('as' => 'print_table_pelembagaan_user', 'uses' => 'PelembagaanController@printTable'));
		Route::get('{id}/download', 'PelembagaanController@downloadLampiran');
		Route::post('deletelog/{id}', array('as' => 'deletelog_pelembagaan', 'uses' => 'PelembagaanController@deleteLog'));

		});

Route::group(array('prefix' => 'layanan'), function() {
		//index
		Route::get('detail', 'LayananController@detail');
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


Route::group(array("prefix" => "admin", "before" => "auth|super_admin"), function(){
		Route::resource('categories', 'CategoriesController');
		});

//ROUTE ROLE KEPALA BAGIAN
Route::group(array("prefix" => "kepala_bagian", "before" => "auth|kepala_bagian"), function(){
		Route::get('/', "AdminController@dashboard");
		Route::resource('account', 'AdminController');
		Route::get('setting', 'AdminController@setting');
		Route::put('setting/save', 'AdminController@save');
		Route::get('cetakLaporan', array('as' => 'admin.cetakLaporan', 'uses' => 'AdminController@cetakLaporan'));

		Route::get('per_uu', array('as' => 'kepala_bagian.per_uu', 'uses' => 'PeruuController@index'));
		Route::get('per_uu/print', array('as' => 'kepala_bagian.per_uu.print', 'uses' => 'PeruuController@printTable'));
		Route::get('per_uu/download/{id}', "PeruuController@downloadLampiran");

		Route::get('pelembagaan', array("as" => "kepala_bagian.pelembagaan", 'uses' => "PelembagaanController@index"));
		Route::get('pelembagaan/print', array("as" => "kepala_bagian.pelembagaan.print", "uses" => "PelembagaanController@printTable"));
		Route::get('{id}/download', array('as' => 'kepala_bagian.pelembagaan.downloadLampiran', 'uses' => 'PelembagaanController@downloadLampiran'));

		//bantuan hukum
		Route::group(array("prefix" => "bantuan_hukum"), function(){
			Route::resource('bantuan_hukum', 'BantuanHukumController');
			Route::get('/', 'BantuanHukumController@index');
			Route::get('tabelbahu', array("as" => "get_tabel_bahu", 'uses' => 'BantuanHukumController@datatable'));
			Route::get('log_banhuk', 'BantuanHukumController@tablelog');
			Route::get('addbahu', 'BantuanHukumController@add');
			Route::get('detail_banhuk', 'BantuanHukumController@detail');
			Route::get('delete_banhuk', 'BantuanHukumController@delete');
			Route::get('delete_log_banhuk', 'BantuanHukumController@deletelog');
			Route::post('save', 'BantuanHukumController@save');
			Route::post('convertpdf', 'BantuanHukumController@convertpdf');
			Route::post('banhuk_update', 'BantuanHukumController@update');
			Route::get('download_banhuk', 'BantuanHukumController@download');
			Route::get('log_banhuk', 'BantuanHukumController@tablelog');
			});


});

//ROUTE ROLE KEPALA SUB BAGIAN
Route::group(array("prefix" => "kepala_subbagian", "before" => "auth|kepala_subbagian"), function(){
		Route::get('/', "AdminController@dashboard");
		Route::resource('account', 'AdminController');
		Route::get('setting', 'AdminController@setting');
		Route::put('setting/save', 'AdminController@save');
		Route::get('cetakLaporan', array('as' => 'admin.cetakLaporan', 'uses' => 'AdminController@cetakLaporan'));

		Route::get('per_uu', array('as' => 'kepala_subbagian.per_uu', 'uses' => 'PeruuController@index'));
		Route::get('per_uu/print', array('as' => 'kepala_subbagian.per_uu.print', 'uses' => 'PeruuController@printTable'));
		Route::get('per_uu/download/{id}', "PeruuController@downloadLampiran");

		Route::get('pelembagaan', array("as" => "kepala_subbagian.pelembagaan", 'uses' => "PelembagaanController@index"));
		Route::get('pelembagaan/print', array("as" => "kepala_subbagian.pelembagaan.print", "uses" => "PelembagaanController@printTable"));
		Route::get('{id}/download', array('as' => 'kepala_subbagian.pelembagaan.downloadLampiran', 'uses' => 'PelembagaanController@downloadLampiran'));

		//bantuan hukum
		Route::group(array("prefix" => "bantuan_hukum"), function(){
			Route::resource('bantuan_hukum', 'BantuanHukumController');
			Route::get('/', 'BantuanHukumController@index');
			Route::get('tabelbahu', 'BantuanHukumController@datatable');
			Route::get('log_banhuk', 'BantuanHukumController@tablelog');
			Route::get('addbahu', 'BantuanHukumController@add');
			Route::get('detail_banhuk', 'BantuanHukumController@detail');
			Route::get('delete_banhuk', 'BantuanHukumController@delete');
			Route::get('delete_log_banhuk', 'BantuanHukumController@deletelog');
			Route::post('save', 'BantuanHukumController@save');
			Route::post('convertpdf', 'BantuanHukumController@convertpdf');
			Route::post('banhuk_update', 'BantuanHukumController@update');
			Route::get('download_banhuk', 'BantuanHukumController@download');
			Route::get('log_banhuk', 'BantuanHukumController@tablelog');
			});


});



Route::resource("sp", 'SistemDanProsedurController', array("only" => array("index")));    
Route::resource("aj", "AnalisisJabatanController", array("only" => array("index")));
Route::resource("puu", "PeruuController", array("only" => array("index")));
Route::group(array('before' => 'auth'), function(){
		Route::resource("sp", 'SistemDanProsedurController', array("only" => array("create", "store")));    
		Route::resource("aj", "AnalisisJabatanController", array("only" => array("create", "store")));
		Route::resource('puu', 'PeruuController', array("only" => array("create", "store")));
		Route::group(array("prefix" => "admin"), function(){
			Route::get('/', array("as" => "admin.index", "uses" => "AdminController@home"));
			Route::get('setting', array("as" => "admin.setting", "uses" => "AdminController@setting"));
			Route::put('setting/save', array("as" => "admin.setting.save", "uses" => 'AdminController@save'));
			Route::get('logout', array("as" => "admin.logout", "uses" => "LoginController@signout"));

			Route::get('sp/printTable', array('as' => 'admin.sp.printTable', 'uses' => 'SistemDanProsedurController@printTable'));
			Route::resource("sp", "SistemDanProsedurController", array("except" => array("create", "store")));

			Route::get('aj/printTable', array('as' => 'admin.aj.printTable', 'uses' => 'AnalisisJabatanController@printTable'));
			Route::resource("aj", "AnalisisJabatanController", array("except" => array("create", "store")));

			Route::get('puu/printTable', array("as" => "admin.puu.printTable", "uses" => "PeruuController@printTable"));
			Route::resource('puu', 'PeruuController', array("create", "store"));

			Route::resource('account', 'AdminController');
			});
});
Route::get('aj/download/{id}', 'AnalisisJabatanController@downloadLampiran');
Route::get('sp/download/{id}', 'SistemDanProsedurController@downloadLampiran');
Route::get('puu/download/{id}', 'PeruuController@downloadLampiran');
