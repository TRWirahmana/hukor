<?php

class DAL_PerUU {
    public static function getDataTable() {
        return PerUU::join('pengguna', 'per_uu.id_pengguna', '=', 'pengguna.id')
                ->join('jabatan', 'pengguna.jabatan', '=', 'jabatan.id')
                ->select(array(
                    'per_uu.id',
                    'per_uu.tgl_usulan',
                    'pengguna.unit_kerja',
                    'jabatan.nama_jabatan',
                    'per_uu.perihal',
                    'per_uu.status',
                    'per_uu.lampiran'
        ));
    }
}
