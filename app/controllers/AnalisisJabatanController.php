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

        $all = Menu::all();
        $all->toArray();

		if(Auth::user()->role_id == 2 || Auth::guest()) {
            $this->layout = View::make('layouts.master', array('allmenu' => $all));
			$this->layout->content = View::make('AnalisisJabatan.index_user', array('role_id' => $roleId));
		} else {
			$this->layout = View::make('layouts.admin');
			$this->layout->content = View::make('AnalisisJabatan.index_admin');    
		}

	}

	public function create() {
		$user = Auth::user();

        $all = Menu::all();
        $all->toArray();

        $this->layout = View::make('layouts.master', array('allmenu' => $all));
		$this->layout->content = View::make('AnalisisJabatan.create')
			->with('user', $user);
	}

	public function store() {
        $input = Input::all();
		$lampiran = Input::file('analisisJabatan.lampiran');

		$filenames = HukorHelper::MultipleUploadFile($this->uploadFolder, $lampiran);

        if($filenames != null)
        {
            $anjab = DAL_AnalisisJabatan::save($input, $filenames);

            if ($anjab == true) {
                Session::flash('success', 'Data berhasil dikirim.');
                return Redirect::route('aj.index');
            } else {
                Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
                return Redirect::back();
            }
        }
        else
        {
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

        $user = Auth::user()->role_id;

        if($user == 3){
            $this->layout = View::make('layouts.admin');
            $this->layout->content = View::make('AnalisisJabatan.edit')
                ->with('analisisJabatan', $analisisJabatan);
        }else{
            $this->layout = View::make('layouts.master');
            $this->layout->content = View::make('AnalisisJabatan.detail')
                ->with('analisisJabatan', $analisisJabatan);
        }
	}

	public function update($id) {

        $input = Input::all();

        $filenames = HukorHelper::MultipleUploadFile($this->uploadFolder, Input::file('lampiran'));

        if($filenames != null)
        {
            $anjab = DAL_AnalisisJabatan::update($id, $input, $filenames);

            if ($anjab == true) {
                Session::flash('success', 'Usulan berhasil diperbaharui.');
                if(Auth::user()->role_id == 2) {
                    return Redirect::route('aj.index');
                }else{
                    return Redirect::route('admin.aj.index');
                }
            } else {
                Session::flash('error', 'Usulah gagal diperbaharui.');
                return Redirect::back();
            }
        }
        else
        {
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
			$data[$index]['status'] = $analisisJabatan->status;
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
