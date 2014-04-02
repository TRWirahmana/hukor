<?php

/**
 * Class ProfileController
 * author : erlan dwinov
 * email : erlan.novayanto@sangkuriang.co.id
 * PT. Sanguriang Solution
 */
class ProfileController extends BaseController
{
    protected $layout = 'layouts.admin'; // base layout

    public function index()
    {
        $DAL = new DAL_Profile();

        $profile = $DAL->GetProfile();

        if(!empty($profile))
        {
            $this->layout->content = View::make('profile.index', array(
                'title' => 'Kelola Profile',
                'detail' => '',
                'form_opts' => array(
                    'route' => array('admin.profile.update', '1'),
                    'enctype' => 'multipart/form-data',
                    'method' => 'put',
                    'class' => 'form-horizontal',
                    'id' => 'form_linked'
                ),
                'data' => $profile
            ));
        }
        else
        {
            $this->layout->content = View::make('profile.index', array(
                'title' => 'Kelola Profile',
                'detail' => '',
                'form_opts' => array(
                    'action' => 'ProfileController@save',
                    'enctype' => 'multipart/form-data',
                    'method' => 'post',
                    'class' => 'form-horizontal',
                    'id' => 'form_linked'
                )
            ));
        }
    }

    public function save()
    {
        $input = Input::all();
        $helper = new HukorHelper();
        $DAL = new DAL_Profile();

        $uploadSuccess = $helper->UploadFile('profile', $input['gambar']);

        if($uploadSuccess)
        {
            $DAL->InsertToTable($input);
        }
        else
        {
            return Redirect::route('linked')->with('error', 'Profile Gagal Disimpan.');
        }

        return Redirect::to('admin/profile')->with('success', 'Profile Berhasil Di Simpan.');
    }

    public function update()
    {
        $input = Input::all();
        $helper = new HukorHelper();
        $DAL = new DAL_Profile();

        $profile = $DAL->GetProfile();

        if($input['gambar'] == "" || empty($input['gambar']))
        {
            $input['gambar'] = $profile->gambar;
            $DAL->UpdateProfile($input);
        }
        else
        {
            $helper->DeleteFile('profile', $profile->gambar);
            $helper->UploadFile('profile', $input['gambar']);
            $DAL->UpdateProfile($input);
        }

        return Redirect::to('admin/profile')->with('success', 'Profile Berhasil Di Ubah.');
    }

    public function show()
    {
        $DAL = new DAL_Profile();

        $data = $DAL->GetProfile();

        $this->layout = View::make('layouts.master');

        $this->layout->content = View::make('profile.detail',
            array('data' => $data));
    }

}
