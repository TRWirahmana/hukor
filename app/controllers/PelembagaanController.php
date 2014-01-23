<?php

class PelembagaanController extends BaseController {

	protected $layout = 'layouts.master';

	public function index()
	{
		$this->layout->content = View::make('Pelembagaan.index');		
	}


	public function pengajuanUsulan()
	{
                $user = User::find(1);

                $pengguna = Pengguna::find(1);

		$this->layout->content = View::make('Pelembagaan.pengajuanUsulan')
                        ->with('user', $user)->with('pengguna', $pengguna);
	}

	public function prosesPengajuan()
	{

		$rules = array(
			'jenis_usulan' => 'required',
			'perihal'      => 'required',
			'catatan'      => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);            
		} else {



                $img = Input::file('lampiran');

		$destinationPath = UPLOAD_PATH . '/' . str_random(8);
		$filename = $img->getClientOriginalName();
		$uploadSuccess = $img->move($destinationPath, $filename);

		$pelembagaan = new Pelembagaan;
		$pelembagaan->id_pengguna = 1;
		$pelembagaan->jenis_usulan = Input::get('jenis_usulan');
		$pelembagaan->perihal = Input::get('perihal');
		$pelembagaan->catatan = Input::get('catatan');
		$pelembagaan->lampiran = $filename;

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
}

}
