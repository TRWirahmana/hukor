<?php

class DAL_AnalisisJabatan {
    public static function getDataTable($filter = null, $firstDate = null, $lastDate = null) {
	$data = AnalisisJabatan::join('pengguna', 'analisis_jabatan.id_pengguna', '=', 'pengguna.id')
	    ->leftJoin('jabatan', 'pengguna.jabatan', '=', 'jabatan.id')
	    ->select(array(
			'analisis_jabatan.id',
			'analisis_jabatan.tgl_usulan',
			'pengguna.unit_kerja',
			'jabatan.nama_jabatan',
			'analisis_jabatan.perihal',
			'analisis_jabatan.status',
			'analisis_jabatan.lampiran'
			));

	if(null != $filter)
	    $data->where("analisis_jabatan.status", "=", $filter);
	if(null != $firstDate)
	    $data->where(DB::raw("DATE(analisis_jabatan.tgl_usulan)"), ">=", DateTime::createFromFormat("d/m/Y", $firstDate)->format('Y-m-d'));
	if(null != $lastDate)
	    $data->where(DB::raw("DATE(analisis_jabatan.tgl_usulan)"), "<=", DateTime::createFromFormat("d/m/Y", $lastDate)->format('Y-m-d'));

	return $data;
    }

    public static function getLogUsulan($id) {
	$data = LogAnalisisJabatan::select(array(
		    "id", 
		    "id_analisis_jabatan",
		    "catatan", 
		    "lampiran",
		    "tgl_proses", 
		    "status"))
	    ->where("id_analisis_jabatan", "=", $id)
	    ->orderBy('tgl_proses', 'desc ');
	return $data;
    }

    public static function getTotalCount() {
	return  AnalisisJabatan::count();
    }

    public static function getUnreadCount() {
	$lastActive = Auth::user()->last_active;
	$count = AnalisisJabatan::where("tgl_usulan", ">=", $lastActive)->count();
	return $count;
    }

    public static function getTodayCount() {
	$count = AnalisisJabatan::where(DB::raw("DATE(tgl_usulan)"), "=", DB::raw("DATE(NOW())"))->count();
	return $count;
    }

    public static function getMonthlyCount() {
	return DB::table("bulan")
	    ->leftJoin('analisis_jabatan', function($join){
		    $join->on('bulan.id', '=', DB::raw('month(analisis_jabatan.tgl_usulan)'))
		    ->on(DB::raw("year(analisis_jabatan.tgl_usulan)"), "=", DB::raw("year(curdate())"));
		    })
	->select(array(
		    "bulan.nama",
		    DB::raw("count(analisis_jabatan.id) as jumlah")
		    ))
	    ->groupBy(DB::raw("bulan.nama"))
	    ->orderBy("bulan.id");
    }



}
