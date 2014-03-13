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


@stop

@section('scripts')
<script type="text/javascript">
</script>
@parent
@stop