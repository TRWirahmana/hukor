<?php

class BantuanHukumController extends BaseController{

    protected $layout = 'layouts.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
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
        $helper = new HukorHelper();

        $uploadSuccess = $helper->UploadFile('bantuanhukum', Input::file('lampiran'));

        if($uploadSuccess)
        {
            $saved = $DAL->SaveBantuanHukum($input, Input::file('lampiran'));

            if($saved)
            {
                return Redirect::to('addbahu')->with('success', 'Data Bantuan Hukum Berhasil Di Simpan.');
            }
            else
            {
                return Redirect::to('addbahu')->with('error', 'Data Bantuan Hukum Gagal Di Simpan.');
            }
        }
        else
        {
            return Redirect::to('addbahu')->with('error', 'Lampiran Gagal Disimpan.');
        }
    }

    public function datatable()
    {
        $input = Input::all();
        $DAL = new DAL_BantuanHukun();
        $data = $DAL->GetAllData($input);

        return $data;
    }

    public function detail()
    {
        $id = Input::get('id');
        $reg = new DAL_Registrasi();
        $DAL = new DAL_BantuanHukun();

        $banhuk = $DAL->GetSingleBantuanHukum($id);

        // show form with empty model
        $this->layout->content = View::make('bantuanhukum.detail', array(
            'banhuk' => $banhuk
        ));
    }

    public function update()
    {
        $input = Input::all();

        $DAL = new DAL_BantuanHukun();
        $data = $DAL->UpdateBantuanHukum($input);

        $link = URL::to('/') . '/detail_banhuk?id=' . $data;

        return Redirect::to($link)->with('success', 'Data Bantuan Hukum Berhasil Di Simpan.');
    }

    public function tablelog()
    {
        $input = Input::all();
        $DAL = new DAL_BantuanHukun();
        $data = $DAL->GetAllLog($input);

        return $data;
    }

    public function delete()
    {
        $id = Input::get('id');
        $DAL = new DAL_BantuanHukun();

        $DAL->DeleteBantuanHukum($id);

        return Redirect::to('bantuanhukum')->with('success', 'Usulan Bantuan Hukum Berhasil Di Hapus.');
    }

    public function deletelog()
    {
        $id = Input::get('id');
        $DAL = new DAL_BantuanHukun();

        $data = $DAL->GetSingleLogBantuanHukum($id);
        $DAL->DeleteLogBantuanHukum(false, $id);

        $link = URL::to('/') . '/detail_banhuk?id=' . $data->bantuan_hukum_id;

        return Redirect::to($link)->with('success', 'Data Berhasil Di Hapus.');
    }
}

