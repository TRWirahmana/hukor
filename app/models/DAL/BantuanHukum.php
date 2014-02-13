<?php
class DAL_BantuanHukun {
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
        if($filter['jenis_perkara'] == 0)
        {
            $data->where('jenis_perkara', '!=', "NULL");
        }
        else
        {
            $data->where('jenis_perkara', '=', intval($filter['jenis_perkara']));
        }

        //filter status_pemohon
        if($filter['status_pemohon'] == 0)
        {
            $data->where('status_pemohon', '!=', "NULL");
        }
        else
        {
            $data->where('status_pemohon', '=', intval($filter['status_pemohon']));
        }

        //filter status_pemohon
        if($filter['advokasi'] != 0)
        {
            $data->where('advokasi', '=', intval($filter['advokasi']));
        }

        //search specific record
        if(!empty($filter['sSearch'])){
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
        $data->advokator =  $input['advokator'];

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

        $log->save();

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

        if(!empty($filter['sSearch'])){
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

        if($all == false)
        {
            $log = LogBantuanHukum::find($id);

            if(!empty($log->lampiran))
            {
                $helper->DeleteFile('bantuanhukum', $log->lampiran);
            }

            $log->delete();
        }
        elseif($all == true)
        {
            $log = LogBantuanHukum::where('bantuan_hukum_id', '=', $id);

            foreach($log->get() as $data)
            {
                if(!empty($log->lampiran))
                {
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

    public static function getMonthlyCount() {
        return DB::table("bulan")
                ->leftJoin('bantuan_hukum', function($join){
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
}