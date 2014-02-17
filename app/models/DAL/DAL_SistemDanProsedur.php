<?php


class DAL_SistemDanProsedur {
	public static function getDataTable($filter = null, $firstDate = null, $lastDate = null) {
        $data = SistemDanProsedur::join('pengguna', 'sistem_dan_prosedur.id_pengguna', '=', 'pengguna.id')
                ->leftJoin('jabatan', 'pengguna.jabatan', '=', 'jabatan.id')
                ->select(array(
                    'sistem_dan_prosedur.id',
                    'sistem_dan_prosedur.tgl_usulan',
                    'pengguna.unit_kerja',
                    'jabatan.nama_jabatan',
                    'sistem_dan_prosedur.perihal',
                    'sistem_dan_prosedur.status',
                    'sistem_dan_prosedur.lampiran'
        ));

        if(null != $filter)
            $data->where("sistem_dan_prosedur.status", "=", $filter);
        if(null != $firstDate)
            $data->where(DB::raw("DATE(sistem_dan_prosedur.tgl_usulan)"), ">=", DateTime::createFromFormat("d/m/Y", $firstDate)->format('Y-m-d'));
        if(null != $lastDate)
            $data->where(DB::raw("DATE(sistem_dan_prosedur.tgl_usulan)"), "<=", DateTime::createFromFormat("d/m/Y", $lastDate)->format('Y-m-d'));

        return $data;
    }

    public static function getLogUsulan($id) {
        $data = LogSistemDanProsedur::select(array(
            "id", 
            "id_sistem_dan_prosedur",
            "catatan", 
            "lampiran",
            "tgl_proses", 
            "status"))
        ->where("id_sistem_dan_prosedur", "=", $id)
        ->orderBy('tgl_proses', 'desc ');
        return $data;
    }

     public static function getTotalCount() {
        return  SistemDanProsedur::count();
    }

    public static function getUnreadCount() {
        $lastActive = Auth::user()->last_active;
        $count = SistemDanProsedur::where("tgl_usulan", ">=", $lastActive)->count();
        return $count;
    }

    public static function getTodayCount() {
        $count = SistemDanProsedur::where(DB::raw("DATE(tgl_usulan)"), "=", DB::raw("DATE(NOW())"))->count();
        return $count;
    }
}