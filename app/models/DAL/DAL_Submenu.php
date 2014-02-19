<?php
class DAL_Submenu {

    public static function getDataTable($filter = 0) {
        $data = Submenu::leftJoin('menu', 'sub_menu.menu_id', '=', 'menu.id')
            ->select(array('id' => 'sub_menu.id',
                'menu' => 'menu.nama_menu',
                'sub_menu' => 'sub_menu.nama_submenu'));

//        $data = Menu::select(array(
//            'nama_menu',
//            'id'
//        ));

        if(0 != $filter)
            $data = $data->where('menu.id', '!=', 0);

        return $data;
    }
}