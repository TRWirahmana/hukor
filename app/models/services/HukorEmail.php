<?php
class HukorEmail {
    public function sendMail($subject, $to_email, $template, $data) {
        $message = '';

        // creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
        $user = array(
            'email' => $to_email,
            'name' => 'Yth. Pemilik E-Mail ' . $$to_email,
        );

        // the data that will be passed into the mail view blade template
//        $data = array(
//            'username' => $username,
//            'password' => $password
//        );

        // use Mail::send function to send email passing the data and using the $user variable in the closure
        Mail::send($template, $data, function($message) use ($user, $subject) {
            $message->from('admin@site.com', 'Site Admin');
            $message->to($user['email'], $user['name'])->subject($subject);
        });
    }
}
