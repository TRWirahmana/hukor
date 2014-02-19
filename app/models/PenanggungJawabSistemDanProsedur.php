<?php

class PenanggungJawabSistemDanProsedur extends Eloquent {
	protected $key = "id";
	protected $table = "penanggung_jawab_sistem_dan_prosedur";
	public $timestamps = false;

	public function sistemDanProsedur()
    {
        return $this->belongsTo('SistemDanProsedur', 'id_sistem_dan_prosedur');
    }
}