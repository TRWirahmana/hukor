<?php

class LoginController extends BaseController {

    public function signin() {
        $username = Input::get('username');
        $password = Input::get('password');
        $user = Registrasi::where('username', '=', $username)->first();
		
		
	        if (null !== $user) {
	            $user = $user->toArray();
				
	            if (Hash::check($password, $user['password'])) {
	
	                // set ulang untuk auth karena untuk auth password tidak boleh di encrypt terlebih dahulu
	                $credential = array(
	                    'id' => $user['id'],
	                    'email' => $user['email'],
	                    'username' => $user['username'],
	                    'status' => $user['status'],
	                    'password' => $password
	                    );
	
	                Session::put('key', array('us' => $username, 'pd' => MyCrypt::encrypt($password)));
				
	                if(Auth::attempt($credential))
	                {
	                    $user_ = Auth::user()->user;
						//validation estimasi pendaftaran for role
	                		switch ($user_->role_id) {
	                        case 2:
								
								//Define tanggal estimasi pendaftaran
								$estimasi_pendaftaran = EstimasiPendaftaran::where('id', '=', '1');
								$rows = count($estimasi_pendaftaran);
						
								$t = EstimasiPendaftaran::find($rows);
								if($t != null){
									$tanggal_mulai = $t->tanggal_mulai;
									$tanggal_berakhir = $t->tanggal_berakhir;
									
									$todays = date('Y-m-d');
								
											if($tanggal_mulai <= $todays && $tanggal_berakhir >= $todays){
				                            	return Redirect::to('/edit')->with('success', 'Login berhasil. Selamat datang Peserta Penyuluhan!');
				                            }
						                   else{
						                		Auth::logout();
					        					Session::forget('key');
						                    	return Redirect::to('/')->withInput()->with('error', 'tanggal pendaftaran telah berakhir!');
						                    }
								} else {
									Auth::logout();
		        					Session::forget('key');
			                    	return Redirect::to('/')->withInput()->with('error', 'tanggal pendaftaran telah berakhir!');
								}
								
	                            break;
	                        case 3:
	                            return Redirect::to('/admreg/Verifikasi');
	                            break;
	                        case 4:
	                            return Redirect::to('/admin/account');
	                            break;
	                        default:
	                            return Redirect::to('/edit');
	                            break;
							}
	                	
	                }
			        //
	            } else {
	                return Redirect::to('/')->withInput()->with('error', 'Password yang anda masukan salah!');
	            }
		
        } else {

            return Redirect::to('/')->withInput()->with('error', 'User tidak terdaftar!');
        }
        
    }

    /*
     * Logout
     */

    public function signout() {
        // @TODO : Clean Creadential
        Auth::logout();
        Session::forget('key');
        return Redirect::to('/')->withInput()->with('success', 'Terimakasih');
    }
	
	public function error()
	{
		$estimasi = EstimasiPendaftaran::find(1);
		//the condition if value of table estimasi_pendaftaran is null
		if($estimasi != null){
			$tgl = HukorHelper::toStringIndonesia($estimasi->tanggal_mulai);
			$tgl_akhir = HukorHelper::toStringIndonesia($estimasi->tanggal_berakhir);
			return Redirect::to('/')->withInput()->with('error', 'Registrasi dimulai pada tanggal ' . $tgl . ' s/d ' . $tgl_akhir);
		
		}else{
			return Redirect::to('/')->withInput()->with('error', 'Registrasi Pendaftaran Belum Dimulai');
		}
	}

}
