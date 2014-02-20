<?php

class BantuanHukum extends Eloquent {

    protected $key = 'id';
    protected $table = 'bantuan_hukum';
    protected $guarded = array();

    public function pengguna(){
        return $this->belongsTo('Pengguna');
    }

    public function pjbantuanhukum(){
        return $this->hasOne('PJBantuanHukum');
    }

}