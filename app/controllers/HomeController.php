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
        $document = new DAL_Document();

        if ($_COOKIE['iwashere'] != "yes") {
            HukorHelper::XMLFile();
            setcookie("iwashere", "yes", time()+43200); //set cookie selama 12 jam
        }

        $dataDoc = $document->GetLastTen();

        $all = Menu::leftJoin('sub_menu', 'menu.id', '=', 'sub_menu.menu_id')
            ->leftJoin('layanan', 'sub_menu.id', '=', 'layanan.submenu_id')
            ->select(array(
                'menu.id',
                'sub_menu.id',
                'layanan.id',
                'menu.nama_menu'
            ))
            ->distinct('menu.nama_menu')
            ->groupby('menu.nama_menu');

        $menlan = Layanan::leftJoin('menu', 'layanan.menu_id', '=', 'menu.id')
            ->select(array(
                'layanan.id',
                'menu.nama_menu'
            ));


        $latest_news = DB::table('berita')
            ->orderBy('id', 'desc')
            ->get();


        $news_feed = DB::table('berita')
            ->whereNotIn('id', array(1, 2, 3, 4))->get();

        $count_news = count($latest_news);

        $this->layout->content = View::make('news.index', array(
            'latest_news' => $latest_news,
            'news_feed' => $news_feed,
            'count_news' => $count_news,
            'document' => $dataDoc,
            'allmenu' => $all,
            'menu_layanan' => $menlan,
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

//        $all = Menu::leftJoin('sub_menu', 'menu.id', '=', 'sub_menu.menu_id')
//            ->leftJoin('layanan', 'sub_menu.id', '=', 'layanan.submenu_id')
//            ->select(array(
//                'menu.id',
//                'sub_menu.id',
//                'layanan.id',
//                'menu.nama_menu'
////                'menu_id' => 'menu.id',
////                'submenu_id' => 'sub_menu.id',
////                'layanan_id' => 'layanan.id',
////                'nama_menu' => 'menu.nama_menu'
//            ))
//            ->distinct('menu.nama_menu')
//            ->groupby('menu.nama_menu')
//            ->get();

        $all = Menu::all();
        $all->toArray();

        $sub = Submenu::all();
        $sub->toArray();

        $lay = Layanan::all();
        $lay->toArray();

//            $menlan = Layanan::leftJoin('menu', 'layanan.menu_id', '=', 'menu.id')
//                ->select(array(
//                    'layanan.id',
//                    'menu.nama_menu'
//                ))
//                ->get();

        $this->layout = View::make('layouts.master', array(
            'allmenu' => $all,
            'sub' => $sub,
            'lay' => $lay,
        ));

        $this->layout->content = View::make('layouts.home',
        array(
            'allmenu' => $all,
            'menu_layanan' => $sub,
        ));

    }

}