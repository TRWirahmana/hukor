<?php
class DAL_Registrasi {
    /*
     | Fungsi Handling Registrasi User Anonymouse (dari front end page)
     * 
     */
    private $_data = array();

    public function SetData($data = array()) {
        $this->_data = $data;
    }

    public function Save() {
        if (!empty($this->_data)) {
            User::insert($this->_data);
            return DB::getPdo()->lastInsertId();
        } else {
            return 0;
        }
    }
}
