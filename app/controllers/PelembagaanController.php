<?php

use Carbon\Carbon;

class PelembagaanController extends BaseController {

	public function index()
	{
		$user = Auth::user();
		
        if(Request::ajax())           
            return Datatables::of(DAL_Pelembagaan::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))->make(true);
            
        if($user->role_id == 3 || $user->role_id == 7 || $user->role_id == 4 || $user->role_id == 1 || $user->role_id == 5 || $user->role_id == 6 || $user->role_id == 8 || $user->role_id == 9){
			$this->layout = View::make('layouts.admin');
        } else {
        	$this->layout = View::make('layouts.master');
        }	    
	    $this->layout->content = View::make('Pelembagaan.index', array( 'user' => $user ));
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

		$this->layout = View::make('layouts.master');
		$this->layout->content = View::make('Pelembagaan.form', array(
				'title' => 'Tambah Akun',
				'detail' => 'Lengkapi formulir dibawah ini untuk menambahkan akun baru.',
				'form_opts' => array(
					'route' => 'store_pelembagaan',					
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

		$pelembagaan = Pelembagaan::find($id);
		$user = Auth::user();

    	$this->layout = View::make('layouts.admin');

		if($user->role_id == 7){
			$this->layout->content = View::make('Pelembagaan.update', array(
				'title' => 'Ubah Pelembagaan #' . $pelembagaan->id,
				'detail' => '',
				'form_opts' => array('route' => 'proses_update_pelembagaan','method' => 'post','class' => 'form-horizontal','id' => 'pelembagaan-update','files' => true),
				'pelembagaan' => $pelembagaan,
				'id' => $id,
			));
		} else if($user->role_id == 8) {
			$this->layout->content = View::make('Pelembagaan.update', array(
				'title' => 'Ubah Pelembagaan #' . $pelembagaan->id,
				'detail' => '',
				'form_opts' => array('route' => 'proses_update_pelembagaan_bahu','method' => 'post','class' => 'form-horizontal','id' => 'pelembagaan-update','files' => true),
				'pelembagaan' => $pelembagaan,
				'id' => $id,
			));
		} else if($user->role_id == 3) {
			$this->layout->content = View::make('Pelembagaan.update', array(
				'title' => 'Ubah Pelembagaan #' . $pelembagaan->id,
				'detail' => '',
				'form_opts' => array('route' => 'proses_update_pelembagaan_admin','method' => 'post','class' => 'form-horizontal','id' => 'pelembagaan-update','files' => true),
				'pelembagaan' => $pelembagaan,
				'id' => $id,
			));
		}
	}

	public function update() //$id)
	{
		$id = Input::get("id");
        $input = Input::all();

        $DAL = new DAL_Pelembagaan();
        $helper = new HukorHelper();

        $uploadSuccess = $helper->UploadFile('pelembagaan', Input::file('lampiran'));         // Upload File
        $logPelembagaan =  $DAL->saveLogPelembagaan($input, Input::file('lampiran'), $id);	  // save pelembagaan

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
			return Redirect::to('pelembagaan/index_pelembagaan')->with('success', 'Data berhasil diubah.');
	}  

	public function store()
	{
        $input = Input::all();

        $DAL = new DAL_Pelembagaan();
        $helper = new HukorHelper();

        // Upload File
        $uploadSuccess = $helper->UploadFile('pelembagaan', Input::file('lampiran'));

        if($uploadSuccess) {
        	$DAL->savePelembagaan($input, Input::file('lampiran'));         	// save pelembagaan
        	$DAL->sendEmailToAllAdminPelembagaan();        						// send Email to admin

			Session::flash('success', 'Data berhasil dikirim.');
			return Redirect::to('pelembagaan/usulan');
		} else {
			Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
			return Redirect::to('pelembagaan/usulan');
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

	public function deleteLog($id){
		$logPelembagaan = logPelembagaan::find($id);
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
