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
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.dataTables.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.ui.datepicker.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-embedding-standard.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dikbud.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycon.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycons.min.css')}}">

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
    var baseUrl = '{{URL::to(' / ')}}';
  </script>

</head>
<body class="main-layout">
<?php $datses = Session::get('key'); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span24">
      <div class="span6 sidebar">
        <?php $user = Auth::user(); ?>
        <header>
          <img src="{{asset('assets/img/logo-kemendiknas.png')}}" alt="Kebudayaan Indonesia">
        </header>

        @if($user != null)
        <p id="username" class="welcome-message user-not-null"><span>Selamat datang, <span id="name"><?php echo $user->username; ?></span></span></p>
        @if($user != null)
        <ul class="welcome-message user-not-null-links">
          <li><a href="{{URL::to('setting')}}" role="menuitem" tab-index="-1"><span class="rulycon-settings"></span>User settings</a></li>
          <li><a role="menuitem" tab-index="-1" href="{{URL::action('LoginController@signout')}}"><span class="rulycon-exit"></span>Sign out</a></li>
        </ul>
        @endif
        @else
        <p id="username" class="welcome-message">Selamat datang <span id="name">guest</span></p>
          @if($user == null)
          {{-- form login--}}
          {{ Form::open(array('action' => 'LoginController@signin', 'method' => 'post', 'id'=>'user-sign-in-form',
          'class' =>'front-form', 'autocomplete' => 'off')) }}

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

          {{
          Form::text('username', '', array(
          'class'=>'username validate[required] text-input',
          'id'=>'username',
          'placeholder'=>'ketikkan username di sini...'
          ))
          }}
          {{ Form::password('password', array('class'=>'password validate[required] text-input',
          'id'=>'password','placeholder'=>'ketikkan password di sini...')) }}
          <button class="btn" id="btn-signin" type="submit">Sign in</button>
          <a href="{{URL::to('forget')}}"> Lupa password? </a>
          <a href="{{URL::to('registrasi')}}" class="pull-right">Belum memiliki akun?</a>
          {{ Form::close() }}
          @endif
        @endif
        <div>
          <ul id="user-menu">
            <!-- <li>
              <a href="http://localhost/retane_blog/wp-login.php?log=<?php //echo $datses['us']; ?>&pwd=<?php echo $datses['pd']; ?>" target="_blank"><span class="rulycon-wordpress"></span> Blog</a>
            </li> -->

            <li class="menu-header">Informasi</li>
            <!--            <li><a href="{{URL::to('account')}}">Kelola Akun</a></li>-->
<<<<<<< HEAD
            <li class="active"><a href="{{ URL::to('layanan_ketatalaksanaan/index') }}"><span class="rulycon-quill"></span>Layanan Ketatalaksanaan</a>
            <ul style="display: block;">
                <li><a href="{{ URL::to('layanan_ketatalaksanaan/spk') }}"><span ></span>Sistem dan Prosedur Kerja</a></li>
                <li><a href="{{ URL::to('layanan_ketatalaksanaan/smm') }}"><span ></span>Sistem dan Manajemen Mutu</a></li>
                <li><a href="{{ URL::to('layanan_ketatalaksanaan/analisis_jabatan') }}"><span ></span>Analisis Jabatan</a></li>
                <li><a href="{{ URL::to('layanan_ketatalaksanaan/pbk') }}"><span ></span>Perhitungan Beban Kerja</a></li>  
                <li><a href="{{ URL::to('layanan_ketatalaksanaan/tata_nilai') }}"><span ></span>Tata Nilai & Budaya Kerja Organisasi</a></li>  
                <li><a href="{{ URL::to('layanan_ketatalaksanaan/pelayanan_publik') }}"><span ></span>Pelayanan Publik</a></li>  
                <li><a href="{{ URL::to('layanan_ketatalaksanaan/tnd') }}"><span ></span>Tata Naskah Dinas</a></li>  
            </ul>
            </li>


            <li><a href="{{ URL::to('layanan_kelembagaan/index') }}"><span class="rulycon-library"></span>Layanan Kelembagaan</a></li>
            <li><a href="{{ URL::to('layanan_kelembagaan/pembentukan') }}"><span class="rulycon-spinner-3"></span>Layanan Pembentukan</a></li>
            <li><a href="{{ URL::to('layanan_kelembagaan/penataan') }}"><span class="rulycon-paragraph-center"></span>Layanan Penataan</a></li>
            <li><a href="{{ URL::to('layanan_kelembagaan/penutupan') }}"><span class="rulycon-checkbox-unchecked"></span>Layanan Penutupan</a></li>
            <li><a href="{{ URL::to('layanan_kelembagaan/statuta') }}"><span class="rulycon-strikethrough"></span>Layanan Statuta</a></li>
            <li><a href="#"><span class="rulycon-books"></span>Layanan Bantuan Hukum</a></li>
            <li><a href="#"><span class="rulycon-book"></span>Layanan Peraturan Perundang-Undangan</a></li>
            <li><a href="#"><span class="rulycon-bubbles"></span>Forum Diskusi</a></li>
            <li><a href="{{ URL::to('callcenter') }}"><span class="rulycon-phone"></span>Call Center</a></li>
=======
            <li id="menu-ketatalaksanaan"><a href="#"><span class="rulycon-quill"></span>Layanan Ketatalaksanaan</a></li>
            <li id="menu-kelembagaan">
              <div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                      <span class="rulycon-library"></span>Layanan Kelembagaan
                      <span class="rulycon-menu-2 pull-right"></span>
                    </a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <ul>
                        <li id="menu-kelembagaan-pembentukan"><a href="{{ URL::to('layanan_kelembagaan/pembentukan') }}"><span class="rulycon-spinner-3"></span>Layanan Pembentukan</a></li>
                        <li id="menu-kelembagaan-penataan"><a href="{{ URL::to('layanan_kelembagaan/penataan') }}"><span class="rulycon-paragraph-center"></span>Layanan Penataan</a></li>
                        <li id="menu-kelembagaan-penutupan"><a href="{{ URL::to('layanan_kelembagaan/penutupan') }}"><span class="rulycon-checkbox-unchecked"></span>Layanan Penutupan</a></li>
                        <li id="menu-kelembagaan-statuta"><a href="{{ URL::to('layanan_kelembagaan/statuta') }}"><span class="rulycon-strikethrough"></span>Layanan Statuta</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li id="menu-layanan-bantuan-hukum"><a href="#"><span class="rulycon-books"></span>Layanan Bantuan Hukum</a></li>
            <li id="menu-layanan-peraturan-perundangan"><a href="#"><span class="rulycon-book"></span>Layanan Peraturan Perundang-Undangan</a></li>
            <li id="menu-forum"><a href="#"><span class="rulycon-bubbles"></span>Forum Diskusi</a></li>
            <li id="menu-call-center"><a href="#"><span class="rulycon-phone"></span>Call Center</a></li>
>>>>>>> 1d65c93903d87a856efd93d71820da3a98a88e0b

            <li class="menu-header">Aplikasi</li>
            <li id="menu-peraturan-perundangan"><a href="{{ URL::route('pengajuan_per_uu') }}"><span class="rulycon-pilcrow"></span>Peraturan Perundang-undangan</a></li>
            <li id="menu-pelembagaan"><a href="{{URL::to('pelembagaan')}}"><span class="rulycon-office"></span>Pelembagaan</a></li>
            <li id="menu-bantuan-hukum"><a href="{{URL::to('BantuanHukum')}}"><span class="rulycon-books"></span>Bantuan Hukum</a></li>
          </ul>
        </div>
        <h6 id="copyright">© 2014 Direktorat Jenderal Kebudayaan Republik Indonesia</h6>
        </footer>
      </div>
      <div class="span18 main-content">
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
