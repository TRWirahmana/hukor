@section('admin')

<div class="rightpanel">

  <ul class="breadcrumbs">
    <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li><a href="{{URL::previous()}}">Produk Hukum</a> <span class="separator"></span></li>
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
              {{ Form::label('', 'Nomor', array('class' => 'control-label')) }}
              <div class="controls">
                <input type="text" disabled value="{{ $data->nomor }}"/>
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('', 'Jenis', array('class' => 'control-label')) }}
              <div class="controls">
                  <input type="text" value="{{ $data->getKategori($data->kategori) }}" disabled/>
              </div>
            </div>

            <!--div class="control-group">
              {{ Form::label('', 'Masalah', array('class' => 'control-label')) }}
              <div class="controls">
                  <input type="text" value="{{ $data->getMasalah($data->masalah) }}" disabled/>
              </div>
            </div-->

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
<!--                <input type="text" disabled value="{{ $data->perihal }}"/>-->
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('', 'Keterangan', array('class' => 'control-label')) }}
              <div class="controls">
                  <textarea cols="10" disabled>{{ $data->deskripsi }}</textarea>
              </div>
            </div>

            <div class="control-group {{$errors->has('password')?'error':''}}">
              {{ Form::label('', 'Tanggal Pengesahan', array('class' => 'control-label')) }}
              <div class="controls">
                <input type="text" disabled value="{{ $data->tgl_pengesahan }}"/>
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('', 'Lampiran', array('class' => 'control-label')) }}
              <div class="controls">
                  @if($data->file_dokumen == null)
                  <p>Tidak ada lampiran</p>
                  @else
                    <a class="btn btn-primary" href="{{ URL::asset('assets/uploads/dokumen/' . $data->file_dokumen )}} "> <span class="rulycon-download"></span> Unduh </a>
                    @endif
              </div>
            </div>

            <div class="control-group">
              <div class="controls span2">
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

@section('scripts')
@parent
<script>
    var $ = jQuery.noConflict();

    jQuery("#produk-hukum > li:first-child").addClass("sub-menu-active");
    jQuery("#produk-hukum").css({
        "display": "block",
        "visibility": "visible"
    });

    $(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Detail Peraturan Produk Hukum";
    });
</script>
@stop
