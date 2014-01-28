<?php

class LayananKelembagaanController extends BaseController {

    protected $layout = 'layouts.master';

    public function index(){

        $info = LayananKelembagaan::find(1);

        $this->layout->content = View::make('layanankelembagaan.index',
        array(
            'info' => $info,
//            'image' => $this->lihatLampiran()
        ));
    }

    public function create(){
        $info = LayananKelembagaan::find(1);

        $this->layout->content = View::make('layanankelembagaan.form',
        array(
            'info' => $info
        ));
    }

    public function submit()
    {
        $input = Input::get('layananlembaga');
        $img = Input::file('layananlembaga.image');
        $kelembagaan = LayananKelembagaan::all();
        $rows = count($kelembagaan);

        //save
        if($img->isValid()){
            $uqFolder = "layanankelembagaan";
//            var_dump($uqFolder);exit;
            $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
            $filename = $img->getClientOriginalName();
            $uploadSuccess = $img->move($destinationPath, $filename);

            if($uploadSuccess){
                if($rows == 1){

                    //find data dari tabel layanan_kelembagaan yang idnya = 1
                    $kelem = LayananKelembagaan::find(1);

                    //path directory untuk file image
                    $img_exists = $destinationPath . '/' . $kelem->image;

                    //pengecekkan file image apakah ada atau tidak
                    if(file_exists($img_exists))

                        //delete file image yang exist di database
                        unlink($img_exists);

                    //update data layanan_kelembagaan
                    $DAL = new DAL_LayananKelembagaan();
                    $DAL->update($input, $kelem, $filename);

                    if($kelem->save()){
                        Session::flash('success', 'Informasi Layanan Kelembagaan berhasil dirubah!');
                        return Redirect::to('layanan_kelembagaan/CreateInfo');
                    }else{
                        Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                        return Redirect::back();
                    }

                }else{
                    $lembaga = new DAL_LayananKelembagaan();
                    $lembaga->SetData(array(
                        'judul_berita' => $input['judul_berita'],
                        'berita' => $input['berita'],
                        'penanggung_jawab' => $input['penanggung_jawab'], // Aktif
                        'image' => $filename,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ));

                    if($lembaga->Save()){
                        Session::flash('success', 'Informasi Layanan Kelembagaan berhasil ditambahkan!');
                        return Redirect::to('layanan_kelembagaan/index');
                    }else{
                        Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                        return Redirect::back();
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