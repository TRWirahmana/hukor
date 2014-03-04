<?php


class SistemDanProsedurController extends BaseController {

	private $folderName = "Sistem dan Prosedur";

	public function index() 
	{
		$roleId = Auth::user()->role_id;
        $all = Menu::all();
        $all->toArray();

		if (Request::ajax())
			return Datatables::of(DAL_SistemDanProsedur::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))
				->add_column("_role_id", $roleId)
				->make(true);

		if(Auth::user()->role_id == 2 || Auth::guest()) {
            $this->layout = View::make('layouts.master', array('allmenu' => $all));
			$this->layout->content = View::make('SistemDanProsedur.informasi');
		} else {
			$this->layout = View::make('layouts.admin');
			$this->layout->content = View::make('SistemDanProsedur.index');
		}
	}

	public function destroy($id)
	{
		$sistemDanProsedur = SistemDanProsedur::find($id);
		if (null != $sistemDanProsedur)
			$sistemDanProsedur->delete();
		echo 1;
	}

	public function edit($id)
	{
		if (Request::ajax())
			return Datatables::of(DAL_SistemDanProsedur::getLogUsulan($id))->make(true);

		$sistemDanProsedur = SistemDanProsedur::with('Pengguna')->find($id);
		$this->layout = View::make('layouts.admin');
		$this->layout->content = View::make('SistemDanProsedur.edit')
			->with('data', $sistemDanProsedur);
	}

	public function update($id)
	{
		$sistemDanProsedur = SistemDanProsedur::find($id);

		$status = Input::get('status', 0);
		$catatan = Input::get('catatan', '');
		$ketLampiran = Input::get('ket_lampiran', '');
		$lampiran = Input::file('lampiran');

		$filenames = HukorHelper::MultipleUploadFile($this->uploadFolder, $lampiran);


		$log = new LogSistemDanProsedur();
		$log->id_sistem_dan_prosedur = $sistemDanProsedur->id;
		$log->catatan = $sistemDanProsedur->catatan;
		$log->lampiran = $sistemDanProsedur->lampiran;
		$log->status = $sistemDanProsedur->status;
		$log->tgl_proses = new DateTime('now');

		$sistemDanProsedur->status = $status;
		$sistemDanProsedur->catatan = $catatan;
		$sistemDanProsedur->lampiran = serialize($filenames);

		if ($sistemDanProsedur->save() && $log->save()) {
			// Kirim email notifikasi ke pembuat usulan
			$data = array(
					'log' => $log,
					'data' => $sistemDanProsedur
				     );

			Mail::send('emails.SistemDanProsedur.update', $data, function($message) use($sistemDanProsedur) {
					$message->to($sistemDanProsedur->pengguna->email)
					->subject('Perubahan Status Usulan');
					});

			Session::flash('success', 'Usulan berhasil diperbaharui.');
			return Redirect::route('admin.sp.index');
		} else {
			Session::flash('error', 'Usulah gagal diperbaharui.');
			return Redirect::back();
		}
	}


	public function create() {
		$user = Auth::user();
        $all = Menu::all();
        $all->toArray();
        $this->layout = View::make('layouts.master', array('allmenu' => $all));
		$this->layout->content = View::make("SistemDanProsedur.create")
			->with('user', $user);
	}

	public function store() {
		$input = Input::get('sistem_dan_prosedur');
		$input2 = Input::get('penanggungJawab');

		$files = Input::file('sistem_dan_prosedur.lampiran');
		$filenames = HukorHelper::MultipleUploadFile($this->folderName, $files);

		$sistemDanProsedur = new SistemDanProsedur;
		$sistemDanProsedur->id_pengguna = Auth::user()->pengguna->id;
		$sistemDanProsedur->perihal = $input['perihal'];
		$sistemDanProsedur->catatan = $input['catatan'];
		$sistemDanProsedur->lampiran = serialize($filenames);
		$sistemDanProsedur->tgl_usulan = new DateTime;
		$sistemDanProsedur->status = 0;
		if ($sistemDanProsedur->save()) {
			$penanggungJawab = new PenanggungJawabSistemDanProsedur();
			$penanggungJawab->id_sistem_dan_prosedur = $sistemDanProsedur->id;
			$penanggungJawab->nama = $input2['nama'];
			$penanggungJawab->no_handphone = $input2['no_handphone'];
			$penanggungJawab->jabatan = $input2['jabatan'];
			$penanggungJawab->NIP = $input2['nip'];
			$penanggungJawab->unit_kerja = $input2['unit_kerja'];
			$penanggungJawab->alamat_kantor = $input2['alamat_kantor'];
			$penanggungJawab->telepon_kantor = $input2['telp_kantor'];
			$penanggungJawab->email = $input2['email'];
			$penanggungJawab->save();

			// kirim email ke admin
			$data = array(
					'user' => Auth::user(),
					'data' => $sistemDanProsedur
				     );
			Mail::send('emails.SistemDanProsedur.new', $data, function($message) {
					// admin email (testing)
					$message->to('egisolehhasdi@gmail.com', 'egisolehhasdi@gmail.com')
					->subject('Usulan Baru Sistem dan Prosedur');
					});

			Session::flash('success', 'Data berhasil dikirim.');
			return Redirect::to('site');
		} else {
			Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
			return Redirect::back();
		}
	}

	public function download($id, $index = null)
	{
		if($sp = SistemDanProsedur::find($id)) {
			$attachments = unserialize($sp->lampiran);
			return	HukorHelper::downloadAttachment($attachments, $index);	
		} else 
			return App::abort(404);
	}

	public function downloadLogLampiran($id)
	{
		if($log = LogSistemDanProsedur::find($id))
		{
			$attachments = unserialize($log->lampiran);
			return HukorHelper::downloadAttachment($attachments);		
		}
		return App::abort(404);
	}

	public function printTable() {
		$status = Input::get("status", null);
		$firstDate = Input::get("firstDate", null);
		$lastDate = Input::get("lastDate", null);

		$sistemDanProsedur = DAL_SistemDanProsedur::getDataTable($status, $firstDate, $lastDate);
		$data = array();
		foreach($sistemDanProsedur->get() as $index => $sistemDanProsedur) {
			$tglUsulan = new DateTime($sistemDanProsedur->tgl_usulan);
			$data[$index]['ID'] = $sistemDanProsedur->id;
			$data[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
			$data[$index]['Unit Kerja'] = $sistemDanProsedur->unit_kerja;
			$data[$index]['Perihal'] = $sistemDanProsedur->perihal;
			$data[$index]['status'] = $this->getStatus($sistemDanProsedur->status);
			$url = URL::route('sp.download', array('id' => $sistemDanProsedur->id));
			$data[$index]['lampiran'] = "<a href='{$url}'>Unduh</a>";
		}

		$table = HukorHelper::generateHtmlTable($data);

		$style = array("<style>");
		$style[] = "table { border-collapse: collapse; }";
		$style[] = "table td, table th { padding: 5px; }";
		$style[] = "</style>";

		$html = array("<h1>Sistem Dan Prosedur</h1>");
		$html[] = "<table><tr>";
		if(null != $status)
			$html[] = "<td><strong>Status</strong></td><td>: ".$this->getStatus($status)."</td>";
		if(null != $firstDate)
			$html[] = "<td><strong>Tgl awal</strong></td><td>: {$firstDate}</td>";
		if(null != $lastDate)
			$html[] = "<td><strong>Tgl akhir</strong></td><td>: {$lastDate}</td>";
		$html[] = "</tr></table>";
		$html[] = $table;

		$pdf = new DOMPDF();
		$pdf->load_html(join("", $style) . join("",$html));
		$pdf->render();
		return $pdf->stream("SistemDanProsedur.pdf");
	}



	private function getStatus($status) {
		switch ($status) {
			case 1:
				return "Diproses";
				break;
			case 2:
				return "Ditunda";
				break;
			case 3:
				return "Ditolak";
				break;
			case 4:
				return "Buat Salinan";
				break;
			case 5:
				return "Penetapan";
				break;
			default:
				return "";
				break;
		}
	}
}
