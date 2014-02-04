@section('content')
    <h2>Layanan Ketatalaksanaan</h2>
<div class="stripe-accent"></div>

  @if($info != NULL)
        @if($info->id == 2)
           <legend>Informasi Layanan Sistem dan Prosedur Kerja</legend>
        @elseif($info->id == 3)
           <legend>Informasi Sistem Manajemen Mutu</legend>        
        @elseif ($info->id == 4)
           <legend>Informasi Analisis Jabatan</legend>        
        @elseif($info->id == 5)
           <legend>Informasi Perhitungan Beban Kerja</legend>        
        @elseif($info->id == 6)
           <legend>Informasi Tata Nilai & Budaya Kerja Organisasi</legend>        
        @elseif($info->id == 7)
           <legend>Informasi Pelayanan Publik</legend>        
        @elseif($info->id == 8)
           <legend>Informasi Tata Naskah Dinas</legend>        
        @else        
           <legend>Informasi Layanan Ketatalaksanaan</legend>        
        @endif
  @endif
  

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