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
    Route::get('ketatalaksanaan', 'KetatalaksanaanController@index');
    Route::get('userketatalaksanaan', 'KetatalaksanaanController@datatable');
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
    Route::get('download_ketatalaksanaan/{key}', 'KetatalaksanaanController@downloadLampiran');


    Route::resource('user', 'UserController');
    //Route::resource('bantuanhukum', 'BantuanHukumController');
    Route::resource('forget', 'ForgetPasswordController@index');
    
    Route::resource('document', 'DocumentController');
    Route::get('adddoc', 'DocumentController@add');
    Route::post('savedoc','DocumentController@save');
    Route::get('tabledoc', 'DocumentController@datatable');
     
    Route::get('callcenter', 'CallCenterController@index');

    Route::get('detailprofile', 'ProfileController@show');

    Route::group(array("prefix" => "produkhukum"), function(){
        Route::get('/', 'ProdukHukumController@index');
        Route::get('{id}/detail', array('as' => 'detail_produkhukum', 'uses' => 'ProdukHukumController@detail'));
        Route::get('{id}/download', 'ProdukHukumController@downloadLampiran');
        Route::get('tableph', 'ProdukHukumController@datatable');
    });

    Route::group(array("prefix" => "puu"), function(){
        Route::resource('puu', 'PeruuController');
    });

    //news
    Route::get('news', 'NewsController@index');
    //pelembagaan
    Route::group(array("prefix" => "pelembagaan"), function(){
        Route::get('/', 'PelembagaanController@index');
        Route::get('{id}/download', 'PelembagaanController@downloadLampiran');
        Route::get('printTable', array("as" => "pelembagaan.printTable", "uses" => "PelembagaanController@printTable"));
    });
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
   // berita
    Route::resource('berita', 'BeritaController');
    Route::get('IndexBerita', 'BeritaController@index');
    Route::get('HomeBerita', 'BeritaController@home');
    Route::put('saveberita', 'BeritaController@save');

    // Route::resource('layanan', 'LayananController');
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

    //Managemen Menu
    Route::resource('menu', 'MenuController');
    Route::get('create_menu', 'MenuController@create');
    Route::get('index_menu', 'MenuController@index');
    Route::get('setting_menu', 'MenuController@setting');
    Route::get('table_menu', 'MenuController@datatable');
    // Route::put('setting/save', 'MenuController@save');

    //Managemen Submenu
    Route::resource('submenu', 'SubmenuController');
    Route::get('create_submenu', 'SubmenuController@create');
    Route::get('index_submenu', 'SubmenuController@index');
    Route::get('setting_submenu', 'SubmenuController@setting');
    // Route::put('settings/save', 'SubmenuController@save');

    //Managemen Link
    Route::resource('linked', 'DikbudController');
    Route::post('savelinked', 'DikbudController@save');
    Route::post('updatelinked', 'DikbudController@update');

    Route::get('subbagians', 'AdminController@subbagian');

    //dokumentasi
    Route::resource('document', 'DocumentController');
    Route::get('adddoc', 'DocumentController@add');
    Route::get('detaildoc/{key}', 'DocumentController@detail');
    Route::get('editdoc/{key}', 'DocumentController@edit');
    Route::get('publishdoc/{key}', 'DocumentController@publish');
    Route::get('deletedoc/{key}', 'DocumentController@delete');
    Route::post('savedoc','DocumentController@save');
    Route::put('updatedoc/{key}','DocumentController@update');
    Route::get('tabledoc', 'DocumentController@datatable');

    //Managemen Profile
    Route::resource('profile', 'ProfileController');
    Route::post('saveprofile', 'ProfileController@save');
    Route::post('updateprofile', 'ProfileController@update');

    //Managemen Ketatalaksanaan
    Route::resource('ketatalaksanaan', 'KetatalaksanaanController');
    Route::post('saveketatalaksanaan', 'KetatalaksanaanController@store');
    Route::post('updateprofile', 'KetatalaksanaanController@update');
    Route::get('tableketatalaksanaan', 'KetatalaksanaanController@datatable');
    Route::get('addketatalaksanaan', 'KetatalaksanaanController@create');
    Route::get('editketatalaksanaan/{key}', 'KetatalaksanaanController@edit');
    Route::get('deleteketatalaksanaan/{key}', 'KetatalaksanaanController@delete');
    Route::get('downloadketatalaksanaan/{key}', 'KetatalaksanaanController@downloadLampiran');
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



// // ################
// //pengaturan route pelembagaan sisi ADMIN
// Route::group(array('prefix' => 'pelembagaan', 'before' => 'auth|pelembagaan'), function() {
//     Route::get('/', function() {
//         return "Hello World";
//     });

//     Route::resource('account', 'AdminController');
//     Route::get('/', 'AdminController@index');
//     Route::get('Home', 'AdminController@home');
//     Route::get('setting', 'AdminController@setting');
//     Route::put('setting/save', 'AdminController@save');

//     Route::resource('pelembagaan', 'PelembagaanController');
//     Route::get('index_pelembagaan', 'PelembagaanController@index');
// //    Route::get('/', array('as' => 'index_pelembagaan', 'uses' =>  'PelembagaanController@index'));
//     Route::get('{id}/update', array('as' => 'update_pelembagaan', 'uses' =>  'PelembagaanController@edit'));
//     Route::post('update', array('as' => 'proses_update_pelembagaan', 'uses' =>  'PelembagaanController@update'));
//     Route::get('print', array('as' => 'print_pelembagaan', 'uses' => 'PelembagaanController@printTable'));
//     Route::get('{id}/download', "PelembagaanController@downloadLampiran");

//     //     Per UU

//     //bantuan hukum
// });

// ########

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


Route::resource("sp", 'SistemDanProsedurController', array("only" => array("index")));    
Route::resource("aj", "AnalisisJabatanController", array("only" => array("index")));
Route::resource("puu", "PeruuController", array("only" => array("index", "update")));
Route::resource("pelembagaan", "PelembagaanController", array("only" => array("index", "printTable"))); 
Route::resource('bantuan_hukum', 'BantuanHukumController', array("only" => array("index")));
Route::group(array('before' => 'auth'), function(){
    Route::resource("sp", 'SistemDanProsedurController', array("only" => array("create", "store")));    
    Route::resource("aj", "AnalisisJabatanController", array("only" => array("create", "store")));
    Route::resource('puu', 'PeruuController', array("only" => array("create", "store")));
    Route::resource('pelembagaan', "PelembagaanController", array("only" => array("create", "store", "index")));
    Route::resource('bantuan_hukum', "BantuanHukumController", array("only" => array("create", "store", "index")));
    Route::group(array("prefix" => "admin"), function() {
        Route::get('/', array("as" => "admin.index", "uses" => "AdminController@home"));
        Route::get('setting', array("as" => "admin.setting", "uses" => "AdminController@setting"));
        Route::put('setting/save', array("as" => "admin.setting.save", "uses" => 'AdminController@save'));
        Route::get('logout', array("as" => "admin.logout", "uses" => "LoginController@signout"));
        Route::get('cetakLaporan', array("as" => "admin.cetakLaporan", "uses" => "AdminController@cetakLaporan"));
        Route::post('enableForum', "AdminController@enableForum");

	Route::get('sp/log/download/{id}', array('as' => "admin.sp.log.download", 'uses' => 'SistemDanProsedurController@downloadLogLampiran'));
        Route::get('sp/printTable', array('as' => 'admin.sp.printTable', 'uses' => 'SistemDanProsedurController@printTable'));
        Route::resource("sp", "SistemDanProsedurController", array("except" => array("create", "store")));

	Route::get('aj/log/download/{id}', array('as' => 'admin.aj.log.download', 'uses' => 'AnalisisJabatanController@downloadLampiranLog'));
        Route::get('aj/printTable', array('as' => 'admin.aj.printTable', 'uses' => 'AnalisisJabatanController@printTable'));
        Route::resource("aj", "AnalisisJabatanController", array("except" => array("create", "store")));

	Route::get('puu/log/download/{id}', array('as' => 'admin.puu.log.download', 'uses' => 'PeruuController@downloadLampiranLog'));
        Route::get('puu/printTable', array("as" => "admin.puu.printTable", "uses" => "PeruuController@printTable"));
        Route::resource('puu', 'PeruuController', array("except" => array("create", "store")));

        Route::get('pelembagaan/printTable', array("as" => "admin.pelembagaan.printTable", "uses" => "PelembagaanController@printTable"));
        Route::resource('pelembagaan', 'PelembagaanController', array("create", "store", "update", "edit", "index"));
        Route::get('pelembagaan/log/download/{id}', 'PelembagaanController@downloadLampiranLog');
        Route::get('pelembagaan/{id}/update', 'PelembagaanController@edit');
        Route::get('pelembagaan/deletelog/{id}', 'PelembagaanController@deleteLog');
        Route::post('update', array('as' => 'proses_update_pelembagaan_admin', 'uses' =>  'PelembagaanController@update'));
        Route::resource('account', 'AdminController');

        Route::get('bantuan_hukum/datatable','BantuanHukumController@datatable');
        Route::get('bantuan_hukum/detail/{id}', 'BantuanHukumController@detail');
        Route::get('bantuan_hukum/tablelog', 'BantuanHukumController@tablelog');
        Route::get('bantuan_hukum/delete/{id}', 'BantuanHukumController@delete');
        Route::get('bantuan_hukum/delete_log/{id}', 'BantuanHukumController@deletelog');
        Route::post('bantuan_hukum/convertpdf', 'BantuanHukumController@convertpdf');
	Route::get('bantuan_hukum/log/download/{id}', 'BantuanHukumController@downloadLampiranLog');
        Route::resource('bantuan_hukum', 'BantuanHukumController');
    });
});
Route::get('aj/download/{id}', array('as' => 'aj.download', 'uses' => 'AnalisisJabatanController@download'));
Route::get('sp/download/{id}/{index?}', array('as' => "sp.download", "uses" => 'SistemDanProsedurController@download'));
Route::get('puu/download/{id}/{index?}', array('as' => 'puu.download', 'uses' => 'PeruuController@download'));
Route::get('pelembagaan/download/{id}/{index?}', array('as' => 'pelembagaan.download', 'uses' => 'PelembagaanController@download' ) );
//Route::get('pelembagaan/{id}/download', 'PelembagaanController@downloadLampiran');
Route::get('pelembagaan/printTable', array("as" => "pelembagaan.printTable", "uses" => "PelembagaanController@printTable"));
Route::get('bantuan_hukum/download/{id}', array('as' => 'bantuan_hukum.download', 'uses' => 'BantuanHukumController@download'));
Route::get('bantuan_hukum/datatable','BantuanHukumController@datatable');
Route::get('pelembagaan/printTable', array("as" => "pelembagaan.printTable", "uses" => "PelembagaanController@printTable"));
Route::get('bantuan_hukum/detail/{id}', 'BantuanHukumController@detail');
Route::get('bantuan_hukum/tablelog', 'BantuanHukumController@tablelog');
Route::get('bantuan_hukum/delete/{id}', 'BantuanHukumController@delete');
Route::get('bantuan_hukum/delete_log/{id}', 'BantuanHukumController@deletelog');
Route::post('bantuan_hukum/convertpdf', 'BantuanHukumController@convertpdf');
Route::get('bantuan_hukum/log/download/{id}', 'BantuanHukumController@downloadLampiranLog');
Route::resource('bantuan_hukum', 'BantuanHukumController');

Route::get('pelembagaan/printTable', array("as" => "admin.pelembagaan.printTable", "uses" => "PelembagaanController@printTable"));

Route::get('pelembagaan/log/download/{id}', 'PelembagaanController@downloadLampiranLog');
Route::get('pelembagaan/{id}/update', 'PelembagaanController@edit');
Route::get('pelembagaan/deletelog/{id}', 'PelembagaanController@deleteLog');
Route::post('pelembagaan_update', array('as' => 'proses_update_pelembagaan', 'uses' =>  'PelembagaanController@update'));
Route::resource('pelembagaan', 'PelembagaanController', array("create", "store", "update", "edit", "index"));
