<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layanan Hukum & Organisasi | Berita</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Registrasi Online Penyuluh Nasional">
  <meta name="author" content="Sangkuriang Internasional">

  <!-- Stylesheet files import here -->

  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.default.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/simplePagination.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive-tables-news.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycon.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycons.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/hukor-news.css')}}">

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

<body>
<div class="mainwrapper">
<div id="top-bar">
  <div class="header">
    <div class="container">
      <div class="logo">
        <img src="{{asset('assets/images/logo-only.png')}}" alt=""/>
        <h4><span>Layanan Hukum &amp; Organisasi</span><span>Kementerian Pendidikan dan Kebudayaan</span></h4>
      </div>
      <div class="headerinner">
        <ul class="headmenu pull-right">
          <li class="odd">
            <a href="{{URL::to('/')}}">
              <span class="rulycon-home"></span>
              <span class="headmenu-label" id="berita">Berita</span>
            </a>
          </li>
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" id="informasi">
              <span class="rulycon-newspaper"></span>
              <span class="headmenu-label">Informasi</span>
            </a>
          </li>
          <li class="odd">
            <a class="dropdown-toggle" data-toggle="dropdown" id="aplikasi">
              <span class="rulycon-wrench"></span>
              <span class="headmenu-label">Aplikasi</span>
            </a>
          </li>
          <li>
            <a href="{{URL::to('produkhukum')}}" id="produk_hukum">
              <span class="rulycon-notebook"></span>
              <span class="headmenu-label">Produk Hukum</span>
            </a>
          </li>
          <li>
            <a href="#" id="forum_diskusi">
              <span class="rulycon-notebook"></span>
              <span class="headmenu-label">Forum</span>
            </a>
          </li>
          <li class="odd">
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
        <span class="rulycon-file-3">&nbsp;</span><a href="#">{{$menus->nama_menu}}</a></li>
        @else
        <li class="has-child"><span class="rulycon-file-3">&nbsp;</span>
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
          <a href="#"><span class="rulycon-notebook"> &nbsp; Peraturan Perundang-undangan </span></a>
          <ul>
            <li><a href="{{ URL::to('/layanan/detail?id=1') }}">Peraturan Perundang-undangan</a></li>
            <li><a href="{{URL::route('puu.index')}}">Informasi dan Status Usulan</a></li>
          </ul>
        </li>
        <li class="has-child">
          <a href="#"><span class="rulycon-file-3"> &nbsp; Pelembagaan</span></a>
          <ul>
            <li><a href="{{ URL::to('/layanan/detail?id=2') }}">Pelembagaan</a></li>
            <li><a href="{{ URL::route('pelembagaan.index') }}">Informasi dan Status Usulan</a></li>
          </ul>
        </li>
        <li class="has-child">
          <a href="#"><span class="rulycon-file-4"> &nbsp; Ketatalaksanaan</span></a>
          <ul>
            <li><a href="{{ URL::to('/layanan/detail?id=4') }}">Sistem dan Prosedur</a></li>
            <li><a href="{{URL::route('sp.index')}}">Informasi dan Status Usulan Sistem dan Prosedur</a></li>

            <li><a href="{{ URL::to('/layanan/detail?id=5') }}">Analisis jabatan</a></li>
            <li><a href="{{URL::route('aj.index')}}">Informasi dan Status Usulan</a></li>
          </ul>
        </li>
        <li class="has-child">
          <a href="#"><span class="rulycon-stack"> &nbsp; Bantuan Hukum</span></a>
          <ul>
            <li><a href="{{ URL::to('/layanan/detail?id=3') }}">Bantuan Hukum</a></li>
            <li><a href="{{ URL::route('bantuan_hukum.index') }}">Informasi dan Status Usulan</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="content-wrapper">
  @yield('news-content')

</div>
<!--content-wrapper-->

    <div class="footer">
        <div class="container">
            <div class="rowsy">
                <ul>
                    <?php
                    $DAL = new DAL_Dikbud();
                    $link_dikbud = $DAL->GetAllLink();
                    ?>
                    @foreach($link_dikbud as $dikbud)
                    <?php $link = "http://" . $dikbud->link; ?>
                    <?php $assets = asset('assets/uploads/link/'.$dikbud->gambar); ?>
                        <li> <a href="{{ $link }}"><img src="{{ $assets }}"></a> </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="container">

    <div class="row-fluid">
      <?php $call = CallCenter::find(1); ?>
      <div class="span9">
        <div id="footer-menu-informasi" style="display: none">
          @foreach($menu as $menus)
          <ul class="footer-menu">

            @if($menus->submenu == null)
            <li>{{$menus->nama_menu}}</li>
            @else
            <li>{{$menus->nama_menu}}</li>
            @foreach($menus->submenu as $submenus)
            @if($submenus->layanan->id != null)
            <li><a href="{{ URL::to('/layanan/detail?id='. $submenus->layanan->id .'') }}">{{ $submenus->nama_submenu
                }}</a></li>
            @else
            <li><a href="#">{{ $submenus->nama_submenu }}</a></li>
            @endif
            @endforeach
            @endif

          </ul>
          @endforeach
        </div>
        <div id="footer-menu-aplikasi" style="display: none">
          <ul class="footer-menu">
            <li>Peraturan Perundang-undangan</li>
            <li><a href="{{ URL::to('/layanan/detail?id=1') }}"></a>Peraturan Perundang-undangan</li>
            <li><a href="{{URL::route('per_uu.informasi')}}">Informasi dan Status Usulan</a></li>
          </ul>
          <ul class="footer-menu">
            <li>Pelembagaan</li>
            <li><a href="{{ URL::to('/layanan/detail?id=2') }}">Pelembagaan</a></li>
            <li><a href="{{ URL::route('pelembagaan.index') }}">Informasi dan Status Usulan</a></li>
          </ul>
          <ul class="footer-menu">
            <li>Ketatalaksanaan</li>
            <li><a href="{{ URL::to('/layanan/detail?id=4') }}">Sistem dan Prosedur</a></li>
            <li><a href="{{URL::route('sp.index')}}">Informasi dan Status Usulan Sistem dan Prosedur</a></li>
            <li><a href="{{ URL::to('/layanan/detail?id=5') }}">Analisis Jabatan</a></li>
            <li><a href="{{URL::route('aj.index')}}">Informasi dan Status Usulan Analisis Jabatan</a></li>
          </ul>
          <ul class="footer-menu">
            <li>Bantuan Hukum</li>
            <li><a href="{{ URL::to('/layanan/detail?id=3') }}">Bantuan Hukum</a></li>
            <li><a href="{{ URL::route('bantuan_hukum.index') }}">Informasi dan Status Usulan</a></li>
          </ul>
        </div>
      </div>
      <div class="span3">
        <address>
          <span>Kementerian Pendidikan Dan Kebudayaan Republik Indonesia</span><br/>
          <br/>
          {{ $call->alamat }} <br/>
          <span class="rulycon-phone"></span> {{ $call->telp }}<br/>
          <span class="rulycon-print"></span> {{ $call->fax }}<br/>
          <!--                        Jawa Barat, Indonesia-->
        </address>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <p style="margin-top: 36px;"><span>&copy; 2014 Kementerian Pendidikan Dan Kebudayaan Republik Indonesia.</span>
        </p>
      </div>
    </div>
  </div>
</div>
<!--footer-->
</div>
<!--mainwrapper-->

@section('scripts')
<script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui-1.9.2.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-migrate-1.1.1.min.js')}}"></script>
<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.cookie.js')}}"></script>
<script src="{{asset('assets/js/jquery.uniform.min.js')}}"></script>
<script src="{{asset('assets/js/flot/jquery.flot.min.js')}}"></script>
<script src="{{asset('assets/js/flot/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('assets/js/responsive-tables-news.js')}}"></script>
<script src="{{asset('assets/js/custom-news.js')}}"></script>

<script src="{{asset('assets/js/jquery.ui.datepicker.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script>
  var $ = jQuery.noConflict();
  $(document).ready(function () {
    $("#main-carousel").carousel({
      interval: 5000,
      cycle: true
    });
  });

  $("#informasi").click(function () {
    $("#sub-informasi").show();
    $("#footer-menu-informasi").show();
    $("#footer-menu-aplikasi").hide();
    $("#sub-aplikasi").hide();
  });

  $("#aplikasi").click(function () {
    $("#sub-informasi").hide();
    $("#footer-menu-aplikasi").show();
    $("#footer-menu-informasi").hide();
    $("#sub-aplikasi").show();
  });

  $('#forum_diskusi').click(function () {
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
  !function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
    if (!d.getElementById(id)) {
      js = d.createElement(s);
      js.id = id;
      js.src = p + "://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);
    }
  }(document, "script", "twitter-wjs");
</script>
<script src="{{asset('assets/js/customize-twitter-1.1.min.js')}}"></script>
<script>
  var twitterWidgetOptions = {
    "url": "{{asset('assets/js/custom-twitter.css')}}"
  };
  CustomizeTwitterWidget(twitterWidgetOptions);
</script>
@show
</body>
</html>
