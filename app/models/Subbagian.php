<?php
class Subbagian extends Eloquent {
    protected $key = "id";
    protected $table = "sub_bagian";
    protected $guarded = array();
    public $timestamps = false;

    public function bagian() {
        return $this->belongsTo('Bagian', 'id_bagian');
    }
}