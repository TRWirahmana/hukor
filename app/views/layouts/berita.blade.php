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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/hukor-news.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.dataTables.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive-tables-news.css')}}">
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

<body>
<div class="mainwrapper">
    <div id="top-bar">
        <div class="header">
            <div class="container">
                <div class="logo">
                    <img src="{{asset('assets/img/logo-kemendiknas-white-text.png')}}" alt=""/>
                </div>
                <div class="headerinner">
                    <ul class="headmenu pull-right">
                        <li class="odd">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{URL::to('news/')}}">
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
                            <a class="dropdown-toggle" data-toggle="dropdown" id="produk_hukum">
                                <span class="rulycon-notebook"></span>
                                <span class="headmenu-label">Produk Hukum</span>
                            </a>
                        </li>
                        <li class="odd">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{URL::to('/')}}">
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
                    <li><a href="#">Tes</a></li>
                </ul>

                <ul class="sub-menu" id="sub-aplikasi" style="display: none">
                    <li class="has-child">
                        <a href="#">Peraturan Perundang-undangan</a>
                        <ul>
                            <li><a href="{{ URL::to('/layanan/detail?id=1') }}">Peraturan Perundang-undangan</a></li>
                            <li><a href="{{URL::route('per_uu.informasi')}}">Informasi dan Status Usulan</a></li>
                        </ul>
                    </li>
                    <li class="has-child">
                        <a href="#">Pelembagaan</a>
                        <ul>
                            <li><a href="{{ URL::to('/layanan/detail?id=2') }}">Pelembagaan</a></li>
                            <li><a href="{{ URL::route('informasi_pelembagaan') }}">Informasi dan Status Usulan</a></li>
                        </ul>
                    </li>
                    <li class="has-child">
                        <a href="#">Ketatalaksanaan</a>
                        <ul>
                                    <li><a href="{{ URL::to('/layanan/detail?id=4') }}">Sistem dan Prosedur</a></li>
                                    <li><a href="{{URL::route('informasi_sistem_prosedur')}}">Informasi dan Status Usulan Sistem dan Prosedur</a></li>

                                    <li><a href="{{ URL::to('/layanan/detail?id=5') }}">Analisis jabatan</a></li>
                                    <li><a href="{{URL::route('usulan_analisis_jabatan')}}">Informasi dan Status Usulan</a></li>
                        </ul>
                    </li>
                    <li class="has-child">
                        <a href="#">Bantuan Hukum</a>
                        <ul>
                            <li><a href="{{ URL::to('/layanan/detail?id=3') }}">Bantuan Hukum</a></li>
                            <li><a href="{{ URL::to('BantuanHukum') }}">Informasi dan Status Usulan</a></li>
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
            <div class="row-fluid">
                <div class="span9">
                    <ul class="footer-menu">
                        <li>Menu 01</li>
                        <li><a href="#">Sub-menu-01-01</a></li>
                        <li><a href="#">Sub-menu-01-02</a></li>
                        <li><a href="#">Sub-menu-01-03</a></li>
                        <li><a href="#">Sub-menu-01-04</a></li>
                        <li><a href="#">Sub-menu-01-05</a></li>
                        <li><a href="#">Sub-menu-01-06</a></li>
                    </ul>
                    <ul class="footer-menu">
                        <li>Menu 02</li>
                        <li><a href="#">Sub-menu-02-01</a></li>
                        <li><a href="#">Sub-menu-02-02</a></li>
                        <li><a href="#">Sub-menu-02-03</a></li>
                        <li><a href="#">Sub-menu-02-04</a></li>
                    </ul>
                    <ul class="footer-menu">
                        <li>Menu 03</li>
                        <li><a href="#">Sub-menu-03-01</a></li>
                        <li><a href="#">Sub-menu-03-02</a></li>
                        <li><a href="#">Sub-menu-03-03</a></li>
                        <li><a href="#">Sub-menu-03-04</a></li>
                        <li><a href="#">Sub-menu-03-05</a></li>
                    </ul>
                    <ul class="footer-menu">
                        <li>Menu 04</li>
                        <li><a href="#">Sub-menu-04-01</a></li>
                        <li><a href="#">Sub-menu-04-02</a></li>
                        <li><a href="#">Sub-menu-04-03</a></li>
                        <li><a href="#">Sub-menu-04-04</a></li>
                        <li><a href="#">Sub-menu-04-05</a></li>
                        <li><a href="#">Sub-menu-04-06</a></li>
                        <li><a href="#">Sub-menu-04-07</a></li>
                    </ul>
                    <ul class="footer-menu">
                        <li>Menu 05</li>
                        <li><a href="#">Sub-menu-05-01</a></li>
                        <li><a href="#">Sub-menu-05-02</a></li>
                        <li><a href="#">Sub-menu-05-03</a></li>
                        <li><a href="#">Sub-menu-05-04</a></li>
                    </ul>
                </div>
                <div class="span3">
                    <address>
                        <span>Kementerian Pendidikan &amp; Kebudayaan Republik Indonesia</span><br/>
                        <br/>
                        Jalan Sempurna no.9, Bandung, 40131 <br/>
                        <span class="rulycon-phone"></span> (022) 2512345, ext 1234<br/>
                        <span class="rulycon-print"></span> (022) 2512345, ext 1234<br/>
                        Jawa Barat, Indonesia
                    </address>
                    <p class="social-links">
                        <a href="#"><span class="rulycon-facebook"></span></a>
                        <a href="#"><span class="rulycon-twitter"></span></a>
                        <a href="#"><span class="rulycon-linkedin"></span></a>
                        <a href="#"><span class="rulycon-yahoo"></span></a>
                    </p>
                    <p><span>&copy; 2014 Kementerian Pendidikan &amp; Kebudayaan Republik Indonesia.</span></p>
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
            interval: 1000,
            cycle: true
        });
    });

    $("#informasi").click(function(){
        $("#sub-informasi").show();
        $("#sub-aplikasi").hide();
    });

    $("#aplikasi").click(function(){
        $("#sub-informasi").hide();
        $("#sub-aplikasi").show();
    });
</script>
@show
</body>
</html>