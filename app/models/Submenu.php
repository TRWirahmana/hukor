<?php
class Submenu extends Eloquent {
    protected $key = "id";
    protected $table = "sub_menu";
    protected $guarded = array();
    public $timestamps = true;

    public function menu() {
        return $this->belongsTo('Menu');
    }

    public function layanan() {
        return $this->hasOne('Layanan');
    }
}