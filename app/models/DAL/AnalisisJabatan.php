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

	public static function getPrintTable($status, $firstDate, $lastDate) {
		$data = self::getDataTable($status, $firstDate, $lastDate);
		$result = array();
		foreach($data->get() as $index => $aj) {
			$tglUsulan = new DateTime($aj->tgl_usulan);
			$result[$index]['ID'] = $aj->id;
			$result[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
			$result[$index]['Unit Kerja'] = $aj->unit_kerja;
			$result[$index]['Perihal'] = $aj->perihal;
			$result[$index]['status'] = self::getStatus($aj->status);
			$url = URL::route('aj.download', array('id' => $aj->id));
			$result[$index]['lampiran'] = "<a href='{$url}'>Unduh</a>";
		}
		return HukorHelper::generateHtmlTable($result);
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
