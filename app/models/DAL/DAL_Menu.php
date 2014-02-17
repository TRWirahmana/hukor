<?php
class DAL_Menu {

    public static function getDataTable($filter = 0) {
        $data = Menu::leftJoin('sub_menu', 'menu.id', '=', 'sub_menu.menu_id')
            ->select(array('id' => 'menu.id',
               'menu' => 'menu.nama_menu',
               'sub_menu' => 'sub_menu.nama_submenu'))
            ->distinct('menu.nama_menu')
            ->groupby('menu.nama_menu');

//        $data = Menu::select(array(
//            'nama_menu',
//            'id'
//        ));

        if(0 != $filter)
            $data = $data->where('menu.id', '!=', 0);

        return $data;
    }
}