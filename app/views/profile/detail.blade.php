@section('content')
<?php $title = ""; ?>
<!--PERATURAN PERUNDANG-UNDANGAN-->
<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Profile";
</script>

<script>
    document.getElementById("menu-profile").setAttribute("class", "active");
//    document.getElementById("collapse10").style.height = "auto";
</script>
<?php $title = "Profile"; ?>

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
</script>
@parent
@stop