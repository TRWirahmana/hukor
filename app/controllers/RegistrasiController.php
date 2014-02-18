<?php

class RegistrasiController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Registrasi Controller
      |--------------------------------------------------------------------------
      |
      | Berisi fungsi-fungsi registrasi user (ANONYMOUS)
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.master';

    // displays user setting form
    public function setting() {
        $user = Auth::user();

        if(!is_null($user))
            $this->layout->content = View::make('registrasi.setting', array(
                'title' => 'Pengaturan Akun',
                'detail' => '',
                'form_opts' => array(
                    'url' => URL::to('setting/save'),
                    'method' => 'put',
                    'class' => 'form-horizontal'
                ),
                'user' => $user
            ));
    }

    // store user setting data
    public function save() {
       
        $input = Input::all();
        $user = Auth::user();
        $forumUser = ForumUser::find($user->id);
//        if ($registrasi->status == 1) {
//            return Redirect::to('edit')->with('error', 'Perubahan tidak bisa dilakukan.');
//        }


        $rules = array();
        $messages = array();

        if($input['username'] !== $user->username) {
            $rules['username'] = 'required|unique:registrasi|min:6';
            $messages['username.unique'] = 'Username tidak tersedia.';
            $messages['username.min'] = 'Username minimal 6 karakter.';

            $user->username = $input['username'];
            $forumUser->username = $input['username'];
        }

        if(!empty($input['password'])) {
            $rules['password'] = 'confirmed|min:6';
            $messages['password.confirmed'] = 'Konfirmasi password salah.';
            $messages['password.min'] = 'Password minimal 6 karakter.';

            $user->password = Hash::make($input['password']);
            $forumUser->password = pun_hash($input['password']);
        }


//        $validator = Validator::make($input, $rules, $messages);
//
//        if($validator->fails()) {
//            return Redirect::to('setting')->withErrors($validator)
//                ->withInput(Input::except('password'))
//                    ->with('error', 'Pengaturan gagal disimpan, mohon periksa kembali.');
//
//        }

        $user->save();
        $forumUser->save();


        if($user->role_id == 3){
            return Redirect::to('admin/account')->with('success', 'Pengaturan akun berhasil disimpan.');
        }else{
            return Redirect::to('/')->with('success', 'Pengaturan akun berhasil disimpan.');
        }

    }
	
	//handling for download template
	public function download(){
		
		$DAL = new DAL_PDF();
		$datas = $DAL->download_template();
		
		
		
		// $dompdf->stream("Formulir_pendaftaran.pdf");
		// Use this to output to the broswer
		// $dompdf->stream('Formulir_pendaftaran.pdf',array('Attachment'=>0));
		// Use this to download the file.
		
	}


    /**
     * Finalisasi data peserta.
     * 
     */
    public function finalisasi()
    {
        // peserta yang sedang aktif dan mencoba melakukan finalisasi.
        $registrasi = Auth::user();

        // user telah melakukan finalisasi
        if ($registrasi->status == 1)
            return Redirect::to('edit')
                ->with('error', 'Anda sudah melakukan finalisasi data. Hal ini tidak dapat dilakukan lagi.');

        // user telah melengkapi semua data pribadi
//        if($registrasi->user->getValidator()->passes())
//        {
//            $registrasi->status = 1;
//            $registrasi->save();
//            $msg =  "Finalisasi data berhasil. Anda dapat mengunduh berkas bukti pendaftaran dengan ".
//                    "cara klik pada tombol Unduh dibawah. Mohon tunggu untuk diverifikasi.";
//            return Redirect::to('edit')->with('success', $msg);
//        } else { // terdapat kesalahan pada formulir pendaftar, finalisasi tidak dapat dilakukan
//            $msg =  "Finalisasi data tidak dapat dilakukan karena terdapat " .
//                    "kesalahan terhadap informasi pribadi anda. Mohon cek kembali semua data pribadi anda.";
//            return Redirect::to('edit')->with('error', $msg);
//        }
    }
	
    public function edit() {

        $listProvinsi = array("" => "Pilih Provinsi") + Provinsi::lists("nama", "id");
        $listInstansi = array("" => "Pilih") + Instansi::where("jenis_instansi", '=', 1)->lists("nama", "id");
        $listKesatuan = array("" => "Pilih") + Instansi::where("jenis_instansi", '=', 2)->lists("nama", "id");

        $regid = Auth::user()->registrasi->id;

//        $uid = Auth::user()->id->get();


        $registrasi = Registrasi::find($regid)->where('user_id', Auth::user()->id)->first();

//        var_dump($registrasi->role_id);exit;

        $this->layout->content = View::make('registrasi.edit', array(
                    'date' => RetaneHelper::listDate(),
                    'month' => RetaneHelper::listMonth(),
                    'year' => RetaneHelper::listYear(date('Y') - 55, date('Y') - 15),
                    'year_pendidikan' => RetaneHelper::listYear(1980, date('Y')),
                    'year_karir' => RetaneHelper::listYear(1980, date('Y')),
                    'year_organisasi' => RetaneHelper::listYear(1970, date('Y')),
                    'year_prestasi' => RetaneHelper::listYear(1980, date('Y')),
                    'user' => $registrasi,
                    'listProvinsi' => $listProvinsi,
                    'listInstansi' => $listInstansi,
                    'listKesatuan' => $listKesatuan
        ));

    }

    public function update() {

        $inputs = Input::all();

//        $rules = array(
//            'biodata.nama_lengkap' => 'required',
//            // 'biodata.email' => 'required|email',
//            'biodata.no_sim' => 'required|numeric',
//            'biodata.telepon' => 'required',
//            'biodata.hp' => 'required',
//            'biodata.jenis_kelamin' => 'required',
//            'biodata.tempat_lahir' => 'required',
//            'biodata.alamat' => 'required',
//            'biodata.provinsi_id' => 'required|not_in:0|exists:provinsi,id',
//            'biodata.status_nikah' => 'required|not_in:0',
//            // 'biodata.no_ktp' => 'required|numeric',
//            'biodata.tulisan_judul' => 'required',
//            'biodata.tulisan_konten' => 'required',
//            'pendidikan.sma' => 'required',
//            'pendidikan.sma_tahun' => 'required',
//            'pendidikan.prasarjana_universitas' => 'required',
//            'pendidikan.prasarjana_tahun' => 'required',
//            'pendidikan.prasarjana_jurusan' => 'required',
//            'pendidikan.ipk_terakhir' => 'required',
//            'foto' => array('mimes:jpeg,png', 'max:512'),
//            'ijazah_terakhir' => array('mimes:jpeg,png', 'max:512'),
//            'transkrip_nilai' => array('mimes:jpeg,png', 'max:512'),
//            'lamaran' => array('mimes:pdf', 'max:512'),
//            'cv' => array('mimes:pdf', 'max:512'),
//            'ket_sehat' => array('mimes:jpeg,png', 'max:512'),
//            'ket_bebas_narkoba' => array('mimes:jpeg,png', 'max:512'),
//            'ket_catatan_kepolisian' => array('mimes:jpeg,png', 'max:512'),
//            'surat_ijin_keluarga' => array('mimes:jpeg,png', 'max:512'),
//            'ktp' => array('mimes:jpeg,png', 'max:512')
//        );
//
//        $attributes = array(
//            'biodata.nama_lengkap' => 'Nama lengkap',
//            'biodata.email' => 'Alamat e-mail',
//            'biodata.no_sim' => 'Nomor SIM C',
//            'biodata.no_ktp' => 'Nomor KTP',
//            'biodata.telepon' => 'Nomor telepon',
//            'biodata.hp' => 'Nomor handphone',
//            'biodata.jenis_kelamin' => 'Jenis kelamin',
//            'biodata.tempat_lahir' => 'Tempat lahir',
//            'biodata.alamat' => 'Alamat',
//            'biodata.provinsi_id' => 'Provinsi',
//            'biodata.status_nikah' => 'Status nikah',
//            'biodata.tulisan_judul' => 'Judul tulisan',
//            'biodata.tulisan_konten' => 'Konten tulisan',
//            'pendidikan.sma' => 'Nama sekolah menengah atas anda',
//            'pendidikan.sma_tahun' => 'Tahun lulus sekolah menengah atas anda',
//            'pendidikan.prasarjana_universitas' => 'Nama universitas/institut/sekolah tinggi',
//            'pendidikan.prasarjana_jurusan' => 'Nama jurusan',
//            'pendidikan.prasarjana_tahun' => 'Tahun lulus',
//            'pendidikan.ipk_terakhir' => 'Nilai IPK terakhir',
//            'foto' => 'Pas foto',
//            'ijazah_terakhir' => 'Ijazah terakhir',
//            'transkrip_nilai' => 'Transkrip nilai',
//            'lamaran' => 'Surat lamaran',
//            'cv' => 'CV(<i>Curiculum Vitae</i>)',
//            'ket_sehat' => 'Surat keterangan sehat',
//            'ket_bebas_narkoba' => 'Surat keterangan bebas narkoba',
//            'ket_catatan_kepolisian' => 'Suran keterangan catatan kepolisian (SKCK)',
//            'surat_ijin_keluarga' => 'Surat Ijin dari Keluarga (Bagi yang sudah menikah)',
//            'ktp' => 'Kartu Tanda Penduduk (KTP)'
//        );
//
//        $messages = array(
//            'required' => ':attribute wajib diisi.',
//            'mimes' => ':attribute harus berupa: :values.',
//            'biodata.email.email' => ':attribute tidak benar.',
//            'biodata.telepon.regex' => ':attribute tidak benar.',
//            'biodata.hp.regex' => ':attribute tidak benar.',
//            'biodata.provinsi_id.not_in' => 'Anda wajib memilih region',
//            'biodata.provinsi_id.exists' => 'Provinsi tidak tersedia.',
//            'biodata.status_nikah.not_in' => 'Anda wajib memilih status',
//            'max' => 'Ukuran berkas tidak boleh lebih dari <strong>512 kilobytes</strong>.',
//            'numeric' => ':attribute harus berupa angka.'
//        );


        $user = Auth::user();

        if($user->registrasi->lampiran()->where('context', '=', 'FOTO_USER')->count() == 0) $rules['foto'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'IJAZAH')->count() == 0) $rules['ijazah_terakhir'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'TRANSKRIP')->count() == 0) $rules['transkrip_nilai'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'LAMARAN')->count() == 0) $rules['lamaran'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'CV')->count() == 0) $rules['cv'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'KETERANGAN_SEHAT')->count() == 0) $rules['ket_sehat'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'KETERANGAN_BEBAS_NARKOBA')->count() == 0) $rules['ket_bebas_narkoba'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'SKCK')->count() == 0) $rules['ket_catatan_kepolisian'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'KTP')->count() == 0) $rules['ktp'][] = 'required';
        if($user->registrasi->lampiran()->where('context', '=', 'SURAT_IJIN_KELUARGA')->count() == 0) $rules['surat_ijin_keluarga'][] = 'required_if:biodata.status_nikah,1';

//        $validator = Validator::make(Input::all(), $rules, $messages);
//        $validator->setAttributeNames($attributes);
//
//        if($validator->fails())
//            return Redirect::to('edit')->withErrors($validator)
//                ->with('error', 'Perubahan data gagal, cek kembali formulir pendaftaran anda.')->withInput();

        $biodata = $inputs['biodata'];
        $pendidikan = $inputs['pendidikan'];
        $keluarga = $inputs['keluarga'];
        $kesehatan = $inputs['kesehatan'];
        $karir = $inputs['karir'];
        $popularitas = $inputs['popularitas'];
        $organisasi = $inputs['organisasi'];
        $prestasi = $inputs['prestasi'];

        $biodata['tanggal_lahir'] = $biodata["tahun"] . '-' . $biodata["bulan"] . '-' . $biodata["tanggal"];
        unset($biodata["tahun"], $biodata["bulan"], $biodata["tanggal"]);

        $user->registrasi()->update($biodata);
        $user->registrasi->pendidikan()->update($pendidikan);
        $user->registrasi->kesehatan()->update($kesehatan);
        $user->registrasi->popularitas()->update($popularitas);

        $user->registrasi->pekerjaan()->delete();
        foreach($karir as $data) {
            if (empty($data['perusahaan']) || empty($data['jabatan']) || empty($data['uraian_singkat'])) continue;

            $periode = $data['bulan_awal'] . '/' . $data['tahun_awal'] . '-' . $data['bulan_akhir'] . '/' . $data['tahun_akhir'];
            $data['periode'] = $periode;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");

            unset($data['bulan_awal'], $data['tahun_awal'], $data['bulan_akhir'], $data['tahun_akhir']);

            $user->registrasi->pekerjaan()->save(new Pekerjaan($data));
        }

        $user->registrasi->organisasi()->delete();
        foreach ($organisasi as $index => $data) {
            if(empty($data['organisasi']) || empty($data['jabatan'])) continue;

            $periode = $data['bulan_awal'] . '/' . $data['tahun_awal'] . '-' . $data['bulan_akhir'] . '/' . $data['tahun_akhir'];
            $data['periode'] = $periode;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");

            unset($data['bulan_awal'], $data['tahun_awal'], $data['bulan_akhir'], $data['tahun_akhir']);

            $user->registrasi->organisasi()->save(new Organisasi($data));
        }

        $user->registrasi->prestasi()->delete();
        foreach ($prestasi as $index => $data) {
            if(empty($data['nama_prestasi'])) continue;

            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            $user->registrasi->prestasi()->save(new Prestasi($data));
        }

        $user->registrasi->keluarga()->delete();
        foreach ($keluarga as $index => $data) {
            if(empty($data['nama_anak'])) continue;

            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            $user->registrasi->keluarga()->save(new Keluarga($data));
        }

        $this->saveLampiran($user, 'foto', 'FOTO_USER', 'users');
        $this->saveLampiran($user, 'ijazah_terakhir', 'IJAZAH');
        $this->saveLampiran($user, 'transkrip_nilai', 'TRANSKRIP');
        $this->saveLampiran($user, 'lamaran', 'LAMARAN');
        $this->saveLampiran($user, 'cv', 'CV');
        $this->saveLampiran($user, 'ket_sehat', 'KETERANGAN_SEHAT');
        $this->saveLampiran($user, 'ket_bebas_narkoba', 'KETERANGAN_BEBAS_NARKOBA');
        $this->saveLampiran($user, 'ket_catatan_kepolisian', 'SKCK');
        $this->saveLampiran($user, 'surat_ijin_keluarga', 'SURAT_IJIN_KELUARGA');
        $this->saveLampiran($user, 'ktp', 'KTP');

        #checkpoint..
        return Redirect::to('edit')->with('success', 'Biodata telah diperbaharui.');
    }

    private function saveLampiran($user, $name, $context, $path = 'lampiran') {

        $path = RETANE_UPLOAD_FOLDER . $path;

        if (Input::hasFile($name)) {
                // cek foto sebelumnya
                $lampiran = $user->registrasi->lampiran()->where('context', '=', $context)->first();
                if(!is_null($lampiran)) {
                    // ganti foto yang dulu dengan yang baru (overwrite)
                    $filename = PREFIX_LAMPIRAN . uniqid() . DOT_SEPARATOR . Input::file($name)->getClientOriginalExtension();
                    $uploaded = Input::file($name)->move($path, $filename);
                    if($uploaded) {
                        $old_filename = $lampiran->file;
                        $lampiran->file = $filename;
                        if($lampiran->save())
                            @unlink($path . DIRECTORY_SEPARATOR . $old_filename);
                    }

                } else {
                    // upload foto baru
                    $filename = PREFIX_LAMPIRAN . uniqid() . DOT_SEPARATOR . Input::file($name)->getClientOriginalExtension();
                    $uploaded = Input::file($name)->move($path, $filename);
                    if ($uploaded) {
                        $user->registrasi->lampiran()->save(new Lampiran(array(
                            'context' => $context,
                            'file' => $filename,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        )));
                    }
                }
        }

    }

    public function form(){

        $this->layout->content = View::make('registrasi.form', array(
//            'date' => RetaneHelper::listDate()
        ));
    }

    //function for generate captcha
    public function captcha(){
        session_start();

        $string = '';

        for ($i = 0; $i < 5; $i++) {
            $string .= chr(rand(97, 122));
        }

        $_SESSION['random_number'] = $string;

        $dir = HUKOR_FONT_FOLDER;

        $image = imagecreatetruecolor(165, 50);

        // random number 1 or 2
        $num = rand(1,2);
        if($num==1)
        {
            $font = "Capture it 2.ttf"; // font style
        }
        else
        {
            $font = "Molot.otf";// font style
        }

// random number 1 or 2
        $num2 = rand(1,2);
        if($num2==1)
        {
            $color = imagecolorallocate($image, 113, 193, 217);// color
        }
        else
        {
            $color = imagecolorallocate($image, 163, 197, 82);// color
        }

        $white = imagecolorallocate($image, 255, 255, 255); // background color white
        imagefilledrectangle($image,0,0,399,99,$white);

        imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $_SESSION['random_number']);

        header("Content-type: image/png");
        imagepng($image);
//        return $string;

    }

    public function lihatLampiran() {
        $id = Input::get('id');
        $lampiran = Lampiran::find($id);
        $path_lampiran = RETANE_UPLOAD_FOLDER . 'lampiran';
        $path_foto = RETANE_UPLOAD_FOLDER . 'users';

        $path = $path_lampiran . DIRECTORY_SEPARATOR . $lampiran->file;
        if(!file_exists($path))
            $path = $path_foto . DIRECTORY_SEPARATOR . $lampiran->file;

        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $mimes = array(
            'pdf' => 'application/pdf',
            'jpg' => 'image/jpg',
            'png' => 'image/png'
        );

        $content = file_get_contents($path);

        $response = Response::make($content, 200);


        $response->header('Content-Type', $mimes[strtolower($ext)]);

        return $response;
    }


    /*
     * Send Data Anonymouse
     */
    public function send() {
        
        $username = Input::get('username');
        $password = Input::get('password');
        $email = Input::get('email');

        $nama = Input::get('nama_lengkap');
        $nip = Input::get('nip');
        $jabatan = Input::get('jabatan');
//        $bagian = Input::get('bagian');
//        $subbag = Input::get('sub_bagian');
        $jk = Input::get('jenis_kelamin');
        $tgl_lahir = Input::get('tgl_lahir');
        $pekerjaan = Input::get('pekerjaan');
        $alamat_kantor = Input::get('alamat_kantor');
        $tlp_ktr = Input::get('tlp_kantor');
        $hp = Input::get('handphone');
        $uk = Input::get('unit_kerja');
        $code = Input::get('code');

//        var_dump($captcha);die;

        $rules = array();
        $messages = array();

        if($username == null) {
            $rules['username'] = 'required|unique:registrasi|min:6';
            $messages['username.unique'] = 'Username tidak tersedia.';
            $messages['username.min'] = 'Username minimal 6 karakter.';
        }

        if(!empty($password)) {
            $rules['password'] = 'confirmed|min:6';
            $messages['password.confirmed'] = 'Konfirmasi password salah.';
            $messages['password.min'] = 'Password minimal 6 karakter.';
        }

        session_start();

        //include('dbcon.php');

        if(strtolower($code) == strtolower($_SESSION['random_number']))
        {

//            echo "MASUK";exit;
            // insert data registration to your table in db

            // Save
            $DAL = new DAL_Registrasi();
            $DAL->SetData(array(
                'username' => $email,
                'password' => Hash::make($password), // Hashing A Password Using Bcrypt\
                'role_id' => 2, // Aktif
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));

            $data = $DAL->Save();

            if ($data !== 0) {
                $dal_user = new DAL_User();
                $dal_user->SetPengguna($data, $email, $nama, $nip, $jabatan, $jk, $tgl_lahir, $pekerjaan, $alamat_kantor, $tlp_ktr, $hp, $uk);
                $dal_user->SaveBiodata($data);

                // register user to forum database!
                $now = new DateTime('now');
                $forumUser = new ForumUser();
                $forumUser->id = $data;
                $forumUser->username = $email;
                $forumUser->password = pun_hash($password);
                $forumUser->email = $email;
                $forumUser->last_visit = $now->getTimestamp();
                $forumUser->registered = $now->getTimestamp();
                $forumUser->save();

//            $this->sendMail($username, $password, $email);
                Session::flash('success', 'Registrasi berhasil. Silahkan login kedalam sistem!');
                return Redirect::to('/');
            } else {
                Session::flash('error', 'Registrasi gagal! Harap ulangi dan Pastikan alamat email anda valid!');
                return Redirect::to('registrasi');
            }

        }
        else
        {
//            echo "SALAH";exit;
            Session::flash('error', 'Registrasi gagal! Captcha tidak valid!');
            return Redirect::to('registrasi');
        }
//
        if (Request::getMethod() == 'POST'){
//            $rules['captcha'] = 'required|captcha';
            $rulesa =  array('code' => array('required', 'captcha'));
            $validator = Validator::make(Input::all(), $rulesa);
            if ($validator->fails())
            {
                Session::flash('error', 'Registrasi gagal! Captcha tidak valid!');
                return Redirect::to('registrasi');
            }
            else
            {
                // Save
                $DAL = new DAL_Registrasi();
                $DAL->SetData(array(
                    'username' => $email,
                    'password' => Hash::make($password), // Hashing A Password Using Bcrypt\
                    'role_id' => 2, // Aktif
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ));

                $data = $DAL->Save();

                if ($data !== 0) {
                    $dal_user = new DAL_User();
                    $dal_user->SetPengguna($data, $email, $nama, $nip, $jabatan, $jk, $tgl_lahir, $pekerjaan, $alamat_kantor, $tlp_ktr, $hp, $uk);
                    $dal_user->SaveBiodata($data);

                    // register user to forum database!
                    $now = new DateTime('now');
                    $forumUser = new ForumUser();
                    $forumUser->id = $data;
                    $forumUser->username = $email;
                    $forumUser->password = pun_hash($password);
                    $forumUser->email = $email;
                    $forumUser->last_visit = $now->getTimestamp();
                    $forumUser->registered = $now->getTimestamp();
                    $forumUser->save();

//            $this->sendMail($username, $password, $email);
                    Session::flash('success', 'Registrasi berhasil. Silahkan login kedalam sistem!');
                    return Redirect::to('/');
                } else {
                    Session::flash('error', 'Registrasi gagal! Harap ulangi dan Pastikan alamat email anda valid!');
                    return Redirect::to('registrasi');
                }
            }
        }


        
    }


    /*
     * Kirim Email
     */
    private function sendMail($username, $password, $email) {
        $message = '';

        // creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
        $user = array(
            'email' => $email,
            'name' => 'Yth. ' . $username,
        );

        // the data that will be passed into the mail view blade template
        $data = array(
            'username' => $username,
            'password' => $password
        );

        // use Mail::send function to send email passing the data and using the $user variable in the closure
        Mail::send('emails.template', $data, function($message) use ($user) {
                    $message->from('admin@site.com', 'Site Admin');
                    $message->to($user['email'], $user['name'])->subject('Sistem Registrasi Online Laboratorium Kepemimpinan Nasional');
                });
    }

}