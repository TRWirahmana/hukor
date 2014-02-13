<?php

class Category extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function berita() {
		return $this->hasMany('Berita', 'id_kategori');
	}
}
