<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layanan Biro Hukum dan Organisasi | Berita</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Layanan Biro Hukum dan Organisasi">
  <meta name="author" content="Sangkuriang Internasional">

  <!-- Stylesheet files import here -->

  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.default.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/simplePagination.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive-tables-news.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.bxslider.css')}}">
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
      <!-- form cari berita-->

      <p class="pull-right" style="padding: 4px;">&nbsp;
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
<!--            <a href="{{URL::to('/')}}">-->
<!--              <span class="rulycon-home-2"></span>-->
<!--              <span class="headmenu-label" id="berita">Berita</span>-->
<!--            </a>-->
          </li>
<!--            <li>-->
<!--                <a class="dropdown-toggle" data-toggle="dropdown" id="aplikasi">-->
<!--                    <span class="rulycon-drawer-3"></span>-->
<!--                    <span class="headmenu-label">Aplikasi</span>-->
<!--                </a>-->
<!--            </li>-->
<!---->
<!--            <li class="odd">-->
<!--                <a href="{{URL::to('detailprofile')}}" id="profile">-->
<!--                    <span class="rulycon-profile"></span>-->
<!--                    <span class="headmenu-label">Profil</span>-->
<!--                </a>-->
<!--            </li>-->

<!--            <li>-->
<!--                <a class="dropdown-toggle" data-toggle="dropdown" id="informasi">-->
<!--                    <span class="rulycon-notebook"></span>-->
<!--                    <span class="headmenu-label">Informasi</span>-->
<!--                </a>-->
<!--            </li>-->

<!--            <li>-->
<!--                <a href="{{URL::to('produkhukum')}}" id="produk_hukum">-->
<!--                    <span class="rulycon-books"></span>-->
<!--                    <span class="headmenu-label">Produk Hukum</span>-->
<!--                </a>-->
<!--            </li>-->
<!---->
<!--          <li>-->
<!--            <a href="#" id="forum_diskusi">-->
<!--              <span class="rulycon-bubbles-2"></span>-->
<!--              <span class="headmenu-label">Forum</span>-->
<!--            </a>-->
<!--          </li>-->
<!--          <li>-->
<!--            <a href="{{URL::to('site')}}">-->
<!--              <span class="rulycon-user"></span>-->
<!--              <span class="headmenu-label" id="login">Login</span>-->
<!--            </a>-->
<!--          </li>-->
        </ul>
        <!--headmenu-->
      </div>
    </div>
  </div>

  <div class="sub-header">
    <div class="container">
      <ul class="sub-menu" id="sub-aplikasi">
          <li>
              <a href="{{URL::to('/')}}"><span class="rulycon-home"> &nbsp; Beranda</span></a>
          </li>

        <li>
          <a href="{{URL::to('detailprofile')}}"><span class="rulycon-profile"> &nbsp; Profil</span></a>
        </li>

          <li class="has-child">
              <a href="#"><span class="rulycon-drawer-3"> &nbsp; Aplikasi</span></a>
              <ul>
                  <li>
                      <a href="{{ URL::to('/layanan/detail?id=1') }}">Peraturan Perundang-Undangan</a>
                  </li>
                  <li>
                      <a href="{{ URL::to('/layanan/detail?id=2') }}">Pelembagaan</a>
                  </li>
                  <li>
                      <a href="{{ URL::to('/layanan/detail?id=3') }}">Bantuan Hukum</a>
                  </li>
                  <li>
                      <a href="{{ URL::to('/layanan/detail?id=5') }}">Analisis Jabatan</a>
                  </li>
                  <li>
                      <a href="{{ URL::to('/layanan/detail?id=4') }}">Sistem dan Prosedur</a>
                  </li>
              </ul>
          </li>

          <li>
              <a href="{{URL::to('produkhukum')}}"><span class="rulycon-books"> &nbsp; Produk Hukum</span></a>
          </li>

          <li>
              <a href="#" id="forum_diskusi"><span class="rulycon-bubbles-3"> &nbsp; Forum</span></a>
          </li>

        <li>
          <a href="{{URL::to('site')}}"><span class="rulycon-user"> &nbsp; Login</span></a>
        </li>

      </ul>
    </div>
  </div>
</div>

<div class="content-wrapper">
  @yield('news-content')

</div>
<!--content-wrapper-->
<!--<div class="footer">-->
<!--    <div class="container">-->
<!---->
<!--        <div class="row-fluid">-->
<!--            --><?php //$call = CallCenter::find(1); ?>
<!--            <div class="span4"  style="margin-top: 0px !important;">-->
<!--                <p>-->
<!--                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.-->
<!--                </p>-->
<!--            </div>-->
<!---->
<!--            <div class="span4" style="margin-top: 0px !important;">-->
<!--                <p>-->
<!--                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.-->
<!--                </p>-->
<!--            </div>-->
<!---->
<!--                  <div class="span4">-->
<!--                    <div id="footer-image">-->
<!--                      <img src="{{asset('assets/images/logo-only.png')}}" alt=""/>-->
<!--                      <span style="margin-top: 6px;">Biro Hukum dan Organisasi</span>-->
<!--                      <p><span>Kementerian Pendidikan Dan Kebudayaan</span>-->
<!--                      <span>Republik Indonesia</span></p>-->
<!--                    </div>-->
<!--                    <address>-->
<!--                      {{ $call->alamat }} <br/>-->
<!--                      <span class="rulycon-phone"></span> {{ $call->telp }} &nbsp; | &nbsp; <span class="rulycon-print"></span> {{ $call->fax }}<br/>-->
<!--                      <!--                        Jawa Barat, Indonesia-->
<!--                    </address>-->
<!--                  </div>-->
<!--                </div>-->
<!--        </div>-->
<!--        <div class="row-fluid">-->
<!--            <div class="span12">-->
<!--                <p style="margin-top: 36px;"><span>&copy; 2014 Kementerian Pendidikan Dan Kebudayaan Republik Indonesia.</span>-->
<!--                </p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="footer">
  <div class="container" style="width: 960px;">

    <div class="row-fluid">
      <?php $call = CallCenter::find(1); ?>
              <div class="span8" style="margin-top: 0px !important;">
              </div>
<!--      <div class="span4" style="margin-top: 0px !important;">-->
<!--          <p>-->
<!--             Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.-->
<!--          </p>-->
<!--      </div>-->
<!---->
<!--        <div class="span4" style="margin-top: 0px !important;">-->
<!--            <p>-->
<!--                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.-->
<!--            </p>-->
<!--        </div>-->

      <div class="span4">
        <div id="footer-image">
          <img src="{{asset('assets/images/logo-only.png')}}" alt=""/>
          <span style="margin-top: 6px;">Biro Hukum dan Organisasi</span>
          <p><span>Kementerian Pendidikan Dan Kebudayaan</span>
          <span>Republik Indonesia</span></p>
        </div>
        <address>
          {{ $call->alamat }} <br/>
          <span class="rulycon-phone"></span> {{ $call->telp }} &nbsp; | &nbsp; <span class="rulycon-print"></span> {{ $call->fax }}<br/>

        </address>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span8">
        <p><span>&copy; 2014 Kementerian Pendidikan Dan Kebudayaan Republik Indonesia.</span></p>
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
<script src="{{asset('assets/js/jquery.bxslider.min.js')}}"></script>
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
            $('#dialog').dialog({
                width: 500,
                modal: true,
                buttons: {
                    "LOGIN" : function(){
                        window.location.replace("{{URL::to('site')}}");
                    },

                    "DAFTAR" : function(){
                        window.location.replace("{{URL::to('registrasi')}}");
                    },

                    "CANCEL" : function() {
                        $(this).dialog("close");
                    }
                }
            });
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
    $(function() {
        $( "#accordion" ).accordion({
            heightStyle: "fill",
            collapsible: true

        });
    });
    $(function() {
        $( "#accordion-resizer" ).resizable({
            minHeight: 140,
            minWidth: 200,
            resize: function() {
                $( "#accordion" ).accordion( "refresh" );
            }
        });
    });
  var twitterWidgetOptions = {
    "url": "{{asset('assets/js/custom-twitter.css')}}"
  };
  CustomizeTwitterWidget(twitterWidgetOptions);
</script>
<script src="{{asset('assets/js/jquery.cycle2.js')}}"></script>
@show
</body>
</html>
