<?php

class PelembagaanController extends BaseController {

	protected $layout = 'layouts.master';

	public function pengajuanUsulan()
	{
		$this->layout->content = View::make('Pelembagaan.pengajuanUsulan');
	}

	public function prosesPengajuan()
	{
		return "<h1>Pengajuan Sudah Diproses";
	}

  	public function datatable()
    	{
		$input = Input::all();
		$DAL = new DAL_BantuanHukum();
		$data = $DAL->GetAllData($input);

		return $data;
	}

}
