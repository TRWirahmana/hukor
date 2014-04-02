<?php
class Layanan extends Eloquent {
    protected $key = "id";
    protected $table = "layanan";
    protected $guarded = array();
    public $timestamps = true;

    public function submenu() {
        return $this->belongsTo('Submenu');
    }

    public function menu() {
        return $this->belongsTo('Menu');
    }

    public function bagian() {
        return $this->belongsTo('Bagian', 'id');
    }
}