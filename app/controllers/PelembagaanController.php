<?php

use Carbon\Carbon;

class PelembagaanController extends BaseController {

//    protected $layout = 'layouts.admin';

	public function index()
	{

		$user = Auth::user();
//		$user->role_id;
        if(Request::ajax())           
            return Datatables::of(DAL_Pelembagaan::getDataTable())->make(true);
            
        	 $statusUn = Pelembagaan::where('status', null)->count();
        	 $statusPro = Pelembagaan::where('status', 1)->count();
        	 $statusPerUU = Pelembagaan::where('status', 2)->count();

	       	// $listTgl = array("" => "Semua") + Pelembagaan::select(array( DB::raw('DATE_FORMAT(tgl_usulan,"%Y") As usulan_year')))
	        // 													->lists('usulan_year', 'usulan_year');
        if($user->role_id == 3){
//	       	$listTgl = array("" => "Semua") + Pelembagaan::select(array( DB::raw('DATE_FORMAT(tgl_usulan,"%Y") As usulan_year')))
//	        													->lists('usulan_year', 'usulan_year');

        if($user->role_id == 3 || $user->role_id == 7){
			$this->layout = View::make('layouts.admin');
        } else {
        	$this->layout = View::make('layouts.master');
        }
	    
	    $this->layout->content = View::make('Pelembagaan.index', array( 'user' => $user, 'status_belum' => $statusUn, 'status_proses' => $statusPro));		
=======
	    $this->layout->content = View::make('Pelembagaan.index', array( 'user' => $user));//, array( 'status_belum' => $statusUn, 'status_proses' => $statusPro));
	}

    public function datatable()
    {
    	//
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
		//$status = LogPelembagaan::where('status', null)->count();

	}    

	public function create()
	{
		$pelembagaan = new Pelembagaan();
		$user = Auth::user();

		$this->layout = View::make('layouts.master');

		$this->layout->content = View::make('Pelembagaan.form', array(
				'title' => 'Tambah Akun',
				'detail' => 'Lengkapi formulir dibawah ini untuk menambahkan akun baru.',
				'form_opts' => array(
					'route' => 'store_pelembagaan',					
					'method' => 'post',
					'class' => 'form-horizontal',
		            'id' => 'pelembagaan-form',
		            'files' => true
				),
				'pelembagaan' => $pelembagaan,
				'user' => $user
			));                        
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(Request::ajax())  
        	return Datatables::of(DAL_LogPelembagaan::getDataTable($id))->make(true);

		$pelembagaan = Pelembagaan::find($id);

    	$this->layout = View::make('layouts.admin');

		if(!is_null($pelembagaan))
			$this->layout->content = View::make('Pelembagaan.update', array(
				'title' => 'Ubah Pelembagaan #' . $pelembagaan->id,
				'detail' => '',
				'form_opts' => array(
					'route' => 'proses_update_pelembagaan',
					'method' => 'post',
//					'route' => array('admin.pelembagaan.update', $pelembagaan->id),
//					'method' => 'put',
					'class' => 'form-horizontal',
		            'id' => 'pelembagaan-update',
					'files' => true
				),
				'pelembagaan' => $pelembagaan,
				'id' => $id,
//				'log_pelembagaan' => $log_pelembagaan,
//				'listRegion' => $listRegion,
//				'listRole' => $listRole
			));
	}

	public function update() //$id)
	{
        $id = Input::get('id');

		$pelembagaan = Pelembagaan::find($id);

        $img = Input::file('lampiran');
		$destinationPath = UPLOAD_PATH . '/';		
		$filename = $img->getClientOriginalName();
		$uploadSuccess = $img->move($destinationPath, $filename);

//		$pelembagaan->id_pengguna = $id;

		$log_pelembagaan = new LogPelembagaan();
		$log_pelembagaan->status = Input::get('status');
		$pelembagaan->status = $log_pelembagaan->status;

		$log_pelembagaan->catatan = Input::get('catatan');
		$log_pelembagaan->keterangan = Input::get('keterangan');
		$log_pelembagaan->lampiran = $filename;

		$log_pelembagaan->pelembagaan_id = $id;
        $log_pelembagaan->tgl_proses = Carbon::now();
		$log_pelembagaan->save();


		$pelembagaan->save();

//		$userid = pengguna::find($pelembagaan->ipengguna);
        // EMAIL To User
		$data = array(
//			'name' => $pelembagaan->pengguna->id,
			'perihal' => Input::get('perihal'),
			'status' => $pelembagaan->getStatus(Input::get('status'))
		);

		$user = array(
				'name' => 'User ',
			    'email' => 'andhy.m0rphin@gmail.com'
		);
		 

		Mail::send('emails.reppelembagaan', $data, function($message) use ($user)
		{
		  $message->to($user['email'], $user['name'])->subject('Re: Usulan Pelembagaan Request');
		});


		return Redirect::to('admin/pelembagaan')->with('success', 'Data berhasil diubah.');
	}  

	public function store()
	{
        $img = Input::file('lampiran');

		$destinationPath = UPLOAD_PATH . '/';		
		$filename = $img->getClientOriginalName();
		$uploadSuccess = $img->move($destinationPath, $filename);
		
		$pelembagaan = new Pelembagaan;
		$user = Auth::user();	
		$pelembagaan->id_pengguna = $user->pengguna->id;
		$pelembagaan->jenis_usulan = Input::get('jenis_usulan');
		$pelembagaan->perihal = Input::get('perihal');
		$pelembagaan->catatan = Input::get('catatan');
		$pelembagaan->lampiran = $filename;

        $pelembagaan->tgl_usulan = Carbon::now();

        // EMAIL To Admin
		$data = array(
			'name' => $user->pengguna->nama_lengkap,
			'perihal' => Input::get('perihal'),
			'jenis_usulan' => $pelembagaan->getJenisUsulan(Input::get('jenis_usulan'))
		);

		$user = array(
		//	array(
				'name' => 'User ',
			    'email' => 'andhy.m0rphin@gmail.com'
		//	),
		//	array(
		//		'name' => 'Admin Pelembagaan',
		//	    'email' => 'jufri.suandi@gmail.com'
		//	)
		);
		 

		//	while()
		 
			Mail::send('emails.reqpelembagaan', $data, function($message) use ($user)
			{
			  $message->to($user['email'], $user['name'])->subject('Usulan Pelembagaan Request');
			});


		if($uploadSuccess) {
			if($pelembagaan->save()) {
				Session::flash('success', 'Data berhasil dikirim.');
				return Redirect::to('pelembagaan/usulan'); //->with('success', 'Data berhasil diubah.');
			} else {
				Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
				return Redirect::to('pelembagaan/usulan');
			}					
		} else {
			Session::flash('error', 'Gagal mengirim berkas. Pastikan berkas berupa PDF dan kurang dari 512k.');
			return Redirect::to('pelembagaan/usulan');
		}		
		Session::flash('success', 'Data berhasil dikirim.');
		return Redirect::to('pelembagaan/usulan');
	}


	public function destroy($id)
	{
		$pelembagaan = Pelembagaan::find($id);
		if(!is_null($pelembagaan)) {
			$pelembagaan->delete();
		}
	}

}
