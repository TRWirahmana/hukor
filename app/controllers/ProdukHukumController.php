<?php

class ProdukHukumController extends BaseController
{
//	protected $layout = 'layouts.master';
    public function index()
    {
        $DAL = new DAL_Document();

        $listThn = $DAL->GetYearOfDocument();

        $all = Menu::all();
        $all->toArray();

        $this->layout = View::make('layouts.master', array('allmenu' => $all));
        $this->layout->content = View::make('produkhukum.index', array('listThn' => $listThn));		
	}

    public function datatable()
    {
        $input = Input::all();
        $DAL = new DAL_Document();
        $data = $DAL->GetAllData($input, false);

        return $data;
    }

	public function detail($id)
	{
		$data = Document::find($id);
        $all = Menu::all();
        $all->toArray();

        $this->layout = View::make('layouts.master', array('allmenu' => $all));
        $this->layout->content = View::make('produkhukum.detail', array(
				'title' => 'Tambah Akun',
				'detail' => 'Lengkapi formulir dibawah ini untuk menambahkan akun baru.',
				'form_opts' => array(
//					'action' => '#',
					'method' => 'post',
					'class' => 'form-horizontal',
		            'id' => 'produkhukum-form',
		            'files' => true
				),
				'data' => $data
			));		
	}

	public function downloadLampiran($id)
    {
        $document = Document::find($id) or App::abort(404);
        $path = UPLOAD_PATH . DS . 'dokumen/' . $document->file_dokumen;
        return Response::download($path, explode('/', $document->file_dokumen)[1]);
    }


}