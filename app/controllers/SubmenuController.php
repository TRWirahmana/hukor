<?php
class SubmenuController extends BaseController {

    public function index()
    {
        $this->layout = View::make('layouts.admin');

        if(Request::ajax())
            return Datatables::of(DAL_Submenu::getDataTable(Input::get('filter', 0)))->make(true);
        $this->layout->content = View::make('submenu.index');
    }

    public function create(){
        $listMenu = array("" => "-- Pilih Menu --") + Menu::lists('nama_menu', 'id');

        $this->layout = View::make('layouts.admin');
        $this->layout->content = View::make('submenu.form', array(
            'title' => 'Tambah Submenu',
            'detail' => 'Lengkapi data dibawah ini untuk menambahkan submenu baru.',
            'form_opts' => array(
                'route' => 'admin.submenu.store',
                'method' => 'post',
                'class' => 'form-horizontal',
                'id' => 'form_menu'
            ),
            'submenu' => new Submenu(),
            'listmenu' => $listMenu,

        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $input = Input::all();
        $menus = $input['menu'];
        /* save to table user */
//        $submenu = new Submenu();
//        $submenu->nama_submenu = $input['submenu'];


//        $submenu->save();

        if($menus != null){
//            $menu = new Menu();
//            $menu->nama_menu = $menus;
//
//            $menu->save();

            $submenu = new Submenu();
            $submenu->menu_id = $menus;
            $submenu->nama_submenu = $input['submenu'];
            $submenu->save();

        }else{
            $submenu = new Submenu();
            $submenu->nama_submenu = $input['submenu'];
            $submenu->save();
        }

        return Redirect::to('admin/index_submenu')->with('success', 'Submenu berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
//        var_dump($id);exit;
        $listMenu = array("" => "-- Pilih Menu --") + Menu::lists('nama_menu', 'id');
        $this->layout = View::make('layouts.admin');

        $submenu = Submenu::find($id);

        $menu = Submenu::join('menu', 'sub_menu.menu_id', '=', 'menu.id')
        ->where('sub_menu.id', '=', intval($id))->get();

        if(!is_null($submenu))
            $this->layout->content = View::make('submenu.form', array(
                'title' => 'Ubah Menu #' . $submenu->id,
                'detail' => '',
                'form_opts' => array(
                    'route' => array('admin.submenu.update', $submenu->id),
                    'method' => 'put',
                    'class' => 'form-horizontal'
                ),
                'submenu' => $submenu,
                'menu' => $menu,
                'listmenu' => $listMenu,
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();
        $menu = $input['menu'];
        $submenu = Submenu::find($id);

        $submenu->menu_id = $menu;
        $submenu->nama_submenu = $input['submenu'];

        $submenu->save();



        return Redirect::to('admin/index_submenu')->with('success', 'Data Submenu berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $submenu = Submenu::find($id);
//        var_dump($user);exit;
        if(!is_null($submenu)) {
            $submenu->delete();
            $submenu->layanan()->delete();

        }

    }
}