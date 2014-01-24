<?php

class AdminController extends BaseController {


	protected $layout = 'layouts.master';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Request::ajax()) {
            if(Input::get('role_id') == 0)
            {
                $admins = User::where('user.role_id', '!=', '')->where('user.id', '!=', 1)->with('pengguna');
//                $admins->where('nama_lengkap', '!=', '');
            }else
            {
                $admins = User::where('user.role_id', '=', Input::get('role_id'))->where('user.id', '!=', 1)->with('pengguna');
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

//        if(Request::ajax())
//            return Datatables::of(DAL_Registrasi::getDataTable(Input::get('role_id')))->make(true);

		$this->layout->content = View::make('admin.index');
	}

    public function datatable()
    {

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$role = User::all();

		$listRole = array();
		foreach($role as $data)
		{
			if($data->role_id != '0')
			{
                switch($data->role_id){
                    case 2 :
                        $listRole[$data->role_id] = "Pengguna";
                        break;
                    case 3 :
                        $listRole[$data->role_id] = "Admin";
                        break;
                    default:
                        $listRole[$data->role_id] = "Pengguna";
                        break;

                }
			}
		}

		$this->layout->content = View::make('admin.form', array(
			'title' => 'Tambah Akun',
			'detail' => 'Lengkapi formulir dibawah ini untuk menambahkan akun baru.',
			'form_opts' => array(
				'route' => 'account.store',
				'method' => 'post',
				'class' => 'form-horizontal',
                'id' => 'reg_admin'
			),
			'user' => new User(),
//			'listRegion' => $listRegion,
//			'listRole' => $listRole
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
        $user->role_id = 3;
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

		return Redirect::to('account')->with('success', 'Akun admin berhasil ditambahkan.');
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

//		$listRegion = array("" => "-- Pilih Region --") + Provinsi::lists('nama', 'id');

        $role = User::select('role_id');
        $listRole = array();
        foreach($role as $data)
        {
            if($data->role_id != '0')
            {
                $listRole[$data->role_id] = $data->role_id;
            }
        }
		//
		$user = User::find($id);
        $user->load('pengguna');
		if(!is_null($user))
			$this->layout->content = View::make('admin.form', array(
				'title' => 'Ubah Akun #' . $user->id,
				'detail' => '',
				'form_opts' => array(
					'route' => array('account.update', $user->id),
					'method' => 'put',
					'class' => 'form-horizontal'
				),
				'user' => $user,
//				'listRegion' => $listRegion,
//				'listRole' => $listRole
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


//        $user->role_id = $input['role'];

        $user->username = $input['email'];
        $user->password = Hash::make($input['password']);
		$user->save();

//        $user->registrasi->role_id = $input['role'];
        $user->pengguna->email = $input['email'];
		$user->pengguna->nama_lengkap = $input['nama_lengkap'];
		$user->pengguna->save();

		return Redirect::to('account')->with('success', 'Data berhasil diubah.');
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
