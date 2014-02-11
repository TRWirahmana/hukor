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

<p>Unit Penanggung Jawab: <?php echo $info->penanggung_jawab; ?></p>
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