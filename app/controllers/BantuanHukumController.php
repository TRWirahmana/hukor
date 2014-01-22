<?php

class BantuanHukumController extends BaseController{

    protected $layout = 'layouts.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
//        echo "TEST";
        $this->layout->content = View::make('BantuanHukum.index');

    }
}

?>