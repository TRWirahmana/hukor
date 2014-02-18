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
    var baseUrl = '{{ URL::to('/') }}';

//      alert(baseUrl);
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
        <p id="username" class="welcome-message user-not-null"><span>Selamat datang, <span id="name"><?php echo $user->pengguna->nama_lengkap; ?></span></span></p>

        <ul class="welcome-message user-not-null-links">
          <li><a href="{{URL::to('setting')}}" role="menuitem" tab-index="-1"><span class="rulycon-settings"></span>User settings</a></li>
          <li><a role="menuitem" tab-index="-1" href="{{URL::action('LoginController@signout')}}"><span class="rulycon-exit"></span>Sign out</a></li>
        </ul>
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
          'placeholder'=>'ketikkan email anda di sini...'
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
              <li id="menu-beranda"><a href="{{URL::to('/')}}"><span class="rulycon-books"></span>Beranda</a></li>
              <li id="menu-produk-hukum"><a href="#"><span class="rulycon-book"></span>Produk Hukum</a></li>

              <!-- Menu Layanan(Dinamisasi)-->
              <?php $menu = Menu::all();
//              echo $menu;exit;
              $no = 1; ?>
              @foreach($menu as $menus)
              <li id="menu-{{ $menus->id }}" >
                  <div class="accordion{{$no}}" id="accordion{{$no}}">
                      <div class="accordion-group">
                          <div class="accordion-heading">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion{{$no}}" href="#collapse{{$no}}">
                                  <span class="rulycon-quill"></span> {{$menus->nama_menu}}
                                  <span class="rulycon-menu-2 pull-right"></span>
                              </a>
                          </div>
                          @if($menus->submenu != null)

                              <div id="collapse{{$no}}" class="accordion-body collapse">
                                  <div class="accordion-inner">
                                      <ul>
                                          @foreach($menus->submenu as $submenus)
                                              @if($submenus->layanan->id != null)
                                                <li><a href="{{ URL::to('/layanan/detail?id='. $submenus->layanan->id .'') }}"><span class="rulycon-earth"></span> {{ $submenus->nama_submenu }}</a></li>
                                              @else
                                                <li><a href="#"><span class="rulycon-earth"></span> {{ $submenus->nama_submenu }}</a></li>
                                              @endif
                                          @endforeach
                                      </ul>
                                  </div>
                              </div>
                          @endif
                      </div>
                  </div>
              </li>
                <?php $no++; ?>
              @endforeach

                <!-- END Menu Layanan -->

<!--            <li id="menu-layanan-bantuan-hukum"><a href="#"><span class="rulycon-books"></span>Layanan Bantuan Hukum</a></li>-->
<!--            <li id="menu-layanan-peraturan-perundangan"><a href="#"><span class="rulycon-book"></span>Layanan Peraturan Perundang-Undangan</a></li>-->
            @if (null != AppConfig::find('enable_forum') && AppConfig::find('enable_forum')->value == "true")
              <li id="menu-forum"><a href="{{ URL::to('forumdiskusi') }}"><span class="rulycon-bubbles"></span>Forum Diskusi</a></li>
            @endif
            <li id="menu-call-center"><a href="{{ URL::to('callcenter') }}"><span class="rulycon-phone"></span>Call Center</a></li>

            <li class="menu-header">Aplikasi</li>
            <li id="menu-peraturan-perundangan"> <!-- <a href="{{ URL::route('pengajuan_per_uu') }}"><span class="rulycon-pilcrow"></span>Peraturan Perundang-undangan</a></li> -->
              <div class="accordion" id="accordion3">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse3">
                      <span class="rulycon-office"></span>Peraturan Perundang-undangan
                      <span class="rulycon-menu-2 pull-right"></span>
                    </a>
                  </div>
                  <div id="collapse3" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <ul>
                          <li id="menu-peruu-info"><a href="{{ URL::to('/layanan/detail?id=1') }}"><span class="rulycon-checkbox-unchecked"></span>Peraturan Perundang-Undangan</a></li>
                          @if($user->role_id == 2)
                          <li id="menu-peruu-usulan"><a href="{{ URL::route('pengajuan_per_uu')  }}"><span class="rulycon-checkbox-unchecked"></span>Lembar Usulan</a></li>
                          @endif
                        <li id="menu-peruu-informasi"><a href="{{URL::route('per_uu.informasi')}}"><span class="rulycon-strikethrough"></span>Informasi dan Status Usulan</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>


            <li id="menu-pelembagaan">
              <div class="accordion" id="accordion5">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion5" href="#collapse5">
                      <span class="rulycon-book"></span>Pelembagaan
                      <span class="rulycon-menu-2 pull-right"></span>
                    </a>
                  </div>
                  <div id="collapse5" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <ul>
                          <li id="menu-peruu-info"><a href="{{ URL::to('/layanan/detail?id=2') }}"><span class="rulycon-checkbox-unchecked"></span>Pelembagaan</a></li>
                        @if($user->role_id == 2)
                        <li id="menu-pelembagaan-usulan"><a href="{{URL::route('create_pelembagaan')}}"><span class="rulycon-checkbox-unchecked"></span>Lembar Usulan</a></li>
                        @endif
                          <li id="menu-pelembagaan-informasi"><a href="{{ URL::route('informasi_pelembagaan') }}"><span class="rulycon-strikethrough"></span>Informasi dan Status Usulan</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li id="menu-ketatalaksanaan">
              <div class="accordion" id="accordion4">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse4">
                      <span class="rulycon-book"></span>Ketatalaksanaan
                      <span class="rulycon-menu-2 pull-right"></span>
                    </a>
                  </div>
                  <div id="collapse4" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <ul>
                        <li id="menu-ketatalaksanaan-usulan"><a href="{{URL::route('usulan_sistem_prosedur')}}"><span class="rulycon-checkbox-unchecked"></span>Lembar Usulan Sistem dan Prosedur</a></li>
                        <li id="menu-ketatalaksanaan-usulan"><a href="{{URL::route('usulan_analisis_jabatan')}}"><span class="rulycon-checkbox-unchecked"></span>Lembar Usulan Analisis Jabatan</a></li>
                        <li id="menu-pelembagaan-informasi"><a href="{{URL::route('informasi_sistem_prosedur')}}"><span class="rulycon-strikethrough"></span>Informasi dan Status Usulan Sistem dan Prosedur</a></li>
                        <li id="menu-pelembagaan-informasi"><a href="{{URL::route('informasi_analisis_jabatan')}}"><span class="rulycon-strikethrough"></span>Informasi dan Status Usulan Analisis Jabatan</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

              @if($user->role_id == 2)
            <li id="menu-bantuan-hukum"><a href="{{ URL::to('BantuanHukum') }}"><span class="rulycon-books"></span>Bantuan Hukum</a></li>
              @else
              <li id="menu-bantuan-hukum"><a href="{{ URL::to('/layanan/detail?id=3') }}"><span class="rulycon-books"></span>Bantuan Hukum</a></li>
              @endif
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
