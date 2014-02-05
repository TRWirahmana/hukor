<?php

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    /* Set Layout */

    protected $layout = 'layouts.master';

    public function index() {
        //exit;
        $this->layout->content = View::make('layouts.home');

    }

    public function download_manual() {
      $manual_path = DOWNLOAD_PATH . DS . "manual_registrasi.pdf";
      if(file_exists($manual_path))
        return Response::download($manual_path);
      else
        return Redirect::to('/')->with('error', 'Kesalahan, berkas tidak ditemukan.');
    }

    public function showForum() {
      $this->layout->content = View::make('layouts.forum');
    }

    public function adminlogin() {
        //exit;
        return View::make('layouts.admin_login');

    }

}