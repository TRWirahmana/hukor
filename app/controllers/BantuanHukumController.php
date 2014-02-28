<?php

class BantuanHukumController extends BaseController{ 
    //    protected $layout = 'layouts.master';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
	$user = Auth::user()->role_id;
	//        echo($user);exit;
	if($user == 2 || $user == null){
	    $this->layout = View::make('layouts.master');
	    $this->layout->content = View::make('BantuanHukum.index', array('user'=> $user));
	}else{
	    $this->layout = View::make('layouts.admin');
	    $this->layout->content = View::make('BantuanHukum.index_admin', array('user'=> $user));
	}

	//        $this->layout->content = View::make('BantuanHukum.index', array('user'=> $user));
    }

    public function create()
    {
	$user = Auth::user();
	$reg = new DAL_Registrasi();

	if($user != null)
	{
	    $data = $reg->findPengguna($user->id);

	    // show form with empty model
	    $this->layout = View::make('layouts.master');
	    $this->layout->content = View::make('BantuanHukum.form', array(
			'user' => $data
			));
	}
	else
	{
	    return Redirect::to('BantuanHukum')->with('Error', 'Harus Login Terlebih Dahulu.');
	}
    }

    public function store()
    {
	$input = Input::all();

	$DAL = new DAL_BantuanHukun();
	$helper = new HukorHelper();

	//updaload file
	$filenames = array();
	$filenames = $helper->MultipleUploadFile('bantuanhukum', Input::file('lampiran'));
	//     $uploadSuccess = $helper->UploadFile('bantuanhukum', Input::file('lampiran'));

	// if($uploadSuccess)
	if($filenames)
	{
	    //$DAL->SaveBantuanHukum($input, Input::file('lampiran')); //save bantuan hukum
	    $DAL->SaveBantuanHukum($input, $filenames); //save bantuan hukum
	    $DAL->SendEmailToAllAdminBankum(); // send email

	    return Redirect::route('bantuan_hukum.create')->with('success', 'Data Bantuan Hukum Berhasil Di Simpan.');
	}
	else
	{
	    return Redirect::route('bantuan_hukum.create')->with('error', 'Lampiran Gagal Disimpan.');
	}
    }

    public function datatable()
    {
	$input = Input::all();
	$DAL = new DAL_BantuanHukun();
	$data = $DAL->GetAllData($input);

	return $data;
    }

    public function detail($id)
    {
	$DAL = new DAL_BantuanHukun();

	//get bantuan hukum by id
	$banhuk = $DAL->GetSingleBantuanHukum($id);

	// show form with empty model
	$this->layout = View::make('layouts.admin');
	$this->layout->content = View::make('BantuanHukum.detail', array('banhuk'=> $banhuk));
    }

    public function update($id)
    {
	$user = Auth::user()->role_id;
	$input = Input::all();
	$input['id'] = $id;

	$DAL = new DAL_BantuanHukun();
	$data = $DAL->UpdateBantuanHukum($input); // update bantuan hukum

	$link = URL::to('admin/bantuan_hukum'); //link to bantuan hukum with id bantuan hukum            

	return Redirect::to($link)->with('success', 'Data Bantuan Hukum Berhasil Di Simpan.');
    }

    public function tablelog()
    {
	$input = Input::all();
	$DAL = new DAL_BantuanHukun();
	$data = $DAL->GetAllLog($input);

	return $data;
    }

    public function delete($id)
    {
	$user = Auth::user()->role_id;
	$DAL = new DAL_BantuanHukun();

	$DAL->DeleteBantuanHukum($id);

	if($user == 2){
	    return Redirect::to('bantuanhukum')->with('success', 'Usulan Bantuan Hukum Berhasil Di Hapus.');
	} else {
	    return Redirect::to('admin/bantuan_hukum')->with('success', 'Usulan Bantuan Hukum Berhasil Di Hapus.');            
	}
    }

    public function deletelog($id)
    {
	$DAL = new DAL_BantuanHukun();

	$data = $DAL->GetSingleLogBantuanHukum($id);
	$DAL->DeleteLogBantuanHukum(false, $id);

	$link = URL::to('/') . '/admin/bantuan_hukum/detail/' . $data->bantuan_hukum_id;

	return Redirect::to($link)->with('success', 'Data Berhasil Di Hapus.');
    }

    public function downloadLampiranLog($id)
    {
	if($log = LogPelembagaan::find($id))
	    return HukorHelper::downloadAsZIP(unserialize($log->lampiran));
	return App::abort(404);
    }


    public function download($id, $index = null) {
	if($object = BantuanHukum::find($id)) {
	    $attachments = unserialize($object->lampiran);	
	    if(!empty($attachments) && null !== $index && isset($attachments[$index]) )
	    {
		$filename = $attachments[$index];	
		$originalName = explode('/', $filenam)[1];
		$path = UPLOAD_PATH . DS . $filename;
		if(file_exists($path))
		    return Response::download($path, $originalname);
	    } else {
		return HukorHelper::downloadAsZIP($attachments);
	    }
	}
	return App::abort(404);
    }


    public function convertpdf()
    {
	$start = Input::get('start_date', null);
	$end = Input::get('end_date', null);

	if(null != $start)
	    $start = date_format(new DateTime($start), "d/m/Y");
	if(null != $end)
	    $end = date_format(new DateTime($end), "d/m/Y");

	// $DAL = new DAL_BantuanHukun();
	// $helper = new HukorHelper();

	// $fields = array(
	//     'nama_lengkap',
	//     'jenis_perkara',
	//     'status_pemohon',
	//     'status_perkara',
	//     'advokasi',
	//     'advokator'
	// );
	// $data = $DAL->GetBankumByDate($start, $end);

	// $helper->GeneratePDf($data, $fields);


	$style = array("<style>");
	$style[] = "table { border-collapse: collapse; }";
	$style[] = "table td, table th { padding: 5px; }";
	$style[] = "</style>";

	$html = array("<h1>Bantuan Hukum</h1>");
	$html[] = "<table><tr>";
	if(null != $start)
	    $html[] = "<td><strong>Tgl awal</strong></td><td>: {$start}</td>";
	if(null != $end)
	    $html[] = "<td><strong>Tgl akhir</strong></td><td>: {$end}</td>";
	$html[] = "</tr></table>";

	$html[] = DAL_BantuanHukun::getPrintTable($start, $end);

	$pdf = new DOMPDF();
	$pdf->load_html(join("", $style) . join("",$html));
	$pdf->render();
	$pdf->stream("bantuan_hukum.pdf");
    }
}

