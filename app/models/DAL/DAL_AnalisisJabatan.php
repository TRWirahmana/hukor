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
        if(count($result) != 0){
            return HukorHelper::generateHtmlTable($result);
        }else{
            return count($result);
        }

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

    public static function save($input, $filenames)
    {
        $analisisJabatan = new AnalisisJabatan;
        $analisisJabatan->id_pengguna = Auth::user()->pengguna->id;
        $analisisJabatan->perihal = $input['analisisJabatan']['perihal'];
        $analisisJabatan->catatan = $input['analisisJabatan']['catatan'];
        $analisisJabatan->lampiran = serialize($filenames);
        $analisisJabatan->tgl_usulan = new DateTime;
        $analisisJabatan->status = 0;

        if ($analisisJabatan->save()) {
            $pj = DAL_AnalisisJabatan::savePenanggungJawab($input['penanggungJawab'], $analisisJabatan->id);

            // kirim email ke admin
            $data = array(
                'user' => Auth::user(),
                'data' => $analisisJabatan
            );
            Mail::send('AnalisisJabatan.emailUsulan', $data, function($message) {
                // admin email (testing)
                $message->to('egisolehhasdi@gmail.com', 'egisolehhasdi@gmail.com')
                    ->subject('Usulan Baru Analisis Jabatan');
            });

            return ($pj == true) ? true : false;
        }
        else
        {
            return false;
        }
    }

    public static function savePenanggungJawab($input, $id)
    {
        $penanggungJawab = new PenanggungJawabAnalisisJabatan();
        $penanggungJawab->id_analisis_jabatan = $id;
        $penanggungJawab->nama = $input['nama'];
        $penanggungJawab->jabatan = $input['jabatan'];
        $penanggungJawab->NIP = $input['nip'];
        $penanggungJawab->no_handphone = $input['no_handphone'];
        $penanggungJawab->unit_kerja = $input['unit_kerja'];
        $penanggungJawab->alamat_kantor = $input['alamat_kantor'];
        $penanggungJawab->telepon_kantor = $input['telp_kantor'];
        $penanggungJawab->email = $input['email'];
        $penanggungJawab->save();

        if($penanggungJawab->save())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function update($id, $input, $filenames)
    {
        $analisisJabatan = AnalisisJabatan::find($id);

        $logAnalisisJabatan = new LogAnalisisJabatan();
        $logAnalisisJabatan->id_analisis_jabatan = $analisisJabatan->id;
        $logAnalisisJabatan->catatan = $input['catatan'];
        $logAnalisisJabatan->lampiran = serialize($filenames);
        $logAnalisisJabatan->status = $input['status'];
        $logAnalisisJabatan->tgl_proses = new DateTime('now');
        $logAnalisisJabatan->ket_lampiran = $input['ket_lampiran'];

        $analisisJabatan->status = $input['status'];
        $analisisJabatan->catatan = $input['catatan'];
        $analisisJabatan->lampiran = serialize($filenames);

        if ($analisisJabatan->save() && $logAnalisisJabatan->save()) {
            // Kirim email notifikasi ke pembuat usulan
            $data = array(
                'log' => $logAnalisisJabatan,
                'data' => $analisisJabatan
            );

            if(Auth::user()->role_id = 2)
            {
                $user = Pengguna::join('user', 'pengguna.user_id', '=', 'user.id')
                    ->where('user.role_id', '=', 3)->orWhere('user.role_id', '=', 9)->get(array('pengguna.email'));

                foreach($user as $dat)
                {
                    Mail::send('AnalisisJabatan.emailUpdate', $data, function($message) use($dat) {
                        $message->to($dat->email)
                            ->subject('Perubahan Status Usulan Analisis Jabatan');
                    });
                }
            }else{
                Mail::send('AnalisisJabatan.emailUpdate', $data, function($message) use($analisisJabatan) {
                    $message->to($analisisJabatan->pengguna->email)
                        ->subject('Perubahan Status Usulan Analisis Jabatan');
                });
            }

            return true;

        } else {
            return false;
        }
    }

    public function saveLog($id)
    {
        $analisisJabatan = AnalisisJabatan::find($id);

        $logAnalisisJabatan = new LogAnalisisJabatan();
        $logAnalisisJabatan->id_analisis_jabatan = $analisisJabatan->id;
        $logAnalisisJabatan->catatan = $analisisJabatan->catatan;
        $logAnalisisJabatan->lampiran = $analisisJabatan->lampiran;
        $logAnalisisJabatan->status = $analisisJabatan->status;
        $logAnalisisJabatan->tgl_proses = new DateTime('now');
    }



}
