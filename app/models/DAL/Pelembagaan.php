<?php

class DAL_Pelembagaan {
    public static function getDataTable() {
	return Pelembagaan::  join('penanggung_jawab_pelembagaan','pelembagaan.id', '=', 'penanggung_jawab_pelembagaan.pelembagaan_id')
                        ->select(array(
                            'pelembagaan.id',
                            'pelembagaan.tgl_usulan',
                            'penanggung_jawab_pelembagaan.unit_kerja',
                            'penanggung_jawab_pelembagaan.jabatan',
                            'pelembagaan.perihal',
                            'pelembagaan.status',
                            'pelembagaan.lampiran'
                ));  
    }
}


