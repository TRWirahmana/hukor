<?php
class DAL_ProdukHukum {
    public static function getDataTable($tahun = null, $kategori = null, $bidang = null )
    {
    	$data = Document::
        /*select(array(
                    'id',
                    'nomor',
                    'kategori',
                    'masalah',
                    'tgl_pengesahan',
                    'file_dokumen',
                    'deskripsi',
                    'tgl_pengesahan',
                    'status_publish',
                    'created_at',
                    'updated_at'
                ))

                ->
                */
                where('status_publish', '=', '0');

    	if(null != $tahun)
		    $data->where(DB::raw("DATE(tgl_pengesahan)"), ">=", DateTime::createFromFormat("d/m/Y", $tahun)->format('Y-m-d'));
    	if(null != $kategori)
    		$data->where('kategori', '=' , $kategori);
    	if(null != $bidang)
    		$data->where('bidang', '=', $bidang);

    	return $data;
	}
}
