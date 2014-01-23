<?php

class DAL_Pelembagaan  extends Eloquent {
    
    public function GetAllData($filter)
    {
        $data = Pelembagaan::select();
        
        $iTotalRecords = $data->count();
        
        if(!empty($filter['sSearch'])){
            $data->where();
        }
        
        $iTotalDisplayRecords = $data->count();
        
        $data = $data->skip($filter['iDisplayStart'])->take($filter['iDisplayLenght']);
        
        return Response::json(array(
            'sEcho' => $filter['sEcho'],
            'aaData' => $data->get()->toArray(),
            'iTotalRecords' => $iTotalRecords,
            'iTotalDisplayRecords' => $iTotalDisplayRecords
            
        ));
        
    }
}


?>


