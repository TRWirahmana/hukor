<?php

class PeruuController extends BaseController
{

    public function index()
    {
        $roleId = Auth::user()->role_id;
        // handle dataTable request
        if (Request::ajax())
            return Datatables::of(DAL_PerUU::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))
                ->add_column("_role_id", $roleId)
                ->make(true);

        if(Auth::user()->role_id == 2 || Auth::guest()) {
            $this->layout = View::make('layouts.master');
            $this->layout->content = View::make('PerUU.informasi');    
        } else {
            $this->layout = View::make('layouts.admin');
            $this->layout->content = View::make('PerUU.index');    
        }
        
    }

    public function create()
    {
        $user = Auth::user();
        $this->layout = View::make('layouts.master');
        $this->layout->content = View::make('PerUU.create')
                ->with('user', $user);
    }

    public function store()
    {
        $input = Input::get('per_uu');
        $img = Input::file('per_uu.lampiran');
        $input2 = Input::get('penanggungJawab');

        if ($img->isValid()) {
            $uqFolder = str_random(8);
            $destinationPath = UPLOAD_PATH . '/' . $uqFolder;
            $filename = $img->getClientOriginalName();
            $uploadSuccess = $img->move($destinationPath, $filename);

            if ($uploadSuccess) {
                $perUU = new PerUU;
                $perUU->id_pengguna = Auth::user()->pengguna->id;
                $perUU->perihal = $input['perihal'];
                $perUU->catatan = $input['catatan'];
                $perUU->lampiran = $uqFolder . DS . $filename;
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
                    $data = array(
                        'user' => Auth::user(),
                        'perUU' => $perUU
                    );
                    Mail::send('emails.PerUU.new', $data, function($message) {
                        // admin email (testing)
                        $message->to('egisolehhasdi@gmail.com', 'egisolehhasdi@gmail.com')
                                ->subject('Usulan Baru Peraturan Perundang-Undangan');
                    });

                    Session::flash('success', 'Data berhasil dikirim.');
                    return Redirect::to('site');
                } else {
                    Session::flash('error', 'Gagal mengirim data. Pastikan informasi sudah benar.');
                    return Redirect::back();
                }
            }
        } else {
            Session::flash('error', 'Gagal mengirim berkas. Pastikan berkas berupa PDF dan kurang dari 512k.');
            return Redirect::back();
        }
    }

    public function edit($id)
    {
        if (Request::ajax())
            return Datatables::of(DAL_PerUU::getLogUsulan($id))->make(true);

        $perUU = PerUU::with('Pengguna')->find($id);
        $this->layout = View::make('layouts.admin');
        $this->layout->content = View::make('PerUU.edit')
                ->with('perUU', $perUU);
    }

    public function update($id)
    {
        $status = Input::get('status', 0);
        $catatan = Input::get('catatan', '');
        $ketLampiran = Input::get('ket_lampiran', '');
        $lampiran = Input::file('lampiran');

        $perUU = PerUU::find($id);

        $logPerUU = new LogPerUU();
        $logPerUU->id_per_uu = $perUU->id;
        $logPerUU->catatan = $perUU->catatan;
        $logPerUU->lampiran = $perUU->lampiran;
        $logPerUU->status = $perUU->status;
        $logPerUU->tgl_proses = new DateTime('now');

        $perUU->status = $status;
        $perUU->catatan = $catatan;

        if (null != $lampiran) {
            if ($lampiran->isValid()) {
                $uqFolder = str_random(8);
                $destinationPath = UPLOAD_PATH . '/' . $uqFolder;
                $filename = $lampiran->getClientOriginalName();
                $uploadSuccess = $lampiran->move($destinationPath, $filename);
                if ($uploadSuccess) {
                    $perUU->lampiran = $uqFolder . DS . $filename;
                }
            } else {
                Session::flash('error', 'Kesalahan dalam menyimpan berkas.');
            }
        }

        if ($perUU->save() && $logPerUU->save()) {
            // Kirim email notifikasi ke pembuat usulan
            $data = array(
                'logPerUU' => $logPerUU,
                'perUU' => $perUU
            );

            Mail::send('emails.PerUU.update', $data, function($message) use($perUU) {
                $message->to($perUU->pengguna->email)
                        ->subject('Perubahan Status Usulan');
            });

            Session::flash('success', 'Usulan berhasil diperbaharui.');
            return Redirect::route('admin.puu.index');
        } else {
            Session::flash('error', 'Usulah gagal diperbaharui.');
            return Redirect::back();
        }
    }

    public function destroy($id)
    {
        $perUU = PerUU::find($id);
        if (null != $perUU)
            $perUU->delete();
        echo 1;
    }

    public function downloadLampiran($id)
    {
        $perUU = PerUU::find($id) or App::abort(404);
        $path = UPLOAD_PATH . DS . $perUU->lampiran;
        return Response::download($path, explode('/', $perUU->lampiran)[1]);
    }


	public function downloadLampiranLog($id)
	{
		$log = LogPerUU::find($id) or App::abort(404);
		$path = UPLOAD_PATH . DS . $log->lampiran;
		return Response::download($path, explode('/', $perUU->lampiran)[1]);
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
