<?php

class HukorHelper {
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
        
        return $exp[2] .' '. HukorHelper::castMonthToString($exp[1]) .' '. $exp[0];
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
            $exp[0] = HukorHelper::castMonthToString($exp[0]);

            $result[$i] = implode(' ', $exp);
        }

        return implode('-', $result);
    }

    /*
     * Upload File
     * $dir adalah untuk nama direktori
     * $inputFile adalah element input file
     */
    public static function UploadFile($dir, $inputFile)
    {
        // set destination folder
        $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $dir;

        //get real file name
        $filename = $inputFile->getClientOriginalName();

        //upload file
        $uploadSuccess = $inputFile->move($destinationPath, $filename);

        return $uploadSuccess;
    }

    /*
     * Upload File
     * $dir adalah untuk nama direktori
     * $file adalah file yang akan di hapus
     */
    public static function DeleteFile($dir, $file)
    {
        // get derectory of file
        $destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $dir;
        $img_exists = $destinationPath . '/' . $file;

        if(file_exists($img_exists))
        {
            //delete file image di folder yang terdaftar di database
            unlink($img_exists);
        }
    }

    /**
    * Generate array/query builder object to html table string.
    * @author egisolehhasdi <egi.hasdi@sangkuriang.co.id>
    * @param mixed @args Either an Array or Laravel Builder object
    * @return String
    */
    public static function generateHtmlTable($args) {
        $columns = array();
        $rows = array();
        $html = array();

        if($args instanceof Illuminate\Database\Eloquent\Builder) {
            $columns = $args->getQuery()->columns;
            $rows = $args->get()->toArray();
        } elseif(is_array($args)) {
            $result = array();
            foreach($args as $sub)
                $result = array_merge($result, $sub);
            $columns = array_keys($result);
            $rows = $args;
        } else { // the argument neither a Query Builder or an array
            return null;
        }

        $html[] = "<table border='1'><thead><tr>";
        foreach($columns as $col)
            $html[] = "<th>" . $col . "</th>";
        $html[] = "</tr></thead><tbody>";
        foreach($rows as $row) {
            $html[] = "<tr>";
            foreach($row as $data)
                $html[] = "<td>" . $data . "</td>";
            $html[] = "</tr>";
        }
        $html[] = "</tbody></table>";

        return join("", $html);
    }
    
}