@section('content')
<?php $title = ""; ?>
    <div class="row-fluid">
        <div class="span24">
            <button class="btn btn-primary" id="btn-usulans" type="button">Buat Usulan</button>
            <button class="btn btn-primary" id="status-usulan" type="button">Status Usulan</button>
        </div>
    </div>
<hr>
@if($info->id == 1)
<!--PERATURAN PERUNDANG-UNDANGAN-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Informasi Per-UU";
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Peraturan perundang-undangan";
</script>

<legend>
    Informasi Peraturan Perundang-Undangan
</legend>

<script>
  document.getElementById("menu-peruu-info").setAttribute("class", "user-menu-active");
  document.getElementById("collapse10").style.height = "auto";
</script>
<?php $title = "Perundang-Undangan"; ?>
@endif

@if($info->id == 2)
<!--PELEMBAGAAN-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Informasi Pelembagaan";
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Pelembagaan";
</script>

<legend>
    Informasi Pelembagaan
</legend>

<script>
  document.getElementById("menu-pelembagaan-info").setAttribute("class", "user-menu-active");
  document.getElementById("collapse11").style.height = "auto";
</script>
<?php $title = "Pelembagaan"; ?>
@endif

@if($info->id == 3)
<!--BANTUAN HUKUM-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Informasi Bantuan Hukum";
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Bantuan hukum";
</script>

<legend>
    Informasi Bantuan Hukum
</legend>

<script>
  document.getElementById("collapse13").style.height = "auto";
  document.getElementById("menu-bantuan-hukum-info").setAttribute("class", "user-menu-active");
</script>
<?php $title = "Bantuan Hukum"; ?>
@endif

@if($info->id == 4)
<!--KETATALAKSANAAN-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Informasi Sistem dan Prosedur";
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Sistem dan Prosedur";
</script>

<legend>
    Informasi Sistem dan Prosedur
</legend>
<script>
    document.getElementById("collapse14").style.height = "auto";
    document.getElementById("menu-prosedur-info").setAttribute("class", "user-menu-active");
</script>
<?php $title = "Sistem dan Prosedur"; ?>
@endif

<?php //var_dump($info->id);exit;?>
@if($info->id == 5)
<!--KETATALAKSANAAN-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Informasi Analisis Jabatan";
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Analisis Jabatan";
</script>

<legend>
    Informasi Analisis Jabatan
</legend>
<script>
    document.getElementById("collapse12").style.height = "auto";
    document.getElementById("menu-anjab-info").setAttribute("class", "user-menu-active");
</script>
<?php $title = "Analisis Jabatan"; ?>
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

<!-- dialog box -->
<div id="dialogs" title="<?php echo $title; ?>" style="display: none;">
    <p>Silahkan klik LOGIN terlebih dahulu untuk membuat usulan. Jika belum mempunyai akun, silakan klik DAFTAR untuk registrasi.</p>
</div>

@stop

@section('scripts')
<script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>

<script type="text/javascript">
    var $ = jQuery.noConflict();
    var info_id = '<?php echo $ids; ?>';

    $('#btn-usulans').click(function () {
//        alert(info_id);exit;
        var user = '<?php echo Auth::user(); ?>';

        if (user) {
            switch(info_id)
            {
                case '1':
                    window.location.replace("{{ URL::route('puu.create') }}");
                    break;
                case '2':
                    window.location.replace("{{ URL::route('pelembagaan.create')}}");
                    break;
                case '3':
                    window.location.replace("{{ URL::route('bantuan_hukum.create') }}");
                    break;
                case '4':
                    window.location.replace("{{ URL::route('sp.create') }}");
                    break;
                case '5':
                    window.location.replace("{{ URL::route('aj.create') }}");
                    break;
            }
        }
        else {
            $('#dialogs').dialog({
                width: 500,
                modal: true,
                buttons: {
                    "Login" : function(){
                        window.location.replace("{{URL::to('site')}}");
                    },

                    "Daftar" : function(){
                        window.location.replace("{{URL::to('registrasi')}}");
                    },

                    Cancel : function() {
                        $(this).dialog("close");
                    }
                }
            });
        }
    });

    $('#status-usulan').click(function () {
//        alert(info_id);exit;
        var user = '<?php echo Auth::user(); ?>';

            switch(info_id)
            {
                case '1':
                    window.location.replace("{{ URL::route('puu.index') }}");
                    break;
                case '2':
                    window.location.replace("{{ URL::route('pelembagaan.index')}}");
                    break;
                case '3':
                    window.location.replace("{{ URL::to('BantuanHukum') }}");
                    break;
                case '4':
                    window.location.replace("{{ URL::route('sp.index') }}");
                    break;
                case '5':
                    window.location.replace("{{ URL::route('aj.index') }}");
                    break;
            }
    });
</script>
@parent
@stop