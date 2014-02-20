<?php

class PJBantuanHukum extends Eloquent {

    protected $key = 'id';
    protected $table = 'pj_bantuan_hukum';
    protected $guarded = array();

    public function bantuanhukum(){
        return $this->belongsTo('BantuanHukum');
    }

}