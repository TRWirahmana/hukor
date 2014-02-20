<?php

class UserController extends BaseController {

    protected $layout = 'layouts.master';

    public function index() {
        //exit;
        $this->layout->content = View::make('BantuanHukum.index');

    }

    public function download_manual() {
        $manual_path = DOWNLOAD_PATH . DS . "manual_registrasi.pdf";
        if(file_exists($manual_path))
            return Response::download($manual_path);
        else
            return Redirect::to('site')->with('error', 'Kesalahan, berkas tidak ditemukan.');
    }

}