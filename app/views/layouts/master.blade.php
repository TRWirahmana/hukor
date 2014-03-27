<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layanan Biro Hukum dan Organisasi</title>
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
  <link rel="shortcut icon" href="{{asset('assets/ico/favicon.ico')}}">

  <script type="text/javascript">
    var baseUrl = '{{ URL::to('/') }}';

    //      alert(baseUrl);
  </script>

</head>
<body class="main-layout">
<?php $datses = Session::get('key'); ?>
<div class="container-fluid">
<div class="row-fluid">
<header id="user-header">
  @include('user-header')
</header>
<div class="span24" style="margin-left: 0;">
<div class="span6 sidebar">
<?php $user = Auth::user(); ?>

@if($user != null)
<p id="username" class="welcome-message user-not-null"><span>Selamat datang, <span
      id="name"><?php echo $user->pengguna->nama_lengkap; ?></span></span></p>

<div class="select-on-mobile">

</div>

<ul class="welcome-message user-not-null-links">
  <li><a href="{{URL::to('setting')}}" role="menuitem" tab-index="-1"><span class="rulycon-cog"></span>Pengaturan
      Akun</a></li><li><a role="menuitem" tab-index="-1" href="{{URL::action('LoginController@signout')}}"><span
        class="rulycon-exit"></span>Keluar</a></li>
</ul>
@else
<p id="username" class="welcome-message">Selamat datang <span id="name"></span></p>
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
'placeholder'=>'Masukan email anda di sini...'
))
}}
{{ Form::password('password', array('class'=>'password validate[required] text-input',
'id'=>'password','placeholder'=>'Masukan password di sini...')) }}
<button class="btn" id="btn-signin" type="submit">Masuk</button>
<a href="{{URL::to('forget')}}"> Lupa password </a>
<a href="{{URL::to('registrasi')}}" class="pull-right">Daftar</a>
{{ Form::close() }}
@endif
@endif
<div>
<ul id="user-menu">
<!-- <li>
              <a href="http://localhost/retane_blog/wp-login.php?log=<?php //echo $datses['us']; ?>&pwd=<?php echo $datses['pd']; ?>" target="_blank"><span class="rulycon-wordpress"></span> Blog</a>
            </li> -->
<li id="menu-beranda"><a href="{{URL::to('/')}}"><span class="rulycon-home-2"></span>Beranda</a></li>
<li id="menu-profile"><a href="{{URL::to('detailprofile')}}"><span class="rulycon-profile"></span>Profil</a></li>
<li id="menu-produk-hukum"><a href="{{URL::to('produkhukum')}}"><span class="rulycon-books"></span>Produk Hukum</a>
</li>
@if (null != AppConfig::find('enable_forum') && AppConfig::find('enable_forum')->value == "true")
<li id="menu-forum"><a href="#"><span class="rulycon-bubbles"></span>Forum</a></li>
@endif
<li id="menu-call-center"><a href="{{ URL::to('callcenter') }}"><span class="rulycon-address-book"></span>Kontak
    Kami</a>
</li>

<li class="menu-header">Layanan</li>
<!--              <li id="menu-beranda"><a href="{{URL::to('/')}}"><span class="rulycon-home-2"></span>Beranda</a></li>-->
<!--              <li id="menu-produk-hukum"><a href="{{URL::to('produkhukum')}}"><span class="rulycon-book"></span>Produk Hukum</a></li>-->
<!-- Menu Layanan(Dinamisasi)-->

<?php $no = 1;
$allmenu = Menu::all();?>

@foreach($allmenu as $menus)
<?php $as = Submenu::leftJoin('menu', 'sub_menu.menu_id', '=', 'menu.id')
  ->where('menu.id', '=', $menus['id'])
  ->select('menu.id AS id', 'menu.nama_menu AS menu', 'sub_menu.id AS sub_id')
  ->get(); ?>

<li id="menu-{{ $menus['id'] }}">
  <div class="accordion" id="accordion{{$no}}">
    <div class="accordion-group">
      <div class="accordion-heading">

        @if($as['0'] != null)

        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion{{$no}}" href="#collapse{{$no}}">
          <span class="rulycon-notebook"></span>{{$menus['nama_menu']}}
          <span class="rulycon-menu-2 pull-right"></span>
        </a>
        @else
        <?php $laysmen = Layanan::where('menu_id', '=', $menus['id'])->get(); ?>
        @if($laysmen['0']['id'] != null)
        <a class="accordion-toggle" href="{{ URL::to('/layanan/detail?id='. $laysmen['0']['id'] .'') }}">
          <span class="rulycon-notebook"></span>{{$menus['nama_menu']}}
          <span class="rulycon-menu-2 pull-right"></span>
        </a>
        @else
        <a class="accordion-toggle" href="#">
          <span class="rulycon-notebook"></span>{{$menus['nama_menu']}}
          <span class="rulycon-menu-2 pull-right"></span>
        </a>
        @endif
        @endif
      </div>
      <?php $subs = Submenu::leftJoin('layanan', 'sub_menu.id', '=', 'layanan.submenu_id')
        ->where('sub_menu.menu_id', '=', $menus['id'])
        ->select('layanan.id AS id', 'sub_menu.nama_submenu AS sub')
        ->get();

      $subs->toArray();?>
      @if($subs != null)

      <div id="collapse{{$no}}" class="accordion-body collapse">
        <div class="accordion-inner">
          <ul>
            @foreach($subs as $submenus)
            @if($submenus['id'] != null)
            <li><a href="{{ URL::to('/layanan/detail?id='. $submenus['id'] .'') }}"><span
                  class="rulycon-list-2"></span> {{ $submenus['sub'] }}</a></li>
            @else
            <li><a href="#"><span class="rulycon-list-2"></span> {{ $submenus['sub'] }}</a></li>
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


<li class="menu-header">Aplikasi</li>
<li id="menu-peraturan-perundangan">
  <!-- <a href="{{ URL::route('pengajuan_per_uu') }}"><span class="rulycon-pilcrow"></span>Peraturan Perundang-undangan</a></li> -->
  <div class="accordion" id="accordion3">
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-parent="#accordion4" href="{{ URL::to('/layanan/detail?id=1') }}">
          <span class="rulycon-drawer-3"></span>Peraturan Perundang-undangan
          <span class="rulycon-menu-2 pull-right"></span>
        </a>
      </div>
      <div id="collapse10" class="accordion-body collapse">
        <div class="accordion-inner">
          <ul>
            <li id="menu-peruu-info"><a href="{{ URL::to('/layanan/detail?id=1') }}"><span
                  class="rulycon-stack"></span>Informasi</a></li>
            @if($user->role_id == 2)
            <li id="menu-peruu-usulan"><a href="{{ URL::route('puu.create')  }}"><span class="rulycon-stack"></span>Lembar
                Usulan</a></li>
            @endif
            <li id="menu-peruu-informasi"><a href="{{URL::route('puu.index')}}"><span class="rulycon-stack"></span>Status
                Usulan</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</li>

<li id="menu-bantuan-hukum">
    <div class="accordion" id="accordion6">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-parent="#accordion6" href="{{ URL::to('/layanan/detail?id=3') }}">
                    <span class="rulycon-drawer-3"></span>Bantuan Hukum
                    <span class="rulycon-menu-2 pull-right"></span>
                </a>
            </div>
            <div id="collapse13" class="accordion-body collapse">
                <div class="accordion-inner">
                    <ul>
                        <li id="menu-bantuan-hukum-info"><a href="{{ URL::to('/layanan/detail?id=3') }}"><span
                                    class="rulycon-stack"></span>Informasi</a></li>
                        @if($user->role_id == 2)
                        <li id="menu-bantuan-hukum-usul"><a href="{{ URL::route('bantuan_hukum.create') }}"><span
                                    class="rulycon-stack"></span>Lembar Usulan</a></li>
                        @endif
                        <li id="menu-banhuk-informasi"><a href="{{ URL::to('BantuanHukum') }}"><span class="rulycon-stack"></span>Status
                                Usulan</a></li>
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
        <a class="accordion-toggle" data-parent="#accordion5" href="{{ URL::to('/layanan/detail?id=2') }}">
          <span class="rulycon-drawer-3"></span>Pelembagaan
          <span class="rulycon-menu-2 pull-right"></span>
        </a>
      </div>
      <div id="collapse11" class="accordion-body collapse">
        <div class="accordion-inner">
          <ul>
            <li id="menu-pelembagaan-info"><a href="{{ URL::to('/layanan/detail?id=2') }}"><span
                  class="rulycon-stack"></span>Informasi</a></li>
            @if($user->role_id == 2)
            <li id="menu-pelembagaan-usulan"><a href="{{URL::route('pelembagaan.create')}}"><span
                  class="rulycon-stack"></span>Lembar Usulan</a></li>
            @endif
            <li id="menu-pelembagaan-informasi"><a href="{{ URL::route('pelembagaan.index') }}"><span
                  class="rulycon-stack"></span>Status Usulan</a></li>
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
        <a class="accordion-toggle" data-parent="#accordion4" href="{{ URL::to('/ketatalaksanaan') }}">
          <span class="rulycon-drawer-3"></span>Ketatalaksanaan
          <span class="rulycon-menu-2 pull-right"></span>
        </a>
      </div>
<!--      <div id="collapse12" class="accordion-body collapse">-->
<!--        <div class="accordion-inner">-->
<!--          <ul>-->
<!--            <li id="menu-prosedur-info"><a href="{{ URL::to('/layanan/detail?id=4') }}"><span-->
<!--                  class="rulycon-stack"></span>Informasi</a>-->
<!--            </li>-->
<!--              @if($user->role_id == 2)-->
<!--              <li id="menu-ketatalaksanaan-usulan"><a href="{{URL::route('sp.create')}}"><span-->
<!--                          class="rulycon-stack"></span>Lembar Usulan</a></li>-->
<!--              @endif-->
<!--            <li id="menu-pelembagaan-informasi2"><a href="{{URL::route('sp.index')}}"><span-->
<!--                  class="rulycon-stack"></span>Status Usulan</a>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </div>-->
<!--      </div>-->
    </div>
  </div>
</li>


<!--              <li id="menu-faq">-->
<!--                  <div class="accordion" id="accordion7">-->
<!--                      <div class="accordion-group">-->
<!--                          <div class="accordion-heading">-->
<!--                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion6" href="#collapse14">-->
<!--                                  <span class="rulycon-info"></span>FAQ-->
<!--                                  <span class="rulycon-menu-2 pull-right"></span>-->
<!--                              </a>-->
<!--                          </div>-->
<!--                          <div id="collapse14" class="accordion-body collapse">-->
<!--                              <div class="accordion-inner">-->
<!--                                  <ul>-->
<!--                                      <li id="menu-peruu-info"><a href="{{ URL::to('/layanan/detail?id=1') }}"><span class="rulycon-checkbox-unchecked"></span>Peraturan Perundang-Undangan</a></li>-->
<!--                                      <li id="menu-pelembagaan-info"><a href="{{ URL::to('/layanan/detail?id=2') }}"><span class="rulycon-checkbox-unchecked"></span>Pelembagaan</a></li>-->
<!--                                      <li id="menu-sistem-info"><a href="{{ URL::to('/layanan/detail?id=4') }}"><span class="rulycon-checkbox-unchecked"></span>Sistem dan Prosedur</a></li>-->
<!--                                      <li id="menu-analisis-info"><a href="{{ URL::to('/layanan/detail?id=5') }}"><span class="rulycon-checkbox-unchecked"></span>Analisis Jabatan</a></li>-->
<!--                                      <li id="menu-bantuan-hukum-info"><a href="{{ URL::to('/layanan/detail?id=3') }}"><span class="rulycon-checkbox-unchecked"></span>Bantuan Hukum</a></li>-->
<!--                                  </ul>-->
<!--                              </div>-->
<!--                          </div>-->
<!--                      </div>-->
<!--                  </div>-->
<!--              </li>-->
</ul>
</div>
<h6 id="copyright">© 2014 Biro Hukum dan Organisasi</h6>
</footer>
</div>
<div class="span18 main-content" style="padding-top: 120px;">
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
<script>
  $('#menu-forum').click(function () {
    var user = '<?php echo Auth::user(); ?>';

    if (user) {
      window.location.replace("{{ URL::to('forumdiskusi') }}");
    }
    else {
      var r = confirm("Anda Belum Login. Harap Login Terlebih Dahulu. Klik OK Untuk Registrasi Jika Anda Belum Memiliki Akun.");
      if (r == true) {
        window.location.replace("{{URL::to('registrasi')}}");
      }
    }

  });


</script>
<script>
  $(document).ready(function() {
    $("<select />", {
      "id": "select-menu-helper"
    }).appendTo(".select-on-mobile");

    $("<option />", {
      "selected": "selected",
      "value": "",
      "text": "~ Please select menu ~"
    }).appendTo("#select-menu-helper");

    $("<optgroup />", {
      "id": "optgroup-label-user-menu",
      "label": "Menu user"
    }).appendTo("#select-menu-helper");

    $(".welcome-message.user-not-null-links a").each(function() {
      var userMenuLinks = $(this);
      $("<option />", {
        "value": userMenuLinks.attr("href"),
        "text": userMenuLinks.text()
      }).appendTo("#optgroup-label-user-menu");
    });

    $("<optgroup />", {
      "id": "optgroup-label-app-menu",
      "label": "Menu aplikasi"
    }).appendTo("#select-menu-helper");

    $("#menu-beranda a, #menu-profile a, #menu-produk-hukum a, #menu-call-center a").each(function() {
      var appMenuLinks = $(this);
      $("<option />", {
        "value": appMenuLinks.attr("href"),
        "text": appMenuLinks.text()
      }).appendTo("#optgroup-label-app-menu");
    });

    $(".select-on-mobile > #select-menu-helper").change(function() {
      window.location = $(this).find("option:selected").val();
    });

    // THE MOST COMPLICATED THINGS IN THIS PAGE BEGINS HERE
    /*$(".accordion-toggle").each(function() {
      var listOfOptGroup = $(this);
      $("<optgroup />", {
        "label": listOfOptGroup.text()
      }).appendTo("#select-menu-helper");

      $(".accordion-inner a").each(function() {
        var listOfLinks = $(this);
        $("<option />", {
          "value": listOfLinks.attr("href"),
          "text": listOfLinks.text()
        }).appendTo("#select-menu-helper");
      });

    });*/
  });
</script>
@show
</body>
</html>
