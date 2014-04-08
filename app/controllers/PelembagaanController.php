<?php

use Carbon\Carbon;

class PelembagaanController extends BaseController {

	public function index()
	{
		$user = Auth::user();


        $all = Menu::all();
        $all->toArray();
		
        if(Request::ajax())           
            return Datatables::of(DAL_Pelembagaan::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))->make(true);
            
        if($user->role_id == 3 || $user->role_id == 7 || $user->role_id == 4 || $user->role_id == 1 || $user->role_id == 5 || $user->role_id == 6 || $user->role_id == 8 || $user->role_id == 9){
			$this->layout = View::make('layouts.admin');
            $this->layout->content = View::make('Pelembagaan.index', array( 'user' => $user ));
        } else {
            $this->layout = View::make('layouts.master', array('allmenu' => $all));
            $this->layout->content = View::make('Pelembagaan.index_user', array( 'user' => $user ));
        }	    

	}

    public function datatable()
    {
    	//
    }

	public function show($id)
	{
		//
	}    

	public function create()
	{
		$pelembagaan = new Pelembagaan();
		$user = Auth::user();

        $all = Menu::all();
        $all->toArray();

        $this->layout = View::make('layouts.master', array('allmenu' => $all));
		$this->layout->content = View::make('Pelembagaan.form', array(
				'title' => 'Tambah Akun',
				'detail' => 'Lengkapi formulir dibawah ini untuk menambahkan akun baru.',
				'form_opts' => array(
					'route' => 'pelembagaan.store',					
					'method' => 'post',
					'class' => 'form-horizontal',
		            'id' => 'pelembagaan-form',
		            'files' => true
				),
				'pelembagaan' => $pelembagaan,
				'user' => $user
			));                        
	}

	public function edit($id)
	{
		if(Request::ajax())  
        	return Datatables::of(DAL_LogPelembagaan::getDataTable($id))->make(true);

        $user = Auth::user();
		$DAL = new DAL_Pelembagaan();
        $pelembagaan = $DAL->getPelembagaanById($id);
        $penanggungJawab = $DAL->getPenangungJawab($id)[0];

    	$this->layout = View::make('layouts.admin');
		if($user->role_id == 7){
			$this->layout->content = View::make('Pelembagaan.update', array(
				'title' => 'Ubah Pelembagaan #' . $pelembagaan->id,
				'detail' => '',
				'form_opts' => array('route' => 'proses_update_pelembagaan_admin','method' => 'post','class' => 'form-horizontal','id' => 'pelembagaan-update','files' => true),
				'pelembagaan' => $pelembagaan,
				'id' => $id,
                'penanggungJawab' => $penanggungJawab,
			));
		} else if($user->role_id == 3) {
			$this->layout->content = View::make('Pelembagaan.update', array(
				'title' => 'Ubah Pelembagaan #' . $pelembagaan->id,
				'detail' => '',
				'form_opts' => array('route' => 'proses_update_pelembagaan_admin','method' => 'post','class' => 'form-horizontal','id' => 'pelembagaan-update','files' => true),
				'pelembagaan' => $pelembagaan,
				'id' => $id,
                'penanggungJawab' => $penanggungJawab,
			));
		}else if($user->role_id == 2) {
            $this->layout = View::make('layouts.master');

            $this->layout->content = View::make('Pelembagaan.detail_usulan', array(
                'title' => 'Detail Pelembagaan #' . $pelembagaan->id,
                'detail' => '',
                'form_opts' => array('route' => 'proses_update_pelembagaan','method' => 'post','class' => 'form-horizontal','id' => 'pelembagaan-update','files' => true),
                'pelembagaan' => $pelembagaan,
                'id' => $id,
                'penanggungJawab' => $penanggungJawab,
            ));
        }
	}

	public function update() //$id)
	{
		$id = Input::get("id");
        $input = Input::all();

        $DAL = new DAL_Pelembagaan();
        $helper = new HukorHelper();

       // $uploadSuccess = $helper->UploadFile('pelembagaan', Input::file('lampiran'));         // Upload File
	$filenames = array();
	$filenames = $helper->MultipleUploadFile('pelembagaan', Input::file('lampiran'));
        
	$DAL->saveLogPelembagaan($input, $filenames, $id);	  // save pelembagaan

		// kirim usulan ke bagian per-uu
		if(Input::get('status') == 2){
			$DAL->sendToPerUU($id);
			// SEND EMAIL KE ADMIN BAGIAN PER UU
			//

			// SEND EMAIL ke User ... message("Usulan telah di usulkan ke bagian per UU");
        	//
        } else {
	        // EMAIL To User
	        $message = 'Usulan Anda Telah di Proses';
			$DAL->sendEmailToUser($id, $message);        	
        }

		$user = Auth::user();		
		if($user->role_id == 3)
			return Redirect::to('admin/pelembagaan')->with('success', 'Data berhasil diubah.');
		else if($user->role_id == 7)
			return Redirect::to('admin/pelembagaan')->with('success', 'Data berhasil diubah.');
        else if($user->role_id == 2)
            return Redirect::to('pelembagaan')->with('success', 'Data berhasil diubah.');
	}  

	public function store()
	{ 
	$input = Input::all(); 
        $DAL = new DAL_Pelembagaan();
        $helper = new HukorHelper();

	// Upload Multiple File
	$filenames = array();
	$filenames = $helper->MultipleUploadFile('pelembagaan', Input::file('lampiran'));

        if($filenames['0'] != null ){
            if($filenames) {
//        	$DAL->savePelembagaan($input, Input::file('lampiran'));         	// save pelembagaan
                $DAL->savePelembagaan($input, $filenames);         	// save pelembagaan
                $DAL->sendEmailToAllAdminPelembagaan();        						// send Email to admin

                if(Auth::user()->role_id == 2){
                    return Redirect::to('pelembagaan/informasi')->with('success', 'Data berhasil dikirim.');
                }else{
                    return Redirect::route('pelembagaan.index')->with('success', 'Data berhasil dikirim.');
                }

            } else {
                if(Auth::user()->role_id == 2){
                    return Redirect::to('pelembagaan/informasi')->with('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
                }else{
                    return Redirect::route('pelembagaan.index')->with('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
                }

            }
        }else{
                $DAL->savePelembagaan($input, $filenames);         	// save pelembagaan
                $DAL->sendEmailToAllAdminPelembagaan();        						// send Email to admin

                if(Auth::user()->role_id == 2){
                    return Redirect::to('pelembagaan/informasi')->with('success', 'Data berhasil dikirim.');
                }else{
                    return Redirect::route('pelembagaan.index')->with('success', 'Data berhasil dikirim.');
                }
        }


	}

	public function destroy($id)
	{	
			$pelembagaan = Pelembagaan::find($id);
		if(!is_null($pelembagaan)) {
			$pelembagaan->delete();
		}

	   	$penanggungJawab = PenanggungJawabPelembagaan::where('pelembagaan_id', $id);
		if(!is_null($pelembagaan)) {
			$penanggungJawab->delete();
		}
	}

	public function deleteLog($id)
    {
		$logPelembagaan = LogPelembagaan::find($id);
		if(!is_null($logPelembagaan)) {
			$logPelembagaan->delete();
		}
	}
	

     public function downloadLampiran($id)
    {
        $pelembagaan = Pelembagaan::find($id) or App::abort(404);
        $path = UPLOAD_PATH . '/pelembagaan/' . $pelembagaan->lampiran;
        return Response::download($path, explode('/', $pelembagaan->lampiran)[1]);
    }

	public function downloadLampiranLog($id)
	{


		if($log = LogPelembagaan::find($id))
//            var_dump(unserialize($log->lampiran));exit;
            return HukorHelper::downloadAsZIP(unserialize($log->lampiran));

		return App::abort(404);
	}

	public function download($id, $index = null) 
	{
		if($object = Pelembagaan::find($id)) 
		{
		$attachments = unserialize($object->lampiran);	
		if(!empty($attachments) && null !== $index && isset($attachments[$index]) )
		{
			$filename = $attachments[$index];	
			$originalName = explode('/', $filename)[1];
			$path = UPLOAD_PATH . DS . $filename;
			if(file_exists($path))
				return Response::download($path, $originalName);
		} else {
			return HukorHelper::downloadAsZIP($attachments);
		}
		}
		return App::abort(404);
	}

    public function printTable() {
    	
    	$status = Input::get("status", null);
    	$firstDate = Input::get("firstDate", null);
    	$lastDate = Input::get("lastDate", null);

    	$table = DAL_Pelembagaan::getPrintTable($status, $firstDate, $lastDate);

		$style = array("<style>");
		$style[] = "table { border-collapse: collapse; }";
		$style[] = "table td, table th { padding: 5px; }";
		$style[] = "</style>";

		$html = array("<h1> Pelembagaan</h1>");
		$html[] = "<table><tr>";
		if(null != $status)
			$html[] = "<td><strong>Status</strong></td><td>: ". $pelembagaan->status . "</td>" ;
		if(null != $firsDate)
			$html[] = "<td><strong>Tanggal Awal</strong></td><td> : {$firstDate} </td>";
		if(null != $lastDate)
			$html[] = "<td><strong>Tanggal Akhir</strong></td><td> : {$lastDate} </td> ";
		$html[] = "</tr></table>";
		$html[] = $table;
	
		$pdf = new DOMPDF();
		$pdf->load_html(join("", $style) . join("", $html));
		$pdf->render();
		$pdf->stream("pelembagaan.pdf");
	}
}
