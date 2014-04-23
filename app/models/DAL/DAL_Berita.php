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
        $data = Berita::leftJoin("categories", "berita.id_kategori", "=", "categories.id")
            ->select(array(
                'berita.judul',
                'categories.nama_kategori',
                'berita.penulis',
                'berita.tgl_penulisan',
                'berita.id'
            ))
            ->orderBy('berita.id', 'desc');

        if(0 != $filter)
            $data = $data->where('berita.id', '!=', 0);

        return $data;
    }

    public static function search($cari) {

        $data = Berita::select('judul');

        $data->where('judul', 'like', "%$cari%");

        return $data;
    }
}