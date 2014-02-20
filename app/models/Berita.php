<?php
class Berita extends Eloquent {
    protected $key = 'id';
    protected $table = 'berita';
    protected $guarded = array();
//    public $timestamps = false;

    public function kategori() {
    	return $this->belongsTo('Category', 'id_kategori');
    }
}