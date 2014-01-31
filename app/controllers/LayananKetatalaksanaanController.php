<?php
class LayananKetatalaksanaanController extends BaseController {

//	protected $layout = 'layout.admin';
	public function index(){

		$info = LayananKetatalaksanaan::find(1);
		$this->layout = View::make('layouts.master');

		$this->layout->content = View::make('layananketatalaksanaan.index',
		array(
				'info' => $info,
		));
	}

    public function spk(){

		$info = LayananKetatalaksanaan::find(2);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('ketatalaksanaan_spk.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }

    public function smm(){

		$info = LayananKetatalaksanaan::find(3);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('ketatalaksanaan_smm.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }

    public function analisis_jabatan(){

		$info = LayananKetatalaksanaan::find(4);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('ketatalaksanaan_jabatan.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }

    public function pbk(){

		$info = LayananKetatalaksanaan::find(5);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('ketatalaksanaan_pbk.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }


    public function tata_nilai(){

		$info = LayananKetatalaksanaan::find(6);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('ketatalaksanaan_nilai.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }

    public function pelayanan_publik(){

		$info = LayananKetatalaksanaan::find(7);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('ketatalaksanaan_pelayanan.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }

    public function tnd(){

		$info = LayananKetatalaksanaan::find(8);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('ketatalaksanaan_tnd.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }

	public function create(){
		$info = LayananKetatalaksanaan::find(1);
		
		$this->layout = View::make('layouts.admin');

		$this->layout->content = View::make('layananketatalaksanaan.form',
		array(
				'form_opts' => array(
					'action' => 'LayananKetatalaksanaanController@submit',
					'method' => 'post',
					'id'=>'user-layananketatalaksanaan-form',
					'class' =>'front-form form-horizontal',
					'autocomplete' => 'off',
					'enctype' => "multipart/form-data"
				),
				'info' => $info,
				'id' => 1
		));
	}

    public function create_spk(){
		$info = LayananKetatalaksanaan::find(2);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('ketatalaksanaan_spk.form',
            array(
                'info' => $info,
                'id' => 2
            ));
    }

    public function create_smm(){
		$info = LayananKetatalaksanaan::find(3);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('ketatalaksanaan_smm.form',
            array(
                'info' => $info,
                'id' => 3
            ));
    }

    public function create_analisis_jabatan(){
		$info = LayananKetatalaksanaan::find(4);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('ketatalaksanaan_jabatan.form',
            array(
                'info' => $info,
                'id' => 4
            ));
    }

    public function create_pbk(){
		$info = LayananKetatalaksanaan::find(5);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('ketatalaksanaan_pbk.form',
            array(
                'info' => $info,
                'id' => 5
            ));
    }

    public function create_tata_nilai(){
		$info = LayananKetatalaksanaan::find(6);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('ketatalaksanaan_nilai.form',
            array(
                'info' => $info,
                'id' => 6
            ));
    }

    public function create_pelayanan_publik(){
		$info = LayananKetatalaksanaan::find(7);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('ketatalaksanaan_pelayanan.form',
            array(
                'info' => $info,
                'id' => 7
            ));
    }

    public function create_tnd(){
		$info = LayananKetatalaksanaan::find(8);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('ketatalaksanaan_tnd.form',
            array(
                'info' => $info,
                'id' => 8
            ));
    }

	public function submit()
	{
		$id = Input::get('id');

		$input = Input::get('layananketatalaksanaan');		
		$img = Input::file('layananketatalaksanaan.image');
		$ketatalaksanaan = LayananKetatalaksanaan::find($id);

		$rows = count($ketatalaksanaan);

		if($img->isValid()){
			$uqFolder = "layananketatalaksanaan";
		    $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
		    $filename = $img->getClientOriginalName();
            $uploadSuccess = $img->move($destinationPath, $filename);

		//	$upload = new HukorHelper($uqFolder, $img);
			if($uploadSuccess){
				if($ketatalaksanaan != null){
					//UPDATE					
					switch($id){
						case '1':
							//find data dari tabel layanan_ketatalaksanaan yang idnya = 1	
							$data = LayananKetatalaksanaan::find(1);

							$img_exists = $destinationPath . '/' . $data->image;

					   		//pengecekkan file image apakah ada atau tidak
		                    if(file_exists($img_exists))

		                        //delete file image di folder yang terdaftar di database
		                        unlink($img_exists);

		                    // update data layanan_ketatalaksanaan
		                    $DAL = new DAL_LayananKetatalaksanaan();
			                $success = $DAL->update($input, $data, $filename );

			                if($success){
	                            return Redirect::to('admin/edit_ketatalaksanaan')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
			               break;
			            case '2':
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
	                            return Redirect::to('admin/edit_spk')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
			            break;
			            case '3':
			            	//find data dari tabel layanan_ketatalaksanaan yang idnya = 1	
							$data = LayananKetatalaksanaan::find(3);

							$img_exists = $destinationPath . '/' . $data->image;

					   		//pengecekkan file image apakah ada atau tidak
		                    if(file_exists($img_exists))

		                        //delete file image di folder yang terdaftar di database
		                        unlink($img_exists);

		                    // update data layanan_ketatalaksanaan
		                    $DAL = new DAL_LayananKetatalaksanaan();
			                $success = $DAL->update($input, $data, $filename );

			                if($success){
	                            return Redirect::to('admin/edit_smm')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
			            break;
						case '4':
			            	//find data dari tabel layanan_ketatalaksanaan yang idnya = 1	
							$data = LayananKetatalaksanaan::find(4);

							$img_exists = $destinationPath . '/' . $data->image;

					   		//pengecekkan file image apakah ada atau tidak
		                    if(file_exists($img_exists))

		                        //delete file image di folder yang terdaftar di database
		                        unlink($img_exists);

		                    // update data layanan_ketatalaksanaan
		                    $DAL = new DAL_LayananKetatalaksanaan();
			                $success = $DAL->update($input, $data, $filename );

			                if($success){
	                            return Redirect::to('admin/edit_analisis_jabatan')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
			            break;
			            case '5':
			            	//find data dari tabel layanan_ketatalaksanaan yang idnya = 1	
							$data = LayananKetatalaksanaan::find(5);

							$img_exists = $destinationPath . '/' . $data->image;

					   		//pengecekkan file image apakah ada atau tidak
		                    if(file_exists($img_exists))

		                        //delete file image di folder yang terdaftar di database
		                        unlink($img_exists);

		                    // update data layanan_ketatalaksanaan
		                    $DAL = new DAL_LayananKetatalaksanaan();
			                $success = $DAL->update($input, $data, $filename );

			                if($success){
	                            return Redirect::to('admin/edit_pbk')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
			            break;
						case '6':
			            	//find data dari tabel layanan_ketatalaksanaan yang idnya = 1	
							$data = LayananKetatalaksanaan::find(6);

							$img_exists = $destinationPath . '/' . $data->image;

					   		//pengecekkan file image apakah ada atau tidak
		                    if(file_exists($img_exists))

		                        //delete file image di folder yang terdaftar di database
		                        unlink($img_exists);

		                    // update data layanan_ketatalaksanaan
		                    $DAL = new DAL_LayananKetatalaksanaan();
			                $success = $DAL->update($input, $data, $filename );

			                if($success){
	                            return Redirect::to('admin/edit_tata_nilai')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
			            break;
			            case '7':
			            	//find data dari tabel layanan_ketatalaksanaan yang idnya = 1	
							$data = LayananKetatalaksanaan::find(7);

							$img_exists = $destinationPath . '/' . $data->image;

					   		//pengecekkan file image apakah ada atau tidak
		                    if(file_exists($img_exists))

		                        //delete file image di folder yang terdaftar di database
		                        unlink($img_exists);

		                    // update data layanan_ketatalaksanaan
		                    $DAL = new DAL_LayananKetatalaksanaan();
			                $success = $DAL->update($input, $data, $filename );

			                if($success){
	                            return Redirect::to('admin/edit_pelayanan_publik')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
			            break;
						case '8':
			            	//find data dari tabel layanan_ketatalaksanaan yang idnya = 1	
							$data = LayananKetatalaksanaan::find(8);

							$img_exists = $destinationPath . '/' . $data->image;

					   		//pengecekkan file image apakah ada atau tidak
		                    if(file_exists($img_exists))

		                        //delete file image di folder yang terdaftar di database
		                        unlink($img_exists);

		                    // update data layanan_ketatalaksanaan
		                    $DAL = new DAL_LayananKetatalaksanaan();
			                $success = $DAL->update($input, $data, $filename );

			                if($success){
	                            return Redirect::to('admin/edit_tnd')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
			            break;
					}
				}else{
					// CREATE
					switch($id){
						case '1':
							$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
							$ketatalaksanaan->SetData(array(
								'id' => $id,
								'judul_berita' => $input['judul_berita'],
								'berita' => $input['berita'],
								'penanggung_jawab' => $input['penanggung_jawab'],
								'image' => $filename,
		                        'created_at' => date('Y-m-d H:i:s'),
		                        'updated_at' => date('Y-m-d H:i:s'),
							));

			                if($ketatalaksanaan->Save()){
			                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
			                	return Redirect::to('admin/edit_ketatalaksanaan');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
							break;

						case '2':
							$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
							$ketatalaksanaan->SetData(array(
								'id' => $id,
								'judul_berita' => $input['judul_berita'],
								'berita' => $input['berita'],
								'penanggung_jawab' => $input['penanggung_jawab'],
								'image' => $filename,
		                        'created_at' => date('Y-m-d H:i:s'),
		                        'updated_at' => date('Y-m-d H:i:s'),
							));

			                if($ketatalaksanaan->Save()){
			                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
			                	return Redirect::to('admin/edit_spk');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
							break;
						case '3':
							$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
							$ketatalaksanaan->SetData(array(
								'id' => $id,
								'judul_berita' => $input['judul_berita'],
								'berita' => $input['berita'],
								'penanggung_jawab' => $input['penanggung_jawab'],
								'image' => $filename,
		                        'created_at' => date('Y-m-d H:i:s'),
		                        'updated_at' => date('Y-m-d H:i:s'),
							));

			                if($ketatalaksanaan->Save()){
			                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
			                	return Redirect::to('admin/edit_smm');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
							break;

						case '4':
							$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
							$ketatalaksanaan->SetData(array(
								'id' => $id,
								'judul_berita' => $input['judul_berita'],
								'berita' => $input['berita'],
								'penanggung_jawab' => $input['penanggung_jawab'],
								'image' => $filename,
		                        'created_at' => date('Y-m-d H:i:s'),
		                        'updated_at' => date('Y-m-d H:i:s'),
							));

			                if($ketatalaksanaan->Save()){
			                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
			                	return Redirect::to('admin/edit_smm');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
							break;							
						case '5':
							$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
							$ketatalaksanaan->SetData(array(
								'id' => $id,
								'judul_berita' => $input['judul_berita'],
								'berita' => $input['berita'],
								'penanggung_jawab' => $input['penanggung_jawab'],
								'image' => $filename,
		                        'created_at' => date('Y-m-d H:i:s'),
		                        'updated_at' => date('Y-m-d H:i:s'),
							));

			                if($ketatalaksanaan->Save()){
			                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
			                	return Redirect::to('admin/edit_smm');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
							break;

						case '6':
							$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
							$ketatalaksanaan->SetData(array(
								'id' => $id,
								'judul_berita' => $input['judul_berita'],
								'berita' => $input['berita'],
								'penanggung_jawab' => $input['penanggung_jawab'],
								'image' => $filename,
		                        'created_at' => date('Y-m-d H:i:s'),
		                        'updated_at' => date('Y-m-d H:i:s'),
							));

			                if($ketatalaksanaan->Save()){
			                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
			                	return Redirect::to('admin/edit_analisis_jabatan');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
							break;							
						case '7':
							$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
							$ketatalaksanaan->SetData(array(
								'id' => $id,
								'judul_berita' => $input['judul_berita'],
								'berita' => $input['berita'],
								'penanggung_jawab' => $input['penanggung_jawab'],
								'image' => $filename,
		                        'created_at' => date('Y-m-d H:i:s'),
		                        'updated_at' => date('Y-m-d H:i:s'),
							));

			                if($ketatalaksanaan->Save()){
			                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
			                	return Redirect::to('admin/edit_pelayanan_publik');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
							break;
						case '8':
							$ketatalaksanaan = new DAL_LayananKetatalaksanaan();
							$ketatalaksanaan->SetData(array(
								'id' => $id,
								'judul_berita' => $input['judul_berita'],
								'berita' => $input['berita'],
								'penanggung_jawab' => $input['penanggung_jawab'],
								'image' => $filename,
		                        'created_at' => date('Y-m-d H:i:s'),
		                        'updated_at' => date('Y-m-d H:i:s'),
							));

			                if($ketatalaksanaan->Save()){
			                	Session::flash('success', 'Informasi Layanan Ketatalaksanaan berhasil dirubah');
			                	return Redirect::to('admin/edit_tnd');
			                }else{
			                	Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar');
			                	return Redirect::back();
			                }
							break;							
					}
				}
			}
		}else{
	            Session::flash('error', 'Gagal mengirim berkas.');
	            return Redirect::back();
		}
	}
	

    public function lihatLampiran() {

        $lampiran = LayananKetatalaksanaan::find(1);
        $path_lampiran = RETANE_UPLOAD_FOLDER . 'layananketatalaksanaan';

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
