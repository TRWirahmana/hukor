<?php

class DownloadHelper{

	public static function FilterPDF($inputfilter){

        //variabel input filter digunakan sebagai paramater untuk melakukan filter

  //       $data = Registrasi::where('id', '!=', null)
  //                           ->where('role_id', '=', 2);

  //       if($inputfilter['thn_pendaftaran'] != "" && $inputfilter['thn_pendaftaran'] != null) {
		// 	$data = $data->where('thn_pendaftaran', '=', $inputfilter['thn_pendaftaran']);
		// }
		
		// if($inputfilter['verifikasi'] != "" && $inputfilter != null){
		// 	$data = $data->where('status', '=', $inputfilter['verifikasi']);
		// }

		// if($inputfilter['provinsi'] != "" && $inputfilter['provinsi'] != null) {
		// 			$data = $data->where("provinsi_id", '=', $inputfilter['provinsi']);
		// }

		// $result = $data->get();

		// return $result;
	}

	public function HTML_PDF($data)
   	 {
		
		// YOU NEED THIS FILE BEFORE YOU CAN RUN DOMPDF <-- im sure someone has a better way of referencing it for Laravel?
		require_once(base_path() . "/vendor/dompdf/dompdf_config.inc.php");
        
        // You can use raw HTML or a blade template, i made a pdf folder within *views* for my templates.
        //create HTML result for PDF Document
		$html =  "<h1>Judul</h1>
		
		<center>
			<table style='border: 1px solid black;border-collapse:collapse;'>
				<tr>
					<th style='border: 1px solid black;text-align:center;'>
						Nama Lengkap
					</th>
					<th style='border: 1px solid black;text-align:center;'>
						Alamat
					</th>
					<th style='border: 1px solid black;text-align:center;'>
						Tempat Lahir
					</th>
					<th style='border: 1px solid black;text-align:center;'>
						Tanggal Lahir
					</th>
					<th style='border: 1px solid black;text-align:center;'>
						Provinsi
					</th>
				</tr>";
				foreach($data as $uid){

				$html .= "
				<tr>
					<td style='border: 1px solid black;text-align:center;font-size:12px;'>
						".$uid->nama_lengkap."
					</td>
					<td style='border: 1px solid black;text-align:center;font-size:12px;'>
						".$uid->alamat."
					</td>
					<td style='border: 1px solid black;text-align:center;font-size:12px;'>
						".$uid->tempat_lahir."
					</td>
					<td style='border: 1px solid black;text-align:center;font-size:12px;'>
						".RetaneHelper::toStringIndonesia($uid->tanggal_lahir)."
					</td>
					<td style='border: 1px solid black;text-align:center;font-size:12px;'>
						".Provinsi::where('id', '=', $uid->provinsi_id)->first()->nama."
					</td>
				</tr>";
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

    public function Excel($data){

        //variabel $data digunakan sebagai kiriman yang mendefinisikan data dari user yang akan di export ke template excel
        require_once(base_path() . "/vendor/PHPExcel/PHPExcel.php");

        $objPHPExcel = new PHPExcel();

        $style = new PHPExcel_Style();
        $text = new PHPExcel_RichText();

        $style = array(
            'font' => array(
                'name' => 'Arial',

            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN))
        );

        $header = array(
            'font' => array(
                'name' => 'Arial',
                'size' => '15px'
            ),
        );


        //Styling Bold pada font
        $objPHPExcel->getActiveSheet()
            ->getStyle("A2:E2")
            ->getFont()
            ->setBold(true)
            ->applyFromArray($style);

        $objPHPExcel->getActiveSheet()
            ->getStyle("A1:E1")
            ->getFont()
            ->setBold(true)
            ->applyFromArray($style);

        //Styling agar text berada di tengah(Center)
        $objPHPExcel->getActiveSheet()
            ->getStyle("A2:E2")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->applyFromArray($style);

        $objPHPExcel->getActiveSheet()
            ->getStyle("A1:E1")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->applyFromArray($header);

        $objPHPExcel->getActiveSheet()
            ->getStyle("A2:E2")
            ->applyFromArray($style);

        //Setting Width untuk masing-masing kolom agar autosize
        for($alphabet = "A"; $alphabet <= "E"; $alphabet++){
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($alphabet)
                ->setAutoSize(true);
        }

        //Set Judul
        $objPHPExcel->getActiveSheet()->mergeCells("A1:E1")->setCellValue("A1", "JUDUL EXCEL");

        $objPHPExcel->getActiveSheet()->setTitle('Data');

        $objPHPExcel->getActiveSheet()->setCellValue("A2", "Field Row Excel");

        $x = 3;
        foreach($data as $usr){
            $objPHPExcel->getActiveSheet()
                ->getStyle("A".$x.":L".$x."")
                ->applyFromArray($style);


            //dinamisasi untuk menampilkan data ke cell excel
            $objPHPExcel->getActiveSheet()->setCellValue("A1", "dinamis" /*.$x, $usr->nama_lengkap*/);
            $x++;


        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Registrasi.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');

    }

    public function download_profile(){

        // YOU NEED THIS FILE BEFORE YOU CAN RUN DOMPDF <-- im sure someone has a better way of referencing it for Laravel?
        require_once(base_path() . "/vendor/dompdf/dompdf_config.inc.php");

        // You can use raw HTML or a blade template, i made a pdf folder within *views* for my templates.

        $html =  "<h1>SCRIPT HTML UNTUK TEMPLATE</h1>
			";


        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper("A4", "portrait");
        $dompdf->render();

        // Use this to output to the broswer
        // $dompdf->stream('Formulir_pendaftaran.pdf',array('Attachment'=>0));

        // Use this to download the file.
        $dompdf->stream("Formulir_pendaftaran.pdf");

        return Redirect::to('edit')->with('success', 'Template berhasil didownload.');

    }

}
?>