<?php

class LayananKelembagaanController extends BaseController {

//    protected $layout = 'layouts.admin';

    public function index(){

        $info = LayananKelembagaan::find(1);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('layanankelembagaan.index',
        array(
            'info' => $info,
//            'image' => $this->lihatLampiran()
        ));
    }

    public function pembentukan(){

        $info = LayananKelembagaan::find(2);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('lembaga_pembentukan.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }
    public function penataan(){

        $info = LayananKelembagaan::find(3);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('lembaga_penataan.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }
    public function penutupan(){

        $info = LayananKelembagaan::find(4);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('lembaga_penutupan.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }
    public function statuta(){

        $info = LayananKelembagaan::find(5);
        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('lembaga_statuta.index',
            array(
                'info' => $info,
//            'image' => $this->lihatLampiran()
            ));
    }

    public function create(){
        $info = LayananKelembagaan::find(1);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('layanankelembagaan.form',
        array(
            'info' => $info,
            'id' => 1
        ));
    }

    public function create_pembentukan(){
        $info = LayananKelembagaan::find(2);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('lembaga_pembentukan.form',
            array(
                'info' => $info,
                'id' => 2
            ));
    }

    public function create_penataan(){
        $info = LayananKelembagaan::find(3);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('lembaga_penataan.form',
            array(
                'info' => $info,
                'id' => 3
            ));
    }

    public function create_statuta(){
        $info = LayananKelembagaan::find(4);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('lembaga_statuta.form',
            array(
                'info' => $info,
                'id' => 4
            ));
    }

    public function create_penutupan(){
        $info = LayananKelembagaan::find(5);

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('lembaga_penutupan.form',
            array(
                'info' => $info,
                'id' => 5
            ));
    }

    public function submit()
    {
        $id = Input::get('id');

        $input = Input::get('layananlembaga');
        $img = Input::file('layananlembaga.image');
        $kelembagaan = LayananKelembagaan::find($id);

        $rows = count($kelembagaan);

        //save
        if($img->isValid()){
            $uqFolder = "layanankelembagaan";
//            var_dump($uqFolder);exit;
            $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
            $filename = $img->getClientOriginalName();
            $uploadSuccess = $img->move($destinationPath, $filename);

            if($uploadSuccess){
                if($kelembagaan != null){
                    //UPDATE
                    switch($id){
                        case '1':

                            //find data dari tabel layanan_kelembagaan yang idnya = 1
                            $kelem = LayananKelembagaan::find(1);

                            //path directory untuk file image
                            $img_exists = $destinationPath . '/' . $kelem->image;

                            //pengecekkan file image apakah ada atau tidak
                            if(file_exists($img_exists))

                                //delete file image di folder yang terdaftar di database
                                unlink($img_exists);

                            //update data layanan_kelembagaan
                            $DAL = new DAL_LayananKelembagaan();
                            $success = $DAL->update($input, $kelem, $filename);

                            if($success){
                                return Redirect::to('admin/edit_kelembagaan')->with('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                        case '2':
//                             echo "update";exit;
                            //find data dari tabel layanan_kelembagaan yang idnya = 1
                            $kelem = LayananKelembagaan::find(2);

                            //path directory untuk file image
                            $img_exists = $destinationPath . '/' . $kelem->image;

                            //pengecekkan file image apakah ada atau tidak
                            if(file_exists($img_exists))

                                //delete file image di folder yang terdaftar di database
                                unlink($img_exists);

                            //update data layanan_kelembagaan
                            $DAL = new DAL_LayananKelembagaan();
                            $success = $DAL->update($input, $kelem, $filename);

                            if($success){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
                                return Redirect::to('admin/edit_pembentukan');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                        case '3':

                            //find data dari tabel layanan_kelembagaan yang idnya = 1
                            $kelem = LayananKelembagaan::find(3);

                            //path directory untuk file image
                            $img_exists = $destinationPath . '/' . $kelem->image;

                            //pengecekkan file image apakah ada atau tidak
                            if(file_exists($img_exists))

                                //delete file image di folder yang terdaftar di database
                                unlink($img_exists);

                            //update data layanan_kelembagaan
                            $DAL = new DAL_LayananKelembagaan();
                            $success = $DAL->update($input, $kelem, $filename);

                            if($success){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
                                return Redirect::to('admin/edit_penataan');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                        case '4':

                            //find data dari tabel layanan_kelembagaan yang idnya = 1
                            $kelem = LayananKelembagaan::find(4);

                            //path directory untuk file image
                            $img_exists = $destinationPath . '/' . $kelem->image;

                            //pengecekkan file image apakah ada atau tidak
                            if(file_exists($img_exists))

                                //delete file image di folder yang terdaftar di database
                                unlink($img_exists);

                            //update data layanan_kelembagaan
                            $DAL = new DAL_LayananKelembagaan();
                            $success = $DAL->update($input, $kelem, $filename);

                            if($success){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
                                return Redirect::to('admin/edit_statuta');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                        case '5':

                            //find data dari tabel layanan_kelembagaan yang idnya = 1
                            $kelem = LayananKelembagaan::find(5);

                            //path directory untuk file image
                            $img_exists = $destinationPath . '/' . $kelem->image;

                            //pengecekkan file image apakah ada atau tidak
                            if(file_exists($img_exists))

                                //delete file image di folder yang terdaftar di database
                                unlink($img_exists);

                            //update data layanan_kelembagaan
                            $DAL = new DAL_LayananKelembagaan();
                            $success = $DAL->update($input, $kelem, $filename);

                            if($success){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
                                return Redirect::to('admin/edit_penutupan');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                    }

                }else{
                    //CREATE
                    switch($id){
                        case '1':
                            $lembaga = new DAL_LayananKelembagaan();
                            $lembaga->SetData(array(
                                'id' => $id,
                                'judul_berita' => $input['judul_berita'],
                                'berita' => $input['berita'],
                                'penanggung_jawab' => $input['penanggung_jawab'], // Aktif
                                'image' => $filename,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ));

                            if($lembaga->Save()){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil ditambahkan!');
                                return Redirect::to('admin/edit_kelembagaan');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                        case '2':
//                            echo "create";exit;

                            $lembaga = new DAL_LayananKelembagaan();
                            $lembaga->SetData(array(
                                'id' => $id,
                                'judul_berita' => $input['judul_berita'],
                                'berita' => $input['berita'],
                                'penanggung_jawab' => $input['penanggung_jawab'], // Aktif
                                'image' => $filename,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ));

                            if($lembaga->Save()){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil ditambahkan!');
                                return Redirect::to('admin/edit_pembentukan');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                        case '3':
                            $lembaga = new DAL_LayananKelembagaan();
                            $lembaga->SetData(array(
                                'id' => $id,
                                'judul_berita' => $input['judul_berita'],
                                'berita' => $input['berita'],
                                'penanggung_jawab' => $input['penanggung_jawab'], // Aktif
                                'image' => $filename,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ));

                            if($lembaga->Save()){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil ditambahkan!');
                                return Redirect::to('admin/edit_penataan');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                        case '4':
                            $lembaga = new DAL_LayananKelembagaan();
                            $lembaga->SetData(array(
                                'id' => $id,
                                'judul_berita' => $input['judul_berita'],
                                'berita' => $input['berita'],
                                'penanggung_jawab' => $input['penanggung_jawab'], // Aktif
                                'image' => $filename,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ));

                            if($lembaga->Save()){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil ditambahkan!');
                                return Redirect::to('admin/edit_statuta');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                                return Redirect::back();
                            }
                            break;
                        case '5':
                            $lembaga = new DAL_LayananKelembagaan();
                            $lembaga->SetData(array(
                                'id' => $id,
                                'judul_berita' => $input['judul_berita'],
                                'berita' => $input['berita'],
                                'penanggung_jawab' => $input['penanggung_jawab'], // Aktif
                                'image' => $filename,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ));

                            if($lembaga->Save()){
                                Session::flash('success', 'Informasi Layanan Kelembagaan berhasil ditambahkan!');
                                return Redirect::to('admin/edit_penutupan');
                            }else{
                                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
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

        $lampiran = LayananKelembagaan::find(1);
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