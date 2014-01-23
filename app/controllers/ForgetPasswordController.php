<?php
/**
 * Created by PhpStorm.
 * User: Sangkuriang
 * Date: 1/23/14
 * Time: 1:13 PM
 */

class ForgetPasswordController extends BaseController {

    protected $layout = 'layouts.master';

    public function index() {
        //exit;
        $this->layout->content = View::make('forgetpassword.index');
    }

    public function reset(){
        $email = Input::get('email');
        $password = HukorHelper::generateRandomString(8);


        $user = User::where('username', '=', $email)->first();

        if (null !== $user) {
            $user = $user->toArray();
//            var_dump($user);exit;

            if ($email == $user['username']) {

                Session::put('key', array('us' => $email, 'pd' => MyCrypt::encrypt($password)));

                $user = User::where('username', '=', $email)->first();

                    $user->password = Hash::make($password);
                    $user->save();

                    $this->sendMail($email, $password);
                    return Redirect::to('/')->withInput()->with('success', 'Password berhasil di reset!. Cek email anda untuk mengetahui username & password yang akan digunakan untuk login kedalam sistem!');
                //
            } else {
                return Redirect::to('/')->withInput()->with('error', 'Email tidak terdaftar!');
            }

        } else {

            return Redirect::to('/')->withInput()->with('error', 'User tidak terdaftar!');
        }
    }

    private function sendMail($email, $password) {
        $message = '';

        // creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
        $user = array(
            'email' => $email,
            'name' => 'Yth. akun dengan alamat email ' . $email,
        );

        // the data that will be passed into the mail view blade template
        $data = array(
            'email' => $email,
            'password' => $password
        );

        // use Mail::send function to send email passing the data and using the $user variable in the closure
        Mail::send('emails.template', $data, function($message) use ($user) {
            $message->from('admin@site.com', 'Site Admin');
            $message->to($user['email'], $user['name'])->subject('Reset Password');
        });
    }
}