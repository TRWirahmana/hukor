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
			$this->layout->content = View::make('SistemDanProsedur.informasi', array('role_id' => $roleId));
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

//        echo "<pre>";
//        print_r($sistemDanProsedur->pengguna);
//        echo "</pre>";
//        exit;

        if(Auth::user()->role_id == 3){
            $this->layout = View::make('layouts.admin');
            $this->layout->content = View::make('SistemDanProsedur.edit')
                ->with('data', $sistemDanProsedur);
        }else{
            $this->layout = View::make('layouts.master');
            $this->layout->content = View::make('SistemDanProsedur.detail')
                ->with('data', $sistemDanProsedur);
        }
	}

	public function update($id)
	{
        $input = Input::all();

		$filenames = HukorHelper::MultipleUploadFile($this->uploadFolder, $input['lampiran']);

        $sp = DAL_SistemDanProsedur::update($id, $input, $filenames);

        if($sp == true)
        {
            Session::flash('success', 'Usulan berhasil diperbaharui.');

            if(Auth::user()->role_id == 3){
                return Redirect::route('admin.sp.index');
            }else{
                return Redirect::route('sp.index');
            }
        }else{
            Session::flash('error', 'Usulah gagal diperbaharui.');
            return Redirect::back();
        }

//        if($filenames != null)
//        {
//            $sp = DAL_SistemDanProsedur::update($id, $input, $filenames);
//
//            if($sp == true)
//            {
//                Session::flash('success', 'Usulan berhasil diperbaharui.');
//
//                if(Auth::user()->role_id == 3){
//                    return Redirect::route('admin.sp.index');
//                }else{
//                    return Redirect::route('sp.index');
//                }
//            }else{
//                Session::flash('error', 'Usulah gagal diperbaharui.');
//                return Redirect::back();
//            }
//        }else{
//            Session::flash('error', 'Usulah gagal diperbaharui.');
//            return Redirect::back();
//        }
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
        $input = Input::all();

		$filenames = HukorHelper::MultipleUploadFile($this->folderName, $input['sistem_dan_prosedur']['lampiran']);

        if($filenames != null)
        {
            $save = DAL_SistemDanProsedur::save($input, $filenames);

            if($save == true)
            {
                Session::flash('success', 'Data berhasil dikirim.');
                return Redirect::route('sp.index');
            }else{
                Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
                return Redirect::back();
            }
        }else{
            Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
            return Redirect::back();
        }
	}

	public function download($id, $index = null)
	{
		if($sp = SistemDanProsedur::find($id)) {
			$attachments = unserialize($sp->lampiran);
			return HukorHelper::downloadAttachment($attachments, $index);
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
