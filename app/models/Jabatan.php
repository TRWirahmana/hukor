<?php

class Jabatan extends Eloquent {
	protected $key = "id";
	protected $table = "jabatan";

	public function pengguna() {
		return $this->hasMany('Pengguna');
	}
}