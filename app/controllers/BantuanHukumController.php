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

    public function add()
    {
        // show form with empty model
//        $this->layout->content = View::make('bpnb.form', array(
//            'bpnb' => new Bpnb,
//            'formOptions' => array(
//                'class' => 'form-horizontal',
//                'method' => 'post',
//                'route' => 'admin.bpnb.store'
//            )
//        ));

        // show form with empty model
        $this->layout->content = View::make('bantuanhukum.form');
    }

    public function save()
    {

    }

    public function datatable()
    {
        $input = Input::all();
        $DAL = new DAL_BantuanHukun();
        $data = $DAL->GetAllData($input);

        return $data;
    }
}