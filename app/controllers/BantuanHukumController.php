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

    public function add()
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

    public function save()
    {
        $input = Input::all();

        $DAL = new DAL_BantuanHukun();
        $helper = new HukorHelper();

        //updaload file
        $uploadSuccess = $helper->UploadFile('bantuanhukum', Input::file('lampiran'));

        if($uploadSuccess)
        {
            $DAL->SaveBantuanHukum($input, Input::file('lampiran')); //save bantuan hukum
            $DAL->SendEmailToAllAdminBankum(); // send email

            return Redirect::route('create_bahu')->with('success', 'Data Bantuan Hukum Berhasil Di Simpan.');
        }
        else
        {
            return Redirect::route('create_bahu')->with('error', 'Lampiran Gagal Disimpan.');
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
        $DAL = new DAL_BantuanHukun();

        //get bantuan hukum by id
        $banhuk = $DAL->GetSingleBantuanHukum($id);

        // show form with empty model
        $this->layout  = View::make("layouts.master");
        $this->layout->content = View::make('BantuanHukum.detail', array(
            'banhuk' => $banhuk
        ));
    }

    public function update()
    {
        $input = Input::all();

        $DAL = new DAL_BantuanHukun();
        $data = $DAL->UpdateBantuanHukum($input); // update bantuan hukum

        $link = URL::to('site') . '/detail_banhuk?id=' . $data; //link to bantuan hukum with id bantuan hukum

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

        $link = URL::to('site') . '/detail_banhuk?id=' . $data->bantuan_hukum_id;

        return Redirect::to($link)->with('success', 'Data Berhasil Di Hapus.');
    }

    public function download()
    {
        $id = Input::get('id');
        $DAL = new DAL_BantuanHukun();
        $helper = new HukorHelper();

        $data = $DAL->GetSingleBantuanHukum($id);

        $download = $helper->DownloadFile('bantuanhukum', $data->lampiran);

        if($download != null)
        {
            return Response::download($download);
        }

        return Redirect::to('bantuanhukum')->with('error', 'Kesalahan, berkas tidak ditemukan.');
    }

    public function convertpdf()
    {
        $start = Input::get('start_date');
        $end = Input::get('end_date');

        $DAL = new DAL_BantuanHukun();
        $helper = new HukorHelper();

        $fields = array(
            'nama_lengkap',
            'jenis_perkara',
            'status_pemohon',
            'status_perkara',
            'advokasi',
            'advokator'
        );
        $data = $DAL->GetBankumByDate($start, $end);

        $helper->GeneratePDf($data, $fields);
    }
}

