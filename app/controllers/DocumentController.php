<?php

class DocumentController extends BaseController{

    protected $layout = 'layouts.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
        $this->layout->content = View::make('document.index');
    }

    public function add()
    {
        $this->layout->content = View::make('document.form', array(
            'data' => new Document(),
            'form_opts' => array(
                'action' => 'DocumentController@save',
                'method' => 'post',
                'class' => 'form-horizontal',
                'id' => 'document-form',
                'files' => true
            ),
        ));
    }

    public function save()
    {
        $input = Input::all();

        $DAL = new DAL_Document();
        $helper = new HukorHelper();

        $uploadSuccess = $helper->UploadFile('dokumen', Input::file('file_dokumen'));

        if($uploadSuccess)
        {
            $saved = $DAL->SaveDocument($input, Input::file('file_dokumen'));

            if($saved)
            {
                return Redirect::to('document')->with('success', 'Dokumen Berhasil Di Simpan.');
            }
            else
            {
                return Redirect::to('document')->with('error', 'Dokumen Gagal Di Simpan.');
            }
        }
        else
        {
            return Redirect::to('document')->with('error', 'File Gagal Disimpan.');
        }
    }

    public function datatable()
    {
        $input = Input::all();
        $DAL = new DAL_Document();
        $data = $DAL->GetAllData($input);

        return $data;
    }

    public function detail()
    {
        $id = Input::get('id');
        $DAL = new DAL_Document();

        $data = $DAL->GetSingleDocument($id);

        // show form with empty model
        $this->layout->content = View::make('document.detail', array(
            'data' => $data
        ));
    }

    public function edit()
    {
        $input = Input::get('id');

        $DAL = new DAL_Document();
        $data = $DAL->GetSingleDocument($input);

        $this->layout->content = View::make('document.form', array(
            'data' => $data,
            'form_opts' => array(
                'action' => 'DocumentController@update',
                'method' => 'post',
                'class' => 'form-horizontal',
                'id' => 'document-form',
                'files' => true
            ),
        ));
    }

    public function update()
    {
        $input = Input::all();

        $DAL = new DAL_Document();
        $data = $DAL->UpdateDocument($input);

        return Redirect::to('document')->with('success', 'Dokumen Berhasil Di Ubah.');
    }

    public function delete()
    {
        $id = Input::get('id');
        $DAL = new DAL_Document();

        $DAL->DeleteDocument($id);

        return Redirect::to('document')->with('success', 'Dokumen Berhasil Di Hapus.');
    }

    public function publish()
    {
        $id = Input::get('id');
        $DAL = new DAL_Document();

        $DAL->PublishDocument($id);

        return Redirect::to('document')->with('success', 'Dokumen Berhasil Di Publish.');
    }
}

