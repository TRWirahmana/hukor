@section('content')
    <h2>Layanan Ketatalaksanaan</h2>
        @if($id == 2)
           <legend>Informasi Layanan Sistem dan Prosedur Kerja</legend>
        @elseif($id == 3)
           <legend>Informasi Sistem Manajemen Mutu</legend>        
        @elseif ($id == 4)
           <legend>Informasi Analisis Jabatan</legend>        
        @elseif($id == 5)
           <legend>Informasi Perhitungan Beban Kerja</legend>        
        @elseif($id == 6)
           <legend>Informasi Tata Nilai & Budaya Kerja Organisasi</legend>        
        @elseif($id == 7)
           <legend>Informasi Pelayanan Publik</legend>        
        @elseif($id == 8)
           <legend>Informasi Tata Naskah Dinas</legend>        
        @else        
           <legend>Informasi Layanan Ketatalaksanaan</legend>        
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

@stop

@section('scripts')
@parent
@stop