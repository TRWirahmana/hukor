<?php

class DocumentController extends BaseController{

    protected $layout = 'layouts.admin';

    /**
     * Display a listing of the resource.
     *
     * @reutrn Response
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

        if(!empty($input['file_dokumen']))
        {
            $helper->UploadFile('dokumen', Input::file('file_dokumen'));
        }

        $saved = $DAL->SaveDocument($input, Input::file('file_dokumen'));

        if($saved)
        {
            return Redirect::to('admin/document')->with('success', 'Dokumen Berhasil Di Simpan.');
        }
        else
        {
            return Redirect::to('admin/document')->with('error', 'Dokumen Gagal Di Simpan.');
        }
    }

    public function datatable()
    {
        $input = Input::all();
        $DAL = new DAL_Document();
        $data = $DAL->GetAllData($input);

        return $data;
    }

    public function detail($id)
    {
//        $id = Input::get('id');
        $DAL = new DAL_Document();

        $data = $DAL->GetSingleDocument($id);

        // show form with empty model
        $this->layout->content = View::make('document.detail', array(
            'data' => $data,
            'form_opts' => array(
//                'action' => 'DocumentController@save',
                'method' => 'post',
                'class' => 'form-horizontal',
                'id' => 'document-form',
                'files' => true
            ),
        ));
    }

    public function edit($id)
    {
//        $input = Input::get('id');

        $DAL = new DAL_Document();
        $data = $DAL->GetSingleDocument($id);

        $this->layout->content = View::make('document.form', array(
            'data' => $data,
            'form_opts' => array(
                'action' => array('DocumentController@update', $data->id),
                'method' => 'put',
                'class' => 'form-horizontal',
                'id' => 'document-form',
                'files' => true
            ),
        ));
    }

    public function update($id)
    {
        $input = Input::all();

        $DAL = new DAL_Document();
        $data = $DAL->UpdateDocument($input, $id);

        return Redirect::to('admin/document')->with('success', 'Dokumen Berhasil Di Ubah.');
    }

    public function delete($id)
    {
//        $id = Input::get('id');
        $DAL = new DAL_Document();

        $DAL->DeleteDocument($id);

        return Redirect::to('admin/document')->with('success', 'Dokumen Berhasil Di Hapus.');
    }

    public function publish($id)
    {
//        $id = Input::get('id');
        $DAL = new DAL_Document();

        $DAL->PublishDocument($id);

        return Redirect::to('admin/document')->with('success', 'Dokumen Berhasil Di Publish.');
    }
}

