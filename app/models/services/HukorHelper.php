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

	public static function RemoveUnderline($string)
	{
		$tamp = explode('_', $string);
		$result = implode(' ', $tamp);
		return $result;
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


	public static function MultipleUploadFile($dir, $inputFile)
	{
		$filenames = array();
		$uqFolder = str_random(8);
		foreach($inputFile as $file)
		{
			if(null !== $file) {
				// set destination folder
				$destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $uqFolder; 
				//get real file name
				$filename = $file->getClientOriginalName();
				//upload file
				$uploadSuccess = $file->move($destinationPath, $filename);
				if($uploadSuccess)
					$filenames[] = $dir . DIRECTORY_SEPARATOR . $uqFolder . DIRECTORY_SEPARATOR . $filename;
			}
		}

		return $filenames;
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

		if(file_exists($img_exists) && is_file($img_exists))
		{
			//delete file image di folder yang terdaftar di database
			@unlink($img_exists);
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
			array_walk($columns, function(&$c) {
					$parts = explode('.', $c);
					$lastPart = $parts[count($parts) - 1 ];
					$c = ucfirst(str_replace('_', " ", strtolower($lastPart)));
					});
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

	public function DownloadFile($dir, $file) {
		$destinationPath = UPLOAD_PATH . DIRECTORY_SEPARATOR . $dir;
		$img_exists = $destinationPath . '/' . $file;

		if(file_exists($img_exists))
			return $img_exists;
		else
			return null;
	}

	public static function GeneratePDf($data, $header)
	{
		$count = count($header);
		$headerClone = $header;
		$html =  "<h1>Judul</h1>

			<center>
			<table style='border: 1px solid black;border-collapse:collapse;'>
			<tr>";
		for($x = 0; $x < $count; $x++)
		{
			if(strpos($headerClone[$x], '_'))
			{
				$headerClone[$x] = HukorHelper::RemoveUnderline($headerClone[$x]);
			}
			$html .= "<th style='border: 1px solid black;text-align:center;'>".strtoupper($headerClone[$x])."</th>";
		}

		$html .= "</tr>";

		foreach($data as $uid){

			$html .= "<tr>";

			for($y = 0; $y < $count; $y++)
			{
				$html .= "<th style='border: 1px solid black;text-align:center;'>" . $uid[$header[$y]] . "</th>";
			}

			$html .= "</tr>";
		}
		$html .="
			</table>
			</center>";

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("A4", "landscape");
		$dompdf->render();


		// Use this to output to the broswer
		//$dompdf->stream('Registrasi.pdf',array('Attachment'=>0));

		// Use this to download the file.
		$dompdf->stream("Registrasi.pdf");
	}

	public static function castMonthToString3($month) {
		switch (intval($month)) {
			case 1 :
				return "Jan";
				break;
			case 2 :
				return "Feb";
				break;
			case 3 :
				return "Mar";
				break;
			case 4 :
				return "Apr";
				break;
			case 5 :
				return "Mei";
				break;
			case 6 :
				return "Jun";
				break;
			case 7 :
				return "Jul";
				break;
			case 8 :
				return "Agu";
				break;
			case 9 :
				return "Sep";
				break;
			case 10 :
				return "Okt";
				break;
			case 11 :
				return "Nov";
				break;
			case 12 :
				return "Des";
				break;
		}
	}

	public static function downloadAsZIP($attachments, $name = "attachment.zip")
	{
		if(!empty($attachments))
		{
			$zipFile = tempnam("tmp", "zip");
			$zip = new ZipArchive;		
			$result = $zip->open($zipFile, ZipArchive::OVERWRITE);
			if(true === $result) 
			{
				foreach($attachments as $attachment) 
				{
					$filename = UPLOAD_PATH . DS  . $attachment;
					$parts = explode(DS, $attachment);
					$localname = end($parts);
					$zip->addFile($filename, $localname);
				}	
				$zip->close();
			}
			return Response::download($zipFile, $name);
		}
		return App::abort(404);
	}

	public static function downloadAttachment($attachments, $index = null)
	{
		if(null == $index) {	
			return self::downloadAsZIP($attachments, 'lampiran.zip');	
		} else if(isset($attachments[$index])) {
			$attachment = $attachments[$index];
			$file = UPLOAD_PATH . DS . $attachment;	
			if(file_exists($file)) {
				$parts = explode(DS, $attachment);
				$filename = end($parts);
				return Response::download($file, $filename);
			}

		} else {
			return App::abort(404);
		}
	}

    public static function XMLFile()
    {
        $dom = new DOMDocument("1.0");

        if(!file_exists(XML_COUNTER . 'counter.xml'))
        {
            header("Content-Type:text/plain");

            // create root element
            $root = $dom->createElement('counter');
            $dom->appendChild($root);

            // create child element
            $count = $dom->createElement('count');
            $root->appendChild($count);

            //create text node
            $value = $dom->createTextNode(1);
            $count->appendChild($value);

            $dom->save(XML_COUNTER . 'counter.xml');
        }
        else
        {
            $dom->load(XML_COUNTER . "counter.xml");

            $root = $dom->documentElement;

            $counter = $root->getElementsByTagName('count')->item(0)->nodeValue;
            $root->getElementsByTagName('count')->item(0)->nodeValue = $counter + 1;

            $dom->save(XML_COUNTER . 'counter.xml');
        }
    }

    public static function GetCounterVisitor()
    {
        $dom = new DOMDocument("1.0");

        $dom->load(XML_COUNTER . "counter.xml");

        $root = $dom->documentElement;

        $counter = $root->getElementsByTagName('count')->item(0)->nodeValue;

        return $counter;
    }


}
