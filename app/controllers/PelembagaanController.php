<?php

use Carbon\Carbon;

class PelembagaanController extends BaseController {

	protected $layout = 'layouts.master';

	public function index()
	{
        if(Request::ajax())           
            return Datatables::of(DAL_Pelembagaan::getDataTable())->make(true);
            
	       	$listTgl = array("" => "Semua") + Pelembagaan::select(array( DB::raw('DATE_FORMAT(tgl_usulan,"%Y") As usulan_year')))
	        													->lists('usulan_year', 'usulan_year');
	    $this->layout->content = View::make('Pelembagaan.index', array( 'listTgl' => $listTgl ));		
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
	}    

	public function create()
	{

		$pelembagaan = new Pelembagaan();

		$this->layout->content = View::make('Pelembagaan.form', array(
				'title' => 'Tambah Akun',
				'detail' => 'Lengkapi formulir dibawah ini untuk menambahkan akun baru.',
				'form_opts' => array(
					'route' => 'pelembagaan.store',
					'method' => 'post',
					'class' => 'form-horizontal',
		            'id' => 'pelembagaan-form',
		            'files' => true
				),
				'pelembagaan' => $pelembagaan,
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
		$pelembagaan = Pelembagaan::find($id);
		//$pelembagaan->load('pengguna');
		if(!is_null($pelembagaan))
			$this->layout->content = View::make('Pelembagaan.update', array(
				'title' => 'Ubah Pelembagaan #' . $pelembagaan->id,
				'detail' => '',
				'form_opts' => array(
					'route' => array('pelembagaan.update', $pelembagaan->id),
					'method' => 'put',
					'class' => 'form-horizontal',
					'files' => true
				),
				'pelembagaan' => $pelembagaan,
//				'listRegion' => $listRegion,
//				'listRole' => $listRole
			));
	}

	public function update($id)
	{
		$input = Input::all();

		$pelembagaan = Pelembagaan::find($id);

		$pelembagaan->id_pengguna = 1;
		$pelembagaan->jenis_usulan = Input::get('jenis_usulan');
		$pelembagaan->perihal = Input::get('perihal');
		$pelembagaan->catatan = Input::get('catatan');
		$pelembagaan->lampiran = "filename";
		$pelembagaan->status = Input::get('status');

        $pelembagaan->tgl_usulan = Carbon::now();
        $pelembagaan->save();

		return Redirect::to('pelembagaan')->with('success', 'Data berhasil diubah.');
	}  

	public function store()
	{

        $img = Input::file('lampiran');

		$destinationPath = UPLOAD_PATH . '/';		
		$filename = $img->getClientOriginalName();
		$uploadSuccess = $img->move($destinationPath, $filename);
		
		$pelembagaan = new Pelembagaan;
		$pelembagaan->id_pengguna = 1;
		$pelembagaan->jenis_usulan = Input::get('jenis_usulan');
		$pelembagaan->perihal = Input::get('perihal');
		$pelembagaan->catatan = Input::get('catatan');
		$pelembagaan->lampiran = $filename;

        $pelembagaan->tgl_usulan = Carbon::now();

		if($uploadSuccess) {
			if($pelembagaan->save()) {
				Session::flash('success', 'Data berhasil dikirim.');
			} else {
				Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
			}					
		} else {
			Session::flash('error', 'Gagal mengirim berkas. Pastikan berkas berupa PDF dan kurang dari 512k.');
		}		
		return Redirect::back();            
	}


	public function prosesPengajuan()
	{
        $img = Input::file('lampiran');

		$destinationPath = UPLOAD_PATH . '/';
		$filename = $img->getClientOriginalName();
		$uploadSuccess = $img->move($destinationPath, $filename);

		$pelembagaan = new Pelembagaan;
		$pelembagaan->id_pengguna = 1;
		$pelembagaan->jenis_usulan = Input::get('jenis_usulan');
		$pelembagaan->perihal = Input::get('perihal');
		$pelembagaan->catatan = Input::get('catatan');
		$pelembagaan->lampiran = $filename;
        $pelembagaan->tanggal_usulan = Carbon::now();

		if($uploadSuccess) {
			if($pelembagaan->save()) {
				Session::flash('success', 'Data berhasil dikirim.');
			} else {
				Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
			}					
		} else {
			Session::flash('error', 'Gagal mengirim berkas. Pastikan berkas berupa PDF dan kurang dari 512k.');
		}		
		return Redirect::back();            
	}

	public function destroy($id)
	{
		$pelembagaan = Pelembagaan::find($id);

		//if(!is_null($pelembagaan)) {
			$pelembagaan->delete();
		//}
	}

}
