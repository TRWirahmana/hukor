<?php


class KetatalaksanaanController extends BaseController {

	public function usulanSistemProsedur() {
        $user = Auth::user();
        $this->layout = View::make('layouts.master');
        $this->layout->content = View::make("Ketatalaksanaan.usulanSistemProsedur")
                ->with('user', $user);
	}

	public function prosesUsulanSistemProsedur() {
		$input = Input::get('sistem_dan_prosedur');
        $img = Input::file('sistem_dan_prosedur.lampiran');
        $input2 = Input::get('penanggungJawab');

        if ($img->isValid()) {
            $uqFolder = str_random(8);
            $destinationPath = UPLOAD_PATH . '/' . $uqFolder;
            $filename = $img->getClientOriginalName();
            $uploadSuccess = $img->move($destinationPath, $filename);

            if ($uploadSuccess) {
                $sistemDanProsedur = new SistemDanProsedur;
                $sistemDanProsedur->id_pengguna = 1;
                $sistemDanProsedur->perihal = $input['perihal'];
                $sistemDanProsedur->catatan = $input['catatan'];
                $sistemDanProsedur->lampiran = $uqFolder . DS . $filename;
                $sistemDanProsedur->tgl_usulan = new DateTime;
                $sistemDanProsedur->status = 0;
                if ($sistemDanProsedur->save()) {
                    $penanggungJawab = new PenanggungJawabSistemDanProsedur();
                    $penanggungJawab->id_sistem_dan_prosedur = $perUU->id;
                    $penanggungJawab->nama = $input2['nama'];
                    $penanggungJawab->jabatan = $input2['jabatan'];
                    $penanggungJawab->NIP = $input2['nip'];
                    $penanggungJawab->unit_kerja = $input2['unit_kerja'];
                    $penanggungJawab->alamat_kantor = $input2['alamat_kantor'];
                    $penanggungJawab->telepon_kantor = $input2['telp_kantor'];
                    $penanggungJawab->email = $input2['email'];
                    $penanggungJawab->save();

                    // kirim email ke admin
                    // $data = array(
                    //     'user' => Auth::user(),
                    //     'perUU' => $perUU
                    // );
                    // Mail::send('emails.usulanbaru', $data, function($message) {
                    //     // admin email (testing)
                    //     $message->to('egisolehhasdi@gmail.com', 'egisolehhasdi@gmail.com')
                    //             ->subject('Usulan Baru Peraturan Perundang-Undangan');
                    // });

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
}