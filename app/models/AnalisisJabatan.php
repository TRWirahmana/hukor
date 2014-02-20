<?php

class AnalisisJabatan extends Eloquent {
	protected $key = "id";
	protected $table = "analisis_jabatan";
	public $timestamps = false;

	public function penanggungJawab() {
		return $this->hasOne('PenanggungJawabAnalisisJabatan', 'id_analisis_jabatan');
	}

	public function pengguna() {
		return $this->belongsTo('Pengguna', 'id_pengguna');
	}

}