@section('content')


<h2>KETATALAKSANAAN</h2>
<div class="stripe-accent"></div>
<legend>Dokumentasi</legend>

@include('flash')

{{ Form::open($form_opts) }}

{{ Form::hidden('id', $data->id) }}

<div class="row-fluid">
    <div class="span12">
        <div class="nav nav-tabs">
            <h4>INPUT DOKUMEN</h4>
        </div>
        <div class="control-group">
            {{ Form::label('nomor', 'Nomor', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('nomor', $data->nomor, array('id' => 'nomor')) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('kategori', 'Kategori', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::select('kategori', array(
                '0' => '- Pilih Kategori -',
                '1' => 'Keputusan Menteri',
                '2' => 'Peraturan Menteri',
                '3' => 'Peraturan Bersama',
                '4' => 'Keputusan Bersama',
                '5' => 'Instruksi Menteri',
                '6' => 'Surat Edaran',
                ), $data->kategori) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('masalah', 'Masalah', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::select('masalah', array(
                '0' => '- Pilih Masalah -',
                '1' => 'Kepegawaian',
                '2' => 'Keuangan',
                '3' => 'Organisasi',
                '4' => 'Umum',
                '5' => 'Perlengkapan',
                '7' => 'Tim',
                '6' => 'Lainnya',
                ), $data->masalah) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('bidang', 'Bidang', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::select('bidang', array(
                '0' => '- Pilih Bidang -',
                '1' => 'Pendidikan Dasar',
                '2' => 'Pendidikan Menengah',
                '3' => 'Pendidikan Tinggi',
                '4' => 'Kebudayaan',
                '5' => 'Pendidikan Anak Usia Dini',
                '6' => 'Nonformal',
                '7' => 'Informal',
                ), $data->masalah) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('perihal', 'Perihal', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::textarea('perihal', $data->perihal, array('id' => 'perihal')) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('deskripsi', 'Deskripsi', array('class' => 'control-label')) }}
            <div class="controls">
                {{Form::textarea('deskripsi', $data->deskripsi, array('id'=>'deskripsi'))}}
            </div>
        </div>

        <div class="control-group {{$errors->has('password')?'error':''}}">
            {{ Form::label('tanggal', 'Tanggal Pengesahan', array('class' => 'control-label')) }}
            <div class="controls">
                {{Form::text('tanggal', $data->tgl_pengesahan, array('id'=>'tanggal', 'class'=>'datepicker'))}}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('file_dokumen', 'File Dokumen', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::file('file_dokumen', array('id'=>'file_dokumen')) }}
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span24 text-center">
        {{Form::submit("Draft", array("class" => "btn btn-primary", "name" => "status"))}}
        {{Form::submit("Publish", array("class" => "btn btn-primary", "name" => "status"))}}
    </div>
</div>
{{ Form::close() }}
@stop

@section('scripts')
@parent
<script type="text/javascript">
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            yearRange: "1970:2020",
            changeYear: true
        }).val();
    });
</script>
@stop