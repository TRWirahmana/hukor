<?php
use Carbon\Carbon;

class DAL_Pelembagaan {
	public static function getDataTable($filter = null, $firstDate = null, $lastDate = null) {
		$data = Pelembagaan::join('penanggung_jawab_pelembagaan','pelembagaan.id', '=', 'penanggung_jawab_pelembagaan.pelembagaan_id')
			->
			select(array(
						'pelembagaan.id',
						'pelembagaan.tgl_usulan',
						'penanggung_jawab_pelembagaan.unit_kerja',
                        'pelembagaan.jenis_usulan',
						'pelembagaan.perihal',
						'pelembagaan.status',
						'pelembagaan.lampiran'

				    )); 

		$user = Auth::user();
		if(null != $user && 2 == $user->role_id)
			$data->where("pelembagaan.id_pengguna", "=", $user->pengguna->id); 
		if(null != $filter)
			$data->where('pelembagaan.status', '=', $filter);
		if(null != $firstDate)
			$data->where(DB::raw("DATE(pelembagaan.tgl_usulan)"), ">=", DateTime::createFromFormat("d/m/Y", $firstDate)->format('Y-m-d'));
		if(null != $lastDate)
			$data->where(DB::raw("DATE(pelembagaan.tgl_usulan)"), "<=", DateTime::createFromFormat("d/m/Y", $lastDate)->format('Y-m-d'));

		return $data;
	}  

    public function savePelembagaan($input, array $filenames ) 
    {
        $pelembagaan = new Pelembagaan;

        $pelembagaan->id_pengguna = $input['id'];
        $pelembagaan->jenis_usulan = $input['jenis_usulan'];
        $pelembagaan->perihal = $input['perihal'];
        $pelembagaan->catatan = $input['catatan'];
       // $pelembagaan->lampiran = $file->getClientOriginalName();
	$pelembagaan->lampiran = serialize($filenames);
        $pelembagaan->status = 0;   // status default = 0 (belum di proses)
        $pelembagaan->tgl_usulan = Carbon::now();
        $pelembagaan->save();

        $this->insertPenanggungJawab($pelembagaan->id, $input);
    }

    public function savePelembagaan1($input)
    {
        $pelembagaan = new Pelembagaan;

        $pelembagaan->id_pengguna = $input['id'];
        $pelembagaan->jenis_usulan = $input['jenis_usulan'];
        $pelembagaan->perihal = $input['perihal'];
        $pelembagaan->catatan = $input['catatan'];
        // $pelembagaan->lampiran = $file->getClientOriginalName();
//        $pelembagaan->lampiran = serialize($filenames);
        $pelembagaan->status = 0;   // status default = 0 (belum di proses)
        $pelembagaan->tgl_usulan = Carbon::now();
        $pelembagaan->save();

        $this->insertPenanggungJawab($pelembagaan->id, $input);
    }

    public function insertPenanggungJawab($idPelembagaan, $input)
    {
        $penanggungJawab = new PenanggungJawabPelembagaan();

        $penanggungJawab->pelembagaan_id = $idPelembagaan;
        $penanggungJawab->nama = $input['nama_pemohon'];
//      $penanggungJawab->jabatan = $input['jabatan'];
        $penanggungJawab->nip = $input['nip'];              
        $penanggungJawab->unit_kerja = $input['unit_kerja'];
        $penanggungJawab->alamat_kantor = $input['alamat_kantor'];
        $penanggungJawab->telp_kantor = $input['telp_kantor'];
        $penanggungJawab->hp = $input['hp'];
        $penanggungJawab->email = $input['email'];
        $penanggungJawab->save();
    }

    public static function getPelembagaanById($id){
        return Pelembagaan::find($id);
    }

//    public static function getPenangungJawab($idPelembagaan)
//    {
//        return DB::table('penanggung_jawab_pelembagaan')->
//                    where('pelembagaan_id', '=', $idPelembagaan);
//    }

    public static function getPenangungJawab($idPelembagaan)
    {
        return PenanggungJawabPelembagaan::where('pelembagaan_id', '=', $idPelembagaan )->get();
    }


    public static function sendToPerUU($idPelembagaan)
    {
        // Kirim Data Ke Bagian PerUU
        $pelembagaan = DAL_Pelembagaan::getPelembagaanById($idPelembagaan);
        $penanggungJawabPelembagaan = DAL_Pelembagaan::getPenangungJawab($idPelembagaan);

        $perUU = new PerUU;
        $perUU->id_pengguna = $pelembagaan->id_pengguna;
        $perUU->perihal = $pelembagaan->perihal;
        $perUU->catatan = $pelembagaan->catatan;
        $perUU->lampiran = $pelembagaan->lampiran;
        $perUU->tgl_usulan = new DateTime;
        $perUU->status = 1; // status kirim dari bagian pelembagaan
        $perUU->save();

        $penanggungJawab = new PenanggungJawabPerUU();
        $penanggungJawab->id_per_uu = $perUU->id;
        $penanggungJawab->nama = $penanggungJawabPelembagaan[0]->nama;
        $penanggungJawab->jabatan = $penanggungJawabPelembagaan[0]->jabatan;
        $penanggungJawab->NIP = $penanggungJawabPelembagaan[0]->nip;
        $penanggungJawab->unit_kerja = $penanggungJawabPelembagaan[0]->unit_kerja;

        $penanggungJawab->alamat_kantor = $penanggungJawabPelembagaan[0]->alamat_kantor;
        $penanggungJawab->telepon_kantor = $penanggungJawabPelembagaan[0]->telp_kantor;
        $penanggungJawab->no_handphone = $penanggungJawabPelembagaan[0]->hp;
        $penanggungJawab->email = $penanggungJawabPelembagaan[0]->email;
        $penanggungJawab->save();
    }

    public function saveLogPelembagaan($input, array $filenames, $id)
    {
        $pelembagaan = Pelembagaan::find($id);

        $log_pelembagaan = new LogPelembagaan();
        $log_pelembagaan->status = $pelembagaan->status;
        $log_pelembagaan->catatan = $pelembagaan->catatan;
        $log_pelembagaan->keterangan = $input['keterangan'];
	$log_pelembagaan->lampiran = $pelembagaan->lampiran;       // $log_pelembagaan->lampiran = $file->getClientOriginalName();
        $log_pelembagaan->pelembagaan_id = $pelembagaan->id;
        $log_pelembagaan->tgl_proses = Carbon::now();
        $log_pelembagaan->save();

        // change status pelembagaan
        $pelembagaan->status = $input['status'];
	$pelembagaan->catatan = $input['catatan'];
	$pelembagaan->lampiran = serialize($filenames);

        $pelembagaan->save();

        return $log_pelembagaan->status;
    }

    public function sendEmailToAllAdminPelembagaan()
    {
        $email = new HukorEmail();
        $reg = new DAL_Registrasi();

        $admin = DAL_Registrasi::findAdminByRoleId(8); //get all admin pelembagaan
        
        $data = array(
                    'title' => 'Pengajuan Usulan Pelembagaan',
                    'pengguna' => $reg->findPengguna(Auth::user()->id)
        );
        // send email to all admin pelembagaan
        foreach ($admin as $adm) {
            $email->sendMail('Usulan Pelembagaan', $adm->email, 'emails.usulan', $data);
        }
    }

    public function sendEmailToAllAdminPerUU()
    {
        $email = new HukorEmail();
        $reg = new DAL_Registrasi();

        $admin = DAL_Registrasi::findAdminByRoleId(6); //get all admin pelembagaan
        
        $data = array(
                    'title' => 'Pengajuan Usulan PerUU',
                    'pengguna' => $reg->findPengguna(Auth::user()->id)
        );
        // send email to all admin pelembagaan
        foreach ($admin as $adm) {
            $email->sendMail('Usulan PerU', $adm->email, 'emails.usulan', $data);
        }
    }

    public static function sendEmailToUser($id, $message)
    {
        $email = new HukorEmail();
        $dest = DAL_Pelembagaan::getEmailPenanggungJawab($id);

        $data = array(
                    'title' => 'Balasan Usulan Pelembagaan',
                    'pengguna' => 'testing'
        );
        $email->sendMail('Balasan Usulan Pelembagaan', $dest, 'emails.reppelembagaan', $data);
     //       ->subject($message);
    }

    public static function getEmailPenanggungJawab($id)
    {
        $email = DB::table('penanggung_jawab_pelembagaan')->select('email')
                 ->where('pelembagaan_id', '=', $id)->get(); 

        return $email[0]->email;
    }

  public static function getPrintTable($status, $firstDate, $lastDate) {
        $data = self::getDataTable($status, $firstDate, $lastDate)->get();
        $result = array();

        foreach($data as $index => $pelembagaan) {
            $tglUsulan = new DateTime($pelembagaan->tgl_usulan);
            $result[$index]['ID'] = $pelembagaan->id;
            $result[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
            $result[$index]['Unit Kerja'] = $pelembagaan->unit_kerja;
            $result[$index]['Perihal'] = $pelembagaan->perihal;
            $result[$index]['status'] = "status";
	    $url = URL::route('pelembagaan.download', array('id' => $pelembagaan->id));
//          $result[$index]['lampiran'] = '<a href="#">'.$pelembagaan->lampiran.'</a>';       
            $result[$index]['lampiran'] = "<a href='{$url}'>Unduh</a>";       
        }

      if(count($result) != 0){
          return HukorHelper::generateHtmlTable($result);
      }else{
          return count($result);
      }

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


