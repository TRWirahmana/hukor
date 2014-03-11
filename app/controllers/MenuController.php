<?php
class MenuController extends BaseController {

    public function index()
    {
        $this->layout = View::make('layouts.admin');

        if(Request::ajax())
            return Datatables::of(DAL_Menu::getDataTable(Input::get('filter', 0)))->make(true);
        $this->layout->content = View::make('menu.index');
    }

    public function create(){
        $this->layout = View::make('layouts.admin');
        $this->layout->content = View::make('menu.form', array(
            'title' => 'Tambah Menu',
            'detail' => 'Lengkapi data dibawah ini untuk menambahkan menu baru.',
            'form_opts' => array(
                'route' => 'admin.menu.store',
                'method' => 'post',
                'class' => 'form-horizontal',
                'id' => 'form_menu'
            ),
            'menu' => new Menu(),
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
//        $in_submenu = $input['submenu'];
        /* save to table user */
        $menu = new Menu();
        $menu->nama_menu = $input['menu'];

        $menu->save();

//        if($in_submenu != null){
//
//            $menu->save();
//
//            foreach ($in_submenu as $data) {
//                if(empty($data['nama_submenu'])) continue;
//
//                $data['menu_id'] = $menu->id;
//                $data['created_at'] = date("Y-m-d H:i:s");
//                $data['updated_at'] = date("Y-m-d H:i:s");
//                $menu->submenu()->save(new Submenu($data));
//            }
//
//        }else{
//            $menu->save();
//        }

        return Redirect::to('admin/menu')->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->layout = View::make('layouts.admin');
        $menu = Menu::find($id);
        $menu->load('submenu');
        if(!is_null($menu))
            $this->layout->content = View::make('menu.form', array(
                'title' => 'Ubah Menu #' . $menu->id,
                'detail' => '',
                'form_opts' => array(
                    'route' => array('admin.menu.update', $menu->id),
                    'method' => 'put',
                    'class' => 'form-horizontal'
                ),
                'menu' => $menu
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
        $menu = Menu::find($id);

        $menu->nama_menu = $input['menu'];
        $menu->save();

        return Redirect::to('admin/menu')->with('success', 'Data Menu berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $menu = Menu::find($id);
//        var_dump($user);exit;
        if(!is_null($menu)) {
            $menu->layanan->delete;
            $menu->submenu()->delete();
            $menu->delete();

        }

    }
}