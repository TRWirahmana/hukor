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
                    'url' => URL::to('admin/setting/save'),
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

            return Redirect::to('admin/Index')->with('success', 'Pengaturan akun berhasil disimpan.');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

//		$role = User::all();
//
//		$listRole = array();
//		foreach($role as $data)
//		{
//			if($data->role_id != '0')
//			{
//                switch($data->role_id){
//                    case 2 :
//                        $listRole[$data->role_id] = "Pengguna";
//                        break;
//                    case 3 :
//                        $listRole[$data->role_id] = "Admin";
//                        break;
//                    default:
//                        $listRole[$data->role_id] = "Pengguna";
//                        break;
//
//                }
//			}
//		}

        $listRole = array(
            '1' => 'Admin',
            '2' => 'Pengguna',
            '3' => 'Super Admin',
            '4' => 'Kepala Biro'
        );

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
		
		if($user->save()){
            /* save to table registrasi */
			$registrasi = new Pengguna();
            $registrasi->user_id = $user->id;
			$registrasi->nama_lengkap = $input['nama_lengkap'];
            $registrasi->email = $input['email'];

			$registrasi->save();

//				$data = array(
//					'username' => $user->username,
//					'password' => $input['password'],
//				);

                /* send email to new member */

//				Mail::send('emails.admreg', $data, function($message) use($user){
//					$message->from('admin@site.com', 'Site Admin');
//					$message->to($user->email, $user->username)
//							->subject('Sistem Registrasi Online Laboratorium Kepemimpinan Nasional');
//				});

		}

		return Redirect::to('admin/account')->with('success', 'Akun berhasil ditambahkan.');
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
        $listRole = array(
            '1' => 'Admin',
            '2' => 'Pengguna',
            '3' => 'Super Admin',
            '4' => 'Kepala Biro'
        );

//        foreach($role as $data)
//        {
//            if($data->role_id != '0')
//            {
//                $listRole[$data->role_id] = $data->role_id;
//            }
//        }
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

		return Redirect::to('admin/account')->with('success', 'Data berhasil diubah.');
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
			
	}

}
