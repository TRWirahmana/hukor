<?php
class Layanan extends Eloquent {
    protected $key = "id";
    protected $table = "layanan";
//    public $timestamps = false;

    public function submenu() {
        return $this->belongsTo('Submenu');
    }

    public function menu() {
        return $this->belongsTo('Menu');
    }
}