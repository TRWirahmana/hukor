<?php

class DAL_LogPelembagaan {
    public static function getDataTable($id) {
	return LogPelembagaan::join('pelembagaan', 'pelembagaan.id','=', 'log_pelembagaan.pelembagaan_id')
                        ->select(array(
                            'log_pelembagaan.pelembagaan_id',
                            'log_pelembagaan.tgl_proses',
                            'log_pelembagaan.status',
                            'log_pelembagaan.catatan',
                            'log_pelembagaan.lampiran',
                            'log_pelembagaan.keterangan'
                ))->where('log_pelembagaan.pelembagaan_id', '=', $id);    
    }
}


