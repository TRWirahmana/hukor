<?php

class DAL_PerUU {
    public static function getDataTable($filter = null, $firstDate = null, $lastDate = null) {
        $data = PerUU::join('pengguna', 'per_uu.id_pengguna', '=', 'pengguna.id')
                ->leftJoin('jabatan', 'pengguna.jabatan', '=', 'jabatan.id')
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

        if(null != $firstDate) {
            $firstDate = DateTime::createFromFormat("d/m/Y", $firstDate);
            
        }

        return $data;
    }

    public static function getLogUsulan($id) {
        $data = LogPerUU::select(array(
            "id", 
            "id_per_uu",
            "catatan", 
            "lampiran",
            "tgl_proses", 
            "status"))
        ->where("id_per_uu", "=", $id)
        ->orderBy('tgl_proses', 'desc ');
        return $data;
    }
}
