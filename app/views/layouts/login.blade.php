<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layanan Biro Hukum dan Organisasi | Berita</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Registrasi Online Penyuluh Nasional">
  <meta name="author" content="Sangkuriang Internasional">

  <!-- Stylesheet files import here -->

  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.default.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycon.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycons.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/hukor-news.css')}}">

  <style type="text/css">
    .container-fluid { padding: 0; }
    .footer {
      display: block;
      width: 100%;
      position: absolute;
      bottom: 0;
    }
    .error-message p {
      width: 420px;
      font-size: 14px;
      margin: 20px auto;
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
    var baseUrl = '{{URL::to(' / ')}}';
  </script>
</head>

<body>
<div class="mainwrapper">
<div id="top-bar">
  <div id="social-links">
    <div class="container" >
      <p class="pull-right">
        <a href="#"><span class="rulycon-twitter"></span></a>
        <a href="#"><span class="rulycon-feed-3"></span></a>
        <input type="text" placeholder="search..."/>
        <button class="btn btn-primary"><span class="rulycon-search"></span></button>
      </p>
    </div>
  </div>
  <div class="header">
    <div class="container">
      <div class="logo">
        <a href="{{URL::to('/')}}">
          <img src="{{asset('assets/images/logo-only.png')}}" alt=""/>
          <h4 style="margin-top: 5px;">
            <span>Biro Hukum dan Organisasi</span>
            <span>Kementerian Pendidikan dan Kebudayaan</span>
            <span>Republik Indonesia</span>
          </h4>
        </a>
      </div>
      <div class="headerinner">
        <ul class="headmenu pull-right">
          <li class="odd">
          </li>
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" id="aplikasi">
              <span class="rulycon-drawer-3"></span>
              <span class="headmenu-label">Aplikasi</span>
            </a>
          </li>

          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" id="informasi">
              <span class="rulycon-notebook"></span>
              <span class="headmenu-label">Informasi</span>
            </a>
          </li>

          <li>
            <a href="{{URL::to('produkhukum')}}" id="produk_hukum">
              <span class="rulycon-books"></span>
              <span class="headmenu-label">Peraturan</span>
            </a>
          </li>

          <li class="odd">
            <a href="{{URL::to('detailprofile')}}" id="profile">
              <span class="rulycon-profile"></span>
              <span class="headmenu-label">Profil</span>
            </a>
          </li>

          <li>
            <a href="#" id="forum_diskusi">
              <span class="rulycon-bubbles-2"></span>
              <span class="headmenu-label">Forum</span>
            </a>
          </li>
          <li>
            <a href="{{URL::to('site')}}">
              <span class="rulycon-user"></span>
              <span class="headmenu-label" id="login">Login</span>
            </a>
          </li>
        </ul>
        <!--headmenu-->
      </div>
    </div>
  </div>

  <div class="sub-header">
    <div class="container">
      <ul class="sub-menu" id="sub-informasi" style="display: none">
        <?php $menu = Menu::all();
        $s = 1; ?>
        @foreach($menu as $menus)
        @if($menus->submenu == null)
        <span class="rulycon-notebook">&nbsp;</span><a href="#">{{$menus->nama_menu}}</a></li>
        @else
        <li class="has-child"><span class="rulycon-notebook">&nbsp;</span>
          @if($menus->submenu != null && $menus->layanan == null)
          <a href="#">{{$menus->nama_menu}}</a>
          @else
          <a href="{{ URL::to('/layanan/detail?id='. $menus->layanan->id .'') }}">{{$menus->nama_menu}}</a>
          @endif
          <ul>
            @foreach($menus->submenu as $submenus)
            @if($submenus->layanan->id != null)
            <li><a href="{{ URL::to('/layanan/detail?id='. $submenus->layanan->id .'') }}">{{ $submenus->nama_submenu
                }}</a></li>
            @else
            <li><a href="#">{{ $submenus->nama_submenu }}</a></li>
            @endif
            @endforeach
          </ul>
        </li>
        @endif
        @endforeach

      </ul>

      <ul class="sub-menu" id="sub-aplikasi" style="display: none">
        <li class="has-child">
          <a href="#"><span class="rulycon-drawer-3"> &nbsp; Peraturan Perundang-undangan </span></a>
          <ul>
            <li><a href="{{ URL::to('/layanan/detail?id=1') }}">Peraturan Perundang-undangan</a></li>
            <li><a href="{{URL::route('puu.index')}}">Informasi dan Status Usulan</a></li>
          </ul>
        </li>
        <li class="has-child">
          <a href="#"><span class="rulycon-drawer-3"> &nbsp; Pelembagaan</span></a>
          <ul>
            <li><a href="{{ URL::to('/layanan/detail?id=2') }}">Pelembagaan</a></li>
            <li><a href="{{ URL::route('pelembagaan.index') }}">Informasi dan Status Usulan</a></li>
          </ul>
        </li>

        <li class="has-child">
          <a href="#"><span class="rulycon-drawer-3"> &nbsp; Bantuan Hukum</span></a>
          <ul>
            <li><a href="{{ URL::to('/layanan/detail?id=3') }}">Bantuan Hukum</a></li>
            <li><a href="{{ URL::route('bantuan_hukum.index') }}">Informasi dan Status Usulan</a></li>
          </ul>
        </li>

        <li class="has-child">
          <a href="#"><span class="rulycon-drawer-3"> &nbsp; Ketatalaksanaan</span></a>
          <ul>
            <li><a href="{{ URL::to('/layanan/detail?id=4') }}">Sistem dan Prosedur</a></li>
            <li><a href="{{URL::route('sp.index')}}">Informasi dan Status Usulan Sistem dan Prosedur</a></li>

            <li><a href="{{ URL::to('/layanan/detail?id=5') }}">Analisis jabatan</a></li>
            <li><a href="{{URL::route('aj.index')}}">Informasi dan Status Usulan</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</div>

<div class="content-wrapper">
  <div class="maincontent">
    <div class="container">
      <div class="row-fluid">
        <div class="container error-message" style="width: 960px; text-align: center; margin-top: 40px;">
          <img src="{{asset('assets/img/error-404.png')}}" alt="" width="320"/>
          <p>Anda dapat mengakses halaman lain melalui menu di atas atau klik <a href="{{ URL::to('/') }}">tautan ini</a> untuk kembali ke halaman utama.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--content-wrapper-->

<div class="footer">
  <div class="container" style="width: 960px;">
    <div class="row-fluid">
      <div class="span12">
        <p class="text-center"><span>&copy; 2014 Kementerian Pendidikan Dan Kebudayaan Republik Indonesia.</span></p>
      </div>
    </div>
  </div>
</div>
<!--footer-->
</div>
<!--mainwrapper-->

<!-- dialog box -->
<div id="dialog" title="Forum" style="display: none">
  <p>Silakan klik LOGIN terlebih dahulu untuk masuk ke dalam Forum. Jika belum mempunyai akun, silakan klik DAFTAR.</p>
</div>

@section('scripts')
<script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-migrate-1.1.1.min.js')}}"></script>
<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
@show
</body>
</html>
