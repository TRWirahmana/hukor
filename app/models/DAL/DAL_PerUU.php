<?php

class DAL_PerUU {
    public static function getDataTable($filter = null) {
        $data = PerUU::join('pengguna', 'per_uu.id_pengguna', '=', 'pengguna.id')
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

        if(null != $filter) {
            $data->where("per_uu.status", "=", $filter);
        }

        return $data;
    }

    public static function getLogUsulan($id) {
        $data = LogPerUU::select(array(
            "id", 
            "catatan", 
            "lampiran",
            "tgl_proses", 
            "status"))
        ->where("id_per_uu", "=", $id)
        ->orderBy('tgl_proses', 'desc ');
        return $data;
    }
}
