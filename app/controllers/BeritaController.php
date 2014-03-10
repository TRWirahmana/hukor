<?php

class BeritaController extends BaseController {


    protected $layout = 'layouts.admin';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function home(){
        $user = Auth::user();
        $this->layout->content = View::make('admin.home', array(
            'user'=> $user
        ));
    }

    public function index()
    {
//        $user = Auth::user();

        // handle dataTable request
        if(Request::ajax())
            return Datatables::of(DAL_Berita::getDataTable(Input::get('filter', 0)))->make(true);

        $this->layout->content = View::make('berita.index');
    }

    // store user setting data
    public function save() {

        $input = Input::all();
        $user = Auth::user();

//        if ($registrasi->status == 1) {
//            return Redirect::to('edit')->with('error', 'Perubahan tidak bisa dilakukan.');
//        }


        $rules = array();
        $messages = array();

        if($input['username'] !== $user->username) {
            $rules['username'] = 'required|unique:registrasi|min:6';
            $messages['username.unique'] = 'Username tidak tersedia.';
            $messages['username.min'] = 'Username minimal 6 karakter.';

            $user->username = $input['username'];
        }

        if(!empty($input['password'])) {
            $rules['password'] = 'confirmed|min:6';
            $messages['password.confirmed'] = 'Konfirmasi password salah.';
            $messages['password.min'] = 'Password minimal 6 karakter.';

            $user->password = Hash::make($input['password']);
        }


//        $validator = Validator::make($input, $rules, $messages);
//
//        if($validator->fails()) {
//            return Redirect::to('setting')->withErrors($validator)
//                ->withInput(Input::except('password'))
//                    ->with('error', 'Pengaturan gagal disimpan, mohon periksa kembali.');
//
//        }

        $user->save();

        return Redirect::to('admin/Index')->with('success', 'Pengaturan akun berhasil disimpan.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $this->layout->content = View::make('berita.form', array(
            'title' => 'Tambah Berita',
            'detail' => 'Isi Keterangan dibawah ini',
            'form_opts' => array(
                'route' => 'admin.berita.store',
                'enctype' => 'multipart/form-data',
                'method' => 'post',
                'class' => 'form-horizontal',
                'id' => 'form_berita'
            ),
            'berita' => new Berita()
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $img = Input::file('gambar');
        $slider = Input::file('slider');

        //save
        if($img != null && $slider != null){
            if($img->isValid() || $slider->isValid()){
                $uqFolder = "berita";
//            var_dump($uqFolder);exit;
                $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
                $filename = $img->getClientOriginalName();
                $slider_img = $slider->getClientOriginalName();
                $uploadSuccess = $img->move($destinationPath, $filename);
                $sliderupload = $slider->move($destinationPath, $slider_img);

                if($uploadSuccess || $sliderupload){
                    /* save to table berita */
                    $berita = new DAL_Berita();

                    $berita->SetData(array(
                        'judul' => $input['judul'],
                        'berita' => $input['berita'],
                        'id_kategori' => $input['kategori'],
//                    'penulis' => $input['penulis'],
                        'gambar' => $filename,
                        'slider' => $slider_img,
                        'tgl_penulisan' => new DateTime,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ));

                    if($berita->Save()){
                        Session::flash('success', 'Berita berhasil ditambahkan!');
//                    Cache::forget('Berita');
                        return Redirect::to('admin/berita');
                    }else{
                        Session::flash('error', 'Berita Gagal disimpan. Pastikan data Berita sudah benar.');
                        return Redirect::back();
                    }
                }

            }else{
                Session::flash('error', 'Gagal mengirim berkas.');
                return Redirect::back();
            }

        }
        elseif($img != null && $slider == null){
            if($img->isValid()){
                $uqFolder = "berita";
//            var_dump($uqFolder);exit;
                $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
                $filename = $img->getClientOriginalName();
                $uploadSuccess = $img->move($destinationPath, $filename);

                if($uploadSuccess){
                    /* save to table berita */
                    $berita = new DAL_Berita();

                    $berita->SetData(array(
                        'judul' => $input['judul'],
                        'berita' => $input['berita'],
                        'id_kategori' => $input['kategori'],
//                    'penulis' => $input['penulis'],
                        'gambar' => $filename,
                        'tgl_penulisan' => new DateTime,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ));

                    if($berita->Save()){
                        Session::flash('success', 'Berita berhasil ditambahkan!');
//                    Cache::forget('Berita');
                        return Redirect::to('admin/berita');
                    }else{
                        Session::flash('error', 'Berita Gagal disimpan. Pastikan data Berita sudah benar.');
                        return Redirect::back();
                    }
                }
            }
        }
            elseif($slider != null && $img == null){
            if($slider->isValid()){
                $uqFolder = "berita";
//            var_dump($uqFolder);exit;
                $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
                $slider_img = $slider->getClientOriginalName();
                $sliderupload = $slider->move($destinationPath, $slider_img);

                if($sliderupload){
                    /* save to table berita */
                    $berita = new DAL_Berita();

                    $berita->SetData(array(
                        'judul' => $input['judul'],
                        'berita' => $input['berita'],
                        'id_kategori' => $input['kategori'],
//                    'penulis' => $input['penulis'],
                        'slider' => $slider_img,
                        'tgl_penulisan' => new DateTime,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ));

                    if($berita->Save()){
                        Session::flash('success', 'Berita berhasil ditambahkan!');
//                    Cache::forget('Berita');
                        return Redirect::to('admin/berita');
                    }else{
                        Session::flash('error', 'Berita Gagal disimpan. Pastikan data Berita sudah benar.');
                        return Redirect::back();
                    }
                }
            }
        }
        else{
            $berita = new DAL_Berita();

            $berita->SetData(array(
                'judul' => $input['judul'],
                'berita' => $input['berita'],
                'id_kategori' => $input['kategori'],
                'tgl_penulisan' => new DateTime,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));

            if($berita->Save()){
                Session::flash('success', 'Berita berhasil ditambahkan!');
//                    Cache::forget('Berita');
                return Redirect::to('admin/berita');
            }else{
                Session::flash('error', 'Berita gagal disimpan. Pastikan data Berita sudah benar.');
                return Redirect::back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $berita = Berita::find($id);

        if(!is_null($berita))
            $this->layout->content = View::make('berita.form', array(
                'title' => 'Ubah Berita #' . $berita->id,
                'detail' => '',
                'form_opts' => array(
                    'route' => array('admin.berita.update', $berita->id),
                    'enctype' => 'multipart/form-data',
                    'method' => 'put',
                    'class' => 'form-horizontal'
                ),
                'berita' => $berita,
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {


        $input = Input::all();

        $img = Input::file('gambar');
        $slider = Input::file('slider');

        $berita = Berita::find($id);

        if($img != null || $slider != null){
            if($img->isValid() || $slider->isValid()){
                $uqFolder = "berita";

//            var_dump($uqFolder);exit;
                $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $uqFolder;
                $filename = $img->getClientOriginalName();
                $slider_img = $slider->getClientOriginalName();
                $uploadSuccess = $img->move($destinationPath, $filename);
                $sliderupload = $slider->move($destinationPath, $slider_img);

                if($uploadSuccess || $sliderupload){

                    $img_exists = $destinationPath . '/' . $berita->gambar;
                    $slider_exists = $destinationPath . '/' . $berita->slider;

                    //pengecekkan file image apakah ada atau tidak
                    if(file_exists($img_exists) || file_exists($slider_exists))

                        //delete file image di folder yang terdaftar di database
                        unlink($img_exists);
                        unlink($slider_exists);

                    /* update to table berita */
                    $berita->judul = $input['judul'];
                    $berita->berita = $input['berita'];
                    $berita->penulis = $input['penulis'];
		    $berita->id_kategori = $input['kategori'];
                    $berita->gambar = $filename;
                    $berita->slider = $slider_img;
                    $berita->tgl_penulisan = new DateTime;
                    $berita->created_at = date('Y-m-d H:i:s');
                    $berita->updated_at = date('Y-m-d H:i:s');

                    $berita->save();

                    if($berita->save()){
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
        }else{
            /* update to table berita */
            $berita->judul = $input['judul'];
            $berita->berita = $input['berita'];
            $berita->penulis = $input['penulis'];
	    $berita->id_kategori = $input['kategori'];
            $berita->gambar = $input['gambar'];;
            $berita->slider = $input['slider'];;
            $berita->tgl_penulisan = new DateTime;
            $berita->created_at = date('Y-m-d H:i:s');
            $berita->updated_at = date('Y-m-d H:i:s');

            $berita->save();

            if($berita->save()){
                Session::flash('success', 'Berita berhasil dirubah!');
                return Redirect::to('admin/berita');
            }else{
                Session::flash('error', 'Gagal mengirim data. Pastikan Berita sudah benar.');
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

        $berita = Berita::find($id);
//        var_dump($user);exit;
        if(!is_null($berita)) {
            $berita->delete();
        }

    }

}
