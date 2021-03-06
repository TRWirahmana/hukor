@section('admin')

<div class="rightpanel">

  <ul class="breadcrumbs">
    <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li><a href="{{URL::previous()}}">Produk Hukum</a> <span class="separator"></span></li>
    <li>{{ $title }}</li>
  </ul>
  @include('adminflash')
  <div class="pageheader">
    <!--        <form action="results.html" method="post" class="searchbar">-->
    <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
    <!--        </form>-->
    <div class="pageicon"><span class="rulycon-notebook"></span></div>
    <div class="pagetitle">
      <!--<h5>Events</h5>-->

      <h1>{{ $title }}</h1>
    </div>
  </div>
  <!--pageheader-->

  <div class="maincontent">
    <div class="maincontentinner">

      <!-- MAIN CONTENT -->
      <div class="row-fluid">
        {{ Form::open($form_opts) }}

        <div class="span8 offset2">
          <fieldset>
            <p class="text-info">{{$detail}}</p>

            <div class="control-group">
              {{ Form::label('nomor', 'Nomor', array('class' => 'control-label')) }}
              <div class="controls">
                {{ Form::text('nomor', $data->nomor, array('id' => 'nomor')) }}
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('kategori', 'Jenis', array('class' => 'control-label')) }}
              <div class="controls">
                {{ Form::select('kategori', array(
                  '0' => '- Pilih Jenis -',
                  '1' => 'Undang-undang Dasar',
                  '2' => 'Peraturan Pemerintah',
                  '3' => 'Peraturan Presiden',
                  '4' => 'Keputusan Presiden',
                  '5' => 'Instruksi Presiden',
                  '6' => 'Peraturan Menteri',
                  '7' => 'Keputusan Menteri',
                  '9' => 'Surat Edaran Menteri',
                  '12' => 'Peraturan Bersama',
                  '13' => 'Keputusan Bersama',
                  '10' => 'Nota Kesepahaman',
                  '11' => 'Kesepakatan Bersama',
                  '14' => 'Surat Edaran Bersama',
                  '15' => 'Peraturan Lain',
                ), $data->kategori) }}
              </div>
            </div>

            <!--div class="control-group">
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
            </div-->

            <div class="control-group">
              {{ Form::label('bidang', 'Bidang', array('class' => 'control-label')) }}
              <div class="controls">
                {{ Form::select('bidang', array(
                '0' => '- Pilih Bidang -',
                '1' => 'Pendidikan Dasar',
                '2' => 'Pendidikan Menengah',
                '3' => 'Pendidikan Tinggi',
                '4' => 'Kebudayaan',
                '5' => 'Pendidikan Anak Usia Dini, Nonformal, Informal',
                '6' => 'Lainnya',
                ), $data->bidang) }}
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('perihal', 'Tentang', array('class' => 'control-label')) }}
              <div class="controls">
                {{ Form::textarea('perihal', $data->perihal, array('id' => 'perihal')) }}
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('deskripsi', 'Keterangan', array('class' => 'control-label')) }}
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

            <div class="control-group">
              <div class="controls">
                {{Form::submit("Draft", array("class" => "btn btn-primary", "name" => "status"))}}
                {{Form::submit("Publish", array("class" => "btn btn-primary", "name" => "status"))}}
                <input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);return true;" name="kembali">
              </div>
            </div>

          </fieldset>

        </div>
        {{ Form::close() }}
      </div>


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
<script type="text/javascript">
  var $ = jQuery.noConflict();
  $(function () {
    $(".datepicker").datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      yearRange: "1970:2020",
      changeYear: true
    }).val();
  });
</script>

<script>
    var titlez = '<?php echo $title; ?> ';

    var t = $.trim(titlez);
//    alert(t);

    if(t == "Tambah Peraturan"){
//        alert('b');
        jQuery("#produk-hukum > li:last-child").addClass("sub-menu-active");
        jQuery("#produk-hukum").css({
            "display": "block",
            "visibility": "visible"
        });
    }

    if(t == "Ubah Informasi Peraturan"){
//        alert('a');
        jQuery("#produk-hukum > li:first-child").addClass("sub-menu-active");
        jQuery("#produk-hukum").css({
            "display": "block",
            "visibility": "visible"
        });
    }

    $(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Produk Hukum";
    });
</script>
@stop
