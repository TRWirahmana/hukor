<?php

class LoginController extends BaseController
{

    public function signin()
    {
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

                if (Auth::attempt($credential)) {
                    $user = Auth::user();

                    // Remove this user's guest entry from the online list
                    ForumOnline::where("ident", "=", mysql_real_escape_string(get_remote_address()))->delete();

                    // log the user in to the forum
                    pun_setcookie($user->id, pun_hash($password), time() + 1209600);

                    // Reset tracked topics
                    set_tracked_topics(null);
                    //validation estimasi pendaftaran for role
                    switch ($user->role_id) {
                        case 2:
                            Session::flash('success', 'Selamat datang ' . $user->username . ' !');
                            return Redirect::to('/');
                            break;

                        case 3:
                            Session::flash('success', 'Selamat datang admin!');
                            return Redirect::to('/admin/Home');
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

    public function signout()
    {
        global $pun_user;

        Auth::logout();
        Session::forget('key');

        // Remove user from "users online" list
        ForumOnline::where('user_id', '=', $pun_user['id'])->delete();
        // Update last_visit (make sure there's something to update it with)
        if (isset($pun_user['logged']))
            ForumUser::find($pun_user['id'])->update(array("last_visit" => $pun_user['logged']));

        pun_setcookie(1, pun_hash(uniqid(rand(), true)), time() + 31536000);

        return Redirect::to('/')->withInput()->with('success', 'Anda telah keluar dari sistem.');
    }

    public function error()
    {
        $estimasi = EstimasiPendaftaran::find(1);
        //the condition if value of table estimasi_pendaftaran is null
        if ($estimasi != null) {
            $tgl = RetaneHelper::toStringIndonesia($estimasi->tanggal_mulai);
            $tgl_akhir = RetaneHelper::toStringIndonesia($estimasi->tanggal_berakhir);
            return Redirect::to('/')->withInput()->with('error', 'Registrasi dimulai pada tanggal ' . $tgl . ' s/d ' . $tgl_akhir);
        } else {
            return Redirect::to('/')->withInput()->with('error', 'Registrasi Pendaftaran Belum Dimulai');
        }
    }

}
