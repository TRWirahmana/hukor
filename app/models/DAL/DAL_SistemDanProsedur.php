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
		$user = Auth::user();
		if(null != $user && $user->role_id == 2)
			$data->where("sistem_dan_prosedur.id_pengguna", "=", $user->pengguna->id);
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

        if(count($result) != 0){
            return HukorHelper::generateHtmlTable($result);
        }else{
            return count($result);
        }
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

    public static function save($input, $filenames)
    {
        $sistemDanProsedur = new SistemDanProsedur;
        $sistemDanProsedur->id_pengguna = Auth::user()->pengguna->id;
        $sistemDanProsedur->perihal = $input['sistem_dan_prosedur']['perihal'];
        $sistemDanProsedur->catatan = $input['sistem_dan_prosedur']['catatan'];
        $sistemDanProsedur->lampiran = serialize($filenames);
        $sistemDanProsedur->tgl_usulan = new DateTime;
        $sistemDanProsedur->status = 0;
        if ($sistemDanProsedur->save()) {

            $pj = DAL_SistemDanProsedur::savePenanggungJawab($input['penanggungJawab'], $sistemDanProsedur->id);

            if($pj == true)
            {
                // kirim email ke admin
                $data = array(
                    'user' => Auth::user(),
                    'data' => $sistemDanProsedur
                );
                Mail::send('emails.SistemDanProsedur.new', $data, function($message) {
                    // admin email (testing)
                    $message->to('egisolehhasdi@gmail.com', 'egisolehhasdi@gmail.com')
                        ->subject('Usulan Baru Sistem dan Prosedur');
                });

                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public static function savePenanggungJawab($input, $spID)
    {
        $penanggungJawab = new PenanggungJawabSistemDanProsedur();
        $penanggungJawab->id_sistem_dan_prosedur = $spID;
        $penanggungJawab->nama = $input['nama'];
        $penanggungJawab->no_handphone = $input['no_handphone'];
        $penanggungJawab->jabatan = $input['jabatan'];
        $penanggungJawab->NIP = $input['nip'];
        $penanggungJawab->unit_kerja = $input['unit_kerja'];
        $penanggungJawab->alamat_kantor = $input['alamat_kantor'];
        $penanggungJawab->telepon_kantor = $input['telp_kantor'];
        $penanggungJawab->email = $input['email'];

        if($penanggungJawab->save())
        {
            return true;
        } else {
            return false;
        }
    }

    public static function update($id, $input, $filenames)
    {
        $sistemDanProsedur = SistemDanProsedur::find($id);

        $log = new LogSistemDanProsedur();
        $log->id_sistem_dan_prosedur = $sistemDanProsedur->id;
        $log->catatan = $input['catatan'];
        $log->lampiran = serialize($filenames);
        $log->status = $input['status'];
        $log->tgl_proses = new DateTime('now');

        $sistemDanProsedur->status = $input['status'];
        $sistemDanProsedur->lampiran = serialize($filenames);

        if ($sistemDanProsedur->save() && $log->save()) {
            // Kirim email notifikasi ke pembuat usulan
            $data = array(
                'log' => $log,
                'data' => $sistemDanProsedur
            );

            if(Auth::user()->role_id = 2)
            {
                $user = Pengguna::join('user', 'pengguna.user_id', '=', 'user.id')
                    ->where('user.role_id', '=', 3)->orWhere('user.role_id', '=', 10)->get(array('pengguna.email'));

                foreach($user as $dat)
                {
                    Mail::send('emails.SistemDanProsedur.update', $data, function($message) use($dat) {
                        $message->to($dat->email)
                            ->subject('Perubahan Status Usulan');
                    });
                }
            }else{
                Mail::send('emails.SistemDanProsedur.update', $data, function($message) use($sistemDanProsedur) {
                    $message->to($sistemDanProsedur->pengguna->email)
                        ->subject('Perubahan Status Usulan');
                });
            }

            return true;
        } else {
            return false;
        }
    }
}
