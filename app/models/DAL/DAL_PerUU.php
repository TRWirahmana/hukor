<?php

class DAL_PerUU {
    public static function getDataTable($filter = 0) {
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

        if(0 != $filter) 
            $data = $data->where('per_uu.id_pengguna', '=', 0);

        return $data;
    }
}
