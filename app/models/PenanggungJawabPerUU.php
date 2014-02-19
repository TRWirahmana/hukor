<?php

class PenanggungJawabPerUU extends Eloquent
{

    protected $key = "id";
    protected $table = "penanggung_jawab_per_uu";
    public $timestamps = false;

    public function perUU()
    {
        return $this->belongsTo('PerUU', 'id_per_uu');
    }

}

