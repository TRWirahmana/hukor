<?php

class RetaneHelper {
    /*
     * Mengembalikan Tanggal 1-31
     * */

    public static function listDate() {
        $days = range(1, 31);
        $days = array_combine($days, $days);
        $days = array("" => "Tgl") + $days;
        return $days;
    }

    /*
     * Mengembalikan Bulan Jan-Des
     */

    public static function listMonth() {
        $months = range(1, 12);
        $months = array_combine($months, array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'));
        $months = array("" => "Bulan") + $months;
        return $months;
    }

    /*
     * Mengembalikan Daftar Tahun (interval dari TahunA s.d TahunB)
     */
    public static function listYear($from, $to) {
        $years = range($from, $to);
        $years = array_combine($years, $years);
        $years = array("" => "Tahun") + $years;
        return $years;
    }

    /*
     * Casting index bulan kedalam string nama2 bulan (indonesia)
     */

    public static function castMonthToString($month) {
        switch (intval($month)) {
            case 1 :
                return "Januari";
                break;
            case 2 :
                return "Februari";
                break;
            case 3 :
                return "Maret";
                break;
            case 4 :
                return "April";
                break;
            case 5 :
                return "Mei";
                break;
            case 6 :
                return "Juni";
                break;
            case 7 :
                return "Juli";
                break;
            case 8 :
                return "Agustus";
                break;
            case 9 :
                return "September";
                break;
            case 10 :
                return "Oktober";
                break;
            case 11 :
                return "November";
                break;
            case 12 :
                return "Desember";
                break;
        }
    }

    /*
     * Format Date to String Indonesia
     */
    public static function toStringIndonesia($date) {
        $exp = explode('-', $date);
        
        return $exp[2] .' '. RetaneHelper::castMonthToString($exp[1]) .' '. $exp[0];
    }
    
    /*
     * Generate Random String
     */
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        while($length--) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /*
     * Generate Periode String
     */
    public static function generatePeriodeString($periode)
    {
        $exp_periode = explode("-", $periode);

        $result = array();
        for ($i = 0; $i < count($exp_periode) ; $i++){
            $exp = explode('/', $exp_periode[$i]);
            $exp[0] = RetaneHelper::castMonthToString($exp[0]);

            $result[$i] = implode(' ', $exp);
        }

        return implode('-', $result);
    }
    
}