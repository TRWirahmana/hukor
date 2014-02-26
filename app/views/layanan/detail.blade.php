@section('content')
<h2>Layanan</h2>
<div class="stripe-accent"></div>

<legend>
    Informasi Layanan
</legend>

@include('flash')

@if($info != null)
<!--    <h1>--><?php //echo $info->judul_berita; ?><!--</h1>-->
<br>
<p><?php echo $info->berita; ?></p>

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
{{ HTML::image('assets/uploads/layanan/' . $attach) }}
@endif


@stop

@section('scripts')
<script type="text/javascript">
</script>
@parent
@stop