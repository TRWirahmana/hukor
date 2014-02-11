<?php

class ProdukHukumController extends BaseController
{
//	protected $layout = 'layouts.master';
    public function index()
    {
     //      if (Request::ajax())
		  	// return Datatables::of(DAL_Pelembagaan::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))->make(true); 
          
			// return Datatables::of(DAL_ProdukHukum::getDataTable(null,null, null))->make(true); 
           
//		$a = DAL_Pelembagaan::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)); 
          

		 //  $a = DAL_ProdukHukum::getDataTable(null,null, null);
//		  var_dump($a);
//		  exit;

        $this->layout = View::make('layouts.master');
        $this->layout->content = View::make('produkhukum.index');		
	}

	public function getData(){
//		if(Request::ajax()){
			$result = [];

			$data = Document::all();// where('status_publish', '=', '0');

			// var_dump($data);
			// exit;
			

			foreach ( $data /*Document::all()/*->where('status_publish','=', '1') */ as $row): 
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
//		} else {
//			return Redirect::to('produkhukum');
//		}
	}

	public function detail()
	{

	}

}