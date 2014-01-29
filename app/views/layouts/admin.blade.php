<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/hukor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rulycon.css')}}">
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
<?php $user = Auth::user(); ?>
<div class="mainwrapper">
    <div class="header">
        <ul id="main-menu">
            <li id="beranda"><a href="{{URL::to('admin/Home')}}"><span class="rulycon-home-2"></span> Beranda</a></li>
            <li id="informasi"><a href="#"><span class="rulycon-user"></span> Informasi</a></li>
            <li id="aplikasi"><a href="#"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            <li id="manajemen"><a href="#"><span class="rulycon-address-book"></span> User</a></li>
        </ul>
    </div>

    <div class="leftpanel">
        <div id="logo-wrapper">
            <img src="{{asset('assets/images/logo-kemendiknas.png')}}" alt="Kementrian Pendidikan Nasional RI"/>
        </div>
        <div id="welcome-message">
            <p>Welcome <span id="user-name"><?php echo $user->username; ?></span></p>
        </div>
        <div id="user-links">
            <a href="{{URL::to('admin/setting')}}"><span class="rulycon-cog"></span> Settings</a>
            <a href="{{URL::action('LoginController@signout')}}"><span class="rulycon-exit"></span> Sign out</a>
        </div>

        <div class="leftmenu">
            <ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Navigation</li>

                <!-- list informasi-->
                <li class="dropdown">
                    <ul id="info" style="display:none">
                        <li id="produkhukum"><a href="#"><span class="iconfa-laptop"></span> Produk Hukum</a></li>
                        <li id="ketatalaksanaan" class="dropdown"><a href="#"><span class="iconfa-hand-up"></span> Layanan Ketatalaksanaan</a>
                            <ul>
                                <li><a href="#">Sistem dan Prosedur Kerja</a></li>
                                <li><a href="#">Sistem manajemen mutu</a></li>
                                <li><a href="#">Analisis Jabatan</a></li>
                                <li><a href="#">Perhitungan beban kerja</a></li>
                                <li><a href="#">Tata nilai & budaya kerja organisasi</a></li>
                                <li><a href="#">Pelayanan publik</a></li>
                                <li><a href="#">Tata naskah dinas</a></li>
                            </ul>
                        </li>
                        <li id="kelembagaan" class="dropdown"><a href="#"><span class="iconfa-briefcase"></span> Layanan Kelembagaan</a>
                            <ul>
                                <li><a href="#">Pembentukan</a></li>
                                <li><a href="#">Penataan</a></li>
                                <li><a href="#">Statuta</a></li>
                                <li><a href="#">Statuta</a></li>
                            </ul>
                        </li>
                        <li id="bahu"><a href="#"><span class="iconfa-th-list"></span> Layanan Bantuan Hukum</a></li>
                        <li id="puu"><a href="#"><span class="iconfa-picture"></span> Layanan Peraturan Perundang-Undangan</a></li>
                        <li id="diskusi"><a href="#"><span class="iconfa-font"></span> Forum Diskusi</a></li>
                        <li id="callcenter"><a href="#"><span class="iconfa-signal"></span> Call Center</a></li>
                    </ul>
                </li>
                <!-- end list-->

                <!-- list aplikasi-->
                <li class="dropdown" >
                    <ul id="app" style="display:none">
                        <li id="app_puu" class="dropdown"><a href="#"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a>
                            <ul>
                                <li><a href="#">Lembar Usulan</a></li>
                                <li><a href="#">Informasi & Status usulan</a></li>
                            </ul>
                        </li>
                        <li id="app_pelembagaan" class="dropdown"><a href="#"><span class="iconfa-hand-up"></span> Pelembagaan</a>
                            <ul>
                                <li><a href="#">Lembar Usulan</a></li>
                                <li><a href="#">Informasi & Status usulan</a></li>
                            </ul>
                        </li>
                        <li id="app_bahu" class="dropdown"><a href=""><span class="iconfa-signal"></span> Bantuan Hukum</a>
                            <ul>
                                <li><a href="#">Lembar Permohonan</a></li>
                                <li><a href="#">Informasi Perkara</a></li>
                            </ul>
                        </li>
                        <li id="app_internal"><a href="#"><span class="iconfa-envelope"></span> Aplikasi Internal</a></li>
                    </ul>
                </li>

                <!-- end list-->

                <!-- list manajemen user-->
                <li class="dropdown" >
                    <ul id="manage" style="display:none">
                        <li><a href="{{URL::to('admin/account')}}"><span class="iconfa-laptop"></span> Kelola Akun</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--leftmenu-->

    </div>
    <!-- leftpanel -->

<!--    CONTENT-->
    @yield('content')

</div>
<!--mainwrapper-->


@section('scripts')
<script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
<script src="{{asset('assets/js/dusk.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/jquery.ui.datepicker.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/DatatableReloadAjax.js')}}"></script>

<script src="{{asset('assets/js/jquery-migrate-1.1.1.min.js')}}"></script>
<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.cookie.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script type="text/javascript">
    jQuery(function ($) {
        $("#beranda").click(function(){
            $("#info").hide();
            $("#app").hide();
            $("#manage").hide();

        });

        $("#informasi").click(function(){
            $("#info").show();
            $("#app").hide();
            $("#manage").hide();
        });

        $("#aplikasi").click(function(){
            $("#info").hide();
            $("#app").show();
            $("#manage").hide();
        });

        $("#manajemen").click(function(){
            $("#info").hide();
            $("#app").hide();
            $("#manage").show();
        });

        if(){

        }

    });
</script>
@show

</body>
</html>
