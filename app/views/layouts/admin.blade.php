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
    <link rel="stylesheet" href="{{asset('assets/TableTools-2.2.0/css/dataTables.tableTools.min.css')}}">
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
        var role = {{Auth::user()->role_id}};
    </script>
</head>
<body class="main-layout">
<?php $user = Auth::user(); ?>
<div class="mainwrapper">
    <div class="header">
        <ul id="main-menu">

            <!-- Kepala Biro-->
            @if($user->role_id == 1)
            <li id="beranda"><a href="{{URL::to('kepala_biro/Home')}}"><span class="rulycon-home-2"></span> Beranda</a></li>
<!--            <li id="news"><a href="{{URL::to('kepala_biro/berita')}}"><span class="rulycon-newspaper"></span> Berita</a></li>-->
<!--            <li id="informasi"><a href="#info"><span class="rulycon-address-book"></span> Informasi</a></li>-->
            <li id="aplikasi"><a href="#app"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            @endif

            <!-- SUPER ADMIN -->
            @if($user->role_id == 3)
            <li id="beranda"><a href="{{URL::to('admin/Home')}}"><span class="rulycon-home-2"></span> Beranda</a></li>

            <li id="news"><a href="#menu_berita"><span class="rulycon-newspaper"></span> Berita</a></li>
            <!--            <li id="informasi"><a href="#info"><span class="rulycon-address-book"></span> Informasi</a></li>-->
            <li id="aplikasi"><a href="#app"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            <li id="managemen"><a href="#manage"><span class="rulycon-user"></span> User</a></li>
            <li id="menu"><a href="#manage-menu"><span class="rulycon-notebook"></span> Manage Menu</a></li>
            @endif

            <!-- Kepala Bagian -->
            @if($user->role_id == 4)
                 <li id="beranda"><a href="{{URL::to('kepala_bagian/')}}"><span class="rulycon-home-2"></span> Beranda</a></li>
                <li id="aplikasi"><a href="#app"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            @endif

            <!-- Kepala Sub Bagian -->
            @if($user->role_id == 5)
            <li id="beranda"><a href="{{URL::to('kepala_subbagian/')}}"><span class="rulycon-home-2"></span> Beranda</a></li>
            <li id="aplikasi"><a href="#app"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            @endif

            <!-- Admin PERUU-->
            @if($user->role_id == 6)
            <li id="beranda"><a href="{{URL::to('per_uu/Home')}}"><span class="rulycon-home-2"></span> Beranda</a></li>
<!--            <li id="news"><a href="{{URL::to('kepala_biro/berita')}}"><span class="rulycon-newspaper"></span> Berita</a></li>-->
<!--            <li id="informasi"><a href="#info"><span class="rulycon-address-book"></span> Informasi</a></li>-->
            <li id="aplikasi"><a href="#app"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            @endif

            <!-- Admin Pelembagaan-->
            @if($user->role_id == 7)
            <li id="beranda"><a href="{{URL::to('pelembagaan/Home')}}"><span class="rulycon-home-2"></span> Beranda</a></li>
            <!--            <li id="news"><a href="{{URL::to('kepala_biro/berita')}}"><span class="rulycon-newspaper"></span> Berita</a></li>-->
            <!--            <li id="informasi"><a href="#info"><span class="rulycon-address-book"></span> Informasi</a></li>-->
            <li id="aplikasi"><a href="#app"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            @endif

            <!-- Admin KETATATALAKSANAAN-->
            @if($user->role_id == 9)
            <li id="beranda"><a href="{{URL::to('ketatalaksanaan/Home')}}"><span class="rulycon-home-2"></span> Beranda</a></li>
<!--            <li id="news"><a href="{{URL::to('kepala_biro/berita')}}"><span class="rulycon-newspaper"></span> Berita</a></li>-->
<!--            <li id="informasi"><a href="#info"><span class="rulycon-address-book"></span> Informasi</a></li>-->
            <li id="aplikasi"><a href="#app"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            @endif

            <!-- Admin Bantuan Hukum-->
            @if($user->role_id == 8)
            <li id="beranda"><a href="{{URL::to('bantuan_hukum/Home')}}"><span class="rulycon-home-2"></span> Beranda</a></li>
            <!--            <li id="news"><a href="{{URL::to('kepala_biro/berita')}}"><span class="rulycon-newspaper"></span> Berita</a></li>-->
            <!--            <li id="informasi"><a href="#info"><span class="rulycon-address-book"></span> Informasi</a></li>-->
            <li id="aplikasi"><a href="#app"><span class="rulycon-wrench"></span> Aplikasi</a></li>
            @endif

        </ul>
    </div>

    <div class="leftpanel">
        <div id="logo-wrapper">
            <img src="{{asset('assets/images/logo-kemendiknas.png')}}" alt="Kementrian Pendidikan Nasional RI"/>
        </div>
        <div id="welcome-message">
            @if($user->role_id == 3)
                <p>Welcome <span id="user-name"><?php echo $user->username; ?></span></p>
            @else
                <p>Welcome <span id="user-name"><?php echo $user->pengguna->nama_lengkap; ?></span></p>
            @endif
        </div>
        <div id="user-links">
            <a href="{{URL::to('admin/setting')}}"><span class="rulycon-cog"></span> Settings</a>
            <a href="{{URL::action('LoginController@signout')}}"><span class="rulycon-exit"></span> Sign out</a>
        </div>

        <div class="leftmenu">
            <ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Navigation</li>

                <!-- KEPALA BIRO RULES-->
                <!-- list aplikasi-->
                @if($user->role_id == 1)
                <li class="dropdown" >
                    <ul id="app">
                        <li id="app_puu"><a href="{{ URL::to('kepala_biro/per_uu/') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a>

                        </li>
                        <li id="app_pelembagaan"><a href="{{ URL::to('kepala_biro/pelembagaan/') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a>

                        <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                            <ul>
                                <li><a href="{{URL::route('admin.sp.index')}}">Sistem dan Prosedur</a></li>
                                <li><a href="{{URL::to('kepala_biro/ketatalaksanaan/analisisJabatan/')}}">Analisis Jabatan</a></li>
                            </ul>
                        </li>

                        </li>
                        <li id="app_bahu"><a href="{{ URL::to('kepala_biro/bantuan_hukum/') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a>

                    </ul>
                </li>

                <!-- end list-->
                @endif

                <!-- ADMIN RULES-->
                @if($user->role_id == 3)
                <!-- list aplikasi-->
                <li class="dropdown" >
                    <ul id="app">
                        <li id="app_puu"><a href="{{ URL::to('admin/per_uu/index_per_uu') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a>

                        </li>
                        <li id="app_pelembagaan" ><a href="{{ URL::to('admin/pelembagaan') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a>

                        </li>
                        <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                            <ul>
                                <li><a href="{{URL::route('admin.sp.index')}}">Sistem dan Prosedur</a></li>
                                <li><a href="{{URL::route('index_analisis_jabatan')}}">Analisis Jabatan</a></li>
                            </ul>
                        </li>
                        <li id="app_bahu"><a href="{{ URL::to('admin/bantuan_hukum') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a>

                            <!--                        <li id="app_internal"><a href="#"><span class="iconfa-envelope"></span> Aplikasi Internal</a></li>-->
                        <li id="app_forum">
                            <a href="#">
                                <label for="cbox-forum">
                                    <input {{ (null != AppConfig::find('enable_forum') && AppConfig::find('enable_forum')->value == 'true')? 'checked': '' }} type="checkbox" id="cbox-forum" value="y" class="checkbox">
                                    &nbsp;&nbsp;&nbsp; Aktifkan Forum
                                </label>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- end list-->

                <!-- list manajemen user-->
                <li class="dropdown">
                    <ul id="manage">
                        <li id="kelola"><a href="{{URL::to('admin/account')}}"><span class="iconfa-laptop"></span> Kelola Akun</a></li>
                    </ul>
                </li>

                <!-- list manajemen user-->
                <li class="dropdown">
                    <ul id="menu_berita">
                        <li><a href="{{URL::to('admin/berita')}}">Berita</a></li>
                        <li><a href="{{URL::route('admin.categories.index')}}">Kategori Berita</a></li>
                    </ul>
                </li>

                <!-- list manajemen menu-->
                <li class="dropdown">
                    <ul id="manage-menu">
                        <li id="menu"><a href="{{URL::to('admin/index_menu')}}"><span class="iconfa-laptop"></span> Kelola Menu</a></li>
                        <li id="kelola_submenu"><a href="{{URL::to('admin/index_submenu')}}"><span class="iconfa-laptop"></span> Kelola Submenu</a></li>
                        <li id="layanan"><a href="{{URL::to('admin/layanan')}}"><span class="iconfa-laptop"></span> Kelola Konten Layanan</a></li>
                        <li id="layanan"><a href="{{URL::to('admin/editcallcenter')}}"><span class="iconfa-laptop"></span> Kelola Call Center</a></li>
                    </ul>
                </li>
                @endif

                <!--   END -->

                @if($user->role_id == 4)
                <li class="dropdown" >
                    <ul id="app">
                        <li id="app_puu"><a href="{{ URL::route('kepala_bagian.per_uu') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a></li>
                        <li id="app_pelembagaan" ><a href="{{ URL::route('kepala_bagian.pelembagaan') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a></li>

                        <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                            <ul>
                                <li><a href="{{URL::to('kepala_bagian/ketatalaksanaan/sistemDanProsedur')}}">Sistem dan Prosedur</a></li>
                                <li><a href="{{URL::to('kepala_bagian/ketatalaksanaan/analisisJabatan/')}}">Analisis Jabatan</a></li>
                            </ul>
                        </li>
                        <li id="app_bahu"><a href="{{ URL::to('kepala_bagian/bantuan_hukum/') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a></li>
                    </ul>
                </li>
                @endif

                <!-- KEPALA SUB BAGIAN RULES-->
                @if($user->role_id == 5)
                <li class="dropdown" >
                    <ul id="app">
                        <li id="app_puu"><a href="{{ URL::route('kepala_subbagian.per_uu') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a></li>
                        <li id="app_pelembagaan" ><a href="{{ URL::route('kepala_subbagian.pelembagaan') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a></li>
                        <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                            <ul>
                                <li><a href="{{URL::to('kepala_subbagian/ketatalaksanaan/sistemDanProsedur')}}">Sistem dan Prosedur</a></li>
                                <li><a href="{{URL::to('kepala_subbagian/ketatalaksanaan/analisisJabatan/')}}">Analisis Jabatan</a></li>
                            </ul>
                        </li>
                        <li id="app_bahu"><a href="{{ URL::to('kepala_subbagian/bantuan_hukum/') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a></li>

                    </ul>
                </li>
                @endif



                <!-- PER UU RULES-->
                @if($user->role_id == 6)
                <!-- list aplikasi-->
                <li class="dropdown" >
                    <ul id="app">
                        <li id="app_puu"><a href="{{ URL::to('/per_uu') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a></li>
                        <li id="app_pelembagaan" ><a href="{{ URL::to('per_uu/pelembagaan/') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a></li>
                        <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                            <ul>
                                <li><a href="{{URL::to('per_uu/ketatalaksanaan/sistemDanProsedur')}}">Sistem dan Prosedur</a></li>
                                <li><a href="{{URL::to('per_uu/ketatalaksanaan/analisisJabatan/')}}">Analisis Jabatan</a></li>
                            </ul>
                        </li>

                        <li id="app_bahu"><a href="{{ URL::to('per_uu/bantuan_hukum/') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a>
                    </ul>
                </li>

                <!-- end list-->
                @endif

                <!--  PELEMBAGAAN RULES-->
                @if($user->role_id == 7)
                <!-- list aplikasi-->
                <li class="dropdown" >
                    <ul id="app">
                        <li id="app_puu"><a href="{{ URL::to('pelembagaan/per_uu/') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a></li>
                        <li id="app_pelembagaan" ><a href="{{ URL::to('/pelembagaan/index_pelembagaan') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a></li>
                        <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                            <ul>
                                <li><a href="{{URL::to('pelembagaan/ketatalaksanaan/sistemDanProsedur')}}">Sistem dan Prosedur</a></li>
                                <li><a href="{{URL::to('pelembagaan/ketatalaksanaan/analisisJabatan/')}}">Analisis Jabatan</a></li>
                            </ul>
                        </li>
                        <li id="app_bahu"><a href="{{ URL::to('pelembagaan/bantuan_hukum/') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a></li>
                    </ul>
                </li>

                <!-- end list-->
                @endif

                <!-- BANTUAN HUKUM RULES -->
                @if($user->role_id == 8)
                <!-- list aplikasi-->
                <li class="dropdown" >
                    <ul id="app">
                        <li id="app_puu"><a href="{{ URL::to('bantuan_hukum/per_uu/') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a></li>
                        <li id="app_pelembagaan" ><a href="{{ URL::to('bantuan_hukum/pelembagaan/') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a></li>
                        <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                            <ul>
                                <li><a href="{{URL::route('admin.sp.index')}}">Sistem dan Prosedur</a></li>
                                <li><a href="{{URL::to('bantuan_hukum/ketatalaksanaan/analisisJabatan/')}}">Analisis Jabatan</a></li>
                            </ul>
                        </li>
                        <li id="app_bahu"><a href="{{ URL::to('bantuan_hukum/') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a></li>
                    </ul>
                </li>

                <!-- end list-->
                @endif


               <!-- KETATALAKSANAAN RULES-->
                @if($user->role_id == 9)
                <!-- list aplikasi-->
                <li class="dropdown" >
                    <ul id="app">

                        <li id="app_puu"><a href="{{ URL::to('ketatalaksanaan/per_uu/') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a></li>
                        <li id="app_pelembagaan" ><a href="{{ URL::to('ketatalaksanaan/pelembagaan/') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a></li>
                        <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                            <ul>
                                <li><a href="{{URL::route('admin.sp.index')}}">Sistem dan Prosedur</a></li>
                                <li><a href="{{URL::route('index_analisis_jabatan')}}">Analisis Jabatan</a></li>
                            </ul>
                        </li>
                        <li id="app_bahu"><a href="{{ URL::to('ketatalaksanaan/bantuan_hukum/') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a></li>

                    </ul>
                </li>

                <!-- end list-->
                @endif

            </ul>
        </div>
        <!--leftmenu-->

    </div>
    <!-- leftpanel -->

<!--    CONTENT-->
    @yield('admin')
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

        $("#news").click(function(){
            $("#info").hide();
            $("#app").hide();
            $("#manage").hide();
            $("#manage-menu").hide();
            $("#menu_berita").show();
        });

        $("#beranda").click(function(){
            $("#info").hide();
            $("#app").hide();
            $("#manage").hide();
            $("#manage-menu").hide();
            $("#menu_berita").hide();

        });

        $("#informasi").click(function(){
            $("#info").show();
            $("#app").hide();
            $("#manage").hide();
            $("#manage-menu").hide();
            $("#menu_berita").hide();
        });

        $("#ketatalaksanaan").click(function(){
            window.location.href = baseURL + "/admin/layananketatalaksanaan/edit_ketatalaksanaan";
        });

        $("#aplikasi").click(function(){
            $("#info").hide();
            $("#app").show();
            $("#manage").hide();
            $("#menu_berita").hide();
            $("#manage-menu").hide();
        });

        $("#managemen").click(function(){
            $("#info").hide();
            $("#app").hide();
            $("#manage-menu").hide();
            $("#manage").show();
            $("#menu_berita").hide();
        });

        $("#menu").click(function(){
            $("#info").hide();
            $("#app").hide();
            $("#manage").hide();
            $("#manage-menu").show();
            $("#menu_berita").hide();
        });

        $("#cbox-forum").change(function(e){
            $.post("/admin/enableForum", {value: $(this).is(":checked")}, function(resp){
                console.log(resp);
            });
        });

    });
</script>
@show

</body>
</html>
