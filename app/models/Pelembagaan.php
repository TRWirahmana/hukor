<?php

class Pelembagaan extends Eloquent {
  	protected $key = "id";
	protected $table = "pelembagaan";
	public $timestamps = false;

	public function pengguna() {
		return $this->belongsTo('Pengguna', 'id_pengguna');
	}

    public function logPelembagaan() {
        return $this->hasMany('LogPelembagaan');
    }

    public function penanggungJawabPelembagaan() {
        return $this->hasMany('PenanggungJawabPelembagaan');
    }

    public function getJenisUsulan($i) {

        switch ($i) {
            case '1':
                return "pendirian";
                break;
            case '2':
                return "Perubahan";
                break;
            case '3':
                return "Statuta";
                break;
            case '4':
                return "Penutupan";
                break;
            default:
                return "";
                break;
        }
    }

    public function getStatus($i) {
        switch ($i) {
            case '1':
                return "Di Proses";
                break;
            case '2':
                return "Kirim Ke Bagian Peraturan PerUU";
                break;
            default:
                return "";
                break;
        }
    }

  
}
