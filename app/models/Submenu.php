<?php
class Submenu extends Eloquent {
    protected $key = "id";
    protected $table = "sub_menu";
//    public $timestamps = false;

    public function menu() {
        return $this->belongsTo('Menu');
    }

    public function layanan() {
        return $this->hasOne('Layanan');
    }
}