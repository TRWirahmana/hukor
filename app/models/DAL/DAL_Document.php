<?php
class DAL_Document {
    /*
     * mengambil seluruh data pada table document
     * $filter : variabel array yang berfungsi untuk memfilter datatable
     */
    public function GetAllData($filter)
    {
        //get all record
        $data = Document::select();

        //count all record
        $iTotalRecords = $data->count();

        //search specific record
        if(!empty($filter['sSearch'])){
            $data->where();
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
    public function SaveDocument($input, $file)
    {
        $data = new Document;

        //pasrse input data to fields
        $data->nomor = $input['nomor'];
        $data->kategori = $input['kategori'];
        $data->masalah = $input['masalah'];
        $data->perihal = $input['perihal'];
        $data->deskripsi = $input['deskripsi'];
        $data->tgl_pengesahan = $input['tanggal'];
        $data->file_dokumen = $file->getClientOriginalName();
        $data->status_publish = $input['status'] == "Publish" ? 1: 0;

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
    public function UpdateDocument($input)
    {
        $data = Document::find($input['id']); // find record by id
        $helper = new HukorHelper();

        $helper->DeleteFile('dokumen', $data->file_dokumen);
        $helper->UploadFile('dokumen', $input['file_dokumen']);


        //pasrse input data to fields
        $data->nomor = $input['nomor'];
        $data->kategori = $input['kategori'];
        $data->masalah = $input['masalah'];
        $data->perihal = $input['perihal'];
        $data->deskripsi = $input['deskripsi'];
        $data->tgl_pengesahan = $input['tanggal'];
        $data->file_dokumen = $input['file_dokumen']->getClientOriginalName();
        $data->status_publish = $input['publish'];

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
}