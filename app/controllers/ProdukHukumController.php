<?php

class ProdukHukumController extends BaseController
{
//	protected $layout = 'layouts.master';
    public function index()
    {
        if(Request::ajax())
	          	return Datatables::of(DAL_ProdukHukum::getDataTable(Input::get("kategori", null), Input::get("masalah", null), Input::get("tahunFilter", null), Input::get("firstDate", null), Input::get("bidang", null)))->make(true);
  
      	$listThn = array("" => "Semua") + Document::select(array( DB::raw('DATE_FORMAT(tgl_pengesahan,"%Y") As pengesahan_year')))
	        													->lists('pengesahan_year', 'pengesahan_year');
        $all = Menu::all();
        $all->toArray();

        $this->layout = View::make('layouts.master', array('allmenu' => $all));
        $this->layout->content = View::make('produkhukum.index', array('listThn' => $listThn));		
	}

	public function getData(){
//		if(Request::ajax()){
			$result = [];

			$data = DAL_ProdukHukum::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null));
			
			foreach ( $data as $row): 
				$result[] = [
					$row->id,
					$row->perihal,
					$row->kategori,
					$row->masalah,
					$row->tgl_pengesahan,
					$row->status_publish
				];
			endforeach;
			return json_encode(['aaData' => $result]);
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
		            'id' => 'pelembagaan-form',
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