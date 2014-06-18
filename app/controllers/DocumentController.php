<?php

class DocumentController extends BaseController{

    protected $layout = 'layouts.admin';

    /**
     * Display a listing of the resource.
     *
     * @reutrn Response
     */

    public function index() {
        $this->layout->content = View::make('document.index', array(
            'tahun' => DAL_Document::GetYearOfNomor()
        ));
    }

    public function add()
    {
        $this->layout->content = View::make('document.form', array(
		'title' => 'Tambah Peraturan',
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
            return Redirect::to('admin/document')->with('success', 'Peraturan Berhasil Di Simpan.');
        }
        else
        {
            return Redirect::to('admin/document')->with('error', 'Peraturan Gagal Di Simpan.');
        }
    }

    public function datatable()
    {
        $input = Input::all();
        $DAL = new DAL_Document();
        $data = $DAL->GetAllData($input, true);

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
		'title' => 'Ubah Informasi Peraturan',
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

        return Redirect::to('admin/document')->with('success', 'Peraturan Berhasil Di Ubah.');
    }

    public function delete($id)
    {
//        $id = Input::get('id');
        $DAL = new DAL_Document();

        $DAL->DeleteDocument($id);

        return Redirect::to('admin/document')->with('success', 'Peraturan Berhasil Di Hapus.');
    }

    public function publish($id)
    {
//        $id = Input::get('id');
        $DAL = new DAL_Document();

        $DAL->PublishDocument($id);

        return Redirect::to('admin/document')->with('success', 'Peraturan Berhasil Di Publish.');
    }

    public function printToPDF()
    {
        $input = Input::all();

        $years = DAL_Document::GetYearOfNomor();
        $data = DAL_Document::DataForPDF($input);

        unset($years['']);

        $title = "";
        $tahun = ($input['tahun'] != "") ? $input['tahun'] : min($years) . " - " . max($years);
        $kategori = ($input['kategori'] != 0) ? strtoupper($data[0]->kategori) : "SEMUA PERATURAN";

        $title .= $kategori . " " . $tahun;

         $header = array(
             'nomor',
             'perihal',
             'kategori'
         );

        if(count($data) != 0){

                HukorHelper::GeneratePDf($data, $header, $title);

        }else{
            return Redirect::to('admin/document')->with('error', 'Peraturan Tidak Ditemukan.');
        }
    }
}

