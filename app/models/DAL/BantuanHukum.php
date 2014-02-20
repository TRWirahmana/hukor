<?php

class DAL_BantuanHukun
{
    /*
     * mengambil seluruh data pada table bantuan_hukum
     * $filter : variabel array yang berfungsi untuk memfilter datatable
     */

    public function GetAllData($filter)
    {
        //get all record
        $data = BantuanHukum::with('pengguna');

        //count all record
        $iTotalRecords = $data->count();

        //filter jenis_perkara
        if ($filter['jenis_perkara'] == 0) {
            $data->where('jenis_perkara', '!=', "NULL");
        } else {
            $data->where('jenis_perkara', '=', intval($filter['jenis_perkara']));
        }

        //filter status_pemohon
        if ($filter['status_pemohon'] == 0) {
            $data->where('status_pemohon', '!=', "NULL");
        } else {
            $data->where('status_pemohon', '=', intval($filter['status_pemohon']));
        }

        //filter status_pemohon
        if ($filter['advokasi'] != 0) {
            $data->where('advokasi', '=', intval($filter['advokasi']));
        }

        //search specific record
        if (!empty($filter['sSearch'])) {
//            $param = $filter['sSearch'];
            $data->where('status_perkara', 'like', "%{$filter['sSearch']}%")
                    ->orWhere('advokator', 'like', "%{$filter['sSearch']}%")
            ;
        }

        //count record after filtering
        $iTotalDisplayRecords = $data->count();

        $data = $data->skip($filter['iDisplayStart'])->take($filter['iDisplayLength']);

        return Response::json(array(
                    "sEcho" => $filter['sEcho'],
                    'aaData' => $data->get()->toArray(),
                    'iTotalRecords' => $iTotalRecords,
                    'iTotalDisplayRecords' => $iTotalDisplayRecords
        ));
    }

    public static function getDataTable($firstDate = null, $lastDate = null) {
        $data = BantuanHukum::join('pengguna', 'pengguna_id', '=', 'pengguna.id')
                ->select(array(
                    'pengguna.nama_lengkap',
                    'bantuan_hukum.jenis_perkara',
                    'bantuan_hukum.status_pemohon',
                    'bantuan_hukum.status_perkara',
                    'bantuan_hukum.advokasi',
                    'bantuan_hukum.advokator',
        ));

        if(null != $firstDate)
            $data->where(DB::raw("DATE(bantuan_hukum.created_at)"), ">=", DateTime::createFromFormat("d/m/Y", $firstDate)->format('Y-m-d'));
        if(null != $lastDate)
            $data->where(DB::raw("DATE(bantuan_hukum.created_at)"), "<=", DateTime::createFromFormat("d/m/Y", $lastDate)->format('Y-m-d'));

        return $data;
    }

    public static function getPrintTable($firstDate, $lastDate) {
        $data = self::getDataTable($firstDate, $lastDate);
        $result = array();
        foreach($data->get() as $index => $object) {
            $tglUsulan = new DateTime($perUU->tgl_usulan);
            $result[$index]['Nama Lengkap'] = $object->nama_lengkap;
            $result[$index]['Jenis Perkara'] = $object->jenis_perkara;
            $result[$index]['Status Pemohon'] = $object->status_pemohon;
            $result[$index]['Status Perkara'] = $object->status_perkara;
            $result[$index]['Advokasi'] = $object->advokasi;
            $result[$index]['Advokator'] = $object->advokator;
        }
        return HukorHelper::generateHtmlTable($result);
    }

    /*
     * fungsi untuk insert data ke table bantuan_hukum
     */

    public function SaveBantuanHukum($input, $file)
    {
        $bantuanHukum = new BantuanHukum;

        //pasrse input data to fields
        $bantuanHukum->pengguna_id = $input['id'];
        $bantuanHukum->jenis_perkara = $input['jns_perkara'];
        $bantuanHukum->status_perkara = $input['status_perkara'];
        $bantuanHukum->status_pemohon = $input['status_pemohon'];
        $bantuanHukum->uraian_singkat = $input['uraian'];
        $bantuanHukum->catatan = $input['catatan'];
        $bantuanHukum->lampiran = $file->getClientOriginalName();
        $bantuanHukum->ket_lampiran = $input['ket_lampiran'];

        $bantuanHukum->save();

        $this->InsertPenanggungJawab($bantuanHukum->id, $input);
    }

    /*
     * fungsi untuk mengambil 1 row dari table bantuan hukum.
     */

    public function GetSingleBantuanHukum($id)
    {
        $data = BantuanHukum::find($id)->with('pjbantuanhukum')->first();

        return $data;
    }

    /*
     * fungsi untuk mengambil 1 row dari table log_bantuan_hukum.
     */

    public function GetSingleLogBantuanHukum($id)
    {
        $data = LogBantuanHukum::find($id);

        return $data;
    }

    /*
     * fungsi untuk update data di table bantuan_hukum dan insert baru di table log_bantuan_hukum
     */

    public function UpdateBantuanHukum($input)
    {
        $data = BantuanHukum::find($input['id']); // find record by id

        $data->advokasi = $input['advokasi'];
        $data->advokator = $input['advokator'];

        $data->save(); // update data in table bantuan_hukum

        $log = new LogBantuanHukum;

        $log->bantuan_hukum_id = $input['id'];
        $log->advokasi = $input['advokasi'];
        $log->advokator = $input['advokator'];
        $log->status_pemohon = $input['status_permohonan'];
        $log->status_perkara = $input['status_perkara'];
        $log->ket_lampiran = $input['ket_lampiran'];
        $log->catatan = $input['catatan'];
        //getClientOriginalName() for get real file name
        $log->lampiran = ($input['lampiran'] != null) ? $input['lampiran']->getClientOriginalName() : null;
        $log->tanggal = date("Y-m-d");

        $log->save();

        $this->SendEmailToPengusul($input['id']);

        return $input['id'];
    }

    /*
     * mengambil seluruh data pada table log_bantuan_hukum
     * $filter : variabel array yang berfungsi untuk memfilter datatable
     */

    public function GetAllLog($filter)
    {
        $data = LogBantuanHukum::select();
        $data->where('bantuan_hukum_id', '=', $filter['id']);

        $iTotalRecords = $data->count();

        if (!empty($filter['sSearch'])) {
            $data->where();
        }

        $iTotalDisplayRecords = $data->count();

        $data = $data->skip($filter['iDisplayStart'])->take($filter['iDisplayLength']);

        return Response::json(array(
                    "sEcho" => $filter['sEcho'],
                    'aaData' => $data->get()->toArray(),
                    'iTotalRecords' => $iTotalRecords,
                    'iTotalDisplayRecords' => $iTotalDisplayRecords
        ));
    }

    /*
     * fungsi untuk menghapus data dan file upload bantuan hukum
     */

    public function DeleteBantuanHukum($id)
    {
        $helper = new HukorHelper();

        $this->DeleteLogBantuanHukum(true, $id);
        $data = $this->GetSingleBantuanHukum($id);

        $helper->DeleteFile('bantuanhukum', $data->lampiran);

        $data->delete();
    }

    /*
     * fungsi untuk menghapus data dan file upload log bantuan hukum
     */

    public function DeleteLogBantuanHukum($all = false, $id)
    {
        $helper = new HukorHelper();

        if ($all == false) {
            $log = LogBantuanHukum::find($id);

            if (!empty($log->lampiran)) {
                $helper->DeleteFile('bantuanhukum', $log->lampiran);
            }

            $log->delete();
        } elseif ($all == true) {
            $log = LogBantuanHukum::where('bantuan_hukum_id', '=', $id);

            foreach ($log->get() as $data) {
                if (!empty($log->lampiran)) {
                    $helper->DeleteFile('bantuanhukum', $log->lampiran);
                }
            }

            $log->delete();
        }
    }

    public function InsertPenanggungJawab($idBankum, $input)
    {
        $pj = new PJBantuanHukum;

        $pj->bantuan_hukum_id = $idBankum;
        $pj->nama = $input['nama'];
        $pj->jns_kelamin = $input['jenis_kelamin'];
        $pj->tgl_lahir = $input['tgl_lahir'];
        $pj->pekerjaan = $input['pekerjaan'];
        $pj->nip = $input['nip'];
        $pj->alamat_kantor = $input['alamat_kantor'];
        $pj->tlp_kantor = $input['telp_kantor'];
        $pj->handphone = $input['handphone'];
        $pj->email = $input['email'];

        $pj->save();
    }

    public static function getMonthlyCount()
    {
        return DB::table("bulan")
                        ->leftJoin('bantuan_hukum', function($join) {
                            $join->on('bulan.id', '=', DB::raw('month(bantuan_hukum.created_at)'))
                            ->on(DB::raw("year(bantuan_hukum.created_at)"), "=", DB::raw("year(curdate())"));
                        })
                        ->select(array(
                            "bulan.nama",
                            DB::raw("count(bantuan_hukum.id) as jumlah")
                        ))
                        ->groupBy(DB::raw("bulan.nama"))
                        ->orderBy("bulan.id");
    }

    public function SendEmailToAllAdminBankum()
    {
        $email = new HukorEmail();

        $reg = new DAL_Registrasi();

        $admin = DAL_Registrasi::findAdminByRoleId(8); //get all admin bantuan hukum
        // data for template ususlan
        $data = array(
            'title' => 'Pengajuan Usulan Bantuan Hukum',
            'pengguna' => $reg->findPengguna(Auth::user()->id)
        );

        // send email to all admin bantuan hukum
        foreach ($admin as $adm) {
            $email->sendMail('Usulan Bantuan Hukum', $adm->email, 'emails.usulan', $data);
        }
    }

    public function SendEmailToPengusul($bankumId)
    {
        $email = new HukorEmail();

        $bankum = BantuanHukum::join('pengguna', 'bantuan_hukum.pengguna_id', '=', 'pengguna_id')
                        ->where('bantuan_hukum.id', '=', $bankumId)->first();

        // data for template ususlan
        $data = array(
            'title' => 'Pengajuan Usulan Bantuan Hukum',
            'bankum' => $bankum
        );

        $email->sendMail('Usulan Bantuan Hukum', $bankum->email, 'emails.proses', $data);
    }

    public function GetFieldsName()
    {
        $pengguna = DB::table('INFORMATION_SHEMA')
                ->where('TABLE_SCHEMA', '=', 'hukor')
                ->where('TABLE_NAME', '=', 'pengguna')
                ->where('COLUMN_NAME', '=', 'nama_lengkap')
                ->select('COLUMN_NAME');

        $result = DB::table('INFORMATION_SHEMA')
                        ->where('TABLE_SCHEMA', '=', 'hukor')
                        ->where('TABLE_NAME', '=', 'bantuan_hukum')
                        ->union($pengguna)
                        ->select('COLUMN_NAME')->get();

        return $result;
    }

    public function GetBankumByDate($start, $end)
    {
        $data = BantuanHukum::join('pengguna', 'bantuan_hukum.pengguna_id', '=', 'pengguna_id')
                        ->where('bantuan_hukum.created_at', '>=', $start)
                        ->where('bantuan_hukum.created_at', '<=', $end)->get()->toArray();

        return $data;
    }

    public static function getTotalCount() {
        return  BantuanHukum::count();
    }

    public static function getUnreadCount() {
        $lastActive = Auth::user()->last_active;
        $count = BantuanHukum::where("created_at", ">=", $lastActive)->count();
        return $count;
    }

    public static function getTodayCount() {
        $count = BantuanHukum::where(DB::raw("DATE(created_at)"), "=", DB::raw("DATE(NOW())"))->count();
        return $count;
    }

}
