<?php
class SpkController extends BaseController {

//	protected $layout = 'layout.admin';
	public function index(){

		$info = LayananKetatalaksanaan::find(2);
		$this->layout = View::make('layouts.master');

		$this->layout->content = View::make('layananketatalaksanaan.index',
		array(
				'info' => $info,
			));

	}

	public function create(){
		$info = LayananKetatalaksanaan::find(2);
		$this->layout = View::make('layouts.admin');

		$this->layout->content = View::make('layananketatalaksanaan.form',
		array(	
				'form_opts' => array(
					'action' => 'SpkController@submit',
					'method' => 'post',
					'id'=>'user-register-form',
					'class' =>'front-form form-horizontal',
					'autocomplete' => 'off',
					'enctype' => "multipart/form-data"
				),
				'info' => $info,
		));
	}

	public function submit(){
		$input = Input::get('layananketatalaksanaan');
		$img = Input::file('layananketatalaksanaan.image');
		$ketatalaksanaan = LayananKetatalaksanaan::all();
		$rows = count($ketatalaksanaan);
//		var_dump($img);
//		exit;

		if($img->isValid()){
			$uqFolder = "layananketatalaksanaan";
		    $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
		    $filename = $img->getClientOriginalName();
        
			$upload = new HukorHelper($uqFolder, $img);

			if($upload){
				if($rows === 1){

					//find data dari tabel layanan_ketatalaksanaan yang idnya = 1	
					$data = LayananKetatalaksanaan::find(2);

					$img_exists = $destinationPath . '/' . $data->image;

			   		//pengecekkan file image apakah ada atau tidak
                    if(file_exists($img_exists))

                        //delete file image di folder yang terdaftar di database
                        unlink($img_exists);

                    // update data layanan_ketatalaksanaan
                    $DAL = new DAL_LayananKetatalaksanaan();
	                $success = $DAL->update($input, $data, $filename );

	                if($success){
	                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
	                	return Redirect::to('spk/index');
	                }else{
	                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
	                	return Redirect::back();
	                }
				}else{
					$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
					$ketatalaksanaan->SetData(array(
						'judul_berita' => $input['judul_berita'],
						'berita' => $input['berita'],
						'penanggung_jawab' => $input['penanggung_jawab'],
						'image' => $filename,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
					));

	                if($ketatalaksanaan->save()){
	                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
	                	return Redirect::to('spk/index');
	                }else{
	                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
	                	return Redirect::back();
	                }
				}
			}else{
	            Session::flash('error', 'Gagal mengirim berkas.');
	            return Redirect::back();
			}
		}
	}
	

    public function lihatLampiran() {

        $lampiran = LayananKetatalaksanaan::find(2);
        $path_lampiran = RETANE_UPLOAD_FOLDER . 'layanankelembagaan';

        $path = $path_lampiran . DIRECTORY_SEPARATOR . $lampiran->image;
        if(!file_exists($path))
            $path = $path_lampiran . DIRECTORY_SEPARATOR . $lampiran->image;

        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $mimes = array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png'
        );

        $content = file_get_contents($path);

        $response = Response::make($content, 200);

        $response->header('Content-Type', $mimes[strtolower($ext)]);

        return $response;
    }

}
