<?php
class DAL_Bagian {
    private $_data = array();

    public function subbagian($bagian_id){

//        $data = Submenu::where('menu_id', '=', $menu_id);

        $data = Subbagian::select('id', 'nama_sub_bagian')
            ->where('id_bagian', '=', $bagian_id);

        return $data;
    }
}
