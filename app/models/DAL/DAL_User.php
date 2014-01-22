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

    /*
     * Simpan Data Riwayat Pendidikan User
     */

    public function SetRiawayatPendidikan($data = array()) {
        $this->_data = $data;
    }

    public function SaveRiawayatPendidikan($userID) {
        if (!empty($this->_data)) {
            $this->_data['user_id'] = $userID;
            $this->_data['created_at'] = date("Y-m-d H:i:s");
            $this->_data['updated_at'] = date("Y-m-d H:i:s");

            User::find($userID)->Pendidikan()->insert($this->_data);
            return true;
        } else {
            return false;
        }
    }

    /*
     * Simpan Data Riwayat Pekerjaan User
     */

    public function SetRiawayatPekerjaan($data = array()) {
        $this->_data = $data;
    }

    public function SaveRiawayatPekerjaan($userID) {
        if (!empty($this->_data) && sizeof($this->_data) > 0) {
            foreach ($this->_data as $data) {
                $data['user_id'] = $userID;
                $periode = $data['bulan_awal'] . '/' . $data['tahun_awal'] . '-' . $data['bulan_akhir'] . '/' . $data['tahun_akhir'];
                $data['periode'] = $periode;
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");

                unset($data['bulan_awal'], $data['tahun_awal'], $data['bulan_akhir'], $data['tahun_akhir']);

                User::find($userID)->Pekerjaan()->insert($data);
            }
            return true;
        } else {
            return false;
        }
    }

    /*
     * Simpan Data Riwayat Organisasi User
     */

    public function SetRiawayatOrganisasi($data = array()) {
        $this->_data = $data;
    }

    public function SaveRiawayatOrganisasi($userID) {
        if (!empty($this->_data) && sizeof($this->_data) > 0) {
            foreach ($this->_data as $data) {
                $data['user_id'] = $userID;
                $periode = $data['bulan_awal'] . '/' . $data['tahun_awal'] . '-' . $data['bulan_akhir'] . '/' . $data['tahun_akhir'];
                $data['periode'] = $periode;
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");

                unset($data['bulan_awal'], $data['tahun_awal'], $data['bulan_akhir'], $data['tahun_akhir']);

                User::find($userID)->Organisasi()->insert($data);
            }
            return true;
        } else {
            return false;
        }
    }

    /*
     * Simpan Data Riwayat Prestasi User
     */

    public function SetRiawayatPrestasi($data = array()) {
        $this->_data = $data;
    }

    public function SaveRiawayatPrestasi($userID) {
        if (!empty($this->_data) && sizeof($this->_data) > 0) {
            foreach ($this->_data as $prestasi) {
                
                $data['user_id'] = $userID;
                $data['nama_prestasi'] = $prestasi['prestasi_nama'];
                $data['periode'] = $prestasi['prestasi_tahun'];
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                User::find($userID)->Prestasi()->insert($data);
            }
            return true;
        } else {
            return false;
        }
    }

    /*
     * Simpan Data Lampiran
     */

    public function SaveLampiran($data = array()) {
        $repo = new DAL_Repository();

        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $repo->SetData($data);

        return $repo->Save();
    }

    public function SetPengguna($user_id, $email)
    {
        $biodata['role_id'] = 2;
        $biodata['user_id'] = $user_id;
        $biodata['email'] = $email;
        $biodata['thn_pendaftaran'] = date('Y');
        $biodata['created_at'] = date("Y-m-d H:i:s");
        $biodata['updated_at'] = date("Y-m-d H:i:s");

        $this->_data = $biodata;
    }

    public function GetDataUser($filter, $role_id)
    {
        $data = Registrasi::where('id', '!=', null);

//        var_dump($role_id);exit;

        if($role_id == 3 || $role_id == 4 || $role_id == 5 || $role_id == 6 || $role_id == 7)
        {
            // filter untuk mengambil data user pelamar
            $data = $data->where('role_id', '=', 2)
                ->where('nama_lengkap', '!=', null);
        }else{
            // filter untuk mengambil data user pelamar
            $data = $data->where('role_id', '=', 2)
                ->where('penilai_pendidikan', '!=', 0)
                ->where('penilai_pengalaman', '!=', 0)
                ->where('penilai_popularitas', '!=', 0)
                ->where('penilai_keluarga', '!=', 0)
                ->where('penilai_kesehatan', '!=', 0);
        }



        // filter provinsi
        if($filter['provinsi'] != "" && $filter['provinsi'] != null) {
            $data = $data->where('provinsi_id', '=', $filter['provinsi']);
        }

        // filter berdasarkan status verifikasi
        if($filter['verifikasi'] != "" || $filter['verifikasi'] != null)
        {
            $data = $data->where('status', '=', $filter['verifikasi']);
        }
        else
        {
            $data = $data->where('status', '!=', null);
        }


        // filter berdasarkan thn pendaftaran
        if($filter['thn_pendaftaran'] != "" || $filter['thn_pendaftaran'] != null)
        {
            $data = $data->where("thn_pendaftaran", "=", $filter['thn_pendaftaran']);
        } 
        else 
        {
            $data = $data->where("thn_pendaftaran", "!=", null);
        }


        //sorting table
        if( $filter['order'] == 'asc' )
        {
            switch ( $filter['sortColumn'] ) {
                case 0:
                    $data = $data->orderBy('nama_lengkap', 'asc');
                    break;
                default:
                    $data = $data->orderBy('nama_lengkap', 'asc');
                    break;
            }
        }
        else if( $filter['order'] == 'desc' )
        {
            switch ( $filter['sortColumn'] ) {
                case 0:
                    $data = $data->orderBy('nama_lengkap', 'desc');
                    break;
                default:
                    $data = $data->orderBy('nama_lengkap', 'desc');
                    break;
            }
        }

        //counting all record
        DAL_User::$allRecord = count($data->get());

        //search datatables
        if( $filter['sSearch'] != null || $filter['sSearch'] != "" )
        {
            $data = $data->where( 'nama_lengkap', 'LIKE', '%'. $filter['sSearch'] .'%' )
                        ->orWhere( 'alamat', 'LIKE', '%'. $filter['sSearch'] .'%' )
                        ->orWhere( 'tempat_lahir', 'LIKE', '%'. $filter['sSearch'] .'%' )
                        ->orWhere( 'tanggal_lahir', 'LIKE', '%'. $filter['sSearch'] .'%' );
        }


        //counting record filtered
        DAL_User::$allFilterRecord = count($data->get());

        //pagination table
        if( $filter['offset'] != null && $filter['limit'] != -1 )
        {
            $data = $data->skip( $filter['offset'] )->take( $filter['limit'] );
        }

        // retrieving a select clause
        $result = $data->select(
            'id', 'nama_lengkap', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'provinsi_id', 'status'
            , 'penilai_pendidikan', 'penilai_pengalaman', 'penilai_popularitas', 'penilai_keluarga', 'penilai_kesehatan')->get();

        return (count($result)) ? $result : null;
    }

    public function GetCVUser($userId)
    {
        $data = Registrasi::find($userId);

        $pendidikan = Registrasi::find($userId)->pendidikan;
        $pekerjaan = Registrasi::find($userId)->pekerjaan;
        $organisasi = Registrasi::find($userId)->organisasi;
        $prestasi = Registrasi::find($userId)->prestasi;
        $lampiran = Registrasi::find($userId)->lampiran;

        foreach ($pekerjaan as $element){
            $element->periode = RetaneHelper::generatePeriodeString($element->periode);
        }

        foreach ($organisasi as $element2){
            $element2->periode = RetaneHelper::generatePeriodeString($element2->periode);
        }

        foreach ($lampiran as $lamp){
            $lamp->link = link_to_action('RegistrasiController@lihatLampiran', 'Lihat', array(
                            'id' => $lamp->id
                        ), array('target' => '_blank'));
        }

        $result = array(
            'biodata' => $data->toArray(),
            'pendidikan' => $pendidikan->toArray(),
            'pekerjaan' => $pekerjaan->toArray(),
            'organisasi' => $organisasi->toArray(),
            'prestasi' => $prestasi->toArray(),
            'lampiran' => $lampiran->toArray()
        );

        return (count($result['biodata'])) ? $result : null;
    }

    public function VerifikasiUser($input)
    {
        $data = Registrasi::find($input['userid']);
        $admins = Auth::user();
        $role = Role::find($admins->role_id);

        switch($admins->role_id)
        {
            //penilai pendidikan
            case 3:
                $verifikator = Auth::user();
                // 1 adalah verifikasi sedangkan 0 adalah tolak
                if($input['status'] == 1)
                {
                    $data->penilai_pendidikan = 1;
//                    $data->verifikator = $verifikator->username;
                }
                else if($input['status'] == 0)
                {
                    $data->penilai_pendidikan = 2;
                    $data->alasan .= "&#10;&#10;";
                    $data->alasan .= $admins->username . " (" . $role->name . "):&#10;";
                    $data->alasan .= $input['alasan'];
//                    $data->verifikator = $verifikator->username;
                }

                $data->save();
                break;

            //penilai pengalaman
            case 4:
                $verifikator = Auth::user();
                // 1 adalah verifikasi sedangkan 0 adalah tolak
                if($input['status'] == 1)
                {
                    $data->penilai_pengalaman = 1;
//                    $data->verifikator = $verifikator->username;
                }
                else if($input['status'] == 0)
                {
                    $data->penilai_pengalaman = 2;
                    $data->alasan .= "&#10;&#10;";
                    $data->alasan .= $admins->username . " (" . $role->name . "):&#10;";
                    $data->alasan .= $input['alasan'];
//                    $data->verifikator = $verifikator->username;
                }

                $data->save();
                break;

            //penilai popularitas
            case 5:
                $verifikator = Auth::user();
                // 1 adalah verifikasi sedangkan 0 adalah tolak
                if($input['status'] == 1)
                {
                    $data->penilai_popularitas = 1;
//                    $data->verifikator = $verifikator->username;
                }
                else if($input['status'] == 0)
                {
                    $data->penilai_popularitas = 2;
                    $data->alasan .= "&#10;&#10;";
                    $data->alasan .= $admins->username . " (" . $role->name . "):&#10;";
                    $data->alasan .= $input['alasan'];
//                    $data->verifikator = $verifikator->username;
                }

                $data->save();
                break;

            // penilai keluarga
            case 6:
                $verifikator = Auth::user();
                // 1 adalah verifikasi sedangkan 0 adalah tolak
                if($input['status'] == 1)
                {
                    $data->penilai_keluarga = 1;
//                    $data->verifikator = $verifikator->username;
                }
                else if($input['status'] == 0)
                {
                    $data->penilai_keluarga = 2;
                    $data->alasan .= "&#10;&#10;";
                    $data->alasan .= $admins->username . " (" . $role->name . "):&#10;";
                    $data->alasan .= $input['alasan'];
//                    $data->verifikator = $verifikator->username;
                }

                $data->save();
                break;

            // penilai kesehatan
            case 7:
                $verifikator = Auth::user();
                // 1 adalah verifikasi sedangkan 0 adalah tolak
                if($input['status'] == 1)
                {
                    $data->penilai_kesehatan = 1;
//                    $data->verifikator = $verifikator->username;
                }
                else if($input['status'] == 0)
                {
                    $data->penilai_kesehatan = 2;
                    $data->alasan .= "&#10;&#10;";
                    $data->alasan .= $admins->username . " (" . $role->name . "):&#10;";
                    $data->alasan .= $input['alasan'];
//                    $data->verifikator = $verifikator->username;
                }

                $data->save();
                break;

            //admin
            case 8:
                $verifikator = Auth::user();
                // 1 adalah verifikasi sedangkan 0 adalah tolak
                if($input['status'] == 1)
                {
                    $data->status = 1;
//                    $data->verifikator = $verifikator->username;
                }
                else if($input['status'] == 0)
                {
                    $data->status = 2;
                    $data->alasan .= "&#10;&#10;";
                    $data->alasan .= $admins->username . " (" . $role->name . "):&#10;";
                    $data->alasan .= $input['alasan'];
//                    $data->verifikator = $verifikator->username;
                }

                $data->save();
                break;
        }
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