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
                    var role = {{Auth::user()->role_id}};</script>
    </head>
    <body class="main-layout">
        <?php $user = Auth::user(); ?>
        <div class="mainwrapper">
            <div class="header">
                <ul id="main-menu">
                    @if(in_array($user->role_id, array(1, 4, 5, 6, 7, 8 ,9)))
                        <li id="beranda"><a href="{{URL::route('admin.index')}}">
                            <span class="rulycon-home-2"></span> Beranda</a>
                        </li>
                        <li id="aplikasi"><a href="#app">
                            <span class="rulycon-wrench"></span> Aplikasi</a>
                        </li>
                    @elseif(3 == $user->role_id)
                        <li id="beranda"><a href="{{URL::route('admin.index')}}">
                            <span class="rulycon-home-2"></span> Beranda</a>
                        </li>
                        <li id="news"><a href="#menu_berita">
                            <span class="rulycon-newspaper"></span> Berita</a>
                        </li>
                        <li id="aplikasi"><a href="#app">
                            <span class="rulycon-wrench"></span> Aplikasi</a>
                        </li>
                        <li id="managemen"><a href="#manage">
                            <span class="rulycon-user"></span> User</a>
                        </li>
                        <li id="menu"><a href="#manage-menu">
                            <span class="rulycon-notebook"></span> Manage Menu</a>
                        </li>
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
                    <a href="{{URL::route('admin.setting')}}"><span class="rulycon-cog"></span> Settings</a>
                    <a href="{{URL::route('admin.logout')}}"><span class="rulycon-exit"></span> Sign out</a>
                </div>

                <div class="leftmenu">
                    <ul class="nav nav-tabs nav-stacked">
                        <li class="nav-header">Navigation</li>

                        @if(in_array($user->role_id, array(1, 4, 5, 6, 7, 8 ,9)))
                            <li class="dropdown" >
                                <ul id="app">
                                    <li id="app_puu"><a href="{{ URL::route('admin.puu.index') }}">
                                        <span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a>
                                    </li>
                                    <li id="app_pelembagaan"><a href="{{ URL::route('admin.pelembagaan.index') }}">
                                        <span class="iconfa-hand-up"></span> Pelembagaan</a>
                                    </li>
                                    <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                                        <ul>
                                            <li><a href="{{URL::route('admin.sp.index')}}">Sistem dan Prosedur</a></li>
                                            <li><a href="{{URL::route('admin.aj.index')}}">Analisis Jabatan</a></li>
                                        </ul>
                                    </li>
                                    <li id="app_bahu"><a href="{{ URL::to('kepala_biro/bantuan_hukum/') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a>

                                </ul>
                            </li>
                        @elseif(3 == $user->role_id)
                            <li class="dropdown" >
                                <ul id="app">
                                    <li id="app_puu"><a href="{{ URL::route('admin.puu.index') }}"><span class="iconfa-laptop"></span> Peraturan Perundang-Undangan</a>

                                    </li>
                                    <li id="app_pelembagaan" ><a href="{{ URL::route('admin.pelembagaan.index') }}"><span class="iconfa-hand-up"></span> Pelembagaan</a>

                                    </li>
                                    <li id="app_ketatalaksanaan" class="dropdown"><a href=""><span class="iconfa-time"></span> Ketatalaksanaan</a>
                                        <ul>
                                            <li><a href="{{URL::route('admin.sp.index')}}">Sistem dan Prosedur</a></li>
                                            <li><a href="{{URL::route('admin.aj.index')}}">Analisis Jabatan</a></li>
                                        </ul>
                                    </li>
                                    <li id="app_bahu"><a href="{{ URL::route('admin.bantuan_hukum.index') }}"><span class="iconfa-signal"></span> Bantuan Hukum</a>

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
