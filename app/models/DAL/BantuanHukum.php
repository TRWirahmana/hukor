<?php
class DAL_BantuanHukun {

    public function GetAllData($filter)
    {
        $data = BantuanHukum::select();

        $iTotalRecords = $data->count();

        if(!empty($filter['sSearch'])){
            $data->where();
        }

        $iTotalDisplayRecords = $data->count();

        $data = $data->skip($filter['iDisplayStart'])->take($filter['iDisplayLength']);

        return Response::json(array(
            "sEcho" => $filter['sEcho'],
            'aaData' => $data->get()->toArray(),
            'iTotalRecords' => $iTotalRecords,
            'iTotalDisplayRecords' => $iTotalDisplayRecords
        ));
    }
}