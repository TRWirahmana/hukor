<?php
class Bagian extends Eloquent {
    protected $key = "id";
    protected $table = "bagian";
    protected $guarded = array();
    public $timestamps = false;

    public function pengguna() {
        return $this->belongsToMany('Pengguna');
    }

    public function layanan() {
        return $this->hasOne('Layanan', 'penanggung_jawab');
    }
}