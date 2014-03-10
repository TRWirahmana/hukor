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

	public static function getPrintTable($status, $firstDate, $lastDate) {
		$data = self::getDataTable($status, $firstDate, $lastDate);
		$result = array();
		foreach($data->get() as $index => $sp) {
			$tglUsulan = new DateTime($sp->tgl_usulan);
			$result[$index]['ID'] = $sp->id;
			$result[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
			$result[$index]['Unit Kerja'] = $sp->unit_kerja;
			$result[$index]['Perihal'] = $sp->perihal;
			$result[$index]['status'] = self::getStatus($sp->status);
			$url = URL::route('sp.download', array('id' => $sp->id));
			$result[$index]['lampiran'] = "<a href='{$url}'>Unduh</a>";
		}
		return HukorHelper::generateHtmlTable($result);
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

	public static function getUnreadCount() {
		$lastActive = Auth::user()->last_active;
		$count = SistemDanProsedur::where("tgl_usulan", ">=", $lastActive)->count();
		return $count;
	}

	public static function getTodayCount() {
		$count = SistemDanProsedur::where(DB::raw("DATE(tgl_usulan)"), "=", DB::raw("DATE(NOW())"))->count();
		return $count;
	}

	public static function getMonthlyCount() {
		return DB::table("bulan")
			->leftJoin('sistem_dan_prosedur', function($join){
					$join->on('bulan.id', '=', DB::raw('month(sistem_dan_prosedur.tgl_usulan)'))
					->on(DB::raw("year(sistem_dan_prosedur.tgl_usulan)"), "=", DB::raw("year(curdate())"));
					})
		->select(array(
					"bulan.nama",
					DB::raw("count(sistem_dan_prosedur.id) as jumlah")
			      ))
			->groupBy(DB::raw("bulan.nama"))
			->orderBy("bulan.id");

	}
}
