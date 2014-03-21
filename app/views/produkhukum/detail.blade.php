@section('content')
<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Produk hukum";
</script>
<!-- <legend>Pengajuan Usulan</legend>
 -->

@include('flash')
{{ Form::open($form_opts) }}

<div class="row-fluid">
  <div class="span12">
    <fieldset>
      <legend style="margin-bottom: 0">Informasi Detail Peraturan</legend>
      <div class="control-group">
        {{ Form::label('nomor', 'Nomor', array('class' => 'control-label'))}}
        <div class="controls">
          <input type="text" value="{{ $data->nomor }}" disabled/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('kategori', 'Kategori', array('class' => 'control-label'))}}
        <div class="controls">
          <input type="text" value="{{ $data->getKategori($data->kategori) }}" disabled/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('masalah', 'Masalah', array('class' => 'control-label'))}}
        <div class="controls">
          <input type="text" value="{{ $data->getMasalah($data->masalah) }}" disabled/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('bidang', 'Bidang', array('class' => 'control-label'))}}
        <div class="controls">
          <input type="text" value="{{ $data->getBidang($data->bidang) }}" disabled/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('tentang', 'Tentang', array('class' => 'control-label'))}}
        <div class="controls">
          <input type="textarea" value="{{ $data->perihal }}" disabled/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('tgl_pengesahan', 'Tanggal Pengesahan', array('class' => 'control-label'))}}
        <div class="controls">
          <input type="text" value="{{ $data->tgl_pengesahan }}" disabled/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
        <div class="controls">
          <a class="btn btn-primary" href={{ URL::asset('assets/uploads/dokumen/' . $data->file_dokumen ); }} > <span class="rulycon-download"></span> Unduh </a>
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <input class='btn btn-primary' Type="button" value="Kembali" onClick="history.go(-1);return true;">
        </div>
      </div>

    </fieldset>
  </div>


  {{ Form::close() }}

  <script>
    document.getElementById("menu-produk-hukum").setAttribute("class", "active");
  </script>
  @stop
