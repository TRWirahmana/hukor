<?php

class DAL_Pelembagaan {
    public static function getDataTable($filter = null, $firstDate = null, $lastDate = null) {
	   $data = Pelembagaan::join('penanggung_jawab_pelembagaan','pelembagaan.id', '=', 'penanggung_jawab_pelembagaan.pelembagaan_id')
                        ->
                        select(array(
                            'pelembagaan.id',
                            'pelembagaan.tgl_usulan',
                            'penanggung_jawab_pelembagaan.unit_kerja',
                            'pelembagaan.perihal',
                            'pelembagaan.status',
                            'pelembagaan.lampiran',
                            'pelembagaan.jenis_usulan'
                )); 
                        
        if(null != $filter)
            $data->where('pelembagaan.status', '=', $filter);
        if(null != $firstDate)
            $data->where(DB::raw("DATE(pelembagaan.tgl_usulan)"), ">=", DateTime::createFromFormat("d/m/Y", $firstDate)->format('Y-m-d'));
        if(null != $lastDate)
            $data->where(DB::raw("DATE(pelembagaan.tgl_usulan)"), "<=", DateTime::createFromFormat("d/m/Y", $lastDate)->format('Y-m-d'));

        return $data;
    }   
}


