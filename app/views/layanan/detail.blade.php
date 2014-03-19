@section('content')
<!--<h2>{{$info->menu->nama_menu}}</h2>-->
<!--<div class="stripe-accent"></div>-->
<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> {{$info->menu->nama_menu}}";
</script>

<legend>
    @if($info->submenu != null)
    {{$info->submenu->nama_submenu}}
    @endif
</legend>

@include('flash')

@if($info != null)
<!--    <h1>--><?php //echo $info->judul_berita; ?><!--</h1>-->
<br>
<div id="beritaaas">
    <p><?php echo $info->berita; ?></p>
</div>

<?php
switch($info->penanggung_jawab){
    case 1:
        echo "<p>Unit Penanggung Jawab: Bagian Peraturan Perundang-Undangan</p>";
        break;

    case 2:
        echo "<p>Unit Penanggung Jawab: Bagian Bantuan Hukum</p>";
        break;

    case 3:
        echo "<p>Unit Penanggung Jawab: Bagian Kelembagaan</p>";
        break;

    case 4:
        echo "<p>Unit Penanggung Jawab: Bagian Ketatalaksanaan</p>";
        break;
}
?>

<br>

<!--    Load Image-->
    <?php $attach = $info->gambar; ?>
    @if($attach != null)
        {{ HTML::image('assets/uploads/layanan/' . $attach) }}
    @endif
@endif


@stop

@section('scripts')
<script type="text/javascript">
</script>
@parent
@stop