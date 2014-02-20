<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign In - Reg Online Penyuluh Nasional</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Registrasi Online Penyuluh Nasional">
        <meta name="author" content="Sangkuriang Internasional">

        <!-- Stylesheet files import here -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dusk.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-embedding-standard.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dikbud.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dusk.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/plugins/validationEngine/validationEngine.jquery.css')}}">
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

        <script type="text/javascript">
            var baseUrl = '{{URL::to('/')}}';
        </script>


    </head>
    <body id="sign-in">
        <div class="container-fluid">
            <div class="row-fluid">
                @yield('content')
            </div>
        </div>
        <footer>
            <div class="stripe-accent"></div>
            <h6>© 2013 Direktorat Jenderal Kebudayaan Republik Indonesia</h6>
            <h6 id="site-links">
                <a href="http://www.kemdiknas.go.id/kemdikbud/" target="_blank" >Kemdikbud</a> |
                <a href="http://en.unesco.org/" target="_blank">UNESCO</a> |
                <a href="http://indonesia.go.id/" target="_blank">Indonesia Goverment Website</a> |
                <a href="http://indonesia.travel/" target="_blank">Indonesia Travel</a></h6>
        </footer>

        @section('scripts')
        <script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/validateEngine/jquery.validationEngine.js')}}"></script>
        <script src="{{asset('assets/js/plugins/validateEngine/jquery.validationEngine-id.js')}}"></script>
        <script src="{{asset('assets/js/dusk.min.js')}}"></script>
        @show
    </body>
</html>