<?php

class AnalisisJabatanController extends BaseController {

	private $uploadFolder = "Analisis Jabatan";

	public function index() {
		// handle dataTable request
		$roleId = Auth::user()->role_id;
		if (Request::ajax())
			return Datatables::of(DAL_AnalisisJabatan::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))
				->add_column("_role_id", $roleId)
				->make(true);

		if(Auth::user()->role_id == 2 || Auth::guest()) {
			$this->layout = View::make('layouts.master');
			$this->layout->content = View::make('AnalisisJabatan.index_user');    
		} else {
			$this->layout = View::make('layouts.admin');
			$this->layout->content = View::make('AnalisisJabatan.index_admin');    
		}

	}

	public function create() {
		$user = Auth::user();
		$this->layout = View::make('layouts.master');
		$this->layout->content = View::make('AnalisisJabatan.create')
			->with('user', $user);
	}

	public function store() {
		$input = Input::get('analisisJabatan');
		$input2 = Input::get('penanggungJawab');

		$lampiran = Input::file('analisisJabatan.lampiran');
		$filenames = HukorHelper::MultipleUploadFile($this->uploadFolder, $lampiran);

		$analisisJabatan = new AnalisisJabatan;
		$analisisJabatan->id_pengguna = Auth::user()->pengguna->id;
		$analisisJabatan->perihal = $input['perihal'];
		$analisisJabatan->catatan = $input['catatan'];
		$analisisJabatan->lampiran = serialize($filenames);
		$analisisJabatan->tgl_usulan = new DateTime;
		$analisisJabatan->status = 0;
		if ($analisisJabatan->save()) {
			$penanggungJawab = new PenanggungJawabAnalisisJabatan();
			$penanggungJawab->id_analisis_jabatan = $analisisJabatan->id;
			$penanggungJawab->nama = $input2['nama'];
			$penanggungJawab->jabatan = $input2['jabatan'];
			$penanggungJawab->NIP = $input2['nip'];
			$penanggungJawab->no_handphone = $input2['no_handphone'];
			$penanggungJawab->unit_kerja = $input2['unit_kerja'];
			$penanggungJawab->alamat_kantor = $input2['alamat_kantor'];
			$penanggungJawab->telepon_kantor = $input2['telp_kantor'];
			$penanggungJawab->email = $input2['email'];
			$penanggungJawab->save();

			// kirim email ke admin
			$data = array(
					'user' => Auth::user(),
					'data' => $analisisJabatan
				     );
			Mail::send('AnalisisJabatan.emailUsulan', $data, function($message) {
					// admin email (testing)
					$message->to('egisolehhasdi@gmail.com', 'egisolehhasdi@gmail.com')
					->subject('Usulan Baru Analisis Jabatan');
					});

			Session::flash('success', 'Data berhasil dikirim.');
			return Redirect::to('site');
		} else {
			Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
			return Redirect::back();
		}
	}

	public function destroy($id) {
		$analisisJabatan = AnalisisJabatan::find($id);
		if (null != $analisisJabatan)
			$analisisJabatan->delete();
		echo 1;
	}

	public function edit($id) {
		if (Request::ajax())
			return Datatables::of(DAL_AnalisisJabatan::getLogUsulan($id))->make(true);

		$analisisJabatan = AnalisisJabatan::with('Pengguna')->find($id);
		$this->layout = View::make('layouts.admin');
		$this->layout->content = View::make('AnalisisJabatan.edit')
			->with('analisisJabatan', $analisisJabatan);
	}

	public function update($id) {
		$status = Input::get('status', 0);
		$catatan = Input::get('catatan', '');
		$ketLampiran = Input::get('ket_lampiran', '');
		$lampiran = Input::file('lampiran');

		$analisisJabatan = AnalisisJabatan::find($id);

		$logAnalisisJabatan = new LogAnalisisJabatan();
		$logAnalisisJabatan->id_analisis_jabatan = $analisisJabatan->id;
		$logAnalisisJabatan->catatan = $analisisJabatan->catatan;
		$logAnalisisJabatan->lampiran = $analisisJabatan->lampiran;
		$logAnalisisJabatan->status = $analisisJabatan->status;
		$logAnalisisJabatan->tgl_proses = new DateTime('now');

		$analisisJabatan->status = $status;
		$analisisJabatan->catatan = $catatan;

		$filenames = HukorHelper::MultipleUploadFile($this->uploadFolder, $lampiran);
		$analisisJabatan->lampiran = serialize($filenames);

		if ($analisisJabatan->save() && $logAnalisisJabatan->save()) {
			// Kirim email notifikasi ke pembuat usulan
			$data = array(
					'log' => $logAnalisisJabatan,
					'data' => $analisisJabatan
				     );

			Mail::send('AnalisisJabatan.emailUpdate', $data, function($message) use($analisisJabatan) {
					$message->to($analisisJabatan->pengguna->email)
					->subject('Perubahan Status Usulan Analisis Jabatan');
					});
			Session::flash('success', 'Usulan berhasil diperbaharui.');
			return Redirect::route('admin.aj.index');
		} else {
			Session::flash('error', 'Usulah gagal diperbaharui.');
			return Redirect::back();
		}
	}

	public function download($id, $index = null) {
		if($aj = AnalisisJabatan::find($id)) {
			$attachments = unserialize($aj->lampiran);
			return HukorHelper::downloadAttachment($attachments, $index);
		}
		return App::abort(404);
	}

	public function downloadLampiranLog($id) {
		if($log = LogAnalisisJabatan::find($id)) {
			$attachments = unserialize($log->lampiran);
			return HukorHelper::downloadAttachment($attachments);
		}
		return App::abort(404);
	}

	public function informasi() {
		// handle dataTable request
		if (Request::ajax())
			return Datatables::of(DAL_AnalisisJabatan::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))->make(true);

		$this->layout = View::make('layouts.master');
		$this->layout->content = View::make('AnalisisJabatan.informasi');
	}

	public function printTable() {
		$status = Input::get("status", null);
		$firstDate = Input::get("firstDate", null);
		$lastDate = Input::get("lastDate", null);

		$dataAnalisisJabatan = DAL_AnalisisJabatan::getDataTable($status, $firstDate, $lastDate);
		$data = array();
		foreach ($dataAnalisisJabatan->get() as $index => $analisisJabatan) {
			$tglUsulan = new DateTime($analisisJabatan->tgl_usulan);
			$data[$index]['ID'] = $analisisJabatan->id;
			$data[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
			$data[$index]['Unit Kerja'] = $analisisJabatan->unit_kerja;
			$data[$index]['Perihal'] = $analisisJabatan->perihal;
			$data[$index]['status'] = $perUU->status;
			$url = URL::route('aj.download', array('id' => $analisisJabatan->id));
			$data[$index]['lampiran'] = "<a href='{$url}'>Unduh</a>";

		}


		$table = HukorHelper::generateHtmlTable($data);

		$style = array("<style>");
		$style[] = "table { border-collapse: collapse; }";
		$style[] = "table td, table th { padding: 5px; }";
		$style[] = "</style>";

		$html = array("<h1>Analisis Jabatan</h1>");
		$html[] = "<table><tr>";
		if (null != $status)
			$html[] = "<td><strong>Status</strong></td><td>: " . $status . "</td>";
		if (null != $firstDate)
			$html[] = "<td><strong>Tgl awal</strong></td><td>: {$firstDate}</td>";
		if (null != $lastDate)
			$html[] = "<td><strong>Tgl akhir</strong></td><td>: {$lastDate}</td>";
		$html[] = "</tr></table>";
		$html[] = $table;

		$pdf = new DOMPDF();
		$pdf->load_html(join("", $style) . join("", $html));
		$pdf->render();
		$pdf->stream("analisis_jabatan.pdf");
	}

}
