<?php

class PerUU extends Eloquent
{

    protected $key = "id";
    protected $table = "per_uu";
    public $timestamps = false;

    public function pengguna()
    {
        return $this->belongsTo('Pengguna', 'id_pengguna');
    }

    public function log()
    {
        return $this->hasMany('LogPerUU', "id_per_uu");
    }

    public function penanggungJawab()
    {
        return $this->hasOne('PenanggungJawabPerUU', 'id_per_uu');
    }

}
