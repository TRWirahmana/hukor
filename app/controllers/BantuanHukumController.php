<?php

class BantuanHukumController extends BaseController{

    protected $layout = 'layouts.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
//        echo "TEST";
        $this->layout->content = View::make('BantuanHukum.index');

    }

    public function add()
    {
        $user = Auth::user();
        $reg = new DAL_Registrasi();

        if($user != null)
        {
            $data = $reg->findPengguna($user->id);

            // show form with empty model
            $this->layout->content = View::make('bantuanhukum.form', array(
                'user' => $data
            ));
        }
        else
        {
            return Redirect::to('BantuanHukum')->with('Error', 'Harus Login Terlebih Dahulu.');
        }
    }

    public function save()
    {
        $input = Input::all();

        $DAL = new DAL_BantuanHukun();

        $DAL->SaveBantuanHukum($input);

        return Redirect::to('addbahu')->with('success', 'Pengaturan akun berhasil disimpan.');
    }

    public function datatable()
    {
        $input = Input::all();
        $DAL = new DAL_BantuanHukun();
        $data = $DAL->GetAllData($input);

        return $data;
    }
}

