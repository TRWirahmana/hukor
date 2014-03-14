@section('content')
@if($info->id == 1)
<h2>Peraturan Perundang-Undangan</h2>
<div class="stripe-accent"></div>

<legend>
    Informasi Peraturan Perundang-Undangan
</legend>
@endif

@if($info->id == 2)
<h2>Pelembagaan</h2>
<div class="stripe-accent"></div>

<legend>
    Informasi Pelembagaan
</legend>
@endif

@if($info->id == 3)
<h2>Bantuan Hukum</h2>
<div class="stripe-accent"></div>

<legend>
    Informasi Bantuan Hukum
</legend>
@endif

@if($info->id == 4)
<h2>Ketatalaksanaan</h2>
<div class="stripe-accent"></div>

<legend>
    Informasi Sistem dan Prosedur
</legend>
@endif

@if($info->id == 5)
<h2>Ketatalaksanaan</h2>
<div class="stripe-accent"></div>

<legend>
    Informasi Analisis Jabatan
</legend>
@endif

@include('flash')

@if($info != null)
<br>
<div id="beritaaaa">
    <p><?php echo $info->berita; ?></p>
</div>


<br>

<!--    Load Image-->
@endif

<div class="span8 offset10">
    <button class="btn btn-primary" id="btn-usulan" type="button">Usulan</button>
</div>

<!-- dialog box -->
<div id="dialog" title="Forum">
    <p>Silahkan klik LOGIN terlebih dahulu untuk membuat usulan. Jika belum mempunyai akun, silakan klik DAFTAR untuk registrasi.</p>
</div>

@stop

@section('scripts')
<script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
<script src="{{asset('assets/js/dusk.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
    var $ = jQuery.noConflict();
    var info_id = '<?php echo $info->id; ?>';

    $('#btn-usulan').click(function () {
        var user = '<?php echo Auth::user(); ?>';

        if (user) {
            switch (info_id)
            {
                case 1:
                    window.location.replace("{{ URL::route('puu.create') }}");
                    break;
                case 2:
                    window.location.replace("URL::route('pelembagaan.create')}}");
                    break;
                case 3:
                    window.location.replace("{{ URL::route('bantuan_hukum.create') }}");
                    break;
                case 4:
                    window.location.replace("{{ URL::route('sp.create') }}");
                    break;
                case 5:
                    window.location.replace("{{ URL::route('aj.create') }}");
                    break;
            }
        }
        else {
            $('#dialog').dialog({
                height: 190,
                width: 400,
                modal: true,
                buttons: {
                    "Login" : function(){
                        window.location.replace("{{URL::to('site')}}");
                    },

                    "Registrasi" : function(){
                        window.location.replace("{{URL::to('registrasi')}}");
                    },

                    Cancel : function() {
                        $(this).dialog("close");
                    }
                }
            });
        }
    });
</script>
@parent
@stop