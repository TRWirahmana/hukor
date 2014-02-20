<?php

class PenanggungJawabAnalisisJabatan extends Eloquent
{
	protected $key = "id";
	protected $table = "penanggung_jawab_analisis_jabatan";
	public $timestamps = false;

	public function analisisJabatan()
	{
		return $this->belongsTo('AnalisisJabatan', 'id_analisis_jabatan');
	}
}