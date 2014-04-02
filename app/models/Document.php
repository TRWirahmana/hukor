<?php

class Document extends Eloquent {

    protected $key = 'id';
    protected $table = 'dokumentasi';
    protected $guarded = array();

    public function getKategori($i){
       switch ($i) {
           case '1' :
               return 'Undang-undang Dasar';
               break;
           case '2' :
               return 'Peraturan Pemerintah';
               break;
           case '3' :
               return 'Peraturan Presiden';
               break;
           case '4' :
               return 'Keputusan Presiden';
               break;
           case '5' :
               return 'Instruksi Presiden';
               break;
           case '6' :
               return 'Peraturan Menteri';
               break;
           case '7' :
               return 'Keputusan Menteri';
               break;
           case '8' :
               return 'Instruksi Menteri';
               break;
           case '9' :
               return 'Surat Edaran Menteri';
               break;
           case '10' :
               return 'Nota Kesepakatan';
               break;
           case '11' :
               return 'Nota Kesepahaman';
               break;
           case '12' :
               return 'Peraturan Bersama';
               break;
           case '13' :
               return 'Keputusan Bersama';
               break;
           case '14' :
               return 'Surat Edaran Bersama';
               break;
           case '15' :
               return 'Peraturan Lain';
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