@section('content')


<h2>KETATALAKSANAAN</h2>
<div class="stripe-accent"></div>
<legend>Dokumen</legend>

@include('flash')

{{ Form::open(array('action' => 'DocumentController@save', 'method' => 'post',
'id' => 'user-registrasi-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal',
'enctype' => "multipart/form-data")) }}
<div class="row-fluid">
    <div class="span12">
        <div class="nav nav-tabs">
            <h4>DETAIL DOKUMEN</h4>
        </div>
        <div class="control-group">
            {{ Form::label('', 'Nama Pemohon', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $data->nomor }}
            </div>
        </div>

        <?php
        $kategori = "";
        switch($data->kategori)
        {
            case 1:
                $kategori = "Keputusan Menteri";
                break;
            case 2:
                $kategori = "Peraturan Menteri";
                break;
            case 3:
                $kategori = "Peraturan Bersama";
                break;
            case 4:
                $kategori = "Keputusan Bersama";
                break;
            case 5:
                $kategori = "Instruksi Menteri";
                break;
            case 6:
                $kategori = "Surat Edaran";
                break;
        }
        ?>
        <div class="control-group">
            {{ Form::label('', 'Kategori', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $kategori }}
            </div>
        </div>

        <?php
        $masalah = "";
        switch($data->masalah)
        {
            case 1:
                $masalah = "Kepegawaian";
                break;
            case 2:
                $masalah = "Keuangan";
                break;
            case 3:
                $masalah = "Organisasi";
                break;
            case 4:
                $masalah = "Umum";
                break;
            case 5:
                $masalah = "Perlengkapan";
                break;
            case 6:
                $masalah = "Lainnya";
                break;
        }
        ?>
        <div class="control-group">
            {{ Form::label('', 'Masalah', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $masalah }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('', 'Tentang', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $data->perihal }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('', 'Deskripsi', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $data->deskripsi }}
            </div>
        </div>

        <div class="control-group {{$errors->has('password')?'error':''}}">
            {{ Form::label('', 'Tanggal Pengesahan', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $data->tgl_pengesahan }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('', 'File Dokumen', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $data->file_dokumen }}
            </div>
        </div>
    </div>
    <div class="span12">

    </div>
</div>

<div class="row-fluid">
    <div class="span24 text-center">
        <button class="btn" type="submit">Simpan</button>
        <button class="btn" type="button">Batal</button>
    </div>
</div>
{{ Form::close() }}
@stop