<?php

class PeruuController extends BaseController {

	protected $layout = 'layouts.master';

	public function pengajuanUsulan()
	{
		$this->layout->content = View::make('PerUU.pengajuanUsulan');
	}

	public function prosesPengajuan()
	{
		return "<h1>Pengajuan Sudah Diproses";
	}

}