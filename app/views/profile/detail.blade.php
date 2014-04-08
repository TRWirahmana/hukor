@section('content')
<?php $title = ""; ?>
<!--PERATURAN PERUNDANG-UNDANGAN-->
<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Profil";
</script>

<script>
    document.getElementById("menu-profile").setAttribute("class", "active");
//    document.getElementById("collapse10").style.height = "auto";
</script>
<?php $title = "Profil"; ?>

@include('flash')

@if($data != null)
@if($data->gambar != null)
<div style="text-align: center;">
    {{ HTML::image('assets/uploads/profile/' . $data->gambar) }}
</div>
<br>
@endif

<div id="isi">
    <p><?php echo $data->isi; ?></p>
</div>

<!--    Load Image-->
@endif

@stop

@section('scripts')
<script src="{{asset('assets/js/jquery-1.10.1.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
    var $ = jQuery.noConflict();

    $(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Profil";
    });
</script>
@parent
@stop