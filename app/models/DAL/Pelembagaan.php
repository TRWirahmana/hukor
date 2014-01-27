<?php

class DAL_Pelembagaan {
    public static function getDataTable() {
	return Pelembagaan::join('pengguna', 'pelembagaan.id_pengguna','=', 'pengguna.user_id')
                        ->select(array(
                            'pelembagaan.id',
                            'pelembagaan.tgl_usulan',
                            'pengguna.unit_kerja',
                            'pengguna.jabatan',
                            'pelembagaan.perihal',
                            'pelembagaan.status'
                ));     
    }
}


