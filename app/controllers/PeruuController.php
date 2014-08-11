<?php

class PeruuController extends BaseController
{


	private $uploadFolder = "Peraturan Perundang-Undangan";

	public function index()
	{
		$roleId = Auth::user()->role_id;
		$all = Menu::all();
		$all->toArray(); // handle dataTable request 
		if (Request::ajax())
			return Datatables::of(DAL_PerUU::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))
				->add_column("_role_id", $roleId)
				->make(true);

		if(Auth::user()->role_id == 2 || Auth::guest()) {
			$this->layout = View::make('layouts.master', array('allmenu' => $all));
			$this->layout->content = View::make('PerUU.informasi', array('role_id' => $roleId));
		} else {
			$this->layout = View::make('layouts.admin');
			$this->layout->content = View::make('PerUU.index');    
		}

	}

	public function create()
	{
		$user = Auth::user();

        $all = Menu::all();
        $all->toArray();

        $this->layout = View::make('layouts.master', array('allmenu' => $all));
		$this->layout->content = View::make('PerUU.create')
			->with('user', $user);
	}

	public function store()
	{
		$filenames = HukorHelper::MultipleUploadFile($this->uploadFolder, Input::file('per_uu.lampiran'));

		$input = Input::get('per_uu');
		$input2 = Input::get('penanggungJawab');

		$perUU = new PerUU;
		$perUU->id_pengguna = Auth::user()->pengguna->id;
		$perUU->perihal = $input['perihal'];
		$perUU->catatan = $input['catatan'];
		$perUU->lampiran = serialize($filenames);
		$perUU->tgl_usulan = new DateTime;
		$perUU->status = 0;
		if ($perUU->save()) {
			$penanggungJawab = new PenanggungJawabPerUU();
			$penanggungJawab->id_per_uu = $perUU->id;
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
            $DAL = new DAL_PerUU();

            $DAL->sendEmailToAllAdminPUU();

//			$data = array(
//					'user' => Auth::user(),
//					'perUU' => $perUU
//				     );
//			Mail::send('emails.PerUU.new', $data, function($message) {
//					// admin email (testing)
//					$message->to('trwofficial@ymail.com', 'trwofficial@ymail.com')
//					->subject('Usulan Baru Peraturan Perundang-Undangan');
//					});

			Session::flash('success', 'Data berhasil dikirim.');
			return Redirect::route('puu.index');
		} else {
			Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
			return Redirect::back();
		}
	}

	public function edit($id)
	{
		if (Request::ajax())
			return Datatables::of(DAL_PerUU::getLogUsulan($id))->make(true);

		$user = Auth::user();
		$perUU = PerUU::with('Pengguna')->find($id);

        if($user->role_id == 3){
            $this->layout = View::make('layouts.admin');
            $this->layout->content = View::make('PerUU.edit')
                ->with('perUU', $perUU);
        }else{
            $this->layout = View::make('layouts.master');
            $this->layout->content = View::make('PerUU.detail')
                ->with('perUU', $perUU);
        }

	}

	public function update($id)
	{
		$status = Input::get('status', 0);
		$catatan = Input::get('catatan', '');
        $updated = Input::get('updated_by');
		$ketLampiran = Input::get('ket_lampiran', '');
        $filenames = HukorHelper::MultipleUploadFile($this->uploadFolder, Input::file('lampiran'));

		$perUU = PerUU::find($id);

		$logPerUU = new LogPerUU();
		$logPerUU->id_per_uu = $perUU->id;
		$logPerUU->catatan = $catatan;
		$logPerUU->lampiran = serialize($filenames);
		$logPerUU->status = $perUU->status;
		$logPerUU->tgl_proses = new DateTime('now');
        $logPerUU->updated_by = $updated;

		$perUU->status = $status;
		$perUU->catatan = $catatan;


		$perUU->lampiran = serialize($filenames);

		if ($perUU->save() && $logPerUU->save()) {
			// Kirim email notifikasi ke pembuat usulan
			$data = array(
					'logPerUU' => $logPerUU,
					'perUU' => $perUU
				     );

            if(Auth::user()->role_id = 2)
            {
                $user = Pengguna::join('user', 'pengguna.user_id', '=', 'user.id')
                    ->where('user.role_id', '=', 3)->orWhere('user.role_id', '=', 6)->get(array('pengguna.email'));

                foreach($user as $dat)
                {
                    Mail::send('emails.PerUU.update', $data, function($message) use($dat) {
                        $message->to($dat->email)
                            ->subject('Perubahan Status Usulan Peraturan Perundang-Undangan');
                    });
                }
            }else{
                Mail::send('emails.PerUU.update', $data, function($message) use($perUU) {
                    $message->to($perUU->pengguna->email)
                        ->subject('Perubahan Status Usulan Peraturan Perundang-Undangan');
                });
            }

			Session::flash('success', 'Usulan berhasil diperbaharui.');
			return Redirect::route('admin.puu.index');
		} else {
			Session::flash('error', 'Usulah gagal diperbaharui.');
			return Redirect::back();
		}
	}

	public function destroy($id) {
		$perUU = PerUU::find($id);
		if (null != $perUU)
			$perUU->delete();
		echo 1;
	}

	public function download($id, $index = null) {
		if($object = PerUU::find($id)){
			$attachments = unserialize($object->lampiran);
			return HukorHelper::downloadAttachment($attachments, $index);
		}
		return App::abort(404);
	}

	public function downloadLampiranLog($id)
	{
		if($log = LogPerUU::find($id)) {
			$attachments = unserialize($log->lampiran);
			return HukorHelper::downloadAttachment($attachments);
		}
		return App::abort(404);
	}

	public function printTable() {
		$status = Input::get("status", null);
		$firstDate = Input::get("firstDate", null);
		$lastDate = Input::get("lastDate", null);
		$table = DAL_PerUU::getPrintTable($status, $firstDate, $lastDate);

		$style = array("<style>");
		$style[] = "table { border-collapse: collapse; }";
		$style[] = "table td, table th { padding: 5px; }";
		$style[] = "</style>";

		$html = array("<h1>Peraturan Perundang Undangan</h1>");
		$html[] = "<table><tr>";
		if(null != $status)
			$html[] = "<td><strong>Status</strong></td><td>: ".DAL_PerUU::getStatus($status)."</td>";
		if(null != $firstDate)
			$html[] = "<td><strong>Tgl awal</strong></td><td>: {$firstDate}</td>";
		if(null != $lastDate)
			$html[] = "<td><strong>Tgl akhir</strong></td><td>: {$lastDate}</td>";
		$html[] = "</tr></table>";
		$html[] = $table;

		$pdf = new DOMPDF();
		$pdf->load_html(join("", $style) . join("",$html));
		$pdf->render();
		$pdf->stream("peruu.pdf");
	}

}
