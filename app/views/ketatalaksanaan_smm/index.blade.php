@section('content')
    <h2>Layanan Ketatalaksanaan</h2>
<div class="stripe-accent"></div>

<legend>
    Informasi Layanan Ketatalaksanaan
</legend>

@include('flash')

@if($info != null)
    <h1><?php echo $info->judul_berita; ?></h1>
    <br>
    <p><?php echo $info->berita; ?></p>

    <p>Unit Penanggung Jawab: <?php echo $info->penanggung_jawab; ?></p>
    <br>

<!--    Load Image-->
    <?php $attach = $info->image; ?>
    {{ HTML::image('assets/uploads/layananketatalaksanaan/' . $attach) }}
@endif

@if($info == null)
<h1>Judul: </h1>
<br>
<p>Info Layanan: </p>
<p>Penanggung Jawab: </p>

@endif

@stop

@section('scripts')
@parent
@stop