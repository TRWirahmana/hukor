<?php

class DAL_Pelembagaan {
    public static function getDataTable($filter = null, $firstDate = null, $lastDate = null) {
	   $data = Pelembagaan::join('penanggung_jawab_pelembagaan','pelembagaan.id', '=', 'penanggung_jawab_pelembagaan.pelembagaan_id')
                        ->
                        select(array(
                            'pelembagaan.id',
                            'pelembagaan.tgl_usulan',
                            'penanggung_jawab_pelembagaan.unit_kerja',
                            'pelembagaan.perihal',
                            'pelembagaan.status',
                            'pelembagaan.lampiran',
                            'pelembagaan.jenis_usulan'
                )); 
                        
        if(null != $filter)
            $data->where('pelembagaan.status', '=', $filter);
        if(null != $firstDate)
            $data->where(DB::raw("DATE(pelembagaan.tgl_usulan)"), ">=", DateTime::createFromFormat("d/m/Y", $firstDate)->format('Y-m-d'));
        if(null != $lastDate)
            $data->where(DB::raw("DATE(pelembagaan.tgl_usulan)"), "<=", DateTime::createFromFormat("d/m/Y", $lastDate)->format('Y-m-d'));

        return $data;
    }  

    public static function getPrintTable($status, $firstDate, $lastDate) {
        $data = Self::getDataTable($status, $firstDate, $lastDate)->get();
        $result = array();

        foreach($data as $index => $pelembagaan) {
            $tglUsulan = new DateTime($pelembagaan->tgl_usulan);
            $result[$index]['ID'] = $pelembagaan->id;
            $result[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
            $result[$index]['Unit Kerja'] = $pelembagaan->unit_kerja;
            $result[$index]['Perihal'] = $pelembagaan->perihal;
            $result[$index]['status'] = "status";
            $result[$index]['lampiran'] = '<a href="#">'.$pelembagaan->lampiran.'</a>';       
        }

        return HukorHelper::generateHtmlTable($result);
    }

    public static function sendEmailToUser() {
        
        
    }


    public static function getMonthlyCount() {
        return DB::table("bulan")
                ->leftJoin('pelembagaan', function($join){
                    $join->on('bulan.id', '=', DB::raw('month(pelembagaan.tgl_usulan)'))
                        ->on(DB::raw("year(pelembagaan.tgl_usulan)"), "=", DB::raw("year(curdate())"));
                })
                ->select(array(
                    "bulan.nama",
                    DB::raw("count(pelembagaan.id) as jumlah")
                ))
                ->groupBy(DB::raw("bulan.nama"))
                ->orderBy("bulan.id");
    }

    public static function getTotalCount() {
        return  Pelembagaan::count();
    }

    public static function getUnreadCount() {
        $lastActive = Auth::user()->last_active;
        $count = Pelembagaan::where("tgl_usulan", ">=", $lastActive)->count();
        return $count;
    }

    public static function getTodayCount() {
        $count = Pelembagaan::where(DB::raw("DATE(tgl_usulan)"), "=", DB::raw("DATE(NOW())"))->count();
        return $count;
    }
}


