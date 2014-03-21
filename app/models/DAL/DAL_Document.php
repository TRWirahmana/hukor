<?php
class DAL_Document {
    /*
     * mengambil seluruh data pada table document
     * $filter : variabel array yang berfungsi untuk memfilter datatable
     */
    public function GetAllData($filter, $admin = true)
    {
        //get all record
        $data = Document::select();

        // filter for user side
        if($admin == false)
        {
            $data->where('status_publish', '=', 1);

            if($filter['masalah'] != null)
            {
                $data->where('masalah', '=', $filter['masalah']);
            }

            if($filter['kategori'] != null)
            {
                $data->where('kategori', '=', $filter['kategori']);
            }

            if($filter['tahunFilter'] != null)
            {
                $data->where(DB::raw('DATE_FORMAT(tgl_pengesahan,"%Y")'), '=', $filter['tahunFilter']);
            }

            if($filter['bidang'] != null)
            {
                $data->where('bidang', '=', $filter['bidang']);
            }
        }

        //count all record
        $iTotalRecords = $data->count();

        //search specific record
        if(!empty($filter['sSearch'])){
            $search = $filter['sSearch'];
            $data->where('nomor', 'like', "%$search%")
                ->orWhere('perihal', 'like', "%$search%");
            ;
        }

        //count record after filtering
        $iTotalDisplayRecords = $data->count();

        $data = $data->skip($filter['iDisplayStart'])->take($filter['iDisplayLength']);
        $data = $data->get()->toArray();

        $result = array();

        foreach($data as $dat)
        {
            $result[] = $dat['nomor'];
        }

        array_multisort($result, SORT_ASC, $data);

        return Response::json(array(
            "sEcho" => $filter['sEcho'],
            'aaData' => $data,
            'iTotalRecords' => $iTotalRecords,
            'iTotalDisplayRecords' => $iTotalDisplayRecords
        ));
    }

    /*
     * fungsi untuk insert data ke table bantuan_hukum
     */
    public function SaveDocument($input)
    {
        $data = new Document;

        //pasrse input data to fields
        $data->nomor = $input['nomor'];
        $data->kategori = $input['kategori'];
        $data->masalah = $input['masalah'];
        $data->perihal = $input['perihal'];
        $data->deskripsi = $input['deskripsi'];
        $data->tgl_pengesahan = $input['tanggal'];
        $data->file_dokumen = (!empty($input['file_dokumen'])) ? $input['file_dokumen']->getClientOriginalName() : null;
        $data->status_publish = $input['status'] == "Publish" ? 1: 0;
        $data->bidang = $input['bidang'];

        return $data->save();//saving data
    }

    /*
     * fungsi untuk mengambil 1 row dari table bantuan hukum.
     */
    public function GetSingleDocument($id)
    {
        $data = Document::find($id);

        return $data;
    }

    /*
     * fungsi untuk update data di table bantuan_hukum dan insert baru di table log_bantuan_hukum
     */
    public function UpdateDocument($input, $id)
    {
        $data = Document::find($id); // find record by id
        $helper = new HukorHelper();

        if(!empty($input['file_dokumen']))
        {
            $helper->DeleteFile('dokumen', $data->file_dokumen);
            $helper->UploadFile('dokumen', $input['file_dokumen']);
        }

        //pasrse input data to fields
        $data->nomor = $input['nomor'];
        $data->kategori = $input['kategori'];
        $data->masalah = $input['masalah'];
        $data->perihal = $input['perihal'];
        $data->deskripsi = $input['deskripsi'];
        $data->tgl_pengesahan = $input['tanggal'];
        $data->file_dokumen = (!empty($input['file_dokumen'])) ? $input['file_dokumen']->getClientOriginalName() : $data->file_dokumen;
        $data->status_publish = $input['status'] == "Publish" ? 1: 0;
        $data->bidang = $input['bidang'];

        $data->save();
    }

    public function DeleteDocument($id)
    {
        $helper = new HukorHelper();

        $data = $this->GetSingleDocument($id);
        $helper->DeleteFile('dokumen', $data->file_dokumen);

        $data->delete();
    }

    public function PublishDocument($id)
    {
        $data = Document::find($id); // find record by id

        $data->status_publish = 1;

        $data->save();
    }

    public function GetLastTen()
    {
        $data = Document::orderBy('id', 'DESC')->take(10)->get();

        return $data;
    }

    public function GetYearOfDocument()
    {
        $data = array("" => "Semua Tahun") + Document::select(array( DB::raw('DATE_FORMAT(tgl_pengesahan,"%Y") As pengesahan_year')))
                ->lists('pengesahan_year', 'pengesahan_year');

        return $data;
    }
}