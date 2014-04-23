<?php
class NewsController extends BaseController {

    public function index(){
        $this->layout = View::make('layouts.berita');

//        $latest_news = DB::table('berita')
//                            ->select('id', 'judul', 'berita', 'tgl_penulisan')
//                            ->orderBy('id', 'desc')
//                            ->limit(4)
//                            ->get();

        $latest_news = DB::table('berita')
            ->orderBy('id', 'desc')
            ->get();


        $news_feed = DB::table('berita')
            ->whereNotIn('id', array(1, 2, 3, 4))->get();

        $count_news = count($latest_news);

        $this->layout->content = View::make('news.index', array(
            'latest_news' => $latest_news,
            'news_feed' => $news_feed,
            'count_news' => $count_news
        ));
    }



    public function search(){
        $cari = Input::get('search');

        $DAL = new DAL_Berita();

        $DAL->search($cari);

        return Redirect::to('search_result')->with('success', 'Pengaturan akun berhasil disimpan.');
    }

    public function search_result(){
//        $cari = Input::get('search');
//
//        $DAL = new DAL_Berita();
//
//        $DAL->search($cari);

        $this->layout = View::make('layouts.berita');
        $this->layout->content = View::make('berita.search');
    }
}