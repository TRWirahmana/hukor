<?php

class DAL_Layanan {
    private $_data = array();

    public function SetData($data = array()) {
        $this->_data = $data;
    }

    public function Save() {
        if (!empty($this->_data)) {
            Layanan::insert($this->_data);
            return DB::getPdo()->lastInsertId();
        } else {
            return 0;
        }
    }

    public function update($input = array(), $kelem, $filename){

        $kelem->berita = $input['berita'];
        $kelem->penanggung_jawab = $input['penanggung_jawab'];
        $kelem->image = $filename;
        $kelem->created_at = date('Y-m-d H:i:s');
        $kelem->updated_at = date('Y-m-d H:i:s');

        return $kelem->save();

    }

    public function submenu($menu_id){

//        $data = Submenu::where('menu_id', '=', $menu_id);

        $data = Submenu::select('id', 'nama_submenu')
            ->where('menu_id', '=', $menu_id);

        return $data;
    }

    public static function getDataTable($filter = 0) {
//        $data = Layanan::select(array(
//            'judul',
//            'penulis',
//            'created_at',
//            'id'
//        ));

        $data = Layanan::leftJoin('sub_menu', 'layanan.submenu_id', '=', 'sub_menu.id')
        ->leftJoin('menu', 'layanan.menu_id', '=', 'menu.id')
            ->select(array(
                'layanan.id',
                'menu.nama_menu'
            ,'sub_menu.nama_submenu'
            ))
        ->where('layanan.id', '!=', 1)
        ->where('layanan.id', '!=', 2)
        ->where('layanan.id', '!=', 3)
        ->where('layanan.id', '!=', 4)
        ->where('layanan.id', '!=', 5);

        if(0 != $filter)
            $data = $data->where('layanan.id', '!=', 0);

        return $data;
    }

}
