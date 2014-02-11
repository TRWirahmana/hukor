<?php


class AnalisisJabatanController extends BaseController 
{
	public function index() 
	{
        // handle dataTable request
        if (Request::ajax())
            return Datatables::of(DAL_AnalisisJabatan::getDataTable(Input::get("status", null), Input::get("firstDate", null), Input::get("lastDate", null)))->make(true);

        $this->layout = View::make('layouts.admin');
        $this->layout->content = View::make('AnalisisJabatan.index');
	}

	public function usulan() 
	{
	    $user = Auth::user();
        $this->layout = View::make('layouts.master');
        $this->layout->content = View::make('AnalisisJabatan.usulan')
			->with('user', $user);
	}

	public function prosesUsulan() 
	{
		$input = Input::get('analisisJabatan');
        $img = Input::file('analisisJabatan.lampiran');
        $input2 = Input::get('penanggungJawab');

        if ($img->isValid()) {
            $uqFolder = str_random(8);
            $destinationPath = UPLOAD_PATH . '/' . $uqFolder;
            $filename = $img->getClientOriginalName();
            $uploadSuccess = $img->move($destinationPath, $filename);

            if ($uploadSuccess) {
                $analisisJabatan = new AnalisisJabatan;
                $analisisJabatan->id_pengguna = Auth::user()->pengguna->id;
                $analisisJabatan->perihal = $input['perihal'];
                $analisisJabatan->catatan = $input['catatan'];
                $analisisJabatan->lampiran = $uqFolder . DS . $filename;
                $analisisJabatan->tgl_usulan = new DateTime;
                $analisisJabatan->status = 0;
                if ($analisisJabatan->save()) {
                    $penanggungJawab = new PenanggungJawabAnalisisJabatan();
                    $penanggungJawab->id_analisis_jabatan = $analisisJabatan->id;
                    $penanggungJawab->nama = $input2['nama'];
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
                        'data' => $analisisJabatan
                    );
                    Mail::send('AnalisisJabatan.emailUsulan', $data, function($message) {
                        // admin email (testing)
                        $message->to('egisolehhasdi@gmail.com', 'egisolehhasdi@gmail.com')
                                ->subject('Usulan Baru Analisis Jabatan');
                    });

                    Session::flash('success', 'Data berhasil dikirim.');
                    return Redirect::to('/');
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

    public function printTable() {
        $status = Input::get("status", null);
        $firstDate = Input::get("firstDate", null);
        $lastDate = Input::get("lastDate", null);

        $dataAnalisisJabatan = DAL_AnalisisJabatan::getDataTable($status, $firstDate, $lastDate);
        $data = array();
        foreach($dataAnalisisJabatan->get() as $index => $analisisJabatan) {
            $tglUsulan = new DateTime($analisisJabatan->tgl_usulan);
            $data[$index]['ID'] = $analisisJabatan->id;
            $data[$index]['Tanggal Usulan'] = $tglUsulan->format('d/m/Y');
            $data[$index]['Unit Kerja'] = $analisisJabatan->unit_kerja;
            $data[$index]['Perihal'] = $analisisJabatan->perihal;
            $data[$index]['status'] = $this->getStatus($perUU->status);
            $data[$index]['lampiran'] = '<a href="#">'.explode("/", $analisisJabatan->lampiran)[1].'</a>';
        }

        $table = HukorHelper::generateHtmlTable($data);

        $style = array("<style>");
        $style[] = "table { border-collapse: collapse; }";
        $style[] = "table td, table th { padding: 5px; }";
        $style[] = "</style>";

        $html = array("<h1>Analisis Jabatan</h1>");
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
        $pdf->stream("analisis_jabatan.pdf");
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

    public function downloadLampiran($id)
    {
        $analisisJabatan = AnalisisJabatan::find($id) or App::abort(404);
        $path = UPLOAD_PATH . DS . $analisisJabatan->lampiran;
        return Response::download($path, explode('/', $analisisJabatan->lampiran)[1]);
    }

    public function hapusUsulan()
    {
        $analisisJabatan = AnalisisJabatan::find(Input::get('id'));
        if (null != $analisisJabatan)
            $analisisJabatan->delete();
        echo 1;
    }

    public function update($id)
    {
        if (Request::ajax())
            return Datatables::of(DAL_AnalisisJabatan::getLogUsulan($id))->make(true);

        $analisisJabatan = AnalisisJabatan::with('Pengguna')->find($id);
        $this->layout = View::make('layouts.admin');
        $this->layout->content = View::make('AnalisisJabatan.update')
                ->with('analisisJabatan', $analisisJabatan);
    }

    public function prosesUpdate()
    {
        $id = Input::get('id');
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

        if (null != $lampiran) {
            if ($lampiran->isValid()) {
                $uqFolder = str_random(8);
                $destinationPath = UPLOAD_PATH . '/' . $uqFolder;
                $filename = $lampiran->getClientOriginalName();
                $uploadSuccess = $lampiran->move($destinationPath, $filename);
                if ($uploadSuccess) {
                    $analisisJabatan->lampiran = $uqFolder . DS . $filename;
                }
            } else {
                Session::flash('error', 'Kesalahan dalam menyimpan berkas.');
            }
        }

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
            return Redirect::route('index_analisis_jabatan');
        } else {
            Session::flash('error', 'Usulah gagal diperbaharui.');
            return Redirect::back();
        }
    }


}