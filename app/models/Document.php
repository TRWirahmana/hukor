<?php

class Document extends Eloquent {

    protected $key = 'id';
    protected $table = 'dokumentasi';
    protected $guarded = array();

    public function getKategori($i){
       switch ($i) {
       	case '1':
            return 'Keputusan Mentri';
       		break;
       	case '2':
 	      return 'Peraturan Mentri';
       		break;
       	case '3':
          return 'Peraturan Bersama';
       		break;
       	case '4':
          return 'Keputusan Bersama';
       		break;
       	case '5':
          return 'Intruksi Mentri';
       		break;
       	case '6':
          return 'Surat Edaran';
       		break;
       	default:
       		return "";
       		break;
       }
    }

    public function getMasalah($i){
        switch ($i) {
        	case '1':
            return 'Kepegawaian';
        		break;
        	case '2':
            return 'Keuangan';
        		break;
        	case '3':
            return 'Organisasi';
        		break;
        	case '4':
            return 'Umum';
        		break;
        	case '5':
            return 'Perlengkapan';
        		break;
        	case '6':
            return 'Lainnya';
        		break;
        	default:
            return '';
        		break;
        }
    }

    public function getBidang($i){
        switch ($i) {
            case '1':
                return 'Pendidikan Dasar';
                break;
            case '2':
                return 'Pendidikan Menengah';
                break;
            case '3':
                return 'Pendidikan Tinggi';
                break;
            case '4':
                return 'Kebudayaan';
                break;
            case '5':
                return 'Pendidikan Anak Usia Dini, Nonformal, Informal';
                break;
            case '6':
                return 'Lainnya';
                break;
            default:
                return '';
                break;
        }
    }

}