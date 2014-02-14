<?php

class LayananController extends BaseController {



    public function index(){
        $this->layout = View::make('layouts.admin');

        if(Request::ajax())
            return Datatables::of(DAL_Layanan::getDataTable(Input::get('filter', 0)))->make(true);

        $this->layout->content = View::make('layanan.index');
    }

    public function detail(){
        $id = Input::get('id');
//        echo $id;exit;

        if($id == 1 || $id == 2 || $id == 3 ){
            $info = Layanan::find($id);
            $this->layout = View::make('layouts.master');

            $this->layout->content = View::make('layanan.info_aplikasi',
                array(
                    'info' => $info
                ));
        }else{
            $info = Layanan::find($id);
            $this->layout = View::make('layouts.master');

            $this->layout->content = View::make('layanan.detail',
                array(
                    'info' => $info
                ));
        }


    }

    public function create(){

        $listMenu = array("" => "Pilih Menu") + Menu::lists("nama_menu", "id");
//        $menu = Menu::all();
//        $listMenu = array();
//        foreach($menu as $data)
//        {
//            $listMenu[$data->id] = $data->nama_menu;
//        }

        $listSubmenu = array("" => "Pilih Submenu") + Submenu::lists("nama_submenu", "id");

//        $submenu = Submenu::select('id', 'nama_submenu');

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('layanan.form',
            array(
                'listSubmenu' => $listSubmenu,
                'listMenu' => $listMenu,
                'menu' => new Menu()
            ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->layout = View::make('layouts.admin');

        $layanan = Menu::find($id);

        if(!is_null($layanan))
            $this->layout->content = View::make('layanan.form', array(
                'title' => 'Ubah Info Layanan #' . $layanan->submenu->layanan->id,
                'detail' => '',
                'form_opts' => array(
                    'route' => array('admin.layanan.update', $layanan->submenu->layanan->id),
                    'enctype' => 'multipart/form-data',
                    'method' => 'put',
                    'class' => 'form-horizontal'
                ),
                'menu' => $layanan,
            ));
    }


    public function submenu(){

        $menu_id = Input::get('menu_id');

        $DAL = new DAL_Layanan();

        $submenu = $DAL->submenu($menu_id);
//        echo json_encode($submenu);exit;

        return Response::json(array('data' => $submenu->get()->toArray()));

    }

    public function submit()
    {
        $input = Input::get('layanan');
        $img = Input::file('layanan.image');

        if($img != null){
            if($img->isValid()){
                $uqFolder = "layanan";
                $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
                $filename = $img->getClientOriginalName();
                $uploadSuccess = $img->move($destinationPath, $filename);

                if($uploadSuccess){
                    //CREATE
                    $lembaga = new DAL_Layanan();
                    $lembaga->SetData(array(
                        'menu_id' => $input['menu'],
                        'submenu_id' => $input['submenu'],
                        'berita' => $input['berita'],
                        'penanggung_jawab' => $input['penanggung_jawab'], // Aktif
                        'gambar' => $filename,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ));

                    if($lembaga->Save()){
                        Session::flash('success', 'Informasi Layanan berhasil ditambahkan!');
                        return Redirect::to('admin/layanan');
                    }else{
                        Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                        return Redirect::back();
                    }
                }
            }else{
                Session::flash('error', 'Gagal mengirim berkas.');
                return Redirect::back();
            }
        }else{
            $lembaga = new DAL_Layanan();
            $lembaga->SetData(array(
                'menu_id' => $input['menu'],
                'submenu_id' => $input['submenu'],
                'berita' => $input['berita'],
//                'penanggung_jawab' => $input['penanggung_jawab'], // Aktif
//                'gambar' => $filename,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));

            if($lembaga->Save()){
                Session::flash('success', 'Informasi Layanan berhasil ditambahkan!');
                return Redirect::to('admin/layanan');
            }else{
                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                return Redirect::back();
            }
        }

    }

    public function update($id)
    {


        $input = Input::all('layanan');

        $img = Input::file('layanan.image');

        $layanan = Menu::find($id);

        if($img->isValid()){
            $uqFolder = "berita";
//            var_dump($uqFolder);exit;
            $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
            $filename = $img->getClientOriginalName();
            $uploadSuccess = $img->move($destinationPath, $filename);

            if($uploadSuccess){

                $img_exists = $destinationPath . '/' . $layanan->submenu->layanan->gambar;

                //pengecekkan file image apakah ada atau tidak
                if(file_exists($img_exists))

                    //delete file image di folder yang terdaftar di database
                    unlink($img_exists);


                /* update to table layanan */
//                $berita->judul = $input['judul'];
                $layanan->submenu->layanan->menu_id = $input['menu'];
                $layanan->submenu->layanan->submenu_id = $input['submenu'];
                $layanan->submenu->layanan->berita = $input['berita'];
                $layanan->submenu->layanan->penulis = $input['penulis'];
                $layanan->submenu->layanan->gambar = $filename;
                $layanan->submenu->layanan->created_at = date('Y-m-d H:i:s');
                $layanan->submenu->layanan->updated_at = date('Y-m-d H:i:s');

                $layanan->submenu->layanan->save();

                if($layanan->submenu->layanan->save()){
                    Session::flash('success', 'Berita berhasil dirubah!');
                    return Redirect::to('admin/berita');
                }else{
                    Session::flash('error', 'Gagal mengirim data. Pastikan Berita sudah benar.');
                    return Redirect::back();
                }

            }

        }else{
            Session::flash('error', 'Gagal mengirim berkas.');
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $menu = Menu::find($id);
//        echo $menu->submenu->layanan;exit;
//        var_dump($user);exit;
        if(!is_null($menu->submenu->layanan)) {
            $menu->submenu->layanan()->delete();
        }

    }

}