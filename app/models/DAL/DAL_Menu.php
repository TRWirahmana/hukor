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

//    public static function getDataTable($filter) {
//        $data = Menu::leftJoin('sub_menu', 'menu.id', '=', 'sub_menu.menu_id')
//            ->select(array('id' => 'menu.id',
//                'menu' => 'menu.nama_menu',
//                'sub_menu' => 'sub_menu.nama_submenu'))
//            ->distinct('menu.nama_menu')
//            ->groupby('menu.nama_menu');
//
////        $data = Menu::select(array(
////            'nama_menu',
////            'id'
////        ));
//
//        //count all record
//        $iTotalRecords = $data->count();
//        //search specific record
//        if(!empty($filter['sSearch'])){
//            $search = $filter['sSearch'];
//            $data->where('menu.nama_menu', 'like', "%$search%");
//            ;
//        }
//
//        //count record after filtering
//        $iTotalDisplayRecords = $data->count();
//
//        $data = $data->skip($filter['iDisplayStart'])->take($filter['iDisplayLength']);
//        $data = $data->get()->toArray();
//
//        array_multisort($data);
//
//        return Response::json(array(
//            "sEcho" => $filter['sEcho'],
//            'aaData' => $data,
//            'iTotalRecords' => $iTotalRecords,
//            'iTotalDisplayRecords' => $iTotalDisplayRecords
//        ));
//    }
}