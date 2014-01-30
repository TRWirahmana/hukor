<?php
class DAL_BantuanHukun {

    public function GetAllData($filter)
    {
        $data = BantuanHukum::with('pengguna');

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

    public function SaveBantuanHukum($input, $file)
    {
        $bantuanHukum = new BantuanHukum;

        $bantuanHukum->pengguna_id = $input['id'];
        $bantuanHukum->jenis_perkara = $input['jns_perkara'];
        $bantuanHukum->status_perkara = $input['status_perkara'];
        $bantuanHukum->status_pemohon = $input['status_pemohon'];
        $bantuanHukum->uraian_singkat = $input['uraian'];
        $bantuanHukum->catatan = $input['catatan'];
        $bantuanHukum->lampiran = $file->getClientOriginalName();
        $bantuanHukum->ket_lampiran = $input['ket_lampiran'];

        return $bantuanHukum->save();
    }

    public function GetSingleBantuanHukum($id)
    {
        $data = BantuanHukum::find($id)->with('pengguna')->first();

        return $data;
    }

    public function UpdateBantuanHukum($input)
    {
        $data = BantuanHukum::find($input['id']);

        $data->advokasi = $input['advokasi'];
        $data->advokator =  $input['advokator'];

        $data->save();

        $log = new LogBantuanHukum;

        $log->bantuan_hukum_id = $input['id'];
        $log->advokasi = $input['advokasi'];
        $log->advokator = $input['advokator'];
        $log->status_pemohon = $input['status_permohonan'];
        $log->status_perkara = $input['status_perkara'];
        $log->ket_lampiran = $input['ket_lampiran'];
        $log->catatan = $input['catatan'];
        $log->lampiran = ($input['lampiran'] != null) ? $input['lampiran']->getClientOriginalName() : null;

        $log->save();

        return $input['id'];
    }

    public function GetAllLog($filter)
    {
        $data = LogBantuanHukum::select();

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

    public function DeleteBantuanHukum($id)
    {
        $this->DeleteLogBantuanHukum(true, $id);
        $data = $this->GetSingleBantuanHukum($id);
        $data->delete();
    }

    public function DeleteLogBantuanHukum($all = false, $id){
        if($all == false)
        {
            $log = LogBantuanHukum::find($id);
            $log->delete();
        }
        elseif($all == true)
        {
            $log = LogBantuanHukum::where('bantuan_hukum_id', '=', $id);
            $log->delete();
        }
    }
}