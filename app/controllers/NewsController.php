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
            ->select('id', 'judul', 'berita', 'tgl_penulisan')
            ->orderBy('id', 'desc')
            ->get();


        $news_feed = DB::table('berita')
            ->whereNotIn('id', array(1, 2, 3, 4))->get();

        $this->layout->content = View::make('news.index', array(
            'latest_news' => $latest_news,
            'news_feed' => $news_feed,
        ));
    }
}