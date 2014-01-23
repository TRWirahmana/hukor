<?php

class LoginController extends BaseController {

    public function signin() {
        $username = Input::get('username');
        $password = Input::get('password');

        $user = User::where('username', '=', $username)->first();
		
		
	        if (null !== $user) {
	            $user = $user->toArray();
				
	            if (Hash::check($password, $user['password'])) {
	
	                // set ulang untuk auth karena untuk auth password tidak boleh di encrypt terlebih dahulu
	                $credential = array(
	                    'id' => $user['id'],
	                    'username' => $user['username'],
	                    'password' => $password
	                    );
	
	                Session::put('key', array('us' => $username, 'pd' => MyCrypt::encrypt($password)));
				
	                if(Auth::attempt($credential))
	                {
	                    $user_ = Auth::user();
						//validation estimasi pendaftaran for role
	                		switch ($user_->role_id) {

                                case 2:
	                            return Redirect::to('/');
	                            break;
	                        default:
	                            return Redirect::to('/');
	                            break;
							}
	                	
	                }
			        //
	            } else {
                    Session::flash('error', 'Password yang anda masukan salah!');
	                return Redirect::to('/');
	            }
		
        } else {
                Session::flash('error', 'User tidak terdaftar!');
                return Redirect::to('/');
        }
        
    }

    /*
     * Logout
     */

    public function signout() {
        // @TODO : Clean Creadential
        Auth::logout();
        Session::forget('key');
        return Redirect::to('/')->withInput()->with('success', 'Anda telah keluar dari sistem.');
    }
	
	public function error()
	{
		$estimasi = EstimasiPendaftaran::find(1);
		//the condition if value of table estimasi_pendaftaran is null
		if($estimasi != null){
			$tgl = RetaneHelper::toStringIndonesia($estimasi->tanggal_mulai);
			$tgl_akhir = RetaneHelper::toStringIndonesia($estimasi->tanggal_berakhir);
			return Redirect::to('/')->withInput()->with('error', 'Registrasi dimulai pada tanggal ' . $tgl . ' s/d ' . $tgl_akhir);
		
		}else{
			return Redirect::to('/')->withInput()->with('error', 'Registrasi Pendaftaran Belum Dimulai');
		}
	}

}
