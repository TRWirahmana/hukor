<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Administrator | Layanan Hukum & Organisasi</title>
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
  <script type="text/javascript">
    jQuery(document).ready(function () {
      jQuery('#login').submit(function () {
        var u = jQuery('#username').val();
        var p = jQuery('#password').val();
        if (u == '' && p == '') {
          jQuery('.login-alert').fadeIn();
          return false;
        }
      });
    });
  </script>
</head>

<body class="loginpage">

<div class="loginpanel">
  <div class="loginpanelinner">
    <img class="inputwrapper animate3 bounceIn" src="{{asset('assets/images/logo-kemendiknas.png')}}" alt=""/>
    {{-- form login--}}
    {{ Form::open(array('action' => 'LoginController@signin', 'method' => 'post', 'id'=>'user-sign-in-form',
    'class' =>'front-form', 'autocomplete' => 'off')) }}
    <div class="inputwrapper animate1 bounceIn">
      {{
      Form::text('username', '', array(
      'class'=>'username validate[required] text-input',
      'id'=>'username',
      'placeholder'=>'ketikkan username di sini...'
      ))
      }}
    </div>
    <div class="inputwrapper animate2 bounceIn">
      {{ Form::password('password', array('class'=>'password validate[required] text-input',
      'id'=>'password','placeholder'=>'ketikkan password di sini...')) }}
    </div>
    <div class="inputwrapper animate3 bounceIn">
      <button class="btn" id="btn-signin" type="submit">Sign in</button>
    </div>

    {{ Form::close() }}


    @if(Session::has('success'))

    <div class="alert alert-success sign-in-register-alert">
      {{ Session::get('success') }}
    </div>
    @elseif(Session::has('error'))
    <div class="alert alert-error sign-in-register-alert">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ Session::get('error') }}
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

  </div>
  <!--loginpanelinner-->
</div>
<!--loginpanel-->

</body>
</html>
