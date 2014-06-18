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
	
	$user = Auth::user();
	if(null != $user && 2 == $user->role_id)
		$data->where("per_uu.id_pengguna", "=", $user->pengguna->id);	

	if(null != $filter)
		$data->where("per_uu.status", "=", $filter);
	if(null != $firstDate)
		$data->where(DB::raw("DATE(per_uu.tgl_usulan)"), ">=", DateTime::createFromFormat("d/m/Y", $firstDate)->format('Y-m-d'));
	if(null != $lastDate)
		$data->where(DB::raw("DATE(per_uu.tgl_usulan)"), "<=", DateTime::createFromFormat("d/m/Y", $lastDate)->format('Y-m-d'));

	return $data;
    }

    public static function getPrintTable($status, $firstDate, $lastDate) {
	    $data = self::getDataTable($status, $firstDate, $lastDate);

	    $result = array();
	    foreach($data->get() as $index => $perUU) {
		    $tglUsulan = new DateTime($perUU->tgl_usulan);
		    $result[$index]['ID'] = $perUU->id;
		    $result[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
		    $result[$index]['Unit Kerja'] = $perUU->unit_kerja;
		    $result[$index]['Perihal'] = $perUU->perihal;
		    $result[$index]['status'] = self::getStatus($perUU->status);
		    $url = URL::route('puu.download', array('id' => $perUU->id));
		    $result[$index]['lampiran'] = "<a href='{$url}'>Unduh</a>";
	    }


        if(count($result) != 0){
            return HukorHelper::generateHtmlTable($result);
        }else{
            return count($result);
        }

    }

    public static function getLogUsulan($id) {
        $data = LogPerUU::select(array(
            "id",
            "id_per_uu",
            "catatan", 
            "lampiran",
            "tgl_proses", 
            "status",
            "updated_by"))
        ->where("id_per_uu", "=", $id)
        ->orderBy('tgl_proses', 'desc ');
        return $data;
    }

    public static function getMonthlyCount() {
        return DB::table("bulan")
                ->leftJoin('per_uu', function($join){
                    $join->on('bulan.id', '=', DB::raw('month(per_uu.tgl_usulan)'))
                        ->on(DB::raw("year(per_uu.tgl_usulan)"), "=", DB::raw("year(curdate())"));
                })
                ->select(array(
                    "bulan.nama",
                    DB::raw("count(per_uu.id) as jumlah")
                ))
                ->groupBy(DB::raw("bulan.nama"))
                ->orderBy("bulan.id");
    }


    public static function getStatus($status) {
        switch ($status) {
            case 1:
                return "Diproses";
                break;
            case 2:
                return "Ditunda";
                break;
            case 3:
                return "Ditolak";
                break;
            case 4:
                return "Buat Salinan";
                break;
            case 5:
                return "Penetapan";
                break;
            default:
                return "";
                break;
        }
    }

    public static function getTotalCount() {
        return  PerUU::count();
    }

    public static function getUnreadCount() {
        $lastActive = Auth::user()->last_active;
        $count = PerUU::where("tgl_usulan", ">=", $lastActive)->count();
        return $count;
    }

    public static function getTodayCount() {
        $count = PerUU::where(DB::raw("DATE(tgl_usulan)"), "=", DB::raw("DATE(NOW())"))->count();
        return $count;
    }
}
