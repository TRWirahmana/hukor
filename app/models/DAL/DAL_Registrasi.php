<?php
class DAL_Registrasi {
    /*
     | Fungsi Handling Registrasi User Anonymouse (dari front end page)
     * 
     */
    private $_data = array();

    public function SetData($data = array()) {
        $this->_data = $data;
    }

    public function Save() {
        if (!empty($this->_data)) {
            User::insert($this->_data);
            return DB::getPdo()->lastInsertId();
        } else {
            return 0;
        }
    }

    public static function getDataTable($role_id) {

        if($role_id == 0)
        {
//            var_dump($role_id);exit;
            $data = User::join('pengguna', 'user.id', '=', 'pengguna.user_id')
                ->select(array(
                    'pengguna.nama_lengkap',
                    'user.username',
                    'pengguna.email',
                    'user.id'
                ))
            ->where('user.id', '!=', 1)
                ->where('user.role_id', '!=', '');

        }else
        {
            $data = User::join('pengguna', 'user.id', '=', 'pengguna.user_id')
                ->select(array(
                    'pengguna.nama_lengkap',
                    'user.username',
                    'pengguna.email',
                    'user.id'
                ))
                ->where('user.role_id', '=', $role_id);
//            var_dump($role_id);exit;

        }


        if(0 != $role_id)
            $data = $data->where('user.id', '=', 0);

        return $data;
    }
}
