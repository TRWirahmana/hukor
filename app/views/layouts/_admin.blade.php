<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registrasi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Registrasi Online Penyuluh Nasional">
        <meta name="author" content="Sangkuriang Internasional">

        @section('styles')
            <!-- Stylesheet files import here -->
            <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dusk.min.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-embedding-standard.min.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dikbud.css')}}">
        @show

        <style type="text/css">
            .container-fluid { padding: 0; }
        </style>

        <!-- HTML5 shiv -->
        <!--[if lt IE 9]>
            <script src="{{asset('assets/js/html5shiv.js')}}"></script>
        <![endif]-->

        <!-- Favicons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('assets/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('assets/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('assets/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{asset('assets/ico/apple-touch-icon-57-precomposed.png')}}">
        <link rel="shortcut icon" href="{{asset('assets/ico/favicon.png')}}">

    </head>
    <body class="main-layout">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span24">
                    <div class="span6 sidebar">
                        <header>Sistem Registrasi Online Penyuluh Nasional</header>
                        <ul class="pull-right">
                            <li class="dropdown">
                                Selamat datang, <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#" id="user-menu">suprapto85 <b class="caret"></b></a>
                                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-menu">
                                    <li><a href="#" role="menuitem" tab-index="-1">User settings</a></li>
                                    <li>
                                        <a role="menuitem" tab-index="-1" href="{{URL::action('LoginController@signout')}}">Sign out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div id="logo-wrapper">
                            <img src="{{asset('assets/img/logo-color-overlay.png')}}" alt="Kebudayaan Indonesia">
                        </div>
                        <footer>
                            <div class="stripe-accent"></div>
                            <h6>© 2013 Direktorat Jenderal Kebudayaan Republik Indonesia</h6>
                        </footer>
                    </div>
                    <div class="span18 main-content">
                        <header><span><img src="{{asset('assets/img/logo.png')}}" alt="Kebudayaan Indonesia" width="230"></span></header>

                        <!-- .row-fluid begins here -->
                        @yield('content')
                        <!-- .row-fluid ends here -->

                    </div>
                </div>
            </div>
        </div>

        @section('scripts')
        <script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
        <script src="{{asset('assets/js/dusk.min.js')}}"></script>
        <script type="text/javascript">
        var baseUrl = '<?php echo URL::to('/');?>';
        </script>
        @show
    </body>
</html>