<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Pengguna extends Eloquent implements UserInterface, RemindableInterface {

    protected $key = 'id';
    protected $table = 'pengguna';

    const STATUS_MENIKAH = 1;
    const STATUS_BELUM_MENIKAH = 2;
    const STATUS_JANDA_DUDA = 3;

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

    public function user() {
        return $this->belongsTo('User');
    }

    public function pelembagaan() {
        return $this->hasMany('Pelembagaan');
    }

    public function detailJabatan() {
        return $this->belongsTo('Jabatan', 'jabatan');
    }

    public function perUU() {
        return $this->hasMany('PerUU');
    }

    public function sistemDanProsedur() {
        return $this->hasMany('SistemDanProsedur');
    }

    public function analisisJabatan() {
        return $this->hasMany('AnalisisJabatan');
    }

    public function bagian() {
        return $this->belongsToMany('Bagian');
    }

}
