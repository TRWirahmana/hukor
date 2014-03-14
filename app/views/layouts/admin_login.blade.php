<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Administrator | Layanan Hukum dan Organisasi</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.shinyblue.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/hukor.css')}}">

    @section('scripts')
    <script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-migrate-1.1.1.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/jquery.cookie.js')}}"></script>

    @show

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{asset('assets/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{asset('assets/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{asset('assets/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/ico/apple-touch-icon-57-precomposed.png')}}">
    <link rel="shortcut icon" href="{{asset('assets/ico/favicon.png')}}">
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#login').submit(function(){
                var u = jQuery('#username').val();
                var p = jQuery('#password').val();
                if(u == '' && p == '') {
                    jQuery('.login-alert').fadeIn();
                    return false;
                }
            });
        });
    </script>
</head>

<body class="loginpage">
@include('adminflash')
<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate3 bounceIn">
          <img class="inputwrapper animate0 bounceIn" src="{{asset('assets/images/logo-only.png')}}" alt=""/>
            <h4>
                <span>Biro Hukum dan Organisasi</span><br>
                <span>Kementerian Pendidikan dan Kebudayaan</span><br>
                <span>Republik Indonesia</span>
            </h4>
        </div>
        {{-- form login--}}
        {{ Form::open(array('action' => 'LoginController@signin_admin', 'method' => 'post', 'id'=>'user-sign-in-form',
        'class' =>'front-form', 'autocomplete' => 'off')) }}
            <div class="inputwrapper animate1 bounceIn">
                {{
                Form::text('username', '', array(
                'class'=>'username validate[required] text-input',
                'id'=>'username',
                'placeholder'=>'Masukan username di sini...'
                ))
                }}
            </div>
            <div class="inputwrapper animate2 bounceIn">
                {{ Form::password('password', array('class'=>'password validate[required] text-input',
                'id'=>'password','placeholder'=>'Masukan password di sini...')) }}
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button class="btn" id="btn-signin" type="submit">Masuk</button>
            </div>

        {{ Form::close() }}

    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2014 Biro Hukum dan Organisasi</p>
</div>

</body>
</html>
