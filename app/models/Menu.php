<?php
class Menu extends Eloquent {
    protected $key = "id";
    protected $table = "menu";
    public $timestamps = true;
//    protected $guarded = array();

    public function submenu() {
        return $this->hasMany('Submenu');
    }

//    public function layanan() {
//        return $this->hasOne('Layanan');
//    }
}