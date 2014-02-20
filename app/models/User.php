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

    public function pengguna() {
        return $this->hasOne('Pengguna');
    }

    public function bagian() {
        return $this->belongsTo('Bagian');
    }

    public function bantuanhukum(){
        return $this->hasMany('BantuanHukum');
    }

    // BELONG TO MANY
    public function roles() {
        return $this->belongsToMany('Role');
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

    public function forumUser() {
        return $this->hasOne('ForumUser', 'id');
    }

}