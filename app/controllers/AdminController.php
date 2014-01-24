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
                $admins = User::where('role_id', '!=', null)->where('id', '!=', 1)->with('registrasi');
            }else
            {
                $admins = User::where('role_id', '=', Input::get('role_id'))->where('id', '!=', 1)->with('registrasi');
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
//		$listRegion = Region::lists('nama', 'id');

		$role = Role::all();
		$listRole = array();
		foreach($role as $data)
		{
			if($data->id != '1' && $data->id != '2')
			{
				$listRole[$data->id] = $data->name;
			}
		}

		$this->layout->content = View::make('admin.form', array(
			'title' => 'Tambah Akun Admin',
			'detail' => 'Lengkapi formulir dibawah ini untuk menambahkan akun baru.',
			'form_opts' => array(
				'route' => 'admin.Account.store',
				'method' => 'post',
				'class' => 'form-horizontal'
			),
			'user' => new User(),
//			'listRegion' => $listRegion,
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
		$user->email = $input['email'];
		$user->username = $input['username'];
		$user->password = Hash::make($input['password']);
		
		if($user->save()){
            /* save to table registrasi */
			$registrasi = new Registrasi();
            $registrasi->user_id = $user->id;
			$registrasi->role_id = $input['role'];
			$registrasi->nama_lengkap = $input['nama_lengkap'];

			$registrasi->save();

				$data = array(
					'username' => $user->username,
					'password' => $input['password'],
				);

                /* send email to new member */

				Mail::send('emails.admreg', $data, function($message) use($user){
					$message->from('admin@site.com', 'Site Admin');
					$message->to($user->email, $user->username)
							->subject('Sistem Registrasi Online Laboratorium Kepemimpinan Nasional');
				});
			
		}

		return Redirect::to('admin/Account')->with('success', 'Akun admin berhasil ditambahkan.');
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

		$listRegion = array("" => "-- Pilih Region --") + Provinsi::lists('nama', 'id');

		$role = Role::all();
		$listRole = array();
        foreach($role as $data)
        {
            if($data->id != '1' && $data->id != '2')
            {
                $listRole[$data->id] = $data->name;
            }
        }
		//
		$user = User::find($id);
        $user->load('registrasi');
		if(!is_null($user))
			$this->layout->content = View::make('admin.form', array(
				'title' => 'Ubah Akun Admin #' . $user->id,
				'detail' => '',
				'form_opts' => array(
					'route' => array('admin.Account.update', $user->id),
					'method' => 'put',
					'class' => 'form-horizontal'
				),
				'user' => $user,
				'listRegion' => $listRegion,
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
		$user->email = $input['email'];
        $user->username = $input['username'];
        $user->password = $input['password'];
		$user->save();

        $user->registrasi->role_id = $input['role'];
		$user->registrasi->nama_lengkap = $input['nama_lengkap'];
		$user->registrasi->save();

		return Redirect::to('admin/Account')->with('success', 'Data admin berhasil diubah.');
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
		if(!is_null($user)) {
			$user->registrasi->delete();
			$user->delete();
		}
			
	}

}
