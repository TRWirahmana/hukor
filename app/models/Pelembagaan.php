<?php

class Pelembagaan extends Eloquent {
  	protected $key = "id";
	protected $table = "pelembagaan";
	public $timestamps = false;

	// HAS ONE
	public function pengguna() {
		return $this->hasOne('Pengguna');
	}

//	public function 

}
