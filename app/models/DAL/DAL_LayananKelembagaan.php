<?php
class DAL_LayananKelembagaan {
    private $_data = array();

    public function SetData($data = array()) {
        $this->_data = $data;
    }

    public function Save() {
        if (!empty($this->_data)) {
            LayananKelembagaan::insert($this->_data);
            return DB::getPdo()->lastInsertId();
        } else {
            return 0;
        }
    }
}