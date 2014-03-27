<?php

class KetatalaksanaanController extends BaseController
{

    protected $layout = 'layouts.admin';

    public function index()
    {
        $user = Auth::user()->role_id;

        if($user == 2 || $user == null){
            $this->layout = View::make('layouts.master');
            $this->layout->content = View::make('ketatalaksanaan.index_user');
        }else{
            $this->layout = View::make('layouts.admin');
            $this->layout->content = View::make('ketatalaksanaan.index');
        }
    }

    public function datatable()
    {
        $input = Input::all();
        $DAL = new DAL_Ketatalaksanaan();
        $data = $DAL->GetAllData($input);

        return $data;
    }

    public function create()
    {
        $this->layout->content = View::make('ketatalaksanaan.form', array(
            'title' => 'Tambah Ketatalaksanaan',
            'data' => new Ketatalaksanaan(),
            'form_opts' => array(
                'action' => 'KetatalaksanaanController@store',
                'method' => 'post',
                'class' => 'form-horizontal',
                'id' => 'document-form',
                'files' => true
            ),
        ));
    }

    public function store()
    {
        $input = Input::all();

        $DAL = new DAL_Ketatalaksanaan();
        $helper = new HukorHelper();

        //updaload file
        if(!empty($input['file_dokumen']))
        {
            $filenames = $helper->UploadFile('ketatalaksanaan', $input['file_dokumen']);

            if($filenames)
            {
                $DAL->SaveKetatalaksanaan($input); //save ketatalaksanaan
            }
            else
            {
                return Redirect::to('admin/ketatalaksanaan')->with('error', 'Lampiran Gagal Disimpan.');
            }
        }
        else
        {
            $DAL->SaveKetatalaksanaan($input); //save ketatalaksanaan
        }

        return Redirect::to('admin/ketatalaksanaan')->with('success', 'Data Berhasil Di Simpan.');
    }

    public function edit($id)
    {
        //get Ketatalaksanaan by id
        $data = Ketatalaksanaan::find($id);

        // show form with empty model
        $this->layout->content = View::make('ketatalaksanaan.form', array(
            'title' => 'Pengaturan Link',
            'detail' => '',
            'form_opts' => array(
                'route' => array('admin.ketatalaksanaan.update', $data->id),
                'enctype' => 'multipart/form-data',
                'method' => 'put',
                'class' => 'form-horizontal',
                'id' => 'form_linked'
            ),
            'data' => $data
        ));
    }

    public function update($id)
    {
        $input = Input::all();
        $helper = new HukorHelper();
        $DAL = new DAL_Ketatalaksanaan();

        $data = Ketatalaksanaan::find($id);

        if($input['file_dokumen'] == "" || empty($input['file_dokumen']))
        {
            $input['file_dokumen'] = $data->file;
            $DAL->UpdateKetatalaksanaan($input, $id);
        }
        else
        {
            $helper->DeleteFile('ketatalaksanaan', $data->file);
            $helper->UploadFile('ketatalaksanaan', $input['file_dokumen']);
            $DAL->UpdateKetatalaksanaan($input, $id);
        }

        return Redirect::to('admin/ketatalaksanaan')->with('success', 'Data Berhasil Di Ubah.');
    }

    public function delete($id)
    {
        $DAL = new DAL_Ketatalaksanaan();

        $DAL->DeleteKetatalaksanaan($id);

        return Redirect::to('admin/ketatalaksanaan')->with('success', 'Data Berhasil Di Hapus.');
    }

    public function downloadLampiran($id)
    {
        $document = Ketatalaksanaan::find($id) or App::abort(404);

        if($document->file != "" || !empty($document->file))
        {
            $path = UPLOAD_PATH . DS . 'ketatalaksanaan/' . $document->file;
            return Response::download($path, explode('/', $document->file)[1]);
        }

        $user = Auth::user()->role_id;

        if($user == 2 || $user == null){
            return Redirect::to('ketatalaksanaan')->with('error', 'File Tidak Tersedia.');
        }else{
            return Redirect::to('admin/ketatalaksanaan')->with('error', 'File Tidak Tersedia.');
        }
    }


}