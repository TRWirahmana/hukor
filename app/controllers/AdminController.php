<?php

class AdminController extends BaseController {


	protected $layout = 'layouts.admin';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    public function home(){
        $user = Auth::user();
        $this->layout->content = View::make('admin.home', array(
            'user'=> $user
        ));
    }

    public function dashboard() {

        if(Request::ajax()) {
            $perUU = DAL_PerUU::getMonthlyCount();
            $pelembagaan = DAL_Pelembagaan::getMonthlyCount();
            $bantuanHukum = DAL_BantuanHukun::getMonthlyCount();

            $data = array();
            foreach($perUU->get() as $obj)
                $data["per_uu"][] = intval($obj->jumlah);

            foreach($pelembagaan->get() as $obj)
                $data["pelembagaan"][] = intval($obj->jumlah);

            foreach($bantuanHukum->get() as $obj)
                $data["bantuan_hukum"][] = intval($obj->jumlah);

            return Response::json($data);
        }


        $this->layout->content = View::make('admin.dashboard');
    }

    public function cetakLaporan() {
        $modul = Input::get('modul', null);
        $firstDate = Input::get("firstDate", null);
        $lastDate = Input::get("lastDate", null);

        $style = array("<style>");
        $style[] = "table { border-collapse: collapse; }";
        $style[] = "table td, table th { padding: 5px; }";
        $style[] = "</style>";

        $html = array("<h1>Laporan</h1>");
        $html[] = "<table><tr>";
        if(null != $status)
            $html[] = "<td><strong>Status</strong></td><td>: ".DAL_PerUU::getStatus($status)."</td>";
        if(null != $firstDate)
            $html[] = "<td><strong>Tgl awal</strong></td><td>: {$firstDate}</td>";
        if(null != $lastDate)
            $html[] = "<td><strong>Tgl akhir</strong></td><td>: {$lastDate}</td>";
        $html[] = "</tr></table><hr />";

        switch ($modul) {
            case 1:
                $html[] = "<h2>Peraturan Perundang Undangan</h2>";
                $html[] = DAL_PerUU::getPrintTable(null, $firstDate, $lastDate);
                break;
            case 2:
                $html[] = "<h2>Pelembagaan</h2>";
                $html[] = DAL_Pelembagaan::getPrintTable(null, $firstDate, $lastDate);
                break;
            case 3:
                $html[] = "<h2>Bantuan Hukum</h2>";
                $html[] = DAL_BantuanHukun::getPrintTable($firstDate, $lastDate);
                break;            
            default:
                $html[] = "<h2>Peraturan Perundang Undangan</h2>";
                $html[] = DAL_PerUU::getPrintTable(null, $firstDate, $lastDate);
                $html[] = "<h2>Pelembagaan</h2>";
                $html[] = DAL_Pelembagaan::getPrintTable(null, $firstDate, $lastDate);
                $html[] = "<h2>Bantuah Hukum</h2>";
                $html[] = DAL_BantuanHukun::getPrintTable($firstDate, $lastDate);
                break;
        }

        $pdf = new DOMPDF();
        $pdf->load_html(join("", $style) . join("",$html));
        $pdf->render();
        $pdf->stream("laporan.pdf");
        // $response = Response::make($pdf->output());
        // $response->header('Content-Type', "application/pdf");
        // return $response;

    }

	public function index()
	{
//        $this->layout = "layouts.admin";
        $user = Auth::user();

        if(Request::ajax()) {
            if(Input::get('role_id') == 0)
            {
                $admins = User::where('user.role_id', '!=', '')->where('user.id', '!=', 1)->with('pengguna');
//                $admins->where('nama_lengkap', '!=', '');
            }else
            {
                $admins = User::where('user.role_id', '=', Input::get('role_id'))->where('user.id', '!=', 0)->with('pengguna');
            }

            $totalRecords = $admins->count();
            $totalDisplayRecords = $admins->count();
            $admins = $admins->skip(Input::get('iDisplayStart'))->take(Input::get('iDisplayLength'));

            return Response::json(array(
                'aaData' => $admins->get()->toArray(),
                'sEcho' => Input::get('sEcho'),
                'iTotalRecords' => $totalRecords,
                'iTotalDisplayRecords' => $totalDisplayRecords
            ));
        }

		$this->layout->content = View::make('admin.index',
                                            array('user' => $user));
	}

    // displays user setting form
    public function setting() {
        $user = Auth::user();


        if(!is_null($user))
            $this->layout->content = View::make('admin.setting', array(
                'title' => 'Pengaturan Akun',
                'detail' => '',
                'form_opts' => array(
                    'url' => URL::route('admin.setting.save'),
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
        }

        if(!empty($input['password'])) {
            $rules['password'] = 'confirmed|min:6';
            $messages['password.confirmed'] = 'Konfirmasi password salah.';
            $messages['password.min'] = 'Password minimal 6 karakter.';

            $user->password = Hash::make($input['password']);
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

            return Redirect::route('admin.index')->with('success', 'Pengaturan akun berhasil disimpan.');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        $listRole = array("" => "-- Pilih Role --") + Role::lists('nama', 'id');
//        $listRole = array(
//            '1' => 'Kepala Biro',
////            '2' => 'Pengguna',
//            '3' => 'Super Admin',
//            '4' => 'Kepala Bagian',
//            '5' => 'Kepala Sub Bagian',
//            '6' => 'Admin Peraturan Perundang-Undangan',
//            '7' => 'Admin Pelembagaan',
//            '8' => 'Admin Bantuan Hukum',
//            '9' => 'Admin Ketatalaksanaan'
//
//        );

		$this->layout->content = View::make('admin.form', array(
			'title' => 'Tambah Akun Admin',
			'detail' => 'Lengkapi formulir dibawah ini untuk menambahkan akun baru.',
			'form_opts' => array(
				'route' => 'admin.account.store',
				'method' => 'post',
				'class' => 'form-horizontal',
                'id' => 'reg_admin'
			),
			'user' => new User(),
            'listRole' => $listRole
		));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();

        /* save to table user */
		$user = new User();
        $user->role_id = $input['role'];
		$user->username = $input['email'];
		$user->password = Hash::make($input['password']);
        $user->last_active = new DateTime('now');
		
		if($user->save()){
            /* save to table registrasi */
			$registrasi = new Pengguna();
            $registrasi->user_id = $user->id;
			$registrasi->nama_lengkap = $input['nama_lengkap'];
            $registrasi->email = $input['email'];

			$registrasi->save();

            switch($user->role_id){
                case 1:
                    $data = array(
                        'username' => $user->username,
                        'password' => $input['password'],
                        'role' => "Kepala Biro"
                    );
                    break;
                case 3:
                    $data = array(
                        'username' => $user->username,
                        'password' => $input['password'],
                        'role' => "Super Admin"
                    );
                    break;
                case 4:
                    $data = array(
                        'username' => $user->username,
                        'password' => $input['password'],
                        'role' => "Kepala Bagian"
                    );
                    break;
                case 5:
                    $data = array(
                        'username' => $user->username,
                        'password' => $input['password'],
                        'role' => "Kepala Sub Bagian"
                    );
                    break;
                case 6:
                    $data = array(
                        'username' => $user->username,
                        'password' => $input['password'],
                        'role' => "Admin Peraturan Perundang-Undangan"
                    );
                    break;
                case 7:
                    $data = array(
                        'username' => $user->username,
                        'password' => $input['password'],
                        'role' => "Admin Pelembagaan"
                    );
                    break;
                case 8:
                    $data = array(
                        'username' => $user->username,
                        'password' => $input['password'],
                        'role' => "Admin Bantuan Hukum"
                    );
                    break;
                case 9:
                    $data = array(
                        'username' => $user->username,
                        'password' => $input['password'],
                        'role' => "Admin Ketatalasksanaan"
                    );
                    break;
            }



                /* send email to new member */

				Mail::send('emails.admreg', $data, function($message) use($user){
					$message->from('admin@site.com', 'Site Admin');
					$message->to($user->username, $user->username)
							->subject('Sistem Layanan Hukum & Organisasi');
				});

		}

		return Redirect::route('admin.account.index')->with('success', 'Akun berhasil ditambahkan.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $role = User::select('role_id');

        $listRole = array("" => "-- Pilih Role --") + Role::lists('nama', 'id');
//        $listRole = array(
//            '1' => 'Kepala Biro',
//            '2' => 'Pengguna',
//            '3' => 'Super Admin',
//            '4' => 'Kepala Bagian',
//            '5' => 'Kepala Sub Bagian',
//            '6' => 'Admin Peraturan Perundang-Undangan',
//            '7' => 'Admin Pelembagaan',
//            '8' => 'Admin Bantuan Hukum',
//            '9' => 'Admin Ketatalaksanaan'
//        );

		//
		$user = User::find($id);
        $user->load('pengguna');
		if(!is_null($user))
			$this->layout->content = View::make('admin.form', array(
				'title' => 'Ubah Akun #' . $user->id,
				'detail' => '',
				'form_opts' => array(
					'route' => array('admin.account.update', $user->id),
					'method' => 'put',
					'class' => 'form-horizontal'
				),
				'user' => $user,
				'listRole' => $listRole
			));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

		$user = User::find($id);

        $user->role_id = $input['role'];
        $user->username = $input['email'];
        $user->password = Hash::make($input['password']);
		$user->save();
        $user->pengguna->email = $input['email'];
		$user->pengguna->nama_lengkap = $input['nama_lengkap'];
		$user->pengguna->save();

        switch($user->role_id){
            case 1:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Kepala Biro"
                );
                break;
            case 2:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Pengguna"
                );
                break;
            case 3:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Super Admin"
                );
                break;
            case 4:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Kepala Bagian"
                );
                break;
            case 5:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Kepala Sub Bagian"
                );
                break;
            case 6:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Admin Peraturan Perundang-Undangan"
                );
                break;
            case 7:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Admin Pelembagaan"
                );
                break;
            case 8:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Admin Bantuan Hukum"
                );
                break;
            case 9:
                $data = array(
                    'username' => $user->username,
                    'password' => $input['password'],
                    'role' => "Admin Ketatalasksanaan"
                );
                break;
        }



        /* send email to new member */

        Mail::send('emails.admreg', $data, function($message) use($user){
            $message->from('admin@site.com', 'Site Admin');
            $message->to($user->username, $user->username)
                ->subject('Sistem Layanan Hukum & Organisasi');
        });

		return Redirect::route('admin.account.index')->with('success', 'Data berhasil diubah.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$user = User::find($id);
//        var_dump($user);exit;
		if(!is_null($user)) {
			$user->pengguna()->delete();
			$user->delete();
		}
        return 1;
			
	}

    public function enableForum() {
        $config = AppConfig::find("enable_forum");
        if($config == null) {
            $config = new AppConfig();
            $config->config_key = "enable_forum";
            $config->value = "false";
            $config->save();
        }
        $config->value = Input::get("value", "false");
        $config->save();
        exit;
    }

}
