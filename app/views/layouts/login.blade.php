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
    <div class="container" style="min-height: 15px;">
    </div>
  </div>
  <div class="header">
    <div class="container" style="min-height: 60px;">
    </div>
  </div>

  <div class="sub-header">
    <div class="container" style="min-height: 30px;">
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
