<?php

class PenanggungJawabPelembagaan extends Eloquent
{

    protected $key = "id";
    protected $table = "penanggung_jawab_pelembagaan";
    public $timestamps = false;

    public function pelembagaan()
    {
        return $this->belongsTo('Pelembagaan', 'pelembagaan_id');
    }
    
}

