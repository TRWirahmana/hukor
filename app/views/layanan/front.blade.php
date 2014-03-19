@section('content')
<h2>Layanan Kelembagaan</h2>
<div class="stripe-accent"></div>

<legend>
    Informasi Layanan Kelembagaan
</legend>

@include('flash')

@if($info != null)
<!--    <h1>--><?php //echo $info->judul_berita; ?><!--</h1>-->
<br>
<div id="beritaaas">
    <p><?php echo $info->berita; ?></p>
</div>


<p>Unit Penanggung Jawab: <?php echo $info->penanggung_jawab; ?></p>
<br>

<!--    Load Image-->
<?php $attach = $info->image; ?>
{{ HTML::image('assets/uploads/layanankelembagaan/' . $attach) }}
@endif


@stop

@section('scripts')
<script type="text/javascript">
</script>
@parent
@stop