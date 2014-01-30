<?php
class DAL_LayananKetatalaksanaan {
	private $_data = array();

	public function SetData($data = array()) {
		$this->_data = $data;
	}

	public function Save() {
		if (!empty($this->_data)){
			LayananKetatalaksanaan::insert($this->_data);
			return DB::getPdo()->lastInsertId();
        } else {
            return 0;
        }
    }


    public function update($input = array(), $ketatalaksanaan, $filename){
    	$ketatalaksanaan->judul_berita = $input['judul_berita'];
		$ketatalaksanaan->penanggung_jawab = $input['penanggung_jawab'];
		$ketatalaksanaan->image = $filename;
//		$ketatalaksanaan->created_at = date('Y-m-d H:i:s');
		$ketatalaksanaan->updated_at = date('Y-m-d H:i:s');
		return $ketatalaksanaan->update();
    }

	

}

