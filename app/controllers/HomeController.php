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
        $this->layout = View::make('layouts.berita');

//        $latest_news = DB::table('berita')
//                            ->select('id', 'judul', 'berita', 'tgl_penulisan')
//                            ->orderBy('id', 'desc')
//                            ->limit(4)
//                            ->get();

        $latest_news = DB::table('berita')
            ->select('id', 'judul', 'berita', 'tgl_penulisan')
            ->orderBy('id', 'desc')
            ->get();


        $news_feed = DB::table('berita')
            ->whereNotIn('id', array(1, 2, 3, 4))->get();

        $count_news = count($latest_news);

        $this->layout->content = View::make('news.index', array(
            'latest_news' => $latest_news,
            'news_feed' => $news_feed,
            'count_news' => $count_news,
        ));

    }

    public function download_manual() {
      $manual_path = DOWNLOAD_PATH . DS . "manual_registrasi.pdf";
      if(file_exists($manual_path))
        return Response::download($manual_path);
      else
        return Redirect::to('site')->with('error', 'Kesalahan, berkas tidak ditemukan.');
    }

    public function showForum() {
      $this->layout->content = View::make('layouts.forum');
    }

    public function adminlogin() {
        //exit;
        return View::make('layouts.admin_login');

    }

    public function main_site() {
        //exit;
        $this->layout->content = View::make('layouts.home');

    }

}