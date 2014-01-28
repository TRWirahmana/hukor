<?php
class DAL_BantuanHukun {

    public function GetAllData($filter)
    {
        $data = BantuanHukum::select();

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

    public function SaveBantuanHukum($input)
    {
        $bantuanHukum = new BantuanHukum;

        $bantuanHukum->pengguna_id = $input['id'];
        $bantuanHukum->jenis_perkara = $input['jns_perkara'];
        $bantuanHukum->status_perkara = $input['status_perkara'];
        $bantuanHukum->status_pemohon = $input['status_pemohon'];
        $bantuanHukum->uraian_singkat = $input['uraian'];
        $bantuanHukum->catatan = $input['catatan'];
        $bantuanHukum->lampiran = $input['lampiran'];
        $bantuanHukum->ket_lampiran = $input['ket_lampiran'];

        $bantuanHukum->save();
    }
}