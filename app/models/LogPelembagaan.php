<?php

class LogPelembagaan extends Eloquent {
  	protected $key = "id";
	protected $table = "log_pelembagaan";
	public $timestamps = false;

	public function pelembagaan() {
		return $this->belongsTo('Pelembagaan', 'pelembagaan_id');
	}
}