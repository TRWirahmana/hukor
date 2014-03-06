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
        $all = Menu::all();
        $all->toArray();

        if($id == 1 || $id == 2 || $id == 3 ){
            $info = Layanan::find($id);
            $this->layout = View::make('layouts.master',
            array(
                'allmenu' => $all));

            $this->layout->content = View::make('layanan.info_aplikasi',
                array(
                    'info' => $info,
                    'allmenu' => $all
                ));
        }else{
            $info = Layanan::find($id);
            $this->layout = View::make('layouts.master',array(
                'allmenu' => $all));

            $this->layout->content = View::make('layanan.detail',
                array(
                    'info' => $info,
                    'allmenu' => $all
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
        $listPJ = array("" => "-- Pilih Bagian --") + Bagian::lists('nama_bagian', 'id');

        $this->layout = View::make('layouts.admin');

        $this->layout->content = View::make('layanan.form', array(
            'title' => 'Tambah Submenu',
            'detail' => 'Lengkapi data dibawah ini untuk menambahkan konten layanan baru.',
            'form_opts' => array(
                'route' => 'admin.layanan.store',
                'method' => 'post',
                'class' => 'form-horizontal',
                'id' => 'layanan_form',
                'enctype' => "multipart/form-data"
            ),
                'listSubmenu' => $listSubmenu,
                'listMenu' => $listMenu,
                'listPJ' => $listPJ,
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

        $listMenu = array("" => "Pilih Menu") + Menu::lists("nama_menu", "id");

        $listSubmenu = array("" => "Pilih Submenu") + Submenu::lists("nama_submenu", "id");

        $listPJ = array("" => "-- Pilih Bagian --") + Bagian::lists('nama_bagian', 'id');
        $layanan = Layanan::find($id);

        if(!is_null($layanan))
            $this->layout->content = View::make('layanan.form', array(
                'title' => 'Ubah Info Layanan #' . $layanan->id,
                'detail' => '',
                'form_opts' => array(
                    'route' => array('admin.layanan.update', $layanan->id),
                    'enctype' => 'multipart/form-data',
                    'method' => 'put',
                    'class' => 'form-horizontal'
                ),
                'menu' => $layanan,
                'listMenu' => $listMenu,
                'listSubmenu' => $listSubmenu,
                'listPJ' => $listPJ,
            ));
    }


    public function submenu(){

        $menu_id = Input::get('menu_id');

        $DAL = new DAL_Layanan();

        $submenu = $DAL->submenu($menu_id);
//        echo json_encode($submenu);exit;

        return Response::json(array('data' => $submenu->get()->toArray()));

    }

    public function store()
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
                Session::flash('error', 'Gagal mengirim data.');
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
        $input = Input::get('layanan');

        $img = Input::file('layanan.image');

        $layanan = Layanan::find($id);



        if($img != null){
            if($img->isValid()){
                $uqFolder = "layanan";
                $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
                $filename = $img->getClientOriginalName();
                $uploadSuccess = $img->move($destinationPath, $filename);

                if($uploadSuccess){
//                    echo $input['menu'];exit;
                    $layanan->menu_id = $input['menu'];
                    $layanan->submenu_id = $input['submenu'];
                    $layanan->berita = $input['berita'];
                    $layanan->penanggung_jawab = $input['penanggung_jawab'];
                    $layanan->gambar = $filename;

                    $layanan->save();

                    if($layanan->save()){
                        Session::flash('success', 'Informasi Layanan berhasil dirubah!');
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
            $layanan->menu_id = $input['menu'];
            $layanan->submenu_id = $input['submenu'];
            $layanan->berita = $input['berita'];
            $layanan->penanggung_jawab = $input['penanggung_jawab'];
//            $layanan->gambar = $filename;
            $layanan->save();
//            var_dump($layanan);exit;
            if($layanan->save()){
                Session::flash('success', 'Informasi Layanan berhasil dirubah!');
                return Redirect::to('admin/layanan');
            }else{
                Session::flash('error', 'Gagal mengirim data. Pastikan Informasi sudah benar.');
                return Redirect::back();
            }
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

        $layanan = Layanan::find($id);
//        echo $menu->submenu->layanan;exit;
//        var_dump($user);exit;
        if(!is_null($layanan)) {
            $layanan->delete();
        }

    }

}