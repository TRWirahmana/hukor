<?php


class SistemDanProsedur extends Eloquent {
	protected $key = "id";
	protected $table = "sistem_dan_prosedur";
	public $timestamps = false;

	public function pengguna() {
		return $this->belongsTo('Pengguna', 'id_pengguna');
	}
	
    public function penanggungJawab()
    {
        return $this->hasOne('PenanggungJawabSistemDanProsedur', 'id_sistem_dan_prosedur');
    }

}