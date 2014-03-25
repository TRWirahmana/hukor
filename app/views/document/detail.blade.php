@section('admin')

<div class="rightpanel">

  <ul class="breadcrumbs">
    <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li><a href="{{URL::previous()}}">Peraturan</a> <span class="separator"></span></li>
    <li>Detail Peraturan</li>
  </ul>
  @include('adminflash')
  <div class="pageheader">
    <!--        <form action="results.html" method="post" class="searchbar">-->
    <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
    <!--        </form>-->
    <div class="pageicon"><span class="rulycon-notebook"></span></div>
    <div class="pagetitle">
      <!--<h5>Events</h5>-->

      <h1>Detail Peraturan</h1>
    </div>
  </div>
  <!--pageheader-->

  <div class="maincontent">
    <div class="maincontentinner">

      <!-- MAIN CONTENT -->
      {{ Form::open($form_opts) }}

      <div class="row-fluid">
        <div class="span8 offset2">
          <fieldset>
            <legend class="f_legend">{{$title}}</legend>
            <p class="text-info">{{$detail}}</p>

            <div class="control-group">
              {{ Form::label('', 'Nama Pemohon', array('class' => 'control-label')) }}
              <div class="controls">
                <input type="text" disabled value="{{ $data->nomor }}"/>
              </div>
            </div>

            <?php
            $kategori = "";
            switch ($data->kategori) {
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
                <input type="text" disabled value="{{ $kategori }}"/>
              </div>
            </div>

            <?php
            $masalah = "";
            switch ($data->masalah) {
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
                <input type="text" disabled value="{{ $masalah }}"/>
              </div>
            </div>

              <div class="control-group">
                  {{ Form::label('bidang', 'Bidang', array('class' => 'control-label'))}}
                  <div class="controls">
                      <input type="text" value="{{ $data->getBidang($data->bidang) }}" disabled/>
                  </div>
              </div>

            <div class="control-group">
              {{ Form::label('', 'Tentang', array('class' => 'control-label')) }}
              <div class="controls">
                  <textarea cols="10" disabled>{{ $data->perihal }}</textarea>
                <input type="text" disabled value="{{ $data->perihal }}"/>
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('', 'Deskripsi', array('class' => 'control-label')) }}
              <div class="controls">
                <input type="text" disabled value="{{ $data->deskripsi }}"/>
              </div>
            </div>

            <div class="control-group {{$errors->has('password')?'error':''}}">
              {{ Form::label('', 'Tanggal Pengesahan', array('class' => 'control-label')) }}
              <div class="controls">
                <input type="text" disabled value="{{ $data->tgl_pengesahan }}"/>
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('', 'File Dokumen', array('class' => 'control-label')) }}
              <div class="controls">
                  <a class="btn btn-primary-blue" href={{ URL::asset('assets/uploads/dokumen/' . $data->file_dokumen ); }} > <span class="rulycon-download"></span> Unduh </a>
              </div>
            </div>

            <div class="control-group">
              <div class="controls">
                <a href="{{URL::previous()}}" style="background: transparent">{{ Form::button('Kembali', array('class' => 'btn btn-primary')) }}</a>
              </div>
            </div>

          </fieldset>
        </div>

      </div>
      {{ Form::close() }}

      <div class="footer">
        <div class="footer-left">
          <span>&copy;2014 Biro Hukum dan Organisasi</span>
        </div>
        <div class="footer-right">
          <span></span>
        </div>
      </div>
      <!--footer-->
    </div>
    <!--maincontentinner-->
  </div>
  <!--maincontent-->


</div>
<!--rightpanel-->
@stop
