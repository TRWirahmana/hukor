<?php

class DAL_User {

    private $_data = array();

    //count record datatable
    public static $allRecord;
    public static $allFilterRecord;

    public function GetData() {
        return $this->_data;
    }

    /*
     * Simpan Biodata
     */

    public function SetBiodata($biodata = array()) {
        $biodata['role_id'] = 2;
        $biodata['password'] = '';
        $biodata['tanggal_lahir'] = $biodata["tahun"] . '-' . $biodata["bulan"] . '-' . $biodata["tanggal"];
        unset($biodata["tahun"], $biodata["bulan"], $biodata["tanggal"]);
        $biodata['status'] = 0; // Pending

        $biodata['created_at'] = date("Y-m-d H:i:s");
        $biodata['updated_at'] = date("Y-m-d H:i:s");

        $this->_data = $biodata;
    }

    public function SaveBiodata($uid) {
        if (!empty($this->_data)) {
            Pengguna::insert($this->_data);
            $id = DB::getPdo()->lastInsertId();
            return $id;
        } else {
            return 0;
        }
    }

    public function SetPengguna($user_id, $email, $nama, $nip, $jabatan, $jk, $tgl_lahir, $alamat_kantor, $tlp_ktr, $hp, $uk,$tempat)
    {
//        $biodata['role_id'] = 2;
        $biodata['user_id'] = $user_id;
        $biodata['email'] = $email;
        $biodata['nip'] = $nip;
        $biodata['nama_lengkap'] = $nama;
        $biodata['jabatan'] = $jabatan;
//        $biodata['bagian'] = $bagian;
//        $biodata['sub_bagian'] = $subbag;
        $biodata['jenis_kelamin'] = $jk;
        $biodata['tgl_lahir'] = $tgl_lahir;
//        $biodata['pekerjaan'] = $pekerjaan;
        $biodata['alamat_kantor'] = $alamat_kantor;
        $biodata['tlp_kantor'] = $tlp_ktr;
        $biodata['handphone'] = $hp;
        $biodata['unit_kerja'] = $uk;
        $biodata['tempat_lahir'] = $tempat;
//        $biodata['thn_pendaftaran'] = date('Y');
        $biodata['created_at'] = date("Y-m-d H:i:s");
        $biodata['updated_at'] = date("Y-m-d H:i:s");

        $this->_data = $biodata;
    }

    public function InsertToWP($username, $password)
    {
        $user = DB::Connection('retane_blog')
            ->table('wp_users')
            ->insertGetId(array(
                'user_login' => $username, // username untuk mengakses ke wordpress
                'user_pass' => md5($password), // password untuk mengakses ke wordpress dan di encryp menggunakan MD5
                'user_nicename' => '',
                'user_email' => $username, // email user
                'user_url' => '', // url untuk ke website pribadi (jika di butuhkan)
                'user_registered' => date("Y-m-d H:i:s"), // tanggal saat user teregister
                'user_activation_key' => '', // ngga tau apa
                'user_status' => 0, // status user aktif atau ngga nya di wp
                'display_name' => '',
            ));

        DB::Connection('retane_blog')
            ->table('wp_usermeta')
            ->insert(array(
                'user_id' => $user,
                'meta_key' => 'wp_capabilities',
                'meta_value' => 'a:1:{s:6:"author";b:1;}',
            ));

        DB::Connection('retane_blog')
            ->table('wp_usermeta')
            ->insert(array(
                'user_id' => $user,
                'meta_key' => 'wp_user_level',
                'meta_value' => '10',
            ));
    }

    public function getUserProfile($id)
    {
        $data = Registrasi::find($id);

        $html = "<center><h1>Profile " . $data->nama_lengkap .  "</h1></center>";
        $html .= "</br></br>";

        $html .= "<h3>Biodata</h3>";
        $html .= "<table style='border: 1px solid black;border-collapse:collapse;'>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Nama Lengkap</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->nama_lengkap .  "</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Jenis Kelamin</td>";

        $jenis_kelamin = ($data->jenis_kelamin == "L") ? "Pria" : "Wanita";
        $html .= "<td style='border: 1px solid black;'>" . $jenis_kelamin .  "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Tempat dan Tanggal Lahir</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->tempat_lahir . ', ' . RetaneHelper::toStringIndonesia($data->tanggal_lahir) .  "</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Alamat</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->alamat .  "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Daerah Registrasi</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->provinsi()->first()->nama .  "</td>";
        // $html .= "<td></td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Status Pernikahan</td>";

        $status_nikah = '';
        switch ($data->status_nikah) {
            case 1:
                $status_nikah .= 'Menikah';
                break;

            case 2:
                $status_nikah .= 'Belum Menikah';
                break;

            case 3:
                $status_nikah .= 'Janda Atau Duda';
                break;
        }

        $html .= "<td style='border: 1px solid black;'>" . $status_nikah .  "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>No Telepon dan Hp</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->telepon . '/' . $data->hp .  "</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Email</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->email .  "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>No KTP</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->no_ktp .  "</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>No SIM C</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->no_sim .  "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Keterampilan dan bakat</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->keterampilan_bakat .  "</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Hobi</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->hobi .  "</td>";
        $html .= "</tr>";
        $html .= "</table>";
        $html .= "</br></br>";

        $html .= "<h3>Riwayat Pendidikan</h3>";
        $html .= "<table style='border: 1px solid black;border-collapse:collapse;'>";
        $html .= "<tr>";
        $html .= "<td></td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Nama Sekolah/Universitas/Sekolah Tinggi</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Tahun</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Jurusan</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Sekolah Dasar (atau setingkat)</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->sd . "</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->sd_tahun . "</td>";
        $html .= "<td style='border: 1px solid black;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Sekolah Lanjutan Tingkat Pertama (atau setingkat)</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->smp . "</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->smp_tahun . "</td>";
        $html .= "<td style='border: 1px solid black;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Sekolah Lanjutan Tingkat Akhir (atau setingkat)</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->sma . "</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->sma_tahun . "</td>";
        $html .= "<td style='border: 1px solid black;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Universitas/Institut/Sekolah Tinggi</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->prasarjana_universitas . "</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->prasarjana_tahun . "</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->prasarjana_jurusan . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;'>Program Pasca Sarjana</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->pascasarjana_universitas . "</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->pascasarjana_tahun . "</td>";
        $html .= "<td style='border: 1px solid black;'>" . $data->pendidikan()->first()->pascasarjana_jurusan . "</td>";
        $html .= "</tr>";
        $html .= "</table>";

        $html .= "</br></br>";
        $html .= "<h3>Karir</h3>";
        $html .= "<table style='border: 1px solid black;border-collapse:collapse;'>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Nama Instansi</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Jabatan</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Periode</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Uraian Singkat Pekerjaan</td>";
        $html .= "</tr>";

        foreach ($data->pekerjaan()->where('registrasi_id', '=', $data->id)->get() as $pekerjaan){
            $html .= "<tr>";
            $html .= "<td style='border: 1px solid black;'>" . $pekerjaan->perusahaan . "</td>";
            $html .= "<td style='border: 1px solid black;'>" . $pekerjaan->jabatan . "</td>";
            $html .= "<td style='border: 1px solid black;'>" . RetaneHelper::generatePeriodeString($pekerjaan->periode) . "</td>";
            $html .= "<td style='border: 1px solid black;'>" . $pekerjaan->uraian_singkat . "</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";

        $html .= "</br></br>";
        $html .= "<h3>Organisasi</h3>";
        $html .= "<table style='border: 1px solid black;border-collapse:collapse;'>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Nama Organisasi</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Jabatan</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Periode</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Uraian Singkat Jabatan</td>";
        $html .= "</tr>";

        foreach ($data->organisasi()->where('registrasi_id', '=', $data->id)->get() as $organisasi){
            $html .= "<tr>";
            $html .= "<td style='border: 1px solid black;'>" . $organisasi->organisasi . "</td>";
            $html .= "<td style='border: 1px solid black;'>" . $organisasi->jabatan . "</td>";
            $html .= "<td style='border: 1px solid black;'>" . RetaneHelper::generatePeriodeString($organisasi->periode) . "</td>";
            $html .= "<td style='border: 1px solid black;'>" . $organisasi->uraian_singkat . "</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";

        $html .= "</br></br></br></br>";
        $html .= "<h3>Prestasi</h3>";
        $html .= "<table style='border: 1px solid black;border-collapse:collapse;'>";
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Nama Prestasi</td>";
        $html .= "<td style='border: 1px solid black;font-weight:bold;text-align:center;'>Tahun</td>";
        $html .= "</tr>";

        foreach ($data->prestasi()->where('registrasi_id', '=', $data->id)->get() as $prestasi){
            $html .= "<tr>";
            $html .= "<td style='border: 1px solid black;'>" . $prestasi->nama_prestasi . "</td>";
            $html .= "<td style='border: 1px solid black;'>" . $prestasi->periode . "</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";

        $result = array(
            'nama' => $data->nama_lengkap,
            'html' => $html
        );

        return $result;
    }

}