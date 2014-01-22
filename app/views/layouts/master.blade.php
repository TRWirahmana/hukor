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
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dikbud.css')}}">
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
<?php $datses = Session::get('key'); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span24">
      <div class="span7 sidebar">
        <header>
          <img src="{{asset('assets/img/tut-wuri-handayani.png')}}" alt="Kebudayaan Indonesia">
          <h4>Direktorat Jenderal Kebudayaan Republik Indonesia</h4>
        </header>
        <p id="username">Selamat datang, <span id="name"></span></p>
        <div>
          <ul id="user-menu">
            <!-- <li>
              <a href="http://localhost/retane_blog/wp-login.php?log=<?php //echo $datses['us']; ?>&pwd=<?php echo $datses['pd']; ?>" target="_blank"><span class="rulycon-wordpress"></span> Blog</a>
            </li> -->

            <li><a href="#">Peraturan Perundang-undangan</a></li>
            <li><a href="#">Pelembagaan</a></li>
            <li><a href="{{URL::to('BantuanHukum')}}">Bantuan Hukum</a></li>
            <li>
              <a href="#" role="menuitem" tab-index="-1"><span class="rulycon-settings"></span> User settings</a></li>
              <li>
              <a role="menuitem" tab-index="-1" href="{{URL::action('LoginController@signout')}}"><span class="rulycon-exit"></span> Sign
                out</a>
            </li>
            <!-- <li>
              <a role="menuitem" tab-index="-1" href="{{URL::action('LoginController@signout')}}"
                 onclick="window.open('http://<?php //echo $_SERVER['HTTP_HOST']; ?>/retane_blog/wp-login.php?loggedout=true')"><span class="rulycon-exit"></span> Sign
                out</a>
            </li> -->
          </ul>
        </div>
        <!--<div id="logo-wrapper">
            <img src="{{asset('assets/img/logo-color-overlay.png')}}" alt="Kebudayaan Indonesia">
        </div>-->
        <footer>
          <!--                            <div class="stripe-accent"></div>-->
          <h6>© 2013 Direktorat Jenderal Kebudayaan Republik Indonesia</h6>
        </footer>
      </div>
      <div class="span17 main-content">
        <h2>Layanan Hukum & Organisasi</h2>
        <div class="stripe-accent"></div>

        @if(Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Berhasil!</strong> {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-error">
                <buton class="close" type="button" data-dismiss="alert">&times;</buton>
                <strong>Kesalahan!</strong> {{Session::get('error')}}
            </div>
        @endif

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
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/jquery.ui.datepicker.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/DatatableReloadAjax.js')}}"></script>
@show
</body>
</html>