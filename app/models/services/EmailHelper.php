<?php
class EmailHelper {
    private function sendMail($no_ktp, $username, $password, $to_email) {
        $message = '';

        // creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
        $user = array(
            'email' => $to_email,
            'name' => 'Yth. Pemegang KTP dengan nomor ' . $no_ktp,
        );

        // the data that will be passed into the mail view blade template
        $data = array(
            'username' => $username,
            'password' => $password
        );

        // use Mail::send function to send email passing the data and using the $user variable in the closure
        Mail::send('emails.template', $data, function($message) use ($user) {
            $message->from('admin@site.com', 'Site Admin');
            $message->to($user['email'], $user['name'])->subject('Subject untuk Email');
        });
    }
}
?>