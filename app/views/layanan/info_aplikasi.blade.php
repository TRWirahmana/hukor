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



@include('flash')

@if($info != null)
<br>
<p><?php echo $info->berita; ?></p>

<br>

<!--    Load Image-->
@endif


@stop

@section('scripts')
<script type="text/javascript">
</script>
@parent
@stop