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
     
        	// $statusUn = Pelembagaan::where('status', null)->count();
        	// $statusPro = Pelembagaan::where('status', 1)->count();
        	// $statusPerUU = Pelembagaan::where('status', 2)->count();

	       	$listTgl = array("" => "Semua") + Pelembagaan::select(array( DB::raw('DATE_FORMAT(tgl_usulan,"%Y") As usulan_year')))
	        													->lists('usulan_year', 'usulan_year');

        if($user->role_id == 3){
			$this->layout = View::make('layouts.admin');
        } else {
        	$this->layout = View::make('layouts.master');
        }
	    
	    $this->layout->content = View::make('Pelembagaan.index', array( 'user' => $user, 'listTgl'));//, array( 'status_belum' => $statusUn, 'status_proses' => $statusPro));		
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
					'route' => array('admin.pelembagaan.update', $pelembagaan->id),
					'method' => 'put',
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

	public function update($id)
	{

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


		// kirim usulan ke bagian per-uu
		if($pelembagaan->status == 2){
			$perUU = new PerUU;
			$perUU->id_pengguna = $pelembagaan->id_pengguna;
			$perUU->perihal = $pelembagaan->perihal;
			$perUU->catatan = $pelembagaan->catatan;
			$perUU->lampiran = $pelembagaan->lampiran;
            $perUU->tgl_usulan = new DateTime;
          	// status kirim dari bagian pelembagaan
            $perUU->status = 1;

        
            if($perUU->save()){

            	$penanggungJawabPelembagaan = DAL_PenanggungJawabPelembagaan::getDataTable($id);

            	$penanggungJawab = new PenanggungJawabPerUU();
            	$penanggungJawab->id_per_uu = $perUU->id;
                    $penanggungJawab->nama = $penanggungJawabPelembagaan[0]->nama;
                    $penanggungJawab->jabatan = $penanggungJawabPelembagaan[0]->jabatan;
                    $penanggungJawab->NIP = $penanggungJawabPelembagaan[0]->nip;
                    $penanggungJawab->unit_kerja = $penanggungJawabPelembagaan[0]->unit_kerja;
                    $penanggungJawab->alamat_kantor = $penanggungJawabPelembagaan[0]->alamat_kantor;
                    $penanggungJawab->telepon_kantor = $penanggungJawabPelembagaan[0]->telp_kantor;
                    $penanggungJawab->email = $penanggungJawabPelembagaan[0]->email;
                    $penanggungJawab->save();
         
                    // kirim email ke admin per uu 
                    $data = array(
                        'user' => Auth::user(),
                        'perUU' => $perUU
                    );
                    Mail::send('emails.usulanbaru', $data, function($message) {
                        // admin email (testing)
                        $message->to('jufri.suandi@gmail.com', 'andhy.m0rphin@gmail.com')
                                ->subject('Usulan Baru dari Pelembagaan');
                    });

			        // EMAIL To User
					$data = array(
						'perihal' => Input::get('perihal'),
						'status' => $pelembagaan->getStatus(Input::get('status'))
					);

					// kirim email user... 
					Mail::send('emails.reppelembagaan', $data, function($message) use ($user)
					{
						$message->to(array('jufri.suandi@gmail.com', 'andhy.m0rphin@gmail.com')); 
						$message->subject('Re: Usulan Pelembagaan telh di redirect ke bagian per UU');
					});
            }
        }
		$pelembagaan->save();
//		$userid = pengguna::find($pelembagaan->ipengguna);

        // EMAIL To User
		$data = array(
			'perihal' => Input::get('perihal'),
			'status' => $pelembagaan->getStatus(Input::get('status'))
		);

		// kirim email user... 
		Mail::send('emails.reppelembagaan', $data, function($message) use ($user)
		{
			$message->to(array('jufri.suandi@gmail.com', 'andhy.m0rphin@gmail.com')); 
			$message->subject('Re: Usulan Pelembagaan');
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

		 
			Mail::send('emails.reqpelembagaan', $data, function($message) use ($user)
			{
			  $message->to(array('jufri.suandi@gmail.com', 'andhy.m0rphin@gmail.com'));
			  $message->subject('Usulan Pelembagaan');
			});


		if($uploadSuccess) {
			if($pelembagaan->save()) {
		     	$penanggungJawab = new PenanggungJawabPelembagaan();
				$penanggungJawab->pelembagaan_id = $pelembagaan->id;
				$penanggungJawab->nama = Input::get('nama_pemohon');
//				$penanggungJawab->jabatan = Input::get('jabatan');
				$penanggungJawab->nip = Input::get('nip');				
				$penanggungJawab->unit_kerja = Input::get('unit_kerja');
				$penanggungJawab->alamat_kantor = Input::get('alamat_kantor');
				$penanggungJawab->telp_kantor = Input::get('telp_kantor');
				$penanggungJawab->email = Input::get('email');
				$penanggungJawab->save();

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

    public function downloadLampiran($id)
    {
        $pelembagaan = Pelembagaan::find($id) or App::abort(404);
        $path = UPLOAD_PATH . DS . $pelembagaan->lampiran;
        return Response::download($path, explode('/', $pelembagaan->lampiran)[1]);
    }

	public function printTable() {
//		$dataPelembagaan = DAL_Pelembagaan::getDataTable();
//		echo "=================";
        $dataPerUU = DAL_PerUU::getDataTable();

        var_dump($dataPerUU);

		exit;
//		var_dump($dataPelembagaan);
//		exit;

/*
		$data = array();
		for($dataPelembagaan->get() as $index => $pelembagaan){
			$tglUsulan = new DateTime($pelembagaan->tgl_usulan);
			$data[$index]['ID'] = $pelembagaan->id;
			$data[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
			$data[$index]['Unit Kerja'] = $pelembagaan->unit_kerja;
			$data[$index]['Perihal'] = $pelembagaan->perihal;
			$data[$index]['status'] = "status";
			$data[$index]['lampiran'] = '<a href="#">'.$pelembagaan->lampiran.'</a>';		
		}

		$table = HukorHelper::generateHtmlTable($data);

		$html = <<<HTML
			<style>
				table{ border-collapse: collapse; }
				table td, table th { padding: 5px; }
			</style>
			<h1>Pelembagaan</h1>
			{$table}
HTML;
			$pdf = new DOMPDF();
			$pdf->load_html($html);
			$pdf->render();
			$pdf->stream("pelembagaan.pdf");
*/	
	}




}
