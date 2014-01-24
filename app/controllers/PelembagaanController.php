<?php

use Carbon\Carbon;

class PelembagaanController extends BaseController {

	protected $layout = 'layouts.master';

	public function index()
	{            
            	$this->layout->content = View::make('Pelembagaan.index');		
	}

	public function listUsulan()
	{
           //     $data =  Pelembagaan::find(1)->pengguna;
            if(Request::ajax())
                return Datatables::of(DAL_Pelembagaan::getDataTable())->make(true);
            
            $this->layout->content = View::make('Pelembagaan.list');		
	}

        public function datatable()
        {
            $input = Input::all();
            $DAL = new DAL_Pelembagaan;            
            $data = $DAL->GetAllData($input);
            
            return $data;
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
}
