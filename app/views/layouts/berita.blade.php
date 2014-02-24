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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/simplePagination.css')}}">

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
                            <a href="{{ URL::to('forumdiskusi') }}" id="forum_diskusi">
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
                    <?php $menu = Menu::all(); ?>
                    @foreach($menu as $menus)
                        @if($menus->submenu == null)
                            <li><a href="#">{{$menus->nama_menu}}</a></li>
                        @else
                            <li class="has-child">
                                <a href="#">{{$menus->nama_menu}}</a>
                                <ul>
                                    @foreach($menus->submenu as $submenus)
                                        @if($submenus->layanan->id != null)
                                            <li><a href="{{ URL::to('/layanan/detail?id='. $submenus->layanan->id .'') }}">{{ $submenus->nama_submenu }}</a></li>
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
                    <li> <a href="http://kemdikbud.go.id"><img src="{{asset('assets/img/satu.png')}}"></a> </li>
                    <li><a href="http://setjen.kemdikbud.go.id"><img src="{{asset('assets/img/2.png')}}" alt=""></a></li>
                    <li><a href="http://paudni.kemdikbud.go.id"><img src="{{asset('assets/img/3.png')}}" alt=""></a></li>
                    <li><a href="http://dikdas.kemdikbud.go.id"><img src="{{asset('assets/img/4.png')}}" alt=""></a></li>
                    <li><a href="http://dikmen.kemdikbud.go.id"><img src="{{asset('assets/img/5.png')}}" alt=""></a></li>
                    <li><a href="http://dikti.kemdikbud.go.id"><img src="{{asset('assets/img/logo_ditjenbud/6.png')}}" alt=""></a></li>
                    <li><a href="http://itjen.kemdikbud.go.id"><img src="{{asset('assets/img/logo_ditjenbud/7.png')}}" alt=""></a></li>
                    <li><a href="http://litbang.kemdikbud.go.id"><img src="{{asset('assets/img/logo_ditjenbud/8.png')}}" alt=""></a></li>
                    <li><a href="http://badanbahasa.kemdikbud.go.id"><img src="{{asset('assets/img/logo_ditjenbud/9.png')}}" alt=""></a></li>
                    <li><a href="http://bpsdmpk.kemdikbud.go.id"><img src="{{asset('assets/img/logo_ditjenbud/10.png')}}" alt=""></a></li>
                    <li><a href="http://kebudayaanindonesia.net"><img src="{{asset('assets/img/logo_ditjenbud/11.png')}}" alt=""></a></li>
                </ul>
            </div>
        </div>
        <div class="container">

            <div class="row-fluid">
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
                                    <li><a href="{{ URL::to('/layanan/detail?id='. $submenus->layanan->id .'') }}">{{ $submenus->nama_submenu }}</a> </li>
                                    @else
                                    <li><a href="#">{{ $submenus->nama_submenu }}</a> </li>
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
            interval: 5000,
            cycle: true
        });
    });

    $("#informasi").click(function(){
        $("#sub-informasi").show();
        $("#footer-menu-informasi").show();
        $("#footer-menu-aplikasi").hide();
        $("#sub-aplikasi").hide();
    });

    $("#aplikasi").click(function(){
        $("#sub-informasi").hide();
        $("#footer-menu-aplikasi").show();
        $("#footer-menu-informasi").hide();
        $("#sub-aplikasi").show();
    });
</script>
@show
</body>
</html>
