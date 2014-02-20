<?php

class LogPerUU extends Eloquent {
	protected $key = "id";
	protected $table = "log_per_uu";
	public $timestamps = false;

	public function perUU() {
		return $this->belongsTo('PerUU', 'id_per_uu');
	}
}