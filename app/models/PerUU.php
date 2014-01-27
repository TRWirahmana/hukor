<?php

class PerUU extends Eloquent {
	protected $key = "id";
	protected $table = "per_uu";
	public $timestamps = false;

	public function pengguna() {
		return $this->belongsTo('Pengguna', 'id_pengguna');
	}
}