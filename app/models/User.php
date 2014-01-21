<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends Eloquent implements UserInterface, RemindableInterface {

    protected $key = 'id';
    protected $table = 'user';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function registrasi() {
        return $this->hasOne('Registrasi');
    }



    protected $guarded = array();

    const STATUS_MENIKAH = 1;
    const STATUS_BELUM_MENIKAH = 2;
    const STATUS_JANDA_DUDA = 3;

    public $attr_names = array(
            'nama_lengkap' => 'Nama Lengkap',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'region_id' => 'Daerah Registrasi',
            'status_nikah' => 'Status',
            'telepon' => 'Nomor Telepon',
            'hp' => 'Nomor Handphone',
            'email' => 'Alamat E-mail',
            'no_ktp' => 'Nomor KTP',
            'no_sim' => 'Nomor SIM',
            'keterampilan_bakat' => 'Keterampilan Bakat',
            'hobi' => 'Hobi',
            'sma' => 'SMA',
            'sma_tahun' => 'Tahun lulus SMA.',
            'prasarjana_universitas' => 'Universitas',
            'prasarjana_tahun' => 'Tahun lulus universitas',
            'foto' => 'Pas Foto',
            'lampiran' => 'Lampiran'
    );
//
//
////    // BELONG TO MANY
//    public function roles() {
//        return $this->belongsToMany('Role');
//    }
////
////    // HAS ONE PENDIDIKAN
//    public function pendidikan() {
//        return $this->hasOne('Pendidikan');
//    }
//
//    // HAS MANY KELUARGA
//    public function keluarga() {
//        return $this->hasMany('Keluarga');
//    }
//
//    // HAS ONE KESEHATAN
//    public function kesehatan() {
//        return $this->hasOne('Kesehatan');
//    }
//
////
////    // HAS MANY PRESTASI
//    public function prestasi() {
//        return $this->hasMany('Prestasi');
//    }
////
////    // HAS MANY PEKERJAAN
//    public function pekerjaan() {
//        return $this->hasMany('Pekerjaan');
//    }
////
//    // HAS MANY Organisasi
//    public function organisasi() {
//        return $this->hasMany('Organisasi');
//    }
////
////
//    public function provinsi() {
//        return $this->belongsTo('Provinsi');
//    }
////
////    // HAS MANY LAMPIRAN
//    public function lampiran() {
//        return $this->hasMany('Lampiran');
//    }
//
    public function getJenisKelamin() {
        switch ($this->jenis_kelamin) {
            case 'L':
                return "Laki-Laki";
                break;
            case 'P':
                return "Perempuan";
                break;
            default:
                return "";
                break;
        }
    }
//
    public function getStatusNikah() {
        switch ($this->status_nikah) {
            case self::STATUS_MENIKAH:
                return "Menikah";
                break;
            case self::STATUS_BELUM_MENIKAH:
                return "Belum Menikah";
                break;
            case self::STATUS_JANDA_DUDA:
                return "Janda atau Duda";
                break;
            default:
                return "";
                break;
        }
    }
//
//    public function getValidator() {
//
//        $rules = array(
//            'nama_lengkap' => 'required',
//            'jenis_kelamin' => 'required',
//            'tempat_lahir' => 'required',
//            'tanggal_lahir' => 'required|not_in:0000-00-00',
//            'alamat' => 'required',
//            'provinsi_id' => 'required|not_in:0',
//            'status_nikah' => 'required|not_in:0',
//            'telepon' => 'required',
//            'hp' => 'required',
//            'email' => 'required',
//            'no_ktp' => 'required',
//            'no_sim' => 'required',
//            // 'keterampilan_bakat' => 'required',
//            // 'hobi' => 'required',
//            'sma' => 'required',
//            'sma_tahun' => 'required',
//            'prasarjana_universitas' => 'required',
//            'prasarjana_tahun' => 'required',
//            'foto' => 'required',
//            'lampiran' => 'required',
//            'tulisan_judul' => 'required',
//            'tulisan_konten' => 'required',
//            'tulisan_verify' => 'required'
//        );
//
//        $attributes = array_merge($this->attributes, $this->pendidikan->attributes);
//
//        if(!is_null($this->lampiran()->where('context', '=', 'FOTO_USER')->first()))
//            $attributes['foto'] = true;
//
//        if ($this->lampiran()->where('context', '!=', 'FOTO_USER')->count() == ($this->status_nikah == 1)? 9 : 8)
//            $attributes['lampiran'] = true;
//
//
//        $validator = Validator::make($attributes, $rules);
//
//        return $validator;
//    }

}