<?php
class Berita extends Eloquent {
    protected $key = "id";
    protected $table = "berita";
//    public $timestamps = false;

    public function kategori() {
    	return $this->belongsTo('Category', 'id_kategori');
    }
}