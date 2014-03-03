<?php
class Bagian extends Eloquent {
    protected $key = "id";
    protected $table = "bagian";
    protected $guarded = array();
    public $timestamps = false;

    public function pengguna() {
        return $this->belongsToMany('Pengguna');
    }
}