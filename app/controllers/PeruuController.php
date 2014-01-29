<?php

class PeruuController extends BaseController {

	protected $layout = 'layouts.master';

	public function index() 
	{
		// handle dataTable request
		if(Request::ajax()) 
			return Datatables::of(DAL_PerUU::getDataTable(Input::get('filter', 0)))->make(true);
		$this->layout->content = View::make('PerUU.index');
	}

	public function pengajuanUsulan()
	{
		$user = User::find(1);
		$this->layout->content = View::make('PerUU.pengajuanUsulan')
			->with('user', $user);
	}

	public function prosesPengajuan()
	{
		$input = Input::get('per_uu');
		$img = Input::file('per_uu.lampiran');

		if($img->isValid()) {
			$uqFolder = str_random(8);
			$destinationPath = UPLOAD_PATH . '/' . $uqFolder;
			$filename = $img->getClientOriginalName();
			$uploadSuccess = $img->move($destinationPath, $filename);

			if($uploadSuccess) {
				$perUU = new PerUU;
				$perUU->id_pengguna = 1;
				$perUU->perihal = $input['perihal'];
				$perUU->catatan = $input['catatan'];
				$perUU->lampiran = $uqFolder . DS .$filename;
				$perUU->tgl_usulan = new DateTime;
				$perUU->status = 0;
				if($perUU->save()) {
					Session::flash('success', 'Data berhasil dikirim.');
					return Redirect::route('index_per_uu');
				} else {
					Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
					return Redirect::back();
				}
			}
		} else {
			Session::flash('error', 'Gagal mengirim berkas. Pastikan berkas berupa PDF dan kurang dari 512k.');
			return Redirect::back();
		}



	}

	public function updateUsulan($id) {
		$perUU = PerUU::with('Pengguna')->find($id);
		$this->layout->content = View::make('PerUU.updateUsulan')
			->with('perUU', $perUU);
	}

	public function prosesUpdateUsulan() {

		$id = Input::get('id');
		$status = Input::get('status', 0);
		$catatan = Input::get('catatan', '');
		$ketLampiran = Input::get('ket_lampiran', '');
		$lampiran = Input::file('lampiran');

		$perUU = PerUU::find($id);
		$perUU->status = $status;
		$perUU->catatan = $catatan;

		if(null != $lampiran && $lampiran->isValid()) {
			$uqFolder = str_random(8);
			$destinationPath = UPLOAD_PATH . '/' . $uqFolder;
			$filename = $lampiran->getClientOriginalName();
			$uploadSuccess = $lampiran->move($destinationPath, $filename);
			if($uploadSuccess) {
				$perUU->lampiran = $uqFolder . DS . $filename;
			} else {
				Session::flash('error', 'Kesalahan dalam menyimpan berkas.');
			}
		} else {
			Session::flash('error', 'Kesalahan dalam menyimpan berkas.');
		}
		Session::flash('success', 'Usulan berhasil diperbaharui.');

		$perUU->save();

		return Redirect::route('index_per_uu');
	}

	public function hapusUsulan() {
		$perUU = PerUU::find(Input::get('id'));
		if(null != $perUU) 
			$perUU->delete();
	}

}
