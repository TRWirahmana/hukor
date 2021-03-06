<?php
class DAL_ProdukHukum {

  
    public static function getDataTable($kategori = null, $masalah = null, $tahun = null, $tahun1 = null, $bidang = null) {
       $data = Document::
                        select(array(
                            'id',
                            'nomor',
                            'kategori',
                            'masalah',
                            'bidang',
                            'tgl_pengesahan',
                            'perihal',
                            'deskripsi',
                            'file_dokumen'
                ))->where('status_publish', 1); 

        if(null != $kategori)
            $data->where('kategori', '=', $kategori);
        if(null != $masalah)
            $data->where('masalah', '=', $masalah);
        if(null != $bidang)
            $data->where('bidang', '=', $bidang);
        if(null != $tahun)
            $data->where(DB::raw("YEAR(tgl_pengesahan)"), "=", DateTime::createFromFormat("Y", $tahun)->format('Y'));

        return $data;
    }   


}
