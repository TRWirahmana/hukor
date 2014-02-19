<?php

class DAL_PenanggungJawabPelembagaan {
	 public static function getDataTable($pelembagaan_id) {
	// 	return PenanggungJawabPelembagaan::where('pelembagaan_id', '=', $pelembagaan_id);
 		return DB:table('penanggung_jawab_pelembagaan')->where('pelembagaan_id', '=', $pelembagaan_id);	
	 }
}
