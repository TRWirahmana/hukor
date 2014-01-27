<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layanan Hukum & Organisasi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Registrasi Online Penyuluh Nasional">
  <meta name="author" content="Sangkuriang Internasional">

  <!-- Stylesheet files import here -->
  <!--        <link rel="stylesheet" type="text/css" href="css/dusk.min.css">
          <link rel="stylesheet" type="text/css" href="css/font-embedding-standard.min.css">
          <link rel="stylesheet" type="text/css" href="css/dikbud.css">-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dusk.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-embedding-standard.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dikbud.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycons.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.dataTables.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.ui.datepicker.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}">

  <style type="text/css">
    .container-fluid {
      padding: 0;
    }

    .dropdown-menu .divider {
      border-bottom: 1px solid #ddd !important;
    }
  </style>

  <!-- HTML5 shiv -->
  <!--[if lt IE 9]>
    <script src="{{asset('assets/js/html5shiv.js')}}"></script>
  <![endif]-->

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
    var baseUrl = '{{URL::to('/')}}';
  </script>

</head>
<body class="main-layout">
<?php $datses = Session::get('key'); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span24">
      <div class="span7 sidebar">
        <header>
          <img src="{{asset('assets/img/tut-wuri-handayani.png')}}" alt="Kebudayaan Indonesia">
          <h4>Direktorat Jenderal Kebudayaan Republik Indonesia</h4>
        </header>
          <?php $user = Auth::user(); ?>
          @if($user != null)
        <p id="username">Selamat datang, <?php echo $user->username; ?><span id="name"></span></p>
          @else
          <p id="username">Selamat datang guest<span id="name"></span></p>
          @endif
        <div>
          <ul id="user-menu">
            <!-- <li>
              <a href="http://localhost/retane_blog/wp-login.php?log=<?php //echo $datses['us']; ?>&pwd=<?php echo $datses['pd']; ?>" target="_blank"><span class="rulycon-wordpress"></span> Blog</a>
            </li> -->

                <li><a href="{{URL::to('account')}}">Kelola Akun</a></li>

            <li><a href="{{ URL::route('index_per_uu') }}">Peraturan Perundang-undangan</a></li>
            <li><a href="{{URL::to('pelembagaan')}}">Pelembagaan</a></li>
            <li><a href="{{URL::to('BantuanHukum')}}">Bantuan Hukum</a></li>

              @if($user != null)
                <li><a href="{{URL::to('registrasi')}}">Form Pendaftaran</a></li>
                <li>
                  <a href="#" role="menuitem" tab-index="-1"><span class="rulycon-settings"></span> User settings</a>
                </li>
                <li>
                  <a role="menuitem" tab-index="-1" href="{{URL::action('LoginController@signout')}}"><span class="rulycon-exit"></span> Sign
                  out</a>
                </li>
              @endif

              @if($user == null)
              {{-- form login--}}
              {{ Form::open(array('action' => 'LoginController@signin', 'method' => 'post', 'id'=>'user-sign-in-form', 'class' =>'front-form', 'autocomplete' => 'off')) }}

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

              <label for='username'>Username</label>
              {{
              Form::text('username', '', array(
              'class'=>'username validate[required] text-input',
              'id'=>'username',
              'placeholder'=>'ketikkan username di sini...'
              ))
              }}
              <label for='password'>Password</label>

              {{ Form::password('password', array('class'=>'password validate[required] text-input', 'id'=>'password','placeholder'=>'ketikkan password di sini...')) }}
                <span><button class="btn" id="btn-signin" type="submit">Sign in</button>

              {{ Form::close() }}

            <br>
            <a href="{{URL::to('forget')}}"> Forget Password? </a>
            @endif
          </ul>
        </div>

          <h6>© 2013 Direktorat Jenderal Kebudayaan Republik Indonesia</h6>
        </footer>
      </div>
      <div class="span17 main-content">
        @yield('content')
      </div>
    </div>
  </div>
</div>

@section('scripts')
<script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
<script src="{{asset('assets/js/dusk.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/jquery.ui.datepicker.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/DatatableReloadAjax.js')}}"></script>
@show
</body>
</html>
