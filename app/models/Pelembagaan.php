<?php

class Pelembagaan extends Eloquent {
  	protected $key = "id";
	protected $table = "pelembagaan";
	public $timestamps = false;

	public function pengguna() {
		return $this->belongsTo('Pengguna', 'id_pengguna');
	}

    public function logPelembagaan() {
        return $this->hasMany('LogPelembagaan');
    }
}
