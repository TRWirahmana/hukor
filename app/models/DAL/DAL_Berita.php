<?php
class DAL_Berita {
    private $_data = array();

    public function SetData($data = array()) {
        $this->_data = $data;
    }

    public function Save() {
        if (!empty($this->_data)) {
            Berita::insert($this->_data);
            return DB::getPdo()->lastInsertId();
        } else {
            return 0;
        }
    }

    public static function getDataTable($filter = 0) {
        $data = Berita::select(array(
                'judul',
                'penulis',
                'created_at',
                   'id'
            ));

        if(0 != $filter)
            $data = $data->where('id', '!=', 0);

        return $data;
    }
}