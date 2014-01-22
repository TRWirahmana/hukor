<?php

class HomeController extends BaseController {

    protected $layout = 'layouts.master';

    public function index() {
        //exit;
        $this->layout->content = View::make('layouts.master');

    }

    public function download_manual() {
        $manual_path = DOWNLOAD_PATH . DS . "manual_registrasi.pdf";
        if(file_exists($manual_path))
            return Response::download($manual_path);
        else
            return Redirect::to('/')->with('error', 'Kesalahan, berkas tidak ditemukan.');
    }

}