<?php
class Menu extends Eloquent {
    protected $key = "id";
    protected $table = "menu";
//    public $timestamps = false;

    public function submenu() {
        return $this->hasOne('Submenu');
    }

    public function layanan() {
        return $this->hasMany('Layanan');
    }
}