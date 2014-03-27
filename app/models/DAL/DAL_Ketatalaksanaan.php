<?php
class DAL_Ketatalaksanaan {

    public function GetAllData($filter)
    {
        //get all record
        $data = Ketatalaksanaan::select();

        //count all record
        $iTotalRecords = $data->count();

        //search specific record
        if(!empty($filter['sSearch'])){
            $search = $filter['sSearch'];
            $data->where('tanggal', 'like', "%$search%")
                ->orWhere('produk', 'like', "%$search%")
                ->orWhere('unit', 'like', "%$search%");
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

    public function SaveKetatalaksanaan($input)
    {
        $data = new Ketatalaksanaan();

        $data->tanggal = ($input['tanggal']) ? $input['tanggal'] : "";
        $data->produk = ($input['produk']) ? $input['produk'] : "";
        $data->unit = ($input['unit']) ? $input['unit'] : "";
        $data->file = (!empty($input['file_dokumen'])) ? $input['file_dokumen']->getClientOriginalName() : "";

        $data->save();
    }

    public function UpdateKetatalaksanaan($input, $id)
    {
        $data = Ketatalaksanaan::find($id);

        $data->tanggal = $input['tanggal'];
        $data->produk = $input['produk'];
        $data->unit = $input['unit'];
        $data->file = (!empty($input['file_dokumen'])) ? $input['file_dokumen']->getClientOriginalName() : "";

        $data->save();
    }

    public function DeleteKetatalaksanaan($id)
    {
        $helper = new HukorHelper();

        $data = Ketatalaksanaan::find($id);
        $helper->DeleteFile('ketatalaksanaan', $data->file);

        $data->delete();
    }

}
