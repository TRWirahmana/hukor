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

    public function update($input = array(), $kelem, $filename){

        $kelem->judul_berita = $input['judul_berita'];
        $kelem->berita = $input['berita'];
        $kelem->penanggung_jawab = $input['penanggung_jawab'];
        $kelem->image = $filename;
        $kelem->created_at = date('Y-m-d H:i:s');
        $kelem->updated_at = date('Y-m-d H:i:s');

        return $kelem->save();

    }
}